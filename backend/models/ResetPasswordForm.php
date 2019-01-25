<?php
namespace backend\models;

use Yii;
use yii\helpers\Html;
use app\models\Admin;
use yii\base\Model;


use yii\base\InvalidParamException;


/**
 * Class ResetPasswordForm
 * @package backend\models
 */
class ResetPasswordForm extends Model
{
    public $new_password;
   	public $confirm_password;
    private $_user;

    /**
     * ResetPasswordForm constructor.
     * @param  string $token
     * @param  array  $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = Admin::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException("Your reset password link has been either used or expired. Please request a new one by visiting the link again ");
        }
        parent::__construct($config);
    }

	/**
	 * Adding a validation for form
	 * @return array
	 */
    public function rules()
    {
         return [
             
             [['new_password', 'confirm_password'], 'required', 'on' => 'reset'],
			 [['new_password'], 'string', 'min' => 6, 'message' => 'New Password should contain at least 6 characters.', 'on' => 'reset'],
			 [['confirm_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => 'New password and Confirm passwords don\'t match.', 'on' => 'reset'],
             [['new_password', 'confirm_password'], 'safe'],
           
        ];
    }
    
   

    /**
     * Resets password here
     * @return boolean if password was reset
     */
    public function resetPassword()
    {
        
        $user = $this->_user;
        $user->password = $user->setPassword($this->new_password);
        $user->removePasswordResetToken();
        return $user->save();
    }
}
