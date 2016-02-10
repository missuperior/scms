<div style="width: 100%;  margin-bottom: 15px; " class="control-group">
    <label style="width: 160px;" class="control-label" for="email">Programs :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 180px;">
        <div class="span12">
            <select onchange="getStudents(this.value)" style="width: 188px;" id="program" name="program" class="select2" data-placeholder="Click to Choose...">                                                                
                <option value="">Select Program</option>
                <?php foreach ($program as $row) { ?>
                    <option <?php if($program_id == $row['program_id'])echo 'selected="selected"';?>
                        value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                <?php } ?>																			
            </select>
            <input style="width: 75px;" type="text" name="total_students" value="<?php echo $students - $students_allocated; ?>" id="total_students" class="span5" />
        </div>

    </div>
</div>


<div style="margin-left: 180px;  color: green"> 
    <label style="font-size: 10px" > Total : <?php echo $students; ?>  </label>
    <?php foreach ($program_detail AS $row){?>
    <label style="font-size: 10px" > <?php echo $row['room_name']; ?> : <?php echo $row['no_of_students']; ?>  </label>
   <?php } ?>
    <label style="font-size: 10px" > Remaining : <?php echo $students - $students_allocated; ?>  </label>
</div>