<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Apply | Uturn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper">
    <div class="container-fluid apply">
        <div class="fullscreen">
            <div class="section">
                <div class="container">
                    <h4>Thanks for your interest in Uturn.</h4>
                    <div class="row">
                        <p><strong>Let's get started! </strong> The first step in joining Uturn is to authorize us to
                            connect with your YouTube channel to start the application process.</p>
                        <p><a href="http://10.0.0.89/uturn/auth/google_oauth2?ref=" target="_blank"
                              class="btn gradient cta">Connect</a></p>
                        <p>FYI: When you click CONNECT, you'll see a quick authorization page from YouTube before you're
                            routed back to Uturn. If you have multiple YouTube channels, be sure you connect the right
                            one (the one that you want to partner with Uturn).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
