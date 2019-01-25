<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package frontend\assets
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
         'css/font-awesome.min.css',
        
    ];
    
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

