<?php $this->load->view('layout/header',array('width'=>"500","sitetitle"=>"weme_server::user_center"));?>


	Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <br>Your Level: <?=$fx_role_name?> <br>
	<br /><?=anchor('/auth/logout/', 'Logout') ?>
	<br /><?=anchor('/auth/change_password', 'Change Password') ?>
	<br /><?=anchor('/auth/change_email', 'Change Email') ?>
	<br /><?=anchor('/backend/source', '推荐阅读,给你好看') ?>
	<br /><?=anchor('/category/index', '修改分类') ?>


<?php $this->load->view('layout/footer');?>
