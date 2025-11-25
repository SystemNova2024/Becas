<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla becas
 * NOTA: Este modelo puede no tener una tabla real en la base de datos,
 * ya que las becas parecen estar hardcodeadas en las vistas
 */
class Beca extends ActiveRecord
{
    public static function tableName()
    {
        return 'becas';
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'fecha_inicio' => 'Fecha de Inicio',
            'fecha_fin' => 'Fecha de Fin',
            'archivo_convocatoria' => 'Archivo de Convocatoria',
        ];
    }
}

