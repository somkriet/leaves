<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ค้นหา Leave detail search</h5>
		</div>
	</div>
	<div class="bs-leave-search-by-date">
		<form name="form1" method="post" action="<?php echo base_url().index_page();?>/leave/leave_detail">
			<div class="row">
				<div class="col-md-3">
					<strong>ตั้งแต่วันที่ / Start date:</strong>
					<input type="text" name="search_start_date" class="form-control" id="datepicker" required>
				</div>
				<div class="col-md-3">
					<strong>ถึงวันที่ / End date:</strong>
					<input type="text" name="search_end_date" class="form-control" id="datepicker2" required>
				</div>
				<input type="hidden" name="select_user_leave_detail" value="<?php echo $user_by_session[0]->user_ID;?>">
				<div class="col-md-3">
					<br>
					<input type="submit" class="form-control btn btn-info" value="Search">
				</div>
			</div>
		</form>
	</div>
</div>