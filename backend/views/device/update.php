<?php

use backend\models\Device;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>Manage Devices</h3>
            </div>
            <div class="box-content nopadding">

				<?php Pjax::begin(['id' => 'farm-gird']) ?>
				<?php
				$form = ActiveForm::begin([
					'id' => 'farm-form',
					'enableAjaxValidation' => false,
					'action' => 'update',
					'options' => [
						'class' => 'form-horizontal form-bordered form-validate',
					],
				]);
				?>
                <div class="wide form">
                    <div class="span6">
                        <div class="control-group">
							<?= Html::activeLabel($farmModel, 'farmName', [
								'label' => 'Select Farm <span class="required">*</span>',
								'class' => 'control-label'
							]) ?>
                            <div class="controls">
								<?php
								$model = new Device;
								$modelfarm = $model->getFarmlevel();
								if (!$modelfarm) {
									$modelfarm = [];
								}
								echo $form->field($farmModel, 'farmName')->dropDownList($modelfarm,
									['prompt' => 'Select farm account'])->label(false);

								?>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
							<?= Html::activeLabel($searchModel, 'DeviceSerialNo', [
								'label' => 'Select Device <span class="required">*</span>',
								'class' => 'control-label'
							]) ?>
                            <div class="controls">
								<?php
								echo $form->field($searchModel, 'DeviceSerialNo')->dropDownList(
									ArrayHelper::map(Device::find()->all(), 'pkDeviceID', 'DeviceUnitNo'),
									['prompt' => 'Select Device'])->label(false);
								?>
                            </div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="row-fluid">
                        <div class="row-fluid">
                            <div class="form-actions span12  search">
                                <div class="form-group">

									<?= Html::submitButton('Assign', ['class' => 'btn btn-primary']) ?>
									<?php echo Html::a('Cancel', array('/device/index'), array('class' => 'btn')); ?>
                                </div>
                            </div>
                        </div
                    </div>
					<?php ActiveForm::end(); ?>
					<?php Pjax::end() ?>
                </div>
            </div>
        </div>
        
    </div>

