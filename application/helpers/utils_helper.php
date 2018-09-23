<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function formatBytes($bytes) {
	if($bytes >= 1073741824) {
		$bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
	} elseif($bytes >= 1048576) {
		$bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
	} elseif($bytes >= 1024) {
		$bytes = round($bytes / 1024 * 100) / 100 . 'KB';
	} else {
		$bytes = $bytes . 'Bytes';
	}
	return $bytes;
}


/*从数据库中调出大量的数据，获取内容中的第一张图片的路径*/   
function s_img($str){
    preg_match_all("/<img.*\>/isU",$str,$ereg);//把图片的<img整个都获取出来了 
    if(!empty($ereg[0]))
	{
	$img=$ereg[0][0];//图片 
    $p="#src=('|\")(.*)('|\")#isU";
    preg_match_all ($p, $img, $img1); 
    $img_path =$img1[2][0];//获取第一张图片路径
    
		return $img_path; 
	}
	else
	{
		return '';
	}
    }
   







/**
 * 分页
 * @param string $table_name
 * @param string $column_name
 * @param void $where
 * @return boolean | void
 */
function gen_page($pageurl,$pagetoal, $pagesize)
{
 
		$ci = &get_instance();
		$ci->load->library('pagination');
		$config['base_url'] = $pageurl;
		$config['total_rows'] = $pagetoal;
		$config['per_page'] =  $pagesize;
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		$config['first_link'] = '首页';
		$config['last_link'] = '末页';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['num_links'] = 9;//设置显示多少页码值
		$ci->pagination->initialize($config);
		return $ci->pagination->create_links();
}


// 反解析embed标签
function escape_embed($str)
{
	return preg_replace('/&lt;embed(.*?)\/&gt;&lt;/', '<embed$1/><', $str);
}

// 时间转化为时间戳
function time2stamp($str)
{
	preg_match('/(\d\d)\/(\d\d)\/(\d\d\d\d)\s(\d\d):(\d\d):(\d\d)/', $str, $m);
	$stamp = mktime($m[4], $m[5], $m[6], $m[1], $m[2], $m[3]);
	return $stamp;
}

 



  
function JSON($array) {  

    arrayRecursive($array, 'urlencode', true);  

	 $json = json_encode($array);  

     return urldecode($json);  

}  


	/** 系统配置 - 咨询配置 **/
function getfirstchar($s0){
$s=iconv('UTF-8','gb2312', $s0);
if (ord($s0)>128) { //汉字开头
$asc=ord($s{0})*256+ord($s{1})-65536;
if($asc>=-20319 and $asc<=-20284)return "A";
if($asc>=-20283 and $asc<=-19776)return "B";
if($asc>=-19775 and $asc<=-19219)return "C";
if($asc>=-19218 and $asc<=-18711)return "D";
if($asc>=-18710 and $asc<=-18527)return "E"; 
if($asc>=-18526 and $asc<=-18240)return "F"; 
if($asc>=-18239 and $asc<=-17923)return "G"; 
if($asc>=-17922 and $asc<=-17418)return "I"; 
if($asc>=-17417 and $asc<=-16475)return "J"; 
if($asc>=-16474 and $asc<=-16213)return "K"; 
if($asc>=-16212 and $asc<=-15641)return "L"; 
if($asc>=-15640 and $asc<=-15166)return "M"; 
if($asc>=-15165 and $asc<=-14923)return "N"; 
if($asc>=-14922 and $asc<=-14915)return "O"; 
if($asc>=-14914 and $asc<=-14631)return "P"; 
if($asc>=-14630 and $asc<=-14150)return "Q"; 
if($asc>=-14149 and $asc<=-14091)return "R"; 
if($asc>=-14090 and $asc<=-13319)return "S"; 
if($asc>=-13318 and $asc<=-12839)return "T"; 
if($asc>=-12838 and $asc<=-12557)return "W"; 
if($asc>=-12556 and $asc<=-11848)return "X"; 
if($asc>=-11847 and $asc<=-11056)return "Y"; 
if($asc>=-11055 and $asc<=-10247)return "Z"; 
}else if(ord($s)>=48 and ord($s)<=57){ //数字开头
switch(iconv_substr($s,0,1,'utf-8'))
{
case 1:return "Y";
case 2:return "E";
case 3:return "S";
case 4:return "S";
case 5:return "W";
case 6:return "L";
case 7:return "Q";
case 8:return "B";
case 9:return "J";
case 0:return "L";
} 
}else if(ord($s)>=65 and ord($s)<=90){ //大写英文开头
return substr($s,0,1);
}else if(ord($s)>=97 and ord($s)<=122){ //小写英文开头
return strtoupper(substr($s,0,1));
}
else
{
return iconv_substr($s0,0,1,'utf-8');//中英混合的词语，不适合上面的各种情况，因此直接提取首个字符即可
}

}


