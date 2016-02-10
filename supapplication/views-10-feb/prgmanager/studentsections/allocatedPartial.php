
    <?php foreach ($allocated as $row) { ?>
         <option  value="<?php echo $row['teacher_id'].'-'.$row['course_id']; ?>" >
             <?php echo $row['teacher_id'].'-'.$row['course_id']; ?>
         </option> 
    <?php } ?>