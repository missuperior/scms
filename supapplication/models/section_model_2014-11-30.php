<?php

class Section_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    
    // check duplication of city name
    //function addStudentSection($program_id,$semeter_id,$student_id)
    function addStudentSection($data_array)
    {
        $query = $this->db->insert('student_sections', $data_array); 
        return $this->db->insert_id();
    }
    
    // getting all section 
    function view_sections($program_id,$semeter_id)
    {
        $query = $this->db->insert('student_sections', $data_array); 
        return $this->db->insert_id();
    }
    
    // get seection  // here always be a current session 
    //function getAllsections($program_id , $semester , $session_id)
    function getAllsections($program_id , $session_id)
    {
        //$query = $this->db->get_where('courses', $program_id);
        $query      = ""
                . "SELECT program_section "
                . "FROM student_sections "
                . "WHERE program_id='$program_id' "
                //. "and semester ='$semester' and session_id ='$session_id' "
                . "and session_id ='$session_id' "
                . "group by program_section";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    // getting a single section
    function get_section($student_id)
    {
        $query   = "SELECT id , student_id , program_section FROM student_sections  WHERE student_id='$student_id'";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
    //function addStudentSection($program_id,$semeter_id,$student_id)
    function addStudentCourseSection($data_array)
    {
        $query = $this->db->insert('student_course_sections', $data_array); 
        return $this->db->insert_id();
    }
    
    function get_all_section_students( $program_id , $cur_session_id , $section){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`, `students`.`roll_no` , `forms`.`email`   
        FROM (`forms`)
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        INNER JOIN `student_sections` ON `student_sections`.`student_id` = `students`.`student_id`
        WHERE `forms`.`program_id` = $program_id
        AND `students`.`current_session_id` = $cur_session_id
        AND `students`.`enrolled_session_id` = $cur_session_id
        AND `student_sections`.`program_section` = '$section'
        GROUP BY form_id";
        
//        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`
//        FROM (`forms`)
//        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
//        INNER JOIN `student_course_sections` ON `student_course_sections`.`student_id` = `student_course_sections`.`student_id`
//        WHERE `forms`.`program_id` = $program_id
//        AND `students`.`current_session_id` = $cur_session_id
//        AND `students`.`enrolled_session_id` = $cur_session_id
//        AND `student_course_sections`.`course_section` = '$section'
//        GROUP BY form_id";
        //$query = 'SELECT * FROM forms INNER JOIN students on students.form_id = forms.form_id where students.semester = 1 and  forms.program_id  = 10';
        
        $query_data = $this->db->query($query);
        //echo $this->db->last_query();
        return $query_data->result_array();
    }
    
    
    // students against  a section
    function student_of_section( $program_id , $cur_session_id , $section){
        
        $query = "
            SELECT student_course_sections.current_session_id  , students.student_id,  forms.form_id, forms.student_name, forms.email ,  students.roll_no  
            FROM student_course_sections 
            INNER JOIN students
            ON
                students.student_id =  student_course_sections.student_id 
            INNER JOIN forms 
            ON
                forms.form_id =  students.form_id 
            WHERE
                `student_course_sections`.`course_section` = '$section'
            AND 
                `student_course_sections`.`current_session_id` = $cur_session_id
            AND
                `student_course_sections`.program_id  = $program_id";
        
       $query_data = $this->db->query($query);
       //echo $this->db->last_query();
        return $query_data->result_array();
    }
    
    // teahers of a section
    function teachers_of_section( $program_id , $cur_session_id , $section){
        
        $query = "
            SELECT student_course_sections.current_session_id  , students.student_id,  forms.form_id, forms.student_name, forms.email ,  students.roll_no  
            FROM student_course_sections 
            INNER JOIN students
            ON
                students.student_id =  student_course_sections.student_id 
            INNER JOIN forms 
            ON
                forms.form_id =  students.form_id 
            WHERE
                `student_course_sections`.`course_section` = '$section'
            AND 
                `student_course_sections`.`current_session_id` = $cur_session_id
            AND
                `student_course_sections`.program_id  = $program_id";
        
       $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
 
    function get_all_section_teachers( $program_id , $cur_session_id , $section){
        
        $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
        $this->db->from('hr_employee_record');
        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
        $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
        $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
        $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');
        
        $this->db->where('hr_departments.account_role_id' , '6');
        $this->db->where( 'hr_employee_record.campus_id' , '3');
        $this->db->where( 'student_course_sections.current_session_id' , $cur_session_id);
        $this->db->where( 'student_course_sections.course_section' , $section);
        $this->db->where( 'student_course_sections.program_id' , $program_id);
        
        $this->db->group_by('emp_id'); 
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    
//    function get_all_section_teachers( $program_id , $cur_session_id , $section){
//        
//        $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
//        $this->db->from('hr_employee_record');
//        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
//        $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
//        $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
//        $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');
//        
//        $this->db->where('hr_departments.account_role_id' , '6');
//        $this->db->where( 'hr_employee_record.campus_id' , '3');
//        $this->db->where( 'student_course_sections.current_session_id' , $cur_session_id);
//        $this->db->where( 'student_course_sections.course_section' , $section);
//        $this->db->where( 'student_course_sections.program_id' , $program_id);
//        
//        $this->db->group_by('emp_id'); 
//        
//        $query = $this->db->get();
//        //echo $this->db->last_query();
//        return $query->result_array();
//    }
    
    
    function teacher_section_courses( $cur_session_id , $teacher_id ) {
        
        $this->db->select( 'hr_employee_record.emp_id' , 'student_course_sections.*');
        $this->db->from('student_course_sections');
        $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');
        $this->db->join('student_course_sections', 'student_course_sections.course_id 	 =  courses.course_id', 'inner');
        
        //$this->db->where('hr_departments.account_role_id' , '6');
        //$this->db->where( 'hr_employee_record.campus_id' , '3');
        $this->db->where( 'student_course_sections.current_session_id' , $cur_session_id);
        $this->db->where( 'student_course_sections.teacher_id' , $teacher_id);
        
        //$this->db->group_by('emp_id'); 
        
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result_array();
    }
    
    
    
    /* added by zohaib*/
    
}
