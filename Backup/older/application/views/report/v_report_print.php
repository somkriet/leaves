<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="bootstrap-style" href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript">
	function CloseWindowsInTime(t){ 
		t = t*100; 
		window.print();
		setTimeout("window.close()",t); 
	} 
	CloseWindowsInTime(1); 
</script>
<style type="text/css">
	* {
		font: 10pt "Tahoma";
		box-sizing: border-box;
		-moz-box-sizing: border-box;

	}
	.page {
		padding-top: 80px;
		padding-left: 10px;
		border: 1px #D3D3D3 solid;
		border-radius: 1px;
		background: white;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}
	.text_center{
		text-align: center;
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

<div class="book">
	<div class="page">
			<div class="text_center" >
				<h3>ใบลาหยุดงาน</h3>
				<h5>ประจำปี <?php echo date('Y'); ?></h5>
			</div>
			<div class="text_lift" >
				<div class="form-group">	
				รหัส <?php echo $user['user_ID']; ?> 
				ชื่อ-นามสกุล <?php echo $user['name_th']; ?>-<?php echo $user['surname_th']; ?>
				ว/ด/ป ที่เริ่มงาน  <?php echo $user['start_date_work']; ?>
				ตำแหน่ง <?php echo $user['position_Name']; ?>
				แผนก <?php echo $user['department_Name']; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">	
					<div id="myTabContent" class="tab-content">
						<table class="table table-condensed table-bordered table-hover ">
							<thead>
								<tr>
									<th width="10"><div class="text_middle">ลำดับ</div></th>
									<th width="69"><div class="text_middle">ว/ด/ป ที่เขียน</div></th>
									<th width="80"><div class="text_middle">ว/ด/ป ที่เริ่มหยุด</div></th>
									<th width="73"><div class="text_middle">ว/ด/ป ที่สิ้นสุด</div></th>
									<th><center><div  class="text_middle">รหัสการลา</div></th>
									<th width="100"><div  class="text_middle">ประเภท</div></th>
									<th><center>รวมทั้งสิ้น(วัน)</center></th>
									<th><div  class="text_middle">เหตุผล</div></th>
									<th width="90"><div class="text_middle">อนุมัติจ่าย</div></th>
									<th><center>ลงชื่อผู้จัดการแผนก</center></th>
									<th><center>จนท.บุคล HR</center></th>
									
								</tr>
							</thead>
							<tbody>
								<?php foreach($report_user_print as $num=>$result){?>
								<tr>
									<td align="center"><?php echo $num+=1;?></td>
									<td><?php echo date("Y-m-d",strtotime($result->active_date));?></td>
									<td><?php echo date("Y-m-d",strtotime($result->start_date));?></td>
									<td><?php echo date("Y-m-d",strtotime($result->end_date));?></td>
									<td><?php echo $result->leave_ID;?></td>
									<td><?php echo $result->leave_type_Name;?></td>
									<td><div class="text_center"><?php echo $result->total_date;?></div></td>
									<td><?php echo $result->subject;?></td>
									<td><div class="text_center"><?php echo $result->acceptation_Name;?></div></td>
									<td><div class="text_center"><?php echo $result->manager_name;?></div></td>
									<td><div class="text_center"><?php echo $result->hr_name;?></div></td>
								</tr>
								<?php } ?>
								<td>TOTAL</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tbody>
						</table>
						<table width='100%'>
							<thead>
								<tr>
									<th><div class="text_left">ลงชื้อผู้ลา..........................<br>
											( <?php echo $user['name_th']; ?>)<br>
											ตำแหน่ง <?php echo $user['position_Name']; ?><div></th>
									
									<th><div class="text_right">ลงชื่อหัวหน้าแผนก......................<br>
											(.....................................)<br>
											ตำแหน่ง.................................	<div></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>	
			</div> 
	</div>
</div>