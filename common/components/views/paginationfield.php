<?php
use yii\helpers\Html;
use yii\base\view;

?>
<?php
$request = Yii::$app->request;
// setting up page size for pagination
$pageSize = ($request->get('pageSize')) ? $request->get('pageSize') : 10;
?>
<!--pagination layout setup starts here-->
<div class="row" style="display: block;margin-right: 10px;float: right;width:100%;text-align: right;">
	<div class="form-group col-md-2">
		<form class="pagform" action="" method="get">
		<select name="pageSize" class="paginationSelect" style="width: 110px;">
			<option value="10" <?php if($pageSize == '10'){ echo 'selected'; }?> >10 Results</option>
			<option value="20" <?php if($pageSize == '20'){ echo 'selected'; }?> >20 Results</option>
			<option value="50" <?php if($pageSize == '50'){ echo 'selected'; }?> >50 Results</option>
			<option value="100" <?php if($pageSize == '100'){ echo 'selected'; }?> >100 Results</option>
			<option value="-1" <?php if($pageSize == '-1'){ echo 'selected'; }?> >All Results</option>
		</select>
		</form>
	</div>		
</div>
<!--pagination layout setup ends here-->

<!--pagination layout script starts here-->
<script type="text/javascript">
	$(document).ready(function() {
	  $('.paginationSelect').on('change', function() {
	    $('.pagform').submit();
	  });
	});
</script>
<!--pagination layout script ends here-->
