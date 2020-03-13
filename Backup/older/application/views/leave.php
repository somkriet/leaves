<script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popover.js"></script>
<script src="<?php echo base_url();?>assets/js/tooltip.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		 var start_time = document.getElementsByName('start_time[]');
			  var end_time = document.getElementsByName('end_time[]');
			  var arr_length = start_time.length;
			  var total_date =0;
			   for(i = 0; i < start_time.length; i++){

			   	//var str = end_time[i].value.splitString(":",".");

			   	var sum_date=(parseFloat(end_time[i].value))-(parseFloat(start_time[i].value));
			   	//alert(start_time[i].value);
				if(start_time[i].value!="" && end_time[i].value!="")
				{
					if(sum_date == "9"){
	  				total_date+=1;
		  			}
		  			else
		  			{
		  			total_date+=0.5;	
		  			}
			
				}
					
	     			
    			}
			document.getElementById('total_sum_date').value=total_date; 
	});
		//**** List Leave (Start) ***//
		function ListLeave(SelectValue)
		{			
			frmMain.ddlLeave.length = 0
			var myOption = new Option('','')  
			//frmMain.ddlLeave.options[frmMain.ddlLeave.length]= myOption
			
			<?php
			$intRows = 0;
			$strSQL = "SELECT * FROM `leave_type` where delete_flag='0' ORDER BY leave_type_Name desc ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
				$intRows++;
				?>			
				x = <?php echo $intRows;?>;
				mySubList = new Array();
				
				strGroup = <?php echo $objResult["leave_group_ID"];?>;
				strValue = "<?php echo $objResult["leave_type_ID"];?>";
				strItem = "<?php echo $objResult["leave_type_Name"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])  
					frmMain.ddlLeave.options[frmMain.ddlLeave.length]= myOption					
				}
				<?php
			}
			?>	
			if (SelectValue == "4") {
				document.getElementById('Manual Promotion1').style.display="block";
			}
			else{
				document.getElementById('Manual Promotion1').style.display="none";
			}																
		}

		function ShowReg(op) {
			if (op == "1") {
				document.getElementById('payment').style.display="block";
			}
			else{
				document.getElementById('payment').style.display="none";
			}
		}
		function ShowInputFile(){
			var leave = document.getElementById("ddlLeave");
  			var leave_ID = leave.options[leave.selectedIndex].value;
  			if(leave_ID == "5"){
  				document.getElementById('doctor').style.display="block";
  			}
  			else{
  				document.getElementById('doctor').style.display="none";
  			}
		}
		$(document).ready(function(){

			$(".start_date").datepicker({
				dateFormat: 'yy-mm-dd',
				showButtonPanel: true,
				changeMonth: true,
				changeYear: true
			});   
			$('#start_time').timepicker();
			$('#end_time').timepicker();    
			$(".cloneTableRows").live('click', function(){
				var thisTableId = $(this).parents("table").attr("id");
				var lastRow = $('#'+thisTableId + " tr:last");
				var newRow = lastRow.clone(true);
				$('#'+thisTableId).append(newRow);
				$('#'+thisTableId + " tr:last td:last img").css("visibility", "visible");
				$('#'+thisTableId + " tr:last td :input").val('');
				$(newRow).find("input").each(function(){
					if($(this).hasClass("hasDatepicker")){ 
						var this_id = $(this).attr("id"); 
						var new_id = this_id +1;

						$(this).attr("id", new_id);
						$(this).removeClass('hasDatepicker');
						$(this).datepicker({
							dateFormat: 'yy-mm-dd',
							showButtonPanel: true,
							changeMonth: true,
							changeYear: true
						});
						$(this).timepicker();
					}
				});         
				return false;
			});

			$(".delRow").click(function(){
				$(this).parents("tr").remove();
				return false;
			});

		});

		function total_date(){
			  var start_time = document.getElementsByName('start_time[]');
			  var end_time = document.getElementsByName('end_time[]');
			  var arr_length = start_time.length;
			  var total_date =0;
			   for(i = 0; i < start_time.length; i++){

			   	//var str = end_time[i].value.splitString(":",".");

			   	var sum_date=(parseFloat(end_time[i].value))-(parseFloat(start_time[i].value));
			   	//alert(start_time[i].value);
				if(start_time[i].value!="" && end_time[i].value!="")
				{
					if(sum_date == "9"){
	  				total_date+=1;
		  			}
		  			else
		  			{
		  			total_date+=0.5;	
		  			}
			
				}
					
	     			
    			}
			document.getElementById('total_sum_date').value=total_date; 
		}

		function check_input() {
				if(document.frmMain.list.value == "")
				{
					alert('กรุณาเลือกรายการ / Request type');
					document.frmMain.list.focus();
					return false;
				}
				if(document.frmMain.ddlLeave.value == "")
				{
					alert('กรุณาเลือกประเภท / Leave type');
					document.frmMain.ddlLeave.focus();
					return false;
				}
				if (document.frmMain.ddlLeave.value ==5 ) {
					if(document.frmMain.userfile.value != "")
					{
						document.frmMain.chkfile.value = 1;
						document.frmMain.chkname.value = document.frmMain.userfile.value;
					}else if(confirm('  คุณไม่ต้องการแนบใบรับรองแพทย์ ใช่หรือไม่ ?  '))
						{
							return true;
							}else{
							return false;
						}
				}

/*			var max_start_date = document.getElementsByName('start_date[]').length;
			var start_date = document.getElementsByName('start_date[]');

				for (var i = 0; i < max_start_date; i++) {
					var start_date_check = Date.parse(start_date[i].value);
					if (isNaN(start_date_check)==true) {
						alert('กรุณากรอก วันที่ / Leave date ตำแหน่งที่ '+(i+1));
						return false;
					}
					start_date_check = "";
				}

			var max_start_time = document.getElementsByName('start_time[]').length;
			var start_time = document.getElementsByName('start_time[]');
		
				for (var i = 0; i < max_start_time; i++) {
					var start_time_check = start_time[i].value;
					if (start_time_check=="") {
						alert('กรุณากรอก *เริ่มเวลา / Start time ตำแหน่งที่ '+(i+1));
						return false;
					}
					start_time_check = "";
				}

			var max_end_time = document.getElementsByName('end_time[]').length;
			var end_time = document.getElementsByName('end_time[]');
		
				for (var i = 0; i < max_end_time; i++) {
					var end_time_check = end_time[i].value;
					if (end_time_check=="") {
						alert('กรุณากรอก *ถึงเวลา / End time ตำแหน่งที่ '+(i+1));
						return false;
					}
					start_time_check = "";
				}*/


			var text_input_subject = document.getElementById('subject').value;
			var length_text_subject= $.trim(text_input_subject).length;

				if(length_text_subject<=5) {
				alert("กรุณากรอกข้อมูลเพิ่มเติม เรื่อง / Description") ;
				document.getElementById('subject').focus();
				return false ;
				}

			var text_input_detail = document.getElementById('detail').value;
			var length_text_detail= $.trim(text_input_detail).length;

				if(length_text_detail<=5) {
				alert("กรุณากรอกข้อมูลเพิ่มเติม รายละเอียด / Reasons") ;
				document.getElementById('detail').focus();
				return false ;
				}
				
			}


