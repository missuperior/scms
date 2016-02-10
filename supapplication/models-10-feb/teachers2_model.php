<?php
class Teachers2_model extends CI_Model {

   //>>>>>>>>>>>>>>>>>>>>    Start Functions For Structure Module    <<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
            
        function getAllbatches()
            {      
                $this->db->order_by('batch', 'DESC'); 
                $query = $this->db->get('batch');

                return $query->result_array();
            }
    
        function getAllSessions()
            {
                $this->db->order_by("session_id", "DESC");         
                $query = $this->db->get('sessions');        
                return $query->result_array();
            }

        function getAllocatedCourseSectionLatest($current_session_id,$batch_id)
            {            
                    $query      = "SELECT * ,courses.* FROM `student_course_sections` 
                                    INNER JOIN courses on `student_course_sections`.course_id = `courses`.course_id 
                                    INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
                                    INNER JOIN sessions on `student_course_sections`.current_session_id = `sessions`.session_id 
                                    WHERE  teacher_id       != ''
                                    AND current_session_id  = $current_session_id 
                                    AND student_course_sections.batch_id            = $batch_id 
                                    GROUP BY `student_course_sections`.course_id,`student_course_sections`.program_id, `student_course_sections`.course_section";

                    $query_data = $this->db->query($query);
//                    echo $this->db->last_query();die;
                    return $query_data->result_array();
            }
            
            
        function checkteacher_course($teacher_id,$course_id,$course_section,$batch_id,$program_id,$session)
                {
                    $query      = "SELECT id FROM `student_course_sections` 
                                    WHERE  teacher_id                              = $teacher_id 
                                    AND current_session_id                         = $session 
                                    AND student_course_sections.batch_id           = $batch_id 
                                    AND student_course_sections.course_section     = '$course_section'
                                    AND student_course_sections.program_id         = $program_id 
                                    AND student_course_sections.course_id          = $course_id 
                                    GROUP BY `student_course_sections`.course_id,`student_course_sections`.program_id, `student_course_sections`.course_section";

                    $query_data = $this->db->query($query);
                    $num_rows   = $query_data->num_rows();

                    return $num_rows;
                }
                
        function checkMidStructure($check_data)
                {
                    $query = $this->db->get_where('mid_course_structure', $check_data);
                    return $query->result_array();
                }    
            
        function getMidTotalMarksLatest($teacher_id,$course_section,$program_id,$semester,$course_id,  $session_id,$batch_id)
                {
                    $query  =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid_total
                                                  FROM mid_course_structure
                                                  WHERE
                                                  teacher_id = $teacher_id AND                                      
                                                  section = '".$course_section."' AND
                                                  program_id = $program_id AND
                                                  batch_id   = $batch_id AND
                                                  session_id = $session_id AND

                                                  course_id  = $course_id
                                                  ");
                    return $query->row();
                }     
            
