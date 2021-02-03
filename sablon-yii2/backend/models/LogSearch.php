<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Log;

/**
 * LogSearch represents the model behind the search form of `app\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_log', 'id_model_log'], 'integer'],
            [['action_log', 'tabela_log', 'changes_log', 'data_log', 'id_user_log', 'ip_log'], 'safe'],
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
        $query = Log::find()->orderby('data_log DESC');

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
        $query->joinWith('userLog');

        // grid filtering conditions
        $query->andFilterWhere([
            'id_log' => $this->id_log,
            'id_model_log' => $this->id_model_log,
        ]);

        $query->andFilterWhere(['like', 'action_log', $this->action_log])
            ->andFilterWhere(['like', 'ip_log', $this->ip_log])
            ->andFilterWhere(['like', 'data_log', $this->data_log])
            ->andFilterWhere(['like', 'tabela_log', $this->tabela_log])
            ->andFilterWhere(['like', 'user.username', $this->id_user_log])
            ->andFilterWhere(['like', 'changes_log', $this->changes_log]);

        return $dataProvider;
    }
}
