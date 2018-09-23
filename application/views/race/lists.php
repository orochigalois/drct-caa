<!-- 主内容开始 -->
<div class="ny_nav_bg_1 fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l_1 fix">
           <a class="on_2"><?php echo $detail['title'];?></a>
        </div>
        <div class="ny_nav_r fix">
            <span>您当前所在位置：</span>
            <?php echo $position;?>
        </div>
    </div>
</div>

<!-- 分类信息 -->
<?php 
if(!empty($typeList_1)): ?>
<div class="ny_h1_bg fix" id="con_html">
    <!-- year -->
    <div class="ny_h1_year_bg fix"  <?php if(count($typeList_2)>12): echo ' style="height: 100px; overflow-y: auto;"';endif;?>>
        <div class="ny_h1_year container fix">
          <?php
		  foreach($typeList_1 as $val):?>
            <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$val['id']);?>#con_html" <?php if($cid_1==$val['id']) echo ' class="on_3"'?>><?php echo strcut($val['title'],0,8,'...');?></a>
         <?php 
		  endforeach;?> 
        </div>
    </div>
    <div class="ny_d1_m_1 container fix">
       <?php 
	   $hr = 0;
	   foreach($race_arr as $k=>$v):
	    if(!empty($typeInfo['con_'.$k])):?>
            <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&tid=1&conId='.$k);?>#con_html"<?php if($tid==1&&$conId==$k) echo ' class="on_4"'?>><?php echo $v;?></a>
       <?php
	    $hr = 1; 
	    endif;
	   endforeach;?>
    </div>
    <?php if($hr==1) echo ' <hr />';?>
    <?php 
	if(!empty($typeList_2)):?>
    <div class="ny_d1_m container fix"  <?php if(count($typeList_2)>4): echo ' style="height: 195px; overflow-y: auto;"';endif;?>>
        <div class="row">
			<?php
            foreach($typeList_2 as $val):
              if(strlen($val['title'])>30):
			   $s_size = 40;?>
              <div class="col-md-6 col-sm-6 col-xs-6">
              <?php 
              else:
			   $s_size = 15;?>
              <div class="col-md-3 col-sm-4 col-xs-6">
              <?php 
              endif;?>
                  <div class="ny_d1_m_n1 fix <?php if($tid==2&&$cid_2==$val['id']) echo ' on_4'?>">
                      <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$val['id']);?>#con_html"><?php echo strcut($val['title'],0,$s_size,'...');?></a>
                  </div>
              </div>
            <?php 
            endforeach;?>
        </div>
    </div>
    <?php 
	endif;?>
</div>
<!-- ny_nav -->
<?php 
if($tid==2):?>
<div class="ny_nav_bg fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l fix">
            <div class="row">
              <?php
			  foreach($showList as $val):?>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$val['id'].'&tid=2');?>#con_html" <?php if($sid==$val['id']) echo ' class="on_2"'?>><?php echo strcut($val['title'],0,24,'...');?></a>
                </div>
			  <?php 
			  endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php 
endif;
if($tid==1):?>
<div class="ny_h2 container fix bt_bottom">
    <div class="ny_h2_tit fix">
        <h3><?php echo $this->recom->get_recom_value($conId,'race_arr');?></h3>
    </div>
    <div class="ny_h2_m fix">
      <?php echo isset($typeInfo['con_'.$conId])?$typeInfo['con_'.$conId]:'';?>
    </div>
</div>
<?php 
elseif($tid==2&&!empty($showInfo)):?>
<div class="ny_h2 container fix bt_bottom">
    <div class="ny_h2_tit fix">
        <h3><?php echo isset($showInfo['title'])?$showInfo['title']:'';?></h3>
    </div>
    <div class="ny_h2_d1 fix">
       <?php 
	   foreach($lists_arr as $k=>$v):
	    if(!empty($showInfo['con_'.$k])):?>
           <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=2&conId='.$k);?>#con_html"<?php if($conId==$k) echo ' class="on_5"'?>><?php echo $v;?></a>
       <?php 
	    endif;
	   endforeach;?>  
       <?php 
	   if(!empty($PicInfo)):?>
       <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=3');?>#con_html" >精彩图集</a> 
       <?php 
	   endif;?>
       <?php 
	   if($video_num>0):?>
       	<a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=4');?>#con_html">视频中心</a>
       <?php 
	   endif;?>
    </div>
    <div class="ny_h2_m fix">
      <?php echo isset($showInfo['con_'.$conId])?$showInfo['con_'.$conId]:'';?>
    </div>
