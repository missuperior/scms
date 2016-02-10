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
          <div style="width:400px; height: 100px; float: left; background-color: white; line-height: 100px">
            <h1 style=" font-size: 28px; margin-left: 10px; ">The Superior University Lahore</h1>            
          </div>
          
            <div style="float:left; width:700px; height:160px;">
                <table width="700" border="1" cellpadding="0"  cellspacing="0">
                  <h3 style="font-size: 30px; font-weight: bold; width: 500px; margin-top: 10px; margin-bottom: 10px;  padding: 10px;">
                    STUDENT INFO
                  </h3>  
                    
                                       
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px; font-size:20px">Name</span></th>
                      <td><span style="margin-left: 20px;">
                         <?php echo $info[0]['student_name'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px; font-size:20px">Roll No</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $info[0]['roll_no'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px; font-size:20px">Program</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $info[0]['program_name'];?>
                         </span>
                       </td>
                     </tr>
                  
                     <tr style="height: 40px; line-height: 40px; text-align: left;">                
                      <th><span style="margin-left: 20px; font-size:20px">Session</span></th>
                       <td><span style="margin-left: 20px;">
                         <?php echo $info[0]['session'];?>
                         </span>
                       </td>
                     </tr>
                  
                         
                </table>
              
              <h4 style="width: 500px; margin-top: 30px; margin-bottom: 10px; font-size: 30px; font-weight: bold; padding: 10px;">
                  REGISTERED COURSES
              </h4>
              
              <?php 
                if(count($info) > 0){
                ?> 

                <table width="700" border="1" cellpadding="4"  cellspacing="0">
                    <tr style="height: 40px; line-height: 40px; text-align: left; text-align: center;">
                        <th style="font-size:20px">#</th>         
                        <th style="font-size:20px">Course Name</th>
                        <th style="font-size:20px">Course Fee</th>

                    </tr>
                  
                  <?php 
                  $total_amount = 0;
                  foreach($info as $k => $row){ 
                        
                      ?>
                    <tr style="height: 40px; line-height: 40px; text-align: left; text-align: center;"> 
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td>
                            <?php 
                                $result   =   $this->Accounts_model->getResult($row['course_id'],$row['student_id'],$row['current_session_id']); 
                                if($result > 0){
                                    echo $original_fpc;
                                    $total_amount = $total_amount + $original_fpc;
                                }else{
                                    echo $discounted_fpc;
                                    $total_amount = $total_amount + $discounted_fpc;
                                }

                            ?>
                        </td>
                    </tr>
                  <?php } ?>
                    
                    <tr style="height:50px;">                                                                                        
                      <td style="text-align: center" colspan="2"><b style="font-size:20px">Total</b> </td>                                               
                        <td style="text-align: center"><b style="font-size:20px"><?php echo $total_amount; ?></b></td>                                                
                   </tr>
               
                </table>

                <?php }?>
              
                <br> 
                <br>
                <h4>Printed By: <?php
                    if ($this->session->userdata('sub_login')) {
                        echo ucfirst($this->session->userdata('sub_login'));
                    } else {
                        echo ucfirst($this->session->userdata('username'));
                    }
                    ?>
                    
                    <b style="margin-left: 250px;">Generated From: </b> <a href="http://scmsuperior.com"> http://scmsuperior.com </a>
                    
                </h4>
                    
              
            </div>

        </div>  
                
              
<script type="text/javascript">
  self.focus()
  self.print()
//  self.close()
</script>
            
    </body>
    </html>  