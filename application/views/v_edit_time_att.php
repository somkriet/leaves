	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<link href='<?php echo base_url();?>assets/css/loading.css' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/DateTimePicker.css" />
 	<script type="text/javascript" src="<?php echo base_url();?>assets/js/DateTimePicker.js"></script>
	<style type="text/css">
	a:hover {cursor:pointer;}
	textarea { /*resize: vertical;*/ resize: none; }
	.date_detail{background-color: #FFF;border: aliceblue;}
	.textred{color:red; font-weight: bold; font-size: 18px;}
	.modal-dialog{
		margin: 50px;
		margin-left: 30%;
		margin-right: 30%;
		max-height: 100%;
		width: auto;
		height: auto;
		position: relative;
	}
	#overlay {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 200%;
	}
	</style>
	<br>

<div class="container" >
	<form  action="<?php echo base_url('index.php/edit_time_att/');?>" method="POST">
		<div class="panel panel-default">
			<div id="overlay" style="display:none">
			</div>
			<div class="panel-heading"> <label class="glyphicon glyphicon-time"> แก้ไขเวลาเข้าออกงาน/ Edit Time Attendence</label></div>
			
			<div class="panel-body">
			
			<div class="row">
				<!-- <div id="dtBox"></div> -->
				<div class="col-xs-6 col-sm-4 col-sm-offset-2">
					<label>ตั้งแต่วันที่ / Start date :</label>
					<input type="date" class="form-control" name="search_start_date" id="search_start_date" value="<?php echo (isset($starttime) AND $starttime != "")?$starttime:'';?>" required>
				</div>
				<div class="col-xs-6 col-sm-4">
					<label>ถึงวันที่ / End date :</label>
					<input type="date" class="form-control" name="search_end_date" id="search_end_date" min="<?php echo(isset($starttime) AND $starttime != "")?$starttime:date('Y-m-01');?>" value="<?php echo (isset($endtime) AND $endtime != "")?$endtime:'';?>" required>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-6 col-sm-4 col-sm-offset-2" >
					<label>เลือกชื่อแผนก / Department: 
						<select class="form-control" name="txt_depart" id="txt_depart" onchange="run_employee(this.value)">
							<option value="">กรุณาเลือกรายการ / Please Select</option>
							<?php foreach($department as $key => $val){ ?>
							<option value="<?php echo $val->department_ID;?>"><?php echo $val->department_Name;?></option>
							<?php } ?>
						</select>
					</label>
				</div>
				<div class="col-xs-6 col-sm-4">
					<label>เลือกชื่อพนักงาน / Empleyee: 
						<select class="form-control" name="txt_employee" id="txt_employee">
							<option value="">กรุณาเลือกรายการ / Please Select</option>
						</select>
					</label>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-6 col-sm-2 col-sm-offset-5">
					<button type="submit" class="btn btn-info btn-block" id="search_time" name="search_time">Search</button>
				</div>
			</div>
			<br><br>
			<div class="panel-footer"></div>
			</div>
		</div>
	</form> 
		<div align="center" class="alert alert-success col-xs-8 col-sm-3 col-sm-offset-3" style="position: absolute; top:45%; z-index: 9999; display:none;">
  			<strong>Success!</strong> แก้ไขเวลาเข้าออกงานสำเร็จ
		</div>
		<table id="stable" class="table table-condensed table-hover table-bordered .col-xs-6 .col-md-4">
 								<thead>
									<tr class="info">
										<th><center>รหัสพนักงาน<BR>User ID</center></th>
										<th><center>ชื่อ-นามสกุล<BR>Name-Surname</center></th>
										<th><center>วันที่<BR>Date</center></th>
										<th><center>เวลาเข้างาน<BR>Time In</center></th>
										<th><center>เวลาออกงาน<BR>Time Out</center></th>
										<th><center>แก้ไข<br>Edit</center></th>
									</tr>
								</thead>
								<tbody>
									<?php //echo "<pre>"; print_r($search_time_att); echo "</pre>"; exit(); ?>
					 				<?php if(!isset($search_time_att) OR empty($search_time_att) ){?>
					 					<tr><td colspan="6" align="center">NO DATA</td></tr>
                            		<?php }else{?>
										<?php foreach($search_time_att as $num=>$val):?>
									<tr class="active">
										<td><center><?php echo $val->work_id;?></center></td>
										<td><?php echo $val->name_en." ".$val->surname_en?><br><?php echo $val->name_th." ".$val->surname_th?></td>
										<td><center><?php echo $val->rec_date;?></center></td>
										<td><center><?php echo (empty($val->temp_time_in)?$val->time_in:$val->temp_time_in);?></center></td>
										<td><center><?php echo (empty($val->temp_time_out)?$val->time_out:$val->temp_time_out);?></center></td>
										<td><center><a href="#" onclick="show_detail('<?php echo $val->work_id;?>','<?php echo $val->name_th." ".$val->surname_th;?>','<?php echo $val->rec_date;?>','<?php echo (empty($val->temp_time_in)?$val->time_in:$val->temp_time_in);?>','<?php echo (empty($val->temp_time_out)?$val->time_out:$val->temp_time_out);?>');" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a></center></td>		
										<!-- <td><center><a id="<?php //echo $val->work_id."^".$val->rec_date.$val->time_in.$val->time_out."*".$val->name_en." ".$val->surname_en."/".$val->name_th." ".$val->surname_th;?>" onclick="show_detail(this.id)" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a></center></td>		 -->
									</tr>
										<?php endforeach; }?>
							</tbody>
					</table>
					<button type="button" class="btn_show_detail btn btn-info btn-xs" data-toggle="modal" data-target="#edit_time" style="display:none"></button>
					<div class="modal fade" id="edit_time" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document" >
							<div class="modal-content" >
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel"></h4>
								</div>
								<div class="modal-body">
										<!-- <p>เวลาเข้างาน/Time in : </p> -->
										<input type="hidden" class="form-control"  name="workid" id="workid" value="" readonly>
										<input type="hidden" class="form-control"  name="dates" id="dates" value="" readonly>
										<label>เวลาเข้างาน/Time in : 
										<input type="text" data-field="time" class="form-control"  name="timein" id="timein" value="" readonly>
										</label>
										<label>เวลาออกงาน/Time out : 
										<input type="text" data-field="time" class="form-control"  name="timeout" id="timeout" value="" readonly>
										</label>
										<div id="dtBox"></div>
										<!-- <label>เวลาออกงาน/Time out : <input class="form-control" type="text" name="timeout" id="timeout" value=""></label> -->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success save" data-dismiss="modal">Save</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<br><br>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		// $(".alert").hide();
		// $("#overlay").hide();
		$("#dtBox").DateTimePicker();
		$.fn.dataTableExt.sErrMode = 'throw';
        $('#stable').DataTable({
          ordering: false,
          lengthChange: true,
          searching: true
        }); 
        
        $(".save").click(function(){
        	if($("#timein").val() == ""){
        		alert("กรุณากรอกข้อมูลช่องเวลาเข้างาน!!");
        	}
        	if($("#timeout").val() == ""){
        		alert("กรุณากรอกข้อมูลช่องเวลาออกงาน!!");
        	}
        	var workid = $("#workid").val();
        	var dates = $("#dates").val();
        	var timein = $("#timein").val();
        	var timeout = $("#timeout").val();
        	$.ajax({
        	type: "POST",
        	dataType: "JSON",
        	url: "<?php echo base_url('index.php/edit_time_att/save_newtime');?>",
        	data: {'workid':workid,'dates':dates,'timein':timein,'timeout':timeout},
        	success: function(data){
        		// alert(data);
        		$(".alert").css('display','');
        		$("#overlay").css('display','');
        		setTimeout(function(){ location.reload(); }, 3000);
        	}	
        	})
        })
	})
	function run_employee(value){
		  	$.ajax({
		    type: "POST",
		    dataType: "JSON",
		    url: "<?php echo base_url('index.php/edit_time_att/run_employee'); ?>",
		    data: {'depart_id' : value},
		    success: function(data){
		    console.log(data);
		    $('#txt_employee').find('option').remove().end();
			$("#txt_employee").append($("<option></option>").val("").html('กรุณาเลือกรายการ / Please Select'));
			var leave_type_array = new Array();
			$.each(data,function(index,value){
			$("#txt_employee").append($("<option></option>").val(value['user_ID']).html(value['name_th']+" "+value['surname_th']+" / "+value['name_en']+" "+value['surname_en']));
			})
			}
		})
  	}
  	function show_detail(id,name,dates,time_in,time_out){
  		$("#myModalLabel").html("แก้ไขเวลาเข้าออกงานของ "+name+" วันที่ : "+dates);
  		$("#workid").val(id);
  		$("#dates").val(dates);
  		$("#timein").val(time_in);
  		$("#timeout").val(time_out);
  		$(".btn_show_detail").click();
  	}
</script>