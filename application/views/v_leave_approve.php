	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<link href='<?php echo base_url();?>assets/css/loading.css' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
	#overlay {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 200%;
	}
	.modal-dialog{
		margin: 50px;
		margin-left: 150px;
		margin-right: 150px;
		width: auto;
		height: auto;
		max-height: 100%;
	}
	textarea { /*resize: vertical;*/ resize: none; }
	a:hover {cursor:pointer;}
	</style>
	<div class="row"></br></br></br></div>
	<div id="overlay" ><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">S</div><div id="fountainTextG_2" class="fountainTextG">a</div><div id="fountainTextG_3" class="fountainTextG">v</div><div id="fountainTextG_4" class="fountainTextG">i</div><div id="fountainTextG_5" class="fountainTextG">n</div><div id="fountainTextG_6" class="fountainTextG">g</div></div>
	</div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading "> <label class="glyphicon glyphicon-search"> ยืนยันการลา / Leave Approve </label></div>
			<div class="panel-body">
				<input type="hidden" name="typeuser" id="typeuser" value="<?php echo (isset($type) AND !empty($type))? $type:'' ?>">
				<div class="row">
					
				</div>
				</br>
						<div class=".col-xs-6 .col-md-4" >
							<table id="stable" class="table table-condensed table-hover table-bordered .col-xs-6 .col-md-4">
							<?php if(!empty($leave_approve_detail) AND isset($leave_approve_detail)){?>
							<p align="center"><a id="pay" class="a_demo_four" onclick="approve_pay_all()">APPROVE WITH PAY ALL</a>
							   <a id="unpay" class="a_demo_four1" onclick="approve_unpay_all()">APPROVE WITH UN PAY ALL</a>
							    <!-- <a id="unpay" class="a_demo_four1" onclick="test()">test</a> -->
							<?php if($type == 1){ ?>
							   <a id="noapp" class="a_demo_four2" onclick="no_approve_all()">NO APPROVE FOR LEAVE ALL</a></p>
							<?php } ?>
							<br>
							<?php } ?>
 								<thead>
									<tr class="info">
										<th><center>เลือก<BR>Select<input type="checkbox" id="chkall"/></center></th>
										<th><center>รหัสการลา<BR>Leave ID</center></th>
										<th><center>รหัสพนักงาน<BR>User ID</center></th>
										<th><center>ชื่อ-นามสกุล<BR>Name-Surname</center></th>
										<th><center>รายการ<BR>Request Type</center></th>
										<th><center>ประเภทการลา<BR>Leave Type</center></th>
										<th><center>วันที่ลา<BR>Leave Date</center></th>
										<th><center>ทำรายการโดย<BR>Transaction By</center></th>
										<th><center>เมื่อวันที่<BR>Transaction Date</center></th>
										<th><center>สถานะ<BR>Status</center></th>
										<?php if($type==1):?>
										<th><center>ค้นหา<br>Search</center></th>
										<?php endif;?>
									</tr>
								</thead>
				<tbody>

					 <?php if(empty($leave_approve_detail) AND isset($leave_approve_detail)){?>
					 					<tr><td colspan="11" align="center">NO DATA</td></tr>
                            			<?php }else{?>
										<?php foreach($leave_approve_detail as $num=>$val):?>
											<?php //echo "<pre>"; print_r($leave_approve_detail); echo "</pre>"; exit();?>
										<tr class="active">
											<input type="checkbox" id="chk_<?php echo $val->leave_ID; ?><?php echo $val->type_mgr?>" name="checkbox2" class="checkbox2" style="display: none"/>
											<!-- style="display: none" -->
											<td><center><input type="checkbox" id="<?php echo $val->leave_ID; ?><?php echo $val->type_mgr?>" class="checkbox1" onclick="clickchk(this.id)"/></center></td>
											<td>
											<center>
											<a onclick="send_leave_id('<?php echo $val->leave_ID;?>','<?php echo $val->user_leave;?>','<?php echo $val->name_th;?>','<?php echo $val->surname_th;?>','<?php echo $val->name_en;?>','<?php echo $val->surname_en;?>','<?php echo $val->subject;?>')"><?php echo $val->leave_ID ?></a>
											</center>
											</td>
											<td><center><?php echo $val->user_leave ?></center></td>
											<td><center><?php echo $val->name_th." ".$val->surname_th." / ".$val->name_en." ".$val->surname_en ?></center></td>
											<td><center><?php echo $val->leave_group_Name ?></center></td>
											<td><center><?php echo $val->leave_type_Name ?></center><br> <!--."<a href="" data-toggle="modal" data-target="#myModal<?php //echo $num+1;?>"> </a>/ ".$row->leave_group_name  -->
											    <?php if($val->leave_attached != "" AND $val->leave_attached != 0 AND $val->leave_type_ID != "5"){?> 
														<a href="<?php echo base_url('assets/upload/')."/".$val->leave_attached;?>" style="color:green" target="_blank">ไฟล์แนบ</a> 
												<?php }else if($val->leave_attached != "" AND $val->leave_attached != 0 AND $val->leave_type_ID == "5"){ ?>
														<a href="<?php echo base_url('assets/upload/')."/".$val->leave_attached;?>" style="color:green" target="_blank">มีใบรับรองแพทย์</a> 
												<?php }else if(($val->leave_attached == "" OR $val->leave_attached == 0) AND $val->leave_type_ID == "5"){ ?>
														<a style="color:red" id="<?php echo $val->leave_ID;?>" onclick="sendleaveid(this.id)">ไม่มีใบรับรองแพทย์</a> 
												<?php } ?>
											</td>
											<td><center><?php echo ($val->start_date == $val->end_date)? date("d/m/Y",strtotime($val->start_date)):date("d/m/Y",strtotime($val->start_date))." - ".date("d/m/Y",strtotime($val->end_date)) ?></center></td>
											<td><center><?php echo $val->active_name_th." ".$val->active_surname_th." / ".$val->active_name_en." ".$val->active_surname_en ?></center></td>
											<td><center><?php echo date("d/m/Y",strtotime($val->active_date));  ?></center></td>
											<td>
												<div class="row">
													<div class="col-md-12">
														<p><a id="p_<?php echo $val->leave_ID?>" class="btn btn-success btn-xs" onclick="approve_pay(this.id,'<?php echo $val->type_mgr?>')">Approve with PAY</a></p>
														<p><a id="u_<?php echo $val->leave_ID?>" class="btn btn-warning btn-xs" onclick="approve_unpay(this.id,'<?php echo $val->type_mgr?>')">Approve with un PAY</a></p>
														<?php if($type == 1){ ?>
														<p><a id="n_<?php echo $val->leave_ID?>" class="btn btn-danger btn-xs" onclick="no_approve(this.id,'<?php echo $val->type_mgr?>')">No Approve for leave</a></p>
														<?php } ?>
													</div>
												</div>
											</td>
											<?php if($type==1):?>
											<td>
												<?php if(!empty($val->search)):?>
												<a href="#" onclick="showdupp('<?php echo $val->leave_ID;?>')" class="btn btn-info btn-xs">รายชื่อพนักงาน<br>ที่ลาช่วงเดียวกัน</a>
												<!-- <button type="button" class="btn_show_dupp btn btn-info btn-xs" data-toggle="modal" data-target="#leave_dupp" style="display: none;">รายชื่อพนักงาน<br>ที่ลาช่วงเดียวกัน</button> -->
												<?php endif;?>
											</td>
											<?php endif;?>
										</tr>
					<?php endforeach; }?>
							</tbody>
					</table>
				</div>
				<!-- Modal -->
				<button type="button" class="clickdetail" data-toggle="modal" data-target="#leave_detail" style="display:none"></button>
				<button type="button" class="btn_show_dupp btn btn-info btn-xs" data-toggle="modal" data-target="#leave_dupp" style="display:none"></button>
			    <div class="modal fade" id="leave_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			      <div class="modal-dialog" role="document" >
			        <div class="modal-content" style="/*width:800px;*/">
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			            <h4 class="modal-title" id="myModalLabel">Leave Detail</h4>
			          </div>
			          <div class="modal-body" style="position: relative; padding: 15px;">
			          <h4 class="userleave" align="center"> </h4>
			          <!-- <h5 class="numleave"> </h5> -->
			          <table id="detail_table" class="table table-condensed table-hover">
							
			          </table><br>
			          <table id="dtable" class="table table-condensed table-hover table-bordered">
			        		<thead align="center"></thead>
			        		<tbody align="center"></tbody>
			      	   </table>
			      	   <table id="atable">
		            		<thead align="center"></thead>
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

				<div class="modal fade" id="leave_dupp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document" >
						<div class="modal-content" style="/*width:800px;*/">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">รายชื่อพนักงานที่ลาช่วงเดียวกัน</h4>
							</div>
							<div class="modal-body" style="position: relative; padding: 15px;">
								<h4 class="userleave" align="center"></h4>
								<table id="detail_table" class="table table-condensed table-hover table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">รหัสการลา</th>
											<th style="text-align: center;">รหัสพนักงาน</th>
											<th style="text-align: center;">ชื่อ-นามสกุล</th>
											<th style="text-align: center;">รายการ</th>
											<th style="text-align: center;">ประเภท</th>
											<th style="text-align: center;">วันที่ลา</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<nav align="center">
									<ul class="pagination" id="page_detail">
									</ul>
								</nav>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="panel-footer"></div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#overlay").hide();
		$('#chkall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });

// $.fn.dataTableExt.sErrMode = 'throw';
         var table = $('#stable').DataTable({
          ordering: false,
          lengthChange: true,
          searching: true
        });
 $('#chkall').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#stable tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#chkall').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

	})
	function clickchk(cid){

		if ($('#'+cid).is(':checked')) {
			// alert(cid);
			$('#chk_'+cid).prop('checked',true);
		}else{
			// alert("5555");
			$('#chk_'+cid).prop('checked',false);
		}
	}
	function showdupp(leave_ID){
		$('#detail_table tbody').empty();
		// var table = $('#detail_table').DataTable();
		// table.destroy();
		// theTable.api().clear();
		if(leave_ID != ""){
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "<?php echo base_url('index.php/leave_approve/get_leave_dupp');?>",
				data: { 'leave_ID': leave_ID },
				success: function(res){
					if(res != ""){
						$.each(res, function(i,val){
							var start_date = change_format(val['start_date']);
							var end_date = change_format(val['end_date']);
							if(val['start_date'] == val['end_date']){
								var dateleave = start_date;
							}else{
								var dateleave = start_date+'</br>ถึงวันที่</br>'+end_date;
							}
							var page='inPage inPage'+Math.ceil((i+1)/5);
							// console.log(page);
							// var data = [val['leave_ID'],val['user_leave'],val['name_th']+' '+val['surname_th'],val['leave_group_Name'],val['leave_type_Name'],dateleave]
							$('#detail_table tbody').append('<tr class="'+page+'">'
																+'<td align="center">'+val['leave_ID']+'</td>'
																+'<td align="center">'+val['user_leave']+'</td>'
																+'<td>'+val['name_th']+' '+val['surname_th']+'</td>'
																+'<td>'+val['leave_group_Name']+'</td>'
																+'<td>'+val['leave_type_Name']+'</td>'
																+'<td align="center">'+dateleave+'</td>'
															+'</tr>');
							// theTable.api().row.add(data).draw();

							// $('.btn_show_dupp').click();
						});

						$('.btn_show_dupp').click();

						change_page(1);

						// $.fn.dataTableExt.sErrMode = 'throw';
						// $('#detail_table').DataTable({
						// 	ordering: false,
						// 	lengthChange: true,
						// 	searching: true
						// });
					}
				}
			});
		}
		return false;
	}

	function change_page(page){
		var rowCount = $('#detail_table tbody tr').length;
		var totalPage = Math.ceil(rowCount/5);
		if(page == 99){
			page = totalPage;
		}
		$('.inPage').css('display','none');
		$('.inPage'+page).css('display','');

		$('#page_detail').empty();

		if(totalPage > 5){
			var mip = page-3;
			if(mip < 0){
				mip = 0;
			}
			var map = mip+5;
			if(map > totalPage){
				map = totalPage;
			}
			mip = map-5;
		}else{
			var mip = 0
			var map = totalPage;
		}

		$('#page_detail').append('<li><a href="#" onclick="change_page(1);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
		for(var i=mip; i<map; i++){
			var p = parseInt(i)+1;
			if(p == page){
				var c = 'class="active"';
			}else{
				var c = "";
			}
			$('#page_detail').append('<li '+c+'><a href="#" onclick="change_page('+p+');">'+p+'</a></li>');
		}
		$('#page_detail').append('<li><a href="#" onclick="change_page(99);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
		// console.log(page);
	}

	function change_format(dates){
		var date = new Date(dates);
		var day = date.getDate();
		if(day < 10){
			var days = '0'+day;
		}else{
			var days = day;
		}
		var month = date.getMonth()+1;
		if(month<10){
			var months = '0'+month;
		}else{
			var months = month;
		}
		var year = date.getFullYear();

		return days+'/'+months+'/'+year;
	}
	// $('.btn_show_dupp').on('click', function(){
	// 	// $('#leave_dupp').show();
	// });

	function send_leave_id(id,user_leave,name_th,surname_th,name_en,surname_en,subject){
		// alert(id);
	// var leaveid = id.indexOf("/");
	// var leave_id = id.substring(0,leaveid);
	// var subuserid = id.indexOf("^");
	// var userid = id.substring(leaveid+1,subuserid);
	// var name = id.substring(subuserid+1,id.length);
	// alert(name);
	// return false;

	$('#detail_table').empty();

	$('#detail_table').append('<tr><td width="30%">หมายเลขการลา / Leave ID :</td><td width="70%">'+id+'</td></tr>');
	$('#detail_table').append('<tr><td width="30%">เรื่อง / Subject :</td><td width="70%">'+subject+'</td></tr>');
	// $('#detail_table').append('<tr><td width="30%">รายละเอียด / Detail :</td><td width="70%"></td></tr>');

  	$.ajax({
    type: "POST",
    dataType: "JSON",
    url: "<?php echo base_url('index.php/leave_approve/showdetail'); ?>",
    data: {'userid' : user_leave,'leave_id':id},
    success: function(data){
    // console.log(data['detail1']);
    $('#detail_table').append('<tr><td width="30%">รายละเอียด / Detail :</td><td width="70%">'+data['detail2'][0]['detail']+'</td></tr>');
    var rowCount = $('#dtable tr').length;
    var srowCount = $('#atable tr').length;
	if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('#dtable thead').empty();
        		 $('#dtable tbody').empty();
	}
	if(srowCount > 0){
				var atable = $('#atable').DataTable();
				 atable.destroy();
				 $('#atable thead').empty();
        		 $('#atable tbody').empty();
	}
      var newth = "<tr><th><center>การลา<br>Leave Type</center></th><th><center>สิทธิ์ที่มีอยู่<br>Maximum allowed</center></th><th><center>สิทธิ์เก่ายกมา<br>Oldremanning leaves</center></th><th><center>สิทธิ์เก่าใช้ไป<br>Old leaves already taken</center></th><th><center>สิทธิ์ใหม่ใช้ไป<br>New leaves already taken</center></th><th><center>หมายเหตุ<br>Remark</center></th></tr>";
          jQuery("#dtable thead").append(newth);
      	  $.each(data['detail1'], function(i,val){
		// //   var no = i+1;
		// //   // var 	d = new date(val['leave_date']),
		// //    // var d = new Date,
		// //   var date = new Date(val['leave_date']);
		// //   var dateleave = date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
      
          var newRowContent = "<tr><td>"+ val['leave_type'] +"</td><td>"+ val['annual_new'] +"</td><td>" + val['annual_old'] + "</td><td>" + val['annual_old_use'] + "</td><td>" + val['annual_new_use'] + 
                              "</td><td>"+val['total_leave']+" วัน/Day</td></tr>";
          jQuery("#dtable tbody").append(newRowContent);
          $(".userleave").html("ข้อมูลการลาของ " + name);
          // $(".numleave").html("หมายเลขการลา :" + leave_id);

		})
          var dnewth = "<tr><th>ลำดับ/NO</th><th>วันที่/Date</th><th>ตั้งแต่เวลา / Start time</th><th>ถึงเวลา / End Time</th></tr>";
          jQuery("#atable thead").append(dnewth);
      	  $.each(data['detail2'], function(i,val){
		  var no = i+1;
		  // var 	d = new date(val['leave_date']),
		   // var d = new Date,
		  var date = new Date(val['leave_date']);
		  var dateleave = date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
          var dnewRowContent = "<tr><td>"+ no +"</td><td>" + dateleave + "</td><td>" + val['start_time'] + "</td><td>" + val['end_time'] + 
                              "</td></tr>";
          jQuery("#atable tbody").append(dnewRowContent);
      })
  		$('#atable').DataTable({
          ordering: true,
          lengthChange: true,
          searching: true
        });
        $(".clickdetail").click(); 
	}
	
  })

  }
  	function approve_pay(id,type_mgr){
  		var subid = id.substring(2,id.length);
  		var type = $("#typeuser").val();
  		var approve_type = "";
  		if(type_mgr == 1){
  			approve_type = "1";
  			// alert('type1'+approve_type);
  		}else{
  			approve_type = "6";
  			// alert('type2'+approve_type);
  		}
  		var r = confirm("Are you sure to Approve With Pay?");
    	if (r == true){
    	$("#overlay").show();
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/approve_pay');?>",
  			data : {'leave_id' : subid, 'type':type, 'approve_type':approve_type,'type_mgr':type_mgr},
  			success: function(data){
  				console.log(data);
  				$("#overlay").hide();
  				location.reload();
  			}
  		})
  		}else{
  			console.log("ยกเลิก");
  			return false;
  		}
	}
	function approve_unpay(id,type_mgr){
  		var subid = id.substring(2,id.length);
  		var type = $("#typeuser").val();
  		var approve_type = "";
  		if(type_mgr == 1){
  			approve_type = "2";
  		}else{
  			approve_type = "7";
  		}
  		// alert(type);
  		var r = confirm("Are you sure to Approve With Un Pay?");
    	if (r == true){
    	$("#overlay").show();
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/approve_unpay');?>",
  			data : {'leave_id' : subid, 'type':type, 'approve_type':approve_type, 'type_mgr':type_mgr},
  			success: function(data){
  				console.log(data);
  				$("#overlay").hide();
  				location.reload();
  			}
  		})
  		}else{
  			console.log("ยกเลิก");
  			return false;
  		}
	}
	function no_approve(id,type_mgr){
		var subid = id.substring(2,id.length);
		var type = $("#typeuser").val();
		var r = confirm("Are you sure to No Apporove For Leave");
		if(r == true){
		$("#overlay").show();
		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/no_approve');?>",
  			data : {'leave_id' : subid, 'type':type, 'type_mgr':type_mgr},
  			success: function(data){
  				console.log(data);
  				$("#overlay").hide();
  				location.reload();
  			}
  		})
	}else{
		console.log("ยกเลิก");
		return false;
	}
	}
 //  	function approve_pay_all(){
 //  		var type = $("#typeuser").val();
 //  		var num = 1;
 //  		var r = confirm("Are you sure to Approve With Pay All?");
 //    	if (r == true){
 //    	$("#overlay").show();
 //        var total = $('input[name=checkbox2]:checked').length;
 //    	$('input[name=checkbox2]:checked').each(function() {
 //    	var type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
 //    	var approve_type = "";
 //    	if(type_mgr == 1){
 //  			approve_type = "1";
 //  		}else{
 //  			approve_type = "6";
 //  		}
 //  		$.ajax({
 //  			type : "POST",
 //  			dataType : "JSON",
 //  			url : "<?php echo base_url('index.php/leave_approve/approve_pay_all');?>",
 //  			data : {'leave_id' : $(this).attr('id').substring(4,17), 'type':type, 'num':num, 'type_mgr':type_mgr, 'approve_type':approve_type},
 //  			async:false,
 //  			// cache: false,/
 //  			success: function(data){
 //  				console.log(data);
 //  				if(total == data){
	//   				$("#overlay").hide();
	//   				location.reload();
 //  				}
 //  			}
 //  		})
 //  		num = num + 1;
 //  		});
 //  		}else{
 //  			console.log("ยกเลิก");
 //  			return false;
 //  		}
	// }
	// function approve_unpay_all(){
 //  		var num = 1;
 //  		var type = $("#typeuser").val();
 //  		var r = confirm("Are you sure to Approve With Un Pay All?");
 //    	if (r == true){
	// 	$("#overlay").show();
 //        var total = $('input[name=checkbox2]:checked').length;
 //    	$('input[name=checkbox2]:checked').each(function() {
 //    	var type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
 //    	var approve_type = "";
 //    	if(type_mgr == 1){
 //  			approve_type = "2";
 //  		}else{
 //  			approve_type = "7";
 //  		}
 //  		$.ajax({
 //  			type : "POST",
 //  			dataType : "JSON",
 //  			url : "<?php echo base_url('index.php/leave_approve/approve_unpay_all');?>",
 //  			data : {'leave_id' : $(this).attr('id').substring(4,17), 'type':type, 'num':num, 'type_mgr':type_mgr, 'approve_type':approve_type},
 //  			async:false,
 //  			success: function(data){
 //  				console.log(data);
 //  				if(total == data){
	//   				$("#overlay").hide();
	//   				location.reload();
 //  				}
 //  			}
 //  		})
 //  		num = num + 1;
 //  		});
 //  		}else{
 //  			console.log("ยกเลิก");
 //  			return false;
 //  		}
	// }
	// function no_approve_all(){
	// 	// var subid = id.substring(2,id.length);
	// 	var type = $("#typeuser").val();
	// 	var num = 1;
	// 	// var total = $('input[name=checkbox2]:checked').length;
	// 	var r = confirm("Are you sure to No Apporove For Leave All");
	// 	if(r == true){
	// 	// $('.checkbox2').each(function() { //loop through each checkbox
 //  //               this.checked = true;  //select all checkboxes with class "checkbox1"               
 //  //       });
 //  		$("#overlay").show();
 //        var total = $('input[name=checkbox2]:checked').length;
		
	// 	$('input[name=checkbox2]:checked').each(function() {
	// 	$.ajax({
 //  			type : "POST",
 //  			dataType : "JSON",
 //  			url : "<?php echo base_url('index.php/leave_approve/no_approve_all');?>",
 //  			data : {'leave_id' : $(this).attr('id').substring(4,$(this).attr('id').length), 'type':type, 'num':num},
 //  			async:false,
 //  			success: function(data){
 //  				console.log(data);
 //  				if(total == data){
	//   				$("#overlay").hide();
	//   				location.reload();
 //  				}
  				
 //  			}
 //  		})
 //  		num = num + 1;
 //  		});
	// }else{
	// 	console.log("ยกเลิก");
	// 	return false;
	// }
	// }
	function approve_pay_all(){
		// alert($('input[name=checkbox2]:checked').length);
		var countchk = $('input[name=checkbox2]:checked').length;
		if(countchk <= 0){
			alert("Please Select Checkbox !!");
			return false;
		}
  		var type = $("#typeuser").val();
  		var num = 1;
  		var r = confirm("Are you sure to Approve With Pay All?");
    	var type_mgr = "";
    	if (r == true){
    	$("#overlay").show();
    	var leaveid = [];
    	$('input[name=checkbox2]:checked').each(function() {
    	if(num == 1){
    		type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
    	}
  		leaveid.push($(this).attr('id').substring(4,17));
  		num = num+1;
  		});
  		var approve_type = "";
    	if(type_mgr == 1){
  			approve_type = "1";
  		}else{
  			approve_type = "6";
  		}
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/approve_pay_all');?>",
  			data : {'leave_id' : leaveid, 'type':type, 'type_mgr':type_mgr, 'approve_type':approve_type},
  			// async:false,
  			success: function(data){
  				console.log(data);
  				if(data == "success"){
	  				$("#overlay").hide();
	  				location.reload();
  				}
  			}
  		})
  		}else{
  			console.log("ยกเลิก");
  			return false;
  		}
	}
	function approve_unpay_all(){
		var countchk = $('input[name=checkbox2]:checked').length;
		if(countchk <= 0){
			alert("Please Select Checkbox !!");
			return false;
		}
  		var num = 1;
  		var type = $("#typeuser").val();
  		var r = confirm("Are you sure to Approve With Un Pay All?");
    	var type_mgr = "";
    	if (r == true){
    	$("#overlay").show();
    	var leaveid = [];
        // var total = $('input[name=checkbox2]:checked').length;
    	$('input[name=checkbox2]:checked').each(function() {
    	if(num == 1){
    		type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
    	}
  		leaveid.push($(this).attr('id').substring(4,17));
  		num = num+1;
  		});
  		var approve_type = "";
    	if(type_mgr == 1){
  			approve_type = "2";
  		}else{
  			approve_type = "7";
  		}
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/approve_unpay_all');?>",
  			data : {'leave_id' : leaveid, 'type':type, 'num':num, 'type_mgr':type_mgr, 'approve_type':approve_type},
  			// async:false,
  			success: function(data){
  				console.log(data);
  				if(data == "success"){
	  				$("#overlay").hide();
	  				location.reload();
  				}
  			}
  		})
  		}else{
  			console.log("ยกเลิก");
  			return false;
  		}
	}
	function no_approve_all(){
		var countchk = $('input[name=checkbox2]:checked').length;
		if(countchk <= 0){
			alert("Please Select Checkbox !!");
			return false;
		}
		var type = $("#typeuser").val();
		var num = 1;
		var r = confirm("Are you sure to No Apporove For Leave All");
		var type_mgr = "";
    	if (r == true){
    	$("#overlay").show();
    	var leaveid = [];
		$('input[name=checkbox2]:checked').each(function() {
		if(num == 1){
    		type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
    	}
  		leaveid.push($(this).attr('id').substring(4,17));
  		num = num+1;
  		});
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/no_approve_all');?>",
  			data : {'leave_id' : leaveid, 'type':type, 'type_mgr':type_mgr},
  			// async:false,
  			success: function(data){
  				console.log(data);
  				if(data == "success"){
	  				$("#overlay").hide();
	  				location.reload();
  				}
  			}
  		})
	}else{
		console.log("ยกเลิก");
		return false;
	}
	}
	function test(){
		var num = 1;
  		var type = $("#typeuser").val();
  		var r = confirm("Are you sure to Approve With Un Pay All?");
  		var type_mgr = "";
    	if (r == true){
    	var leaveid = [];
		$("#overlay").show();
    	$('input[name=checkbox2]:checked').each(function() {
    	if(num == 1){
    		type_mgr = $(this).attr('id').substring(17,$(this).attr('id').length);
    	}
  		leaveid.push($(this).attr('id').substring(4,17));
  		num = num+1;
  	});
    	var approve_type = "";
    	if(type_mgr == 1){
  			approve_type = "2";
  		}else{
  			approve_type = "7";
  		}
  		$.ajax({
  			type : "POST",
  			dataType : "JSON",
  			url : "<?php echo base_url('index.php/leave_approve/test');?>",
  			data : {'leave_id' : leaveid, 'type':type, 'type_mgr':type_mgr, 'approve_type':approve_type},
  			// async:false,
  			success: function(data){
  				console.log(data);
  				if(data == "success"){
	  				$("#overlay").hide();
	  				location.reload();
  				}
  			}
  		})
  		}else{
  			console.log("ยกเลิก");
  			return false;
  		}
	}
 </script>