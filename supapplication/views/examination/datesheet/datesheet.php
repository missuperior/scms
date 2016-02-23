<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Superior University Lahore</title>
<style>
* {
	margin:0%;
	padding:0%;
}
.clr {
	clear:both;
}
.clr20 {
	clear:both;
	height:20px;
}
.clr10 {
	clear:both;
	height:10px;
}
html {
	height:100%;
}
body {
	background:url(images/bg.png) no-repeat center top fixed;
	background-attachment:fixed;
	background-size:cover;
	font-family:Arial, Helvetica, sans-serif;
	width:100%;
	height:100%;
}
.topmostbar {
	margin:auto; 
	padding:0; 
	width:960px;
}
.logo {
	width:178px;
	height:176px;
	float:left;
	display:block;
}
.center_text {
	width:600px;
	float:left;
	text-align:left;
	margin-left:50px;
	
}
@media print{
 #ad{ display:none;}
 #leftbar{ display:none;}
 #contentarea{ width:100%;}
}
</style>
</head>
<body>
    
<?php foreach($info AS $row){?>   
    
<!--Header starts from here-->
<div class="topmostbar">
<div style="margin-top:25px;">
    <div class="logo"> <a href="#"><img src="<?php echo base_url();?>assets/images/colg_logo.png" /></a></div>
  <div class="center_text">
    <h1 style="font-size:32px" >SUPERIOR GROUP OF COLLEGES </h1>
    <h3 style="font-size:26px; margin-left: 45px" > The Superior College Lahore</h3>
    <br />
    <h2 style="font-size:26px; margin-left: 50px">ROLL NO SLIP (FOR STUDENT) </h2>
  </div>
  </div>
  <div class="clr20"></div>
 
    <div style="width:750px; float:  left;">
        <div style="width:100%;  float: left; margin-bottom: 10px;">      
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">ROLL NO :</label><p style="float:left; width:75%"><?php echo $row['roll_no'];?></p> <br>
        </div>
<!--        <div style="width:100%;  float: left; margin-bottom: 10px;">      
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">REGISTRATION NO :</label><p style="float:left; width:75%"><?php echo $row['reg_no'];?></p> <br>
        </div>-->
        <div style="width:100%;  float: left; margin-bottom: 10px;">         
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">SEMESTER :</label><p style="float:left; width:75%"><?php echo $row['semester'];?></p> <br>
        </div>
        <div style="width:100%;  float: left; margin-bottom: 10px;">            
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">PROGRAM :</label><p style="float:left; width:75%"><?php echo $row['program_name'];?></p> <br>
        </div>
        <div style="width:100%;  float: left; margin-bottom: 10px;">            
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">NAME :</label><p style="float:left; width:75%"><?php echo $row['student_name'];?></p> <br>
        </div>
        <div style="width:100%;  float: left; margin-bottom: 10px;">            
              <label style="margin-right:0px; width:25%; font-weight: bold; float: left">FATHER'S NAME :</label><p style="float:left; width:75%"><?php echo $row['father_name'];?></p> <br>
        </div>
    </div>
  
<!--  <div  style="width:150px; float:  left;">
      <img src="<?php echo base_url();?>user_images/<?php echo $row['image']?>" width="150" height="150"/>
  </div>-->
 

   <div class="clr20"></div>
  <div style="text-align:center; margin-bottom: 15px; margin-top: 20px;" >
    <p align="center"><strong><u style="font-size:26px;">Examination Centre </u></strong></p>
    <br/>
    <?php // if($row['campus_id'] == 2){ $text = ' (30-L)';}?>
    <h4 style="font-size:26px;"><?php echo $row['venue'];?>  </h4>    
  </div>
  
  <div class="clr"></div>
  <div style="margin-left:0px;">
  <table width="900" height="170" border="1" cellpadding="0" cellspacing="0">
        <tr>
           <td width="350" align="center" valign="center"><strong>SUBJECTS</strong></td>
           <td width="200" align="center" valign="center"><strong>DAY</strong></td>
           <td width="175" height="26" align="center" valign="top"><strong>DATE</strong></td>
           <td width="175" height="26" align="center" valign="top"><strong>Timing</strong></td>

        </tr>
        <?php 
       $courses     =   $this->Examination_model->getDatesheetCourses($row['venue_id']);
        foreach($courses AS $row2){?>
          <tr>
              <td align="left" style="padding-left : 20px" valign="center"><?php echo  $row2['course_name'];?></td>
              <td align="left" style="padding-left : 20px" valign="center">&nbsp;</td>
              <td align="left" style="padding-left : 20px" valign="center">&nbsp;</td>
              <td align="left" style="padding-left : 20px" valign="center">&nbsp;</td>              
          </tr>
        <?php }?>
  
</table>

  </div>
  
  
    <div class="clr20"style="margin-bottom:25px;"></div>
  <p>
  <h1>Note: </h1>
  <div class="clr10" style="margin-bottom:15px;"></div>
  <h3>1. Keep this Slip carefully, bring during the Exam and show when required.</h3>
  <div class="clr10" style="margin-bottom:15px;"></div>
  <h3>  2. Unfair Means Case will be registered against the candidate who refuses
            to obey Center Superintendent / Invigilator.
  </h3>
  <div class="clr10" style="margin-bottom:15px;"></div>
  <h3>  3. Unfair Means Case will also be registered against the candidate who
        violates the instructions and Rules & Regulations.</h3>
  <div class="clr10" style="margin-bottom:15px;"></div>
  <h3>  4.  No one is allowed to leave the Examination Hall before half the time is over.</h3>
  <div class="clr10" style="margin-bottom:15px;"></div>
   <h3> 5. Candidates are also required to bring clipboards with them.</h3>
  <div class="clr10" style="margin-bottom:15px;"></div>
   <h3> 6.  Mobile Phones  are strictly prohibited in the Examination Hall.</h3>
 </p>
    
  <div class="clr20"></div>
  <div style="margin-top:50px;">
      <img src="<?php echo base_url();?>assets/images/prohibited.png" width="208" height="68" />
      <img style="margin-left: 470px" src="<?php echo base_url();?>assets/images/signature.png" width="150" height="75" />      
  </div>
  <div style="margin-top:0px;">      
      <h2 style="margin-left:80px; float:right;	">Additional Controller of Examinations</h2>  
  </div>

</div>
<div class="clr" style="margin-bottom:100px;"></div>
<!--Header ends here--> 
<!--wholemiddlearea starts from here-->

<!--footer ends here--> 
<!--</div>-->

<?php  } ?>

<script type="text/javascript">
        self.focus()
        self.print()
//        self.close()
</script>

</body>
</html>