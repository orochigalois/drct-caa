<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_model extends MY_Model
{
	var $trs;
	var $lis;
	var $postion = array();
	var $par_row = array();
	public $table_name = 'about';
	public function __construct()
	{
		parent::__construct();
	}

	public function postAdd($post = array())
	{
		$data = $post['info'];
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
	/**
	*取得所有单页
	*@param 
	*@return 
	*/
	public function about_info($pid=0)
	{
		$arg = array();
		$where = array('pid'=>$pid);
		$list = $this->select($where, '*', 0, 0, 'ord ASC,id ASC');
		return $list;
	}
	
	/*无限极分类start*/
	 public function get_trs($parid = 0)
	{
		$array = $this->about_info($parid);
		foreach($array as $key=>$value)
		{
			$this->trs .= '<tr><td width="482" class="ts"><font>[1级]</font>'.$value['title'].'</td><td width="150" align="center">'.$value['ord'].'</td><td  align="center">';
			if($value['is_lower']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/about/add'.'?id='.$value['id']).'" class="xga2">添加</a>';
			}
			$this->trs .= '<a href="'.site_url('admin/about/edit'.'?id='.$value['id']).'" class="xga">修改</a></td></tr>';
			unset($key);
			if($value['pid'] == $parid)
			{
				$this->_trs($this->about_info($value['id']));
			}
		}
		
		return $this->trs;
	}
	/**
	*获取所有下级分类table
	*@param array $catid 分类ID
	*@param array $catids 下级分类
	*@param array $index 分类级别
	*/
	public function _trs(&$catids,$index = 1)
	{
		$index++;
		foreach($catids as $key=>$value)
		{
			$this->trs  .= '<tr><td class="ts ts'.$index.'"><font>['.$index.'级]</font> '.$value['title'].'</td><td align="center">'.$value['ord'].'</td><td align="center">';
			if($value['is_lower']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/about/add'.'?id='.$value['id']).'" class="xga2">添加</a>';
			}
			$this->trs .= '<a href="'.site_url('admin/about/edit'.'?id='.$value['id']).'" class="xga">修改</a>';
			if($value['is_delete']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/about/del'.'?id='.$value['id']).'" class="xga" onClick="return isDel(\'确定要删除吗?\')">删除</a>';
			}
			$this->trs .= '</td></tr>';
			unset($key);
			$this->_trs($this->about_info($value['id']),$index);
			
		}
	
	}

	/*左侧无限极分类*/
	public function get_lis($parid = 0,$id = 0,$url = '')
	{
		$array = $this->about_info($parid);
		if(!empty($array))
		{
			foreach($array as $key=>$value)
			{
				$list = $this->about_info($value['id']);
				$this->lis  .= '<a';
				if($id == $value['id'])
				{
					$this->lis  .= ' class="on_2"';
				}
				$this->lis  .= ' href="'.$url.$value['id'].'">'.$value['title'].'</a>';
				/*if($list)
				{
					$this->_lis($list,$id,$url);
				}*/
			}
		}
		else
		{
			$row = $this->row( array('id' => $parid) );
			$this->lis  .= '<a class="on_2" href="'.$url.$row['id'].'">'.$row['title'].'</a>';
		}
		return $this->lis;
	}
	/**
	*获取所有下级分类table
	*@param array $catid 分类ID
	*@param array $catids 下级分类
	*@param array $index 分类级别
	*/
	public function _lis(&$catids,$id = 0,$url = '',$index = 1)
	{
		$index++;
		$this->lis  .= '<ul>';
		foreach($catids as $key=>$value)
		{
			$this->lis  .= '<li ';
			if($id == $value['id'])
			{
				$this->lis  .= 'class="on"';
			}
				$this->lis  .= '><a href="'.$url.$value['id'].'">'.$value['title'].'</a></li>';
			unset($key);
			$this->_lis($this->about_info($value['id']),$id,$url,$index);
		}
		$this->lis  .= '</ul></li>'; 
	}
	/*无限极分类end*/



	/*面包屑导航*/
	public function get_postion($parid = 0,$url = '')
	{
		$row = $this->row( array('id' => $parid ) );
		$this->postion[$row['title']] = $url.$row['id'];
		if( $row['pid'] != 0)
		{
			$this->_postion($row['pid'],$url);
		}
		else
		{
			$this ->par_row = $row;
		}
		$this->postion['首页'] = site_url();
		return array_reverse($this->postion,true);
	}

	public function _postion($catids = '',$url = '')
	{
		$row = $this->row( array('id' => $catids ) );
		$this->postion[$row['title']] = $url.$row['id'];
		if( $row['pid'] != 0)
		{
			$this->_postion($row['pid'],$url);
		}
		else
		{
			$this ->par_row = $row;
		}
	}
}

/* file end */