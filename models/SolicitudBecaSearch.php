<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SolicitudBecaSearch extends SolicitudBeca
{
    public $becaNombre;  // atributo virtual para búsqueda

    public function rules()
    {
        return [
            [['id', 'estudiante_id', 'documentos_completos', 'beca_id'], 'integer'],
            [['fecha_solicitud', 'estatus', 'observaciones', 'justificacion', 'becaNombre'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SolicitudBeca::find()->joinWith('beca');  // para hacer join con la tabla beca

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'defaultOrder' => ['fecha_solicitud' => SORT_DESC],
                'attributes' => [
                    'fecha_solicitud',
                    'estatus',
                    'estudiante_id',
                    'becaNombre' => [
                        'asc' => ['beca.nombre' => SORT_ASC],
                        'desc' => ['beca.nombre' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // si no valida, no mostrar resultados
            $query->where('0=1');
            return $dataProvider;
        }

        // filtros básicos
        $query->andFilterWhere([
            'id' => $this->id,
            'estudiante_id' => $this->estudiante_id,
            'fecha_solicitud' => $this->fecha_solicitud,
            'documentos_completos' => $this->documentos_completos,
            'beca_id' => $this->beca_id,
        ]);

        $query->andFilterWhere(['like', 'estatus', $this->estatus])
              ->andFilterWhere(['like', 'observaciones', $this->observaciones])
              ->andFilterWhere(['like', 'justificacion', $this->justificacion]);

        // filtro para nombre de beca (relación)
        $query->andFilterWhere(['like', 'beca.nombre', $this->becaNombre]);

        return $dataProvider;
    }
}
