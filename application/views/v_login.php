<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/bootstrap-docs-readme.png');?>">

	<title>MLeave</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css');?>">

	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.4.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<style type="text/css">
	@keyframes example {
    0%   {left:0px; top:-500px;}
    25%  {left:0px; top:0px;}
}
.container {
    position: relative;
    animation-name: example;
    animation-duration: 4s;
}
.control-version{
	/*font-weight: bold;*/
	font-family: Georgia, serif;
	font-size: 18px;
}
</style>
</head>
<body>

	<div class="container ">

<img src="<?php echo base_url('assets/img/hook.png');?>" class="img-responsive" alt="" style="no-repeat center center; background-size: 100% 100%; position: relative;
    z-index: 999; margin-top: -4%; margin-left:-1%"/>

		<div class="row" id="pwd-container">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			
				<section class="login-form" >

					<?php echo form_open('',array('id'=>'form_login','role'=>'login','autocomplete'=>'off'));?>
					<br>
					<!-- width="40%" height="40%" style="position:relative; margin-top:20px;" -->
					

					<img src="<?php echo base_url('assets/img/MLeave logo1.png');?>" class="img-responsive" alt=""  /><!-- width="40%" height="40%" style="position:relative; margin-top:20px;" -->
					<input type="text" id="txt_username" name="txt_username" class="form-control" placeholder="Username" required value="">
					<input type="password" id="txt_password" name="txt_password" class="form-control" placeholder="Password" required="">
					<div class="pwstrength_viewport_progress" id="msg_login"></div>
					<!-- <br> -->
					<button type="submit" class="btn btn-primary btn-block">Login</button>
					<p class="control-version">v. 1.0.1</p>
					<?php echo form_close();?>
				</section>  
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
$(function(){
	$('#txt_username').focus();
});

$('#form_login').on('submit', function(){
	var username = $('#txt_username').val();
	var password = $('#txt_password').val();

	$('#msg_login').empty();
	$.ajax({
		type: "POST",
		dataType: "JSON",
		url: "<?php echo base_url('index.php/login/authen');?>",
		data: { 'username': username, 'password': password },
		beforeSend: function(xls){
			$('#msg_login').html('<img style="margin-bottom: 0px;" src="<?php echo base_url('assets/img/loading.gif')?>">');
		},
		success: function(res){
			console.log(res);
			if(res['return']=='error'){
				$('#msg_login').html('<font color="red"><b>Invalid</b> Username or Password</font>');
				// $('#txt_username').val("");
				$('#txt_password').val("");
				$('#txt_password').focus();
			}else{
				window.location.href="<?php echo base_url('index.php/home');?>";
			}
		}
	});

	return false;
});
</script>