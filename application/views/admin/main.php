<div class="mrbot">
            	<div class="mrbot1">
                	<div class="mrbt1">后台首页</div>
                    <div class="mrnr1">
						<table class="table" width="98%">
							<tr>
								<th width="10%">服务器操作系统</th>
								<td><?php echo  PHP_OS;?></td>
							</tr>
							<tr>
								<th>运行环境</th>
								<td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
							</tr>
							<tr>
								<th>MYSQL版本</th>
								<td>
									<?php echo  $this->db->version(); ?>
								</td>
							</tr>
							<tr>
								<th>上传限制</th>
								<td><?php echo ini_get('upload_max_filesize');?></td>
							</tr>
						</table>
                    </div>

                </div>
            </div>