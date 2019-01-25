<?php

namespace backend\models;

use Yii;

/**
 * Description of PivotSummary
 *
 * @author vinove
 */
class PivotSummary {

	/**
	 * @param $id equipmentid for summary details
	 * @return mixed
	 */
    public function getSummary($id) {
		
        $conn = \Yii::$app->db;
        // generate query
        $query = "select * from(SELECT `tbl_device`.DeviceSerialNo,"
                . " EquipmentMeta.*,tbl_irrigation.irrigationName,`tbl_equipment`.*"
                . " FROM `tbl_equipment` "
                . " LEFT JOIN `tbl_irrigation` ON `tbl_equipment`.`fkIrrigationID` = `tbl_irrigation`.`irrigationID`"
                . " LEFT JOIN `tbl_field` ON `tbl_equipment`.`fkFieldID` = `tbl_field`.`fieldID`"
                . " LEFT JOIN tbl_device ON `tbl_equipment`.fkDeviceID = tbl_device.pkDeviceID"
                . " LEFT JOIN `EquipmentMeta` ON `tbl_equipment`.`pkEquipmentID` = `EquipmentMeta`.`fkEquipmentID`"
                . " WHERE `tbl_equipment`.pkEquipmentID=$id order by EquipmentMeta.id desc) test"
                . " group by test.fkEquipmentID";
        $model = $conn->createCommand($query)->queryOne();
        return $model;
    }

	/**
	 * @param $id
	 * @return mixed
	 */
    public function getCheckIn($id) {
        $conn = \Yii::$app->db;
        $query = "SELECT * FROM pivotTracker.pivotRawCheckIn WHERE pivotTracker.pivotRawCheckIn.simNumber = '" . $id . "' ORDER BY pivotTracker.pivotRawCheckIn.timestamp DESC";
        $model = $conn->createCommand($query)->queryOne();
        return $model;
    }

	/**
	 * @param $id
	 * @return string
	 */
    public function getDirection($id) {
        $model = $this->getLast($id);
        if ($model && count($model) > 1) {
            $model = $model[0]['pivotHeading'] - $model[1]['pivotHeading'];
            if ($model != '0') {
                $model = $model >= 0 ? "Forward" : "Reverse";
            } else {
                $model = "N/A";
            }
        } else {
            $model = "N/A";
        }
        return $model;
    }

	/**
	 * @param $id
	 * @param $pressure
	 * @return string
	 */
    public function getAlarmMoveNoPressure($id, $pressure) {
        if ($pressure == "0") {
            $model = $this->getLast($id);
            if ($model && count($model) > 1) {
                $model = $model[0]['pivotHeading'] - $model[1]['pivotHeading'];
                if ($model == "0") {
                    $model = "No";
                } else {
                    $model = "Yes";
                }
            } else {
                $model = "No";
            }
        } else {
            $model = "No";
        }
        return $model;
    }

	/**
	 * @param $id
	 * @param $pressure
	 * @return string
	 */
    public function getAlarmMovePressure($id, $pressure) {
        if ($pressure == "1") {
            $model = $this->getLast($id);
            if ($model && count($model) > 1) {
                $model = $model[0]['pivotHeading'] - $model[1]['pivotHeading'];
                if ($model == 0) {
                    $model = "Yes";
                } else {
                    $model = "No";
                }
            } else {
                $model = "No";
            }
        } else {
            $model = "No";
        }
        return $model;
    }

	/**
	 * @param $id
	 * @return float|int|string
	 */
    public function getSpeed($id) {
        $model = $this->getLast($id);
        if ($model && count($model) > 1) {
            $degreeDiff = $this->getDegreeDiff($model[0]['pivotHeading'], $model[1]['pivotHeading']);
            $date1 = strtotime(date('Y-m-d H:i:s', strtotime($model[0]['timestamp'])));
            $date2 = strtotime(date('Y-m-d H:i:s', strtotime($model[1]['timestamp'])));
            $dateDiff_s = ($date1 - $date2) / 1000.0;
            $model = $degreeDiff / $dateDiff_s;
            $model = ($model * 3600.0) / 1000.0*0.621371;
            return round($model, 3) . " mph";
        } else {
            $model = "N/A";
        }

        return $model;
    }

	/**
	 * @param $deg1
	 * @param $deg2
	 * @return float|int
	 */
    public function getDegreeDiff($deg1, $deg2) {
        $degreeDiff = abs($deg1 - $deg2);
        if ($degreeDiff > 300) {
            $diffDegree2 = $degreeDiff - 360;
        }if ($degreeDiff < 300) {
            $diffDegree2 = $degreeDiff;
        }
        return $diffDegree2;
    }

