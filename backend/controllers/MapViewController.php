<?php

namespace backend\controllers;

use Yii;
use backend\models\Field;
use backend\models\Equipment;
use backend\models\EquipmentMeta;
use backend\models\PivotSummary;

/**
 * Class MapViewController
 * @package backend\controllers
 */
class MapViewController extends Controller {

	/**
	 * load map view data for equipment
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
                // make query
                $query = "SELECT tbl_device.DeviceSerialNo,EquipmentMeta.updateDate,EquipmentMeta.PivotStopAction,tbl_irrigation.irrigationName,`tbl_equipment`.*"
                        . " FROM `tbl_equipment` "
                        . " LEFT JOIN `tbl_irrigation` ON `tbl_equipment`.`fkIrrigationID` = `tbl_irrigation`.`irrigationID`"
                        . " LEFT JOIN `tbl_field` ON `tbl_equipment`.`fkFieldID` = `tbl_field`.`fieldID`"
                        . " LEFT JOIN tbl_device ON `tbl_equipment`.fkDeviceID = tbl_device.pkDeviceID"
                        . " LEFT JOIN `EquipmentMeta` ON `tbl_equipment`.`pkEquipmentID` = `EquipmentMeta`.`fkEquipmentID`"
                        . " WHERE `tbl_equipment`.`fkFieldID`=$fieldID group by `tbl_equipment`.pkEquipmentID order by EquipmentMeta.id desc";
                $allEquipment = $conn->createCommand($query)->queryAll();
                for ($i = 0; $i < count($allEquipment); $i++) {

                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
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
                    //position
                    $calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
                    $position = $pivotSummary->calculateHeading($checkIn, $calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $position = $position + $deviceOffset;
                    }

                    $allEquipment[$i]['position'] = $position;				
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReasonNotes'] = $motionArray[1][0];
                    $allEquipment[$i]['motionReasonText'] = $motionArray[1][1];				
					$overallColor = $this->getOverallColor($checkIn['pressure'],$motionArray[0]);
                    $allEquipment[$i]['overallColor'] = $overallColor;
                }
            } else {
                $allEquipment = Field::getListField();
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
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
                    $calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
                    $position = $pivotSummary->calculateHeading($checkIn, $calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $position = $position + $deviceOffset;
                    }

                    $allEquipment[$i]['position'] = $position;				
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReasonNotes'] = $motionArray[1][0];
                    $allEquipment[$i]['motionReasonText'] = $motionArray[1][1];				
					$overallColor = $this->getOverallColor($checkIn['pressure'],$motionArray[0]);
                    $allEquipment[$i]['overallColor'] = $overallColor;
                }
            }
            $this->layout = 'mainsubadmin';
            return $this->render('index', [
                        'model' => $allField, 'allEquipment' => $allEquipment,
            ]);
        } elseif (Yii::$app->user->identity->user_type == 'field-admin') {
			// load field model
            $model = new Field();
            $allField = $model->getAssignedfieldtech();

            if (!empty($ID)) {
                $fieldID = Yii::$app->request->get('ID');
                $conn = \Yii::$app->db;
                $query = "SELECT tbl_device.DeviceSerialNo,EquipmentMeta.updateDate,EquipmentMeta.PivotStopAction,tbl_irrigation.irrigationName,`tbl_equipment`.*"
                        . " FROM `tbl_equipment` "
                        . " LEFT JOIN `tbl_irrigation` ON `tbl_equipment`.`fkIrrigationID` = `tbl_irrigation`.`irrigationID`"
                        . " LEFT JOIN `tbl_field` ON `tbl_equipment`.`fkFieldID` = `tbl_field`.`fieldID`"
                        . " LEFT JOIN tbl_device ON `tbl_equipment`.fkDeviceID = tbl_device.pkDeviceID"
                        . " LEFT JOIN `EquipmentMeta` ON `tbl_equipment`.`pkEquipmentID` = `EquipmentMeta`.`fkEquipmentID` "
                        . " WHERE `tbl_equipment`.`fkFieldID`=$fieldID group by `tbl_equipment`.pkEquipmentID order by EquipmentMeta.id desc";
                $allEquipment = $conn->createCommand($query)->queryAll();
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
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
                    $calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
                    $position = $pivotSummary->calculateHeading($checkIn, $calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $position = $position + $deviceOffset;
                    }
                    
                    $allEquipment[$i]['position'] = $position;				
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReasonNotes'] = $motionArray[1][0];
                    $allEquipment[$i]['motionReasonText'] = $motionArray[1][1];				
					$overallColor = $this->getOverallColor($checkIn['pressure'],$motionArray[0]);
                    $allEquipment[$i]['overallColor'] = $overallColor;
                }
            } else {
                $allEquipment = Field::getTechnicianField();
                for ($i = 0; $i < count($allEquipment); $i++) {
                    $checkIn = $pivotSummary->getCheckIn($allEquipment[$i]['DeviceSerialNo']);
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
                    $calibration = $pivotSummary->getCalibration($allEquipment[$i]["DeviceSerialNo"]);
                    $position = $pivotSummary->calculateHeading($CheckIn, $calibration);

                    if(!empty($allEquipment[$i]['deviceOffset']))
                    {
                        $deviceOffset = $allEquipment[$i]['deviceOffset'];
                        $position = $position + $deviceOffset;
                    }

                    $allEquipment[$i]['position'] = $position;				
					$motionArray = $pivotSummary->determineMotion($checkIn,$calibration);
					$allEquipment[$i]['movementColor'] = $motionArray[0];
                    $allEquipment[$i]['motionReasonNotes'] = $motionArray[1][0];
                    $allEquipment[$i]['motionReasonText'] = $motionArray[1][1];				
					$overallColor = $this->getOverallColor($checkIn['pressure'],$motionArray[0]);
                    $allEquipment[$i]['overallColor'] = $overallColor;
                }
            }
            $this->layout = 'mainfieldadmin';
            return $this->render('index', [
                        'model' => $allField, 'allEquipment' => $allEquipment,
            ]);
        }
    }

	/**
	 * @param $pressure
	 * @param $color
	 * @return string
	 */
	private function getOverallColor($pressure,$color){	
		if (($pressure == "1" && $color == "Green")) {
			return "Green";
		} elseif (($pressure == "0" && $color == "Red") || $color == "Gray") {
			return "Gray";
		} elseif ($color == "Yellow"){
			return "Yellow";
		} else {
			return "Red";
		}
		
	}

	/**
	 * map view stop equipment
	 * @param $id
	 */
    public function actionStopEquip($id) {
    	// load equipment model
        $model = Equipment::findOne($id);
        $model->EqpStatus = 0;
        $model->save();
        $equip = EquipmentMeta::findAll(['fkEquipmentID' => $id]);
        foreach ($equip as $key => $value) {
            $eqMeta = EquipmentMeta::findOne($value['id']);
            $eqMeta->PivotStopAction = 0;
            $eqMeta->updateDate = date('Y-m-d H:i:s');
            $eqMeta->save(false);
        }
        $this->redirect(['/map-view']);
    }

}
