<div class="control-group">
    <label class="control-label" for="form-field-2">Select Employee:</label>

    <div class="controls">
        <select style="width: 200px;" id="employee" name="employee_id" class="select2" data-placeholder="Click to Choose...">                                                                
            <option selected>Select Employee</option>    
        <?php foreach ($employes as $row) { ?>
                <option onclick="set_acc_role('<?php echo $row['account_role_id']?>')" value="<?php echo $row['emp_id'] ?>"><?php echo $row['employee_name'] ?></option> 
            <?php } ?>																			
        </select>

    </div>

</div>
<div class="control-group">
    <label class="control-label" for="form-field-2">User Name:</label>

    <div class="controls">
        <input type="text" id="user_name" placeholder="Username" name="user_name"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="form-field-2">Password:</label>

    <div class="controls">
        <input type="password" id="password" placeholder="Password" name="password"/>
        <input type="hidden" id="acc_role_id"  name="acc_role_id" value=""/>
    </div>
</div>

    <div class="control-group">
        <label class="control-label">Admission Modules: </label>
        <div class="controls">
            <label>
                <input name="admission_modules[]" type="checkbox" value="add_inquiry_form"/>
                <span class="lbl"> Add Inquiry</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="view_inquiries"/>
                <span class="lbl"> View Inquiries</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="edit_inquiry"/>
                <span class="lbl"> Edit Inquiry</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="add_prospectus_form"/>
                <span class="lbl"> Add Prospectus</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="sale_prospectus_form"/>
                <span class="lbl"> Sale Prospectus</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="view_prospectus"/>
                <span class="lbl"> View Prospectus</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="initial_form"/>
                <span class="lbl"> Add Initial Form</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="add_initial_form"/>
                <span class="lbl"> Initial Form</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="view_initial_forms"/>
                <span class="lbl"> View Initial Forms</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="search_form"/>
                <span class="lbl"> Add Student Form</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="view_student_form"/>
                <span class="lbl"> View Student Form</span>
            </label>
            <label>
                <input name="admission_modules[]" type="checkbox" value="form"/>
                <span class="lbl"> Student Form</span>
            </label>            
            <label>
                <input name="admission_modules[]" type="checkbox" value="reports"/>
                <span class="lbl"> Reports</span>
            </label>


        </div>
    </div>


  <hr />
                                        <div class="row-fluid wizard-actions">
                                            <button class="btn btn-success btn-next" data-last="Finish ">
                                                Save                                            
                                            </button>
                                        </div>