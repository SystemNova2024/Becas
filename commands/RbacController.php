<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $roles = [
            1 => 'Coordinador de becas',
            3 => 'Estudiante',
        ];

        foreach ($roles as $userId => $roleName) {
            // Verifica si el rol ya existe
            $role = $auth->getRole($roleName);
            if (!$role) {
                $role = $auth->createRole($roleName);
                $auth->add($role);
                echo "Rol creado: $roleName\n";
            } else {
                echo "Rol ya existe: $roleName\n";
            }

            // Asignar el rol al usuario
            if (!$auth->getAssignment($roleName, $userId)) {
                $auth->assign($role, $userId);
                echo "Asignado '$roleName' al usuario con ID $userId\n";
            } else {
                echo "El usuario $userId ya tiene el rol '$roleName'\n";
            }
        }

        echo "✔ RBAC inicializado correctamente.\n";
    }

}
