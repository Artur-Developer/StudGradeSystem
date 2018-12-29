<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 08.09.2017
 * Time: 23:00
 */

namespace backend\models;

use backend\components\Customs;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\components\GetUserInfo;
use backend\Models\AllGroup;

class ImportExcelFile  extends \yii\db\ActiveRecord
{
    public static function tableName()
    {

        return 'uploadExcelFile';
    }
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $file = 'uploads/group/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            if(!file_exists($file)){
                $this->imageFile->saveAs($file);
            }
            return true;
        } else {
            return false;
        }
    }
    public function CheckImportFile($name)
    {
        return $this::find()->where(['fileName'=>$name])->one();
    }
    
      public static function  getLastId()
    {
    	 $lastId = static::find()->orderBy('id DESC')->one();
    	 return $lastId->id;
    }

    public function InsertData()
    {
         $mmm = new GetUserInfo;
         $table = self::tableName();
         $getFileName = $this->imageFile->baseName;
         $extensionFile = '.'.$this->imageFile->extension;
         $data = $mmm->dataTime();
         $userId = $mmm->userId();
         $request =  Yii::$app->db->createCommand("INSERT INTO `$table` (`id`, `fileName`, `fileExtensions`,`importData`,`user_id`) 
          VALUES (' ','$getFileName','$extensionFile','$data','$userId')")->execute();
        return $request;
    }
    
    public function CreateGroupData()
    {
         $table = AllGroup::tableName();
         $groupName = $this->imageFile->baseName;
         $id = static::getLastId();
         $request =  Yii::$app->db->createCommand("INSERT INTO `$table` (`id`, `name_group`,`importFile_id`) 
          VALUES (' ','$groupName', '$id')")->execute();
        return $request;
    }


    public function getImportfile()
    {
        return $this->hasOne(AllGroup::className(), ['importFile_id' => 'id']);
    }

}
