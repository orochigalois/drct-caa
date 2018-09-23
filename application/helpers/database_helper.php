<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取数据表单个字段的值
 * @param string $table_name
 * @param string $column_name
 * @param void $where
 * @return boolean | void
 */
function db_result($table_name, $column_name, $where)
{
	$ci = &get_instance();
	$re = $ci->db->select($column_name)->where($where)->limit(1)->get($table_name);
	if(1 === $re->num_rows())
	{
		$re = $re->result_array();
		return $re[0][$column_name];
	}
	else
	{
		return FALSE;
	}
}

/** 将某个字段的值自增，$value值可以为负
 * 
 * @param string $table_name 	表名
 * @param string $column_name	字段名
 * @param void $where		where条件，为ci数据库的where语法
 * @param int $value		值
 */
function inc($table_name, $column_name, $where, $value = 1)
{
	$value = intval($value);
	$ci = &get_instance();
	$ci ->db
		 ->set($column_name, '`' . $column_name . '` + ' . $value, FALSE)
		 ->where($where)
		 ->update($table_name);
}

/**
 * 将table_name 的status字段的值置为value
 * @param string $table_name
 * @param void $where
 * @param tinyint $value
 */
function set_status($table_name, $where, $value = 0)
{
	$value = intval($value);
	$ci = &get_instance();
	$ci->db->set('status', $value)
				->where($where)
				->update($table_name);
	// print_r($ci->db->queries);
}

//上传图片
function uploadFile($files,$uppath = 'static/upfile', $width = 0, $height = 0)
{
	$type=$files["type"];
	$sfile = '';
	if( ( $type=="image/jpeg" or $type=="image/gif" or $type=="image/pjpeg"  or $type=="image/x-png" or $type=="image/png") )
	{
		$sfile=date("YmdHis") . rand(1000,9999) . substr( $files["name"],strrpos($files["name"],"."));
		move_uploaded_file($files["tmp_name"],$uppath."/".$sfile);
		_cut_image($uppath,$sfile, $width, $height);//截取;
	}
	
	return $sfile;
}

function _cut_image($uppath,$image, $width = 0, $height = 0)
{
	$ci = &get_instance();
	$ci->load->library('image_lib');
	$config['image_library'] = 'gd2';
	$config['source_image'] = $uppath.'/'.$image;
	$config['create_thumb'] = FALSE;
	$config['maintain_ratio'] = TRUE;
	if($width)  $config['width'] = $width;
	if($height) $config['height'] = $height;
	$ci->image_lib->initialize($config);
	if(!$ci->image_lib->resize())
	{
		echo $ci->image_lib->display_errors(); exit;
	}
}
