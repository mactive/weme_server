<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title><?php echo $sitetitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/style.css" />
</head>
<body>
	<div class="wbox_500 radius_5px">
	Hi, <strong><?php echo $username; ?></strong>! You are logged in now. 
	<br /><?=anchor('/auth/logout/', 'Logout') ?>
	<br /><?=anchor('/auth/change_password', 'Change Password') ?>
	<br /><?=anchor('/auth/change_email', 'Change Email') ?>
	<br /><?=anchor('/auth/unregister', 'Unregister') ?>
	<br /><?=anchor('/weibo/', 'Brand Weibo') ?>
	</div>
</body>
</html>