<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use kartik\mpdf\Pdf;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
'access' => [
    'class' => AccessControl::class,
    'only' => ['logout', 'becas', 'dashboard', 'aprobar', 'solicitudes'],
    'rules' => [
        [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
        ],
        [
            'actions' => ['becas'],
            'allow' => true,
            'roles' => ['Estudiante', 'Coordinador de becas'],
        ],
        [
            'actions' => ['dashboard', 'aprobar', 'solicitudes'],
            'allow' => true,
            'roles' => ['@'],
        ],
    ],
],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBecas()
    {
        return $this->render('becas');
    }

    public function actionPdfAlimenticia()
    {
        $content = $this->renderPartial('pdf-beca-alimenticia');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Alimenticia - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfExcelencia()
    {
        $content = $this->renderPartial('pdf-beca-excelencia');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca de Excelencia - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfAcademica()
    {
        $content = $this->renderPartial('pdf-beca-academica');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Académica - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfSocioeconomica()
    {
        $content = $this->renderPartial('pdf-beca-socioeconomica');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Socioeconómica - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfVulnerables()
    {
        $content = $this->renderPartial('pdf-beca-vulnerables');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Grupos Vulnerables - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfDeportiva()
    {
        $content = $this->renderPartial('pdf-beca-deportiva');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Deportiva - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionPdfMaestria()
    {
        $content = $this->renderPartial('pdf-beca-maestria');
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Beca Maestría - UTH'],
            'methods' => [
                'SetHeader' => ['Universidad Tecnológica de Huejotzingo'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

  public function actionLogin()
{
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {

        $rolId = Yii::$app->user->identity->rol_id;

        if ($rolId == 3) {
            return $this->redirect(['estudiante/dashboard']);
        } elseif ($rolId == 1) {
            return $this->redirect(['coordinador/dashboard']);
        } elseif ($rolId == 5) {  // 👈 AQUI AGREGA EL ROL DEL DOCENTE
            return $this->redirect(['docente/dashboard']);
        } else {
            return $this->goHome();
        }
    }

    $model->password = '';
    return $this->render('login', [
        'model' => $model,
    ]);
}

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
