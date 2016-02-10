<?php 
if(count($final_structure) > 0){ ?>

                                <input class="span1" value="<?php echo $final_structure->final_title_1; ?>" style="background-color:#f4f4f4; margin-left: 23px;" type="text" name="ftitle1[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_1; ?>" style="background-color:#f4f4f4" type="text" name="ftotal1[]" id="ftotal1<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_2; ?>" style="background-color:#f4f4f4" type="text" name="ftitle2[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_2; ?>" style="background-color:#f4f4f4" type="text" name="ftotal2[]" id="ftotal2<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_3; ?>" style="background-color:#f4f4f4" type="text" name="ftitle3[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_3; ?>" style="background-color:#f4f4f4" type="text" name="ftotal3[]" id="ftotal3<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_4; ?>" style="background-color:#f4f4f4" type="text" name="ftitle4[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_4; ?>" style="background-color:#f4f4f4" type="text" name="ftotal4[]" id="ftotal4<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_5; ?>" style="background-color:#f4f4f4" type="text" name="ftitle5[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_5; ?>" style="background-color:#f4f4f4" type="text" name="ftotal5[]" id="ftotal5<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_6; ?>" style="background-color:#f4f4f4" type="text" name="ftitle6[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_6; ?>" style="background-color:#f4f4f4" type="text" name="ftotal6[]" id="ftotal6<?php echo $div_id; ?>" placeholder="T/Marks" />
                                <input class="span1" value="<?php echo $final_structure->final_title_7; ?>" style="background-color:#f4f4f4" type="text" name="ftitle7[]" placeholder="Title" />
                                <input class="span1" value="<?php echo $final_structure->final_value_7; ?>" style="background-color:#f4f4f4" type="text" name="ftotal7[]" id="ftotal7<?php echo $div_id; ?>" placeholder="T/Marks" />


                                <?php if($final_structure->final_title_1 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 3px;width: 13.1%; margin-left: 23px;" type="text" class="fvalue" id="fvalue1<?php echo $div_id; ?>" name="fvalue1[]" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 3px;width: 13.1%; margin-left: 23px;" type="text" class="fvalue" name="fvalue1[]" placeholder="Marks" readonly/>
                                <?php } ?>

                                <?php if($final_structure->final_title_2 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue2[]" id="fvalue2<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue2[]" placeholder="Marks" readonly />
                                <?php } ?>

                                <?php if($final_structure->final_title_3 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue3[]" id="fvalue3<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue3[]" placeholder="Marks" readonly />
                                <?php } ?>

                                <?php if($final_structure->final_title_4 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue4[]" id="fvalue4<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue4[]" placeholder="Marks" readonly />
                                <?php } ?>

                                <?php if($final_structure->final_title_5 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue5[]" id="fvalue5<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 1px;width: 13.1%;" type="text" class="fvalue" name="fvalue5[]" placeholder="Marks" readonly />
                                <?php } ?>

                                <?php if($final_structure->final_title_6 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue6[]" id="fvalue6<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue6[]" placeholder="Marks" readonly />
                                <?php } ?>

                                <?php if($final_structure->final_title_7 != '' ){ ?>
                                <input onkeyup="validate_final(this.value, this.id)" class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue7[]" id="fvalue7<?php echo $div_id; ?>" placeholder="Marks" />
                                <?php }else { ?>
                                <input class="span1" style="margin-left: 0px;width: 13.1%;" type="text" class="fvalue" name="fvalue7[]" placeholder="Marks" readonly />
                                <?php } ?>


<?php }else{ ?>
                                
                                <h6 style="color:red; margin-left: 111px;">First Describe the structure of this course and then add Result</h6>
                                
<?php } ?>