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
        </style>
                
    </head>
  <body>
        
        <div id="wrapper" style="margin-top: 12px; height: 410px; width: 750px">
          
          <div style="width:100px; height: 100px; float: left; background-color: white; margin-left: 100px;">
            <img style="padding-top:10px; padding-left: 5px;" src="<?php echo base_url()?>assets/avatars/challan_logo2.png" width="80" height="80" />
          </div>
          <div style="width:400px; height: 100px; float: left; background-color: white;">
            <h1 style=" font-size: 28px; margin-left: 10px; ">The Superior University Lahore</h1>            
          </div>
          
            <div style="float:left; width:700px; height:160px;">
                <table width="700" border="1" cellpadding="0"  cellspacing="0">
                  <h3 style="font-size: 30px; font-weight: bold; width: 500px; margin-top: 10px; margin-bottom: 10px;  padding: 10px;">
                    STUDENT CURRENT STATUS                    
                  </h3>  
                    
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                       <th><span style="margin-left: 20px;">Status</th>
                       <td>
                           <span style="margin-left: 20px;">
                                <?php if($std_package[0]['status'] == 'ok'){echo 'Active';}else{ echo $std_package[0]['status'];}?>
                           </span>
                       </td>
                       
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Name</span></th>
                      <td><span style="margin-left: 20px;">
                         <?php echo $std_package[0]['student_name'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Roll #</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $std_package[0]['roll_no'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Program</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $std_package[0]['program_name'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Session</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $std_package[0]['session'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Admission Fee</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo number_format($std_package[0]['admission_fee']);?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Misc Fee</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo number_format($std_package[0]['misc_fee']);?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Session Fee</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo number_format($std_package[0]['session_fee']);?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px;">Session Package</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo number_format($std_package[0]['session_total_package']);?>
                         </span>
                       </td>
                     </tr>                  
                </table>
              
              <h4 style="width: 80px; margin-top: 30px; margin-bottom: 10px; font-size: 30px; font-weight: bold; padding: 10px;">
                  INSTALLMENTS
              </h4>
              
              <?php 
                if(count($std_installments) > 0){
                ?> 

                <table width="700" border="1" cellpadding="4"  cellspacing="0">
                    <tr style="height: 40px; line-height: 40px; text-align: left; text-align: center;">
                        <th>#</th>         
                        <th>Amount</th>
                        <th>Session</th>
                        <th>Due Date</th>                                            
                        <th>Status</th>  

                    </tr>
                  
                  <?php foreach($std_installments as $k => $row){ ?>
                    <tr style="height: 40px; line-height: 40px; text-align: left; text-align: center;"> 
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo number_format($row['payable']); ?></td>
                        <td><?php echo $row['session']; ?></td>
                        <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                        <td>
                        <?php if($row['status'] == 0){ echo 'Unpaid'; ?> 
                        <?php }else{ echo 'Paid'; } ?>
                        </td>
                    </tr>
                  <?php } ?>
               
                </table>

                <?php }?>
                
                <div style="width: 700px; margin-top: 15px;  "> 
                    <label style="float: left"><b>Remarks : </b></label>
                    <p style="float: left; margin-left: 20px;"><?php echo $std_package[0]['remarks'];?></p>
                </div>
                <br> 
                <br>
                <h4>Printed By: <?php
                    if ($this->session->userdata('sub_login')) {
                        echo ucfirst($this->session->userdata('sub_login'));
                    } else {
                        echo ucfirst($this->session->userdata('username'));
                    }
                    ?>
                </h4>
              
            </div>

        </div>  
                
              
<script type="text/javascript">
  self.focus()
  self.print()
  self.close()
</script>
            
    </body>
    </html>  