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
    $searchModel = new \app\models\SolicitudBecaSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $query = SolicitudBeca::find()
        ->joinWith('beca')       // para poder filtrar y ordenar por nombre de beca
        ->with('estudiante');    // evitar consultas adicionales para estudiante

    $request = Yii::$app->request;

    // Filtrar por estatus si viene en GET
    $estatus = $request->get('estatus', null);
    if ($estatus !== null) {
        $query->andWhere(['estatus' => $estatus]);
    }

    // Filtrar por nombre de beca si viene en GET
    $becaNombre = $request->get('becaNombre', null);
    if ($becaNombre !== null) {
        $query->andFilterWhere(['like', 'beca.nombre', $becaNombre]);
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
                'becaNombre' => [
                    'asc' => ['beca.nombre' => SORT_ASC],
                    'desc' => ['beca.nombre' => SORT_DESC],
                ],
            ],
        ],
    ]);

    return $this->render('solicitudes', [
        'dataProvider' => $dataProvider,
        'estatus' => $estatus,
        'becaNombre' => $becaNombre,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}


public function actionAprobar($id)
{
    $solicitud = SolicitudBeca::findOne($id);
    if ($solicitud) {
        $solicitud->estatus = 'Aprobada';
        $solicitud->save(false);
        Yii::$app->session->setFlash('success', 'Solicitud aprobada correctamente.');
    }
    return $this->redirect(['solicitudes']);
}

    public function actionRechazar($id)
    {
        $solicitud = SolicitudBeca::findOne($id);
        if ($solicitud) {
            $solicitud->estatus = 'Rechazada';
            $solicitud->save(false);
            Yii::$app->session->setFlash('warning', 'Solicitud rechazada.');
        }
        return $this->redirect(['solicitudes']);
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
