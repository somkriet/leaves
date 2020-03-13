<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/bootstrap-docs-readme.png');?>">

	<title>MLeave</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css');?>"> -->

	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.4.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
</head>
<body>
<!-- <div > -->
				<!-- <a class="navbar-brand" href="<?php echo base_url('index.php/home');?>"><img src="<?php echo base_url('assets/img/icon_logo.png');?>" width="40%" heigth="40%"></a> -->
			<!-- </div> -->
<nav class="navbar navbar-default navbar-fixed-top" ><!-- style="position:relative; margin-left:100px;" -->
			
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
				<!-- <a class="navbar-brand" href="<?php //echo base_url('index.php/home');?>"><img src="<?php echo base_url('assets/img/icon_logo.png');?>" style="    position: relative;
    margin-top: -20px;"></a> -->
			<!-- <a class="navbar-brand" href="<?php echo base_url('index.php/home');?>"><img src="<?php echo base_url('assets/img/logo2.png');?>" style="position:relative; margin-top:-18px;"></a> -->
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li <?php echo($nav=='home')?'class="active"':"";?>><a href="<?php echo base_url('index.php/home');?>"><span class="glyphicon glyphicon-home"></span> หน้าแรก/Home <span class="sr-only">(current)</span></a></li>
					<li <?php echo($nav=='add_leave')?'class="active"':"";?>><a href="<?php echo base_url('index.php/leave');?>"><span class="glyphicon glyphicon-pencil"></span> กรอกใบลา/Leave Requests</a></li>
					<li <?php echo($nav=='leave_detail')?'class="active"':"";?>><a href="<?php echo base_url('index.php/leave_detail');?>"><span class="glyphicon glyphicon-list-alt"></span> ข้อมูลการลา/Leave detail</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-king"></span> MD. <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><span class="glyphicon glyphicon-ok"></span> ยืนยันการลา / Leave Approve</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> ข้อมูลการลา / Leave detail</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-file"></span> รายงานการลา / Leave Report</a></li>
						</ul>
					</li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-queen"></span> Sr. <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><span class="glyphicon glyphicon-ok"></span> ยืนยันการลา / Leave Approve</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url('index.php/leave_detail_usertype');?>"><span class="glyphicon glyphicon-list-alt"></span> ข้อมูลการลา / Leave detail</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-file"></span> รายงานการลา / Leave Report</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-star"></span> Asst.Mgr. <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><span class="glyphicon glyphicon-ok"></span> ยืนยันการลา / Leave Approve</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url('index.php/leave_detail_usertype');?>"><span class="glyphicon glyphicon-list-alt"></span> ข้อมูลการลา / Leave detail</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-file"></span> รายงานการลา / Leave Report</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> HR <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><span class="glyphicon glyphicon-ok"></span> ยืนยันการลา / Leave Approve</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> กำหนดวันหยุด / Holiday Setup</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-plus"></span> จัดการผู้ใช้ / User Setup</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> ตั้งค่าระบบ / System Setup</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url('index.php/leave_detail_usertype');?>"><span class="glyphicon glyphicon-list-alt"></span> ข้อมูลการลา / Leave detail</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-file"></span> รายงานการลา / Leave Report</a></li>
							<!-- <li><a href="#"><span class="glyphicon glyphicon-duplicate"></span> รายงาน / Daily Report</a></li> -->
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-pushpin"></span> <?php echo $user['name_en'];?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> ข้อมูลส่วนตัว / Profile</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url('index.php/login/logout');?>"><span class="glyphicon glyphicon-off"></span> ออกจากระบบ / Sign out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<br><br><br>