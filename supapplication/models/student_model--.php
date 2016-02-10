<?php

class Student_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // student login 
    
    function studentLogin($login_data)
    {
      $this->db->select('student_logins.*, students.form_no, 
                         forms.form_no, forms.student_name');
      $this->db->from('student_logins');
      $this->db->join('students', 'student_logins.student_id = students.student_id', 'inner');
      $this->db->join('forms', 'students.form_no = forms.form_no', 'inner');
      $this->db->where($login_data);
      $query = $this->db->get();     
      return $query->row();
    }
    
    // Check Student Record Availablity
    
    function checkStudentRecord($program_id, $roll_no)
    {
      $this->db->select('students.student_id,students.form_id,students.roll_no, 
                         forms.*, 
                         programs.program_id, program_name');
      $this->db->from('students');
      $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
      $this->db->join('programs', 'forms.program_id = programs.program_id', 'left');
      $this->db->where(array('students.roll_no' => $roll_no, 'programs.program_id' => $program_id));
      $query = $this->db->get();
      
      return $query->row();
    }
    
    // Check Student Registration Existance 
    function checkSignUpStudent($roll_no)
    {
      $query = $this->db->get_where('student_logins', array('roll_no' => $roll_no));      
      return $query->result_array();
    }
        
    // Student Registration data store in DB
    function signUpStudent($student_data)
    {
      $query = $this->db->insert('student_logins', $student_data);
      return $query;
    }
    
    
    function getStudentProfile($student_id)
    {
      $this->db->select('students.*, 
                         forms.form_id, forms.student_name, forms.father_name, forms.nic_no, forms.email, forms.mobile, forms.dob,, forms.form_submit_date,
                         batch.*,
                         sessions.*,
                         programs.program_id, programs.program_name');  
      $this->db->from('students');
      $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
      $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');
      $this->db->join('sessions', 'students.current_session_id = sessions.session_id', 'inner');
      $this->db->join('programs', 'forms.program_id = programs.program_id', 'inner');
      $this->db->where(array('students.student_id' => $student_id));
      $query = $this->db->get();
      
      return $query->result_array();
    }
    
}
