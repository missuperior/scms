<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="" style="text-decoration: none">Examination </a>
            </li>
        </ul><!--.breadcrumb-->
        <div class="nav-search" id="nav-search">
            <form class="form-search" />
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>
    <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                 <h4 class="lighter">
                    <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="span12">
                            <div class="row-fluid">
                                    <?php if(count($students) > 0 ){?>
                                    <div class="table-header">
                                        <h3 id="title">Class Summary Report</h3>
                                    </div>
                                
                                    <a  href="<?php echo base_url(); ?>examination/view_final_result_summary_cr_print/<?php echo $program_id;?>/<?php echo $section;?>/<?php echo $batch_id;?>/<?php echo $session_id;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="7"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="6"><h3 style="text-align:right">Class Wise Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="3"><b><?php  echo $students[0]['campus_name']; ?></b></td>
                                               <td colspan="2"><b><?php echo $students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                               <td colspan="4"><b><?php  echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="4"><b>Exam Type : <?php echo 'Final'; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Sr No</th>
                                                <th>Roll No</th>
                                                <th>Student Name</th>
                                                <?php 
                                                  $student_id   = $students[0]['student_id'];
                                                  $totall       = 0;
                                                  $final_marks  = 0;
                                                  

                                                    $cont         = count($offered);
//                                                   echo '<pre>';
//                                                    print_r($offered); die;
                                                    foreach($offered as $kk => $l)
                                                    { 
                                                            //$mid                =   $this->Examination_model->getMidStructureCr($program_id,$offered[$i]['course_id'], $section, $batch_id, $session_id );
                                                            $mid                =   $this->Examination_model->getMidStructureCr($program_id,$l['course_id'], $section, $batch_id, $session_id );
                                                            $mid_marks          = $mid->mid_value_1+$mid->mid_value_2+$mid->mid_value_3;
                                                             //echo 'course_id--'.$l['course_id'].'=='.$mid_marks.'--'.$i.'<br/>';

                                                            $final              =   $this->Examination_model->getFinalStructureCr($program_id,$l['course_id'], $section, $batch_id, $session_id );
                                                            $final_marks        = $final->final_value_1+$final->final_value_2+$final->final_value_3+$final->final_value_4+$final->final_value_5+$final->final_value_6+$final->final_value_7;
                                                            //echo 'course_id--'.$l['course_id'].'=='.$final_marks.'--'.$i.'<br/>';

                                                            $lab_marks          =   $this->Examination_model->getLabMarksStructure($program_id , $batch_id,$l['course_id']  ,$session_id , $section);
                                                            //echo 'course_id--'.$l['course_id'].'=='.$lab_marks.'--'.$i.'<br/>';
                                                            $total_marks        =   $final_marks + $lab_marks + $mid_marks;

                                                            if(!empty($lab_marks)){
                                                                $credit_hrs     =   $l['credit_hours']+1;
                                                            }else{
                                                                $credit_hrs     =   $l['credit_hours'];
                                                            }
                                                            $totall             = $totall+$total_marks;
                                                           // echo '<th>'.$l['course_name'].'('.$total_marks.')</th>';
                                                            echo '<th>'.$l['course_name'].'<br>('.$total_marks.' - Cr : '.$credit_hrs.')</th>';
                                                        } ?>
                                                <th>G.P.A</th>
                                                <th>Obtained</th>
                                                <th>Total</th>
                                                <th>CGPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $id = 0;
                                       
                                        for($c=0; $c < count($students); $c++){   
                                            
                                            
                                            if($id != $students[$c]['student_id']){
                                                $fail_subjects  =   $this->Examination_model->getFailSubjectsCR($students[$c]['student_id'],$batch_id,$session_id);
                                            
                                            ?>
                                          <tr>
                                            <td><?php echo $c+1; ?></td>
                                            <td><?php echo $students[$c]['roll_no']; ?></td>
                                            <td><?php echo $students[$c]['student_name']; ?></td>
                                           
                                            <?php
                                                  $totall_obtained = 0;
                                                  $reg_id =   $students[$c]['student_id'];
                                                  $count = 0;
                                                  $gpa = 0;
                                                   $marks=0;
                                                   $credit_hours=0;
                                             foreach ($offered as $cr){ ?>
                                                  <td> 
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
                                             
                                                        $gpaa = $gpa/$credit_hours;
                                                        
                                                        if($session_id > $students[$c]['enrolled_session_id']){                                                        
                                                            $cgpa = $this->Examination_model->getCGPA_cr($students[$c]['student_id'],$session_id,$batch_id);
                                                           // $cgpa   =   $this->Examination_model->getLastGpa($students[$c]['student_id'],$gpa,$credit_hours);           
                                                        }else{
                                                            $cgpa = $gpaa;
                                                        }
                                              ?>
                                             </td>   
                                            <td><?php if($marks > 0){echo 'Fail';}else{echo number_format("$gpaa",2);}?></td>
                                            <td><?php echo $totall_obtained;?></td>
                                            <td><?php echo $totall;?></td>
                                            <td><?php if($fail_subjects > 0){echo 'Fail';}else{echo number_format("$cgpa",2);}?></td>
                                          </tr>
                                        <?php } 
                                            $id = $students[$c]['student_id'];
                                                        }?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="118">Powered By : Superior Solutionz</td></tr>
                                        
                                    </table>
                                    <?php }else{?>
                                    <div class="table-header">
                                       <h3>Record Not Found</h3>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.tableTools.js"></script>