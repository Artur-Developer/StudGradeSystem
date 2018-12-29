<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Testing;

/**
 * TestingSearch represents the model behind the search form about `backend\models\Testing`.
 */
class TestingSearch extends Testing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id'], 'integer'],
            [['name_test', 'description', 'user_create', 'create_date'], 'safe'],
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
        $query = Testing::find();

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
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'name_test', $this->name_test])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user_create', $this->user_create]);

        return $dataProvider;
    }
}
