<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
  	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>
</head>
<body>
<div class="row"><br></br></div>
<div class="container" style="margin-top:18px;">
	<div class="row">
		<ul id="myTab" class="nav nav-tabs ">			
			<li><a href="#user_type" tabindex="-1" data-toggle="tab">ประเภทผู้ใช้ / User type</a></li>
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">สำนักงาน Office /แผนก  Dept.<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a href="#office" tabindex="-1" data-toggle="tab">สำนักงาน / Office</a></li>
					<li><a href="#department" tabindex="-1" data-toggle="tab">แผนก / Dept.</a></li>
				</ul>
			</li>
			<li><a href="#acceptinon" data-toggle="tab">สถานะใบลา / Leave status</a></li>
			<li><a href="#progression" data-toggle="tab">การเดินทาง / Trip type</a></li>
			<li><a href="#position" data-toggle="tab">ตำแหน่ง / Position</a></li>
			<li><a href="#leave_type" data-toggle="tab">ประเภทการลา /  Leave Type</a></li>
		</ul>

<div class="panel panel-default">
			<div class="panel-heading "></div>
				<div class="panel-body">
					
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade in active" id="user_type">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_user_type" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>ประเภทผู้ใช้งาน / Type</th>
								<th>แก้ไข / Edit</th>
								<th>ลบ / Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($user_type_all as $num_user_type=>$user_type){?>
							<tr>
								<td><?php echo $num_user_type+=1;?></td>
								<td><?php echo $user_type->user_type_Name;?></td>
								<td>
									<?php
									if($user_type->user_type_ID!=0 or $user_type->user_type_Name!="Administrator")
										{?>
									<a data-toggle="modal" href="#edit_user_type<?php echo $user_type->user_type_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit user type -->
									<div class="modal fade" id="edit_user_type<?php echo $user_type->user_type_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_user_type">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข ประเภทผู้ใช้ / Edit type user</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input name="user_type_Name" type="text" class="form-control" value="<?php echo $user_type->user_type_Name;?>" required>
																		<input name="user_type_ID" type="hidden" value="<?php echo $user_type->user_type_ID;?>">
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
									<?php }
									?>
								</td>
								<td>

								<?php if($user_type->user_type_ID!=0 or $user_type->user_type_Name!="Administrator"){?><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_user_type/<?php echo $user_type->user_type_ID;?>" onclick ="return confirm('ต้องการลบใช่หรือไม่');"><i class="glyphicon glyphicon-trash"></i></a>  <?php }?>

								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</p>
			</div>

		
			<div class="tab-pane fade" id="office">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_office" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>สำนักงาน / Office</th>
								<th>แก้ไข / Edit</th>
								<th>ลบ / Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($office_all as $num_office=>$office){?>
							<tr>
								<td><?php echo $num_office+=1;?></td>
								<td><?php echo $office->office_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_office<?php echo $office->office_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Office-->
									<div class="modal fade" id="edit_office<?php echo $office->office_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_office">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข สำนักงาน / Edit Office</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input name="office" type="text" class="form-control" value="<?php echo $office->office_Name;?>" required>
																		<input name="office_ID" type="hidden" value="<?php echo $office->office_ID;?>">
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
								</td>
								<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_office/<?php echo $office->office_ID;?>" onclick ="return confirm('ต้องการลบใช่หรือไม่');"><i class="glyphicon glyphicon-trash"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</p>
			</div>
			<div class="tab-pane fade" id="department">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_department" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>แผนก / Dept.</th>
								<th>สำนักงาน / Office</th>
								<th>แก้ไข / Edit</th>
								<th>ลบ / Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($department_all as $num_department=>$department){?>
							<tr>
								<td><?php echo $num_department+=1;?></td>
								<td><?php echo $department->department_Name;?></td>
								<td><?php echo $department->office_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_department<?php echo $department->department_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Department-->
									<div class="modal fade" id="edit_department<?php echo $department->department_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="department" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_department">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไขแผนก / Edit Dept.</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input type="text" class="form-control" name="department_name" value="<?php echo $department->department_Name;?>" required>
																		<input type="hidden" name="department_ID" value="<?php echo $department->department_ID;?>">
																	</td>
																	<td>
																		<select class="form-control" name="office" required>
																			<option value="<?php echo $department->office_ID;?>"><?php echo $department->office_Name;?></option>
																			<?php foreach($office_all as $row){?>
																			<option value="<?php echo $row->office_ID;?>"><?php echo $row->office_Name;?></option>
																			<?php }?>
																		</select>
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
									</div><!-- /.modal -->
								</td>
								<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_department/<?php echo $department->department_ID;?>" onclick ="return confirm('ต้องการลบใช่หรือไม่');" ><i class="glyphicon glyphicon-trash"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</p>
			</div>

			<div class="tab-pane fade" id="acceptinon">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_acception" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-condensed table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>สถานะการลา / Leave status</th>
								<th>แกไข / Edit</th>
								<th>ลบ / Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($acceptation as $num_acc=>$acc){?>
							<tr>
								<td><?php echo $num_acc+=1;?></td>
								<td><?php echo $acc->acceptation_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_acception<?php echo $acc->acceptation_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Department-->
									<div class="modal fade" id="edit_acception<?php echo $acc->acceptation_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="department" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_acception">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข สถานะการลา / Edit leave status</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input type="text" class="form-control" name="acception_Name" value="<?php echo $acc->acceptation_Name;?>" required>
																		<input type="hidden" name="acception_ID" value="<?php echo $acc->acceptation_ID;?>">
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
									</div><!-- /.modal -->
								</td>
								<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_acception/<?php echo $acc->acceptation_ID;?>" onclick ="return confirm('ต้องการลบใช่หรือไม่');" ><i class="glyphicon glyphicon-trash"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="progression">
					<p>
						<div class="space-top"></div>
						<a data-toggle="modal" href="#add_progression" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
						<div class="space-top"></div>
						<table class="table table-bordered table-hover table-condansed">
							<thead>
								<tr>
									<th>#</th>
									<th>การเดินทาง / Trip type</th>
									<th>แก้ไข / Edit</th>
									<th>ลบ / Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($progression_all as $num_pro=>$pro){?>
								<tr>
									<td><?php echo $num_pro+=1;?></td>
									<td><?php echo $pro->progression_Name;?></td>
									<td>
										<a data-toggle="modal" href="#edit_progression<?php echo $pro->progression_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
										<!-- Modal edit Department-->
										<div class="modal fade" id="edit_progression<?php echo $pro->progression_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<form name="department" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_progression">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">แก้ไข การเดินทาง / Edit Trip type</h4>
														</div>
														<div class="modal-body">
															<table class="table table-bordered">
																<tbody>
																	<tr>
																		<td>
																			<input type="text" class="form-control" name="progression_Name" value="<?php echo $pro->progression_Name;?>" required>
																			<input type="hidden" name="progression_ID" value="<?php echo $pro->progression_ID;?>">
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
										</div><!-- /.modal -->
									</td>
									<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_progression/<?php echo $pro->progression_ID;?>"  onclick="return confirm('คุณต้องการลบใช่หรือไม่');" ><i class="glyphicon glyphicon-trash"></i></a></td>
								</tr>
								<?php }?>
							</tbody>
						</table>		
					</p>
				</div>

				<div class="tab-pane fade" id="position">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_position" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>ตำแหน่ง / Postion</th>
								<th>แก้ไข / Edit</th>
								<th>ลบ / Delate</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($position_all as $num_position=>$position){?>
							<tr>
								<td><?php echo $num_position+=1;?></td>
								<td><?php echo $position->position_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_position<?php echo $position->position_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Office-->
									<div class="modal fade" id="edit_position<?php echo $position->position_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="position" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_position">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข ตำแหน่ง / Edit Postion</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input name="position_Name" type="text" class="form-control" value="<?php echo $position->position_Name;?>" required>
																		<input name="position_ID" type="hidden" value="<?php echo $position->position_ID;?>">
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">Edit\</button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<!-- Modal edit Department-->
								</td>
								<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_position/<?php echo $position->position_ID;?>" onclick=" return confirm('คุณต้องการลบใช่หรือไม่');"><i class="glyphicon glyphicon-trash"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</p>
			</div>

			<div class="tab-pane fade" id="leave_type">
				<p>
					<div class="space-top"></div>
					<a data-toggle="modal" href="#add_type_leave" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Add</a>
					<div class="space-top"></div>
					<table class="table table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>ประเภทการลา / Leave Type</th>
								<th>แก้ไข / Edit</th>
								<th>ลบ / Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($leave_type_all as $num_leave_type=>$leave_type){?>
							<tr>
								<td><?php echo $num_office+=1;?></td>
								<td><?php echo $leave_type->leave_type_Name;?></td>
								<td>
									<a data-toggle="modal" href="#edit_leave_type<?php echo $leave_type->leave_type_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Office-->
									<div class="modal fade" id="edit_leave_type<?php echo $leave_type->leave_type_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/edit_leave_type">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข ประเภทการลา / Edit leave_type</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		

																		<div class="row">
																	  <div class="col-xs-6">ประเภทการลา
																	  		<input name="leave_type_Name" type="text" class="form-control" value="<?php echo $leave_type->leave_type_Name;?>" required>
																			<input name="leave_type_ID" type="hidden" value="<?php echo $leave_type->leave_type_ID;?>">
																	  		<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="leave_type_th" required> -->
																	  </div>
																	  <div class="col-xs-6">กลุ่มการลา
																	  		<!-- <input type="text" class="form-control"  name="leave_group_ID" value="<?php echo $leave_type->leave_group_ID;?>" > -->
																	  		<select class="form-control" name="leave_group_ID" required>
																			<!-- <option value="<?php echo $leave_type->leave_group_ID;?>"><?php echo $leave_type->leave_group_Name;?></option> -->
																			<?php foreach($leave_group_all as $row){?>
																			<option value="<?php echo $row->leave_group_ID;?>" <?php echo($leave_type->leave_group_ID==$row->leave_group_ID)?'selected':''; ?>><?php echo $row->leave_group_Name;?></option>
																			<?php }?>
																		</select>
																	  </div>
																	  <div class="col-xs-6">Title Name
																	  		<input type="text" class="form-control" name="title_name" value="<?php echo $leave_type->title_name;?>">
																	  </div>
																	  <div class="col-xs-6">Name EN 
																	  		<input type="text" class="form-control"  name="name_en" value="<?php echo $leave_type->name_en;?>">
																	  </div>
																	  <div class="col-xs-6">จำกัดการลา
																	  		<input type="text" class="form-control"  name="limit_leave"  value="<?php echo $leave_type->limit_leave;?>"><br>
																	  </div><br>
																	  <div class="col-xs-12">คิดวันลาหยุดด้วยหรือไม่
																	  		<label class="radio-inline">
									  											<input type="radio" name="cal_holiday" id="cal_holiday_1" value="1" <?php echo($leave_type->cal_holiday==1)?'checked':''; ?>> Yes
																			</label>
																			<label class="radio-inline">
									  											<input type="radio" name="cal_holiday" id="cal_holiday_2" value="0" <?php echo($leave_type->cal_holiday==0)?'checked':''; ?>> No
																			</label><br>
																	  		<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="position_Name" required> -->
																	  </div><br>
																	   <div class="col-xs-12">ใช่รายการย่อยของลากิจหรือไม่
																	   		<label class="radio-inline">
									  											<input type="radio" name="show_flag" id="show_flag_2" value="2" <?php echo($leave_type->show_flag==2)?'checked':''; ?>> Yes
																			</label>
																			<label class="radio-inline">
									  											<input type="radio" name="show_flag" id="show_flag_1" value="1" <?php echo($leave_type->show_flag==1)?'checked':''; ?>> No
																			</label>

																	  		<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="position_Name" required> -->
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
								</td>
								<td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/system_setup/del_leave_type/<?php echo $leave_type->leave_type_ID;?>" onclick=" return confirm('คุณต้องการลบใช่หรือไม่')"><i class="glyphicon glyphicon-trash"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</p>
			</div>


			</div>
		</p>
	</div>
</div>
</div>

<!-- ************************************ modal ****************************************-->

<!-- Modal Add user type-->
<div class="modal fade" id="add_user_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="user_type" method="post" action="<?php echo base_url('index.php/system_setup/add_user_type');?>">
	
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มประเภทผู้ใช้ / Add Type User</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input name="user_type_Name" id="user_type_Name" type="text" class="form-control" placeholder="ชื่อ ประเภทผู้ใช้ ใหม่" required>
									<input name="user_type_ID" type="hidden" value="NULL">
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
<!-- Modal Add user type -->

<!-- Modal Add Office-->
<div class="modal fade" id="add_office" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_office">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มสำนักงาน / Add office</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input name="office" type="text" class="form-control" placeholder="ชื่อ สำนักงาน ใหม่" required>
									<input name="office_ID" type="hidden" value="NULL">
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

<!-- Modal Add Department-->
<div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="department" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_department">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มแผนก / Add Dept.</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="department_name" placeholder="ชื่อ แผนก ใหม่" required></td>
								<td>
									<select class="form-control" name="office" required>
										<option value="">Office</option>
										<?php foreach($office_all as $row){?>
										<option value="<?php echo $row->office_ID;?>"><?php echo $row->office_Name;?></option>
										<?php }?>
									</select>
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

<!-- Modal Add acception-->
<div class="modal fade" id="add_acception" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_acception">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มสถานะการลา / Add leave status</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input name="acceptation" type="text" class="form-control" placeholder="ชื่อ สถานะใบลา ใหม่" required>
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

<!-- Modal Add progression-->
<div class="modal fade" id="add_progression" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_progression">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มการเดินทาง / Add trip type</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input type="text" class="form-control" placeholder="ชื่อ การเดินทางใหม่ ใหม่" name="progression_Name" required>
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

<!-- Modal Add prosition-->
<div class="modal fade" id="add_position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_position">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มตำแหน่ง / Add Position</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input type="text" class="form-control" placeholder="ชื่อ ตำแหน่ง ใหม่" name="position_Name" required>
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

<div class="modal fade" id="add_type_leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/system_setup/add_leave_type">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มประเภทการลา / Add Leave Type</h4>
				</div>
				<div class="modal-body">
					<table id="ltable" class="table table-bordered">
						<tbody>
							<tr>
								<td>

								<div class="row">
								  <div class="col-xs-6">ประเภทการลา
								  		<input type="text" class="form-control" placeholder="ประเภทการลา" name="leave_type_Name" required>
								  </div>
								  <div class="col-xs-6">กลุ่มการลา

								  		<!-- <input type="text" class="form-control" placeholder="leave_group_ID" name="leave_group_ID" required> -->
								  		<select class="form-control" name="leave_group_ID" required>
									
										<?php foreach($leave_group_all as $row){?>
										<option value="<?php echo $row->leave_group_ID;?>"><?php echo $row->leave_group_Name;?></option>
										<?php }?>
										</select>
								  </div>
								  <div class="col-xs-6">Leave Type
								  		<input type="text" class="form-control" placeholder="title_name" name="title_name" required>
								  </div>
								  <div class="col-xs-6">Name EN
								  		<input type="text" class="form-control" placeholder="name_en" name="name_en" required>
								  </div>
								  <div class="col-xs-6">จำกัดการลา
								  		<input type="text" class="form-control" placeholder="limit_leave" name="limit_leave" ><br>
								  </div><br>
								  <div class="col-xs-12">คิดวันลาหยุดด้วยหรือไม่
								  		<label class="radio-inline">
  											<input type="radio" name="cal_holiday" id="cal_holiday_1" value="1"> Yes
										</label>
										<label class="radio-inline">
  											<input type="radio" name="cal_holiday" id="cal_holiday_2" value="0" checked> No
										</label><br>
								  		<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="position_Name" required> -->
								  </div><br>
								   <div class="col-xs-12">ใช่รายการย่อยของลากิจหรือไม่
								   		<label class="radio-inline">
  											<input type="radio" name="show_flag" id="show_flag_2" value="2"> Yes
										</label>
										<label class="radio-inline">
  											<input type="radio" name="show_flag" id="show_flag_1" value="1" checked> No
										</label>

								  		<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="position_Name" required> -->
								  </div>
								</div>
									<!-- <input type="text" class="form-control" placeholder="ประเภทการลา" name="position_Name" required> -->
	
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

					</div>
			</div>
		
	</div>
</div>
</div>
</body>
</html>

<script type="text/javascript">
 $(document).ready(function(){
      $.fn.dataTableExt.sErrMode = 'throw';
        $('.table').DataTable({
          ordering: true,
          lengthChange: true,
          searching: true
        });
    })
 $("#add_type_leave").click(function(){
 	$.fn.dataTableExt.sErrMode = 'throw';
        $('#ltable').DataTable({
          ordering: true,
          lengthChange: true,
          searching: true
        });
    })
 })
</script>