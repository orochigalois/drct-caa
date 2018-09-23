<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends MY_Model
{
	
	public  $table_name = 'message';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function postAdd($post = array())
	{
		$data = array();
		foreach($post['info'] as $key => $value){
			$data[$key] = safe_replace($value);
		}
		$data['addtime'] = time();
		//print_r($data);exit;
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