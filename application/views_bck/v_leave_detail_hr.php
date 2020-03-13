	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
	textarea { /*resize: vertical;*/ resize: none; }
	a:hover {cursor:pointer;}
	</style>
	<div class="row"></br></div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading "> <label class="glyphicon glyphicon-search"> ข้อมูลการลาของ <?php echo $user['name_th'];?> <?php echo $user['surname_th'];?>/Leave detail : <?php echo $user['name_en'];?> <?php echo $user['surname_en']; ?> </label></div>
			<div class="panel-body">
				<div class="com-md-12 col-xs-12">
				 <!--<?php //echo form_open_multipart("",array('id'=>'form_leave_detail'));?> -->
				   <form action="<?php echo base_url('index.php/leave_detail'); ?>" method="POST">
					<div class="row">

						<div class="row">
							<div class="col-xs-6 col-sm-4">
								<label>ตั้งแต่วันที่ / Start date :</label>
								<input type="date" class="form-control" name="search_start_date" id="search_start_date" value="<?php echo (isset($date_from) AND $date_from != "")?$date_from:'';?>" required>
							</div>
							<div class="col-xs-6 col-sm-4">
								<label>ถึงวันที่ / End date :</label>
								<input type="date" class="form-control" name="search_end_date" id="search_end_date" min="<?php echo(isset($date_from) AND $date_from != "")?$date_from:date('Y-m-01');?>" value="<?php echo (isset($date_to) AND $date_to != "")?$date_to:'';?>" required>
							</div>
							<div class="col-xs-6 col-sm-4">
								<br>
								<button type="submit" class="btn btn-default btn-info " name="leave_data_search" id="leave_data_search" href="#" role="button">
								<span class="glyphicon glyphicon-search"></span> Search</button>
							</div>  
						</div>
					</div>
				<div class="row"></div>
				</br>
		<div class=".col-xs-8 .col-md-8" >
			<table id"stable" class="table table-condensed table-hover table-bordered">
 				<thead>
					<tr class="info">
						<th width="15%"><center>ชื่อ-นามสกุล<BR>Name-Surname</center></th>
						<th width="15%"><center>รายการ<BR>Request type</center></th>
						<th><center>ประเภท<BR>Leave type</center></th>
						<th><center>วันที่ลา<BR>Leave Date</center></th>
						<th><center>จำนวน(วัน)<BR>Total(days)</center></th>
						<th width="15%"><center>ทำรายการโดย<BR>Transaction by</center></th>
						<th><center>ลาเมื่อวันที่<BR>Transaction date</center></th>
						<th><center>สถานะ<BR>Status</center></th>
						<th><center>ยกเลิก<BR>Cancel</center></th>
					</tr>
				</thead>
				<tbody>
					  <?php if(empty($data_dealer) OR isset($data_dealer[0]->ERROR)){?>
					  		<tr><td colspan="9" align="center">NO DATA</td></tr>
                            <?php }else{?>
					<?php foreach($data_dealer as $num=>$row):?>
						<?php //echo "<pre>"; print_r($data_dealer); echo "</pre>"; exit();?>
					<tr class="active">
						<td><?php echo $row->name_th." ".$row->surname_th ;?> /</br> <?php echo $row->name_en." ".$row->surname_en ;?></td>
						<td><?php echo $row->leave_group_name;?></br>
						<td><?php echo $row->leave_type_name;?><br> <!--."<a href="" data-toggle="modal" data-target="#myModal<?php //echo $num+1;?>"> </a>/ ".$row->leave_group_name  -->
					    <?php if($row->leave_attached != "" AND $row->leave_type_ID != "5"){?> 
								<a href="<?php echo base_url('assets/upload/')."/".$row->leave_attached;?>" style="color:red" target="_blank">ไฟล์แนบ</a> 
						<?php }else if($row->leave_attached != "" AND $row->leave_type_ID == "5"){ ?>
								<a href="<?php echo base_url('assets/upload/')."/".$row->leave_attached;?>" style="color:red" target="_blank">มีใบรับรองแพทย์</a> 
						<?php }else if($row->leave_attached == "" AND $row->leave_type_ID == "5"){ ?>
								<a style="color:red" target="_blank">ไม่มีใบรับรองแพทย์</a> 
						<?php } ?>
					    </td>
						<td><a id="<?php echo $row->leave_ID;?>" onclick="send_leave_id(this.id)"><?php
							if(($row->start_date)==($row->end_date)){
								echo date("d/m/Y", strtotime($row->start_date));
							}else{
								echo date("d/m/Y", strtotime($row->start_date));?><br>
									<center><?php echo"ถึงวันที่"?></center>
									<?php echo date("d/m/Y", strtotime($row->end_date));
							}?></a></td>
						<td><center><?php echo $row->total_date ?></center></td>
						<td><?php echo $row->active_name_th." ".$row->active_surname_th.'</br>'.$row->active_name_en." ".$row->active_surname_en;?></td>
						<td><?php echo date("d/m/Y", strtotime($row->active_date));?></td>
						<td><?php echo $row->acceptation_name ?></td>
						<td><button id="d_<?php echo $row->leave_ID;?>" type="button" class="btn btn-danger" <?php echo (isset($row->acceptation_ID) && $row->acceptation_ID != "0")?"disabled":"onclick='deleteid(this.id)'" ?>><i class="glyphicon glyphicon-remove"></i></button></td>
					</tr>
				</div>
			</div>
		</div>
					<?php endforeach; }?>
			</tbody>
		</table>
	</div>
