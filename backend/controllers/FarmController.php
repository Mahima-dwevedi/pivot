<?php

namespace backend\controllers;

use app\models\Admin;
use backend\models\Farm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Class FarmController
 * @package backend\controllers
 */
class FarmController extends Controller
{

	/**
	 * Lists all Farm models.
	 * @return mixed
	 */
	public function actionIndex()
	{

		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} elseif (Yii::$app->user->identity->user_type == 'super-admin') {

			$searchModel = new Farm();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
	}

	/**
	 * Displays a single Farm model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{

		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} elseif (Yii::$app->user->identity->user_type == 'super-admin') {
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		} elseif (Yii::$app->user->identity->user_type == 'farm-admin') {
			$this->layout = 'mainsubadmin';
			return $this->render('view', [
				'model' => $this->findModelfarm($id),
			]);
		}
	}

	/**
	 *  This function  will give Farm Model.
	 * @return mixed
	 */
	protected function findModel($id)
	{
		if (($model = Farm::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * get form model
	 * @param $id
	 * @return mixed
	 */
	protected function findModelFarm($id)
	{

		if (($model = Farm::find()->where(['fkAdminID' => $id])->one()) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * Creates a new Farm model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} elseif (Yii::$app->user->identity->user_type == 'super-admin') {
			// load form and admin model
			$model = new Farm();
			$modelAdmin = new Admin();
			$modelAdmin->scenario = 'createfarm';
			$model->scenario = 'create';
			$modelAdmin->created_at = date('Y-m-d H:i:s');
			$modelAdmin->user_type = 'farm-admin';
			$model->load(Yii::$app->request->post());
			if ($modelAdmin->load(Yii::$app->request->post()) && $modelAdmin->validate()) {

				$password = $modelAdmin->password;
				$modelAdmin->password_hash = Yii::$app->security->generatePasswordHash($_POST['Admin']['password']);
				// validate model
				if ($model->validate()) {
					if ($modelAdmin->save()) {
						$primarykey = $modelAdmin->pkAdminID;
						$modelAdmin->fkUserID = Yii::$app->user->id;
						$modelAdmin->Adminlevel = 0;
						$modelAdmin->save();
					}

					$model->farmAddDate = date('Y-m-d H:i:s');
					$model->farmUpdateDate = date('Y-m-d H:i:s');
					$model->fkAdminID = $primarykey;
					$model->farmLicenseStartDate = $this->changeDateFormat($model->farmLicenseStartDate);
					$model->farmLicenseExpireDate = $this->changeDateFormat($model->farmLicenseExpireDate);
					// save form model
					if ($model->save()) {
						$modelAdmin->Name = $model->farmName;
						$modelAdmin->Address = $model->farmAddress1;
						$modelAdmin->save();
						Mail::sendMail($modelAdmin, $password);
						Yii::$app->session->setFlash('create', true);
						return $this->redirect(['index']);
					}
				} else {
					return $this->render('create', [
						'model' => $model,
						'modelAdmin' => $modelAdmin,
					]);
				}
			} else {
				return $this->render('create', [
					'model' => $model,
					'modelAdmin' => $modelAdmin,
				]);
			}
		}
	}

	/**
	 * @param $date
	 * @return string
	 */
	public function changeDateFormat($date)
	{

		$dateArr = explode('-', $date);
		$newDate = $dateArr[2] . '-' . $dateArr[0] . '-' . $dateArr[1];
		return $newDate;
	}

	/**
	 *  create  Farm model as well as admin model.
	 * If creation  is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreatefarm()
	{

		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} elseif (Yii::$app->user->identity->user_type == 'farm-admin' && Yii::$app->user->identity->Adminlevel == '0') {
			$model = new Farm();
			$modelAdmin = new Admin();
			$modelAdmin->scenario = 'createfarm';
			$model->scenario = 'createaccount';
			$modelAdmin->created_at = date('Y-m-d H:i:s');
			$modelAdmin->user_type = 'farm-admin';
			$model->load(Yii::$app->request->post());
			if ($modelAdmin->load(Yii::$app->request->post()) && $modelAdmin->validate()) {
				$password = $modelAdmin->password;
				$modelAdmin->password_hash = Yii::$app->security->generatePasswordHash($_POST['Admin']['password']);


				if ($model->validate()) {

					if ($modelAdmin->save()) {
						$primarykey = $modelAdmin->pkAdminID;
						$modelAdmin->fkUserID = Yii::$app->user->id;
						$modelAdmin->save();
					}


					$model->farmAddDate = date('Y-m-d H:i:s');
					$model->farmUpdateDate = date('Y-m-d H:i:s');
					$model->farmLicenseStartDate = $this->changeDateFormat($model->farmLicenseStartDate);
					$model->farmLicenseExpireDate = $this->changeDateFormat($model->farmLicenseExpireDate);
					$model->fkAdminID = $primarykey;
					// save form model
					if ($model->save()) {
						$modelAdmin->Name = $model->farmName;
						$modelAdmin->Address = $model->farmAddress1;
						$modelAdmin->Adminlevel = 1;
						$modelAdmin->save();
						$this->layout = 'mainsubadmin';

						\common\models\Mail::sendMail($modelAdmin, $password);
						Yii::$app->session->setFlash('create', true);
						return $this->redirect(['farm/manage']);
					}
				} else {
					$this->layout = 'mainsubadmin';
					return $this->render('createaccount', [
						'model' => $model,
						'modelAdmin' => $modelAdmin,
					]);
				}
			} else {
				$this->layout = 'mainsubadmin';
				return $this->render('createaccount', [
					'model' => $model,
					'modelAdmin' => $modelAdmin,
				]);
			}
		}
	}

	/**
	 *  Update  Farm model as well as admin model.
	 * If updation  is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} elseif (Yii::$app->user->identity->user_type == 'super-admin') {
			$model = $this->findModel($id);
			$model->farmUpdateDate = date('Y-m-d H:i:s');
			$adminID = $model->fkAdminID;

			$modelAdmin = Admin::findOne(['pkAdminID' => $adminID]);
			$model->scenario = 'update';
			$modelAdmin->scenario = 'updatefarm';
			if (isset($_POST['Admin']['password']) && $_POST['Admin']['password'] != '') {

				$modelAdmin->password_hash = Yii::$app->security->generatePasswordHash($_POST['Admin']['password']);
			}
			if ($modelAdmin->load(Yii::$app->request->post()) && $modelAdmin->validate()) {

				$model->Name = $modelAdmin->Name;
				$modelAdmin->updated_at = date('Y-m-d H:i:s');
				$model->load(Yii::$app->request->post());
				if ($modelAdmin->save()) {

					if ($model->load(Yii::$app->request->post()) && $model->validate()) {

						$model->farmUpdateDate = date('Y-m-d H:i:s');
						$model->farmLicenseStartDate = $this->changeDateFormat($model->farmLicenseStartDate);
						$model->farmLicenseExpireDate = $this->changeDateFormat($model->farmLicenseExpireDate);

						$model->save();
					} else {
						return $this->render('update', [
							'model' => $model,
							'modelAdmin' => $modelAdmin,
						]);
					}

					if ($model->save()) {
						Yii::$app->session->setFlash('update', true);
						return $this->redirect(['index']);
					}
				} else {

					return $this->render('update', [
						'model' => $model,
						'modelAdmin' => $modelAdmin,
					]);
				}
			} else {
				return $this->render('update', [
					'model' => $model,
					'modelAdmin' => $modelAdmin,
				]);
			}
		}
	}

	/**
	 * Deletes an existing Farm model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 *  Update  Farm model as well as admin model.
	 * If updation  is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionUpdateFarmAdmin($id)
	{
		if (Yii::$app->user->identity->user_type == 'farm-admin' && Yii::$app->user->identity->Adminlevel == '0') {
			$model = $this->findModelfarm($id);

			$model->farmUpdateDate = date('Y-m-d H:i:s');
			$adminID = $model->fkAdminID;
			$modelAdmin = Admin::findOne(['pkAdminID' => $adminID]);
			$modelAdmin->scenario = 'updatefield';
			$modelAdmin->scenario = 'updatefarm';
			if (isset($_POST['Admin']['password']) && $_POST['Admin']['password'] != '') {

				$modelAdmin->password_hash = Yii::$app->security->generatePasswordHash($_POST['Admin']['password']);
			}
			if ($modelAdmin->load(Yii::$app->request->post()) && $modelAdmin->validate()) {

				$modelAdmin->updated_at = date('Y-m-d H:i:s');
				if ($model->save()) {
					if ($model->load(Yii::$app->request->post()) && $model->validate()) {
						$modelAdmin->Name = $model->farmName;
						$model->farmUpdateDate = date('Y-m-d H:i:s');
						$modelAdmin->save();
					} else {
						return $this->render('update', [
							'model' => $model,
							'modelAdmin' => $modelAdmin,
						]);
					}
					if ($model->save()) {
						Yii::$app->session->setFlash('update', true);
						return $this->redirect(['manage']);
					}
				} else {

					return $this->render('updateFarmAdmin', [
						'model' => $model,
						'modelAdmin' => $modelAdmin,
					]);
				}
			} else {
				return $this->render('updateFarmAdmin', [
					'model' => $model,
					'modelAdmin' => $modelAdmin,
				]);
			}
		}
	}

	/**
	 *  This action will deactivate the farm account
	 * After performing this action status will change from farm tabel as well s admin table.
	 * @return mixed
	 */
	public function actionDeactivate($id)
	{

		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} else {
			$model = $this->findModel($id);
			$adminID = $model->fkAdminID;
			$modelAdmin = Admin::findUserType($adminID);
			$model->farmUpdateDate = date('Y-m-d H:i:s');
			$model->farmLicenseStartDate = date('Y-m-d H:i:s');
			$model->farmInstrumentAllottedDate = date('Y-m-d H:i:s');
			$model->farmLicenseExpireDate = date('Y-m-d H:i:s');
			$model->farmStatus = 'Deactive';
			$modelAdmin->status = 0;
			$modelAdmin->save();
			if ($model->save()) {
				Yii::$app->session->setFlash('delete', true);
				return $this->redirect(['index']);
			}
		}
	}

	/**
	 *  This action will Multiple  deactivate or activate the farm account
	 * After performing this action status will change from farm tabel as well s admin table.
	 * @return mixed
	 */
	public function actionChangestatus()
	{
		$postArr = Yii::$app->request->post();
		$status = ($postArr['farmStatus'] == 'activate') ? 'Active' : 'Deactive';

		if (count($postArr['farmID']) > 0) {
			foreach ($postArr['farmID'] as $val) {
				$model = $this->findModel($val);
				$adminID = $model->fkAdminID;
				$modelAdmin = Admin::findUserType($adminID);
				if ($status == 'Active') {
					$modelAdmin->status = 10;
				} else {
					$modelAdmin->status = 0;
				}
				$modelAdmin->save(false);
				$model->farmStatus = $status;
				$model->save(false);
			}
		}
		return "Update";
	}

	/**
	 *  This action will Activate the farm account.
	 * After performing this action status will change from farm tabel as well s admin table.
	 * @return mixed
	 */
	public function actionActivate($id)
	{

		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} else {

			$model = $this->findModel($id);
			$adminID = $model->fkAdminID;
			$modelAdmin = Admin::findUserType($adminID);
			$model->farmUpdateDate = date('Y-m-d H:i:s');
			$model->farmLicenseStartDate = date('Y-m-d H:i:s');
			$model->farmInstrumentAllottedDate = date('Y-m-d H:i:s');
			$model->farmLicenseExpireDate = date('Y-m-d H:i:s');


			$model->farmStatus = 'active';
			$modelAdmin->status = 10;
			$modelAdmin->save();
			if ($model->save()) {
				Yii::$app->session->setFlash('active', true);
				return $this->redirect(['index']);
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function actionManage()
	{
		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} else {
			$searchModel = new Admin();
			$model = new Farm();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);  // echo '<pre>'; print_r($dataProvider->pkAdminID); die;
			$this->layout = 'mainsubadmin';
			return $this->render('manageAccount', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'model' => $model,
			]);
		}
	}

}
