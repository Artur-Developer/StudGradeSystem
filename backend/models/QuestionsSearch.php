<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Questions;

/**
 * QuestionsSearch represents the model behind the search form about `backend\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id', 'user_id', 'rating'], 'integer'],
            [['name_question', 'type', 'time', 'create_date'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
//        $query = Questions::find();
        if (Yii::$app->user->can('Firste_admin')) {
            $query = Questions::find();
        }
        else{
            $a = Yii::$app->user->id;
            $query = Questions::find()->where(['user_id'=>$a]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        // add conditions that should always apply here

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
        $query->andFilterWhere([
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'time' => $this->time,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'name_question', $this->name_question])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
