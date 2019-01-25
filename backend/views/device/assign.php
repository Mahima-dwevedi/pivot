<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\cms */

$this->title = 'Assign Farm';
$this->params['breadcrumbs'][] = ['label' => 'Device', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>

<div id="margin_mobile" class="page-header">
    <div class="pull-left">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('Manage Devices', ['/device']); ?><i class="icon-angle-right"></i></li>
        <li><span class="readcrum_without_link">Assign Farm</span></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>
<div id="breadcrumbs-msg" class="breadcrumbs">
    <ul>
		<?php
		if (Yii::$app->session->getFlash('errorupdate')) {
			echo '<li><span class="readcrum_without_link_success">Please select a farm</span></li>';
		}
		?>
    </ul>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>Assign Farm</h3>
            </div>
            <div class="box-content nopadding">
				<?=
				DetailView::widget([
					'model' => $model,

					'attributes' => [
						[
							'label' => 'Device Unit Number    ',
							'format' => 'raw',
							'value' => $model->DeviceUnitNo,
						],
						[
							'label' => 'Status',
							'format' => 'raw',
							'value' => $model->DeviceStatus,
						],
					],
				])
				?>
                <div class="search-form">
                    <div class="box box-color box-bordered">
                        <div class="box-content nopadding">
							<?php
							$form = ActiveForm::begin([
								'id' => 'farm-form',
								'enableAjaxValidation' => false,
								'options' => [
									'class' => 'form-horizontal form-bordered form-validate',
								],
							]);
							?>
                            <div class="wide form">
                                <div class="span12">
                                    <div class="control-group">
										<?= Html::activeLabel($farmModel, 'farmName', [
											'label' => 'Select Farm <span class="required">*</span>',
											'class' => 'control-label'
										]) ?>
                                        <div class="controls">
											<?php
											$modelfarm = $model->getFarmlevel();
											if (!$modelfarm) {
												$modelfarm = [];
											}
											$id = $model->fkFarmID;
											echo $form->field($farmModel, 'farmName')->dropDownList($modelfarm,
												[
													'options' => [$id => ['Selected' => 'selected']],
													'prompt' => 'Select farm account'
												]
											)->label(false);
											?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <div class="form-actions span12  search">
                                            <div class="form-group">

												<?= Html::submitButton('Assign', ['class' => 'btn btn-primary']) ?>
												<?php echo Html::a('Cancel', array('/device/index'),
													array('class' => 'btn')); ?>
                                            </div>
                                        </div>
                                    </div
                                </div>
								<?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

