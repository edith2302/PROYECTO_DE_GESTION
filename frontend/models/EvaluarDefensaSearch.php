<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evaluardefensa;

/**
 * EvaluardefensaSearch represents the model behind the search form of `app\models\Evaluardefensa`.
 */
class EvaluardefensaSearch extends Evaluardefensa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_comision', 'id_defensa', 'nota'], 'integer'],
            [['comentarios'], 'safe'],
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
        $query = Evaluardefensa::find();

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
            'id_comision' => $this->id_comision,
            'id_defensa' => $this->id_defensa,
            'nota' => $this->nota,
        ]);

        $query->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
