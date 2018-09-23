<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">      
        <li><a href="<?php echo site_url('race?catid='.$pid)?>" <?php if(isset($hover)&&in_array($hover,array('cat_2','cat_3'))) echo ' class="cur"';?>><?php echo $catename;?></a></li>
        <?php 
		$TopNew = $this->Newstype_model->select(array('pid'=>$pid), 'id,title', 0, 4, 'ord ASC,id ASC');
		if(!empty($TopNew)):
		 foreach($TopNew as $val):?>
        	<li><a href="<?php echo site_url('race/lists?catid='.$val['id'])?>" <?php if(isset($hover)&&$hover=='cat_'.$val['id']) echo ' class="cur"';?>><?php echo strcut($val['title'],0,10);?></a></li>
        <?php 
		 endforeach;
		endif;?>
    </ul>
    <a <?php if(!empty($weburl)) echo 'href="'.$weburl.'" target="_blank"';?> class="nav_bm">参赛报名</a>
    <a href="<?php echo site_url()?>" class="nav_bm_1">返回主页</a>
</div>
