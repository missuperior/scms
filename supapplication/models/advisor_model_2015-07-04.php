<?php

class Advisor_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // admin login 
    
    function Login($login_data)
    {
        
        $query = $this->db->get_where('gen_sub_logins', $login_data);  
        //   echo $this->db->last_query();  
        return $query->row();           
        //return $query->result_array();

    }
   
    
    // i/p : batch id, session id, porgram id
    // o/p : return student list
    /*function getStudentList($batch_id,$program_id,$session_id){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id` , `students`.`roll_no` , `forms`.`email`
        FROM (
        `forms`
        )
        
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        WHERE `forms`.`program_id` =$program_id
        AND `students`.`enrolled_session_id` =$session_id
        AND `students`.`batch_id` = '$batch_id'
        AND `students`.`roll_no` != ' '
        GROUP BY forms.form_id
        ORDER BY students.roll_no ASC ";
        
        $query_data = $this->db->query($query);
        //echo $this->db->last_query();
        return $query_data->result_array();
    }*/
    function getStudentList($batch_id,$program_id){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id` , `students`.`roll_no` , `forms`.`email`
        FROM (
        `forms`
        )
        
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        WHERE `forms`.`program_id` =$program_id
        AND `students`.`batch_id` = '$batch_id'
        AND `students`.`roll_no` != ' '
        GROUP BY forms.form_id
        ORDER BY students.roll_no ASC ";
        
        $query_data = $this->db->query($query);
        //echo $this->db->last_query();
        return $query_data->result_array();
    }
    
    function getSession($session_id){
        $this->db->select('session_id,session');
        $this->db->from('sessions');
        $this->db->where('session_id',$session_id);
        $query      =   $this->db->get();
        return $query->result_array();
    }
    
    public function getstresult($student_id){
    $query      =   $this->db->query("
                                      SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course, (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1, mid_result.`course_id` AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2, final_result.semester, courses.`course_name`,courses.credit_hours,programs.`program_name`,campus.`campus_name` ,batch.*
                                        FROM students INNER JOIN forms ON forms.form_id =students.form_id 
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id` 
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id 

                                        INNER JOIN courses ON courses.course_id = final_result.course_id 
                                        INNER JOIN programs ON programs.program_id = forms.program_id 
                                        INNER JOIN batch ON batch.batch_id = students.batch_id
                                        WHERE students.`student_id`= $student_id
                                        AND mid_result.`course_id` = final_result.`course_id`
                                        ");
                                    //GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id` 
        //echo $this->db->last_query();
        return $query->result_array();
    
    }
    
    function addStCourses($course)
    {
        $query = $this->db->insert('student_course_sections', $course); 
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }
    
}