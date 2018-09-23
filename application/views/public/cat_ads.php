<div class="index_banner fix">
    <div id="owl-demo" class="owl-carousel owl-theme owl-demo">
      <?php 
	  if(!empty($adsList)):
	    foreach($adsList as $val):?>
        <div class="item">
            <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?> class="ban_img0"><img src="<?=base_url($val['simg'])?>"></a>
            <a <?php if(!empty($val['url'])) echo 'href="'.$val['url'].'" target="_blank"';?> class="ban_img1"><img src="<?=base_url($val['simg_2'])?>"></a>
        </div>
      <?php 
	    endforeach;
	  endif;?>  
    </div>
</div>
<script>
    $(".index_banner .owl-carousel").owlCarousel({
          autoPlay:true,
          navigation : true, 
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true,
          dots:false,
          navigationText:false,
          rewindSpeed:1000
    });
</script>
