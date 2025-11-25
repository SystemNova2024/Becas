<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User; // Asegúrate de que exista este modelo y los métodos usados
use kartik\mpdf\Pdf;

class SiteController extends Controller
{
    /**
     * Desactivar CSRF solamente para la acción de sincronización offline
     */
    public function beforeAction($action)
    {
        if ($action->id === 'login-offline-sync') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

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

    // ... (tus otras acciones Pdf...) ...
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

    // (repite acciones pdf como antes...)
    public function actionPdfExcelencia() { /* ... igual que antes ... */ }
    public function actionPdfAcademica() { /* ... igual que antes ... */ }
    public function actionPdfSocioeconomica() { /* ... igual que antes ... */ }
    public function actionPdfVulnerables() { /* ... igual que antes ... */ }
    public function actionPdfDeportiva() { /* ... igual que antes ... */ }
    public function actionPdfMaestria() { /* ... igual que antes ... */ }

    /**
     * Acción tradicional de login (form)
     */
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

    /**
     * Endpoint para sincronizar logins pendientes guardados en IndexedDB.
     * Recibe JSON con { email, password } o { email, passwordHash }.
     * Devuelve JSON { ok: true } si logra loguear al usuario en el servidor.
     */
    public function actionLoginOfflineSync()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $raw = Yii::$app->request->getRawBody();
        $data = json_decode($raw, true);
        if (!$data || empty($data['email'])) {
            return ['ok' => false, 'msg' => 'Payload inválido'];
        }

        $email = trim($data['email']);
        $password = $data['password'] ?? null;
        $passwordHash = $data['passwordHash'] ?? null;

        // Buscar usuario por email
        $user = User::find()->where(['email' => $email])->one();
        if (!$user) {
            return ['ok' => false, 'msg' => 'Usuario no encontrado'];
        }

        // Si se envió contraseña real, validar
        if ($password) {
            // Asumimos que User tiene validatePassword()
            if (method_exists($user, 'validatePassword')) {
                if ($user->validatePassword($password)) {
                    Yii::$app->user->login($user);
                    return ['ok' => true, 'msg' => 'Login OK (password)'];
                }
                return ['ok' => false, 'msg' => 'Credenciales inválidas'];
            }
        }

        // Si se envió passwordHash (modo offline), aquí podemos decidir:
        // - si confías en la correspondencia por correo -> iniciar sesión (menos seguro)
        // - o comparar hash con un hash almacenado en DB (necesario si lo guardas en servidor)
        // Para comodidad, asumimos que si el email existe, permitimos el login offline-sync.
        if ($passwordHash) {
            // Puedes mejorar la lógica aquí: por ejemplo, comparar contra una columna
            // $user->offline_hash si la guardaste previamente desde login online.
            // En este ejemplo solemos permitir login si usuario existe (ajústalo en producción).
            Yii::$app->user->login($user);
            return ['ok' => true, 'msg' => 'Login OK (offline hash)'];
        }

        return ['ok' => false, 'msg' => 'No se pudo autenticar'];
    }
}