	/**
	 * @param $id
	 * @param $capacity
	 * @param $acresWater
	 * @return float|int|string
	 */
    public function getWaterRate($id, $capacity, $acresWater) {
        $model = $this->getLast($id);
        if ($model && count($model) > 1) {
            $degreeDiff = $this->getDegreeDiff($model[0]['pivotHeading'], $model[1]['pivotHeading']);
            $rpm = $degreeDiff / 360;
            $grp = $rpm * $capacity;
            $model = $grp / (27154 * $acresWater);
        } else {
            $model = "N/A";
        }
        return $model;
    }

	/**
	 * @param $desiredRate
	 * @param $acresWater
	 * @param $tankLevel
	 * @return string
	 */
    public function getNeedCycle($desiredRate, $acresWater, $tankLevel) {
        if ($desiredRate != null && $tankLevel != null && $acresWater != null) {
            $x = $desiredRate * $acresWater * 1.2;
            if ($tankLevel < $x) {
                $model = "Yes";
            } else {
                $model = "No";
            }
        } else {
            $model = "N/A";
        }
        return $model;
    }

	/**
	 * @param $id
	 * @return mixed
	 */
    public function getLast($id) {
        $conn = \Yii::$app->db;
        $query = "SELECT pivotTracker.pivotRawCheckIn.* FROM pivotTracker.pivotRawCheckIn WHERE pivotTracker.pivotRawCheckIn.simNumber = '" . $id . "' ORDER BY pivotTracker.pivotRawCheckIn.timestamp DESC LIMIT 2";
        $model = $conn->createCommand($query)->queryAll();
        return $model;
    }

	/**
	 *
	 * @param $id
	 * @return mixed
	 */
    public function getLastToday($id) {
        $conn = \Yii::$app->db;
        $query = "SELECT pivotTracker.pivotRawCheckIn.* FROM pivotTracker.pivotRawCheckIn WHERE pivotTracker.pivotRawCheckIn.simNumber = '" . $id . "' AND DATE(`timestamp`) = DATE(NOW()) ORDER BY pivotTracker.pivotRawCheckIn.timestamp DESC LIMIT 2";
        $model = $conn->createCommand($query)->queryAll();
        return $model;
    }

	/**
	 * get last stop time
	 * @param $status
	 * @param $id
	 * @return false|string
	 */
    public function getLastStopTime($status, $id) {
        if ($status == '1') {
            $model = EquipmentMeta::find()->select("ScheduledStopTime")->where("fkEquipmentID='$id' AND PivotStopAction=1 order by id desc")->one();

            if ($model) {

                if ($model->ScheduledStopTime) {
                    return date('m-d-Y H:i:s', strtotime($model->ScheduledStopTime));
                } else {
                    $model = EquipmentMeta::find()->select("updateDate")->where("fkEquipmentID='$id' AND PivotStopAction=0 order by id desc")->one();
                    if ($model) {
                        if ($model->updateDate) {
                            return date('m-d-Y H:i:s', strtotime($model->updateDate));
                        } else {
                            return "N/A";
                        }
                    } else {
                        return "N/A";
                    }
                }
            } else {
                return "N/A";
            }
        } else {
            $model = EquipmentMeta::find()->select("updateDate")->where("fkEquipmentID='$id' AND PivotStopAction=0 order by id desc")->one();
            if ($model) {
                if ($model->updateDate) {
                    return date('m-d-Y H:i:s', strtotime($model->updateDate));
                } else {
                    return "N/A";
                }
            } else {
                return "N/A";
            }
        }
    }

	/**
	 * @param $N
	 * @param $E
	 * @param $min_n
	 * @param $max_n
	 * @param $min_e
	 * @param $max_e
	 * @param $offset
	 * @return int
	 */
	public function calculateHeadingPart2($N,$E,$min_n,$max_n,$min_e,$max_e,$offset) {

      if ($max_n - $min_n != 0 && $max_e - $min_e != 0) {
		  $N1 = (2 * $N - $max_n - $min_n) / ($max_n - $min_n);
		  $E1 = (2 * $E - $max_e - $min_e) / ($max_e - $min_e); 

		  $yawAngle = atan2(-1*$E1,$N1);
		  
		  //Convert from Radians to Degrees
		  $yawAngle =rad2deg($yawAngle);  
		  $retVal = intval($yawAngle) + $offset;
		  
		  if ($retVal<0) 
			$retVal = $retVal + 360;
		  elseif ($retVal==360)
            $retVal=0;

		  return $retVal;  
	  } else {
		  return 0;
	  }
	}

