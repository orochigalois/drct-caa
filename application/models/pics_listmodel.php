<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pics_listmodel extends MY_Model
{
	
	public  $table_name = 'pics_list';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function postAdd($post = array())
	{
		$data = $post['info'];
		$data['addtime'] = strtotime($data['addtime']);
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