 
<div class="container theme-showcase" role="main">
	<h1> User Dashboard</h1>
 <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"> Send Invitation Mail to Friend</h3>
            </div>
            <div class="panel-body">
            <form class="cmxform" id="sendemail" method="post" action="">
			<fieldset>
				<legend></legend>
				 <?php echo $message; ?>
				<p>
					<label for="username">Email Address</label>
					<input id="uemail" name="uemail" type="text"><input class="submit" type="submit" value="Send Email" name="btnsubmit">
				</p>
				 
				<p>
					
				</p>
			</fieldset>
	</form>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">List of entries</h3>
            </div>
            <div class="panel-body">
             <fieldset>
			 
			 <?php echo $message; ?>
			 <table  class="table">
			 <tr>
				<td>#</td>
				<td>Poster Email</td>
				<td>Posted On</td>
				<td>Action</td>
			 </tr>
			 <?php 
				if(sizeof($entryList) > 0) {
					$i=1;
					foreach($entryList as $listitems) {
						echo '<tr>';
						echo '<td>'.$i++.'</td>';
						echo '<td>'.$listitems->u_email.'</td>';
						echo '<td>'.$listitems->u_postedon.'</td>';
						echo '<td><a href="'.BASE_URL.'entry/'.$listitems->e_id.'/view">Open</a> | <a href="'.BASE_URL.'dashboard/?eid='.$listitems->e_id.'&action=delete"  class="delete-link">Delete</a> | <a href="'.BASE_URL.'entry/'.$listitems->e_id.'/send">Send</a></td>';
				 
					}
					//echopre($entryList); 
				}
				else
					echo '<tr><td colspan="4"><strong>No entries found</strong></td></tr>';
			?>
			 
			 
		</fieldset>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
         
        
      </div>
	  
	  </div>
 
 
	
	