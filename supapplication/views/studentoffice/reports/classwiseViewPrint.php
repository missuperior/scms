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
        <th width="25%" scope="col" bgcolor="#6B6565" >Class Result Summary  </th>
    </tr>
   
</table>

<div style="clear:both;height:20px;"></div>
    
<!--<div style="float:left; margin-left:50px;"><img src="<?php echo base_url();?>assets/images/logo1.png" width="150" height="150" /></div>
<div style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 40px; float: left; margin-left: 250px; margin-top: 20px; color: #000;" > <strong>Superior Group of Colleges</strong></div>
<div style="clear:both; height:5px;"></div>
<div style="text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 20px; margin-left: 550px; border: solid 1px; color: #000; width: 100%; margin: o auto; width: 400px;">Class Result Summary</div>
<div style="clear:both;height:30px;"></div>-->



<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">

<table  width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr style="height: 30px; color: white ">    
    <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"> <?php  echo '  '.$students[0]['campus_name']; ?></th>
    <th width="25%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php  echo '  '.$students[0]['program_name']; ?></th>
    <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php  echo '  '.$students[0]['batch_type'].' '.$students[0]['batch']; ?></th>
    <th width="15%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Semester &nbsp;&nbsp;</b> <?php  echo '  0'.$students[0]['semester']; ?></th>    
    <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Exam Type : &nbsp;&nbsp;</b> <?php  echo '  '.$exam_type; ?></th>
    
  </tr>
</table>




</div>


<div style="clear:both;height:10px;"></div>
<!--<div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">-->

<table style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: bold; color: #000;" width="100%" border="1" cellspacing="0" cellpadding="0">
  <THEAD>
    <tr style="color:white; font-size: 11px;">
<!--    <th width="3%" height="82" align="center" valign="top" bgcolor="#FFFFFF" scope="col">
        <h5><strong>SR</strong></h5>
        <h5><strong>No</strong></h5>
    </th>-->
      
    <th width="6%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        <strong>Roll No</strong>
    </th>
      
    <th width="15%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        <strong>Student Name</strong>
    </th>
    
    <?php 
        $student_id =   $students[0]['student_id'];
        $totall=0;
        $mid_marks = 0;
          for($i=0; $i < count($students); $i++)
          {
              if($student_id == $students[$i]['student_id']){
      ?>     
      
    <th width="10%" align="center" valign="bottom" bgcolor="#4F4D4D" scope="col">
        <?php
        
             if($exam_type == 'Mid'){
                                     $mid_marks   =  $this->Examination_model->getMidTotal($students[$i]['program_id'],$students[$i]['course_id']);        
            }
                                                
            $total_marks = $exam_type == 'Mid' ? $mid_marks : '100';
            $totall = $totall+$total_marks;
        ?>
        <p><strong><?php echo $students[$i]['course_name'];?></strong></p>
        <p><?php echo $total_marks.' ( '.$students[$i]['credit_hours'].' )';?></p>        
    </th>
      <?php }} ?>
        
   
    <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        <p>G.P.A</p>
    </th>
    <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        Obt.
    </th>
    <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        Total
    </th>
    <th width="5%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
        CGPA
    </th>
    
  </tr>
      
</THEAD>
    
    
  <?php 
        $id = 0;
//      for($kl=0; $kl<5; $kl++){
        for($c=0; $c < count($students); $c++){                                            
            if($id != $students[$c]['student_id']){
  ?>  
<tbody>
  <tr>
    <!--<td height="32" align="center" valign="middle"><?php echo $c+1; ?></td>-->
    
    <td align="center" valign="top"><?php echo $students[$c]['roll_no']; ?></td>
    
    <td align="left" valign="top" style="padding-left:10px"><?php echo $students[$c]['student_name']; ?></td>
    
    <?php 
            $totall_obtained = 0;
              $student_id =   $students[$c]['student_id'];
              $count = 0;
              $gpa = 0;
                for($i=$c; $i < count($students); $i++)
                {
                    if($student_id == $students[$i]['student_id']){
                        $count++;
    ?>   
    
    <td align="center" valign="top" style="font-size: 10px">
        <?php 
            if($exam_type == 'Mid'){ 
                $totall_obtained = $totall_obtained + $students[$i]['obtained'];                                                            
                echo $students[$i]['obtained'];    
                $res    = $this->Examination_model->calculateGpa($students[$i]['obtained'],$mid_marks,$exam_type);
                $gpa    =   $gpa + $res; 
            }else{ 
                $totall_obtained = $totall_obtained + $students[$i]['obtained1']+$students[$i]['obtained2'];   
                $res    = $this->Examination_model->calculateGpa($students[$i]['obtained1'],$students[$i]['obtained2'],$exam_type);
                $gpa    =   $gpa + $res; 
                echo $students[$i]['obtained1']+$students[$i]['obtained2'];                                                             
            }
        ?>
    </td>
    
    <?php } }
            $cgpa = $gpa/$count;
    ?>
        
    <td align="center" valign="top" style="font-size: 10px"><?php echo number_format("$cgpa",2);?></td>
    
    <td align="center" valign="top" style="font-size: 10px"><?php echo $totall_obtained;?></td>
    
    <td align="center" valign="top" style="font-size: 10px"><?php echo $totall;?></td>
    
    <td align="center" valign="top" style="font-size: 10px"><?php echo number_format("$cgpa",2);?></td>
    
  </tr>
</tbody>
    <?php } 
            $id = $students[$c]['student_id'];
}//}?>

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
