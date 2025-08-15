<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\models\SolicitudBeca;
use app\models\UploadForm;
use app\models\User;

class DocenteController extends Controller
{
    public $layout = 'docente';

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->rol_id != 5) {
            return $this->redirect(['site/login']);
        }
        return parent::beforeAction($action);
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionCalendario()
    {
        return $this->render('calendario');
    }

    public function actionEstudiantes()
    {
        $estudiantes = User::find()->where(['rol_id' => 3, 'activo' => 1])->all();
        
        return $this->render('estudiantes', [
            'estudiantes' => $estudiantes,
        ]);
    }

    public function actionEvaluaciones()
    {
        $solicitudes = SolicitudBeca::find()->where(['estatus' => 'Pendiente'])->all();

        return $this->render('evaluaciones', [
            'solicitudes' => $solicitudes,
        ]);
    }

    public function actionVerSolicitud($id)
    {
        $solicitud = SolicitudBeca::findOne($id);

        if (!$solicitud) {
            throw new NotFoundHttpException('Solicitud no encontrada.');
        }

        return $this->render('ver-solicitud', [
            'solicitud' => $solicitud,
        ]);
    }

    public function actionEvaluar($id)
    {
        $solicitud = SolicitudBeca::findOne($id);

        if (!$solicitud) {
            throw new NotFoundHttpException('Solicitud no encontrada.');
        }

        if (Yii::$app->request->isPost) {
            $nuevoEstatus = Yii::$app->request->post('estatus');
            $solicitud->estatus = $nuevoEstatus;

            if ($solicitud->save()) {
                Yii::$app->session->setFlash('success', '✅ Evaluación guardada.');
                return $this->redirect(['evaluaciones']);
            } else {
                Yii::$app->session->setFlash('error', '❌ Error al guardar.');
            }
        }

        return $this->render('evaluar', [
            'solicitud' => $solicitud,
        ]);
    }

    public function actionPerfil()
    {
        return $this->render('perfil');
    }

    public function actionSubirCalificacion()
    {
        $model = new UploadForm();
        $estudiantes = User::find()->where(['rol_id' => 3, 'activo' => 1])->all();

        if (Yii::$app->request->isPost) {
            $model->archivo = UploadedFile::getInstance($model, 'archivo');
            $model->load(Yii::$app->request->post());

            if ($model->upload()) {
                Yii::$app->session->setFlash('success', '✅ Calificación subida correctamente para el estudiante seleccionado.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', '❌ Error al subir la calificación.');
            }
        }

        return $this->render('subir-calificacion', [
            'model' => $model,
            'estudiantes' => $estudiantes,
        ]);
    }
}
