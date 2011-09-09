<?php $this->load->view('layout/header',array('width'=>"750","sitetitle"=>"weme_server::user_center"));?>
	
	
	<ul class="category_list">
	<?php foreach($list AS $val){ ?>
 		<li class="radius_3px li_<?=$val['level']?>">
			<div class="icon f_left"><img src="<?=base_url().$val['icon']?>" height="40"/></div>
				<?=$val['title']?> <span class="grey999"><?=$val['desc']?></span>
				<a href="<?=site_url('category/del/'.$val['id'])?>">del</a>
				<a href="<?=site_url('category/edit/'.$val['id'])?>">edit</a>
				<a href="<?=site_url('category/source_list/'.$val['id'])?>">list</a>
		</li>
	<?}?>
	</ul>
	
	
	
	<br><br><hr><br><br>
	
	
	Add category:
	<?php echo form_open_multipart('category/post');?>
		Cate:
		<select name="pid">
			<option value="0"> 请选择..</option>
			<?php echo $option;?>
		</select><br>
		
		Name:<input name="cname" type="text"/> Order:<input name="corder" type="text"/><br>
		Desc:<input name="cdesc" type="text"/> <br>
		icon:<input name="cicon" type="file"/> <br>		
		<input type="submit">
	</form>


<?php $this->load->view('layout/footer');?>
