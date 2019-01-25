<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchBank */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Devices';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pull-right margin_top20 mobile_margin">
	<?= Html::a('Add New Device', ['create'], ['class' => 'btn btn-success']) ?>
</div>
<div class="user-index">

    <div class="page-header">
        <div class="pull-left">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="breadcrumbs">
        <ul>
            <li><?php echo Html::a('Home', ['/site/index']); ?><i class="icon-angle-right"></i></li>
            <li><span class="readcrum_without_link"><?= Html::encode($this->title) ?></span></li>
        </ul>
        <div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
    </div>
    <div class="breadcrumbs" id="message">
    </div>
    <div class="breadcrumbs" id="breadcrumbs-msg">
		<?php if ((Yii::$app->session->hasFlash('create')) || (Yii::$app->session->hasFlash('update')) || (Yii::$app->session->hasFlash('createirrigation')) || (Yii::$app->session->hasFlash('errorupdate')) || (Yii::$app->session->hasFlash('assign')) || (Yii::$app->session->hasFlash('delete')) || (Yii::$app->session->hasFlash('error')) || (Yii::$app->session->hasFlash('active')) || (Yii::$app->session->hasFlash('import')) || (Yii::$app->session->hasFlash('sourcefileerror')) || (Yii::$app->session->getFlash('unassign'))) { ?>
            <ul>
				<?php
				if (Yii::$app->session->getFlash('create')) {
					echo '<li><span class="readcrum_without_link_success">' . ADD_DEVICE_SUCCESS . '</li>';
				} else {
					if (Yii::$app->session->getFlash('update')) {
						echo '<li><span class="readcrum_without_link_success">' . EDIT_DEVICE_SUCCESS . '</li>';
					} else {
						if (Yii::$app->session->getFlash('delete')) {
							echo '<li><span class="readcrum_without_link_success">' . DEACTIVATE_DEVICE_SUCCESS . '</li>';
						} else {
							if (Yii::$app->session->getFlash('error')) {
								echo '<li><span class="readcrum_without_link_success">' . ERROR_DEVICE_SUCCESS . '</li>';
							} else {
								if (Yii::$app->session->getFlash('active')) {
									echo '<li><span class="readcrum_without_link_success">' . ACTIVATE_DEVICE_ACCOUNT . '</li>';
								} else {
									if (Yii::$app->session->getFlash('assign')) {
										echo '<li><span class="readcrum_without_link_success">' . ASSIGN_DEVICE_ACCOUNT . '</li>';
									} else {
										if (Yii::$app->session->getFlash('import')) {
											echo '<li><span class="readcrum_without_link_success">' . CSV_IMPORT_SUCCESS . '</li>';
										} else {
											if (Yii::$app->session->getFlash('sourcefileerror')) {
												echo '<li><span class="readcrum_without_link_success">' . SOURCE_FILE_ERROR . '</li>';
											} else {
												if (Yii::$app->session->getFlash('errorupdate')) {
													echo '<li><span class="readcrum_without_link_success">' . DEVICE_UPDATE_ERROR . '</li>';
												} else {
													if (Yii::$app->session->getFlash('createirrigation')) {
														echo '<li><span class="readcrum_without_link_success">' . IRRIGATION_CREATE_SUCCESS . '</li>';
													} else {
														if (Yii::$app->session->getFlash('unassign')) {
															echo '<li><span class="readcrum_without_link_success">Device has been successfully unassigned.</li>';
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				?>
            </ul>
		<?php }
		?>
    </div>
    <div class="search-form">
		<?php echo $this->render('update', [
			'searchModel' => $searchModel,
			'farmModel' => $farmModel,
		]); ?>
    </div><!-- search-form -->

    <div class="search-form">
		<?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div><!-- search-form -->
    <div class="cb"></div>

    <div class="row-fluid">
		<?php \yii\widgets\Pjax::begin(['id' => 'device-grid']); ?>


        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3><i class="icon-reorder"></i><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="clear"></div>

            <div class="box-content nopadding">
				<?php \yii\widgets\Pjax::begin(); ?>
                <form action="" name='device-grid-list-form' id='device-grid-list-form'>
                    <div class="table-responsive">
						<?=
						GridView::widget([
							'dataProvider' => $dataProvider,
							'id' => 'device-grid',
							'columns' => [

								[
									'name' => 'pkDeviceID',
									'class' => 'yii\grid\CheckboxColumn'
								],
								['class' => 'yii\grid\SerialColumn'],
								[
									'attribute' => 'farmName',
									'label' => 'Farm Name',
									'value' => function ($data) {
										if (isset($data->fkFarmID) && $data->fkFarmID != '') {
											if (is_object($data->farm)) {
												$name = $data->farm->farmName;
											} else {
												$name = 'not assigned';
											}
										} else {
											$name = "not assigned";
										}
										return $name;
									},

								],
								[
									'attribute' => 'DeviceSerialNo',
									'label' => 'Device Sim Number',
									'value' => function ($data) {
										return $data->DeviceSerialNo;
									},
								],
								[
									'attribute' => 'DeviceUnitNo',
									'label' => 'Device Unit Number',
									'value' => function ($data) {
										return $data->DeviceUnitNo;
									},
								],

								[
									'attribute' => 'DeviceAddDate',
									'label' => 'Created Date',
									'value' => function ($data) {
										return date("m-d-Y", strtotime($data->DeviceAddDate));
									},
								],
								[
									'attribute' => 'DeviceStatus',
									'label' => 'Status',
									'value' => function ($data) {
										return $data->DeviceStatus;
									},
								],
								[
									'header' => 'Action',
									'class' => 'yii\grid\ActionColumn',
									'template' => '{view} {deactivate} {activate} {assign} {unassign} {delete}',
									'buttons' => [
										'deactivate' => function ($url) {
											return Html::a('<span class="glyphicon icon-ban-circle my_font_icon"></span>',
												$url, [
													'title' => Yii::t('app', 'deactivate'),
													'data-pjax' => '0',
													'data-confirm' => 'Are you sure you want to deactivate this account?',
												]);
										},
										'activate' => function ($url) {
											return Html::a('<span class="glyphicon icon-ok my_font_icon"></span>', $url,
												[
													'title' => Yii::t('app', 'activate'),
													'data-pjax' => '0',
													'data-confirm' => 'Are you sure you want to activate this account?',
												]);
										},
										'view' => function ($url) {
											return Html::a('<span class="glyphicon icon-eye-open my_font_icon"></span>',
												$url, [
													'title' => Yii::t('app', 'view'),
													'data-pjax' => '0',
												]);
										},
										'assign' => function ($url) {
											return Html::a('<span class="glyphicon icon-edit my_font_icon"></span>',
												$url, [
													'title' => Yii::t('app', 'assign'),
													'data-pjax' => '0',
												]);
										},
										'unassign' => function ($url) {
											return Html::a('<span class="glyphicon glyphicon-share my_font_icon"></span>',
												$url, [
													'title' => Yii::t('app', 'unassign'),
													'data-pjax' => '0',
												]);
										},

									],
									'urlCreator' => function ($action, $model) {
										if ($action === 'activate') {
											$url = Yii::$app->urlManager->createUrl([
												'device/activate',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}
										if ($action === 'deactivate') {
											$url = Yii::$app->urlManager->createUrl([
												'device/deactivate',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}
										if ($action === 'view') {
											$url = Yii::$app->urlManager->createUrl([
												'device/view',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}
										if ($action === 'assign') {
											$url = Yii::$app->urlManager->createUrl([
												'device/assign',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}
										if ($action === 'unassign') {
											$url = Yii::$app->urlManager->createUrl([
												'device/unassign',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}
										if ($action === 'delete') {
											$url = Yii::$app->urlManager->createUrl([
												'device/delete',
												'id' => $model->pkDeviceID
											]);
											return $url;
										}

									}
								],

							],
						]);
						?>
                    </div>
                    <div class="control-group">
                        <div class="controls faqstatusDropdown">
							<?= Html:: dropDownList('DeviceStatus', '',
								['activate' => 'Active', 'deactivate' => 'Deactive',], [
									'prompt' => '--Choose Action--',
									'onchange' => 'deviceMultipleAction(this.value)',
									'id' => 'DeviceStatus'
								]) ?>
                        </div>
                    </div>
					<?= Html::endForm() ?>
					<?php \yii\widgets\Pjax::end(); ?>
					<?php echo common\components\PaginationField::widget(); ?>

            </div>

        </div>
    </div>

    <script>
        
        // multiple action for device table
        function deviceMultipleAction(action) {
            var checked_num = $('input[name="pkDeviceID[]"]:checked').length;

            if (!checked_num) {
                alert('Please select atleast one.');
                $.pjax.reload({container: '#device-grid'});
                $(document).on('pjax:complete', function () {
                    $("#DeviceStatus").select2();
                });
            }
            else {
                if (action == 'activate' || action == 'deactivate') {

                    if ($('#DeviceStatus').val() == 'Select') {
                        alert('Please Select valid option');
                    }
                    else {
                        if (confirm("Are you sure you want to perform this action?")) {
                            var data = $("#device-grid-list-form").serialize();
                            $.ajax({
                                type: 'POST',
                                url: 'changestatus',
                                data: data,

                                success: function (data) {

                                    if (data) {
                                        var statusMsg = "";
                                        statusMsg = 'device status has been Update successfully.';
                                        $('#message').html("<div class='breadcrumbs' id='breadcrumbs-msg'><ul><li><span class='readcrum_without_link_success'>" + statusMsg + "</span></li></ul></div>");
                                        $('#breadcrumbs-msg').fadeOut(3000);
                                        $.pjax.reload({container: '#device-grid'});
                                        $(document).on('pjax:complete', function () {
                                            $("#faqStatus").select2();
                                        });
                                        statusMsg = '';
                                    }
                                }, error: function (data) { // if error occured
                                    alert("Error occured.Please try again.");
                                    $.pjax.reload({container: '#device-grid'});
                                    $(document).on('pjax:complete', function () {
                                        $("#DeviceStatus").select2();
                                    });
                                },
                                dataType: 'html'
                            });
                        } else {
                            $('input[type="checkbox"]').prop('checked', false);
                            $("#farmStatus").select2("val", "Select");
                        }
                    }
                }
            }
        }

    </script>


