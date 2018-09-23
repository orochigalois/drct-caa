<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>管理后台</title>
<link href="<?=base_url('static/css/admin/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('static/css/admin/tablestyle.css')?>" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=base_url('static/js/admin/jquery-1.4.2.min.js')?>"></script>
<script language="javascript" src="<?=base_url('static/js/admin/js.js')?>"></script>
<script language="javascript" src="<?=base_url('static/js/admin/public.js')?>"></script>
<script language="javascript" src="<?=base_url('static/js/admin/Validform_v5.js')?>"></script>
<link href="<?=base_url('static/css/admin/validform.css')?>" rel="stylesheet" type="text/css" />
</head>
<div class="container">
	<div class="head">
    	<div class="head1"><?php echo db_result('base','title',array('id'=>1));?></div>
        <div class="head2">
        	<a href="<?=site_url()?>" class="xz" target="_blank"><img src="<?=base_url('static/images/admin/ttb1.png')?>" width="24" height="23" />网站首页</a>
            <a href="<?=site_url('admin/admin')?>"><img src="<?=base_url('static/images/admin/ttb2.png')?>" width="24" height="23" />系统管理</a>
            <a href="<?=site_url('admin/admin/logout')?>"><img src="<?=base_url('static/images/admin/ttb4.png')?>" width="24" height="23" />安全退出</a>
        </div>
    </div>

    <div class="main">
    	<div class="mleft">
        	<ul class="ul">
            	<li><a href="#">信息管理</a>
                	<ul class="ul1">
                    	<li <?=(isset($hover) && $hover=='base')?'class="xz"':'';?>><a href="<?=site_url('admin/base')?>">基本信息</a></li>
                        <li <?=(isset($hover) && $hover=='slide')?'class="xz"':'';?>><a href="<?=site_url('admin/slide')?>">幻灯管理</a></li>
                        <li <?=(isset($hover) && $hover=='links')?'class="xz"':'';?>><a href="<?=site_url('admin/links')?>">链接管理</a></li>
                        <li <?php echo (isset($hover) && $hover=='message')?'class="xz"':'';?>><a href="<?php echo site_url('admin/message')?>"><?php echo $this->msg_name;?></a></li>
                        <div class="lt"></div>
                    </ul>
                </li>
				<li><a href="#">单页管理</a>
                	<ul class="ul1">
                    	<li <?=(isset($hover) && $hover=='about')?'class="xz"':'';?>><a href="<?=site_url('admin/about')?>">内容管理</a></li>
                        <div class="lt"></div>
                    </ul>
                </li>
                <li><a href="#">图文管理</a>
                	<ul class="ul1">
                    	<li <?=(isset($hover) && $hover=='newsType')?'class="xz"':'';?>><a href="<?=site_url('admin/news/typeList')?>">分类管理</a></li>
                        <li <?=(isset($hover) && $hover=='news')?'class="xz"':'';?>><a href="<?=site_url('admin/news')?>">内容管理</a></li>
                        <div class="lt"></div>
                    </ul>
                </li>
                <li><a href="#">广告管理</a>
                	<ul class="ul1">
                    	<li <?=(isset($hover) && $hover=='ads')?'class="xz"':'';?>><a href="<?=site_url('admin/ads')?>">广告管理</a></li>
                        <div class="lt"></div>
                    </ul>
                </li>

                <li><a href="#">系统管理</a>
                	<ul class="ul1">
                    	<li <?=(isset($hover) && $hover=='user')?'class="xz"':'';?>><a href="<?=site_url('admin/admin/user')?>">管理员管理</a></li>
                        <li><a href="<?=site_url('admin/admin/backup_db')?>">数据库备份</a></li>
                        <li <?=(isset($hover) && $hover=='files')?'class="xz"':'';?>><a href="<?=site_url('admin/admin/files')?>">附件管理</a></li>
                        <div class="lt"></div>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="mright">
        	<div class="mrtop">
            	<div class="breadCrumb">
                	您当前的位置： <?=isset($position)?$position:'';?>
                </div>
                <div class="mrtr">
	<script language=JavaScript>
    today=new Date();
    function initArray(){
    this.length=initArray.arguments.length
    for(var i=0;i<this.length;i++)
    this[i+1]=initArray.arguments[i] }
    var d=new initArray( "星期日", "星期一", "星期二", "星期三", "星期四","星期五", "星期六");
    document.write( today.getFullYear(),"年", today.getMonth()+1,"月", today.getDate(),"日 ", d[today.getDay()+1]
    );
    </script>
                </div>
                <div class="clear"></div>
            </div>
            <?=$body?>
            <div class="copyRight">北京金方时代科技有限公司&nbsp;&nbsp;&nbsp; 版权所有 Inc All Rights Reserved  &nbsp;&nbsp;&nbsp;联系电话：010-51654321</div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$(function(){
	$(".addForm").Validform({
		tiptype:function(msg,o,cssctl){
			if(!o.obj.is("form")){
				var objtip=o.obj.parents("td").find(".Validform_checktip");
				cssctl(objtip,o.type);
				objtip.text(msg);
				var infoObj=o.obj.parents("td").find(".info");
				if(o.type==2){
					infoObj.fadeOut(200);
				}else{
					if(infoObj.is(":visible")){return;}
					var left=o.obj.offset().left,
						top=o.obj.offset().top;
					infoObj.css({
						left:left+120,
						top:top-45
					}).show().animate({
						top:top-90
					},200);
				}

			}
		}
	});

	//这一段是遍历.ul li，让每个子li获得各自的背景图
	$('.ul>li').each(function(i){
		$(this).css('background','url(<?=base_url('static/images/admin')?>/xtb'+(i+1)+'.png) no-repeat 15px 12px #28323b');
	})
})
</script>