<?php

namespace common\components;
 
use Yii;
use yii\base\Component;

/**
 * add all common functions here
 * Class CommonFunction
 * @package common\components
 */
class CommonFunction extends Component {

	/**
	 * return subscription plan
	 * @param $status
	 * @return string
	 */
    public function subscriptionPlan($status)
    {
        switch ($status) {
			case 0:
				$returnVal = "Free";
				break;
			case 1:
				$returnVal = "Paid";
				break;
			default:
				$returnVal = "";
		}
        return $returnVal;
    }

	/**
	 * Set Status Change icon
	 * @param $status
	 * @return string
	 */
    public function statusFormat($status)
    {
        switch ($status){
			case 1:
				$returnVal = "<span class='label label-satgreen'>Active</span>";
				break;
			case 2:
				$returnVal = "<span class='label label label-yellow'>Inactive</span>";
				break;
			default:
				$returnVal = "<span class='label label label-red'>Reject</span>";
		}
        return $returnVal;
    }
 
}


?>