</script>
<div class="container">
	<?php if($status==1){?>
	<div class="alert alert-block alert-success fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>ดำเนินการเสร็จสิ้น / Complete</h4>
		<p>คุณได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว.</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==4){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>ลาพักร้อน,ลาบวช,ลาคลอด,ลากิจ(ล่วงหน้า) จะไม่สามารถเลือกวันย้อนหลังได้ หรือ เวลาในการลาไม่ถูกต้อง</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==5){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>ลากิจ(ย้อนหลัง),ลาป่วย จะไม่สามารถเลือกวันล่วงหน้าได้ หรือ เวลาในการลาไม่ถูกต้อง</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==6){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>สิทธิ์ในการลาพักร้อนของท่านหมดแล้ว</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==7){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>วัน หรือ เวลา ในการลาไม่ถูกต้อง </p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==9){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>วันเดือนปีที่มีการกรอก มีการใช้งานแล้ว</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==10){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>เวลาที่ทำการลาจะต้องไม่ทับซ้อนกัน</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==11){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด / Error</h4>
		<p>ผู้ใช้นี้ยังไม่ได้คำนวณสิทธิ์</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==12){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด/ Error</h4>
		<p>ไฟล์ต้องเป็น PDF เท่านั้น หรือขนาดเกิน 1 Mb /  PDF File Only or over size 1 Mb.</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==13){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด/ Error</h4>
		<p>ไม่สามารถลาข้ามเดือน ระหว่าง มกราคม-มีนาคม  และ กุมภาพันธ์-ธันวาคม</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<?php if($status==14){?>
	<div class="alert alert-block alert-danger fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4>เกิดข้อผิดพลาด/ Error</h4>
		<p>ไม่สามารถลาข้ามปีได้</p>
		<p>
			<a href="<?php echo base_url().index_page();?>/home/index" class="btn btn-success">กลับหน้าแรก</a>
		</p>
	</div>
	<?php }?>
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก</a> / กรอกใบลา</h5>
		</div>
	</div>
	<div class="bs-leave">

		<div class="space-top"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-10">
						<form name="frmMain" id="frmMain" method="post" action="<?php echo base_url().index_page();?>/leave/add_leave_result"  accept-charset="utf-8" enctype="multipart/form-data" onSubmit="JavaScript:return check_input(); ">
							<div class="row">
								<?php if($user['user_type_ID']==0 or $user['user_type_ID']==5){?>
								<div class="col-md-6">
									<strong>*ลาให้กับ / Employee :</strong>
									<select name="user_leave" class="form-control">
										<option value="<?php echo $user_by_session[0]->user_ID;?>"><?php echo $user_by_session[0]->user_ID;?> : <?php echo $user_by_session[0]->name_th;?>  <?php echo $user_by_session[0]->surname_th;?> / <?php echo $user_by_session[0]->name_en;?>  <?php echo $user_by_session[0]->surname_en;?></option>
										<?php foreach($user_by_department as $row){?>
										<option value="<?php echo $row->user_ID?>"><?php echo $row->user_ID?> : <?php echo $row->name_th;?> <?php echo $row->surname_th;?> / <?php echo $row->name_en;?> <?php echo $row->surname_en;?></option>
										<?php }?>
									</select>
								</div>
								<?php }else {?> 
								<input type="hidden" name="user_leave" value="<?php echo $user['user_ID'];?>">
								<?php }?>
								<div class="col-md-6">
									<strong>*เลือกรายการ / Request type : </strong>
									<select id="list" name="list" onChange = "ListLeave(this.value)" class="form-control">
										<option selected value=""></option>
										<?php
										$strSQL = "SELECT * FROM `leave_group` where delete_flag='0' ORDER BY leave_group_ID ASC ";
										$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
										while($objResult = mysql_fetch_array($objQuery))
										{
											?>
											<option value="<?php echo $objResult["leave_group_ID"];?>"><?php echo $objResult["leave_group_Name"];?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<strong>*เลือกประเภท / Leave type :</strong>
									<select id="ddlLeave" name="ddlLeave" class="form-control" onChange = "ShowInputFile()"></select>
								</div>

							</div>
							<div class="space-top"></div>
							<div class="row">
								<div class="col-md-12">
									<table  id="table2" class="table table-bordered table-condensed">
										<tr>

											<th>*วันที่ / Leave date</th>
											<th>*เริ่มเวลา / Start time</th>
											<th>*ถึงเวลา / End time</th>
											<th><p class="text-center"><img src="<?php echo base_url();?>assets/img/add.png" class="cloneTableRows" /></p></th>
										</tr>

										<tr>

											<td>
												<p>
													<input type="text" name="start_date[]" class="start_date form-control" placeholder=""  Request/>
												</p>
											</td>
											<td>
												<p>
													<select name="start_time[]" class="form-control" onchange='total_date()'  Request>
														<!-- <option value="">กรุณาเลือก</option> -->
														<?php foreach($time as $rows){?>
														<option><?php echo $rows;?></option>
														<?php }?>
													</select>
												</p>
											</td>
											<td>
												<select name="end_time[]" class="form-control" onchange='total_date()'  Request>
												<!-- 	<option value="">กรุณาเลือก</option> -->
													<?php foreach($time_end as $rows){?>
													<option><?php echo $rows;?></option>
													<?php }?>
												</select>
											</td>
											<td><p class="text-center"><img src="<?php echo base_url();?>assets/img/del.png" alt="" class="delRow" style="visibility: hidden;" /></p></td>
										</tr>
									</table>
									<div class="text-right ">
										รวม / Total <input type="text" name="total_sum_date" id="total_sum_date" placeholder="" size="2" disabled/> วัน / Day
									</div>
								</div>

							</div>
							<div class="space-top"></div>
							<div class="row" id="Manual Promotion1" style="display:none">
								<div class="col-md-6" >
									<strong>เดินทางโดย :</strong>
									<select name="progression" class="form-control">
										<option value=""></option>
										<?php foreach($progression_all as $progression){?>
										<option value="<?php echo $progression->progression_ID;?>"><?php echo $progression->progression_Name;?></option>
										<?php }?>
									</select>
								</div>
								<div class="col-md-3">
									<strong>ค่าใช้จ่าย :</strong>
									<select name="pay" class="form-control" onchange="ShowReg(this.selectedIndex)">
										<option value="0">ไม่มีค่าใช้จ่าย</option>
										<option value="1">มีค่าใช้จ่าย</option>
									</select>
								</div>
								<div class="col-md-3" id="payment" style="display:none">
									<strong>จำนวนเงิน :</strong>
									<input type="text" name="costs" class="form-control">
								</div>
							</div>
							<div class="space-top"></div>
							<div class="row">
								<div class="col-md-6">
									<strong>*เรื่อง / Description :</strong>
									<input class="form-control" type="text" name="subject" id='subject'>
								</div> 
								<div class="col-md-6">
									<strong>*รายละเอียด / Reasons :</strong>
									<textarea class="form-control" rows="3" name="detail" id='detail'></textarea>
								</div>
							</div>
							<div class="top-space">
								<div class="row" id="doctor" style="display:none">
									<div class="col-md-6">
										<strong>ใบรับรองแพทย์ / Medical certificate:</strong>
										<input type="hidden" name="chkfile" value="0">
										<input type="hidden" name="chkname" value="">
										<h5>ต้องเป็นไฟล์ PDF เท่านั้น / PDF File Only </h5>
										<input type="file" id="userfile" name="userfile" class="form-control" >
									</div>
								</div>
							</div>
							<div class="space-top"></div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-lg btn-block btn-success" type="submit" />SAVE</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-2">
						<div class="alert alert-block alert-warning fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4>Please below for your advantage!</h4>
							<p>Rate for leaves time calculate,this system calculate by first part of day (8.30-12.00) and second part of day (13.00-17.00).so this system isn't calculate by hours.</p>
							<!-- <h4>โปรดอ่านตรงนี้สักนิด เพื่อประโยชน์ของท่าน!</h4>
							<p>เกณฑ์ในการคิดชั่วโมงการลา จะคิดที่ครึ่งวันเช้า (08.30-12.00) และบ่าย (13.00-17.30) ระบบจะไม่คิดการลาเป็นชั่วโมง.</p>
							 <p>
								<a data-toggle="modal" href="#myModal" class="btn btn-warning">รายละเอียด</a>
							</p>  -->
						</div>
						<div class="alert alert-block alert-warning fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4>LEAVE REGULATION</h4>
							<!-- <p>Annual Leave</p>
							<p>Sick Leave</p>
							<p>Private Leave</p> -->

							<a  id="example"  data-container="body" data-toggle="popover" data-placement="left" data-content="Annnual Leave ลาพักร้อน ไม่ตัดคะแนน">
							  Annual Leave
							</a>
							<br>
							<a  id="example1"  data-container="body" data-toggle="popover" data-placement="left" data-content="Sick Leave 1 Day (Without Medical Certificate) / ป่วย 1 วัน (ไม่มีใบรับรองแพทย์)  -0.50 คะแนน">
							  Sick Leave
							</a>
							<br>
							<a  id="example2"  data-container="body" data-toggle="popover" data-placement="left" data-content="พนักงานสามารถลากิจได้ 10 วันใน 1 ปี ตามระเบียบข้อบังคับการทำงานของบริษัท  Private Leave (Peronal) ลากิจธุระส่วนตัว หักเงินเดือน ไม่หักคะแนน ">
							  Private Leave
							</a>

							<p>
								<a href="<?php echo base_url().index_page();?>/leave/leave_regulation" class="btn btn-info">Other</a>
							</p>
							<!-- <h4>โปรดอ่านตรงนี้สักนิด เพื่อประโยชน์ของท่าน!</h4>
							<p>เกณฑ์ในการคิดชั่วโมงการลา จะคิดที่ครึ่งวันเช้า (08.30-12.00) และบ่าย (13.00-17.30) ระบบจะไม่คิดการลาเป็นชั่วโมง.</p>
							 <p>
								<a data-toggle="modal" href="#myModal" class="btn btn-warning">รายละเอียด</a>
							</p>  -->
						</div>

						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


      <script>
      $(function (){
         $("#example").popover();
      });
        $(function (){
         $("#example1").popover();
      });
          $(function (){
         $("#example2").popover();
      });
      </script>
