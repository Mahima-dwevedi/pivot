<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Cookie;

/**
 * Class LoginForm
 * @package app\models
 */
class LoginForm extends ActiveRecord {

    public $username;
    public $password;
    public $rememberMe;
    private $_user = false;
    public $coockie_store;

	/**
	 * Setting table name for this model
	 * @return string
	 */
	public static function tableName() {
		return 'admin';
	}

	/**
	 * adding validation for login form
	 * @return array
	 */
    public function rules() {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            [['email'], 'default'],
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
			// email should be email
        ];
    }



    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect Email ID or Password.');
            }
        }
    }

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
    public function login() {
       
        if ($this->validate()) {
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);

            if ($this->rememberMe != 1) {
                $cookies = Yii::$app->response->cookies;
                $cookies->remove('email');
                unset($cookies['email']);
                $cookies1 = Yii::$app->response->cookies;
                $cookies1->remove('password');
                unset($cookies1['password']);
            } else {
                $cookies = Yii::$app->response->cookies;
				// add a new cookie to the response to be sent
                $cookies->add(new Cookie([
                    'name' => 'email',
                    'value' => $this->email,
                ]));
                $cookies1 = Yii::$app->response->cookies;
				// add a new cookie to the response to be sent
                $cookies1->add(new Cookie([
                    'name' => 'password',
                    'value' => $this->password,
                ]));
            }
            return true;
        } else {
            return false;
        }
    }

	/**
	 * update last login
	 */
    public function lastLogin() {
        if (isset(Yii::$app->user->id)) {
        $id = \Yii::$app->user->id;
        $admin = Admin::findOne($id);

        $admin->AdminLastLogin = date('Y-m-d H:i:s');
        $admin->update(false);
    }
    }

    /**
     * Finds user by [[username]]
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = Admin::findByUsername($this->email);
        }

        return $this->_user;
    }

}
