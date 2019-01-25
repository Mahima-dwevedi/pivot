<?php

namespace frontend\controllers;

use Yii;
use yii\web\View;
use frontend\models\Coupon;

class CheckoutController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionApplycoupon()
    {
       $couponCode=$_POST['coupon'];
       $couponDate=date('y-m-d h:i:s');
       $modelCouponQuery= Coupon::find()->where(['CouponCode'=>$couponCode,'CouponStatus'=>'1']);
       $objCoupon=$modelCouponQuery->one();
       if(!(is_object($objCoupon)))
       {
           $arrResult['error']=true;
           $arrResult['errorMessage']='Coupon code is invalid'; 
       }
       else
       {
            //$modelCouponQuery->
            $modelCouponQuery->andwhere('StartDate<=:from', array('from'=>$couponDate));
            $modelCouponQuery->andwhere('EndDate>=:from', array('from'=>$couponDate));
            if(!(is_object($modelCouponQuery->one())))
            {
                $arrResult['error']=true;
                $arrResult['errorMessage']='Coupon code is expired'; 
            }
            else {
                $arrResult['error']=false;
                $subtotal=\Yii::$app->cart->getCost();
                $discount=round($subtotal*$objCoupon->Discount/100,2);
                $total=$subtotal-$discount;
                $arrResult['discount']= $discount;
                 $arrResult['total']= $total;
                 //\Yii::$app->cart->setCost($total);
                 $arrResult['successMessage']='Coupon code is successfully applied'; 
            }
       }
     echo json_encode($arrResult);  
    }

}
