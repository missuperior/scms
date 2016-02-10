<div class="main-content">
  <div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
      <li>
        <a href="#">ADMISSIONS</a>                
      </li>            
    </ul><!--.breadcrumb-->

    <div class="nav-search" id="nav-search">
      <form class="form-search" />
      <span class="input-icon">
        <input style="width: 200px;"  type="text"placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
        <i class="icon-search nav-search-icon"></i>
      </span>
      </form>
    </div><!--#nav-search-->
  </div>

  <div class="page-content">
    <div class="page-header position-relative">
      <h1>
        STUDENT FORM
      </h1>
    </div><!--/.page-header-->

    <div class="row-fluid">
      <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <h4 class="lighter">                    
          <a href="#modal-wizard" data-toggle="modal" class="pink"> 
            <?php echo validation_errors(); ?>
            <?php echo $this->session->userdata('error_msg');

            $this->session->unset_userdata('msg'); ?> </a>

            <?php $this->session->unset_userdata('error_msg'); ?> 
            <?php echo $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg'); ?> </a>

        </h4>

        <div class="hr hr-18 hr-double dotted"></div>

        <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">EDIT STUDENT FORM</h4>                               
              </div>

              <div class="widget-body">
                <div class="widget-main">

                  <div class="row-fluid">


                    <form class="form-horizontal" id="studentform" method="POST" action="<?php echo base_url(); ?>studentoffice/update_studentform" enctype="multipart/form-data" />

                    <div class="step-content row-fluid position-relative" id="step-container">
                      <div class="step-pane active" id="step1">


                        <!-- *************************************    Start Student Table Information  *************************************************** -->
                                                                  
                        
                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Form No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 200px;" type="text" name="form_no" id="form_no" value="<?php if(set_value('form_no')) {echo set_value('form_no');}else {echo $student[0]['form_no'];}?>" class="span6" readonly/>
                              <input style="width: 200px;" type="hidden" name="student_id" id="student_id" value="<?php echo $student[0]['student_id'];?>" class="span6" />
                              <input style="width: 200px;" type="hidden" name="form_id" id="form_id" value="<?php echo $student[0]['form_id'];?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <?php if($student[0]['roll_no'] != ''){ ?>
                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="roll_no" id="roll_no" readonly  value="<?php if(set_value('roll_no')) {echo set_value('roll_no');}else {echo $student[0]['roll_no'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                        
                        <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                           <label style="width: 130px;" class="control-label" for="email">Current Session:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="current_session" name="current_session" class="chzn-select" data-placeholder="Click to Choose...">
                                <?php foreach ($sessions as $row) { 
                                    if($student[0]['current_session_id'] == $row['session_id']){
                                    ?>
                                  <option value="<?php echo $row['session_id'] ?>"> <?php echo $row['session'] ?></option> 
                                    <?php }} ?>																					
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 145px; margin-left: -15px;" class="control-label" for="email">Enrollment Session: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="enrolment_session" name="enrolment_session" class="chzn-select" data-placeholder="Click to Choose...">
                                <?php foreach ($sessions as $row) { 
                                    if($student[0]['enrolled_session_id'] == $row['session_id']){
                                    ?>
                                  <option value="<?php echo $row['session_id'] ?>"> <?php echo $row['session'] ?></option> 
                                    <?php }} ?>																				
                              </select>
                            </div>
                          </div>
                        </div>
                      

                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Shift : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 200px;" type="text" name="shift" id="shift" value="<?php if(set_value('shift')){echo set_value('shift'); }else { echo $student[0]['shift'];}?>" class="span6" readonly/>                                
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Batch: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="batch" name="batch" class="chzn-select" data-placeholder="Click to Choose...">
                                
                                  <?php foreach ($batches as $row) { 
                                      if($student[0]['batch_id'] == $row['batch_id']) {
                                      ?>
                                        <option value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch'] . ' - ' . $row['batch_type'] ?></option> 
                                      <?php } } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Program: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                
                                  <?php foreach ($programs as $row) { 
                                      if($student[0]['program_id'] == $row['program_id']){
                                      ?>
                                      <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                      <?php } } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>



                        <!-- *************************************    End Student table Information  *************************************************** -->



                        <!-- *************************************    Start Personel Information  *************************************************** -->

                        <hr/>
                        <h3 style="margin-top: 20px" class="lighter block green">PERSONAL INFORMATION</h3>   
                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="name" id="name" value="<?php if(set_value('name')) {echo set_value('name');}else {echo $student[0]['student_name'];}?>"  class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Father's Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="father_name" id="father_name" value="<?php if(set_value('father_name')) {echo set_value('father_name');}else {echo $student[0]['father_name'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Nationality: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="nationality" id="nationality" value="<?php if(set_value('nationality')) {echo set_value('nationality');}else {echo $student[0]['nationality'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                       <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Religion: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select  style="width: 200px;" id="religion" name="religion" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Religion --</option>
                                                                <option <?php if($student[0]['religion'] == "Islam") echo 'selected="selected"'; ?> value="Islam">Islam</option>
                                                                <option <?php if($student[0]['religion'] == "Christianity") echo 'selected="selected"'; ?> value="Christianity">Christianity</option>
                                                                <option <?php if($student[0]['religion'] == "Hinduism") echo 'selected="selected"'; ?> value="Hinduism">Hinduism</option>
                                                                <option <?php if($student[0]['religion'] == "Sikhism") echo 'selected="selected"'; ?> value="Sikhism">Sikhism</option>                                                                
                                                                						
                             </select>
                            </div>
                          </div>
                        </div>
                        
                        
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">C.N.I.C: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="cnic" id="cnic" value="<?php if(set_value('cnic')) {echo set_value('cnic');}else {echo $student[0]['nic_no'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="id-date-picker-1">Date of Birth: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="dob" id="dob" value="<?php if(set_value('dob')) {echo set_value('dob');}else {echo $student[0]['dob'];}?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>

                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Email: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="email" name="email" id="email" value="<?php if(set_value('email')) {echo set_value('email');}else {echo $student[0]['email'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="mobile" id="mobile" value="<?php if(set_value('mobile')) {echo set_value('mobile');}else {echo $student[0]['mobile'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px; margin-top: 20px;" class="control-group">
                          <label style="width: 130px;" class="control-label">Gender: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div  style="margin-left: 140px;" class="controls">
                            <span class="span12">
                              <label class="blue">
                                  <input name="gender" value="male" type="radio"  <?php if($student[0]['gender'] == 'male') echo 'checked="checked"';?> />
                                <span class="lbl"> Male</span>
                              </label>
                              <label class="blue">
                                <input name="gender" value="female" type="radio"  <?php if($student[0]['gender'] == 'female') echo 'checked="checked"';?> />
                                <span class="lbl"> Female</span>
                              </label>
                            </span>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px; margin-top: 20px;" class="control-group">
                          <label style="width: 130px;" class="control-label">Marital Status: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div  style="margin-left: 140px;" class="controls">
                            <span class="span12">
                              <label class="blue">
                                <input name="marital_status" value="Single" type="radio"    <?php if($student[0]['marital_status'] == 'Single') echo 'checked="checked"';?> />
                                <span class="lbl"> Single </span>
                              </label>
                              <label class="blue">
                                <input name="marital_status" value="Married" type="radio"  <?php if($student[0]['marital_status'] == 'Married') echo 'checked="checked"';?> >
                                <span class="lbl"> Married</span>
                              </label>
                            </span>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">Address (Present):<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="present_address" id="present_address" value="<?php if(set_value('present_address')) {echo set_value('present_address');}else {echo $student[0]['present_address'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">City (Present): <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="present_city" name="present_city" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option>
                                  <?php foreach ($cities as $row) { ?>
                                      <option <?php if (set_value('present_city') == $row['city_id']){echo 'selected="selected"';} if($student[0]['present_city_id'] == $row['city_id']) {echo 'selected="selected"';} ?>
                                          value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
                                  <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">Address(Permnet):<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="permanent_address" id="permanent_address" value="<?php if(set_value('permanent_address')) {echo set_value('permanent_address');}else {echo $student[0]['permanent_address'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 35px;" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">City (Permanent): <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select  style="width: 201px;" id="permanent_city" name="permanent_city" class="chzn-select" data-placeholder="Click to Choose...">

                                <option value="">-- Select City --</option>
                                  <?php foreach ($cities as $row) { ?>
                                      <option <?php if (set_value('permanent_city') == $row['city_id']){ echo 'selected="selected"'; } if($student[0]['permanent_city_id'] == $row['city_id']) {echo 'selected="selected"';} ?>
                                          value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
                                  <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div><br/>

                        <!-- *************************************    End Personel Information  *************************************************** -->



                        <!-- *************************************    Start Guardian Information  *************************************************** -->

                        <hr/>
                        <h3 style="margin-top: 20px" class="lighter block green">GUARDIAN INFORMATION</h3>   
                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_name" id="guardian_name" value="<?php if(set_value('guardian_name')) {echo set_value('guardian_name');}else {echo $student[0]['guardian_name'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_relation" id="guardian_relation" value="<?php if(set_value('guardian_relation')) {echo set_value('guardian_relation');}else {echo $student[0]['guardian_relation'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Occupation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_occupation" id="guardian_occupation" value="<?php if(set_value('guardian_occupation')) {echo set_value('guardian_occupation');}else {echo $student[0]['guardian_occupation'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Designation:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_designation" id="guardian_designation" value="<?php if(set_value('guardian_designation')) {echo set_value('guardian_designation');}else {echo $student[0]['guardian_designation'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Income: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_income" id="guardian_income" value="<?php if(set_value('guardian_income')) {echo set_value('guardian_income');}else {echo $student[0]['guardian_income'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Address: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text"name="guardian_address" id="guardian_address" value="<?php if(set_value('guardian_address')) {echo set_value('guardian_address');}else {echo $student[0]['guardian_address'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text"name="guardian_mobile" id="guardian_mobile" value="<?php if(set_value('guardian_mobile')) {echo set_value('guardian_mobile');}else {echo $student[0]['guardian_mobile'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Phone:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="guardian_phone" id="guardian_phone" value="<?php if(set_value('guardian_phone')) {echo set_value('guardian_phone');}else {echo $student[0]['guardian_phone'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">City: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="guardian_city" name="guardian_city" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option>                                                               
                                <?php foreach ($cities as $row) { ?>
                                      <option <?php if (set_value('guardian_city') == $row['city_id']) { echo 'selected="selected"';}  if($student[0]['guardian_city_id'] == $row['city_id']) {echo 'selected="selected"';}  ?> 
                                          value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
                                <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>



                        <!-- *************************************    End Guardian Information  *************************************************** -->



                        <!-- *************************************    Start person to be notified in case of emergency Informatio    *************************************************** -->

                        <hr/>
                        <h3 class="lighter block green">PERSON TO BE NOTIFIED IN CASE OF EMERGENCY</h3>   
                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_name" id="emergency_name" value="<?php if(set_value('emergency_name')) {echo set_value('emergency_name');}else {echo $student[0]['emergency_contact_name'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_relation" id="emergency_relation" value="<?php if(set_value('emergency_relation')) {echo set_value('emergency_relation');}else {echo $student[0]['emergency_contact_relation'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Address: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_address" id="emergency_address" value="<?php if(set_value('emergency_address')) {echo set_value('emergency_address');}else {echo $student[0]['emergency_contact_address'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">City: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="emergency_city" name="emergency_city" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option> 
<?php foreach ($cities as $row) { ?>
                                  <option <?php if (set_value('emergency_city') == $row['city_id']) {echo 'selected="selected"';}  if($student[0]['emergencay_city_id'] == $row['city_id']) {echo 'selected="selected"';}   ?>
                                      value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
<?php } ?>																				
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_mobile" id="emergency_mobile" value="<?php if(set_value('emergency_mobile')) {echo set_value('emergency_mobile');}else {echo $student[0]['emergency_contact_mobile'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Phone:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_phone" id="emergency_phone" value="<?php if(set_value('emergency_phone')) {echo set_value('emergency_phone');}else {echo $student[0]['emergency_contact_phone'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <!-- *************************************    End person to be notified in case of emergency Information  *************************************************** -->



                        <!-- *************************************    Start kinship Informatio    *************************************************** -->

                        <hr/>
                        <h3 class="lighter block green" style="margin-top: 20px">KINSHIP INFORMATION</h3>   
                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Name:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="kinship_name" id="kinship_name" value="<?php if(set_value('kinship_name')) {echo set_value('kinship_name');}else {echo $student[0]['kinship_name'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="kinship_relation" id="kinship_relation" value="<?php if(set_value('kinship_relation')) {echo set_value('kinship_relation');}else {echo $student[0]['kinship_relation'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>                                                                                                                                                                                                                                                                                              


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="kinship_rollno" id="kinship_rollno" value="<?php if(set_value('kinship_rollno')) {echo set_value('kinship_rollno');}else {echo $student[0]['kinship_rollno'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Program:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="kinship_program" name="kinship_program"  class="chzn-select" data-placeholder="Click to Choose...">
                                <?php foreach ($programs as $row) { ?>
                                      <option <?php if (set_value('program') == $row['program_id']){echo 'selected="selected"';} if($student[0]['kinship_program'] == $row['program_id']) {echo 'selected="selected"';}  ?>
                                          value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                  <?php } ?>
																			
                              </select>
                            </div>
                          </div>
                        </div>                                                                                                

                        <div style="width: 50%;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Batch:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="kinship_batch" name="kinship_batch" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select Batch --</option> 
                                    <?php foreach ($batches as $row) { ?>
                                        <option <?php if (set_value('batch') == $row['batch_id']){echo 'selected="selected"';} if($student[0]['kinship_batch'] == $row['batch_id']) {echo 'selected="selected"';} ?>
                                       value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch'] . ' - ' . $row['batch_type'] ?></option> 
                                  <?php } ?>																		
                              </select>
                            </div>
                          </div>
                        </div>


                        <!-- *************************************    End Kinship Information  *************************************************** -->




                        <!-- *************************************    Start Professionl Qualification Information   *************************************************** -->

                        <hr/>
                        <h3 class="lighter block green">ACADEMIC PROFESSIONAL QUALIFICATION</h3>   
                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Qualification: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_qualification" id="previous_qualification" value="<?php if(set_value('previous_qualification')) {echo set_value('previous_qualification');}else {echo $student[0]['previous_qualification'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_rollno" id="previous_rollno" value="<?php if(set_value('previous_rollno')) {echo set_value('previous_rollno');}else {echo $student[0]['previous_rollno'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>                                                                                                                                                                                                                                                                                                                                                                                              

                        <div style="width: 50%; float: left;  margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Subjects: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_subject" name="previous_subject" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select Subject --</option>
                                <option <?php if (set_value('previous_subject') == 'Science') {echo 'selected="selected"'; }if($student[0]['previous_subjects'] == 'Science') {echo 'selected="selected"';}  ?>
                                    value="Science" />Science
                                <option <?php if (set_value('previous_subject') == 'Arts') {echo 'selected="selected"'; }if($student[0]['previous_subjects'] == 'Arts') {echo 'selected="selected"';}  ?>
                                    value="Arts" />Arts
                                <option <?php if (set_value('previous_subject') == 'Social') {echo 'selected="selected"'; }if($student[0]['previous_subjects'] == 'Social') {echo 'selected="selected"';}  ?>
                                    value="Social" />Social																		                                                                																			
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;  margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Institute: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_institute" name="previous_institute" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select Institute --</option>
<?php foreach ($institutes as $row) { ?>
                                  <option <?php if (set_value('previous_institute') == $row['institute_id']) {echo 'selected="selected"';} if($student[0]['previous_institute'] == $row['institute_id']) {echo 'selected="selected"';}  ?> value="<?php echo $row['institute_id'] ?>"><?php echo $row['institute_name']; ?></option> 
<?php } ?>																		                                                                																			
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Total Marks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_totalmarks" id="previous_totalmarks" value="<?php if(set_value('previous_totalmarks')) {echo set_value('previous_totalmarks');}else {echo $student[0]['previous_total_marks'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Obtained Marks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_obtainedmarks" id="previous_obtainedmarks" value="<?php if(set_value('previous_obtainedmarks')) {echo set_value('previous_obtainedmarks');}else {echo $student[0]['previous_obtained_marks'];}?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Grade: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_grade" name="previous_grade" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select Grade --</option>
                                <option <?php if (set_value('previous_grade') == 'A') {echo 'selected="selected"';} if($student[0]['previous_grade'] == 'A') {echo 'selected="selected"';}  ?>
                                
                                    value="A" />A
                               <option <?php if (set_value('previous_grade') == 'B') {echo 'selected="selected"';} if($student[0]['previous_grade'] == 'B') {echo 'selected="selected"';}  ?>
                                value="B" />B
                               <option <?php if (set_value('previous_grade') == 'C') {echo 'selected="selected"';} if($student[0]['previous_grade'] == 'C') {echo 'selected="selected"';}  ?> 
                               value="C" />C																				
                               <option <?php if (set_value('previous_grade') == 'D') {echo 'selected="selected"';} if($student[0]['previous_grade'] == 'D') {echo 'selected="selected"';}  ?>
                               value="D" />D																				
                               <option <?php if (set_value('previous_grade') == 'E') {echo 'selected="selected"';} if($student[0]['previous_grade'] == 'E') {echo 'selected="selected"';}  ?>
                               value="E" />E																				
                              </select>
                            </div>
                          </div>
                        </div>

                        
                         <div style="width: 50%; float: left;  margin-bottom: 35px;" class="control-group">
                            <label style="width: 130px;" class="control-label" for="email">Year: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                            <div class="controls" style="margin-left: 140px;">
                                <div class="span12">
                                    <select style="width: 201px;" id="previous_year" name="previous_year" class="chzn-select" data-placeholder="Click to Choose...">
                                        <option value="">-- Select Year --</option>
                                        <?php for($i=1980; $i <= date('Y'); $i++ ){?>
                                            <option  <?php if (set_value('previous_year') == $i){ echo 'selected="selected"'; }if($student[0]['previous_degree_year'] == $i) {echo 'selected="selected"';} ?> value="<?php echo $i;?>">
                                                <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- *************************************    End Kinship Information  *************************************************** -->



                      </div>

                    </div>

                    <hr />
                    <div class="row-fluid wizard-actions">
                      <button class="btn btn-success btn-next" data-last="Finish ">
                        Update                                            
                      </button>
                    </div>
                    </form>
                  </div>
                </div><!--/widget-main-->
              </div><!--/widget-body-->
            </div>
          </div>
        </div>

      </div><!--/.span-->
    </div><!--/.row-fluid-->
  </div><!--/.page-content-->  
</div><!--/.main-content-->


<!-- *******  Start for Date picker  *******-->

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
  $(function() {
    $('.date-picker').datepicker({
      changeMonth:true,
      changeYear:true
    });
    $('.date-picker').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
                                			
  });
</script>
<!-- *******  End for Date picker  *******-->





<!-- *******************************   Form Validations   ****************************** -->

<script type="text/javascript">
  $('#studentform').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
      form_no: {
        required: true
      },
      roll_no: {
        required: true
      },
                    
      current_session: {
        required: true
      },
      enrolment_session: {
        required: true
      },
      shift: {
        required: true
      },
      batch: {
        required: true
      },
      program: {
        required: true
      },
                    
      name: {
        required: true
      },
      father_name: {
        required: true
      },
      nationality: {
        required: true
      },
      religion: {
        required: true
      },
      cnic: {
        required: true,
        minlength: 15,
        maxlength: 15
      },
      dob: {
        required: true
      },
      email: {
        required: true
      },
      phone: {
        required: true
      },
      mobile: {
        required: true
      },
      present_address: {
        required: true
      },
      present_city: {
        required: true
      },
      permanent_address: {
        required: true
      },
      permanent_city: {
        required: true
      },
      guardian_name: {
        required: true
      },
      guardian_relation: {
        required: true
      },
      guardian_occupation: {
        required: true
      },
      //                    guardian_designation: {
      //                        required: true
      //                    },
      guardian_income: {
        required: true
      },
      guardian_address: {
        required: true
      },
      guardian_city: {
        required: true
      },
      guardian_mobile: {
        required: true
      },
      
      emergency_name: {
        required: true
      },
      emergency_relation: {
        required: true
      },
      emergency_address: {
        required: true
      },
      emergency_city: {
        required: true
      },      
      emergency_mobile: {
        required: true
      },
      previous_qualification: {
        required: true
      },
      previous_totalmarks: {
        required: true,
        number:true
      },
      previous_rollno: {
        required: true
      },                    
      previous_institute: {
        required: true
      },                    
      previous_subject: {
        required: true
      },                    
      previous_grade: {
        required: true
      },                    
      previous_year: {
        required: true
      },                    
      previous_obtainedmarks: {
        required: true,
        number:true
      }
    },
                
    highlight: function(e) {
      $(e).closest('.control-group').removeClass('info').addClass('error');
    },
    submitHandler: function(form) {
      document.validationForm.action = "<?php echo base_url(); ?>forms/add_studentform";
      document.validationForm.submit();
    }                
  });
            
            
  jQuery(function($){
    $("#mobile").mask("9999-9999999");
    $("#cnic").mask("99999-9999999-9");
    $("#guardian_mobile").mask("9999-9999999");
    $("#guardian_phone").mask("9999-9999999");
    $("#kinship_mobile").mask("9999-9999999");
    $("#kinship_phone").mask("9999-9999999");
    $("#emergency_phone").mask("9999-9999999");
    $("#emergency_mobile").mask("9999-9999999");
  });

</script>   