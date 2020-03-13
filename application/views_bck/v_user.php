	<style type="text/css">
	textarea { /*resize: vertical;*/ resize: none; }
	</style>
	<div class="row"></br></br></br></div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading "><label class="glyphicon glyphicon-user"> ข้อมูลผู้ใช้ / User Data</label></div>
				<div class="panel-body">
					<div class="com-md-12 col-xs-12">
				 		
						<div class="row">
						  <!-- <div class="col-xs-9">.col-xs-9</div> -->
						  <div class="col-xs-4"><center><img src="<?php echo base_url('assets/img/user.png');?>" alt="..." class="img-thumbnail"></center></div>
						  <div class="col-xs-6">
						  		<table class="table table-condensed table-hover table-bordered">
								 	<thead>	
									  	<!-- <tr>
										  	<th>aa</th>
										  	<th>aa</th>  	
									  	</tr> -->
								  	<thead>
								  	<tbody>
								  		<?php foreach($data_user as $num=>$row){?>
								  		<tr>
								  			<th>รหัส<br>User ID</th>
								  			<th><?php echo $row->user_ID?>
								  			

								  			</th>
								  		</tr>
								  		<tr>
								  			<th>ชื่อ - สกุล<br>Name - Surname</th>
								  			<th><?php echo $row->name_th." ".$row->surname_th ;?><br>
								  			<?php echo $row->name_en." ".$row->surname_en ;?>
								  			<input type="hidden" class="form-control" name="name_th" id="name_th" value="<?php echo $row->name_th ?>" > 
								  			<input type="hidden" class="form-control" name="surname_th" id="surname_th" value="<?php echo $row->surname_th ?>" > 
								  			<input type="hidden" class="form-control" name="name_en" id="name_en" value="<?php echo $row->name_en ?>" > 
								  			<input type="hidden" class="form-control" name="surname_en" id="surname_en" value="<?php echo $row->surname_en ?>" > 
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>แผนก<br>Dept.</th>
								  			<th><?php echo $row->department_Name;?><br>
											
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>ออฟฟิศ<br>Office</th>
								  			<th><?php echo $row->office_Name;?><br>
							
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>ตำแหน่ง<br>Position</th>
								  			<th><?php echo $row->position_Name;?><br>
								  	
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>วันที่เริ่มงาน<br>Start work date</th>
								  			<th><?php echo $row->start_date_work;?><br>
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>อีเมล์<br>Email</th>
								  			<th><?php echo $row->email;?><br>
								  			</th>
								  		</tr>
								  		<tr>
								  			<th>เบอร์โทร<br>Phone no.</th>
								  			<th><?php echo $row->phone;?><br>
								  			</th>
								  		</tr>
								  	
										
								<?php }?>
									</tbody>
								</table>
								<!-- Button trigger modal -->
								<center>
									<button type="button" class="btn btn-warning btn-lg glyphicon glyphicon-wrench" data-toggle="modal" data-target="#myModal">
									  แก้ไข/Edit
									</button>
								</center>

							<form name="user" method="post" action="<?php echo base_url().index_page();?>/user/edit_user_profile"> 
									<!-- Modal -->
									<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog modal-lg">
									    <div class="modal-content">

										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title glyphicon glyphicon-user" id="myModalLabel"> แก้ไขข้อมูลผู้ใช้/Edit User</h4>
										      </div>
										      <div class="modal-body">									
										        	<div class="modal-body">
															<table class="table table-bordered">
																<tbody>
																<?php foreach($data_user as $num=>$row){ ?>
																	<tr>
																		<td>
																			<input type="hidden" class="form-control" name="user_ID" id="user_ID" value="<?php echo $row->user_ID ?>" > 
																			<input type="hidden" class="form-control" name="birth_date" id="birth_date" value="<?php echo $row->birth_date ?>" > 
																			<input type="hidden" class="form-control" name="user_type_ID" id="user_type_ID" value="<?php echo $row->user_type_ID ?>" > 
																			<input type="hidden" class="form-control" name="password" id="password" value="<?php echo $row->password ?>" > 

																			<input type="hidden" class="form-control" name="annual_new" id="annual_new" value="<?php echo $row->annual_new ?>" > 
																			<input type="hidden" class="form-control" name="annual_old" id="annual_old" value="<?php echo $row->annual_old ?>" > 
																			<input type="hidden" class="form-control" name="annual_old_use" id="annual_old_use" value="<?php echo $row->annual_old_use ?>" > 
																			<input type="hidden" class="form-control" name="annual_new_use" id="annual_new_use" value="<?php echo $row->annual_new_use ?>" > 

																		
																			<div class="form-group">
																			วันที่เริ่มงาน <input type="text" id="start_date_work" name="start_date_work" value="<?php echo $row->start_date_work;?>" style="background: #CCCCCC" readonly>
																			</div>
																			<div class="form-group">
																			ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" id="name_en" name="name_en" value="<?php echo $row->name_en;?>"  style="background: #CCCCCC" readonly>
																			นามสกุล(ภาษาอังกฤษ) <input type="text" id="surname_en" name="surname_en" value="<?php echo $row->surname_en;?>"  style="background: #CCCCCC" readonly>
																			</div>
																			<div class="form-group">
																			ชื้อผู้ใช้(ภาษาไทย) <input type="text" id="name_th" name="name_th" value="<?php echo $row->name_th;?>"  style="background: #CCCCCC" readonly>
																			นามสกุล(ภาษาไทย) <input type="text" id="surname_th"name="surname_th" value="<?php echo $row->surname_th;?>"  style="background: #CCCCCC" readonly>
																			</div>
																			<div class="form-group">
																			อีเมล์ <input type="text" id="email" name="email" value="<?php echo $row->email;?>" style="background: #CCCCCC" readonly >
																			เบอร์โทร <input type="text" id="phone" name="phone" value="<?php echo $row->phone;?>">
																			</div>
																				<div class="col-md-3">
																				แผนก
																				<input type="hidden" id="department_ID" name="department_ID" value="<?php echo $row->department_ID;?>">
																				<input type="text" value="<?php echo $row->department_Name;?>" style="background: #CCCCCC" readonly >
																				</div>
																				<div class="col-md-3">
																				ตำแหน่ง
																				<input type="hidden" id="position_ID" name="position_ID" value="<?php echo $row->position_ID;?>">
																				<input type="text" value="<?php echo $row->position_Name;?>" style="background: #CCCCCC" readonly >
																			 	</div>

																				<div class="col-md-3">
																				ประเภทผู้ใช้
																				<input type="hidden" id="user_type_ID" name="user_type_ID" value="<?php echo $row->user_type_ID;?>">
																				<input type="text" value="<?php echo $row->user_type_Name;?>" style="background: #CCCCCC" readonly >
																				</div>
																				<div class="col-md-4">
																				Email ผู้รับเมื่อลา <input type="text" id="send_email_to" name="send_email_to" size="90" value="<?php echo $row->send_email_to;?>" style="background: #CCCCCC" readonly>
																				</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													<?php }?>
										      	</div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										        <button type="submit" class="btn btn-primary">Save</button>
										      </div>
									  

									    </div>
									  </div>
									</div>
 								 </form>
									
						  </div>

						 
						</div>
					</div>

				</div>
			
				<div class="panel-footer"></div>
			</div>
		</div>
		</div>
	</div>
	</div>

<script type="text/javascript">
	function check_form()
	{
		if (document.getElementById('name_en').value=="") {
			document.getElementById('name_en').focus();
			alert('กรุณากรอก ชื้อผู้ใช้(ภาษาอังกฤษ');
			return false;
		}; 
		if (document.getElementById('surname_en').value=="") {
			document.getElementById('surname_en').focus();
			alert('กรุณากรอก นามสกุล(ภาษาอังกฤษ) ');
			return false;
		}; 
		if (document.getElementById('name_th').value=="") {
			document.getElementById('name_th').focus();
			alert('กรุณากรอก ชื้อผู้ใช้(ภาษาไทย');
			return false;
		};
		if (document.getElementById('surname_th').value=="") {
			document.getElementById('surname_th').focus();
			alert('กรุณากรอก ชื้อผู้ใช้(ภาษาไทย');
			return false;
		}; 
		if (document.getElementById('phone').value=="") {
			document.getElementById('phone').focus();
			alert('กรุณากรอก เบอร์โทร');
			return false;
		};  
	}
</script>
