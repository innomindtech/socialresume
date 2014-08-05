 
 
<form class="cmxform" id="signupForm" method="post" action="">
		<fieldset>
			<legend>Login Form</legend>
			 <?php echo $message; ?>
			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text">
			</p>
			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password">
				<input id="redirect" name="redirect" type="hidden" value="<?php echo $redirect; ?>";>				
			</p>
			 
			<p>
				<input class="submit" type="submit" value="Submit" name="btnsubmit">
			</p>
		</fieldset>
	</form>