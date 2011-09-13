<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Rss extends CI_Model 
{
    private $source_table_name  = "sources" ;

	function __construct() 
	{
		parent::__construct();
	}
	
	function get_source_list($cid){
		$query = $this->db->get($this->source_table_name);
        echo $this->db->last_query();
		return $query->row_array();
	}

}

/* End of file Rss.php */
/* Location: ./application/models/Rss.php */