	<style type="text/css">
	textarea { /*resize: vertical;*/ resize: none; }
	</style>
	<div class="row"></br></div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading "> <label class="glyphicon glyphicon-search"> ยืนยันการลา / Leave Approve </label></div>
			<div class="panel-body">
				<div class="com-md-12 col-xs-12">
				 <?php echo form_open_multipart("",array('id'=>'form_leave_detail_hr'));?> 
					
				</div>
				<div class="row"></div>
				</br>
						<div class=".col-xs-6 .col-md-4" >
							<table class="table table-condensed table-hover table-bordered .col-xs-6 .col-md-4">
 								<thead>
									<tr class="info">
										<th><center>รหัสการลา<BR>Leave Id</center></th>
										<th><center>รหัสพนักงาน<BR>Request Type</center></th>
										<th><center>ชื่อ-นามสกุล<BR>Name-Surname</center></th>
										<th><center>รายการ<BR>Request Type</center></th>
										<th><center>ประเภทการลา<BR>Leave Type</center></th>
										<th><center>วันที่ลา<BR>Leave Date</center></th>
										<th><center>ทำรายการโดย<BR>Transaction By</center></th>
										<th><center>เมื่อวันที่<BR>ransaction Date</center></th>
										<th><center>สถานะ<BR>Status</center></th>
									</tr>
								</thead>
				<tbody>

					 <?php if(empty($data_leave_approve) OR isset($data_leave_approve[0]->ERROR)){?>
                            			<?php }else{?>
										<?php foreach($data_leave_approve as $num=>$leave_approve):?>
										<tr class="active">
											<td><a href="<?php echo base_url().index_page();?>/leave_approve_mj/leave_approve_result/#<?php echo $leave_approve->leave_ID;?>" data-toggle="modal" data-target="#myModal<?php echo $leave_approve->leave_ID?>"><?php echo $leave_approve->leave_ID?></a></td>
											<td><?php echo $leave_approve->user_ID ?></td>
											<td><?php echo $leave_approve->name_th ." ".$leave_approve->surname_th?><br>
												<?php echo $leave_approve->name_en ." ". $leave_approve->surname_en?>
											</td>
											<td><?php echo $leave_approve->leave_group_Name?></td>
											<td><?php echo $leave_approve->leave_type_Name ?></td>
											<td><?   if(($leave_approve->start_date)==($leave_approve->end_date)){
														echo date("d/m/Y", strtotime($leave_approve->start_date));
													}else{
														echo date("d/m/Y", strtotime($leave_approve->start_date));?><br>
													<center><?php echo"ถึงวันที่"?></center>
														<?php echo date("d/m/Y", strtotime($leave_approve->end_date));
													}?></a>
											</td>
											<td><?php echo $leave_approve->active_name_th ." ". $leave_approve->active_surname_th?><br>
												<?php echo $leave_approve->active_name_en ." ". $leave_approve->active_surname_en?></td>
											<td><?php echo $leave_approve->active_date ?></td>
											<td>
												<div class="row">
													<div class="col-md-12">
														<p>
															<a href="javascript:confirmLeaveSuccess('<?php echo base_url().index_page();?>/leave_approve_mj/leave_approve_result/<?php echo $leave_approve->leave_ID;?>/1/<?php echo $leave_approve->user_ID;?>/<?php echo $leave_approve->leave_type_ID;?>')" class="btn btn-success btn-xs">Approve with PAY</a>
														</p>
														<p>
															<a href="javascript:confirmLeaveWarning('<?php echo base_url().index_page();?>/leave_approve_mj/leave_approve_result/<?php echo $leave_approve->leave_ID;?>/2')" class="btn btn-warning btn-xs">Approve with un PAY</a>
														</p>
														<p>
															<a href="javascript:confirmLeaveCancle('<?php echo base_url().index_page();?>/leave_approve_mj/leave_approve_result/<?php echo $leave_approve->leave_ID;?>/3')" class="btn btn-danger btn-xs">No Approve for leave</a>
														</p>
													</div>
												</div>
											</td>
										</tr>
					
					<?php endforeach; }?>
					 <!--    </div>
					  </div>
					</div> -->
					<!--<?php// }?>-->
							</tbody>
					</table>
				</div>

				<!-- Modal -->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $leave_approve->leave_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title glyphicon glyphicon-user" id="myModalLabel"> รายละเอียดวันที่ลา/Leave Detail</h4>
							</div>
								<div class="modal-body">									
									<div class="modal-body">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>วันที่ลา/Date</td>
													<td>วันที่เริ่มลา/Start Date</td>
													<td>วันสิ้นสุดการลา/End Date</td>	
													</tr>
												<?php if(empty($data_leave_approve) OR isset($data_leave_approve[0]->ERROR)){?>
                            					<?php }else{?>
												<?php foreach($data_leave_approve as $num=>$leave_approve):?>
													<tr>
															<td><?php echo $leave_approve->active_date?></td>
															<td><?php echo $leave_approve->start_date ?></td>
															<td><?php echo $leave_approve->end_date ?></td>
													</tr>
												<?php endforeach; }?>	
											</tbody>
										</table>
									</div>
					
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save</button>
								</div>
						</div>
					</div>
				</div>

			</div>
				<?php echo form_close();?> 
				<div class="panel-footer"></div>
				</div>
			</div>
			
		</div>
	</div>
	<script type="text/javascript">

	 </script>