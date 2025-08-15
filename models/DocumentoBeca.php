<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class DocumentoBeca extends ActiveRecord
{
    public static function tableName()
    {
        return 'documentos_solicitud';
    }

    public function rules()
    {
        return [
            [['solicitud_id', 'tipo_documento', 'nombre_archivo', 'ruta_archivo'], 'required'],
            [['solicitud_id', 'validado'], 'integer'],
            [['fecha_validacion'], 'safe'],
            [['tipo_documento'], 'string', 'max' => 50],
            [['nombre_archivo'], 'string', 'max' => 255],
            [['ruta_archivo'], 'string', 'max' => 500],
            [['hash_documento'], 'string', 'max' => 64],
        ];
    }

    public function getSolicitud()
    {
        return $this->hasOne(SolicitudBeca::class, ['id' => 'solicitud_id']);
    }
}
