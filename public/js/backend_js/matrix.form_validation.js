
$(document).ready(function(){
	var typingTimer;
	var doneTypingInterval = 1000;
	$('#current_pwd').on('keyup', function () {
		clearTimeout(typingTimer);
			if ($('#current_pwd').val()) {
				typingTimer = setTimeout(doneTyping, doneTypingInterval);
			}
	});
	  function doneTyping () {
		//do something
		var current_pwd = $('#current_pwd').val();
		// alert(current_pwd);
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(res){
				// alert(res);
				if(res == 'true'){
					$('#chkpwd').html("<font color='green'>Current Password is Correct</font>");
				} else {
					$('#chkpwd').html("<font color='red'>Current Password is Incorrect</font>");
				}
			},
			error: function() {
				alert("Error");
			}
		})
	  }

	
	
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//Add Category Form Validation
	$("#add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//edit Category form validation
	$("#edit_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//add product form validation
	$("#add_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_name:{
				required:true,
			},
			product_code:{
				required:true,
			},
			product_color:{
				required:true,
			},
			price:{
				required:true,
				number:true
			},
			image:{
				required:true,
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//delete product jquery script
	$(".delProduct").click(function(){
		var id= $(this).attr('rel');
		var deletFunction = $(this).attr('rel1');
		Swal.fire({
			title: 'Are you sure?',
			text: "you won't be able to revert this",
			showCancelButton: true,
			confirmButtonColor: '#3085df',
			cancelButtonColor: '#d3d3d3',
			confirmButtonText: "Yes delete it",
			cancelButtonText: 'No, Cancel',
			// confirmButtonClass: 'btn btn-success',
			// cancelButtonClass: 'btn btn-danger',
			icon: 'warning',
			buttonStyling: false,
			reverseButtons: true
		}).then((result) => {
			if(result.value) {
				window.location.href="/admin/"+deletFunction+"/"+id;
			}
		});

		
		// function() {
		// 	window.location.href="/admin/"+deletFunction+"/"+id;
		// }
	});

	//edit product form validation
	$("#edit_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_name:{
				required:true,
			},
			product_code:{
				required:true,
			},
			product_color:{
				required:true,
			},
			price:{
				required:true,
				number:true
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top:3px;"><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;"/>'+
	'<input type="text" name="size[]" id="size" placeholder="Size" style="width:120px; margin-left:3px;"/>'+
	'<input type="text" name="price[]" id="price" placeholder="Price" style="width:120px; margin-left:3px;"/>'+
	'<input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px; margin-left:3px;"/>'+
	'<a href="javascript:void(0);" class="remove_button"> Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
