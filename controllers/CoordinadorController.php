<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SolicitudBeca;
use app\models\Beca;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use app\models\DocumentoBeca;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CoordinadorController extends Controller
{
    public $layout = 'coordinador'; // Layout específico para Coordinador
    
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['dashboard', 'aprobar', 'rechazar', 'solicitudes', 'logout'],
            'rules' => [
                [
                    'actions' => ['dashboard', 'aprobar', 'rechazar', 'solicitudes'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                return Yii::$app->response->redirect(['site/login']);
            },
        ],
        'verbs' => [
            'class' => VerbFilter::class,
            'actions' => [
                'logout' => YII_ENV_TEST ? ['GET', 'POST'] : ['POST'],
            ],
        ],
    ];
}



public function actionDashboard()
{
    return $this->render('dashboard');
}



public function actionSolicitudes()
{
    $query = SolicitudBeca::find()
        ->with('estudiante');  // Cargar estudiante para evitar N+1 queries

    $request = Yii::$app->request;

    // Filtrar por estatus si viene en GET
    $estatus = $request->get('estatus', null);
    if ($estatus !== null) {
        $query->andWhere(['estatus' => $estatus]);
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => ['pageSize' => 10],
        'sort' => [
            'defaultOrder' => ['fecha_solicitud' => SORT_DESC],
            'attributes' => [
                'fecha_solicitud',
                'estatus',
                'estudiante_id',
                'beca_id',
            ],
        ],
    ]);

    return $this->render('solicitudes', [
        'dataProvider' => $dataProvider,
        'estatus' => $estatus,
    ]);
}


    public function actionVerSolicitud($id)
    {
        $solicitud = SolicitudBeca::findOne($id);
        if (!$solicitud) {
            throw new \yii\web\NotFoundHttpException('La solicitud no existe.');
        }

        return $this->render('ver-solicitud', [
            'solicitud' => $solicitud,
        ]);
    }

    public function actionAprobar($id)
    {
        $solicitud = SolicitudBeca::findOne($id);
        if ($solicitud) {
            $solicitud->estatus = 'Aprobada';
            $solicitud->save(false);
            
            // Enviar notificación automática al estudiante
            $notificacion = new \app\models\Notificacion();
            $notificacion->solicitud_id = $id;
            $notificacion->usuario_id = $solicitud->estudiante_id;
            $notificacion->mensaje = "✓ ¡Tu solicitud de beca ha sido APROBADA! Puedes ver los detalles en 'Mis Solicitudes'.";
            $notificacion->tipo = 'aprobacion';
            $notificacion->fecha_creacion = date('Y-m-d H:i:s');
            $notificacion->leida = 0;
            $notificacion->save(false);
            
            Yii::$app->session->setFlash('success', '✓ Solicitud aprobada y notificación enviada al estudiante.');
        }
        return $this->redirect(['solicitudes']);
    }

    public function actionRechazar($id)
    {
        $solicitud = SolicitudBeca::findOne($id);
        if ($solicitud) {
            $solicitud->estatus = 'Rechazada';
            $solicitud->save(false);
            
            // Enviar notificación automática al estudiante
            $notificacion = new \app\models\Notificacion();
            $notificacion->solicitud_id = $id;
            $notificacion->usuario_id = $solicitud->estudiante_id;
            $notificacion->mensaje = "⚠ Tu solicitud de beca ha sido RECHAZADA. Puedes ver más detalles en 'Mis Solicitudes'.";
            $notificacion->tipo = 'rechazo';
            $notificacion->fecha_creacion = date('Y-m-d H:i:s');
            $notificacion->leida = 0;
            $notificacion->save(false);
            
            Yii::$app->session->setFlash('warning', '⚠ Solicitud rechazada y notificación enviada.');
        }
        return $this->redirect(['solicitudes']);
    }

    public function actionEnviarNotificacion($id)
    {
        $solicitud = SolicitudBeca::findOne($id);
        
        if (!$solicitud) {
            throw new \yii\web\NotFoundHttpException('La solicitud no existe.');
        }

        $model = new \app\models\Notificacion();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->solicitud_id = $id;
            $model->usuario_id = $solicitud->estudiante_id;
            $model->tipo = 'mensaje_coordinador';
            $model->fecha_creacion = date('Y-m-d H:i:s');
            $model->leida = 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '✓ Notificación enviada al estudiante correctamente.');
                return $this->redirect(['solicitudes']);
            }
        }

        return $this->render('enviar-notificacion', [
            'solicitud' => $solicitud,
            'model' => $model,
        ]);
    }

public function actionVerDocumentos($id)
{
    $model = SolicitudBeca::findOne($id);
    $documentos = DocumentoBeca::find()
        ->where(['solicitud_id' => $id])
        ->all();

    return $this->render('ver-documentos', [
        'model' => $model,
        'documentos' => $documentos
    ]);
}


public function actionBecas()
{
    $becas = Beca::find()->orderBy(['fecha_inicio' => SORT_DESC])->all();
    return $this->render('becas', ['becas' => $becas]);
}


public function actionCrearBeca()
{
    $model = new Beca();

    if ($model->load(Yii::$app->request->post())) {
        $archivo = UploadedFile::getInstance($model, 'archivo_convocatoria');

        if ($archivo) {
            $nombreArchivo = 'convocatoria_' . time() . '.' . $archivo->extension;
            $ruta = Yii::getAlias('@webroot/uploads/convocatorias/') . $nombreArchivo;
            $archivo->saveAs($ruta);
            $model->archivo_convocatoria = 'uploads/convocatorias/' . $nombreArchivo;
        }

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Beca registrada correctamente.');
            return $this->redirect(['becas']);
        }
    }

    return $this->render('crear-beca', ['model' => $model]);
}
public function actionActualizarBeca($id)
{
    $model = Beca::findOne($id);
    if (!$model) {
        throw new NotFoundHttpException('La beca no existe.');
    }

    if ($model->load(Yii::$app->request->post())) {
        $archivo = UploadedFile::getInstance($model, 'archivo_convocatoria');
        if ($archivo) {
            $nombreArchivo = 'convocatoria_' . time() . '.' . $archivo->extension;
            $ruta = Yii::getAlias('@webroot/uploads/convocatorias/') . $nombreArchivo;
            $archivo->saveAs($ruta);
            $model->archivo_convocatoria = 'uploads/convocatorias/' . $nombreArchivo;
        }
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Beca actualizada correctamente.');
            return $this->redirect(['becas']);
        }
    }

    return $this->render('actualizar-beca', ['model' => $model]);
}

public function actionEliminarBeca($id)
{
    $model = Beca::findOne($id);
    if (!$model) {
        throw new NotFoundHttpException('La beca no existe.');
    }

    // Elimina archivo físico si existe
    if ($model->archivo_convocatoria && file_exists(Yii::getAlias('@webroot/') . $model->archivo_convocatoria)) {
        @unlink(Yii::getAlias('@webroot/') . $model->archivo_convocatoria);
    }

    $model->delete();

    Yii::$app->session->setFlash('success', 'Beca eliminada correctamente.');
    return $this->redirect(['becas']);
}
    public function actionReportes()
    {
        return $this->render('reportes');
    }

    public function actionSoporte()
    {
        return $this->render('soporte');
    }


public function actionLogout()
{
    Yii::$app->user->logout();
    return $this->redirect(Yii::$app->homeUrl);
}


}
