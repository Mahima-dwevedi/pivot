<?php

namespace backend\controllers;

use app\models\Admin;
use backend\models\Device;
use backend\models\Farm;
use backend\models\ImportFieldMapping;
use backend\models\SearchDevice;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


class DeviceController extends Controller
{

	public function __construct()
	{
		// return logout if user not found
		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		}
	}

	/**
	 * Call to index view
	 * @return mixed
	 */
	public function actionIndex()
	{
		// check for user type
		if (Yii::$app->user->identity->user_type == 'super-admin') {
			$searchModel = new SearchDevice();
			$farmModel = new Farm();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			$pageSize = (isset($_GET['pageSize'])) ? $_GET['pageSize'] : 10;
			$dataProvider->pagination->pageSize = $pageSize;
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'farmModel' => $farmModel,
			]);
		}
	}

	/**
	 * Create device
	 * @return mixed
	 */
	public function actionCreate()
	{
		// check for user type
		if (Yii::$app->user->identity->user_type == 'super-admin') {
			// load device model
			$model = new Device();
			$model->scenario = 'create';
			$searchModel = new ImportFieldMapping();
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$model->DeviceAddDate = date('Y-m-d H:i:s');
				if ($model->save()) {
					Yii::$app->session->setFlash('create', true);
					return $this->redirect(['index']);
				}
			} else {
				return $this->render('create', [
					'model' => $model,
					'searchModel' => $searchModel,
				]);
			}
		}
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		// check for user type
		if (Yii::$app->user->identity->user_type == 'super-admin') {
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}
	}

	/**
	 * Find model
	 * @param $id
	 * @return mixed
	 */
	protected function findModel($id)
	{

		if (($model = Device::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * Assign Device to a farm
	 * @return mixed
	 */
	public function actionUpdate()
	{
		if (Yii::$app->user->identity->user_type == 'super-admin') {

			$id = $_POST['SearchDevice']['DeviceSerialNo'];
			$fkFarmID = $_POST['Farm']['farmName'];
			//device and farm should not be blank
			if ($id != '' && $fkFarmID != '') {
				$model = $this->findModel($id);
				$model->fkFarmID = $fkFarmID;
				if ($model->save()) {
					Yii::$app->session->setFlash('assign', true);
					return $this->redirect(['index']);
				} else {
					Yii::$app->session->setFlash('assign', true);
					return $this->redirect(['index']);
				}
			} else {
				Yii::$app->session->setFlash('errorupdate', true);
				return $this->redirect(['index']);
			}
		}
	}

	/**
	 * Un-assign Device to a farm
	 * @param $id
	 * @return mixed
	 */
	public function actionUnassign($id)
	{
			// get model with id
			$model = $this->findModel($id);
			$model->DeviceCellularServiceContractDate = date('Y-m-d H:i:s');
			$model->DeviceAddDate = date('Y-m-d H:i:s');
			$model->DeviceUpdateDate = date('Y-m-d H:i:s');
			$model->fkFarmID = "";
			if ($model->save()) {
				Yii::$app->session->setFlash('unassign', true);
				return $this->redirect(['index']);
			}
	}

	/**
	 * assign Device to a farm
	 * @param $id
	 * @return mixed
	 */
	public function actionAssign($id)
	{
		// load form model
		$farmModel = new Farm();
		if (Yii::$app->request->isPost && !empty($_POST['Farm']['farmName'])) {
			$model = $this->findModel($id);
			$model->DeviceCellularServiceContractDate = date('Y-m-d H:i:s');
			$model->DeviceAddDate = date('Y-m-d H:i:s');
			$model->DeviceUpdateDate = date('Y-m-d H:i:s');
			$model->fkFarmID = $_POST['Farm']['farmName'];
			if ($model->save()) {

				Yii::$app->session->setFlash('assign', true);
				return $this->redirect(['index']);
			}
		} elseif (Yii::$app->request->isPost) {
			Yii::$app->session->setFlash('errorupdate', true);
			return $this->redirect(['assign', 'id' => $id]);
		}

		if (Yii::$app->user->identity->user_type == 'super-admin') {
			return $this->render('assign', [
				'model' => $this->findModel($id),
				'farmModel' => $farmModel,
			]);
		}
	}

	/**
	 * Deletes an existing Device model.
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
	 * edit device
	 * @param $id
	 * @return mixed
	 */
	public function actionEdit($id)
	{
		// check user type
		if (Yii::$app->user->identity->user_type == 'super-admin') {
			$model = $this->findModel($id);
			$model->farmUpdateDate = date('Y-m-d H:i:s');
			$adminID = $model->fkAdminID;

			// load admin model
			$modelAdmin = Admin::findOne(['pkAdminID' => $adminID]);
			$model->scenario = 'update';
			$modelAdmin->scenario = 'updatefarm';
			if (isset($_POST['Admin']['password']) && $_POST['Admin']['password'] != '') {
				$modelAdmin->password_hash = Yii::$app->security->generatePasswordHash($_POST['Admin']['password']);
			}
			// load model and validate
			if ($modelAdmin->load(Yii::$app->request->post()) && $modelAdmin->validate()) {

				$modelAdmin->updated_at = date('Y-m-d H:i:s');
				if ($model->save()) {

					if ($model->load(Yii::$app->request->post()) && $model->validate()) {

						$model->farmUpdateDate = date('Y-m-d H:i:s');
						$model->farmLicenseStartDate = date('Y-m-d', strtotime($_POST['Farm']['farmLicenseStartDate']));
						$model->farmLicenseExpireDate = date('Y-m-d',
							strtotime($_POST['Farm']['farmLicenseExpireDate']));
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
	 * Deactivate Device Status
	 * @param $id
	 * @return mixed
	 */
	public function actionDeactivate($id)
	{
		if (!isset(Yii::$app->user->id)) {
			return $this->redirect(['/site/login']);
		} else {
			$model = $this->findModel($id);
			$model->DeviceCellularServiceContractDate = date('Y-m-d H:i:s');
			$model->DeviceAddDate = date('Y-m-d H:i:s');
			$model->DeviceUpdateDate = date('Y-m-d H:i:s');

			$model->DeviceStatus = 'Deactive';

			if ($model->save()) {

				Yii::$app->session->setFlash('delete', true);
				return $this->redirect(['index']);
			}
		}
	}

	/**
	 * Bulk status change of Device 'activate' or 'deactivate'
	 * @return string
	 */
	public function actionChangestatus()
	{
		// get all post data
		$postArr = Yii::$app->request->post();
		$status = ($postArr['DeviceStatus'] == 'activate') ? 'Active' : 'Deactive';
		if (count($postArr['pkDeviceID']) > 0) {
			foreach ($postArr['pkDeviceID'] as $val) {
				$model = $this->findModel($val);
				$model->DeviceStatus = $status;
				$model->save(false);
			}
		}
		return "Update";
	}

	/**
	 * Activate Device Status
	 * @param $id
	 * @return mixed
	 */
	public function actionActivate($id)
	{
			// load model
			$model = $this->findModel($id);
			$model->DeviceCellularServiceContractDate = date('Y-m-d H:i:s');
			$model->DeviceAddDate = date('Y-m-d H:i:s');
			$model->DeviceUpdateDate = date('Y-m-d H:i:s');
			$model->DeviceStatus = 'active';
			if ($model->save()) {
				Yii::$app->session->setFlash('active', true);
				return $this->redirect(['index']);
			}

	}

	/**
	 * import device with csv
	 * @return mixed
	 */
	public function actionImport()
	{
		$model = new ImportFieldMapping();
		$source_file = UploadedFile::getInstance($model, 'source_file');
		$doc_path = \Yii::getAlias('@backend/web') . '/uploaded_files/member/';
		$rannumber = time();
		$model->source_file = $rannumber . '_' . $source_file->baseName . '.' . $source_file->extension;
		$server_doc_path = ($doc_path . $rannumber . '_' . $source_file->baseName . '.' . $source_file->extension);

		$rannumber = time();
		if ($source_file->baseName != '') {
			if (file_exists($server_doc_path)) {
				unlink($server_doc_path);
			}
			$server_doc_path = ($doc_path . $rannumber . '_' . $source_file->baseName . '.' . $source_file->extension);
			$source_file->saveAs($doc_path . $rannumber . '_' . $source_file->baseName . '.' . $source_file->extension,
				true);
		}

		if (!isset($_POST[$server_doc_path]) && empty($_POST[$server_doc_path])) {

			$model->source_file = $server_doc_path;
			$validate = $model->validate();
			if ($validate) {
				$file_source = $server_doc_path;
				if (file_exists($file_source)) {

					$DATA = $this->parse_file($file_source);
					if (isset($DATA['DATA'])) {
						$arrFieldMapping = $model->getImportFieldMapping();
						$error = array();

						foreach ($DATA['DATA'] as $key => $row) {
							$errorMsg = $this->checkRecord($row, $DATA['HEADER'], $arrFieldMapping, $key);
							if (!empty($errorMsg)) {
								$error[] = $errorMsg;
							}
						}

						if (!empty($error)) {

							Yii::$app->session->setFlash('error', true);
							return $this->redirect(['index']);
						} else {
							foreach ($DATA['DATA'] as $key => $row) {
								$this->processRecord($row, $DATA['HEADER'], $arrFieldMapping, $key);
							}
							Yii::$app->session->setFlash('import', true);
							return $this->redirect(['index']);
						}
					}
				} else {
					Yii::$app->session->setFlash('sourcefileerror', true);
					return $this->redirect(['index']);
				}
			} else {
				Yii::$app->session->setFlash('sourcefileerror', true);
				return $this->redirect(['index']);
			}
			$this->redirect('index', array('model' => $model));
		}
	}

	/**
	 * Parse file
	 * @param $file
	 * @return array|bool
	 */
	function parse_file($file)
	{

		$array = [];
		if (($handle = fopen($file, "r")) !== false) {
			$array = $this->parse_lines($handle);
		} else {
			return false;
		}

		return $array;
	}

	/**
	 * Parse line
	 * @param $handle
	 * @return array
	 */
	function parse_lines($handle)
	{
		$array = array();
		$header = array();
		$row = 0;
		//loop through csv data
		while (($line = fgets($handle)) !== false) {

			$data = explode(",", $line);
			$num = count($data);

			if ($num == '5') {
				for ($c = 0; $c < $num; $c++) {
					if ($row == 0) {
						$header[$c] = trim($data[$c]);
						$array['HEADER'][$c] = $data[$c];
					} else {
						$array['DATA'][$row][trim($header[$c])] = $data[$c];
					}
				}
				$row++;
			}
		}
		// close file
		fclose($handle);
		return $array;
	}

	/**
	 * CHeck records
	 * @param $row
	 * @param array $arrFieldMapping
	 * @return array|void
	 */
	function checkRecord($row, $arrFieldMapping = array())
	{
		$errorMessage = array();
		$values = $row;
		$values = array_change_key_case($values, CASE_LOWER);

		$recordData = array();
		foreach ($values as $key => $value) {

			$value = trim($value);
			if ($key != '') {

				foreach ($arrFieldMapping as $db_field => $sourceArray) {
					$sourceFieldName = strtolower($sourceArray['source_field']);
					if ($key == $sourceFieldName) {
						$recordData[$db_field] = (!empty($value) ? $value : null);
					}
				}
			}
		}

		$device = null;
		if (isset($recordData['DeviceSerialNo'])) {
			$device = $recordData['DeviceSerialNo'];
			if (!is_null($device)) {
				$recordData['DeviceSerialNo'] = $device;
			} else {
				$errorMessage[] = 'device provided as BLANK/NULL in source file.';
			}
		} else {

			$errorMessage[] = 'device is not provided in source file.';
		}

		$ServiceProvider = null;
		if (isset($recordData['DeviceCellularServiceProvider'])) {
			$ServiceProvider = $recordData['DeviceCellularServiceProvider'];
			if (!is_null($ServiceProvider)) {
				$recordData['DeviceCellularServiceProvider'] = $ServiceProvider;
			} else {
				$errorMessage[] = 'Service Provider as BLANK/NULL in source file.';
			}
		} else {

			$errorMessage[] = 'Service Provider is not provided in source file.';
		}

		$ServiceContractDate = null;
		if (isset($recordData['DeviceCellularServiceContractDate'])) {
			$ServiceContractDate = $recordData['DeviceCellularServiceContractDate'];
			if (!is_null($ServiceContractDate)) {
				$recordData['DeviceCellularServiceContractDate'] = $ServiceContractDate;
			} else {
				$errorMessage[] = 'Cellular Service Contract Date is not provided as BLANK/NULL in source file.';
			}
		} else {

			$errorMessage[] = 'Cellular Service Contract Date is not provided in source file.';
		}
		$ServicePhone = null;
		if (isset($recordData['DeviceCellularServicePhone'])) {
			$ServicePhone = $recordData['DeviceCellularServicePhone'];
			if (!is_null($ServicePhone)) {
				$recordData['DeviceCellularServicePhone'] = $ServicePhone;
			} else {
				$errorMessage[] = 'ervice Phone provided as BLANK/NULL in source file.';
			}
		} else {

			$errorMessage[] = 'Service Phone is not provided in source file.';
		}
		$SoftwareVersion = null;
		if (isset($recordData['DeviceSoftwareVersion'])) {
			$SoftwareVersion = $recordData['DeviceSoftwareVersion'];
			if (!is_null($SoftwareVersion)) {
				$recordData['DeviceSoftwareVersion'] = $SoftwareVersion;
			} else {
				$errorMessage[] = 'Software Version provided as BLANK/NULL in source file.';
			}
		} else {

			$errorMessage[] = 'Software Version is not provided in source file.';
		}

		if (count($errorMessage) > 0) {
			$errorMessage = implode("\n", $errorMessage);
			return $errorMessage;
		} else {
			return;
		}
	}

	/**
	 * process records
	 * @param $row
	 * @param array $arrFieldMapping
	 */
	function processRecord($row, $arrFieldMapping = [])
	{

		$values = $row;
		$values = array_change_key_case($values, CASE_LOWER);
		$recordData = [];
		foreach ($values as $key => $value) {

			$value = trim($value);
			if ($key != '') {

				foreach ($arrFieldMapping as $db_field => $sourceArray) {
					$sourceFieldName = strtolower($sourceArray['source_field']);
					if ($key == $sourceFieldName) {
						$recordData[$db_field] = (!empty($value) ? $value : null);
					}
				}
			}
		}

		// load device model and save
		$model = new Device();
		$model->DeviceSerialNo = $recordData['DeviceSerialNo'];
		$model->DeviceCellularServiceProvider = $recordData['DeviceCellularServiceProvider'];
		$model->DeviceCellularServiceContractDate = $recordData['DeviceCellularServiceContractDate'];
		$model->DeviceCellularServicePhone = $recordData['DeviceCellularServicePhone'];
		$model->DeviceSoftwareVersion = $recordData['DeviceSoftwareVersion'];
		if ($model->save()) {
			return;
		}
	}

	/**
	 * Check duplicate file in directory
	 * @param $dir
	 * @param $fileName
	 * @param $ext
	 * @param $start
	 * @return string
	 */
	public function checkIsFileExist($dir, $fileName, $ext, $start)
	{
		if (($dir != "") && ($fileName != "")) {
			$i = $start;
			$getSource = $dir . $fileName . $i . '.' . $ext;

			if (file_exists($getSource)) {
				$add = $i + 1;
				return $this->checkIsFileExist($dir, $fileName, $ext, $add);
			} else {
				return $fileName . $i . '.' . $ext;
			}
		} else {
			return '';
		}
	}

	/**
	 * Get file name without extension
	 * @param $filename
	 * @return bool|string
	 */
	public function getFilenameWithoutExt($filename)
	{
		$pos = strripos($filename, '.');
		return ($pos === false)? $filename: substr($filename, 0, $pos);
	}


	/**
	 * Get file file extension
	 * @param $filename
	 * @return mixed|string
	 */
	public function getFileExt($filename)
	{
		return ($filename) ? end(explode('.', $filename)) : '';
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

}
