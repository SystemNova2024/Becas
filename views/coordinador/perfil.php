<?php
use yii\helpers\Html;
?>
<h2>👤 Mi Perfil Coordinador</h2>
<p><strong>Nombre:</strong> <?= Html::encode($usuario->nombre_completo) ?></p>
<p><strong>Email:</strong> <?= Html::encode($usuario->correo) ?></p>
<p><strong>Rol:</strong> Coordinador de Becas ✅</p>
