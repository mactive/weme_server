<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title>微薄信息</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css" />
</head>
<body>
<div class="wbox_500 radius_5px">
	<img src="<?=$me['profile_image_url']?>" />
	<?=$me['screen_name']?>你好 <?=$me['location']?>
	
	<?php if(is_array($ms)){
		foreach( $ms as $item ){
			?>
			<div style="padding:10px;margin:5px;border:1px solid #ccc">
				<div class="f_left" style="width:80px;"><img src="<?=$item['user']['profile_image_url']?>" /></div>
				<div class="f_left" style="width:380px;"><?=$item['text'];?></div>
				<div class="clear"></div>
			
			</div>		
			<?
		}
	} ?>

	
</div>
</body>
</html>