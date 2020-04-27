
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
			confirmButtonColor: '#3085dg',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes delete it",
			cancelButtonText: 'No, Cancel',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
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
});
