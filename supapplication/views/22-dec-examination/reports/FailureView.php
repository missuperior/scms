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
                                             <td colspan="1"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="2"><h3 style="text-align:left">Failure List</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="1"><b>Campaign : </b><?php  echo $students[0]['campaign_name']; ?></td>
                                               <td colspan="1"><b>Semester : </b><?php  echo $semester; ?></td>
                                               <td colspan="1"><b>Program  : </b><?php  echo $students[0]['program_name']; ?></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Roll No</th>
                                                <th>Student Name</th>                                               
                                                <th>Subjects</th>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $id = 0;
                                        for($c=0; $c < count($students); $c++){ 
                                                    $subjects = '';
                                                    $fail_subjects = $this->Examination_model->getFailureSubjects($students[$c]['student_id'],$semester);
                                                    if(count($fail_subjects) > 0){
                                                        
                                                        foreach ($fail_subjects AS $row){
                                                            $subjects = $subjects.$row['course_name'].'('.$row['marks'].'), ';
                                                        }
                                                    
                                            ?>
                                          <tr>
                                            <td><?php echo $students[$c]['roll_no']; ?></td>
                                            <td><?php echo $students[$c]['student_name']; ?></td>                                           
                                            <td><?php echo $subjects;  ?></td>
                                         
                                          </tr>
                                        <?php }}?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="3">Powered By : Superior Solutionz</td></tr>
                                        
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