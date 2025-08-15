<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Beca extends ActiveRecord
{
    public static function tableName()
    {
        return 'becas';
    }

    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'requisitos', 'procedimiento', 'fecha_inicio', 'fecha_fin'], 'required'],
            [['descripcion', 'requisitos', 'procedimiento'], 'string'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['archivo_convocatoria'], 'string', 'max' => 255],
            [['requiere_justificacion', 'requiere_documentos'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'requisitos' => 'Requisitos',
            'procedimiento' => 'Procedimiento',
            'fecha_inicio' => 'Fecha de Inicio',
            'fecha_fin' => 'Fecha de Fin',
            'archivo_convocatoria' => 'Archivo de Convocatoria',
            'requiere_justificacion' => 'Requiere Justificación',
            'requiere_documentos' => 'Requiere Documentos',
        ];
    }

    // 🔹 Getter para poder usar $beca->titulo aunque en la BD se llame "nombre"
    public function getTitulo()
    {
        return $this->nombre;
    }

}
