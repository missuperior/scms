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
                                            <input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id; ?>" />

                                            <div class="row-fluid" style="float:left; ">
                                                <label style="float: left; margin: 5px 10px 0 40px;">Session : </label>

                                                <select style="width:600px" name="mid_session" id="mid_session" data-placeholder="Choose a Country...">
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

                                                        <select onchange="getMidStructure(this.value, this.id)" style="width:207px; margin-right: 5px; float: left;" name="course[]" id="1" data-placeholder="Choose a Country...">
                                                                <option value="">Select Course</option>
                                                                <?php foreach ($courses as $row) { ?>
                                                                <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                <?php } ?>  
                                                        </select>
                                                        <div id="mid1" style="width:400px; height: 80px; float: left; ">
                                                                                                                           
                                                        </div>
                                                        
                                                        
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

                                                <select style="width:83%"  name="final_session" id="final_session" data-placeholder="Choose a Country...">
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

                                                        <select onchange="getFinalStructure(this.value, this.id)" style="width:83%; margin-right: 5px" name="course[]" id="11" data-placeholder="Choose a Country...">
                                                            <option value="">Select Course</option>
                                                                <?php foreach ($courses as $row) { ?>
                                                                <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                <?php } ?>  
                                                        </select>
                                                        
                                                        <div id="final11" style="width:100%; height: 80px; float: left; ">
                                                                                                                           
                                                        </div>
                                                        
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
            
            var session_id  =   $("#mid_session").val();
            var program_id  =   $("#program_id").val();
            
            if(course_id!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'course_id':course_id,
                        'session_id':session_id,
                        'program_id':program_id,
                        'div_id'    :div_id,
                    },
                    url: "<?php echo base_url();?>examination_de/getMidStructure",
                    //url: base_url+"examination_de/getMidStructure/course_id="+course_id+"&session_id="+session_id,
                    success:function(data){
                        $("#mid"+div_id).html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Course');
              }
            
            
            
        }
    
    
        function getFinalStructure(course_id,div_id)
        {
            
            var session_id  =   $("#final_session").val();
            var program_id  =   $("#program_id").val();
            
            if(course_id!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'course_id':course_id,
                        'session_id':session_id,
                        'program_id':program_id,
                        'div_id'    :div_id,
                    },
                    url: "<?php echo base_url();?>examination_de/getFinalStructure",                    
                    success:function(data){                       
                        $("#final"+div_id).html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Course');
              }
            
            
            
        }
    
    
    
        function add_more_mid()
        {
             var id   = $("#midid").val();             
             id       = parseInt(id)+1;             
             $("#midid").val(id);          
             var html   = '<div class="row-fluid" style="float:left; width:960px;" id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label><select onchange="getMidStructure(this.value, this.id)" style="width:207px; margin-right: 5px; float:left;" name="course[]" id="'+id+'" data-placeholder="Choose a Country..."><option value="">Select Course</option><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?></select><div id="mid'+id+'" style="width:400px; height: 80px; float: left; "></div></div>';
             
             $("#addMoreMid").append(html);                               
             
        }
        
        function add_more_final()
        {
             var id   = $("#finalid").val();             
             id       = parseInt(id)+1;             
             $("#finalid").val(id);          
             var html = '<div class="row-fluid" style="float:left; width:100%;" id="'+id+'"><label style="float: left; margin: 5px 10px 0 38px;">Courses : </label><select onchange="getFinalStructure(this.value, this.id)" style="width:83%; margin-right: 5px" name="course[]" id="'+id+'" data-placeholder="Choose a Country..."><option value="">Select Course</option><?php foreach ($courses as $row) { ?><option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option><?php } ?></select><div id="final'+id+'" style="width:100%; height: 80px; float: left; "></div></div>';
             
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
        
       function validate_mid(value,id)
       {  
           
           var lastChar = id.substr(id.length - 2);           
           var total = $("#mtotal"+lastChar).val();          
           if(parseInt(value) > parseInt(total))
           {               
               $("#"+id).val('');
           }else{
                var element = document.getElementById(id);
                var match = value.match(/[^0-9\.]/g);
                 if(match)
                 {
                    $(element).val('');
                 }
            }
        }
        
        // validate marks field to number only
        
       function validate_final(value,id)
       {             
           var lastChar = id.substr(id.length - 3);           
           var total = $("#ftotal"+lastChar).val();
           //alert(total);
           if(parseInt(value) > parseInt(total))
           {               
               $("#"+id).val('');
           }else{
                var element = document.getElementById(id);
                var match = value.match(/[^0-9\.]/g);
                 if(match)
                 {
                    $(element).val('');
                 }
            }
        }

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