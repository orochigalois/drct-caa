<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recom
{

    private $ci = null;
    private $config = null;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->config->load('recom');
        $this->config = $this->ci->config->item('recom');
    }

    public function get_list($item='recom')
    {
        $arr = array();
        $this->config = $this->ci->config->item($item);
        foreach($this->config as $k => $v)
        {
            $arr[$k] = $v;
        }
        return $arr;
    }


	public function get_recom_value($is_recom,$item='recom',$t=0)
	{
		$value = '';
        $this->config = $this->ci->config->item($item);
		foreach($this->config as $k => $v)
        {
            if($k == $is_recom)
			{
				$value = $v;
			}
        }
        if( $t ) {
			return $value;
        } else {
			return '&nbsp;'.$value;
        }

	}

}

/* EOF */