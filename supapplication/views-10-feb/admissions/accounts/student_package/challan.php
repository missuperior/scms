<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Superior University Lahore</title>
        <link href="<?php echo base_url();?>assets/css/challan.css" rel="stylesheet" type="text/css" />

        <script type="text/css">
                    .row{height: 30px; line-height: 30px;}
        </script>
        
        
        <style type="text/css">
             @media print{
              #ad{ display:none;}
              #leftbar{ display:none;}
              #contentarea{ width:100%;}

            }
        </style>

        
        
    </head>
    <body>
        
        <?php 
        $copy1 = 'Student Copy';
        $copy2 = 'Accounts Copy';
        $copy3 = 'Bank Copy';
        for($i=1; $i<4; $i++){?>
        
        <div id="wrapper" style="margin-top: 40px; height: 410px;">
            <div class="header">
                
                <div style="width:75px; height:100px; float: left; ">
                    <h1 style=" font-size: 30px; margin-left: 10px; margin-top: 30px;">HBL</h1>
                </div>
                
                <div style="width:150px; height: 100px; float: left; background-color: white;">
                    <img style="padding-top:10px; padding-left: 5px;" src="<?php echo base_url()?>assets/avatars/challan_logo.png" width="80" height="80" />
                </div>
                
                <div style="width:550px; height: 100px; float: left; background-color: white;">
                    <h1 style=" font-size: 28px; margin-left: 10px; ">
                        The Superior College, University Campus
                    </h1>
                    <p style="margin-left: 160px; margin-top: 10px;width: 200px;">A Govt. Chartered Institute</p>
                    <h4 style="margin-left: 160px; width: 200px;" >
                        Fee Invoice (<?php if($i==1){echo $copy1;} else if($i==2){echo $copy2;}else if($i==3){echo $copy3;}?>)
                    </h4>
                </div>
                
                <div style="width:135px; height:100px; float: left; ">
                    <p style="  font-size: 15px; margin-bottom: 0px; margin-top: 40px;"> <b> Dated: </b>  <?php echo date('M d, Y'); ?>                            </p>
                    <hr></hr>
                </div>
                
                
               
            </div>
            <div style="float:left; width:980px; height:160px;">
                <table width="980" border="1" cellpadding="0" cellspacing="0">
                    <tr style="height: 40px; line-height: 40px;">
                        <td colspan="5" style=" width:100%; font-weight:bold; font-size:18px;">
                            <p style="float:left; width:46%; text-align: left; margin-left: 15px; "><?php echo $challan['bank_name'].' '.$challan['bank_address'].' '.$challan['bank_city'].'.'; ?></p>
                            <p style="float:left; width:35%; text-align: left; ">A/C#:<?php echo ' '.$challan['account_no']; ?></p>
                            <p style="float:left; width:15%; text-align: left">Challan#: <?php echo ' '.$challan['challan_no']; ?></p>
                        </td>
                    </tr>
                    
                     <tr style="height: 40px; line-height: 40px;">
                        <td colspan="1" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Roll No:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px; "><?php echo $challan['roll_no']; ?></p></td>
                        <td colspan="1" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Name:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px; "><?php echo $challan['student_name']; ?></p></td>
                        <td colspan="3" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Program:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px;"><?php echo $challan['program_name']; ?></p></td>
                    </tr>
                    
                    <tr style="height: 40px; line-height: 40px;">
                        <td colspan="1" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Batch:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px; "><?php echo $challan['batch']; ?></p></td>
                        <td colspan="1" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Session:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px; "><?php echo $challan['session']; ?></p></td>
                        <td colspan="3" style="font-weight:bold; font-size:18px;"><p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Due Date:</p><p style="font-weight:normal; margin-left:30px; float:left; font-size:18px; "><?php echo(date("d- M- Y",strtotime($challan['due_date'])));  ?></p></td>
                    </tr>
                    
                     <tr style="height: 40px; line-height: 40px;">
                         <td colspan="5" style="font-weight:bold; font-size:18px;">
                             <p style="font-weight:bold; float:left; margin-left:12px; font-size:18px;">Amount:</p>
                             <p style="font-weight:normal; margin-left:10px; float:left; font-size:18px; ">
                                 <b style="margin-right: 20px"><?php echo $challan['amount'].' '; ?> </b>
                                 <?php echo ' '.$challan['amount_in_words'].' Only.'; ?>
                             </p>
                         </td>
                    </tr>
                    
                </table>
            </div>
            <div style="width:750px; float:left; margin-top:12px;">
                <p style="width:750px; font-size:18px;">Note: Rs 50/- per day will be charged as fine, after the due date. If fees shall not be deposited within 15 days, student should be struck off from the college roll. Fee once received is Non-refundable & Non-transferable</p></div>
            <div style="width:160px; float:left; margin-top:12px;  ">
                <table width="230" height="70px" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <?php if($challan['status'] == 0){?>
                        <td colspan="5" style="font-size:18px; text-align:center;">&nbsp;&nbsp;&nbsp;Bank Stamp & Signature</td>
                        <?php }else{?>
                        <td colspan="5" style="font-size:30px; font-weight:bold; text-align:center;">&nbsp;&nbsp;&nbsp;PAID <p style="font-size:18px; font-weight:normal; text-align:center;"><b>Dated : </b> <?php echo(date("d-M-Y",strtotime($challan['post_date']))); ?></p></td>
                        </tr><?php } ?>
                </table>   
            </div>
            <div style="width:980px; height:30px; margin-bottom: 40px; text-align:center; float:left;">
                <p style="font-size:22px; font-weight:bold;">Powered By: Superior Solutionz</p>
            </div>    
            
            <?php if($i != '3'){?>
            <p>----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
            <?php } ?>

        </div>
        
        
        <?php } ?>
  
           <script type="text/javascript">

self.focus()
self.print()
self.close()
</script>
        
        
        
    </body>
    
    
 
    
</html>    
