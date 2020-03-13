	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
	textarea { /*resize: vertical;*/ resize: none; }
	a:hover {cursor:pointer;}
	.modal-dialog{
		margin: 50px;
		margin-left: 150px;
		margin-right: 150px;
		width: auto;
		height: auto;
		max-height: 100%;
	}
	table thead tr th{
		text-align: center
	}
	</style>
	<div class="row"></br></br></br></div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading "> <label class="glyphicon glyphicon-search"> รายงานการลา/Leave Report </label></div>
			<div class="panel-body">
				<div class="com-md-12 col-xs-12">
				<form method="POST" action="<?php echo base_url('index.php/leave_report/');?>">
					<div class="row">
							<div class="col-xs-6 col-sm-4">
								<label>ตั้งแต่วันที่ / Start date :</label>
								<input type="date" class="form-control" name="datefrom" id="detail_date_from" value="<?php echo (isset($datefrom) AND !empty($datefrom))?$datefrom:''; ?>" required>
							</div>

							<div class="col-xs-6 col-sm-4">
								<label>ถึงวันที่ / End date :</label>
								<input type="date" class="form-control" name="dateto" id="detail_date_to" value="<?php echo (isset($dateto) AND !empty($dateto))?$dateto:''; ?>" required>
							</div>
							<input type="hidden" name="type_user" id="type_user" value="<?php echo (isset($type))? $type:'';?>">
							<div class="col-xs-6 col-sm-4">
							<br>
						    <button type="submit" name="search" id="search" class="btn btn-primary glyphicon glyphicon-search"> Search</button></div>

						    <div class="col-md-10 row" style="display: none;">
						    <div class="col-md-5  form-group">
								<label class="textred">*</label><label>เลือกรายการ / Request type :</label>
								<select class="form-control" name="txt_req_type" id="txt_req_type" onchange="runleave_type(this.value)">
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<?php foreach($leave_group as $key => $value){?>
									<option value="<?php echo $value->leave_group_ID;?>"><?php echo $value->leave_group_Name;?></option>
									<?php } ?>
								</select>
								<input type="hidden" name="group_l" id="group_l" value="" />
							</div>
							</div>
					</div>

					<!-- <div class="col-md-6"> -->
							
							<!-- <div class="col-md-6 col-xs-12 form-group">
								<label class="textred">*</label>เลือกประเภท / Leave type :
								<select class="form-control" name="txt_leave_type" id="txt_leave_type" onchange="runleave_type_casual(this.value)" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
								</select>
							</div>
								<input type="hidden" name="type_l" id="type_l" value="" /> -->
						<!-- </div> -->



				</form>
				</div>
				<div class="row"></div>
				</br>
				<!-- <div class=".col-xs-6 .col-md-4" > -->
					<table id"stable" class="table table-condensed table-hover table-bordered .col-xs-6 .col-md-4">
						<thead>
					<tr>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">รหัส<br>User Id</div></th>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">แผนก<br>Dept.</div></th>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">ชื่อ<br>Name</div></th>
   						<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">นามสกุล<br>Surname</div></th>
    					<th colspan="2" style="vertical-align: middle; text-align: center;"><div class="text-center">ลากิจ<br>Casual day</div></th>
    					<th colspan="2" style="vertical-align: middle; text-align: center;"><div class="text-center">ลาป่วย<br>Sick day</div></th>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="text-center">ลาพักร้อน<br>Annual day</div></th> 
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">รวมวันลา<br>Total leave day</div></th>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">เดินทาง<br>On <br>the job <br>leave</div></th>
    					<th rowspan="3" style="vertical-align: middle; text-align: center;"><div class="tablemiddle">ลาประชุม<br>Manager <br>meeting <br>leave</div></th>
  					</tr>
  					<tr>
    					
   					</tr>
  					<tr>
  					  <th style="vertical-align: middle; text-align: center;"><div class="text-center">จ่าย<br>Pay</div></th>
   					  <th style="vertical-align: middle; text-align: center;"><div class="text-center">ไม่จ่าย<br>Not Pay</div></th>
  					  <th style="vertical-align: middle; text-align: center;"><div class="text-center">จ่าย<br>Pay</div></th>
  					  <th style="vertical-align: middle; text-align: center;"><div class="text-center">ไม่จ่าย<br>Not Pay</div></th>
				    </tr>
				</thead>
				<tbody>
					<?php if(isset($report) AND empty($report)){?>
					<tr><td colspan="13" align="center">NO DATA</td></tr>
					<?php }else{ ?>
					<?php foreach($report as $num=>$result){?>
					<tr>
						<td align="center"><a id="<?php echo $result->user_leave;?>/<?php echo $result->department_ID;?>" onclick="run_report(this.id)"><?php echo $result->user_leave;?></a></td>
						<td align="center"><?php echo $result->department_Name;?></td>
						<td><?php echo $result->name_th." / ".$result->name_en;?></td>
						<td><?php echo $result->surname_th." / ".$result->surname_en;?></td>
						<td align="center"><?php  echo $result->casual_pay;?></td>
						<td align="center"><?php  echo $result->casual_unpay;?></td>
						<td align="center"><?php echo $result->sick_pay;?></td>
						<td align="center"><?php  echo $result->sick_unpay;?></td>
						<td align="center"><?php echo $result->annual;?></td>
						<td align="center"><?php echo $result->annual+$result->sick_pay+$result->sick_unpay+$result->casual_pay+$result->casual_unpay;?></td>
						<td align="center"><?php echo $result->leave_job;?></td>
						<td align="center"><?php echo $result->meeting_leave;?></td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
					<!-- <div class="panel-footer"></div> -->
				<!-- </div> -->
				<button type="button" class="clickdetail" data-toggle="modal" data-target="#leave_detail" style="display:none"></button>
        		<div class="modal fade"  id="leave_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
		          <div class="modal-dialog" role="document" >
		            <div class="modal-content">
		              <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="myModalLabel">Report Leave Detail : <p id="userdetail"></p></h4>
		              </div>
		              <div class="modal-body" style="position: relative; padding: 15px;">
		              <table id="dtable" align="center">
		            		<thead ></thead>
		            		<tbody align="center"></tbody>
		          	   </table>
		          	   </div>
		              <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <!-- <button type="button" class="btn btn-primary">Save</button> -->
		              </div>
		            </div>
		          </div>
        		</div>
			</div>
			
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		// $.fn.dataTableExt.sErrMode = 'throw';
	 //      $('.table').DataTable({
	 //          ordering: true,
	 //          lengthChange: true,
	 //          searching: true
	 //        });
	})
		function run_report (id) {
			var sub1 = id.indexOf("/");
			var user_id = id.substring(0,sub1);
			var depart = id.substring(sub1+1,id.length);
			var datefrom = $("#detail_date_from").val();
			var dateto = $("#detail_date_to").val();
			var usertype = $("#type_user").val();
			// alert(datefrom);
			$.ajax({
    		type: "POST",
    		dataType: "JSON",
    		url: "<?php echo base_url('index.php/leave_report/showdetail'); ?>",
    		data: {'user_id' : user_id,'depart' : depart,'datefrom' : datefrom,'dateto' : dateto,'usertype' : usertype},
   	 		success: function(data){
    		console.log(data);
    		var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('#dtable thead').empty();
        		 $('#dtable tbody').empty();
			}
      	var newth = "<tr><th>ลำดับ/NO</th><th>เรื่อง/Subject</th><th>รายละเอียด/Deatil</th><th>วันที่/Date</th><th>รวมวันลา/Total leave day</th></tr>";
          jQuery("#dtable thead").append(newth);
      	  $.each(data, function(i,val){
		  var no = i+1;
		  // var 	d = new date(val['leave_date']),
		   // var d = new Date,
		  var name = "Report Leave Detail : " + val['name_en']+"  "+val['surname_en'] +" / " +  val['name_th']+"  "+val['surname_th'] ;
		  // alert(name);
		  var datefrom = new Date(val['start_date']);
		  var dateto = new Date(val['end_date']);
		  var leave_f = datefrom.getDate() + '/' + (datefrom.getMonth() + 1) + '/' +  datefrom.getFullYear();
		  var leave_t = dateto.getDate() + '/' + (dateto.getMonth() + 1) + '/' +  dateto.getFullYear();
		  if(leave_f == leave_t){
		  		var newRowContent = "<tr><td>"+ no +"</td><td>"+ val['subject'] +"</td><td>"+ val['detail'] +"</td><td>" + leave_f + "</td><td>"+ val['total_date'] +"</td></tr>";
          jQuery("#dtable tbody").append(newRowContent);
		  }else{
		  		var newRowContent = "<tr><td>"+ no +"</td><td>"+ val['subject'] +"</td><td>"+ val['detail'] +"</td><td>" + leave_f + " - "+ leave_t + "</td><td>"+ val['total_date'] +"</td></tr>";
          jQuery("#dtable tbody").append(newRowContent);
		  }
          $("#myModalLabel").html(name);
		})
       $(".clickdetail").click();
       $.fn.dataTableExt.sErrMode = 'throw';
       $('#dtable').DataTable({
          ordering: true,
          lengthChange: true,
          searching: true
        });
}
  })
		}
	 </script>