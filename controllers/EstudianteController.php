<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\models\User; 
use app\models\SolicitudBeca;
use app\models\Beca;
use app\models\DocumentoBeca;
use app\models\UploadForm;
use app\models\DocumentoSolicitud;
use app\models\Notificacion;

class EstudianteController extends Controller
{
    public $layout = 'estudiante';

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->rol_id != 3) {
            return $this->redirect(['site/login']);
        }
        return parent::beforeAction($action);
    }

    /**
     * Muestra el Dashboard con la última solicitud.
     */
    public function actionDashboard()
    {
        $usuarioId = Yii::$app->user->identity->id;

        $ultimaSolicitud = SolicitudBeca::find()
            ->where(['estudiante_id' => $usuarioId])
            ->orderBy(['fecha_solicitud' => SORT_DESC])
            ->one();

        $usuario = User::findOne($usuarioId);

        return $this->render('dashboard', [
            'ultimaSolicitud' => $ultimaSolicitud,
            'usuario' => $usuario,
        ]);
    }

    /**
     * Muestra todas las solicitudes.
     */
    public function actionSolicitudes()
    {
        $usuarioId = Yii::$app->user->identity->id;
        $solicitudes = SolicitudBeca::find()
            ->where(['estudiante_id' => $usuarioId])
            ->all();

        return $this->render('solicitudes', [
            'solicitudes' => $solicitudes,
        ]);
    }

    /**
     * Muestra perfil del estudiante.
     */
    public function actionPerfil()
    {
        $usuario = User::findOne(Yii::$app->user->identity->id);

        return $this->render('perfil', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Muestra becas disponibles actualmente.
     */
    public function actionBecas()
    {
        // Lista de becas hardcodeada (sin base de datos)
        $becas = [
            (object)[
                'id' => 1,
                'nombre' => 'Beca Alimenticia',
                'descripcion' => 'Apoyo económico para la alimentación: un desayuno o comida gratis al día durante el cuatrimestre.',
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                'archivo_convocatoria' => null,
            ],
            (object)[
                'id' => 2,
                'nombre' => 'Beca de Excelencia',
                'descripcion' => 'Exención de cuota de inscripción/reinscripción para promedios de excelencia.',
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                'archivo_convocatoria' => null,
            ],
            (object)[
                'id' => 3,
                'nombre' => 'Beca Académica',
                'descripcion' => 'Descuento del 50% en la reinscripción para promedios altos.',
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => date('Y-m-d', strtotime('+6 months')),
                'archivo_convocatoria' => null,
            ],
        ];

        return $this->render('becas', [
            'becas' => $becas
        ]);
    }

    /**
     * Muestra becas institucionales.
     */
    public function actionBecasInstitucionales()
    {
        // Lista de becas institucionales hardcodeada
        $becas = [
            (object)[
                'id' => 1,
                'nombre' => 'Beca Alimenticia',
                'descripcion' => 'Apoyo económico para la alimentación',
            ],
            (object)[
                'id' => 2,
                'nombre' => 'Beca de Excelencia',
                'descripcion' => 'Exención de cuota para promedios de excelencia',
            ],
            (object)[
                'id' => 3,
                'nombre' => 'Beca Académica',
                'descripcion' => 'Descuento del 50% para promedios altos',
            ],
            (object)[
                'id' => 4,
                'nombre' => 'Beca Socioeconómica',
                'descripcion' => 'Para estudiantes de escasos recursos',
            ],
        ];

        return $this->render('becas-institucionales', [
            'becas' => $becas
        ]);
    }

    public function actionCreate()
    {
        $model = new SolicitudBeca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $files = UploadedFile::getInstancesByName('documentos');

            foreach ($files as $file) {
                $nombreArchivo = uniqid() . '.' . $file->extension;
                $rutaCarpeta = Yii::getAlias('@webroot/uploads/solicitudes/');
                
                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0775, true);
                }

                $rutaCompleta = $rutaCarpeta . $nombreArchivo;

                if ($file->saveAs($rutaCompleta)) {
                    $doc = new DocumentoSolicitud();
                    $doc->solicitud_id = $model->id;
                    $doc->nombre_original = $file->name;
                    $doc->ruta_archivo = '/uploads/solicitudes/' . $nombreArchivo;
                    $doc->tipo_mime = $file->type;
                    $doc->save(false);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSolicitar($id)
    {
        // VERIFICAR: ¿El estudiante ya tiene una solicitud?
        $usuarioId = Yii::$app->user->identity->id;
        $solicitudExistente = SolicitudBeca::find()
            ->where(['estudiante_id' => $usuarioId])
            ->andWhere(['!=', 'estatus', 'Rechazada']) // Permitir nueva solicitud si fue rechazada
            ->one();

        if ($solicitudExistente) {
            Yii::$app->session->setFlash('error', 
                "⚠ Ya tienes una solicitud de beca activa. Puedes ver tu solicitud en 'Mis Solicitudes'. " .
                "Si necesitas ayuda, contacta al Departamento de Becas o envía un mensaje al coordinador desde 'Contactar Coordinador'.");
            return $this->redirect(['solicitudes']);
        }

        // Nombres de becas disponibles
        $becasNombres = [
            1 => 'Beca Alimenticia',
            2 => 'Beca de Excelencia',
            3 => 'Beca Académica',
            4 => 'Beca Socioeconómica',
        ];
        
        // Crear objeto beca con los datos básicos
        $beca = (object)[
            'id' => $id,
            'nombre' => $becasNombres[$id] ?? 'Beca Institucional',
            'descripcion' => 'Convocatoria de beca institucional',
        ];

        $solicitud = new SolicitudBeca();
        
        // Crear la solicitud directamente al hacer POST
        if (Yii::$app->request->isPost) {
            $solicitud->beca_id = $id;
            $solicitud->estudiante_id = $usuarioId;
            $solicitud->fecha_solicitud = date('Y-m-d');
            $solicitud->estatus = 'pendiente';
            $solicitud->documentos_completos = 0;
            
            if ($solicitud->save()) {
                // Mostrar mensaje de confirmación
                $becaNombre = $beca->nombre;
                Yii::$app->session->setFlash('success', "✓ ¡Beca solicitada! Has solicitado {$becaNombre}. Tu solicitud ha sido registrada correctamente y se ve en 'Mis Solicitudes'.");
                return $this->redirect(['solicitudes']);
            } else {
                Yii::$app->session->setFlash('error', 'Error al registrar la solicitud. Por favor, intenta nuevamente.');
            }
        }

        return $this->render('solicitar', [
            'beca' => $beca,
            'solicitud' => $solicitud,
        ]);
    }

    /**
     * Muestra las notificaciones del estudiante.
     */
    public function actionNotificaciones()
    {
        $usuarioId = Yii::$app->user->identity->id;
        
        $notificaciones = Notificacion::find()
            ->where(['usuario_id' => $usuarioId])
            ->with(['solicitud'])
            ->orderBy(['fecha_creacion' => SORT_DESC])
            ->all();

        return $this->render('notificaciones', [
            'notificaciones' => $notificaciones,
        ]);
    }

    /**
     * Marca una notificación como leída.
     */
    public function actionMarcarLeida($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $notificacion = Notificacion::findOne($id);
        if ($notificacion && $notificacion->usuario_id == Yii::$app->user->identity->id) {
            $notificacion->leida = 1;
            if ($notificacion->save()) {
                return ['success' => true];
            }
        }
        
        return ['success' => false];
    }

    /**
     * Contactar al coordinador de becas.
     */
    public function actionContactarCoordinador()
    {
        $model = new Notificacion();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            // Obtener ID del coordinador (usuarios con rol_id = 1)
            $coordinador = User::findOne(['rol_id' => 1]);
            
            if ($coordinador) {
                // Buscar una solicitud del estudiante (o usar la más reciente)
                $solicitudEstudiante = SolicitudBeca::find()
                    ->where(['estudiante_id' => Yii::$app->user->identity->id])
                    ->orderBy(['fecha_solicitud' => SORT_DESC])
                    ->one();
                
                // Si tiene solicitud, usar ese ID. Si no, usar NULL.
                $model->solicitud_id = $solicitudEstudiante ? $solicitudEstudiante->id : null;
                $model->usuario_id = $coordinador->id;
                $model->tipo = 'mensaje_estudiante';
                $model->fecha_creacion = date('Y-m-d H:i:s');
                $model->leida = 0;

                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', '✓ Mensaje enviado al Departamento de Becas correctamente.');
                    return $this->redirect(['solicitudes']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'No se encontró el coordinador de becas.');
            }
        }

        return $this->render('contactar-coordinador', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
