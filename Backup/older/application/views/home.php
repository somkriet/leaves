	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<?php 
	$now_date=date('Y-m-d');
	if(($user['user_type_ID']==0 or $user['user_type_ID']==5) and ($now_date >= '2013-12-01') and (empty($check_non_working_time_next_year))){?>
		<script type="text/javascript">
		$(document).ready(function() {
      		alert("เนื่องจากใกล้ถึงปีใหม่แล้ว และตอนนี้ทางระบบยังไม่มีการบันทึกวันหยุดของปีถัดไป ดังนั้นท่านควรทำการบันทึกข้อมูลวันลาโดยเร็วที่สุด.");
      		window.location.assign("<?php echo base_url().index_page();?>/calendar/calendar_next_year")
		});
	</script>
	<?php }?>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<h5>หน้าแรก / home</h5>
			</div>

		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="bs-right">
					<div class="row">
						<div class="span12">
							<h4><i class="glyphicon glyphicon-bullhorn"></i> สิทธิ์การลาประจำปี <?php echo $user['this_year'];?> / Leaves information for <?php echo $user['this_year'];?></h4>
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
									<td>
										<?php
										$year_now =date('Y'); 
										$q1=$this->db->query("
											SELECT annual_have
											FROM leave_annual 
											WHERE user_ID='".$user['user_ID']."' 
											AND year_ID like '".$year_now."%'  
											 
											");
										$result1=$q1->result();
										echo $result1[0]->annual_have;
										?>
									</td>
									<td>
										<?php
										$year_now =date('Y'); 
										$q2=$this->db->query("
											SELECT annual_old as annual
											FROM leave_annual 
											WHERE user_ID='".$user['user_ID']."' 
											AND year_ID like '".$year_now."%'  
											 
											");
										$result2=$q2->result();
										echo $result2[0]->annual;
										?>
									</td>
									<td>
										<?php
										$year_now =date('Y'); 
										$q3=$this->db->query("
											SELECT annual_old_use as annual
											FROM leave_annual 
											WHERE user_ID='".$user['user_ID']."' 
											AND year_ID like '".$year_now."%'  
											 
											");
										$result3=$q3->result();
										echo $result3[0]->annual;
										?>
									</td>
									<td>
										<?php
										$year_now =date('Y'); 
										$q4=$this->db->query("
											SELECT annual_new_use as annual
											FROM leave_annual 
											WHERE user_ID='".$user['user_ID']."' 
											AND year_ID like '".$year_now."%'  
											 
											");
										$result4=$q4->result();
										echo $result4[0]->annual;
										?>
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
											WHERE user_leave='".$user['user_ID']."' 
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
											WHERE user_leave='".$user['user_ID']."' 
											AND start_date like '".$year_now."%' 
											AND leaves.leave_type_ID=5
											AND (leaves.acceptation_ID =1 or leaves.acceptation_ID =2)");
										$result6=$q6->result();
										echo $result6[0]->annual;
										?> วัน / Day</td>
									</tr>
								</tbody>
							</table>
							<div class="space-top"></div>
							<div class="alert alert-block alert-warning fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4>หมายเหตุ!</h4>
								<p>ถ้าใน 1 ปี มีจำนวนวันลาพักร้อนเหลือ จะยกยอดวันที่เหลือไปในปีถัดไป แต่จำนวนวันที่เหลือนั้น จะใช้ได้ถึง 31 มีนาคมของปีถัดไป ถ้าไม่ใช้จะตัดสิทธิ์</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bs-non_working_time">
					<h4><i class="glyphicon glyphicon-calendar"></i> ปฏิทินวันหยุดประจำปี <?php echo $user['this_year'];?><br>Holiday Calendar for <?php echo $user['this_year'];?></h4>
					<table class="table table-condensed  table-hover table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>วันหยุด</th>
								<th>วันที่</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$now_date=date('Y-m-d');
							foreach($non_working_time as $num=>$non_work){?>
							<tr <?php if($non_work->non_working_time > $non_work){echo "class='danger'";}?>>
								<td><?php echo $num+=1;?></td>
								<td><?php echo $non_work->detail;?></td>
								<td><?php echo date('Y-m-d',strtotime($non_work->non_working_time));?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<p class="text-right"><a href="<?php echo base_url().index_page();?>/calendar/index" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-calendar"></i> วันหยุดทั้งหมด</a></p>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="bs-statistics_leave">
					<h4><i class="glyphicon glyphicon-list-alt"></i> ประวัติการลา ประจำปี <?php echo $user['this_year'];?></h4>
					<?php if(empty($statistics_thie_years)){?>
					<div class="alert alert-block alert-success fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>ขอแสดงความยินดี</h4>
						<p>ในปี <?php echo $user['this_year'];?> นี้คุณยังไม่ได้ทำการลา หรือเดินทางตามคำสั่งเลย แม้แต่ครั้งเดียว.</p>

					</div>
					<?php }?>
					<p class="text-right"><a href="<?php echo base_url().index_page();?>/leave/leave_all" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-list-alt"></i> ประวัติการลาทั้งหมด</a></p>
				</div>
			</div>
		</div> -->
	</div>
