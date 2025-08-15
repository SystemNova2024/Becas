<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $archivo;
    public $estudiante_id;
    public $tipo_calificacion;
    public $observaciones;
    public $fecha_evaluacion;

    public function rules()
    {
        return [
            [['estudiante_id', 'tipo_calificacion'], 'required'],
            [['estudiante_id'], 'integer'],
            [['tipo_calificacion'], 'string', 'max' => 100],
            [['observaciones'], 'string', 'max' => 500],
            [['fecha_evaluacion'], 'safe'],
            [['archivo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf,doc,docx,xls,xlsx,jpg,jpeg,png'],
            [['archivo'], 'file', 'maxSize' => 1024 * 1024 * 5], // 5MB máximo
        ];
    }

    public function attributeLabels()
    {
        return [
            'archivo' => 'Archivo de Calificación',
            'estudiante_id' => 'Estudiante',
            'tipo_calificacion' => 'Tipo de Calificación',
            'observaciones' => 'Observaciones',
            'fecha_evaluacion' => 'Fecha de Evaluación',
        ];
    }

    public function getTiposCalificacion()
    {
        return [
            'examen_parcial' => 'Examen Parcial',
            'examen_final' => 'Examen Final',
            'proyecto' => 'Proyecto',
            'tarea' => 'Tarea',
            'participacion' => 'Participación',
            'otro' => 'Otro',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $nombreArchivo = 'calificacion_' . $this->estudiante_id . '_' . time() . '.' . $this->archivo->extension;
            $rutaDestino = 'uploads/calificaciones/' . $nombreArchivo;
            
            // Crear directorio si no existe
            $directorio = dirname($rutaDestino);
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            
            if ($this->archivo->saveAs($rutaDestino)) {
                // Aquí podrías guardar en la base de datos
                return $rutaDestino;
            }
        }
        return false;
    }
}
