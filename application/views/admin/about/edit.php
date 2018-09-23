<script type="text/javascript" charset="utf-8" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
K.create('textarea[id="content"],[id="descs"]', {
allowFileManager: false,
filterMode: false,
newlineTag:'br',
  afterBlur: function(){this.sync();}
});
});
</script>
<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">单页管理</div>
        <div class="mrnr1">
                <div class="hdbot">
                    <div class="xxk">
                        <span><a href="javascript:void(0)">基本信息</a></span>
						<span><a href="javascript:void(0)">SEO设置</a></span>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="xxgl_main">
                    <form name="myform"  method="post" action="<?=site_url('admin/about/save')?>" enctype="multipart/form-data" class="addForm">
                    <div class="hdnr">
                        <table width="100%" cellpadding="0" cellspacing="0" class="table3 tab">
                            <tr>
                            <td width="75">标 题：</td>
                            <td><input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-30"  nullmsg="请输入标题！" errormsg="标题至少1个字符,最多30个任意字符！"/>
                            <div class="info"><span class="Validform_checktip">标题至少1个字符,最多30个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        	</tr>
                            <tr>
                                <td></td>
                                <td><div class="tsy">标题长度12-80个字符(1个中文汉字为2个字符)</div></td>
                            </tr>
							<?php /*?><tr>
                                <td>英文名称：</td>
                                <td><input type="text" name="info[ename]" class="input5 inputt" value="<?=isset($row["ename"])?$row["ename"]:'';?>"></td>
                            </tr><?php */?>
                            <tr>
                                <td>权 重：</td>
                                <td><input type="text" name="info[ord]" class="input6 inputt" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                            </tr>
                            <?php 
							if(isset($row["pid"])&&$row["pid"]==0):?>
                            <tr>
                                <td>Banner大图：</td>
                                <td>
                                <input name="info[bgsimg]" value="<?=isset($row["bgsimg"])?$row["bgsimg"]:'';?>" type="text" class="inputt input62" id="bgsimg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('bgsimg',1900,566)" value="上传" /> 图片建议尺寸1900*566像素
                                </td>
                            </tr>
                            <tr>
                                <td>Banner小图：</td>
                                <td>
                                <input name="info[bgsimg_2]" value="<?=isset($row["bgsimg_2"])?$row["bgsimg_2"]:'';?>" type="text" class="inputt input62" id="bgsimg_2" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('bgsimg_2',640,557)" value="上传" /> 图片建议尺寸640*557像素
                                </td>
                            </tr>
                            <?php 
							endif;?>
                            <tr>
                                <td valign="top">详细内容：</td>
                                <td> <textarea name="info[content]" id="content" style="width:793px;height:302px;visibility:hidden;"><?=isset($row["content"])?$row["content"]:'';?></textarea></td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td>
                                    <div class="tabm" style="margin-top:-10px">
                                        <div class="fl tabbt">提 示 1：</div>
                                        <div class="fr tabnr hongzi">各大搜索引挚越来越重视文章内容的可阅读性，然而复制的内容含有影响优化效果的HTML标记。</div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="tabm">
                                        <div class="fl tabbt">提 示 2：</div>
                                        <div class="fr tabnr hongzi">各为了提高文章质量，请粘贴后，使用"清除格式"工具选中要清除格式的内容，再对内容进行排版。</div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="tabm">
                                        <div class="fl tabbt">提 示 3：</div>
                                        <div class="fr tabnr hongzi">分段内容主题字体请着重加粗，排名效果将更佳。</div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="tabm">
                                        <div class="fl tabbt">提 示 4：</div>
                                        <div class="fr tabnr">内容需要与标题和描述所描述相符，可阅读性高，不要堆积关键词</div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="tabm">
                                        <div class="fl tabbt">提 示 5：</div>
                                        <div class="fr tabnr">内容的外链数量建议在3-5个左右，不宜太多，并且链接地址的内容最好与此标题相关度较高  </div>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding-left:220px;padding-top:30px">
                                	<input name="id" type="hidden" value="<?=isset($row["id"])?$row["id"]:'';?>">
                  					<input name="info[pid]" type="hidden" value="<?=isset($row["pid"])?$row["pid"]:'0';?>">
                                    <input type="submit" value="提交" class="tjanniu cr" />
                                    <input type="reset" value="重置" class="czanniu cr"/>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
					<div class="hdnr">
                        <table width="100%" cellpadding="0" cellspacing="0" class="table3 tab">
                            <tr>
                                <td width="75">SEO标题：</td>
                                <td><input type="text" name="info[seoTitle]" class="input5 inputt" value="<?=isset($row["seoTitle"])?$row["seoTitle"]:'';?>"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div class="tsy">标题长度12-80个字符(1个中文汉字为2个字符)</div></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="tabm" style="margin-top:-10px">
                                        <div class="fl tabbt">优化提示：</div>
                                        <div class="fr tabnr hongzi">标题最好包含有关键词或分类名称，长度建议20-30个字符以内 。</div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">SEO关键词：</td>
                                <td>
                                   <textarea name="info[seoKeyword]" class="text1"><?=isset($row["seoKeyword"])?$row["seoKeyword"]:'';?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="tabm" style="margin-top:-10px">
                                        <div class="fl tabbt">优化提示：</div>
                                        <div class="fr tabnr hongzi">关键词最好有出现在标题、描述和内容中，标题关键词最佳包含1-3个 。</div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">SEO描述：</td>
                                <td>
                                    <textarea name="info[setDescription]" class="text1"><?=isset($row["setDescription"])?$row["setDescription"]:'';?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div class="tsy">描述长度50-400个字符(1个中文汉字为2个字符)</div></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="tabm" style="margin-top:-10px">
                                        <div class="fl tabbt">优化提示：</div>
                                        <div class="fr tabnr hongzi">描述尽可能突出中心内容，最好包含关键词和分类名称 。</div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding-left:220px;padding-top:30px">
                                    <input type="submit" value="提交" class="tjanniu cr" />
                                    <input type="reset" value="重置" class="czanniu cr"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                   </form>
                    
                </div>
            
        </div>
    </div>
</div>
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