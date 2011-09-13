<?php
//session_start();
include_once( APPPATH.'/libraries/Weibooauth.php' );

class Weibo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('json');
		//$this->load->library('Weibooauth');
		//$this->load->library('Fx_auth');
		//$this->load->library('inc');
		//$this->load->library('session');

		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$o = new WeiboOAuth( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') );
		
		$keys = $o->getRequestToken();
		$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , base_url().index_page().'weibo/callback');

		$this->session->set_userdata('keys', $keys);
		//$_SESSION['keys'] = $keys;
		
		echo "<a href=".$aurl.">Use Oauth to login</a>";
		$this->output->enable_profiler(TRUE);
	}
	
	function callback()
	{
		
		//$o = new WeiboOAuth( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );

		$keys=$this->session->userdata('keys');
		$o = new WeiboOAuth( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $keys['oauth_token'] , $keys['oauth_token_secret']  );

		parse_str($_SERVER['REQUEST_URI']);
		
		$last_key = $o->getAccessToken($oauth_verifier) ;

		$this->session->set_userdata('last_key', $last_key);
		//$_SESSION['last_key'] = $last_key;
		
		echo "Accept completea".anchor('weibo/weibolist','Enter you weibolist');

		//$this->output->enable_profiler(TRUE);http://localhost/weme/weibo/callback?oauth_token=1571a85d337ceaf6f7e5266fc663c703&oauth_verifier=851361
	}
	
	function weibolist()
	{
		$last_key=$this->session->userdata('last_key');
		
		$c = new WeiboClient( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $last_key['oauth_token'] , $last_key['oauth_token_secret']);
		$ms = $c->home_timeline(); // done
		$me = $c->verify_credentials();
				
		$data=array(
			'ms'=>$ms,
			'me'=>$me,
		);
	
		$this->load->model("weme/model_node","model_node");
	
		/**/
	
		foreach($ms AS $val){
			$this->model_node->createNode($val);
		}
		

		$this->load->view('welcome_message',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function post_text()
	{
		$last_key=$this->session->userdata('last_key');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', '内容', 'trim|xss_clean|required|max_length[140]');
		//$this->form_validation->set_rules('back_url', '内容', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			show_error('weibo错误');
		}

		else{
			$c = new WeiboClient( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $last_key['oauth_token'] , $last_key['oauth_token_secret']  );
			$c->update( $this->input->post('text'));
			echo "发送成功";
			
		}
		
		
		
	}
	
	
}
?>