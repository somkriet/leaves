<script type="text/javascript">
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ตั้งค่าระบบ System setup</h5>
		</div>
	</div>
	<div class="bs-setting">
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
		<?php }?>


		<ul id="myTab" class="nav nav-tabs">
			<!--<li class="dropdown active">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">ผู้ใช้ <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a href="#user" tabindex="-1" data-toggle="tab">ผู้ใช้</a></li>-->
					<li><a href="#user_type" tabindex="-1" data-toggle="tab">ประเภทผู้ใช้ / User type</a></li>
				<!--</ul>
			</li>-->
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
		</ul>



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
												<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/edit_user_type">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แกไข ประเภทผู้ใช้ / Edit type user</h4>
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
								<td><?php if($user_type->user_type_ID!=0 or $user_type->user_type_Name!="Administrator"){?><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_user_type/<?php echo $user_type->user_type_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a>  <?php }?></td>
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
												<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/edit_office">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แกไข สำนักงาน / Edit Office</h4>
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
								<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_office/<?php echo $office->office_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
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
												<form name="department" method="post" action="<?php echo base_url().index_page();?>/setting/edit_department">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไขแผนก / Edit Dept.</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																		<input type="text" class="form-control" name="department" value="<?php echo $department->department_Name;?>" required>
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
								<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_department/<?php echo $department->department_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
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
												<form name="department" method="post" action="<?php echo base_url().index_page();?>/setting/edit_acception">
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
								<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_acception/<?php echo $acc->acceptation_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
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
													<form name="department" method="post" action="<?php echo base_url().index_page();?>/setting/edit_progression">
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
									<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_progression/<?php echo $pro->progression_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
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
												<form name="position" method="post" action="<?php echo base_url().index_page();?>/setting/edit_position">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แกไข ตำแหน่ง / Edit Postion</h4>
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
								<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_position/<?php echo $position->position_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
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
</div>









<!-- ************************************ modal ****************************************-->
<!-- Modal Add user-->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_user" method="post" action="<?php echo base_url().index_page();?>/setting/add_user">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มผู้ใช้ / Add User</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									

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
<!-- Modal Add user -->

<!-- Modal Add user type-->
<div class="modal fade" id="add_user_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/add_user_type">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มประเภทผู้ใช้ / Add Type User</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input name="user_type_Name" type="text" class="form-control" placeholder="ชื่อ ประเภทผู้ใช้ ใหม่" required>

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
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/add_office">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มสำนักงาน / Add Position</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<input name="office" type="text" class="form-control" placeholder="ชื่อ สำนักงาน ใหม่" required>

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
			<form name="department" method="post" action="<?php echo base_url().index_page();?>/setting/add_department">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มแผนก / Add Dept.</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="department" placeholder="ชื่อ แผนก ใหม่" required></td>
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
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/add_acception">
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
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/add_progression">
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
			<form name="office" method="post" action="<?php echo base_url().index_page();?>/setting/add_position">
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