<?php 
//echopre($cmslist);
?>

<div class="span9" id="content">

               
										<p>
											<button class="btn"><i class="icon-plus"></i> Add</button>
											<button class="btn btn-inverse"><i class="icon-refresh icon-white"></i> Update</button>
											<button class="btn btn-primary"><i class="icon-pencil icon-white"></i> Edit</button>
											<button class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</button>
										</p>
									 
                    

                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">CMS Pages</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table table-striped">
						              <thead>
						                <tr>
						                  <th>#</th>
						                  <th>Url Alias</th>
						                  <th>Title</th>
						                  <th>Description</th>
						                  <th>Actions</th>
						                </tr>
						              </thead>
						              <tbody>
						              <?php 
						              if(sizeof($cmslist->records) > 0){
						              //	echopre($cmslist->records);
						               foreach($cmslist->records as $list){
						              ?>
						                <tr>
						                  <td>1</td>
						                   <td>/<?php echo $list->cnt_alias;?></td>
						                  <td><?php echo $list->cnt_title;?></td>
						                  <td><?php echo splittext($list->cnt_content);?></td>
						                  <td>	 
						                 <a href="<?php echo BASE_URL;?>admin/index/editcms" title="Edit"> <i class="icon-edit"></i></a>
						                  </td>
						                </tr>
						                <?php 
						               }
						                }
						                ?>
						               
						              </tbody>
						            </table>
                                    
                                    <div  ><div class="span6"><div class="dataTables_info" id="example_info"> Showing 1 to 10 of 57 entries</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#"> Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next  </a></li></ul></div></div></div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    

                    

                    

                    

                     


                </div>