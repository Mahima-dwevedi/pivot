<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\cms */

$this->title = 'Edit Cms';
$this->params['breadcrumbs'][] = ['label' => 'Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-header">
	<div class="pull-left">
		 <h1> <?= Html::encode($this->title) ?></h1>
	</div>
</div>
<div class="breadcrumbs">
	<ul>
		<li><?php echo Html::a('Home',['/site/index']); ?><i class="icon-angle-right"></i></li>
		<li><?php echo Html::a('CMS Summary',['/cms']); ?><i class="icon-angle-right"></i></li>
		<li><a href="#">Edit CMS Page</a></li>
	</ul>
	<div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
