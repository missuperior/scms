<html>
<head>
    <style>
        .table{font-size: 9px;}
    </style>
</head>
<body style="font-size: 12px; margin-top: 100px;">

<div style=" width:100%; float:left;"  >
    <div>
        <div style=" width:60%;  float: left;  "><p style="text-align: right"><b>TO WHOM IT MAY CONCERN</b></p></div>        
        <div style=" width:40%;  float: left;  "><p style="text-align: center"><b>Ref : </b>_________________</p></div>        
    </div>
</div>   
 
<div style=" width:100%; float:left; height: 30px;"  >
    <div>
        <div style=" width:57%;  float: left;  "><p style="text-align: left"><b>Roll No : </b> <?php echo $info[0]['roll_no'];?></p></div>        
        <div style=" width:40%;  float: left;  "><p style="text-align: center"><b>Date : </b><?php echo date('d-M-y');?></p></div>        
    </div>
</div>   
 
<div style=" width:100%; float:left;  height: 30px;"  >
    <div>
        <div style=" width:57%;  float: left;  "><p style="text-align: left"><b>Name : </b> <?php echo $info[0]['student_name'];?></p></div>        
        <div style=" width:40%;  float: left;  "><p style="text-align: center"><b>Father Name : </b><?php echo $info[0]['father_name'];?></p></div>        
    </div>
</div>   
 
<div style=" width:100%; float:left; height: 50px;"  >
    <div>
        <div style=" width:57%;  float: left;  "><p style="text-align: left"><b>Program : </b> <?php echo $info[0]['program_name'];?></p></div>        
        <div style=" width:40%;  float: left;  "><p style="text-align: center"><b>Session : </b><?php echo $info[0]['session'];?></p></div>        
    </div>
</div>   
 
    
<div style=" width:100%; float:left;"  >
    <div >
        <div style=" width:100%;  float: left; text-align: center; border: 5px solid grey "><b>ACADEMIC RESULT</b></div>        
    </div>
</div> 
    
    <table style=" width:100%; float:left;" class="table" >
<tbody style="align:center; width:100%;">
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
        foreach($info AS $row){                      
            if($c == 4){
?>
<table style=" width:100%; margin-top:150px; float:left;" class="table" >
            <?php }else{?>
<table style=" width:100%; margin-top:0px; float:left;" class="table" >
            <?php } ?>
            <tbody style="align:center; width:100%;">
		<th style=" width:60%; "><p style="text-align: left;"><?php echo $row['session'];?></p></th>
		<th style=" width:10%; "><p style="text-align: center;"></p></th>
		<th style=" width:30%; "><p style="text-align: center;"></p></th>
            </tbody>
</table>

    
<table style="border-style: solid; border-width: 1px; width:100%; float:left;"  class="table">
    <tbody style="align:center; width:100%;">
    <?php 
            $i                  = 1;
            $total_credit_hours = 0;
            $total_obtained     = 0;
            
            $result             =   $this->Teachers_model->get_std_result($row['session_id'],$row['roll_no']);
            echo '<pre>';print_r($result);die;
            foreach($result AS $row){
                
                    $total_credit_hours     =   $total_credit_hours + $row['credit_hours'];
                    
                    $obtained               =   $row['mid_total']+$row['final_total'];
                    
                    $total_marks            =   $i * 100;
                    
                    $total_obtained         =   $total_obtained + $obtained;
                    
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
    
        
<table style=" width:100%; float:left;" class="table" >
 
<tbody style="align:center; width:100%;">
		<th style=" width:60%; "><p style="text-align: left;"></p></th>
		<th style=" width:20%; "><p style="text-align: center; ">Percentage : <?php echo round($total_obtained / $total_marks * 100,2);?></p></th>
		<th style=" width:20%; "><p style="text-align: center;">GPA : 3.33</p></th>

		</tbody>
</table>

        <?php $c++; }?>
    
    
<div style=" width:100%"  >
    <div style="margin-top: 20px;">
        <div style=" width:60%;  float: left;  "><p style="text-align: left">Prepared By : ____________________________</p></div>
        <div style=" width:40%; float: left;  "><p style="text-align: left">_______________________________________</p></div>
    </div>
    <div>
        <div style=" width:63%;  float: left;  "><p style="text-align: left">Checked By : ____________________________</p></div>
        <div style=" width:37%; float: left;  "><b style="text-align: left">Additional Controller of Examination</b></div>
    </div>
   
</div>    
    
    
</body>
</html>
