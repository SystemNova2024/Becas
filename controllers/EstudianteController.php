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
        $hoy = date('Y-m-d');

        $becas = Beca::find()
            ->where(['<=', 'fecha_inicio', $hoy])
            ->andWhere(['>=', 'fecha_fin', $hoy])
            ->orderBy(['fecha_inicio' => SORT_DESC])
            ->all();

        return $this->render('becas', [
            'becas' => $becas
        ]);
    }

    /**
     * Muestra becas institucionales (todas las registradas en BD).
     */
    public function actionBecasInstitucionales()
    {
        $becas = Beca::find()
            ->orderBy(['fecha_inicio' => SORT_DESC])
            ->all();

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
        $beca = Beca::findOne($id);
        if (!$beca) {
            throw new NotFoundHttpException('Beca no encontrada.');
        }

        $solicitud = new SolicitudBeca();
        $solicitud->beca_id = $id;
        $solicitud->estudiante_id = Yii::$app->user->id;
        $solicitud->fecha_solicitud = date('Y-m-d');
        $solicitud->estatus = 'pendiente';
        $solicitud->documentos_completos = 0;

        if ($solicitud->load(Yii::$app->request->post()) && $solicitud->save()) {

            if (!$beca->requiere_justificacion) {
                $solicitud->observaciones = null;
                $solicitud->save(false);
            }

            $archivos = UploadedFile::getInstances($solicitud, 'archivo');

            $rutaCarpeta = Yii::getAlias('@webroot/uploads/solicitudes/');
            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0775, true);
            }

            foreach ($archivos as $archivo) {
                $nombreArchivo = uniqid() . '.' . $archivo->extension;
                $rutaCompleta = $rutaCarpeta . $nombreArchivo;

                if ($archivo->saveAs($rutaCompleta)) {
                    $documento = new DocumentoBeca();
                    $documento->solicitud_id = $solicitud->id;
                    $documento->nombre_archivo = $archivo->name;
                    $documento->tipo_documento = $archivo->type;
                    $documento->ruta_archivo = '/uploads/solicitudes/' . $nombreArchivo;
                    $documento->save(false);
                }
            }

            Yii::$app->session->setFlash('success', 'Solicitud y documentos enviados correctamente.');
            return $this->redirect(['solicitudes']);
        }

        return $this->render('solicitar', [
            'beca' => $beca,
            'solicitud' => $solicitud,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
