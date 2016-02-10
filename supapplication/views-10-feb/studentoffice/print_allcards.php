<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Superior University Lahore</title>
        <link href="<?php echo base_url(); ?>assets/css/registration_card.css" rel="stylesheet" type="text/css" />
        
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
    $check = 4;
    foreach($stdinfo AS $key => $row){
        $i = $key + 1;
        if($i == $check){
        ?>
        <div id="container" style="margin-top: 200px; margin-bottom: 50px;">
        <?php 
        $check = $check + 3; 
        } else{?>    
        <div id="container" style="margin-top: 50px; " >
        <?php }?>
            <!--Header starts from here-->
            <div id="header">
                <div id="leftportionofheader">
                    <img src="<?php echo base_url();?>assets/images/lgo.png"  />	
                </div>
                <div id="middleportionofheader">

                </div>
                <div id="rightportionofheader">
                    <div id="maincontentofheader">
                        <p>THE SUPERIOR UNIVERSITY LAHORE</p>
                    </div>
                    <div id="divider">
                        <img src="<?php echo base_url(); ?>assets/images/dividingbarinheader.png" />
                    </div>
                    <div id="bottomcontentofheader">
                        <p>STUDENT CARD</p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <!--Header ends here-->
            <!--wholemiddlearea starts from here-->
            <div id="wholemiddlearea">
                <div id="leftareaofwholemiddlearea">
                    <p class="texttypeone">This is to certify that</p>
                    <div class="clr"></div>
                    <div class="labelandinput">
                        <label class="texttypetwo">Mr/Miss</label><div class="border_bottom"><input type="text" value="<?php echo $row['student_name']; ?>" style="width:220px; margin-left: 20px; border:none; margin-top:4px; height:16px; background-color:transparent;" /></div>
                    </div>
                    <div class="clr"></div>
                    <div class="labelandinput">
                        <label class="texttypetwo">Father name</label><div class="border_bottom"><input type="text" value="<?php echo $row['father_name']; ?>" style="width:196px; margin-left: 20px; margin-top:4px; height:16px; background-color:transparent; border:none;" /></div>
                    </div>
                    <div class="clr"></div>
                    <p class="texttypeone" >has been registered as a student of</p>
                    <div class="clr"></div>
                    <p class="texttypeone">THE SUPERIOR UNIVERSITY, LAHORE</p>
                    <div class="clr"></div>
                    <div class="labelandinput">
                        <label class="texttypetwo">Program</label>
                        <div class="border_bottom">
                           <?php if(strlen($row['program_name']) < 30 ){?> 
                            <input type="text" value="<?php echo $row['program_name']; ?>"  style="width:215px; margin-left: 20px; margin-top:4px; height:16px; background-color:transparent; border:none;" />
                           <?php }else{?>
                            <input type="text" value="<?php echo $row['program_name']; ?>"  style="font-size: 10px; width:235px; margin-left: 10px; margin-top:4px; height:16px; background-color:transparent; border:none;" />
                           <?php } ?>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="labelandinput">
                        <label class="texttypeone">His/Her Roll No number is</label><div class="border_bottom"><input type="text" value="<?php echo $row['roll_no']; ?>" style="width:135px; height:16px; background-color:transparent; margin-top:4px; border:none;" /></div>
                    </div>
                    <div class="clr"></div>                       
                </div>
                <div id="rightareaofwholemiddlearea">
                    <div id="picture_area">
                        <img style="border-radius:15px" width="130px" height="150" src="<?php echo base_url();?>assets/images/tariq.JPG"/>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <!--wholemiddlearea ends here-->
            <!--footer starts from here-->
            <div id="footer">
                <div id="leftareaoffooter">
                    <div class="labelandinput">
<!--                        <label class="texttypeone">Dated:</label><div class="border_bottom"><input type="text" value="<?php echo '11-Nov-2014';?>" style="width:90px; background-color:transparent; border-bottom:2px solid #000; margin-left:3px; border:none; margin-top:4px; height:11px;" /></div>					-->
                        <label class="texttypeone">Dated:</label><div class="border_bottom"><input type="text" value="<?php echo date('d-M-Y',  strtotime($row['form_submit_date']));?>" style="width:90px; background-color:transparent; border-bottom:2px solid #000; margin-left:3px; border:none; margin-top:4px; height:11px;" /></div>					
                    </div>
                    <div class="clr"></div>
                    <p class="texttypethree">
                        Candidates should keep this card carefully. A fee of Rs.500 is charged for duplicate Registration card.
                    </p>        
                </div>
                <div id="rightareaoffooter">
                    <p class="texttypefour">Registrar</p>
                </div>

            </div>
            <div class="clr"></div>
            <!--footer ends here-->
        </div>  
    <?php  } ?>
     
        <!--</div>-->
        
        
               <script type="text/javascript">
                    self.focus()
                    self.print()
                    //self.close()
                </script>
        
        
 </body>
</html>