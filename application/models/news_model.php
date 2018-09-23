<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends MY_Model
{
	var $ids;
	public $table_name = 'news';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Newstype_model');
	}

	public function postAdd($post = array())
	{
		$data = $post['info'];
		$data['addtime'] = strtotime($data['addtime']);
		if(!empty($post['file'])){
			$imgs  = isset($post['file']) ? $post['file']['name'] : '';
			$names = isset($post['names']) ? $post['names']: '';
			$count = count($imgs);

			$o_arr = array();
			$o_n_arr = array();
			if(!empty($post['id'])){
			  $row = $this->row( array('id' => $post['id']),'imgs,names' );
			  if( !empty($row['imgs'])){
				  $o_arr = unserialize($row['imgs']);
			  }
			  
			  if( !empty($row['names'])){
				  $o_n_arr = unserialize($row['names']);
			  }
			}
			
			if( !empty($imgs[0]))
			{
				for($i=0;$i<$count;$i++)
				{
					$array['name']  = $post['file']['name'][$i];
					$array['type']  = $post['file']['type'][$i];
					$array['tmp_name']  = $post['file']['tmp_name'][$i];
					$array['error']  = $post['file']['error'][$i];
					$array['size']  = $post['file']['size'][$i];
					$image = uploadFile($array,'static/upfile',0,0);
					$arr[$i] = $image;
				}

				//图片集
				if(!empty($o_arr)){
				  $pic_arr = array_merge($o_arr,$arr);
				}else{
			      $pic_arr = $arr;
				}
				$data['imgs'] = serialize($pic_arr);
				
				//名称集
				if(!empty($o_n_arr)){
				  $n_arr = array_merge($o_n_arr,$names);
				}else{
			      $n_arr = $names;
				}
				$data['names'] = serialize($n_arr);
			}
		}
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

	public function _news_ids($pid=0)
	{
		$where = array('pid'=>$pid);
		$list = $this->Newstype_model->select($where, 'id', 0, 0);
		if( !empty($list) )
		{
			foreach($list as $key=>$val)
			{
				$this->ids .= $val['id'].',';
				if(isset($val['id']) != null)
				{
					$this->_news_ids($val['id']);
				}
			}
		}
		else
		{
			$this->ids  .= $pid.',';
		}	 //重复调用无下级分类ID
	}
    /**
	 * 取得指定栏目新闻
	 * @param $catid 数组或者单个id
	 * @return 
	 */
	public function get_ids($cateid = 0)
	{
		  
		 $this->_news_ids($cateid);
		 $array_ids = array();
		 if(!empty($this->ids) or isset($this->ids))
		 {
		   $array_ids = array_unique(explode(',',rtrim($this->ids,',')));
		   $this->ids = '';
		 }
		return  $array_ids; 
	}
  
	/**
	  *上一页下一页
	  *@param p 上一页
	  *@param n下一页
	  */
	
	public function get_pn_info($id = 0, $where = '', $type = 'p')
	{
	
		$index_key = 0;
		$list =  $this->select($where,'id,title,ord', 0, 0, 'ord ASC,addtime DESC,id DESC');
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