<?php

use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Content -->
<div class="container">
	<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">

        <div class="page_title col-lg-12">Sign Up to Uturn</div>
        <div class="col-lg-8 col-md-12 content_wrap">

            <div class="breadcrumbs" id="breadcrumbs-msg">
				<?php if ((Yii::$app->session->hasFlash('success')) || (Yii::$app->session->hasFlash('fail')) || (Yii::$app->session->hasFlash('error'))) { ?>
                    <ul>
						<?php
						if (Yii::$app->session->getFlash('success')) {
							echo '<li><span class="sucess_txt">' . Yii::$app->session->getFlash('success') . '</li>';
						} else {
							if (Yii::$app->session->getFlash('fail')) {
								echo '<li><span class="readcrum_without_link_success">' . USER_SIGNUP_FAIL . '</li>';
							} else {
								if (Yii::$app->session->getFlash('error')) {
									echo '<li><span class="error_txt">' . Yii::$app->session->getFlash('error') . '</li>';
								}
							}
						}
						?>
                    </ul>
				<?php } ?>
            </div>
            <div class="from_container">
                <div class="from_title">
                    Personal information<span><i class="star_red">*</i> All fiels are mandatory</span>
                </div>
                <div class="info">Please check that your details are right, and fill in any blank fields.</div>
                <div class="input_box">


					<?= $form->field($model, 'first_name')->textInput([
						'class' => 'txt',
						'placeholder' => 'First Name'
					])->label(false); ?> </div>
                <div class="input_box"><?= $form->field($model, 'last_name')->textInput([
						'class' => 'txt',
						'placeholder' => 'Last Name'
					])->label(false); ?> </div>
                <div class="input_box"> <?= $form->field($model, 'email')->textInput([
						'class' => 'txt',
						'placeholder' => 'Email'
					])->label(false); ?></div>
                <div class="fld_full_width">
                    <div class="dob_wrap fl">
                        <label>Date Of Birth</label>
						<?php
						for ($i = 1; $i <= 31; $i++) {
							if ($i < 10) {
								$arrDate[$i] = '0' . $i;
							} else {
								$arrDate[$i] = $i;
							}
						}

						?>
                        <div class="dob">
							<?= $form->field($model, 'date')->dropDownList($arrDate,
								['prompt' => 'Date', 'class' => 'chosen-select'])->label(false) ?>
                        </div>
                        <div class="dob">
							<?php for ($m = 1; $m <= 12; $m++) {
								$arrMonth[$m] = date('M', mktime(0, 0, 0, $m));
							} ?>

							<?= $form->field($model, 'month')->dropDownList($arrMonth,
								['prompt' => 'Month', 'class' => 'chosen-select'])->label(false) ?>
                        </div>

                        <div class="dob">
							<?php
							for ($y = date("Y"); $y > 1929; $y--) {
								$arrYear[$y] = $y;
							}
							?>
							<?= $form->field($model, 'year')->dropDownList($arrYear,
								['prompt' => 'Year', 'class' => 'chosen-select'])->label(false) ?>
                        </div>

                    </div>
                    <div class="right_sec_frm fr">
                        <label>Gender</label>
						<?php echo $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female'],
							['class' => 'chosen-select'])->label(false); ?>
                    </div>
                    <div class="cb"></div>
                </div><!--fld_full_width-->
                <div class="fld_full_width">
                    <label>Postal Address</label>
                    <div class="input_box_full"><?= $form->field($model, 'billing_address1')->textInput([
							'class' => 'txt',
							'placeholder' => 'Address 1'
						])->label(false); ?></div>
                    <div class="input_box_full valid_star_non"><?= $form->field($model, 'billing_address2')->textInput([
							'class' => 'txt',
							'placeholder' => 'Address 2(Optional)'
						])->label(false); ?></div>
                    <div class="input_box"><?= $form->field($model, 'billing_suburb')->textInput([
							'class' => 'txt',
							'placeholder' => 'Suburb'
						])->label(false); ?></div>
                    <div class="input_box"><?= $form->field($model, 'billing_city')->textInput([
							'class' => 'txt',
							'placeholder' => 'Town/City'
						])->label(false); ?></div>
                    <div class="input_box"><?= $form->field($model, 'billing_post_code')->textInput([
							'class' => 'txt',
							'placeholder' => 'Postal Code'
						])->label(false); ?></div>
                </div><!--fld_full_width-->
                <div class="fld_full_width">
                    <label>Your Account</label>
                    <div class="input_box_full"><?= $form->field($model, 'blueskyMobileNumber')->textInput([
							'class' => 'txt',
							'placeholder' => 'Bluesky Mobile Number'
						])->label(false); ?></div>
                </div><!--fld_full_width-->
                <div class="cb"></div>


            </div><!--from_container -->


            <div class="from_title_pass">OR Login via
                <p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it
                    here:</p>
				<?= yii\authclient\widgets\AuthChoice::widget([
					'baseAuthUrl' => ['site/auth']
				]) ?>
            </div>


            <div class="from_title_pass">Choose a secure password for your Bluesky Account</div>
            <div class="input_box valid_star_non ex_space"> <?= $form->field($model,
					'password')->passwordInput(['class' => 'txt', 'placeholder' => 'Password'])->label(false) ?></div>
            <div class="input_box valid_star_non"><?= $form->field($model, 'confirm_password')->passwordInput([
					'class' => 'txt',
					'placeholder' => 'Confirm Password'
				])->label(false) ?></div>
            <div class="pass_info">Your password needs to contain at least 8 characters, one upper case and one numeric
                character.
            </div>

            <div id="accepted">

                <div><label>
						<?php echo $form->field($model, 'accept_term', [
							'options' => ['tag' => 'span',],
							'template' => "{input}"
						])->checkbox(['checked' => false])->label(false); ?>
                        <div id="terms" style="float:left; margin-top: 12px;"> I have read and accept <a
                                    href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/bluesky-terms"
                                    target="_blank">Bluesky terms</a>
                    </label></div>
            </div>
        </div>
		<?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary btn_signup fl']) ?>


    </div>


</div>
<?php ActiveForm::end(); ?>
<!-- /.row -->


<!-- Footer -->

</div>
<style>

    #accepted .help-block {
        color: red;
        font-family: arial;
        font-size: 12px;
        position: absolute;
        top: 16px;
        width: 300px;
    }

    #accepted .field-signupform-accept_term {
        float: left;
    }


</style>

<!-- /.container -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/frontend/web/js/chosen.jquery.js"
        type="text/javascript"></script>

<script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "100%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
<script type="text/javascript">
    function customCheckbox(checkboxName) {
        var checkBox = $('#signupform-accept_term');
        $(checkBox).each(function () {
            $(this).wrap("<span class='custom-checkbox'></span>");
            if ($(this).is(':checked')) {
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function () {
            $(this).parent().toggleClass("selected");
        });
    }

    $(document).ready(function () {
        customCheckbox('#signupform-accept_term');

    })
</script>
