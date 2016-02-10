<?php

class Employee_model extends CI_Model {
    
    
    function hr_employee_record($employee_data)
    {
        $query = $this->db->get_where('gen_account_logins', $employee_data);
        return $query->row();           
    }
    
}