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
		
		//$this->load->library('category_library',$params);
	}
	
	function index()
	{				
		$data['list'] = $this->category_library->getAllCategory();

//		$cate = $this->category_library->getAllCategory();

		$str = $this->category_library->getOptionStr();
		$data['option'] = $str;
		$this->load->view('cate_view', $data);
	}
	
	function post()
	{
		$file_path = $this->do_upload();
		$this->category_library->addCategory($this->input->post('pid'),$this->input->post('cname'),$this->input->post('cdesc'),$this->input->post('corder'),$file_path);
		redirect('category/index');

	}
	function del($cid)
	{
		$this->category_library->delCategory($cid);
		redirect('category/index');
	}
	function edit($cid)
	{
		$data['cate'] = $this->category_library->fetchOne($cid);
		$str = $this->category_library->getOptionStr($cid);
		$data['option'] = $str;
		$this->load->view('cate_edit',$data);
	}
	function modify($cid)
	{
		$temp = $this->do_upload();
		$file_path = empty($temp) ? "" : $temp ;
		$this->category_library->editCategory($cid,$this->input->post('pid'),$this->input->post('cname'),$this->input->post('cdesc'),$this->input->post('corder'),$file_path);
		redirect('category/index');
	}

	function do_upload()
	{
	  	$config['upload_path'] = './uploads/';
	  	$config['allowed_types'] = 'gif|jpg|png';
	  	$config['max_size'] = '200';
	  	$config['encrypt_name']  = TRUE;

	  	$this->load->library('upload', $config);
	
	  	if ( ! $this->upload->do_upload('cicon'))
	  	{
	   		$error = array('error' => $this->upload->display_errors());
			//print_r($error);
	   		//$this->load->view('upload_form', $error);
	  	} 
	  	else
	  	{
	   		$data = array('upload_data' => $this->upload->data());
			//echo "upload_success";
			//print_r($data);
			$file_path = $config['upload_path'].$data['upload_data']['file_name'];
			return $file_path;
	   		//$this->load->view('upload_success', $data);
	  	}
	}
	
	
	function source_list()
	{
		$cid = $this->uri->segment(3);
		echo $cid;
		$this->load->model('weme/source','source');
		$data['list'] = $this->source->get_source_list($cid);

		$this->load->view('source_view',$data);
	}
	
	
	
}

/* End of file category.php */
/* Location: ./system/application/controllers/category.php */