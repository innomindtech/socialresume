 
Write entry for the user
 <hr>

 
 <form class="cmxform" id="frmaddentry" method="post" action="">
		<fieldset>
			<legend>Write your entry for  <?php echo $requesterEmail; ?></legend>
			 <?php echo $message; ?>
			<p>
				 
				<textarea name="writeentry" id="writeentry"></textarea> <br>
				<input id="requestuserid" name="requestuserid" type="hidden" value="<?php echo $requestuserid; ?>">		
				<input class="submit" type="submit" value="Submit" name="btnsubmit">
			</p>
			 
			<p>
				
			</p>
		</fieldset>
	</form>