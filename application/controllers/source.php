<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Source extends CI_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->model("weme/rss","rss");
	}
	
	function index() 
	{
		echo "Hi here is the source";
		$this->rss->get_source_list(1);
	}

}

/* End of file Source.php */
/* Location: ./application/controllers/Source.php */