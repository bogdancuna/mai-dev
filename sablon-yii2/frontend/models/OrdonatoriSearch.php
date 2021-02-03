<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ordonatori;

/**
 * OrdonatoriSearch represents the model behind the search form of `app\models\Ordonatori`.
 */
class OrdonatoriSearch extends Ordonatori
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tip_ord'], 'integer'],
            [['denumire'], 'safe'],
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
        $query = Ordonatori::find();

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
            'tip_ord' => $this->tip_ord,
        ]);

        $query->andFilterWhere(['like', 'denumire', $this->denumire]);

        return $dataProvider;
    }
}
