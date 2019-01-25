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

//require_once 'youtube_oAuth.php';
//require(__DIR__ . '../frontend/web/inc/youtube_oAuth.php');
/* @var $this \yii\web\View */  
/* @var $content string */

AppAsset::register($this);
//echo "<pre>";
//echo Yii::$app->user->identity['username'];
//echo Yii::$app->getUrlManager()->getBaseUrl()."/css/plugins/jquery-ui/smoothness/jquery-ui.css";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
    
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<meta name="google-translate-customization" content="18c1fda6c0e55178-ab40c9a3a9ff6851-gc213302e63501a9f-10"></meta>
    
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">    
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/frontend/web/js/miniPopup.js"></script>
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/frontend/web/css/main.css">

<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css/plugins/jquery-ui/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css/plugins/select2/select2.css">
<!-- Notify -->
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/css/plugins/gritter/jquery.gritter.css">
     
 <script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/bootbox/jquery.bootbox.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/form/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/validation/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/wizard/jquery.form.wizard.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/mockjax/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/eakroko.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/application.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/demonstration.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/icheck/jquery.icheck.min.js"></script>
<!-- Notify -->
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/gritter/jquery.gritter.min.js"></script>

<?php 

if(Yii::$app->controller->getRoute() != 'user/create' && Yii::$app->controller->getRoute() != 'user/update' && Yii::$app->controller->getRoute() != 'ticket/create' && Yii::$app->controller->getRoute() != 'ticket/update' && Yii::$app->controller->getRoute() != 'ticket/index')
{?>
<script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/bootstrap.min.js"></script>
<?php }?>
  
   
	<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/js/plugins/placeholder/jquery.placeholder.min.js"></script>

	 <script>
            $(document).ready(function() {

                $('input, textarea').placeholder();
            });
        </script>
        
        

</head>

 <body <?php if (!isset(Yii::$app->user->id)) echo 'class="login"'; ?> data-layout-sidebar="fixed" data-layout-topbar="fixed" class="sidebar-left">
<?php $this->beginBody() ?>   
    <?php
//        if (isset(Yii::$app->user->id))
//        {
            ?>

            <!-- NAVIGATION STARTS-->
            <div id="navigation">
                <div class="container-fluid">
                <?php echo Html::a('', ['site/index'], ['id' => 'brand']); ?>
                    <?php echo Html::a('<i class="icon-reorder"></i>', '#', array('class' => 'toggle-nav', 'rel' => 'tooltip', 'title' => 'Toggle navigation', 'data-placement' => 'bottom')); ?>

                    <ul class='main-nav'>
                        <?php
                        //$controllerName =Yii::app()->getController()->getId();
                        //$this->varActionName1 = Yii::app()->controller->action->id;
                        ?>
                        
