<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * Class Mail
 * @package common\models
 */
class Mail {

	/**
	 * send mail
	 * @param $model
	 * @param $password
	 * @return mixed
	 */
    public static function sendMail($model, $password) {
        $messageValue = "Dear $model->username,<br><br>Your Account has been created successfully.<br>
                    The below details of your account.<br><br>
                    <table>
                    <tr><td><b>Email Address:</b></td><td>$model->email<td/></tr>
                    <tr><td><b>Password:</b></td><td>$password<td/></tr> 
                    <tr></tr>
                    </table><br>
					If you would like to login your account, please click on this <br><br>" . Html::a(Yii::$app->urlManager->createAbsoluteUrl(['site/login']), Yii::$app->urlManager->createAbsoluteUrl(['site/login'])) . "<br><br>
					If you're unable to click on the link you can also copy the URL and paste it into your browser manually.
					<br/><br/>
					Regards<br/>Pivot Pro";

        return \Yii::$app->mail->compose()
                        ->setFrom([Yii::$app->params['adminEmail']=>'Pivot Team'])
                        ->setTo($model->email)
                        ->setSubject('Account Creation')
                        ->setHtmlBody($messageValue)
                        ->send();
    }

}