</div>
<?php 
elseif($tid==3):?>
<!-- 图集 -->
<script type="text/javascript" src="<?php echo base_url('static');?>/js/jquery.ad-gallery.js?rand=995"></script>
<script>
$(function(){
	var galleries = $('.ad-gallery').adGallery();
})
</script>
<div class="ny_h2 container fix">
    <div class="ny_h2_tit fix">
        <h3><?php echo isset($showInfo['title'])?$showInfo['title']:'';?></h3>
    </div>
    <div class="ny_h2_d1 fix">
       <?php 
	   foreach($lists_arr as $k=>$v):
	    if(!empty($showInfo['con_'.$k])):?>
       	  <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=2&conId='.$k);?>#con_html"><?php echo $v;?></a>
       <?php 
	     endif;
	   endforeach;?>
       <?php 
	   if(!empty($PicInfo)):?>
       <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=3');?>#con_html" class="on_5">精彩图集</a> 
       <?php 
	   endif;?>
       <?php 
	   if($video_num>0):?>
       	<a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=4');?>#con_html">视频中心</a>
       <?php 
	   endif;?>
    </div>
    <!-- pc端 -->
    <div id="gallery" class="ad-gallery gallery-02 rel">
        <?php if(!empty($PicList)):?><div class="ad-image-wrapper"></div><?php endif;?>
        <div class="ad-controls"></div>
        <div class="ad-nav">
            <div class="ad-thumbs">
                <ul class="ad-thumb-list">
                 <?php 
				 if(!empty($PicList)):
				    foreach($PicList as $val):?>
                    <li>
                        <a href="<?php echo base_url($val['simg']);?>">
                          <img src="<?php echo base_url($val['simg']);?>"  title="<?php echo strcut($val['descs'],0,100,'...');?>" class="image0" width="123" height="69">
                        </a>
                    </li>
                 <?php 
				   endforeach;
				 endif;?>   
                </ul>
            </div>
        </div>
        <?php 
	    if(!empty($PicPrev)):?>
            <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=3&picId='.$PicPrev['id']);?>#con_html" class="photo prev-photo">
                <img src="<?php echo base_url($PicPrev['simg']);?>">
                <span><?php echo strcut($PicPrev['title'],0,12,'...');?></span>
            </a>
        <?php 
		endif;?>
        <?php 
	    if(!empty($PicNext)):?>
            <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=3&picId='.$PicNext['id']);?>#con_html" class="photo next-photo">
                <img src="<?php echo base_url($PicNext['simg']);?>">
                <span><?php echo strcut($PicNext['title'],0,12,'...');?></span>
            </a>
        <?php 
		endif;?>
    </div>
    <!-- PAD和手机端 -->
    <div class="gall_pad fix">
        <div id="owl-demo" class="owl-carousel">
         <?php 
		 if(!empty($PicList)):
			foreach($PicList as $val):?>
            <div class="item">
                <div class="in_d1_m fix">
                    <a><img src="<?php echo base_url($val['simg']);?>" /></a>
                    <p><?php echo $val['descs'];?></p>
                </div>
            </div>
		 <?php 
		   endforeach;
		 endif;?> 
        </div>
        <script>
            $(document).ready(function() {
              $(".ny_h2 #owl-demo").owlCarousel({
                  autoPlay: false,
                  margin:10,
                  items : 1,
                  lazyLoad : true,
                  navigation : true,
                  dotsSpeed:3000,
                  navigationText:false,
                  itemsDesktop : [1199,1],
                  itemsDesktopSmall : [979,1],
                  itemsTablet:[768,1]
              });
            });
        </script>
    </div>
    <!-- 点击下载当前图集 -->
    <a href="<?php echo !empty($PicInfo['download'])?site_url('race/download?file='.$PicInfo['download']):'javascript:;';?>" class="load_a">点击下载当前图集</a>
</div>
<?php 
elseif($tid==4):?>
<!-- 视频中心 -->
<div class="ny_h2 container fix bt_bottom">
    <div class="ny_h2_tit fix">
        <h3><?php echo isset($showInfo['title'])?$showInfo['title']:'';?></h3>
    </div>
    <div class="ny_h2_d1 fix">
       <?php 
	   foreach($lists_arr as $k=>$v):
	    if(!empty($showInfo['con_'.$k])):?>
          <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=2&conId='.$k);?>#con_html"><?php echo $v;?></a>
       <?php 
	    endif;
	   endforeach;?> 
       <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=3');?>#con_html">精彩图集</a> 
       <a href="<?php echo site_url('race/lists?catid='.$cid.'&cid_1='.$cid_1.'&cid_2='.$cid_2.'&sid='.$sid.'&tid=4');?>#con_html" class="on_5">视频中心</a>
    </div>
    <div class="ny_h_fa row fix" id="posHtml"></div>
    <input type="hidden" name="page" id="page" value="0" />
    <a href="javascript:;"  onclick="displayMore(<?php echo $cid?>)" id="posMore" class="more_a"></a>
</div>
<script type="text/javascript">
function displayMore(cid){
  $.ajax({
	url : "<?php echo site_url('race/ajaxDisplayVideo')?>",
	dataType : "json",
	type: "get",
	data: "cid=" + cid + '&page=' + $('#page').val(),
	success: function(data){
	   $('#posHtml').append(data.content);
	   $('#page').val(data.per_page);
	   if(data.falg == 1){
			$('#posMore').hide();
	   }
	}
  });
}
displayMore(<?php echo $sid?>);
</script>
<?php 
endif;?>
<?php 
endif;?>
<!-- 主内容结束 -->
