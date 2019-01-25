// JS

function toggleCheckboxes(flag) {  
    var form = document.getElementById('user-role-form');
    var inputs = form.elements;
    if(flag == 'true'){
	    for (var i = 0; i < inputs.length; i++) { 
	      if (inputs[i].type == "checkbox") {
	        inputs[i].checked = true;
	      }  
	    }
	    $('#checkAllID').val('false');
    }else{
    	for (var i = 0; i < inputs.length; i++) { 
   	      if (inputs[i].type == "checkbox") {
   	        inputs[i].checked = false;
   	      }  
   	    }
    	$('#checkAllID').val('true');
    }
}

function toggleSubCheckboxes(ID)
{
	if($('.mod'+ID).find('input[type="checkbox"]').prop("checked") == true){
		$('div.mod'+ID+'_attr').find('input[type="checkbox"]').prop('checked', true);
	}else{
		$('div.mod'+ID+'_attr').find('input[type="checkbox"]').prop('checked', false);
	}
}
$(function() {
    $('input[type="reset"]').on('click', function(evt) {
	
	evt.preventDefault();
	$form = $(evt.target).closest('form');
	$form[0].reset();
	$form.find('select').select2();
    });
});
