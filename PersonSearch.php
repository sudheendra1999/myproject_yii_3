<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'income', 'expense', 'total_balance'], 'integer'],
            [['details','user_id', 'date_capture'], 'safe'],
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
        $query = Person::find();
        $query->leftJoin('backend_user','backend_user.id=person.user_id');

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
            'person_id' => $this->person_id,
            'income' => $this->income,
            'expense' => $this->expense,
            'total_balance' => $this->total_balance,
            'date_capture' => $this->date_capture,
            //'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details]);
        $query->andFilterWhere(['like', 'backend_user.username', $this->user_id]);

        return $dataProvider;
    }
}
