<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<title>Superior University Lahore</title>
    	<link href="<?php echo base_url()?>/assets/css/login.css" rel="stylesheet" type="text/css" />
       
    </head>
	<body>
    	<div id="mainbackground">
    		<div id="wrapper">
        		<!--Header starts from here-->
                <div id="header">
                    <a href="#"><img src="<?php echo base_url()?>/assets/images/headerlogo.jpg" alt="logoinheader"/></a>
                </div>
                <!--Header ends here-->
                <!--wholemiddlearea starts from here-->
                <p id="adminpara">Accounts Login</p>
                <div id="overallbackground">
                <div id="wholemiddlearea">
                    <form name="adminLogin" id="adminLogin" method="post" onsubmit="return validate()"  action="<?php echo base_url() ?>accounts/admin_login">
                	<div id="loginarea">
                    	<div id="image">
                        	<img src="<?php echo base_url()?>/assets/images/loginareaimage.png" alt="loginareaimage" />
                        </div>
                            
                            <div style="color: #FF0000;   margin: 50px 0 0 130px;    width: 325px;">
                                <?php echo $this->session->userdata('error'); $this->session->unset_userdata('error');?>                              
                                <?php echo validation_errors(); ?>
                            </div>
                            
                    	<div id="labelonediv" style="margin-top: 15px;"> 
                			<label class="labelone">EMAIL</label>
                                        <input type="text" name="username" id="username" class="inputfield1" />
                        </div>
                          
                        <br />
                        <div id="labeltwodiv">
                        	<label class="labeltwo">PASSWORD</label>
                                <input type="password" name="password" id="password" class="inputfield2" />
                        </div>
                        <div id="twoparas">
                        	<input type="checkbox" />
                        	<p id="paraone">REMEMBER ME</p>
                        	<a href="#"><p id="paratwo">FORGOT PASSWORD</p></a>
                        </div>
                        
                        <div id="submitbutton">
                            <input type="submit" class="button" value="Submit"  />
                        	<!--<a href="#"><img src="images/submitbutton.jpg" alt="submitbutton" /></a>-->
                        </div>
                	</div>
                    </form>
                </div>
                </div>
                <!--wholemiddlearea ends here-->
                <!--footer starts from here-->
                <div id="footer">
                	<p class="pone">Copyright Â© 2014 Superior university. All rights reserved</p>
                    <p class="ptwo">Designed & Developed by <a href="#">Superior Solutions</a></p>
                </div>
                <!--footer ends here-->  
        	</div>
        </div>
    </body>
</html>


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