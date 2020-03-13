<style type="text/css">
	table thead tr th{
		text-align: center;
		vertical-align: middle;
	}
	.msg_alert{
		font-size: 24px;
		position:fixed;
		top:40%;
		z-index: 9999;

		-moz-box-shadow: 5px 5px 5px #ccc;  
		-webkit-box-shadow: 5px 5px 5px #ccc;  
		box-shadow: 5px 5px 5px #ccc;   
		height: 100px;
	}

	.msg_wait{
		height: 100%;
		padding-top: 10px;
	}

	.msg_success{
		height: 100%;
		padding-top: 17px;
	}

	.msg_error{
		height: 100%;
		padding-top: 17px;
	}

	.ico-red{
		color: red;
	}

	.ico-green{
		color: green;
	}
</style>
<div class="row"><br></br><br><br></div>
<div class="container" style="margin-top:18px;">
	<div class="col-md-12 col-xs-12">
		<div class="col-md-2 col-xs-12">
		<button id="btn_add_user" type="button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> เพิ่มผู้ใช้</button>
		</div>
		<div class="col-md-3 col-xs-12">
			<div class="input-group">
				<select id="dept_search" name="dept_search" class="form-control">
					<?php foreach($department as $idx => $val):?>
					<option value="<?php echo $val->department_ID;?>" <?php echo(isset($dept_search) and $dept_search==$val->department_ID)?'selected':'';?>><?php echo $val->department_Name;?></option>
					<?php endforeach;?>
				</select>
				<span class="input-group-btn">
					<button id="btn_search_dept" class="btn btn-info" type="button"><span class="glyphicon glyphicon-eye-open"></span></button>
				</span>
			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-4 col-xs-12">
			<div class="input-group">
				<input type="text" id="search_user" name="search_user" class="form-control" placeholder="Search Name..." value="<?php echo(isset($search_name))?$search_name:'';?>">
				<span class="input-group-btn">
					<button id="btn_search_user" class="btn btn-info" type="button"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</div>
		<div class="col-md-12"><br></div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<table id="tb_user" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>รหัส<br>ID</th>
							<th>ชื่อ - สกุล<br>Name - Surname</th>
							<th>แผนก<br>Dept.</th>
							<th>ออฟฟิศ<br>Office</th>
							<th>ตำแหน่ง<br>Position</th>
							<th>อีเมล์<br>E-mail</th>
							<th>เบอร์โทร<br>Tel.</th>
							<th>ประเภทผู้ใช้<br>User Type</th>
							<th>แก้ไข<br>Edit</th>
							<th>ลบ<br>Delete</th>
							<th>คำนวณสิทธิ์</th>
						</tr>
					</thead>
					<tbody>
						<?php if(empty($user_list)):?>
						<tr>
							<td colspan="12" align="center">- NO DATA -</td>
						</tr>
						<?php else: $no=1; foreach($user_list as $idx => $val):?>
						<tr>
							<td align="center"><?php echo $no;?></td>
							<td align="center"><?php echo $val->user_ID;?></td>
							<td><?php echo $val->name_th.' '.$val->surname_th.' / '.$val->name_en.' '.$val->surname_en;?></td>
							<td align="center"><?php echo $val->department_Name;?></td>
							<td align="center"><?php echo $val->office_Name;?></td>
							<td><?php echo $val->position_Name;?></td>
							<td><?php echo $val->email;?></td>
							<td><?php echo $val->phone;?></td>
							<td><?php echo $val->user_type_Name;?></td>
							<td align="center"><button type="button" class="btn btn-warning" onclick="edit_user('<?php echo $val->user_ID;?>');"><span class="glyphicon glyphicon-wrench"></span></button></td>
							<td align="center"><button type="button" class="btn btn-danger" onclick="del_user('<?php echo $val->user_ID;?>');"><span class="glyphicon glyphicon-trash"></span></button></td>
							<td align="center"><button type="button" class="btn btn-info" onclick="cal_user('<?php echo $val->user_ID;?>');"><span class="glyphicon glyphicon-dashboard"></span></button></td>
						</tr>
						<?php $no++; endforeach; endif;?>
					</tbody>
				</table>
			</div>
		</div>			
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 id="head_modal" class="modal-title" style="text-align: center;">Modal Header</h4>
			</div>
			<div class="modal-body">
				<?php echo form_open('',array('id'=>'myform'));?>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">วันที่เริ่มงาน / Start date work <font color="red">*</font></label>
							<input id="start_date_work" name="start_date_work" type="text" class="form-control" autocomplete="off" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">รหัสพนักงาน / User ID <font color="red">*</font></label>
							<div class="input-group">
								<input id="user_ID" name="user_ID" type="text" class="form-control" minlength="4" autocomplete="off" required>
								<span class="input-group-addon" id="addon_user_id">
									<span class="glyphicon glyphicon-remove ico-red"></span>
								</span>
							</div>
							<input id="temp_user_ID" name="temp_user_ID" type="hidden">
							<div style="display: none;">
								<input type="radio" name="can_submit" id="can_submit_1" value="1"><!-- true -->
								<input type="radio" name="can_submit" id="can_submit_2" value="2"><!-- false -->
							</div>
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">วันเกิด / Birth day</label>
							<input id="birth_day" name="birth_day" type="text" class="form-control" autocomplete="off">
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">ชื่อภาษาไทย / Thai name <font color="red">*</font></label>
							<input id="name_th" name="name_th" type="text" class="form-control" required>
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">นามสกุลภาษาไทย / Thai surname <font color="red">*</font></label>
							<input id="surname_th" name="surname_th" type="text" class="form-control" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">ชื่อภาษาอังกฤษ / English name <font color="red">*</font></label>
							<input id="name_en" name="name_en" type="text" class="form-control" required>
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">นามสกุลภาษาอังกฤษ / English surname <font color="red">*</font></label>
							<input id="surname_en" name="surname_en" type="text" class="form-control" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">แผนก / Department <font color="red">*</font></label>
							<select id="department" name="department" class="form-control">
								<?php foreach($department as $idx => $val):?>
								<option value="<?php echo $val->department_ID;?>"><?php echo $val->department_Name;?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">ออฟฟิศ / Office <font color="red">*</font></label>
							<select id="office" name="office" class="form-control">
								<?php foreach($office as $idx => $val):?>
								<option value="<?php echo $val->office_ID;?>"><?php echo $val->office_Name;?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">ตำแหน่ง / Position <font color="red">*</font></label>
							<select id="position" name="position" class="form-control">
								<?php foreach($position as $idx => $val):?>
								<option value="<?php echo $val->position_ID;?>"><?php echo $val->position_Name;?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">เบอร์โทรศัพท์ / Phone number</label>
							<input id="phone" name="phone" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">อีเมล์ / E-mail</label>
							<input id="email" name="email" type="email" class="form-control">
						</div>
						<div class="col-md-offset-2 col-md-5">
							<label class="label-control">รหัสผ่าน / Password <font color="red">*</font></label>
							<input id="password" name="password" type="password" class="form-control" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<label class="label-control">ประเภทผู้ใช้ / User type <font color="red">*</font></label>
							<select id="user_type" name="user_type" class="form-control">
								<?php foreach($user_type as $idx => $val):?>
								<option value="<?php echo $val->user_type_ID;?>"><?php echo $val->user_type_Name;?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<label class="label-control">ส่งอีเมล์ถึง / Send E-mail to <font color="red">*</font></label>
							<input id="send_email_to" name="send_email_to" type="text" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row" id="tb_annual">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="text-align: center; vertical-align: middle;">การลา<br>Leave Type</th>
									<th style="text-align: center; vertical-align: middle;">สิทธิที่มีอยู่<br>Maximum allowed</th>
									<th style="text-align: center; vertical-align: middle;">สิทธิเก่ายกมา<br>Oldremanning leaves</th>
									<th style="text-align: center; vertical-align: middle;">สิทธิเก่าใช้ไป<br>Old leaves already taken</th>
									<th style="text-align: center; vertical-align: middle;">สิทธิใหม่ใช้ไป<br>New leaves already taken</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>ลาพักร้อน / Annual Leave</td>
									<td><input id="new_annual" name="new_annual" type="text" class="form-control" value="0" required></td>
									<td><input id="old_annual" name="old_annual" type="text" class="form-control" value="0" required></td>
									<td><input id="old_annual_use" name="old_annual_use" type="text" class="form-control" value="0" required></td>
									<td><input id="new_annual_use" name="new_annual_use" type="text" class="form-control" value="0" required></td>
								</tr>
								<tr>
									<td>ลากิจ / Casual Leave</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>ลาป่วย / Sick Leave</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<button id="btn_submit_form" type="submit" style="display: none;"></button>
				<?php echo form_close();?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="btn_save_user" type="button" class="btn btn-success">Save</button>
			</div>
		</div>
	</div>
