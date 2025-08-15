 <?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = ' Becas Disponibles - UTH';
?>

<style>
  /* ===== Estilos locales específicos de la vista ===== */
  .becas-catalogo .card {
    border-radius: 14px;
    background: #ffffff;
    border: 1px solid #e9ecef;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .becas-catalogo .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,.06);
  }
  .becas-catalogo .card-img-top {
    height: 140px;
    object-fit: cover;
    border-top-left-radius: 14px;
    border-top-right-radius: 14px;
  }
  .chip {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    font-size: 12px;
    margin: 2px 6px 2px 0;
    cursor: pointer;
    user-select: none;
  }
  .chip.active { background: #0d6efd; color: #fff; border-color: #0d6efd; }
  .chip .dot {
    width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; background: currentColor;
  }
  .list-toolbar .form-control, .list-toolbar .form-select { border-radius: 10px; }
  .table thead th { white-space: nowrap; }
  .table tbody td { vertical-align: middle; }
  .badge-soft { background: #f5f7ff; color: #0d6efd; border: 1px solid #e4e9ff; }
  .text-quiet { color: #6c757d; }
  .icon-24 { width: 24px; height: 24px; }
  .truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

  /* Contenedor del modal para mejor lectura */
  .modal-body .section-title { font-weight: 700; color: #111827; margin: .75rem 0 .5rem; }
  .modal-body ul, .modal-body ol { padding-left: 1.1rem; }
  .modal-body li { margin-bottom: .35rem; }
  .modal-illustration { border-radius: 12px; overflow: hidden; }

  /* Indicadores de categoría en cards */
  .category-pill { position:absolute; top:10px; left:10px; background: rgba(255,255,255,.92); border:1px solid #e9ecef; border-radius: 999px; padding:4px 10px; font-size: 12px; }

  /* Pequeñas mejoras responsive */
  @media (max-width: 575.98px) {
    .list-toolbar .row > [class*='col-'] { margin-bottom: .5rem; }
    .becas-catalogo .card-img-top { height: 120px; }
  }
</style>

  <!-- =========================================================
       TABLA DE SOLICITUDES EXISTENTES
       ========================================================= -->
  <?php if (!empty($solicitudes)): ?>
    <div class="table-responsive shadow-sm rounded mb-5">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-primary">
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col" style="width: 25%;">Fecha</th>
            <th scope="col" style="width: 20%;">Estatus</th>
            <th scope="col" style="width: 30%;">Progreso</th>
            <th scope="col" class="text-end" style="width: 20%;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($solicitudes as $solicitud): 
            // Determina el progreso y clase para la barra
            switch ($solicitud->estatus) {
              case 'Aprobada':
                $progress = 100;
                $progressClass = 'bg-success';
                break;
              case 'Rechazada':
                $progress = 100;
                $progressClass = 'bg-danger';
                break;
              case 'En Revisión':
              default:
                $progress = 50;
                $progressClass = 'bg-warning';
            }
          ?>
            <tr>
              <td class="fw-semibold"><?= Html::encode($solicitud->id) ?></td>
              <td><?= Yii::$app->formatter->asDate($solicitud->fecha_solicitud, 'long') ?></td>
              <td>
                <span class="badge <?= $progressClass ?> text-white px-3 py-2" style="font-size: 0.9rem;">
                  <?= Html::encode($solicitud->estatus) ?>
                </span>
              </td>
              <td>
                <div class="progress" style="height: 8px; border-radius: 4px; background-color: #e9ecef;">
                  <div class="progress-bar <?= $progressClass ?>" role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </td>
              <td class="text-end">
                <?= Html::a('📄 Ver Detalle', ['#'], [
                      'class' => 'btn btn-sm btn-outline-primary disabled',
                      'title' => 'Próximamente'
                    ]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div id="catalogo" class="mt-5 becas-catalogo">
    <!-- ===== Título y controles ===== -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-2">
      <div>
        <h3 class="fw-bold mb-1">🎓 Becas Institucionales
      </div>
      <div class="list-toolbar w-100 w-sm-auto">
        <div class="row g-2 align-items-center">
          <div class="col-12 col-sm-6 col-md-4">
          </div>
          </div>
          <div class="col-6 col-sm-3 col-md-2 text-end">
          
        </div>
        <div class="mt-2">
    <!-- ===== Grid de becas ===== -->
    <div id="gridBecas" class="row g-3">
      <?php
        // Dataset de becas con imágenes (Unsplash/placeholder) y meta datos
        $becas = [
          [
            'id' => 'alimenticia',
            'titulo' => 'BECA ALIMENTICIA',
            'categoria' => 'economica',
            'descripcion' => 'Apoyo económico para la alimentación: un desayuno o comida gratis al día durante el cuatrimestre.',
            'img' => Yii::getAlias('@web') . '/uploads/imagenes/alimenticia.jpeg',
            'detalle' => 'Con base en los artículos 12 y 15 del reglamento de Becas, la beca consiste en recibir alimentación (un desayuno o comida) de manera gratuita por una sola ocasión al día, de lunes a viernes en la cafetería de la UTH durante el cuatrimestre mayo-agosto 2025.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el pago de seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Realizar el pago de reinscripción antes del 2 de mayo de 2025'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 2 de mayo de 2025',
              'Resultados se publican el 4 de mayo de 2025',
              'Presentarse el 12 de mayo de 2025 para aplicación'
            ],
          ],
          [
            'id' => 'excelencia',
            'titulo' => 'BECA DE EXCELENCIA',
            'categoria' => 'academica',
            'descripcion' => 'Exención de cuota de inscripción/reinscripción para promedios de excelencia.',
            'img' => Yii::getAlias('@web') . '/uploads/imagenes/excelencia.avif',
            'detalle' => 'Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en la exención de pago sobre la cuota de inscripción o reinscripción del cuatrimestre mayo-agosto 2025.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el pago de seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Tener promedio general de 10 hasta el cuatrimestre enero-abril 2025'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 2 de mayo de 2025',
              'Resultados se publican el 4 de mayo de 2025',
              'Registrar referencia antes del 8 de mayo de 2025'
            ],
          ],
          [
            'id' => 'academica',
            'titulo' => 'BECA ACADÉMICA',
            'categoria' => 'academica',
            'descripcion' => 'Descuento del 50% en la reinscripción para promedios altos.',
            'img' => 'https://images.unsplash.com/photo-1456735190827-d1262f71b8a3?q=80&w=1400&auto=format&fit=crop',
            'detalle' => 'Con base en los artículos 12 y 14 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el pago de seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Tener promedio mínimo de 9.0 a 9.9 en el cuatrimestre enero-abril 2025'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 2 de mayo de 2025',
              'Resultados se publican el 4 de mayo de 2025',
              'Recibir orden de pago el 8-9 de mayo de 2025',
              'Registrar referencia antes del 11 de mayo de 2025'
            ],
          ],
          [
            'id' => 'socioeconomica',
            'titulo' => 'BECA DE ASISTENCIA SOCIOECONÓMICA',
            'categoria' => 'social',
            'descripcion' => 'Exención de pago de reinscripción para estudiantes de escasos recursos.',
             'img' => Yii::getAlias('@web') . '/uploads/imagenes/asistencia.avif',
            'detalle' => 'Con base en los artículos 12 y 18 del reglamento de Becas, la beca consiste en la exención de pago sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a estudiantes de escasos recursos económicos con la intención que concluyan sus estudios.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Comprobante oficial de ingresos reciente (no mayor a 30 días)'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud con comprobante de ingresos el 2 de mayo de 2025',
              'Resultados se publican el 4 de mayo de 2025',
              'Registrar referencia antes del 8 de mayo de 2025'
            ],
          ],
          [
            'id' => 'vulnerables',
            'titulo' => 'BECA PARA ALUMNOS DISCAPACITADOS',
            'categoria' => 'social',
            'descripcion' => '50% de descuento para estudiantes de grupos vulnerables o con discapacidad.',
             'img' => Yii::getAlias('@web') . '/uploads/imagenes/discapacitacion.avif',
            'detalle' => 'Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a los estudiantes que pertenezcan a grupos vulnerables, origen indígena (etnia) o que presenten alguna discapacidad.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el pago de seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Pertenecer a alguna etnia indígena o presentar alguna discapacidad'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 2 de mayo de 2025',
              'Entrevista médica el 3 de mayo de 2025 (si aplica)',
              'Resultados se publican el 4 de mayo de 2025',
              'Recibir orden de pago el 8-11 de mayo de 2025',
              'Registrar referencia antes del 11 de mayo de 2025'
            ],
          ],
          [
            'id' => 'deportiva',
            'titulo' => 'BECA DEPORTIVA Y EXTRACURRICULAR',
            'categoria' => 'deportiva',
            'descripcion' => 'Descuento del 50% para desempeño destacado en deporte o actividad extracurricular.',
            'img' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=1400&auto=format&fit=crop',
            'detalle' => 'Con base al artículo 25 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025 a los estudiantes que logren un desempeño destacado en actividad deportiva o extracurricular.',
            'requisitos' => [
              'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
              'Tener expediente completo y sin observaciones',
              'No tener adeudos',
              'Tener cubierto el pago de seguro contra accidentes',
              'No contar con otra beca para sus estudios',
              'Tener promedio mínimo de 8.5 en el cuatrimestre enero-abril 2025'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 2 de mayo de 2025',
              'Resultados se publican el 4 de mayo de 2025',
              'Registrar referencia antes del 8 de mayo de 2025'
            ],
            'nota' => 'Esta beca requiere postulación por la Dirección de Extensión Universitaria.'
          ],
          [
            'id' => 'maestria',
            'titulo' => 'BECA DE MAESTRÍA PARA TRABAJADORES UTH',
            'categoria' => 'posgrado',
            'descripcion' => '25% de descuento en mensualidad del posgrado para personal UTH.',
            'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1400&auto=format&fit=crop',
            'detalle' => 'Convocatoria a Beca de Maestría para el cuatrimestre mayo-agosto 2025: 25% de descuento en el pago de mensualidad durante el cuatrimestre.',
            'requisitos' => [
              'Ser trabajador(a) activo(a) de la Universidad Tecnológica de Huejotzingo',
              'Ser estudiante inscrito en programa de maestría',
              'Haber cursado por lo menos 2 cuatrimestres del programa de maestría',
              'Promedio general de 9 hasta el cuatrimestre anterior inmediato',
              'No tener adeudos de ningún tipo con la UTH',
              'Tener expediente completo y sin observaciones',
              'Cumplimiento de trámites en tiempo y forma relativos a su calidad de estudiante'
            ],
            'procedimiento' => [
              'Validar datos personales en el SII',
              'Registrar solicitud el 5 de mayo de 2025',
              'Resultados se publican el 9 de mayo de 2025',
              'Registrar referencia antes del 11 de mayo de 2025'
            ],
            'nota' => 'Descuento del 25% en el pago por concepto de mensualidad.'
          ],
        ];

        // Render de tarjetas
        foreach ($becas as $b):
          $solicitarUrl = Url::to(['/site/becas', 'tipo' => $b['id']]);
      ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 beca-item" data-categoria="<?= Html::encode($b['categoria']) ?>" data-keywords="<?= Html::encode(strtolower($b['titulo'].' '.$b['descripcion'])) ?>">
        <div class="card h-100 position-relative" aria-live="polite">
          <span class="category-pill text-muted"><?= Html::encode(strtoupper($b['categoria'])) ?></span>
          <img src="<?= Html::encode($b['img']) ?>" alt="Imagen de <?= Html::encode($b['titulo']) ?>" class="card-img-top" loading="lazy">
          <div class="card-body p-3">
            <h6 class="fw-bold mb-1" title="<?= Html::encode($b['titulo']) ?>"><?= Html::encode($b['titulo']) ?></h6>
            <p class="mb-2 text-muted small truncate-2"><?= Html::encode($b['descripcion']) ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-sm btn-outline-primary" type="button" data-role="detalle" data-id="<?= Html::encode($b['id']) ?>">
                <i class="fas fa-info-circle"></i> Detalles
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ===== Bloque de Reglas resumidas y botón a Reglas Completas (modal) ===== -->
    <div class="row justify-content-center mt-4">
      <div class="col-lg-10">
        <div class="card" style="border: 3px solid #eee; border-radius: 20px; background: #fff;">
          <div class="card-body p-4 p-md-5">
            <div class="text-center mb-3">
              <h4 class="fw-bold mb-1">📘 Reglas de las Becas</h4>
              <div class="text-muted">Resumen general del proceso</div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <h6 class="fw-bold">📋 Requisitos Generales</h6>
                <ul class="small text-quiet mb-0">
                  <li>Ser estudiante activo de la UTH</li>
                  <li>Mantener promedio mínimo requerido</li>
                  <li>No tener adeudos pendientes</li>
                  <li>Cumplir con la documentación solicitada</li>
                  <li>Asistir a las actividades obligatorias</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6 class="fw-bold">📅 Proceso de Solicitud</h6>
                <ul class="small text-quiet mb-0">
                  <li>Revisar convocatorias vigentes</li>
                  <li>Completar formulario de solicitud</li>
                  <li>Entregar documentación completa</li>
                  <li>Participar en entrevista si es requerida</li>
                  <li>Esperar resolución del comité</li>
                </ul>
              </div>
            </div>
            <div class="text-center mt-3">
              <button class="btn btn-lg btn-outline-dark" id="btnReglasCompletas" type="button">
                <i class="fas fa-file-alt"></i> Ver Reglas Completas
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =========================================================
     MODAL DETALLES DE BECA
     ========================================================= -->
<div class="modal fade" id="becaModal" tabindex="-1" aria-labelledby="becaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="background:#111827; color:#fff;">
        <h5 class="modal-title" id="becaModalLabel">Detalles de la Beca</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="becaModalBody">
        <!-- Contenido dinámico -->
      </div>
      <div class="modal-footer">
        <a href="#" id="modalSolicitar" class="btn btn-dark">Solicitar</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- =========================================================
     MODAL REGLAS COMPLETAS
     ========================================================= -->
<div class="modal fade" id="reglasModal" tabindex="-1" aria-labelledby="reglasModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" style="background:#111827; color:#fff;">
        <h5 class="modal-title" id="reglasModalLabel">Reglas Completas de Becas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <h5 class="section-title">📋 Requisitos Generales</h5>
            <ul>
              <li>Ser estudiante activo de la UTH</li>
              <li>Mantener promedio mínimo requerido según el tipo de beca</li>
              <li>No tener adeudos pendientes</li>
              <li>Cumplir con la documentación solicitada</li>
              <li>Asistir a las actividades obligatorias</li>
              <li>Tener expediente completo y sin observaciones</li>
              <li>Tener cubierto el pago de seguro contra accidentes</li>
              <li>No contar con otra beca para sus estudios</li>
            </ul>

            <h5 class="section-title">📅 Proceso de Solicitud</h5>
            <ol>
              <li>Revisar convocatorias vigentes en el SII</li>
              <li>Validar datos personales previo a reinscripción</li>
              <li>Completar formulario de solicitud en línea</li>
              <li>Entregar documentación completa según el tipo de beca</li>
              <li>Participar en entrevista si es requerida</li>
              <li>Esperar resolución del comité de becas</li>
              <li>Cumplir con los plazos establecidos</li>
            </ol>

            <h5 class="section-title">📌 Consideraciones Importantes</h5>
            <ul>
              <li>Una vez elegida la beca y hecho el registro no hay modificación</li>
              <li>En caso de no hacer efectiva la beca en tiempo y forma, se cancelará</li>
              <li>Los resultados se publican en el SII y correo institucional</li>
              <li>Es responsabilidad del estudiante revisar las notificaciones</li>
              <li>Los criterios de asignación incluyen disponibilidad presupuestal</li>
            </ul>

            <div class="alert alert-warning mt-3">
              <strong>Importante:</strong> Todas las fechas mencionadas corresponden al cuatrimestre Mayo-Agosto 2025.
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- =========================================================
     PLANTILLAS JS: DETALLES POR BECA (usando dataset JS con textos COMPLETOS)
     ========================================================= -->
<script>
  // Utilidad: sanitiza texto simple para evitar inyección en plantillas (muy básico para este caso)
  function esc(str) {
    return String(str).replace(/[&<>"']/g, function(m) {
      return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[m]);
    });
  }

  // Dataset espejo en JS (sincronizado con PHP) para interacción en el modal y filtros
  const BECAS = {
    alimenticia: {
      id: 'alimenticia',
      titulo: 'BECA ALIMENTICIA',
      categoria: 'economica',
      img: 'https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base en los artículos 12 y 15 del reglamento de Becas, la beca consiste en recibir alimentación (un desayuno o comida) de manera gratuita por una sola ocasión al día, de lunes a viernes en la cafetería de la UTH durante el cuatrimestre mayo-agosto 2025.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el pago de seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Realizar el pago de reinscripción antes del 2 de mayo de 2025'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 2 de mayo de 2025',
        'Resultados se publican el 4 de mayo de 2025',
        'Presentarse el 12 de mayo de 2025 para aplicación'
      ]
    },
    excelencia: {
      id: 'excelencia',
      titulo: 'BECA DE EXCELENCIA',
      categoria: 'academica',
      img: 'https://images.unsplash.com/photo-1596495578065-8b2a7a06d1ab?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en la exención de pago sobre la cuota de inscripción o reinscripción del cuatrimestre mayo-agosto 2025.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el pago de seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Tener promedio general de 10 hasta el cuatrimestre enero-abril 2025'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 2 de mayo de 2025',
        'Resultados se publican el 4 de mayo de 2025',
        'Registrar referencia antes del 8 de mayo de 2025'
      ]
    },
    academica: {
      id: 'academica',
      titulo: 'BECA ACADÉMICA',
      categoria: 'academica',
      img: 'https://images.unsplash.com/photo-1456735190827-d1262f71b8a3?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base en los artículos 12 y 14 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el pago de seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Tener promedio mínimo de 9.0 a 9.9 en el cuatrimestre enero-abril 2025'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 2 de mayo de 2025',
        'Resultados se publican el 4 de mayo de 2025',
        'Recibir orden de pago el 8-9 de mayo de 2025',
        'Registrar referencia antes del 11 de mayo de 2025'
      ]
    },
    socioeconomica: {
      id: 'socioeconomica',
      titulo: 'BECA DE ASISTENCIA SOCIOECONÓMICA',
      categoria: 'social',
      img: 'https://images.unsplash.com/photo-1512361436605-a4a49e5a3bd3?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base en los artículos 12 y 18 del reglamento de Becas, la beca consiste en la exención de pago sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a estudiantes de escasos recursos económicos con la intención que concluyan sus estudios.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Comprobante oficial de ingresos reciente (no mayor a 30 días)'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud con comprobante de ingresos el 2 de mayo de 2025',
        'Resultados se publican el 4 de mayo de 2025',
        'Registrar referencia antes del 8 de mayo de 2025'
      ]
    },
    vulnerables: {
      id: 'vulnerables',
      titulo: 'BECA PARA GRUPOS VULNERABLES Y DISCAPACIDADES',
      categoria: 'social',
      img: 'https://images.unsplash.com/photo-1516728778615-2d590ea1856f?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a los estudiantes que pertenezcan a grupos vulnerables, origen indígena (etnia) o que presenten alguna discapacidad.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el pago de seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Pertenecer a alguna etnia indígena o presentar alguna discapacidad'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 2 de mayo de 2025',
        'Entrevista médica el 3 de mayo de 2025 (si aplica)',
        'Resultados se publican el 4 de mayo de 2025',
        'Recibir orden de pago el 8-11 de mayo de 2025',
        'Registrar referencia antes del 11 de mayo de 2025'
      ]
    },
    deportiva: {
      id: 'deportiva',
      titulo: 'BECA DEPORTIVA Y EXTRACURRICULAR',
      categoria: 'deportiva',
      img: 'https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=1400&auto=format&fit=crop',
      detalle: `Con base al artículo 25 del reglamento de Becas, la beca consiste en un descuento del 50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025 a los estudiantes que logren un desempeño destacado en actividad deportiva o extracurricular.`,
      requisitos: [
        'Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura',
        'Tener expediente completo y sin observaciones',
        'No tener adeudos',
        'Tener cubierto el pago de seguro contra accidentes',
        'No contar con otra beca para sus estudios',
        'Tener promedio mínimo de 8.5 en el cuatrimestre enero-abril 2025'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 2 de mayo de 2025',
        'Resultados se publican el 4 de mayo de 2025',
        'Registrar referencia antes del 8 de mayo de 2025'
      ],
      nota: 'Esta beca requiere postulación por la Dirección de Extensión Universitaria.'
    },
    maestria: {
      id: 'maestria',
      titulo: 'BECA DE MAESTRÍA PARA TRABAJADORES UTH',
      categoria: 'posgrado',
      img: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1400&auto=format&fit=crop',
      detalle: `Convocatoria a Beca de Maestría para el cuatrimestre mayo-agosto 2025: 25% de descuento en el pago de mensualidad durante el cuatrimestre.`,
      requisitos: [
        'Ser trabajador(a) activo(a) de la Universidad Tecnológica de Huejotzingo',
        'Ser estudiante inscrito en programa de maestría',
        'Haber cursado por lo menos 2 cuatrimestres del programa de maestría',
        'Promedio general de 9 hasta el cuatrimestre anterior inmediato',
        'No tener adeudos de ningún tipo con la UTH',
        'Tener expediente completo y sin observaciones',
        'Cumplimiento de trámites en tiempo y forma relativos a su calidad de estudiante'
      ],
      procedimiento: [
        'Validar datos personales en el SII',
        'Registrar solicitud el 5 de mayo de 2025',
        'Resultados se publican el 9 de mayo de 2025',
        'Registrar referencia antes del 11 de mayo de 2025'
      ],
      nota: 'Descuento del 25% en el pago por concepto de mensualidad.'
    }
  };

  // Render del modal a partir de una beca
  function renderModal(beca) {
    const solicitarHref = '<?= Url::to(['/site/becas']) ?>' + '?tipo=' + encodeURIComponent(beca.id);
    const requisitos = (beca.requisitos||[]).map(x => `<li>${esc(x)}</li>`).join('');
    const procedimiento = (beca.procedimiento||[]).map(x => `<li>${esc(x)}</li>`).join('');
    const nota = beca.nota ? `<div class="alert alert-info mt-3"><strong>Nota:</strong> ${esc(beca.nota)}</div>` : '';

    const html = `
      <div class="row g-3">
        <div class="col-12">
          <div class="modal-illustration mb-2">
            <img src="${esc(beca.img)}" alt="${esc(beca.titulo)}" class="w-100" style="max-height: 260px; object-fit: cover;">
          </div>
        </div>
        <div class="col-12">
          <h4 class="mb-1">${esc(beca.titulo)}</h4>
          <p class="text-muted">${esc(beca.detalle)}</p>
        </div>
        <div class="col-md-6">
          <h6 class="section-title">Requisitos</h6>
          <ul>${requisitos}</ul>
        </div>
        <div class="col-md-6">
          <h6 class="section-title">Procedimiento</h6>
          <ol>${procedimiento}</ol>
        </div>
        <div class="col-12">${nota}</div>
      </div>
    `;

    document.getElementById('becaModalLabel').textContent = beca.titulo;
    document.getElementById('becaModalBody').innerHTML = html;
    const link = document.getElementById('modalSolicitar');
    link.setAttribute('href', solicitarHref);
  }

  // Delegación de eventos para abrir modal desde las tarjetas
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-role="detalle"]');
    if (btn) {
      const id = btn.getAttribute('data-id');
      const beca = BECAS[id];
      if (beca) {
        renderModal(beca);
        const modal = new bootstrap.Modal(document.getElementById('becaModal'));
        modal.show();
      }
    }
  });

  // Botón reglas completas
  document.getElementById('btnReglasCompletas').addEventListener('click', function(){
    const modal = new bootstrap.Modal(document.getElementById('reglasModal'));
    modal.show();
  });

  // Scroll al catálogo
  document.getElementById('btnScrollCatalogo').addEventListener('click', function(){
    document.getElementById('catalogo').scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  // ====== Filtros y búsqueda ======
  const chips = Array.from(document.querySelectorAll('.chip'));
  const grid = document.getElementById('gridBecas');
  const items = Array.from(grid.querySelectorAll('.beca-item'));
  const inputBuscar = document.getElementById('inputBuscar');
  const selectOrden = document.getElementById('selectOrden');
  const btnLimpiar = document.getElementById('btnLimpiarFiltros');

  function applyFilters() {
    const activeChip = chips.find(c => c.classList.contains('active'));
    const cat = activeChip ? activeChip.getAttribute('data-cat') : 'todas';
    const q = (inputBuscar.value || '').toLowerCase().trim();

    items.forEach(card => {
      const itemCat = card.getAttribute('data-categoria');
      const keywords = card.getAttribute('data-keywords') || '';
      const passCat = (cat === 'todas') || (itemCat === cat);
      const passQ = !q || keywords.includes(q);
      card.style.display = (passCat && passQ) ? '' : 'none';
    });
  }

  function applySort() {
    const val = selectOrden.value;
    const cards = Array.from(grid.children);
    cards.sort((a,b) => {
      const ta = a.querySelector('h6')?.textContent?.toLowerCase() || '';
      const tb = b.querySelector('h6')?.textContent?.toLowerCase() || '';
      if (val === 'titulo-desc') return tb.localeCompare(ta);
      return ta.localeCompare(tb);
    });
    cards.forEach(c => grid.appendChild(c));
  }

  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      applyFilters();
    });
  });

  inputBuscar.addEventListener('input', applyFilters);
  selectOrden.addEventListener('change', applySort);
  btnLimpiar.addEventListener('click', () => {
    chips.forEach(c => c.classList.remove('active'));
    chips[0].classList.add('active');
    inputBuscar.value = '';
    selectOrden.value = 'titulo-asc';
    applySort();
    applyFilters();
  });

  // Inicializa orden
  applySort();

  // ===== Tooltip opcional para chips (si Bootstrap Tooltip está disponible) =====
  if (bootstrap && bootstrap.Tooltip) {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
  }
</script>

<!-- =========================================================
     BLOQUE OPCIONAL: ICONOS/RECURSOS
     Nota: Asegúrate de tener Font Awesome cargado en tu layout si vas a usar <i class="fas ..."></i>
     ========================================================= -->
<!-- Ejemplo (si tu layout aún no lo agrega):
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
-->