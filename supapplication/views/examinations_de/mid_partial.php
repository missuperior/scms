<?php 
if(count($mid_structure) > 0)
{
?>


<input class="span2" style="background-color:#f4f4f4;margin-left:2px; " value="<?php echo $mid_structure->mid_title_1; ?>" type="text" name="mtitle1[]" id="mtitle1" placeholder="Title" readonly/>
<input class="span2" style="margin-left:2px; background-color:#f4f4f4" value="<?php echo $mid_structure->mid_value_1; ?>" type="text" name="mtotal1[]"  id="mtotal1<?php echo $div_id; ?>" placeholder="T/Marks" readonly/>

<input class="span2" style=" background-color:#f4f4f4; margin-left:2px;" value="<?php echo $mid_structure->mid_title_2; ?>" type="text" name="mtitle2[]" id="mtitle2" placeholder="Title"  readonly />
<input class="span2" style=" background-color:#f4f4f4; margin-left:2px;" value="<?php echo $mid_structure->mid_value_2; ?>" type="text" name="mtotal2[]" id="mtotal2<?php echo $div_id; ?>" placeholder="T/Marks" readonly />

<input class="span2" style=" background-color:#f4f4f4; margin-left:2px;" value="<?php echo $mid_structure->mid_title_3; ?>" type="text" name="mtitle3[]" id="mtitle3" placeholder="Title" readonly />
<input class="span2" style=" background-color:#f4f4f4; margin-left:2px;" value="<?php echo $mid_structure->mid_value_3; ?>" type="text" name="mtotal2[]" id="mtotal3<?php echo $div_id; ?>" placeholder="T/Marks" readonly />


<?php if($mid_structure->mid_title_1 != '' ){ ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.4%;margin-left:2px;" type="text" name="mvalue1[]"  class="mvalue" id="mvalue1<?php echo $div_id; ?>" placeholder="Obtained Marks" />
<?php }else { ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.4%;margin-left:2px;" type="text" name="mvalue1[]"  class="mvalue" id="mvalue1<?php echo $div_id; ?>" placeholder="Obtained Marks" readonly />
<?php } ?>

<?php if($mid_structure->mid_title_2 != '' ){ ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.6%;margin-left:2px;" type="text" name="mvalue2[]"  class="mvalue" id="mvalue2<?php echo $div_id; ?>" placeholder="Obtained Marks" />
<?php }else { ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.6%;margin-left:2px;" type="text" name="mvalue2[]"  class="mvalue" id="mvalue2<?php echo $div_id; ?>" placeholder="Obtained Marks" readonly/>
<?php } ?>

<?php if($mid_structure->mid_title_3 != '' ){ ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.5%;margin-left:2px;" type="text" name="mvalue3[]"  class="mvalue" id="mvalue3<?php echo $div_id; ?>" placeholder="Obtained Marks" />
<?php }else { ?>
<input  onkeyup="validate_mid(this.value, this.id)" style=" width: 27.4%;margin-left:2px;" type="text" name="mvalue3[]"  class="mvalue" id="mvalue3<?php echo $div_id; ?>" placeholder="Obtained Marks" readonly />
<?php } ?>

<?php }else{ ?>
<h6 style="color:red">First Describe the structure of this course and then add Result</h6>
<?php } ?>