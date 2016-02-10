<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<style tyle="text/css">
  #header {
  display: table-header-group;
}
</style>    
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>



<?php if(count($students) > 0 ){?>
    
    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="30%" scope="col"><img src="<?php echo base_url();?>assets/images/logo.png" width="100" height="100" /></th>
    <th  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 30px; text-align:left" width="100%" scope="col">Superior University</th>
  </tr>
  
</table>
    
<div style="clear:both;height:15px;"></div>


<table style="margin-left:230px; color:white; font-family: Arial; font-size: 14px; font-weight: normal" height="30" width="25%" border="2" cellspacing="0" cellpadding="0">
    <tr>
        <th width="25%" scope="col" bgcolor="#6B6565" >ATTENDANCE SHEET </th>
    </tr>
   
</table>

<div style="clear:both;height:20px;"></div>
    
<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">

<table  width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <tr style="height: 30px;">       
        <th width="35%" align="left" valign="middle" scope="col"><b>Program :</b><?php  echo '  '.$students[0]['program_name']; ?></th>    
        <th width="35%" align="left" valign="middle"  scope="col"><?php  echo '  '.$students[0]['batch_type'].' '.$students[0]['batch']; ?></th>    
        <th width="30%" align="left" valign="middle"  scope="col"><b>Dated: </b>____________________</th>        
    </tr>
    
    <tr style="height: 30px;">       
      <th width="35%" align="left" valign="middle" scope="col"><b> <?php echo $students[0]['shift'];?></b></th>         
     <th width="35%" align="left" valign="middle"  scope="col"><b>Exam : </b>____________________</th>    
     <th width="30%" align="left" valign="middle"  scope="col"><b>Subject : </b>____________________</th>        
    </tr>
    
</table>




</div>


<div style="clear:both;height:10px;"></div>
<!--<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">-->

<table style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight:bold; color: #000;" width="100%" border="1" cellspacing="0" cellpadding="0">
  <THEAD>
    <tr style="color:white; font-size: 12px; height: 30px; line-height: 30px;">
     
    <th width="10%" align="center"  bgcolor="#4F4D4D" scope="col">
        <strong>Sr No</strong>
    </th>
      
    <th width="15%" align="center" bgcolor="#4F4D4D" scope="col">
        <strong>Roll No</strong>
    </th>
      
    <th width="20%" align="center" bgcolor="#4F4D4D" scope="col">
        <strong>Student Name</strong>
    </th>
    
    <th width="20%" align="center" bgcolor="#4F4D4D" scope="col">
        Sheet #
    </th>
    <th width="20%" align="center" bgcolor="#4F4D4D" scope="col">
        Continuation Sheet
    </th>
    <th width="15%" align="center" bgcolor="#4F4D4D" scope="col">
        Signature
    </th>
        
  </tr>
      
</THEAD>

<tbody>
    <?php
    $i=1;
    foreach($students as $row){ ?>
    
  <tr>
    <td height="32" align="center" valign="middle"><?php echo $i; ?></td>
    
    <td align="center" valign="center"><?php echo $row['roll_no']; ?></td>
    
    <td align="left" valign="center" style="padding-left:10px"><?php echo $row['student_name']; ?></td>
    <td align="center" valign="center" style="padding-left:10px; font-size: 10px"></td>
    <td align="center" valign="center" style="padding-left:10px; font-size: 10px"></td>
    <td align="center" valign="center" style="padding-left:10px; font-size: 10px"></td>
    
  </tr>
</tbody>
    <?php $i++;}?>

</table>



<table style="margin-top:50px; width: 100%">
    <tr style="height: 35px;">
        <td style=" width: 60%">Invigilator : ___________________________ </td>
        <td style=" text-align: center;  width: 20%; border: 1px solid "><b>Students Present</b></td>
        <td style=" width: 20%; border: 1px solid "></td>
    </tr>
    <tr style="height: 35px;" >
        <td style=" width: 60% ">Signature : ___________________________ </td>
        <td style=" text-align: center;  width: 20%; border: 1px solid "><b>Students Absent</b></td>
        <td style=" width: 20%; border: 1px solid "></td>
    </tr>
    <tr style="height: 35px;" >
        <td style=" width: 60% "></td>
        <td style=" text-align: center; width: 20%; border: 1px solid "><b>Total Students</b></td>
        <td style=" width: 20%; border: 1px solid "></td>
    </tr>
</table>

<!--</div>-->




<!--</div>-->


<?php }else{?>

            <div style="float:left; margin-left:50px;"><img src="<?php echo base_url();?>assets/images/colg_logo.png" width="150" height="150" /></div>
            <div style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 50px; float: left; margin-left: 250px; margin-top: 20px; color: #000;" > <strong>Superior Group of Colleges</strong></div>
            <div style="clear:both; height:5px;"></div>
            <div style="text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 20px; margin-left: 550px; border: solid 1px; color: #000; width: 100%; margin: o auto; width: 400px;">Result Not Found</div>
            <div style="clear:both;height:30px;"></div>  

<?php }?>


<script type="text/javascript">

self.focus()
self.print()
//self.close()
</script>


</body>
</html>
