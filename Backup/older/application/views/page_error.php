<div class="container">
	<div class="bs-message">
		<?php if($status==1){?>
		<div class="alert alert-block alert-danger fade in">
			<a href="<?php echo base_url().index_page();?>/setting/index" class="close">&times;</a>
			<h4>ต้องขออภัยด้วย !</h4>
			<p>คุณไม่สามารถลบข้อมูลนี้ได้ โปรดลบข้อมูลในวิธีที่ถูกต้อง และอย่าทำแบบนี้อีกนะ จากใจ Administrator. ถ้ายังมีปัญหาติดต่อได้ที่ <a href="http://www.facebook.com/ben.ubu" target="_blank">คลิก</a></p>
		</div>
		<?php }?>
	</div>
</div>