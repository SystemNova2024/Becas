<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Notificacion extends ActiveRecord
{
    public static function tableName()
    {
        return 'notificaciones';
    }

    public function rules()
    {
        return [
            [['usuario_id', 'mensaje'], 'required'],
            [['solicitud_id', 'usuario_id', 'leida'], 'integer'],
            [['mensaje', 'tipo'], 'string'],
            [['fecha_creacion'], 'safe'],
            ['solicitud_id', 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solicitud_id' => 'Solicitud',
            'usuario_id' => 'Estudiante',
            'mensaje' => 'Mensaje',
            'tipo' => 'Tipo',
            'fecha_creacion' => 'Fecha de Creación',
            'leida' => 'Leída',
        ];
    }

    public function getSolicitud()
    {
        return $this->hasOne(SolicitudBeca::class, ['id' => 'solicitud_id']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::class, ['id' => 'usuario_id']);
    }
}

