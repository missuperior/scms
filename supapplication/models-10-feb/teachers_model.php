<?php
class Teachers_model extends CI_Model {

     function teacherLogin($login_data)
    {
        
        $query  = $this->db->get_where('gen_sub_logins', $login_data);
        
        $result = $query->row();           
        //echo $this->db->last_query();die;
        //echo '<pre>';var_dump($result);echo '</pre>';exit;
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
    
    
     // change password
    
    function ChangePass($old_password,$new_password)
    {
        $old_password = array('sub_password'=>$old_password);
        $query = $this->db->get_where('gen_sub_logins', $old_password);
        $res =  $query->result_array();
        
        $id = $this->session->userdata('sub_login_id');
        
        if(count($res) > 0)
        {
          $query =  $this->db->query("update gen_sub_logins set `sub_password` = '$new_password'  WHERE sub_login_id 	=  $id ");
        
                $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                $log_data   =   array(
                                        'operator_id'   => $this->session->userdata('sub_login_id'),
                                        'reference_id'  => $this->session->userdata('sub_login_id'),
                                        'action'        => $action
                                    );

                $query = $this->db->insert('user_log', $log_data); 
                return $query;
        }else{
            return false;
        }
        
    }
    
    
//    function getAllocatedCourses($teacher_id)
//    {
//        $this->db->select('courses.course_id,courses.course_name');
//        $this->db->from('courses');
//        $this->db->join('courses_allocation ca','courses.course_id = ca.course_id');
//        $this->db->where('ca.teacher_id',$teacher_id);
//        $query      =       $this->db->get();
//        return $query->result_array();
//    }
    
    function getStudents($session_id,$program_id,$course_id,$teacher_id)
    {
        $this->db->select('student_courses.*,forms.student_name,students.roll_no,programs.program_name,courses.course_name');
        $this->db->from('student_courses');
        $this->db->join('students','students.student_id = student_courses.student_id','inner');
        $this->db->join('forms','forms.form_id = students.form_id','inner');
        $this->db->join('programs','forms.program_id = programs.program_id','inner');
        $this->db->join('courses','student_courses.course_id = courses.course_id','inner');
        $this->db->where('student_courses.session_id',$session_id);
        $this->db->where('student_courses.teacher_id',$teacher_id);
        $this->db->where('student_courses.course_id',$course_id);
        //$this->db->where('forms.program_id',$program_id);        
        $query =    $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
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
    
    
    function submitAttendance($absent_data){
        
        $query = $this->db->insert('attendance_absent', $absent_data); 		
        return $this->db->insert_id();
        
    }
    
    function submitAttendancePresent($present_data){
               
        $query = $this->db->insert('attendance_present', $present_data); 		
        return $this->db->insert_id();       
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
    
    
    
      // check duplication of Bank Name
    
    function checklink($data)
    {
        $query = $this->db->get_where('useful_links', $data);
        return $query->result_array();
    }
	
	 // add new Bank in db
    
    function addlink($data)
    {
        $query = $this->db->insert('useful_links', $data); 
        return $this->db->insert_id();
    }
   
     // get all Banks data from db
    
    function getAlllinks()
    {      
        $this->db->select('*');
        $this->db->from('useful_links');        
        $this->db->order_by("link_id", "ASC"); 
        $query = $this->db->get();
        
        return $query->result_array();
    }
    	
    // get a campus record for update
    
    function getlink($id)
    {       
        $query = $this->db->get_where('useful_links', array('link_id' => $id));
		
        return $query->result_array();
    }
	
	 // update the link record
    
    function updatelink($id, $link)
    {       
        $this->db->where('link_id', $id);
        $query = $this->db->update('useful_links', $link); 
        
        return $query;        
    }
    
    /*by zohaib strat */
    function add_assignment($data)
    {
        $query = $this->db->insert('courses_assets', $data);
        return $this->db->insert_id();
    }
    
    function getAllassignments($teacher_id,$current_session_id)
    {
        $this->db->select('ca.course_id,ca.program_id,programs.program_name,courses.course_name, courses_assets.*');
        $this->db->from('courses_allocation ca');
        $this->db->join('programs','programs.program_id = ca.program_id','inner');
        $this->db->join('courses','courses.course_id = ca.course_id','inner');
        $this->db->join('courses_assets','courses_assets.course_id = ca.course_id','inner');
        
        
        $this->db->where('ca.session_id',$current_session_id);
        $this->db->where('ca.teacher_id',$teacher_id);
        $this->db->where('courses_assets.asset_type','Assignment');
        
        $query      = $this->db->get();
        $num_rows   = $query->num_rows();
        
        if($num_rows > 0 ){ return $query->result_array(); }else{ return null; }
    }
    
    function getAllquiz($teacher_id,$current_session_id)
    {
        $this->db->select('ca.course_id,ca.program_id,programs.program_name,courses.course_name, courses_assets.*');
        $this->db->from('courses_allocation ca');
        $this->db->join('programs','programs.program_id = ca.program_id','inner');
        $this->db->join('courses','courses.course_id = ca.course_id','inner');
        $this->db->join('courses_assets','courses_assets.course_id = ca.course_id','inner');
        
        
        $this->db->where('ca.session_id',$current_session_id);
        $this->db->where('ca.teacher_id',$teacher_id);
        $this->db->where('courses_assets.asset_type','Quiz');
        
        $query      = $this->db->get();
        $num_rows   = $query->num_rows();
        
        if($num_rows > 0 ){ return $query->result_array(); }else{ return null; }
    }
    
    function getAlllecture($teacher_id,$current_session_id)
    {
        $this->db->select('ca.course_id,ca.program_id,programs.program_name,courses.course_name, courses_assets.*');
        $this->db->from('courses_allocation ca');
        $this->db->join('programs','programs.program_id = ca.program_id','inner');
        $this->db->join('courses','courses.course_id = ca.course_id','inner');
        $this->db->join('courses_assets','courses_assets.course_id = ca.course_id','inner');
        $this->db->where('ca.session_id',$current_session_id);
        $this->db->where('ca.teacher_id',$teacher_id);
        $this->db->where('courses_assets.asset_type','Lecture');
        
        $query      = $this->db->get();
        $num_rows   = $query->num_rows();
        if($num_rows > 0 ){ return $query->result_array(); }else{ return null; }
    }
    
    /*by zohiab end*/
    
    
     //   ***** Start function for Cat Module *****   //
    
    // check duplication of city name
    
    function checkCat($cat)
    {
        $query = $this->db->get_where('books_categories', $cat);		
        return $query->result_array();
    }
    
    
    // add city in db
    
    function addCat($cat)
    {
        $query = $this->db->insert('books_categories', $cat); 		
        return $this->db->insert_id();
    }
    
    // get all cities from db
    
    function getAllcats()
    {
        $this->db->order_by('cat_name', 'ASC'); 
        $query = $this->db->get('books_categories');		
        return $query->result_array();
    }
    
    // get a city for update
    
    function getCat($id)
    {       
        $query = $this->db->get_where('books_categories', array('cat_id' => $id));
		
        return $query->result_array();
    }
    
    // update the city name
    
    function updateCat($id,$cat)
    {
        $this->db->where('cat_id', $id);
        $query = $this->db->update('books_categories', $cat);
		 
        return $query;        
    }
    

    // added by zohaib for new secviotn wise start
    
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
    function getStudentCourseSection($program_id, $current_session_id, $section , $course_id,$batch_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query = "
        SELECT * FROM
            `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN students on `student_course_sections`.student_id = `students`.student_id 
        INNER JOIN forms on `forms`.form_id = `students`.form_id 

        WHERE teacher_id != ''
        AND student_course_sections.current_session_id = $current_session_id
        
        and student_course_sections.program_id = $program_id
        and student_course_sections.batch_id = $batch_id
        and students.batch_id = $batch_id
        and course_section = '$section' 
        and students.status = 'ok' 
        and student_course_sections.course_id = '$course_id' ";
        
        
        $query_data = $this->db->query($query);
//        echo $this->db->last_query();die;
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
    
    function checkMidStructure($program_id,$course_id,$course_section)
    {
            $query = $this->db->query("SELECT * FROM mid_course_structure 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id  = $program_id AND
                                        course_id   = $course_id AND
                                        section     = '$course_section' ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
     // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure', $mid_data); 
		
        return $this->db->insert_id();
    }
    
    function getMidStructure($program_id,$course_id,$section,$batch_id,$current_session_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        mid_course_structure 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = $batch_id AND 
                                        session_id = $current_session_id
                                  ");
        
        //echo $this->db->last_query();die;
        return $query->row();
        
    }
    
    function getFinalStructure($program_id,$course_id,$section,$batch_id,$current_session_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        final_course_structure 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = $batch_id AND 
                                        session_id = $current_session_id
                                  ");
        
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
    
     function checkFinalStructure($program_id,$course_id,$course_section)
        {
            $query = $this->db->query("SELECT * FROM final_course_structure 
                                    WHERE 
                                     teacher_id != '' AND 
                                        program_id  = $program_id AND
                                        course_id   = $course_id AND
                                        section     = '$course_section' ");
            return $query->result_array();
        }
    
    // add final term structre
    
    function addFinalStructure($final_data)
    {
        $query = $this->db->insert('final_course_structure', $final_data); 
		
        //echo $this->db->last_query();die;
        return $this->db->insert_id();
    }
    
    function getFianlStructure($program_id,$course_id,$section,$batch_id,$current_session_id)
    {
         $query = $this->db->query("SELECT * FROM 
                                        final_course_structure 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = '$batch_id' AND 
                                        session_id = $current_session_id
                                  ");
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
    
    function CheckMidResult($program_id,$course_id,$course_section,$session_id,$batch_id)
    {        
        $query = $this->db->query("SELECT * FROM mid_result_status 
                                    WHERE 
                                        teacher_id != '' AND 
                                        program_id  = $program_id AND
                                        course_id   = $course_id AND
                                        session_id  =   $session_id AND
                                        batch_id  =   $batch_id AND
                                        section     = '$course_section'");
        
//        echo $this->db->last_query();die;
        //return $query->result_array();
        return $query->num_rows();
    }
    function CheckFinalResult($program_id,$course_id,$course_section,$session_id,$batch_id)
    {
         $query = $this->db->query("SELECT * FROM final_result_status
                                    WHERE 
                                        teacher_id  != '' AND
                                        program_id  = $program_id AND
                                        batch_id  = $batch_id AND
                                        course_id   = $course_id AND
                                        session_id  =   $session_id AND
                                        section     = '$course_section'");
        //return $query->result_array();
        return $query->num_rows();
    }
    
    function CheckMidResult_semester($program_id,$course_id,$semester,$campaign_id)
    {        
        $query = $this->db->query("SELECT * FROM mid_result_status 
                                    WHERE
                                        program_id  = $program_id AND
                                        course_id   = $course_id AND
                                        campaign_id = $campaign_id AND
                                        semester  =   $semester ");
        //echo $this->db->last_query();die;
        return $query->num_rows();
    }
    function CheckFinalResult_semester($program_id,$course_id,$semester,$campaign_id)
    {
         $query = $this->db->query("SELECT * FROM final_result_status 
                                    WHERE 
                                        teacher_id != '' AND 
                                        program_id  = $program_id AND
                                        course_id   = $course_id AND
                                        campaign_id = $campaign_id AND
                                        semester  =   $semester ");
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
    
    function getMidResult($student_id,$session_id,$course_id,$program_id,$batch_id,$section)
    {
        $query = $this->db->query("SELECT * FROM 
                                    mid_result 
                                    WHERE 
                                    teacher_id != '' AND 
                                    student_id = $student_id AND 
                                    program_id = $program_id AND 
                                    batch_id = $batch_id AND 
                                    section  = '$section' AND 
                                    session_id = $session_id AND 
                                    course_id = $course_id
                              ");	
        //echo $this->db->last_query();die;
        return $query->row();
    }
    
    function getFinalResult($student_id,$session_id,$course_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                    final_result 
                                    WHERE 
                                   teacher_id != '' AND 
                                    student_id = $student_id AND 
                                    session_id = $session_id AND 
                                    course_id = $course_id
                              ");	
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
     
      //function getAllocatedCourseSection($teacher_id, $semester, $current_session_id){
    function getAllocatedCourseSectionLatest($teacher_id, $current_session_id,$batch_id){
        
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id where teacher_id = $teacher_id  and current_session_id = $current_session_id group by course_section";
         $query      = 
        "SELECT * ,courses.* FROM `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.course_id = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN sessions on `student_course_sections`.current_session_id = `sessions`.session_id 
        WHERE  
        teacher_id       != ''
        AND current_session_id  = $current_session_id 
        AND student_course_sections.batch_id            = $batch_id 
        GROUP BY `student_course_sections`.course_id,`student_course_sections`.program_id, `student_course_sections`.course_section";
                       
        $query_data = $this->db->query($query);
       //echo $this->db->last_query();die;
        return $query_data->result_array();
    }
    
    function getAllocatedCourseSectionLatest2($teacher_id, $current_session_id,$batch_id){
        
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id where teacher_id = $teacher_id  and current_session_id = $current_session_id group by course_section";
         $query      = 
        "SELECT * ,courses.* FROM `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.course_id = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN sessions on `student_course_sections`.current_session_id = `sessions`.session_id 
        WHERE  
        teacher_id       != ''
        AND current_session_id  = $current_session_id 
        AND student_course_sections.batch_id            = $batch_id 
        GROUP BY `student_course_sections`.program_id, `student_course_sections`.course_section";
                       
        $query_data = $this->db->query($query);
        //echo $this->db->last_query();die;
        return $query_data->result_array();
    }
    
      //function getAllocatedCourseSection($teacher_id, $semester, $current_session_id){
    function checkteacher_course($teacher_id,$course_id,$course_section,$batch_id,$program_id,$session){
        
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id where teacher_id = $teacher_id  and current_session_id = $current_session_id group by course_section";
        $query      = 
        "SELECT id FROM `student_course_sections` 
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
    // **** Sections Courses assigned via section ends****  \\
    // 
    // 
    // 
    // **** Sections Courses assigned via section start zohaib****  \\
     function getStudentCourseSectionLatest($teacher_id,$program_id, $session_id,$semester, $section, $batch_id, $course_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query = "
        SELECT * FROM
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
    //semester  = $semester AND
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
    
    // **** Sections Courses assigned via section start zohaib ends****  \\
    
      function getMidResStatus($program_id,$course_id,$section,$batch_id,$current_session_id){
        $query = $this->db->query("SELECT * FROM mid_result_status 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = $batch_id AND
                                        session_id = '$current_session_id'
                                    ");
        //echo $this->db->last_query();die;
        return $query->row();
    }
    
    function getFinalResStatus($program_id,$course_id,$section,$batch_id,$current_session_id){
        $query = $this->db->query("SELECT * FROM final_result_status 
                                        WHERE 
                                        teacher_id != '' AND 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = '$batch_id' AND
                                        session_id = '$current_session_id'
                                    ");
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
    
    
     function del_mid_result($program_id,$course_id,$section,$session_id,$batch_id,$log_data)
    {
        $res    =   $this->db->query("DELETE FROM mid_result 
                                        WHERE 
                                                        teacher_id != '' AND
                                                        program_id = $program_id AND
                                                        course_id = $course_id AND
                                                        section = '$section' AND
                                                        session_id = $session_id AND
                                                        batch_id = $batch_id");
        //echo $this->db->last_query();die;
        if($res){
                    $res2    =   $this->db->query("DELETE FROM mid_result_status 
                                        WHERE 
                                                        teacher_id != '' AND
                                                        program_id = $program_id AND
                                                        course_id = $course_id AND
                                                        section = '$section' AND
                                                        session_id = $session_id AND
                                                        batch_id = $batch_id");

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
    
    function del_final_result($program_id,$course_id,$section,$session_id,$batch_id,$log_data)
    {
        $res    =   $this->db->query("DELETE FROM final_result 
                                        WHERE 
                                                        teacher_id != '' AND
                                                        program_id = $program_id AND
                                                        course_id = $course_id AND
                                                        section = '$section' AND
                                                        session_id = $session_id AND
                                                        batch_id = $batch_id");
        //echo $this->db->last_query();die;
        if($res){
                    $res2    =   $this->db->query("DELETE FROM final_result_status 
                                        WHERE 
                                                        teacher_id != '' AND
                                                        program_id = $program_id AND
                                                        course_id = $course_id AND
                                                        section = '$section' AND
                                                        session_id = $session_id AND
                                                        batch_id = $batch_id");

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
 
    
    function getStudentCourseSectionInd($teacher_id,$program_id, $current_session_id, $section,$course_id){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query = "
        SELECT * FROM
            `student_course_sections` 
        INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id 
        INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id 
        INNER JOIN students on `student_course_sections`.student_id = `students`.student_id 
        INNER JOIN forms on `forms`.form_id = `students`.form_id 

        WHERE teacher_id != ''
        AND student_course_sections.current_session_id = $current_session_id
        
        and student_course_sections.program_id = $program_id
        and student_course_sections.course_id  = $course_id
        and course_section = '$section' ";
        
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
 
    // *************** start for cr edit/del sheet in scms
    
   function UpdateMidResult($mid_result,$mid_result_id)
    {
        $this->db->where('mid_result_id', $mid_result_id);
        $this->db->update('mid_result', $mid_result);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }
    
     function UpdateFinalResult($final_result_id,$final_result)
    {
        $this->db->where('final_result_id', $final_result_id);
        $this->db->update('final_result', $final_result); 
        return $this->db->affected_rows();
    }
   
    
}