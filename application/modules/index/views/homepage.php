<div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Login Form</h3>
            </div>
            <div class="panel-body">
             <form class="cmxform" id="signupForm" method="post" action="">
		 
			 
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
			 <input id="chkregister" name="chkregister" type="checkbox" value="register"> Register as a User
			<p>
				<input class="submit" type="submit" value="Submit" name="btnsubmit">
			</p>
		 
	</form>
            </div>
          </div>
          
        </div><!-- /.col-sm-4 -->
         
         
      </div> 
 
