<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends ActiveRecord implements IdentityInterface
{

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	const ROLE_USER = 10;

	public $current_password;
	public $new_password;
	public $confirm_password;
	public $confirm_email;
	public $password;
	public $user_Type;

	/**
	 * setting table name
	 * @return string
	 */
	public static function tableName()
	{

		return 'admin';
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public static function findIdentity($id)
	{
		return static::findOne(['pkAdminID' => $id, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public static function findUserType($id)
	{
		$model = Admin::findOne($id);
		return $model;
	}

	/**
	 * @param $token
	 * @param null $type
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by username
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}

		return static::findOne([
			'password_reset_token' => $token,
			'status' => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * Finds out if password reset token is valid
	 * @param string $token password reset token
	 * @return boolean
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return false;
		}
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = (int)end($parts);
		return $timestamp + $expire >= time();
	}

	/**
	 * model validation form admin
	 * @return array
	 */
	public function rules()
	{
		return [
			[['username', 'password_hash', 'email'], 'required', 'on' => 'register'],
			[['username', 'email', 'password'], 'required', 'on' => 'create'],
			[['email', 'username'], 'unique', 'on' => 'createfarm'],
			[['email', 'username'], 'unique', 'on' => 'createfield'],
			[['email', 'username'], 'unique', 'on' => 'updatefarm'],
			[['email', 'username'], 'unique', 'on' => 'updatefield'],
			[
				['username', 'email', 'password', 'phone', 'phone_provider', 'confirm_email', 'user_type'],
				'required',
				'on' => 'createfarm'
			],
			[
				['username', 'email', 'password', 'phone', 'phone_provider', 'confirm_email', 'user_type'],
				'required',
				'on' => 'createfield'
			],
			[['username', 'email', 'phone', 'updated_at'], 'required', 'on' => 'updatefarm'],
			[['role', 'status', 'page_setting', 'fkUserID'], 'integer'],
			[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[
				[
					'picture',
					'page_setting',
					'phone',
					'phone_provider',
					'AdminLastLogin',
					'confirm_email',
					'current_password',
					'new_password',
					'Name',
					'Address',
					'confirm_password',
					'updated_at',
					'created_at',
					'user_type',
					'Address',
					'Adminlevel'
				],
				'safe'
			],
			[['current_password', 'new_password', 'confirm_password'], 'required', 'on' => 'changepassword'],
			[['current_password', 'new_password', 'confirm_password'], 'string', 'min' => 6, 'on' => 'changepassword'],
			[['password'], 'string', 'min' => 6, 'on' => 'createfarm'],
			[
				['confirm_password'],
				'compare',
				'compareAttribute' => 'new_password',
				'message' => 'New password and Confirm passwords don\'t match.',
				'on' => 'changepassword'
			],
			[
				['confirm_password'],
				'compare',
				'compareAttribute' => 'password',
				'message' => 'New password and Confirm passwords don\'t match.',
				'on' => 'create'
			],
			[['username', 'email'], 'required', 'on' => 'editprofile'],
			[['username'], 'required', 'on' => 'editprofile', 'message' => 'Name cannot be blank'],
			[['picture'], 'file', 'extensions' => 'gif, jpg, png',],
			[
				['confirm_email'],
				'compare',
				'compareAttribute' => 'email',
				'message' => 'email and Confirm email don\'t match.'
			],
			[['email', 'confirm_email'], 'email'],
			[['username', 'email', 'phone', 'confirm_email'], 'required', 'on' => 'editprofile'],
			['phone', 'match', 'pattern' => '^[0-9]{3}-[0-9]{3}-[0-9]{4}$^'],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 * @param $newPassword
	 */
	public function validateStrongPassword($newPassword)
	{

		if (preg_match('/^[a-zA-Z0-9$!@#%&\.\?]*$/i', $newPassword)) {

			$this->addError('new_password', 'password should contain atleast one number and one special character.');
		}
	}

	/**
	 * setting labels for column
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'pkAdminID' => 'ID',
			'username' => 'Username',
			'auth_key' => 'Auth Key',
			'password_hash' => 'Password Hash',
			'password_reset_token' => 'Password Reset Token',
			'email' => 'Email',
			'role' => 'Role',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'AdminLastLogin' => 'Last Login',
			'phone' => 'Cell Phone Number',
			'phone_provider' => 'Cell Phone Provider'
		];
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @param $authKey
	 * @return bool
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * @return string
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, trim($this->password_hash));
	}


	/**
	 * Generates password hash from password and sets it to the model
	 * @param $password
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}

	/**
	 * validate current password
	 * @param $id
	 * @param $curPassword
	 * @return mixed
	 */
	public function validateCurrentPassword($id, $curPassword)
	{
		$password_hash = Yii::$app->security->validatePassword($curPassword, $this->password_hash);
		if ($password_hash != '') {
			return static::findOne([
				'pkAdminID' => $id,
				'status' => self::STATUS_ACTIVE,
				'password_hash' => $this->password_hash,
			]);
		} else {
			$this->addError('current_password', 'Password is incorrect.');
		}
	}

	/**
	 * Signs user up.
	 * @return User|null the saved model or null if saving fails
	 */
	public function search($params)
	{

		$id = Yii::$app->user->id;

		// ALL farm account and technician assigned to parent farm account Date:5-8-2015
		if (Yii::$app->user->identity->Adminlevel == '0') {
			$query = Admin::find()->Where(['fkUserID' => $id]);
			$query->joinWith('farm');
			$query->joinWith('tech')->orWhere(['fkParentID' => $id]);

		} else {
			$query = Admin::find()->Where(['fkUserID' => $id]);
			$query->joinWith('farm');
			$query->joinWith('tech')->orWhere(['fkParentID' => Yii::$app->user->identity->fkUserID]);
		}

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => ['defaultOrder' => ['pkAdminID' => SORT_DESC]],
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		// if user search for admin name
		if (@$params['Admin']['Name'] != '') {
			$query->andFilterWhere(['like', 'farmName', $params['Admin']['Name']]);
			$query->orFilterWhere(['like', 'FeildtechName', $params['Admin']['Name']]);
			$query->andFilterWhere(['fkUserID' => $id]);
			$this->Name = $params['Admin']['Name'];
		}

		// check if user search for user type
		if (@$params['Admin']['user_type'] != '') {
			$query->andFilterWhere(['like', 'user_type', $params['Admin']['user_type']]);
			$this->user_type = $params['Admin']['user_type'];
		}

		if (($this->load($params) && $this->validate())) {
			return $dataProvider;
		}
		$query->andFilterWhere([
			'user_type' => $this->user_type,
		]);

		return $dataProvider;
	}

	/**
	 * form relation
	 * @return mixed
	 */
	public function getFarm()
	{
		return $this->hasOne(\backend\models\Farm::className(), ['fkAdminID' => 'pkAdminID']);
	}


}
