<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">内容管理</div>
        <div class="mrnr1">
                <div class="hdtop">
                    <a href="<?=site_url('admin/news/edit')?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/news')?>" class="gla">管 理</a>
                    <div class="hdtright">
                    	<form name="myform" action="<?=site_url('admin/news')?>" method="get">
                        <span>标 题：</span><input type="text"  class="inputt input1" name="q" value="<?=$q?$q:''?>"/>
                        <span>所属分类：</span>
                        <select name="cateid" class="easyui-combobox" style="height:25px">
                            	<option value="0">全部</option>
                                <?php
                                    echo $this->Newstype_model->get_options($cateid);
                                ?>
                            </select>
                        <input type="submit" value="查 询" class="button" />
                        </form>
                    </div>
                    
                    <div class="clear"></div>
                </div>
                <div class="hdbot">
                   <form action="<?=site_url('admin/news/moreDel')?>"  method="post">
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
                      <tr>
                        <td align="center" class="biaoti" width="5%"><input type="checkbox" class="allcheck" /></td>
						<td align="center" class="biaoti" width="20%">标 题</td>
                        <td align="center" class="biaoti" width="10%">所属分类</td>
                        <td align="center" class="biaoti" width="5%">排 序</td>
                        <td align="center" class="biaoti" width="8%">发布时间</td>
                        <td align="center" class="biaoti" width="12%">操 作</td>
                      </tr>
                      <?php foreach($list as $val):?>
                      <tr>
                        <td align="center"><input name="id[]" type="checkbox" id="id[]" value="<?=$val["id"];?>"></td>
                        <td class="ts"><?php echo $val["title"];?>
                        <?php if($val['is_recom']>0):?><font class="fontt"><?php echo $this->recom->get_recom_value($val['is_recom']);?></font><?php endif;?>
                        <?php if(!empty($val['simg'])):?><font class="fontt"><a href="<?=base_url($val['simg'])?>" target="_blank" style="color:#F00">图</a></font><?php endif;?><?php if(!empty($val['files'])):?><font class="fontt"><a href="<?=base_url($val['files'])?>" target="_blank" style="color:#F00">附件</a></font><?php endif;?></td>
                        <td align="center"><?=db_result('news_type','title',array('id'=>$val['bid']));?></td>
                        <td align="center"><?=$val['ord'];?></td>
                        <td align="center"><?=date('Y-m-d H:i',$val['addtime']);?></td>
                        <td align="center">
                          <a href="<?=site_url('admin/news/edit')?>?id=<?=$val['id']?>" class="xga">修改</a>
                          <?php 
						  $class = db_result('news_type','class',array('id'=>$val['bid']));
						  if($class=='race'):?>
                              <a href="<?=site_url('admin/pics?cateid='.$val['id'])?>" class="xga" style="margin:0 2px;">图片集</a>
                              <a href="<?=site_url('admin/news/VideoList?cateid='.$val['id'])?>" class="xga">视频</a>
                          <?php 
						  endif;?>
                        </td>
                      </tr>
                      <?php endforeach;?>
                    </table>
                    <div class="tableb">
                        <input type="checkbox" class="allcheck" />
                        <div style="float:left;margin-top:12px;margin-left:10px">
                            <select name="action" class="easyui-combobox" style="width:130px;height:25px;">
                        	<option value="-2">删除</option>
                            <?php foreach($recom as $key=>$value): ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endforeach;?>
                         </select>
                        </div>
                        <input type="submit" value="提交" class="scanniu cr" />
                        <div class="tablebnr"><?=$page?></div>
                    </div>
                    </form>
                </div>
            
        </div>

    </div>
</div>