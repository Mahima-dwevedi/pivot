<?php
namespace frontend\controllers;


use Yii;
use common\models\User;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\verifyphone;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\faq;
use app\models\searchfaq;
use frontend\models\Contact;
use yii\data\Pagination;


/**
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends Controller
{
	/**
	 * setting behaviours here
	 * @return array
	 */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [''],
                'rules' => [
                    [
                        'actions' => ['signup','login','faq','signup-verify'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

	/**
	 * @return array
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
             'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

	/**
	 * call to index action
	 * @return mixed
	 */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
