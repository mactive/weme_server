<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Node extends CI_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->model("weme/model_node","model_node");
	}
	
	function index() 
	{
		echo "=================";
		$this->model_node->get_source_list("1");
	}

}

/* End of file node.php */
/* Location: ./application/controllers/node.php */