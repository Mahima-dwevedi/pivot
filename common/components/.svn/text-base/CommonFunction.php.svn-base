<?php

namespace common\components;
 
use Yii;
use yii\base\Component;
 
class CommonFunction extends Component {
 
    /**
     *  return subscription plan
    */
    public function subscriptionPlan($status)
    {
        $returnVal = "";
        if ($status == 1)
        {
            $returnVal = "Paid";
        }
        else if ($status == 0)
        {
            $returnVal = "Free";
        }
        else
        {

        }
        return $returnVal;
    }


    /**
     *  Set Status Change icon
     */
    public function statusFurmate($status)
    {
        $returnVal = "";
        if ($status == 1)
        {
            $returnVal = "<span class='label label-satgreen'>Active</span>";
        }
        else if ($status == 2)
        {
            $returnVal = "<span class='label label label-yellow'>Inactive</span>";
        }
        else
        {
            $returnVal = "<span class='label label label-red'>Reject</span>";
        }
        return $returnVal;
    }
 
}


?>