<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?=$catename?></div>
        <div class="mrnr1">
                <div class="hdtop">
                    <a href="<?=site_url('admin/pics/edit?cateid='.$cateid)?>" class="tja">添 加</a>
                    <a href="<?=site_url('admin/pics?cateid='.$cateid)?>" class="gla">管 理</a>
                    <form name="myform" action="<?=site_url('admin/pics')?>" method="get">
                    <input type="hidden" name="cateid" value="<?php echo $cateid?>" />
                    <div class="hdtright">
                        <span>标 题：</span><input type="text"  class="inputt input1" name="q" value="<?=$q?$q:''?>"/>
                        <input type="submit" value="查 询" class="button" />
                    </div>
                    </form>
                    <div class="clear"></div>
                </div>
                <form action="<?=site_url('admin/pics/moreDel')?>" method="post" onSubmit="return checkSubmit(this);">
                <div class="hdbot">
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
                      <tr>
                        <td align="center" class="biaoti" ><input type="checkbox" class="allcheck" /></td>
						<td align="center" class="biaoti">标 题</td>
                        <td align="center" class="biaoti">排 序</td>
                        <td align="center" class="biaoti">发布时间</td>
                        <td align="center" class="biaoti">操 作</td>
                      </tr>
                      <?php foreach($list as $c):?>
                      <tr>
                        <td align="center"><input name="id[]" type="checkbox" value="<?=$c["id"];?>"></td>
                        <td align="center"><?=$c['title']?></td>
                        <td align="center"><?=$c["ord"];?></td>
                        <td align="center"><?=date('Y-m-d H:i',$c['addtime']);?></td>
                        <td align="center">
                         <a href="<?=site_url('admin/pics/edit?cateid='.$cateid.'&id='.$c['id'])?>" class="xga">修改</a>
                         <a href="<?=site_url('admin/pics/picList?cateid='.$c['id'])?>" class="xga" style="margin:0 2px;">列表</a>
                        </td>
                      </tr>
                      <?php endforeach;?>
                      
                    </table>
                    <div class="tableb">
                        <input type="checkbox" class="allcheck" />
                        <input name="action" type="hidden" value="-2" />
                        <input type="hidden" name="cateid" value="<?=$cateid;?>">
                        <input type="submit" value="删除" class="scanniu cr" />
                        <div class="tablebnr"><?=$page?></div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>