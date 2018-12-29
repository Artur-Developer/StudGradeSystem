<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 28.01.2018
 * Time: 16:05
 */

namespace frontend\models;

use backend\models\Group;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class GetSubjectGroup extends Group
{


    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['group_id', 'user_id', 'subject_id' ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }



    public function search($params)
    {

         if (!Yii::$app->user->isGuest && !Yii::$app->user->can('Prepod')) {
            $query = Group::find()->where(['group_id'=>Yii::$app->user->identity->group_id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
////            'id' => $this->id,
//            'group_id' => $this->group_id,
//            'subject.name_subject' => $this->subject->name_subject,
//        ]);

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id]);

        return $dataProvider;

    }

}
