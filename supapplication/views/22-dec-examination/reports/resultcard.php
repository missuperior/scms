<html>
<head>
    <style>
        .table{font-size: 9px;}
        
        
        @media print{
         #ad{ display:none;}
         #leftbar{ display:none;}
         #contentarea{ width:100%;}
        }
        
    </style>
</head>
<?php if($print_type == 1){ ?>
<body style="font-size: 12px; font-family: Arial; margin-top: 150px; margin-left: 70px;">
<?php }else{?>
<body style="font-size: 12px; font-family: Arial; margin-top: 50px;">
<?php }?>
    
<?php if($print_type == 0){?>   
<div style=" width:85%; float:left; margin-bottom: 30px; "  >    
    <div style=" width:25%;  float: left; text-align: center  "><img src="<?php echo base_url();?>assets/images/logo1.png" width="120" height="120" /></div>                      
    <div style=" width:70%;  float: left; margin-left: 5%  "><h1 style="margin-top: 40px; margin-left: 20px; font-weight: bold ">Superior Group Of Colleges</h1></div>                          
</div>
<?php }?>
    
<div style=" width:85%; float:left; "  >
    
    <!--<div style=" width:65%;  float: left;  "><p style="text-align: right; font-size: 16px; margin:0px"><b style="text-decoration: underline;">TO WHOM IT MAY CONCERN</b></p></div>-->                      
    <div style=" width:30%;  float: left; margin-left: 0%  "><p style="text-align: left; font-size: 12px; margin:0px"><b>Ref : </b>   _________________</p></div>                      
    
</div>   
    
<div style=" width:85%; float:left; margin-bottom: 30px;"  >
    <div>               
        <div style=" width:100%;  float: left;  "><p style="text-align: left; font-size: 12px;"><b>Dated : </b>____________________</p></div>        
    </div>
</div>   
 
    <div style="width:100%; float:  left;">
        
        
        <label style="float: left; text-align: left; width:20%; font-size: 12px; font-weight: bold;">Roll No : </label>
        <h3 style="float: left; text-align: left;   font-size: 11px;    margin: 0;    width: 80%; margin-bottom: 10px;  font-weight: normal;"><?php echo $info[0]['roll_no'];?></h3>
        
        <label style="float: left; width:20%; font-size: 12px; font-weight: bold;">Name : </label>
        <h3 style="float: left;    font-size: 11px;    margin: 0;    width: 30%; font-weight: normal;"><?php echo $info[0]['student_name'];?></h3>
        
        
        <label style="float: left; text-align: left; width:22%; font-size: 12px; font-weight: bold;">Father's Name : </label>
        <h3 style="float: left; text-align: left;   font-size: 11px;    margin: 0;    width: 28%; margin-bottom: 10px;  font-weight: normal;"><?php echo $info[0]['father_name'];?></h3>
        
<!--        <label style="float: left; width:200px; font-size: 18px; font-weight: bold;">REGISTRATION NO : </label>
        <h3 style="float: left;    font-size: 18px;    margin: 0;    width: 250px;  margin-bottom: 20px; font-weight: normal;"><?php echo $info[0]['reg_no'];?></h3>-->
        
        
                
        <label style="float: left; width:20%; font-size: 12px; font-weight: bold;">Program : </label>
        <h3 style="float: left;    font-size: 11px;    margin: 0;    width: 30%; margin-bottom: 20px;  font-weight: normal;"><?php echo $info[0]['program_name'];?></h3>
        
<!--        <label style="float: left; width:200px; font-size: 18px; font-weight: bold;">SEMESTER : </label>
        <h3 style="float: left;    font-size: 18px;    margin: 0;    width: 250px; margin-right: 400px; font-weight: normal;"><?php echo 'SEMESTER 0'.$info[0]['semester'];?></h3>-->
        
        <label style="float: left;  text-align: left; width:22%; font-size: 12px; font-weight: bold;">Session : </label>
        <h3 style="float: left; text-align: left;   font-size: 11px;    margin: 0;    width: 28%; margin-bottom: 10px; font-weight: normal;"><?php echo $info[0]['batch_type'].' '.$info[0]['batch'];?></h3>
       
       
        </div>
    </div>
    
<table style=" width:100%; float:left;" class="table" >
    <tbody style="align:center; width:100%;">
                    <th style="border-style: solid; border-width: 2px; width:100%; height: 20px; line-height: 20px; font-size: 14px; font-weight: bold"><p style="text-align: center;">Academic Result</p></th>
    </tbody>
</table>
    

