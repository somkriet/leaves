<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MLeave</title>
  <link rel="shortcut icon" href="<?php echo  base_url();?>assets/img/meikologo_large.png">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url();?>assets/css/sticky-footer-navbar.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/leave.css" rel="stylesheet">
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
      .tablemiddle{
        padding-top: 0px;
        padding-bottom: 30px;
        text-align: center;
      }
      </style>
      <script type="text/javascript">




        function confirmLogout(delUrl) {
          if (confirm("ต้องการออกจากระบบจริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmDelete(delUrl) {
          if (confirm("ต้องการลบข้อมูลจริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmCancle(delUrl) {
          if (confirm("ต้องการยกเลิกจริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmLeaveSuccess(delUrl) {
          if (confirm("ต้องการอนุมัติรายการนี้โดยยอมให้จ่ายเงินเดือนจริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmLeaveWarning(delUrl) {
          if (confirm("ต้องการอนุมัติรายการนี้ไม่จ่ายเงินเดือนจริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmLeaveCancle(delUrl) {
          if (confirm("ต้องการไม่อนุมัติรายการนี้จริงหรือไม่ ?")) {
            document.location = delUrl;
          }
        }
        function confirmLeaveHr(delUrl) {
          if (confirm("ยืนยัน การรับทราบ")) {
            document.location = delUrl;
          }
        }

  



      </script>
    </head>
    <body>
      <!-- Wrap all page content here -->
      <div id="wrap">
        <!-- Fixed navbar -->
       
        <div class="navbar navbar-default navbar-fixed-top">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/img/logoheader.png"></a>
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

          <!--     <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/img/logo.png"></a> -->
            </div>
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url().index_page();?>/home/index"><i class="glyphicon glyphicon-home"></i> หน้าแรก/Home</a></li>
            
                <li><a href="<?php echo base_url().index_page();?>/leave/add_leave"><i class="glyphicon glyphicon-pencil"></i> กรอกใบลา/Leave Requests</a></li>
           
                <li><a href="<?php echo base_url().index_page();?>/leave/search_leave"><i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการลา/Leave detail</a></li>
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
              <?php if($user['user_type_ID']==0 or $user['user_type_ID']==6){?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-tower"></i> MD 
                    <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                    <?php }?>
                  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().index_page();?>/leave/leave_approv"><i class="glyphicon glyphicon-tasks"></i> ยืนยันใบลา / Leave approve
                      <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                    <?php }?>
                    </a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url().index_page();?>/leave/search_leave_detail"><i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการลา / Leave detail</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/report/report_alluser">รายงานการลา / Leave report</a></li>
                  </ul>
                </li>
                <?php }?>
              <?php if($user['user_type_ID']==0 or $user['user_type_ID']==1){?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-tower"></i> Senior 
                    <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                    <?php }?>
                  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().index_page();?>/leave/leave_approv"><i class="glyphicon glyphicon-tasks"></i> ยืนยันใบลา / Leave approve
                        <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                        <?php }?>
                    </a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url().index_page();?>/leave/search_leave_detail"><i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการลา / Leave detail</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/report/index">รายงานการลา / Leave report</a></li>
                  </ul>
                </li>
                <?php }?>
              <?php if($user['user_type_ID']==0 or $user['user_type_ID']==2 or $user['user_type_ID']==7){?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> <?php if($user['user_type_ID']==0 or $user['user_type_ID']==2){echo "Manager";}else{echo "Asst.Manager";}?> 
                    <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                    <?php }?>
                   <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().index_page();?>/leave/leave_approv"><i class="glyphicon glyphicon-tasks"></i> ยืนยันใบลา / Leave approve
                        <?php if($leave_count[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count[0]->count_user;?></span>
                        <?php }?>
                    </a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url().index_page();?>/leave/search_leave_detail"><i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการลา / Leave detail</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/report/index">รายงานการลา / Leave report</a></li>
                  </ul>
                </li>
                <?php }?>
                <?php if($user['user_type_ID']==0 or $user['user_type_ID']==5 or ($user['user_type_ID']==2 and $user['position_ID']==28 or $user['position_ID']==29)){?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>HR 
                    <?php if($leave_count_ap_hr[0]->count_user!=0){?>
                        <span class="label label-danger"><?php echo $leave_count_ap_hr[0]->count_user;?></span>
                    <?php }?>
                    <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().index_page();?>/leave/hr_approv">ยืนยันใบลา / Leave approve</a></li>
                    <!--<li><a href="#">การยกเลิกใบลา</a></li>-->
   
                    <li><a href="<?php echo base_url().index_page();?>/calendar/calendar_next_year">กำหนดวันหยุด / Holiday setup</a></li>
                    <!--<li><a href="#">กำหนดผู้ Approv</a></li>-->
                    <!--<li><a href="#">สิทธิ์การลา</a></li>-->
                    <!-- <li><a href="<?php echo base_url().index_page();?>/hr/office">Office</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/hr/acceptation">Acceptation</a></li>
                    <li><a href="#">วันหยุดประจำปี</a></li> -->
                    <li><a href="<?php echo base_url().index_page();?>/setting/add_edit_delete_user">จัดการผู้ใช้ / User setup</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/setting/index">ตั้งค่าระบบ / System setup</a></li>
  
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url().index_page();?>/leave/search_leave_detail"><i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการลา / Leave detail search</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/report/report_alluser"><i class="glyphicon glyphicon-list-alt"></i> รายงานการลา / Leave report</a></li>
                    <li><a href="<?php echo base_url().index_page();?>/daily_report/index"><i class="glyphicon glyphicon-list-alt"></i> รายงาน / Daily report</a></li>
                    <!-- <li><a href="<?php echo base_url().index_page();?>/report/report_leave_annual_year">ข้อมูลสิทธ์ / Leave annual</a></li> -->
                  </ul>
                </li>
                <?php }?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-pushpin"></i> <?php if($user['user_type_ID']==0){echo "Admin";}else{echo $user['name_en'];}?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
 
                    <li><a href="<?php echo base_url().index_page();?>/user/index"><i class="glyphicon glyphicon-user"></i> ข้อมูลส่วนตัว / Profile</a></li>
           
                  <!--   <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li> -->
                    <li class="divider"></li>
                    <li><a href="javascript:confirmLogout('<?php echo base_url().index_page();?>/home/logout')"><i class="glyphicon glyphicon-off"></i> ออกจากระบบ / Sign out</a></li>
                  </ul>
                </li>
                
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>

<script type="text/javascript">
// document.getElementById('status_b').value="555";
//   var mybrowser=navigator.userAgent;  
//     if(mybrowser.indexOf('MSIE')>0){  
      
       
//         alert("กรุณาเปิดด้วย Google Chrome");  
//     }  
//     if(mybrowser.indexOf('Firefox')>0){  

//     }     
//     if(mybrowser.indexOf('Presto')>0){  

//     }             
//     if(mybrowser.indexOf('Chrome')>0){  
  
//     }       
</script>     