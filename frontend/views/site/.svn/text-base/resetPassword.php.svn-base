<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
   
<div class="site-reset-password">
 <div class="row">
	<div class="page_title col-lg-12"><?= Html::encode($this->title) ?></div>


    
         <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
	
        <div class="col-lg-8 col-md-12 content_wrap">
        <h4>Please choose your new password:</h4>
        <div class="input_box valid_star_non ex_space reset-password-errow"><?=  $form->field($model, 'password')->passwordInput(['class'=>'txt', 'placeholder'=>'Password'])->label(false); ?></div>
                    <div class="input_box valid_star_non ex_space reset-password-errow"><?=  $form->field($model, 'confirm_password')->passwordInput(['class'=>'txt', 'placeholder'=>'Confirm Password'])->label(false); ?> 
                        </div>
                    <div class="form-group">
                    <?=  Html::submitButton('Save', ['class' => 'btn btn-primary btn_signup fl top_space']) ?>
                    </div>
					
          
        </div>
         <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
