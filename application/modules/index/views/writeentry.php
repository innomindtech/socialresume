 

 

 	<h1>Write entry for the user</h1>
 <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"> Write your entry for  <?php echo $requesterEmail; ?></h3>
            </div>
            <div class="panel-body">
			
 <form class="cmxform" id="frmaddentry" method="post" action="">
	 
			 <?php echo $message; ?>
			<p>
				 
				<textarea name="writeentry" id="writeentry"></textarea> <br>
				<input id="requestuserid" name="requestuserid" type="hidden" value="<?php echo $requestuserid; ?>">		
				<input class="submit" type="submit" value="Submit" name="btnsubmit">
			</p>
			 
			 
		 
	</form>
	
	</div>
          </div>
          
        </div><!-- /.col-sm-4 -->
         
        
      </div>