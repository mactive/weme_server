<?php 

if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Model_node class
 *
 * @package default 针对节点的编辑
 * @author we&me
 **/ 
class Model_node extends CI_Model 
{

    private $_weibo_table_name  = "weibo_node" ;
	private $_node_id = 'node_id';
	private $_doc_id = 'doc_id';

	function __construct() 
	{
		parent::__construct();
	}
	

	/**
	 * 创建节点
	 */
	public function createNode($data)
	{
		if(!$this->existNode($data['mid'])){
			$this->indertNode($data);
		}else{
			//echo $data['mid']." is existed.";
		}
	}
	
	/**
	 * 是否存在这条message了 mid
	 */
	public function existNode($mid)
	{
		$this->db->select('mid');
		$this->db->where('mid',$mid);
		$query = $this->db->get($this->_weibo_table_name);
		$res = $query->num_rows() > 0 ? TRUE : FALSE;
		return $res;
	}
	
	
	/**
	 * createNode
	 */
	/**/
	public function indertNode($data)
	{

		# code...
		$insert_array = array();
		$insert_array['created_at'] = strtotime($data['created_at']);
		$insert_array['mid'] = $data['mid'];
		$insert_array['text'] = $data['text'];
		$insert_array['source'] = $data['source'];
		$insert_array['favorited'] = $data['favorited'];
		$insert_array['truncated'] = $data['truncated'];
		$insert_array['in_reply_to_status_id'] = $data['in_reply_to_status_id'];
		$insert_array['in_reply_to_user_id'] = $data['in_reply_to_user_id'];
		$insert_array['in_reply_to_screen_name'] = $data['in_reply_to_screen_name'];
		$insert_array['thumbnail_pic'] = empty($data['thumbnail_pic']) ? "": $data['thumbnail_pic'];
		$insert_array['bmiddle_pic'] = empty($data['bmiddle_pic']) ? "" : $data['bmiddle_pic'];
		$insert_array['original_pic'] = empty($data['original_pic']) ? "" : $data['original_pic'];
		
		$insert_array['user_id'] = $data['user_id'];		//weme_user_id
		$insert_array['author'] = $data['author'];	//weibo_author
		
		$this->db->insert($this->_weibo_table_name, $insert_array); 
		
	}
	
	/**
	 * 获得用户的节点ID
	 */
	public function getNodeList($page = '0')
	{
		# code...
		$limit
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id',$user_id);
		$this->db->get($this->_weibo_table_name,0,40,);
		
		
	}

}

/* End of file model_node.php */
/* Location: ./application/models/model_node.php */