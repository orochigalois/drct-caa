<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sess
{
	public function __construct()
	{
          
	}
	
	
	/** 设置session
	 * 
	 * @param void $key 键或者数组，如果为数组则不用传递第二个参数
	 * @param void $val ，值或者不传
	 */
	public function set($key, $val = null)
	{
		if(is_array($key))
		{
			foreach ($key as $k=>$v)
			{
				$_SESSION[$k] = $v;
			}
		}
		else
		{
			$_SESSION[$key] = $val;
		}
	}
	
	/** 从session中获取值，如果不旬在返回NULL
	 * 
	 * @param void $key 键
	 * @return void | NULL
	 */
	public function get($key)
	{
		if(array_key_exists($key, $_SESSION))
		{
			return  $_SESSION[$key];
		}
                
		else
		{
			return NULL;
		}
	}
	
	/**
	 * 删除 session 中的值
	 * @param void $key 键
	 */
	public function del($key)
	{
		if(array_key_exists($key, $_SESSION))
		{
			unset($_SESSION[$key]);
		}
	}
	
	/**
	 * 清空 session
	 */
	public function clear()
	{
		$_SESSION = array();
	}
}

/* EOF */