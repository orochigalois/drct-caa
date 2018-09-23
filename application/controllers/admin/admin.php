<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台管理页面
 */
class Admin extends Echina{

	public $upfile_path;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->upfile_path = DOCUMENT_PATH."static/kindeditor/attached/";
	}

	public function index()
	{
		$this->adminroles->has_authz();
		$postion['后台首页'] = site_url("admin");
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['body'] = $this->load->view("admin/main",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	
	}
	public function  login()
	{
		$post = $this->input->post(NULL,TRUE);
		$arg['msg']= '';
		if($this->sess->get('isLogin'))
		{
			header('Location:'.site_url('admin/admin/login'));
		}
		if($post)
		{
			if(strtoupper($post['txtCode']) != $this->sess->get('scode'))
			{
				$arg['msg'] = '验证码不正确';
			}
			elseif(!(trim($post['txtUserName']) && trim($post['txtPassWord'])))
			{
				$arg['msg'] = '用户名与密码不为空';
			}
			else
			{
				$username = trim($post['txtUserName']);
				$userpass = trim($post['txtPassWord']);
				if($this->Admin_model->login($username,$userpass))
				{
					header('Location:'.site_url("admin/admin"));
				}else
				{
					$arg['msg'] = '用户名与密码不正确';
				}
			}
			
			unset($post['txtCode']);
		}
		
		$this->load->view('admin/login',$arg);
	}

	public function user()
	{
		$this->adminroles->has_authz();
		$get = $this->input->get(NULL,TRUE);
		$page = isset($get['p']) ? intval($get['p']) : 0;
		$pagesize = 0;
		$pageurl = site_url("admin/admin/user");
		$where = array();
		$arg['list'] = $this->Admin_model->select($where,'*', $page, $pagesize);
		$total=$this->Admin_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		$arg['action'] = 'manage';
		$postion['后台首页'] = site_url("admin");
		$postion['系统管理'] = '';
		$postion['管理员管理'] = site_url("admin/admin/user");
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'user';
		$this->pageinfo['body'] = $this->load->view("admin/admin/user",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function addUser($id = '')
	{
		$this->adminroles->has_authz();
		$post = $this->input->post(NULL,TRUE);
		$get   = $this->input->get(NULL,TRUE);
		if($post)
		{
			$bool = $this->Admin_model->postAdd($post);
			if($bool) Alert('操作成功！');
			else       Alert('操作失败！');
			echo WindowLocation(site_url("admin/admin/user"));
		}
		$arg['action'] = 'edit';
		if (!empty($id))
		{
			$arg['row']=$this->Admin_model->row(array('id'=>$id));
		}
		$postion['后台首页'] = site_url("admin");
		$postion['系统管理'] = '';
		$postion['管理员管理'] = site_url("admin/admin/user");
		$postion['修改管理员'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'user';
		$this->pageinfo['body'] = $this->load->view("admin/admin/user",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function delUser($id = 0)
	{
		if(!$id) return;
		$return = $this->Admin_model->del( array('id' => $id) );
		if($return == FALSE)
		{
			 Alert('删除失败!');
		}
		echo WindowLocation(site_url("admin/admin/user"));
	}
	/**
	*	数据库备份
	*/
	public function backup_db()
	{
		$this->load->dbutil();
		$prefs = array(
					'format'      => 'txt',             // gzip, zip, txt
					'newline'     => "\r\n"               // Newline character used in backup file
					);
		$backup =& $this->dbutil->backup($prefs);
		$this->load->helper('file');
		$dbName = 'mybackup_'.date('Ymd_His').'.sql';
		write_file('backup/mybackup.sql', $backup);
		$this->load->helper('download');
		$data1 = file_get_contents("backup/mybackup.sql"); 
		$name = 'backup.sql';
		force_download($dbName, $data1);
	}
	/**
	*	附件管理
	*/
	public function files()
	{
		$get = $this->input->get(NULL,TRUE);
		$dir = isset($get['dir']) && trim($get['dir']) ? str_replace(array('..\\', '../', './', '.\\','.'), '', trim($get['dir'])) : '';
		$filepath = $this->upfile_path;
		if(!empty($dir))
		{
			$filepath .=  $dir."/";
		}
		$list = glob($filepath.'/'.'*');
		if(!empty($list)) rsort($list);
		$local = str_replace(array( DOCUMENT_PATH ,DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR), array('',DIRECTORY_SEPARATOR), $filepath);
		$arg = array();
		$arg['list'] = $list;
		$arg['local'] = $local;
		$arg['dir'] = $dir;
		$postion['后台首页'] = site_url("admin");
		$postion['系统管理'] = '';
		$postion['附件管理'] = site_url("admin/admin/files");
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'files';
		$this->pageinfo['body'] = $this->load->view("admin/admin/files",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function delFiles()
	{
		$get = $this->input->get(NULL,TRUE);
		$filename = urldecode($get['filename']);
		$tmpdir = $dir = urldecode($get['dir']);
		$tmpdir = str_replace('\\','/',$tmpdir);
		$tmpdirs = explode('/',$tmpdir);
		$tmpdir = DOCUMENT_PATH.$tmpdirs[0].'/'.$tmpdirs[1].'/';
		$ondir = '';
		foreach ($tmpdirs as $val)
		{
			if(!empty($val) && $val != 'upfile' && $val != 'static')
			{
				$ondir = $val;
			}
		}
		if($tmpdir!=$this->upfile_path) 
		{
			Alert('操作失败！');
		}
		$file = DOCUMENT_PATH.$dir.DIRECTORY_SEPARATOR.$filename;
		$file = str_replace(array('/','\\'), DIRECTORY_SEPARATOR, $file);
		$file = str_replace('..', '', $file);
		if(@unlink($file))
		{
			Alert('操作成功！');
		}
		else
		{
			Alert('操作失败！');
		}
		echo WindowLocation(site_url("admin/admin/files").'?dir='.$ondir);
	}

	public function logout()
	{
		if($this->sess->get('isLogin'))
		{
			$this->sess->clear();
		}
		header('Location:'.site_url('admin'));
     }
}
/* EOF */