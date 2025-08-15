<?php
use app\models\LoginForm;
use app\models\User;

class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testValidation()
    {
        $model = new LoginForm();

        // Sin datos, debe fallar
        $this->assertFalse($model->validate());

        // Campos requeridos
        $this->assertArrayHasKey('correo', $model->getErrors());
        $this->assertArrayHasKey('password', $model->getErrors());

        // Datos con correo mal formado
        $model->correo = 'correo-mal-formado';
        $model->password = '123456';
        $this->assertFalse($model->validate());
    }

    public function testValidatePasswordWithRealUser()
    {
        // Usa un correo que esté en tu BD de testing
        $correoValido = '3522110951@uth.edu.mx'; // Cambia aquí
        $passwordValido = 'Equip@integrador9'; // Cambia aquí por la contraseña real

        $model = new LoginForm();
        $model->correo = $correoValido;
        $model->password = $passwordValido;

        // Debe validar correctamente porque usas datos reales
        $this->assertTrue($model->validate(), "Debe validar con usuario y contraseña correctos");

        // Password incorrecto
        $model->password = 'claveIncorrecta';
        $this->assertFalse($model->validate(), "No debe validar con contraseña incorrecta");
        $this->assertArrayHasKey('password', $model->getErrors());
    }

    public function testLogin()
    {
        $correoValido = '3522110951@uth.edu.mx'; // Cambia aquí
        $passwordValido = 'Equip@integrador9'; // Cambia aquí

        $model = new LoginForm();
        $model->correo = $correoValido;
        $model->password = $passwordValido;

        $this->assertTrue($model->login(), "Debe iniciar sesión con datos válidos");

        // Intento con datos inválidos
        $model->correo = 'correo@invalido.com';
        $model->password = 'otraClave';
        $this->assertFalse($model->login(), "No debe iniciar sesión con datos inválidos");
    }
}
