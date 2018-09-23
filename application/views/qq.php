<script language="javascript">
document.write("<div class='QQbox' id='divQQbox' >");

document.write("<div class='Qlist' id='divOnline' onmouseout='hideMsgBox(event);' style='display : none;'>");

document.write("<div class='t'></div>");

document.write("<div class='con'>");

document.write("<h2>在线客服</h2>");

document.write("<ul>");

<?php
	$arrQQ=explode(',',$QQ);
	$arrQQName=explode(',',$QQName);
	$num=count($arrQQ);
	for($i=0;$i<$num;$i++)
	{
?>
document.write("<li class=odd><a href='http://wpa.qq.com/msgrd?v=3&uin=<?= $arrQQ[$i]?>&site=<?= $arrQQName[$i]?>&menu=yes' target='_blank'><img src='http://wpa.qq.com/pa?p=2:<?= $arrQQ[$i]?>:4'  border='0' alt='QQ' style='float:left' /><?=$arrQQName[$i]?></a></li>");
<?php }?>




document.write("</ul>");document.write("</div>");

document.write("<div class='b'></div>");

document.write("</div>");

document.write("<div id='divMenu' onmouseover='OnlineOver();'><img src='<?php echo base_url('static')?>/css/qq/qq_1.png' class='press' alt='QQ客服热线'></div>");

document.write("</div>");



//<![CDATA[

var tips; var theTop = 80/*这是默认高度,越大越往下*/; var old = theTop;

function initFloatTips() {

tips = document.getElementById('divQQbox');

moveTips();

};

function moveTips() {

var tt=50;

if (window.innerHeight) {

pos = window.pageYOffset

}

else if (document.documentElement && document.documentElement.scrollTop) {

pos = document.documentElement.scrollTop

}

else if (document.body) {

pos = document.body.scrollTop;

}

pos=pos-tips.offsetTop+theTop;

pos=tips.offsetTop+pos/10;



if (pos < theTop) pos = theTop;

if (pos != old) {

tips.style.top = pos+"px";

tt=10;

//alert(tips.style.top);

}



old = pos;

setTimeout(moveTips,tt);

}

//!]]>

initFloatTips();







function OnlineOver(){

document.getElementById("divMenu").style.display = "none";

document.getElementById("divOnline").style.display = "block";

document.getElementById("divQQbox").style.width = "145px";

}



function OnlineOut(){

document.getElementById("divMenu").style.display = "block";

document.getElementById("divOnline").style.display = "none";



}



function hideMsgBox(theEvent){ //theEvent用来传入事件，Firefox的方式

　 if (theEvent){

　 var browser=navigator.userAgent; //取得浏览器属性

　 if (browser.indexOf("Firefox")>0){ //如果是Firefox

　　 if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素

　　 return; //结束函式

} 

} 

if (browser.indexOf("MSIE")>0){ //如果是IE

if (document.getElementById('divOnline').contains(event.toElement)) { //如果是子元素

return; //结束函式

}

}
else
{
	if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素
            
        return; //结束函式
            
    } 
}


}

/*要执行的操作*/

document.getElementById("divMenu").style.display = "block";

document.getElementById("divOnline").style.display = "none";

}

</script>
