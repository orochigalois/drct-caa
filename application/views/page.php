<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="format-detection" content="telephone=no" />
    <title><?=$seo_title?$seo_title:$title;?></title>
    <meta name="keywords" content="<?=$seo_keywords?$seo_keywords:$keyword;?>">
    <meta name="description" content="<?=$seo_desc?$seo_desc:$descs;?>">
    <link href="<?=base_url('static')?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('static')?>/css/common.css" rel="stylesheet">
    <!-- 轮播插件 -->
    <link rel="stylesheet" href="<?=base_url('static')?>/css/owl.carousel.css" />
    <link rel="stylesheet" href="<?=base_url('static')?>/css/owl.theme.css" />

    <link href="<?=base_url('static')?>/css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('static');?>/css/jquery.ad-gallery.css">
    <link href="<?=base_url('static')?>/css/style.css" rel="stylesheet">
    <link href="<?=base_url('static')?>/css/media-style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url('static')?>/css/qq/qq.css" />
    
    <!--[if lt IE 9]>
    <script src="<?=base_url('static')?>/js/html5shiv.min.js"></script>
    <script src="<?=base_url('static')?>/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url('static')?>/js/jquery.min.js"></script>
    <script src="<?=base_url('static')?>/js/bootstrap.min.js"></script>
    <!-- 轮播插件 -->
    <script src="<?=base_url('static')?>/js/owl.carousel.js"></script>

    <script src="<?=base_url('static')?>/js/wow.min.js"></script>
    <script src="<?=base_url('static')?>/js/jquery.style.js"></script>
    <script src="<?=base_url('static')?>/js/picturefill.min.js"></script>
    
    <script language="javascript" src="<?php echo base_url('static/js/admin/Validform_v5.js')?>"></script>
    <script>
        document.createElement( "picture" );
        $(function(){
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true,
                live: true
            });
            wow.init();
        })
    </script>
    <style>
	.Validform_error{ background-color:#ffe7e7 !important;}
	</style>
</head>

<body>
<!--header-开始-->
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url()?>"><img src="<?=base_url($simg)?>"></a>
    </div>
    <?php 
	if(isset($is_nav)&&$is_nav==1):
		$this->load->view('public/h_nav');
	else:
		$this->load->view('public/r_nav');
	endif;?>
</nav>
<!--header end-->
<?php 
if(isset($hover)):
 if($hover=='home'):
  $this->load->view('public/slide');
 elseif(in_array($hover,array('cat_2','cat_3'))):
  $this->load->view('public/cat_ads');
 else:
  $this->load->view('public/ads');
 endif;
endif;
echo $body;?>
<!-- 查看更多赛事 -->
<div class="in_d5_bg fix">
    <div class="container">
        <div class="row">
            <form class="proForm"  method="post" action="<?php echo site_url('search')?>">
            <div class="in_d5_l col-md-6 col-sm-6 fix">
                <p>查看更多赛事<span>See more events</span></p>
                <div class="in_d5_form fix">
                    <input type="text" class="in_txt" placeholder="请输入想要查看的内容" name="keyword" datatype="*" nullmsg="请输入想要查看的内容" />
                    <input type="submit" class="in_but" value="点击搜索" />
                </div>
            </div>
            </form>
			<script>
            $(".proForm").Validform({
                tiptype:function(msg,o,cssctl){
                  var objtip=o.obj.siblings(".Validform_checktip");
                  cssctl(objtip,o.type);
                  objtip.text(msg);
                },
                datatype:{
                    "t_p": /((15)\d{9})|((13)\d{9})|((17)\d{9})|((18)\d{9})|0\d{2,3}-?\d{7,8}/,
                }
            });
            </script>
            <div class="in_d5_r col-md-6 col-sm-6 fix">
                <h3>点击收藏我们</h3>
                
                <div class="in_d5_r1 bdsharebuttonbox fix">
                    <a href="javascript:void(0);" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博" style="background-image: url(<?=base_url('static')?>/images/n1.png);">
                    </a>
                    <a href="javascript:void(0);" class="bds_weixin" data-cmd="weixin" title="分享到微信" style="background-image: url(<?=base_url('static')?>/images/n2.png);">
                    </a>
                    <a href="javascript:void(0);" class="popup_sqq" data-cmd="sqq" style="background-image: url(<?=base_url('static')?>/images/n3.png);">
                    </a>
                    <a href="javascript:void(0);" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博" style="background-image: url(<?=base_url('static')?>/images/n4.png);">
                    </a>
                </div>
                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
				</script>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<div class="fot_bg fix">
    <div class="container fix">
        <div class="row fix">
            <div class="ft_d1 ft_d2 col-md-3 col-sm-6 ">
               <h3>中国机器人大赛</h3> 
               <ul class="ft_ul fix">
                <?php 
				$BotNew1 = $this->Newstype_model->select(array('pid'=>3), 'id,title', 0, 0, 'ord ASC,id ASC');
				if(!empty($BotNew1)):
				 foreach($BotNew1 as $val):?>
                   <li><a href="<?php echo site_url('race/lists?catid='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a></li>
                <?php 
				 endforeach;
				endif;?>
               </ul>
            </div>
            <div class="ft_d1 ft_d2 col-md-3 col-sm-6 ">
               <h3>RoboCup机器人世界杯中国赛</h3> 
               <ul class="ft_ul fix">
                <?php 
				$BotNew2 = $this->Newstype_model->select(array('pid'=>2), 'id,title', 0, 0, 'ord ASC,id ASC');
				if(!empty($BotNew2)):
				 foreach($BotNew2 as $val):?>
                   <li><a href="<?php echo site_url('race/lists?catid='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a></li>
                <?php 
				 endforeach;
				endif;?>
               </ul>
            </div>

            <div class="ft_d1 ft_d2 col-md-3 col-sm-6 ">
               <h3>友情链接</h3> 
               <ul class="ft_ul fix">
                 <?php 
				 $botLink = $this->Links_model->select('','id,title,url', 0,3,'ord ASC,id DESC');
				 if(!empty($botLink)):
				   foreach($botLink as $val):?>
                   	<li><a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,13,'...');?></a></li>
                 <?php 
				   endforeach;
				 endif;?>
                 <li><a href="<?php echo site_url('links');?>">查看更多</a></li>
               </ul>
            </div>
            
            <div class="ft_ph_d1 fix">
                <h3>中国机器人大赛</h3>
                <?php 
				if(!empty($BotNew1)):
				 foreach($BotNew1 as $val):?>
                  <a href="<?php echo site_url('race/lists?catid='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a>
                <?php 
				 endforeach;
				endif;?>
            </div>
            <div class="ft_ph_d1 fix">
                <h3>RoboCup机器人世界杯中国赛</h3>
                <?php
				if(!empty($BotNew2)):
				 foreach($BotNew2 as $val):?>
                   <a href="<?php echo site_url('race/lists?catid='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a>
                <?php 
				 endforeach;
				endif;?>
            </div>
            <div class="ft_ph_d1 fix">
                <h3>友情链接</h3>
                <?php 
				if(!empty($botLink)):
				   foreach($botLink as $val):?>
                   <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,4,'...');?></a>
                 <?php 
				   endforeach;
				 endif;?>
                 <a href="<?php echo site_url('links');?>">查看更多</a>
            </div>
            
            <div class="ft_d1 col-md-3 col-sm-6 ">
               <h3>联系我们</h3> 
               <p><?php echo $address.'，'.$postcode;?></p>
               <p>电话：<?php echo $tel?></p>
               <p>E-mail: <?php echo $email?></p>
               <div class="ft_d3 fix">
                   <a href="<?php echo site_url('about?id=5')?>" class="ft_a1">志愿者招募</a>
                   <a href="<?php echo site_url('about?id=2')?>" class="ft_a2">如有疑问或建议，点此留言>></a>
               </div>
            </div>
        </div>
        <p class="fot_p"><?php echo $content;?></p>
    </div>
</div>
<?php
if($isQQ==1&&!empty($QQ)):
 $this->load->view('qq');
endif;?>
<script>
// 网站开发人员信息
console.log("开发时间：2017年05月23日");
console.log("客户经理：杜楠");
console.log("UI设计师：蔡苗");
console.log("前端工程师：田家晴");
console.log("后端工程师：田翠翠");
</script>

</body>
</html>
