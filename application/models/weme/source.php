<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Source extends CI_Model 
{
	public $source_table_name = "sources";
	function __construct() 
	{
		parent::__construct();
	}
		
	function get_source_list($cid){
		echo "===============";
		if($cid){
			$this->db->where('cat_id'=>$cid);
		}
		$query = $this->db->get($source_table_name);
		echo $this->db->last_query();
		return $query->row_array(); 
				
	}

}

/* End of file class_name.php */
/* Location: ./application/models/class_name.php */