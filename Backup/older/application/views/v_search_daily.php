    <script type="text/javascript" src="<?php echo base_url();?>assets/js/googleapis.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-select.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-select.css">

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
    	function ListD(SelectValue)
		{			

			//alert(SelectValue);
			form1.select_user_leave_detail.length = 0
			var myOption = new Option('ทั้งหมด / All','')  
			form1.select_user_leave_detail.options[form1.select_user_leave_detail.length]= myOption
			
			<?php
			$intRows = 0;
			$strSQL = "SELECT * FROM `user` where user_status='0' ORDER BY department_ID desc ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
				$intRows++;
				?>			
				x = <?php echo $intRows;?>;
				mySubList = new Array();
				
				strGroup = <?php echo $objResult["department_ID"];?>;
				strValue = "<?php echo $objResult["user_ID"];?>";
				strItem = "<?php echo $objResult["name_th"];?> - <?php echo $objResult["surname_th"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])  
					form1.select_user_leave_detail.options[form1.select_user_leave_detail.length]= myOption					
				}
				<?php
			}
			?>																
		}
    </script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก Home</a> / ค้นหา Search</h5>
		</div>
	</div>
	<div class="bs-leave-search-by-date">
		<form name="form1" method="post" action="<?php echo base_url().index_page();?>/daily_report/gen_excel">
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
					<select name="Department_ID" id="Department_ID" class="form-control selectpicker" data-live-search="true" onChange = "ListD(this.value)">
						<option value="">ทั้งหมด / All</option>
						<?php foreach($department_all as $value){?>
						<option value="<?php echo $value->department_ID;?>"><?php echo $value->department_Name;?></option>
						<?php }?>					
					</select>
				</div>

				<div class="col-md-3">
				<strong>เลือกชื่อพนักงาน / Empleyee:</strong>
					<select name="select_user_leave_detail" id="select_user_leave_detail" class="form-control " data-live-search="true">
						<option value="">ทั้งหมด / All</option>
					</select>
				</div>

				<?php }else{?>
				<input type="hidden" name="select_user_leave_detail" value="<?php echo $user_by_session[0]->user_ID;?>">
				<?php }?>
				<div class="col-md-3">
					<br>
					<input type="submit" class="form-control btn btn-info" value="Daily report">
				</div>
			</div>
		</form>
	</div>
</div>