<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Admin;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "tbl_farm".
 *
 * @property integer $farmID
 * @property integer $fkAdminID
 * @property string $farmName
 * @property string $farmUserName
 * @property string $farmPassword
 * @property string $farmAddress1
 * @property string $farmAddress2
 * @property string $farmPincode
 * @property string $farmEmail
 * @property string $farmContactNumber
 * @property string $farmInstrumentAllottedDate
 * @property string $farmLicenseStartDate

 * @property string $farmNotificationStatus
 * @property string $farmStatus
 * @property string $farmAddDate
 * @property string $farmUpdateDate
 */
class Farm extends ActiveRecord {


    public $radio;

	/**
	 * Setting table name for this model
	 * @return string
	 */
    public static function tableName() {
        return 'tbl_farm';
    }

	/**
	 * Adding validation for form
	 * @return array
	 */
    public function rules() {
        return [
            [['farmName', 'farmLicenseStartDate', 'farmLicenseExpireDate'], 'required', 'on' => 'create'],
            [['farmName'], 'required', 'on' => 'createaccount'],
            [['farmName', 'Name'], 'required', 'on' => 'update'],
            [['fkAdminID'], 'integer'],
            ['farmName', 'unique', 'on' => 'update'],
            ['farmName', 'unique', 'on' => 'create'],
            [['farmAddress1', 'farmAddress2', 'farmStatus'], 'string'],
            [['fkAdminID', 'Name', 'farmID', 'farmNotificationStatus', 'farmInstrumentAllottedDate', 'farmPincode', 'farmAddress1', 'farmAddress2', 'Name', 'farmLicenseStartDate', 'farmStatus', 'farmAddDate', 'farmUpdateDate'], 'safe'],
            [['farmName', 'farmNotificationStatus', 'Name'], 'string', 'max' => 255],
            [['farmPincode'], 'string', 'max' => 5],
            [['farmLicenseStartDate'], 'required', 'on' => 'create', 'message' => 'License Start Date cannot be blank'],
            [['farmLicenseExpireDate'], 'required', 'on' => 'create', 'message' => 'License Expire Date cannot be blank'],
            [['farmLicenseStartDate'], 'required', 'on' => 'update', 'message' => 'License Start Date cannot be blank'],
            [['farmLicenseExpireDate'], 'required', 'on' => 'update', 'message' => 'License Expire Date cannot be blank'],
        ];
    }

	/**
	 * Setting labels for columns
	 * @return array
	 */
    public function attributeLabels() {
        return [
            'farmID' => 'Farm ID',
            'fkAdminID' => 'Fk Admin ID',
            'farmName' => 'Farm Name',
            'Name' => 'Name',
            'farmAddress1' => 'Farm Address',
            'farmAddress2' => 'Farm Address2',
            'farmPincode' => 'Farm Pincode',
            'farmInstrumentAllottedDate' => 'Farm Instrument Allotted Date',
            'farmLicenseStartDate' => 'Farm License Start Date',
            'farmLicenseExpireDate' => 'Farm License Expire Date',
            'farmNotificationStatus' => 'Farm Notification',
            'farmStatus' => 'Farm Status',
            'farmAddDate' => 'Farm Add Date',
            'farmUpdateDate' => 'Farm Update Date',
        ];
    }

	/**
	 * @return mixed
	 */
    public function getAdmin() {
        return $this->hasOne(admin::className(), ['pkAdminID' => 'fkAdminID']);
    }

	/**
	 * Search for form model
	 * @param $params
	 * @return ActiveDataProvider
	 */
    public function search($params) {

        $query = Farm::find()->joinWith('admin', true, 'INNER JOIN')->andWhere(['admin.Adminlevel' => '0']);

        $pageSize = (isset($_GET['pageSize'])) ? $_GET['pageSize'] : 10;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => ['attributes' => ['farmName', 'farmAddDate', 'farmLicenseStartDate', 'farmLicenseExpireDate', 'farmStatus']],
        ]);

        // load model and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // add filter
        $query->andFilterWhere([ 'like', 'farmName', $this->farmName]);
        return $dataProvider;
    }

	/**
	 * @return array
	 */
    public function getSearchFarmList() {

        $array = [];
        $model = Farm::find()->select('farmName')->joinWith('admin', true, 'INNER JOIN')->andWhere(['admin.Adminlevel' => '0'])->all();

        foreach ($model as $value) {
            array_push($array, $value['farmName']);
        }
        return $array;
    }

}
