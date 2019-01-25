<?php

namespace backend\controllers;

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Field;
use backend\models\Equipment;
use backend\models\EquipmentMeta;
use backend\models\PivotSummary;

class ListViewController extends Controller {

	/**
	 * load list view with data
	 * @param string $ID
	 * @return mixed
	 */
    public function actionIndex($ID = '') {

        $pivotSummary = new PivotSummary;
        if (!isset(Yii::$app->user->id)) {
            return $this->redirect(['/site/login']);
        } elseif (Yii::$app->user->identity->user_type == 'farm-admin') {

            $model = new Field();
            $allField = $model->getEquipmentField();

            if (!empty($ID)) {
                $fieldID = Yii::$app->request->get('ID');
                $conn = \Yii::$app->db;
                $query = "SELECT `tbl_device`.DeviceSerialNo,tbl_irrigation.irrigationName,tbl_field.fieldName,`tbl_equipment`.*"
                        . " FROM `tbl_equipment` "
                        . " LEFT JOIN `tbl_irrigation` ON `tbl_equipment`.`fkIrrigationID` = `tbl_irrigation`.`irrigationID`"
                        . " LEFT JOIN `tbl_field` ON `tbl_equipment`.`fkFieldID` = `tbl_field`.`fieldID`"
                        . " LEFT JOIN tbl_device ON `tbl_equipment`.fkDeviceID = tbl_device.pkDeviceID"
                        . " LEFT JOIN `EquipmentMeta` ON `tbl_equipment`.`pkEquipmentID` = `EquipmentMeta`.`fkEquipmentID` "
                        . " WHERE `tbl_equipment`.`fkFieldID`=:fieldID group by `tbl_equipment`.pkEquipmentID order by tbl_equipment.EquipmentName asc";
                $allEquipment = $conn->createCommand($query)->bindValue(":fieldID", $fieldID)->queryAll();

                // loop through all equipment
                for ($i = 0; $i < count($allEquipment); $i++) {

                	//get Last pressure
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
					$calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
					$heading = $pivotSummary->calculateHeading($checkIn,$calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $heading = $heading + $deviceOffset;
                    }

					$allEquipment[$i]['heading'] = $heading;
                    $allEquipment[$i]['pressure'] = $checkIn['pressure'];
                    $moveNoPressure = $pivotSummary->getAlarmMoveNoPressure($allEquipment[$i]['DeviceSerialNo'],$checkIn['pressure']);
                    $allEquipment[$i]['moveNoPressure'] = $moveNoPressure;
                    $noMovePressure = $pivotSummary->getAlarmMovePressure($allEquipment[$i]['DeviceSerialNo'], $checkIn['pressure']);
                    $allEquipment[$i]['noMovePressure'] =$noMovePressure;
                    //speed from device table after calculation
                    $speed = $pivotSummary->getSpeed($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['speed'] = $speed;
                    //direction from device table after calculation
                    $direction = $pivotSummary->getDirection($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['direction'] = $direction;
                    //alert from device table after calculation
					
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReason'] = $motionArray[1];
					
                }
            } else {

                $allEquipment = Field::getListField();
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
					$calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
					$heading = $pivotSummary->calculateHeading($checkIn,$calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $heading = $heading + $deviceOffset;
                    }

					$allEquipment[$i]['heading'] = $heading;
                    $allEquipment[$i]['pressure'] = $checkIn['pressure'];
                    $moveNoPressure = $pivotSummary->getAlarmMoveNoPressure($allEquipment[$i]['DeviceSerialNo'],$checkIn['pressure']);
                    $allEquipment[$i]['moveNoPressure'] = $moveNoPressure;
                    $noMovePressure = $pivotSummary->getAlarmMovePressure($allEquipment[$i]['DeviceSerialNo'], $checkIn['pressure']);
                    $allEquipment[$i]['noMovePressure'] =$noMovePressure;

                    //speed from device table after calculation
                    $speed = $pivotSummary->getSpeed($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['speed'] = $speed;

                    //direction from device table after calculation
                    $direction = $pivotSummary->getDirection($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['direction'] = $direction;

                    //alert from device table after calculation
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReason'] = $motionArray[1];
                }
            }
            $this->layout = 'mainsubadmin';
            return $this->render('index', [
                        'model' => $allField, 'allEquipment' => $allEquipment,
            ]);
        } elseif (Yii::$app->user->identity->user_type == 'field-admin') { //check if user type is field admin

            $model = new Field();
            $allField = $model->getAssignedfieldtech();
            if (!empty($ID)) {
                $fieldID = Yii::$app->request->get('ID');
                $conn = \Yii::$app->db;
                // generate query here
                $query = "SELECT `tbl_device`.DeviceSerialNo,tbl_irrigation.irrigationName,tbl_field.fieldName,`tbl_equipment`.*"
                        . " FROM `tbl_equipment` "
                        . " LEFT JOIN `tbl_irrigation` ON `tbl_equipment`.`fkIrrigationID` = `tbl_irrigation`.`irrigationID`"
                        . " LEFT JOIN `tbl_field` ON `tbl_equipment`.`fkFieldID` = `tbl_field`.`fieldID`"
                        . " LEFT JOIN tbl_device ON `tbl_equipment`.fkDeviceID = tbl_device.pkDeviceID"
                        . " LEFT JOIN `EquipmentMeta` ON `tbl_equipment`.`pkEquipmentID` = `EquipmentMeta`.`fkEquipmentID` "
                        . " WHERE `tbl_equipment`.`fkFieldID`=:fieldID group by `tbl_equipment`.pkEquipmentID order by EquipmentMeta.id desc";
                $allEquipment = $conn->createCommand($query)->bindValue(":fieldID", $fieldID)->queryAll();

                // loop through all equipment
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
					$calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
					$heading = $pivotSummary->calculateHeading($checkIn,$calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $heading = $heading + $deviceOffset;
                    }

					$allEquipment[$i]['heading'] = $heading;
                    $allEquipment[$i]['pressure'] = $checkIn['pressure'];
                    $moveNoPressure = $pivotSummary->getAlarmMoveNoPressure($allEquipment[$i]['DeviceSerialNo'],$checkIn['pressure']);
                    $allEquipment[$i]['moveNoPressure'] = $moveNoPressure;
                    $noMovePressure = $pivotSummary->getAlarmMovePressure($allEquipment[$i]['DeviceSerialNo'], $checkIn['pressure']);
                    $allEquipment[$i]['noMovePressure'] =$noMovePressure;

                    //speed from device table after calculation
                    $speed = $pivotSummary->getSpeed($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['speed'] = $speed;

                    //direction from device table after calculation
                    $direction = $pivotSummary->getDirection($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['direction'] = $direction;
                    //alert from device table after calculation
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReason'] = $motionArray[1];
                }
            } else {
                $allEquipment = Field::getTechnicianField();
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
					$calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
					$heading = $pivotSummary->calculateHeading($checkIn,$calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $heading = $heading + $deviceOffset;
                    }
					$allEquipment[$i]['heading'] = $heading;
                    $allEquipment[$i]['pressure'] = $checkIn['pressure'];
                    $moveNoPressure = $pivotSummary->getAlarmMoveNoPressure($allEquipment[$i]['DeviceSerialNo'],$checkIn['pressure']);
                    $allEquipment[$i]['moveNoPressure'] = $moveNoPressure;
                    $noMovePressure = $pivotSummary->getAlarmMovePressure($allEquipment[$i]['DeviceSerialNo'], $checkIn['pressure']);
                    $allEquipment[$i]['noMovePressure'] =$noMovePressure;

                    //speed from device table after calculation
                    $speed = $pivotSummary->getSpeed($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['speed'] = $speed;

                    //direction from device table after calculation
                    $direction = $pivotSummary->getDirection($allEquipment[$i]['DeviceSerialNo']);
                    $allEquipment[$i]['direction'] = $direction;

                    //alert from device table after calculation
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReason'] = $motionArray[1];
                }
            }

            $this->layout = 'mainfieldadmin';
            return $this->render('index', [
                        'model' => $allField, 'allEquipment' => $allEquipment,
            ]);
        }
    }

	/**
	 * stop equipment
	 * @param $id
	 */
	public function actionStopEquip($id) {
        Equipment::stopEqipment($id);
        $this->redirect(['/list-view']);
    }

}
