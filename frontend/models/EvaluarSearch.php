<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evaluar;

/**
 * EvaluarSearch represents the model behind the search form of `app\models\Evaluar`.
 */
class EvaluarSearch extends Evaluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','puntaje_ideal','puntaje_obtenido', 'nota', 'id_entrega', 'id_usuario'], 'integer'],
            [['nota'], 'number'],
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
        $query = Evaluar::find();

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
            'puntaje_ideal'=> $this->puntaje_ideal,
            'puntaje_obtenido'=> $this->puntaje_obtenido,
            'nota' => $this->nota,
            'id_entrega' => $this->id_entrega,
            'id_usuario' => $this->id_usuario,
        ]);

        $query->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
