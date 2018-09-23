<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">管理员管理</div>
        <div class="mrnr1">
             <div class="hdbot">
                <div class="xxk">
                    <div class="gly_bt">新增管理员</div>
                </div>
            </div>
                <div class="glynr">
                    <form  method="post" action="<?=site_url('admin/admin/addUser')?>" class="addForm">
                    <table class="table7" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td>账 号：</td>
                            <td><input type="text" class="inputt input7"  name="username" datatype="*1-18"  nullmsg="请输入您的账号！" errormsg="账号至少1个任意字符,最多18个任意字符！"/>
                            <div class="info"><span class="Validform_checktip">昵称至少6个字符,最多18个字符</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                            <td>密 码：</td>
                            <td><input type="password" class="inputt input71" name="password" datatype="*6-18" nullmsg="请输入密码！" errormsg="密码至少6个字符,最多18个字符！"/>
                             <div class="info"><span class="Validform_checktip">密码至少6个字符,最多18个字符</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
</td>
                            <td>确认密码：</td>
                            <td><input type="password" class="inputt input71"  name="pwd"   recheck="password" datatype="*6-18" nullmsg="请输入确认密码！" errormsg="两次输入的密码不一致！"/>
                            <div class="info"><span class="Validform_checktip">请确认您的密码</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
</td>
                            <td><input type="submit" class="gla" value="添加" /></td>
                        </tr>
                    </table>
                    </form>
                </div>
                <?php
				  if($action == "manage"):
				  foreach($list as $c):
				?>
                <div class="hdbot">
                    <div class="tablet4 tablett">
                        <span class="sp1">管理员账号</span>
                        <span class="sp2">管理员密码</span>
                        <span class="sp3">备注</span>
                        <span class="sp4">修改</span>
                        <span class="sp5">删 除</span>
                    </div>
                    <table width="910" border="0" cellspacing="1" cellpadding="0" class="table1 tab pad">
                      <tr>
                        <td width="192" align="center"><?=$c['username']?></td>
                        <td width="232" align="center" class="ts"><?=$c['userpwd']?></td>
                        <td width="162" align="center"><?=($c['status']==1)?'系统用户':'';?></td>
                        <td width="162" align="center"><a href="<?=site_url("admin/admin/addUser/{$c['id']}")?>" class="xga">修改</a></td>
                        <td width="" align="center">
                        <?php if($c['status']==1):?>
                        <a href="#" class="xga" onClick="return isDel('系统用户不允许删除！')">删除</a>
                        <?php else:?>
                        <a href="<?=site_url("admin/admin/delUser/{$c['id']}")?>" class="xga" onClick="return isDel('确定要删除吗?')">删除</a>
                        <?php endif;?>
                        </td>
                      </tr>
                    </table>
                </div>
                 <?php 
                   endforeach;
				   elseif($action == "edit"):
                 ?>
                 <div class="hdbot">
                    <div class="xxk">
                        <div class="gly_bt">修改管理员</div>
                    </div>
                </div>
                <div class="glynr">    
                	<form  method="post" action="<?=site_url('admin/admin/addUser')?>" class="addForm">        
                    <table class="table7 table77" cellspacing="0" cellpadding="0" border="0">
                    	<tr>
                            <td>管理员账号：</td>
                            <td><input type="text" class="inputt input8" name="username"  value="<?=isset($row['username'])?$row['username']:'';?>"/></td>
                        </tr>
                        <tr>
                            <td>管理员密码：</td>
                            <td><input type="password" class="inputt input8"  name="password" ignore="ignore" datatype="*6-18" nullmsg="请输入密码！" errormsg="密码至少6个字符,最多18个字符！"/>
                             <div class="info"><span class="Validform_checktip">密码至少6个字符,最多18个字符</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        </tr>
                        <tr>
                            <td>确认密码：</td>
                            <td><input type="password" class="inputt input8"  name="pwd"  recheck="password" ignore="ignore" datatype="*6-18"  nullmsg="请输入确认密码！" errormsg="两次输入的密码不一致！"/>
                            <div class="info"><span class="Validform_checktip">请确认您的密码</span><span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left:0px;color:#F00">注:不修改密码请留空。 </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left:0px;">
                            	<input type="hidden" name="id" value="<?=isset($row['id'])?$row['id']:'';?>" />
                                <input type="submit" value="提交" class="tjanniu2 cr" />
                                <input type="reset" value="重置" class="czanniu2 cr" />
                                <input type="button" value="取消" class="czanniu3 cr" onclick="javascript:history.back();"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <?php endif;?>           
            
        </div>
    </div>
</div>
 
