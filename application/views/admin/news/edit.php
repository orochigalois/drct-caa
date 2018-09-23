<script type="text/javascript" src="<?=base_url('static/js/admin/utils.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/js/data/WdatePicker.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/kindeditor-min.js')?>" charset="utf-8" ></script>
<script type="text/javascript" src="<?=base_url('static/kindeditor/lang/zh_CN.js')?>" charset="utf-8"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
K.create('textarea[id="con_1"]', {
allowFileManager: false,
filterMode: false,
newlineTag:'br',
  afterBlur: function(){this.sync();}
});
});
</script>
<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">内容管理</div>
        <div class="mrnr1">
          
                <div class="hdtop">
                    <a href="<?=site_url('admin/news/edit')?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/news')?>" class="gla">管 理</a>
                    <div class="clear"></div>
                </div>
                <div class="hdbot">
                    <div class="xxk">
                        <span><a href="javascript:void(0)">基本信息</a></span>
                        <span><a href="javascript:void(0)">SEO设置</a></span>
                        <span><a href="javascript:void(0)">高级信息</a></span>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="xxgl_main">
                	 <form name="myform"  method="post" action="<?=site_url('admin/news/save')?>" class="addForm" enctype="multipart/form-data">
                    <div class="hdnr">
                        <table width="100%" cellpadding="0" cellspacing="0" class="table3 tab">
                            <tr>
                                <td width="75">标 题：</td>
                                <td>
                                <input type="text"  name="info[title]" class="inputt input5" value="<?=isset($row["title"])?$row["title"]:'';?>" datatype="*1-240"  nullmsg="请输入标题！" errormsg="标题至少1个任意字符,最多240个任意字符！"/>
                                <div class="info"><span class="Validform_checktip">标题至少1个字符,最多240个任意字符！</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div class="tsy">标题长度1-240个任意字符</div></td>
                            </tr>
                            <tr>
                                <td>权 重：</td>
                                <td><input type="text" class="input6 inputt" name="info[ord]" value="<?=isset($row["ord"])?$row["ord"]:'10';?>"> 越小越靠前</td>
                            </tr>
                            <tr>
                                <td>所属分类：</td>
                                <td>
                                  <select name="info[bid]" onchange="selectLoad(this)" id="selectBid">
									<?php
										$bid = isset($row["bid"])?$row["bid"]:0;
                                        echo $this->Newstype_model->get_options($bid);
                                    ?>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">详细内容：</td>
                                <td><textarea name="info[con_1]" style="width:793px;height:302px;visibility:hidden;"  id="con_1"><?=isset($row["con_1"])?$row["con_1"]:'';?></textarea></td>
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
                    <div class="hdnr"></div>
                    <input name="id" type="hidden" id="id" value="<?=isset($row["id"])?$row["id"]:'';?>">
                   </form> 
                </div>
            
        </div>
    </div>
</div>
<script>
	function selectLoad(obj)
	{
		$cid = 0;
		$id = <?=isset($row["id"])? $row["id"]: 0;?>;
		if(typeof(obj) == 'object') {
			$cid = obj.value;
		} else {
			$cid = obj;
		}
		$('.hdnr:eq(2)').load("<?php echo site_url('admin/news/ajaxBody?cid=');?>" + $cid + "&id=" + $id,function(){
			KindEditor.create('textarea[id="con_2"],[id="con_3"],[id="con_4"]', {
			allowFileManager: false,
			filterMode: false,
			newlineTag:'br',
			afterBlur: function(){this.sync();}
			});
		});
		
	}
	$(function() {
		$cid = $('#selectBid').val();
		selectLoad($cid);
	});
</script>