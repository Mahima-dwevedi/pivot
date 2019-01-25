<?php

use a3ch3r46\tinymce\TinyMCE;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\cms */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$this->registerJs(
	'$("document").ready(function(){ 
        $("#cms-gird").on("pjax:end", function() {
            $.pjax.reload({container:"#cms-grid-list-form"});  //Reload GridView
        });
    });'
);
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-table"></i><?php echo $model->id ? 'Edit CMS Page' : 'Add New CMS Page'; ?></h3>
                <a class="btn pull-right" data-toggle="modal"
                   href="<?php echo Yii::$app->urlManager->createUrl('/cms'); ?>"><i class="icon-circle-arrow-left"></i>
                    Back</a>
            </div>
            <div class="box-content nopadding">
                <!-- Enable pjax and setting the form starts from here -->
				<?php Pjax::begin(['id' => 'cms-gird']) ?>
				<?php $form = ActiveForm::begin([
					'id' => 'cms-form',
					'enableAjaxValidation' => false,
					'options' => [
						'class' => 'form-horizontal form-bordered form-validate',
					],

				]); ?>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageTitle',
						['label' => 'Page Title <span class="required">*</span>', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?= $form->field($model, 'pageTitle')->textInput(['maxlength' => 150])->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'slug',
						['label' => 'Slug <span class="required">*</span>', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?= $form->field($model, 'slug')->textInput(['maxlength' => 100])->label(false); ?>
                        <p>Hint: Front-end url page name only (ex : about)</p>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'options', ['class' => 'control-label']) ?>
                    <div class="controls">
						<?php echo $form->field($model, 'options')->dropDownList([
							'footer' => 'Footer',
							'others' => 'Others'
						])->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageMetaTitle',
						['label' => 'Meta Title', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?= $form->field($model, 'pageMetaTitle')->textarea(['rows' => 4])->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageMetaKewords',
						['label' => 'Meta Kewords', 'class' => 'control-label']) ?>

                    <div class="controls">
						<?= $form->field($model, 'pageMetaKewords')->textarea(['rows' => 4])->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageMetaDescription',
						['label' => 'Meta Description', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?= $form->field($model, 'pageMetaDescription')->textarea(['rows' => 4])->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageContent', ['label' => 'Content', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?php echo $form->field($model, 'pageContent')->widget(TinyMCE::className())->label(false); ?>
                    </div>
                </div>
                <div class="control-group">
					<?= Html::activeLabel($model, 'pageStatus',
						['label' => 'Status <span class="required">*</span>', 'class' => 'control-label']) ?>
                    <div class="controls">
						<?php echo $form->field($model, 'pageStatus')->dropDownList([
							'1' => 'Active',
							'0' => 'Inactive'
						])->label(false); ?>

                    </div>
                </div>
                <div class="note"><strong>Note :</strong> <span class="required">*</span> Indicates mandatory fields.
                </div>
                <div class="form-actions">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
						['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					<?php echo Html::a('Cancel', array('/cms'), array('class' => 'btn')); ?>
                </div>
				<?php ActiveForm::end(); ?>
				<?php Pjax::end() ?>
                <!-- form ends from here -->
            </div>
        </div>
    </div>
</div>


