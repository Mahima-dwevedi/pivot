<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package backend\assets
 */
class AppAsset extends AssetBundle
{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/themes.css',
        'css/plugins/icheck/all.css',
        'css/plugins/jquery-ui/smoothness/jquery-ui.css',
        'css/plugins/jquery-ui/smoothness/jquery.ui.theme.css',
        'css/plugins/jquery-ui/smoothness/jquery.ui.theme.css',
        'css/plugins/select2/select2.css',
        'css/plugins/gritter/jquery.gritter.css',
	
    ];
   
    public $js = [
        'js/jquery.maskedinput.min.js',
      	'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/plugins/nicescroll/jquery.nicescroll.min.js',
        'js/plugins/imagesLoaded/jquery.imagesloaded.min.js',
        'js/plugins/jquery-ui/jquery.ui.core.min.js',
        'js/plugins/jquery-ui/jquery.ui.widget.min.js',
        'js/plugins/jquery-ui/jquery.ui.mouse.min.js',
        'js/plugins/jquery-ui/jquery.ui.resizable.min.js',
        'js/plugins/jquery-ui/jquery.ui.sortable.min.js',
        'js/plugins/touch-punch/jquery.touch-punch.min.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        'js/plugins/select2/select2.min.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
   
}
