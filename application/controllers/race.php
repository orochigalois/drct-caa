<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Race extends Echina {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ads_model');
		$this->load->model('Pics_model');
		$this->load->model('Pics_listmodel');
		$this->load->model('News_model');
		$this->load->model('Newstype_model');
		$this->load->library('recom');
		
		$this->load->model('Video_model');
	}

	public function index()
	{
		$get = $this->input->get(NULL,TRUE);
		$cid = isset($get['catid']) ? intval($get['catid']) : 1;

		$type = $this->Newstype_model->row( array('id' => $cid) );
		$seoTitle = !empty($type['seoTitle'])?$type['seoTitle']:$type['title'];
		$this->set_title($seoTitle);
		$this->set_keywords($type['seoKeyword']);
		$this->set_desc($type['setDescription']);
		$url = site_url('race').'?catid=';
		$postion = $this->Newstype_model->get_postion($cid,$url);
		$this->set_breadcrumb($postion);
		$row = $this->Newstype_model->par_row;
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$arg['catename'] = $row['title'];
		$arg['pid'] 	 = $row['id'];
		
		$typeList = $this->Newstype_model->select(array('pid'=>$cid), 'id,title,class,ename,h_simg,descs', 0, 3, 'id ASC');
		$arg['typeList'] = $typeList;
		$arg['newList']  = $this->News_model->select(array('bid'=>$typeList[1],'is_recom'=>1),'id,title,simg,descs,addtime,source',0,6,'ord ASC,addtime DESC');
		$arg['raceList'] = $this->Newstype_model->select(array('pid'=>$typeList[2]['id']), 'id,title,descs', 0, 15, 'ord ASC,id ASC');
			
		$adsBid  = $cid==2?4:5;
		$arg['adsList'] = $this->Ads_model->select(array('bid'=>$adsBid),'id,title,simg,url,simg_2',0,0,'ord ASC,id desc');
	
		$arg['is_nav'] = 2;
		$arg['hover']  = 'cat_'.$row['id'];
		$this->pageinfo['body'] = $this->load->view('race/index',$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
	
	public function lists()
	{
		$get   = $this->input->get(NULL,TRUE);
		$cid   = isset($get['catid']) ? intval($get['catid']) : 1;
		$cid_1 = isset($get['cid_1']) ? intval($get['cid_1']) : 0;
		$cid_2 = isset($get['cid_2']) ? intval($get['cid_2']) : 0;
		$sid   = isset($get['sid']) ? intval($get['sid']) : 0;
		$tid   = isset($get['tid']) ? intval($get['tid']) : 2;
		$conId = isset($get['conId']) ? intval($get['conId']) : 1;
		$picId = isset($get['picId']) ? intval($get['picId']) : 0;

		if(!in_array($cid,array(15,19))){
			$check = $this->Newstype_model->row( array('pid' => $cid,'class !='=>'link'), 'id', 'ord ASC,id ASC');
			if(!empty($check))
			{
				$cid = $check['id'];
			}
		}
		$type = $this->Newstype_model->row( array('id' => $cid) );
		if(!empty($type['link_url'])&&$type['class'] == 'link') {
			header('Location:' . $type['link_url']); exit;
		}
		
		$seoTitle = !empty($type['seoTitle'])?$type['seoTitle']:$type['title'];
		$this->set_title($seoTitle);
		$this->set_keywords($type['seoKeyword']);
		$this->set_desc($type['setDescription']);
		$url = site_url('race/lists').'?catid=';
		$postion = $this->Newstype_model->get_postion($cid,$url);
		$this->set_breadcrumb($postion);
		$row = $this->Newstype_model->par_row;
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$templates 	  = !empty($type['templates']) ? $type['templates'] : $row['templates'];
		$pagesize = !empty($type['pagesize']) ? $type['pagesize'] : $row['pagesize'];
		$arg['catename'] = $row['title'];
		$arg['pid'] 	 = $row['id'];
		$arg['pagesize'] = $pagesize;
		$arg['detail']   = $type;
		
		$tpid 	  = in_array($type['pid'],array(2,3))?$cid:$type['pid'];
		$cateList = $this->Newstype_model->get_lis($tpid,$cid,$url);
		$arg['cateList'] = $cateList;
		
		$typeList_1 = $this->Newstype_model->select(array('pid'=>$cid), 'id,title', 0, 0, 'ord ASC,id ASC');
		
		$cid_1		= empty($cid_1)&&!empty($typeList_1)?$typeList_1[0]['id']:$cid_1;	
		$typeInfo   = $this->Newstype_model->row(array('id'=>$cid_1));
		$typeList_2 = $this->Newstype_model->select(array('pid'=>$cid_1), 'id,title', 0, 0, 'ord ASC,id ASC');
		
		$cid_2		= empty($cid_2)&&!empty($typeList_2)?$typeList_2[0]['id']:$cid_2;	
		$showList   = $this->News_model->select(array('bid'=>$cid_2), 'id,title', 0, 0, 'ord ASC,id ASC');
		
		$sid		= empty($sid)&&!empty($showList)?$showList[0]['id']:$sid;	
		$showInfo   = $this->News_model->row(array('id'=>$sid));
		
		$arg['race_arr']  = $this->recom->get_list('race_arr');
		$arg['lists_arr'] = $lists_arr = $this->recom->get_list('lists_arr');
		
		if($tid==2&&$conId==1){
		    foreach($lists_arr as $k=>$v){
			  if(!empty($showInfo['con_'.$k])){
				$conId   = $k;
				break;
			  }
			}
		}
		
		
		$arg['cid']   = $cid;
		$arg['cid_1'] = $cid_1;
		$arg['cid_2'] = $cid_2;
		$arg['sid']   = $sid;
		$arg['tid']   = $tid;
		$arg['conId'] = $conId;
		
		$arg['typeList_1'] = $typeList_1;
		$arg['typeList_2'] = $typeList_2;
		$arg['showList']   = $showList;
		$arg['typeInfo']   = $typeInfo;
		$arg['showInfo']   = $showInfo;
		
		$arg['video_num']  = $this->Video_model->total(array('bid'=>$sid));
		
		//图片集
		$PicInfo 	= array();
		$PicList  	= array();
		$PicPrev 	= array();
		$PicNext  	= array();
		if(!empty($showInfo)){
			$PicInfo = $this->Pics_model->row(array('bid'=>$sid),'id,download','ord ASC,addtime desc,id DESC');
			if(!empty($PicInfo)){
				$n_picId = !empty($picId)?$picId:$PicInfo['id'];
				$PicPrev = $this->Pics_model->get_pn_info($n_picId,array('bid'=>$sid), 'p');
				$PicNext = $this->Pics_model->get_pn_info($n_picId,array('bid'=>$sid), 'n');
				$PicList = $this->Pics_listmodel->select(array('bid'=>$n_picId), 'id,title,simg,descs', 0, 0, 'ord ASC,addtime desc,id DESC');
			}
		}
		$arg['PicInfo']   = $PicInfo;
		$arg['PicPrev']   = $PicPrev;
		$arg['PicNext']   = $PicNext;
		$arg['PicList']   = $PicList;
		//print_r($PicInfo);
		//print_r($PicList);exit;
		//print_r($PicNext);exit;
		
		
		$arg['catimg']   = !empty($type['bgsimg']) ? $type['bgsimg'] : $row['bgsimg'];
		$arg['catimg_m'] = !empty($type['bgsimg_2']) ? $type['bgsimg_2'] : $row['bgsimg_2'];
		
		//echo $templates;exit;
		
		$arg['is_nav'] = 2;
		$arg['hover']  = 'cat_'.$tpid;
		$this->pageinfo['body'] = $this->load->view('race/'.$templates,$arg,true);
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
		$url = site_url('race/lists').'?cid=';
		$postion = $this->Newstype_model->get_postion($detail['bid'],$url);
		$row = $this->Newstype_model->par_row;
		$this->set_breadcrumb($postion);
		$arg['position'] = $this->pageinfo['breadcrumb'];
		
		$cid 	  = $detail['bid'];
		$tpid 	  = in_array($type['pid'],array(2,3))?$cid:$type['pid'];
		$cateList = $this->Newstype_model->get_lis($tpid,$cid,$url);
		$arg['cateList'] = $cateList;
		
		$arg['pid'] 	 = $row['id'];
		$arg['catename'] = $row['title'];
		$arg['detail']   = $detail;
		
		
		/*上一篇下一篇*/
		$prev = $this->News_model->get_pn_info($id,array('bid'=>$cid), 'p');
		$next = $this->News_model->get_pn_info($id,array('bid'=>$cid), 'n');
		if(!empty($prev))
		{
			$arg['prev'] = '<a href="'.site_url('race/view').'?id='.$prev['id'].'">'.strcut($prev['title'],0,24,'...').'</a>';
		}
		else
		{
			$arg['prev'] = '没有了';
		}
		if(!empty($next))
		{
			$arg['next'] = '<a href="'.site_url('race/view').'?id='.$next['id'].'">'.strcut($next['title'],0,24,'...').'</a>';
		}
		else
		{
			$arg['next'] = '没有了';
		}
		
		$arg['catimg']   = !empty($type['bgsimg']) ? $type['bgsimg'] : $row['bgsimg'];
		$arg['catimg_m'] = !empty($type['bgsimg_2']) ? $type['bgsimg_2'] : $row['bgsimg_2'];
		
		$arg['is_nav'] = 2;
		$arg['hover']  = 'cat_'.$tpid;
		$this->pageinfo['body'] = $this->load->view('category/news_view',$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
	
	//文件下载
	public function download()
	{
		$get = $this->input->get(NULL,TRUE);
		$file = trim($get['file']);
		if(!is_file($file)) {
			Alert('文件不存在或者操作失误，返回上一层！',-1); exit;
		}
		$this->load->helper('download');
		$data = file_get_contents($file);
		$name = $file;
		force_download($name, $data); 
	}
		
		
	public function ajaxDisplay()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$cid	= intval($get['cid']);
		$page   = isset($get['page']) ? intval($get['page']): 0;
		$pagesize   = isset($get['pagesize']) ? intval($get['pagesize']): 0;

		$data 	 = array('content'=>'','page'=>$page,'falg'=>0);
		$arr_ids = $this->News_model->get_ids($cid);
		
		$where 	 = array();
		$where['bid'] = $arr_ids;
		$list = $this->News_model->select($where, 'id,title,simg,descs,addtime,source',$page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		foreach($list as $val){
			$data['content'] .= '<div class="col-md-4 col-sm-6 fix"><div class="in_d2 fix">';
            $data['content'] .= '<a href="'.site_url('race/view?id='.$val['id']).'"><img src="'.base_url($val['simg']).'"></a>';
            $data['content'] .= '<h3><a href="'.site_url('race/view?id='.$val['id']).'">'.strcut($val['title'],0,18,'...').'</a></h3>';
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
		
		
		
	public function ajaxDisplayVideo()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$cid	= intval($get['cid']);
		$page   = isset($get['page']) ? intval($get['page']): 0;
		
		$data 	 = array('content'=>'','page'=>$page,'falg'=>0);
		
		$pagesize = 2;
		$where 	  = array();
		$where['bid'] = $cid;
		$list = $this->Video_model->select($where, 'id,title,simg,v_url',$page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		$v_url = '';
		foreach($list as $val){
			if(!empty($val['v_url'])){
			  $v_url = 'href="'.$val['v_url'].'" target="_blank"';
			}
			$data['content'] .= '<div class="col-md-3 col-sm-6 fix"><div class="ny_h fix">';
            $data['content'] .= '<a '.$v_url.'><img src="'.base_url($val['simg']).'"></a>';
            $data['content'] .= '<p>'.strcut($val['title'],0,16,'...').'</p>';
            $data['content'] .= '<h3><a '.$v_url.'>点击播放</a></h3>';
            $data['content'] .= '</div></div>';
		}
		$total = $this->Video_model->total($where);
		
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