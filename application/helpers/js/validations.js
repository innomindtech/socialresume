$().ready(function() {
		 
		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				username: {
					required: true,
					minlength: 2,
					email: true
				},
				password: {
					required: true,
					minlength: 5
				}  
			},
			messages: {
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters",
					email: "Please enter a valid email address",
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				} 
			}
		});
		
		
		// validate the email sending form
		$("#sendemail").validate({
			rules: {
				uemail: {
					required: true,
					email: true
				} 
			},
			messages: { 
				uemail: {
					required: "Please enter the email",
					email: "Please enter a valid email address",
				} 
			}
		});
		
		
		
		
		
		// validate the entry adding form
		$("#frmaddentry").validate({
			rules: {
				writeentry: {
					required: true 
				} 
			},
			messages: { 
				writeentry: {
					required: "Please enter the entry about the user" 
				} 
			}
		});
		

		// function to ensure the confirmation for delete
		$(".delete-link").on("click", null, function(){
			return confirm("Are you sure you want to delete this record?");
		});
		
		
		
		
	});
	
	
	 
		