//function init_validate(){      
//    
//$.validator.setDefaults({
//	submitHandler: function(form) {
//	    fireFormEvent(form);
//            //form.submit();
//            }
//    });
//    
//    $.validator.addMethod("alphabetsOnly", function(value, element) {
//	return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
//    });
//    $.validator.addMethod("phoneValidate", function(value, element) {
//	return this.optional(element) || value == value.match(/^[0-9-+]{8,}$/);
//    });
//    $.validator.addMethod("faxValidate", function(value, element) {
//	return this.optional(element) || value == value.match(/^\+?[0-9]{6,}$/);
//    });
//    $.validator.addMethod("alphabetsAndSpaceOnly", function(value, element)
//    {
//	return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
//    });
//    $.validator.addMethod("pwcheck", function(value) {
//        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
//            && /\d/.test(value) // has a digit
//    });
//    
//    // When the browser is ready...
//    $(function() {
//	// Setup form validation on the #employer-register-form element
//	$(".validate-form").validate({
//	    invalidHandler: function(form, validator) {
//				$('.errorMessageForm').hide();
//			    },
//	    errorClass:"validate-error-msg", errorElement:"div",
//	});
//        $('.requiredField').each(function(i, obj) {
//	    $(this).rules("add", {
//		required:true, messages: {
//		    required: FORM_REQUIRED_FIELD,
//		}
//	    });
//	});
//        $('.alpha').each(function(i, obj) {
//	    $(this).rules("add", {
//		alphabetsOnly:true, messages: {
//		    alphabetsOnly:FORM_ONLY_ALPHABETS,
//		}
//	    });
//	});
//        $('.alphaAndSpace').each(function(i, obj) {
//	    $(this).rules("add", {
//		alphabetsAndSpaceOnly:true, messages: {
//		    alphabetsAndSpaceOnly:FORM_ONLY_ALPHABETS_AND_SPACE,
//		}
//	    });
//	});
//        $('.emailField').each(function(i, obj) {
//	    $(this).rules("add", {
//		email: true,
//                required: true,
//                messages: {
//		    required: FORM_REQUIRED_FIELD,
//                    email: FORM_INVALID_EMAIL,
//		}
//	    });
//	});
//        $('.phoneField').each(function(i, obj) {
//	    $(this).rules("add", {
//		phoneValidate: true, messages: {
//		    phoneValidate: FORM_INVALID_PHONE
//		}
//	    });
//	});
//        $('.faxField').each(function(i, obj) {
//	    $(this).rules("add", {
//		faxValidate: true, messages: {
//		    faxValidate: FORM_INVALID_FAX
//		}
//	    });
//	});
//        $('.passField').each(function(i, obj) {
//	    $(this).rules("add", {
//		pwcheck: true, messages: {
//		    pwcheck: FORM_PASSWORD_REQUIREMENTS,
//		}
//	    });
//	});
//    });
//}


// For Non Ajax Forms

    $.validator.setDefaults({
	submitHandler: function(form) {
	    fireFormEvent(form);
            //form.submit();
            }
    });
    $.extend($.validator.messages, {
        equalTo: "Value doesn't match the password field",
    });
    
    $.validator.addMethod("alphabetsOnly", function(value, element) {
	return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    });
    $.validator.addMethod("alphaNumeric", function(value, element) {
	return this.optional(element) || value == value.match(/^[a-zA-Z0-9]+$/);
    });
    $.validator.addMethod("phoneValidate", function(value, element) {
	return this.optional(element) || value == value.match(/^[0-9-+]{8,}$/);
    });
    $.validator.addMethod("faxValidate", function(value, element) {
	return this.optional(element) || value == value.match(/^\+?[0-9]{6,}$/);
    });
    $.validator.addMethod("alphabetsAndSpaceOnly", function(value, element)
    {
	return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });
    $.validator.addMethod("pwcheck", function(value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /\d/.test(value) // has a digit
    });
    $.validator.addMethod("realNumberOnly", function(value, element) {
        return this.optional(element) || value == value.match(/^0*[1-9]\d*$/);
    });
     $.validator.addMethod("nicValidate", function(value, element) {
	return this.optional(element) || value == value.match(/^[0-9-]*$/);
    });
    // When the browser is ready...
    $(function() {
	// Setup form validation on the #employer-register-form element
	$(".validate-form").validate({
	    invalidHandler: function(form, validator) {
							    $('.errorMessageForm').hide();
			    },
	    errorClass:"validate-error-msg", errorElement:"div",
	});
        $('.requiredField').each(function(i, obj) {
	    $(this).rules("add", {
		required:true, messages: {
		    required: FORM_REQUIRED_FIELD,
		}
	    });
	});
        $('.alpha').each(function(i, obj) {
	    $(this).rules("add", {
		alphabetsOnly:true, messages: {
		    alphabetsOnly:FORM_ONLY_ALPHABETS,
		}
	    });
	});
        $('.alphaNum').each(function(i, obj) {
	    $(this).rules("add", {
		alphaNumeric:true, messages: {
		    alphaNumeric:FORM_ONLY_ALPHANUMERIC,
		}
	    });
	});
        $('.alphaAndSpace').each(function(i, obj) {
	    $(this).rules("add", {
		alphabetsAndSpaceOnly:true, messages: {
		    alphabetsAndSpaceOnly:FORM_ONLY_ALPHABETS_AND_SPACE,
		}
	    });
	});
        $('.emailField').each(function(i, obj) {
	    $(this).rules("add", {
		email: true,
                required: true,
                messages: {
		    required: FORM_REQUIRED_FIELD,
                    email: FORM_INVALID_EMAIL,
		}
	    });
	});
        $('.phoneField').each(function(i, obj) {
	    $(this).rules("add", {
		phoneValidate: true, messages: {
		    phoneValidate: FORM_INVALID_PHONE
		}
	    });
	});
        $('.faxField').each(function(i, obj) {
	    $(this).rules("add", {
		faxValidate: true, messages: {
		    faxValidate: FORM_INVALID_FAX
		}
	    });
	});
         $('.realNumber').each(function(i, obj) {
	    $(this).rules("add", {
		realNumberOnly: true, messages: {
		    realNumberOnly: FORM_NUMBER_GREATER_THAN_ZERO
		}
	    });
	});
        $('.passField').each(function(i, obj) {
	    $(this).rules("add", {
		pwcheck: true, messages: {
		    pwcheck: FORM_PASSWORD_REQUIREMENTS,
		}
	    });
	});
	$('.nicField').each(function(i, obj) {
	    $(this).rules("add", {
		nicValidate: true, messages: {
		    nicValidate: FORM_INVALID_NIC
		}
	    });
	});
    });