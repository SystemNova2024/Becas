<?php

/** @var yii\web\View $this */

$this->title = 'Sistema de Becas';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-1 becas-title" style="color: #4A0000; font-weight: 900; text-shadow: 3px 3px 6px rgba(0,0,0,0.4), 0 0 20px rgba(74,0,0,0.3); font-size: 5rem; letter-spacing: 8px; background: linear-gradient(45deg, #4A0000, #8B0000); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">BECAS</h1>

        <p class="lead" style="font-size: 1.8rem; color: #000000; margin-top: 2rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); font-weight: 600;">Sistema de Consulta y Gestión de Becas</p>

        <div class="mt-5">
            <a class="btn btn-lg consultar-btn" href="<?= \yii\helpers\Url::to(['site/becas']) ?>" style="background: linear-gradient(45deg, #4A0000, #8B0000); color: #FFF8DC; padding: 18px 50px; font-size: 1.3rem; border-radius: 50px; box-shadow: 0 6px 15px rgba(74,0,0,0.4); transition: all 0.3s ease; border: 2px solid #FFF8DC;">
                <i class="fas fa-search" style="margin-right: 12px;"></i>
                Consultar Becas
            </a>
        </div>
    </div>

    <div class="body-content">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="card info-card" style="border: none; box-shadow: 0 8px 25px rgba(0,0,0,0.15); border-radius: 20px; background: linear-gradient(135deg, #FFF8DC, #F5F5DC);">
                    <div class="card-body" style="padding: 4rem;">
                        <h2 style="color: #4A0000; margin-bottom: 2rem; font-weight: bold; text-shadow: 1px 1px 3px rgba(0,0,0,0.2);">✨ Descubre Oportunidades Únicas en la Universidad Tecnológica de Huejotzingo ✨</h2>
                        <p class="lead" style="color: #4A0000; line-height: 2; font-size: 1.3rem; font-weight: 500;">
                            <strong>Explora</strong> nuestro catálogo completo de becas disponibles para estudiantes UTH<br>
                            <strong>Encuentra</strong> la oportunidad perfecta para tu desarrollo académico dentro de la UTH<br>
                            <strong>Impulsa</strong> tu futuro con las mejores opciones educativas que ofrece la Universidad Tecnológica de Huejotzingo
                        </p>
                        <div class="mt-4">
                            <span style="color: #8B0000; font-size: 1.1rem; font-weight: 600;">¡Tu éxito académico comienza aquí!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
