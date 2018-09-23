<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?=$catename?></div>
        <div class="mrnr1">
            
                <div class="hdtop">
                    <a href="<?=site_url('admin/ads/edit'.'?catid='.$cateid)?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/ads'.'?catid='.$cateid)?>" class="gla">管 理</a>
                    <form name="myform" action="<?=site_url('admin/ads')?>" method="get">
                    <div class="hdtright">
                        <span>标 题：</span><input type="text"  class="inputt input1" name="q" value="<?=$q?$q:''?>"/>
                        <span>广告位置：</span>
                        <select name="cateid" class="easyui-combobox" style="height:25px">
                           <option value="0">全部</option>
                           <?php 
						   if(!empty($typelist)):
						    foreach($typelist as $val):?> 
                              <option value="<?php echo $val['id']?>" <?php if(isset($cateid)&&$cateid==$val['id']) echo ' selected="selected"';?>><?php echo $val['title'].'['.$val['width'].'X'.$val['height'].'px]';?></option>
                           <?php 
						    endforeach;
						   endif;?>  
                        </select>
                        <input type="submit" value="查 询" class="button" />
                    </div>
                    </form>
                    <div class="clear"></div>
                </div>
                <form action="<?=site_url('admin/ads/moreDel')?>" method="post" >
                <div class="hdbot">
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
                      <tr>
                        <td align="center" class="biaoti" ><input type="checkbox" class="allcheck" /></td>
						<td align="center" class="biaoti">标 题</td>
                        <td align="center" class="biaoti">广告位置</td>
						<td align="center" class="biaoti">链接地址</td>
                        <td align="center" class="biaoti">排 序</td>
                        <td align="center" class="biaoti">操 作</td>
                      </tr>
                      <?php foreach($list as $c):?>
                      <tr>
                        <td align="center"><input name="id[]" type="checkbox" value="<?=$c["id"];?>"></td>
                        <td align="center"><?=$c['title']?></td>
                        <td align="center"><?=db_result('ads_type','title',array('id'=>$c['bid']));?></td>
                        <td align="center"><?=$c['url']?></td>
                        <td align="center"><?=$c['ord'];?></td>
                        <td align="center"><a href="<?=site_url('admin/ads/edit'.'?catid='.$cateid.'&id='.$c['id'])?>" class="xga">修改</a></td>
                      </tr>
                      <?php endforeach;?>
                      
                    </table>
                    <div class="tableb">
                        <input type="checkbox" class="allcheck" />
                        <input type="hidden" name="cateid" value="<?=$cateid;?>">
                        <input type="submit" value="删除" class="scanniu cr" />
                        <div class="tablebnr"><?=$page?></div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>