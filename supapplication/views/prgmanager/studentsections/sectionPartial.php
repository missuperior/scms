    <?php 
//    echo '<pre>';
//    var_dump($sections);
//    echo '</pre>';
?>


<div class="control-group" >
    <label class="control-label" for="section">Section:</label>
    <div class="controls">
        <div class="span12">
            <select name="section" id="section">
                  <?php foreach ($sections as $row) { ?>
                        <option  value="<?php echo $row['program_section'] ?>" >
                            <?php echo $row['program_section'] ?>
                        </option> 
                   <?php } ?>
            </select>
        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="section">Teacher Course:</label>
    <div class="controls">
        <div class="span12">
            <select name="teachercourse" id="teachercourse">
                    <?php foreach ($allocated as $row) { ?>
                    <option  value="<?php echo $row['teacher_id'].'-'.$row['course_id']; ?>" >
                        <?php echo $row['employee_name'].'-'.$row['course_name']; ?>
                    </option> 
                <?php } ?>
            </select>
        </div>
    </div>
</div>


