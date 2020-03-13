    <script type="text/javascript" src="<?php echo base_url();?>assets/js/googleapis.js"></script>


    <!-- 3.0 -->
    <link href="<?php echo base_url();?>assets/css/bootstrapcdn.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/js/bootstrapcdn.js"></script>
    <!-- 2.3.2
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.js"></script>
    -->
    <script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });

            // $('.selectpicker').selectpicker('hide');
        });
    </script>

    <script>
    	$(function(){
    		$('optgroup :odd').css('color','blue');

    		$('#Department_ID').on('change', function(){
    			var dep_id = $(this).val();

    			$('#select_user_leave_detail').empty();
    			//alert(dep_id);
    			$.ajax({
    				type: 'POST',
					url: 'test_test',
					data: 'num_dep_id=' + dep_id,

					success: function(result){
						//console.log( result );
						$('#select_user_leave_detail').append("<option value=''>ทั้งหมด / All</option>");
						for (var i=0; i<result.length; i++) {
					     	$('#select_user_leave_detail').append('<option value="' + result[i].user_ID + '">' + result[i].name_th + ' ' + result[i].surname_th + '</option>');
					 	}
					}
    			});
    		});
    	});
    </script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ค้นหา Search</h5>
		</div>
	</div>
	<div class="bs-leave-search-by-date">
		<form name="form1" method="post" action="<?php echo base_url().index_page();?>/leave/leave_detail">
			<div class="row">
				<div class="col-md-3">
					<strong>ตั้งแต่วันที่ / State date:</strong>
					<input type="text" name="search_start_date" class="form-control" id="datepicker" required>
				</div>
				<div class="col-md-3">
					<strong>ถึงวันที่ / End date:</strong>
					<input type="text" name="search_end_date" class="form-control" id="datepicker2" required>
				</div>
				

				<?php if($user['user_type_ID']==0 or $user['user_type_ID']==6 or $user['user_type_ID']==5 or $user['user_type_ID']==2 or $user['user_type_ID']==1 or $user['user_type_ID']==7){?>
				<div class="col-md-3">
				<strong>เลือกชื่อแผนก / Department:</strong>
					<select name="Department_ID" id="Department_ID" class="form-control selectpicker" data-live-search="true">
						<?php if($user['user_type_ID']==5 or $user['user_type_ID']==6 or $user['position_ID']==28 or $user['position_ID']==29 or $user['user_type_ID']==0) {?>
							<option value="">ทั้งหมด / All</option>
								<?php foreach($department_all as $value){?>
								<option value="<?php echo $value->department_ID;?>">
								<?php echo $value->department_Name;?> 
								</option>
								<?php }?>
						<?php }else{ ?>
								<option value="<?php echo $user['department_ID'];?>">	<?php echo $user['department_Name'];?>
						<?php }?>					
					</select>
				</div>

				<div class="col-md-3">
				<strong>เลือกชื่อพนักงาน / Empleyee:</strong>
					<select name="select_user_leave_detail" id="select_user_leave_detail" class="form-control" data-live-search="true">
						<?php if($user['user_type_ID']==5 or $user['user_type_ID']==6 or $user['position_ID']==28 or $user['position_ID']==29 or $user['user_type_ID']==0 or $user['user_type_ID']==2){?>
							<optgroup><option value="">ทั้งหมด / All</option>
						<?php }?>
						<?php foreach($user_by_department as $user_dep){?>
						<option value="<?php echo $user_dep->user_ID;?>">
						<?php echo $user_dep->name_th;?> 
						<?php echo $user_dep->surname_th;?>
						</option>
						<?php }?></optgroup>
					</select>
				</div>

				<?php }else{?>
				<input type="hidden" name="select_user_leave_detail" value="<?php echo $user_by_session[0]->user_ID;?>">
				<?php }?>
				<div class="col-md-3">
					<br>
					<input type="submit" class="form-control btn btn-info" value="Search">
				</div>
			</div>
		</form>
	</div>
</div>