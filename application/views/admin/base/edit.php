<script type="text/javascript" charset="utf-8" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
K.create('textarea[id="content"]', {
allowFileManager: false,
filterMode: false,
newlineTag:'br',
  afterBlur: function(){this.sync();}
});
});
</script>
<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">基本信息</div>
        <div class="mrnr1">
            <form action="<?=site_url('admin/base/edit')?>" method="post">
                <table width="900" border="0" cellspacing="0" cellpadding="0" class="table">
                  <tr>
                    <td width="90" class="td1" align="right">网站标题：</td>
                    <td><input type="text" class="inputt input" name="info[title]" value="<?=$row['title']?>"/></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right" valign="top">关键字：</td>
                    <td>
                        <textarea class="text1" name="info[keyword]"><?=$row['keyword']?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="td1" align="right" valign="top">网站描述：</td>
                    <td><textarea class="text1" name="info[descs]"><?=$row['descs']?></textarea></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">QQ列表：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[QQ]" value="<?=$row['QQ']?>"/>QQ号之间用","隔开</td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">QQ名称列表：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[QQName]" value="<?=$row['QQName']?>"/>QQ名称之间用","隔开</td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">开关QQ：</td>
                    <td class="radio"><input type="radio" name="info[isQQ]" value="0" <?= ($row["isQQ"]==0) ? "checked='checked'":"";?> /><span>关</span><input type="radio" name="info[isQQ]" value="1" <?= ($row["isQQ"]==1) ? "checked='checked'":"";?> /><span>开</span>
                    </td>
                  </tr>
                  <?php /*?><tr>
                    <td class="td1" align="right">QQ样式：</td>
                    <td class="radio">
							<input type="radio" name="info[qqStype]" value="2" <?php echo $qqStype= ($row["qqStype"]==2) ? "checked='checked'":"";?>/>
							<img src="<?=base_url('static/images/admin/qq_huiimg.png')?>" width="100" height="50" />
                    </td>
                  </tr><?php */?>
                  <tr>
                    <td class="td1" align="right">电话：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[tel]" value="<?=$row['tel']?>"/></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">Email：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[email]" value="<?=$row['email']?>"/></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">地址：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[address]" value="<?=$row['address']?>"/></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">邮编：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[postcode]" value="<?=$row['postcode']?>"/></td>
                  </tr>
                  <tr>
                    <td class="td1" align="right">参赛报名：</td>
                    <td class="ms"><input type="text" class="inputt input" name="info[weburl]" value="<?=$row['weburl']?>"/></td>
                  </tr>
				  <tr>
                    <td class="td1" align="right">Logo：</td>
                    <td>
                    <input name="info[simg]" value="<?=isset($row["simg"])?$row["simg"]:'';?>" type="text" class="inputt input62" id="simg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('simg','175','72')" value="上传" /> 建议尺寸大小175*72px
                    </td>
                  </tr>
				  <tr>
                    <td class="td1" align="right" valign="top">网站底部信息：</td>
                    <td><textarea name="info[content]" style="width:793px;height:302px;visibility:hidden;"  id="content"><?=$row['content']?></textarea></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td align="center">
                    <input type="hidden" name="id" value="<?=$row['id']?>" />
                    <input type="submit" class="tjanniu cr" value="提 交" /><input type="reset" class="czanniu cr" value="重 置" /></td>
                  </tr>
                </table>
            </form>
        </div>

    </div>
</div>
<link href="<?=base_url('static/kindeditor/themes/default/default.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
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