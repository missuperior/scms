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
     
    
    function student_course($student_id , $session_id){
        
        
        
         $query      =   $this->db->query("
                                    SELECT *
                                    FROM `student_course_sections`  
                                    INNER JOIN courses ON courses.course_id = student_course_sections.course_id 
                                    INNER JOIN programs ON programs.program_id = student_course_sections.program_id 
                                    WHERE student_course_sections.`student_id`= $student_id
                                    AND student_course_sections.`current_session_id`= $session_id
                                    ");
                                    //GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id` 
        //echo $this->db->last_query();
        return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
        
    }
 
    function oldpassword($oldpassword , $teacher_id){
         $query      =   $this->db->query("
                                    SELECT *
                                    FROM gen_sub_logins
                                    WHERE employee_id= $teacher_id
                                    AND sub_password= '$oldpassword'
                                    AND role = 'ADVISOR'
                                    ");
        return $val =  $query->num_rows() > 0 ? true: false;
    }
    
    // update password 
 
    function updatepassword($newpassword , $teacher_id){
        
         $query      =   $this->db->query("
                                    UPDATE 
                                        gen_sub_logins
                                    SET 
                                        sub_password= '$newpassword'
                                    WHERE employee_id= $teacher_id
                                    AND role = 'ADVISOR'
                                ");
        if($query ){return true;}else{return false;} 
    }

    
    //function dstudent_course($student_id , $session_id , $section , $batch_id, $program_id,  $emp_id , $course_id){
    function dstudent_course($student_id , $session_id , $section , $batch_id, $program_id,   $course_id){

//        echo "DELETE FROM
//                                         `student_course_sections`
//                                    WHERE      student_id= '$student_id'
//                                    AND teacher_id= $emp_id
//                                    AND current_session_id= $session_id
//                                    AND course_section = '$section'
//                                    AND batch_id= $batch_id
//                                    AND program_id= $program_id 
//                                    AND course_id= $course_id 
//                                ";die;
        
         $query      =   $this->db->query(
                                    "DELETE FROM
                                         `student_course_sections`
                                    WHERE      student_id= '$student_id'
                                    AND current_session_id= $session_id
                                    AND course_section = '$section'
                                    AND batch_id= $batch_id
                                    AND program_id= $program_id 
                                    AND course_id= $course_id 
                                ");
        if($query ){return true;}else{return false;} 
        
    }
    
    function upstudent_course($student_id , $session_id , $section , $batch_id, $program_id,   $course_id, $new_section){
    
        $query      =   $this->db->query(
                                    "UPDATE 
                                         `student_course_sections`
                                     SET     course_section = '$new_section'
                                    WHERE      student_id= '$student_id'
                                    AND current_session_id= $session_id
                                    AND course_section = '$section'
                                    AND batch_id= $batch_id
                                    AND program_id= $program_id 
                                    AND course_id= $course_id 
                                ");
        if($query ){return true;}else{return false;} 
    
    }
    
    
    function  getPreReq($course_id   ){
        $query              = $this->db->get_where('courses_pre_req', array('course_id' => $course_id));      
        $data               = $query->result_array();
        
        $parent_course_id   = $data[0]['course_pre_req_id'];
        
        $parent_course_id   = !empty($parent_course_id) ? $parent_course_id : null;
        return $parent_course_id;
    }
    
    function  getParentCourseOfLab($course_id   ){
        $query              = $this->db->get_where('courses', array('parent_course_id' => $course_id));      
        $data               = $query->result_array();
        $parent_course_id   = $data[0]['parent_course_id'];
        
        $query              = $this->db->get_where('courses', array('parent_course_id' => $course_id));      
        
        $parent_course_id   = !empty($parent_course_id) ? $parent_course_id : null;
        return $parent_course_id;
    }
    
    // student single course result
    //public function final_result($student_id , $session_id,$course_id  ){
    public function final_result($student_id , $course_id  ){
        $data = $this->db->query("SELECT  (final_value_1+ final_value_2 + final_value_3 + final_value_4 + final_value_5 + final_value_6 + final_value_7) AS final FROM final_result WHERE student_id = $student_id AND course_id = $course_id" );
        echo $this->db->last_query();  
        return $data->result_array();
    }
    
    public function mid_result($student_id , $course_id  ){
        $data = $this->db->query("SELECT  (mid_value_1+ mid_value_2 + mid_value_3) AS mid FROM mid_result WHERE student_id = $student_id AND course_id = $course_id" );
        return $data->result_array();
    }
    
    //public function getLabMarks( $student_id , $batch_id,$course_id  ,$session_id){
    public function getLabMarks( $student_id , $course_id  ){
        //$data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id " );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        
        if(!empty($course_idl)){
            $data = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_id " );
            return $data->result_array();
        }else{
            return null;
        }
   }
   
       
    function UpCourseSec( $section, $student_id , $session_id ){
    
        $query      =   $this->db->query(
                                    "UPDATE 
                                         `student_course_sections`
                                    SET     course_section = '$section'
                                    WHERE      student_id= '$student_id'
                                    AND current_session_id= $session_id
                                ");
        if($query ){return 'Section Updated';}else{return 'Error Occur';} 
    }
   

}