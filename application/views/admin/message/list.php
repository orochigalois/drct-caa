<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?php echo $catename;?></div>
        <div class="mrnr1">
                <div class="hdbot">
                	 <form action="<?=site_url('admin/message/moreDel')?>" method="post"  onSubmit="return checkSubmit(this);">
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab">
						<td align="center" class="biaoti" ><input type="checkbox" class="allcheck" /></td>
						<td align="center" class="biaoti">主题</td>
                        <td align="center" class="biaoti">姓名</td>
                        <td align="center" class="biaoti">联系方式</td>
						<td align="center" class="biaoti">发布时间</td>
                        <td align="center" class="biaoti">操作</td>
                      <?php foreach($list as $c):?>	
                      <tr>
                        <td align="center"><input name="id[]" type="checkbox" value="<?=$c["id"];?>"></td>
                        <td align="center"><?=$c["theme"];?></td>
                        <td align="center"><?=$c["name"];?></td>
                        <td align="center"><?=$c["phone"];?></td>
                        <td align="center"><?=date('Y-m-d H:i:s',$c["addtime"]);?></td>
                        <td align="center"><a href="<?=site_url('admin/message/edit')?>?id=<?=$c['id']?>" class="xga">查看</a></td>
                      </tr>
                      <?php endforeach;?>
                    </table>
                    <div class="tableb">
                        <input type="checkbox" class="allcheck" />
                        <input name="action" type="hidden" value="-2" />
                        <input type="submit" value="删除" class="scanniu cr" />
                        <div class="tablebnr"><?=$page?></div>
                    </div>
                   </form> 
                    
                </div>
        </div>

    </div>
</div>