<!DOCTYPE html>
<html lang="en">
<head>
  <title>User setup</title>
  
</head>
<body>
<div class="row"><br></div>
<div class="container" style="margin-top:18px;">
 <!-- <div class="col-sm-8 text-left">  -->
      <div class="row"></div><br>
<div class="row">
    <div class="col-md-4">
      <center>
          <!-- Button trigger modal -->
        <button type="button" class="btn btn-success glyphicon glyphicon-plus btn-lg" 
        data-toggle="modal" data-target="#add_user">เพิ่มผู้ใช้</button>
      
      <form name="user" method="post" action="<?php echo base_url().index_page();?>/user_setup/add_user">
          <!-- Modal Add User -->
        <div class="modal fade bs-example-modal-lg" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog btn-lg" >
            <div class="modal-content">
              <div class="modal-header">
                <form name="add_user" method="post" action="<?php echo base_url().index_page();?>/user_setup/add_user">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลผู้ใช้/Add User</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                   <div class="col-xs-8">
                        <label>วันที่เริ่มทำงาน/Start date work</label>
                        <input type="text" class="form-control datepicker" name="start_date_work" id="start_date_work" placeholder = "dd/mm/yyyy" required>
                    </div>
                  <div class="col-xs-6">
                        <label>รหัสพนักงาน/User ID</label>
                      <input type="text" class="form-control" name="userID" id="userID" placeholder="รหัสพนักงาน/User ID" required>
                  </div>
                  <div class="col-xs-6">
                        <label>วันเกิด/Birth day</label>
                      <input type="text" class="form-control datepicker" name="birth_date" id="birth_date" placeholder = "dd/mm/yyyy" required>                        
                  </div>


                  <div class="col-xs-6">
                    <label  for="add_holiday">ชื่อภาษาไทย/Name</label><input type="text" class="form-control" name="name_th" id="name_th" placeholder="ชื่อ/Name" required>
                  </div>
                   <div class="col-xs-6">
                        <label>นามสกุลภาษาไทย/Sername</label>
                      <input type="text" class="form-control" name="surname_th" id="surname_th" placeholder="นามสกุล/Sername" required>                        
                  </div>


                  <div class="col-xs-6">
                    <label  for="add_holiday">ชื่อภาษาอังกฤษ/Name</label><input type="text" class="form-control" name="name_en" id="name_en" placeholder="ชื่อภาษาอังกฤษ/Name" required>
                  </div>
                   <div class="col-xs-6">
                        <label>นามสกุลอังกฤษ/Sername</label>
                      <input type="text" class="form-control" name="surname_en" id="surname_en" placeholder="นามสกุลอังกฤษ/Sername" required>                        
                  </div>
                  <div class="col-xs-6">
                    <label  for="add_holiday">รหัสผ่าน/Password</label><input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน/Password" required>
                  </div>

                  <div class="col-xs-6">
                  <label>แผนก/Dept.</label>
                        <select class="form-control" name="department_ID" id="department_ID" required>
                                    <option value="">เลือกแผนก/Dept.</option>
                                    <?php foreach($result_department as $num=>$result){?>
                                    <option value="<?php echo $result->department_ID;?>"><?php echo $result->department_Name;?></option>
                               <?php }?>
                      </select>
                  
                  </div>
                   <div class="col-xs-6">
                   <label>ออฟฟิศ/Office</label>
                           <select class="form-control" name="office_ID" id="office_ID" required>
                                    <option value="">เลือกออฟฟิศ/Office</option>
                                    <?php foreach($result_office  as $num=>$result){?>
                                    <option value="<?php echo $result->office_ID;?>"><?php echo $result->office_Name;?></option>
                               <?php }?>
                          </select>

                  </div>

                  <div class="col-xs-6">
                    <label>ตำแหน่ง/Position</label>
                    <select class="form-control" name="position_ID" id="position_ID" required>
                                    <option value="">เลือกตำแหน่ง/Position</option>
                                    <?php foreach($result_position  as $num=>$result){?>
                                    <option value="<?php echo $result->position_ID;?>"><?php echo $result->position_Name;?></option>
                               <?php }?>
                          </select>
                  
                  </div>
                   <div class="col-xs-6">
                        <label>อีเมล์/E-mail</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="อีเมล์/E-mail" required>                        
                  </div>

                  <div class="col-xs-6">
                    <label  for="add_holiday">เบอร์โทร/Phone no.</label><input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์โทร/Phone no." required>
                  </div>

                  <div class="col-xs-6">
                    <label >ประเภทผู้ใช้/User Type</label>
                    <select class="form-control" name="user_type_ID" id="user_type_ID" required>
                                    <option value="">เลือกประเภทผู้ใช้/User Type</option>
                                    <?php foreach($result_user_type  as $num=>$result){?>
                                    <option value="<?php echo $result->user_type_ID;?>"><?php echo $result->user_type_Name;?></option>
                               <?php }?>
                          </select>
                  </div>
                    <div class="col-xs-8">
                                <label>ส่งอีเมล์ถึง/Send email to</label><input type="email" class="form-control" name="send_email_to" id="send_email_to" placeholder="อีเมล์/E-mail" required>
                    </div>                                       
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
             
            </div>
          </div>
        </div><br><br>
 </form>
            <form name="user" method="post" action="<?php echo base_url().index_page();?>/user_setup_bck/check_user">
             <div class="input-group stylish-input-group">
                  <select class="form-control" name="txt_user_setup" id="txt_user_setup" required>
                                    <option value="">เลือกแผนก/Dept.</option>
                                    <?php foreach($result_department as $num=>$result){?>
                                    <option value="<?php echo $result->department_ID;?>"><?php echo $result->department_Name;?></option>
                               <?php }?>
                      </select>
                 <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-hand-up"></span>
                        </button>  
                    </span>
                    </div>
            </form>

                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"> <br><br><br><br>
                  <form name="user_search" method="post" action="<?php echo base_url('index.php/user_setup');?>">
                      <div id="imaginary_container"> 
                          <div class="input-group stylish-input-group">
                              <input type="text" id="search" name="search" class="form-control"  placeholder="Search Name" required>
                                <span class="input-group-addon">
                                  <button type="submit">
                                      <span class="glyphicon glyphicon-search"></span>
                                  </button>  
                                </span>
                          </div>
                      </div>
                  </form>
              </div>
               
