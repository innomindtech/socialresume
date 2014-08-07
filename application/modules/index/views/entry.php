 
  

	<h1> Entry Details</h1>
 <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"> Detailed view of entry </h3>
            </div>
            <div class="panel-body">
            
			 <?php
			echo $message;
 
				if($action == 'view') {	// show the details of the entry
				?>
				 <table class="table">
					 <tr>
						<td>Entry Posted By : </td>
						<td><?php echo $eventInfo->u_email; ?></td>
					 </tr>
					 <tr>
						<td>Entry Posted On : </td>
						<td><?php echo $eventInfo->u_postedon; ?></td>
					 </tr>
					 <tr>
						<td>Entry : </td>
						<td><?php echo $eventInfo->u_message; ?></td>
					 </tr>
					  <tr>
						<td>  </td>
						<td> <a class="btn btn-xs btn-default" href="<?php echo BASE_URL;?>dashboard">Back to list </a>
						
						<?php if($loguserid == $eventInfo->u_id ){ ?>
						<a class="btn btn-xs btn-danger delete-link" href="<?php echo BASE_URL;?>entry/<?php echo $eventInfo->e_id; ?>/delete">Delete</a> 
						<a class="btn btn-xs btn-success" href="<?php echo BASE_URL;?>entry/<?php echo $eventInfo->e_id; ?>/send">Send</a></td>
						<?php } ?>
					 </tr>
				</table>
				<?php
				
				}
				else if($action == 'send') {	// show the sending options here
				?>
				<p>
				  <form class="cmxform" id="sendemail" method="post" action="<?php echo BASE_URL;?>entry/<?php echo $eventInfo->e_id; ?>/send">
					Message :
					<p class="list-group-item-text"><?php echo $eventInfo->u_message; ?></p>
					<input name="writeentry" id="writeentry" type="hidden" value="<?php echo $eventInfo->u_message; ?>">  <br>
						Enter emailid:<input id="uemail" name="uemail" type="textbox" value="">	
						<input id="entryid" name="entryid" type="hidden" value="<?php echo $eventInfo->e_id; ?>">	<br>	
					<input class="submit" type="submit" value="Send" name="btnsubmit" class="btn btn-xs btn-default">
					 <a  class="btn btn-xs btn-default" href="<?php echo BASE_URL;?>dashboard">Back to list </a>
					</form>
				</p>
				<?php
				}
				else
					echo "Error.. Missing information";
				
			 
			 ?>
			
            </div>
          </div>
          
        </div><!-- /.col-sm-4 -->
         
        
      </div>
	  
	  
 
 
	
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
			 
			
			
			
			
			 
			 
 