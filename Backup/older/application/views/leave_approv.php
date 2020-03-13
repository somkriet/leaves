<style type="text/css">
.modal-lg {
     width: 60%;
    }
</style>
<div class="container">
	<?php function checkarray($data)
		{
		$sizedata=0;	
			for ($i=0; $i < sizeof($data); $i++) { 
				if(sizeof($data[$i])!=0)
				{
					$sizedata=1;
				}
			}
			return $sizedata;
		}
		?>
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ข้อมูลการลาของพนักงาน Empleyee Leave detail</h5>
		</div>
	</div>
	<div class="row">
		<div class="bs-leave-detail">
			<div class="col-md-12">
				<?php
				if($leave_user_for_approv==0)
				{?>
				<div class="alert alert-block alert-success fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>ขอแสดงความยินดี</h4>
						<p>ไม่มีข้อมูลการของลาของพนักงาน.</p>
				</div>
				<?php 
				}else{
					if($status==1){?>
					<div class="alert alert-success fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>ทำรายการสำเร็จ</strong> คุณได้ทำการอนุมัติรายการดังกล่าวแบบจ่ายเงิน เรียบร้อยแล้ว.
					</div>
					<?php }else if($status==2){?>
					<div class="alert alert-success fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>ทำรายการสำเร็จ</strong> คุณได้ทำการอนุมัติรายการดังกล่าวแบบไม่จ่ายเงิน เรียบร้อยแล้ว.
					</div>
					<?php }else if($status==3){?>
					<div class="alert alert-danger fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>ทำรายการสำเร็จ</strong> คุณได้ทำการไม่อนุมัติรายการดังกล่าวเรียบร้อยแล้ว.
					</div>
					<?php }?>
				<table class="table table-hover table-bordered table-condense">
					<thead>
						<tr>
							<th>#</th>
							<th>รหัสพนักงาน<br>User ID</th>
							<th>ชื่อ<br>Name</th>
							<th>รายการ<br>Request type</th>
							<th>ประเภท<br>leave Type</th>
							<th>วันที่ลา<br>Leave Date</th>
							<th>ทำรายงานโดย<br>Transection by</th>
							<th>เมื่อ<br>Transection date</th>
							<th>สถานะ<br>Status</th>
							<th>ค้นหา<br>Search</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($leave_user_for_approv as $rows){;?>

						<tr>
							<td>
								<a data-toggle="modal" href="#detail<?php echo $rows->leave_ID;?>"><?php echo $rows->leave_ID;?></a>
								<!-- leave detail -->
								<div class="modal fade" id="detail<?php echo $rows->leave_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">รายละเอียดการลา</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<h4>ข้อมูลการการลาของ <?php echo $rows->user_leave;?></h4>
														<table class="table table-condense">
															<tbody>
																<tr>
																	<td>หมายเลขการลา</td>
																	<td><?php echo $rows->leave_ID;?></td>
																</tr>
																<tr>
																	<td>เรื่อง</td>
																	<td><?php echo $rows->subject;?></td>
																</tr>
																<tr>
																	<td>รายละเอียด</td>
																	<td><?php echo $rows->detail;?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="row">
													<h4>สิทธิ์การลาประจำปี <?php echo $user['this_year'];?> / Leaves information for <?php echo $user['this_year'];?></h4>
															<table class="table table-condensed  table-hover table-bordered">
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
																			WHERE user_ID='".$rows->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result1=$q1->result();
																		//echo $result1[0]->annual_have;
																									
																		?>

																		<?php echo @$result1[0]->annual_have; ?>
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q2=$this->db->query("
																			SELECT annual_old as annual
																			FROM leave_annual 
																			WHERE user_ID='".$rows->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result2=$q2->result();
																		//echo $result2[0]->annual;
																		?>
																		<?php echo @$result2[0]->annual; ?>
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q3=$this->db->query("
																			SELECT annual_old_use as annual
																			FROM leave_annual 
																			WHERE user_ID='".$rows->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result3=$q3->result();
																		//echo $result3[0]->annual;
																		?>
																		<?php echo @$result3[0]->annual; ?>
																	</td>
																	<td class="new-table-center">
																		<?php
																		$year_now =date('Y'); 
																		$q4=$this->db->query("
																			SELECT annual_new_use as annual
																			FROM leave_annual 
																			WHERE user_ID='".$rows->user_ID."' 
																			AND year_ID like '".$year_now."%'  
																			 
																			");
																		$result4=$q4->result();
																		//echo $result4[0]->annual;
																		?>
																		<?php echo @$result4[0]->annual; ?>
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
																			WHERE user_leave='".$rows->user_ID."' 
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
																			WHERE user_leave='".$rows->user_ID."' 
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
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</td>
							<td><?php echo $rows->user_ID;?></td>
							<td><?php echo $rows->user_leave;?> <?php echo $rows->user_leave_surname;?> / <?php echo $rows->user_leave_en;?> <?php echo $rows->user_leave_surname_en;?></td>
							<td><?php echo $rows->leave_group_Name;?></td>
							<td><?php echo $rows->leave_type_Name;?>
								<?php if ($rows->leave_type_ID==5) {
									if ($rows->leave_attached==0) { ?>
							      		<?php echo '<br><font color="red">ไม่มีใบรับรองแพทย์</font>';
							      	}else{							      		
							      		?>							     
							      		<a href='<?php echo base_url();?>uploads/<?php echo $rows->leave_attached;?>' target="_blank"><font color="green"><br>มีใบรับรองแพทย์</font></a>
							      	<?php }
								}?>
							</td>
							<td>
								<?php
								$query=$this->db->query("SELECT * FROM leave_detail
										where leave_detail.leave_ID='".$rows->leave_ID."'
										" );
								$result=$query->result(); 
								foreach ($result as $key => $detail) {							
									echo date('Y-m-d',strtotime($detail->leave_date));
									echo " เวลา ";
									echo $detail->start_time."-".$detail->end_time;
									echo "<br>";
								}
								?>
						    </td>
							<td><?php echo $rows->active_leave;?> <?php echo $rows->active_leave_surname;?> / <?php echo $rows->active_leave_en;?> <?php echo $rows->active_leave_surname_en;?></td>
							<td><?php echo date('Y-m-d',strtotime($rows->active_date));?></td>
							<td>

								<div class="row">
									<div class="col-md-12">
										<p>
											<a href="javascript:confirmLeaveSuccess('<?php echo base_url().index_page();?>/leave/leave_approv_result/<?php echo $rows->leave_ID;?>/1/<?php echo $rows->user_ID;?>/<?php echo $rows->leave_type_ID;?>')" class="btn btn-success btn-xs">Approve with PAY</a>
										</p>
										<p>
											<a href="javascript:confirmLeaveWarning('<?php echo base_url().index_page();?>/leave/leave_approv_result/<?php echo $rows->leave_ID;?>/2')" class="btn btn-warning btn-xs">Approve with un PAY</a>
										</p>
										<p>
											<a href="javascript:confirmLeaveCancle('<?php echo base_url().index_page();?>/leave/leave_approv_result/<?php echo $rows->leave_ID;?>/3')" class="btn btn-danger btn-xs">No Approve for leave</a>
										</p>
									</div>
								</div>
							</td>

							<td><?php 
								$query_result="";
								$query_leave_date=$this->db->query("SELECT leave_date  FROM leave_detail
										where leave_detail.leave_ID='".$rows->leave_ID."'
										" );
								$result_leave_date=$query_leave_date->result(); 

								//print_r($result_leave_date);

								foreach ($result_leave_date as $key => $value) {
									$query=$this->db->query("SELECT * FROM leaves l
									join leave_type lt on l.leave_type_ID=lt.leave_type_ID
									join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
									join user u on l.user_leave=u.user_ID
									join user u2 on l.active_by=u2.user_ID
									join leave_detail ld on ld.leave_ID=l.leave_ID
									WHERE ld.leave_date ='".date('Y-m-d',strtotime($value->leave_date))."'
									AND (l.acceptation_ID =1 or l.acceptation_ID=2)
									AND u.department_ID='".$rows->department_ID."'
									" );
									$result=$query->result(); 
									//echo date('Y-m-d',strtotime($value->leave_date));
								@$query_result[]=$result;	
								}

								
						
								$sizedata=checkarray($query_result);


								// $query=$this->db->query("SELECT * FROM leaves l
								// 	join leave_type lt on l.leave_type_ID=lt.leave_type_ID
								// 	join leave_group lg on lt.leave_group_ID=lg.leave_group_ID
								// 	join user u on l.user_leave=u.user_ID
								// 	join user u2 on l.active_by=u2.user_ID
								// 	join leave_detail ld on ld.leave_ID=l.leave_ID
								// 	WHERE l.start_date >='".date('Y-m-d',strtotime($rows->start_date))."' and l.end_date <='".date('Y-m-d',strtotime($rows->end_date))."'
								// 	AND (l.acceptation_ID =1 or l.acceptation_ID=2)
								// 	AND u.department_ID='".$rows->department_ID."'
								// 	" );
								// $result=$query->result(); 
								//print_r($result);
								//echo date('Y-m-d',strtotime($rows->end_date));
								?>


								<div class="col-md-12">
						<?php if($sizedata!=0){ ?>
						<p class="text-right"><a data-toggle="modal" href="#myModal<?php echo $rows->leave_ID;?>" class="btn btn-info">รายชื่อพนักงานที่ลาช่วงเดียวกัน</a></p>
						<?php } ?>
						<div class="modal fade" id="myModal<?php echo $rows->leave_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">รายชื่อพนักงานที่ลาช่วงเดียวกัน</h4>

			</div>
			<div class="modal-body">
				<table class="table table-hover table-bordered table-condense">
					<thead>
						<tr>
							<th>#</th>
							<th>รหัสพนักงาน</th>
							<th>ชื่อ</th>
							<th>รายการ</th>
							<th  width='20%'>ประเภท</th>
							<th  width='20%'>วันที่ลา</th>
							
							<th>เมื่อ</th>
							
						</tr>
					</thead>
						<tbody>
						<?php
						//echo sizeof($query_result);
						
						for ($i=0; $i < sizeof($query_result); $i++) { 
										//print_r($query_result[$i]);					
							foreach($query_result[$i] as $result_leave)
							{ ?>

							 <tr>
								<td>
								<?php echo $result_leave->leave_ID;?>
								<!-- leave detail -->
								<div class="modal fade" id="detail<?php echo $result_leave->leave_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">รายละเอียดการลา</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<h4>ข้อมูลการการลาของ <?php echo $result_leave->name_th;?>-<?php echo $result_leave->surname_th;?></h4>
														<table class="table table-condense">
															<tbody>
																<tr>
																	<td>หมายเลขการลา/Leave ID</td>
																	<td><?php echo $result_leave->leave_ID;?></td>
																</tr>
																<tr>
																	<td>เรื่อง/Subject</td>
																	<td><?php echo $result_leave->subject;?></td>
																</tr>
																<tr>
																	<td>รายละเอียด/Detail</td>
																	<td><?php echo $result_leave->detail;?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
								</td>
								<td><?php echo $result_leave->user_ID;?></td>
								<td><?php echo $result_leave->name_th;?>-<?php echo $result_leave->surname_th;?></td>
								<td><?php echo $result_leave->leave_group_Name;?></td>
								<td><?php echo $result_leave->leave_type_Name;?></td>
								<td><?php
									$query=$this->db->query("SELECT * FROM leave_detail
											where leave_detail.leave_detail_ID='".$result_leave->leave_detail_ID."'
											" );
									$result=$query->result(); 
									foreach ($result as $key => $detail) {							
										echo date('Y-m-d',strtotime($detail->leave_date));
										echo " เวลา ";
										echo $detail->start_time."-".$detail->end_time;
										echo "<br>";
									}
									?>
								</td>
								<td><?php echo date('Y-m-d',strtotime($rows->active_date));?></td>
								
							</tr>

							<?php } }
						?>
						<tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
					</div>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
				<?php }?>
				<div class="row">
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
