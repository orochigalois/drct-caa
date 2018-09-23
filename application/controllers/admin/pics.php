<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台图片管理
 */
class Pics extends Echina{

	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('News_model');
		$this->load->model('Pics_model');
		$this->load->model('Pics_listmodel');
	}

	public function index()
	{
		$get = $this->input->get(NULL,TRUE);
		$q = isset($get['q']) ? trim($get['q']) : '';
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$page = isset($get['p']) ? intval($get['p']) : 0;
		$pagesize = 20;
		
		
		$where = array();
		if(!empty($cateid)){
			$where['bid'] = $cateid;
		}
		$where['like'] = array('title'=>$q);
		$pageurl = site_url("admin/pics").'?cateid='.$cateid.'&q='.$q;
		$list = $this->Pics_model->select($where, 'id,title,ord,addtime', $page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		$pagetotal = $this->Pics_model->total($where);
		
		$arg['list']   = $list;
		$arg['cateid'] = $cateid;
		$arg['q'] 	   = $q;
		$arg['page']   = gen_page($pageurl,$pagetotal,$pagesize);
		
		$cat_name = db_result('news','title',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'图片管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = site_url("admin/pics");
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/pics/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$id 	= isset($get['id']) ? intval($get['id']) : 0;
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$row    = $this->Pics_model->row( array('id' => $id) );
		$arg['row']    = $row;
		$arg['cateid'] = $cateid;
		
		$cat_name = db_result('news','title',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'列表管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = site_url("admin/pics");
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/pics/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);

	}

	public function save()
	{
		$post = $this->input->post(NULL,TRUE);
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : 0;
		$bool = $this->Pics_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/pics?cateid='.$cateid));
	}

	public function moreDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$action = isset($post['action']) ? $post['action'] : '';
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : '';
		$ids = isset($post['id']) ? $post['id'] : '';
		if($ids)
		{
			foreach($ids as $id)
			{
				$this->Pics_model->del( array('id' => $id) );
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/pics?cateid='.$cateid));
	}
 
	
	
	
	public function picList()
	{
		
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$page   = isset($get['p']) ? intval($get['p']) : 0;
		
		
		$pagesize = 20;
		$pageurl = site_url("admin/pics/picList").'?cateid='.$cateid.'&q='.$q;
		$where = array();
		if(!empty($cateid)){
			$where['bid'] = $cateid;
		}
		$where['like'] = array('title'=>$q);
		$arg['list'] = $this->Pics_listmodel->select($where,'id,title,ord,addtime', $page, $pagesize,'ord ASC,addtime desc,id DESC');
		$total	     = $this->Pics_listmodel->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		
		$cat_name = db_result('pics','title',array('id'=>$cateid));
		$pid	  = db_result('pics','bid',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'列表管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$arg['pid']    = $pid;
		$arg['cateid'] = $cateid;
		$arg['q'] 	   = $q;
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/pics/pic_list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function picEdit()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$id 	= isset($get['id']) ? intval($get['id']) : 0;
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$row    = $this->Pics_listmodel->row( array('id' => $id) );
		$arg['row']    = $row;
		$arg['cateid'] = $cateid;
		
		$pid	  = db_result('pics','bid',array('id'=>$cateid));
		$cat_name = db_result('pics','title',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'列表管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$arg['pid']    = $pid;
		
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/pics/pic_edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);

	}

	public function picSave()
	{
		$post = $this->input->post(NULL,TRUE);
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : 0;
		$bool = $this->Pics_listmodel->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/pics/picList?cateid='.$cateid));
	}




	public function picDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$ids = isset($post['id']) ? $post['id'] : '';
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : '';
		if($ids)
		{
			foreach($ids as $key=>$id)
			{
				$this->Pics_listmodel->del( array('id' => $id) );
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/pics/picList'.'?cateid='.$cateid));
	}

}
/*
 * EOF
 */

