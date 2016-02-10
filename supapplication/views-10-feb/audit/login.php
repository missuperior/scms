<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<title>Superior University Lahore</title>
    	<link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
			<!--wholemiddlearea starts from here-->
            	<div id="contentarea">
					<img src="<?php echo base_url();?>assets/images/logo.png" style="width:200px; height:200px; left:20px; position: absolute; top:120px; z-index:2;"  />
					<div class="clr"></div>
					
                                      <form name="adminLogin" id="adminLogin" method="post" onsubmit="return validate()"  action="<?php echo base_url() ?>audit/admin_login">
                		
                                        <div id="loginarea">
						<div id="login_header">
							<p>Login Panel</p>
						</div>
						<div class="clr"></div>
						<div class="textandinputfield">
							<input id="user_name" type="text" name="username" placeholder="username" />
						</div>
						<div class="clr"></div>
						<div class="textandinputfield">
							<input id="password" type="password" name="password" placeholder="password"/>
                                                        <input type="hidden" name="account_role_id" id="account_role_id" value="5" class="inputfield2" />

						</div>
						<div class="clr"></div>
						<div id="loginbutton">
							<input type="submit" value="Login"  />
						</div>
					</div>
                                      </form>
					<div class="clr"></div>
				</div>
            <!--wholemiddlearea ends here-->
    </body>
<script type="text/javascript">
function validate(){
var uname = document.adminLogin.username.value;
var pass  = document.adminLogin.password.value;

if(uname == '')
{
    alert('Username is Required.');
    document.adminLogin.username.focus();
    return false;
}
if(pass == '')
{
    alert('Password is Required.');
    document.adminLogin.password.focus();
    return false;
}

}
</script>
</html>