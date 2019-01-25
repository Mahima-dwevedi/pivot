<?php

namespace frontend\controllers;


use app\models\faq;
use app\models\searchfaq;
use frontend\models\ContactForm;
use frontend\models\verifyphone;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;


/**
 * Class PageController
 * @package frontend\controllers
 */
class PageController extends Controller
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

						'actions' => ['signup', 'login', 'faq', 'signup-verify'],
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
					'logout' => ['post', 'get'],
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
	 * @param $slug
	 * @return mixed
	 */
	public function actionView($slug)
	{
		if ($slug == '') {
			return $this->render('index');
		} else {
			$varPageData = \app\models\Cms::find()->where('slug = :slug', ['slug' => $slug])->all();
			$this->layout = 'main';
			if ($varPageData == null) {
				throw new CHttpException(404, 'The specified Page cannot be found.');
			} else {
				// # Page Related Data
				return $this->render('view', array('varPageData' => $varPageData));
			}
		}
	}
}
