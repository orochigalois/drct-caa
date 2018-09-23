<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scode {
	private $width;
	private $height;
	private $codeNum;
	private $disturbColorNum;
	private $checkCode;
	private $image;

	/**
	 * 构造方法用来实例化验证码对象，并为一些成员属性初使化
	 * @param	int	$width		设置验证码图片的宽度，默认宽度值为80像素
	 * @param	int	$height		设置验证码图片的高度，默认高度值为20像素
	 * @param	int	$codeNum	设置验证码中字母和数字的个数，默认个数为4个
	 */
	function __construct($width=80, $height=20, $codeNum=4) {
		$this->width=$width;
		$this->height=$height;
		$this->codeNum=$codeNum;
		$number=floor($height*$width/15);
		if($number > 240-$codeNum)
			$this->disturbColorNum=240-$codeNum;
		else
			$this->disturbColorNum=$number;
		$this->checkCode=$this->createCheckCode();
	}

	/**
	 * 用于输出验证码图片，也向服务器的SESSION中保存了验证码
	 * 使用echo 输出对象即可
	 * @return string	验证码
	 */
	function __toString(){
		$_SESSION["scode"]=strtoupper($this->checkCode);
		$this->outImg();
		return '';
	}

	private function outImg(){
		$this->getCreateImage();
		// $this->setDisturbColor();
		$this->outputText();
		$this->outputImage();
	}

	private function getCreateImage(){
		$this->image=imagecreatetruecolor($this->width,$this->height);
		$backColor = imagecolorallocate($this->image, rand(225,255),rand(225,255),rand(225,255));
		imagefill($this->image, 0, 0, $backColor);
		$border=imageColorAllocate($this->image, 0, 0, 0);
		imageRectangle($this->image,0,0,$this->width-1,$this->height-1,$border);
	}

	private function createCheckCode(){
		$code="3456789abcdefghijkmnpqrstuvwxyABCDEFGHIJKMNPQRSTUVWXY";
		$ascii = '';
		for($i=0;$i<$this->codeNum;$i++) {
			$char = $code{rand(0,strlen($code)-1)};
			$ascii .= $char;
		}
		return $ascii;
	}

	private function setDisturbColor() {
		for($i=0; $i<=$this->disturbColorNum; $i++) {
			$color = imagecolorallocate($this->image, rand(0,255), rand(0,255), rand(0,255));
			imagesetpixel($this->image,rand(1,$this->width-2),rand(1,$this->height-2),$color);
		}
		for($i=0; $i<10; $i++){
			$color=imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
			imagearc($this->image,rand(-10,$this->width),rand(-10,$this->height),rand(30,300),rand(20,200),55,44,$color);
		}
	}

	private function outputText() {
		for ($i=0;$i<$this->codeNum;$i++) {
			$fontcolor = imagecolorallocate($this->image, rand(0,128), rand(0,128), rand(0,128));
			$fontSize=rand(3,5);
			$x = floor($this->width/$this->codeNum)*$i+3;
			$y = rand(0,$this->height-imagefontheight($fontSize));
			imagechar($this->image, $fontSize, $x, $y, $this->checkCode{$i}, $fontcolor);
		}
	}

	private function outputImage(){
		//ob_clean();
		if(imagetypes() & IMG_GIF){
			header("Content-type: image/gif");
			imagegif($this->image);
		}elseif(imagetypes() & IMG_JPG){
			header("Content-type: image/jpeg");
			imagejpeg($this->image, "", 0.5);
		}elseif(imagetypes() & IMG_PNG){
			header("Content-type: image/png");
			imagepng($this->image);
		}elseif(imagetypes() & IMG_WBMP){
			header("Content-type: image/vnd.wap.wbmp");
			imagewbmp($this->image);
		}else{
			die("PHP不支持图像创建！");
		}
		imagedestroy($this->image);
	}
}

/* eof */