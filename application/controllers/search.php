<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Echina {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('News_model');
		$this->load->model('Ads_model');
		$this->load->model('Newstype_model');
	}

	public function index()
	{
		$post     = $this->input->post(NULL,TRUE);
		$keyword = isset($post['keyword']) ? trim($post['keyword']) : '';
		
		$arg['keyword'] = $keyword;
		$arg['catname'] = '搜索结果';
		$this->set_title($arg['catname']);
		
		$adsInfo = $this->Ads_model->row(array('bid'=>6));
		$arg['catimg']   = !empty($adsInfo['bgsimg']) ? $adsInfo['bgsimg'] : 'static/images/ny_banner.png';
		$arg['catimg_m'] = !empty($adsInfo['bgsimg_2']) ? $adsInfo['bgsimg_2'] : 'static/images/x_banner.png';
		
		$arg['is_nav'] = 1;
		$arg['hover']  = '';
		$this->pageinfo['body'] = $this->load->view('search',$arg,true);
		$this->load->view('page',$this->pageinfo);
	}
	
    public function ajaxDisplay()
	{
		$get 	= $this->input->get(NULL,TRUE);
		$q 		= isset($get['q']) ? trim($get['q']) : '';
		$page   = isset($get['page']) ? intval($get['page']): 0;
		$data 	= array('content'=>'','page'=>$page,'falg'=>0);
		
		$pagesize = 10;
		$where = array();
		$where['like'] = array('title' => $q);
		$list = $this->News_model->select($where, 'id,bid,title,descs',$page, $pagesize, 'ord ASC,addtime DESC,id DESC');
		//echo $this->db->last_query();
		foreach($list as $val){
			$typeInfo = $this->Newstype_model->row( array('id' => $val['bid']),'id,pid,class' );
			if($typeInfo['id']==1||$typeInfo['pid']==1){
			  $webUrl = site_url('category/view?id='.$val['id']);
			}else{
			  if($typeInfo['class']=='news'){
			  	$webUrl = site_url('race/view?id='.$val['id']);
			  }else{
				$fpid   = db_result('news_type','pid',array('id'=>$typeInfo['pid']));
			  	$webUrl = site_url('race/lists?catid='.$fpid.'&cid_1='.$typeInfo['pid'].'&cid_2='.$val['bid'].'&tid=2&sid='.$val['id']).'#con_html';
			  }
			}
			$data['content'] .= '<div class="search fix">';
            $data['content'] .= '<h3><a href="'.$webUrl.'" target="_blank">'.strcut($val['title'],0,30,'...').'</a></h3>';
            $data['content'] .= '<p>'.strcut($val['descs'],0,180,'...').'</p>';
            $data['content'] .= '</div>';
		}
		$total = $this->News_model->total($where);
		
		$page_num  = ceil($total/$pagesize); //总页码
		if($page>0) $currpage = ceil($page/$pagesize)+1;else $currpage =1;
		$nextpage 		  = $currpage*$pagesize;
		$data['per_page'] = $nextpage;
		if( $nextpage >= $total){
			$data['falg'] = 1;
		}
		echo json_encode($data);
	}

	
	
	/*public function unionsql($perpage=20,$pages=0,$key='')
	{
		$query = $this->db->query("select * from
		(
			(select c1.id,c1.bid, c1.title,c1.addtime,c1.descs, c1.column from web_news as c1 WHERE c1.title LIKE '%{$key}%')
			union all
			(select c2.id,c2.bid, c2.title,c2.addtime,c2.descs, c2.column from web_show as c2 WHERE c2.title LIKE '%{$key}%')
		) as alltable ORDER BY addtime DESC LIMIT {$pages}, {$perpage}");
		$result = $query->result_array();
		return $result;
	}
	
	public function get_uniontotal($key='')
	{
		$query = $this->db->query("select * from
		(
			(select c1.id from web_news as c1 WHERE c1.title LIKE '%{$key}%')
			union all
			(select c2.id from web_show as c2 WHERE c2.title LIKE '%{$key}%')
			) as alltable");
		return $query->num_rows();
	}*/
	  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */