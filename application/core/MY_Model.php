<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected  $table_name = NULL;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function setWhere($getwhere)
	{
		if(is_array($getwhere)){
			foreach($getwhere as $key=>$where){
				switch($key)
				{
					case 'like':
						$this->db->like($where);
						break;
					case 'or_like':
						$this->db->or_like($where);
						break;
					case 'or':
						$this->db->or_where($where);
						break;
					case 'where_not_in':
						foreach($where as $k=>$value)
						{
							$this->db->where_not_in($k,$value);
						}
						break;
					default:
						if(is_array($where))
						{
							$this->db->where_in($key, $where);
						}
						else
						{
							$this->db->where($key,$where);
						}
						break;
				}
			}
		}
		else
		{
			$this->db->where($getwhere);
		}
	}
	/**
	 *获取单条信息
	*@param array $data 数组条件
	*@param string $select 查询字段
	*@param int $pageStart 从0开始
	*@param int $pageNum 最大条数
	*@param string $order 排序
	*@return 数据总数和数组
	*/
	public function select($getwhere = '', $select = '*', $pageStart = 1, $pageNum = 20, $order = 'id ASC',$is_select = TRUE)
	{
		$data = array();
		$limit = '';
		if(!empty($getwhere))
		{
			$this->setWhere($getwhere);
		}
		if($pageNum > 0)
		{
			$this->db->limit($pageNum,$pageStart);
		}
		$result = $this->db->select($select,$is_select)
									->order_by($order)
									->get($this->db->dbprefix.$this->table_name);
									
		if($result->num_rows() > 0)
		{
			$data = $result->result_array();
		}
		
		return $data;
	}
	
	public function total($getwhere = '')
	{
		if(!empty($getwhere))
		{
			$this->setWhere($getwhere);
		}
		$result = $this->db->get($this->db->dbprefix.$this->table_name);
		$count = $result->num_rows();
		
		return $count;
	}
	/**
	 *获取单条信息
	*@param array $data 数组条件
	*@param string $select 查询字段
	*@return 单条数据
	*/
	public function row($where, $select = '*', $order = 'id ASC', $is_select = TRUE)
	{
		$re = $this->db
						->select($select,$is_select)
						->where($where)
						->order_by($order)
						->get($this->db->dbprefix.$this->table_name);
		if($re->num_rows())
		{
			$data = $re->result_array();
			return $data[0];
		}
		else
		{
			return array();
		}
	}
	/**
	 *添加信息
	*@param array $data 数组
	*@return bool
	*/
	public function add($data)
	{
		if(is_array($data))
		{
			return $this->db->insert($this->db->dbprefix.$this->table_name, $data);
		}
		else
		{
			return FALSE;
		}
	}
	/**
	 *修改信息
	*@param int $id ID值
	*@param array $data 数组
	*@return
	*/
	public function edit($id,$data)
	{
		if(!$id) return;
		$res = $this->db->update($this->db->dbprefix.$this->table_name,$data,array('id'=>$id));
		return $res;
	}
	
	public function editSet($id,$data)
	{
		if(is_array($data))
		{
			foreach($data as $k=>$c)
			{
				$this->db->set($k,$c,FALSE);
			}
		}
		$this->db->where(array('id'=>$id));
		$res = $this->db->update($this->db->dbprefix.$this->table_name);
		return $res;
	}
	/**
	 *删除信息
	*@param
	*@return
	*/
	public function  del($getwhere)
	{
		if(!empty($getwhere))
		{
			$this->setWhere($getwhere);
		}
		$re = $this->db->delete($this->db->dbprefix.$this->table_name);
		if(1 == $re)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 *返回字段注释和字段名
	*@param
	*@return
	*/
	public function  list_fields()
	{
		$list = $this->db->list_fields($this->db->dbprefix.$this->table_name);
		if(!empty($list))
		{
			return $list;
		}
		else
		{
			return array();
		}
	}

	  /**
     * 取得指定栏目新闻
     * @param
     * @return
     */
    public function get_catid_info($catid = '', $getwhere='', $select = '*', $pageStart = 0, $pageNum = 20, $order = 'id ASC',$is_select = TRUE)
    {
        $data = array();
        $limit = '';
        if(!empty($catid))
        {
            $allcid=$this->getallclassid($catid,$this->table_name."_type");
            $this->db->where("bid in (".$allcid.")");
        }
		if(!empty($getwhere))
		{
			$this->setWhere($getwhere);
		}
        if($pageNum > 0)
        {
            $this->db->limit($pageNum,$pageStart);
        }
        $result = $this->db->select($select,$is_select)
            ->order_by($order)
            ->get($this->db->dbprefix.$this->table_name);
        if($result->num_rows() > 0)
        {
            $data = $result->result_array();
        }

        return $data;
    }

	/**
	*获取顶级分类ID信息
	*@param
	*@return
	*/
	public function Get_First_Catid($catid,$tablename='about')
	{
	  $tablename;
	  $sql='select id,pid from '.$this->db->dbprefix.''.$tablename.' where id='.$catid;
	  $result=$this->db->query($sql);
	  if($result->num_rows()>0){
	  $data = $result->result_array();
	  if($data[0]['pid']!=0){
	  $cabid=$this->Get_First_Catid($data[0]['pid'],$tablename);
	  }
	  else
	  {
	  $cabid=$data[0]['id'];
	  }
	  return $cabid;
	  }
	}

	//获取新闻表下级所有类别 er
	function getallclassid($cid,$tablename='news_type')
	{
	$sql='select id from '.$this->db->dbprefix.''.$tablename.' where pid='.$cid;
	$result=$this->db->query($sql);
	if($result->num_rows()>0)
	{
	$jj_result = $result->result_array();
	$cidstr=$cid;
	foreach($jj_result as $v)
	{
	$cidstr.=",".$v['id'];
	if(isset($v['id']) != null)
	{
	   //$arg[$row['id']]['catid'] = $this->news_type_info($row['id']);
		$cidstr.=",".$this->getallclassid($v['id'],$tablename);
	}
	}
	}
	else
	{
	$cidstr=$cid;
	}
	$cidstr=str_replace(",,",",",$cidstr);
	$cidarr=explode(",",$cidstr);
	sort($cidarr);
	$cidarr=array_unique($cidarr);
	$cidstr=implode(",",$cidarr);
	return  $cidstr;
	}

	//获取新闻表下级所有类别 er
	function get_region_ids($cid,$tablename='region_type')
	{
	$sql='select region_id from '.$this->db->dbprefix.''.$tablename.' where parent_id='.$cid;
	$result=$this->db->query($sql);
	if($result->num_rows()>0)
	{
	$jj_result = $result->result_array();
	$cidstr=$cid;
	foreach($jj_result as $v)
	{
	$cidstr.=",".$v['region_id'];
	if(isset($v['region_id']) != null)
	{
	   //$arg[$row['id']]['catid'] = $this->news_type_info($row['id']);
		$cidstr.=",".$this->get_region_ids($v['region_id'],$tablename);
	}
	}
	}
	else
	{
	$cidstr=$cid;
	}
	$cidstr=str_replace(",,",",",$cidstr);
	$cidarr=explode(",",$cidstr);
	sort($cidarr);
	$cidarr=array_unique($cidarr);
	$cidstr=implode(",",$cidarr);
	return  $cidstr;
	}

 
}

/* file end */