</div>
      <br>
    <!-- </div> -->

     <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading "><label class="glyphicon glyphicon-user"> ข้อมูลผู้ใช้ / User Data</label></div>
            <div class="panel-body">
              <div class="com-md-12 col-xs-12">
              <?php //echo form_open_multipart("",array('id'=>'form_user'));?> 
                <table class="table table-bordered">
                <thead>
                  <tr class="info">
                    <th>#</th>
                    <th>รหัส<br>id</th>
                    <th>ชื่อ - สกุล<br>Name-Surname</th>
                    <th>แผนก<br>Dept.</th>
                    <th>ออฟฟิศ<br>Office</th>
                    <th>ตำแหน่ง<br>Position</th>
                    <th>อีเมล์<br>Email</th>
                    <th>เบอร์โทร<br>Phone no.</th>
                    <th>ประเภทผู้ใช้<br>User type</th>
                    <th>แก้ไข<br>Edit</th>
                    <th>ลบ<br>Delete</th>
                    <th>คำนวณสิทธิ์<br></th>
                  </tr>
                </thead>
              <tbody>
                <?php if(empty($data_user_setup) OR isset($data_user_setup[0]->ERROR)){?>
                            <?php }else{?>
                <?php foreach($data_user_setup as $num=>$row):?>
                  <tr class="active">
                    <td><?php echo $num+1;?></td>
                    <td><?php echo $row->user_ID;?></a></td>  
                    <td><?php echo $row->name_th." ".$row->surname_th ;?> / <?php echo $row->name_en." ".$row->surname_en ;?></td>
                    <td><?php echo $row->department_Name;?></td>
                    <td><?php echo $row->office_Name;?></td>
                    <td><?php echo $row->position_Name;?></td>
                    <td><?php echo $row->email;?></td>
                    <td><?php echo $row->phone;?></td>
                    <td><?php echo $row->user_type_Name;?></td>
                    <td> 
                     
                  <a data-toggle="modal" href="#edit_user<?php echo $row->user_ID;?>" class="btn btn-warning"><i class="glyphicon glyphicon-wrench"></i></a>
                  <!-- Modal edit Office-->
                  <div class="modal fade bs-example-modal-lg" id="edit_user<?php echo $row->user_ID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form name="user" method="post" action="<?php echo base_url().index_page();?>/user_setup/edit_user">
                        <?php //echo form_open('/edit_user',array('name'=>'user'));?>
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">แก้ไข ผู้ใช้ / Edit user</h4>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td>
                                        <div class="row">
                                         <div class="col-xs-8">
                                          <label  for="add_holiday">วันที่เริ่มทำงาน/Start date work</label>
                                          <input type="text" class="form-control datepicker" name="start_date_work" id="start_date_work<?php echo $num;?>" value="<?php echo $row->start_date_work;?>" placeholder = "dd/mm/yyyy">
                                        </div>

                                        <div class="col-xs-6">
                                              <label>รหัสพนักงาน/User ID</label>
                                            <input type="text" class="form-control" name="user_ID" id="user_ID" value="<?php echo $row->user_ID ?>" >                        
                                        </div>
                                        <div class="col-xs-6">
                                              <label>วันเกิด/Birth day</label>
                                            <input type="text" class="form-control datepicker" name="birth_date" id="birth_date<?php echo $num;?>" value="<?php echo $row->birth_date;?>" placeholder = "dd/mm/yyyy">                        
                                        </div>


                                        <div class="col-xs-6">
                                          <label  for="add_holiday">ชื่อภาษาไทย/Name</label><input type="text" class="form-control" name="name_th" id="name_th" value="<?php echo $row->name_th;?>">
                                        </div>
                                         <div class="col-xs-6">
                                              <label>นามสกุลภาษาไทย/Sername</label>
                                            <input type="text" class="form-control" name="surname_th" id="surname_th" value="<?php echo $row->surname_th;?>">                        
                                        </div>


                                        <div class="col-xs-6">
                                          <label  for="add_holiday">ชื่อภาษาอังกฤษ/Name</label><input type="text" class="form-control" name="name_en" id="name_en" value="<?php echo $row->name_en;?>" >
                                        </div>
                                         <div class="col-xs-6">
                                              <label>นามสกุลอังกฤษ/Sername</label>
                                            <input type="text" class="form-control" name="surname_en" id="surname_en" value="<?php echo $row->surname_en;?>">                        
                                        </div>

                                        <div class="col-xs-6">
                                          <label  for="add_holiday">แผนก/Dept.</label>
                                             <select class="form-control" name="department_ID" id="department_ID" required>
                                                    <option value="<?php echo $row->department_ID;?>"><?php echo $row->department_Name;?></option>
                                                    <?php foreach($result_department as $num=>$result){?>
                                                    <option value="<?php echo $result->department_ID;?>"><?php echo $result->department_Name;?></option>
                                                    <?php }?>
                                                </select>


                                          <!-- <input type="text" class="form-control" name="department" id="department" value="<?php //echo $row->department_Name;?>"> -->
                                        </div>
                                         <div class="col-xs-6">
                                              <label>ออฟฟิศ/Office</label>
                                               <select class="form-control" name="office_ID" id="office_ID" required>
                                                    <option value="<?php echo $row->office_ID;?>"><?php echo $row->office_Name;?></option>
                                                    <?php foreach($result_office as $num=>$result){?>
                                                    <option value="<?php echo $result->office_ID;?>"><?php echo $result->office_Name;?></option>
                                                    <?php }?>
                                                </select>
                                            <!-- <input type="text" class="form-control" name="office" id="office" value="<?php// echo $row->office_Name;?>" >                         -->
                                        </div>

                                        <div class="col-xs-6">
                                          <label  for="add_holiday">ตำแหน่ง/Position</label>
                                               <select class="form-control" name="position_ID" id="position_ID" required>
                                                    <option value="<?php echo $row->position_ID;?>"><?php echo $row->position_Name;?></option>
                                                    <?php foreach($result_position as $num=>$result){?>
                                                    <option value="<?php echo $result->position_ID;?>"><?php echo $result->position_Name;?></option>
                                                    <?php }?>
                                                </select>

                                          <!-- <input type="text" class="form-control" name="position" id="position" value="<?php //echo $row->position_Name;?>" > -->
                                        </div>
                                         <div class="col-xs-6">
                                              <label>อีเมล์/E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row->email;?>">                        
                                        </div>

                                         <div class="col-xs-6">
                                          <label  for="add_holiday">รหัสผ่าน/Password</label><input type="password" class="form-control" name="password" id="password"  value="<?php echo $row->password;?>">
                                        </div>

                                        <div class="col-xs-6">
                                          <label  for="add_holiday">เบอร์โทร/Phone no.</label><input type="text" class="form-control" name="phone" id="phone"  value="<?php echo $row->phone;?>">
                                        </div>

                                        <div class="col-xs-6">
                                          <label  for="add_holiday">ประเภทผู้ใช้/User Type</label>
                                                <select class="form-control" name="user_type_ID" id="user_type_ID" required>
                                                    <option value="<?php echo $row->user_type_ID;?>"><?php echo $row->user_type_Name;?></option>
                                                    <?php foreach($result_user_type as $num=>$result){?>
                                                    <option value="<?php echo $result->user_type_ID;?>"><?php echo $result->user_type_Name;?></option>
                                                    <?php }?>
                                                </select>
                                          <!-- <input type="text" class="form-control" name="user_type" id="user_type" value="<?php// echo $row->user_type_Name;?>"> -->
                                        </div>

                                        <div class="col-xs-8">
                                          <label  for="add_holiday">ส่งอีเมล์ถึง/Send email to</label><input type="text" class="form-control" name="send_email_to" id="send_email_to" value="<?php echo $row->send_email_to;?>">
                                        </div>
                                       
                                    </div>
           
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                           <div class="modal-body">
                              <table class="table table-bordered">
                                <tr class="info">
                                    <th><center>การลา<br>Leave Type</center></th>
                                    <th><center>สิทธิ์ที่มีอยู่<br>Maximum allowed</center></th>
                                    <th><center>สิทธิ์เก่ายกมา<br>Oldremanning leaves</center></th>
                                    <th><center>สิทธิ์เก่าใช้ไป<br>Old leaves already taken</center></th> 
                                    <th><center>สิทธิ์ใหม่ใช้ไป<br>New leaves already taken</center></th>
                                </tr>
                                <tr>
                                  <th><?php echo "ลาพักร้อน"."/"."annual Leave"; ?></th>
                                  <th><input type="text" class="form-control chk_num" name="annual_new"  id="annual_new" value="<?php echo $row->annual_new;?>"></th>
                                  <th><input type="text" class="form-control chk_num" name="annual_old"  id="annual_old" value="<?php echo $row->annual_old?>"></th>
                                  <th><input type="text" class="form-control chk_num" name="annual_old_use"  id="annual_old_use" value="<?php echo $row->annual_old_use?>"></th>
                                  <th><input type="text" class="form-control chk_num" name="annual_new_use"  id="annual_new_use" value="<?php echo $row->annual_new_use?>"></th>

                                </tr>
                                <tr>
                                 <th><?php echo "ลากิจ"."/"."casual Leave"; ?></th>
                                    <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                 </tr> 
                                  <th><?php echo "ลาป่วย"."/"."sick Leave"; ?></th>
                                     <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                 </tr> 
                              </table>
                           </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                          <?php //echo form_close();?>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal edit Department-->
                    </td>
                    <td><a class="btn btn-danger" href="<?php echo base_url().index_page();?>/user_setup/del_user/<?php echo $row->user_ID;?>" onclick=" return confirm('คุณต้องการลบใช่หรือไม่')"><i class="glyphicon glyphicon-trash"></i></a></td>  <!--  -->
                    <td><a class="btn btn-info" href="<?php echo base_url().index_page();?>/user_setup/cal_user/<?php echo $row->user_ID;?>" onclick=" return confirm('คุณต้องการคำนวณสิทธิ์การลาใช่หรือไม่')" ><i class="glyphicon glyphicon-hand-up"></i></a></td>
                  </tr>
            </div>
          </div>
        </div>
          <?php endforeach; }?>
            </tbody>
  </table>
          </div>
        </div>
        <?php //echo form_close();?> 
        <div class="panel-footer"></div>
      </div>
    </div>
