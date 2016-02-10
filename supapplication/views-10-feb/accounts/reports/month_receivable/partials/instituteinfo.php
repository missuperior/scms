<?php if($this->session->userdata('role') == 'HOD'){ ?>
<div class="control-group">
    <label style="width: 130px;" class="control-label" for="email">Campus:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                <option value="">-- Select Campus --</option>
                <?php foreach ($campus as $row) { ?>
                    <option value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> 
                <?php } ?>
                <option value="0">ALL</option>
            </select>
        </div>
    </div>
</div>
<?php } ?>

<div class="control-group">
    <label style="width: 130px;" class="control-label" for="email">Institutes:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select style="width: 200px;" id="institutes" name="institutes" class="select2" data-placeholder="Click to Choose...">
                <option value="">-- Select Institute --</option>
                <?php foreach ($institutes as $row) { ?>
                    <option value="<?php echo $row['institute_id'] ?>"><?php echo $row['institute_name'] ?></option>
                <?php } ?>
                <option value="0">ALL</option>
            </select>
        </div>
    </div>
</div>