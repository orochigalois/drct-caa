<script type="text/javascript" src="<?=base_url('static/js/admin/utils.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/js/data/WdatePicker.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
K.create('textarea[id="con_1"],[id="con_2"],[id="con_3"],[id="con_4"],[id="con_5"]', {
allowFileManager: false,
filterMode: false,
newlineTag:'br',
  afterBlur: function(){this.sync();}
});
});
</script>
<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">分类管理</div>
        <div class="mrnr1">
            <form name="myform"  method="post" action="<?=site_url('admin/news/saveType')?>" class="addForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                  <tr>
                    <td width="90" align="right">标 题：</td>
                    <td><input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-30"  nullmsg="请输入标题！" errormsg="标题至少1个字符,最多30个任意字符！"/>
                    <div class="info"><span class="Validform_checktip">标题至少1个字符,最多30个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><div class="tsy">标题长度12-80个字符(1个中文汉字为2个字符)</div></td>
                    </tr>
                    <tr>
                        <td align="right">权 重：</td>
                        <td><input type="text" name="info[ord]" class="input6 inputt" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                    </tr>
                   <?php if(isset($row['class']) && $row['class'] == 'link'):?>
					<tr>
						<td align="right">外链地址：</td>
						<td><input type="text" class="inputt input4" name="info[link_url]"  value="<?=isset($row["link_url"])?$row["link_url"]:'';?>"/>必须以http://开头</td>
				   </tr>
				  <?php endif;?>
                    <?php if(isset($row['class']) && $row['class'] == 'news'):?>
                    <tr>
                        <td align="right">分页数量：</td>
                        <td><input type="text" name="info[pagesize]" class="input6 inputt" value="<?=isset($row["pagesize"])?$row["pagesize"]:'10';?>"></td>
                    </tr>
                    <?php endif;?>
                    <?php 
					if((isset($row["id"])&&$row["id"]==1)||isset($row["pid"])&&$row["pid"]==1):?>
                    <tr>
                        <td align="right">Banner大图：</td>
                        <td>
                        <input name="info[bgsimg]" value="<?=isset($row["bgsimg"])?$row["bgsimg"]:'';?>" type="text" class="inputt input62" id="bgsimg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('bgsimg',1900,566)" value="上传" /> 图片建议尺寸1900*566像素
                        </td>
                    </tr>
                    <?php 
					else:?>
                    <tr>
                        <td align="right">Banner大图：</td>
                        <td>
                        <input name="info[bgsimg]" value="<?=isset($row["bgsimg"])?$row["bgsimg"]:'';?>" type="text" class="inputt input62" id="bgsimg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('bgsimg',1900,823)" value="上传" /> 图片建议尺寸1900*823像素
                        </td>
                    </tr>
                    <?php 
					endif;?>
                    <tr>
                        <td align="right">Banner小图：</td>
                        <td>
                        <input name="info[bgsimg_2]" value="<?=isset($row["bgsimg_2"])?$row["bgsimg_2"]:'';?>" type="text" class="inputt input62" id="bgsimg_2" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('bgsimg_2',640,557)" value="上传" /> 图片建议尺寸640*557像素
                        </td>
                    </tr>
                    <?php 
					if(isset($row["id"])&&($row["id"]==14||$row["id"]==18)):?>
                      <tr>
                          <td align="right">栏目首页图片：</td>
                          <td>
                          <input name="info[h_simg]" value="<?=isset($row["h_simg"])?$row["h_simg"]:'';?>" type="text" class="inputt input62" id="h_simg" /> <input name="Submit2" type="button" class="button1" onclick="uploadpic('h_simg',1170,117)" value="上传" /> 图片建议尺寸1170*117像素
                          </td>
                      </tr>
                    <?php 
					endif;?>
                    <?php 
					if((isset($row["id"])&&$row["id"]==1)||(isset($row["pid"])&&($row["pid"]==2||$row["pid"]==3||$row["pid"]==15||$row["pid"]==19))):?>
                    <tr>
                        <td align="right">英语标题：</td>
                        <td><input type="text" name="info[ename]" class="input62 inputt" value="<?=isset($row["ename"])?$row["ename"]:'';?>"></td>
                    </tr>
                    <tr>
                      <td align="right">信息描述：</td>
                      <td><textarea class="text1" name="info[descs]"><?=isset($row["descs"])?$row["descs"]:'';?></textarea></td>
                    </tr>
                    <?php 
					endif;?>
                    <?php 
					if(isset($row["pid"])&&($row["pid"]==15||$row["pid"]==19)):
						$conArr = $this->recom->get_list('race_arr');
						foreach($conArr as $k=>$v):?>
						<tr>
							<td align="right" valign="top"><?php echo $v;?>：</td>
							<td><textarea name="info[con_<?php echo $k?>]" style="width:793px;height:302px;visibility:hidden;"  id="con_<?php echo $k?>"><?=isset($row["con_".$k])?$row["con_".$k]:'';?></textarea></td>
						</tr>
				   <?php 
						endforeach;
					endif;	
				    if(isset($row['class'])&&$row['class']=='about'||(isset($row["pid"])&&($row["pid"]==16||$row["pid"]==20))):?>
                        <tr>
							<td align="right" valign="top">详细内容：</td>
							<td><textarea name="info[con_1]" style="width:793px;height:302px;visibility:hidden;"  id="con_1"><?=isset($row["con_1"])?$row["con_1"]:'';?></textarea></td>
						</tr>
                   <?php 
				   endif;?>
                  <tr>
                    <td align="right">SEO标题：</td>
                    <td><input type="text" class="inputt input4" name="info[seoTitle]"  value="<?=isset($row["seoTitle"])?$row["seoTitle"]:'';?>"/></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                        <div class="youhuats">
                            <div class="yhts">优化提示： </div>
                            <div class="yhnr">标题最好包含有关键词或分类名称，长度建议20-30个字符以内 </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">SEO关键词：</td>
                    <td><textarea class="text1" name="info[seoKeyword]"><?=isset($row["seoKeyword"])?$row["seoKeyword"]:'';?></textarea></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                        <div class="youhuats">
                            <div class="yhts">优化提示： </div>
                            <div class="yhnr">关键词最好有出现在标题、描述和内容中，标题关键词最佳包含1-3个 </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">SEO描述：</td>
                    <td><textarea class="text1" name="info[setDescription]"><?=isset($row["setDescription"])?$row["setDescription"]:'';?></textarea></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                        <div class="youhuats">
                            <div class="yhts">优化提示： </div>
                            <div class="yhnr">描述尽可能突出中心内容，最好包含关键词和分类名称  </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="padding-left:220px;padding-top:30px">
                    	<input type="hidden" name="id" value="<?=isset($row["id"])?$row["id"]:'';?>">
                  		<input name="info[pid]" type="hidden" value="<?=isset($row["pid"])?$row["pid"]:'0';?>">
                        <?php 
						if(isset($row["pid"])&&($row["pid"]==15||$row["pid"]==19)):?>
                  		  <input name="info[is_lower]" type="hidden" value="1">
                        <?php 
						endif;?>
                        <input name="info[class]" type="hidden" value="<?=isset($class)?$class:'';?>">
                        <input name="info[templates]" type="hidden" value="<?=isset($templates)?$templates:'';?>">
                        <input type="submit" value="提交" class="tjanniu cr" />
                        <input type="reset" value="重置" class="czanniu cr"/>
                    </td>
                  </tr>
                </table>

            </form>
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