 

 

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
						<textarea name="writeentry"   id="ckeditor_standard"></textarea> <br>
						<input id="requestuserid" name="requestuserid" type="hidden" value="<?php echo $requestuserid; ?>">		
						<input class="submit" type="submit" value="Submit" name="btnsubmit">
					</p>
			</form>
	
			</div>
        </div>
          
        </div><!-- /.col-sm-4 -->
    </div>
	  
	<script src="<?php echo BASE_URL;?>assets/ckeditor/ckeditor.js"></script>
	<script src="<?php echo BASE_URL;?>assets/ckeditor/adapters/jquery.js"></script>       
        <script>
        $(function() {
			 // Ckeditor standard
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Styles', 'Format', 'Font', 'FontSize' ] }
			]});
        });
        </script>