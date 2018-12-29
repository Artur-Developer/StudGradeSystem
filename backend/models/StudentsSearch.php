<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 09.09.2017
 * Time: 19:09
 */

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PostbackendSearch represents the model behind the search form about `backend\models\Postbackend`.
 */
class StudentsSearch extends Students
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['last_name','first_name','middle_name', 'traing','email', 'create_data','group_id'], 'safe'],
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

            $query = Students::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'traing', $this->traing])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'group_id', $this->group_id]);

        $query->andFilterWhere([
            'traing' => $this->traing,
            'group_id' => $this->group_id,
            'status' => $this->status,]);


        return $dataProvider;
    }

}
