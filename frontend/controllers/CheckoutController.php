<?php

namespace frontend\controllers;

use frontend\models\Coupon;
use Yii;
use yii\web\View;

/**
 * Class CheckoutController
 * @package frontend\controllers
 */
class CheckoutController extends \yii\web\Controller
{
	/**
	 * call index action
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * apply coupon
	 * @return string
	 */
	public function actionApplyCoupon()
	{
		$couponCode = $_POST['coupon'];
		$couponDate = date('y-m-d h:i:s');
		$modelCouponQuery = Coupon::find()->where(['CouponCode' => $couponCode, 'CouponStatus' => '1']);
		$objCoupon = $modelCouponQuery->one();
		if (!(is_object($objCoupon))) {
			$arrResult['error'] = true;
			$arrResult['errorMessage'] = 'Coupon code is invalid';
		} else {
			//$modelCouponQuery->
			$modelCouponQuery->andwhere('StartDate<=:from', array('from' => $couponDate));
			$modelCouponQuery->andwhere('EndDate>=:from', array('from' => $couponDate));
			if (!(is_object($modelCouponQuery->one()))) {
				$arrResult['error'] = true;
				$arrResult['errorMessage'] = 'Coupon code is expired';
			} else {
				$arrResult['error'] = false;
				$subtotal = \Yii::$app->cart->getCost();
				$discount = round($subtotal * $objCoupon->Discount / 100, 2);
				$total = $subtotal - $discount;
				$arrResult['discount'] = $discount;
				$arrResult['total'] = $total;
				$arrResult['successMessage'] = 'Coupon code is successfully applied';
			}
		}
		return json_encode($arrResult);
	}

}
