<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台单页管理
 */
class About extends Echina{

	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('About_model');
	}

	public function index()
	{
		$arg['trees'] = $this->About_model->get_trs();
		$postion['后台首页'] = site_url("admin");
		$postion['单页管理'] = site_url('admin/about');
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'about';
		$this->pageinfo['body'] = $this->load->view("admin/about/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function add()
	{
		$get = $this->input->get(NULL,TRUE);
		$id = isset($get['id']) ? intval($get['id']) : 0;
		$arg['row'] = array('pid'=>$id);
		$postion['后台首页'] = site_url("admin");
		$postion['单页管理'] = site_url('admin/about');
		$postion['添加'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'about';
		$this->pageinfo['body'] = $this->load->view("admin/about/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$get = $this->input->get(NULL,TRUE);
		$id = isset($get['id']) ? intval($get['id']) : 0;
		$arg['row'] = $this->About_model->row( array('id' => $id ));
		$postion['后台首页'] = site_url("admin");
		$postion['单页管理'] = site_url('admin/about');
		$postion['编辑'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'about';
		$this->pageinfo['body'] = $this->load->view("admin/about/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function save()
	{
		$post = $this->input->post();
		$bool = $this->About_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/about'));
	}

	public function del()
	{
		$id = $this->input->get("id",TRUE);
		if(!empty($id))
		{
			$this->About_model->del( array('id' => $id) );
		}
		echo WindowLocation(site_url('admin/about'));
	}
}
/*
 * EOF
 */

