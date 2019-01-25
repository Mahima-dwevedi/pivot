<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchcms */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cms';
$this->params['breadcrumbs'][] = $this->title;

?>

<script type="text/javascript">
    jQuery(function($) {
        
        $('.search-button').click(function(){
            $('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
  
   	$('#cms-grid').yiiGridView('update', {
		data: $(this).serialize(),
                   
        });
        return false;
        
            
        
});
});
</script>

<div class="cms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row-fluid">
    <div class="span12 margin_top20">
        <?= Html::a('Create Cms', ['create'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('Advanced Search', null, ['href' => 'javascript:void(0);','class' => 'search-button btn btn-inverse']) ?>
       
    </div> 
</div>
    
    <div class="search-form" style="display:none">
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div><!-- search-form -->

   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row-fluid">
        <div class="breadcrumbs" id="breadcrumbs-msg">
	<?php  if( (Yii::$app->session->hasFlash('create')) || (Yii::$app->session->hasFlash('update')) || (Yii::$app->session->hasFlash('deletecms'))){ ?>
		<ul>
		  <?php
			if(Yii::$app->session->getFlash('create'))
			{
			    echo '<li><span class="readcrum_without_link_success">'.ADD_CMS_SUCCESS.'</li>';
			}else if(Yii::$app->session->getFlash('update'))
			{
			    echo '<li><span class="readcrum_without_link_success">'.EDIT_CMS_SUCCESS.'</li>';
			}else if(Yii::$app->session->getFlash('deletecms'))
			{
			    echo '<li><span class="readcrum_without_link_success">'.DELETE_CMS_SUCCESS.'</li>';
			}
		  ?>						
	      </ul>
	<?php } ?>
</div>

    
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>All CMS</h3>
                    <!--<a class="btn pull-right" data-toggle="modal" href="#" id = "viewAll">View All</a>-->
            </div>
            <div class="clear"></div>

            <div class="box-content nopadding">
                <?php \yii\widgets\Pjax::begin(['id' => 'cms-grid-list-form']); ?>
                <form action="" name='cms-grid-list-form' id='cms-grid-list-form'>
                
                 
                   <?= GridView::widget([
                'id'=>'cms-grid',
                'dataProvider' =>$dataProvider,
                       
               // 'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'name' => 'id[]',
                'class' => 'yii\grid\CheckboxColumn',
                
                
                ],
           
             [
                 'attribute' => 'pageTitle',
                'value' => function ($data) {
                return $data->pageTitle; // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'pagetitle']
               ],
                         
              [
                 'attribute' => 'options',
                'value' => function ($data) {
                return $data->options=='footer'?'footer':'others'; // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'pagesatus']
               ],
                         
             [
                 'attribute' => 'pageStatus',
                'value' => function ($data) {
                return $data->pageStatus=='0'?'Inactive':'Active'; // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'pagesatus']
               ],
               [
                    'attribute' => 'createdBy',
                     'value' => function ($data) {
                return  $data->createdBy; // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'modifiedDate']
               ],   
                [
                    'attribute' => 'updatedBy',
                     'value' => function ($data) {
                return  $data->updatedBy; // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'updatedBy']
               ],   
           
            
            [
                'attribute' => 'modifiedDate',
                     'value' => function ($data) {
                return  date("d M, Y H:i",  strtotime($data->modifiedDate)); // $data['name'] for array data, e.g. using SqlDataProvider.
                 },
                 'contentOptions'=>['class'=>'updatedDate']
               ],
                         
          // ['class' => 'yii\grid\ActionColumn'],
          
          
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {info}',
                'buttons' => [
                 'info' => function ($url, $model) {
            return Html::a('<span class="glyphicon icon-list-alt my_font_icon"></span>', $url,  [
                        'title' => Yii::t('app', 'Preview'), 'data-pjax' => '0', 'target'=>'_blank'
            ]);
        },
         'view' => function ($url, $model) {
            return Html::a('<span class="glyphicon icon-eye-open my_font_icon"></span>', $url, [
                        'title' => Yii::t('app', 'View'), 'data-pjax' => '0',
            ]);
        },
        'update' => function ($url, $model) {
            return Html::a('<span class="glyphicon icon-pencil my_font_icon"></span>', $url, [
                        'title' => Yii::t('app', 'Edit'), 'data-pjax' => '0',
            ]);
        },
        'delete' => function ($url, $model) {
            return Html::a('<span class="glyphicon icon-trash my_font_icon"></span>', $url, [
                        'title' => Yii::t('app', 'delete'), 'data-pjax' => '0',  'data-confirm' => 'Are you sure you want to delete this item?',
            ]);
        }
        
],
        'urlCreator' => function ($action, $model, $key, $index) {
        if ($action === 'info') {
            $url = Yii::$app->urlManager->createUrl(['../../../view/', 'slug' => $model->slug]);
             //$url ='../../../view?slug='.$model->slug;
                 return $url;
        }
         if ($action === 'view') {
             $url = Yii::$app->urlManager->createUrl(['cms/view', 'id' => $model->id]);
             return $url;
        }
         if ($action === 'update') {
              $url = Yii::$app->urlManager->createUrl(['cms/update', 'id' => $model->id]);
             
                 return $url;
        }
         if ($action === 'delete') {
              $url = Yii::$app->urlManager->createUrl(['cms/delete', 'id' => $model->id]);
                 return $url;
        }
    }
                
                ],
            
        ],
    ]); ?>
               <div class="select_box_pagi">
						<select id="cmsStatus1" name="cmsStatus" class="" onchange="cmsMultipleAction();">
							<option value="Select">Select Action</option>
							
							<option value="2">Delete</option>
						</select>
					</div>
                </form>
                <?php \yii\widgets\Pjax::end(); ?>
               
            </div>
        </div>
       

</div>
    
    <script>
    
     function cmsMultipleAction()
    {
        
    
        var checked_num = $('input[name="id[]"]:checked').length;
       
      
        if (!checked_num) {
            alert('Please select atleast one.');
            $.pjax.reload({container:'#cms-grid'});
        }
        else
        {
	      
               if(confirm('Are you sure you want to delete this item?')) { 
               
            if ($('#cmsStatus').val()=='Select') {
				alert('Please Select valid option');
			}
		       else
		       {
                        
                            var data=$("#cms-grid-list-form").serialize();
                                                        
			        $.ajax({
			        type: 'POST',
			        url: '<?php echo Yii::$app->getUrlManager()->createUrl("cms/multipledelete");?>',
			        data:data,
			        success:function(data){
                                   
			        	         if(data)
			                        { 
			                        	var statusMsg = "";
			                        	
			                        		statusMsg = 'CMS pages '+ data+'d'+' successfully.';	
			                        	
                                                       
			                        	
			                            $('#breadcrumbs-msg').css('display','block');
			                            $('#breadcrumbs-msg').html("<ul><li><span class='readcrum_without_link_success'>"+statusMsg+"</span></li></ul>");
			                            $('#breadcrumbs-msg').fadeOut(5000);
                                                     $.pjax.reload({container:'#cms-grid'});
			                            statusMsg = '';
			                        }
			          },error: function(data) { // if error occured
			              alert("Error occured.Please try again.");
			             $.pjax.reload({container:'#cms-grid'});
			         },
			        dataType:'html'
			        });
			        
		        }
                        }else {
                        $.pjax.reload({container:'#cms-grid'});
                        }
		    }
		
       
       
    }
  
   
    </script>
    
