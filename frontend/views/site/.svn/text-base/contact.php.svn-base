<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
<div class="site-contact">
    <h1></h1>

   
    <!--<p><?php //echo Yii::$app->session->getFlash('message');?></p>-->
    
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="row">
                <div class="page_title col-lg-12"><?= Html::encode($this->title) ?></div>
                <div class="col-lg-8 col-md-12 content_wrap">
                    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
    <div class="breadcrumbs" id="breadcrumbs-msg">
        <ul>
             <?php
                                if(Yii::$app->session->getFlash('success'))
                                {
                                    echo '<li><span class="sucess_txt">'.Yii::$app->session->getFlash('success').'</li>';
                                }
                                else if(Yii::$app->session->getFlash('error'))
                                {
                                    echo '<li><span class="error_txt">'.Yii::$app->session->getFlash('error').'</li>';
                                }
                          ?>	
        </ul>
    </div>
    <div class="from_container">
        <div class="from_title">
                    	Contact information<span><i class="star_red">*</i> All fiels are mandatory</span>
                    </div>
        <div class="info">Please check that your details are right, and fill in any blank fields.</div>
                    <div class="input_box_full">
                <?= $form->field($model, 'contactName')->textInput(['class'=>'txt','placeholder'=>'Name'])->label(false); ?>
                        </div>
        <div class="input_box_full">
                <?= $form->field($model, 'contactEmail')->textInput(['class'=>'txt','placeholder'=>'Email'])->label(false); ?>
        </div>
       <div class="input_box_full">
                <?= $form->field($model, 'contactSubject')->textInput(['class'=>'txt','placeholder'=>'Subject'])->label(false); ?>
        </div>
        
                <?= $form->field($model, 'contactBody')->textArea(['rows' => 6]); ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
</div>
</div>
