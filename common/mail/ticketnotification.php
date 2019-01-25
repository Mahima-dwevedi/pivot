<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ticket Details</title>
<style>
#table_box tr td{padding:15px 10px;border-right:1px solid #ccc;border-bottom:1px solid #ccc;border-left:1px solid #ccc; font-size:15px;}
#table_box1 tr td{padding:15px 10px;border-bottom:1px solid #ccc; font-size:15px;}
.content_wrap strong{display:block; line-height:24px;}
.content_wrap h3{border-bottom:1px solid #ccc; padding-bottom:8px;}
.content_wrap p{line-height:20px;}
</style>
</head>

<body>
<table cellspacing="0" cellpadding="0" width="1006" border="0" align="center" style="text-align:center; font-family: Arial, Helvetica, sans-serif;">
<tr>
<td>
<!--inner table-->
<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">




<tr>
<td valign="top">
<div style="width:100%; color:#252222; text-align:justify; margin:0 auto;">
<p style="font-size:15px;">Dear <?php echo $params->first_name;?>,</p>
<h3>Ticket Details</h3>
</div>
</td></tr><tr><td width="50%" valign="top">
<table id="table_box" cellspacing="0" cellpadding="0" width="94%" border="0" align="left" style="text-align:left; border-top:1px solid #ccc;">
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Status:</td><td><?php echo $params->status;?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Priority:</td><td><?php echo $params->priority!=''?$params->priority:'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Department:</td><td><?php echo $params->fkdepartmentID!=''?app\models\department::showDepartmentName($params->fkdepartmentID):'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Create Date:</td><td><?php echo $params->created_at!='0000-00-00 00:00:00'?date("d M, Y h:i",  strtotime($params->created_at)):'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">SIM:</td><td><?php echo $params->sim!=''?$params->sim:'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Plan:</td><td><?php echo $params->plan!=''?$params->plan:'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Device Details:</td><td><?php echo $params->device_details!=''?$params->device_details:'N/A';?></td></tr>
<tr style="height:36px;"><td colspan="2" style="border-left:none; border-right:none;">&nbsp;</td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Assigned To:</td><td><?php echo $params->assign_to!=''?app\models\Admin::showMemberName($params->assign_to):'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">SLA Plan:</td><td><?php echo $params->slaplan!=''?$params->slaplan:'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Due Date:</td><td><?php echo $params->date_from!='0000-00-00'?date("d M, Y",  strtotime($params->date_from)):'N/A';?> To <?php echo $params->date_to!='0000-00-00'?date("d M, Y",  strtotime($params->date_to)):'N/A';?></td></tr>
</table>
</td>
<td width="50%" valign="top">
<table id="table_box" cellspacing="0" cellpadding="0" width="94%" border="0" align="right" style="text-align:left; border-top:1px solid #ccc;">
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Name:</td><td><?php echo $params->first_name.' '.$params->last_name;?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Email:</td><td><?php echo $params->email;?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Phone:</td><td><?php echo $params->phone_number;?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Source:</td><td><?php echo $params->source;?></td></tr>
<tr style="height:36px;"><td colspan="2">&nbsp;</td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Help Topic:</td><td><?php echo $params->fkhelptopicID!=''?app\models\helptopic::showTopicName($params->fkhelptopicID):'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Last Message:</td><td><?php echo $params->created_at!='0000-00-00 00:00:00'?date("d M, Y h:i",  strtotime($params->created_at)):'N/A';?></td></tr>
<tr><td style="width:33%;background-color:#005596;color:#ffffff; font-weight:bold;">Last Response:</td><td>&nbsp;</td></tr>
</table>

</td></tr>
<tr style="height:36px;"><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2">

<table id="table_box1" cellspacing="0" cellpadding="0" width="100%" border="0" align="center" style="text-align:left; border-top:1px solid #ccc;border-left:1px solid #ccc;border-right:1px solid #ccc;">
<tr><td>
<div class="content_wrap">
<h3>Subject: <?php echo $modelIssue->subject;?></h3>
<strong>Ticket Thread</strong>
<strong style="border-bottom:1px solid #ccc; padding-bottom:5px;">Issue</strong>
<p><?php echo $modelIssue->issue!=''?$modelIssue->issue:'N/A';?></p>

<strong style="border-bottom:1px solid #ccc; padding-bottom:5px;">Internal Note</strong>
<p><?php echo $modelIssue->internalnote!=''?$modelIssue->internalnote:'N/A';?></p>
</div>
</td></tr>


</table>
</td></tr>

<tr><td><p style="font-size:15px;margin-top:24px; text-align:left;">Thank You</p></td></tr>

</table><!--inner table-->

<body>



</html>
