
<!DOCTYPE html>
<html>
<head>
    <title></title>
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
</head>
<body>
    <label for="id_select">Test label YEag</label>
    <select id="id_select" class="selectpicker bla bla bli" multiple data-live-search="true">
        <option>cow</option>
        <option>bull</option>
        <option class="get-class" disabled>ox</option>
        <optgroup label="test" data-subtext="another test" data-icon="icon-ok">
            <option>ASD</option>
            <option selected>Bla</option>
            <option>Ble</option>
        </optgroup>
    </select>

    <div class="container">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="bs3Select" class="col-lg-2 control-label">Test bootstrap 3 form</label>
                <div class="col-lg-10">
                    <select id="bs3Select" class="selectpicker show-tick form-control" multiple data-live-search="true">
                        <option>cow</option>
                        <option>bull</option>
                        <option class="get-class" disabled>ox</option>
                        <optgroup label="test" data-subtext="another test" data-icon="icon-ok">
                            <option>ASD</option>
                            <option selected>Bla</option>
                            <option>Ble</option>
                        </optgroup>
                    </select>
                </div>
              </div>
        <form>
    </div>

</body>
</html>
