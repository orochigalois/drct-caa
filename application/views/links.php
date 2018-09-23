<!-- 主内容开始 -->
<div class="ny_nav_bg_1 fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l_1 fix">
            <a class="on_2"><?php echo $catname;?></a>
        </div>
        <div class="ny_nav_r fix">
            <span>您当前所在位置：</span>
            <a href="><?php echo site_url();?>">首页</a>
            <span>></span>
            <a><?php echo $catname;?></a>
        </div>
    </div>
</div>
<div class="container fix" style="margin-bottom:20px;">
    <div class="row fix" id="posHtml" style="margin-bottom:20px;"></div>
    <input type="hidden" name="page" id="page" value="0" />
    <a href="javascript:;"  onclick="displayMore()" id="posMore" class="more_a"></a>
</div>
<script>
function displayMore(){
  $.ajax({
	url : "<?php echo site_url('links/ajaxDisplay')?>",
	dataType : "json",
	type: "get",
	data: 'page=' + $('#page').val(),
	success: function(data){
	   $('#posHtml').append(data.content);
	   $('#page').val(data.per_page);
	   if(data.falg == 1){
			$('#posMore').hide();
	   }
	}
  });
}
displayMore();
</script>
<!-- 主内容结束 -->
