<script type="text/javascript">
	function check_input()
	{
		if(document.frmMain.userfile.value == "")
		{
			alert('กรุณาเลือกภาพก่อนอัพโหลด');
			return false;
		}
	}
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก</a> / ข้อมูลการลา </h5>
		</div>
	</div>
	<div class="row">
		<div class="bs-leave-detail">
			<h3>ข้อมูลการลาของ : <?php
			if(@$user_by_select_search[0]->user_ID==0){
				echo "ข้อมูลทั้งหมด / All";
			}else{
				echo $user_by_select_search[0]->name_th."  ";echo $user_by_select_search[0]->surname_th;
			}?>
			/ Leave detail :
			<?php
			if(@$user_by_select_search[0]->user_ID==0){
				echo "ข้อมูลทั้งหมด / All";
			}else{
				echo $user_by_select_search[0]->name_en."  ";echo $user_by_select_search[0]->surname_en;
			}?>
			</h3>
			<?php if ($status==1) {?>
				<h3><?php echo '<center><font color="red">ไฟล์ที่อัพโหลด ขนาดใหญ่เกิน 1 Mb</font></center>';?></h3>
			<?php }
			if ($status==2) { ?>
				<h3><?php echo '<center><font color="green">อัพโหลดไฟล์เรียบร้อย</font></center>';?></h3>
			<?php }	?>


			<table class="table table-condensed table-hover table-bordered">
				<thead>
					<tr>
						<th>ชื่อ-นามสกุล<BR>Name</th>
						<th>รายการ<BR>REquest type</th>
						<th>ประเภท<BR>Leave type</th>
						<th>วันที่<BR>Leave Date</th>
						<th>จำนวน(วัน)<BR>Total(days)</th>
						<th>ทำรายการโดย<BR>Transaction by</th>
						<th>เมื่อวันที่<BR>Transaction date</th>
						<th>สถานะ<BR>Status</th>
						<th>ยกเลิก<BR>Cancel</th>
					</tr>
				</thead>
				<tbody>
					<?php //print_r($result_search_leave_detail);?>
					<?php foreach($result_search_leave_detail as $num=>$row){?>
					<tr>

						<td><?php echo $row->user_leave." ".$row->user_leave_surname ;?> / <?php echo $row->user_leave_en." ".$row->user_leave_surname_en ;?></td>
						<td><?php echo $row->leave_group_Name;?></td>
						<td><a href="" data-toggle="modal" data-target="#myModal<?php echo $num+1;?>"><?php echo $row->leave_type_Name." / ";?></a><br>
						<?php 
						if ($row->leave_type_ID==5) {
							if ($row->leave_attached==0) {
					      		echo '<font color="red">ไม่มีใบรับรองแพทย์</font>';
					      	}else{?>
					      		<a href="<?php echo base_url()."uploads/".$row->leave_attached;?>" target="_blank"><font color="green">มีใบรับรองแพทย์</font></a>
					      	<?php }
						}
						?>
					    </td>
						<td>
							<?php
							$query=$this->db->query("SELECT * FROM leave_detail
									where leave_detail.leave_ID='".$row->leave_ID."'
									" );
							$result=$query->result(); 
							foreach ($result as $key => $detail) {							
								echo date('Y-m-d',strtotime($detail->leave_date));
								echo " เวลา ";
								echo $detail->start_time."-".$detail->end_time;
								echo "<br>";
							}
							?>
						</td>
						<td><?php echo number_format($row->total_date,1);?></td>
						<td><?php echo $row->name_th;?> <?php echo $row->surname_th;?> / <?php echo $row->name_en;?> <?php echo $row->surname_en;?></td>
						<td><?php echo date('Y-m-d',strtotime($row->active_date));?></td>
						<td><?php echo $row->acceptation_Name;?></td>
						<td>

							<?php 	
							if($user['user_type_ID']==5 or $user['user_type_ID']==0 or $user['position_ID']==28 or $user['position_ID']==29){

								if(date('Y-m-d',strtotime($row->start_date))>=date('Y-m-d',strtotime("-1 days")) AND $row->acceptation_ID==0 )
									{ ?>
								<a href="javascript:confirmCancle('<?php echo base_url().index_page();?>/leave/leave_cancle/<?php echo $row->leave_ID;?>/<?php echo $start_date_check;?>/<?php echo $end_date_check;?>')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
								<?php }
									else
									{?>
								<button type="button" class="btn btn-danger" disabled="disabled"><i class="glyphicon glyphicon-remove"></i></button>
								<?php 
									}

							}else{ ?>
							<?php if($row->acceptation_ID==0){?>
								<a href="javascript:confirmCancle('<?php echo base_url().index_page();?>/leave/leave_cancle/<?php echo $row->leave_ID;?>/<?php echo $start_date_check;?>/<?php echo $end_date_check;?>/<?php echo $row->user_ID;?>')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
							<?php }else{?>
								<button type="button" class="btn btn-danger" disabled="disabled"><i class="glyphicon glyphicon-remove"></i></button>
							<?php } }?>
						</td>
					</tr>
					<div class="modal fade" id="myModal<?php echo $num+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Leave Detail</h4>
					      </div>
					      <div class="modal-body">

					         <?php echo $row->subject;?> / <?php echo $row->detail;?>
					      </div>
					      <div class="modal-footer">
					      <div class="row">
					      		<div class="col-md-8 text-left">	
					      		
							    <?php if ($row->leave_type_ID==5) {
									if ($row->leave_attached==0) {?>
										<form name="frmMain" id="frmMain" method="post" action="<?php echo base_url().index_page();?>/upload/do_upload"  accept-charset="utf-8" enctype="multipart/form-data" onSubmit="JavaScript:return check_input();">			
										<input type="hidden" name="leave_ID" value="<?php echo $row->leave_ID;?>">
										<input type="hidden" name="row_start_date" value="<?php echo $start_date_check;?>">
										<input type="hidden" name="row_end_date" value="<?php echo $end_date_check;?>">
										<input type="hidden" name="row_user_ID" value="<?php echo $row->user_ID;?>">
										<input type="file" id="userfile" name="userfile" class="form-control" ><br>
										<input type="submit" class="btn btn-default" value="Upload" />

										</form>
							      		<?php echo '<font color="red">ไม่มีใบรับรองแพทย์</font>';
							      	}else{?>

										
							      		<a href="<?php echo base_url();?>uploads/<?php echo $row->leave_attached;?>" target="_blank"><font color="green">มีใบรับรองแพทย์</font></a>
							      	<?php }
								}?>
								</div>
					      		<div class="col-md-4 text-right"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
					      </div>
					      </div>
					    </div>
					  </div>
					</div>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
