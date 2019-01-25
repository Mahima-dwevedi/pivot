<?php
namespace frontend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $confirm_password;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('You have already re-set your password using this link.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     * ((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})
     * (			# Start of group
                (?=.*\d)		#   must contains one digit from 0-9
                (?=.*[a-z])		#   must contains one lowercase characters
                (?=.*[A-Z])		#   must contains one uppercase characters
                (?=.*[@#$%])		#   must contains one special symbols in the list "@#$%"
                            .		#     match anything with previous condition checking
                              {6,20}	#        length at least 6 characters and maximum of 20	
              )			# End of group
     * 
     */
    
    public function rules()
    {
        return [
            [['password','confirm_password'], 'required'],
            ['password', 'string', 'min' => 8],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password', 'message' => 'Password and Confirm password don\'t match.'],
            [['password'], 'match', 'pattern'=>'((?=.*\d)(?=.*[A-Z])(?=.).{8,20})', 'message' => 'Password must at least one upper case and one numeric character.'],
                
          ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->password = $this->password;
        $user->removePasswordResetToken();

        return $user->save();
    }
}
