<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends Echina {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('About_model');
	}

	public function index()
	{
		$get = $this->input->get(NULL,TRUE);
		$id = isset($get['id']) ? intval($get['id']) : 0;
		$row = $this->About_model->row( array('pid' => $id), '*', 'ord ASC,id ASC');
		if(!empty($row))
		{
			$id = $row['id'];
		}
		$detail = $this->About_model->row( array('id' => $id));
		if(empty($detail))
		{
			Alert('',-1);
		}
		$this->set_keywords($detail['seoKeyword']);
		$this->set_desc($detail['setDescription']);
		if($detail['seoTitle']=="" && empty($detail['seoTitle']))
		{
			$this->set_title($detail['title']);
		}
		else
		{
			$this->set_title($detail['seoTitle']);
		}
		
		$url = site_url('about').'?id=';
		$postion = $this->About_model->get_postion($id,$url);
		$par_row = $this->About_model->par_row;
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		$arg['cateList'] = $this->About_model->get_lis($par_row['id'],$id,$url);
		$arg['catename'] = $par_row['title'];
		$arg['detail'] 	 = $detail;
		
		$arg['catimg'] 	 = $par_row['bgsimg'];
		$arg['catimg_m'] = $par_row['bgsimg_2'];

		//print_r($detail);exit;
		$arg['is_nav'] = 1;
		$arg['hover']  = 'about_'.$par_row['id'];
		if($par_row['id']==2){
			$this->pageinfo['body'] = $this->load->view('about_contact',$arg,true);
		}else{
			$this->pageinfo['body'] = $this->load->view('about',$arg,true);
		}
		$this->load->view('page',$this->pageinfo); 
	}
	
	
	//留言处理
	public function actMsg(){

		$msg_url = '';
		$arr = array();
		$arr['status'] = 'n';
		$post = $this->input->post(NULL,TRUE);
		if(empty($post['info']['name'])||empty($post['info']['phone'])){
			$arr['info'] = '参数有误';
		}else{
			$this->load->model('Message_model');
			$bool = $this->Message_model->postAdd($post);
			if($bool){
				$arr['status'] = 'y';
				$arr['info']   = '操作成功！';
			}else{
				$arr['info'] = '操作失败！';
			}
		}
		print_r(json_encode($arr));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */