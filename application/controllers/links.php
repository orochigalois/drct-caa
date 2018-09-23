<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends Echina {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Links_model');
	}

	public function index()
	{
		
		$get 	= $this->input->get(NULL,TRUE);
		$page   = isset($get['page']) ? intval($get['page']): 0;
		
		$arg['catname'] = '友情链接';
		$this->set_title($arg['catname']);
		
		$pagesize = 20;
		$pageurl = site_url("links");
		$where = array();
		$total		 = $this->Links_model->total($where);
		$arg['list'] = $this->Links_model->select($where,'id,title,url', $page, $pagesize,'ord ASC,id DESC');
		$arg['page'] = gen_page($pageurl,$total,$pagesize);
		
		$arg['is_nav'] = 1;
		$arg['hover']  = '';
		$this->pageinfo['body'] = $this->load->view('links',$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
	
	public function ajaxDisplay()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$page   = isset($get['page']) ? intval($get['page']): 0;
		$data 	= array('content'=>'','page'=>$page,'falg'=>0);
		
		$pagesize = 10;
		$where = array();
		$list = $this->Links_model->select($where,'id,title,url', $page, $pagesize,'ord ASC,id DESC');
		//echo $this->db->last_query();
		foreach($list as $val){
			$data['content'] .= '<div class="lj_add col-md-6 col-sm-6 fix"><a';
			if(!empty($val['url'])){
			  $data['content'] .= ' href="'.$val['url'].'" target="_blank"';
			}
            $data['content'] .= '>'.strcut($val['title'],0,20,'...').'</a>';
            $data['content'] .= '</div>';
		}
		$total = $this->Links_model->total($where);
		
		$page_num  = ceil($total/$pagesize); //总页码
		if($page>0) $currpage = ceil($page/$pagesize)+1;else $currpage =1;
		$nextpage 		  = $currpage*$pagesize;
		$data['per_page'] = $nextpage;
		if( $nextpage >= $total){
			$data['falg'] = 1;
		}
		echo json_encode($data);
	}

	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */