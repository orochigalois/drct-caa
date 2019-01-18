<!-- 主内容开始 -->
<div class="ny_nav_bg_1 fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l_1 fix">
           <?php echo $cateList;?>
        </div>
        <div class="ny_nav_r fix">
            <span>您当前所在位置：</span>
            <?php echo $position;?>
        </div>
    </div>
</div>
<?php 
$baseInfo = $this->Base_model->row( array('id' => 1) );?>
<div class="container fix">
  <div class="ny_h5_bg row fix">
      <div class="col-md-6 ny_h5_l fix">
          <h3><?php echo $baseInfo['title']?></h3>
          <span>地址</span>
          <p><?php echo $baseInfo['address']?></p>
          <span>邮编</span>
          <p><?php echo $baseInfo['postcode']?></p>
          <span>电话</span>
          <p><?php echo $baseInfo['tel']?></p>
          <span>E-mail</span>
          <p><?php echo $baseInfo['email']?></p>
      </div>
      <div class="col-md-6 ny_h5_r fix">
          <?php echo $detail['content']?>
      </div>
  </div>  

  <div class="ny_h5_bg row fix">
    <div class="ny_h5_l fix">
        <p>RoboCup Junior 相关问题咨询请加入QQ交流群：57171258</p>
        <p>RoboCup 大学组及中国机器人大赛相关问题咨询请邮件联系：liukuan@caa.org.cn</p>
    </div>
  </div>

  <!-- 留言咨询  注释此模块-->
<?php if (1==2):?>
  <form class="msgForm"  method="post" action="<?php echo site_url('about/actMsg')?>">
  <div class="ny_h5 fix">
     <h3>留言咨询</h3> 
     <!--<label><input name="ny_check" type="checkbox" value="" />给自己发送一份副本</label>-->
  </div>
  <div class="row fix">
      <div class="col-md-6 ny_text fix">
          <input type="text" class="form-control" placeholder="姓名 / NAME" name="info[name]"  datatype="*2-6" nullmsg="请输入姓名">
      </div>
      <div class="col-md-6 ny_text fix">
          <input type="text" class="form-control" placeholder="电话 / TEL" name="info[phone]"  datatype="t_p" nullmsg="请输入电话">
      </div>

      <div class="col-md-6 ny_text fix">
          <input type="text" class="form-control" placeholder="邮箱 / E-MAIL" name="info[email]"  datatype="e" nullmsg="请输入邮箱"/>
      </div>
      <div class="col-md-6 ny_text fix">
          <input type="text" class="form-control" placeholder="主题 / THEME" name="info[theme]"  datatype="*" nullmsg="请输入主题"/>
      </div>
      <div class="ny_txt fix">
        <textarea class="form-control" rows="3" placeholder="内容 / CONTENT" name="info[content]"  datatype="*1-200" nullmsg="请输入主题"></textarea>
      </div>
      <div class="ny_txt fix">
          <button type="submit" class="btn btn-default">提交</button>
      </div>
  </div>
  </form>
<?php endif;?>
</div>
<script>
$(".msgForm").Validform({
	tiptype:function(msg,o,cssctl){
	  var objtip=o.obj.siblings(".Validform_checktip");
	  cssctl(objtip,o.type);
	  objtip.text(msg);
	},
	//tiptype:3,
	ajaxPost:true,
	showAllError:true,
	datatype:{
		"t_p": /((15)\d{9})|((13)\d{9})|((17)\d{9})|((18)\d{9})|0\d{2,3}-?\d{7,8}/,
	},
	callback:function(data){
		if(data.status=='y'){
		  $(".msgForm")[0].reset();
		}
		alert(data.info);
	}
});
</script>

<!-- 主内容结束 -->
