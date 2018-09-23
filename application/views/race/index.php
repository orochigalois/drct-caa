<!-- 主内容开始 -->
<!-- 大赛简介 -->
<div class="ny_d3_k container fix">
    <div class="in_d2_t fix">
        <h3><?php echo isset($typeList[0]['title'])?$typeList[0]['title']:'';?></h3>
        <span><?php echo isset($typeList[0]['ename'])?$typeList[0]['ename']:'';?></span>
        <p><?php echo isset($typeList[0]['descs'])?$typeList[0]['descs']:'';?></p>
        <a href="<?php echo site_url('race/lists?catid='.$typeList[0]['id'])?>">查看更多</a>
    </div>
</div>
<!-- 广告图 -->
<div class="in_d4_k container fix">
    <a href="<?php echo site_url('race/lists?catid='.$typeList[1]['id'])?>"><img src="<?php echo base_url($typeList[1]['h_simg']);?>" /></a>
</div>
<!-- 通知公告 -->
<div class="in_d2_k fix">
    <div class="container fix">
        <div class="in_d2_t fix">
            <h3><?php echo isset($typeList[1]['title'])?$typeList[1]['title']:'';?></h3>
            <span><?php echo isset($typeList[1]['ename'])?$typeList[1]['ename']:'';?></span>
            <p><?php echo isset($typeList[1]['descs'])?$typeList[1]['descs']:'';?></p>
        </div>
        <div class="row">
		  <?php 
		  if(!empty($newList)):
		    foreach($newList as $val):?>
            <div class="col-md-4 col-sm-6 fix">
                <div class="in_d2 fix">
                    <a href="<?php echo site_url('race/view?id='.$val['id'])?>"><img src="<?=base_url($val['simg'])?>" /><!--<em></em>--></a>
                    <h3><a href="<?php echo site_url('race/view?id='.$val['id'])?>"><?php echo strcut($val['title'],0,18,'...');?></a></h3>
                    <p><?php echo strcut($val['descs'],0,50,'...');?></p>
                    <span><?php echo date("d F Y",$val['addtime']);?><?php echo strcut($val['source'],0,10);?></span>
                </div>
            </div>
          <?php 
		    endforeach;
		  endif;?>
        </div>
        <a href="<?php echo site_url('race/lists?catid='.$typeList[1]['id'])?>" class="in_d2_more">查看更多</a>
    </div>
</div>

<!-- 赛事历程 -->
<div class="in_d5_k fix">
    <div class="in_d2_t fix">
        <h3><?php echo isset($typeList[2]['title'])?$typeList[2]['title']:'';?></h3>
        <span><?php echo isset($typeList[2]['ename'])?$typeList[2]['ename']:'';?></span>
        <p><?php echo isset($typeList[2]['descs'])?$typeList[2]['descs']:'';?></p>
    </div>
    <div class="row fix">
      <?php 
	  if(!empty($raceList)):
		foreach($raceList as $val):?>
        <div class="in_d5 col-md-3 col-sm-6 fix">
            <a href="<?php echo site_url('race/lists?catid='.$typeList[2]['id'].'&cid_1='.$val['id'])?>">
                <img src="<?=base_url('static')?>/images/img14.png" alt="" />
                <em style="background:#1a61b6"></em>
                <div class="in_d5_m fix">
                    <h3><?php echo strcut($val['title'],0,10);?></h3>
                    <p><?php echo strcut($val['descs'],0,20,'...');?></p>
                </div>
            </a>
        </div>
		<?php 
		 endforeach;
	   endif;?>
        <div class="in_d5 col-md-3 col-sm-6 fix">
            <a href="<?php echo site_url('race/lists?catid='.$typeList[2]['id'])?>">
                <h4><img src="<?=base_url('static')?>/images/img15.png" alt="" /></h4>
            </a>
        </div>
    </div>
</div>

<!-- 主内容结束 -->
