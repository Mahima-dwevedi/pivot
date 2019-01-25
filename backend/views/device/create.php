<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\faq */

$this->title = 'Create Device';
$this->params['breadcrumbs'][] = ['label' => 'Device', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="margin_mobile" class="page-header">
    <div class="pull-left">
        <h1> <?= Html::encode($this->title) ?></h1>
    </div>
</div>
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('Manage Devices', ['/device/index']); ?><i class="icon-angle-right"></i></li>
        <li><span class="readcrum_without_link">Add Device</span></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>

<?=
$this->render('_form', [
	'model' => $model,
	'searchModel' => $searchModel,
])
?>
