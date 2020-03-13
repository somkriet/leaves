</div>
<div id="footer">
  <div class="container">
    <p class="text-muted credit"><b>MLeave</b> <br/>Version 2.0 copyright © 2013 Meiko Trans(Thailand) Co.,Ltd. all right reserved.
<br/>by IT department</p>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>


    <script type="text/javascript">
      $(function() {
        $( "#datepicker" ).datepicker(
        {
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true
        }
        );
      });
       $(function() {
        $( "#datepicker2" ).datepicker(
        {
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true
        }
        );
      });
    </script>
  </body>
  </html>