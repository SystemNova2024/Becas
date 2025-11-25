<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Modelo para la tabla solicitudes_becas
 */
class SolicitudBeca extends ActiveRecord
{
    public static function tableName()
    {
        return 'solicitudes_becas';
    }

    public function rules()
    {
        return [
            [['id', 'estudiante_id', 'beca_id', 'documentos_completos'], 'integer'],
            [['fecha_solicitud', 'fecha_aprobacion', 'vigencia_inicio', 'vigencia_fin'], 'safe'],
            [['estatus'], 'string', 'max' => 50],
            [['observaciones', 'justificacion', 'documento'], 'string'],
            [['nombre_documento', 'tipo_documento'], 'string', 'max' => 255],
            [['evaluacion_automatica'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estudiante_id' => 'Estudiante',
            'beca_id' => 'Beca',
            'fecha_solicitud' => 'Fecha de Solicitud',
            'estatus' => 'Estatus',
            'documentos_completos' => 'Documentos Completos',
            'evaluacion_automatica' => 'Evaluación Automática',
            'observaciones' => 'Observaciones',
            'fecha_aprobacion' => 'Fecha de Aprobación',
            'vigencia_inicio' => 'Vigencia Inicio',
            'vigencia_fin' => 'Vigencia Fin',
            'justificacion' => 'Justificación',
            'documento' => 'Documento',
            'nombre_documento' => 'Nombre del Documento',
            'tipo_documento' => 'Tipo de Documento',
        ];
    }

    // Relación con Usuario
    public function getEstudiante()
    {
        return $this->hasOne(User::class, ['id' => 'estudiante_id']);
    }

    // Relación con Beca (si existe)
    public function getBeca()
    {
        return $this->hasOne(Beca::class, ['id' => 'beca_id']);
    }
}
