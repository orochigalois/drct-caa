<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Echina extends CI_Controller
{
	protected $pageinfo;
	public $link_name  = '友情链接';
	public $msg_name   = '留言内容';
	public function __construct()
	{
		parent::__construct();
		$this->init_pageinfo();
		$this->load->model('About_model');
		$this->load->model('Newstype_model');
		$this->load->model('Links_model');
	}
	/**
	 * 初始化pageinfo
	 */
	private function init_pageinfo()
	{
		$base = $this->Base_model->row( array('id' => 1) );
		$setting = $this->Setting_model->row( array('id' => 1) );
		$this->pageinfo = array(
			'isLogin'	=> FALSE,
			'seo_title' 	=> '',
			'seo_keywords' 	=> '',
			'seo_desc'		=> '',
			'csses'		=> array(),
			'jses'		=> array(),
			'breadcrumb'=> ''
		);
		$this->load->vars($setting);
		$this->load->vars($base);
		
	}

	/**
	 * 设置页面title属性
	 * @param string $title
	 */
	protected function set_title($title='')
	{
		$this->pageinfo['seo_title'] = $title;
	}

	/**
	 * 设置页面keywords属性
	 * @param string $kw
	 */
	protected function set_keywords($kw='')
	{
		$this->pageinfo['seo_keywords'] = $kw;
	}

	/**
	 * 设置页面description属性
	 * @param string $desc
	 */
	protected function set_desc($desc='')
	{
		$this->pageinfo['seo_desc'] = $desc;
	}


	/**
	 * 添加js文件
	 * @param  $js_file js文件名或者路径
	 * @param  $is_rela_path true表示$js_file是相对路径，false表示自定义的绝对路径
	 */
	protected function add_js($js_file, $is_rela_path = true)
	{
		if($is_rela_path)
			$this->pageinfo['jses'][] = 'static/js/' . $js_file;
		else
			$this->pageinfo['jses'][] = $js_file;
	}

	/**
	 * 添加css文件
	 * @param string $css_file css文件名或者路径
	 * @param bool $is_rela_path true表示$css_file是相对路径，false表示自定义的绝对路径
	 */
	protected function add_css($css_file, $is_rela_path = true)
	{
		if($is_rela_path)
			$this->pageinfo['csses'][] = 'static/css/' . $css_file;
		else
			$this->pageinfo['csses'][] = $css_file;
	}

	/**
	 * 一维数组，设置面包屑导航
	 * @param array $sb
	 */
	protected function set_breadcrumb(array $sb)
	{
		$linker = " &gt; ";
		$str = '';
		if(!$sb) $this->pageinfo['breadcrumb'] = '';
		foreach($sb as $key => $value)
		{
			//$key = str_replace('-', ' ', $key);
			if($value)
			{
				$str .= "<a href='{$value}'>".$key ."</a>";
			}else
			{
				$str .= "$key";
			}
			$str .= $linker;
		}

		$this->pageinfo['breadcrumb'] = rtrim($str, $linker);
	}
	

	/*判断是否登录*/
	public function is_login($reture = TRUE)
	{
		if($reture)
		{
			if(!$this->sess->get('isLoginMember'))
			{
				echo WindowLocation(site_url('member/login'));
			}
		}
		else
		{
			if($this->sess->get('isLoginMember'))
			{
				echo WindowLocation(site_url('member'));
			}
		}
	}
 




 

}

/* file end */