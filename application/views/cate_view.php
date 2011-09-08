<?php $this->load->view('layout/header',array('width'=>"500","sitetitle"=>"weme_server::user_center"));?>
	
	Add category:
	<?php echo form_open_multipart('category/post');?>
		Cate:
		<select name="pid">
			<option value="0"> 请选择..</option>
			<?php echo $option;?>
		</select><br>
		
		Name:<input name="cname" type="text"/> Order:<input name="corder" type="text"/><br>
		Desc:<input name="cdesc" type="text"/> <br>
		icon:<input name="userfile" type="file"/> <br>		
		<input type="submit">
	</form>
	
	<br><br>
	<hr><br><br>
	
	
	Del category:
	<form method="post" action="<?php echo site_url('category/del');?>">
		Cate:<select name="cid">
		<?php echo $option;?>
		</select><br>
		<input type="submit">
	</form>

<?php $this->load->view('layout/footer');?>
