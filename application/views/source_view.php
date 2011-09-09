<?php $this->load->view('layout/header',array('width'=>"750","sitetitle"=>"weme_server::source_view"));?>



<ul class="category_list">
<?php foreach($list AS $val){ ?>
	<li class="radius_3px li_<?=$val['level']?>">
			<?=$val['title']?> <span class="grey999"><?=$val['desc']?></span>
			<a href="<?=site_url('category/del/'.$val['id'])?>">del</a>
	</li>
<?}?>
</ul>

<?php $this->load->view('layout/footer');?>
