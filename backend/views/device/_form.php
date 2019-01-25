<?php

use backend\models\ImportFieldMapping;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-table"></i><?= Html::encode($this->title) ?></h3>
                <a class="btn pull-right" data-toggle="modal"
                   href="<?php echo Yii::$app->urlManager->createUrl('/device'); ?>"><i
                            class="icon-circle-arrow-left"></i> Back</a>
            </div>
            <div class="box-content nopadding">
				<?php
				$form = ActiveForm::begin([
					'id' => 'active-form',
					'options' => [
						'class' => 'form-horizontal form-bordered',
						'enctype' => 'multipart/form-data'
					],
				]);
				?>
                <div class="fullwidth">
                    <div class="control-group">
						<?php $model->radio = 1; ?>
						<?= Html::activeLabel($model, 'radio',
							['label' => 'Choose Option<span class="required">*</span>', 'class' => 'control-label']) ?>
                        <div class="controls">
                            <div class="span2" style=float:left;>
								<?= $form->field($model, 'radio')->radioList(array('1' => 'Manual Enter'),
									array('onclick' => 'usfields(1);'))->label(false); ?>
                            </div>
                            <div style=float:left;>
								<?= $form->field($model, 'radio')->radioList(array('2' => 'Upload a file'),
									array('onclick' => 'usfields(2);'))->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div class="cb"></div>
                </div>
                <div class="box-contenqt nopadding" id="manual" style="display:block">
					<?php yii\widgets\Pjax::begin(['id' => 'device-gird']) ?>
					<?php
					$form = ActiveForm::begin([
						'id' => 'device-form',
						'enableAjaxValidation' => false,
						'options' => [
							'class' => 'form-horizontal form-bordered form-validate',
						],
					]);
					?>
                    <div class="fullwidth">
                        <div class="control-group">
							<?= Html::activeLabel($model, 'DeviceSerialNo', [
								'label' => 'SIM Number of Pivot Monitor<span class="required">*</span>',
								'class' => 'control-label'
							]) ?>
                            <div class="controls">
								<?= $form->field($model, 'DeviceSerialNo',
									['errorOptions' => ['class' => 'error']])->textInput()->label(false); ?>
                            </div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="fullwidth">
                        <div class="control-group">
							<?= Html::activeLabel($model, 'DeviceUnitNo', [
								'label' => 'UNIT Number of Pivot Monitor<span class="required">*</span>',
								'class' => 'control-label'
							]) ?>
                            <div class="controls">
								<?= $form->field($model, 'DeviceUnitNo',
									['errorOptions' => ['class' => 'error']])->textInput()->label(false); ?>
                            </div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="fullwidth">
                        <div class="control-group">
							<?= Html::activeLabel($model, 'DeviceComment', [
								'label' => 'Device Comments
                            ',
								'class' => 'control-label'
							]) ?>
                            <div class="controls">
								<?= $form->field($model, 'DeviceComment',
									['errorOptions' => ['class' => 'error']])->textInput()->label(false); ?>
                            </div>
                        </div>
                        <div class="cb"></div>
                    </div>
                    <div class="control-group">
						<?= Html::activeLabel($model, 'fkFarmID',
							['label' => 'Farm Account', 'class' => 'control-label']) ?>
                        <div class="controls">
							<?php
							$modelfarm = $model->getFarmlevel();
							if ($modelfarm == '') {
								$modelfarm = [];
							}
							echo $form->field($model, 'fkFarmID')->dropDownList($modelfarm,
								['prompt' => 'Select farm account'])->label(false);

							?>
                        </div>
                    </div>
                    <div class="note"><strong>Note :</strong> <span class="required">*</span> Indicates mandatory
                        fields.
                    </div>
                    <div class="form-actions">
						<?= Html::submitButton($model->isNewRecord ? 'Create Device' : 'Update Device',
							['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
						<?php echo Html::a('Cancel', array('/device/index'), array('class' => 'btn')); ?>
                    </div>
					<?php ActiveForm::end(); ?>
					<?php yii\widgets\Pjax::end() ?>
                </div>
                <div class="box-contwent nopadding" id="csvupload" style="display:none">
					<?php
					$form = ActiveForm::begin(
						[
							'action' => ['device/import'],
							'options' => ['enctype' => 'multipart/form-data']
						]);
					?>
                    <div class="control-group">
                        <div class="form-actions span12 csv-upload1">
                            <div class="fileUpload">
								<?= $form->field($searchModel, 'source_file')->fileInput()->label(false) ?>
								<?php echo Html::a("CSV Sample(Download)", ['/../uploaded_files/device.csv'],
									['download' => true]) ?>
                            </div>
                        </div>
                        <div class="form-actions span12 csv-upload2">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
					<?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function usfields(id) {
        $('#usfields').show();
        if (id == 2) {
            $('#manual').hide();
            $('#csvupload').show();
        }
        else {
            $('#manual').show();
            $('#csvupload').hide();
        }
    }

    $(function () {
        $("#device-devicecellularservicephone").mask("999-999-9999");
    });
</script>
