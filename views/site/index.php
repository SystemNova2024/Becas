<?php
/**
 * Vista principal – Sistema de Becas UTH
 * @var yii\web\View $this
 */

$this->title = 'Sistema de Becas - UTH';
?>

<!-- Hero / CTA -->
<section class="row justify-content-center mt-5">
    <div class="col-lg-8">
        <div class="hero-card text-center">
            <h3 class="hero-title">¿Listo para comenzar?</h3>
            <p class="hero-subtitle">
                Descubre todas las oportunidades de beca disponibles para tu carrera profesional
            </p>
            <a href="<?= \yii\helpers\Url::to(['site/becas']) ?>"
               class="btn btn-primary btn-lg text-uppercase fw-semibold">
                Explorar becas
            </a>
        </div>
    </div>
</section>

<!-- Estadísticas -->
<section class="row justify-content-center my-5">
    <div class="col-lg-8">
        <div class="row text-center g-3">
            <?php foreach ([
                ['15+', 'Becas activas'],
                ['500+', 'Estudiantes'],
                ['95%', 'Satisfacción'],
                ['24/7', 'Disponible']
            ] as [$num, $label]): ?>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number"><?= $num ?></div>
                        <div class="stat-label"><?= $label ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Características -->
<section class="mb-5">
    <h2 class="section-title">
        <i class="fas fa-rocket me-2 accent"></i>Características principales
    </h2>

    <div class="row g-4">
        <?php
        $features = [
            ['bolt', 'Acceso rápido', 'Consulta inmediata de todas las becas disponibles con filtros avanzados'],
            ['shield-alt', 'Seguro y confiable', 'Sistema protegido con las mejores prácticas de seguridad informática'],
            ['sync-alt', 'Actualización en tiempo real', 'Información siempre actualizada de convocatorias y resultados']
        ];
        foreach ($features as [$icon, $title, $text]): ?>
            <div class="col-lg-4">
                <div class="feature-card h-100">
                    <div class="feature-icon">
                        <i class="fas fa-<?= $icon ?> fa-2x text-white"></i>
                    </div>
                    <h5 class="feature-title"><?= $title ?></h5>
                    <p class="feature-text"><?= $text ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Tipos de beca -->
<section class="mb-5">
    <h2 class="section-title">
        <i class="fas fa-award me-2 accent"></i>Tipos de becas disponibles
    </h2>

    <div class="row g-4">
        <?php
        $types = [
            ['brain', 'Excelencia académica', 'Para estudiantes con promedio destacado'],
            ['hands-helping', 'Apoyo social', 'Becas para estudiantes en situación vulnerable'],
            ['briefcase', 'Becas laborales', 'Trabajo y estudio dentro de la institución'],
            ['globe-americas', 'Internacionales', 'Programas de intercambio académico']
        ];
        foreach ($types as [$icon, $title, $text]): ?>
            <div class="col-lg-3 col-md-6">
                <div class="type-card h-100">
                    <div class="type-icon">
                        <i class="fas fa-<?= $icon ?> fa-2x text-white"></i>
                    </div>
                    <h5 class="type-title"><?= $title ?></h5>
                    <p class="type-text"><?= $text ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Estilos extra (pueden ir en un archivo .css) -->
<style>
:root {
    --color-primary: #0056b3;
    --color-accent: #00c9a7;
    --color-light: #f8f9fa;
    --text-primary: #343a40;
    --shadow: 0 8px 24px rgba(0, 0, 0, .08);
}

.hero-card {
    background: linear-gradient(135deg, var(--color-light), #fff);
    padding: 4rem 3rem;
    border-radius: 20px;
    border: 2px solid var(--color-accent);
    box-shadow: var(--shadow);
}

.hero-title {
    color: var(--color-primary);
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
}

.hero-subtitle {
    color: var(--text-primary);
    font-size: 1.2rem;
    margin-bottom: 2.5rem;
}

.stat-card {
    background: var(--color-light);
    border-radius: 15px;
    padding: 2rem 1rem;
}

.stat-number {
    color: var(--color-primary);
    font-weight: 700;
    font-size: 2.5rem;
}

.stat-label {
    color: var(--text-primary);
    font-weight: 600;
}

.section-title {
    text-align: center;
    color: var(--color-primary);
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 3rem;
}

.accent { color: var(--color-accent); }

.feature-card,
.type-card {
    text-align: center;
    border-radius: 15px;
    padding: 2.5rem 1.5rem;
    background: #fff;
    box-shadow: var(--shadow);
}

.feature-icon,
.type-icon {
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.type-icon { width: 70px; height: 70px; border-radius: 15px; }

.feature-title,
.type-title {
    color: var(--color-primary);
    font-weight: 700;
    margin-bottom: 1rem;
}

.feature-text,
.type-text {
    color: var(--text-primary);
    line-height: 1.6;
    margin: 0;
}
</style>