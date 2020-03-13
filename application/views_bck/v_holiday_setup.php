<!DOCTYPE html>
<html>
<head>
	<title>holiday_setup</title>
</head>
<body>
<div class="row"><br><br></div>
<div class="container" style="margin-top:18px;">

<center>

  				<!-- Button trigger modal -->
				<button type="button" class="btn btn-success glyphicon glyphicon-plus btn-lg" data-toggle="modal" data-target="#myModal">
				  เพิ่มวันหยุด
				</button>

 				<form action="<?php echo base_url('index.php/holiday_setup/add_holiday_data'); ?>" method="POST">
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">เพิ่มวันหยุด/Add Holiday</h4>
				      </div>
				      <div class="modal-body">
				        	<div class="row">
								  <div class="col-xs-6">
								  			
								  			<label>วันที่/Date</label>
 											<input type="date" class="form-control" name="add_date" id="add_date" required>								  			
								  </div>

								  <div class="col-xs-6">
								  	<label  for="add_holiday">วันหยุด/Holiday</label><input type="text" class="form-control" name="add_holiday" id="add_holiday" placeholder="วันหยุด" required>
								  </div>
							</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary" name="add_data" id="add_data">Save</button>
				      </div>
				    </div>
				  </div>
				</div>
				</form>
				
		</center><br>

		
