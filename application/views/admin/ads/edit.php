<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?=$catename?></div>
        <div class="mrnr1">
                <div class="hdtop">
                    <a href="<?=site_url('admin/ads/edit'.'?catid='.$cateid)?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/ads'.'?catid='.$cateid)?>" class="gla">管 理</a>
                    <div class="clear"></div>
                </div>
                <div class="zxzx_main">
                	<form name="myform"  method="post" action="<?=site_url('admin/ads/save')?>" class="addForm">
                    <table class="table7 table77" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td>标 题：</td>
                            <td><input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-30"  nullmsg="请输入标题！" errormsg="标题至少1个字符,最多30个任意字符！"/>
                            <div class="info"><span class="Validform_checktip">标题至少1个字符,最多30个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        </tr>
                        <tr>
                            <td>权 重：</td>
                            <td><input type="text" class="input6 inputt" name="info[ord]" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                        </tr>
                        <tr>
                            <td>广告位置：</td>
                            <td>
                         	 <select name="info[bid]" id="bid" onchange="ChangSize();">
                               <?php 
                               if(!empty($typelist)):
                                foreach($typelist as $val):?> 
                                  <option value="<?php echo $val['id']?>" <?php if(isset($row['bid'])&&$row['bid']==$val['id']) echo ' selected="selected"';?>><?php echo $val['title'];?></option>
                               <?php 
                                endforeach;
                               endif;?>  
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>大图图片：</td>
                            <td>
                              <input type="hidden" name="s_width" id="s_width" value="<?php echo isset($type['width'])?$type['width']:300;?>">
							  <input type="hidden" name="s_height" id="s_height" value="<?php echo isset($type['height'])?$type['height']:148;?>">
                         	  <input name="info[simg]" value="<?=isset($row["simg"])?$row["simg"]:'';?>" type="text" class="inputt input3" id="simg" /> 
                         	  <input name="Submit2" type="button" class="button1" onclick="uploadpic('simg')" value="上传" />图片建议尺寸<font id="s_html">300*148</font>像素
                            </td>
                        </tr>
                        <tr>
                            <td>小图图片：</td>
                            <td>
                              <input type="hidden" name="m_s_width" id="m_s_width" value="<?php echo isset($type['m_width'])?$type['m_width']:'';?>">
							  <input type="hidden" name="m_s_height" id="m_s_height" value="<?php echo isset($type['m_height'])?$type['m_height']:'';?>">
                         	  <input name="info[simg_2]" value="<?=isset($row["simg_2"])?$row["simg_2"]:'';?>" type="text" class="inputt input3" id="simg_2" /> 
                         	  <input name="Submit2" type="button" class="button1" onclick="uploadpic_m('simg_2')" value="上传" /><font id="m_s_html"></font>
                            </td>
                        </tr>
                        <tr>
                            <td>链接地址：</td>
                            <td><input type="text" name="info[url]" class="inputt input5" value="<?=isset($row["url"])?$row["url"]:'';?>" /></td>
                        </tr>
						<tr>
							<td valign="top">信息描述：</td>
							<td>
							 <textarea name="info[descs]" class="text1"><?=isset($row["descs"])?$row["descs"]:'';?></textarea>
							</td>
						</tr>
                        <tr>
                            <td></td>
                            <td style="padding-left:0px;">
                            	<input type="hidden" name="id" value="<?=isset($row["id"])?$row["id"]:'';?>">
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
<script type="text/javascript" charset="utf-8" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
	function ChangSize(){
		var bid= $('#bid').val();
		$.ajax({
			url:"<?php echo site_url('admin/ads/ajaxPid')?>",
			dataType:"json",
			type:"post",
			data:"catid="+bid,
			success:function(msg){
				$('#s_width').val(msg.width);
				$('#s_height').val(msg.height);
				var s_size = msg.width+"*"+msg.height;
				$("#s_html").html(s_size);
				
				if(msg.m_width!=null){
					$('#m_s_width').val(msg.m_width);
					$('#m_s_height').val(msg.m_height);
					var m_s_size = msg.m_width+"*"+msg.m_height;
					$("#m_s_html").html('图片建议尺寸'+m_s_size+'像素');
				}

			}
		})
	}
	function uploadpic(picid)
	{
		var width  = $('#s_width').val();
		var height = $('#s_height').val();
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
	
	function uploadpic_m(picid)
	{
		var width  = $('#m_s_width').val();
		var height = $('#m_s_height').val();
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
	ChangSize();
</script>