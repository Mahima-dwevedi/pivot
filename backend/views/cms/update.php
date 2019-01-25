<?php

use yii\helpers\Html;

$this->title = 'Edit Cms';
$this->params['breadcrumbs'][] = ['label' => 'Cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<!-- page heading starts here -->
<div class="page-header">
    <div class="pull-left">
        <h1> <?= Html::encode($this->title) ?></h1>
    </div>
</div>
<!-- page heading ends here -->

<!-- breadcrumbs heading start here -->
<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('CMS Summary', ['/cms']); ?><i class="icon-angle-right"></i></li>
        <li><a href="#">Edit CMS Page</a></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>
<!-- breadcrumbs heading ends here -->

<!-- calling for html here -->
<?= $this->render('_form', [
	'model' => $model,
]) ?>
