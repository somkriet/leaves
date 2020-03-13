<script type="text/javascript">
	$('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>
</script>
<style type="text/css">
	* {
		font: 15pt;
		box-sizing: border-box;
		-moz-box-sizing: border-box;

	}
	.page {
		padding-top: 80px;
		padding-left: 10px;
		padding-right: 10px;
		border: 1px #D3D3D3 solid;
		border-radius: 1px;
		background: white;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}
	.text_center{
		text-align: center;
	}
	.text_middle{
		text-align:center;
   		vertical-align:middle;
   		padding-bottom: 5px;
	}

	.text_left{
		text-align: left;
	}
	.text_right{
		text-align: right;
	}
	.space_top{
		padding-top: 20px;
	}
	.space_left{
		padding-left: 60px;
	}
	@page {
		size: A4;
		margin: 0;
		size: landscape;
	}
	.bordered{
		border: thin inset #333;
		width: 100%;
	}
	.bordered th{
		border: thin inset #333;
		padding-top: 2px;
		padding-left: 2px;
		padding-right: 2px;
		padding-bottom: 2px;
	}
	.bordered td{
		border: thin inset #333;
		padding-top: 2px;
		padding-left: 2px;
		padding-right: 2px;
		padding-bottom: 2px;
	}
	@media print {
		.page {
			margin: 0;
			border: initial;
			border-radius: initial;
			width: initial;
			min-height: initial;
			box-shadow: initial;
			background: initial;
			page-break-after: always;

		}
	}
</style>

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
					<input type="hidden" name="search_start_date2" value="<?php echo $search_start_date2;?>">
					<input type="hidden" name="search_end_date2" value="<?php echo $search_end_date2;?>">
					<input type="submit" class="btn btn-info" value="Excel">
				</div>
				</form>
				<?php }?>
				</div>
			</div>
		</div>
		

		<div id="myTabContent" class="tab-content">
			<table class="table table-condensed table-bordered table-hover">
				<thead>
					<tr>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">รหัส<br>User ID</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">แผนก<br>Dept.</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">ชื่อ<br>Name</div></th>
   						<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">นามสกุล<br>Surname</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">วันทำงาน<br>Total day</div></th>
    					<th rowspan="3" align="center" valign="middle"><div class="tablemiddle">วันที่มาทำงาน<br>Work day</div></th>
  					</tr>

				</thead>
				<tbody>
					<?php foreach($report_user as $num=>$result){?>
					<tr>
						<td align="center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $num+1;?>"><?php echo $result->ID;?></a></td>
						<td align="center"><?php echo $result->Dep;?></td>
						<td><?php echo $result->Nname;?></td>
						<td><?php echo $result->Lname;?></td>
						<td align="right"><?php echo $result->daywork;?></td>
						<td align="right"><?php echo $result->sumdaywork;?></td>


					</tr>
					<div class="modal fade" id="myModal<?php echo $num+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Leave Detail : <?php echo $report_detail[$num][0]->user_leave;?></h4>
					      </div>
					      <div class="modal-body">
					         <?php 
					         	foreach ($report_detail[$num] as $key => $value) {
					         			echo "<b>Subject </b>: ";
						         		echo @$value->subject;
						         		echo " / <b>Detail</b> : ";
						         		echo @$value->detail;
						         		echo "<br><b>วันที่</b> : ";
						         		echo substr(@$value->leave_date, 0, -9);
						         		echo " <b>เริ่ม</b> ";
						         		echo @$value->start_time;
						         		echo " - <b>ถึง</b> ";
						         		echo @$value->end_time;
						         		echo "<br><br>";
					         } ?>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
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
					<h4 class="modal-title">เพิ่มผู้ใช้ / Add user</h4>
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
										แผนก / Dept.
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
										ประเภทผู้ใช้ / Type user
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
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>






