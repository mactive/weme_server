<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('fx_auth');
	}

	function index()
	{
		if (!$this->fx_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->fx_auth->get_user_id();
			$data['username']	= $this->fx_auth->get_username();			
			$data['fx_role_name'] = $this->session->userdata('fx_role_name');
			if($data['fx_role_name'] == "Admin"){
				$this->load->view('welcome_admin', $data);
			}else{
				$this->load->view('welcome', $data);
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */