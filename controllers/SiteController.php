<?php


namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc     
     */    

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
           return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            $usuario=$model->getUser();            
            Yii::$app->session->set('rol', $usuario->Rol);
            Yii::$app->session->set('id',$usuario->id);

            $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            $fecha_entrada = strtotime($usuario->fecha_caducidad);
            echo $fecha_actual;
            echo $fecha_entrada;
            if($fecha_actual > $fecha_entrada){

                        $mensaje="mensaje";
                        setcookie("mensaje","Su cuenta ha expirado. Por favor colocarse en contacto con el administrador");
                         Yii::$app->session->set('error',$mensaje);
                        $msj=Yii::$app->session->get('error');
    
                         echo $msj;

                          //$model->addError($pass, 'Incorrect username or password.');
                    Yii::$app->user->logout();

                    return $this->redirect('/site/login',302);

            } else{
                     return $this->redirect('/gaceta/index',302);

            }

            
          // return $this->goBack();
        }
     return $this->render('login', [
           'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

       // return $this->goHome();
        return $this->redirect('/gaceta/index',302); 
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
