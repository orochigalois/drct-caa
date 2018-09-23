<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Echina {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('News_model');
		$this->load->model('Newstype_model');
	}

	public function index()
	{
		$get = $this->input->get(NULL,TRUE);
		$cid = isset($get['catid']) ? intval($get['catid']) : 1;
		$page = isset($get['p']) ? intval($get['p']): 0;
		$q = isset($get['q']) ? trim($get['q']): '';
		
		$check = $this->Newstype_model->row( array('pid' => $cid), 'id', 'ord ASC,id ASC');
		if(!empty($check))
		{
			$cid = $check['id'];
		}
		$type = $this->Newstype_model->row( array('id' => $cid) );
		$seoTitle = !empty($type['seoTitle'])?$type['seoTitle']:$type['title'];
		$this->set_title($seoTitle);
		$this->set_keywords($type['seoKeyword']);
		$this->set_desc($type['setDescription']);
		$url = site_url('category').'?catid=';
		$postion = $this->Newstype_model->get_postion($cid,$url);
		$this->set_breadcrumb($postion);
		$row = $this->Newstype_model->par_row;
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$templates 	  = !empty($type['templates']) ? $type['templates'] : $row['templates'];
		$pagesize = !empty($type['pagesize']) ? $type['pagesize'] : $row['pagesize'];
		$arg['cateList'] = $this->Newstype_model->get_lis($row['id'],$cid,$url);
		$arg['catename'] = $row['title'];
		$arg['cid'] 	 = $cid;
		$arg['pid'] 	 = $row['id'];
		$arg['pagesize'] = $pagesize;
		
		$arg['catimg']   = !empty($type['bgsimg']) ? $type['bgsimg'] : $row['bgsimg'];
		$arg['catimg_m'] = !empty($type['bgsimg_2']) ? $type['bgsimg_2'] : $row['bgsimg_2'];
		
		//echo $pagesize;
		$lists = '';
		$arr_ids = $this->News_model->get_ids($cid);
		$where 	 = array();
		$where['bid'] = $arr_ids;
		$list = $this->News_model->select($where, 'id,title,simg,descs,addtime,source',0, $pagesize, 'ord ASC,addtime DESC,id DESC');
		foreach($list as $val){
			$lists .= '<div class="col-md-4 col-sm-6 fix"><div class="in_d2 fix">';
            $lists .= '<a href="'.site_url('category/view?id='.$val['id']).'"><img src="'.base_url($val['simg']).'"></a>';
            $lists .= '<h3><a href="'.site_url('category/view?id='.$val['id']).'">'.strcut($val['title'],0,18,'...').'</a></h3>';
            $lists .= '<p style="left: 0px;">'.strcut($val['descs'],0,50,'...').'</p>';
            $lists .= '<span>'.date("d F Y",$val['addtime']).strcut($val['source'],0,10).'</span>';
            $lists .= '</div></div>';
		}
		$total = $this->News_model->total($where);
		$arg['lists']   =  $lists;
		$arg['total']   =  $total;
		
		$arg['is_nav'] = $row['id']==1?1:2;
		$arg['hover']  = 'cat_'.$row['id'];
		$this->pageinfo['body'] = $this->load->view('category/'.$templates,$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
	
	
	public function view()
	{
		$get = $this->input->get(NULL,TRUE);
		$id = isset($get['id']) ? intval($get['id']) : '';
		if(empty($id) && $id=="")
		{
			header("Location:". site_url());
		}
		$detail = $this->News_model->row( array('id' => $id) );
		if($detail['seoTitle']=="" && empty($detail['seoTitle']))
		{
			$this->set_title($detail['title']);
		}
		else
		{
			$this->set_title($detail['seoTitle']);
		}
		$this->set_keywords($detail['seoKeyword']);
		$this->set_desc($detail['setDescription']);
		$type = $this->Newstype_model->row( array('id' => $detail['bid']) );
		$url = site_url('category').'?catid=';
		$postion = $this->Newstype_model->get_postion($detail['bid'],$url);
		$row = $this->Newstype_model->par_row;
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$arg['cateList'] = $this->Newstype_model->get_lis($row['id'],$detail['bid'],$url);
		$arg['catename'] = $row['title'];
		$arg['type'] 	 = $type;
		$arg['detail']   = $detail;
		
		
		/*上一篇下一篇*/
		$prev = $this->News_model->get_pn_info($id,array('bid'=>$detail['bid']), 'p');
		$next = $this->News_model->get_pn_info($id,array('bid'=>$detail['bid']), 'n');
		if(!empty($prev))
		{
			$arg['prev'] = '<a href="'.site_url('category/view').'?id='.$prev['id'].'">'.$prev['title'].'</a>';
		}
		else
		{
			$arg['prev'] = '没有了';
		}
		if(!empty($next))
		{
			$arg['next'] = '<a href="'.site_url('category/view').'?id='.$next['id'].'">'.$next['title'].'</a>';
		}
		else
		{
			$arg['next'] = '没有了';
		}
		
		$arg['catimg']   = !empty($type['bgsimg']) ? $type['bgsimg'] : $row['bgsimg'];
		$arg['catimg_m'] = !empty($type['bgsimg_2']) ? $type['bgsimg_2'] : $row['bgsimg_2'];
		
		$arg['is_nav'] = $row['id']==1?1:2;
		$arg['hover']  = 'cat_'.$row['id'];
		$this->pageinfo['body'] = $this->load->view('category/news_view',$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
	
	
	public function ajaxDisplay()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$cid	= intval($get['cid']);
		$page   = isset($get['page']) ? intval($get['page']): 0;
		$pagesize = isset($get['pagesize']) ? intval($get['pagesize']): 0;

		$data 	 = array('content'=>'','page'=>$page,'falg'=>0);
		$arr_ids = $this->News_model->get_ids($cid);
		
		$where 	 = array();
		$where['bid'] = $arr_ids;
		$list = $this->News_model->select($where, 'id,title,simg,descs,addtime,source',$page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		foreach($list as $val){
			$data['content'] .= '<div class="col-md-4 col-sm-6 fix"><div class="in_d2 fix">';
            $data['content'] .= '<a href="'.site_url('category/view?id='.$val['id']).'"><img src="'.base_url($val['simg']).'"></a>';
            $data['content'] .= '<h3><a href="'.site_url('category/view?id='.$val['id']).'">'.strcut($val['title'],0,18,'...').'</a></h3>';
            $data['content'] .= '<p style="left: 0px;">'.strcut($val['descs'],0,50,'...').'</p>';
            $data['content'] .= '<span>'.date("d F Y",$val['addtime']).strcut($val['source'],0,10).'</span>';
            $data['content'] .= '</div></div>';
		}
		$total = $this->News_model->total($where);
		
		if($pagesize>0){
			$page_num  = ceil($total/$pagesize); //总页码
			if($page>0) $currpage = ceil($page/$pagesize)+1;else $currpage =1;
			$nextpage 		  = $currpage*$pagesize;
			$data['per_page'] = $nextpage;
			if( $nextpage >= $total){
				$data['falg'] = 1;
			}
		}else{
			$data['per_page'] = 0;
			$data['falg'] = 1;
		}
		echo json_encode($data);
	}
	
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */