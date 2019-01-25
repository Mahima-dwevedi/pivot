<?php

namespace backend\controllers;

use Yii;
use backend\models\PivotSummary;

/**
 * Class PivotSummaryController
 * @package backend\controllers
 */
class PivotSummaryController extends Controller {

	/**
	 * collect summary and load to index page
	 * @return mixed
	 */
    public function actionIndex() {
        $id = \Yii::$app->request->get('id');

        if ($id) {
        	// load summary
            $pivotSummary = new PivotSummary;
            $model = $pivotSummary->getSummary($id);
            $getLastCheckins = $pivotSummary->getCheckIn($model['DeviceSerialNo']);
            $pressure = $getLastCheckins['pressure'];
            $direction = $pivotSummary->getDirection($model['DeviceSerialNo']);
            $lastStopTime = $pivotSummary->getLastStopTime($model["EqpStatus"], $id);
            $calibration = $pivotSummary->getCalibration($model["DeviceSerialNo"]);
            $moveNoPressure = $pivotSummary->getAlarmMoveNoPressure($model["DeviceSerialNo"], $pressure);
            $noMovePressure = $pivotSummary->getAlarmMovePressure($model["DeviceSerialNo"], $pressure);
            $idleDuration = $pivotSummary->getIdleDuration($model["EqpStatus"], $model['id']);
            $speed = $pivotSummary->getSpeed($model["DeviceSerialNo"]);
            $waterRate = $pivotSummary->getWaterRate($model["DeviceSerialNo"], $model['EqpWellCapacity'], $model['EqpAcresWatered']);
            $needCycle = $pivotSummary->getNeedCycle($model['DesiredRate'], $model['EqpAcresWatered'], $model['TankLevel']);
            $position = $pivotSummary->calculateHeading($getLastCheckins, $calibration);

            if(!empty($model['deviceOffset']))
            {
                $deviceOffset = $model['deviceOffset'];
                $position = $position + $deviceOffset;
            }

            $alarmWithNoPressure = $pivotSummary->getAlarmWithNoPressure($model['EqpStatus'], $pressure, $model['EquipmentType']);
            $lastReportTime = $getLastCheckins['timestamp'];
            if (Yii::$app->user->identity->user_type == 'field-admin') {
                $this->layout = 'mainfieldadmin';
            } else {
                $this->layout = 'mainsubadmin';
            }

            // render index with data
            return $this->render('index', [
                        'model' => $model,
                        'direction' => $direction,
                        'position' => $position,
						'signalStrength' => $getLastCheckins['signalStrength'],
                        'moveNoPressure' => $moveNoPressure,
                        'noMovePressure' => $noMovePressure,
                        'idleDuration' => $idleDuration,
                        'pressure' => $pressure,
                        'speed' => $speed,
                        'waterRate' => $waterRate,
                        'needCycle' => $needCycle,
                        'alarmWithNoPressure' => $alarmWithNoPressure,
                        'lastReportTime' => $lastReportTime,
                        'lastStopTime' => $lastStopTime]);
        }
    }

}
