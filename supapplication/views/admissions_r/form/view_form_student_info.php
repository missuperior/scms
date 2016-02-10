<?php //echo  '<pre>';var_dump($form_data);echo  '</pre>';exit;?>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">STUDENT FORM INFO</a>                
            </li>            
        </ul>

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
        <div class="page-header position-relative">
            <h1>
                Student Form Information
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> 
                    </a>
                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="table-header">
                                       <h3>Student Form Info</h3>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Form No.</th>
                                                <td><?php echo $form_data[0]['form_no'];?>
                                                </td>                                        
                                            </tr>
                                            <tr>                                                                        
                                                <th>Student Name</th>
                                                <td><?php echo $form_data[0]['student_name'];?></td>                                        
                                            </tr>
                                            <tr>                                                                        
                                                <th>Father Name</th>
                                                <td><?php echo $form_data[0]['father_name'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Gender</th>
                                                <td><?php echo $form_data[0]['gender'];?></td>                                        
                                            </tr>
                                            <tr>                                                                        
                                                <th>Contact</th>
                                                <td><?php echo $form_data[0]['mobile'];?></td>                                        
                                            </tr>
                                            
                                            <tr>                                                                        
                                                <th>Shift</th>
                                                <td><?php echo $form_data[0]['shift'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Program</th>
                                                <td><?php echo $form_data[0]['program_name'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Campaign</th>
                                                <td><?php echo $form_data[0]['campaign_name'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Campus</th>
                                                <td><?php echo $form_data[0]['campus_name'];?></td>                                        
                                            </tr>
                                                                                    
                                            <tr>                                                                        
                                                <th>Form Date</th>
                                               <td><?php echo $form_data[0]['form_submit_date'];?></td>                                        
                                            </tr>
                                        </tbody>
                                    </table>
                
                
                
               
            </div>
        </div>
        
        
        <div class="hr hr-18 hr-double dotted"></div>

        <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">EDIT STUDENT FORM</h4>                               
              </div>

              

                  <div class="row-fluid">


                    <form class="form-horizontal" id="studentform" method="POST" action="<?php echo base_url(); ?>admission_r/update_student_form_info" enctype="multipart/form-data" />

                    <div class="step-content row-fluid position-relative" id="step-container">
                      <div class="step-pane active" id="step1">


                        <!-- *************************************    Start Student Table Information  *************************************************** -->
                         
                        <div style="width: 50%; float: left;margin-bottom: 15px;" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Form No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <?php echo $form_data[0]['form_no'];?>
                                <input style="width: 200px;" type="hidden" name="form_no" id="form_no" value="<?php if(set_value('form_no')){echo set_value('form_no'); }else { echo $form_data[0]['form_no'];}?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="form_id" id="form_id" value="<?php if(set_value('form_no')){echo set_value('form_no'); }else { echo $form_data[0]['form_id'];}?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="inquiry_id" id="inquiry_id" value="<?php echo $form_data[0]['inquiry_id'];?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $form_data[0]['campaign_id'];?>" class="span6" />
                                
<!--                                <input style="width: 200px;" type="hidden" name="initial_form_id" id="initial_form_id" value="<?php //echo $initial[0]['initial_form_id'];?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="campaign_id" id="campaign_id" value="<?php //echo $initial[0]['campaign_id'];?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="campaign_name" id="campaign_name" value="<?php //echo $initial[0]['campaign_name'];?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="inquiry_id" id="inquiry_id" value="<?php //echo $initial[0]['inquiry_id'];?>" class="span6" />
                                <input style="width: 200px;" type="hidden" name="campus_id" id="campus_id" value="<?php //echo $initial[0]['campus_id'];?>" class="span6" />-->
                            </div>
                          </div>
                        </div>

                       
                        <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Shift: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select onchange="getProgram(this.value)" style="width: 200px;" id="shift" name="shift" class="chzn-select" data-placeholder="Click to Choose...">
                                    <option value="">-- Select Shift --</option>
                                    <option <?php if($form_data[0]['shift'] == "Morning") echo 'selected="selected"'; ?> value="Morning">Morning</option>
                                    <option <?php if($form_data[0]['shift'] == "Evening") echo 'selected="selected"'; ?> value="Evening">Evening</option>
                                    <option <?php if($form_data[0]['shift'] == "Weekends") echo 'selected="selected"'; ?> value="Weekends">Weekend</option>
                             </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 50%; float: left; margin-bottom: 15px" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Program: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12"  id="prog">
                              <select style="width: 201px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                <option value="">-- Select Program --</option>
                                  <?php foreach ($programs as $row) { ?>
                                      <option <?php if (set_value('program') == $row['program_id']){echo 'selected="selected"';} if($form_data[0]['program_id'] == $row['program_id']) {echo 'selected="selected"';}  ?>
                                          value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                  <?php } ?>																			
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <!-- campus update--> 
                        <div style="width: 50%;margin-bottom: 15px; float: left" class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Campus: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                          <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                              <select style="width: 200px;" id="campus" name="campus" class="chzn-select" data-placeholder="Click to Choose...">
                                    <?php foreach ($campuses as $campus){ ?>
                                    <option <?php if($form_data[0]['campus_id'] == $campus["campus_id"]) echo 'selected="selected"'; ?> value="<?php echo $campus['campus_id']; ?>"><?php echo $campus['campus_name'];?></option>
                                    <?php } ?>
                             </select>
                            </div>
                          </div>
                        </div>
                        <!-- campus update --> 
                      </div>
                                <input type="hidden" name="old_shift" value="<?php echo $form_data[0]['shift'] ?>"/>
                                <input type="hidden" name="old_program_id" value="<?php echo $form_data[0]['program_id'] ?>"/>
                                <input type="hidden" name="old_campus_id" value="<?php echo $form_data[0]['campus_id'] ?>"/>
                        <input type="submit" class="btn btn-success btn-next" value="Save">
                    
                    </div>

                        <!-- *************************************    End Student table Information  *************************************************** -->

                  </form>
        
        
        
        
        
    </div>
</div>
</div>
</div>
        <script type="text/javascript">
        function getProgram(value)
   {
       if(value!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'type':value,
                         },
                    url: "<?php echo base_url();?>admission_r/get_program_info",
                    
                    success:function(data){
                        $("#prog").html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Shift');
              }            
              
   }
   
   
    $('#studentform').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
                
            program: {
                required: true
            },            
            shift: {
                required: true
            },            
            campus: {
                required: true
            }
          
        },
        messages: {
            email: {
                required: "Please provide a valid email.",
                email: "Please provide a valid email."
            },
            password: {
                required: "Please specify a password.",
                minlength: "Please specify a secure password."
            },
            subscription: "Please choose at least one option",
            gender: "Please choose gender",
            agree: "Please accept our policy"
        },
        highlight: function(e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },
        submitHandler: function(form) {
            document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_inquiry";
            document.validationForm.submit();
        },
        invalidHandler: function(form) {
        }

    });
   
        </script>
        