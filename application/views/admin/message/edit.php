<div class="mrbot">
    <div class="mrbot1">
        <div class="mrbt1"><?php echo $catename;?></div>
        <div class="mrnr1">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                	<?php foreach($fields as $c):?>
                    <tr>
                        <td align="right"><?=$c['Comment']?>：</td>
                        <td>
						<?php
                         switch($c['Field']){
					 	   case 'addtime':
						   	 echo date('Y-m-d',$row[$c['Field']]);
						   break;
						   default:
						     echo $row[$c['Field']];
						   break;
						 }?>
                        </td>
                    </tr>
               		<?php endforeach;?>
                  <tr>
                    <td></td>
                    <td style="padding-left:220px;padding-top:30px"><a href="javascript:history.back();">返回上一层</a></td>
                  </tr>
                </table>
        </div>

    </div>
</div>