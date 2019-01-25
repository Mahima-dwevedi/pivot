 <?php
 use yii\helpers\Html;
 use yii\widgets\LinkPager;
 //print_r($varFaqData);
 ?>
 
<?php
if(count($varFaqData2) > 0)
{

 foreach ($varFaqData2 as $data):   
     
            if($data->id == '1' ){ echo "tewrwerwerwer";?>
             <div class="panel panel-default">
          <div class="panel-heading  panel_active">
            <h5 class="panel-title">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id ; ?>">
                <?= Html::decode("{$data ->question}") ?>
                <i></i>
              </a>
            </h5>
          </div>
          <div id="collapse<?php echo $data->id ; ?>" class="panel-collapse collapse in">
            <div class="panel-body">
              <?= Html::decode("{$data ->answer}") ?>
            </div>
          </div>
        </div>

          <?php } else if($data->id != '1' ){   ?>

         <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id ; ?>">
                 <?= Html::decode("{$data ->question}") ?>
                <i></i>
              </a>
            </h5>
          </div>
          <div id="collapse<?php echo $data->id ; ?>" class="panel-collapse collapse">
            <div class="panel-body">
             <?= Html::decode("{$data ->answer}") ?>
            </div>
          </div>
        </div>

    <?php } 
    
    
    endforeach;
}else {?>
       <div class="panel panel-default">
        
            <h5 class="panel-title">
              Record not found!
            </h5>
         
         
        </div>
    
 <?php }
    ?>   

  <script>
        $(document).ready( function() {
			$('.panel-heading').first().addClass('panel_active');
    $('#myCarousel').carousel({
		pause: true,
    interval: false
	});
	
	var clickEvent = false;
	$('#myCarousel').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
	//faq accordion
	 $('.collapse').on('shown.bs.collapse', function(){ 
	 $('.panel-heading').removeClass('panel_active');
$(this).parent().find(".fa-plus-circle").removeClass("fa-plus-circle").addClass("fa-minus-circle");
$(this).parent().find('.panel-heading').addClass('panel_active');
}).on('hidden.bs.collapse', function(){
	$('.panel-heading').removeClass('panel_active');
$(this).parent().find(".fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
//$(this).parent().find('.panel-heading').addClass('panel_active');
});
	
	
});
</script>