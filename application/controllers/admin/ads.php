<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台广告管理
 */
class Ads extends Echina{

	var $a_row;
	var $i_typeId;
	var $get;

	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('Ads_model');
		$this->load->model('Adstype_model');
	}

	public function index()
	{
		
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$page   = isset($get['p']) ? intval($get['p']) : 0;
		
		$pagesize = 20;
		$pageurl = site_url("admin/ads").'?cateid='.$cateid.'&q='.$q;
		$where = array();
		if(!empty($cateid)){
			$where['bid'] = $cateid;
		}
		$where['like'] = array('title'=>$q);
		$arg['list'] = $this->Ads_model->select($where,'id,title,url,bid,ord', $page, $pagesize,'ord ASC,id desc');
		$total	     = $this->Ads_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		
		$arg['catename'] = $catename = '广告管理';
		$postion['后台首页'] = site_url("admin");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		//分类信息
		$arg['typelist'] = $this->Adstype_model->select('','*',0,0,'id asc');
		
		$arg['cateid'] = $cateid;
		$arg['q'] 	   = $q;
		
		$this->pageinfo['hover'] = 'ads';
		$this->pageinfo['body'] = $this->load->view("admin/ads/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$id 	= isset($get['id']) ? intval($get['id']) : 0;
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$row    = $this->Ads_model->row( array('id' => $id) );
		$arg['row'] = $row;
		
		$arg['catename'] = $catename = '广告管理';
		$postion['后台首页'] = site_url("admin");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		//分类信息
		$arg['typelist'] = $this->Adstype_model->select('','*',0,0,'id asc');
		$arg['cateid']   = $cateid;
		
		if(isset($row['bid'])){
		  $arg['type'] = $this->Adstype_model->row(array('id'=>$row['bid']));
		}
		
		$this->pageinfo['hover'] = 'ads';
		$this->pageinfo['body'] = $this->load->view("admin/ads/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);

	}

	public function save()
	{
		$post = $this->input->post(NULL,TRUE);
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : 0;
		$bool = $this->Ads_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/ads?cateid='.$cateid));
	}




	public function moreDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$ids = isset($post['id']) ? $post['id'] : '';
		$bid = isset($post['bid']) ? intval($post['bid']) : '';
		if($ids)
		{
			/*$where = array();
			$where['bid'] = $bid;
			$pagetoal = $this->Ads_model->total($where);
			if(count($ids) < $pagetoal)
			{*/
				foreach($ids as $key=>$id)
				{
					$this->Ads_model->del( array('id' => $id) );
				}
			/*}
			else
			{
				Alert('至少保留一条信息！');
			}*/
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/ads'.'?catid='.$bid));
	}
	
	
	public function ajaxPid(){

		$arr = array();
		$arr['success'] = 'n';
		$bid = intval($this->input->post('catid',TRUE));
		$row = $this->Adstype_model->row(array('id'=>$bid),'width,height,m_width,m_height');
		if(!empty($row)){
		  $arr['success'] = 'y';
		  $arr['width']   = $row['width'];
		  $arr['height']  = $row['height'];
		  
		  $arr['m_width']   = $row['m_width'];
		  $arr['m_height']  = $row['m_height'];
		}
		print_r(json_encode($arr));

	}
	 
}
/*
 * EOF
 */

