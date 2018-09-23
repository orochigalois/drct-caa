<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?php echo $catname;?>管理</div>
        <div class="mrnr1">
            <form name="myform"  method="post" action="<?=site_url('admin/links/edit')?>" class="addForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                  <tr>
                    <td width="90" align="right">标 题：</td>
                    <td><input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-30"  nullmsg="请输入标题！" errormsg="标题至少1个字符,最多30个任意字符！"/>
                    <div class="info"><span class="Validform_checktip">标题至少1个字符,最多30个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div class="tsy">标题至少1个字符,最多30个任意字符!</div></td>
                  </tr>
                  <tr>
                    <td align="right">权 重：</td>
                    <td><input type="text" name="info[ord]" class="input6 inputt" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                  </tr>
                  <?php if($is_links):?>  
                  <tr>
                    <td align="right">缩略图：</td>
                    <td>
                 <input name="info[simg]" value="<?=isset($row["simg"])?$row["simg"]:'';?>" type="text" class="inputt input3" id="simg" /> 
                 <input name="Submit2" type="button" class="button1" onclick="uploadpic('simg','277','150')" value="上传" />建议尺寸大小277*150像素
                    </td>
                </tr>
                <?php endif;?>
                <tr>
                    <td align="right">链接地址：</td>
                    <td><input type="text" name="info[url]" class="inputt input5" value="<?=isset($row["url"])?$row["url"]:'';?>" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td style="padding-left:220px;padding-top:30px">
                      <input type="hidden" name="id" value="<?=isset($row["id"])?$row["id"]:'';?>">
                      <input type="hidden" name="size" value="<?=$links_size?>" />
                      <input type="submit" value="提交" class="tjanniu cr" />
                      <input type="reset" value="重置" class="czanniu cr"/>
                  </td>
                </tr>
               </table>
            </form>
        </div>

    </div>
</div>
<link href="<?=base_url('static/kindeditor/themes/default/default.css')?>" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
	function uploadpic(picid,width,height)
	{
		siteaurl = "<?=site_url('admin')?>";
		var editor = KindEditor.editor({
			uploadJson:siteaurl+"/avatar/attrImg?width="+width+"&height="+height,
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
