<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Echina
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Slide_model');
		$this->load->model('News_model');
		$this->load->model('Newstype_model');
		$this->load->model('Ads_model');
		
	}

	public function index()
	{

		$arg['slideList'] = $this->Slide_model->select('','*',0,0,'ord ASC,id desc');


		$arg['typeInfo'] = $this->Newstype_model->row(array('id'=>1));
		
		$arr_ids = $this->News_model->get_ids(1);
		$arg['news'] = $this->News_model->select(array('bid'=>$arr_ids,'is_recom'=>1),'id,title,simg,descs,addtime,source',0,6,'ord ASC,addtime DESC');
							
		$arg['ads'] = array(
							1=>$this->Ads_model->select(array('bid'=>1),'id,title,simg,url,descs',0,3,'ord ASC,id desc'),
							2=>$this->Ads_model->select(array('bid'=>2),'id,title,simg,url,descs',0,6,'ord ASC,id desc'),
							3=>$this->Ads_model->row(array('bid'=>3)),
							);
		//print_r($arg['ads']);exit;
		
		$arg['is_nav'] = 1;
		$arg['hover']  = 'home';
		$this->pageinfo['body'] = $this->load->view('index',$arg,true);
		$this->load->view('page',$this->pageinfo);
		 
	}
	

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */