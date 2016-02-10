 <script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>

                <!--inline scripts related to this page-->

                <script type="text/javascript"> 

                  $(function() {

                   $(".chzn-select").chosen(); 

                  })

                </script>
<div style="width: 100%;  margin-bottom: 15px; " class="control-group">
    <label style="width: 160px;" class="control-label" for="email">Programs :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 180px;">
        <div class="span12">
            <select onchange="getStudents(this.value)" style="width: 188px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                <option value="">Select Program</option>
                <?php foreach ($program as $row) { ?>
                    <option <?php if($program_id == $row['program_id'])echo 'selected="selected"';?>
                        value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                <?php } ?>																			
            </select>
            <!--<input style="width: 75px;" type="text" name="total_students" value="<?php echo $students - $students_allocated; ?>" id="total_students" class="span5" />-->
        </div>

    </div>
</div>

<div style="margin-left: 180px; color: #635C5C; width:300px;  "> 
    <label style=" width: 150px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Total Students</label><p style="  font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $students; ?></p>    
    <?php foreach ($program_detail AS $row){?>
    <label style=" width: 150px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Allocated Room </label><p style="  font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $row['room_name']; ?></p>
    <!--<label style="font-size: 10px" > <?php echo $row['room_name']; ?> : <?php echo $row['no_of_students']; ?> : <?php echo "Test No ".$row['test_no']; ?> </label>-->
   <?php } ?>
    <label style=" width: 150px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Remaining Students</label><p style="  font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $students - $students_allocated; ?></p>
    <input type="hidden" name="total_students" id="total_students" value="<?php echo $students - $students_allocated; ?>" />
</div>