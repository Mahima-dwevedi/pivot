<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\admin;
use backend\models\device;

$this->title = 'View Device';
$this->params['breadcrumbs'][] = ['label' => 'Device', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="margin_mobile" class="page-header">
    <div class="pull-left">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<div class="breadcrumbs">
    <ul>
        <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
        <li><?php echo Html::a('Manage Devices', ['/device']); ?><i class="icon-angle-right"></i></li>
        <li><span class="readcrum_without_link">View Device</span></li>
    </ul>
    <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
</div>


<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>View Plan</h3>
                <a class="btn pull-right" data-toggle="modal" href="<?php echo Yii::$app->urlManager->createUrl('/device'); ?>"><i class="icon-circle-arrow-left"></i> Back</a>
            </div>
            <div class="box-content nopadding">
                <?=
                DetailView::widget([
                    'model' => $model,
                   
                    'attributes' => [
                       [
                            'label' => 'Device Unit Number    ',
                            'format' => 'raw',
                            'value' => $model->DeviceSerialNo,
                        ],
                        [
                            'label' => 'Status',
                            'format' => 'raw',
                            'value' => $model->DeviceStatus,
                        ],
                       
                        
                      ],
                ])
                ?>

            </div>

        </div>
    </div>
</div>