        function getStudentCourseSectionLatest($teacher_id,$program_id, $session_id,$semester, $section, $batch_id, $course_id)
                {
        
                    $query = " SELECT * FROM
                                `student_course_sections` 
                                INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id 
                                INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
                                INNER JOIN students on `student_course_sections`.student_id = `students`.student_id 
                                INNER JOIN forms on `forms`.form_id = `students`.form_id 


                                where teacher_id = $teacher_id
                                and student_course_sections.current_session_id = $session_id
                                and students.batch_id = $batch_id
                                and student_course_sections.program_id = $program_id
                                and student_course_sections.course_id = $course_id
                                and course_section = '$section' order by students.roll_no asc";

                    $query_data = $this->db->query($query);
                    return $query_data->result_array();
                } 
        function getMidResult($data)
                {
                    $query = $this->db->get_where('mid_result', $data);		
                    return $query->row();
                }

    
     function getStudents($teacher_id, $program_id, $course_id,$course_section,$batch_id,$session_id){
        $query      =   $this->db->query("SELECT student_id FROM final_result where
                                            teacher_id = $teacher_id AND 
                                            program_id = $program_id AND 
                                            course_id  = $course_id AND 
                                            section    = '$course_section' AND 
                                            batch_id   = $batch_id AND 
                                            session_id = $session_id  
                                            GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
       // echo $this->db->last_query();die;
        return      $query->result_array();
    } 
    
     function getStudentsDelete($program_id, $course_section,$batch_id,$session_id){
        $query      =   $this->db->query("SELECT student_id FROM final_result where
                                            teacher_id != '' AND 
                                            program_id = $program_id AND                                             
                                            section    = '$course_section' AND 
                                            batch_id   = $batch_id AND 
                                            session_id = $session_id  
                                            GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
        //echo $this->db->last_query();die;
        return      $query->result_array();
    } 
    
     function getStudentsLab($program_id, $course_id,$course_section,$batch_id,$session_id){
        $query      =   $this->db->query("SELECT student_id FROM final_result where
                                            teacher_id != '' AND 
                                            program_id = $program_id AND 
                                            course_id  = $course_id AND 
                                            section    = '$course_section' AND 
                                            batch_id   = $batch_id AND 
                                            session_id = $session_id  
                                            GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
        //echo $this->db->last_query();die;
        return      $query->result_array();
    } 
    
     function getFinalMarks($student_id,$session_id){
        
       // echo $student_id;die;
         $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1,
                                        mid_result.`course_id`  AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2,
                                        final_result.session_id,final_result.course_id,courses.`course_type`, courses.`course_name`,courses.credit_hours,programs.`program_name`,campus.`campus_name`,campus.`campus_code`,batch.*

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN courses ON courses.course_id = final_result.course_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 

                                                                               
                                        mid_result.`session_id` = $session_id AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        final_result.`session_id` = $session_id AND
                                        students.`student_id` = $student_id and
                                        courses.course_type = 'Theory'

                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id`");   
         
       // echo $this->db->last_query();die;
         
         
         return      $query->result_array();
    }
    
     function calculateGpa($total,$credit_hours){
                
        
        if($total < 50){ $gpa = 0.0;}
        if($total ==50){ $gpa = 1.0;}
        if($total == 51){ $gpa = 1.1;}
        if($total == 52){ $gpa = 1.2;}
        if($total == 53){ $gpa = 1.3;}
        if($total == 54){ $gpa = 1.4;}
        if($total == 55){ $gpa = 1.5;}
        if($total == 56){ $gpa = 1.6;}
        if($total == 57){ $gpa = 1.7;}
        if($total == 58){ $gpa = 1.8;}
        if($total == 59){ $gpa = 1.9;}
        if($total == 60){ $gpa = 2.0;}
        if($total == 61){ $gpa = 2.1;}
        if($total == 62){ $gpa = 2.2;}
        if($total == 63){ $gpa = 2.3;}
        if($total == 64){ $gpa = 2.4;}
        if($total == 65){ $gpa = 2.5;}
        if($total == 66){ $gpa = 2.6;}
        if($total == 67){ $gpa = 2.7;}
        if($total == 68){ $gpa = 2.8;}
        if($total == 69){ $gpa = 2.9;}
        if($total == 70){ $gpa = 3.0;}
        if($total == 71){ $gpa = 3.1;}
        if($total == 72){ $gpa = 3.2;}
        if($total == 73){ $gpa = 3.3;}
        if($total == 74){ $gpa = 3.4;}
        if($total == 75){ $gpa = 3.5;}
        if($total == 76){ $gpa = 3.6;}
        if($total == 77){ $gpa = 3.7;}
        if($total == 78){ $gpa = 3.8;}
        if($total == 79){ $gpa = 3.9;}
        if($total >= 80){ $gpa = 4.0;}
        
        $result     =   $gpa*$credit_hours;
        return $result;
        
    }
    
    function checkgpa($student_id,$session_id){
        $query = $this->db->query("select * from std_sem_gpa where student_id = $student_id and session_id = $session_id"); 		
        return $query->row();
    }
    
     function SaveStdgpa($student_id,$gpa,$session_id,$total_gpa,$credit_hours){
        $query = $this->db->insert('std_sem_gpa', array('session_id'=>$session_id,'gpa'=>$gpa, 'student_id'=>$student_id, 'credit_hours' =>$credit_hours, 'total_gpa'=>$total_gpa)); 		
        return $this->db->insert_id();
    }
    
    function UpdateStdgpa($student_id,$gpa,$session_id,$total_gpa,$credit_hours){
        $this->db->where(array('session_id'=>$session_id,'student_id'=> $student_id));
        $this->db->update('std_sem_gpa', array('gpa'=>$gpa, 'total_gpa'=>$total_gpa,'credit_hours'=>$credit_hours)); 
       //echo $this->db->last_query();die;
        return $this->db->affected_rows();  
    }
    
    
   function getParentCourseId($course_id){
        $query  =   $this->db->query(" SELECT parent_course_id FROM courses WHERE course_id = $course_id  ");
        $res    =   $query->row();
        return      $res->parent_course_id;
   } 
   
    public function getLabMarks( $student_id , $batch_id,$course_id  ,$session_id){
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        
        if(!empty($course_idl)){
            $data = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl AND session_id = $session_id" );            
            return $data->result_array();
        }else{
            return null;
        }        
   }
    
    
    
    
    
    
    
    
            
            
            
    
    
    
   //>>>>>>>>>>>>>>>>>>>>    End Functions For Structure Module    <<<<<<<<<<<<<<<<<<<<<<<<<<<<< // 
    
    
    
    
    
    
//    function getStudents($session_id,$program_id,$course_id,$teacher_id)
//    {
//        $this->db->select('student_courses.*,forms.student_name,students.roll_no,programs.program_name,courses.course_name');
//        $this->db->from('student_courses');
//        $this->db->join('students','students.student_id = student_courses.student_id','inner');
//        $this->db->join('forms','forms.form_id = students.form_id','inner');
//        $this->db->join('programs','forms.program_id = programs.program_id','inner');
//        $this->db->join('courses','student_courses.course_id = courses.course_id','inner');
//        $this->db->where('student_courses.session_id',$session_id);
//        $this->db->where('student_courses.teacher_id',$teacher_id);
//        $this->db->where('student_courses.course_id',$course_id);
//        //$this->db->where('forms.program_id',$program_id);        
//        $query =    $this->db->get();
//        //echo $this->db->last_query();die;
//        return $query->result_array();
//    }
    
    function getStatus($student_id,$date)
    {
        $this->db->select('status');
        $this->db->from('attendance_absent');                
        $this->db->where('attendance_absent.student_id',$student_id);
        $this->db->where('attendance_absent.attendance_date',$date);
        $query =    $this->db->get();
        $result= $query->row();
        return $result->status;
    }
    
    
    function getCurrentSession(){
        $this->db->select('session_id,session');
        $this->db->from('sessions');
        $this->db->where('active',1);
        $query      =   $this->db->get();
        return $query->row();
    }
    
    function getAllocatedCourses($teacher_id,$current_session_id)
    {
        $this->db->select('ca.course_id,ca.program_id,programs.program_name,courses.course_name');
        $this->db->from('courses_allocation ca');
        $this->db->join('programs','programs.program_id = ca.program_id','inner');
        $this->db->join('courses','courses.course_id = ca.course_id','inner');
        $this->db->where('ca.session_id',$current_session_id);
        $this->db->where('ca.teacher_id',$teacher_id);
        $query      =   $this->db->get();
        return $query->result_array();
    }
    
    
   
    
    //function getAllocatedCourseSection($teacher_id, $semester, $current_session_id){
    function getAllocatedCourseSection($teacher_id, $current_session_id){
        
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id where teacher_id = $teacher_id  and current_session_id = $current_session_id group by course_section";
        $query      = "SELECT * FROM `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.course_id = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        WHERE  teacher_id = $teacher_id 
        AND current_session_id = $current_session_id 
        GROUP BY `student_course_sections`.course_id,`student_course_sections`.program_id, `student_course_sections`.course_section";
                       
        $query_data = $this->db->query($query);
        //echo $this->db->last_query();die;
        return $query_data->result_array();
    }
    
    //function getStudentCourseSection($teacher_id,$program_id, $current_session_id,$semester, $section){
    function getStudentCourseSection($teacher_id,$program_id, $current_session_id, $section , $course_id,$batch_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query = "
        SELECT * FROM
            `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN students on `student_course_sections`.student_id = `students`.student_id 
        INNER JOIN forms on `forms`.form_id = `students`.form_id 

        WHERE teacher_id = $teacher_id
        AND student_course_sections.current_session_id = $current_session_id
        
        and student_course_sections.program_id = $program_id
        and course_section = '$section' 
        and students.batch_id = $batch_id
        and student_course_sections.course_id = '$course_id' ";
        
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
    //function getStudentCourseSectionWise($teacher_id, $current_session_id,$semester, $section,$course_id){
    function getStudentCourseSectionWise($teacher_id, $current_session_id, $section,$course_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query      = "SELECT * FROM `student_course_sections` "
                . "INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id "
                . "INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id "
                . "INNER JOIN students on `student_course_sections`.student_id = `students`.student_id "
                . "INNER JOIN forms on `forms`.form_id = `students`.form_id  "
                . "where teacher_id = $teacher_id "
                . "and student_course_sections.current_session_id = $current_session_id"
                //. " and student_course_sections.semester = $semester "
                . "and student_course_sections.course_section = '$section' "
                . "and student_course_sections.course_id = '$course_id' ";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    function AttendanceExists($course_id,$teacher_id,$session_id,$semester,$course_section,$date){
        $query      = "SELECT * FROM `attendance_present` "
                . "where teacher_id = $teacher_id "
                . "and attendance_present.session_id = $session_id"
                . " and semester = $semester "
                . "and attendance_present.course_section = '$course_section' "
                . "and attendance_present.course_id = '$course_id' " 
                . "and attendance_present.date like '%$date%' ";
        
        $query_data = $this->db->query($query);
        $num_rows   = $query_data->num_rows();
        
        if($num_rows > 0 ){ return $query_data->result_array(); }else{ return null; }
    }
    
    
    // added by zohaib for new secviotn wise ends
    
    // added by zohaib for all anouncenmtns wise starts
    function announments($admin){
        $query      = "SELECT * FROM  anouncements WHERE added_by  = '$admin' and deleted != 1 ORDER BY added_date DESC" ;
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;

    }
    // added by zohaib for news wise ends
    
    
    // **** Start Addded By Tariq For Examination ****  \\
    
    // check duplicate entery
    
  
    
     // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure', $mid_data); 
		
        return $this->db->insert_id();
    }
    
    function getMidStructure($check_data)
    {
        $query = $this->db->get_where('mid_course_structure', $check_data);
//        echo '<pre>';
//        var_dump($check_data);
//        echo '</pre>';
//        
//        exit;
        //echo $this->db->last_query();die;
        return $query->row();
        
    }

    function MidStructure($mid_structure_id)
    {        
        $query = $this->db->get_where('mid_course_structure', array('mid_course_structure_id' => $mid_structure_id));
        return $query->row();
    }


    // get mid marks
    
    function getMidTotalMarks($teacher_id,$course_section,$program_id,$semester,$course_id)
    {
        $query  =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid_total
                                      FROM mid_course_structure
                                      WHERE
                                      teacher_id = $teacher_id AND                                      
                                      section = '".$course_section."' AND
                                      program_id = $program_id AND
                                      semester  = $semester AND
                                      course_id = $course_id
                                      ");
        return $query->row();
    }
    
    function updateMidStructure($mid_course_id,$mid_data)
    {
        $this->db->where('mid_course_structure_id', $mid_course_id);
        return $query = $this->db->update('mid_course_structure', $mid_data); 
        //echo $this->db->last_query();die;
    }
    
    // get mid marks
    
    function getFinalTotalMarks($teacher_id,$course_section,$program_id,$semester,$course_id)
    {
        $query  =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final_total
                                      FROM final_course_structure
                                      WHERE
                                      teacher_id = $teacher_id AND                                      
                                      section = '".$course_section."' AND
                                      program_id = $program_id AND
                                      semester  = $semester AND
                                      course_id = $course_id
                                      ");
        return $query->row();
    }
    
    // check duplicate entery
    
     function checkFinalStructure($check_data)
        {
            $query = $this->db->get_where('final_course_structure', $check_data);
            return $query->result_array();
        }
    
    // add final term structre
    
    function addFinalStructure($final_data)
    {
        $query = $this->db->insert('final_course_structure', $final_data); 
		
        //echo $this->db->last_query();die;
        return $this->db->insert_id();
    }
    
    function getFianlStructure($check_data)
    {
        $query = $this->db->get_where('final_course_structure', $check_data);
        return $query->row();
    }
    
    function FinalStructure($final_structure_id)
    {        
        $query = $this->db->get_where('final_course_structure', array('final_course_structure_id' => $final_structure_id));
        return $query->row();
    }
    
    function updateFinalStructure($final_course_id,$final_data)
    {
        $this->db->where('final_course_structure_id', $final_course_id);
        return $query = $this->db->update('final_course_structure', $final_data); 
        //echo $this->db->last_query();die;
    }
    
    function CheckMidResult($check_data)
    {
        $query = $this->db->get_where('mid_result_status', $check_data);
        //return $query->result_array();
        return $query->num_rows();
    }
    function CheckFinalResult($check_data)
    {
        $query = $this->db->get_where('final_result_status', $check_data);
        //return $query->result_array();
        return $query->num_rows();
    }
    
    function AddMidResult($mid_result)
    {
        $query = $this->db->insert('mid_result', $mid_result); 	
        
        return $this->db->insert_id();
    }
    function AddMidResultStatus($mid_result_status)
    {
        $query = $this->db->insert('mid_result_status', $mid_result_status); 		
        return $this->db->insert_id();
    }
    function AddFinalResultStatus($final_result_status)
    {
        $query = $this->db->insert('final_result_status', $final_result_status); 	
        //echo $this->db->last_query();die;
        return $this->db->insert_id();
    }
    function AddFinalResult($final_result)
    {
        $query = $this->db->insert('final_result', $final_result); 
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }
    
   
    
    function getFinalResult($data)
    {
        $query = $this->db->get_where('final_result', $data);		
        return $query->row();
    }
    
    function get_std_info($roll_no)
    {
            $query  =   $this->db->query("
                            SELECT students.`roll_no`,students.`semester`,students.`shift`,forms.`father_name`,forms.`student_name`, 
                                        sessions.session,sessions.`session_id`,programs.program_name 
                            FROM students 
                            INNER JOIN forms ON forms.`form_id` = students.`form_id` 
                            INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id` 
                            INNER JOIN sessions ON sessions.`session_id` = mid_result.`session_id` 
                            INNER JOIN programs ON programs.`program_id` = forms.`program_id` 
                            WHERE 
                                students.roll_no = '$roll_no'  
                            GROUP BY 
                                sessions.`session_id`
                        ");
             //echo $this->db->last_query();die;
        return $query->result_array();
    }
    function get_std_result($session_id,$roll_no)
    {
        $query  =   $this->db->query("SELECT students.`roll_no`,students.`semester`,students.`shift`,forms.`father_name`,forms.`student_name`,
                                        SUM(mid_result.`mid_value_1`+mid_result.`mid_value_2`+mid_result.`mid_value_3`) AS mid_total,
                                        SUM(final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS final_total,
                                        programs.program_name,courses.course_name,courses.credit_hours,sessions.session

                                        FROM students

                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN programs ON programs.program_id = forms.`program_id`
                                        INNER JOIN courses ON courses.course_id = mid_result.`course_id`
                                        INNER JOIN sessions ON sessions.`session_id` = mid_result.`session_id`

                                        WHERE 
                                        students.roll_no = '$roll_no' AND
                                        mid_result.`session_id` = $session_id AND
                                        mid_result.`course_id` = final_result.`course_id`

                                        GROUP BY mid_result.`course_id`
                                        ORDER BY sessions.`session_id`
                                      ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    // **** End Addded By Tariq For Examination ****  \\
    
   

 
    // **** Sections Courses assigned via section start ****  \\
     
     
      //function getAllocatedCourseSection($teacher_id, $semester, $current_session_id){
   
    
      //function getAllocatedCourseSection($teacher_id, $semester, $current_session_id){
   
    // **** Sections Courses assigned via section ends****  \\
    // 
    // 
    // 
    // **** Sections Courses assigned via section start zohaib****  \\
   
    //semester  = $semester AND
   
    
    // **** Sections Courses assigned via section start zohaib ends****  \\
    
      function getMidResStatus($data){
        $query = $this->db->get_where('mid_result_status', $data);
        return $query->row();
    }
    
    function getFinalResStatus($check_data){
        $query = $this->db->get_where('final_result_status', $check_data);
        return $query->row();
    }

    
    function post_mid_result($data){
        $this->db->where($data);
        $query = $this->db->update('mid_result_status', array('result_status' => 2));
        // for user log
        if($query){
            // update last login date and time
            
                $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                $log_data   =   array(
                                        'operator_id'   => $this->session->userdata('sub_login_id'),
                                        'reference_id'  => $this->session->userdata('mid_status_id'),
                                        'action'        => $action
                                    );
                $query2 = $this->db->insert('user_log', $log_data); 
                return $query;             
        }else{  
            return false;
        }
        
    }
    
    function post_final_result($data){
        $this->db->where($data);
        $query = $this->db->update('final_result_status', array('result_status' => 2)); 
        
        // for user log
        if($query){
            // update last login date and time
            
                $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                $log_data   =   array(
                                        'operator_id'   => $this->session->userdata('sub_login_id'),
                                        'reference_id'  => $this->session->userdata('final_status_id'),
                                        'action'        => $action
                                    );
                $query2 = $this->db->insert('user_log', $log_data); 
                return $query;             
        }else{  
            return false;
        }
        
    }
    
    
     function del_mid_result($mid_result_delete,$log_data)
    {
        $res    =   $this->db->delete('mid_result',$mid_result_delete);
        
        if($res){
                    $res2    =   $this->db->delete('mid_result_status',$mid_result_delete);

                    // for user log
                    if($res2){
                                $query = $this->db->insert('edit_del_result_log', $log_data); 
                                return $res2;
                }else{  
                                return false;
                }
        }
        return false;
    }
    
    function del_final_result($final_result_delete,$log_data)
    {
        $res    =   $this->db->delete('final_result',$final_result_delete);
        
        if($res){
            $res2    =   $this->db->delete('final_result_status',$final_result_delete);
            // for user log
                    if($res2){
                                $query = $this->db->insert('edit_del_result_log', $log_data); 
                                return $res2;           
                }else{  
                    return false;
                }
        }
        return false;
    }
    
    
    
    function getCourseLab($course_id ,$batch_id , $program_id ){
        
        $query  =   $this->db->query("
                            SELECT * FROM courses 
                            WHERE parent_course_id = $course_id 
                            AND batch_id = $batch_id 
                            AND program_id = $program_id ");
//        echo '<pre>';
//        var_dump($query->result_array());
//        echo '<pre>';die;
        return $query->result_array();
        
        
    }
    function combine_final_result($data){
        
        //$sel_final_result = "SELECT * from results"
        
        
    }
 
    
    function getStudentCourseSectionInd($teacher_id,$program_id, $current_session_id, $section,$course_id,$batch_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query = "
        SELECT * FROM
            `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN students on `student_course_sections`.student_id = `students`.student_id 
        INNER JOIN forms on `forms`.form_id = `students`.form_id 

        WHERE teacher_id = $teacher_id
        AND student_course_sections.current_session_id = $current_session_id
        
        and student_course_sections.program_id = $program_id
        and student_course_sections.course_id  = $course_id
        and students.batch_id = $batch_id
        and course_section = '$section' ";
        
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
}