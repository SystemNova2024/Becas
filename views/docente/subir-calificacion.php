<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="upload-container">
    <div class="upload-header text-center mb-4">
        <div class="uth-logo mb-4">
            <img src="<?= Yii::getAlias('@web') ?>/uploads/imagenes/logo.png" alt="UTH Logo" class="img-fluid" style="max-height: 130px;">
        </div>
        <h1 class="display-5 fw-bold text-dark mb-2">
            Subir Calificaciones
        </h1>
        <p class="lead text-muted">Universidad Tecnológica de Huejotzingo</p>
        <div class="header-divider"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="upload-card">
                <div class="card-header bg-light text-dark border-bottom">
                    <h5 class="mb-0">
                        Formulario de Calificación
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data', 'class' => 'needs-validation'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{hint}\n{error}",
                            'labelOptions' => ['class' => 'form-label fw-bold'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'estudiante_id')->dropDownList(
                                ArrayHelper::map($estudiantes, 'id', 'nombre_completo'),
                                [
                                    'prompt' => 'Selecciona un estudiante',
                                    'class' => 'form-select form-select-lg',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'tipo_calificacion')->dropDownList(
                                $model->getTiposCalificacion(),
                                [
                                    'prompt' => 'Tipo de calificación',
                                    'class' => 'form-select form-select-lg',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'fecha_evaluacion')->input('date', [
                                'class' => 'form-control form-control-lg',
                                'value' => date('Y-m-d')
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'archivo')->fileInput([
                                'class' => 'form-control form-control-lg',
                                'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png'
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?= $form->field($model, 'observaciones')->textarea([
                                'rows' => 4,
                                'placeholder' => 'Observaciones adicionales sobre la calificación...',
                                'class' => 'form-control form-control-lg'
                            ]) ?>
                        </div>
                    </div>

                    <div class="upload-actions text-center mt-4">
                        <button type="submit" class="btn btn-dark btn-lg me-3">
                            <i class="bi bi-upload me-2"></i>Subir Calificación
                        </button>
                        <button type="reset" class="btn btn-outline-dark btn-lg">
                            <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
                        </button>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <!-- Información de ayuda -->
            <div class="help-section mt-4">
                                    <div class="card border-dark">
                        <div class="card-header bg-light text-dark border-bottom">
                        <h6 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>Información Importante
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Formatos aceptados: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Tamaño máximo: 5 MB</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Selecciona siempre al estudiante correcto</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>La calificación se enviará automáticamente al estudiante</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.upload-container {
    background: #ffffff;
    border-radius: 15px;
    padding: 3rem;
    border: 2px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.upload-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 2rem;
    margin-bottom: 3rem;
}

.uth-logo {
    text-align: center;
}

.header-divider {
    width: 120px;
    height: 3px;
    background: #495057;
    margin: 1.5rem auto 0;
}

.upload-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    overflow: hidden;
}



.form-control-lg, .form-select-lg {
    padding: 1rem 1.25rem;
    font-size: 1.1rem;
    border-radius: 12px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    background: #fff;
}

.form-control-lg:focus, .form-select-lg:focus {
    border-color: #495057;
    box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
    transform: translateY(-2px);
}

.form-label {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.upload-actions .btn {
    padding: 1rem 2.5rem;
    font-size: 1.2rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 600;
}

.upload-actions .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.help-section .card {
    border-radius: 15px;
    border: 2px solid #0d6efd;
}

.help-section ul li {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8f9fa;
    font-size: 1rem;
}

.help-section ul li:last-child {
    border-bottom: none;
}

.help-section ul li i {
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .upload-container {
        padding: 2rem 1rem;
    }
    
    .upload-actions .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>