/**
 * 函数名：Alert($C_alert,$I_goback=0)
 * 作 用：非法操作警告
 * @author	Arthur <ArthurXF@gmail.com>
 * @param	$C_alert （提示的错误信息）
 * @param	$I_goback （返回到那一页）
 * @return	布尔值
 * 备 注：无
 */
function Alert($C_alert,$I_goback=0){
	if($I_goback<>0)	{
		if($C_alert == '') {
			echo "<script>history.go($I_goback);</script>";
		}else echo "<script>alert('$C_alert');history.go($I_goback);</script>";
	}else{
		echo "<script>alert('$C_alert');</script>";
	}
}

/**
 * 函数名：WindowLocation($C_url,$C_get="",$C_getOther="")
 * 作 用：PHP中的window.location函数
 * @author	Arthur <ArthurXF@gmail.com>
 * @param	$C_url （转向窗口的URL）
 * @param	$C_get （GET方法参数）
 * @param	$C_getOther （GET方法的其他参数）
 * @return	无
 * 备 注：无
 */
function WindowLocation($C_url,$C_get="",$C_getOther=""){
	if($C_get == '' && $C_getOther == ''){
		$C_target="window.location='$C_url'";
	}
	if($C_get == "" && $C_getOther <> ""){
		$C_target="window.location='$C_url?$C_getOther='+this.value";
	}
	if($C_get <> "" && $C_getOther == ""){
		$C_target="window.location='$C_url?$C_get'";
	}
	if($C_get <> "" && $C_getOther <> ""){
		$C_target="window.location='$C_url?$C_get&$C_getOther='+this.value";
	}
	echo '<script>'.$C_target.'</script>';
	exit;
}


/**
* 支持utf8中文字符截取
* @author	肖飞
* @param	string $text		待处理字符串
* @param	int $start			从第几位截断
* @param	int $sublen			截断几个字符
* @param	string $code		字符串编码
* @param	string $ellipsis	附加省略字符
* @return	string
*/
function strcut($string, $start = 0,$sublen=12, $ellipsis='',$code = 'UTF-8'){
	$intTemp = 0;
	if($code == 'UTF-8'){
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $string, $t_string);
		foreach($t_string[0] as $k => $v){
			if(strpos("~!@#$%^&*()_+{}|\":<>?`1234567890-=[]\;',./abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ", $v) != false && $k <= $sublen) {$intTemp++;};
		}
		$sublen = $sublen + floor($intTemp/2);

		if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)).$ellipsis;
		return join('', array_slice($t_string[0], $start, $sublen));
	}else{
		$start = $start;
		$strlen = strlen($string);
		if($sublen != 0) $sublen = $sublen*2;
		else $sublen = $strlen;
		$tmpstr = '';
		for($i=0; $i<$strlen; $i++){
			if($i>=$start && $i<($start+$sublen)){
				if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
				else $tmpstr.= substr($string, $i, 1);
			}
			if(ord(substr($string, $i, 1))>129) $i++;
		}
		if(strlen($tmpstr)<$strlen ) $tmpstr.= $ellipsis;
		return $tmpstr;
	}
}

