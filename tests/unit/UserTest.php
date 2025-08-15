<?php
use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testValidationOnCreate()
    {
        $user = new User();
        $user->setScenario('create');

        // Sin datos, no debe validar
        $this->assertFalse($user->validate(), 'Debe fallar validación sin datos');

        // Ponemos datos mínimos correctos
        $user->nombre_completo = 'Usuario Prueba';
        $user->correo = 'usuario@prueba.com';
        $user->password = '123456';

        $this->assertTrue($user->validate(), 'Debe validar con datos correctos');

        // Correo inválido
        $user->correo = 'correo-invalido';
        $this->assertFalse($user->validate(['correo']), 'Correo inválido debe fallar');

        // Correo único: depende de la base de datos
        // Aquí solo probamos la regla de formato, para la regla unique se requiere base de datos o mock
    }

    public function testBeforeSaveHashesPassword()
    {
        $user = new User();
        $user->setScenario('create');
        $user->nombre_completo = 'Test User';
        $user->correo = 'testuser@example.com';
        $user->password = 'secreto';

        $this->assertNull($user->contrasena_hash);

        $user->beforeSave(true);

        $this->assertNotNull($user->contrasena_hash, 'La contraseña debe estar hasheada después de beforeSave');
        $this->assertNotEquals('secreto', $user->contrasena_hash, 'El hash no debe ser igual a la contraseña en texto plano');
    }

    public function testValidatePassword()
    {
        $user = new User();
        $password = 'miClave123';
        $user->contrasena_hash = Yii::$app->security->generatePasswordHash($password);

        $this->assertTrue($user->validatePassword($password), 'Debe validar contraseña correcta');
        $this->assertFalse($user->validatePassword('otraClave'), 'Debe fallar contraseña incorrecta');
    }
}