	/**
	 * @param $checkInData
	 * @param $minMax
	 * @return int
	 */
    public function calculateHeading ($checkInData,$minMax){
		
		if (abs($checkInData['Ax']) > abs($checkInData['Ay']) && abs($checkInData['Ax']) > abs($checkInData['Az'])) {
			if ($checkInData['Ax'] < 0){
				return $this->calculateHeadingPart2($checkInData['My'],$checkInData['Mz'],$minMax['minY'],$minMax['maxY'],$minMax['minZ'],$minMax['maxZ'],-90);
			} else {			
				return $this->calculateHeadingPart2($checkInData['Mz'],$checkInData['My'],$minMax['minZ'],$minMax['maxZ'],$minMax['minY'],$minMax['maxY'],180);
			}
		} else if (abs($checkInData['Ay']) > abs($checkInData['Az'])) {
			if ($checkInData['Ay'] < 0){
				return $this->calculateHeadingPart2($checkInData['Mz'],$checkInData['Mx'],$minMax['minZ'],$minMax['maxZ'],$minMax['minX'],$minMax['maxX'],180);
			} else {
				return $this->calculateHeadingPart2($checkInData['Mx'],$checkInData['Mz'],$minMax['minX'],$minMax['maxX'],$minMax['minZ'],$minMax['maxZ'],-90);			
			}
		} else {
			if ($checkInData['Az'] < 0){
				return $this->calculateHeadingPart2($checkInData['Mx'],$checkInData['My'],$minMax['minX'],$minMax['maxX'],$minMax['minY'],$minMax['maxY'],0);			
			} else {
				return $this->calculateHeadingPart2($checkInData['My'],$checkInData['Mx'],$minMax['minY'],$minMax['maxY'],$minMax['minX'],$minMax['maxX'],-90);			
			}
		}
	}

	/**
	 * calculate calibration
	 * @param $serialNo
	 * @return mixed
	 */
    public function getCalibration($serialNo) {
        $con = Yii::$app->db;
        $query = "SELECT MAX( `Mx` ) AS maxX, MIN( `Mx` ) AS minX, MAX( `My` ) AS maxY, MIN( `My` ) AS minY, MAX( `Mz` ) AS maxZ, MIN( `Mz` ) AS minZ FROM pivotTracker.pivotRawCheckIn WHERE pivotTracker.pivotRawCheckIn.simNumber=\"" . $serialNo . "\"";
        $model = $con->createCommand($query)->queryOne();
        return $model;
    }

	/**
	 * get idle duration
	 * @param $status
	 * @param $id
	 * @return string
	 */
    public function getIdleDuration($status, $id) {

        if ($status == "0") {
            $model = EquipmentMeta::find()->select("updateDate")->where("id='$id' AND PivotStopAction='0' order by id desc")->one();
            if ($model) {
                $endDate = date("Y-m-d H:i:s");
                $days = (strtotime($endDate) - strtotime($model['updateDate'])) / (60 * 60 * 24);
                $days = (int) $days;
                if ($days > 4) {
                    $model = "Idle From $days Days";
                } else {
                    $model = "N/A";
                }
            } else {
                $model = "N/A";
            }
        } else {
            $model = "N/A";
        }
        return $model;
    }

	/**
	 * get alarm without pressure
	 * @param $eqpStatus
	 * @param $pressure
	 * @param $type
	 * @return string
	 */
    public function getAlarmWithNoPressure($eqpStatus, $pressure, $type) {
        if ($type == 2) {
            if ($eqpStatus == "1" && $pressure == "0") {
                $model = "red";
            } else {
                $model = "grey";
            }
        } else {
            $model = "N/A";
        }
        return $model;
    }

	/**
	 * get color
	 * @param $currentCheckIn
	 * @param $calibration
	 * @return mixed
	 */
    public function getColor($currentCheckIn,$calibration){ 
		$motionResults = $this->determineMotion($currentCheckIn,$calibration);
		
        return $motionResults[0];
    }

