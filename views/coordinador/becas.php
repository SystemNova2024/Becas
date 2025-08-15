<?php
use yii\helpers\Html;

/** @var app\models\Beca[] $becas */

$this->title = 'Listado de Becas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary"><i class="bi bi-award-fill me-2"></i>Becas Registradas</h3>
        <?= Html::a('<i class="bi bi-plus-lg me-1"></i> Nueva Beca', ['crear-beca'], ['class' => 'btn btn-success btn-lg rounded-pill shadow-sm']) ?>
    </div>

    <?php if (empty($becas)): ?>
        <div class="alert alert-warning rounded-3 shadow-sm">
            No hay becas registradas actualmente.
        </div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark rounded-top">
                    <tr>
                        <th>Nombre</th>
                        <th style="min-width: 160px;">Fechas</th>
                        <th>Convocatoria</th>
                        <th style="width: 160px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($becas as $beca): ?>
                        <tr>
                            <td><?= Html::encode($beca->nombre) ?></td>
                            <td>
                                <?= Yii::$app->formatter->asDate($beca->fecha_inicio, 'php:d/m/Y') ?>
                                &rarr;
                                <?= Yii::$app->formatter->asDate($beca->fecha_fin, 'php:d/m/Y') ?>
                            </td>
                            <td>
                                <?php if ($beca->archivo_convocatoria): ?>
                                    <?= Html::a('<i class="bi bi-file-earmark-pdf-fill me-1"></i> Ver archivo', 
                                        Yii::getAlias('@web') . '/' . $beca->archivo_convocatoria, 
                                        ['target' => '_blank', 'class' => 'btn btn-outline-primary btn-sm rounded-pill shadow-sm']) ?>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Sin archivo</span>
                                <?php endif; ?>
                            </td>
                       <td>
                            <div class="d-flex">
                                <?= Html::a('<i class="bi bi-pencil-square"></i> Editar', ['actualizar-beca', 'id' => $beca->id], [
                                    'class' => 'btn btn-warning btn-sm rounded-pill me-2 shadow-sm'
                                ]) ?>
                                <?= Html::a('<i class="bi bi-trash"></i> Eliminar', ['eliminar-beca', 'id' => $beca->id], [
                                    'class' => 'btn btn-danger btn-sm rounded-pill shadow-sm',
                                    'data' => [
                                        'confirm' => '¿Estás seguro de eliminar esta beca?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
