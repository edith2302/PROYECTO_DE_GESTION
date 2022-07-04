<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hito;

/**
 * HitoSearch represents the model behind the search form of `app\models\Hito`.
 */
class HitoSearch extends Hito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_hito', 'porcentaje_nota', 'id_rubrica', 'id_profe_asignatura'], 'integer'],
            [['nombre', 'descripcion', 'fecha_habilitacion', 'hora_habilitacion', 'fecha_limite', 'hora_limite'], 'safe'],
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
        $query = Hito::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>1
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
            'fecha_habilitacion' => $this->fecha_habilitacion,
            'hora_habilitacion' => $this->hora_habilitacion,
            'fecha_limite' => $this->fecha_limite,
            'hora_limite' => $this->hora_limite,
            'tipo_hito' => $this->tipo_hito,
            'porcentaje_nota' => $this->porcentaje_nota,
            'id_rubrica' => $this->id_rubrica,
            'id_profe_asignatura' => $this->id_profe_asignatura,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
