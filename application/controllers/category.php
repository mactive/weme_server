<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		
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
	
	
	function do_upload()
	{
	  	
	}
	
	
	function post()
	{
		//$this->easypost->post();	
		
		$config['upload_path'] = './uploads/';
	  	$config['allowed_types'] = 'gif|jpg|png';
	  	$config['max_size'] = '100';
	  	$config['encrypt_name']  = TRUE;

	  	$this->load->library('upload', $config);

	  	if ( ! $this->upload->do_upload())
	  	{
	   		$error = array('error' => $this->upload->display_errors());
			print_r($error);
	   		//$this->load->view('upload_form', $error);
	  	} 
	  	else
	  	{
	   		$data = array('upload_data' => $this->upload->data());
			//echo "upload_success";
			print_r($data);
			$file_path = $config['upload_path'].$data['upload_data']['file_name'];
			$this->category_library->addCategory($this->input->post('pid'),$this->input->post('cname'),$this->input->post('cdesc'),$this->input->post('corder'),$file_path);
			redirect('category/index');
			
	   		//$this->load->view('upload_success', $data);
	  	}


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