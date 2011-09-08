<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$params = array(
			'tableName'=>'source_category',
			'filedId'=>'id',
			'filedCname'=>'title',
			'filedCdesc'=>'desc'
		);
		$this->load->library('category_library',$params);
	}
	
	function index()
	{				
		echo $this->category_library->getListStr();
		
//		$cate = $this->category_library->getAllCategory();
//		foreach($cate as $item)
//		{
//			echo str_repeat('&nbsp;',$item['clevel']*5).$item['cname']."<br/>";
//		}
		$str = $this->category_library->getOptionStr();
		$data['option'] = $str;
		$this->load->view('cate_view', $data);
	}
	
	function post()
	{
		//$this->easypost->post();	
		$this->category_library->addCategory($this->input->post('pid'),$this->input->post('cname'),$this->input->post('cdesc'),$this->input->post('corder'));
		//echo $this->input->post('cname');
		redirect('category/index');
	}
	function del()
	{
		$this->category_library->delCategory($this->input->post('cid'));
		redirect('category/index');
	}
	function edit($cid)
	{
		$data['cate'] = $this->category_library->fetchOne($cid);
		$str = $this->category_library->getOptionStr();
		$data['option'] = $str;
		$this->load->view('cate_edit',$data);
	}
	function modify($cid)
	{
		$this->category_library->editCategory($cid,$this->input->post('pid'),$this->input->post('cname'),$this->input->post('cdesc'),$this->input->post('corder'));
		redirect('category/index');
	}
}

/* End of file category.php */
/* Location: ./system/application/controllers/category.php */