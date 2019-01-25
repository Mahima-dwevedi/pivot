<?php

namespace backend\controllers;

use Yii;
use app\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Admin;
use backend\models\Farm;
use backend\models\Field;
use backend\models\Equipment;
use backend\models\EquipmentNotification;
use yii\web\Cookie;

/**
 * Class SiteController
 * @package backend\controllers
 */
class SiteController extends Controller {

	/**
	 * @return array
	 */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'recovery', 'reset-password', 'logout', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'reset-password', 'changepassword', 'editprofile', 'deactivate', 'activate', 'createaccount', 'attend'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

	/**
	 * @return array
	 */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

	/**
	 * call index page
	 * @return mixed
	 */
    public function actionIndex() {
        if (\Yii::$app->user->id) {
            $modelAdmin = $this->findModel(Yii::$app->user->id);
            $searchModel = new EquipmentNotification();
            $dataProvider = $searchModel->getFormNotification();
            $model = Farm::findOne(Farm::getDetails());
            if ($modelAdmin->user_type === 'super-admin'){
                return $this->render('index', ['model' => $model]);
            } elseif ($modelAdmin->user_type === 'farm-admin') {
                $modelField = Field::countField();

                $modelEquipment = Equipment::countEquipment();

				// layout for farm-admin
                $this->layout = 'mainsubadmin';
                return $this->render('indexFarm', [
                            'model' => $model, 'modelField' => $modelField, 'modelEquipment' => $modelEquipment, 'dataProvider' => $dataProvider
                ]);
            } elseif ($modelAdmin->user_type === 'field-admin') {
				// layout for farm-admin
                $this->layout = 'mainfieldadmin';
                return $this->render('indexField', ['model' => $model, 'dataProvider' => $dataProvider]);
            }
        }
    }

	/**
	 * Call login page
	 * @return mixed
	 */
    public function actionLogin() {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // load login form
        $model = new LoginForm();
        $cookies = Yii::$app->request->cookies;
        $cookies1 = Yii::$app->request->cookies;
        if ($cookies->has('email')) {
            $username = $cookies->getValue('email');
            $password = $cookies1->getValue('password');
            $remember = 1;
        } else {

            $username = "";
            $password = "";
            $remember = "";
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $postdata = Yii::$app->request->post();
            $username = $postdata['LoginForm']['email'];
            $password = $postdata['LoginForm']['password'];
            $rememberMe = $postdata['LoginForm']['rememberMe'];

            // set cookies if remember me checked
            if($rememberMe == '1')
            {
                $cookies = Yii::$app->response->cookies;
                $cookies->remove('email');
                $cookies->remove('password');

                $cookies->add(new Cookie([
                    'name' => 'email',
                    'value' => $username,
                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                ]));

                $cookies->add(new Cookie([
                    'name' => 'password',
                    'value' => $password,
                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                ]));
            }    

            $modelAdmin = $this->findModel(Yii::$app->user->id);
            if($modelAdmin->user_type === 'farm-admin'){
               return $this->redirect(['list-view/index']);
            }
            else{
                return $this->goBack();
            }
        } else {
            return $this->render('login', [
                        'model' => $model, 'username' => $username, 'password' => $password,
                        'remember' => $remember,
            ]);
        }
    }

	/**
	 * login action
	 * @return mixed
	 */
    public function actionLogout() {
        $model = new LoginForm();
        $model->lastLogin();
        Yii::$app->user->logout();
        return $this->goHome();
    }

