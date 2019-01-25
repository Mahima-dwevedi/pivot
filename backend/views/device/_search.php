<?php

use kartik\widgets\TypeaheadBasic;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!-- search-form starts here-->
<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>Search Device</h3>
            </div>
            <div class="box-content nopadding">
				<?php
				$form = ActiveForm::begin([
					'action' => ['device/'],
					'method' => 'get',
					'options' => ['class' => 'form-horizontal form-bordered']
				]);
				?>
                <div class="row-fluid">
                    <div class="wide form">
                        <div class="span6">
                            <div class="control-group">
								<?= Html::activeLabel($model, 'DeviceSerialNo',
									['label' => 'Device Sim Number', 'class' => 'control-label']) ?>
                                <div class="controls">
									<?php
									//                                    if ($model->deviceSearchList) {
									//                                        echo $form->field($model, 'FormSearch')->widget(TypeaheadBasic::classname(), [
									//                                            'data'=>$model->deviceSearchList,
									//                                            'options' => ['placeholder' => 'Type Farm Name'],
									//                                            'pluginOptions' => ['highlight' => true],
									//                                        ])->label(false);
									//                                    } else {
									echo $form->field($model,
										'DeviceSerialNo')->textInput(['placeholder' => 'Type Sim Number'])->label(false);
									?>

                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="form-actions span12  search">
                                    <div class="form-group">
										<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
										<?= Html::a('Reset', ['device/index'],
											['id' => 'resetVal', 'class' => 'btn btn-default']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
						ActiveForm::end();
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- search-form ends here-->
