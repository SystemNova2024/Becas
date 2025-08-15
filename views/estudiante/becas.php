<?php
use yii\helpers\Html;
?>

<div class="container py-5">
    <h2 class="mb-5 fw-bold text-primary">🎓 Becas Disponibles</h2>

    <?php if (!empty($becas)): ?>
        <div class="row g-4">
            <?php foreach ($becas as $beca): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 hover-card">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title fw-bold"><?= Html::encode($beca->nombre) ?></h4>
                            <p class="card-text text-muted flex-fill"><?= nl2br(Html::encode($beca->descripcion)) ?></p>
                            <p class="mb-3"><strong>Vigencia:</strong> <?= Html::encode($beca->fecha_inicio) ?> → <?= Html::encode($beca->fecha_fin) ?></p>

                            <?php if ($beca->archivo_convocatoria): ?>
                                <p>
                                    <?= Html::a('📎 Ver convocatoria', Yii::getAlias('@web') . '/' . $beca->archivo_convocatoria, [
                                        'target' => '_blank',
                                        'class' => 'text-decoration-none fw-semibold text-primary'
                                    ]) ?>
                                </p>
                            <?php endif; ?>

                            <?= Html::a('Solicitar esta beca', ['estudiante/solicitar', 'id' => $beca->id], [
                                'class' => 'btn btn-success rounded-pill mt-auto shadow-sm px-4 py-2'
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-light shadow-sm rounded-4 text-center py-4">
            <div style="font-size: 2.5rem;">😔</div>
            <p class="mb-0 fs-5">No hay becas activas disponibles en este momento.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .card-text {
        font-size: 0.95rem;
        line-height: 1.4;
    }
</style>
