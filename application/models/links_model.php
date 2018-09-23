<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_model extends MY_Model
{
	
	public  $table_name = 'links';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function postAdd($post = array())
	{
		$data = $post['info'];
		$data['url'] = newUrl($data['url']);
		/*if(!empty($data['simg']))
		{
			$exp = explode('*',$post['size']);
			_cut_image('static/upfile/links',$data['simg'],$exp[0],$exp[1]);
		}*/
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