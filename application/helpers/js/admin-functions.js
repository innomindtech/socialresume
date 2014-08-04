$().ready(function() {
	 
 $('#editcms').validate({
     rules: {
	 	txttitle: {
             required: true
         } 
     },
     errorElement: 'span',
     errorClass: 'help-block',
 });
 
 $('#example').tooltip();
 
 
 
 $("[data-toggle=tooltip]").tooltip({ placement: 'right'});
 
 
 	// admin general settings validations
 	$('#gensettings').validate({
 		rules: {
 			admin_mail: {
            	required: true,
            	email:true
         	} 
     	},
     	errorElement: 'span',
     	errorClass: 'help-block',
 	});
 	// general settings validations ends
	
	$("#category-form").validate({
    
        // Specify the validation rules
        rules: {
            category_type: "required",
            category_name: "required",
            category_alias: "required"
            
        },
        
        // Specify the validation error messages
        messages: {
            category_type: "Please select category type",
            category_name: "Please enter category name",
            category_alias: "Please enter category alias", 
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	
	$("#video-form").validate({
    
        // Specify the validation rules
        rules: {
            category_type	: "required",
            txttitle		: "required",
            txtlink			: "required"
            
        },
        
        // Specify the validation error messages
        messages: {
            category_type	: "Please select category type",
            txttitle		: "Please enter title",
            txtlink			: "Please enter link" 
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	
		$("#user-form").validate({
    
        // Specify the validation rules
        rules: {
            txt_fname		: "required",
            txt_lname		: "required",
            txt_email		: {
								required: true,
								email: true},
			txt_username	:"required",
			txt_password	:"required"
            
        },
        
        // Specify the validation error messages
        messages: {
            txt_fname		: "Please enter first name",
            txt_lname		: "Please enter last name",
            txt_email		: {
								required:"Please enter email",
								email	:"please enter a valid email address"
							 },
			txt_username	:"Please enter username",
			txt_password	:"Please enter password"
		},	
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	

}); 
 function enable_disable(id,doVal){
   
  // window.href='http://localhost/projects/happythaiforex/admin/enable_disableUser/'+id+'/'+doVal;
   $.ajax({
       url: BASE_URL+'admin/enable_disableUser/'+id+'/'+doVal,
       dataType: 'json',
       success: function(data){		  
       }
    }); 
	
}