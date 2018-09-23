<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_model extends MY_Model
{
	public  $table_name = 'ads';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function postAdd($post = array())
	{
		$data = $post['info'];
		//$data['url'] = newUrl($data['url']);
		/*if(!empty($data['simg']))
		{
			_cut_image('static/upfile/ads',$data['simg'],$post['width'],$post['height']);
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