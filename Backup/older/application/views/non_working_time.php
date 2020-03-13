<div class="container">
<div class="row">
        <div class="col-md-12">
           <a href="<?php echo base_url().index_page();?>/home/index">หน้าแรก</a> / ปฏิทินวันหยุด</h5>
        </div>
    </div>
    <div class="space-top"></div>
    <div class="bs-non_working_time">
    <div class="row">
        <div class="col-md-12">
            <h3>ปฎิทินวันหยุดประจำปี <?php echo date('Y');?> / Holiday Calendar for <?php echo date('Y');?></h3>
            <table class="table table-condensed  table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วันหยุด</th>
                        <th>วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $date_now=date('Y-m-d');
                    foreach($non_working_time as $num=>$rows){
                        ?>
                        <tr class="<?php if($rows->non_working_time < $date_now){echo 'danger';}?>">
                            <td><?php echo $num+=1;?></td>
                            <td><?php echo $rows->detail;?></td>
                            <td><?php echo date('d/m/Y',strtotime($rows->non_working_time));?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>