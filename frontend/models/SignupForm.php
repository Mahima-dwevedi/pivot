<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\swiftmailer\Message;


/**
 *
 * Class SignupForm
 * @package frontend\models
 */
class SignupForm extends Model
{
	public $username;
	public $email;
	public $password;
	public $first_name;
	public $last_name;
	public $gender;
	public $billing_address1;
	public $billing_address2;
	public $billing_suburb;
	public $billing_city;
	public $billing_post_code;
	public $contact_number;
	public $confirm_password;
	public $year;
	public $month;
	public $date;
	public $accept_term;
	public $dob;
	public $status;
	public $blueskyMobileNumber;

	public static function socialSignup($arrUsers)
	{

		if (array_key_exists('emails', $arrUsers)) {
			$providerID = $arrUsers['id'];
			$providerName = 'google';
		} else {
			$providerID = $arrUsers['id'];
			$providerName = 'facebook';
		}


		$user = new User();
		if ($providerName == 'facebook') {
			$user->email = $arrUsers['email'];
			$user->confirm_email = $arrUsers['email'];
			$user->first_name = $arrUsers['first_name'];
			$user->last_name = $arrUsers['last_name'];
		} else {
			$user->email = $arrUsers['emails'][0]['value'];
			$user->confirm_email = $arrUsers['emails'][0]['value'];
			$name = explode(" ", $arrUsers['displayName']);
			$user->first_name = $name[0];
			$user->last_name = $name[1];
		}

		$user->setPassword(time());
		$user->generateAuthKey();
		$user->provider = $providerName;
		$user->provider_id = $providerID;
		$user->accept_term = 1;

		$user->verifyemail = 1;
		$user->status = 1;
		$user->created_at = date('Y-m-d H:i:s');
		$user->updated_at = date('Y-m-d H:i:s');
		if ($user->save(false)) {
			return $user;
		}

		return null;

	}

	/**
	 * Finds user by acitve code
	 * @param $token
	 * @return mixed
	 */
	public static function findByactivecode($token)
	{

		return User::findOne([
			'auth_key' => $token,
			'verifyemail' => '0',
		]);
	}

	/**
	 * @param $activeCode
	 * @return mixed
	 */
	public static function acitveUser($activeCode)
	{
		return $model = User::find()->where(['auth_key' => $activeCode])->one();
	}

	/**
	 * validation for signup form
	 * @return array
	 */
	public function rules()
	{
		return [
			[
				[
					'first_name',
					'last_name',
					'year',
					'month',
					'date',
					'billing_address1',
					'billing_suburb',
					'billing_city',
					'billing_post_code',
					'gender',
					'blueskyMobileNumber'
				],
				'required'
			],
			[
				['first_name', 'last_name'],
				'match',
				'pattern' => '/[a-zA-Z]+$/s',
				'message' => 'Must contains only letters.'
			],
			[
				['confirm_password'],
				'compare',
				'compareAttribute' => 'password',
				'message' => 'Password and Confirm password don\'t match.'
			],
			[
				['password'],
				'match',
				'pattern' => '((?=.*\d)(?=.*[A-Z])(?=.).{8,20})',
				'message' => 'Password must contain at least one upper case and one numeric character.'
			],
			[['status', 'billing_post_code'], 'integer'],
			['blueskyMobileNumber', 'integer'],
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			[
				'email',
				'unique',
				'targetClass' => 'common\models\User',
				'message' => 'This email address is already taken.'
			],
			[['first_name', 'last_name', 'email'], 'string', 'max' => 255],
			[['billing_address1', 'billing_address2'], 'string', 'max' => 200],
			[['billing_suburb', 'billing_city'], 'string', 'max' => 100],
			[['password'], 'required'],
			['password', 'string', 'min' => 8],
			['billing_post_code', 'string', 'min' => 6, 'message' => 'atleast 6 characters'],
			['blueskyMobileNumber', 'string', 'min' => 10, 'max' => 15, 'message' => 'characters between 10 to 15'],
			[['dob', 'confirm_password', 'status', 'contact_number'], 'safe'],
			[
				['confirm_password'],
				'compare',
				'compareAttribute' => 'password',
				'message' => 'password and Confirm password don\'t match.'
			],
			['accept_term', 'compare', 'compareValue' => true, 'message' => 'You must agree to the Bluesky terms'],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',

			'auth_key' => 'Auth Key',
			'password_hash' => 'Password Hash',
			'password_reset_token' => 'Password Reset Token',
			'email' => 'Email',
			'blueskyMobileNumber' => 'Bluesky Mobile Number',
			'status' => 'Status',
			'billing_address1' => 'Address1',
			'billing_address2' => 'Address2',
			'billing_suburb' => 'Suburbs',
			'billing_city' => 'City',
			'billing_post_code' => 'Postal Code',
			'delivery_address1' => 'Delivery Address1',
			'delivery_address2' => 'Delivery Address2',
			'suburb' => 'Delivery Suburb',
			'city' => 'Delivery City',
			'post_code' => 'Delivery Post Code',
			'contact_number' => 'Contact Number',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup($arrSignup)
	{

		$user = new User();
		$user->email = $this->email;
		$user->confirm_email = $this->email;
		$user->first_name = $this->first_name;

		$user->last_name = $this->last_name;
		$user->gender = $this->gender;
		$user->dob = $arrSignup['year'] . '-' . $arrSignup['month'] . '-' . $arrSignup['date'];
		$user->blueskyMobileNumber = $this->blueskyMobileNumber;
		$user->billing_address1 = $this->billing_address1;
		$user->billing_address2 = $this->billing_address2;
		$user->billing_suburb = $this->billing_suburb;
		$user->billing_city = $this->billing_city;
		$user->billing_post_code = $this->billing_post_code;

		$user->setPassword($this->password);
		$user->generateAuthKey();

		$user->verifyemail = 0;
		$user->status = 1;
		$user->created_at = date('Y-m-d H:i:s');
		$user->updated_at = date('Y-m-d H:i:s');
		if ($user->save(false)) {
			return $user;
		}

		return null;
	}


}
