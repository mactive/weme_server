<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents source authentication data. It operates the following tables:
 * - source category,
 * - source
 *
 * @package		weme
 * @author		Mactive meng(http://www.we-media.org)
 * @version		1.0.0
 */
class Source extends CI_Model
{
	private $cat_table_name		= 'source_category';			// user accounts
	private $source_table_name	= 'sources';	// user profiles
	
	function __construct()
	{
		parent::__construct();

		$this->_prefix 				= $this->config->item('db_table_prefix','fx_auth');
		//$this->profile_table_name 	= $this->_prefix.$this->config->item('db_user_profile_table','fx_auth');
	}
	
	function get_category_list(){
		
	}
}

?>