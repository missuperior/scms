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
    <th  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 30px; text-align:left" width="70%" scope="col">Superior University Lahore</th>
  </tr>
</table>
    
<div style="clear:both;height:15px;"></div>


<table style="margin-left:400px; color:white; font-family: Arial; font-size: 16px; font-weight: normal" height="40" width="20%" border="2" cellspacing="0" cellpadding="0">
    <tr>
        <th width="25%" scope="col" bgcolor="#6B6565" >Subject Wise Result Report </th>
    </tr>
   
</table>

<div style="clear:both;height:20px;"></div>
    
<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">

<table  width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr style="height: 30px; color: white ">    
    <th width="10%" align="center" valign="middle" bgcolor="#6B6565" scope="col"> <?php  echo '  '.$students[0]['campus_name']; ?></th>
    <th width="15%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php  echo '  '.$students[0]['program_name']; ?></th>
    <th width="15%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php  echo '  '.$students[0]['course_name']; ?></th>
    <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php  echo '  '.$students[0]['batch_type'].' '.$students[0]['batch']; ?></th>
    <th width="15%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Semester &nbsp;&nbsp;</b> <?php  echo '  0'.$students[0]['semester']; ?></th>    
    <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Exam Type : &nbsp;&nbsp;</b> <?php  echo '  '.$exam_type; ?></th>
    
  </tr>
</table>




</div>


<div style="clear:both;height:10px;"></div>
<!--<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">-->

<table style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight:bold; color: #000;" width="100%" border="1" cellspacing="0" cellpadding="0">
  <THEAD>
    <tr style="color:white; font-size: 11px; height: 30px; line-height: 30px;">
<!--    <th width="3%" height="82" align="center" valign="top" bgcolor="#FFFFFF" scope="col">
        <h5><strong>SR</strong></h5>
        <h5><strong>No</strong></h5>
    </th>-->
      
    <th width="8%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        <strong>Roll No</strong>
    </th>
      
    <th width="13%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        <strong>Student Name</strong>
    </th>
    
    <th width="10%" align="center" valign="bottom" bgcolor="#4F4D4D" scope="col">
        <?php echo $structure->mid_title_1.'('.$structure->mid_value_1.')';?>
    </th>
    <th width="10%" align="center" valign="bottom" bgcolor="#4F4D4D" scope="col">
        <?php echo $structure->mid_title_2.'('.$structure->mid_value_2.')';?>
    </th>
    <th width="10%" align="center" valign="bottom" bgcolor="#4F4D4D" scope="col">
        <?php echo $structure->mid_title_3.'('.$structure->mid_value_3.')';?>
    </th>
       
    <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        Total (<?php echo $total;?>)
    </th>
    <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        % Age 
    </th>
    <th width="5%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        Grade
    </th>
    
  </tr>
      
</THEAD>

<tbody>
    <?php foreach($students as $row){ 
                                            
                                            $total_obtained   =   $row['mid_value_1'] + $row['mid_value_2'] + $row['mid_value_3'];                                            
                                            $percentage = $total_obtained/$total*100;
                                            
                                            if($percentage < 50){$grade = 'F';}
                                            if($percentage >= 50 && $percentage < 60){$grade = 'D';}
                                            if($percentage >= 60 && $percentage < 70){$grade = 'C';}
                                            if($percentage >= 70 && $percentage < 80){$grade = 'B';}
                                            if($percentage >= 80 ){$grade = 'A';}
                                            
    ?>
    
  <tr>
    <!--<td height="32" align="center" valign="middle"><?php echo $c+1; ?></td>-->
    
    <td align="center" valign="top"><?php echo $row['roll_no']; ?></td>
    
    <td align="left" valign="top" style="padding-left:10px"><?php echo $row['student_name']; ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo $row['mid_value_1']; ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo $row['mid_value_2']; ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo $row['mid_value_3']; ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo $total_obtained; ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo number_format("$percentage",2); ?></td>
    <td align="center" valign="top" style="padding-left:10px; font-size: 10px"><?php echo $grade; ?></td>
    
  </tr>
</tbody>
    <?php }?>

</table>



<table style="margin-top:50px; width: 100%">
    <tr style="height: 35px;">
        <td style=" width: 60%">Prepared By: ___________________________ </td>
        <td style=" width: 40%"></td>
    </tr>
    <tr style="height: 35px;" >
        <td style=" width: 60% ">Checked  By: ___________________________ </td>
        <td style=" width: 40%; padding-left: 35px;">Additional Controller Of Examination </td>
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
