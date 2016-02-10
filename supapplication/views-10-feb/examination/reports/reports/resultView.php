<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
        <link href="<?php echo base_url();?>assets/css/challan.css" rel="stylesheet" type="text/css" />

        <style type="text/css">
                    .row{
                    height: 30px; 
                    line-height: 30px;
                    }
                    
                    @media print {
                      .footer {page-break-after: always;}
                    }
                    h5{
                      font-weight: bold;
                      margin: 0;
                    }
                    .navbar{
                      display: none;
                    }
                    table, tr, td{
                      border-color: #000 !important;
                    }
        </style>                
    </head>
  <body>
    <?php if(count($student_result) > 0 ){?>
    <?php $std_id = 0; 
    foreach ($student_result as $row){
      if($row['student_id'] != $std_id){?>
        
        <div id="wrapper" style="margin-top: 12px; height: 410px; margin-bottom: 200px;">
            <div class="header">
              
                <div style="width:115px; height: 100px; float: left; background-color: white;">
                    <img style="padding-top:10px; margin-top: -20px; padding-left: 5px;" src="<?php echo base_url()?>assets/avatars/challan_logo.png" width="80" height="80" />
                </div>
                
                <div style="width:750px; height: 100px; float: left; background-color: white;">
                    <h1 style=" font-size: 28px; margin-left: 150px;">The Superior College, <?php echo $row['campus_name']; ?></h1>                  
                </div>
                
            </div>
            <div style="float:left; width:980px; height:160px;">
                    <pre style="margin: 0 auto; width: 170px; margin-bottom: 70px; text-align: center; font-weight: bold;">Result Intimation</pre>
              
              <h5>Dear Parents / Guardians</h5><br/>
              <p style="background: none; border: none; padding-bottom: 10px;">This letter is being forwarded to inform you about your child's progress in studies. We shall appreciate any opinion from you concerning 
the overall betterment of your child.</p>
              
                <table width="980" border="2" cellpadding="0"  cellspacing="10" class="table table-striped table-bordered table-hover">
                  <tr>
                    <td><h5>Roll No:</h5></td>
                    <td><?php echo $row['roll_no']; ?></td>
                    <td><h5>Program:</h5></td>
                    <td><?php echo $row['program_name']; ?></td>
                  </tr>
                  <tr>
                    <td><h5>Name:</h5></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><h5>Session:</h5></td>
                    <td><?php echo $row['campaign_name']; ?></td>
                  </tr>
                  <tr>
                    <td><h5>Father Name:</h5></td>
                    <td><?php echo $row['father_name']; ?></td>
                    <td><h5>Section</h5></td>
                    <td><?php echo $row['section']; ?></td>
                  </tr>
                  <tr>
                    <td rowspan="2"><h5>Address:</h5></td>
                    <td rowspan="2"><?php echo $row['present_address']; ?></td>
                    <td><h5>Part</h5></td>
                    <td><?php echo $row['part']; ?></td>
                  </tr>
                  <tr>
                    <td><h5>Exam:</h5></td>
                    <td><?php echo $row['exam_type']; ?></td>
                  </tr>
                                                    
                </table>
                  
              <table width="980" border="2" cellpadding="10" cellspacing="0" style="margin-top: 60px;" class="table table-striped table-bordered table-hover">
                  
                  <tr>
                    <td><h5>Subject</h5></td>
                    <td><h5>Obtained Marks</h5></td>
                    <td><h5>Total Marks</h5></td>
                    <td><h5>%age</h5></td>
                  </tr>
                  
                  <?php $obt = 0; $total = 0; 
                  foreach($student_result as $v){
                    if($row['student_id'] == $v['student_id']){                     
                  ?>
                    <tr>
                      <td><?php echo $v['subject_name']; ?></td>
                      <td><?php echo $v['obtained_marks']; 
                      $obt = $obt + $v['obtained_marks'];
                      ?></td>
                      <td><?php echo $v['total_marks']; 
                      $total = $total + $v['total_marks'];
                      ?></td>
                      <td><?php echo number_format($v['obtained_marks']/$v['total_marks']*100).' %'; ?></td>
                    </tr>
                  <?php }} ?>
                             
                <tr>
                  <td></td>
                  <td><h5><?php echo $obt; ?></h5></td>
                  <td><h5><?php echo $total; ?></h5></td>
                  <td><h5><?php echo number_format($obt/$total*100).' %'; ?></h5></td>
                </tr>                
              </table>
              
              <div style="float: right; margin-top: 100px; font-weight: bold;">                                                
                <hr style="height:1px; border:none; color:#333; background-color:#333;" />
                <?php echo ucwords($row['controller_name']); ?><br/>
                Controller of Examination
              </div>             
                 
            </div>         
            
        </div>  
      
    <div class="footer"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>
      <?php }$std_id = $row['student_id']; } ?>    
      <?php } else { ?>
        <div class="table-header">
          <h3>Record Not Found</h3>
        </div>
      <?php } ?>
                  
<!--<script type="text/javascript">
  self.focus()
  self.print()
  self.close()
</script>-->
            
    </body>
    </html>  