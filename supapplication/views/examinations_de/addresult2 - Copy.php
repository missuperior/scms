<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Program Manager Dashboard </a>
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

        <div class="page-header position-relative">
            <h1>
                Course Allocation   
            </h1>
        </div><!--/.page-header-->

        <h4 class="lighter">
            <a href="" style="text-decoration: none" class="pink">
                <?php echo $this->session->userdata('success');
                $this->session->unset_userdata('success'); ?>
<?php echo $this->session->userdata('error');
$this->session->unset_userdata('error'); ?>
            </a>
        </h4>

        <div class="row-fluid">
            <div class="span12">                                                                     

                <!-- *****   Define  Mid term structure   ***** -->          
                <div class="row-fluid">                                    
                    <div class="table-header" >
                        <h3>Add Result
                            <a style="color: White; float: right; margin-right:10px;" href="<?php echo base_url()?>examination_de/view_result/?student_id=<?php echo $student_id; ?>"> View Result</a>
                        </h3>
                    </div>

                    <div class="row-fluid" >
                        <div class="span4" style="width:100%; min-height: 500px; height: auto;">
                            <div class="widget-box" >
                                <div class="widget-header" id="mid-header" style="cursor:pointer">
                                    <h4 style="color:#003d43">Mid Term</h4>
                                </div>

                                <div class="widget-body" id="mid" style=" min-height: 300px; height: auto;">

                                    <form name="midtermform" id="midtermform" method="post" action="<?php echo base_url() ?>examination_de/add_mid_result" enctype="multipart/form-data">

                                        <div class="widget-main" id="div1" style="min-height: 525px; height: auto;">

                                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
                                            <input type="hidden" name="start_session_id" value="<?php echo $start_session_id; ?>" />
                                            <input type="hidden" name="program_id" value="<?php echo $program_id; ?>" />

                                            <div class="row-fluid" style="float:left; ">
                                                <label style="float: left; margin: 5px 10px 0 40px;">Session : </label>

                                                <select style="width:600px" name="session" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                    <?php
                                                    foreach ($sessions as $row) {
                                                        if ($row['session_id'] >= $start_session_id) {
                                                            ?>
                                                            <option   value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                                            <?php } } ?>  
                                                </select>
                                            </div>
                                           
                                            <div id="addMoreMid">
                                                <input type="hidden" id="midid" name="midid" value="1"/>
                                                <div class="row-fluid" style="float:left; width:960px;" id="1">
                                                        <label style="float: left; margin: 5px 10px 0 38px;">Courses : </label>

                                                        <select onchange="getMidStructure(this.value, this.id)" style="width:207px; margin-right: 5px" name="course[]" id="1" data-placeholder="Choose a Country...">
                                                                <?php foreach ($courses as $row) { ?>
                                                                <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                <?php } ?>  
                                                        </select>
                                                        
                                                        <input class="span1" style="background-color:#f4f4f4" value="" type="text" name="mtitle1[]" id="mtitle1" placeholder="Title" readonly/>
                                                        <input class="span1" style="background-color:#f4f4f4" value="" type="text" name="mtotal1[]" id="mtotal1" placeholder="T/Marks" readonly/>
                                                        
                                                        
                                                        <input class="span1" style=" background-color:#f4f4f4" value="" type="text" name="mtitle2[]" id="mtitle2" placeholder="Title"  readonly />
                                                        <input class="span1" style=" background-color:#f4f4f4" value="" type="text" name="mtitle2[]" id="mtotal2" placeholder="T/Marks" readonly />
                                                        
                                                        
                                                        <input class="span1" style=" background-color:#f4f4f4" value="" type="text" name="mtitle3[]" id="mtitle3" placeholder="Title" readonly />
                                                        <input class="span1" style=" background-color:#f4f4f4" value="" type="text" name="mtitle3[]" id="mtotal3" placeholder="T/Marks" readonly />
                                                        
                                                
                                                        
                                                        <input class="span2" style=" width: 13.1%; margin-left: 325px; " type="text" name="mvalue1[]"  class="mvalue" id="mvalue1" placeholder="Obtained Marks" />
                                                        <input class="span2" style=" width: 13.1%;" type="text" name="mvalue2[]"  class="mvalue" id="mvalue2" placeholder="Obtained Marks" />
                                                        <input class="span2" style=" width: 13.1%;" type="text" name="mvalue3[]"  class="mvalue" id="mvalue3" placeholder="Obtained Marks" />
                                           
                                                </div>
                                                
                                            </div>

                                            <label onclick="add_more_mid()" style=" color: #003D43; font-size: 18px; height: 30px; line-height: 25px;  margin-left: 108px;   width: 210px;"> Add More </label>

                                        </div>

                                        <div class="form-actions center">
                                            <input type="submit" value="Submit" class="btn btn-small btn-success" >

                                            </input>
                                        </div>
                                    </form> 
                                </div>

                            </div>
                            
                            
                            
                             <div class="widget-box" >
                                <div class="widget-header" id="final-header" style="cursor:pointer">
                                    <h4 style="color:#003d43">Final Term</h4>
                                </div>

                                <div class="widget-body" id="final" style="min-height: 300px; height: auto;">

                                    <form name="finaltermform" id="finaltermform" method="post" action="<?php echo base_url() ?>examination_de/add_final_result" enctype="multipart/form-data">

                                        <div class="widget-main" id="div2"  style="min-height: 525px; height: auto;">

                                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
                                            <input type="hidden" name="start_session_id" value="<?php echo $start_session_id; ?>" />

                                            <div class="row-fluid" style="float:left; ">
                                                <label style="float: left; margin: 5px 10px 0 40px;">Session : </label>

                                                <select style="width:83%"  name="session" id="session" data-placeholder="Choose a Country...">
                                                    <?php
                                                    foreach ($sessions as $row) {
                                                        if ($row['session_id'] >= $start_session_id) {
                                                            ?>
                                                            <option   value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                                            <?php } } ?>  
                                                </select>
                                            </div>
                                           
                                            <div id="addMoreFinal">
                                                <input type="hidden" id="finalid" name="finalid" value="11"/>
                                                <div class="row-fluid" style="float:left; width:100%;" id="11">
                                                        <label style="float: left; margin: 5px 10px 0 38px;">Courses : </label>

                                                        <select style="width:83%; margin-right: 5px" name="course[]" id="course" data-placeholder="Choose a Country...">
                                                                <?php foreach ($courses as $row) { ?>
                                                                <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                <?php } ?>  
                                                        </select>
                                                        
                                                        <input class="span1" style="background-color:#f4f4f4; margin-left: 23px;" type="text" name="ftitle1[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle2[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle3[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle4[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle5[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle6[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle7[]" placeholder="Title" />
                                                        
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle1[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle2[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle3[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle4[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle5[]" placeholder="T/Marks" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle6[]" placeholder="Title" />
                                                        <input class="span1" style="background-color:#f4f4f4" type="text" name="ftitle7[]" placeholder="T/Marks" />
                                                        
                                                        <input class="span1" style="margin-left: 3px;width: 13.1%; margin-left: 23px;" type="text" class="fvalue" name="fvalue1[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue2[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue3[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue4[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue5[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue6[]" placeholder="Marks" />
                                                        <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue7[]" placeholder="Marks" />
                                                        
                                                        
                                                        
                                                </div>
                                                
                                            </div>

                                            <label onclick="add_more_final()" style=" color: #003D43; font-size: 18px; height: 30px; line-height: 25px;  margin-left: 23px;   width: 210px;"> Add More </label>

                                        </div>

                                        <div class="form-actions center">
                                            <input type="submit" value="Submit" class="btn btn-small btn-success" >

                                            </input>
                                        </div>
                                    </form> 
                                </div>

                            </div>
                        </div><!--/span-->

                    </div><!--/row-->

                </div>
            </div> 
        </div><!--/.page-content-->

    </div><!--/.main-content-->
</div><!--/.main-container--> 

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js"></script>

<script>
// hide and show div

$(document).ready(function(){
  $("#mid-header").click(function(){
    $("#mid").toggle();    
  });
  $("#final-header").click(function(){
    $("#final").toggle();
  });
});




</script>

<script>
    
        function getMidStructure(course_id,div_id)
        {
            
            alert(div_id);
            var session_id = $("#session").val();
            
        }
    
    
    
        function add_more_mid()
        {
             var id   = $("#midid").val();             
             id       = parseInt(id)+1;             
             $("#midid").val(id);          
             var html   = '<div class="row-fluid" style="float:left; width:960px;" id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label><select style="width:207px; margin-right: 5px" name="course[]" id="form-field-select-3" data-placeholder="Choose a Country..."><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?></select><input class="span1" style="margin-left: 3px; background-color:#f4f4f4" value="Paper" type="text" name="mtitle1[]" placeholder="Title" /><input class="span1" style="margin-left: 3px; background-color:#f4f4f4" value="15" type="text" name="mtotal1[]" placeholder="T/Marks" /><input class="span1" style=" margin-left: 3px; background-color:#f4f4f4" value="Quiz" type="text" name="mtitle2[]" placeholder="Title" /><input class="span1" style=" margin-left: 3px; background-color:#f4f4f4" value="05" type="text" name="mtitle2[]" placeholder="T/Marks" /><input class="span1" style=" margin-left: 3px; background-color:#f4f4f4" value="Objective" type="text" name="mtitle3[]" placeholder="Title" /><input class="span1" style="margin-left: 3px; background-color:#f4f4f4" value="10" type="text" name="mtitle3[]" placeholder="T/Marks" /><input class="span2" style=" width: 13.1%; margin-left: 325px; " type="text" name="mvalue1[]"  class="mvalue" id="mvalue1" onkeyup="mid_value(this.value)" placeholder="Obtained Marks" /><input class="span2" style=" width: 13.1%; margin-left: 4px;" type="text" name="mvalue2[]"  class="mvalue" id="mvalue2" onkeyup="mid_value(this.value)" placeholder="Ob Marks" /><input class="span2" style=" width: 13.1%; margin-left: 4px;" type="text" name="mvalue3[]" onkeyup="mid_value(this.value)"  class="mvalue" id="mvalue3" placeholder="Ob Marks" /><img onclick="remove_div_mid('+id+')"  style="margin: 7px 5px; vertical-align: top;" width="20" src="<?php echo base_url()?>assets/img/del.jpg" ></div>';
             //var html = '<div class="row-fluid" style="float:left; width:710px; " id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label>\n\<select style="width:207px; margin-right: 5px" name="course[]" id="form-field-select-3" data-placeholder="Choose a Country..."><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?>  </select><input class="span1" style="background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle1[]" placeholder="Title" /><input class="span1" style="margin: 0 0 10px;" type="text" class="mvalue" onkeyup="mid_value(this.value)" name="mvalue1[]" placeholder="Marks" /><input class="span1" style="background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle2[]" placeholder="Title" /><input class="span1" style=" margin: 0 0 10px;" type="text" onkeyup="mid_value(this.value)" class="mvalue" name="mvalue2[]" placeholder="Marks" /><input class="span1" style=" background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle3[]" placeholder="Title" /><input class="span1" style=" margin: 0 0 10px;" type="text" class="mvalue" onkeyup="mid_value(this.value)" name="mvalue3[]" placeholder="Marks" /><img onclick="remove_div_mid('+id+')"  style="margin: 7px 5px; vertical-align: top;" width="20" src="<?php echo base_url()?>assets/img/del.jpg" ></div>';                                           
             //var html = '<div class="row-fluid" style="float:left; width:710px; " id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label>\n\<select style="width:207px; margin-right: 5px" name="course[]" id="form-field-select-3" data-placeholder="Choose a Country..."><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?>  </select><input style="width:55px; background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle1[]" placeholder="Title" /><input style="width:40px; margin: 0 0 10px;" type="text" class="mvalue" onkeyup="mid_value(this.value)" name="mvalue1[]" placeholder="Marks" /><input style="width:55px; background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle2[]" placeholder="Title" /><input style="width:40px; margin: 0 0 10px;" type="text" onkeyup="mid_value(this.value)" class="mvalue" name="mvalue2[]" placeholder="Marks" /><input style="width:55px; background-color:#f4f4f4; margin: 0 3px 10px;" type="text" name="mtitle3[]" placeholder="Title" /><input style="width:40px; margin: 0 0 10px;" type="text" class="mvalue" onkeyup="mid_value(this.value)" name="mvalue3[]" placeholder="Marks" /><img onclick="remove_div_mid('+id+')"  style="margin: 7px 5px; vertical-align: top;" width="20" src="<?php echo base_url()?>assets/img/del.jpg" ></div>';                                           
             $("#addMoreMid").append(html);                               
             
        }
        
        function add_more_final()
        {
             var id   = $("#finalid").val();             
             id       = parseInt(id)+1;             
             $("#finalid").val(id);          
             var html = '<div class="row-fluid" style="float:left; width:100%;" id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label><select style="width:83%; margin-right: 5px" name="course[]" id="form-field-select-3" data-placeholder="Choose a Country..."><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?></select><input class="span1" style="background-color:#f4f4f4;  margin-left: 23px;" type="text" name="ftitle1[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 2px; " type="text" name="ftitle2[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle3[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 3px; " type="text" name="ftitle4[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle5[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 3px; " type="text" name="ftitle6[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle7[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 2px; " type="text" name="ftitle1[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle2[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 2px; " type="text" name="ftitle3[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 2px; " type="text" name="ftitle4[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle5[]" placeholder="T/Marks" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 2px; " type="text" name="ftitle6[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4;    margin-left: 1px; " type="text" name="ftitle7[]" placeholder="T/Marks" /><input class="span1" style="width: 13.1%; margin-left: 23px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue1[]" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue2[]" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue3[]" onkeyup="final_value(this.value)" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue4[]" onkeyup="final_value(this.value)" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue5[]" onkeyup="final_value(this.value)" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue6[]" onkeyup="final_value(this.value)" placeholder="Marks" /><input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue7[]" onkeyup="final_value(this.value)" placeholder="Marks" /><img onclick="remove_div_final('+id+')"  style="margin: 7px 5px; vertical-align: top;" width="20" src="<?php echo base_url()?>assets/img/del.jpg" ></div>';
             //var html = '<div class="row-fluid" style="float:left; width:710px;" id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label><select style="width:160px; margin-right: 5px" name="course[]" id="form-field-select-3" data-placeholder="Choose a Country..."><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?></select><input class="span1" style="background-color:#f4f4f4; margin-left: 3px;   margin-right: 3px; " type="text" name="ftitle1[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle2[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle3[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle4[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle5[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle6[]" placeholder="Title" /><input class="span1" style="background-color:#f4f4f4; margin-right: 3px;" type="text" name="ftitle7[]" placeholder="Title" /><input class="span1" style="margin-left: 278px;  margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue1[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue2[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text"  class="fvalue" onkeyup="final_value(this.value)" name="fvalue3[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue4[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue5[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue6[]" placeholder="Marks" /><input class="span1" style="margin-right: 3px;" type="text" class="fvalue" onkeyup="final_value(this.value)" name="fvalue7[]" placeholder="Marks" /><img onclick="remove_div_final('+id+')"  style="margin: 7px 5px; vertical-align: top;" width="20" src="<?php echo base_url()?>assets/img/del.jpg" ></div>';
             $("#addMoreFinal").append(html);
             
        }
        
        // remove the added div
        
        function remove_div_mid(id)
        {            
            $("#"+id).remove();
        }
        // remove the added div
        
        function remove_div_final(id)
        {            
            $("#"+id).remove();
        }
        
        // validate marks field to number only
for(var i=1; i<=10; i++){
            $('.mvalue').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });
        }
$('.fvalue').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });
            
function mid_value(value)
{
        var match = value.match(/[^0-9\.]/g);
        if(match)
        {
            $(".mvalue").val('');
        }
}

function final_value(value)
{
        var match = value.match(/[^0-9\.]/g);
        if(match)
        {
            $(".fvalue").val('');
        }
}


</script>