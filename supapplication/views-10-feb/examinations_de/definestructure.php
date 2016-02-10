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
                        <?php echo $this->session->userdata('success'); $this->session->unset_userdata('success'); ?>
                        <?php echo $this->session->userdata('error'); $this->session->unset_userdata('error'); ?>
                   </a>
      </h4>

        <div class="row-fluid">
            <div class="span12">                                                                     

 
                                        <!-- *****   Define  Mid term structure   ***** -->          
                                               <div class="row-fluid">                                    
                                                   <div class="table-header" id="mid-header">
                                                       <h3>Define Mid Term Structure</h3>
                                                   </div>

                                      <div class="row-fluid" id="mid" >
                                           <div class="span4" style="width:57.8%; min-height: 400px; height: auto;">
                                               <div class="widget-box" style="min-height: 400px; height: auto;">
                                                   <div class="widget-header">
                                                       <h4 style="color:#003d43">Drop Here</h4>
                                                   </div>

                                                   <div class="widget-body" style="min-height: 400px; height: auto;">

                                                       <form name="midtermform" id="midtermform" method="post" action="<?php echo base_url()?>examination_de/mid_term_structure" enctype="multipart/form-data">

                                                           <div class="widget-main" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 400px; height: auto;">
                                                               <input style="margin-left:20px" type="hidden" value="<?php echo $id; ?>" class="span8" id="course_allocation_id" name="course_allocation_id" >
                                                              
                                                               <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Program : </label>

                                                                   <select style="width:70%" name="program" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                       <?php foreach ($programs as $row) { ?>
                                                                           <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                                        <?php } ?>  
                                                                   </select>
                                                               </div>
                                                               
                                                               <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Session : </label>

                                                                   <select style="width:70%" name="session" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                       <?php
                                                                       foreach ($sessions as $row) {
                                                                          ?>
                                                                               <option   value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                                                          
                                                                       <?php } ?>  
                                                                   </select>
                                                               </div>

                                                               
                                                               <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Courses : </label>

                                                                    <select style="width:70%;" name="course" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                            <?php foreach ($courses as $row) { ?>
                                                                            <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                            <?php } ?>  
                                                                    </select>
                                                               </div>

                                                               
                                                               
                                                               
                                                           </div>

                                                           <div class="form-actions center">
                                                               <input type="submit" value="Define" class="btn btn-small btn-success" >

                                                               </input>
                                                           </div>
                                                       </form> 
                                                   </div>

                                               </div>
                                           </div><!--/span-->

                                           <div class="span4" style="width:40%; min-height:505px; height: auto;">
                                               <div class="widget-box" style="min-height: 505px; height: auto;">
                                                   <div class="widget-header">
                                                       <h4 style="color:#003d43">Dropable</h4>
                                                   </div>

                                                   <div class="widget-body" style="min-height: 528px; height: auto;">
                                                       <div class="widget-main" id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 405px; height: auto;">

                                                           <div draggable="true" ondragstart="drag(event)" id="d1">  
                                                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="mtitle1" name="mtitle[]"   placeholder="Title">
                                                                    <input style="margin-left:20px" type="text" class="span8" id="mvalue1" name="mvalue[]"   placeholder="Marks">
                                                           </div>
                                                           <div draggable="true" ondragstart="drag(event)" id="d2">  
                                                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="mtitle2" name="mtitle[]"   placeholder="Title">
                                                                    <input style="margin-left:20px" type="text" class="span8" id="mvalue2" name="mvalue[]"   placeholder="Marks">
                                                           </div>
                                                           <div draggable="true" ondragstart="drag(event)" id="d3">  
                                                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="mtitle3" name="mtitle[]"   placeholder="Title">
                                                                    <input style="margin-left:20px" type="text" class="span8" id="mvalue3" name="mvalue[]"   placeholder="Marks">
                                                           </div>
 
                                                           
                                                           
                                                       </div>
                                                   </div>
                                               </div>
                                           </div><!--/span-->

                                       </div><!--/row-->
 
       <!-- *****   Define  Final term structure   ***** -->                                                 
                    
                <div class="row-fluid">                                    
                    <div class="table-header" id="final-header">
                        <h3>Define Final Term Structure</h3>
                    </div>

       <div class="row-fluid" id="final" style="display: none">
            <div class="span4" style="width:57.8%; min-height: 560px; height: auto;">
                <div class="widget-box" style="min-height: 560px; height: auto;">
                    <div class="widget-header">
                        <h4 style="color:#003d43">Drop Here</h4>
                    </div>
                    
                    <div class="widget-body" style="min-height: 560px; height: auto;">
                        <form name="finaltermform" id="finaltermform" method="post" action="<?php echo base_url()?>examination_de/final_term_structure" enctype="multipart/form-data">
                            <div class="widget-main" id="div3" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 660px; height: auto;">
                          
                                <input style="margin-left:20px" type="hidden" value="<?php echo $id; ?>" class="span8" id="course_allocation_id" name="course_allocation_id" >
                                
                                 <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Program : </label>

                                                                   <select style="width:70%" name="program" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                       <?php foreach ($programs as $row) { ?>
                                                                           <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                                        <?php } ?>  
                                                                   </select>
                                                               </div>
                                                               
                                                               <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Session : </label>

                                                                   <select style="width:70%" name="session" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                       <?php
                                                                       foreach ($sessions as $row) {
                                                                          ?>
                                                                               <option   value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option> 
                                                                          
                                                                       <?php } ?>  
                                                                   </select>
                                                               </div>

                                                               
                                                               <div class="row-fluid" style="float:left; ">
                                                                   <label style="float: left;  margin: 5px 0 0 20px;  width: 16.6%;">Courses : </label>

                                                                    <select style="width:70%;" name="course" id="form-field-select-3" data-placeholder="Choose a Country...">
                                                                            <?php foreach ($courses as $row) { ?>
                                                                            <option   value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                            <?php } ?>  
                                                                    </select>
                                                               </div>

                                
                                
                                
                                
                                
                            </div>
                            <div class="form-actions center">
                                <input type="submit" value="Define" class="btn btn-small btn-success" >
                                                                    
                                </input>
                            </div>
                        </form> 
                    </div>

                </div>
            </div><!--/span-->

            <div class="span4" style="width:40%; min-height: 663px; height: auto;">
                <div class="widget-box" style="min-height: 663px; height: auto;">
                    <div class="widget-header">
                        <h4 style="color:#003d43">Dropable</h4>
                    </div>

                    <div class="widget-body" style="min-height: 663px; height: auto;">
                        <div class="widget-main" id="div4" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 763px; height: auto;">
                          
                            
                            <div draggable="true" ondragstart="drag(event)" id="d4">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle1" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue1" name="fvalue[]"   placeholder="Marks">
                            </div> 
                            <div draggable="true" ondragstart="drag(event)" id="d5">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle2" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue2" name="fvalue[]"   placeholder="Marks">
                            </div>
                            <div draggable="true" ondragstart="drag(event)" id="d6">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle3" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue3" name="fvalue[]"   placeholder="Marks">
                            </div>
                            <div draggable="true" ondragstart="drag(event)" id="d7">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle4" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue4" name="fvalue[]"   placeholder="Marks">
                            </div>
                            <div draggable="true" ondragstart="drag(event)" id="d8">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle5" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue5" name="fvalue[]"   placeholder="Marks">
                            </div>
                            <div draggable="true" ondragstart="drag(event)" id="d9">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle6" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue6" name="fvalue[]"   placeholder="Marks">
                            </div>
                            <div draggable="true" ondragstart="drag(event)" id="d10">
                                    <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle7" name="ftitle[]"   placeholder="Title">
                                    <input style="margin-left:20px" type="text" class="span8" id="fvalue7" name="fvalue[]"   placeholder="Marks">
                            </div>
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div><!--/span-->

        </div><!--/row-->
      </div>
            </div>
        </div> 
    </div><!--/.page-content-->

