<?php
session_start();
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

		//$this->session->set_userdata('keys', $keys);
		$_SESSION['keys'] = $keys;
		
		echo "<a href=".$aurl.">Use Oauth to login</a>";
		$this->output->enable_profiler(TRUE);
	}
	
	function callback()
	{
		
		$o = new WeiboOAuth( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );

		//$keys=$this->session->userdata('keys');
		//$o = new WeiboOAuth( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $keys['oauth_token'] , $keys['oauth_token_secret']  );

		parse_str($_SERVER['REQUEST_URI']);
		
		$last_key = $o->getAccessToken($oauth_verifier) ;

		$_SESSION['last_key'] = $last_key;
		
		echo "授权完成".anchor('weibo/weibolist','进入你的微博列表页面');

		//$this->output->enable_profiler(TRUE);
	}
	
	function weibolist()
	{
		$c = new WeiboClient( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']);
		$ms = $c->home_timeline(); // done
		$me = $c->verify_credentials();
				
		$data=array(
			'ms'=>$ms,
			'me'=>$me,
		);

		$this->load->view('welcome_message',$data);
		//$this->output->enable_profiler(TRUE);
	}
	
	function post_text()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', '内容', 'trim|xss_clean|required|max_length[140]');
		//$this->form_validation->set_rules('back_url', '内容', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			show_error('weibo错误');
		}

		else{
			$c = new WeiboClient( $this->config->item('WB_AKEY') , $this->config->item('WB_SKEY') , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
			$c->update( $this->input->post('text'));
			echo "发送成功";
			
		}
		
		
		
	}
	
	
}
?>