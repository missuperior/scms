<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Courses </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>Copy Courses Module</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Courses Copy</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/copycoursesave" enctype="multipart/form-data" />

                                                <h3>Copy From</h3>
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="sr_programs" id="programs"> 
                                                                <option value="0" >Select Program</option>
                                                            <?php foreach($all_programs as $p){ ?> 
                                                                <option value="<?php echo $p['program_id'];?>" ><?php echo $p['program_name'].'=='.$p['program_code'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Select Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="sr_batch" id="batch"> 
                                                                <option value="0" >Select batch</option>
                                                            <?php foreach($all_batches as $p){ ?> 
                                                                <option value="<?php echo $p['batch_id'];?>" ><?php echo $p['batch_type'].'=='.$p['batch'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                
                                                <h3>Copy To</h3>
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="de_programs" id="programs"> 
                                                                <option value="0" >Select Program</option>
                                                            <?php foreach($all_programs as $p){ ?> 
                                                                <option value="<?php echo $p['program_id'];?>" ><?php echo $p['program_name'].'=='.$p['program_code'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Select Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="de_batch" id="batch"> 
                                                                <option value="0" >Select batch</option>
                                                            <?php foreach($all_batches as $p){ ?> 
                                                                <option value="<?php echo $p['batch_id'];?>" ><?php echo $p['batch_type'].' <==> '.$p['batch'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish ">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->
            </div><!--/.main-content-->
        </div><!--/.main-container-->