<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NewsType_model extends MY_Model
{
   
	var $options;
	var $trs;
	var $lis;
	var $postion = array();
	var $par_row = array();
	public $table_name = 'news_type';
	
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
	*取得所有新闻类型
	*@param 
	*@return 
	*/
	function news_type_info($pid = 0, $flag = TRUE)
	{
		//二级
		$arrays = array();
		$where = array();
		$where['pid'] = $pid;
		/*if(!$flag) {
			$where['class !='] = 'about';
		}*/
		$list = $this->select($where, '*', 0, 0, 'ord ASC,id ASC');
		foreach($list as $key=>$values)
		{
			$arrays[$values['id']]['id'] = $values['id'];
			$arrays[$values['id']]['title'] = $values['title'];
			$arrays[$values['id']]['ename'] = $values['ename'];
			$arrays[$values['id']]['pid'] = $values['pid'];
			$arrays[$values['id']]['ord'] = $values['ord'];
			$arrays[$values['id']]['class'] = $values['class'];
			$arrays[$values['id']]['is_lower'] = $values['is_lower'];
			$arrays[$values['id']]['is_delete'] = $values['is_delete'];
			$arrays[$values['id']]['catid'] = $this->news_parent_type_info($values['id'], $flag);
		}
		return $arrays;
	}
	//得到此分类下的
	public function news_parent_type_info($parent_id=0, $flag = TRUE)
	{
		$arg = array();
		$where = array();
		$where['pid'] = $parent_id;
		if(!$flag) {
			$where['class !='] = 'about';
		}
		$list = $this->select($where, '*', 0, 0, 'ord ASC,id ASC');
		if(!empty($list) || $parent_id == 0)
		{
			foreach($list as $key=>$row)
			{
				$arg[$row['id']]['id'] = $row['id'];
				$arg[$row['id']]['title'] = $row['title'];
				$arg[$row['id']]['ename'] = $row['ename'];
				$arg[$row['id']]['pid'] = $row['pid'];
				$arg[$row['id']]['ord'] = $row['ord'];
				$arg[$row['id']]['class'] = $row['class'];
				$arg[$row['id']]['is_lower'] = $row['is_lower'];
				$arg[$row['id']]['is_delete'] = $row['is_delete'];
				
				if(isset($row['id']) != null)
				{
					 $arg[$row['id']]['catid'] = $this->news_type_info($row['id']);
				}
			}

		}
		return $arg;
	}
	
	/*无限极分类start*/
	public function get_options($catid = 0,$parid = 0)
	{
		$array = $this->news_type_info($parid,false);
		foreach($array as $key=>$value)
		{
			$this->options .= '<option value="'.$key.'" ';
			if($catid == $key)
			{
				$this->options .= 'selected';
			}
			if(!empty($value['catid']))
			{
				$this->options .= 'disabled="disabled"';
			}
			$this->options .=  '>'.'[1级]'.$value['title'].'</option>';
			if(!empty($value['catid']))
			{
				$this->_options($catid,$value['catid']);
			}
		}

		return $this->options;

	}

	/**
	*获取所有下级分类select
	*@param array $catid 分类ID
	*@param array $catids 下级分类
	*@param array $index 分类级别
	*/
	public function _options($catid = 0,$catids = array(),$index = 1)
	{
		$index++;
		foreach($catids as $key=>$value)
		{
			$this->options  .= '<option value="'.$key.'"';
			if($catid == $key)
			{
				$this->options .= 'selected';
			}
			if(!empty($value['catid']))
			{
				$this->options .= 'disabled="disabled"';
			}
			$this->options  .= '>';
			for($i=1;$i<$index;$i++)
			{
				$this->options .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			$this->options  .= '['.$i.'级]'.$value['title'].'</option>';

			if(!empty($value['catid']))
			{
					$this->_options($catid,$value['catid'],$index);
			}
		}

	}


	public function get_trs($parid = 0)
	{
		$array = $this->news_type_info($parid);
		foreach($array as $key=>$value)
		{
			$this->trs .= '<tr><td width="482" class="ts"><font>[1级]</font>'.$value['title'].'</td><td width="150" align="center">'.$value['ord'].'</td><td  align="center">';
			if($value['is_lower']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/news/addType'.'?id='.$value['id']).'" class="xga2">添加</a>';
			}
			$this->trs .= '<a href="'.site_url('admin/news/editType'.'?id='.$value['id']).'" class="xga">修改</a></td></tr>';
			if(!empty($value['catid']))
			{
				$this->_trs($value['catid']);
			}
		}
		return $this->trs;
	}
	/**
	* 获取所有下级分类table
	* @param array $catid 分类ID
	*	@param array $catids 下级分类
	*@param array $index 分类级别
	*/
	public function _trs($catids = array(),$index = 1)
	{
		$index++;
		foreach($catids as $key=>$value)
		{
			$model = '';
			if($value['class'] == 'about') {
				$model = '<font>[单页模型]</font>';
			} elseif($value['class'] == 'link') {
				$model = '<font>[外链模型]</font>';
			}
			$this->trs  .= '<tr><td class="ts ts'.$index.'"><font>['.$index.'级]</font> '.$value['title'].$model.'</td><td align="center">'.$value['ord'].'</td><td align="center">';
			if($value['is_lower']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/news/addType'.'?id='.$value['id']).'" class="xga2">添加</a>';
			}
			$this->trs .= '<a href="'.site_url('admin/news/editType'.'?id='.$value['id']).'" class="xga">修改</a>';
			if($value['is_delete']==1)
			{
				$this->trs .= '<a href="'.site_url('admin/news/delType'.'?id='.$value['id']).'" class="xga" onClick="return isDel(\'确定要删除吗?\')">删除</a>';
			}
			$this->trs .= '</td></tr>';
			if(!empty($value['catid']))
			{
					$this->_trs($value['catid'],$index);
			}
		}
	}

	/*左侧无限极分类*/
	public function get_lis($parid = 0,$id = 0,$url = '')
	{
		$parRow = $this->row(array('id'=>$id),'id,title,pid');
		$array = $this->news_type_info($parid);
		if(!empty($array))
		{
			foreach($array as $key=>$value)
			{
				$this->lis  .= '<a';
				if($id == $value['id'] || $value['id'] == $parRow['pid'])
				{
					$this->lis  .= ' class="on_2"';
				}
				$this->lis  .= ' href="'.$url.$value['id'].'">'.$value['title'].'</a>';
			}
		}
		else
		{
			$row = $this->row( array('id' => $parid) );
			$this->lis  .= '<a class="on_2" href="'.$url.$parRow['id'].'">'.$parRow['title'].'</a>';
		}
		return $this->lis;
	}
	/**
	* 获取所有下级分类table
	* @param array $catid 分类ID
	*	@param array $catids 下级分类
	*@param array $index 分类级别
	*/
	public function _lis($catids = array(),$id = 0,$url = '',$index = 1)
	{
		$index++;
		$this->lis  .= '<li class="leftMenu'.$index.'"><dl>';
		foreach($catids as $key=>$value)
		{
			
			$this->lis  .= '<dd ';
			if($id == $value['id'])
			{
				$this->lis  .= 'class="on"';
			}
				$this->lis  .= '><a href="'.$url.$value['id'].'">'.$value['title'].'</a></dd>';
	 
			if(!empty($value['catid']))
			{
					$this->_lis($value['catid'],$id,$url,$index);
			}
		}
		$this->lis  .= '</dl></li>'; 
	}
	/*无限极分类end*/



	/*面包屑导航*/
	public function get_postion($parid = 0,$url = '')
	{
		$row = $this->row( array('id' => $parid) );
		$this->postion['<span class="xz">'.$row['title'].'</span>'] = $url.$row['id'];
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
		$row = $this->row( array('id' => $catids) );
		if(in_array($row['id'],array(2,3))){
			$this->postion[$row['title']] = site_url('race?catid='.$row['id']);
		}else{
			$this->postion[$row['title']] = $url.$row['id'];
		}
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