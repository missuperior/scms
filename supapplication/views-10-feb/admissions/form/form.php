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
                <h4 class="lighter">ADD STUDENT FORM</h4>                               
              </div>

              <div class="widget-body">
                <div class="widget-main">

                  <div class="row-fluid">


                    <form class="form-horizontal" id="studentform" method="POST" action="<?php echo base_url(); ?>admission/add_studentform" enctype="multipart/form-data" />

                    <div class="step-content row-fluid position-relative" id="step-container">
                      <div class="step-pane active" id="step1">


                        <!-- *************************************    Start Student Table Information  *************************************************** -->
                   

                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Form No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="form_no" id="form_no" value="<?php echo set_value('form_no'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="roll_no" id="roll_no"  value="<?php echo set_value('roll_no'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                           <label style="width: 130px;" class="control-label" for="email">Current Session:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="current_session" name="current_session" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Session --</option>
                                <?php foreach ($sessions as $row) { ?>
                                  <option <?php if (set_value('current_session') == $row['session_id'])
                                    echo 'selected="selected"'; ?> value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                <?php } ?>																				
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 145px; margin-left: -15px;" class="control-label" for="email">Enrollment Session: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="enrolment_session" name="enrolment_session" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Session --</option>
                                <?php foreach ($sessions as $row) { ?>
                                  <option <?php if (set_value('enrolment_session') == $row['session_id'])
                                  echo 'selected="selected"'; ?> value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>
                      

                        <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Shift: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="shift" name="shift" class="select2" data-placeholder="Click to Choose...">
                                 <option value="">-- Select Shift --</option>
                                                                <option <?php if($initial[0]['shift'] == "Morning") echo 'selected="selected"'; ?> value="Morning">Morning</option>
                                                                <option <?php if($initial[0]['shift'] == "Evening") echo 'selected="selected"'; ?> value="Evening">Evening</option>
                                                                <option <?php if($initial[0]['shift'] == "Weekend") echo 'selected="selected"'; ?> value="Weekend">Weekend</option>																		
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Batch: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="batch" name="batch" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Batch --</option> 
                                  <?php foreach ($batches as $row) { ?>
                                        <option <?php if (set_value('batch') == $row['batch_id'])
                                      echo 'selected="selected"'; ?> value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch'] . ' - ' . $row['batch_type'] ?></option> 
                                  <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Program: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="program" name="program" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Program --</option>
                                  <?php foreach ($programs as $row) { ?>
                                      <option <?php if (set_value('program') == $row['program_id'])
                                      echo 'selected="selected"'; ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                  <?php } ?>																			
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
                              <input style="width: 200px;" type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"  class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Father's Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="father_name" id="father_name" value="<?php echo set_value('father_name'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Nationality: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="nationality" id="nationality" value="<?php echo set_value('nationality'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Religion: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="religion" id="religion" value="<?php echo set_value('religion'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">C.N.I.C: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="cnic" id="cnic" value="<?php echo set_value('cnic'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="id-date-picker-1">Date of Birth: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="dob" id="dob" value="<?php echo set_value('dob'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>

                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Email: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px; margin-top: 20px;" class="control-group">
                          <label style="width: 130px;" class="control-label">Gender: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div  style="margin-left: 140px;" class="controls">
                            <span class="span12">
                              <label class="blue">
                                <input name="gender" value="male" type="radio"   checked/>
                                <span class="lbl"> Male</span>
                              </label>
                              <label class="blue">
                                <input name="gender" value="female" type="radio" />
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
                                <input name="marital_status" value="Single" type="radio"   checked/>
                                <span class="lbl"> Single </span>
                              </label>
                              <label class="blue">
                                <input name="marital_status" value="Married" type="radio" />
                                <span class="lbl"> Married</span>
                              </label>
                            </span>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">Address (Present):<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="present_address" id="present_address" value="<?php echo set_value('present_address'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">City (Present): <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="present_city" name="present_city" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option>
                                  <?php foreach ($cities as $row) { ?>
                                      <option <?php if (set_value('present_city') == $row['city_id'])
                                      echo 'selected="selected"'; ?> value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
                                  <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">Address(Permnet):<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="permanent_address" id="permanent_address" value="<?php echo set_value('permanent_address'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 35px;" class="control-group">
                          <label style="width: 140px;" class="control-label" for="email">City (Permanent): <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select  style="width: 201px;" id="permanent_city" name="permanent_city" class="select2" data-placeholder="Click to Choose...">

                                <option value="">-- Select City --</option>
                                  <?php foreach ($cities as $row) { ?>
                                      <option <?php if (set_value('permanent_city') == $row['city_id'])
                                      echo 'selected="selected"'; ?> value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
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
                              <input style="width: 200px;" type="text" name="guardian_name" id="guardian_name" value="<?php echo set_value('guardian_name'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_relation" id="guardian_relation" value="<?php echo set_value('guardian_relation'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Occupation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_occupation" id="guardian_occupation" value="<?php echo set_value('guardian_occupation'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Designation:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_designation" id="guardian_designation" value="<?php echo set_value('guardian_designation'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Income: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text" name="guardian_income" id="guardian_income" value="<?php echo set_value('guardian_income'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Address: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text"name="guardian_address" id="guardian_address" value="<?php echo set_value('guardian_address'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>
                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;" type="text"name="guardian_mobile" id="guardian_mobile" value="<?php echo set_value('guardian_mobile'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Phone:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="guardian_phone" id="guardian_phone" value="<?php echo set_value('guardian_phone'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">City: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="guardian_city" name="guardian_city" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option>                                                               
<?php foreach ($cities as $row) { ?>
                                  <option <?php if (set_value('guardian_city') == $row['city_id'])
    echo 'selected="selected"'; ?> value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
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
                              <input style="width: 200px;"  type="text"name="emergency_name" id="emergency_name" value="<?php echo set_value('emergency_name'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_relation" id="emergency_relation" value="<?php echo set_value('emergency_relation'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Address: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_address" id="emergency_address" value="<?php echo set_value('emergency_address'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">City: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="emergency_city" name="emergency_city" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select City --</option> 
<?php foreach ($cities as $row) { ?>
                                  <option <?php if (set_value('emergency_city') == $row['city_id'])
    echo 'selected="selected"'; ?> value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
<?php } ?>																				
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Mobile: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_mobile" id="emergency_mobile" value="<?php echo set_value('emergency_mobile'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Phone:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="emergency_phone" id="emergency_phone" value="<?php echo set_value('emergency_phone'); ?>" class="span6" />
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
                              <input style="width: 200px;"  type="text"name="kinship_name" id="kinship_name" value="<?php echo set_value('kinship_name'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Relation:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="kinship_relation" id="kinship_relation" value="<?php echo set_value('kinship_relation'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>                                                                                                                                                                                                                                                                                              


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="kinship_rollno" id="kinship_rollno" value="<?php echo set_value('kinship_rollno'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Program:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="kinship_program" name="kinship_program"  class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Program --</option>
<?php foreach ($programs as $row) { ?>
                                  <option <?php if (set_value('kinship_program') == $row['program_id'])
    echo 'selected="selected"'; ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
<?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>                                                                                                

                        <div style="width: 50%;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Batch:</label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="kinship_batch" name="kinship_batch" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Batch --</option> 
<?php foreach ($batches as $row) { ?>
                                  <option <?php if (set_value('kinship_batch') == $row['batch_id'])
    echo 'selected="selected"'; ?> value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch'] . ' - ' . $row['batch_type']; ?></option> 
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
                              <input style="width: 200px;"  type="text"name="previous_qualification" id="previous_qualification" value="<?php echo set_value('previous_qualification'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Roll No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_rollno" id="previous_rollno" value="<?php echo set_value('previous_rollno'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>                                                                                                                                                                                                                                                                                                                                                                                              

                        <div style="width: 50%; float: left;  margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Subjects: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_subject" name="previous_subject" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Subject --</option>
                                <option <?php if (set_value('previous_subject') == 1)
                                        echo 'selected="selected"'; ?> value="1" />Science
                                <option <?php if (set_value('previous_subject') == 2)
                                        echo 'selected="selected"'; ?> value="2" />Arts
                                <option <?php if (set_value('previous_subject') == 3)
                                        echo 'selected="selected"'; ?> value="3" />Social																		                                                                																			
                                <option <?php if (set_value('previous_subject') == 4)
                                        echo 'selected="selected"'; ?> value="4" />N/A																		                                                                																			
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;  margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Institute: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_institute" name="previous_institute" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Institute --</option>
                                <?php foreach ($institutes as $row) { ?>
                                  <option <?php if (set_value('previous_institute') == $row['institute_id'])
                                        echo 'selected="selected"'; ?> value="<?php echo $row['institute_id'] ?>"><?php echo $row['institute_name']; ?></option> 
                                 <?php } ?>																		                                                                																			
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Total Marks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_totalmarks" id="previous_totalmarks" value="<?php echo set_value('previous_totalmarks'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left; margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Obtained Marks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <input style="width: 200px;"  type="text"name="previous_obtainedmarks" id="previous_obtainedmarks" value="<?php echo set_value('previous_obtainedmarks'); ?>" class="span6" />
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Grade: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_grade" name="previous_grade" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Grade --</option>
                                <option <?php if (set_value('previous_grade') == 1)
  echo 'selected="selected"'; ?> value="1" />A
                                <option <?php if (set_value('previous_grade') == 2)
  echo 'selected="selected"'; ?> value="2" />B
                                <option <?php if (set_value('previous_grade') == 3)
  echo 'selected="selected"'; ?> value="3" />C																				
                                <option <?php if (set_value('previous_grade') == 4)
  echo 'selected="selected"'; ?> value="4" />D																				
                                <option <?php if (set_value('previous_grade') == 5)
  echo 'selected="selected"'; ?> value="5" />E																				                              
                                <option <?php if (set_value('previous_grade') == 6)
  echo 'selected="selected"'; ?> value="6" />N/A																				
                              </select>
                            </div>
                          </div>
                        </div>

                        <div style="width: 50%; float: left;  margin-bottom: 35px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Year: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 201px;" id="previous_year" name="previous_year" class="select2" data-placeholder="Click to Choose...">
                                <option value="">-- Select Year --</option>
                                <option <?php if (set_value('previous_year') == 1)
  echo 'selected="selected"'; ?> value="1" />2006
                                <option <?php if (set_value('previous_year') == 2)
  echo 'selected="selected"'; ?> value="2" />2007
                                <option <?php if (set_value('previous_year') == 3)
  echo 'selected="selected"'; ?> value="3" />2008
                                <option <?php if (set_value('previous_year') == 4)
  echo 'selected="selected"'; ?> value="4" />2009
                                <option <?php if (set_value('previous_year') == 5)
  echo 'selected="selected"'; ?> value="5" />2010
                                <option <?php if (set_value('previous_year') == 6)
  echo 'selected="selected"'; ?> value="6" />2011
                                <option <?php if (set_value('previous_year') == 7)
  echo 'selected="selected"'; ?> value="7" />2012
                                <option <?php if (set_value('previous_year') == 8)
  echo 'selected="selected"'; ?> value="8" />2013
                                <option <?php if (set_value('previous_year') == 9)
  echo 'selected="selected"'; ?> value="9" />2014
                                <option <?php if (set_value('previous_year') == 10)
  echo 'selected="selected"'; ?> value="10" />2015

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
                        Save                                            
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