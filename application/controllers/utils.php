<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends Echina
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function avatar($uid)
	{
		$this->load->model('user');
		$user = $this->user->get_userinfo('uid', $uid);
		$file = WEB_ROOT_PATH . $user['avatar'];
		if(file_exists($file))
		{
			echo file_get_contents($file);
		}
	}
	// 验证码
	public function scode()
	{
		$this->load->library('scode');
		echo $this->scode;
	}

	 
}