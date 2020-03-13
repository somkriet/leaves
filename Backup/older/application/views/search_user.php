<style type="text/css">
.modal-lg {
     width: 60%;
     height: 100%;
    }
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก</a> / ข้อมูลการลา</h5>
		</div>
	</div>

	<div class="row">
		<div class="bs-leave-detail">
			<div class="row">
			<div class="col-md-12">
				<h3>ข้อมูลผู้ใช้ : </h3>
				
					<form name="form1" method="post" action="<?php echo base_url().index_page();?>/user/search_user">
					<p class="text-right">
					<div class="col-md-6">
					</div>
					<div class="col-md-3">
						<input type="text" name="search_user" class="form-control" id="search_user" placeholder="กรุณากรอกชื่อที่ต้องการค้นหา" required>
					</div>
					<div class="col-md-3">
						<input type="submit" class="form-control btn btn-info" value="ค้นหา">
					</div>
					</p>
					</form>
			</div>
		</div>
			<div class="space-top"></div>
		<div class="row">
			<div class="col-md-12">
			<table class="table table-condensed table-hover table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>รหัส</th>
						<th>ชื่อ - สกุล</th>
						<th>แผนก</th>
						<th>ออฟฟิศ</th>
						<th>อีเมล์</th>
						<th>เบอร์โทร</th>
						<th>ประเภทผู้ใช้</th>
						<th>แก้ไข</th>
						<th>ลบ</th>
					</tr>
				</thead>
				<tbody>
							
							<?php foreach($result as $num=>$result){?>
							<tr>
								<td><?php echo $num+=1;?></td>
								<td><?php echo $result->user_ID;?></td>
								<td><?php echo $result->name_th;?>-<?php echo $result->surname_th;?></td>
								<td><?php echo $result->department_Name;?></td>
								<td><?php echo $result->office_Name;?></td>
								<td><?php if($result->email!="0"){echo $result->email;}else{echo "-";}?></td>
								<td><?php if($result->phone!="0"){echo $result->phone;}else{echo "-";}?></td>
								<td><?php echo $result->user_type_Name;?></td>

								<td>
									<a data-toggle="modal" href="#edit_user<?php echo $result->user_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
									<!-- Modal edit Department-->
									<div class="modal fade" id="edit_user<?php echo $result->user_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<form name="edit_user" method="post" action="<?php echo base_url().index_page();?>/setting/edit_user/2">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">แก้ไข ข้อมูล</h4>
													</div>
													<div class="modal-body">
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td>
																	<!--<input type="hidden" name="user_ID" value="<?php echo $result->user_ID;?>">
																		<input type="text" class="form-control" name="name_en" value="<?php echo $result->name_en;?>" required>-->

																		
																		<input type="hidden" name="user_ID" value="<?php echo $result->user_ID;?>" required>
																		
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" name="name_en" value="<?php echo $result->name_en;?>" required>
																		นามสกุล(ภาษาอังกฤษ) <input type="text" name="surname_en" value="<?php echo $result->surname_en;?>" required>
																		</div>
																		<div class="form-group">
																		ชื้อผู้ใช้(ภาษาไทย) <input type="text" name="name_th" value="<?php echo $result->name_th;?>">
																		นามสกุล(ภาษาไทย) <input type="text" name="surname_th" value="<?php echo $result->surname_th;?>">
																		</div>
																		<div class="form-group">
																		อีเมล์ <input type="text" name="email" value="<?php echo $result->email;?>">
																		เบอร์โทร <input type="text" name="phone" value="<?php echo $result->phone;?>">
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
																			<select class="form-control" name="office_ID" required>
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
														<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
														<button type="submit" class="btn btn-primary">แก้ไข</button>
													</div>
												</form>
											</div>
										</div>
									</div><!-- /.modal -->
								</td>
								<td>
									<a class="btn btn-danger" href="javascript:confirmDelete('<?php echo base_url().index_page();?>/setting/del_user/<?php echo $result->user_ID;?>')"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>