<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1"><title>网站管理后台
</title>
<script language=javascript>
<!--
ie = (document.all)? true:false
if (ie){
	function ctlent(eventobject){
		if(window.event.keyCode==13){this.document.form1.submit();}
	}
}
//-->
</script>
</head>


<link href="<?=base_url('static/css/admin/main.css')?>" rel="stylesheet" type="text/css" />

<body>

<br><br><br><br><br>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#000000" align="center">   
  <tr>
    <td bgcolor="#FFFFFF"><table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#6FA1FF">
      <tr>
        <td width="311" valign="top"><table width="311" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="72" bgcolor="#FFFFFF" style="padding-left:15px;"><img src="<?=base_url('static/images/logo2.png')?>" width="72" height="72"  /></td>
          </tr>
          <tr>
            <td height="16" bgcolor="#3975e6"></td>
          </tr>
          <tr>
            <td height="1" bgcolor="#FFFFFF"></td>
          </tr>
          <tr>
            <td><img src="<?=base_url('static/images/admin/login_0.jpg')?>" width="311" height="238" /></td>
          </tr>
        </table></td>
        <td width="289" valign="top"><table width="289" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="60" align="center" valign="bottom" bgcolor="#FFFFFF"><font color="#0054a6">您需要首先<font color="#ff0000">登录</font>，才能使用后台管理系统。</font></td>
          </tr>
          <tr>
            <td height="27" background="<?=base_url('static/images/admin/login_2.gif')?>"></td>
          </tr>
              
          <tr>
            <td height="145" align="center" bgcolor="#EEEEEE"><table width="240" border="0" cellspacing="0" cellpadding="0">
			<form id="form1" name="form1" method="post" action="<?=site_url('admin/admin/login')?>" onKeyDown="ctlent()">
              <tr>
                <td width="60" height="32" align="center" valign="middle">用户名：</td>
                <td width="180" height="32" align="left" valign="middle"><input name="txtUserName" type="text" class="main" id="txtUserName" maxlength="20" style="width:125px;" /></td>
              </tr>
              <tr>
                <td height="32" align="center" valign="middle">密&nbsp;&nbsp;码：</td>
                <td height="32" align="left" valign="middle"><input name="txtPassWord" type="password" class="main" id="txtPassWord" maxlength="20" style="width:125px;" /></td>
              </tr>
              <tr>
                <td height="32" align="center" valign="middle">验证码：</td>
                <td height="32" align="left" valign="middle">
				<input name="txtCode" type="text" class="main" id="txtCode" maxlength="20" style="width:50px;"  /><img src='<?=site_url('utils/scode')?>' name="txtCode" width="66" height="23" border='0' onclick="this.src='<?=site_url('utils/scode')?>?s='+Math.random();"><input name="action" type="hidden" id="action" value="login"></td>
              </tr>
              <tr>
                <td height="36" colspan="2" align="center" valign=center><input name="Submit2" type="submit" class="sbut" value="登 录" /></td>
              </tr>
			  </form>
            </table></td>
          </tr>
          <tr>
            <td height="25" bgcolor="#a6d2ff" align="center">
			<?php
            if(isset($msg) && $msg !=''){
            ?>
                <span style="color:red;"><?=$msg?></span>
              <?php
                }
              ?> </td>
          </tr>
        </table></td>
        <td width="120" valign="top"><table width="120" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="72" bgcolor="#FFFFFF"></td>
          </tr>
          <tr>
            <td height="16" bgcolor="#3975e6"></td>
          </tr>
          <tr>
            <td height="1" bgcolor="#FFFFFF"></td>
          </tr>
        </table></td>
      </tr>
    </table>
        <table width="720" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="<?=base_url('static/images/admin/login_3.gif')?>" width="720" height="17" /></td>
          </tr>
          <tr>
            <td height="60" align="right" style="padding-right:15px;">&nbsp;</td>
          </tr>
      </table></td>
  </tr>
</table>
</body>
</html>