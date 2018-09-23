<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 后台新闻管理
 */
class News extends Echina{

	public function __construct()
	{
		parent::__construct();
		$this->adminroles->has_authz();
		$this->load->model('News_model');
		$this->load->model('Newstype_model');
		$this->load->model('Video_model');
		$this->load->library('recom');
	}

	public function index()
	{
		$get = $this->input->get(NULL,TRUE);
		$q = isset($get['q']) ? trim($get['q']) : '';
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$page = isset($get['p']) ? intval($get['p']) : 0;
		$pagesize = 20;
		$pageurl = site_url("admin/news").'?cateid='.$cateid.'&q='.$q;
		$arr_ids =  $this->News_model->get_ids($cateid);
		$where = array();
		$where['bid'] = $arr_ids;
		$where['like'] = array('title'=>$q);
		$list = $this->News_model->select($where, 'id,title,bid,simg,is_recom,ord,addtime', $page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		$pagetotal = $this->News_model->total($where);
		
		$arr_recom = $this->recom->get_list();
		$arg['recom'] = $arr_recom;
		$arg['list'] = $list;
		$arg['cateid'] = $cateid;
		$arg['q'] = $q;
		$arg['page'] = gen_page($pageurl,$pagetotal,$pagesize);
		$postion['后台首页'] = site_url("admin");
		$postion['内容管理'] = '';
		$postion['内容管理'] = site_url('admin/news');
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/news/list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function edit()
	{
		$id = intval( $this->input->get("id",TRUE) );
		$row = $this->News_model->row( array('id' => $id) );
		if( !empty($row['imgs']))
		{
			$row['imgs'] = unserialize($row['imgs']);
		}
		else
		{
			$row['imgs'] = array();
		}
		$arg['row'] = $row;
		$postion['后台首页'] = site_url("admin");
		$postion['内容管理'] = '';
		$postion['内容管理'] = site_url('admin/news');
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/news/edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);

	}

	public function save()
	{
		$post = $this->input->post();
		$post['file'] = isset($_FILES['img']) ? $_FILES['img'] : '';
		$bool = $this->News_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/news'));
	}

	public function moreDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$action = isset($post['action']) ? $post['action'] : '';
		$ids = isset($post['id']) ? $post['id'] : '';
		if($ids)
		{
			foreach($ids as $id)
			{
				if($action=='-2')
				{
					$this->News_model->del( array('id' => $id) );
				}
				else
				{
					$this->News_model->edit($id, array('is_recom'=>$action));
				}
			}
		}
		else
		{
			Alert('请选择要删除或推荐的信息！');
		}
		echo WindowLocation(site_url('admin/news'));
	}
 
	
	public function typeList()
	{
		$postion['后台首页'] = site_url("admin");
		$postion['内容管理'] = '';
		$postion['分类管理'] = site_url('admin/news/typeList');
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$arg['trees'] = $this->Newstype_model->get_trs();
		$this->pageinfo['hover'] = 'newsType';
		$this->pageinfo['body'] = $this->load->view("admin/news/list_type",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function addType()
	{
		$get = $this->input->get(NULL,TRUE);
		$id = isset($get['id']) ? intval($get['id']) : 0;
		$row = $this->Newstype_model->row( array('id' => $id ));
		$data['pid'] = $id;
		if(!empty($row)){
			$arg['class'] = $row['class'];
			$arg['templates'] = $row['templates'];
		}
		$arg['row'] = $data;
		
		$postion['后台首页'] = site_url("admin");
		$postion['内容管理'] = '';
		$postion['分类管理'] = site_url('admin/news/typeList');
		$postion['添加分类'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$this->pageinfo['hover'] = 'newsType';
		$this->pageinfo['body'] = $this->load->view("admin/news/edit_type",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function editType()
	{
		$get = $this->input->get(NULL,TRUE);
		$id  = isset($get['id']) ? intval($get['id']) : 0;
		$row = $this->Newstype_model->row( array('id' => $id ));
		if(!empty($row)){
			$arg['class'] = $row['class'];
			$arg['templates'] = $row['templates'];
		}
		$arg['row'] = $row;
		
		$postion['后台首页'] = site_url("admin");
		$postion['内容管理'] = '';
		$postion['分类管理'] = site_url('news/typeList');
		$postion['编辑分类'] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$this->pageinfo['hover'] = 'newsType';
		$this->pageinfo['body'] = $this->load->view("admin/news/edit_type",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function saveType()
	{
		$post = $this->input->post();
		$bool = $this->Newstype_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/news/typeList'));
	}

	public function delType()
	{
		$id = $this->input->get("id",TRUE);
		if(!empty($id))
		{
			$this->Newstype_model->del( array('id' => $id) );
		}
		echo WindowLocation(site_url('admin/news/typeList'));
	}

	public function ajaxBody()
	{
		$get = $this->input->get(NULL,TRUE);
		$cid = intval($get['cid']);
		$id = intval($get['id']);
		$field = 'id,class,pid';
		$arg = array();
		$class = '';
		$row = $this->Newstype_model->row(array('id' => $cid),$field);
		if(!empty($row)) {
			$parent =  $this->Newstype_model->row(array('id' => $row['pid']),$field);
			if(empty($row['class'])  && !empty($parent)) {
				$class = $parent['class'];
			} else {
				$class = $row['class'];
			}
		}
		$arg['class']  = $class;
		
		$arg['width']  = 370;
		$arg['height'] = 152;
		
		$arg['lists_arr'] = $this->recom->get_list('lists_arr');
		
		$detail = $this->News_model->row(array('id'=>$id));
		$arg['detail'] = $detail;
		//print_r($detail);exit;
		
		$this->load->view('admin/news/ajax',$arg);
	}
	
	
	public function ajax_delete_imgs()
	{

		$post = $this->input->post(NULL,TRUE);
		$id = isset($post['id']) ? intval($post['id']) : 0;
		$row = $this->News_model->row(array('id' => $id));

		$file_path = 'static/upfile/';
		
		//图片集
		$arr = unserialize($row['imgs']);
		if(!empty($arr[0])){
		  delFile($file_path.$arr[0]);
	    }
		unset($arr[$post['num']]); 
		$data['imgs'] = serialize($arr);
		
		//名称集
		$n_arr = unserialize($row['names']);
		unset($n_arr[$post['num']]); 
		$data['names'] = serialize($n_arr);

        $return = $this->Show_model->edit($id,$data);
		if($return) echo 1;
		else         echo 0;
	}
	
	
	
	public function VideoList()
	{
		
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$page   = isset($get['p']) ? intval($get['p']) : 0;
		
		
		$pagesize = 20;
		$pageurl = site_url("admin/news/VideoList").'?cateid='.$cateid.'&q='.$q;
		$where = array();
		if(!empty($cateid)){
			$where['bid'] = $cateid;
		}
		$where['like'] = array('title'=>$q);
		$arg['list'] = $this->Video_model->select($where,'id,title,ord,addtime', $page, $pagesize,'ord ASC,addtime desc,id DESC');
		$total	     = $this->Video_model->total($where);
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		
		$cat_name = db_result('news','title',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'视频管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		
		$arg['cateid'] = $cateid;
		$arg['q'] 	   = $q;
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/news/video_list",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);
	}

	public function VideoEdit()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$q	    = isset($get['q']) ? trim($get['q']) : '';
		$id 	= isset($get['id']) ? intval($get['id']) : 0;
		$cateid = isset($get['cateid']) ? intval($get['cateid']) : 0;
		$row    = $this->Video_model->row( array('id' => $id) );
		$arg['row']    = $row;
		$arg['cateid'] = $cateid;
		
		$cat_name = db_result('news','title',array('id'=>$cateid));
		$arg['catename']   = $catename = strcut($cat_name,0,10,'...').'视频管理';
		$postion['后台首页'] = site_url("admin");
		$postion['图文管理'] = site_url("admin/news");
		$postion[$catename] = '';
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		
		
		$this->pageinfo['hover'] = 'news';
		$this->pageinfo['body'] = $this->load->view("admin/news/video_edit",$arg,TRUE);
		$this->load->view('admin/index',$this->pageinfo);

	}

	public function VideoSave()
	{
		$post = $this->input->post(NULL,TRUE);
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : 0;
		$bool = $this->Video_model->postAdd($post);
		if($bool) Alert('操作成功！');
		else       Alert('操作失败！');
		echo WindowLocation(site_url('admin/news/VideoList?cateid='.$cateid));
	}




	public function VideoDel()
	{
		$post = $this->input->post(NULL,TRUE);
		$ids = isset($post['id']) ? $post['id'] : '';
		$cateid = isset($post['cateid']) ? intval($post['cateid']) : '';
		if($ids)
		{
			foreach($ids as $key=>$id)
			{
				$this->Video_model->del( array('id' => $id) );
			}
		}
		else
		{
			Alert('请选择要删除的信息！');
		}
		echo WindowLocation(site_url('admin/news/VideoList'.'?cateid='.$cateid));
	}

}
/*
 * EOF
 */

