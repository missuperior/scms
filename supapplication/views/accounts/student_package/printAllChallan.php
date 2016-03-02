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
    
    <?php 
    ini_set('max_execution_time', 3000); //300 seconds = 50 minutes
    foreach ($challans as $row => $j) { ?>

        <?php 
        $copy1 = 'Student Copy';
        $copy2 = 'Accounts Copy';
        $copy3 = 'Bank Copy';
        for($i=1; $i<4; $i++){ ?>
        
        <div id="wrapper" style="margin-top: 12px; height: 410px;">
            <div class="header">
                
                
                     <?php if($j['program_name'] == 'MBBS'){ ?>                    
                            <div style="width:100px; height:100px; float: left; ">
                                    <img style="padding-top:10px; padding-left: 5px;" src="<?php echo base_url()?>assets/avatars/bank_logo.jpg" width="80" height="80" />
                            </div>
                                    
                    <?php }else{
                                if(strlen($j['bank_name']) > 6){?>
                            <div style="width:130px; height:100px; float: left; ">
                                    <h1 style=" font-size: 15px; margin-left: 10px; margin-top: 30px;"><?php echo $j['bank_name']; ?></h1>
                            </div>
                            <?php }else{?>
                            <div style="width:130px; height:100px; float: left; ">
                                    <h1 style=" font-size: 30px; margin-left: 10px; margin-top: 30px;"><?php echo $j['bank_name']; ?></h1>
                            </div>
                    <?php }}?>
                
                
                <div style="width:140px; height: 100px; float: left; background-color: white;">
                    <img style="padding-top:10px; padding-left: 5px;" src="<?php echo base_url()?>assets/avatars/challan.png" width="80" height="80" />
                </div>
                
               <div style="width:550px; height: 100px; float: left; background-color: white;">
                   <h1 style=" font-size: 28px; margin-left: 10px; text-align: center "><?php echo $j['challan_title']?></h1>
                    
                    <p style="margin-left: 160px; margin-top: 10px;width: 200px;">A Govt. Chartered Institute</p>
                    <h4 style="margin-left: 160px; width: 200px;" >
                        Fee Invoice (<?php if($i==1){echo $copy1;} else if($i==2){echo $copy2;}else if($i==3){echo $copy3;}?>)
                    </h4>
                </div>
                
                <div style="width:145px; height:100px; float: left; ">
                    <p style="  font-size: 15px; margin-bottom: 0px; margin-top: 40px;"> <b> Dated: </b>  <?php echo date('d- M- Y'); ?></p>
                    <hr></hr>
                </div>
                
            </div>
            <div style="float:left; width:980px; height:160px;">
                <table width="980" border="1" cellpadding="0"  cellspacing="0">
                    <tr style="height: 40px; line-height: 40px;">
                        <td colspan="5" style=" width:100%; font-weight:bold; font-size:15px;">                            
                            <p style="float:left; width:46%; text-align: left; margin-left: 15px; "><?php if($j['program_name'] == 'MBBS'){echo 'Bank Al-Habib Ltd. Main Branch, Lahore';}else{  echo $j['bank_address'].' '.$j['city_name'].'.';} ?></p>
                            <p style="float:left; width:35%; text-align: left; ">A/C#:<?php  if($j['program_name'] == 'MBBS'){echo ' 0002-0081-079384-02-1';}else{   echo ' '.$j['account_no'];} ?></p>
                            <p style="float:left; width:15%; text-align: left">Challan#: <?php echo ' '.$j['challan_id']; ?></p>
                        </td>
                    </tr>
                    
                     <tr style="height: 40px; line-height: 40px;">
                        <td colspan="1" style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Form No:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px; "><?php echo $j['form_no']; ?></p></td>
                        <td colspan="1" style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Name:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px; "><?php echo $j['student_name']; ?></p></td>
                        <td colspan="3" style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Program:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px;"><?php echo $j['program_name']; ?></p></td>
                    </tr>
                    <?php
                        if($j['campaign_id'] == 1 && $j['session'] == 'Spring 2015'){
                            $session     =   'Semester 2';
                        }elseif($j['campaign_id'] == 1 && $j['session'] == 'Fall 2015'){
                            $session     =   'Semester 3';
                        }elseif($j['campaign_id'] == 1 && $j['session'] == 'Spring 2016'){
                            $session     =   'Semester 4';
                        }elseif($j['campaign_id'] == 1 && $j['session'] == 'Fall 2016'){
                            $session     =   'Semester 5';
                        }
                        
                        elseif($j['campaign_id'] == 2 && $j['session'] == 'Fall 2015'){
                            $session     =   'Semester 2';
                        }elseif($j['campaign_id'] == 2 && $j['session'] == 'Spring 2016'){
                            $session     =   'Semester 3';
                        }elseif($j['campaign_id'] == 2 && $j['session'] == 'Fall 2016'){
                            $session     =   'Semester 4';
                        }
                        
                        elseif($j['campaign_id'] == 3 && $j['session'] == 'Spring 2016'){
                            $session     =   'Semester 2';
                        }elseif($j['campaign_id'] == 3 && $j['session'] == 'Fall 2016'){
                            $session     =   'Semester 3';
                        }
                        
                        elseif($j['campaign_id'] == 5 && $j['session'] == 'Fall 2016'){
                            $session     =   'Semester 2';
                        }
                        
                        else{
                            $session     =   'Semester 1';
                        }
                    ?>
                    <tr style="height: 40px; line-height: 40px;">
                        <td style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Roll No:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px; "><?php echo $j['roll_no']; ?></p></td>
                        <td style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Session:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px; "><?php echo $session; ?></p></td>
                        <td colspan="3" style="font-weight:bold; font-size:15px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Due Date:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:15px; "><?php echo(date("d- M- Y",strtotime($j['due_date'])));  ?></p></td>
                    </tr>
                    
                    <tr style="height: 40px; line-height: 40px;">
                         <td colspan="5" style="font-weight:bold; font-size:15px;">
                             <p style="font-weight:bold; float:left; margin-left:12px; font-size:15px;">Amount:</p>
                             <p style="font-weight:normal; margin-left:10px; float:left; font-size:15px; ">
                                 <b style="margin-right: 20px"><?php echo number_format($j['payable']).' '; ?> </b>
                                 <?php echo $amount_in_word[$row].' Only.'; ?>
                             </p>
                         </td>
                    </tr>
                                       
                </table>
              
              <?php 
              if(count($installments[$row]) > 0){
                  
              if ($installments[$row][0]['challan_id'] != $j['challan_id']) {
              ?>
              <p style="font-weight:bold; float:left; width: 100%; text-decoration: underline; font-size:15px; margin-bottom: 5px; margin-top: 5px;">Upcoming Installments</p>
              <?php }?>
              <?php 
              $k=1;
              foreach($installments[$row] as  $roww) {
                 // var_dump($roww);die;
                 // echo '<pre>';var_dump($installments[$row]);die;
                  if ($roww['challan_id'] != $j['challan_id']) {
              ?>
                <p style="font-weight:bold; float:left; margin-left:12px; font-size:15px; margin: 3px;"><?php echo $k.'. ';?>Amount:</p>
                <p style="font-weight:bold; float:left; margin-left:12px; font-size:15px; margin: 3px;"><?php echo number_format($roww['payable']); ?> | </p>
                <p style="font-weight:bold; float:left; margin-left:12px; font-size:15px; margin: 3px;">Due Date:</p>
                <p style="font-weight:bold; float:left; margin-left:12px; font-size:15px; margin: 3px; margin-right: 60px;"><?php echo date('d-M-y', strtotime($roww['due_date'])); ?></p>

                <?php }
                $k++; }
              } ?>
              
            </div>
          
            <div style="width:750px; float:left; margin-top:80px; margin-bottom: 5px;">
                <?php if($challan['program_name'] == 'MBBS'){?>
                    <p style="width:750px; font-size:15px;">Note: Rs 1000/- per day will be charged as fine, after the due date. If fees shall not be deposited within 07 days, student should be struck off from the college roll and will be charged Re-admission Fee. Fee once received is Non-refundable & Non-transferable</p>
                <?php }else{?>
                    <p style="width:750px; font-size:15px;">Note: Rs 100/- per day will be charged as fine, after the due date. If fees shall not be deposited within 07 days, student should be struck off from the college roll. Fee once received is Non-refundable & Non-transferable</p>
                <?php } ?>    
            </div>   
            <div style="width:160px; float:left; margin-top:65px;">
                <table width="225" height="70px" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <?php if($i['status'] == 0){?>
                        <td colspan="5" style="font-size:15px; text-align:center;">&nbsp;&nbsp;&nbsp;Bank Stamp & Signature</td>
                        <?php }else{?>
                        <td colspan="5" style="font-size:30px; font-weight:bold; text-align:center;">&nbsp;&nbsp;&nbsp;PAID <p style="font-size:15px; font-weight:normal; text-align:center;"><b>Dated : </b> <?php echo(date("d-M-Y",strtotime($j['post_date']))); ?></p></td>
                    </tr><?php } ?>
                </table>   
            </div>
        </div>  
      
                   
        <?php } ?>
        <div class="footer"></div>
      <?php   } ?>             
              
<script type="text/javascript">
  self.focus()
  self.print()
</script>
            
    </body>
    </html>  