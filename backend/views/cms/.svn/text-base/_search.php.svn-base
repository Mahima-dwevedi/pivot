<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searchcms */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#_search-form").on("pjax:end", function() {
            $.pjax.reload({container:"#cms-grid-list-form"});  //Reload GridView
        });
    });'
);
?>
<div class="row-fluid">
<div class="span12">
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>Advanced Search  </h3>
        </div>
        <div class="box-content nopadding">
		

 <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
         'id'=>'_search-form',
         'enableAjaxValidation'=>true,
                                 'validateOnSubmit'=>true,
     'options' => ['class' => 'form-horizontal form-bordered'],
     
    
    ]); ?>
            
      		<div class="row-fluid">
                <div class="wide form">
                    <div class="span4">
                        <div class="control-group">
                            <?= Html::activeLabel($model, 'pageTitle', ['label'=>'Page Title', 'class'=>'control-label']) ?>
                         
                            <div class="controls">
                                
                                 <?= $form->field($model, 'pageTitle')->textInput()->label(false); ?>
                            </div>
                        </div>
                    </div>
                   
		      <!--<div class="span4">
                        <div class="control-group">
                           <?= Html::activeLabel($model, 'pageContent', ['label'=>'Content', 'class'=>'control-label']) ?>
                            <div class="controls">
                                <?= $form->field($model, 'pageContent')->textInput()->label(false); ?>

                            </div>
                        </div>
                    </div>-->
		      
		    
		     <div class="row-fluid">
                        <div class="form-actions span12  search">
                                <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['cms/index'],  ['id' => 'resetVal', 'class' => 'btn btn-default']) ?>
    </div>
                            


                        </div>
                    </div>
	
	

	
 </div>

 <?php ActiveForm::end(); ?>

</div><!-- search-form -->
</div>
   </div>
   </div>
 </div>
