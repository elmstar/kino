<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Session;

/**
 * SessionSearch represents the model behind the search form of `backend\models\Session`.
 */
class SessionSearch extends Session
{
    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['film.title', 'film.duration']);
    }
    public function rules()
    {
        return [
            [['id', 'film_id'], 'integer'],
            [['datetime', 'film.title'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Session::find();
        $query->joinWith(['film' => function ($query) {
            $query->from(['film' => 'film']);
        }]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => ['datetime' => SORT_DESC]],
        ]);
        $dataProvider->sort->attributes = array_merge($dataProvider->sort->attributes, [
            'film.title' => [
                    'asc' => ['film.title' => SORT_ASC],
                    'desc' => ['film.title' => SORT_DESC]
                ],
            'film.duration' => [
                'asc' => ['film.duration' => SORT_ASC],
                'desc' => ['film.duration' => SORT_DESC]
            ]
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
            'film_id' => $this->film_id,
            'datetime' => $this->datetime,
            'price' => $this->price,
        ]);
        $query->andFilterWhere(['like', 'film.title', $this->getAttribute('film.title')]);
        return $dataProvider;
    }
}
