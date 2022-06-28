<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rubrica;

/**
 * RubricaSearch represents the model behind the search form of `app\models\Rubrica`.
 */
class RubricaSearch extends Rubrica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'descripcion',/* 'escala', */'id_profe_asignatura'], 'integer'],
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
        $query = Rubrica::find();

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
            'descripcion' => $this->descripcion,
            //'escala' => $this->escala,
            'id_profe_asignatura' => $this->id_profe_asignatura,
        ]);

        return $dataProvider;
    }
}
