<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }
 public $password; 
public function rules()
{
    return [
        [['nombre_completo', 'correo', 'password'], 'required', 'on' => 'create'],
        [['correo'], 'email'],
        [['correo'], 'unique'],
        [['rol_id', 'activo'], 'integer'],
        [['creado_en', 'actualizado_en', 'contrasena_hash'], 'safe'],
        [['nombre_completo', 'correo','password'], 'string', 'max' => 255],
    ];
}

        public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_completo' => 'Nombre Completo',
            'correo' => 'Correo',
            'rol_id' => 'Rol ID',
            'activo' => 'Activo',
        ];
    }

    public function getAuthAssignments()
    {
        return $this->hasMany(\yii\rbac\Assignment::class, ['user_id' => 'id']);
    }

    public function assignRole($rolName)
    {
        if (!Yii::$app->authManager->getAssignment($rolName, $this->id)) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($rolName);
            if ($role) {
                $auth->assign($role, $this->id);
            }
        }
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'activo' => true]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Si tienes un campo de accessToken, implementa aquí
        return null;
    }
public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {

        // Guardar la fecha de actualización
        $this->actualizado_en = date('Y-m-d H:i:s');

        // Si es nuevo registro, guarda la fecha de creación
        if ($this->isNewRecord) {
            $this->creado_en = date('Y-m-d H:i:s');
        }

        // Encriptar la contraseña solo si se escribió una nueva
        if (!empty($this->password)) {
            $this->contrasena_hash = Yii::$app->security->generatePasswordHash($this->password);
        }

        return true;
    }

    return false;
}
    /**
     * Encuentra usuario por correo
     * @param string $correo
     * @return static|null
     */
    public static function findByUsername($correo)
    {
        return static::findOne(['correo' => $correo, 'activo' => true]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null; // Si no usas authKey, puedes dejarlo null
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return true; // Si no usas authKey
    }

    /**
     * Valida la contraseña usando password_hash
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        // Contraseña Segura 
        return Yii::$app->security->validatePassword($password, $this->contrasena_hash);
    }
}
