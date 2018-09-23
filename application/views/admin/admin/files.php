<script language="javascript" src="<?=base_url('static/js/admin/Validform_v5.js')?>"></script>
<link href="<?=base_url('static/css/admin/validform.css')?>" rel="stylesheet" type="text/css" />
<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1">附件管理</div>
        <div class="mrnr1">
                <div class="glynr">    
                	 	         
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="10" background="static/images/admin/main_4.gif">&nbsp;</td>
					<td width="926" background="static/images/admin/main_9.gif">
					<?php if ($dir !='' && $dir != '.'):?>
                    <table width="100%" border="0" align="center" cellpadding="0"
                        cellspacing="0">
                        <tr>
                            <td height="34">
                            <a href="?c=attachment&dir=<?php echo stripslashes(dirname($dir))?>">返回上层目录</a>
                            </td>
                        </tr>
                    </table>
                    <?php endif;?>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
										
										<?php 
										if(is_array($list)) {
											foreach ($list as $v){
											$filename = basename($v);
										?>
											<tr class="td">
												<?php 
												if(is_dir($v)){
												?>
												<td>
												<img src="<?=base_url("static/ico/jia.ico")?>" width="30" />
												<a href="<?=site_url('admin/admin/files')?>?dir=<?php echo (isset($dir) && !empty($dir) ? stripslashes($dir).'/' : '').$filename?>"><b><?php echo $filename?></b></a>
												</td>
												<td width="10%"></td>
												
												<?php }else{?>
												<td><img src="<?=base_url("static/ico/".fileext($filename).".ico")?>" width="20" /><a rel=""><?php echo $filename?></a></td>
												<td width="10%"><a href="<?=base_url("{$local}{$filename}")?>" target="BigImg">查看</a>  |  <a href="<?=site_url('admin/admin/delFiles')?>?filename=<?php echo urlencode($filename)?>&dir=<?php echo urlencode($local)?>" onclick="return isDel('文件删除后将无法恢复，确认删除此文件吗？')">删除</a></td>
												
												<?php }?>
											</tr>
										<?php 
											}
										}
										?>

									</table>
								</td>
							</tr>
						</table>
					
					</td>
				</tr>


			</table>
       			</div>
    </div>
</div>
 
 