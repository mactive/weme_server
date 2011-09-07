<h2> <?=$me->name?>你好~</h2>

<h2>发送新微博</h2>
<form action="<?=base_url().index_page()?>weibo/post_text" method="POST">
<input type="text" name="text" style="width:300px" value="文字内容" />
<input type="submit" />
</form>
<?php
/*
if( isset($_REQUEST['text']) || isset($_REQUEST['avatar']) )
{

if( isset($_REQUEST['pic']) )
	$rr = $c ->upload( $_REQUEST['text'] , $_REQUEST['pic'] );
elseif( isset($_REQUEST['avatar']  ) )
	$rr = $c->update_avatar( $_REQUEST['avatar'] );
else
	$rr = $c->update( $_REQUEST['text'] );	

	echo "<p>发送完成</p>" ; 

}
*/
?>

<?php if( is_array( $ms ) ): ?>
<?php foreach( $ms as $item ): ?>
<div style="padding:10px;margin:5px;border:1px solid #ccc">
<?=$item->text;?>
</div>
<?php endforeach; ?>
<?php endif; ?>