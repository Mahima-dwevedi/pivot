<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_device".
 * @property integer $pkDeviceID
 * @property integer $deviceID
 * @property string $deviceSerialNo
 * @property string $deviceCellularServiceProvider
 * @property string $deviceCellularServicePhone
 * @property string $deviceSoftwareVersion
 * @property integer $fkFarmID
 * @property string $deviceAddDate
 * @property string $deviceUpdateDate
 */
class Device extends ActiveRecord
{


	public $zipfile;
	public $radio;
	public $FormSearch;

	/**
	 * Setting up table here for this model
	 * @return string
	 */
	public static function tableName()
	{
		return 'tbl_device';
	}

	/**
	 * Function find all farm name which is Created by Super admin
	 * @return array
	 */
	public static function getFarmlevel()
	{

		// load forms model
		$query = Farm::find()->select([
			'tbl_farm.fkAdminID',
			'tbl_farm.farmName',
			'admin.Adminlevel'
		])
			->join('LEFT JOIN', 'admin', 'admin.pkAdminID =tbl_farm.fkAdminID')
			->join('LEFT JOIN', 'tbl_device',
				'tbl_device.fkFarmID =tbl_farm.fkAdminID')->andWhere(['admin.Adminlevel' => '0'])->groupBy('tbl_farm.fkAdminID');

		$command = $query->createCommand();
		$data = $command->queryAll();

		if ($data) {
			foreach ($data as $value) {
				$farm[$value['fkAdminID']] = $value['farmName'];

			}
			return $farm;
		}else{
			return [];
		}

	}

	/**
	 * adding validation for device model
	 * @return array
	 */
	public function rules()
	{
		return [
			[['DeviceSerialNo', 'DeviceUnitNo'], 'required', 'on' => 'create'],
			[['DeviceSerialNo', 'DeviceAddDate', 'DeviceUpdateDate', 'fkFarmID', 'fkFieldID', 'DeviceComment'], 'safe'],
			[['fkFarmID', 'fkFieldID', 'DeviceSerialNo'], 'integer'],
			[['pkDeviceID'], 'required', 'on' => 'assigndevice', 'message' => 'Please select a Device'],
			[['DeviceSerialNo'], 'unique'],
			[['DeviceUnitNo'], 'unique'],
			[['DeviceStatus', 'DeviceComment'], 'string', 'max' => 255],

		];
	}

	/**
	 * setting labels for columns
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'DeviceID' => 'Device ID',
			'fkFieldID' => 'Field ID',
			'DeviceSerialNo' => 'Sim Number of Pivot Monitor',
			'DeviceUnitNo' => 'Unit Number of Pivot Monitor',
			'DeviceCellularServiceProvider' => 'Device Cellular Service Provider',
			'DeviceCellularServiceContractDate' => 'Device Cellular Service Contract Date',
			'DeviceCellularServicePhone' => 'Device Cellular Service Phone',
			'DeviceSoftwareVersion' => 'Device Software Version',
			'fkFarmID' => 'Fk Farm ID',
			'DeviceStatus' => 'Device Status',
			'DeviceComment' => 'Device Comment',
			'DeviceAddDate' => 'Device Add Date',
			'DeviceUpdateDate' => 'Device Update Date',
		];
	}

	/**
	 * @return mixed
	 */
	public function getFarm()
	{
		return $this->hasOne(Farm::classname(), ['fkAdminID' => 'fkFarmID']);
	}

	/**
	 * @return mixed
	 */
	public function getAdmin()
	{
		return $this->hasOne(Admin::className(), ['pkAdminID' => 'fkAdminID']);
	}

	/**
	 * search for device
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{

		// load device model
		$query = Device::find()->orderBy('pkDeviceID DESC');
		$query->joinWith('farm');
		$pageSize = (isset($_GET['pageSize'])) ? $_GET['pageSize'] : 10;
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => $pageSize,
			],
			'sort' => ['attributes' => ['DeviceSerialNo', 'DeviceAddDate', 'DeviceStatus']],
		]);

		// load and validate model
		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		// search for device form name
		if (@$params['Device']['FormSearch'] != '') {
			$query->andFilterWhere(['like', 'farmName', $params['Device']['FormSearch']]);
			$this->FormSearch = $params['Device']['FormSearch'];
		}
		return $dataProvider;
	}

}

