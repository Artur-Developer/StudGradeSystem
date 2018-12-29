<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Postbackend;

/**
 * PostbackendSearch represents the model behind the search form about `backend\models\Postbackend`.
 */
class PostbackendSearch extends Postbackend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id','how_send'], 'integer'],
            [['title', 'text', 'date'], 'safe'],
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
        if (!Yii::$app->user->isGuest &&
            Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())
            ['Firste_admin']->name == 'Firste_admin')
        {
            $query = Postbackend::find();

        }

        else{
            $a = Yii::$app->user->id;
            $query = Postbackend::find()->where(['user_id' => $a ]);
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
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'user_id' => $this->user_id,
            'how_send' => $this->how_send,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'how_send', $this->how_send]);

        return $dataProvider;
    }

}