</div>
		<button type="button" class="clickdetail" data-toggle="modal" data-target="#leave_detail" style="display:none"></button>
        <div class="modal fade" id="leave_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" >
            <div class="modal-content" style="width:800px; height:700px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Leave Detail</h4>
              </div>
              <div class="modal-body" style="position: relative; padding: 15px;">
              <table id="dtable">
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
			<div class="panel-footer"></div>
		</div>
	</div>
</div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	// $.fn.dataTableExt.sErrMode = 'throw';
       $('#stable').DataTable({
          ordering: false,
          lengthChange: true,
          searching: true
        });
})
function send_leave_id(id){
  	$.ajax({
    type: "POST",
    dataType: "JSON",
    url: "<?php echo base_url('index.php/leave_detail/showdetail'); ?>",
    data: {'leave_id' : id},
    success: function(data){
    console.log(data);
    var rowCount = $('#dtable tr').length;
			if(rowCount > 0){
				var table = $('#dtable').DataTable();
				 table.destroy();
				 $('#dtable thead').empty();
        		 $('#dtable tbody').empty();
	}
      var newth = "<tr><th>ลำดับ/NO</th><th>วันที่/Date</th><th>ตั้งแต่เวลา / Start time</th><th>ถึงเวลา / End Time</th></tr>";
          jQuery("#dtable thead").append(newth);
      	  $.each(data, function(i,val){
		  var no = i+1;
		  // var 	d = new date(val['leave_date']),
		   // var d = new Date,
		  var date = new Date(val['leave_date']);
		  var dateleave = date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
          var newRowContent = "<tr><td>"+ no +"</td><td>" + dateleave + "</td><td>" + val['start_time'] + "</td><td>" + val['end_time'] + 
                              "</td></tr>";
          jQuery("#dtable tbody").append(newRowContent);
		})
       $(".clickdetail").click();
       $.fn.dataTableExt.sErrMode = 'throw';
       $('#dtable').DataTable({
          ordering: false,
          lengthChange: true,
          searching: true
        });
}
  })
  }
    function deleteid(id){
  	var subid = id.substring(2,id.length);
  	var r = confirm("Are you sure to delete?");
    if (r == true){
	     $.ajax({
	    type: "POST",
	    dataType: "JSON",
	    url: "<?php echo base_url('index.php/leave_detail/del_leave_id');?>",
	    data: {'l_id' : subid},
	  		success: function(data){
	    	}
	  	})
	     location.reload();
    }else{
        return false;
    }
  }

$('#search_start_date').on('change', function(){
	var start = $('#search_start_date').val();
	var end = $('#search_end_date').val();

	if(start > end){
		$('#search_end_date').val(start);
	}
	$('#search_end_date').attr('min',start);
});
</script>


