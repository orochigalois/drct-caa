<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台幻灯片
 */
class Slide extends Echina{

	public $get;
	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('Slide_model');
		$this->get = $this->input->get(NULL,TRUE);
	}

	public function index()
	{

		$page = isset($this->get['p']) ? intval($this->get['p']) : 0;
		$pagesize = 20;
		$pageurl = site_url("admin/slide");
		$where = array();
		$arg['list'] = $this->Slide_model->select($where,'id,title,url,simg,ord', $page, $pagesize,'ord ASC,id ASC');
		$total=$this->Slide_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		$postion['后台首页'] = site_url("admin");
		$postion['幻灯管理'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'slide';
		$this->pageinfo['body'] = $this->load->view("admin/slide/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$post = $this->input->post(NULL,TRUE);
		if($post)
		{
			$bool = $this->Slide_model->postAdd($post);
			if($bool) Alert('操作成功！');
			else       Alert('操作失败！');
			echo WindowLocation(site_url('admin/slide'));
		}
		$id = isset($this->get['id']) ? intval($this->get['id']) : 0;
		$arg['row'] = $this->Slide_model->row(array('id'=>$id)); 
		$postion['后台首页'] = site_url("admin");
		$postion['幻灯管理'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'slide';
		$this->pageinfo['body'] = $this->load->view("admin/slide/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function moreDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$ids = isset($post['id']) ? $post['id'] : '';
		if($ids)
		{
			$where = array();
			$pagetoal = $this->Slide_model->total($where);
			if(count($ids) < $pagetoal)
			{
				foreach($ids as $key=>$id)
				{
					$this->Slide_model->del( array('id' => $id) );
				}
			}
			else
			{
				Alert('至少保留一条信息！');
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/slide'));
	}
}
/*
 * EOF
 */

