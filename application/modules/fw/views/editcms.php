 

 <div class="span9" id="content">
                      <!-- morris stacked chart -->
                      
                   
									
									
                    <div class="row-fluid">
                    
                    
                       <?php echo $message;?>
                    
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">CMS List / Edit CMS</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="post" id="editcms" enctype="multipart/form-data" >
                                      <fieldset>
                                        <legend>Update CMS</legend>
                                        
                                        <div class="control-group">
                                          <label class="control-label">CMS Alias</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $cmsinfo->cnt_alias;?></span>
                                          </div>
                                        </div>
                                        
                                        <input type="hidden" name="txtcntid" value="<?php echo $cmsinfo->cnt_id;?>">
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Page Title</label>
                                          <div class="controls">
                                            <input name="txttitle" class="input-xlarge focused" id="txttitle" type="text" value="<?php echo $cmsinfo->cnt_title;?>">
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="disabledInput">Page Content</label>
                                          <div class="controls">
                                             
		                               <textarea name="txtcontent" id="ckeditor_full"><?php echo $cmsinfo->cnt_content;?></textarea>
		                            
                                          </div>
                                        </div>
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">File input</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" name="cmsimage" id="fileInput" type="file">
                                          </div>
                                        </div>
                                        
                                        
                                        <div class="form-actions">
                                          <button type="submit" name="btnUpdate" class="btn btn-primary">Save changes</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                     

                     <!-- wizard -->
                    

                </div>
                
        
        
        
        
        
                
                
                
                
    