<table style=" width:100%; float:left;" class="table" >
    <tbody style="align:center; width:100%; height: 23px; line-height: 23px; font-size: 12px;">
                    <th style="border-style: solid; border-width: 4px; width:9%;  background-color:#A7A6A6; "><p style="text-align: center;">SR No.</p></th>
                    <th style="border-style: solid; border-width: 4px; width:40%;  background-color:#A7A6A6; "><p style="text-align: center;">Subject </p></th>
                    <th style="border-style: solid; border-width: 4px; width:12%;  background-color:#A7A6A6; "><p style="text-align: center;">Cr Hours</p></th>
                    <th style="border-style: solid; border-width: 4px; width:15%;  background-color:#A7A6A6; "><p style="text-align: center;">Total Marks</p></th>
                    <th style="border-style: solid; border-width: 4px; width:20%;  background-color:#A7A6A6; "><p style="text-align: center;">Obtained Marks</p></th>
                    <th style="border-style: solid; border-width: 4px; width:4%;  background-color:#A7A6A6; "><p style="text-align: center;">Grade</p></th>
    </tbody>
</table>

<?php 
$c = 0;
$g_total_marks = 0;
$g_obt_marks = 0;
$g_total_credit_hours = 0;
$cgpa=0;

//    for($a=0; $a<2; $a++){        
        foreach($info AS $row){                      
            if($c == 4){
?>
<table style=" width:100%; margin-top:150px; float:left;" class="table" >
            <?php }else{?>
<table style=" width:100%; margin-top:20px; float:left;" class="table" >
            <?php } ?>
            <tbody style="align:center; width:100%;">
		<th style=" width:60%; "><p style="text-align: left; font-size: 18px; font-weight: bold"><?php echo '0'.$row['semester'];?></p></th>
		<th style=" width:10%; "><p style="text-align: center;"></p></th>
		<th style=" width:30%; "><p style="text-align: center;"></p></th>
            </tbody>
</table>

    
<table style="border-style: solid; border-width: 1px; width:100%; float:left;"  class="table">
    <tbody style="align:center; width:100%;">
    <?php 
            $i = 1;
            $total_credit_hours = 0;
            $total_obtained = 0;
            $gpa            =   0;
            
            
            $result         =   $this->Examination_model->get_std_result($row['semester'],$row['roll_no']);
           // echo '<pre>';print_r($result);die;
            foreach($result AS $row){
                
                    $total_credit_hours     =   $total_credit_hours + $row['credit_hours'];
                    
                    $obtained      =   $row['mid_total']+$row['final_total'];
                    
                    $total_marks        =   $i * 100;
                    
                    $total_obtained     =   $total_obtained + $obtained;
                    
                    $res    = $this->Examination_model->calculateGpa($obtained,0,'Final');
                    $gpa    =   $gpa + $res;
                    
                    if($obtained < 50)
                    {   $grade = 'F';}
                    elseif($obtained >= 50 && $obtained < 60)
                    {   $grade = 'D';}
                    elseif($obtained >= 60 && $obtained < 70)
                    {   $grade = 'C';}
                    elseif($obtained >= 70 && $obtained < 80)
                    {   $grade = 'B';}
                    elseif($obtained >= 80 && $obtained <= 100)
                    {   $grade = 'A';}
                    
                    
        
        ?>
        <tr>
                <td style="border-style: solid; border-width: 1px; width:9%; "><p style="text-align: center;"><?php echo $i; ?></p></td>
                <td style="border-style: solid; border-width: 1px; width:40%; "><p style="text-align: left; margin-left: 20px;"><?php echo $row['course_name'];?></p></td>
                <td style="border-style: solid; border-width: 1px; width:12%; "><p style="text-align: center;"><?php echo $row['credit_hours'];?></p></td>
                <td style="border-style: solid; border-width: 1px; width:15%; "><p style="text-align: center;">100</p></td>
                <td style="border-style: solid; border-width: 1px; width:20%; "><p style="text-align: center;"><?php echo $obtained;?></p></td>
                <td style="border-style: solid; border-width: 1px; width:4%; "><p style="text-align: center;"><?php echo $grade; ?></p></td>
        </tr>		
     <?php $i++; } ?>
    </tbody>
</table>


<table  style=" width:100%; float:left;" class="table">
<tbody>
	<tr>
		<th style=" width:9%; "><p style="text-align: center;"></p></th>
		<th style=" width:40%; "><p style="text-align: center;"></p></th>
		<th style="border-style: solid; border-width: 1px; width:12%; "><p style="text-align: center;"><?php echo $total_credit_hours;?></p></th>
		<th style="border-style: solid; border-width: 1px; width:15%; "><p style="text-align: center;"><?php echo $total_marks;?></p></th>
		<th style="border-style: solid; border-width: 1px; width:20%; "><p style="text-align: center;"><?php echo $total_obtained;?></p></th>
		<th style=" border-style: solid; border-width: 1px; width:4%; "><p style="text-align: center;"></p></th>
		</tr>
		</tbody>


</table>
    
        
<table style=" width:100%; float:left; margin-bottom: 0px" class="table" >
 
<tbody style="align:center; width:100%;">
		<th style=" width:60%; "><p style="text-align: left;"></p></th>
		<th style=" width:20%; "><p style="text-align: center; font-size:12px; "><?php echo round($total_obtained / $total_marks * 100,2).'%';?></p></th>
		<th style=" width:20%; "><p style="text-align: center; font-size:12px; ">GPA : <?php echo ' '.$gpa = round($gpa/($i-1),2); ?></p></th>

		</tbody>
</table>

        <?php 
            $cgpa          =    $cgpa + $gpa;
            $g_total_marks = $g_total_marks + $total_marks;
            $g_obt_marks = $g_obt_marks + $total_obtained;
            $g_total_credit_hours = $g_total_credit_hours + $total_credit_hours;
        
        $c++; }//}?>
    

