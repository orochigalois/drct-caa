<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">      
        <li><a href="<?php echo site_url()?>" <?php if(isset($hover)&&$hover=='home') echo ' class="cur"';?>>首页</a></li>
        <li class="dropdown">
            <a href="<?php echo site_url('about?id=1')?>" class="dropdown-toggle <?php if(isset($hover)&&$hover=='about_1') echo ' cur';?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">关于</a>
            <?php 
			$TopAbout = $this->About_model->select(array('pid'=>1), 'id,title', 0, 0, 'ord ASC,id ASC');?>
            <ul class="dropdown-menu">
              <?php 
			  if(!empty($TopAbout)):
			    foreach($TopAbout as $val):?>
                <li><a href="<?php echo site_url('about?id='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a></li>
              <?php 
			    endforeach;
			  endif;?>  
            </ul>
        </li>
        <?php 
		$TopNew = $this->Newstype_model->select(array('pid'=>0), 'id,title', 0, 3, 'ord ASC,id ASC');
		if(!empty($TopNew)):
		 foreach($TopNew as $val):
		    if($val['id']==1):?>
        	<li><a href="<?php echo site_url('category?catid='.$val['id'])?>" <?php if(isset($hover)&&$hover=='cat_1') echo ' class="cur"';?>><?php echo strcut($val['title'],0,10);?></a></li>
            <?php 
			else:?>
        		<li><a href="<?php echo site_url('race?catid='.$val['id'])?>"><?php echo strcut($val['title'],0,10);?></a></li>
            <?php 
			endif;?>
        <?php 
		 endforeach;
		endif;?>
        <li><a href="<?php echo site_url('about?id=2')?>" <?php if(isset($hover)&&$hover=='about_2') echo ' class="cur"';?>>联系我们</a></li>
    </ul>
    <a <?php if(!empty($weburl)) echo 'href="'.$weburl.'" target="_blank"';?> class="nav_bm">参赛报名</a>
    <?php if(!isset($hover)||$hover!='home'):?><a href="<?php echo site_url()?>" class="nav_bm_1">返回主页</a><?php endif;?>
</div>
