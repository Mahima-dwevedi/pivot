<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'View CMS';
$this->params['breadcrumbs'][] = ['label' => 'Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <div class="pull-left">
        <h1>View CMS </h1>
    </div>
</div>
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('CMS Summary', ['/cms']); ?><i class="icon-angle-right"></i></li>
        <li><a href="#">View CMS </a></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>View CMS</h3>
                <a class="btn pull-right" data-toggle="modal"
                   href="<?php echo Yii::$app->urlManager->createUrl('/cms'); ?>"><i class="icon-circle-arrow-left"></i>
                    Back</a>
            </div>
            <div class="box-content nopadding">
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'pageTitle',
						'slug',
						[

							'label' => 'Page Content',
							'format' => 'html',
							'value' => Html::decode($model->pageContent),

						],
						'pageMetaTitle',
						'pageMetaKewords',
						'pageMetaDescription:ntext',
						'createdBy',
						'updatedBy',
						[
							'label' => 'Show Page',
							'value' => $model->options == 'footer' ? 'Footer' : 'Others',
						],
						[
							'label' => 'Page Status',
							'value' => $model->pageStatus == '0' ? 'Inactive' : 'Active',
						],
						[
							'label' => 'Modified Date',
							'value' => $model->modifiedDate != '0000-00-00 00:00:00' ? date("d M, Y H:i",
								strtotime($model->modifiedDate)) : date("d M, Y h:i", strtotime($model->modifiedDate)),

						],
					],
				]) ?>
            </div>
        </div>
    </div>
</div>

