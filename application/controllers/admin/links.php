<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台链接管理
 */
class Links extends Echina{

	public $get;
	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('Links_model');
		$this->get = $this->input->get(NULL,TRUE);
	}

	public function index()
	{
		$page = isset($this->get['p']) ? intval($this->get['p']) : 0;
		$pagesize = 20;
		$pageurl = site_url("admin/links");
		$where = array();
		$arg['list'] = $this->Links_model->select($where,'id,title,url,simg,ord', $page, $pagesize,'ord ASC,id DESC');
		$total=$this->Links_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);

		$arg['catname'] = $catname = $this->link_name;
		$postion['后台首页'] = site_url("admin");
		$postion[$catname] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'links';
		$this->pageinfo['body'] = $this->load->view("admin/links/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$post = $this->input->post(NULL,TRUE);
		if($post)
		{
			$bool = $this->Links_model->postAdd($post);
			if($bool) Alert('操作成功！');
			else       Alert('操作失败！');
			echo WindowLocation(site_url('admin/links'));
		}
		$id = isset($this->get['id']) ? intval($this->get['id']) : 0;
		$arg['row'] = $this->Links_model->row(array('id'=>$id)); 

		$arg['catname'] = $catname = $this->link_name;

		$postion['后台首页'] = site_url("admin");
		$postion[$catname] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'links';
		$this->pageinfo['body'] = $this->load->view("admin/links/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function moreDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$ids = isset($post['id']) ? $post['id'] : '';
		if($ids)
		{
			foreach($ids as $key=>$id)
			{
				$this->Links_model->del( array('id' => $id) );
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/links'));
	}
}
/*
 * EOF
 */

