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



        <?php if (count($students) > 0) { ?>


            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="30%" scope="col"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="100" height="100" /></th>
                    <th  style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 30px; text-align:left" width="70%" scope="col">Superior Group Of Colleges</th>
                </tr>
            </table>

            <div style="clear:both;height:15px;"></div>


            <table style="margin-left:400px; color:white; font-family: Arial; font-size: 16px; font-weight: normal" height="40" width="20%" border="2" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="25%" scope="col" bgcolor="#6B6565" >Class Result Summary  </th>
                </tr>

            </table>

            <div style="clear:both;height:20px;"></div>

    <!--<div style="float:left; margin-left:50px;"><img src="<?php echo base_url(); ?>assets/images/logo1.png" width="150" height="150" /></div>
    <div style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 40px; float: left; margin-left: 250px; margin-top: 20px; color: #000;" > <strong>Superior Group of Colleges</strong></div>
    <div style="clear:both; height:5px;"></div>
    <div style="text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 20px; margin-left: 550px; border: solid 1px; color: #000; width: 100%; margin: o auto; width: 400px;">Class Result Summary</div>
    <div style="clear:both;height:30px;"></div>-->



            <div style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">

                <table  width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr style="height: 30px; color: white ">    
                        <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"> <?php echo '  ' . $students[0]['campus_name']; ?></th>
                        <th width="25%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php echo '  ' . $students[0]['program_name'].' (Section : '.$section.')'; ?></th>
                        <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><?php echo '  ' . $students[0]['batch_type'] . ' ' . $students[0]['batch']; ?></th>
                        <th width="15%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Session &nbsp;&nbsp;</b> <?php echo $students[0]['session']; ?></th>    
                        <th width="20%" align="center" valign="middle" bgcolor="#6B6565" scope="col"><b>Exam Type : &nbsp;&nbsp;</b> <?php echo 'Final'; ?></th>

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

                        <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            <strong>Sr No</strong>
                        </th>
                        
                        <th width="6%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            <strong>Roll No</strong>
                        </th>

                        <th width="14%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            <strong>Student Name</strong>
                        </th>

                        <?php
                        $student_id = $students[0]['student_id'];
                        $totall = 0;
                        $final_marks = 0;


                        $cont = count($offered);
                        foreach ($offered as $kk => $l) {
                            //$mid                =   $this->Examination_model->getMidStructureCr($program_id,$offered[$i]['course_id'], $section, $batch_id, $session_id );
                            $mid = $this->Examination_model->getMidStructureCr($program_id, $l['course_id'], $section, $batch_id, $session_id);
                            $mid_marks = $mid->mid_value_1 + $mid->mid_value_2 + $mid->mid_value_3;
                            //echo 'course_id--'.$l['course_id'].'=='.$mid_marks.'--'.$i.'<br/>';

                            $final = $this->Examination_model->getFinalStructureCr($program_id, $l['course_id'], $section, $batch_id, $session_id);
                            $final_marks = $final->final_value_1 + $final->final_value_2 + $final->final_value_3 + $final->final_value_4 + $final->final_value_5 + $final->final_value_6 + $final->final_value_7;
                            //echo 'course_id--'.$l['course_id'].'=='.$final_marks.'--'.$i.'<br/>';

                            $lab_marks = $this->Examination_model->getLabMarksStructure($program_id, $batch_id, $l['course_id'], $session_id, $section);
                            //echo 'course_id--'.$l['course_id'].'=='.$lab_marks.'--'.$i.'<br/>';
                            $total_marks = $final_marks + $lab_marks + $mid_marks;

                            if (!empty($lab_marks)) {
                                $credit_hrs = $l['credit_hours'] + 1;
                            } else {
                                $credit_hrs = $l['credit_hours'];
                            }
                            $totall = $totall + $total_marks;
                            // echo '<th>'.$l['course_name'].'('.$total_marks.')</th>';
                            echo '<th width="10%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">' . $l['course_name'] . '<br>(' .$total_marks.' - Cr : '. $credit_hrs . ')</th>';
                        }
                        ?>


                        <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            <p>G.P.A</p>
                        </th>
                        <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            Obt.
                        </th>
                        <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            Total
                        </th>
                        <th width="4%" align="center" valign="middle" bgcolor="#4F4D4D" scope="col">
                            CGPA
                        </th>

                    </tr>

                </THEAD>


                <?php
                $id = 0;
                $fail_subjects = 0;
                for ($c = 0; $c < count($students); $c++) {

                    if ($id != $students[$c]['student_id']) {
                        $fail_subjects = $this->Examination_model->getFailSubjectsCR($students[$c]['student_id'], $batch_id, $session_id);
                        ?>  
                        <tbody>

                                    <tr>
                                     <td align="center" valign="top"  style="font-size: 11px"><?php echo $c+1; ?></td>
                                     <td align="center" valign="top" style="font-size: 11px"><?php echo $students[$c]['roll_no']; ?></td>
                                     <td align="left" valign="top" style="padding-left:10px; font-size: 11px"><?php echo $students[$c]['student_name']; ?></td>

                                        <?php
                                        $totall_obtained = 0;
                                        $reg_id = $students[$c]['student_id'];
                                        $count = 0;
                                        $gpa = 0;
                                        $marks = 0;
                                        $credit_hours = 0;
                                        
                                         foreach ($offered as $cr){ ?>
                                                  <td style="font-size: 12px"> 
                                                <?php  $labi       =  $this->Examination_model->getLabMarks($students[$c]['student_id'],$batch_id,$cr['course_id'], $session_id);
                                                  $student_marks  =   $this->Examination_model->SingleSubjectMarks_cr_Jal($cr['program_id'],$section,$cr['batch_id'],$cr['session_id'], $students[$c]['student_id'], $cr['course_id']);
                                                  
                                                  if(!empty($student_marks)) {
                                                     
                                                      if(count($labi) > 0){
                                                                                $t_marks = $student_marks[0]['obtained']+$labi[0]['final_value_1'];
                                                                                $crdt_hrs   =   $student_marks[0]['credit_hours']+1;
                                                            }else{
                                                                                $t_marks = $student_marks[0]['obtained'];
                                                                                $crdt_hrs   =   $student_marks[0]['credit_hours'];
                                                            }
                                                          
                                                          //  echo '<br>Credit'.$crdt_hrs.'-'.$students[$i]['credit_hours'];
                                                                                                                                                                                      
                                                            $res            = $this->Examination_model->getGpa($t_marks,$crdt_hrs);
                                                            $credit_hours   =   $credit_hours+$crdt_hrs;
                                                            $gpa            =   $gpa + $res; 
                                                            
                                                            if($t_marks < 50 ){ echo $t_marks.' (F)';$marks++;}else{ echo $t_marks;}   
                                                       
                                                            $totall_obtained    =   $totall_obtained + $t_marks;
                                                  }else{
                                                      echo "N/F";
                                                  } ?>
                                                  
                                                  </td>
                                               
                                     <?php       }
                                
                                        $gpaa = $gpa / $credit_hours;

                                        if ($session_id > $students[$c]['enrolled_session_id']) {
                                              $cgpa = $this->Examination_model->getCGPA_cr($students[$c]['student_id'],$session_id,$batch_id);
                                             //   $cgpa = $this->Examination_model->getLastGpa($students[$c]['student_id'], $gpa, $credit_hours);
                                        } else {
                                            $cgpa = $gpaa;
                                        }
                                        ?>

                                        <td align="center" valign="top" style="font-size: 10px"><?php if ($marks > 0) {
                                            echo 'Fail';
                                        } else {
                                            echo number_format("$gpaa", 2);
                                        } ?></td>

                                        <td align="center" valign="top" style="font-size: 11px"><?php echo $totall_obtained; ?></td>

                                        <td align="center" valign="top" style="font-size: 11px"><?php echo $totall; ?></td>

                                        <td align="center" valign="top" style="font-size: 11px"><?php if ($fail_subjects > 0) {
                        echo 'Fail';
                    } else {
                        echo number_format("$cgpa", 2);
                    } ?></td>

                                    </tr>
                                </tbody>
                <?php
                
                $id = $students[$c]['student_id'];
                 }}          
            ?>

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


        <?php } else { ?>

                    <div style="float:left; margin-left:50px;"><img src="<?php echo base_url(); ?>assets/images/colg_logo.png" width="150" height="150" /></div>
                    <div style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 50px; float: left; margin-left: 250px; margin-top: 20px; color: #000;" > <strong>Superior Group of Colleges</strong></div>
                    <div style="clear:both; height:5px;"></div>
                    <div style="text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 20px; margin-left: 550px; border: solid 1px; color: #000; width: 100%; margin: o auto; width: 400px;">Result Not Found</div>
                    <div style="clear:both;height:30px;"></div>  

        <?php } ?>


        <script type="text/javascript">

            self.focus()
            self.print()
        //self.close()
        </script>


    </body>
</html>
