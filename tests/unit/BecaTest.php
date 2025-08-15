<?php
use app\models\Beca;

class BecaTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testValidation()
    {
           $beca = new Beca();

    $this->tester->comment('Escenario actual: ' . $beca->getScenario());

    $beca->setScenario('default'); // fuerza escenario por si acaso

    $valid = $beca->validate();

    if ($valid) {
        $this->tester->comment('Validó correctamente con atributos: ' . print_r($beca->getAttributes(), true));
    } else {
        $this->tester->comment('No validó, errores: ' . print_r($beca->getErrors(), true));
    }

    $this->assertFalse($valid, 'El modelo no debe validar sin datos');

        // Asignamos datos mínimos para validar
        $beca->nombre = 'Beca de Prueba';
        $beca->descripcion = 'Descripción de prueba';
        $beca->requisitos = 'Requisitos de prueba';
        $beca->procedimiento = 'Procedimiento de prueba';
        $beca->fecha_inicio = '2025-01-01';
        $beca->fecha_fin = '2025-12-31';
        $beca->archivo_convocatoria = 'archivo.pdf';
        $beca->requiere_justificacion = true;
        $beca->requiere_documentos = false;

        $this->assertTrue($beca->validate(), 'El modelo debe validar con datos correctos');

        // Prueba valores no válidos para booleanos
        $beca->requiere_justificacion = 'no es booleano';
        $this->assertFalse($beca->validate(['requiere_justificacion']));

        $beca->requiere_justificacion = true; // lo corregimos
        $beca->fecha_inicio = 'fecha inválida';
        $this->assertFalse($beca->validate(['fecha_inicio']));
    }
}
