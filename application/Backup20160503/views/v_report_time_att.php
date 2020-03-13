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
	.ui-datepicker-calendar {
    display: none;
    }
	</style>
	<br>

<div class="container" >
	<form  action="<?php echo base_url('index.php/report_time_att/');?>" target="_blank" method="POST">
		<div class="panel panel-default">
			<div id="overlay">
			</div>
			<div class="panel-heading"> <label class="glyphicon glyphicon-paste"> รายงานเวลาเข้าออกงาน/ Report Time Attendence</label></div>
			
			<div class="panel-body">
			
			<div class="row">
				<!-- <div id="dtBox"></div> -->
				<!-- <div class="col-xs-6 col-sm-4 col-sm-offset-2">
					<label>ตั้งแต่วันที่ / Start date :</label>
					<input type="date" class="form-control" name="search_start_date" id="search_start_date" value="<?php //echo (isset($starttime) AND $starttime != "")?$starttime:'';?>" required>
				</div>
				<div class="col-xs-6 col-sm-4">
					<label>ถึงวันที่ / End date :</label>
					<input type="date" class="form-control" name="search_end_date" id="search_end_date" min="<?php //echo(isset($starttime) AND $starttime != "")?$starttime:date('Y-m-01');?>" value="<?php //echo (isset($endtime) AND $endtime != "")?$endtime:'';?>" required>
				</div> -->
				<input type="hidden" class="form-control" name="search_start_date" id="search_start_date" value="">
				<input type="hidden" class="form-control" name="search_end_date" id="search_end_date"  value="">
				<div class="col-xs-7 col-sm-5 col-sm-offset-2">
				<label for="startDate">Month/Year :
    			<input name="startDate" id="startDate" class="date-picker form-control" onchange="senddate(this.value);" required/></label>
    			</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-6 col-sm-4 col-sm-offset-2" >
					<label>เลือกชื่อแผนก / Department: 
						<select class="form-control" name="txt_depart" id="txt_depart" onchange="run_employee(this.value)" required>
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
					<button type="submit" class="btn btn-info btn-block" id="print_time" name="print_time">Print Report</button>
				</div>
			</div>
			<br><br>
			<div class="panel-footer"></div>
			</div>
		</div>
	</form> 
		<div align="center" class="alert alert-success col-xs-8 col-sm-3 col-sm-offset-3" style="position: absolute; top:45%; z-index: 9999;">
  			<strong>Success!</strong> แก้ไขเวลาเข้าออกงานสำเร็จ
		</div>
	<br><br>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".alert").hide();
		$("#overlay").hide();
		$("#dtBox").DateTimePicker();
		$(function() {
     $('.date-picker').datepicker(
        {
            dateFormat: "mm/yy",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            onClose: function(dateText, inst) {
                function isDonePressed(){
                    return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                }

                if (isDonePressed()){
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');
                    
                     $('.date-picker').focusout()//Added to remove focus from datepicker input box on selecting date
                }
            },
            beforeShow : function(input, inst) {

                inst.dpDiv.addClass('month_year_datepicker')

                if ((datestr = $(this).val()).length > 0) {
                    year = datestr.substring(datestr.length-4, datestr.length);
                    month = datestr.substring(0, 2);
                    $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                    $(this).datepicker('setDate', new Date(year, month-1, 1));
                    $(".ui-datepicker-calendar").hide();
                }
            }
        })
	// $("#startDate").onblur(function(){
	// 	alert("666666");
	// })
});
		// $.fn.dataTableExt.sErrMode = 'throw';
  //       $('#stable').DataTable({
  //         ordering: false,
  //         lengthChange: true,
  //         searching: true
  //      }); 
    });  
    function run_employee(value){
		  	$.ajax({
		    type: "POST",
		    dataType: "JSON",
		    url: "<?php echo base_url('index.php/report_time_att/run_employee'); ?>",
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
  	function senddate(value){
  		// var senddate = "01/"+value;
  		var subdate = value.substring(0,2);
  		var subyear = value.substring(3,value.length);
  		var senddate = subdate+"/01/"+subyear;

  		// var date = new Date(senddate);
  		var date = new Date(senddate), y = date.getFullYear(), m = date.getMonth();
		var firstDay = new Date(y, m, 1);
		var lastDay = new Date(y, m + 1, 0);
		var formatfirst = firstDay.getFullYear() + '-' + (firstDay.getMonth() + 1) + '-' +  firstDay.getDate();
		var formatlast = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1) + '-' +  lastDay.getDate();
		$("#search_start_date").val(formatfirst);
		$("#search_end_date").val(formatlast);
  		// alert(lastDay);
  	}
</script>