	/**
	 * detemine motion
	 * @param $currentCheckIn
	 * @param $calibration
	 * @return array
	 */
	public function determineMotion($currentCheckIn,$calibration){
		$conn = \Yii::$app->db;
		$query = "SELECT * FROM pivotTracker.pivotRawCheckIn WHERE simNumber = '" . $currentCheckIn['simNumber'] . "' AND timestamp < '". $currentCheckIn['timestamp'] . "' ORDER BY timestamp DESC";
		$result = $conn->createCommand($query)->queryAll();	
		$checkinCount = count($result);
		
		$lastCheckInTime = \DateTime::createFromFormat('Y-m-d H:i:s', $currentCheckIn['timestamp']);
		$twoHoursAgo= new \DateTime("now");
		$twoHoursAgo->modify('-2 hours');
		
		/*
		 * Look for a switch between pressure or 2+ hour gap between check-ins
		 */
		
		$a=$currentCheckIn;
		for ($i = 0; $i < $checkinCount; $i++) {
	
			$aTime = \DateTime::createFromFormat('Y-m-d H:i:s', $a['timestamp']);
			$bTime = \DateTime::createFromFormat('Y-m-d H:i:s', $result[$i]['timestamp']);
			$bTime->modify('+2 hours');
			
			if($bTime < $aTime) {
				break;
			}elseif ($a['pressure'] != $result[$i]['pressure']){
				break;
			} else {	
			}
					
			$a = $result[$i];		
		}
		
	
		$transitionCheckIn=$a;
		$transitionTime = \DateTime::createFromFormat('Y-m-d H:i:s', $transitionCheckIn['timestamp']);
				
		$currentCheckInTime = \DateTime::createFromFormat('Y-m-d H:i:s', $currentCheckIn['timestamp']);
		
		if (is_object ($currentCheckInTime)){
			$currentCheckInDisplayTime = $currentCheckInTime->format('h:i A m-d-Y');
			$currentCheckInDisplayTime = str_replace("M", "M on", $currentCheckInDisplayTime);
			
			$interval = $currentCheckInTime->diff($transitionTime);
		
			$seconds = $interval->days * 24 * 60 *60;
			$seconds += $interval->h * 60 *60;
			$seconds += $interval->i * 60;
			$seconds += $interval->s;
		} else {
			$currentCheckInDisplayTime = "Never";
		}
		
		$theHeading = $this->calculateHeading($currentCheckIn,$calibration);
			
		/*
		 * If the last check-in is older than 2 hours ago, mark as gray
		 * RULE 5
		 */
		if ($lastCheckInTime < $twoHoursAgo) {
			$motion="Gray";
			$reasonCode=array("Last Check-in: ",$currentCheckInDisplayTime);

		/*
		 * Last Check-in is recent and no pressure 
		 * Any check-in within 2 hours of transition is assumed to be stopped
		 * RULE 5, 6, & 7
		 */
		} elseif ($currentCheckIn['pressure'] == 0 && $seconds < 7200){
			$motion="Red";
			$reasonCode=array("Pressure Stopped: ",$currentCheckInDisplayTime);
			
		/*
		 * Last Check-in is recent and pressure 
		 * Any check-in within 2 hours of transition is assumed to be running
		 * RULE 1, 2, & 3
		 */
		} elseif ($currentCheckIn['pressure'] == 1 && $seconds < 7200){
			$motion="Green";	
			$reasonCode=array("Pressure Started: ",$currentCheckInDisplayTime);
			
		/* 
		 * Last Check-in is recent and transition was greater than 2 hours ago
		 */
		 
		 //RULE 4 or 8
		 
		} else {
					
			$query = "SELECT * FROM pivotTracker.pivotRawCheckIn WHERE simNumber = '" . $currentCheckIn['simNumber'] . "' AND timestamp < DATE_SUB('". $currentCheckIn['timestamp'] . "', INTERVAL 2 HOUR) ORDER BY timestamp DESC";		
			$result = $conn->createCommand($query)->queryAll();
			
			if (!$result) {
				echo "Could not successfully run query ($sql) from DB: " . mysql_error();
				exit;
			} else {
				$comparisonHeading = $this->calculateHeading($result[0],$calibration);
			}
			
			$delta=abs($theHeading - $comparisonHeading) % 360;
			$delta = $delta > 180 ? 360 - $delta : $delta;
			
			if ($delta >= 5){
				$motion="Green";
			} else {
				$motion="Red";
			}	
			
			$comparisonCheckInTime = \DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['timestamp']);
			$comparisonTime = $comparisonCheckInTime->format('h:i A');
			
			$reasonCode=array("Note:",$delta . " degrees since " . $comparisonTime);

		}
		
		return array($motion,$reasonCode);
	}

}

?>
