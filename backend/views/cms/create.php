<?php

use yii\helpers\Html;

$this->title = 'Create Cms';
$this->params['breadcrumbs'][] = ['label' => 'Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <div class="pull-left">
        <h1> <?= Html::encode($this->title) ?></h1>
    </div>
</div>
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('CMS Summary', ['/cms']); ?><i class="icon-angle-right"></i></li>
        <li><a href="#">Add CMS Page</a></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>
<!--Calling page form file-->
<?= $this->render('_form', [
	'model' => $model,
]) ?>

