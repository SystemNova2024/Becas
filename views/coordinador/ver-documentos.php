<?php
use yii\helpers\Html;

/** @var app\models\DocumentoSolicitud[] $documentos */
?>

<div class="documentos-container my-4">
    <h4 class="mb-3 fw-bold border-bottom pb-2" style="color: #4a6fa5;">
        <i class="bi bi-folder2 me-2"></i> Documentos Adjuntos
    </h4>

    <?php if (!empty($documentos)): ?>
        <ul class="list-unstyled mb-0">
            <?php foreach ($documentos as $doc): ?>
                <li class="d-flex justify-content-between align-items-center p-3 mb-2 rounded document-item">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-text me-3" style="font-size: 1.5rem; color: #4a6fa5;"></i>
                        <?= Html::a(
                            Html::encode($doc->nombre_archivo),
                            $doc->ruta_archivo,
                            [
                                'target' => '_blank',
                                'class' => 'fw-semibold text-decoration-none document-link'
                            ]
                        ) ?>
                    </div>
                    <span class="small text-muted">Abrir</span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="text-muted fst-italic">
            <i class="bi bi-info-circle me-1"></i> No hay documentos adjuntos.
        </div>
    <?php endif; ?>
</div>

<style>
.document-item {
    background-color: #f8faff;
    border: 1px solid #d6e4f0;
    transition: background-color 0.2s ease-in-out, transform 0.15s ease-in-out, box-shadow 0.2s ease-in-out;
}
.document-item:hover {
    background-color: #eaf2fb;
    transform: translateX(4px);
    box-shadow: 0 2px 6px rgba(74, 111, 165, 0.15);
}
.document-link {
    color: #2d4e75;
}
.document-link:hover {
    color: #1a3553;
}
</style>
