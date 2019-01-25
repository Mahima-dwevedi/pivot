//Onfocus and onBlur code
$(document).ready(function() {   
    /*
    values=new Array();
    i=0;
jQuery('input[type=text],input[type=email],input[type=password],textarea').each(function(){
        values[i]=jQuery(this).val();
        jQuery(this).attr('dval',i);
        i++;
    });
jQuery('input[type=text],input[type=email],input[type=password],textarea').focus(function(){
        dval=jQuery(this).attr('dval');
        val=jQuery(this).val();
        if(val==values[dval])jQuery(this).val('');
    });
jQuery('input[type=text],input[type=email],input[type=password],textarea').blur(function(){
        dval=jQuery(this).attr('dval');
        val=jQuery(this).val();
        if(val=='')jQuery(this).val(values[dval]);
    });
	*/
    values=new Array();
    i=0;
    jQuery('.rightSidebarSearch').each(function(){
        values[i]=jQuery(this).val();
        jQuery(this).attr('dval',i);
        i++;
    });
    jQuery('.rightSidebarSearch').focus(function(){
        dval=jQuery(this).attr('dval');
        val=jQuery(this).val();
        if(val==values[dval])jQuery(this).val('');
    });
    jQuery('.rightSidebarSearch').blur(function(){
        dval=jQuery(this).attr('dval');
        val=jQuery(this).val();
        if(val=='')jQuery(this).val(values[dval]);
    });
    jQuery( ".sitemap" ).click(function() {
        jQuery( ".footer_links,.open-up,.close-down" ).slideToggle( "slow" );
    });
    jQuery(".sitemap").click(function(){
        var offset = $(this).offset().top;
        jQuery('body,html').animate({
            scrollTop: offset
        }, 900);
    });


    /*for search page ajax pagination start here*/
    //$('.search_result ul.pagination li').each(function(){
    $('.search_result').on('click','ul.pagination li',function(ev){
        $(".loader-holder").show();
        ev.preventDefault();
        $.get($(this).find('a').attr('href'),{
            ajax:true
        },function(html){
            $('.search_result').html($(".search_result", html).html());
            $('.result_row').last().addClass('last');
            setTimeout(function(){
                $(".loader-holder").hide();
            },500)
        });
    });
    //});
    $('.result_row').last().addClass('last');
    /*for search page ajax pagination end here*/
    setTimeout(function () {
        $("#auto-hide-msg").fadeOut('slow');
    }, 4000);      
    $('input[type="reset"]').on('click', function(evt) {	
        evt.preventDefault();
        $form = $(evt.target).closest('form');
        $form[0].reset();
        $form.find('select').resetSS();
        $('div.validate-error-msg').hide();
    //$.fn.extend(resetSS);
    });
});
//Onfocus and onBlur code end
    
$('#mainSearchSubmitDiv').live('click',function(e){
    if($('#mainSearchText').val()!='Enter Skills, Designation, Trades or Qualification...' && $('#mainSearchText').val().trim()!='' ){
        $('#main-search-form').submit();
    }
	
});
    
$('#cmsRightSidebarSearchSubmitDiv').live('click',function(e){
    if($('#cmsRightSidebarSearchText').val()!='Search here' && $('#cmsRightSidebarSearchText').val().trim()!='' ){
        $('#cms-right-sidebar-search-form').submit();
    }
});
    
//    $('ul#employerTabs li a').live('click',function(){	
//	$(this).parent().addClass('active');
//	var currentTab = $(this).attr('href');
//	var tabToModify=currentTab.replace('#', '');	
//	
//	$(".loader-holder").show();
//	
//	$.ajax({
//		type: "POST",
//		url: baseUrl+'employer/changeAssignmentTab',
//		data:   {
//			    tabType : tabToModify				
//			},
//		success: function(data) {
//					    try {
//						var response= $.parseJSON(data);
//						if (response.sessionExpired) {
//						    //alert("sg");
//						    $(location).attr('href',baseUrl+"employer/login");
//						}else if (response.errors) {
//						    
//						}
//					    } catch (e) {   // when there is an output to print
//						// not json
//						$('#'+tabToModify).html(data);
//						init_validate();
//						$(".loader-holder").hide();
//					    }		
//		},
//		error: function(e) {
//			//called when there is an error
//			//console.log(e.message);
//		}
//	});
//	
//	
//	return false;
//    });

function get_notification_count(){  
    $.ajax({
        type: "GET",
        url: baseUrl+'notification/GetNotificationCount',
        success: function(data) {
            var response= $.parseJSON(data);
            if (response.sessionExpired) {
                $(location).attr('href',baseUrl+"employer/login");
            }else if (response.notificationCount>=0) {
                $('.left_demand ul li a .notification-bubble').html(response.notificationCount);
            }
         
        },
        error: function(e) {
        //called when there is an error
        //console.log(e.message);
        }
    });
}

function customCheckbox(checkboxName){
    var checkBox = $('input[name="'+ checkboxName +'"]');
    //alert(checkBox);
    $(checkBox).each(function(){
        $(this).wrap( "<span class='custom-checkbox-gird'></span>" );
        if($(this).is(':checked')){
            $(this).parent().addClass("selected");
           
        }
    });
    $(checkBox).click(function(){
        $(this).parent().toggleClass("selected");			
        var thisID = $(this).attr('id');
        if(thisID.search("-grid_c0_all") > 0){
            if($(this).parent('span').hasClass("selected")){
                $("span.custom-checkbox-gird").addClass("custom-checkbox-gird selected");
            }else{
                $("span.custom-checkbox-gird").removeClass("selected");
            }
        }
    });       
}

function processPassport(){
    //alert(baseUrl);
    $('input[type="submit"]').attr('disabled','disabled');
    $('.loader-holder').show();
    $.ajax({
        type:"post",
        url: baseUrl+"passport/PassportStatus",
        data:$("#passport").serialize(),
        dataType: 'json',
        cache: false,
        success: function(data) {
            $(".redPassportMessage").remove();
            var status=data.status;
            //alert(status);
            if (status=="nicNotValid") {
                $(".visa p").html("NIC is not registered with us! Please enter correct NIC.<span></span>");
            }else if (status=="visaNotAvailable"){
                $(".visa p").html("Visa is not available right now for this NIC.<span></span>");
            }else if (status=="success"){
                var textToShow= data.visaStatus;
                $(".visa p").html(textToShow+"<span></span>");
                var passportExpiry= data.expiry;
                var differnce= calculateDaysDifference(passportExpiry);
                if (differnce < 31) {
                    if (differnce==0) {
                        $(".visa").append("<p class='redPassportMessage'>Your Passport is going to expire tommorow. Please renew your Passport.</p>");
                    }else if(differnce<0){
                        $(".visa").append("<p class='redPassportMessage'>Your Passport has already been expired. Please renew your Passport.</p>");
                    }else if(differnce>0){
                        $(".visa").append("<p class='redPassportMessage'>Your Passport is going to expire after "+differnce+" days. Please renew your Passport.</p>");
                    }
                }
            }
            $('input[type="submit"]').removeAttr('disabled');
            $(".visa").css("display","block");
            $('.loader-holder').hide();
            $('html, body').animate({
                scrollTop: $(".visa").offset().top
            }, 600);
        }
    });
}

function calculateDaysDifference(date){
    var str = date.replace(/-/g, '/');
    var d1 = new Date(str).getTime();
    var d2 = (new Date).getTime();
    var diff = 0;
    if (d1 && d2) {
        diff = Math.floor((d1 - d2) / 86400000); // ms per day
    }
    return diff;
}