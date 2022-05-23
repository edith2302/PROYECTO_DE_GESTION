<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form of `app\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'num_integrantes', 'id_profe_guia', 'id_autor'], 'integer'],
            [['nombre', 'descripcion', 'tipo', 'area', 'estado', 'disponibilidad'], 'safe'],
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
        $query = Proyecto::find();

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
            'num_integrantes' => $this->num_integrantes,
            'id_profe_guia' => $this->id_profe_guia,
            'id_autor' => $this->id_autor,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'disponibilidad', $this->disponibilidad]);

        return $dataProvider;
    }
}
