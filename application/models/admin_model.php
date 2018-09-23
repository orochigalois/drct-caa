<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_Model
{
	public $table_name = 'admin';
	
	public function __construct()
	{
		parent::__construct();
	}

	public 	function login($username,$userpass)
	{
		$user = $this->row(array('username'=>$username));
		if($user && $user['userpwd']==md5pass($userpass,$user['salt']))
		{
			$this->sess->set('uid', $user['id']);
			$this->sess->set('isLogin', TRUE);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function postAdd($post = array())
	{
		$salt = random_string('alnum',6);
		$data['username'] = $post['username'];
		if(!empty($post['password']))
		{
			$data['salt']= $salt;
			$data['userpwd'] = md5pass($post['password'],$salt);
		}
		if(empty($post['id']))
		{
			$bool = $this->add($data);
		}
		else
		{
			$bool = $this->edit($post['id'],$data);
		}
		return $bool;
	}
}

/* file end */