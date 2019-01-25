$(document).ready(function(){
	$(".MobileOnly").click(function(){
		$("ul.leftSidebar").slideToggle();
	});
	
	$('.checkradios').checkradios();
	
	 var config = {
	'.chosen-select'           : {},     
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    };
	
	
	$(".Mobiletabs").click(function(){
		$("ul.tabbUl").slideToggle();
	});
	
	

})


$(document).ready(function(){
	
	 var config = {
	'.chosen-select'           : {},     
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    };
	
	
	
	$('.checkradios').checkradios();
	
	
	
	

});

    function customCheckbox(checkboxName){
        var checkBox = $('input[name="'+ checkboxName +'"]');
        $(checkBox).each(function(){
            $(this).wrap( "<span class='custom-checkbox'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function(){
            $(this).parent().toggleClass("selected");
        });
    }
   
        customCheckbox("sport[]");
        customCheckbox("car[]");
        customCheckbox("confirm");
   
	
$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });