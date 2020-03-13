	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<link href='<?php echo base_url();?>assets/css/loading.css' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	
	<style type="text/css">
	a:hover {cursor:pointer;}
	#overlay {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 200%;
	}
	#overlay1 {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 10%;
    width: 100%;
    height: 200%;
	}
	textarea { /*resize: vertical;*/ resize: none; }
	.date_detail{background-color: #FFF;border: aliceblue;}
	.textred{color:red; font-weight: bold; font-size: 18px;}
	</style>

	<br></br></br>
	<div id="overlay1" >
			<div class="alert alert-success showalert">
  				<strong>Success!</strong> ดำเนินการเสร็จสิ้น คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.
			</div>
	</div>	
	<div id="overlay" ><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">S</div><div id="fountainTextG_2" class="fountainTextG">a</div><div id="fountainTextG_3" class="fountainTextG">v</div><div id="fountainTextG_4" class="fountainTextG">i</div><div id="fountainTextG_5" class="fountainTextG">n</div><div id="fountainTextG_6" class="fountainTextG">g</div></div>
	</div>

	<div class="container" ><!-- style="width: 1370px;" -->
	
		<div class="panel panel-default">
	
			<div class="panel-heading"> <label class="glyphicon glyphicon-list-alt"> กรอกใบลา/Leave Requests</label></div>
			
			<div class="panel-body">
			
			<div class="alert alert-block alert-warning fade col-md-offset-10 col-md-2 col-xs-2 in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5>LEAVE REGULATION </h5>
							<a  id="example"  data-container="body" data-toggle="popover" data-placement="left" data-content="Annnual Leave ลาพักร้อน ไม่ตัดคะแนน">
							 &nbsp;&nbsp;&nbsp;<label class="glyphicon glyphicon-grain">&nbsp;Annual Leave</label>
							</a>
							<br>
							<a  id="example1"  data-container="body" data-toggle="popover" data-placement="left" data-content="Sick Leave 1 Day (Without Medical Certificate) / ป่วย 1 วัน (ไม่มีใบรับรองแพทย์)  -0.50 คะแนน">
							&nbsp;&nbsp;&nbsp;<label class="glyphicon glyphicon-bed">&nbsp;Sick Leave</label>
							</a>
							<br>
							<a  id="example2"  data-container="body" data-toggle="popover" data-placement="left" data-content="พนักงานสามารถลากิจได้ 10 วันใน 1 ปี ตามระเบียบข้อบังคับการทำงานของบริษัท  Private Leave (Peronal) ลากิจธุระส่วนตัว หักเงินเดือน ไม่หักคะแนน ">
							&nbsp;&nbsp;&nbsp;<label class="glyphicon glyphicon-calendar">&nbsp;Private Leave</label>
							</a>
							<p style="margin-left: 60%;">
								<a href="<?php echo base_url().index_page();?>/regulation" class="btn btn-info">Other</a>
							</p>
						</div>
				<div class="com-md-10 col-xs-10" style="position:relative; margin-top:-15%;">

				<form id="frmUpload" action="<?php echo base_url('index.php/leave/');?>" method="post" enctype="multipart/form-data" >
					<div class="col-md-10 col-xs-10">
						<div class="col-md-12 col-xs-12 row col-md-offset-1">
							<div class="col-md-6  col-xs-12 form-group" <?php echo ((isset($user['department_ID']) AND ($user['department_ID'] == 7 AND ($user['user_type_ID'] == 1 OR $user['user_type_ID'] == 2))) OR $user['user_type_ID'] == 0 OR $user['user_type_ID'] == 5)? '':"style='display:none;'" ?>>
								<label class="textred">*</label>ลาให้กับ / Employee :
								<select class="form-control" name="txt_user_leave" id="txt_user_leave" onchange="document.getElementById('user_l').value=this.options[this.selectedIndex].text"  required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<?php foreach($employee as $key => $value){  ?>
									<option value="<?php echo $value->user_ID; ?>" <?php echo (isset($userid) AND $userid == $value->user_ID)?'selected':'';?>><?php echo $value->name_th."  ".$value->surname_th."/".$value->name_en."  ".$value->surname_en; ?></option>
									<?php } ?>
								</select>
								<input type="hidden" name="user_l" id="user_l" value="" />
							</div>
						</div>
						<div class="col-md-12 col-xs-12 row col-md-offset-1">
							<div class="col-md-6  col-xs-12 form-group">
								<label class="textred">*</label>เลือกรายการ / Request type :
								<select class="form-control" name="txt_req_type" id="txt_req_type" onchange="runleave_type(this.value)" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<?php foreach($leave_group as $key => $value){?>
									<option value="<?php echo $value->leave_group_ID;?>"><?php echo $value->leave_group_Name;?></option>
									<?php } ?>
								</select>
								<input type="hidden" name="group_l" id="group_l" value="" />
							</div>
							<div class="col-md-6 col-xs-12 form-group">
								<label class="textred">*</label>เลือกประเภท / Leave type :
								<select class="form-control" name="txt_leave_type" id="txt_leave_type" onchange="runleave_type_casual(this.value)" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
								</select>
							</div>
								<input type="hidden" name="type_l" id="type_l" value="" />
						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row type_casual" style="display:none">
							<div class="col-md-6 col-xs-12  form-group">
								<label class="textred">*</label>เลือกประเภทลากิจ /Casual Leave type :
								<select class="form-control" name="txt_leave_type_cas" id="txt_leave_type_cas" onchange="chk_remark()">
									<option value="">กรุณาเลือกรายการ / Please Select</option>
								</select>
							</div>
							<div class="col-md-6 col-xs-12 form-group">
								<label  class="textred" id="remerk">*</label>หมายเหตุ /Remark :
								<input class="form-control" type="text" name="txtremark" id="txtremark">
							</div>
						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row cost" style="display:none"><!-- style="display:none" -->
							<div class="col-md-6 col-xs-12 form-group">
								<label class="textred">*</label>เดินทางโดย :
								<select class="form-control" name="txt_progression" id="txt_progression" onchange="document.getElementById('progress_l').value=this.options[this.selectedIndex].text">
									<option value="">กรุณาเลือกรายการ / Please Select</option>
								</select>
							</div>
							<input type="hidden" name="progress_l" id="progress_l" value="" />

							<div class="col-md-3 col-xs-12 form-group">
								<label>ค่าใช้จ่าย :</label>
									<select class="form-control" name="txt_payment" id="txt_payment" onchange="document.getElementById('pay_l').value=this.options[this.selectedIndex].text">
									<!-- <option value="">Please Select</option> -->
									<option value="0">ไม่มีค่าใช้จ่าย</option>
									<option value="1">มีค่าใช้จ่าย</option>
								</select>
							</div>
							<input type="hidden" name="pay_l" id="pay_l" value="" />
							<div class="col-md-3 col-xs-12 form-group">
								<label>จำนวนเงิน :</label>
								<input class="form-control" type="text" name="txt_cost" id="txt_cost">
							</div>
						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row">
								<div class="col-md-6 col-xs-12 form-group">
									<label class="textred">*</label>ลาวันที่ / from date :
									<input type="text" class="form-control" name="txt_date_from" id="txt_date_from" onchange="rundate()" required>
								</div>
								<div class="col-md-6 col-xs-12 form-group">
									<label class="textred">*</label>ถึงวันที่ / to date :
									<input type="text" class="form-control" name="txt_date_to" id="txt_date_to" onchange="rundate()" required>
								</div>
						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row">
							<div class="col-md-6 col-xs-12" style="padding: 0px;">
								<div class="col-md-12 col-xs-12 form-group">
									<label class="textred">*</label>เรื่อง / Description :
									<input type="text" class="form-control" id="txt_topic" name="txt_topic" required>
								</div>
								<form id="frmUpload" action="<?php echo base_url('index.php/leave/');?>" method="post" enctype="multipart/form-data" >
								<div class="col-md-12 col-xs-12 form-group">
									<label>ไฟล์แนบ / Attachment :</label>
									<input type="hidden" id="leid" name="leid">
									<input type="file" class="form-control" id="file_upload" name="file_upload">
    								<input type="submit" name="btnSubmit" id="btnSubmit" value="อัพโหลด" style="display:none" />
								</div>
							</div>
							<div class="col-md-6 col-xs-12 form-group">
								<label class="textred">*</label>รายละเอียด / Reasons :
								<textarea class="form-control" id="txt_desc" name="txt_desc" rows="5" required></textarea>
							</div>
						</div>
						<div id="textdata" style="display:none">

						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row table_detail">
								<table class="table" id="dtable">
    								<thead></thead>
								    <tbody></tbody>
				 				 </table>
						</div>
						<div class="showtotal" style="display:none">
							<label>รวม/Total
							<input type="text" name="totalday" id="totalday"  disabled /> วัน/day</label>
						</div>
						<div class="col-md-12 col-xs-12 col-md-offset-1 row">
							<div class="col-md-5 col-xs-3 form-group"></div>
							<div class="col-md-2 col-xs-4 form-group">
								<button type="button" class="btn btn-success btn-block" id="save_leave">Save</button>
							</div>
						</div>
					</div>
					</form>
				</div>

			</div>
			
			<div class="panel-footer"></div>
			
		</div>
	<!-- </div> -->
	<script type="text/javascript">
	$(document).ready(function(){
		// alert("ดำเนินการเสร็จสิ้น / Complete \n คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.");
		// $("#remerk").removeClass("textred");
		// $(".alert").hide();
		// $(".1").css("display","none");
		$("#overlay1").hide();
		$("#remerk").css("display","none");
		$("#overlay").hide();
	$(function (){
         $("#example").popover();
      });
        $(function (){
         $("#example1").popover();
      });
          $(function (){
         $("#example2").popover();
      });
   //   $("#cancel").click(function(){
   //   	var r = confirm("คุณต้องการยกเลิกวันหยุดที่ตรงกับวันเสาร์นี้ใช่หรือไม่");
   //  	if (r == true){
  			
  	// 	}else{
			// return false;
  	// 	}
   //   })
	var currentYear = (new Date).getFullYear();
	// alert(currentYear);
	$("#user_l").val($("#txt_user_leave option:selected").text());
    $("#txt_date_from").datepicker({
    	dateFormat: "yy-mm-dd",
        numberOfMonths: 2,
        minDate: new Date(currentYear-1, 1-1, 1),
        maxDate: new Date(currentYear+1, 3-1, 31),
        onSelect: function(selected) {
          $("#txt_date_to").datepicker("option","minDate", selected)
          rundate();
        }
    })
    $("txt_leave_type").click(function(){
    	if($("#txt_req_type").val() == ""){
			alert("กรุณเลือกรายการ / Request type");
			return false;
		}
    })
    $("#txt_date_to").datepicker({ 
    	dateFormat: "yy-mm-dd",
        numberOfMonths: 2,
        minDate: new Date(currentYear-1, 1-1, 1),
        maxDate: new Date(currentYear+1, 3-1, 31),
        onSelect: function(selected) {
           $("#txt_date_from").datepicker("option","maxDate", selected)
           rundate();
        }
    })
    $( "#txt_req_type" ).change(function() {
  		 $("#txt_date_to").val("");
  		 $("#txt_date_from").val("");
	     $("#txt_leave_type_cas").find('option').remove().end();
		 $(".type_casual").css("display","none");
		 $(".showtotal").css('display','none');
		 var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('thead').empty();
        		 $('tbody').empty();
			}
	})
	$( "#txt_leave_type" ).change(function() {
  		 $("#txt_date_to").val("");
  		 $("#txt_date_from").val("");
  		 var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('thead').empty();
        		 $('tbody').empty();
			}
	})
	$( "#txt_leave_type_cas" ).change(function() {
  		 $("#txt_date_to").val("");
  		 $("#txt_date_from").val("");
  		 var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('thead').empty();
        		 $('tbody').empty();
			}
	})
	$("#save_leave").click(function(){
		var user_leave = $("#txt_user_leave").val();
		var req_type = $("#txt_req_type").val();
		var type_leave = $("#txt_leave_type").val();
		var type_leave_cas = $("#txt_leave_type_cas").val();
		var remark = $("#txtremark").val();
		var datefrom = $("#txt_date_from").val();
		var dateto = $("#txt_date_to").val();
		var description = $("#txt_topic").val();
		var reasons = $("#txt_desc").val();
		var file = $("#file_upload").val();
		var progression = $("#txt_progression").val();
		var payment = $("#txt_payment").val();
		var cost = $("#txt_cost").val();
		var totalday = $("#totalday").val();
		var length = file.length;
		var filename = file.substring(12,length);
		// var rowCount = $('#dtable tr').length;
		var Table = $('#dtable').dataTable();
		var rowCount = Table.fnGetData().length;
		var numoldnew = 0; //$(".oldnew").length;
		var numnew = 0; //$(".new").length;
		var numold = 0; //$(".old").length;

		for(var n=0; n<rowCount; n++){
			var start = $('#textfrom'+n).val();
			var end = $('#textto'+n).val();
			if((start == '08.30' || start == '8.30') && end == '17.30'){
				var use_time = 1;
			}else{
				var use_time = 0.5;
			}
			if($('#textdate'+n).hasClass('oldnew')){
				numoldnew = parseFloat(numoldnew) + parseFloat(use_time);
			}else if($('#textdate'+n).hasClass('new')){
				numnew = parseFloat(numnew) + parseFloat(use_time);
			}else if($('#textdate'+n).hasClass('old')){
				numold = parseFloat(numold) + parseFloat(use_time);
			}
		}
		// console.log(numold);
		// return false;
		////////////////////
		var user_l=$("#user_l").val();
		var type_l = $("#type_l").val();
		var group_l = $("#group_l").val();
		var progress_l = $("#progress_l").val();
		var pay_l = $("#pay_l").val();
		///////////////////
		var user_leave = $("#txt_user_leave").val();
		var datechk = "";
		// var idleave = "";
		// alert(numnew);
		// return false;
		if(type_leave == 5 && file == ""){
			var r = confirm("ท่านต้องการแนบใบรับรองแพทย์ก่อนหรือไม่?");
    	if (r == true){
  			return false;
  		}
		}
		if(req_type == 4 && progression == 0){
			alert("กรุณาเลือกการเดินทางโดย ?");
			return false;
		}
		if((type_leave == 3 || type_leave == 4) && type_leave_cas == ""){
			alert("กรุณาเลือกประเภทการลากิจ");
			return false;
		}
		if(payment == 1 && cost == ""){
			alert("กรุณาระบุจำนวนค่าใช่จ่าย");
			return false;
		}
		if(rowCount <= 0){
			alert("กรุณาเลือกวันลาใหม่ เนื่องจากวันที่ท่านลาตรงกับวันหยุด");
			return false;
		}
		if($("#txt_topic").val() == ""){
			alert("กรุณากรอกเรื่อง");
			return false;
		}
		if($("#txt_desc").val() == ""){
			alert("กรุณากรอกรายละเอียด");
			return false;
		}
		if($("#txt_date_from").val() == ""){
			alert("กรุณากรอกวันที่ต้องการลา");
			return false;
		}
		if($("#txt_date_to").val() == ""){
			alert("กรุณากรอกวันที่ต้องการลา");
			return false;
		}
		if(type_leave_cas == '21' &&  remark == ""){
			alert("กรุณากรอกข้อมูลช่องหมายเหตุ");
			return false;
		}
		// $("#overlay").show();
		var chkdate = '';
		var chkleave = '';
		var arr_date = new Array();
		var arr_timefrom = new Array();
		var arr_timeto = new Array();
		// var detail = $("#dtable tbody tr").length;
		var detail1 = $(".textfrom").length;
		// alert(detail1); return false;
			   for (var i = 0; i < detail1; i++) {
					var c_date = $("#textdate"+i).val();
					var c_timefrom = $("#textfrom"+i).val();
					var c_timeto = $("#textto"+i).val();
				if(c_date != ""){
					arr_date.push(c_date);
					arr_timefrom.push(c_timefrom);
					arr_timeto.push(c_timeto);
				}
			}
			console.log(arr_date);
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/leave/chk_date')?>",
			data: { 'c_date' : arr_date, 'c_timefrom' : arr_timefrom, 'c_timeto' : arr_timeto,'user_leave':user_leave },
			async: false,
			success: function(data){
				console.log(data);
				// return false;
				chkdate = data;
			}
		});
		if(chkdate == 'ERROR'){
					alert("กรุณาตรวจสอบวันลาใหม่ เนื่องจากมีวันลาที่ท่านได้กรอกการลาแล้ว");
					return false;
				}
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/leave/chk_haveleave')?>",
			data: {'numoldnew' : numoldnew,'numold':numold,'numnew':numnew,'user_leave' : user_leave,'type_leave' : type_leave},
			async: false,
			success: function(data){
				chkleave = data;
			}
		});
		if(chkleave == "no"){
			alert("สิทธิ์การลาพักร้อนที่มีอยู่ไม่พอค่ะ");
			return false;
		}
		// console.log('=='+numoldnew+'=='+numold+'=='+numnew+'==');
		// return false;
		$("#overlay").show();
		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "<?php echo base_url('index.php/leave/save_leave');?>",
			data : {'user_leave' : user_leave,'req_type' : req_type,'type_leave' : type_leave,'type_leave_cas' : type_leave_cas,
					'remark' : remark,'datefrom' : datefrom,'dateto' : dateto,'description' : description,'reasons' : reasons,
					'filename' : filename,'progression' : progression,'cost' : cost,'payment' : payment,'totalday' : totalday,'chk_table' : 'h',
					'numoldnew' : numoldnew,'numold':numold,'numnew':numnew,'user_l':user_l,'type_l':type_l,'group_l':group_l,'progress_l':progress_l,'pay_l':pay_l},
			// async: false,
			success: function(data){
				// console.log(data);
				// return false;
				// idleave = data;
				// if(data == "no"){
				// 	alert("สิทธิ์การลาพักร้อนที่มีอยู่ไม่พอค่ะ");
				// 	return false;
				// }
				var leaveid = data[0]['leave_ID'];
				 $("#leid").val(leaveid);
				// var oTable = $('#dtable').dataTable();
				// var detail = oTable.fnGetData().length;
				// var detail = $("#dtable tbody tr").length;
				// var detail = $("#dtable tbody tr").length;
				// console.log(leaveid);
				// return false;
				var detail = $(".textfrom").length;
				for (var i = 0; i < detail; i++) {
					var chkval = $("#textdate"+i).val();
					if(chkval != ""){
					var d_date = $("#textdate"+i).val();
					var d_timefrom = $("#textfrom"+i).val();
					var d_timeto = $("#textto"+i).val();
					}
					$.ajax({
					type : "POST",
					dataType : "JSON",
					url : "<?php echo base_url('index.php/leave/save_leave');?>",
					data : {'leaveid' : leaveid,'d_date' : d_date,'d_timefrom' : d_timefrom,'d_timeto' : d_timeto,'chk_table' : 'd'},
					async: false,
					success: function(data){
							}
						});
					// console.log(i);
				}
				// return false;
					// alert("ดำเนินการเสร็จสิ้น / Complete \n คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.");
					// $(".alert").show();
					$("#overlay").hide();
					$("#overlay1").show();
					// $(".showalert").css("display","");
					setTimeout(function(){$( "#btnSubmit" ).click();}, 2000);
					
					
					// $(".alert").hide();
			}
		})
		
	})
})
	function runleave_type(value){
		$("#group_l").val($("#txt_req_type option:selected").text());
		$("#type_l").val("");
		$("#progress_l").val("");
		$("#pay_l").val("");
		$(".cost").css('display','none');
		$("#txt_progression").find('option').remove().end();
		$("#txt_payment").val("0");
		$("#txt_cost").val("");
		var group_id = value;
			$.ajax({
						type : "POST",
						dataType : "JSON",
						url : "<?php echo base_url('index.php/leave/leave_type');?>",
						data : {'group_id' : group_id},
						success: function(data){
							// console.log(data);
							$('#txt_leave_type').find('option').remove().end();
							$("#txt_leave_type").append($("<option></option>").val("").html('กรุณาเลือกรายการ / Please Select'));
							var leave_type_array = new Array();
							$.each(data,function(index,value){
								$("#txt_leave_type").append($("<option></option>").val(value['leave_type_ID']).html(value['leave_type_Name']));
							})
						} 
					})
		if(group_id == 4){
			$(".cost").css('display','');
			$.ajax({
						type : "POST",
						dataType : "JSON",
						url : "<?php echo base_url('index.php/leave/leave_onjob');?>",
						data : {'group_id' : group_id},
						success: function(data){
							
							// console.log(data);
							$('#txt_progression').find('option').remove().end();
							$("#txt_progression").append($("<option></option>").val(0).html('กรุณาเลือกรายการ / Please Select'));
							var leave_type_array = new Array();
							$.each(data,function(index,value){
								$("#txt_progression").append($("<option></option>").val(value['progression_ID']).html(value['progression_Name']));
							})
						} 
					})
		}
	}

	function runleave_type_casual(value){
		$("#type_l").val($("#txt_leave_type option:selected").text());

		var type_id = value;
		if(type_id == '3' || type_id == '4'){
			$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "<?php echo base_url('index.php/leave/leave_type_casual');?>",
			data : {'type_id' : type_id},
			success: function(data){
				$(".type_casual").css("display","");
				$("#txt_leave_type_cas").find('option').remove().end();
				$("#txt_leave_type_cas").append($("<option></option>").val(0).html('กรุณาเลือกรายการ / Please Select'));
				var leave_type_array = new Array();
				$.each(data,function(index,value){
					$("#txt_leave_type_cas").append($("<option></option>").val(value['leave_type_ID']).html(value['leave_type_Name']));
				})
			} 
		})
		}else{
			$(".type_casual").css("display","none");
			$(".showtotal").css('display','none');
			$("#txt_leave_type_cas").find('option').remove().end();
		}
	}
function rundate(){
		if($("#txt_leave_type").val() == ""){
			$("#txt_date_to").val("");
			$("#txt_date_from").val("");
			alert("กรุณาเลือกประเภทการลา");
			return false;
		}else{
			if($("#txt_leave_type_cas").val() == "0"){
				$("#txt_date_to").val("");
				$("#txt_date_from").val("");
				alert("กรุณาเลือกประเภทการลากิจ");
				return false;
			}
		}
		var dateto = $("#txt_date_to").val();
		var datefrom = $("#txt_date_from").val();
		var type = $("#txt_leave_type").val(); 
		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "<?php echo base_url('index.php/leave/leave_d');?>",
			data : {'datefrom' : datefrom, 'dateto' : dateto, 'type' : type},
			success: function(data){
				// console.log(data);
				$('input[name="day"]').remove();
				$(".showtotal").css('display','');
				var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('thead').empty();
        		 $('tbody').empty();
        		 $('#textdata').empty();
			}

				var newth = "<tr><th>ลำดับ / NO</th><th>วันที่ / Date</th><th>ตั้งแต่เวลา /<br> From Time </th><th>ถึงเวลา /<br> To Time </th><th>ลบวันเสาร์ /<br> Delete Saturday</th></tr>";
        			jQuery("#dtable thead").append(newth);
				$.each(data,function(index,val){
					var no = index+1;
					var sat = '';
					var d = new Date(val['0']);
					// var getTot = daysInMonth(d.getMonth(),d.getFullYear()); 
					  // var d = new Date();
    				var n = d.getDay()
    				if(n == 6 || n == 0){
    					sat = '1';
    				}
					$('<input>').attr({
					    type: 'hidden',
					    id: 'day'+index,
					    name: 'day',
					    value: '1'
					}).appendTo('.showtotal');
					if(sat == ''){
        				var newRowContent = "<tr><td>"+ no +"</td><td><input type='text' class='date_detail "+val[1]+"' id='date"+index+"' name='date"+index+"' value="+val[0]+" disabled></td><td><select class='timefrom' id='timefrom"+index+"' name='timefrom"+index+"' onchange='cal_timefrom(this.value,this.id)' ><option value='8.30'>8.30</option><option value='13.00'>13.00</option></select></td><td><select class='timeto' id='timeto"+index+"' name='timeto"+index+"' onchange='cal_timeto(this.value,this.id)'><option value='12.00'>12.00</option><option value='17.30' selected>17.30</option></select></td><td>-</td></tr>";
					}else{
        				var newRowContent = "<tr id='show"+index+"'><td>"+ no +"</td><td><input type='text' class='date_detail "+val[1]+"' id='date"+index+"' name='date"+index+"' value="+val[0]+" disabled></td><td><select class='timefrom' id='timefrom"+index+"' name='timefrom"+index+"' onchange='cal_timefrom(this.value,this.id)' ><option value='8.30'>8.30</option><option value='13.00'>13.00</option></select></td><td><select class='timeto' id='timeto"+index+"' name='timeto"+index+"' onchange='cal_timeto(this.value,this.id)'><option value='12.00'>12.00</option><option value='17.30' selected>17.30</option></select></td><td><button type='button' id='cancel"+index+"' onclick='cancelsat(this.id,this)'>Cancel</button></td></tr>";
					}
        			jQuery("#dtable tbody").append(newRowContent);
        			$("#totalday").val(no);
					// var $chk = $('<input/>').attr({ type: 'text', id:'textchk'+index, value:val[1]}).addClass('textchk'+index);
					// $("#textdata").append($chk);
					var $date = $('<input/>').attr({ type: 'text', id:'textdate'+index, value:val[0]}).addClass(val[1]);
					$("#textdata").append($date);
					var $from = $('<input/>').attr({ type: 'text', id:'textfrom'+index, value:'08.30'}).addClass('textfrom');
					$("#textdata").append($from);
					var $to = $('<input/>').attr({ type: 'text', id:'textto'+index, value:'17.30'}).addClass('textto'+index);
					$("#textdata").append($to);
				})
				// $(".table_detail").append('');///////////////// INSERT PAGINATION
				$.fn.dataTableExt.sErrMode = 'throw';
		       		$('#dtable').DataTable({
		          ordering: true,
		          lengthChange: true,
		          searching: true
		        })
			}
		})
	}
	function cal_timefrom(value,id){
		var fid = id;
		var fval = value;
		var length = fid.length;
		var txt_tid = fid.substring(8,length);
		var totimeid = "timeto"+txt_tid;
		var txt_tval = $("#"+totimeid).val();
		var totalday = $("#totalday").val();
		var txtday = $("#day"+txt_tid).val();
		var day = 0.5;
			if(fval == "13.00"){
			$("#"+totimeid).val("17.30");
			txt_tval = "17.30";
		}
		if(txt_tval - fval != 9 && txtday != '0.5'){
			$("#totalday").val(totalday - day);
			$("#day"+txt_tid).val('0.5');
		}else if(txt_tval - fval == 9 && txtday != '1'){
			$("#totalday").val(parseFloat(totalday) + parseFloat(day));
			$("#day"+txt_tid).val('1');
		}
		$("#textfrom"+txt_tid).val(fval);
		$("#textto"+txt_tid).val(txt_tval);
	}
	function cal_timeto(value,id){
		var tid = id;
		var tval = value;
		var length = tid.length;
		var txt_fid = tid.substring(6,length);
		var fromtimeid = "timefrom"+txt_fid;
		var txt_fval = $("#"+fromtimeid).val();
		var totalday = $("#totalday").val();
		var txtday = $("#day"+txt_fid).val();
		var day = 0.5;
		if(tval == "12.00"){
			$("#"+fromtimeid).val("8.30");
			txt_fval = "8.30";
		}
		if(tval - txt_fval != 9 && txtday != '0.5'){
			$("#totalday").val(totalday - day);
			$("#day"+txt_fid).val('0.5')
		}else if(tval - txt_fval == 9 && txtday != '1'){
			$("#totalday").val(parseFloat(totalday) + parseFloat(day));
			$("#day"+txt_fid).val('1')
		}
		$("#textfrom"+txt_fid).val(txt_fval);
		$("#textto"+txt_fid).val(tval);
	}
	function cancelsat(id,thiss){
		
		var subid = id.substring(6);
		var date = $("#date"+subid).val();
		var r = confirm("คุณต้องการลบวันลาที่ตรงกับวันเสาร์ที่ "+ date +" ใช่หรือไม่");
		if(r==true){
			$('#textdate'+subid).remove();
			$('#textfrom'+subid).remove();
			$('#textto'+subid).remove();
			var len = $('.textfrom').length;
			for(var i=subid; i<len; i++){
				var idx = parseInt(i)+1;
				// var textdate = $('#textdate'+idx).val();
				// var textfrom = $('#textfrom'+idx).val();
				// var textto = $('#textto'+idx).val();
				$('#textdate'+idx).attr('id','textdate'+i);
				$('#textfrom'+idx).attr('id','textfrom'+i);
				$('#textto'+idx).attr('id','textto'+i);

				// $('#textdate'+i).val(textdate);
				// $('#textfrom'+i).val(textfrom);
				// $('#textto'+i).val(textto);
			}
			var day = $("#timeto"+subid).val() - $("#timefrom"+subid).val();
			var totalday = $("#totalday").val();
			if(day == 9){
	   			$("#totalday").val(totalday-1);
			}else{
				$("#totalday").val(totalday-0.5);
			}
			// $("#show"+subid).css('display','none');// thiss.closest('tr').remove();
   			var row = thiss.closest('tr');
			$('#dtable').dataTable().fnDeleteRow(row);
			// row.remove();

			var count = $('#dtable tbody tr').length;

			for(var i=0; i<count; i++){
				var id = i+1;
				// var nnew = i;
				$('#dtable tbody tr').eq(i).find('td').eq(0).text(id);
				$('#dtable tbody tr').eq(i).find('input.date_detail').attr('id','date'+i);
				$('#dtable tbody tr').eq(i).find('select.timefrom').attr('id','timefrom'+i);
				$('#dtable tbody tr').eq(i).find('select.timeto').attr('id','timeto'+i);
				// $('#dtable tbody tr').eq(i).find('td').eq(0).text(id);
				$('#dtable tbody tr').eq(i).find('input.date_detail').attr('name','date'+i);
				$('#dtable tbody tr').eq(i).find('select.timefrom').attr('name','timefrom'+i);
				$('#dtable tbody tr').eq(i).find('select.timeto').attr('name','timeto'+i);
			}
			// $("#textchk"+subid).val('');
			// $("#textdate"+subid).val('');
			// $("#textfrom"+subid).val('');
			// $("#textto"+subid).val('');
		}else{
			return false;
		}
	}
	function chk_remark(){
		// alert("45555");
		
		var type_leave_cas = $("#txt_leave_type_cas").val();
		// alert(type_leave_cas);
		if(type_leave_cas == '21'){
			$("#remerk").css("display","");
		}else{
			$("#remerk").css("display","none");
		}
	}
	</script>