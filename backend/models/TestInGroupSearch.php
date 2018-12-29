<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TestInGroup;

/**
 * TestInGroupSearch represents the model behind the search form about `backend\models\TestInGroup`.
 */
class TestInGroupSearch extends TestInGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'required', 'test_id', 'subject_group_id', 'rating_data_id', 'user_id'], 'integer'],
            [['type', 'end_date', 'create_date'], 'safe'],
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
        if (Yii::$app->user->can('Firste_admin')) {
            $query = TestInGroup::find();
        }
        else{
            $a = Yii::$app->user->id;
            $query = TestInGroup::find()->where(['user_id' => $a ]);
        }

//        $query = TestInGroup::find();

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
            'required' => $this->required,
            'test_id' => $this->test_id,
            'subject_group_id' => $this->subject_group_id,
            'rating_data_id' => $this->rating_data_id,
            'user_id' => $this->user_id,
            'end_date' => $this->end_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
        ->andFilterWhere(['like', 'subject_group_id', $this->subject_group_id]);

        return $dataProvider;
    }
}