<!--                        <li <?php if (Yii::$app->controller->getUniqueId() == 'site') echo 'class="active"'; ?>>
                            <?php echo Html::a('Dashboard', ['site/index']); ?>
                        </li>
                        
                         <li <?php if (Yii::$app->controller->getUniqueId() == 'user' ) echo 'class="active"'; ?>>
                            <?php echo Html::a('<span>Portal Admin</span> <span class="caret"></span>', 'javascript:void(0);', ['data-toggle' => 'dropdown','class' => 'dropdown-toggle']); ?>
                           <ul class="dropdown-menu">
                                
                                <li class='dropdown'>
                                    
                                    <?php echo Html::a('Manage Customers', Yii::$app->urlManager->createUrl('/customer')); ?>
                                    
                                </li>
                             <li class='dropdown'>
                                    
                                    <?php echo Html::a('Manage Admin User', Yii::$app->urlManager->createUrl('/user')); ?>
                                    
                                </li>
                              <li class='dropdown'>
                                    
                                    <?php echo Html::a('Settings', Yii::$app->urlManager->createUrl('/member/editprofile')); ?>
                                    
                                </li>
                                
                            </ul>
                        </li>
                        

                        <li <?php if (Yii::$app->controller->getUniqueId() == 'cms' || Yii::$app->controller->getUniqueId() == 'faq' || Yii::$app->controller->getUniqueId() == 'homebanner') echo 'class="active"'; ?>>
                            <?php echo Html::a('<span>Portal Setup</span> <span class="caret"></span>', 'javascript:void(0);', ['data-toggle' => 'dropdown', 'class' => 'dropdown-toggle']); ?>
                            <ul class="dropdown-menu">
                                <li class='dropdown'>
                                    <?php echo Html::a('Manage CMS', ['../cms']); ?>
                                    
                                </li>
                                <li class='dropdown'>
                                    <?php echo Html::a('Manage FAQs', ['../faq']); ?>
                                    
                                </li>
                              <li class='dropdown'>
                                    <?php echo Html::a('Manage Banner', ['../homebanner']); ?>
                                    
                                </li>
                              
                                <li class='dropdown'>
                                    <?php echo Html::a('Categories', ['../category']); ?>
                                </li>
                               <li class='dropdown'>
                                <?php //echo Html::a('Attributes', ['/attribute']); ?>
                               </li >
                                <li class='dropdown'>
                                <?php echo Html::a('Product', ['../product']); ?>
                                </li>
                                <li class='dropdown'>
                                <?php echo Html::a('Manage Coupon ', ['../discount']); ?>
                                </li>
                                  <li class='dropdown'>
                                <?php echo Html::a('Combos', ['../combo']); ?>
                                </li>
                                 <li class='dropdown'>
                                <?php echo Html::a('Orders', ['../orders']); ?>
                                </li>
                            </ul>
                        </li>
                        
                           <li <?php if (Yii::$app->controller->getUniqueId() == 'uturnsetup') echo 'class="active"'; ?>>
                            <?php echo Html::a('<span>Uturn Setup</span> <span class="caret"></span>', 'javascript:void(0);', ['data-toggle' => 'dropdown', 'class' => 'dropdown-toggle']); ?>
                          <ul class="dropdown-menu">
                                
                                <li>
                                    <?php echo Html::a('Contact Request', ['/contactrequest'], []); ?>
                                </li>
                              
                            </ul>
                        </li>
                        
                          <li <?php if (Yii::$app->controller->getUniqueId() == 'department' || Yii::$app->controller->getUniqueId() == 'helptopic' || Yii::$app->controller->getUniqueId() == 'ticket') echo 'class="active"'; ?>>
                            <?php echo Html::a('<span>Support Center</span> <span class="caret"></span>', 'javascript:void(0);', ['data-toggle' => 'dropdown', 'class' => 'dropdown-toggle']); ?>
                          <ul class="dropdown-menu">
                                
                                <li>
                                    <?php echo Html::a('Support Setting', ['/department'], []); ?>
                                </li>
                              
                            </ul>
                        </li>-->
            
                        <li>
                            <?php //echo Html::a('<span>Join Uturn</span>', 'javascript:void(0);', ['class' => 'pop-up']); ?>
                            <?php echo Html::a('<span>Join Uturn</span>', ['partner/joinuturn'], []); ?>
                        </li>
                         
                        <li>
                          <?php echo Html::a('Sign In', ['partner/login'], []); ?>
                      </li>                      
                      <!--<li><a href="<?php //echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/site/logout"><img src="<?php //echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/images/logout.png" alt="" /> Logout</a></li>-->
                    </ul>
                    <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </div>
            </div>
            <!-- NAVIGATION ENDS-->

            <div class="container-fluid" id="content" style="">
                <div id="left">
                    <!--<div class="subnav">
                        <div class="subnav-title">
                            <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quick stats</span></a>
                        </div>
                        <div class="subnav-content">
                            <ul class="quickstats">
                              
                            </ul>
                        </div>
                    </div>-->
                    <div class="subnav">
                        <div class="subnav-title">
                            <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Quick Links</span></a>
                        </div>
                        <ul class="subnav-menu">
                          <?php if(Yii::$app->controller->getUniqueId() == 'cms' || Yii::$app->controller->getUniqueId() == 'faq' || Yii::$app->controller->getUniqueId() == 'homebanner' || Yii::$app->controller->getUniqueId() == 'product' || Yii::$app->controller->getUniqueId() == 'combo' || Yii::$app->controller->getUniqueId() == 'orders' || Yii::$app->controller->getUniqueId() == 'discount' || Yii::$app->controller->getUniqueId() == 'category')
                          {?>
                            <li>
                                <?php echo Html::a('Manage CMS', ['/cms']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Manage FAQs', ['/faq']); ?>
                            </li>
                             <li>
                                <?php echo Html::a('Manage Banner', ['/homebanner']); ?>
                            </li>
                             <li>
                                <?php echo Html::a('Manage Products', ['/product']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Manage Combos', ['/combo']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Manage Orders', ['/orders']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Manage Coupons', ['/discount']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Manage Category', ['/category']); ?>
                            </li>
                          <?php } 
                       else if(Yii::$app->controller->getUniqueId() == 'department' || Yii::$app->controller->getUniqueId() == 'helptopic' || Yii::$app->controller->getUniqueId() == 'ticket' || Yii::$app->controller->getUniqueId() == 'staff')
                          {?>
                            <li>
                                  <?php echo Html::a('Manage Department', Yii::$app->urlManager->createUrl('/department')); ?>
                            </li>
                             <li>
                                  <?php echo Html::a('Manage Help Topic', Yii::$app->urlManager->createUrl('/helptopic')); ?>
                            </li>
                             <li>
                                  <?php echo Html::a('Manage Ticket', Yii::$app->urlManager->createUrl('/ticket/list')); ?>
                            </li>
                            <li>
                                  <?php echo Html::a('My Ticket', Yii::$app->urlManager->createUrl('/ticket/myticket')); ?>
                            </li>
                             <li>
                                  <?php echo Html::a('Staff Directory' , Yii::$app->urlManager->createUrl('/staff')); ?>
                            </li>
                            
                          <?php }
                           else if(Yii::$app->controller->getUniqueId() == 'member' ) 
                           {?>
                           
                               
                                
                             <li class='dropdown'>
                                    
                                    <?php echo Html::a('Change Password', Yii::$app->urlManager->createUrl('/member/changepassword')); ?>
                                    
                                </li>
                              <li class='dropdown'>
                                    
                                    <?php echo Html::a('Settings', Yii::$app->urlManager->createUrl('/member/editprofile')); ?>
                                    
                                </li>
                                
                           
                            <?php   } 
                            else if(Yii::$app->controller->getUniqueId() == 'user' || Yii::$app->controller->getUniqueId() == 'customer') 
                           { ?> 
                                 <li><?php echo Html::a('Manage Customers', Yii::$app->urlManager->createUrl('/customer')); ?></li>
                                <li> <?php echo Html::a('Manage Admin User', Yii::$app->urlManager->createUrl('/user')); ?></li>
                                <li> <?php echo Html::a('Settings', Yii::$app->urlManager->createUrl('/member/editprofile')); ?></li>
                                
                               <?php }
                           else {
                                ?>
                               
                             <li>
                                 
                                <?php echo Html::a('Add Banner', ['homebanner/create']); ?>
                            </li>
                            <li>
                                <?php echo Html::a('Add CMS Page', ['cms/create']); ?>
                            </li>
                            
                          <?php }?>
                         
                        </ul>
                    </div>
                    <!--<div class="subnav subnav">
                        <div class="subnav-title">
                            <a href="#" class='toggle-subnav'><i class="icon-angle-right"></i><span>Global Settings</span></a>
                        </div>
                    </div>-->
                </div>
                <div id="main">
                    <div class="container-fluid">
                        <!--<div class="page-header">-->
                      
                        <!--</div>-->
                        <?php
                    //}
                   echo $content;
                    if (isset(Yii::$app->user->id))
                    {
                        ?>
                    </div>
                </div>
            </div>
            
<!--Signup pop start here-->
    <div class="dropdown-menu foralign">
  <div class="fullscreen">
<div class="section">
    <div class="container">
      <h4>Thanks for your interest in Uturn.</h4>
      <div class="row">
          <p><strong>Let's get started! </strong> The first step in joining Uturn is to authorize us to connect with your YouTube channel to start the application process.</p>
          <p><a href="<?php echo $loginUrl;?>" target="_blank" class="btn gradient cta">Connect</a></p>
          <p>FYI: When you click CONNECT, you'll see a quick authorization page from YouTube before you're routed back to Uturn. If you have multiple YouTube channels, be sure you connect the right one (the one that you want to partner with Uturn).</p>
      </div>    
    </div>
  </div>
  </div>
</div>
<!--Signup popup  End here-->              
            
           <!-- <div id="footer">
                <p>uturn- All Rights Reserved</p>
                <?php echo Html::a('<i class="icon-arrow-up"></i>', '#', ['class' => 'gototop']); ?>
            </div>-->
            <script type="text/javascript">
                window.onload = function(){
                    setTimeout(function () {
                        $("#breadcrumbs-msg").fadeOut('slow');
                    }, 5000);
                };
            </script>
        <?php } ?>
            
            <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
