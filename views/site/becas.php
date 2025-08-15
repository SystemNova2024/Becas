<?php

/** @var yii\web\View $this */

$this->title = 'Becas Disponibles - UTH';
?>

<div class="becas-page">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="display-3" style="color: #4A0000; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Becas Disponibles</h1>
        <p class="lead" style="color: #4A0000; font-size: 1.3rem;">Universidad Tecnológica de Huejotzingo</p>
    </div>

    <!-- Becas Grid -->
    <div class="row mb-5">
        <!-- Beca Alimenticia -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-utensils" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA ALIMENTICIA</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Apoyo económico para la alimentación de estudiantes que requieren asistencia para cubrir sus necesidades básicas.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('alimenticia')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca de Excelencia -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-trophy" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA DE EXCELENCIA</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Reconocimiento y apoyo para estudiantes con excelente rendimiento académico y destacado desempeño.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('excelencia')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca Académica -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-graduation-cap" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA ACADÉMICA</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Apoyo para estudiantes con buen rendimiento académico que requieren asistencia económica.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('academica')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca de Asistencia Socioeconómica -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-hands-helping" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA DE ASISTENCIA SOCIOECONÓMICA</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Apoyo integral para estudiantes en situación socioeconómica vulnerable que requieren asistencia.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('socioeconomica')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca para Grupos Vulnerables y Discapacidades -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-heart" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA PARA GRUPOS VULNERABLES Y DISCAPACIDADES</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Apoyo especializado para estudiantes con discapacidades y grupos en situación de vulnerabilidad.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('vulnerables')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca Deportiva y Extracurricular -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-running" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA DEPORTIVA Y EXTRACURRICULAR</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Reconocimiento y apoyo para estudiantes destacados en actividades deportivas y extracurriculares.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('deportiva')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <!-- Beca de Maestría para Trabajadores UTH -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card beca-card h-100" style="border: 2px solid #4A0000; border-radius: 15px; transition: all 0.3s ease;">
                <div class="card-body text-center p-4">
                    <div class="beca-icon mb-3">
                        <i class="fas fa-user-tie" style="font-size: 3rem; color: #4A0000;"></i>
                    </div>
                    <h3 class="card-title" style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">BECA DE MAESTRÍA PARA TRABAJADORES UTH</h3>
                    <p class="card-text" style="color: #666; line-height: 1.6;">
                        Apoyo para el personal docente y administrativo de la UTH que desea continuar sus estudios de posgrado.
                    </p>
                    <button class="btn btn-outline-primary mt-3" style="border-color: #4A0000; color: #4A0000;" onclick="mostrarDetalles('maestria')">
                        <i class="fas fa-info-circle"></i> Ver Detalles
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reglas Section -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card" style="border: 3px solid #4A0000; border-radius: 20px; background: linear-gradient(135deg, #FFF8DC, #F5F5DC);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 style="color: #4A0000; font-weight: bold; text-shadow: 1px 1px 3px rgba(0,0,0,0.2);">
                            <i class="fas fa-gavel" style="margin-right: 10px;"></i>
                            Reglas de las Becas
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">📋 Requisitos Generales</h4>
                            <ul style="color: #4A0000; line-height: 1.8;">
                                <li>Ser estudiante activo de la UTH</li>
                                <li>Mantener promedio mínimo requerido</li>
                                <li>No tener adeudos pendientes</li>
                                <li>Cumplir con la documentación solicitada</li>
                                <li>Asistir a las actividades obligatorias</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4 style="color: #4A0000; font-weight: bold; margin-bottom: 1rem;">📅 Proceso de Solicitud</h4>
                            <ul style="color: #4A0000; line-height: 1.8;">
                                <li>Revisar convocatorias vigentes</li>
                                <li>Completar formulario de solicitud</li>
                                <li>Entregar documentación completa</li>
                                <li>Participar en entrevista si es requerida</li>
                                <li>Esperar resolución del comité</li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-lg" style="background: linear-gradient(45deg, #4A0000, #8B0000); color: #FFF8DC; padding: 12px 30px; border-radius: 50px; box-shadow: 0 4px 8px rgba(74,0,0,0.3);" onclick="mostrarReglasCompletas()">
                            <i class="fas fa-file-alt"></i> Ver Reglas Completas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar detalles de becas -->
<div class="modal fade" id="becaModal" tabindex="-1" aria-labelledby="becaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(45deg, #4A0000, #8B0000); color: #FFF8DC;">
                <h5 class="modal-title" id="becaModalLabel">Detalles de la Beca</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="becaModalBody">
                <!-- El contenido se cargará dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function mostrarDetalles(tipo) {
    const modal = new bootstrap.Modal(document.getElementById('becaModal'));
    const modalBody = document.getElementById('becaModalBody');
    const modalTitle = document.getElementById('becaModalLabel');
    
    let contenido = '';
    let titulo = '';
    
    switch(tipo) {
        case 'alimenticia':
            titulo = 'BECA ALIMENTICIA';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base en los artículos 12 y 15 del reglamento de Becas, la beca consiste en recibir alimentación 
                            (un desayuno o comida) de manera gratuita por una sola ocasión al día, de lunes a viernes en la 
                            cafetería de la UTH durante el cuatrimestre mayo-agosto 2025.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el pago de seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li>Realizar el pago de reinscripción antes del 2 de mayo de 2025</li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 2 de mayo de 2025</li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Presentarse el 12 de mayo de 2025 para aplicación</li>
                        </ol>
                    </div>
                </div>
            `;
            break;
            
        case 'excelencia':
            titulo = 'BECA DE EXCELENCIA';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en la exención de 
                            pago sobre la cuota de inscripción o reinscripción del cuatrimestre mayo-agosto 2025.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el pago de seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li><strong>Tener promedio general de 10 hasta el cuatrimestre enero-abril 2025</strong></li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 2 de mayo de 2025</li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Registrar referencia antes del 8 de mayo de 2025</li>
                        </ol>
                    </div>
                </div>
            `;
            break;
            
        case 'academica':
            titulo = 'BECA ACADÉMICA';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base en los artículos 12 y 14 del reglamento de Becas, la beca consiste en un descuento del 
                            50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el pago de seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li><strong>Tener promedio mínimo de 9.0 a 9.9 en el cuatrimestre enero-abril 2025</strong></li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 2 de mayo de 2025</li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Recibir orden de pago el 8-9 de mayo de 2025</li>
                            <li>Registrar referencia antes del 11 de mayo de 2025</li>
                        </ol>
                    </div>
                </div>
            `;
            break;
            
        case 'socioeconomica':
            titulo = 'BECA DE ASISTENCIA SOCIOECONÓMICA';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base en los artículos 12 y 18 del reglamento de Becas, la beca consiste en la exención de 
                            pago sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a estudiantes de 
                            escasos recursos económicos con la intención que concluyan sus estudios.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li><strong>Comprobante oficial de ingresos reciente (no mayor a 30 días)</strong></li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud con comprobante de ingresos el 2 de mayo de 2025</li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Registrar referencia antes del 8 de mayo de 2025</li>
                        </ol>
                    </div>
                </div>
            `;
            break;
            
        case 'vulnerables':
            titulo = 'BECA PARA GRUPOS VULNERABLES Y DISCAPACIDADES';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base en los artículos 12 y 13 del reglamento de Becas, la beca consiste en un descuento del 
                            50% sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025, a los estudiantes que 
                            pertenezcan a grupos vulnerables, origen indígena (etnia) o que presenten alguna discapacidad.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el pago de seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li><strong>Pertenecer a alguna etnia indígena o presentar alguna discapacidad</strong></li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 2 de mayo de 2025</li>
                            <li><strong>Entrevista médica el 3 de mayo de 2025 (si aplica)</strong></li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Recibir orden de pago el 8-11 de mayo de 2025</li>
                            <li>Registrar referencia antes del 11 de mayo de 2025</li>
                        </ol>
                    </div>
                </div>
            `;
            break;
            
        case 'deportiva':
            titulo = 'BECA DEPORTIVA Y EXTRACURRICULAR';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Con base al artículo 25 del reglamento de Becas, la beca consiste en un descuento del 50% pago 
                            sobre la cuota de reinscripción del cuatrimestre mayo-agosto 2025 a los estudiantes que logren un 
                            desempeño destacado en una actividad deportiva o extracurricular individual o de conjunto.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser estudiante regular de nivel TSU, Ingeniería o Licenciatura</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>No tener adeudos</li>
                            <li>Tener cubierto el pago de seguro contra accidentes</li>
                            <li>No contar con otra beca para sus estudios</li>
                            <li><strong>Tener promedio mínimo de 8.5 en el cuatrimestre enero-abril 2025</strong></li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 2 de mayo de 2025</li>
                            <li>Resultados se publican el 4 de mayo de 2025</li>
                            <li>Registrar referencia antes del 8 de mayo de 2025</li>
                        </ol>
                        
                        <div class="alert alert-info mt-3" style="background-color: #FFF8DC; border-color: #4A0000; color: #4A0000;">
                            <strong>Nota:</strong> Esta beca requiere postulación por la Dirección de Extensión Universitaria.
                        </div>
                    </div>
                </div>
            `;
            break;
            
        case 'maestria':
            titulo = 'BECA DE MAESTRÍA PARA TRABAJADORES UTH';
            contenido = `
                <div class="row">
                    <div class="col-12">
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Descripción</h4>
                        <p style="text-align: justify; line-height: 1.6; margin-bottom: 1.5rem;">
                            Estimado(a) trabajador(a) estudiante de maestría, se te Convoca a participar en la Beca de Maestría 
                            para el cuatrimestre mayo-agosto 2025, la beca consiste en el 25% de descuento en el pago de 
                            mensualidad durante el cuatrimestre mayo-agosto 2025.
                        </p>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;"> Requisitos</h4>
                        <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                            <li>Ser trabajador(a) activo(a) de la Universidad Tecnológica de Huejotzingo</li>
                            <li>Ser estudiante inscrito en programa de maestría</li>
                            <li>Haber cursado por lo menos 2 cuatrimestres del programa de maestría</li>
                            <li><strong>Promedio general de 9 hasta el cuatrimestre anterior inmediato</strong></li>
                            <li>No tener adeudos de ningún tipo con la UTH</li>
                            <li>Tener expediente completo y sin observaciones</li>
                            <li>Cumplimiento de trámites en tiempo y forma relativos a su calidad de estudiante</li>
                        </ul>
                        
                        <h4 style="color: #4A0000; margin-bottom: 1rem;">Procedimiento</h4>
                        <ol style="color: #4A0000; line-height: 1.8;">
                            <li>Validar datos personales en el SII</li>
                            <li>Registrar solicitud el 5 de mayo de 2025</li>
                            <li>Resultados se publican el 9 de mayo de 2025</li>
                            <li>Registrar referencia antes del 11 de mayo de 2025</li>
                        </ol>
                        
                        <div class="alert alert-info mt-3" style="background-color: #FFF8DC; border-color: #4A0000; color: #4A0000;">
                            <strong>Característica:</strong> Descuento del 25% en el pago por concepto de mensualidad.
                        </div>
                    </div>
                </div>
            `;
            break;
    }
    
    modalTitle.textContent = titulo;
    modalBody.innerHTML = contenido;
    modal.show();
}

function mostrarReglasCompletas() {
    const modal = new bootstrap.Modal(document.getElementById('becaModal'));
    const modalBody = document.getElementById('becaModalBody');
    const modalTitle = document.getElementById('becaModalLabel');
    
    modalTitle.textContent = 'REGLAS COMPLETAS DE BECAS';
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-12">
                <h4 style="color: #4A0000; margin-bottom: 1rem;">📋 Requisitos Generales</h4>
                <ul style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                    <li>Ser estudiante activo de la UTH</li>
                    <li>Mantener promedio mínimo requerido según el tipo de beca</li>
                    <li>No tener adeudos pendientes</li>
                    <li>Cumplir con la documentación solicitada</li>
                    <li>Asistir a las actividades obligatorias</li>
                    <li>Tener expediente completo y sin observaciones</li>
                    <li>Tener cubierto el pago de seguro contra accidentes</li>
                    <li>No contar con otra beca para sus estudios</li>
                </ul>
                
                <h4 style="color: #4A0000; margin-bottom: 1rem;"> Proceso de Solicitud</h4>
                <ol style="color: #4A0000; line-height: 1.8; margin-bottom: 1.5rem;">
                    <li>Revisar convocatorias vigentes en el SII</li>
                    <li>Validar datos personales previo a reinscripción</li>
                    <li>Completar formulario de solicitud en línea</li>
                    <li>Entregar documentación completa según el tipo de beca</li>
                    <li>Participar en entrevista si es requerida</li>
                    <li>Esperar resolución del comité de becas</li>
                    <li>Cumplir con los plazos establecidos</li>
                </ol>
                
                <h4 style="color: #4A0000; margin-bottom: 1rem;"> Consideraciones Importantes</h4>
                <ul style="color: #4A0000; line-height: 1.8;">
                    <li>Una vez elegida la beca y hecho el registro no hay modificación</li>
                    <li>En caso de no hacer efectiva la beca en tiempo y forma, se cancelará</li>
                    <li>Los resultados se publican en el SII y correo institucional</li>
                    <li>Es responsabilidad del estudiante revisar las notificaciones</li>
                    <li>Los criterios de asignación incluyen disponibilidad presupuestal</li>
                </ul>
                
                <div class="alert alert-warning mt-3" style="background-color: #FFF8DC; border-color: #8B0000; color: #8B0000;">
                    <strong>Importante:</strong> Todas las fechas mencionadas corresponden al cuatrimestre Mayo-Agosto 2025.
                </div>
            </div>
        </div>
    `;
    modal.show();
}
</script> 