<script type="text/javascript">
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">

		</div>
	</div>
	<div class="bs-setting-user">
		<div class="row" style="padding-bottom: 20px;">			
			<div class="col-md-2 col-md-offset-10">
				<div class="form-group">
				<?php if ($status==1) { ?>
				<form name="form2" method="post" action="<?php echo base_url().index_page();?>/export/report_alluser_excel">
				<div class="col-md-3">
					<input type="submit" class="btn btn-info" value="Excel">
					<input type="hidden" name="search_start_date2" value="<?php echo $search_start_date2;?>">
					<input type="hidden" name="search_end_date2" value="<?php echo $search_end_date2;?>">
				</div>
				</form>>
				<?php }?>
				</div>
			</div>
		</div>
		<div id="myTabContent" class="tab-content">
			<table class="table table-condensed table-bordered table-hover">
				<thead>
					<tr>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">รหัส<br>User Id</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">แผนก<br>Dept.</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">ชื่อ<br>Name</div></th>
   						<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">นามสกุล<br>Surname</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">วันทำงาน<br>Total day</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">วันที่มาทำงาน<br>Work day</div></th>
    					<th colspan="5" align="center" valign="middle"><div class="text-center">การลา<br>Leave type</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">เดินทาง<br>On <br>the job <br>leave</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">รวมวันลา<br>Total leave day</div></th>
  					</tr>
  					<tr>
    					<th rowspan="2" align="center" valign="middle"><div class="text-center" style="padding-bottom: 15px;">ลาพักร้อน<br>Annual day</div></th> 
    					<th colspan="2" align="center" valign="middle"><div class="text-center">ลากิจ<br>Casual day/div></th>
    					<th colspan="2" align="center" valign="middle"><div class="text-center">ลาป่วย<br>Sick day</div></th>
   					</tr>
  					<tr>
  					  <th align="center" valign="middle"><div class="text-center">จ่าย<br>Pay</div></th>
   					  <th align="center" valign="middle"><div class="text-center">ไม่จ่าย<br>Not Pay</div></th>
  					  <th align="center" valign="middle"><div class="text-center">จ่าย<br>Pay</div></th>
  					  <th align="center" valign="middle"><div class="text-center">ไม่จ่าย<br>Not Pay</div></th>
				    </tr>
				</thead>
				<tbody>
					<?php foreach($report_user as $num=>$result){?>
					<tr>
						<td align="center"><?php echo $result->ID;?></td>
						<td align="center"><?php echo $result->Dep;?></td>
						<td><?php echo $result->Nname;?></td>
						<td><?php echo $result->Lname;?></td>
						<td align="right"><?php echo $result->daywork;?></td>
						<td align="right"><?php echo $result->sumdaywork;?></td>
						<td align="right"><?php echo $result->leavesummer;?></td>
						<td align="right"><?php echo $result->leave1;?></td>
						<td align="right"><?php echo $result->leave2;?></td>
						<td align="right"><?php echo $result->leave3;?></td>
						<td align="right"><?php echo $result->leave4;?></td>
						<td align="right"><?php echo $result->leave5?></td>
						<td align="right"><?php echo $result->lostdaywork?></td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
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
					<h4 class="modal-title">เพิ่มผู้ใช้</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<div class="form-group">
									รหัสผู้ใช้ <input type="text" name="user_ID" value="" required>
									</div>
									<div class="form-group">
									ชื้อผู้ใช้(ภาษาอังกฤษ) <input type="text" name="name_en" value="" required>
									นามสกุล(ภาษาอังกฤษ) <input type="text" name="surname_en" value="" required>
									</div>
									<div class="form-group">
									ชื้อผู้ใช้(ภาษาไทย) <input type="text" name="name_th" value="">
									นามสกุล(ภาษาไทย) <input type="text" name="surname_th" value="">
									</div>
									<div class="form-group">
									อีเมล์ <input type="text" name="email" value="">
									เบอร์โทร <input type="text" name="phone" value="">
									</div>

										<div class="col-md-4">
										แผนก
										<select class="form-control" name="department_ID" required>
											<?php foreach($department_all as $row){?>
											<option value="<?php echo $row->department_ID;?>"><?php echo $row->department_Name;?></option>
											<?php }?>
										</select>
										</div>

										<!-- <div class="col-md-4">
										ออฟฟิศ
										<select class="form-control" name="department_ID" required>
											<?php foreach($office_all as $row){?>
											<option value="<?php echo $row->office_ID;?>"><?php echo $row->office_Name;?></option>
											<?php }?>
										</select>
										</div> -->

										<div class="col-md-4">
										ประเภทผู้ใช้
										<select class="form-control" name="user_type_ID" required>
										
											<?php foreach($get_user_type_all as $row){?>
											<option value="<?php echo $row->user_type_ID;?>"><?php echo $row->user_type_Name;?></option>
											<?php }?>
										</select>
										</div>

								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>






