<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pics_model extends MY_Model
{
	
	public  $table_name = 'pics';
	
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
	
	
	public function get_pn_info($id = 0, $where = '', $type = 'p')
	{
	
		$index_key = 0;
		$list =  $this->select($where,'id,title,simg,ord', 0, 0, 'ord ASC,addtime DESC,id DESC');
		$allnum = count($list);
	
		foreach($list as $key => $val){
			if($val['id'] == $id){
				$index_key = $key;
				break;
			}
		}
		if($type == 'p' && ($index_key-1) >= 0){
			return $list[($index_key-1)];
		}else if($type == 'n' && ($index_key+1) < $allnum){
			return $list[($index_key+1)];
		}
		return '';
	}
 
}

/* file end */