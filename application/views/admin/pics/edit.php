<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?=$catename?></div>
        <div class="mrnr1">
                <div class="hdtop">
                    <a href="<?=site_url('admin/pics/edit?cateid='.$cateid)?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/pics?cateid='.$cateid)?>" class="gla">管 理</a>
                    <div class="clear"></div>
                </div>
                <div class="zxzx_main">
                	<form name="myform"  method="post" action="<?=site_url('admin/pics/save')?>" class="addForm">
                    <table class="table7 table77" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td>标 题：</td>
                            <td><input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-30"  nullmsg="请输入标题！" errormsg="标题至少1个字符,最多30个任意字符！"/>
                            <div class="info"><span class="Validform_checktip">标题至少1个字符,最多30个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        </tr>
                        <tr>
                            <td>权 重：</td>
                            <td><input type="text" name="info[ord]" class="input6 inputt" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                        </tr>
                        <tr>
                            <td>图 片：</td>
                            <td>
                         	  <input name="info[simg]" value="<?=isset($row["simg"])?$row["simg"]:'';?>" type="text" class="inputt input3" id="simg" /> 
                         	  <input name="Submit2" type="button" class="button1" onclick="uploadpic('simg',101,101)" value="上传" />图片建议尺寸101*101px;
                            </td>
                        </tr>
                        <tr>
                            <td>图片集：</td>
                            <td>
                         	  <input name="info[download]" value="<?=isset($row["download"])?$row["download"]:'';?>" type="text" class="inputt input3" id="download" /> 
                         	  <input name="Submit2" type="button" class="button1" onclick="uploadfile('download')" value="上传" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right">发布时间：</td>
                            <td>
                            <input name="info[addtime]" type="text" class="inputt input61" id="addtime"  value="<?=date('Y-m-d H:i',isset($row['addtime'])?$row['addtime']:time());?>">&nbsp;<img onclick="WdatePicker({el:'addtime','dateFmt':'yyyy-MM-dd HH:mm'})" src="<?=base_url('static/js/data/skin/datePicker.gif')?>" width="16" height="22" align="middle">
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left:0px;">
                            	<input type="hidden" name="id" value="<?=isset($row["id"])?$row["id"]:'';?>">
                    			<input type="hidden" name="info[bid]" value="<?=$cateid;?>" >
                                <input type="hidden" name="cateid" value="<?=$cateid;?>" >
                                <input type="submit" value="提交" class="tjanniu2 cr" />
                                <input type="reset" value="重置" class="czanniu3 cr"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
        </div>

    </div>
</div>
<link href="<?=base_url('static/kindeditor/themes/default/default.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=base_url('static/js/data/WdatePicker.js')?>" charset="utf-8" ></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>"></script>
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
	function uploadfile(fileid)
	{
		siteaurl = "<?=site_url('admin')?>";
		var editor = KindEditor.editor({
			uploadJson:siteaurl+"/avatar/attrupload",
			allowFileManager : true
		});
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : KindEditor('#'+fileid).val(),
				clickFn : function(url,title) {
					if($.trim(title)==url){
						title='';
					}
					newurl = url.substr(url.indexOf("static"));
					$('#'+fileid).val(newurl);
					editor.hideDialog();
				}
			});
		});
	}
</script>