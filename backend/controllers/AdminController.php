<?php

namespace backend\controllers;

use yii\web\Controller;

class AdminController extends Controller
{
	/**
	 * setting up behaviours to actions
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'only' => ['addBasic'],
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
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
	 * call index view
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * call login view
	 * @return mixed
	 */
	public function actionLogin()
	{

		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		//load login form
		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logout
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}
}
