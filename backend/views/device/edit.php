<?php

use yii\helpers\Html;

$this->title = 'Update Device';
$this->params['breadcrumbs'][] = ['label' => 'Device', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->farmID, 'url' => ['view', 'id' => $model->farmID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div id="margin_mobile" class="page-header">
    <div class="pull-left">
        <h1> <?= Html::encode($this->title) ?></h1>
    </div>
</div>
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('Manage Farms', ['/farm']); ?><i class="icon-angle-right"></i></li>
        <li><span class="readcrum_without_link">Update Farm</span></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>
<!--    calling update form here-->
<?= $this->render('_formupdate', [
	'model' => $model,
	'modelAdmin' => $modelAdmin,
]) ?>
