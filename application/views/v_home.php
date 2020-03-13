<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
<div class="row"><br></br></div>
<div class="container" style="margin-top:18px;">
<div class="row">
  <div class="col-md-7">
  		<div class="panel panel-default">
			<div class="panel-heading "><label class="glyphicon glyphicon-calendar"> สิทธิการลา/Leaves information</label></div>
				<div class="panel-body">
					<div class="com-md-12 col-xs-12">
						<table class="table table-condensed table-hover table-bordered" >
								<thead>	
								 	<tr>
								 		<label><h3>สิทธิการลาประจำปี <?php echo date("Y");?><br>Leaves information for <?php echo date("Y");?> </h3></label>
								 	</tr>
									<tr class="info">
										<th><center>การลา<br>Leave Type</center></th>
										<th><center>สิทธิ์ที่มีอยู่<br>Maximum allowed</center></th>
										<th><center>สิทธิ์เก่ายกมา<br>Oldremanning leaves</center></th>
										<th><center>สิทธิ์เก่าใช้ไป<br>Old leaves already taken</center></th> 
										<th><center>สิทธิ์ใหม่ใช้ไป<br>New leaves already taken</center></th>
										<th><center>หมายเหตุ<br>Remake</center></th> 
									</tr>
								<thead>
								<tbody>
								  	  <?php if(empty($data_user_leave) OR isset($data_user_leave[0]->ERROR)){?>
                            		<?php }else{?>
						          	<?php foreach($data_user_leave as $num=>$row):?>
						          		<tr class="active">
								  			<th><?php echo $row->leave_type?></th>
								  			<th><?php echo $row->annual_new;?></th>
								  			<th><?php echo $row->annual_old?></th>
								  			<th><?php echo $row->annual_old_use?></th>
								  			<th><?php echo $row->annual_new_use?></th>
								  			<th><?php echo $row->total_leave ?> วัน/Day</th>
								  		</tr>			  				        
					</div>
				</div>
		</div>
						          <?php endforeach; }?>
							</tbody>
						</table>
					</div>

				</div>
				<div class="panel-footer"></div>
			</div>
  		</div>
  			<div class="col-md-5">
					<table class="table table-condensed table-hover table-bordered">
							<thead>	
								<tr border="1" >
								 	<label><h3>วันหยุดประจำปี <?php echo date("Y");?> <br>Holiday Calender <?php echo date("Y");?></h3></label>
								</tr>
								<tr class="info">
									<th>วันที่ / Date</th>
									<th>วันหยุด/Holiday</th>  	
								</tr>
							<thead>
							<tbody>
								<?php 
									foreach($data_holiday as $num=>$Calender){?>
								<tr <?php echo(strtotime($Calender->non_working_time)<strtotime(date('Y-m-d')))?'class="danger"':'';?>>
									<td class="active"><?php echo date("d/m/Y", strtotime($Calender->non_working_time));?><br></td>
									<td><?php echo $Calender->detail;?></td>
								</tr>				
								<?php }?>
							</tbody>
					</table>
				</div>
			</div>
  		</div>
	</div>
</div>
</body>
</html>
<script>
</script>