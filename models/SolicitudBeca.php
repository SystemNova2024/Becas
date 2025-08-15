<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo SolicitudBeca
 *
 * Representa una solicitud de beca hecha por un estudiante.
 */
class SolicitudBeca extends ActiveRecord
{
    public static function tableName()
    {
        return 'solicitudes_becas';
    }
    public $archivo;

    public function rules()
    {
        return [
            [['estudiante_id', 'fecha_solicitud', 'estatus', 'beca_id'], 'required'],
            [['estudiante_id', 'documentos_completos', 'beca_id'], 'integer'],
            [['fecha_solicitud', 'fecha_aprobacion', 'vigencia_inicio', 'vigencia_fin'], 'safe'],
            [['estatus'], 'string', 'max' => 50],
            [['observaciones', 'justificacion'], 'string'],
            [['evaluacion_automatica'], 'number'],
          [['archivo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, jpg, jpeg, png', 'maxSize' => 5 * 1024 * 1024, 'maxFiles' => 10]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estudiante_id' => 'Estudiante',
            'tipo_beca_id' => 'Tipo de Beca',
            'beca_id' => 'Beca',
            'fecha_solicitud' => 'Fecha de Solicitud',
            'estatus' => 'Estatus',
            'documentos_completos' => 'Documentos Completos',
            'evaluacion_automatica' => 'Evaluación Automática',
            'observaciones' => 'Comentarios del Coordinador', 
            'justificacion' => 'Justificación del Alumno',
            'fecha_aprobacion' => 'Fecha de Aprobación',
            'vigencia_inicio' => 'Vigencia Inicio',
            'vigencia_fin' => 'Vigencia Fin',
        ];
    }

    public function getEstudiante()
    {
        return $this->hasOne(User::class, ['id' => 'estudiante_id']);
    }

    public function getBeca()
    {
        return $this->hasOne(Beca::class, ['id' => 'beca_id']);
    }


    public function getDocumentos()
    {
        return $this->hasMany(DocumentoBeca::class, ['solicitud_id' => 'id']);
    }
}

