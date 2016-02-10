<?php

class Manager_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
      function adminLogin($login_data)
    {
        
        $query  = $this->db->get_where('gen_sub_logins', $login_data);
        
        
        $result = $query->row();      
        
        
        //echo '<pre>';var_dump($query);echo '</pre>';exit;
        if($result){
            
            // update last login date and time
                $id     =   $result->sub_login_id;
                $data   =   array('last_login'=>date('Y-m-d H:i:s'));
                $this->db->where('sub_login_id', $id);
                
                
                
                $query = $this->db->update('gen_sub_logins', $data);
                if($query == 1)
                {
                        $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                        $log_data   =   array(
                                                'operator_id'   => $id,
                                                'reference_id'  => $id,
                                                'action'        => $action
                                            );
                        $query = $this->db->insert('user_log', $log_data); 
                        return $result;
                 }
                }else{  
                    return false;
                }
    }
    
    
    
    
    
    // manager login 
    function managerLogin($login_data)
    {
        $query = $this->db->get_where('gen_account_logins', $login_data);
        return $query->row();           
    }
    

    function submanagerLogin($login_data)
    {
        $query = $this->db->get_where('gen_sub_logins', $login_data);
        return $query->row();           
    }
    
      
    // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure', $mid_data); 
        return $this->db->insert_id();
    }
    
    
    // get mid info
    
    function getMidInfo($id)
    {       
        $query = $this->db->get_where('mid_course_structure', array('course_allocation_id' => $id));
		
        return $query->result_array();
    }
    
    // update mid structure
    
    function updateMidStructure($mid_id,$mid_data)
    {
        $this->db->where('mid_course_structure_id', $mid_id);
        $query = $this->db->update('mid_course_structure', $mid_data);
		 
        return $query;      
    }
    
    
    // add final term structre
    
    function addFinalStructure($final_data)
    {
        $query = $this->db->insert('final_course_structure', $final_data); 
		
        return $this->db->insert_id();
    }
    
    // get final info
    
    function getFinalInfo($id)
    {       
        $query = $this->db->get_where('final_course_structure', array('course_allocation_id' => $id));
		
        return $query->result_array();
    }
    
    // update Final structure
    
    function updateFinalStructure($final_id,$final_data)
    {
        $this->db->where('final_course_structure_id', $final_id);
        $query = $this->db->update('final_course_structure', $final_data);
		 
        return $query;      
    }

    
    // get all students 
    
    function getAllStudents()
    {
        $this->db->select('forms.student_name, students.student_id, students.roll_no');
        $this->db->from('forms');
        $this->db->join('students', 'forms.form_id = students.form_id ', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // get all mid structure 
    
    function getMStructure()
    {    
        $query = $this->db->get_where('mid_course_structure', array('mid_course_structure_id' => 1));
        return $query->result_array();    
    }
    
    // get final sturcture 
    
    function getFStructure()
    {    
        $query = $this->db->get_where('final_course_structure', array('final_course_structure_id' => 1));
        return $query->result_array();    
    }
    
 
    
    
    
    
        /* Added By Zohaib To add Login start */
            
        // ALL THOSE WILL COME TO WHICH COURSE HAS BEEN ALLOCATED
        function EmployerList(){
            $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
            $this->db->from('hr_employee_record');
            $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
            $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
            $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
            $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');

            //$this->db->where('hr_departments.account_role_id' , '6');
            $this->db->where( 'hr_employee_record.campus_id' , '3');
            $this->db->group_by('emp_id'); 

            $query = $this->db->get();
            return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
            
            //return $query->result_array();
        }
    
        function getAlllogins(){
            $query = "  SELECT gen_sub_logins.* ,"
                    . " campus.*, hr_employee_record.* "
                    . "FROM "
                    . "gen_sub_logins "
                    . "INNER JOIN hr_employee_record "
                    . "ON hr_employee_record.emp_id = gen_sub_logins.employee_id "
                    . "INNER JOIN campus ON gen_sub_logins.campus_id = campus.campus_id"
                    . " where role = 'Teacher'";
            $query_data = $this->db->query($query);
            return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;

        }
        
        function checklogingenerated( $emp_id )
        {
            $query      = "SELECT * FROM gen_sub_logins WHERE employee_id= '$emp_id' ";
            $query_data = $this->db->query($query);
            return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        }
        
        // to get department
        function getEmployeeDept( $emp_id )
        {
            $query      = "SELECT * FROM hr_employee_record WHERE emp_id= '$emp_id' ";
            $query_data = $this->db->query($query);
            return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        }

        
        
    /* Added By Zohaib To add Login End*/
        
    // manager model list
    
    public function all_emp_list($department_id){
        
        $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
        $this->db->from('hr_employee_record');
        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
        $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
        $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
        $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');

        //$this->db->where('hr_departments.account_role_id' , '6');
        $this->db->where( 'hr_employee_record.campus_id' , '3');
        $this->db->where( 'hr_employee_record.department_id' , $department_id);
        $this->db->group_by('emp_id'); 

        $query = $this->db->get();
        return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
    }
        
    // all advisors lists
    public function all_advisor_list($emp_department_id){
        $query = "  SELECT gen_sub_logins.* ,"
                    . " campus.*, hr_employee_record.* "
                    . "FROM "
                    . "gen_sub_logins "
                    . "INNER JOIN hr_employee_record "
                    . "ON hr_employee_record.emp_id = gen_sub_logins.employee_id "
                    . "INNER JOIN campus ON gen_sub_logins.campus_id = campus.campus_id"
                    . " WHERE gen_sub_logins.role       = 'ADVISOR' AND "
                    . "  hr_employee_record.department_id   = $emp_department_id";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        
    }
    function advisorlogingenerated( $emp_id , $username)
    {
        $query      = "SELECT * FROM gen_sub_logins WHERE employee_id= '$emp_id' AND role = 'ADVISOR' AND sub_login = '$username'";
        
        $query_data = $this->db->query($query);
        $num_row    = $query_data->num_rows();
        
        return $val =   $num_row > 0 ? $num_row: null;
    }
    
    function advisoradd( $data )
    {
        $query = $this->db->insert('gen_sub_logins', $data); 
        
        return $this->db->insert_id();
    }
    
    
    /* Added By Zohaib To course section start*/

    // for adding course section addition
    function CourseSectionSettings($data)
    {
        $query = $this->db->insert('course_sections_settings', $data); 
        return $this->db->insert_id();
    }
    
    function CourseSectionSettingsList($session_id , $batch_id)
    {
        
              $query = "SELECT `course_sections_settings`.* ,`batch`.* ,`course_sections_settings`.id as setting_id,  `courses`.*, `programs`.`program_name` "
                    . "FROM (`course_sections_settings`) "
                    . "INNER JOIN `courses` ON `course_sections_settings`.`course_id` = `courses`.`course_id` "
                    . "INNER JOIN `programs` ON `course_sections_settings`.`program_id` = `programs`.`program_id` "
                    . "INNER JOIN `batch` ON `course_sections_settings`.`batch_id` = `batch`.`batch_id` "
                . "WHERE `course_sections_settings`.`session_id` = '$session_id' "
                . "AND `course_sections_settings`.`batch_id` = '$batch_id' ORDER BY session_id DESC ";

        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    // saving adivosr allocatoin to course sections
    function saveAdvisorAllocation($course_section_id , $session_id ,$batch_id, $advisor_id , $date)
    {
         $query = "UPDATE "
                . "`course_sections_settings` "
                . " SET "
                . " advisor_id =  $advisor_id ,  "
                . " session_id = $session_id   , "
                . " advisor_allocated_date = '$date' " 
                . " WHERE `course_sections_settings`.`session_id`       = '$session_id' "
                . " AND `course_sections_settings`.`id`                 = '$course_section_id' "
                . " AND `course_sections_settings`.`batch_id`                 = '$batch_id' ";

        $query_data = $this->db->query($query);
        //echo '<br/>';
        return $query_data ;
    }
    
    
    //function all_advisor_associated( $pm_id , $session_id ){
    function all_advisor_associated( $batch_id , $session_id ){
         $query = "SELECT `course_sections_settings`.*,`course_sections_settings`.id as setting_id,hr_employee_record.employee_name,  `courses`.*, `programs`.`program_name` "
                . "FROM (`course_sections_settings`) "
                . "INNER JOIN `courses`"
                . " ON `course_sections_settings`.`course_id` = `courses`.`course_id` "
                . "INNER JOIN `programs` ON `course_sections_settings`.`program_id` = `programs`.`program_id` "
                . "INNER JOIN hr_employee_record ON hr_employee_record.emp_id = course_sections_settings.`advisor_id`  "
                
                . "WHERE `course_sections_settings`.`session_id` = '$session_id' "
                . "AND `course_sections_settings`.`batch_id` = '$batch_id' "
                //. "AND `course_sections_settings`.`pm_id` = '$pm_id' "
                . "ORDER BY session_id DESC";

        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
 
    
    // saving adivosr allocatoin to course sections
    function saveTeacherAllocation($course_section_id , $session_id , $batch_id,  $teacher_id , $date)
    {
        $query = "UPDATE "
                . "`course_sections_settings` "
                . " SET "
                . " allocated_teacher_id =  $teacher_id ,  "
                . " allocated_teacher_date = '$date' " 
                . " WHERE `course_sections_settings`.`session_id`        = '$session_id' "
                . " AND `course_sections_settings`.`batch_id` = '$batch_id' "
                . " AND `course_sections_settings`.`id` = '$course_section_id' ";

        $query_data = $this->db->query($query);
        return $query_data;
    }
 
    
    function all_teacher_associated(  $session_id ,$batch_id ){
        
          $query = "SELECT `course_sections_settings`.*,`course_sections_settings`.id as setting_id,hr_employee_record.employee_name,  `courses`.*, `programs`.`program_name` "
                . "FROM (`course_sections_settings`) "
                . "INNER JOIN `courses`"
                . " ON `course_sections_settings`.`course_id` = `courses`.`course_id` "
                . "INNER JOIN `programs` ON `course_sections_settings`.`program_id` = `programs`.`program_id` "
                . "INNER JOIN hr_employee_record ON hr_employee_record.emp_id = course_sections_settings.`allocated_teacher_id`  "
                . "WHERE `course_sections_settings`.`session_id` = '$session_id' "
                //. "AND `course_sections_settings`.`pm_id` = '$pm_id' "
                . "AND `course_sections_settings`.`batch_id` = '$batch_id' "
                . "ORDER BY session_id DESC";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    /* Added By Zohaib To course section Ends*/
    
    
    public function addingLogin($data_array){
        $query = $this->db->insert('student_logins', $data_array); 
        return $this->db->insert_id();
    }
    
    
}