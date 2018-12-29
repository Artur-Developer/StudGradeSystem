<?php

namespace backend\models;
use backend\components\Customs;
use backend\components\GetUserInfo;
use Yii;

class RatingData extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'rating_data';
    }

    public $subject_group_id;
    public $date_update_id;

    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'date','format'=>'Y-m-d'],
            [['theme_id','subject_group_id','date_update_id'], 'integer'],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Themes::className(), 'targetAttribute' => ['theme_id' => 'id']],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Дата',
            'theme_id' => 'Тема занятия',
        ];
    }

    public static function  getLastIdFromRatingData()
    {
    	 $lastId = static::find()->orderBy('id DESC')->one();
    	 return $lastId->id;
    }

    public function checkDuplicateDate(){
        if (!$this->hasErrors()) {
            $date = RatingGroup::find()->leftJoin('rating_data', 'rating.col_rating_id = rating_data.id')->where(['subject_group_id' => $this->subject_group_id])->andWhere(['rating_data.data'=> date("Y-m-d", strtotime($this->data))])->groupBy('col_rating_id')->one();
            if (!empty($date)) {
                Yii::$app->session->setFlash('danger', 'Дата ' . date("d-m-Y", strtotime($date->data->data)) . ' уже существует');
                return false;
            }
            elseif (empty($date)) {
                Yii::$app->session->setFlash('success', 'Добавлена дата ' . $this->data);
                static::SaveNewFormatDate();
            }
        }
        return false;
    }

  
    public function CreateDate($date,$theme_id=null){
        if($this->validate()){
            $this->data =  date("Y-m-d", strtotime($date));
            $this->theme_id = $theme_id;
            return $this->save();
        }
        else{
            return false;
        }
    }

    public function SaveNewFormatDate(){
        $this->data =  date("Y-m-d", strtotime($this->data));
        parent::save();
    }

    public function DropData($id){
        $find = self::findOne($id);
        $find->delete();
    }

    public function UpdateValueData($value,$id,$theme_id=null){
        $find = static::findOne($id);
        $find->data = date("Y-m-d", strtotime($value));
        $find->theme_id = $theme_id;
        return $find->save();
    }

    public function getIdData()
    {
        return $this->hasMany(RatingGroup::className(), ['col_rating_id' => 'id']);
    }

    public function getThemes()
    {
        return $this->hasOne(Themes::className(), ['id' => 'theme_id']);
    }
}