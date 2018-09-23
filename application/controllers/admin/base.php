<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台基本信息
 */
class Base extends Echina{

	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
	}

	public function index()
	{
		$arg['row'] = $this->Base_model->row(array('id' => 1));
		$postion['后台首页'] = site_url("admin");
		$postion['信息管理'] = '';
		$postion['基本管理'] = site_url('admin/base');
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'base';
		$this->pageinfo['body'] = $this->load->view("admin/base/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}


	public function edit()
	{
		$post = $this->input->post();
		if($post)
		{
			$data = $post['info'];
			$this->Base_model->edit($post['id'],$data);
		}
		echo WindowLocation(site_url('admin/base'));
	}


}
/*
 * EOF
 */

