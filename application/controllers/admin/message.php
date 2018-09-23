<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台留言管理
 */
class Message extends Echina{

	public $get;
	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('Message_model');
		$this->get = $this->input->get(NULL,TRUE);
	}

	public function index()
	{

		$page = isset($this->get['p']) ? intval($this->get['p']) : 0;
		$pagesize = 20;
		$pageurl = site_url("admin/message");
		$where = array();
		$arg['list'] = $this->Message_model->select($where,'*', $page, $pagesize,'addtime DESC,id DESC');
		$total=$this->Message_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		
		$arg['catename'] = $catename = $this->msg_name;
		$postion['后台首页'] = site_url("admin");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'message';
		$this->pageinfo['body'] = $this->load->view("admin/message/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$id = isset($this->get['id']) ? intval($this->get['id']) : 0;
		$arg['row'] = $this->Message_model->row(array('id'=>$id));
		$arg['fields'] = $this->Message_model->list_fields();
		
		$arg['catename'] = $catename = $this->msg_name;
		$postion['后台首页'] = site_url("admin");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'message';
		$this->pageinfo['body'] = $this->load->view("admin/message/edit",$arg,TRUE);
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
				$this->Message_model->del( array('id' => $id) );
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/message'));
	}
}
/*
 * EOF
 */

