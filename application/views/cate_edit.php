<?php $this->load->view('layout/header',array('width'=>"500","sitetitle"=>"weme_server::user_center"));?>

Edit:
<form method="post" action="<?php echo site_url('category/modify/'.$cate['id']);?>">
Cate:
	<select name="pid">
		<option value="0"> 请选择..</option>
		<?php echo $option;?>
	</select>

Name:<input name="cname" type="text" value="<?php echo $cate['title']?>"/><br>
Desc:<input name="cdesc" type="text" value="<?php echo $cate['desc']?>"/><br>
Order:<input name="corder" type="text" value="<?php echo $cate['sort_order']?>"/><br>
<input type="submit">
</form>


<?php $this->load->view('layout/footer');?>
