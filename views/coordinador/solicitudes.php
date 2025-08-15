<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\SolicitudBecaSearch $searchModel */

$this->title = 'Solicitudes de Beca';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <h2 class="text-primary mb-4">
                <i class="bi bi-folder-check-fill me-2"></i> <?= Html::encode($this->title) ?>
            </h2>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover align-middle'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'estudiante_id',
                        'label' => 'Estudiante',
                        'value' => function ($model) {
                            return $model->estudiante->nombre_completo ?? '(Sin nombre)';
                        }
                    ],
                    [
                        'attribute' => 'becaNombre',
                        'label' => 'Beca',
                        'value' => function ($model) {
                            return $model->beca->nombre ?? '(Sin beca)';
                        },
                        'filter' => Html::activeTextInput($searchModel, 'becaNombre', ['class' => 'form-control', 'placeholder' => 'Buscar por beca']),
                    ],
                    [
                        'attribute' => 'fecha_solicitud',
                        'format' => ['date', 'php:d/m/Y'],
                    ],
                    [
                        'attribute' => 'estatus',
                        'contentOptions' => function ($model) {
                            return ['class' => match ($model->estatus) {
                                'Aprobada' => 'text-success fw-bold',
                                'Rechazada' => 'text-danger fw-bold',
                                default => 'text-warning fw-bold',
                            }];
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{aprobar} {rechazar}',
                        'header' => 'Acciones',
                        'controller' => 'Coordinador',
                        'buttons' => [
                            'aprobar' => function ($url, $model) {
                                if ($model->estatus === 'pendiente') {
                                    return Html::a('<i class="bi bi-check-circle-fill"></i>', ['aprobar', 'id' => $model->id], [
                                        'title' => 'Aprobar',
                                        'class' => 'text-success me-2',
                                        'data-confirm' => '¿Seguro que deseas aprobar esta solicitud?'
                                    ]);
                                }
                                return '';
                            },
                            'rechazar' => function ($url, $model) {
                                if ($model->estatus === 'pendiente') {
                                    return Html::a('<i class="bi bi-x-circle-fill"></i>', ['rechazar', 'id' => $model->id], [
                                        'title' => 'Rechazar',
                                        'class' => 'text-danger',
                                        'data-confirm' => '¿Seguro que deseas rechazar esta solicitud?'
                                    ]);
                                }
                                return '';
                            },
                        ],
                    ],
                    [
                        'label' => 'Documentos',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                '<i class="bi bi-file-earmark-text"></i> Ver',
                                ['coordinador/ver-documentos', 'id' => $model->id],
                                [
                                    'class' => 'btn btn-outline-secondary btn-sm rounded-pill shadow-sm',
                                    'title' => 'Ver documentos de la solicitud',
                                ]
                            );
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
