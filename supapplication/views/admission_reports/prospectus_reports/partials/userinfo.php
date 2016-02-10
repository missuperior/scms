<?php if($this->session->userdata('role') == 'HOD'){ ?>
<div class="control-group">
    <label style="width: 130px;" class="control-label" for="email">User:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select  style="width: 200px;" id="user" name="user" class="select2" data-placeholder="Click to Choose...">
                <option value="">-- Select Campus --</option>
                <?php foreach ($users as $row) { ?>
                    <option value="<?php echo $row['sub_login_id'] ?>"><?php echo $row['sub_login']; ?></option> 
                <?php } ?>																			
            </select>
        </div>
    </div>
</div>
<?php } ?>
