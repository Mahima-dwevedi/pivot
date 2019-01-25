<?php

namespace frontend\controllers;

use Yii;
use yii\web\View;
use common\models\User;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
     public function actionDashboard()
    {
         if(!\Yii::$app->session->get('userId'))
         {
             return $this->redirect(Yii::$app->urlManager->createUrl("site/index"), true);
         }
         $model = new User;
        
         $userDetails = $model->findByUsername(Yii::$app->session->get('userEmail'));
         
       return $this->render('dashboard', [
            'model' => $userDetails,
        ]);
         
         
         //$this->title = 'My page title';
       // return $this->render('dashboard');
    }

}