/**
 * 将内容过滤成文本
 * @author	肖飞
 * @param	string $document		待处理字符串
 * @return  string
 */

function stripText($document){

	// I didn't use preg eval (//e) since that is only available in PHP 4.0.
	// so, list your entities one by one here. I included some of the
	// more common ones.

	$search = array("'<script[^>]*?>.*?</script>'si",	// strip out javascript
					"'<[\/\!]*?[^<>]*?>'si",			// strip out html tags
					"'([\r\n])[\s]+'",					// strip out white space
					"'&(quot|#34|#034|#x22);'i",		// replace html entities
					"'&(amp|#38|#038|#x26);'i",			// added hexadecimal values
					"'&(lt|#60|#060|#x3c);'i",
					"'&(gt|#62|#062|#x3e);'i",
					"'&(nbsp|#160|#xa0);'i",
					"'&(iexcl|#161);'i",
					"'&(cent|#162);'i",
					"'&(pound|#163);'i",
					"'&(copy|#169);'i",
					"'&(reg|#174);'i",
					"'&(deg|#176);'i",
					"'&(#39|#039|#x27);'",
					"'&(euro|#8364);'i",				// europe
					"'&a(uml|UML);'",					// german
					"'&o(uml|UML);'",
					"'&u(uml|UML);'",
					"'&A(uml|UML);'",
					"'&O(uml|UML);'",
					"'&U(uml|UML);'",
					"'&szlig;'i",
					);
	$replace = array(	"",
						"",
						"\\1",
						"\"",
						"&",
						"<",
						">",
						" ",
						chr(161),
						chr(162),
						chr(163),
						chr(169),
						chr(174),
						chr(176),
						chr(39),
						chr(128),
						"ä",
						"ö",
						"ü",
						"Ä",
						"Ö",
						"Ü",
						"ß",
					);

	$text = preg_replace($search,$replace,$document);

	return $text;
}

function getsiteurl()
{
	$uri = $_SERVER['REQUEST_URI']?$_SERVER['REQUEST_URI']:($_SERVER['PHP_SELF']?$_SERVER['PHP_SELF']:$_SERVER['SCRIPT_NAME']);
	return 'http://'.$_SERVER['HTTP_HOST'].$uri;

}
function md5pass($pass,$salt)
{
	return md5(substr(md5($pass),0,10).$salt);
}


//删除图片
function  delFile($myfile)
{
	$myfile = iconv('UTF-8','GBK',$myfile);
	if (file_exists($myfile)) {
		unlink ($myfile);
	}
}

function fileext($filename)
{
	return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}

// 生成资讯链接
function newUrl($url)
{
	if(!empty($url))
	{
		if(FALSE === strpos($url, 'http://'))
		{
			return 'http://' . $url;
		}
	}
	return $url;
}


function pageBreak($content) 
{
	$pattern = "/<hr class=\"ke-pagebreak\" style=\"page-break-after:always;\" \/>/"; 
	$strSplit = preg_split($pattern, $content, -1); 
	$count = count($strSplit); 
	$outStr = ""; 
	$i = 1;
	if ($count > 1 ) { 
	$outStr = "<div id='page_break'>"; 
	foreach($strSplit as $value) { 
	if ($i <= 1) { 
	$outStr .= "<div id='page_$i'>$value</div>"; 
	} else { 
	$outStr .= "<div id='page_$i' class='collapse'>$value</div>"; 
	} 
	$i++; 
	} 
	$outStr .= "<div class='num'>"; 
	for ($i = 1; $i <= $count; $i++) { 
	$outStr .= "<li>$i</li>"; 
	} 
	$outStr .= "</div></div>"; 
	return $outStr; 
	} else { 
	return $content; 
	}
}

//过滤 防注入
function safe_replace($string)
{
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}

function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
	if (stristr($user_agent, $device)) {
	$is_mobile = true;
	break;
	}
	}
	return $is_mobile;
}


/* file end */