</div><!--/.main-content-->
</div><!--/.main-container--> 

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js"></script>


<script>
$("#midtermform").submit(function(){
    var title = document.querySelectorAll("#midtermform input[name='mtitle[]']");
    
    for (i = 0; i < title.length; i++) {
        
        if(title[i].value == '')
        {
            alert("Title Field is required");
            return false;
        }
        
    }
});

$("#midtermform").submit(function(){
    var values = document.querySelectorAll("#midtermform input[name='mvalue[]']");
    
    for (i = 0; i < values.length; i++) {
        
        if(values[i].value == '')
        {
            alert("Value Field is required");
            return false;
        }
        
    }
});

$("#finaltermform").submit(function(){
    var title = document.querySelectorAll("#finaltermform input[name='ftitle[]']");
    
    for (i = 0; i < title.length; i++) {
        
        if(title[i].value == '')
        {
            alert("Title Field is required");
            return false;
        }
        
    }
});

$("#finaltermform").submit(function(){
    var values = document.querySelectorAll("#finaltermform input[name='fvalue[]']");
    
    for (i = 0; i < values.length; i++) {
        
        if(values[i].value == '')
        {
            alert("Value Field is required");
            return false;
        }
        
    }
});


</script>
<!--inline scripts related to this page-->
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
    
// for drag and drop elements    
    
function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));
}
</script>
<script type="text/javascript">
                                        $(function() {
                                            var oTable1 = $('#sampe-table-2').dataTable({
                                                "aoColumns": [
                                                    {"bSortable": true},
                                                    null, null, 
                                                    {"bSortable": false}
                                                ]});

                                            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                                            function tooltip_placement(context, source) {
                                                var $source = $(source);
                                                var $parent = $source.closest('table')
                                                var off1 = $parent.offset();
                                                var w1 = $parent.width();

                                                var off2 = $source.offset();
                                                var w2 = $source.width();

                                                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                                                    return 'right';
                                                return 'left';
                                            }
                                        })
</script>

