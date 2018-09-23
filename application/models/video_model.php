<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_model extends MY_Model
{
	
	public  $table_name = 'video';
	
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