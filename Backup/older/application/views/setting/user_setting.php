<script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<style type="text/css">
.modal-lg {
     width: 60%;
     height: 100%;
    }
.modal-footer{
	padding-top: 100px;
}
</style>
<script type="text/javascript">
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
	function check_add(){
		if (document.getElementById('datepicker3').value==''){
			document.getElementById('datepicker3').focus();
			alert('กรุณากรอก วันเริ่มงาน');
			return false;
		};
		if (document.getElementById('checkadd_name').value==''){
			document.getElementById('checkadd_name').focus();
			alert('กรุณากรอก รหัสผู้ใช้ ');
			return false;
		};
		if (document.getElementById('checkadd_password').value==''){
			document.getElementById('checkadd_password').focus();
			alert('กรุณากรอก รหัสผ่าน ');
			return false;
		};
		if (document.getElementById('checkadd_name_en').value==''){
			document.getElementById('checkadd_name_en').focus();
			alert('กรุณากรอก ชื้อผู้ใช้(ภาษาอังกฤษ) ');
			return false;
		};
		if (document.getElementById('checkadd_surname_en').value==''){
			document.getElementById('checkadd_surname_en').focus();
			alert('กรุณากรอก นามสกุล(ภาษาอังกฤษ)');
			return false;
		};
		if (document.getElementById('checkadd_name_th').value==''){
			document.getElementById('checkadd_name_th').focus();
			alert('กรุณากรอก ชื้อผู้ใช้(ภาษาไทย)');
			return false;
		};
		if (document.getElementById('checkadd_surname_th').value==''){
			document.getElementById('checkadd_surname_th').focus();
			alert('กรุณากรอก นามสกุล(ภาษาไทย)');
			return false;
		};
		if (document.getElementById('checkadd_email').value==''){
			document.getElementById('checkadd_email').focus();
			alert('กรุณากรอก อีเมล์ ');
			return false;
		};
		if (document.getElementById('checkadd_phone').value==''){
			document.getElementById('checkadd_phone').focus();
			alert('กรุณากรอก เบอร์โทร ');
			return false;
		};
	}
	function check_all(datepicker,name_en,surname_en,name_th,surname_th,email,phone,send_email_to)
	{
		if(datepicker.value=="")
		{
			alert('กรุณากรอก วันเริ่มงาน');
			datepicker.focus();
			return false;
		}
		if(name_en.value=="")
		{
			alert('กรุณากรอก ชื่อผู้ใช้(ภาษาอังกฤษ)');
			name_en.focus();
			return false;
		}
		if(surname_en.value=="")
		{
			alert('กรุณากรอก นามสกุล(ภาษาอังกฤษ)');
			surname_en.focus();
			return false;
		}
		if(name_th.value=="")
		{
			alert('กรุณากรอก ชื่อผู้ใช้(ภาษาไทย)');
			name_th.focus();
			return false;
		}
		if(surname_th.value=="")
		{
			alert('กรุณากรอก นามสกุล(ภาษาไทย)');
			surname_th.focus();
			return false;
		}
		if(email.value=="")
		{
			alert('กรุณากรอก อีเมล์');
			email.focus();
			return false;
		}
		if(phone.value=="")
		{
			alert('กรุณากรอก เบอร์โทร');
			phone.focus();
			return false;
		}
		if(send_email_to.value=="")
		{
			alert('กรุณากรอก Email ผู้รับเมื่อลา');
			send_email_to.focus();
			return false;
		}

	}
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / จัดการผู้ใช้ User setup</h5>
		</div>
	</div>
	<div class="bs-setting-user">

		<?php if($status==1){?>
		<div class="alert alert-block alert-success fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ขอแสดงความยินดี</h4>
			<p>คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.</p>
		</div>
		<?php } else if($status==2){?>
		<div class="alert alert-block alert-danger fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ขอแสดงความยินดี</h4>
			<p>คุณได้ทำการลบมูลเรียบร้อยแล้ว.</p>
		</div>
		<?php }else if($status==3){?>
		<div class="alert alert-block alert-warning fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ขอแสดงความยินดี</h4>
			<p>คุณได้ทำการแก้ไขมูลเรียบร้อยแล้ว.</p>
		</div>
		<?php }else if($status==4){?>
		<div class="alert alert-block alert-danger fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ข้อมูลผิดพลาด</h4>
			<p>ชื้อผู้ใช้งานของคุณไม่ถูกต้อง หรือ มีอยู่แล้ว.</p>
		</div>
		<?php }else if($status==5){?>
		<div class="alert alert-block alert-success fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ขอแสดงความยินดี</h4>
			<p>คำนวณเรียบร้อย</p>
		</div>
		<?php }?>






		<div class="tab-pane col-md-6 fade in active" id="user">
			<p>
				<a data-toggle="modal" href="#add_user" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add user</a>
				<!--<a href="<?php echo base_url().index_page();?>/setting/setting_date_user"  class="btn btn-default " target="_blank" >Print</a>-->

		</div>
		<form name="form1" method="post" action="<?php echo base_url().index_page();?>/user/search_user">
			<div class="col-md-3">
				<input type="text" name="search_user" data-loading-text="Loading..." class="form-control" id="search_user" placeholder="Please fill name that you want to search"  required>
			</div>
			<div class="col-md-2">
				<input type="submit" class="form-control btn btn-info" value="Search">
			</div>
			<div class="col-md-1">
				<a class="btn btn-info "  href="<?php echo base_url().index_page();?>/setting/setting_annual_all"><i class="glyphicon glyphicon-dashboard"></i></a>
			</div>

		</form>

		<ul id="myTab" class="nav nav-tabs">
		<?php foreach($department_all as $num_menu=>$department){?>			
			<li <?php if($num_menu==0){echo "class='active'";}?>><a href="<?php echo '#'.$department->department_ID;?>" data-toggle="tab"><?php echo $department->department_Name;?></a></li>
		<?php }?>
		</ul>

		<div id="myTabContent" class="tab-content">
			<?php foreach($department_all as $num=>$department){?>
				<div class="tab-pane fade <?php if($num==0){echo "in active";}?>" id="<?php echo $department->department_ID;?>">
					<p>
					<table class="table table-condensed table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>รหัส<br>id</th>
								<th>ชื่อ - สกุล<br>Name-Surname</th>
								<th>แผนก<br>Dept.</th>
								<th>ออฟฟิศ<br>Office</th>
								<th>ตำแหน่ง<br>Position</th>
								<th>อีเมล์<br>Email</th>
								<th>เบอร์โทร<br>Phone no.</th>
								<th>ประเภทผู้ใช้<br>User type</th>
								<th>แก้ไข<br>Edit</th>
								<th>ลบ<br>Delete</th>
								<th>คำนวณสิทธิ์<br></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$q=$this->db->query("SELECT * 
													FROM `user` 
													join user_type on user.user_type_ID=user_type.user_type_ID  
													join department on user.department_ID=department.department_ID 
													join office on  department.office_ID=office.office_ID 
													join position on  position.position_ID=user.position_ID 
													where user.department_ID  = '".$department->department_ID."'
													AND user.user_status=0");
								$result=$q->result();
								//print_r($result);
								//echo $department->department_ID; 
							?>
							<?php foreach($result as $num=>$result){?>
							<tr>
								<td><?php echo $num+=1;?></td>
								<td><?php echo $result->user_ID;?></td>
								<td><?php echo $result->name_th;?>-<?php echo $result->surname_th;?></td>
								<td><?php echo $result->department_Name;?></td>
								<td><?php echo $result->office_Name;?></td>
								<td><?php echo $result->position_Name;?></td>
								<td><?php if($result->email!="0"){echo $result->email;}else{echo "-";}?></td>
								<td><?php if($result->phone!="0"){echo $result->phone;}else{echo "-";}?></td>
								<td><?php echo $result->user_type_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_user<?php echo $result->user_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Department-->
									<div class="modal fade" id="edit_user<?php echo $result->user_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<form name="edit_user" method="post" onsubmit="JavaScript:return check_all(datepicker<?php echo $result->user_ID;?>,name_en<?php echo $num;?>,surname_en<?php echo $num;?>,name_th<?php echo $num;?>,surname_th<?php echo $num;?>,email<?php echo $num;?>,phone<?php echo $num;?>,send_email_to<?php echo $num;?>)" action="<?php echo base_url().index_page();?>/setting/edit_user/2">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข ข้อมูล / Edit Data</h4>
													</div>
													<div class="modal-body new-modal-body">

														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		    <script type="text/javascript">
																		      $(function() {
																		        $( "#datepicker<?php echo $result->user_ID;?>" ).datepicker(
																		        {
																		          dateFormat: 'dd/mm/yy',
																		          changeMonth: true,
																		          changeYear: true
																		        }
																		        );
																		      });
																		 
																		    </script>

																		
																		<input type="hidden" name="user_ID" value="<?php echo $result->user_ID;?>" required>
																		
																		<div class="form-group">
																		
																		วันเริ่มงาน<input type="text"  name="start_date_work" value="<?php echo $result->start_date_work;?>" id="datepicker<?php echo $result->user_ID;?>" required>
																		</div>
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" name="name_en" id="name_en<?php echo $num;?>" value="<?php echo $result->name_en;?>" required>
																		นามสกุล(ภาษาอังกฤษ) <input type="text" name="surname_en" id="surname_en<?php echo $num;?>" value="<?php echo $result->surname_en;?>" required>
																		</div>
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาไทย) <input type="text" name="name_th" id="name_th<?php echo $num;?>" value="<?php echo $result->name_th;?>">
																		นามสกุล(ภาษาไทย) <input type="text" name="surname_th" id="surname_th<?php echo $num;?>" value="<?php echo $result->surname_th;?>">
																		</div>
																		<div class="form-group">
																		อีเมล์ <input type="text" name="email" id="email<?php echo $num;?>" value="<?php echo $result->email;?>">
																		เบอร์โทร <input type="text" name="phone" id="phone<?php echo $num;?>" value="<?php echo $result->phone;?>">
																		</div>
																			<div class="col-md-4">
																			แผนก
																			<select class="form-control" name="department_ID" required>
																				<option value="<?php echo $result->department_ID;?>"><?php echo $result->department_Name;?></option>
																				<?php foreach($department_all as $row){?>
																				<option value="<?php echo $row->department_ID;?>"><?php echo $row->department_Name;?></option>
																				<?php }?>
																			</select>
																			</div>

																			<div class="col-md-4">
																			ตำแหน่ง
																			<select class="form-control" name="position_ID" required>
																				<option value="<?php echo $result->position_ID;?>"><?php echo $result->position_Name;?></option>
																				<?php foreach($position_all as $row){?>
																				<option value="<?php echo $row->position_ID;?>"><?php echo $row->position_Name;?></option>
																				<?php }?>
																			</select>
																		 	</div> 

																			<div class="col-md-4">
																			ประเภทผู้ใช้
																			<select class="form-control" name="user_type_ID" required>
																				<option value="<?php echo $result->user_type_ID;?>"><?php echo $result->user_type_Name;?></option>
																				<?php foreach($get_user_type_all as $row){?>
																				<option value="<?php echo $row->user_type_ID;?>"><?php echo $row->user_type_Name;?></option>
																				<?php }?>
																			</select>
																			</div>

																			<div class="col-md-4">
																				Email ผู้รับเมื่อลา<input type="text" name="send_email_to" size="90" id="send_email_to<?php echo $num;?>" value="<?php echo $result->send_email_to;?>">
																			</div>
																	</td>
																</tr>
															</tbody>
														</table>
														<h4>สิทธิ์การลาประจำปี <?php echo $user['this_year'];?> / Leaves information for <?php echo $user['this_year'];?></h4>
															<table class="table table-hover table-bordered table-condense">
															<thead>
																<tr>
																	<th>#</th>
																	<th>การลา<BR>Leave type</th>
																	<th>สิทธิ์มีอยู่<BR>Maximum allowed</th>
																	<th>สิทธิ์เก่ายกมา<BR>Oldremaining leaves</th>
																	<th>สิทธิ์เก่าใช้ไป<BR>Old leaves already taken</th>
																	<th>สิทธิ์ใหม่ใช้ไป<BR>New leaves already taken</th>
																	<th>หมายเหตุ<BR>remark</th>
																</tr>
															</thead>							
																<tbody>
																	<tr>
																	<td>1</td>
																	<td>ลาพักร้อน<BR>Annual leave</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q1=$this->db->query("
																			SELECT annual_have
																			FROM leave_annual 
																			WHERE user_ID='".$result->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result1=$q1->result();
																		//echo $result1[0]->annual_have;									
																		?>
																		<input type="text" name="an_have" size="5" value="<?php echo @$result1[0]->annual_have; ?>">
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q2=$this->db->query("
																			SELECT annual_old as annual
																			FROM leave_annual 
																			WHERE user_ID='".$result->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result2=$q2->result();
																		//echo $result2[0]->annual;
																		?>
																		<input type="text" name="an_old" size="5" value="<?php echo @$result2[0]->annual; ?>">
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q3=$this->db->query("
																			SELECT annual_old_use as annual
																			FROM leave_annual 
																			WHERE user_ID='".$result->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result3=$q3->result();
																		//echo $result3[0]->annual;
																		?>
																		<input type="text" name="an_old_use" size="5" value="<?php echo @$result3[0]->annual; ?>">
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q4=$this->db->query("
																			SELECT annual_new_use as annual
																			FROM leave_annual 
																			WHERE user_ID='".$result->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result4=$q4->result();
																		//echo $result4[0]->annual;
																		?>
																		<input type="text" name="an_new_use" size="5" value="<?php echo @$result4[0]->annual; ?>">
																	</td>
																		<td>วัน / Day</td>
																	</tr>
																	<tr>
																		<td>2</td>
																		<td>ลากิจ<br>Casual leave</td>
																		<td>-</td>
																		<td>-</td>
																		<td>-</td>
																		<td>-</td>
																		<td><?php
																		$year_now =date('Y'); 
																		$q5=$this->db->query("
																			SELECT sum(total_date) as annual
																			FROM leaves 
																			WHERE user_leave='".$result->user_ID."' 
																			AND start_date like '".$year_now."%'  and  (leaves.leave_type_ID=3 or leaves.leave_type_ID=4) and (leaves.acceptation_ID =1 or leaves.acceptation_ID =2)");
																		$result5=$q5->result();
																		echo $result5[0]->annual;
																		?> วัน / Day</td>
																	</tr>
																	<tr>
																		<td>3</td>
																		<td>ลาป่วย<br>Sick leave</td>
																		<td>-</td>
																		<td>-</td>
																		<td>-</td>
																		<td>-</td>
																		<td><?php
																		$year_now =date('Y'); 
																		$q6=$this->db->query("
																			SELECT sum(total_date) as annual
																			FROM leaves 
																			WHERE user_leave='".$result->user_ID."' 
																			AND start_date like '".$year_now."%' 
																			AND leaves.leave_type_ID=5
																			AND (leaves.acceptation_ID =1 or leaves.acceptation_ID =2)");
																		$result6=$q6->result();
																		echo $result6[0]->annual;
																		?> วัน / Day</td>
																	</tr>
																</tbody>
															</table>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">Save</button>
													</div>
												</form>
											</div>
										</div>
									</div><!-- /.modal -->
								</td>
								<td>
									<a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_user/<?php echo $result->user_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
								<td>
									<a class="btn btn-info"  href="<?php echo base_url().index_page();?>/setting/setting_annual/<?php echo $result->user_ID;?>/1"><i class="glyphicon glyphicon-dashboard"></i></a>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					</p>
				</div>
			<?php }?>
		</div>
	</div>
</div>


<!-- ************************************ modal ****************************************-->
<!-- Modal Add user-->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form name="add_user" method="post" onsubmit="JavaScript:return check_add()" action="<?php echo base_url().index_page();?>/setting/add_user">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มผู้ใช้ / Add user</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<div class="form-group">
									วันเริ่มงาน<input type="text" name="start_date_work" id="datepicker3" required>
									</div>
									<div class="form-group">
									รหัสผู้ใช้ <input type="text" name="user_ID" value="" id="checkadd_name" required>

									รหัสผ่าน <input type="text" name="password" value="" id="checkadd_password"  required>
									</div>
									<div class="form-group">
									ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" name="name_en" value="" id="checkadd_name_en"  required>
									นามสกุล(ภาษาอังกฤษ) <input type="text" name="surname_en" value="" id="checkadd_surname_en"  required>
									</div>
									<div class="form-group">
									ชื้อผู้ใช้(ภาษาไทย) <input type="text" name="name_th" value="" id="checkadd_name_th">
									นามสกุล(ภาษาไทย) <input type="text" name="surname_th" value="" id="checkadd_surname_th">
									</div>
									<div class="form-group">
									อีเมล์ <input type="text" name="email" value="" required  id="checkadd_email">
									เบอร์โทร <input type="text" name="phone" value="" id="checkadd_phone">
									</div>

										<div class="col-md-4">
										แผนก
										<select class="form-control" name="department_ID" required>
											<?php foreach($department_all as $row){?>
											<option value="<?php echo $row->department_ID;?>"><?php echo $row->department_Name;?></option>
											<?php }?>
										</select>
										</div>

										 <div class="col-md-4">
										ตำแหน่ง
										<select class="form-control" name="position_ID" required  id="checkadd_position_ID">
											<?php foreach($position_all as $row){?>
											<option value="<?php echo $row->position_ID;?>"><?php echo $row->position_Name;?></option>
											<?php }?>
										</select>
										</div> 

										<div class="col-md-4">
										ประเภทผู้ใช้
										<select class="form-control" name="user_type_ID" required>
										
											<?php foreach($get_user_type_all as $row){?>
											<option value="<?php echo $row->user_type_ID;?>"><?php echo $row->user_type_Name;?></option>
											<?php }?>
										</select>
										</div>
										<div class="col-md-4">
											Email ผู้รับเมื่อลา<input type="text" name="send_email_to" size="90" value="<?php echo $result->send_email_to;?>" required>
										</div>

								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>

	</div>

</div>


 <script type="text/javascript">
  $(function() {
    $( "#datepicker3" ).datepicker(
    {
      dateFormat: 'dd/mm/yy',
      changeMonth: true,
      changeYear: true
    }
    );
  });

</script>




