<script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	function check_form(datepicker,checkdetail)
	{
		
		if (datepicker.value=="") {
			alert('กรุณากรอก วันที่ * / Holiday date: ');
			datepicker.focus();
			return false;
		};
		if (checkdetail.value=="") {
			alert('กรุณากรอก วันหยุด * / Holiday name:  ');
			checkdetail.focus();
			return false;
		};
	}
	function check_form_edit(datepicker,checkdetail)
	{
		if (datepicker.value=="") {
			alert('กรุณากรอก วันที่ * / Holiday date: ');
			datepicker.focus();
			return false;
		};
		if (checkdetail.value=="") {
			alert('กรุณากรอก วันหยุด * / Holiday name:  ');
			checkdetail.focus();
			return false;
		};
	}
	function check_form_edit(datepicker,checkdetail)
	{
		if (datepicker.value=="") {
			alert('กรุณากรอก วันที่ * / Holiday date: ');
			datepicker.focus();
			return false;
		};
		if (checkdetail.value=="") {
			alert('กรุณากรอก วันหยุด * / Holiday name:  ');
			checkdetail.focus();
			return false;
		};
	}
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / กำหนดวันหยุด Holiday setup</h5>
		</div>
	</div>
	<div class="bs-non_working_time">
		<div class="row">
			<?php if($status==1){?>
			<div class="alert alert-block alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>ขอแสดงความยินดี</h4>
				<p>คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.</p>
			</div>
			<?php }else if($status==2){?>
			<div class="alert alert-block alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>ขอแสดงความยินดี</h4>
				<p>คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว.</p>
			</div>
			<?php }else if($status==3){?>
			<div class="alert alert-block alert-warning fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>ขอแสดงความยินดี</h4>
				<p>คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว.</p>
			</div>
			<?php }?>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo "ปีนี้ ".date('Y');?><?php echo " / This year ".date('Y');?></h3>
					</div>
					<div class="panel-body">
						<table class="table table-condensed  table-hover table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>วันหยุด<br>Holiday name</th>
									<th>วันที่<br>Date</th>
									<th>แก้ไข<br>Edit</th>
									<th>ลบ<br>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$date_now=date('Y-m-d');
								foreach($get_non_working_time_all as $num=>$rows){
									?>
									<tr class="<?php if($rows->non_working_time < $date_now){echo 'danger';}?>">
										<td><?php echo $num+=1;?></td>
										<td><?php echo $rows->detail;?></td>
										<td><?php echo date('Y-m-d',strtotime($rows->non_working_time));?></td>
										<td>
											<a data-toggle="modal" href="#edit1<?php echo $rows->calendar_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
											<!-- Modal -->
											<div class="modal fade" id="edit1<?php echo $rows->calendar_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">แก้ไขวันหยุด / Edit Holiday</h4>
														</div>
														<div class="modal-body">
															<form name="form1" method="post" onsubmit="JavaScript:return check_form(datepicker<?php echo $rows->calendar_ID;?>,checkdetail<?php echo $num;?>)" action="<?php echo base_url().index_page();?>/calendar/edit_calendar">
																<script type="text/javascript">
																	$(function() {
																		$( "#datepicker<?php echo $rows->calendar_ID;?>" ).datepicker(
																		{
																			dateFormat: 'yy-mm-dd',
																			changeMonth: true,
																			changeYear: true
																		}
																		);
																	});
																</script>
																<div class="row">
																	<div class="col-md-5">
																		<strong>วันที่ * / Holiday date:</strong>
																		<input type="text" class="form-control" name="non_working_time" value="<?php echo $rows->non_working_time;?>" id="datepicker<?php echo $rows->calendar_ID;?>" required>
																		<input type="hidden" name="calendar_ID" value="<?php echo $rows->calendar_ID;?>">
																	</div>
																	<div class="col-md-5">
																		<strong>วันหยุด * / Holiday name:</strong>
																		<input type="text" class="form-control" id="checkdetail<?php echo $num;?>" name="detail" value="<?php echo $rows->detail;?>" required>
																	</div>
																</div>

															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Edit</button>
															</div>
														</form>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
										<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/calendar/del_calendar/<?php echo $rows->calendar_ID;?>')"><i class="glyphicon glyphicon-remove"></i></a></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo "ปีหน้า ".$nex_year=date('Y',strtotime('+1 year'));?><?php echo " / Next year ".$nex_year=date('Y',strtotime('+1 year'));?></h3>
						</div>
						<div class="panel-body">
							<?php if(empty($check_non_working_time_next_year)){?>
							<div class="alert alert-block alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4>ขออภัย!</h4>
								<p>ยังไม่มีข้อมูลวันหยุดในปี <?php echo $nex_year;?>.</p>
								<p>
									<a class="btn btn-danger" href="#">เพิ่มวันหยุดสำหรับปี <?php echo $nex_year;?></a>
								</p>
							</div>
							<?php }else{?>
							<table class="table table-condensed  table-hover table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>วันหยุด<br>Holiday name</th>
										<th>วันที่<br>Date</th>
										<th>แก้ไข<br>Edit</th>
										<th>ลบ<br>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$date_now=date('Y-m-d');
									foreach($check_non_working_time_next_year as $num=>$rows){
										?>
										<tr class="<?php if($rows->non_working_time < $date_now){echo 'danger';}?>">
											<td><?php echo $num+=1;?></td>
											<td><?php echo $rows->detail;?></td>
											<td><?php echo date('Y-m-d',strtotime($rows->non_working_time));?></td>
											<td>
												<a data-toggle="modal" href="#edit1<?php echo $rows->calendar_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
											<!-- Modal -->
											<div class="modal fade" id="edit1<?php echo $rows->calendar_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">แก้ไขวันหยุด / Edit Holiday</h4>
														</div>
														<div class="modal-body">
															<form name="form1" method="post" onsubmit="JavaScript:return check_form_edit(datepicker<?php echo $rows->calendar_ID;?>,checkdetail<?php echo $num;?>)" action="<?php echo base_url().index_page();?>/calendar/edit_calendar">
																<script type="text/javascript">
																	$(function() {
																		$( "#datepicker<?php echo $rows->calendar_ID;?>" ).datepicker(
																		{
																			dateFormat: 'yy-mm-dd',
																			changeMonth: true,
																			changeYear: true
																		}
																		);
																	});
																</script>
																<div class="row">
																	<div class="col-md-5">
																		<strong>วันที่ * / Holiday date *:</strong>
																		<input type="text" class="form-control" name="non_working_time" value="<?php echo $rows->non_working_time;?>" id="datepicker<?php echo $rows->calendar_ID;?>" required>
																		<input type="hidden" name="calendar_ID" value="<?php echo $rows->calendar_ID;?>">
																	</div>
																	<div class="col-md-5">
																		<strong>วันหยุด * / Holiday name *:</strong>
																		<input type="text" id="checkdetail<?php echo $num;?>" class="form-control" name="detail" value="<?php echo $rows->detail;?>" required>
																	</div>
																</div>

															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Edit</button>
															</div>
														</form>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
											</td>
											<td><a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/calendar/del_calendar/<?php echo $rows->calendar_ID;?>')"><i class="glyphicon glyphicon-remove"></i></a></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a data-toggle="modal" href="#add" class="btn btn-success btn-lg btn-block">เพิ่มวันหยุด / Add Holiday </a>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">สร้างวันหยุด / Add Holiday </h4>
					</div>
					<div class="modal-body">
						<form name="form1" method="post"  onsubmit="JavaScript:return check_form_edit(datepicker,detail)"  action="<?php echo base_url().index_page();?>/calendar/add_calendar">
							<div class="row">
								<div class="col-md-5">
									<strong>วันที่ * / Holiday date *:</strong>
									<input type="text" class="form-control" name="non_working_time" placeholder="วันที่" id="datepicker" required>
								</div>
								<div class="col-md-5">
									<strong>วันหยุด * / Holiday name *:</strong>
									<input type="text" class="form-control" name="detail" placeholder="วันหยุด" id="detail" required>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
