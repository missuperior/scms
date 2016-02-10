<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    	<title>Superior University Lahore</title>
    	<link href="<?php echo base_url()?>/assets/css/login.css" rel="stylesheet" type="text/css" />
       
    </head>
    
    <body>

        		<!--Header starts from here-->
                <div id="outerheader">
                	<div id="header">
            				<a href="#"><img src="<?php echo base_url()?>assets/images/headerlogo.jpg" /></a>
                    </div>
                </div>
                <div class="clr"></div>
                <!--Header ends here-->
                <!--wholemiddlearea starts from here-->
                <div id="outercontentarea">
                	<div id="contentarea">
                            
                            <form name="adminLogin" id="adminLogin" method="post" onsubmit="return validate()"  action="<?php echo base_url() ?>admission/admin_login">
                		<div id="loginarea">

                                    
                                    <div id="image">
                        				<img src="<?php echo base_url()?>assets/images/loginareaimage.png" alt="loginareaimage" />
                        			</div>
                                    <div class="clr"></div>
                                    
                                    <div style="color: #FF0000;  margin: 15px 0 0 110px;    width: 325px;">
                                        <?php echo $this->session->userdata('error'); $this->session->unset_userdata('error');?>                              
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    
                    				<div id="labelonediv"> 
                						<label class="labelone">EMAIL</label>
                                                                <input type="text" name="username" id="username" class="inputfield1" />
                        			</div>
                                    <div class="clr"></div>
                        			<div id="labeltwodiv">
                        				<label class="labeltwo">PASSWORD</label>
                                                        <input type="password" name="password" id="password" class="inputfield2" />
                                                        <input type="hidden" name="account_role_id" id="account_role_id" value="3" class="inputfield2" />

                        			</div>
                                    <div class="clr"></div>
                                    <div id="twoparas">
                        				<input type="checkbox" />
                        				<p id="paraone">REMEMBER ME</p>
                        				<a href="#"><p id="paratwo">FORGOT PASSWORD</p></a>
                        			</div>
                        			<div id="submitbutton">
                        				<input type="submit" class="button" value="Submit"/>
                        				<!--<a href="#"><img src="images/submitbutton.jpg" alt="submitbutton" /></a>-->
                        			</div>
                                    <div class="clr"></div>
                                    </form>
                		</div>
                		<div id="shadowunderlogin">
                        	
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                <!--wholemiddlearea ends here-->
                <!--footer starts from here-->
                <div id="outerfooterarea">
                	<div id="footer">
                		<p class="pone">Copyright Â© 2014 Superior university. All rights reserved</p>
                    	<p class="ptwo">Designed & Developed by <a href="#">Superior Solutions</a></p>
                        <div class="clr"></div>
                	</div>
                </div>
                <div class="clr"></div>
                <!--footer ends here--> 
        	<!--</div>-->
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
   