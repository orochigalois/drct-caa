<table width="100%" cellpadding="0" cellspacing="0" class="table3 tab">
  <?php 
  if($class=='news'):?>
    <tr>
        <td>来源：</td>
        <td>
         <input type="text" class="input62 inputt" name="info[source]" value="<?=isset($detail["source"])?$detail["source"]:'';?>">
        </td>
    </tr>
	<tr>
		<td>列表图片：</td>
		<td>
		<input name="info[simg]" value="<?=isset($detail["simg"])?$detail["simg"]:'';?>" type="text" class="inputt input62" id="simg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('simg',<?php echo $width;?>,<?php echo $height;?>)" value="上传" /> 图片建议尺寸<?php echo $width . '*' . $height;?>像素
		</td>
	</tr>
    <tr>
        <td valign="top">信息描述：</td>
        <td>
         <textarea name="info[descs]" class="text1"><?=isset($detail["descs"])?$detail["descs"]:'';?></textarea>
        </td>
    </tr>
  <?php 
  endif;?>
  <?php 
  if($class=='race'):
	foreach($lists_arr as $k=>$v):
	if($k>1):?>
    <tr>
        <td align="right" valign="top"><?php echo $v;?>：</td>
        <td><textarea name="info[con_<?php echo $k?>]" style="width:793px;height:302px;visibility:hidden;"  id="con_<?php echo $k?>"><?=isset($detail["con_".$k])?$detail["con_".$k]:'';?></textarea></td>
    </tr>
 <?php
    endif; 
    endforeach;
  endif;?>
    <tr>
        <td>发布时间：</td>
        <td>
        <input name="info[addtime]" type="text" class="inputt input61" id="addtime"  value="<?=date('Y-m-d H:i',isset($detail['addtime'])?$detail['addtime']:time());?>">&nbsp;<img onclick="WdatePicker({el:'addtime','dateFmt':'yyyy-MM-dd HH:mm'})" src="<?=base_url('static/js/data/skin/datePicker.gif')?>" width="16" height="22" align="middle">
    </tr>
	<tr>
		<td></td>
		<td style="padding-left:220px;padding-top:30px">
			<input type="submit" value="提交" class="tjanniu cr" />
			<input type="reset" value="重置" class="czanniu cr"/>
		</td>
	</tr>
</table>
<script type="text/javascript">
	function uploadpic(picid,width,height)
	{
		siteaurl = "<?=site_url('admin')?>";
		var editor = KindEditor.editor({
			uploadJson:siteaurl+"/avatar/attrupload?width="+width+"&height="+height,
			allowFileManager : true
		});
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
				imageUrl : KindEditor('#'+picid).val(),
					clickFn : function(url, title, width, height, border, align) {
						newurl = url.substr(url.indexOf("static"));
						$('#'+picid).val(newurl);
						editor.hideDialog();
					}
				});
		});
	}
</script>


