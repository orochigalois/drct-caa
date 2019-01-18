<!-- 三大分类 -->
<div class="in_d1_h fix">
    <div class="row fix">
      <?php 
	  if(!empty($ads[1])):
	  	foreach($ads[1] as $val):?>
        <div class="in_d1_k col-md-4 col-sm-4 fix">
            <div class="in_d1 fix" style="background-image: url(<?php echo base_url($val['simg']);?>);">
                <h3><a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,10);?></a></h3>
                <p><?php echo !empty($val['descs'])?strcut($val['descs'],0,16,'...'):'&nbsp;';?></p>
                <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>>查看更多</a>
            </div>
        </div>
     <?php 
	 	endforeach;
	  endif;?>   
    </div>
</div>
<!-- 三大分类手机版 -->
<div class="in_phone_d1 fix">
  <?php 
  if(!empty($ads[1])):
	foreach($ads[1] as $k=>$val):
	if($k==2):?>
      <div class="fix"></div>
      <div class="in_ph_d2 fix" style="background-image: url(<?php echo base_url($val['simg']);?>);">
          <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,10);?></a>
          <p><?php echo !empty($val['descs'])?strcut($val['descs'],0,16,'...'):'&nbsp;';?></p>
      </div>
    <?php 
	else:?>
      <div class="in_ph_d1 fix">
          <img src="<?php echo base_url($val['simg']);?>" />
          <h3><a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,10);?></a></h3>
          <p><?php echo !empty($val['descs'])?strcut($val['descs'],0,16,'...'):'&nbsp;';?></p>
      </div>
  <?php 
     endif;
	endforeach;
  endif;?>  
</div>
<script>
  var num = $img.length;
    $imgs.load(function() {
      num--;
      if (num > 0) {
        return;
      }
      else{
        var inHeight;
        function bb() {
            inHeight = $('.in_ph_d1').height();
            $('.in_phone_d1 .in_ph_d1').height(inHeight);
        }
        bb();
        
        $(window).resize(function(){
            bb();
        })
      }
      
    })
</script>
<!-- 最新通知 注释此模块 -->
<?php if (1==2):?>
<div class="in_d2_k fix">
    <div class="container fix">
        <div class="in_d2_t fix">
            <h3><?php echo strcut($typeInfo['title'],0,20);?></h3>
            <span><?php echo strcut($typeInfo['ename'],0,20);?></span>
            <p><?php echo strcut($typeInfo['descs'],0,120);?></p>
        </div>
        <div class="row">
          <?php 
		  if(!empty($news)):
		    foreach($news as $val):?>
            <div class="col-md-4 col-sm-6 fix">
                <div class="in_d2 fix">
                    <a href="<?php echo site_url('category/view?id='.$val['id'])?>"><img src="<?=base_url($val['simg'])?>" /><!--<em></em>--></a>
                    <h3><a href="<?php echo site_url('category/view?id='.$val['id'])?>"><?php echo strcut($val['title'],0,18,'...');?></a></h3>
                    <p><?php echo strcut($val['descs'],0,50,'...');?></p>
                    <span><?php echo date("d F Y",$val['addtime']);?><?php echo strcut($val['source'],0,10);?></span>
                </div>
            </div>
          <?php 
		    endforeach;
		  endif;?>   
        </div>
        <a href="<?php echo site_url('category?catid='.$typeInfo['id'])?>" class="in_d2_more">查看更多</a>
    </div>
</div>
<?php endif;?>

<!-- 大图部分 -->
<div class="in_d3_h fix">
    <div class="row fix">
      <?php 
	  if(!empty($ads[2])):
	  	foreach($ads[2] as $val):?>
        <div class="in_d3_k col-md-6 col-sm-6 fix">
            <img src="<?=base_url($val['simg'])?>" />
            <div class="in_d3 fix">
                <p><?php echo strcut($val['descs'],0,10,'...');?></p>
                <h3><a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>><?php echo strcut($val['title'],0,20,'...');?></a></h3>
                <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?>>查看更多 ></a>
            </div>
        </div>
        <?php 
		endforeach;
	  endif;?>
    </div>
</div>

<!-- 机器人竞赛与培训部 -->
<div class="in_d4 fix">
    <div class="container">
        <div class="row">
          <?php 
	  	  if(!empty($ads[3])):?>
            <div class="in_d4_l col-md-5 col-sm-5 fix">
                <h3><a <?php if(!empty($ads[3]['url'])) echo 'href="'.$ads[3]['url'].'" target="_blank"';?>><?php echo strcut($ads[3]['title'],0,10,'...');?></a></h3>
                <p><?php echo strcut($ads[3]['descs'],0,60,'...');?></p>
                <a <?php if(!empty($ads[3]['url'])) echo 'href="'.$ads[3]['url'].'" target="_blank"';?>>查看更多</a>
            </div>
            <div class="in_d4_r col-md-7 col-sm-7 fix">
                <img src="<?=base_url($ads[3]['simg'])?>" />
            </div>
          <?php 
		  endif;?>
        </div>
    </div>
</div>
