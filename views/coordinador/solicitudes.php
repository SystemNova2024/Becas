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
                        'attribute' => 'beca_id',
                        'label' => 'Beca',
                        'value' => function ($model) {
                            $becas = [
                                1 => 'Beca Alimenticia',
                                2 => 'Beca de Excelencia',
                                3 => 'Beca Académica',
                                4 => 'Beca Socioeconómica',
                            ];
                            return $becas[$model->beca_id] ?? "Beca ID: {$model->beca_id}";
                        },
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
                        'label' => 'Progreso',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $color = match($model->estatus) {
                                'aprobada' => 'success',
                                'rechazada' => 'danger',
                                'en_revision' => 'warning',
                                default => 'info',
                            };
                            $estatus = ucfirst(str_replace('_', ' ', $model->estatus));
                            return "<span class='badge bg-{$color}'>{$estatus}</span>";
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{ver} {aprobar} {rechazar} {notificar}',
                        'header' => 'Acciones',
                        'buttons' => [
                            'ver' => function ($url, $model) {
                                return Html::a(
                                    '<i class="bi bi-eye"></i> Ver',
                                    ['coordinador/ver-solicitud', 'id' => $model->id],
                                    ['class' => 'btn btn-sm btn-outline-primary me-1']
                                );
                            },
                            'aprobar' => function ($url, $model) {
                                if ($model->estatus === 'pendiente') {
                                    return Html::a(
                                        '<i class="bi bi-check-circle"></i> Aprobar',
                                        ['aprobar', 'id' => $model->id],
                                        [
                                            'class' => 'btn btn-sm btn-success me-1',
                                            'data-confirm' => '¿Aprobar esta solicitud?'
                                        ]
                                    );
                                }
                                return '';
                            },
                            'rechazar' => function ($url, $model) {
                                if ($model->estatus === 'pendiente' || $model->estatus === 'en_revision') {
                                    return Html::a(
                                        '<i class="bi bi-x-circle"></i> Rechazar',
                                        ['rechazar', 'id' => $model->id],
                                        [
                                            'class' => 'btn btn-sm btn-danger me-1',
                                            'data-confirm' => '¿Rechazar esta solicitud?'
                                        ]
                                    );
                                }
                                return '';
                            },
                            'notificar' => function ($url, $model) {
                                return Html::a(
                                    '<i class="bi bi-bell"></i> Notificar',
                                    ['coordinador/enviar-notificacion', 'id' => $model->id],
                                    ['class' => 'btn btn-sm btn-outline-warning']
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
