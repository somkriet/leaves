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
<div class="container">
<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ข้อมูลผู้ใช้ Data User</h5>
		</div>
	</div>
	<div class="bs-user">
		<div class="row">
				<div class="col-md-2">
					<p><img src="<?php echo base_url();?>assets/img/user.png" class="img-thumbnail" /></p>
					
				</div>
				<div class="col-md-10">
					<table class="table table-striped">
					 	<thead>	
						  	<tr>
							  	<th>รหัส<br>User ID</th>
							  	<th>ชื่อ - สกุล<br>Name - Surname</th>
							  	<th>แผนก<br>Dept.</th>
							  	<th>ออฟฟิศ<br>Office</th>
							  	<th>ตำแหน่ง<br>Position</th>
							  	<th>วันที่เริ่มงาน<br>Start work date</th>
							  	<th>อีเมล์<br>Email</th>
							  	<th>เบอร์โทร<br>Phone no.</th>
						  	</tr>
					  	<thead>
					  	<tbody>
					  		<?php 
							foreach($userdata as $num=>$userdata){?>
							<tr>
								<td><?php echo $userdata->user_ID;?></td>
								<td><?php echo $userdata->name_th;?>-<?php echo $userdata->surname_th;?></td>
								<td><?php echo $userdata->department_Name;?></td>
								<td><?php echo $userdata->office_Name;?></td>
								<td><?php echo $userdata->position_Name;?></td>
								<td><?php echo $userdata->start_date_work;?></td>
								<td><?php if($userdata->email !="0"){echo $userdata->email;}else{echo "-";}?></td>
								<td><?php if($userdata->phone !="0"){echo $userdata->phone;}else{echo "-";}?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>

			
					<!--<button type="button" class="btn btn-warning btn-block" >แก้ไข</button>-->
					<a data-toggle="modal" href="#edit_user<?php echo $userdata->user_ID;?>" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-wrench"></i></a>
						<div class="modal fade" id="edit_user<?php echo $userdata->user_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<form name="edit_user" method="post" onsubmit="JavaScript:return check_form()" action="<?php echo base_url().index_page();?>/setting/edit_user/1">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">แก้ไข ข้อมูลผู้ใช้ / Edit Data User</h4>
										</div>
										<div class="modal-body">
											<table class="table table-bordered">
												<tbody>
														<tr>
															<td>
																<input type="hidden" name="user_ID" value="<?php echo $userdata->user_ID;?>" required>

																		<div class="form-group">
																		วันที่เริ่มงาน <input type="text" name="start_date_work" value="<?php echo $userdata->start_date_work;?>" style="background: #CCCCCC" readonly>
																		
																		</div>
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" id="name_en" name="name_en" value="<?php echo $userdata->name_en;?>" required>
																		นามสกุล(ภาษาอังกฤษ) <input type="text" id="surname_en" name="surname_en" value="<?php echo $userdata->surname_en;?>" required>
																		</div>
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาไทย) <input type="text" id="name_th" name="name_th" value="<?php echo $userdata->name_th;?>">
																		นามสกุล(ภาษาไทย) <input type="text" id="surname_th"name="surname_th" value="<?php echo $userdata->surname_th;?>">
																		</div>
																		<div class="form-group">
																		อีเมล์ <input type="text" name="email" value="<?php echo $userdata->email;?>" style="background: #CCCCCC" readonly >
																		เบอร์โทร <input type="text" id="phone" name="phone" value="<?php echo $userdata->phone;?>">
																		</div>
																			<div class="col-md-4">
																			แผนก
																			<!-- <select class="form-control" name="department_ID"   <?php if($userdata->user_type_ID!=0){echo 'readonly';}?> required>
																				<option value="<?php echo $userdata->department_ID;?>"><?php echo $userdata->department_Name;?></option>
																				<?php foreach($department_all as $row){?>
																				<option value="<?php echo $row->department_ID;?>"><?php echo $row->department_Name;?></option>
																				<?php }?>
																			</select> -->
																			<input type="hidden" name="department_ID" value="<?php echo $userdata->department_ID;?>">
																			<input type="text" value="<?php echo $userdata->department_Name;?>" style="background: #CCCCCC" readonly >
																			</div>

																			<div class="col-md-4">
																			ตำแหน่ง
																			<!-- <select class="form-control" name="position_ID"   <?php if($userdata->user_type_ID!=0){echo 'readonly';}?> required>
																				<option value="<?php echo $userdata->position_ID;?>"><?php echo $userdata->position_Name;?></option>
																				<?php foreach($position_all as $row){?>
																				<option value="<?php echo $row->position_ID;?>"><?php echo $row->position_Name;?></option>
																				<?php }?>
																			</select> -->
																			<input type="hidden" name="position_ID" value="<?php echo $userdata->position_ID;?>">
																			<input type="text" value="<?php echo $userdata->position_Name;?>" style="background: #CCCCCC" readonly >
																		 	</div>

																			<div class="col-md-4">
																			ประเภทผู้ใช้
																			<!-- <select class="form-control" name="user_type_ID"   <?php if($userdata->user_type_ID!=0){echo 'readonly';}?> required>
																				<option  value="<?php echo $userdata->user_type_ID;?>"><?php echo $userdata->user_type_Name;?></option>
																				<?php foreach($get_user_type_all as $row){?>
																				<option value="<?php echo $row->user_type_ID;?>"><?php echo $row->user_type_Name;?></option>
																				<?php }?>
																			</select> -->
																			<input type="hidden" name="user_type_ID" value="<?php echo $userdata->user_type_ID;?>">
																			<input type="text" value="<?php echo $userdata->user_type_Name;?>" style="background: #CCCCCC" readonly >
																			</div>
																			<div class="col-md-4">
																			
																				Email ผู้รับเมื่อลา<input type="text" name="send_email_to" size="90" value="<?php echo $userdata->send_email_to;?>" style="background: #CCCCCC" readonly>
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
									</from>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>