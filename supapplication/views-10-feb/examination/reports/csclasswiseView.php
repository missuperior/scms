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
                                
                                    <a  href="<?php echo base_url(); ?>examination/class_wise_report_print/<?php echo $campaign_id;?>/<?php echo $program_id;?>/<?php echo $exam_type;?>/<?php echo $semester;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="6"><h3 style="text-align:right">Class Wise Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="2"><b><?php echo $students[0]['campus_name']; ?></b></td>
                                               <td colspan="2"><b><?php echo $students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                               <td colspan="1"><b><?php echo 'Session :'.$session; ?></b></td>
                                               <td colspan="3"><b><?php echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="4"><b>Exam Type : <?php echo $exam_type; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Roll No</th>
                                                <th>Student Name</th>
                                                <?php 
                                                  $reg_id       = $students[0]['student_id'];
                                                  $totall       = 0;
                                                  $stu_counts   = count($students);
                                                    for($i=0; $i < $stu_counts; $i++)
                                                    {
                                                        if($reg_id == $students[$i]['student_id']){
                                                ?>      
                                                
                                                <th><?php 
                                                    $total_marks    = '100';
                                                    $totall         = $totall+$total_marks;
                                                    
                                                    $credit_hours   = $students[$i]['credit_hours'];
                                                    
                                                     ?>
                                                    <?php //$lab_result = $this->Section_model->chkLabExists($student_id,$res['batch_id'] ,$res['course_id'] ,$row['session_id'] , $res['course_section'] ) ?>
                                                    <?php //1
                                                    // if having lab
                                                    $lab_exists         = $this->Section_model->chkLabExists($batch_id,$students[$i]['course_id']);
                                                    //echo $batch_id . $students[$i]['course_id'];
                                                    $credit_hrspls      = $lab_exists == 0 ?  $credit_hours :  $credit_hours+1;
                                                    
                                                    
                                                    echo $students[$i]['course_name'].'('.$total_marks.') <br/>  '.$credit_hrspls  ; ?>
                                                </th>
                                                    <?php }} ?>
                                                <th>G.P.A</th>
                                                <th>Obtained</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $id         = 0;
                                        $cnt_std    = count($students);
                                        for($c=0; $c < $cnt_std; $c++){    
                                            if($id != $students[$c]['student_id']){
                                            ?>
                                          <tr>
                                            <td><?php echo $students[$c]['roll_no']; ?></td>
                                            <td><?php echo $students[$c]['student_name']; ?></td>
                                            
                                             <?php 
                                                $totall_obtained    = 0;
                                                $reg_id             = $students[$c]['student_id'];
                                                $count              = 0;
                                                $gpa                = 0;
                                                    for($i=$c; $i < count($students); $i++)
                                                    {
                                                        if($reg_id == $students[$i]['student_id']){
                                                            $count++;
                                                ?>      
                                                
                                                <td><?php 
                                                        $lab_marks          = $this->Section_model->getLabMarks($students[$i]['student_id'], $batch_id,$students[$i]['course_id'],$session_id , $section);
                                                        $obtained3          =  $lab_marks[0]['final_value_1'];

                                                        $totall_obtained    = $totall_obtained + $students[$i]['obtained1']+$students[$i]['obtained2'];
                                                        $res                = $this->Examination_model->calculateGpa($students[$i]['obtained1'],$students[$i]['obtained2'],$exam_type);
                                                        $gpa                = $gpa + $res; 
                                                        echo $students[$i]['obtained1']+$students[$i]['obtained2'] + $obtained3;
                                                    ?>
                                                </td>
                                                
                                            <?php   } }
                                            $cgpa = $gpa/$count;
                                              ?>
                                                
                                            <td><?php echo number_format("$cgpa",2);?></td>
                                            <td><?php echo $totall_obtained;?></td>
                                            <td><?php echo $totall;?></td>
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