</div>
</body>
</html>
    <script type="text/javascript">



    $(function(){
      var count = "<?php echo @count($data_user_setup);?>";
      // alert(count);
      if(count != ""){
        for(var i=0; i<count; i++){
          $("#start_date_work"+i).datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true
          });

          $("#birth_date"+i).datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true
          });
        }
      }
      $("#start_date_work").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
            changeYear: true
      });
      $("#birth_date").datepicker({
        dateFormat:'dd/mm/yy',
        changeMonth: true,
            changeYear: true
      });

      // $(".datepicker").datepicker({
      //   dateFormat: 'dd/mm/yy',
      //   changeMonth: true,
      //     changeYear: true
      // });
     
    });

    $('.chk_num').on('keyup', function(){
      var text = $(this).val();
      if(!$.isNumeric(text) && text != ""){
        alert('กรอกได้เฉพาะหมายเลขเท่านั้น');
        $(this).val("");
        $(this).focus();
      }
    });
   
   $('#userID').on('blur', function(){
    var user_ID = $(this).val();
    var $div = $(this);

    if(user_ID != ""){
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "<?php echo base_url('index.php/user_setup/chk_user_ID');?>",
        data: { 'user_ID': user_ID },
        success: function(res){
          if(res=='ERROR'){
            alert('รหัสพนักงานซ้ำ กรุณาตรวจสอบอีกครั้ง');
            $div.focus();
          }
        }
      });
    }
   });
    </script>

<!-- <a href="delete.html" class="ask-custom"><img src="images/trash.png" border="0" align="absbottom" /></a> -->