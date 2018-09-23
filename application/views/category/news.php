<!-- 主内容开始 -->
<div class="ny_nav_bg_1 fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l_1 fix">
           <?php echo $cateList;?>
        </div>
        <div class="ny_nav_r fix">
            <span>您当前所在位置：</span>
            <?php echo $position;?>
        </div>
    </div>
</div>
<div class="container" style="margin-bottom:50px;">
    <div class="ny_mt40 row" id="posHtml">
      <?php echo $lists?>
    </div>
    <?php 
	if($total>$pagesize):?>
    <input type="hidden" name="page" id="page" value="<?php echo $pagesize?>" />
    <a href="javascript:;"  onclick="displayMore(<?php echo $cid?>)" id="posMore" class="more_a"></a>
    <?php 
	endif;?>
</div>
<script>
function displayMore(cid){
  $.ajax({
	url : "<?php echo site_url('category/ajaxDisplay')?>",
	dataType : "json",
	type: "get",
	data: "cid=" + cid + '&pagesize=<?php echo $pagesize?>&page=' + $('#page').val(),
	success: function(data){
	   $('#posHtml').append(data.content);
	   $('#page').val(data.per_page);
	   if(data.falg == 1){
			$('#posMore').hide();
	   }
	}
  });
}
//displayMore(<?php echo $cid?>);
</script>
<!-- 主内容结束 -->