<div class="row">
  <div class="col-md-6">
  		<div class="panel panel-default">
			<div class="panel-heading "><label class="glyphicon glyphicon-calendar"> วันหยุดปีนี้/Holiday calendar</label></div>
				<div class="panel-body">
					<div class="com-md-12 col-xs-12">
				 		<!--<?php //echo form_open_multipart("",array('id'=>'form_user'));?> -->
						<table class="table table-condensed table-hover table-bordered" >
								 	<thead>	
								 	<tr><label><h3>วันหยุดปี <?php echo date("Y");?><br>Holiday calendar for <?php echo date("Y");?> </h3></label>
								 	</tr>
									  	<tr class="info">
										  	<th><center>#</center></th>
										  	<th><center>วันหยุด<br>Holiday</center></th>
										  	<th><center>วันที่<br>Date</center></th>
										  	<th><center>Tool</center></th>
									  	</tr>
								  	<thead>
								  	<tbody>
								  		 <?php if(empty($result) OR isset($result[0]->ERROR)){?>
                            			<?php }else{?>
										<?php foreach($result as $num=>$row):?>
							<tr>
								  			<th><?php echo $num+1 ?></th>
								  			<th><?php echo date("d/m/Y", strtotime($row->non_working_time));?></th>
								  			<th><?php echo $row->detail ?></th>
								  			<th><center>

								  			 <a href="#edit_user<?php echo $row->calendar_ID;?>" data-toggle="modal">แก้ไข</a>
								                  <!-- Modal edit Office-->
								               <form name="user" method="post" action="<?php echo base_url().index_page();?>/holiday_setup/edit_holiday_data/<?php echo $row->calendar_ID; ?>"> 
								                  <div class="modal fade" id="edit_user<?php echo $row->calendar_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								                    <div class="modal-dialog">
								                      <div class="modal-content">
								                        
								                          <div class="modal-header">
								                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								                            <h4 class="modal-title">แก้ไข ผู้ใช้ / Edit user</h4>
								                          </div>
								                          <div class="modal-body">
								                            <table class="table table-bordered">
								                              <tbody>
								                                <tr>
								                                  <td>
								                     					
								                     					<div class="row">
																  <div class="col-xs-6">
																  			
																  			<label>วันที่/Date</label>
																  			
																  			  <input type="date" class="form-control" name="add_date" id="add_date" value="<?php echo $row->non_working_time;?>">							  			
																  				
																  </div>

																  <div class="col-xs-6">
																  			<label>วันหยุด/Holiday</label>
																  			 
																 			<input type="text" class="form-control" name="add_holiday" id="add_holiday" value="<?php echo $row->detail;?>">
																
																   </div>
																  
															</div>
								           
								                                  </td>
								                                </tr>
								                              </tbody>
								                            </table>
								                          </div>
								                          <div class="modal-footer">
								                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                            <button type="submit" class="btn btn-primary">Edit</button>
								                          </div>
								                        </form>
								                      </div>
								                    </div>
								                  </div>
								                  <!-- Modal edit Department-->
								  			<a href="<?php echo base_url().index_page();?>/holiday_setup/del_holiday_data/<?php echo $row->calendar_ID;?>" onclick=" return confirm('คุณต้องการลบใช่หรือไม่')">ลบ</a>
								  			</center>
								  			</th>
							</tr>
					    </div>
					  </div>
					</div>
					<?php endforeach; }?>
									</tbody>
								</table>
					</div>

				</div>
				<!--<?php// echo form_close();?> -->
				<div class="panel-footer"></div>
			</div>


  </div>
  <div class="col-md-6">
		  	<div class="panel panel-default">
			<div class="panel-heading "><label class="glyphicon glyphicon-calendar"> วันหยุดปีหน้า/Holiday Calender</label></div>
				<div class="panel-body">
					<div class="com-md-12 col-xs-12">
				 		<!--<?php //echo form_open_multipart("",array('id'=>'form_user'));?> -->
						<table class="table table-condensed table-hover table-bordered" >
								 	<thead>	
								 	<tr><label><h3>วันหยุดปี <?php echo date("Y")+1;?><br>Holiday Calender for <?php echo date("Y")+1;?> </h3></label>
								 	</tr>
										<tr class="info">
										  	<th><center>#</center></th>
										  	<th><center>วันหยุด<br>Holiday</center></th>
										  	<th><center>วันที่<br>Date</center></th>
										  	<th><center>Tool</center></th>
									  	</tr>
								  	<thead>
								  	<tbody>
								  			 <?php if(empty($result_data) OR isset($result_data[0]->ERROR)){?>
                            			<?php }else{?>
										<?php foreach($result_data as $num=>$row):?>
							<tr>
								  			<th><?php echo $num+1 ?></th>
								  			<th><?php echo date("d/m/Y", strtotime($row->non_working_time)+1);?></th>
								  			<th><?php echo $row->detail ?></th>
								  			<th><center>

								  			 <a href="#edit_user<?php echo $row->calendar_ID;?>" data-toggle="modal">แก้ไข</a>
								                  <!-- Modal edit Office-->
								                  <form name="user" method="post" action="<?php echo base_url().index_page();?>/holiday_setup/edit_holiday_data/<?php echo $row->calendar_ID; ?>"> 
								                  <div class="modal fade" id="edit_user<?php echo $row->calendar_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								                    <div class="modal-dialog">
								                      <div class="modal-content">
								                       
								                          <div class="modal-header">
								                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								                            <h4 class="modal-title">แก้ไข ผู้ใช้ / Edit user</h4>
								                          </div>
								                          <div class="modal-body">
								                            <table class="table table-bordered">
								                              <tbody>
								                                <tr>
								                                  <td>	
								                     					<div class="row">
																  <div class="col-xs-6">
																  			
																  			<label>วันที่/Date</label>
																  		  <input type="date" class="form-control" name="add_date" id="add_date" value="<?php echo $row->non_working_time;?>">							  			
																  				
																  </div>

																  <div class="col-xs-6">
																  			<label>วันหยุด/Holiday</label>
																  			 
																 			<input type="text" class="form-control" name="add_holiday" id="add_holiday" value="<?php echo $row->detail;?>">
																   </div>							  
															</div>
								           
								                                  </td>
								                                </tr>
								                              </tbody>
								                            </table>
								                          </div>
								                          <div class="modal-footer">
								                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								                            <button type="submit" class="btn btn-primary">Edit</button>
								                          </div>
								                       
								                      </div>
								                    </div>
								                  </div>
								                   </form>
								                  <!-- Modal edit Department-->

								  			<a href="<?php echo base_url().index_page();?>/holiday_setup/del_holiday_data/<?php echo $row->calendar_ID;?>" onclick=" return confirm('คุณต้องการลบใช่หรือไม่')">ลบ</a>
								  			</center>
								  			</th>
							</tr>
					    </div>
					  </div>
					</div>
					<?php endforeach; }?>
	 
									</tbody>
								</table>
					</div>
				</div>
				<!--<?php echo form_close();?> -->
				<div class="panel-footer"></div>


			</div>

  		</div>
	</div>
</div>
</body>
</html>

<script type="text/javascript">
		
</script>
