<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>MLeave</title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/signin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/leave.css" rel="stylesheet">
	<style>
		body {
			background: #F5F5F5;
		}
		.form-signin-heading{
			font-size: 20px;
			color: #428bca;
		}
	</style>


</head>
<body>

	<div class="container">
		
		<form class="form-signin" name="form1" method="post" action="<?php echo base_url().index_page();?>/login/authen">

	    <input type='hidden' id='status_b'  name='status_b' value='' />
		<input type="hidden" name="redirect" value="<?php echo @$status;?>">
		<div class="bs-login">
			<div class="rowfulid">
			<?php if($user_open_on == "com"){?>
				<div class="span12">
					<center><img src="<?php echo  base_url();?>assets/img/MLeave logo.png" height="100px"  /></center>
				</div>
			<?php }else{ ?>
				<div class="span12">
					<center><img src="<?php echo  base_url();?>assets/img/MLeave_mobile.png" height="50px" /></center>
				</div>
			<?php } ?>
			</div>
			
			<br><p class="form-signin-heading">Please sign in</p>
			<?php
			if($status==1)
				{ ?>
			<div class="alert alert-block alert-danger fade in">
        <h4>ไม่สามารถเข้าสู่ระบบได้!</h4>
        <p>Username หรือ Password ไม่ถูกต้อง.</p>
        <div class="space-top"></div>
        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
		<input type="password" class="form-control" placeholder="Password" name="password" required>
		<p class="text-right">
          <a class="btn btn-danger" href="#">ลืม Password</a>
        </p>
        <div class="space-top"></div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        
        </div>
		</p>
		<?php } else{?>
		<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
		<input type="password" class="form-control" placeholder="Password" name="password" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<?php }?>
		</div>
	</form>

</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>


 <script type="text/javascript">  

    var mybrowser=navigator.userAgent;  
    if(mybrowser.indexOf('MSIE')>0){  
    	document.getElementById('status_b').value="2";
  alert("Internet Explorer ไม่สนับสนุนการทำงานบางอย่าง\nแนะนำให้ใช้งาน Google Chrome หรือ Mozilla Firefox");  
  //       
		// self.close(); 
    }  
    if(mybrowser.indexOf('Firefox')>0){  
       document.getElementById('status_b').value="3";
    }     
    if(mybrowser.indexOf('Presto')>0){  
       document.getElementById('status_b').value="4";  
    }             
    if(mybrowser.indexOf('Chrome')>0){  
       document.getElementById('status_b').value="1";  
    }         
 </script> 