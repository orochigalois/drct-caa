<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//头像处理
class Avatar extends Echina
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* 图片上传
	*/
	public function attrlist(){
 
		$attr_url = 'static/kindeditor/attached/';
		$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		$dir_name = $this->input->get('dir');
		$path_name = $this->input->get('path');
		$order = $this->input->get('order');
		if(!in_array($dir_name,array('image','flash','media','file'))){
			echo "Invalid Directory name.";
			exit;
		}
		if($dir_name!=''){
			$attr_url .= $dir_name.'/';
			if (!file_exists($attr_url)) {
				mkdir($attr_url);
			}
		}
		$current_path = $attr_url.($path_name!=''?$path_name.'/':'');
		if ($path_name=='') {
			$current_path =$attr_url;
			$current_dir_path = '';
			$moveup_dir_path = '';
		} else {
			$current_path = $attr_url.$path_name.'/';
			$current_dir_path = $path_name;
			$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
		}
		$order = $order==''?'name':strtolower($order);
		if (preg_match('/\.\./', $current_path)) {
			echo 'Access is not allowed.';
			exit;
		}
		if (!preg_match('/\/$/', $current_path)) {
			echo 'Parameter is not valid.';
			exit;
		}
		if (!file_exists($current_path) || !is_dir($current_path)) {
			echo 'Directory does not exist.';
			exit;
		}
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('number');
		$listarr = directory_map($current_path,1);
		$i = 0;
		foreach($listarr as $filename){
			$filepath = $current_path.$filename;
			$file = get_file_info($filepath);
			if(is_dir($filepath)){
				$tmpDir =directory_map($file['server_path'],1);
				$file_list[$i]['is_dir'] = true;
				$file_list[$i]['has_file'] = (count($tmpDir) > 0);
				$file_list[$i]['filesize'] = 0;
				$file_list[$i]['is_photo'] = false;
				$file_list[$i]['filetype'] = '';
				unset($tmpDir);
			}else{
				$file_list[$i]['is_dir'] = false;
				$file_list[$i]['has_file'] = false;
				$file_list[$i]['filesize'] = $file['size'];
				$file_list[$i]['dir_path'] = '';
				$file_ext = strtolower(get_suffix($file['server_path']));
				$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
				$file_list[$i]['filetype'] = $file_ext;
			}
			$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
			$file_list[$i]['datetime'] = date('Y-m-d H:i:s', $file['date']); //文件最后修改时间
			$i++;
		}
		usort($file_list, 'cmp_func');
		$result = array();
		$result['moveup_dir_path'] = $moveup_dir_path;
		$result['current_dir_path'] = $current_dir_path;
		$result['current_url'] = base_url($current_path).'/';
		$result['total_count'] = count($file_list);
		$result['file_list'] = $file_list;
		echo json_encode($result);
	}
	
	function attrupload(){
		$get = $this->input->get(NULL,TRUE);
		$width = isset($get['width']) ? intval($get['width']) : 0;
		$height = isset($get['height']) ? intval($get['height']) : 0;
		$save_path = 'static/kindeditor/attached/';
		$ext_arr = array(
				'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
				'file' => array('gif', 'jpg', 'jpeg', 'png', 'bmp','doc', 'docx', 'xls', 'xlsx', 'ppt', 'txt', 'zip', 'rar', 'gz', 'bz2','swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'rm', 'rmvb'),
		);

		//print_r($_FILES);exit;
		
		$dir_name = $this->input->get('dir');
		if(!in_array($dir_name,array('image','flash','media','file'))){
			$result = array('error'=>1,'message'=>"Invalid Directory name.");
			echo json_encode($result);
		}
		$save_path .= $dir_name.'/';
		if (!file_exists($save_path)) {
				mkdir($save_path);
		}
		$save_path .= date('Ymd').'/';
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		$uploadconfig['upload_path'] = $save_path;
		$uploadconfig['allowed_types'] = implode('|',$ext_arr[$dir_name]);
		$uploadconfig['encrypt_name']  = TRUE;
		$uploadconfig['remove_spaces']  = TRUE;
		$uploadconfig['max_size']  = '404800000';
		$this->load->library('upload', $uploadconfig);
		if(!$this->upload->do_upload('imgFile')){
			$result = array('error'=>1,'message'=>$this->upload->display_errors('',''));
		}else{
			$data = $this->upload->data();
			if($dir_name=='image'){
				$this->load->library('image_lib');
				$waterconfig['image_library'] = 'gd2';
				$waterconfig['source_image'] = $save_path.$data['file_name'];
				$waterconfig['maintain_ratio'] = TRUE;
				if($width)  $waterconfig['width'] = $width;
				if($height) $waterconfig['height'] = $height;
				$this->image_lib->initialize($waterconfig);
				$this->image_lib->resize();
			}
			$result = array('error'=>0,'url'=>base_url($save_path.$data['file_name']));
		}
		echo json_encode($result);
	}


	//上传附件
	function attrupload_n(){
		$get = $this->input->get(NULL,TRUE);
		$width  = isset($get['width']) ? intval($get['width']) : 0;
		$height = isset($get['height']) ? intval($get['height']) : 0;
		$site   = isset($get['site']) ? trim($get['site']) : '';
		$type   = isset($get['type']) ? trim($get['type']) : '';
		$save_path = 'static/kindeditor/attached/';
		$ext_arr = array(
				'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
				'file' => array('gif', 'jpg', 'jpeg', 'png', 'bmp','doc', 'docx', 'xls', 'xlsx', 'ppt', 'txt', 'zip', 'rar', 'gz', 'bz2','swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'rm', 'rmvb','mp4'),
				//'media' => array('flv,mp4'),
		);
		$dir_name = $this->input->get('dir');
		if(!empty($type))
		{
			$dir_name	= $type;
		}
		if(!in_array($dir_name,array('image','flash','media','file'))){
			$result = array('error'=>1,'message'=>"Invalid Directory name.");
			echo json_encode($result);
		}
		$save_path .= $dir_name.'/';
		if (!file_exists($save_path)) {
				mkdir($save_path);
		}
		$save_path .= date('Ymd').'/';
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		$uploadconfig['upload_path'] = $save_path;
		$uploadconfig['allowed_types'] = implode('|',$ext_arr[$dir_name]);
		$uploadconfig['encrypt_name']  = TRUE;
		$uploadconfig['remove_spaces']  = TRUE;
		$uploadconfig['max_size']  = '10240000';
		$this->load->library('upload',$uploadconfig);
		if(!$this->upload->do_upload('imgFile')){
			$result = array('error'=>1,'message'=>$this->upload->display_errors('',''));
		}else{
			$data = $this->upload->data();
			if($dir_name=='image'){
				$this->load->library('image_lib');
				$waterconfig['image_library'] = 'gd2';
				$waterconfig['source_image'] = $save_path.$data['file_name'];
				$waterconfig['maintain_ratio'] = TRUE;
				if($width)  $waterconfig['width'] = $width;
				if($height) $waterconfig['height'] = $height;
				$this->image_lib->initialize($waterconfig);
				$this->image_lib->resize();
			}
			$result = array('error'=>0,'url'=>base_url($save_path.$data['file_name']));
		}
		echo json_encode($result);
	}
	
	
	//上传图片
	function attrImg(){
		$get = $this->input->get(NULL,TRUE);
		$width = isset($get['width']) ? intval($get['width']) : 0;
		$height = isset($get['height']) ? intval($get['height']) : 0;
		$save_path = 'static/kindeditor/attached/';
		$ext_arr = array(
				'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
		);
		$dir_name = $this->input->get('dir');
		if(!in_array($dir_name,array('image','flash','media','file'))){
			$result = array('error'=>1,'message'=>"Invalid Directory name.");
			echo json_encode($result);
		}
		$save_path .= $dir_name.'/';
		if (!file_exists($save_path)) {
				mkdir($save_path);
		}
		$save_path .= date('Ymd').'/';
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
		$uploadconfig['upload_path'] = $save_path;
		$uploadconfig['allowed_types'] = implode('|',$ext_arr[$dir_name]);
		$uploadconfig['encrypt_name']  = TRUE;
		$uploadconfig['remove_spaces']  = TRUE;
		$uploadconfig['max_size']  = '2024';
		$this->load->library('upload', $uploadconfig);
		if(!$this->upload->do_upload('imgFile')){
			$result = array('error'=>1,'message'=>$this->upload->display_errors('',''));
		}else{
			$data = $this->upload->data();
				
			$this->load->helper('pic');
			$y_simg = $save_path.$data['file_name'];
			$n_simg = $save_path.$data['raw_name'].'_1'.$data['file_ext'];
			imagezoom($y_simg,$n_simg,$width,$height);
			
			$result = array('error'=>0,'url'=>base_url($n_simg));
		}
		echo json_encode($result);
	}

	



}

