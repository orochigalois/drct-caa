<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminroles
{
	private $ci = null;
	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->library('sess');
	}


	/**
	 * 权限
	 * @global type $RTR 
	 * @放在后台代码的各个方法的第一行即可，没有权限的就不能访问这个方法
	 */
	public function has_authz()
	{
		$uid = $this->ci->sess->get('uid'); 
		if(!$uid)
		{
			header('Location:'.site_url('admin/admin/login'));exit;
		}
		else
		{
			global $RTR;
			$class = $RTR->fetch_class();
			$method = $RTR->fetch_method();
		}
	}

	 /**
	 *根据类和方法判断该当前登录用户是否有权限,用于后台左侧导航是否显示判断
	 * @param type $method 
	 * @param type $class 
	 */
	public function get_admin_authz($class='',$method='')
	{
		 $uid = $this->ci->sess->get('uid');
		 if (!($class && $method)) return false;
		 if(!$uid) return false;
		 $user_modular = $this->admin_modular_by_uid($uid);
		 if(array_key_exists($class, $user_modular))
		 {
			 if(count($user_modular[$class])==0)
			 {
				 return true;
			 }elseif(in_array($method,$user_modular[$class]))
			 {
				 return true;
			 } else
			 {
				 return false;
			 }
		 }else
		 {
			 return false;
		 }
	}
}