	/**
	 * recover link
	 * @return mixed
	 */
    public function actionRecovery() {
		// load password reset form
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'An email with the reset password link has been sent. Go to your email and click on the link.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

	/**
	 * get reset request form
	 * @return mixed
	 */
    public function actionRequestPasswordReset() {
    	//load password request form
        $model = new PasswordResetRequestForm();
        //validate model
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

	/**
	 * reset password from here
	 * @param $token
	 * @return mixed
	 */
    public function actionResetPassword($token) {
        try {
        	// load reset password form
            $model = new ResetPasswordForm($token);
            $model->scenario = 'reset';
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Your password has been reset successfully.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Edit profile of superadmin & farm admin
     * @return mixed
     */
    public function actionEditProfile() {
        $model = $this->findModel(Yii::$app->user->id);
        $model->scenario = 'editprofile';
        // check user type for super admin
        if ($model->user_type === 'super-admin') {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('editProfileSuccess', true);
                    return $this->redirect('index', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('editprofile', [
                            'model' => $model,
                ]);
            }
        } elseif ($model->user_type === 'farm-admin') { // check user type for form admin
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('editProfileSuccess', true);
                    $this->layout = 'mainsubadmin';
                    return $this->redirect('index', [
                                'model' => $model,
                    ]);
                }
            } else {
                $this->layout = 'mainsubadmin';
                return $this->render('editprofile', [
                            'model' => $model,
                ]);
            }
        } elseif ($model->user_type === 'field-admin') {  // check user type for field admin
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('editProfileSuccess', true);
                    $this->layout = 'mainfieldadmin';
                    return $this->redirect('index', [
                                'model' => $model,
                    ]);
                }
            } else {
                $this->layout = 'mainfieldadmin';
                return $this->render('editprofile', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Change PASSWORD FOR SUPER-ADMIN && FARM-ADMIN
     * @return mixed
     */
    public function actionChangePassword() {
        $model = $this->findModel(Yii::$app->user->id);
        $model->scenario = 'changepassword';
		// check user type for super admin
        if ($model->user_type === 'super-admin') {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $arrPost = Yii::$app->request->post('Admin');
                // validate current password
                $validCurrentPas = $model->validateCurrentPassword(Yii::$app->user->id, $arrPost['current_password']);
                if (isset($validCurrentPas)) {
                    if ($insertData = $model->updateAdmintable($arrPost)) {
                        Yii::$app->user->logout();
                        Yii::$app->getSession()->setFlash('success', 'Your password has been changed successfully, login with new password');
                        return $this->redirect(["/site/login"]);
                    }
                } else {
                    return $this->render('changepassword', array('model' => $model));
                }
            } else {
                return $this->render('changepassword', array('model' => $model));
            }
        } elseif ($model->user_type === 'farm-admin') { // check user type for form admin
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $arrPost = Yii::$app->request->post('Admin');
                $validCurrentPas = $model->validateCurrentPassword(Yii::$app->user->id, $arrPost['current_password']);
                if (isset($validCurrentPas)) {
                    if ($insertData = $model->updateAdmintable($arrPost)) {
                        Yii::$app->user->logout();
                        Yii::$app->getSession()->setFlash('success', 'Your password has been changed successfully, login with new password');
                        return $this->redirect(["/site/login"]);
                    }
                } else {
                    $this->layout = 'mainsubadmin';
                    return $this->render('changepassword', array('model' => $model));
                }
            } else {
                $this->layout = 'mainsubadmin';
                return $this->render('changepassword', array('model' => $model));
            }
        } elseif ($model->user_type === 'field-admin') { // check user type for field admin
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $arrPost = Yii::$app->request->post('Admin');
                $validCurrentPas = $model->validateCurrentPassword(Yii::$app->user->id, $arrPost['current_password']);
                if (isset($validCurrentPas)) {
                	//update password to admin table
                    if ($insertData = $model->updateAdmintable($arrPost)) {
                        Yii::$app->user->logout();
                        Yii::$app->getSession()->setFlash('success', 'Your password has been changed successfully, login with new password');
                        return $this->redirect(["/site/login"]);
                    }
                } else {
                    $this->layout = 'mainfieldadmin';
                    return $this->render('changepassword', array('model' => $model));
                }
            } else {
                $this->layout = 'mainfieldadmin';
                return $this->render('changepassword', array('model' => $model));
            }
        }
    }

	/**
	 * deactivate user
	 * @param $id
	 * @return mixed
	 */
    public function actionDeactivate($id) {

        if (!isset(Yii::$app->user->id)) {
            return $this->redirect(['/site/login']);
        } elseif (Yii::$app->user->identity->user_type == 'farm-admin') {
            $model = $this->findModel($id);
            $model->AdminLastLogin = date('Y-m-d H:i:s');
            $model->created_at = date('Y-m-d H:i:s');
            $model->status = 0;

            if ($model->save()) {
                Yii::$app->session->setFlash('delete', true);
                return $this->redirect(['farm/manage']);
            }
        }
    }

	/**
	 * activate user
	 * @param $id
	 * @return mixed
	 */
    public function actionActivate($id) {

        if (!isset(Yii::$app->user->id)) {
            return $this->redirect(['/site/login']);
        } elseif (Yii::$app->user->identity->user_type == 'farm-admin') {

            $model = $this->findModel($id);

            $model->AdminLastLogin = date('Y-m-d H:i:s');
            $model->created_at = date('Y-m-d H:i:s');
            $model->status = 10;
            if ($model->save()) {
                Yii::$app->session->setFlash('active', true);
                return $this->redirect(['farm/manage']);
            }
        }
    }

	/**
	 * get admin model
	 * @param $id
	 * @return mixed
	 */
    protected function findModel($id) {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
