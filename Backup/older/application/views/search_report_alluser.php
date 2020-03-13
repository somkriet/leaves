<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home </a> / รายงานการลา Leave report</h5>
			<?php if ($status==1) {
				echo "<h3><center>ค้นหาข้อมูลตั้งแต่วันที่ from".$search_start_date." ถึงวันที่ to".$search_end_date."</center></h3>";
			}?>
		</div>
	</div>
	<div class="bs-leave-search-by-date">
		<form name="form1" method="post" action="<?php echo base_url().index_page();?>/report/report_alluser/1">
			<div class="row">
				<div class="col-md-3">
					<strong>ตั้งแต่วันที่ / from:</strong>
					<input type="text" name="search_start_date" class="form-control" id="datepicker" required>
					<input type="hidden" name="search_start_date2" value="<?php echo $search_start_date2;?>">
				</div>
				<div class="col-md-3">
					<strong>ถึงวันที่ / to:</strong>
					<input type="text" name="search_end_date" class="form-control" id="datepicker2" required>
					<input type="hidden" name="search_end_date2" value="<?php echo $search_end_date2;?>">
				</div>
				<div class="col-md-3">
					<br>
					<input type="submit" class="form-control btn btn-info" value="Search">
				</div>
			</div>
		</form>
	</div>
</div>