<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">幻灯管理</div>
        <div class="mrnr1">
                <div class="hdtop">
                    <a href="<?=site_url('admin/slide/edit')?>" class="tja tja2">添加</a>
                    <a href="<?=site_url('admin/slide')?>" class="gla gla2">管理</a>                    
                    <div class="clear"></div>
                </div>
                <div class="hdbot">
                	 <form action="<?=site_url('admin/slide/moreDel')?>" method="post" onSubmit="return checkSubmit(this);" >
                    <div class="tablet tablett">
                        <span class="sp1"><input type="checkbox" class="allcheck" /></span>
                        <span class="sp2">标 题</span>
                        <span class="sp3">链接地址</span>
                        <span class="sp4">排 序</span>
                        <span class="sp5">操 作</span>
                    </div>
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
                      <?php foreach($list as $c):?>	
                      <tr>
                        <td width="38" align="center"><input name="id[]" type="checkbox" value="<?=$c["id"];?>"></td>
                        <td width="318" class="ts"><?=$c["title"];?>
                        <?php if(!empty($c['simg'])):?>&nbsp;<a href="<?=base_url($c['simg'])?>" target="_blank"><img src="<?=base_url($c['simg'])?>" width="80"></a><?php endif;?>
                        </td>
                        <td width="337" align="center"><?=$c["url"];?></td>
                        <td width="86" align="center"><?=$c["ord"];?></td>
                        <td align="center"><a href="<?=site_url('admin/slide/edit'.'?id='.$c['id'])?>" class="xga">修改</a></td>
                      </tr>
                      <?php endforeach;?>
                    </table>
                    <div class="tableb">
                        <input type="checkbox" class="allcheck" />
                        <input type="hidden" name="action" value="-2" />
                        <input type="submit" value="删除" class="scanniu cr" />
                        <div class="tablebnr"><?=$page?></div>
                    </div>
                   </form> 
                    
                </div>
        </div>

    </div>
</div>