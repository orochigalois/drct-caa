<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class email_send{
	
	public $ci = null;
	public function __construct(){
		$this->ci = &get_instance();
		$config =& get_config();
		$config['protocol']  = 'smtp';//采用smtp方式
        $config['smtp_host'] = 'smtp.zhurongge.com';
        $config['smtp_user'] = 'zhurong@zhurongge.com';//你的邮箱帐号
        $config['smtp_pass'] = 'zhurong001';//你的邮箱密码
//         $config['smtp_pass'] = 25;
        $config['charset']   = 'utf-8';
        $config['wordwrap']  = TRUE;
        $config['mailtype']  = "html";
        $this->ci->load->library('email');//加载email类
        $this->ci->email->initialize($config);//参数配置
        $this->ci->email->from('zhurong@zhurongge.com', '助融阁');
	}
	
	
	public function send($email,$title = '',$message = ''){
		$this->ci->email->to($email);
		$this->ci->email->subject($title);
		$this->ci->email->message($message);
		$send_flag = $this->ci->email->send();
		var_dump($send_flag);
		if($send_flag){
			return true;
		}else{
			return false;
		}
	}
}

?>