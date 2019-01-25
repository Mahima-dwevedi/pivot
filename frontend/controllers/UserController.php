<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\web\View;

/**
 * Class UserController
 * @package frontend\controllers
 */
class UserController extends \yii\web\Controller
{
	/**
	 * call to index action
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * call to dashboard action
	 * @return mixed
	 */
	public function actionDashboard()
	{
		if (!\Yii::$app->session->get('userId')) {
			return $this->redirect(Yii::$app->urlManager->createUrl("site/index"), true);
		}

		$model = new User;
		$userDetails = $model->findByUsername(Yii::$app->session->get('userEmail'));
		return $this->render('dashboard', [
			'model' => $userDetails,
		]);
	}

}