<table style=" width:100%; float:left;" class="table" >
    <tbody style="align:center; width:100%; height: 20px; line-height: 20px; font-size: 12px;">
                    <th style="border-style: solid; border-width: 1px; width:49%; "><p style="text-align: left; margin-left: 25px;">Grand Total :</p></th>                    
                    <th style="border-style: solid; border-width: 1px; width:12%; "><p style="text-align: center;"><?php echo $g_total_credit_hours; ?></p></th>
                    <th style="border-style: solid; border-width: 1px; width:15%; "><p style="text-align: center;"><?php echo $g_total_marks; ?></p></th>
                    <th style="border-style: solid; border-width: 1px; width:20%; "><p style="text-align: center;"><?php echo $g_obt_marks; ?></p></th>
                    <th style="border-style: solid; border-width: 1px; width:4%;  "><p style="text-align: center;"></p></th>
    </tbody>
</table>
 
<table style=" width:100%; float:left; margin-top: 20px;" class="table" >   
    <tbody style="align:center; width:100%;  font-size: 11px; font-weight: normal;">
                    <th style="width:85%; "><p style="text-align: left; font-style: italic; margin-left: 10px;">This certificate is issued on behalf of his/her personal request.</p></th>                                        
                    <th style="width:15%; "><p style="text-align: left; "><b>CGPA : </b><?php echo ' '.round($cgpa/$c,2); ?></p></th>                                        
    </tbody>
</table>
    
<table style=" width:100%; float:left; margin-bottom: 50px;" class="table" >    
    <tbody style="align:center; width:100%; height: 20px; line-height: 20px; font-size: 10px;">
                    <th style="border-style: solid; border-width: 1px; width:10%; "><p style="text-align: center;">Grade Plan</p></th>                    
                    <th style="border-style: solid; border-width: 1px; width:18%; "><p style="text-align: center; ">A : 80% and Above</p></th>                    
                    <th style="border-style: solid; border-width: 1px; width:17%; "><p style="text-align: center;">B : 70% to 79%</p></th>
                    <th style="border-style: solid; border-width: 1px; width:17%; "><p style="text-align: center;">C : 60% to 69%</p></th>
                    <th style="border-style: solid; border-width: 1px; width:17%; "><p style="text-align: center;">D : 50% to 59%</p></th>
                    <th style="border-style: solid; border-width: 1px; width:17%;  "><p style="text-align: center;">F : 49% and Below</p></th>
    </tbody>
</table>

    
    
<div style=" width:100%"  >
    <div style="margin-top: 20px;">
        <div style=" width:65%;  float: left;  "><p style="text-align: left">Prepared By : ____________________________</p></div>
        <div style=" width:35%; float: left;  "><p style="text-align: left">______________________________</p></div>
    </div>
    <div>
        <div style=" width:65%;  float: left;  "><p style="text-align: left">Checked By : ____________________________</p></div>
        <div style=" width:35%; float: left;  "><b style="text-align: left; font-size:12px">Additional Controller of Examination</b></div>
    </div>
   
</div>    

    <script type="text/javascript">
        self.focus()
        self.print()
        //self.close()
    </script>
    
</body>
</html>
