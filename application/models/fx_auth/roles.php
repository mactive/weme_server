<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Model 
{
	private $table_name			= 'roles';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name	= $ci->config->item('db_table_prefix', 'fx_auth').$this->table_name;
	}
	
	function get_all()
	{
		$this->db->order_by('id', 'asc');
		return $this->db->get($this->table_name);
	}
	
	function get_role_by_id($role_id)
	{
		$this->db->where('id', $role_id);
		return $this->db->get($this->table_name);
	}
	
	function create_role($name, $parent_id = 0)
	{
		$data = array(
			'name' => $name,
			'parent_id' => $parent_id
		);
            
		$this->db->insert($this->table_name, $data);
	}
	
	function delete_role($role_id)
	{
		$this->db->where('id', $role_id);
		$this->db->delete($this->table_name);		
	}
	
	
	function get_parent_id($role_id)
	{
		$this->db->where('id', $role_id);
		$query = $this->db->get($this->table_name);
		foreach ($query->result() as $row)
		{
		    return $row->parent_id;
		}
	}
	
	function get_parent_roles_id($role_id){
		
		$parent_id  = $this->get_parent_id($role_id);
		
		$this->db->where('id', $parent_id);
		$query = $this->db->get($this->table_name, 1);
		foreach ($query->result() as $row)
		{
		    return $row->id;
		}
	}
	
}

?>