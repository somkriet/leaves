	<style type="text/css">
	textarea { /*resize: vertical;*/ resize: none; }
	</style>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
				<div class="com-md-12 col-xs-12">
					<?php echo form_open_multipart("",array('id'=>'form_add_leave'));?>
					<div class="col-md-10 col-xs-12">
						<div class="col-md-12 col-xs-12 row">
							<div class="col-md-6 col-xs-12 form-group">
								<label>*ลาให้กับ / Employee :</label>
								<select class="form-control" name="txt_user_leave" id="txt_user_leave" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<option value="2204">Jatupon</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 col-xs-12 row">
							<div class="col-md-6 col-xs-12 form-group">
								<label>*เลือกรายการ / Request type :</label>
								<select class="form-control" name="txt_req_type" id="txt_req_type" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<option value="leave">Leave</option>
								</select>
							</div>

							<div class="col-md-6 col-xs-12 form-group">
								<label>*เลือกประเภท / Leave type :</label>
								<select class="form-control" name="txt_leave_type" id="txt_leave_type" required>
									<option value="">กรุณาเลือกรายการ / Please Select</option>
									<option value="sick">sick</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 col-xs-12 row">
							<div class="col-md-6 col-xs-12" style="padding: 0px;">
								<div class="col-md-12 col-xs-12 form-group">
									<label>*ลาวันที่ / from date :</label>
									<input type="date" class="form-control" name="txt_date_from" id="txt_date_from" required>
								</div>

								<div class="col-md-12 col-xs-12 form-group">
									<label>*ถึงวันที่ / to date :</label>
									<input type="date" class="form-control" name="txt_date_to" id="txt_date_to" required>
								</div>
							</div>

							<div class="col-md-6 col-xs-12" style="padding: 0px;">
								<div class="col-md-12 col-xs-12 form-group">
									<label>*เลือกเวลา / Start time</label>
									<select class="form-control" id="txt_time_from" name="txt_time_from" required>
										<option value="">กรุณาเลือกรายการ / Please Select</option>
										<option value="08.30">08.30</option>
										<option value="13.00">13.00</option>
									</select>
								</div>

								<div class="col-md-12 col-xs-12 form-group">
									<label>*เลือกเวลา / End time</label>
									<select class="form-control" id="txt_time_to" name="txt_time_to" required>
										<option value="">กรุณาเลือกรายการ / Please Select</option>
										<option value="12.00">12.00</option>
										<option value="17.30">17.30</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xs-12 row">
							<div class="col-md-6 col-xs-12" style="padding: 0px;">
								<div class="col-md-12 col-xs-12 form-group">
									<label>*เรื่อง / Description :</label>
									<input type="text" class="form-control" id="txt_topic" name="txt_topic" required>
								</div>
								<div class="col-md-12 col-xs-12 form-group">
									<label>ใบรับรองแพทย์ / Medical certificate :</label>
									<h5 style="margin: 0px;">ต้องเป็นไฟล์ PDF เท่านั้น / PDF File Only</h5>
									<input type="file" class="form-control" id="file_upload" name="file_upload">
								</div>
							</div>

							<div class="col-md-6 col-xs-12 form-group">
								<label>*รายละเอียด / Reasons :</label>
								<textarea class="form-control" id="txt_desc" name="txt_desc" rows="5" required></textarea>
							</div>
						</div>
						<div class="col-md-12 col-xs-12 row">
							<div class="col-md-5 col-xs-3 form-group"></div>
							<div class="col-md-2 col-xs-4 form-group">
								<button type="submit" class="btn btn-success btn-block">Save</button>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
			<div class="panel-footer"></div>
		</div>
	</div>

	<script type="text/javascript">
	$('#txt_date_from').on('change', function(){
		var date = $(this).val();

		$('#txt_date_to').attr('min',date);

		if($('#txt_date_to').val() == "" || $('#txt_date_to').val() < date){
			$('#txt_date_to').val(date);
		}

		if(date == $('#txt_date_to').val() && $('#txt_time_from').val() == '13.00' && $('#txt_time_to').val() == '12.00'){
			$('#txt_time_from').val("");
			$('#txt_time_to').val("");
		}
	});

	$('#txt_date_to').on('change', function(){
		var date = $(this).val();

		$('#txt_date_from').attr('max',date);

		if($('#txt_date_from').val() == ""){
			$('#txt_date_from').val(date);
		}

		if(date == $('#txt_date_from').val() && $('#txt_time_from').val() == '13.00' && $('#txt_time_to').val() == '12.00'){
			$('#txt_time_from').val("");
			$('#txt_time_to').val("");
		}
	});

	$('#txt_time_from').on('change', function(){
		if($('#txt_date_from').val() == $('#txt_date_to').val()){
			if($(this).val() == '13.00'){
				$('#txt_time_to').val('17.30');
			}
		}
	});

	$('#txt_time_to').on('change', function(){
		if($('#txt_date_from').val() == $('#txt_date_to').val()){
			if($(this).val() == '12.00'){
				$('#txt_time_from').val('08.30');
			}
		}
	});

	$('#form_add_leave').on('submit', function(){
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?php echo base_url('index.php/leave/set_flash');?>",
			async: false,
			data: { 'type': 'submit' },
			success: function(res){

			}
		});
	});
	</script>