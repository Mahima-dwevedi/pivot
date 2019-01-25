<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

/**
 * Class PaginationField
 * @package common\components
 */
class PaginationField extends Widget
{
	/**
	 * call parent init
	 */
    public function init()
    {
        parent::init();
    }

	/**
	 * render pagination layout
	 * @return mixed
	 */
    public function run()
    {
        return $this->render('paginationfield');
    }
}