</div>

<div id="msg_wait" class="msg_alert col-md-offset-4 col-md-4 alert alert-warning" align="center" roll="dialog" style="display: none;">
	<div class="msg_wait" role="alert"><img src="<?php echo base_url('assets/img/loading2.gif');?>" width="50px"> Waiting...</div>
</div>
<div id="msg_success" class="msg_alert col-md-offset-4 col-md-4 alert alert-success" align="center" roll="dialog" style="display: none;">
	<div class="msg_success" role="alert">Success</div>
</div>
<div id="msg_error" class="msg_alert col-md-offset-4 col-md-4 alert alert-danger" align="center" roll="dialog" style="display: none;">
	<div class="msg_error" role="alert">Error!</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#start_date_work').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true
		});

		$('#birth_day').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true
		});
	});

	function edit_user(user_ID){
		$('#msg_wait').show();
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/user_setup/get_user_data');?>",
			async: false,
			data: { 'user_ID': user_ID },
			success: function(res){
				// console.log(res);
				setTimeout(function(){
					$('#msg_wait').hide();
					if(res=='error'){
						$('#msg_error').show();
						setTimeout(function(){
							$('#msg_error').hide();
						}, 2000);
					}else{
						$('#head_modal').text('แก้ไขข้อมูลผู้ใช้ / Edit User');
						$('#myform').trigger('reset');
						$('#start_date_work').val(res[0]['start_date_work']);
						$('#user_ID').val(res[0]['user_ID']);
						$('#temp_user_ID').val(res[0]['user_ID']);
						$('#birth_day').val(res[0]['birth_date']);
						$('#name_th').val(res[0]['name_th']);
						$('#surname_th').val(res[0]['surname_th']);
						$('#name_en').val(res[0]['name_en']);
						$('#surname_en').val(res[0]['surname_en']);
						$('#department').val(res[0]['department_ID']);
						$('#office').val(res[0]['office_ID']);
						$('#position').val(res[0]['position_ID']);
						$('#phone').val(res[0]['phone']);
						$('#email').val(res[0]['email']);
						$('#password').val(res[0]['password']);
						$('#user_type').val(res[0]['user_type_ID']);
						$('#send_email_to').val(res[0]['send_email_to']);

						$('#can_submit_1').prop('checked', true);

						$('#new_annual').val(res[0]['annual_new']);
						$('#old_annual').val(res[0]['annual_old']);
						$('#old_annual_use').val(res[0]['annual_old_use']);
						$('#new_annual_use').val(res[0]['annual_new_use']);

						$('#tb_annual').css('display','');
						$('#addon_user_id').html('<span class="glyphicon glyphicon-ok ico-green"></span>');
						$('#myModal').modal('show');
					}
				}, 1000);
			}
		});
		return false;
	}

	function del_user(user_ID){
		if(confirm('ต้องการลบพนักงานคนนี้ออกหรือไม่?')){
			$('#msg_wait').show();
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "<?php echo base_url('index.php/user_setup/del_user');?>",
				data: { 'user_ID': user_ID },
				async: false,
				success: function(res){
					setTimeout(function(){
						$('#msg_wait').hide();
						if(res == 'success'){
							$('#msg_success').show();
							setTimeout(function(){
								$('#msg_success').hide();
								location.reload();
							}, 2000);
						}
					}, 2000);
				}
			});
		}
		return false;
	}

	function cal_user(user_ID){
		$('#msg_wait').show();
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/user_setup/cal_user');?>",
			data: { 'user_ID': user_ID },
			async: false,
			success: function(res){
				setTimeout(function(){
					$('#msg_wait').hide();
					if(res == 'success'){
						$('#msg_success').show();
						setTimeout(function(){
							$('#msg_success').hide();
							location.reload();
						}, 2000);
					}else{
						$('#msg_error').show();
						setTimeout(function(){
							$('#msg_error').hide();
						}, 2000);
					}
				}, 2000);
			}
		});
		return false;
	}

	$('#btn_search_dept').on('click', function(){
		var department_ID = $('#dept_search').val();
		$('#msg_wait').show();
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/user_setup/search_dept');?>",
			async: false,
			data: { 'department_ID': department_ID },
			success: function(res){
				// console.log(res);
				setTimeout(function(){
					$('#msg_wait').hide();
					if(res == 'error'){
						$('#msg_error').show();
						setTimeout(function(){
							$('#msg_error').hide();
						}, 2000);
					}else{
						$('#msg_success').show();
						$('#tb_user tbody').empty();
						if(res==""){
							$('#tb_user tbody').append('<tr><td colspan="12" align="center">- NO DATA -</td></tr>');
						}else{
							$.each(res, function(i, val){
								$('#tb_user tbody').append('<tr>'
															+'<td align="center">'+(i+1)+'</td>'
															+'<td align="center">'+val['user_ID']+'</td>'
															+'<td>'+val['name_th']+' '+val['surname_th']+' / '+val['name_en']+' '+val['surname_en']+'</td>'
															+'<td align="center">'+val['department_Name']+'</td>'
															+'<td align="center">'+val['office_Name']+'</td>'
															+'<td>'+val['position_Name']+'</td>'
															+'<td>'+val['email']+'</td>'
															+'<td>'+val['phone']+'</td>'
															+'<td>'+val['user_type_Name']+'</td>'
															+'<td align="center"><button type="button" class="btn btn-warning" onclick="edit_user(\''+val['user_ID']+'\');"><span class="glyphicon glyphicon-wrench"></span></button></td>'
															+'<td align="center"><button type="button" class="btn btn-danger" onclick="del_user(\''+val['user_ID']+'\');"><span class="glyphicon glyphicon-trash"></span></button></td>'
															+'<td align="center"><button type="button" class="btn btn-info" onclick="cal_user(\''+val['user_ID']+'\');"><span class="glyphicon glyphicon-dashboard"></span></button></td>'
															+'</tr>');
							});
						}
						setTimeout(function(){
							$('#msg_success').hide();
						}, 2000);
					}
				}, 2000);
			}
		});
		return false;
	});

	$('#btn_search_user').on('click', function(){
		var name = $('#search_user').val();
		if(name != ""){
			$('#msg_wait').show();
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "<?php echo base_url('index.php/user_setup/search_user');?>",
				async: false,
				data: { 'name': name },
				success: function(res){
					// console.log(res);
					setTimeout(function(){
						$('#msg_wait').hide();
						if(res == 'error'){
							$('#msg_error').show();
							setTimeout(function(){
								$('#msg_error').hide();
							}, 2000);
						}else{
							$('#msg_success').show();
							$('#tb_user tbody').empty();
							if(res==""){
								$('#tb_user tbody').append('<tr><td colspan="12" align="center">- NO DATA -</td></tr>');
							}else{
								$.each(res, function(i, val){
									$('#tb_user tbody').append('<tr>'
																+'<td align="center">'+(i+1)+'</td>'
																+'<td align="center">'+val['user_ID']+'</td>'
																+'<td>'+val['name_th']+' '+val['surname_th']+' / '+val['name_en']+' '+val['surname_en']+'</td>'
																+'<td align="center">'+val['department_Name']+'</td>'
																+'<td align="center">'+val['office_Name']+'</td>'
																+'<td>'+val['position_Name']+'</td>'
																+'<td>'+val['email']+'</td>'
																+'<td>'+val['phone']+'</td>'
																+'<td>'+val['user_type_Name']+'</td>'
																+'<td align="center"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></button></td>'
																+'<td align="center"><button type="button" class="btn btn-danger" onclick="del_user(\''+val['user_ID']+'\');"><span class="glyphicon glyphicon-trash"></span></button></td>'
																+'<td align="center"><button type="button" class="btn btn-info" onclick="cal_user(\''+val['user_ID']+'\');"><span class="glyphicon glyphicon-dashboard"></span></button></td>'
																+'</tr>');
								});
							}
							setTimeout(function(){
								$('#msg_success').hide();
							}, 2000);
						}
					}, 2000);
				}
			});

		}
		return false;
	});

	$('#search_user').on('keyup', function(e){
		if(e.which == 13){
			$('#btn_search_user').click();
		}
		return false;
	});

	$('#btn_add_user').on('click', function(){
		$('#head_modal').text('เพิ่มข้อมูลผู้ใช้ / Add User');
		$('#myform').trigger('reset');
		$('#tb_annual').css('display','none');
		$('#addon_user_id').html('<span class="glyphicon glyphicon-remove ico-red"></span>');
		$('#can_submit_2').prop('checked', true);
		$('#myModal').modal('show');
	});

	$('#user_ID').on('blur', function(){
		var user_ID = $('#user_ID').val().trim();
		var temp_user_ID = $('#temp_user_ID').val().trim();
		if(user_ID != "" && user_ID != temp_user_ID){
			$('#addon_user_id').html('<img src="<?php echo base_url('assets/img/loader2.gif');?>" width="20px;">');
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "<?php echo base_url('index.php/user_setup/chk_user_ID');?>",
				data: { 'user_ID': user_ID },
				success: function(res){
					setTimeout(function(){
						if(res=='success'){
							$('#addon_user_id').html('<span class="glyphicon glyphicon-ok ico-green"></span>');
							$('#can_submit_1').prop('checked', true);
						}else{
							$('#addon_user_id').html('<span class="glyphicon glyphicon-remove ico-red"></span>');
							$('#can_submit_2').prop('checked', true);
						}
					}, 1000);
				}
			});
		}else if(user_ID != "" && user_ID == temp_user_ID){
			$('#addon_user_id').html('<span class="glyphicon glyphicon-ok ico-green"></span>');
			$('#can_submit_1').prop('checked', true);
		}else{
			$('#addon_user_id').html('<span class="glyphicon glyphicon-remove ico-red"></span>');
			$('#can_submit_2').prop('checked', true);
		}
	});

	$('#btn_save_user').on('click', function(){
		$('#btn_submit_form').click();
	});

	$('#myform').on('submit', function(){
		var start_date_work = $('#start_date_work').val();
		var user_ID = $('#user_ID').val();
		var birth_day = $('#birth_day').val();
		var name_th = $('#name_th').val();
		var surname_th = $('#surname_th').val();
		var name_en = $('#name_en').val();
		var surname_en = $('#surname_en').val();
		var department = $('#department').val();
		var office = $('#office').val();
		var position = $('#position').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var user_type = $('#user_type').val();
		var send_email_to = $('#send_email_to').val();

		var can_submit = $('input[name="can_submit"]:checked').val();

		var new_annual = $('#new_annual').val();
		var old_annual = $('#old_annual').val();
		var old_annual_use = $('#old_annual_use').val();
		var new_annual_use = $('#new_annual_use').val();

		if(can_submit == 2){
			alert('กรุณาตรวจสอบรหัสพนักงานให้ถูกต้อง');
			$('#user_ID').focus();
			return false;
		}
		
		$('#msg_wait').show();
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/user_setup/manage_user');?>",
			async: false,
			data: {
				'start_date_work': start_date_work,
				'user_ID': user_ID,
				'birth_day': birth_day,
				'name_th': name_th,
				'surname_th': surname_th,
				'name_en': name_en,
				'surname_en': surname_en,
				'department': department,
				'office': office,
				'position': position,
				'phone': phone,
				'email': email,
				'password': password,
				'user_type': user_type,
				'send_email_to': send_email_to,
				'new_annual': new_annual,
				'old_annual': old_annual,
				'old_annual_use': old_annual_use,
				'new_annual_use': new_annual_use
			},
			success: function(res){
				setTimeout(function(){
					$('#msg_wait').hide();
					$('#msg_success').show();
					setTimeout(function(){
						$('#msg_success').hide();
						location.reload();
					}, 2000);
				}, 2000);
			}
		});
		return false;
	});
</script>