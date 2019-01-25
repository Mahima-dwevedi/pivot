<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
//use app\models\Admin;

use yii as YII;
use frontend\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
    
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pivot</title>

    <!-- Bootstrap Core CSS -->
    <!--<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css_layout/bootstrap.min.css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!--<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/font-awesome/css/font-awesome.min.css">

    <!-- Plugin CSS -->
    <!--<link rel="stylesheet" href="css/animate.min.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css_layout/animate.min.css">
    <!-- Custom CSS -->
    <!--<link rel="stylesheet" href="css/creative.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css_layout/creative.css">
    
    <!--Plugin JS-->
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/jquery.easing.min.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/jquery.fittext.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/wow.min.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/jquery.checkradios.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/chosen.jquery.min.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/bootstrap-datetimepicker.min.js">
    <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js_layout/custom.js">
    
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<meta charset="utf-8">
<link rel="icon" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/img/favicon.ico" type="image/x-icon" />
</head>

 <body <?php if (!isset(Yii::$app->user->id)) echo 'class="login"'; ?> data-layout-sidebar="fixed" data-layout-topbar="fixed" class="sidebar-left">
<?php $this->beginBody() ?> 
     <div class="row">     
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              
                <a class="navbar-brand" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/frontend/web/img_layout/logo.png" align="logo"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
 </div>
     <!--<header>-->
        <?php echo $content; ?> 
     <!--</header>--> 

    

<!-- jQuery -->
    

</body>
</html>

<?php $this->endPage() ?>
