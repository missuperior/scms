<?php
class Examination_model extends CI_Model {

     //   ***** Start function for Course Module *****   //
    
    
    // check duplication of course name
    
    function checkcourse($check_data)
    {
        $query = $this->db->get_where('coursess', $check_data);
        return $query->result_array();
    }
    
    
    // add new course in db
    
    function addCourse($course_data)
    {
        $query = $this->db->insert('coursess', $course_data); 
        return $this->db->insert_id();
    }
    
     // get all courses data from db
    
    function getAllCourses()
    {        
        $this->db->select('coursess.*,programs.program_name');        
        $this->db->from('coursess');        
        $this->db->join('programs','programs.program_id = coursess.program_id','inner');                
        $this->db->order_by("coursess.course_id", "desc"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // get a course record for update
    
    function getCourse($id)
    {       
        $query = $this->db->get_where('coursess', array('course_id' => $id));
        return $query->row();
    }
        
     // update the course record
    
    function updateCourse($id, $course)
    {
        $this->db->where('course_id', $id);
        $this->db->update('coursess', $course); 
        return $this->db->affected_rows();        
    }
    
    function getAllocatedCourseSection($teacher_id, $current_session_id){
        
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
    
    
    // **** Start Addded By Tariq For Examination ****  \\
    
    
    function getCoursesList($program_id){
        
        $query = $this->db->get_where('coursess', array('program_id'=>$program_id));
        return $query->result_array();
    }
    
    // check duplicate entery
    
     function checkMidStructure($check_data)
        {
            $query = $this->db->get_where('mid_course_structure', $check_data);
            return $query->result_array();
        }
    
     // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure', $mid_data); 
		
        return $this->db->insert_id();
    }
    
    function getMidResStatus($data){
        $query = $this->db->get_where('mid_result_status', $data);
        return $query->row();
    }
    
    function getStudent($campaign_id,$program_id)
    {
        $query      =   $this->db->query("select students.*,forms.student_name,programs.program_name,campaign.campaign_name
                                           from 
                                           students
                                           INNER JOIN forms ON forms.form_id = students.form_id
                                           INNER JOIN programs ON programs.program_id = forms.program_id 
                                           INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id 
                                           where
                                           forms.program_id = $program_id AND
                                           forms.campaign_id = $campaign_id AND
                                           students.roll_no != '' AND
                                           students.status = 'ok'
                                           ORDER BY students.roll_no ASC
                                            ");
       // echo $this->db->last_query();die;
        return      $query->result_array();
    }
    
    function getMissedStudents($campaign_id,$program_id,$course_id,$semester,$term){
        
        $table      =   $term == 'mid' ? 'mid_result' : 'final_result';
        
        $query1      =   $this->db->query("SELECT students.student_id FROM students 
                                            INNER JOIN forms ON forms.`form_id` = students.`form_id` 
                                            WHERE 
                                            forms.`campaign_id` = $campaign_id AND 
                                            forms.`program_id` = $program_id AND 
                                            students.`roll_no` != '' AND 
                                            students.status = 'ok' 
                                            ORDER BY students.roll_no ASC");
        
        $query2      =   $this->db->query("SELECT $table.student_id
                                            FROM $table 
                                            INNER JOIN students ON $table.`student_id` = students.`student_id`
                                            INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                            WHERE
                                            $table.campaign_id =$campaign_id AND
                                            $table.program_id = $program_id AND 
                                            $table.course_id = $course_id AND
                                            $table.`semester` = $semester");

        $res1       =   $query1->result_array();
        $res2       =   $query2->result_array();
        
        
        foreach($res1 AS $row1){
            $array1[] =   $row1['student_id'];
        }
        foreach($res2 AS $row2){
            $array2[] =   $row2['student_id'];
        }
        $aray           =   array_diff($array1,$array2);
        $array          = array_values($aray);
            if(count($array) > 0){
                foreach($array AS $key=>$row){
                    if($key == 0){
                                $qry    = 'where students.student_id = '.$row;
                    }else{
                                $qry    =  $qry.' OR students.student_id = '.$row;
                    }
                }

                $query      =   $this->db->query("select students.student_id,students.roll_no,forms.student_name from students
                                            inner join forms on forms.form_id = students.form_id $qry");
        
                return      $query->result_array();
            }else{
                return false;
            }
        
    }
    
    function getMidStructure($data)
    {
        $query = $this->db->get_where('mid_course_structure', $data);
//        echo $this->db->last_query();die;
        return $query->row();
    }
    function getMidStructureCr($program_id,$course_id, $section , $batch_id , $session_id)
    {
        $query = $this->db->query("SELECT *
                                        FROM 
                                        `mid_course_structure`
                                        
                                        WHERE `program_id` = $program_id
                                        AND `course_id` = $course_id
                                        AND `section` = '$section'
                                        AND `batch_id` = '$batch_id'
                                        AND `session_id` = '$session_id'
                                        AND `teacher_id` is not null
                                      ");
        
        //echo $this->db->last_query();
        //echo '<br/>';
        //echo '<pre>';var_dump($query->row());echo '</pre>';
        return $query->row();
    }

    function MidStructure($mid_structure_id)
    {        
        $query = $this->db->get_where('mid_course_structure', array('mid_course_structure_id' => $mid_structure_id));
        return $query->row();
    }


    // get mid marks
    
    function getMidTotalMarks($campaign_id,$program_id,$course_id)
    {
        $query  =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid_total
                                      FROM mid_course_structure
                                      WHERE                                      
                                      program_id = $program_id AND
                                      course_id = $course_id AND
                                      campaign_id = $campaign_id
                                      ");
//        echo $this->db->last_query();die;
        return $query->row();
    }
    
    function updateMidStructure($mid_course_id,$mid_data)
    {
        $this->db->where('mid_course_structure_id', $mid_course_id);
        $this->db->update('mid_course_structure', $mid_data); 
        return $this->db->affected_rows();
    }
    
    // get mid marks
    
    function getFinalTotalMarks($teacher_id,$course_section,$program_id,$semester,$course_id)
    {
        $query  =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final_total
                                      FROM final_structure
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
		
        return $this->db->insert_id();
    }
    
    function getFinalStructure($data)
    {
        $query = $this->db->get_where('final_course_structure', $data);
        return $query->row();
    }
    function getFinalStructureCr($program_id,$course_id, $section , $batch_id , $session_id)
    {
        $query = $this->db->query("SELECT *
                                        FROM 
                                        `final_course_structure`
                                        
                                        WHERE `program_id` = $program_id
                                        AND `course_id` = $course_id
                                        AND `section` = '$section'
                                        AND `batch_id` = '$batch_id'
                                        AND `session_id` = '$session_id'
                                        AND `teacher_id` is not null
                                      ");
        
//        echo $this->db->last_query();
//        echo '<br/>';
        //echo '<pre>';var_dump($query->row());echo '</pre>';
        return $query->row();
    }
    
    function getFinalResStatus($check_data){
        $query = $this->db->get_where('final_result_status', $check_data);
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
        return $query->row();
    }
    function CheckMidResult2($check_data)
    {
        $query = $this->db->get_where('mid_result', $check_data);
        return $query->row();
    }
    function CheckFinalResult($check_data)
    {
        $query = $this->db->get_where('final_result_status', $check_data);
        return $query->row();
    }
    function CheckFinalResult2($check_data)
    {
        $query = $this->db->get_where('final_result', $check_data);
        return $query->row();
    }
    
    function AddMidResult($mid_result)
    {
        $query = $this->db->insert('mid_result', $mid_result); 	        
        return $this->db->insert_id();
    }
    function AddMidResultStatus($mid_result_status,$campaign_id,$program_id,$course_id,$semester)
    {
        $query = $this->db->insert('mid_result_status', $mid_result_status); 		
        $id    = $this->db->insert_id();
        
        // add Examination log
        
        if($id){
            // update last login date and time
            
                $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                => 'Add Mid Result',
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                $query = $this->db->insert('examination_logs', $log_data); 
                return $id;             
        }else{  
            return false;
        }
    }
    function AddFinalResultStatus($final_result_status,$campaign_id,$program_id,$course_id,$semester)
    {
        $query = $this->db->insert('final_result_status', $final_result_status); 		
        $id    = $this->db->insert_id();
        
         // add Examination log
        
        if($id){
            // update last login date and time
            
                $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                        
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                => 'Add Final Result',
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                $query = $this->db->insert('examination_logs', $log_data); 
                return $id;             
        }else{  
            return false;
        }
    }
    function AddFinalResult($final_result)
    {
        $query = $this->db->insert('final_result', $final_result); 		
        return $this->db->insert_id();
    }
    
    function getMidResult($campaign_id,$program_id,$course_id,$semester)
    {
        $query  =   $this->db->query("SELECT students.`roll_no`,forms.`student_name`,programs.`program_name`,coursess.`course_name`,mid_result.*,campaign.campaign_name
                            FROM students
                            INNER JOIN forms ON forms.form_id = students.form_id
                            INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                            INNER JOIN programs ON programs.`program_id` = forms.`program_id`
                            INNER JOIN coursess ON coursess.`course_id` = mid_result.`course_id`
                            INNER JOIN campaign ON campaign.`campaign_id` = forms.`campaign_id`

                            WHERE
                            mid_result.campaign_id       = $campaign_id AND
                            mid_result.`program_id` = $program_id AND
                            mid_result.`course_id` = $course_id AND
                            mid_result.`semester` = $semester
                                
                            ORDER BY students.roll_no ASC
                            ");
       // echo $this->db->last_query();die;
        return $query->result_array();
        }
    
    function getFinalResult($campaign_id,$program_id,$course_id,$semester)
    {
        $query  =   $this->db->query("SELECT students.`roll_no`,forms.`student_name`,programs.`program_name`,coursess.`course_name`,final_result.*,campaign.campaign_name
                            FROM students
                            INNER JOIN forms ON forms.form_id = students.form_id
                            INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                            INNER JOIN programs ON programs.`program_id` = forms.`program_id`
                            INNER JOIN coursess ON coursess.`course_id` = final_result.`course_id`
                            INNER JOIN campaign ON campaign.`campaign_id` = forms.`campaign_id`

                            WHERE

                            final_result.campaign_id  = $campaign_id AND
                            final_result.`program_id` = $program_id  AND
                            final_result.`course_id`  = $course_id   AND
                            final_result.`semester`   = $semester
                                
                            ORDER BY students.roll_no ASC
                            ");
        // echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    function get_std_info($roll_no)
    {
            $query  =   $this->db->query("SELECT mid_result.semester,students.`roll_no`,forms.`father_name`,forms.`student_name`, 
                                        programs.program_name,batch.* 

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`                                         
                                        INNER JOIN batch ON batch.`batch_id` = students.`batch_id`                                         
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`                                         
                                        INNER JOIN programs ON programs.`program_id` = forms.`program_id` 
                                        
                                        WHERE 
                                        students.roll_no = '$roll_no'                                            

                                        GROUP BY 
                                        mid_result.`semester`
                                      ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
    function get_std_info_req($roll_no,$semester)
    {
            $query  =   $this->db->query("SELECT mid_result.semester,students.`roll_no`,forms.`father_name`,forms.`student_name`, 
                                        programs.program_name,batch.* 

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`                                         
                                        INNER JOIN batch ON batch.`batch_id` = students.`batch_id`                                         
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`                                         
                                        INNER JOIN programs ON programs.`program_id` = forms.`program_id` 
                                        
                                        WHERE 
                                        students.roll_no = '$roll_no' AND
                                        mid_result.semester = $semester

                                        GROUP BY 
                                        mid_result.`semester`
                                      ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
    function get_std_info_rang($roll_no,$semester)
    {
            $query  =   $this->db->query("SELECT mid_result.semester,students.`roll_no`,forms.`father_name`,forms.`student_name`, 
                                        programs.program_name,batch.* 

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`                                         
                                        INNER JOIN batch ON batch.`batch_id` = students.`batch_id`                                         
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`                                         
                                        INNER JOIN programs ON programs.`program_id` = forms.`program_id` 
                                        
                                        WHERE 
                                        students.roll_no = '$roll_no' AND
                                        mid_result.semester <= $semester

                                        GROUP BY 
                                        mid_result.`semester`
                                      ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
    
    function get_std_result($semester,$roll_no)
    {
        $query  =   $this->db->query("SELECT students.semester,
                                        SUM(mid_result.`mid_value_1`+mid_result.`mid_value_2`+mid_result.`mid_value_3`) AS mid_total, 
                                        SUM(final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS final_total, 
                                        coursess.course_name,coursess.credit_hours 

                                        FROM students 

                                        INNER JOIN forms ON forms.`form_id` = students.`form_id` 
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id` 
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id` 
                                        INNER JOIN programs ON programs.program_id = forms.`program_id` 
                                        INNER JOIN coursess ON coursess.course_id = mid_result.`course_id` 

                                        WHERE 
                                        students.roll_no = '$roll_no' AND 
                                        mid_result.`semester` =  '$semester' AND 
                                        mid_result.`course_id` = final_result.`course_id` 

                                        GROUP BY mid_result.`course_id` 
                                        ORDER BY students.`semester` 
                                      ");
         // echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    function del_mid_result($mid_result_delete,$campaign_id,$program_id,$course_id,$semester)
    {
        $res    =   $this->db->delete('mid_result',$mid_result_delete);
        
        if($res){
                    $res2    =   $this->db->delete('mid_result_status',$mid_result_delete);

                    // for user log
                    if($res2){
                    // update last login date and time

                        $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                        
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                =>  'Delete Mid Result',
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                        $query = $this->db->insert('examination_logs', $log_data); 
                        return $res2;             
                }else{  
                    return false;
                }
        }
        return false;
    }
    
    function del_final_result($final_result_delete,$campaign_id,$program_id,$course_id,$semester)
    {
        $res    =   $this->db->delete('final_result',$final_result_delete);
        
        if($res){
            $res2    =   $this->db->delete('final_result_status',$final_result_delete);
            // for user log
                    if($res2){
                    // update last login date and time

                        $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                        
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                =>  'Delete Final Result',
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                        $query      = $this->db->insert('examination_logs', $log_data); 
                        return $res2;             
                }else{  
                    return false;
                }
        }
        return false;
    }
    
    function post_mid_result($data,$status,$campaign_id,$program_id,$course_id,$semester){
        $this->db->where($data);
        $this->db->update('mid_result_status', array('result_status' => $status));
        // for user log
        $action      =   $status == 1 ? 'Unverify Mid Result' : 'Verify Mid Result';
        if($this->db->affected_rows() > 0){       
            // update last login date and time
            
                $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                        
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                =>  $action,
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                $query = $this->db->insert('examination_logs', $log_data); 
                return $id;             
        }else{  
            return false;
        }
        
    }
    function post_final_result($data,$status,$campaign_id,$program_id,$course_id,$semester){
        $this->db->where($data);
        $this->db->update('final_result_status', array('result_status' => $status)); 
        
        $action      =   $status == 1 ? 'Unverify Final Result' : 'Verify Final Result';
        if($this->db->affected_rows() > 0){       
            // update last login date and time
            
                $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                        
                                        'semester'              =>  $semester,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'campaign_id'           =>  $campaign_id,
                                        'action'                =>  $action,
                                        'ip_address'            => $_SERVER['REMOTE_ADDR']
                                    );
                $query = $this->db->insert('examination_logs', $log_data); 
                return $id;             
        }else{  
            return false;
        }
        
    }
    
    function UpdateMidResult($mid_result_id,$mid_result)
    {
        $this->db->where('mid_result_id', $mid_result_id);
        $this->db->update('mid_result', $mid_result); 
        return $this->db->affected_rows();
    }
//    function UpdateMidResult($mid_result_id,$mid_result,$campaign_id,$program_id,$course_id,$semester)
//    {
//        $this->db->where('mid_result_id', $mid_result_id);
//        $this->db->update('mid_result', $mid_result); 
//        return $this->db->affected_rows();
//    }
    function AddResultLog($log_data){                         
            return  $this->db->insert('edit_del_result_log', $log_data);                 
    }

    function UpdateFinalResult($final_result_id,$final_result)
    {
        $this->db->where('final_result_id', $final_result_id);
        $this->db->update('final_result', $final_result); 
        return $this->db->affected_rows();
    }
//    function UpdateFinalResult($final_result_id,$final_result,$campaign_id,$program_id,$course_id,$semester)
//    {
//        $this->db->where('final_result_id', $final_result_id);
//        $this->db->update('final_result', $final_result); 
//        return $this->db->affected_rows;
//    }
  
function getStudentsMidResult($campaign_id,$program_id,$course_id,$semester){
       
        $query      =   $this->db->query("SELECT students.roll_no,forms.`student_name`,mid_result.semester,mid_result.mid_value_1,mid_result.`mid_value_2`,mid_result.`mid_value_3`,mid_result.`status`,
                                        campaign.campaign_name,campus.campus_name,coursess.course_name,programs.program_name,batch.*
                                        FROM students
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN campus on campus.campus_id = forms.campus_id                                        
                                        INNER JOIN coursess on coursess.course_id = mid_result.course_id
                                        INNER JOIN programs on programs.program_id = forms.program_id
                                        INNER JOIN campaign on campaign.campaign_id = forms.campaign_id
                                        INNER JOIN batch on batch.batch_id = students.batch_id
                                        WHERE
                                        
                                        forms.campaign_id = $campaign_id AND
                                        forms.program_id = $program_id AND
                                        mid_result.`course_id` = $course_id AND
                                        mid_result.`semester` = $semester
                                        ORDER BY students.roll_no ASC");
        //echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    
    function getStudentsFinalResult($campaign_id,$program_id,$course_id,$semester){
       
        $query      =   $this->db->query("SELECT students.`roll_no`,forms.`student_name`,final_result.semester,
                                            final_result.final_value_1,final_result.`final_value_2`,final_result.`final_value_3`,final_result.final_value_4,final_result.`final_value_5`,final_result.`final_value_6`,final_result.`final_value_7`,
                                            mid_result.`mid_value_1`,mid_result.`mid_value_2`,mid_result.`mid_value_3`,
                                            final_result.`status`,campus.campus_name,coursess.course_name,programs.program_name,campaign.campaign_name,batch.*

                                        FROM 
                                        students
                                        
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus on campus.campus_id = forms.campus_id
                                        INNER JOIN coursess on coursess.course_id = final_result.course_id
                                        INNER JOIN programs on programs.program_id = forms.program_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN batch on batch.batch_id = students.batch_id
                                        
                                        WHERE
                                        forms.campaign_id = $campaign_id AND
                                        forms.program_id = $program_id AND                                        
                                        final_result.`course_id` = $course_id AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        final_result.`semester` = $semester 
                                        ORDER BY students.roll_no ASC");
       // echo $this->db->last_query();die;
        return $query->result_array();
        
    }
   
    function uploadMidMarks($data){        
        $this->db->where($data);
        $this->db->update('mid_result_status', array('result_status'=>2)); 
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }
    
    function uploadFinalMarks($data){        
        $this->db->where($data);
        $this->db->update('final_result_status', array('result_status'=>2)); 
//        echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }
    
    
    
    
    function classWiseMidReport($campaign_id,$program_id,$semester){
       
        $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,mid_result.`program_id`,mid_result.`course_id`,SUM(mid_result.`mid_value_1`+mid_result.`mid_value_2`+mid_result.`mid_value_3`) AS obtained ,mid_result.semester,
                                        coursess.`course_name`,coursess.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name`,batch.*
                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id =students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN coursess ON coursess.course_id = mid_result.course_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 
                                        
                                        forms.`program_id`= $program_id AND
                                        forms.`campaign_id` = $campaign_id AND
                                        mid_result.`semester` = $semester   AND
                                        students.status = 'ok'
                                        GROUP BY mid_result.`student_id`,mid_result.`course_id`
                                        ORDER BY students.roll_no ASC,  coursess.course_id ASC");
//          echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function classWiseMidReport_cr($program_id,$section,$batch_id,$session_id){
       
        $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,mid_result.`program_id`,mid_result.`course_id`,SUM(mid_result.`mid_value_1`+mid_result.`mid_value_2`+mid_result.`mid_value_3`) AS obtained ,mid_result.semester,
                                        courses.`course_name`,courses.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name`,batch.*
                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id =students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN courses ON courses.course_id = mid_result.course_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 
                                        
                                        forms.`program_id`          = $program_id AND
                                        mid_result.`section`        = '$section'   AND
                                        mid_result.`session_id`     = $session_id   AND
                                        mid_result.`batch_id`       = $batch_id   AND
                                        students.status = 'ok'
                                        GROUP BY mid_result.`student_id`,mid_result.`course_id`
                                        ORDER BY students.roll_no ASC,  courses.course_id ASC");
      // echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function classWiseFinalReport($campaign_id,$program_id,$semester){
       
        $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1,
                                        mid_result.`course_id`  AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2,
                                        final_result.semester, coursess.`course_name`,coursess.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name` ,batch.*

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id =students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN coursess ON coursess.course_id = final_result.course_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 
                                        
                                        forms.`program_id`= $program_id AND
                                        forms.`campaign_id` = $campaign_id AND                                             
                                        mid_result.`semester` = $semester AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        final_result.`semester` = $semester AND
                                        students.status = 'ok'
                                           
                                        
                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id` 
                                        ORDER BY students.roll_no ASC, coursess.course_id ASC");
       // echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function FailureReport($campaign_id,$program_id,$semester){
       
        $query      =   $this->db->query("SELECT 
                                                students.`student_id`,students.roll_no,forms.student_name,programs.program_id,programs.`program_name`,campaign.`campaign_name`
                                                FROM students 
                                                INNER JOIN forms ON forms.form_id =students.form_id 
                                                INNER JOIN final_result ON final_result.`student_id` = students.`student_id` 
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 

                                                WHERE 
                                                final_result.`program_id`= $program_id AND 
                                                final_result.`campaign_id` = $campaign_id AND 
                                                final_result.`semester` = $semester AND 
                                                students.status = 'ok' 
                                                GROUP BY 
                                                final_result.`student_id`
                                                ORDER BY 
                                                students.roll_no ASC");
       // echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function classWiseFinalReport_cr($program_id,$section,$batch_id,$session_id){
       
        $query      =   $this->db->query("SELECT students.enrolled_session_id,students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3+final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained,
                                        mid_result.`course_id`  AS mid_course,sessions.session,
                                        final_result.session_id, courses.`course_name`,courses.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name` ,batch.*

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id =students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN courses ON courses.course_id = final_result.course_id
                                        INNER JOIN sessions ON sessions.session_id = final_result.session_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 
                                        
                                        forms.`program_id`= $program_id AND
                                        final_result.`section` = '$section' AND                                             
                                        final_result.`batch_id` = $batch_id AND
                                        final_result.`session_id` = $session_id AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        students.status = 'ok'
                                           
                                        

                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id` 
                                        ORDER BY students.roll_no ASC, courses.course_id ASC");
        //                                        GROUP BY final_result.`course_id`,final_result.`course_id`,mid_result.`course_id` 
//                                        ORDER BY courses.course_id ASC");
        
        //echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    function classWiseFinalReport_cr_Jal($program_id,$section,$batch_id,$session_id){
       
        $query      =   $this->db->query("SELECT students.enrolled_session_id,students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3+final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained,
                                        mid_result.`course_id`  AS mid_course,sessions.session,
                                        final_result.session_id, courses.`course_name`,courses.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name` ,batch.*

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id =students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        INNER JOIN courses ON courses.course_id = final_result.course_id
                                        INNER JOIN sessions ON sessions.session_id = final_result.session_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 
                                        
                                        forms.`program_id`= $program_id AND
                                        final_result.`section` = '$section' AND                                             
                                        final_result.`batch_id` = $batch_id AND
                                        final_result.`session_id` = $session_id AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        students.status = 'ok'
                                           
                                        

                                        GROUP BY students.roll_no 
                                        ORDER BY students.roll_no ASC, courses.course_id ASC");
        //                                        GROUP BY final_result.`course_id`,final_result.`course_id`,mid_result.`course_id` 
//                                        ORDER BY courses.course_id ASC");
        
       // echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    
    
    function SingleSubjectMarks_cr_Jal($program_id,$section,$batch_id,$session_id, $student_id, $course_id){
       
//        $query      =   $this->db->query("SELECT students.enrolled_session_id,students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
//                                        (mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3+final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained,
//                                        mid_result.`course_id`  AS mid_course,sessions.session,
//                                        final_result.session_id, courses.`course_name`,courses.credit_hours,programs.`program_name`,campaign.`campaign_name`,campus.`campus_name` ,batch.*
//                                        FROM students
//                                        
//                                        INNER JOIN forms ON forms.form_id =students.form_id
//                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
//                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
//                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
//                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
//                                        INNER JOIN courses ON courses.course_id = final_result.course_id
//                                        INNER JOIN sessions ON sessions.session_id = final_result.session_id
//                                        INNER JOIN programs ON programs.program_id = forms.program_id
//                                        INNER JOIN batch ON batch.batch_id = students.batch_id
//
//                                        WHERE 
//                                        students.student_id = $student_id AND 
//                                        final_result.course_id = $course_id AND
//                                        forms.`program_id`= $program_id AND
//                                        final_result.`section` = '$section' AND                                             
//                                        final_result.`batch_id` = $batch_id AND
//                                        final_result.`session_id` = $session_id AND
//                                        mid_result.`course_id` = final_result.`course_id` AND
//                                        students.status = 'ok'
//                                           
//                                        
//
//                                        GROUP BY students.roll_no 
//                                        ORDER BY students.roll_no ASC");
        $query      =   $this->db->query("SELECT (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.`final_value_1`+f.`final_value_2`+f.`final_value_3`+f.`final_value_4`+f.`final_value_5`+f.`final_value_6`+f.`final_value_7`) AS obtained,
                                                    courses.credit_hours
                                                    FROM mid_result AS m
                                                    INNER JOIN final_result AS f ON f.student_id = m.student_id
                                                    INNER JOIN courses ON courses.`course_id` = f.course_id
                                                    WHERE

                                                    m.student_id = $student_id AND 
                                                    m.course_id = $course_id AND 
                                                    m.`program_id`= $program_id AND 
                                                    m.`section` = '$section' AND 
                                                    m.`batch_id` = $batch_id AND 
                                                    m.`session_id` = $session_id AND
                                                    m.course_id = f.course_id");
        
        //echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function getAttendanceInfo($campaign_id,$program_id){
        $query  =   $this->db->query("SELECT forms.`student_name`, students.`roll_no`,programs.`program_name`, batch.`batch`,batch.`batch_type`,students.`shift`
                                    FROM forms 
                                    INNER JOIN students ON forms.`form_id` = students.`form_id`
                                    INNER JOIN programs ON programs.`program_id` = forms.`program_id`
                                    INNER JOIN batch ON batch.`batch_id` = students.`batch_id`

                                    WHERE

                                    forms.`program_id` = $program_id AND
                                    forms.`campaign_id` = $campaign_id AND
                                    students.roll_no    != '' AND
                                    students.`status` = 'ok'
                                    ORDER BY students.roll_no ASC ");
        
        return $query->result_array();
    }
    
   
    function getMidTotal($program_id,$course_id){
        
        $query      =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid_total FROM mid_course_structure WHERE program_id = $program_id AND course_id = $course_id ");
        $result     =   $query->row();
        return      $result->mid_total;
    }
    
    
    function getMidTotal_cr($program_id,$course_id,$section,$batch_id,$session_id){
        
        $query      =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid_total FROM mid_course_structure WHERE program_id = $program_id AND course_id = $course_id AND section = '$section' AND batch_id = $batch_id AND session_id = $session_id ");
        $result     =   $query->row();
        return      $result->mid_total;
    }
  
    
    
    
    
    function calculateGpa($total,$credit_hours){
        
         
        if($total < 50){ $gpa = 0;}
        if($total ==50){ $gpa = 1;}
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
        
        $res    =   $gpa * $credit_hours;
        return $res;
        
    }
    
    function getLastGpa($student_id,$gpa,$credit_hours){

        $query  =   $this->db->query("select total_gpa,credit_hours from std_sem_gpa where student_id = $student_id");
        $result =   $query->result_array();
       $total_gpa=0;
       $credit_hours=0;
        foreach ($result As $row){
            $total_gpa    =   $total_gpa + $row['total_gpa'];
            $credit_hours    =   $credit_hours + $row['credit_hours'];
        }
        
        return     $total_gpa/$credit_hours;
        
    }  
    
    
    
    //*********************      RESULT REPORTS FOR CR STDUENTS    START        *******************************************//
    
    function getStdInfo($roll_no){
        $this->db->select('std.student_id,std.roll_no,std.batch_id,f.program_id,f.student_name,f.father_name,p.program_name,b.*');
        $this->db->from('students std');
        $this->db->join('forms f','std.form_id = f.form_id','inner');
        $this->db->join('programs p','f.program_id = p.program_id','inner');
        $this->db->join('batch b','b.batch_id = std.batch_id','inner');
        $this->db->where('std.roll_no',$roll_no);
        $query  =   $this->db->get();
        return      $query->row();
    }
    
    function getSessions($student_id)
      {
          $this->db->select('mid.session_id,sessions.session');
          $this->db->from('mid_result mid');
          $this->db->join('sessions','sessions.session_id = mid.session_id','inner');
          $this->db->where('mid.student_id',$student_id);
          $this->db->group_by('mid.session_id');
          $query = $this->db->get();
          return $query->result_array();
          
      }
    
      
       function getStudentResult($student_id,$session_id)
      {
          $this->db->select('sessions.session, courses.course_name,mid.student_id, courses.course_id ,courses.credit_hours');
          $this->db->from('mid_result mid');
          $this->db->join('final_result final','mid.student_id = final.student_id','inner');
          $this->db->join('sessions','sessions.session_id = mid.session_id','inner');
          $this->db->join('courses','courses.course_id = mid.course_id','inner');
          $this->db->where('mid.student_id',$student_id);
          $this->db->where('mid.session_id',$session_id);
          $this->db->group_by('mid.course_id');          
          $query = $this->db->get();
        //  echo $this->db->last_query();die;
          return $query->result_array();
          
      }
      
      //single student rest
    public function mid_result($student_id , $session_id,$course_id,$batch_id){
        $data = $this->db->query("SELECT *,(mid_value_1+ mid_value_2 + mid_value_3) AS midd,session_id
                                        FROM 
                                        mid_result 
                                        WHERE 
                                        student_id = $student_id AND 
                                        course_id = $course_id AND
                                        batch_id = $batch_id AND
                                        session_id = $session_id" );
        //echo $this->db->last_query();
        return $data->result_array();
    }
      //single student rest
    public function mid_result_pass($student_id ,$course_id,$batch_id){
        $data = $this->db->query("SELECT (mid_value_1+ mid_value_2 + mid_value_3) AS midd,session_id FROM mid_result 
                                            WHERE 
                                            student_id = $student_id 
                                            AND course_id = $course_id 
                                            AND batch_id = $batch_id 
                                            ORDER BY midd DESC
                                            LIMIT 1" );
      //  echo $this->db->last_query();die;
        return $data->result_array();
    }
    
      //single student rest
    public function final_result($student_id , $session_id,$course_id,$batch_id  ){
        $data = $this->db->query("SELECT  (final_value_1+ final_value_2 + final_value_3 + final_value_4 + final_value_5 + final_value_6 + final_value_7) AS final, courses.credit_hours                                             
                                     FROM final_result
                                     inner join courses ON courses.course_id = final_result.course_id
                                     WHERE
                                     final_result.student_id = $student_id AND
                                     final_result.course_id = $course_id AND 
                                     final_result.batch_id = $batch_id AND
                                     final_result.session_id = $session_id" );
       // echo $this->db->last_query();die;
        return $data->result_array();
    }
    
      //single student rest
    public function final_result_pass($student_id ,$course_id,$batch_id){
        $data = $this->db->query("SELECT (final_value_1+ final_value_2 + final_value_3 + final_value_4 + final_value_5 + final_value_6 + final_value_7) AS final, 
                                    courses.credit_hours 
                                    FROM 
                                    final_result 
                                    INNER JOIN courses ON courses.course_id = final_result.course_id 
                                    WHERE 
                                    final_result.student_id = $student_id AND 
                                    final_result.batch_id = $batch_id AND
                                    final_result.course_id = $course_id
                                    ORDER BY
                                    final DESC
                                    LIMIT 1" );
       //echo $this->db->last_query();die;
        return $data->result_array();
    }
    
    public function getLabMarks( $student_id , $batch_id,$course_id  ,$session_id){
        
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        
        //echo '<pre>';var_dump($result[0]["course_id"]);echo '</pre>';
        
        $course_idl = $result[0]["course_id"];
        //echo $course_idl;
        //die;
        if(!empty($course_idl)){
            $data1 = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl AND session_id = $session_id" );
            return $data1->result_array();
        }else{
            return null;
        }
        
   }
   
    public function getLabMarksStructure($program_id , $batch_id,$course_id  ,$session_id, $section){
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        
        if(!empty($course_idl)){
            //echo "SELECT  final_value_1 FROM final_course_structure WHERE program_id = $program_id AND course_id = $course_idl AND session_id = $session_id and batch_id = $batch_id and teacher_id != ''";
            $data = $this->db->query("SELECT  final_value_1 FROM final_course_structure WHERE program_id = $program_id AND course_id = $course_idl AND session_id = $session_id and batch_id = $batch_id and teacher_id != '' and section = '$section'" );
            $result = $data->row();
            return $result->final_value_1;
        }else{
            return null;
        }
   }
   
    public function getLabMarks_pass( $student_id , $batch_id,$course_id){
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        
        if(!empty($course_idl)){
            $data = $this->db->query("SELECT final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl ORDER BY final_value_1 DESC LIMIT 1" );
//          echo $this->db->last_query();die;
            return $data->result_array();
        }else{
            return null;
        }
        
   }
   
     function getGpa($total,$credit_hours){
          
          if($total < 50){ $gpa = 0;}
          else if($total == 50){ $gpa = 1.0;}
          else if($total == 51){ $gpa = 1.1;}
          else if($total == 52){ $gpa = 1.2;}
          else if($total == 53){ $gpa = 1.3;}
          else if($total == 54){ $gpa = 1.4;}
          else if($total == 55){ $gpa = 1.5;}
          else if($total == 56){ $gpa = 1.6;}
          else if($total == 57){ $gpa = 1.7;}
          else if($total == 58){ $gpa = 1.8;}
          else if($total == 59){ $gpa = 1.9;}
          else if($total == 60){ $gpa = 2.0;}
          else if($total == 61){ $gpa = 2.1;}
          else if($total == 62){ $gpa = 2.2;}
          else if($total == 63){ $gpa = 2.3;}
          else if($total == 64){ $gpa = 2.4;}
          else if($total == 65){ $gpa = 2.5;}
          else if($total == 66){ $gpa = 2.6;}
          else if($total == 67){ $gpa = 2.7;}
          else if($total == 68){ $gpa = 2.8;}
          else if($total == 69){ $gpa = 2.9;}
          else if($total == 70){ $gpa = 3.0;}
          else if($total == 71){ $gpa = 3.1;}
          else if($total == 72){ $gpa = 3.2;}
          else if($total == 73){ $gpa = 3.3;}
          else if($total == 74){ $gpa = 3.4;}
          else if($total == 75){ $gpa = 3.5;}
          else if($total == 76){ $gpa = 3.6;}
          else if($total == 77){ $gpa = 3.7;}
          else if($total == 78){ $gpa = 3.8;}
          else if($total == 79){ $gpa = 3.9;}
          else if($total >= 80){ $gpa = 4.0;}
          
          $res  =   $gpa * $credit_hours;
          return $res ;
          
      }
      
      
      
    //*********************      RESULT REPORTS FOR CR STDUENTS    END        *******************************************//
      
      
      // *************** student gpa calculation ***************//
      
        function getStudents($campaign_id,$program_id,$semester){
        $query      =   $this->db->query("SELECT student_id FROM final_result 
                                            where 
                                            semester = $semester and
                                            campaign_id = $campaign_id and
                                            program_id  = $program_id
                                            GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
//        echo $this->db->last_query();die;
        return      $query->result_array();
    } 
    
   
    function getFinalMarks($student_id,$semester){
        
       // echo $student_id;die;
         $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1,
                                        mid_result.`course_id`  AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2,
                                        final_result.semester, coursess.`course_name`,coursess.credit_hours,programs.`program_name`,campus.`campus_name`,campus.`campus_code`,batch.*

                                        FROM students
                                        
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN coursess ON coursess.course_id = final_result.course_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN batch ON batch.batch_id = students.batch_id

                                        WHERE 

                                                                               
                                        mid_result.`semester` = $semester AND
                                        mid_result.`course_id` = final_result.`course_id` AND
                                        final_result.`semester` = $semester AND
                                        students.`student_id` = $student_id

                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id`");   
         
//         echo $this->db->last_query();die;
         return      $query->result_array();
    }
    
    function checkgpa($student_id,$semester){
        $query = $this->db->query("select * from std_sem_gpa where student_id = $student_id and semester = $semester"); 		
        return $query->row();
    }
    
    
    function SaveStdgpa($student_id,$gpa,$semester,$total_gpa,$credit_hours){
        $query = $this->db->insert('std_sem_gpa', array('semester'=>$semester,'gpa'=>$gpa, 'student_id'=>$student_id, 'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 		
        return $this->db->insert_id();
    }
    
    function UpdateStdgpa($student_id,$gpa,$semester,$total_gpa,$credit_hours){
        //$this->db->query("update std_sem_gpa set gpa = $gpa, total_gpa = $total_gpa, credit_hours=$credit_hour where student_id = $student_id and semester = $semester");
        $this->db->where(array('student_id'=> $student_id,'semester'=>$semester));
        $this->db->update('std_sem_gpa', array('gpa'=>$gpa, 'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 
        return $this->db->affected_rows();  
    }
    
    function getFailureSubjects($student_id,$semester){
        
        $query  =   $this->db->query("SELECT (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7)
                                        AS marks,m.student_id,m.course_id,coursess.`course_name`
                                        FROM mid_result AS m
                                        INNER JOIN final_result AS f ON f.student_id = m.student_id
                                        INNER JOIN coursess ON coursess.`course_id` = f.`course_id`
                                        WHERE
                                        m.student_id = $student_id
                                        AND
                                        m.student_id = f.student_id
                                        AND 
                                        m.course_id = f.course_id
                                        AND
                                        f.semester  = $semester 
                                        AND
                                        m.semester  = $semester
                                        AND
                                        (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7) < 50
                                        ORDER BY course_id ASC
                                    ");
      //      echo $this->db->last_query();die;
      return $query->result_array();
        
    }
    
    
    function getFailSubjects($student_id,$semester){
        
        $query  =   $this->db->query("SELECT (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7)
                                        AS marks,m.student_id,m.course_id
                                        FROM mid_result AS m
                                        INNER JOIN final_result AS f ON f.student_id = m.student_id
                                        WHERE
                                        m.student_id = $student_id
                                        AND
                                        m.student_id = f.student_id
                                        AND 
                                        m.course_id = f.course_id
                                        AND
                                        f.semester <= $semester
                                        AND
                                        (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7) < 50
                                        ORDER BY course_id ASC
                                    ");
      return $query->num_rows();
        
    }
    
    function getFailSubjectsCR($student_id,$batch_id,$session_id){
        
        $query  =   $this->db->query("SELECT (m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7)
                                        AS marks,m.student_id,m.course_id
                                        FROM mid_result AS m
                                        INNER JOIN final_result AS f ON f.student_id = m.student_id
                                        WHERE
                                        m.student_id = $student_id
                                        AND
                                        f.student_id = $student_id
                                        AND
                                        m.student_id = f.student_id
                                        AND 
                                        m.course_id = f.course_id 
                                        AND
                                        f.session_id <= $session_id
                                        AND
                                        f.batch_id  = $batch_id
                                        AND
                                        m.batch_id  =   $batch_id
                                            
                                        Group By course_id
                                        ORDER BY course_id ASC
                                        
                                    ");
      //echo $this->db->last_query();die;
      $result   =   $query->result_array();      
      foreach($result AS $row){
            $marks      =   $row['marks'];            
            $course_id  =   $row['course_id'];            
          
            $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
//               echo $this->db->last_query();die;
            $result     = $data->result_array();
            $course_idl = $result[0]['course_id'];
            
             if(!empty($course_idl)){
                $data = $this->db->query("SELECT final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl ORDER BY final_value_1 DESC LIMIT 1" );                   
                $res    =   $data->row();                
                $total_marks = $res->final_value_1 + $marks;
                if($total_marks < 50) {
                    $array[]= array(
                                        'marks'  =>   $total_marks,  
                                        'course_id'  =>  $course_id,  
                                        'student_id'  =>   $student_id
                                    ); 
                    
             }}else{
                    if($marks < 50){
                                    $array[]= array(
                                        'marks'  =>   $marks,  
                                        'course_id'  =>  $course_id,  
                                        'student_id'  =>   $student_id
                                    );
                    }
                }
      }
//      echo '<pre>'; print_r($array);die;
      return count($array);
        
    }
    
    //************** Signle student result edit
    
    function getSessionResult($roll_no,$session_id,$type){

        if($type == 1){
                        $query      =   $this->db->query("SELECT c.*,s.roll_no,m.*,ses.session
                                                            FROM mid_result AS m
                                                                INNER JOIN courses AS c ON m.`course_id` = c.`course_id`
                                                                INNER JOIN students AS s ON s.`student_id` = m.`student_id`
                                                                INNER JOIN sessions AS ses ON ses.`session_id` = m.`session_id`                                                                
                                                            WHERE
                                                                s.`roll_no` = '$roll_no' AND
                                                                m.`session_id` = $session_id");
        }elseif ($type == 2) {
            
                        $query      =   $this->db->query("SELECT c.*,s.roll_no,f.*,ses.session
                                                            FROM final_result AS f
                                                                INNER JOIN courses AS c ON f.`course_id` = c.`course_id`
                                                                INNER JOIN students AS s ON s.`student_id` = f.`student_id`
                                                                INNER JOIN sessions AS ses ON ses.`session_id` = f.`session_id`
                                                            WHERE
                                                                s.`roll_no` = '$roll_no' AND
                                                                f.`session_id` = $session_id");
        }
        //echo $this->db->last_query();die;
        return      $query->result_array();
    }
    
    function getSessionResult_semester($roll_no,$semester,$campaign_id,$type){

        if($type == 1){
                        $query      =   $this->db->query("SELECT c.*,s.roll_no,m.*
                                                            FROM mid_result AS m
                                                                INNER JOIN coursess AS c ON m.`course_id` = c.`course_id`
                                                                INNER JOIN students AS s ON s.`student_id` = m.`student_id`                                                                
                                                            WHERE
                                                                m.campaign_id   =   $campaign_id AND
                                                                s.`roll_no` = '$roll_no' AND
                                                                m.`semester` = $semester");
        }elseif ($type == 2) {
            
                        $query      =   $this->db->query("SELECT c.*,s.roll_no,f.*
                                                            FROM final_result AS f
                                                                INNER JOIN coursess AS c ON f.`course_id` = c.`course_id`
                                                                INNER JOIN students AS s ON s.`student_id` = f.`student_id`
                                                            WHERE
                                                                f.campaign_id   =   $campaign_id AND
                                                                s.`roll_no` = '$roll_no' AND
                                                                f.`semester` = $semester");
        }
       // echo $this->db->last_query();die;
        return      $query->result_array();
    }
    
    function MidStruc($program_id,$course_id,$section,$batch_id,$session_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        mid_course_structure 
                                        WHERE 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = $batch_id AND 
                                        session_id = $session_id
                                  ");
        return $query->row();
        
    }
   
    function MidRes($program_id,$course_id,$section,$batch_id,$session_id,$student_id)
    {
        $query = $this->db->query("SELECT m.*,s.roll_no,f.student_name FROM 
                                        mid_result AS m
                                        inner join students  AS s on s.student_id = m.student_id
                                        inner join forms  AS f on f.form_id = s.form_id
                                        WHERE 
                                        m.program_id = $program_id AND 
                                        m.course_id = $course_id AND 
                                        m.section = '$section' AND 
                                        m.batch_id = $batch_id AND 
                                        m.session_id = $session_id AND
                                        m.student_id = $student_id
                                  ");
       // echo $this->db->last_query();die
        return $query->row();
        
    }
    function MidStruc_semester($program_id,$course_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        mid_course_structure 
                                        WHERE 
                                        program_id = $program_id AND 
                                        course_id = $course_id 
                                  ");
        return $query->row();
        
    }
   
    function MidRes_semester($program_id,$course_id,$semester,$student_id,$campaign_id)
    {
        $query = $this->db->query("SELECT m.*,s.roll_no,f.student_name FROM 
                                        mid_result AS m
                                        inner join students  AS s on s.student_id = m.student_id
                                        inner join forms  AS f on f.form_id = s.form_id
                                        WHERE 
                                        m.program_id = $program_id AND 
                                        m.course_id = $course_id AND 
                                        m.semester = '$semester' AND
                                        m.student_id = $student_id AND
                                        m.campaign_id = $campaign_id
                                  ");
       // echo $this->db->last_query();die
        return $query->row();
        
    }
    function FinalStruc($program_id,$course_id,$section,$batch_id,$session_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        final_course_structure 
                                        WHERE 
                                        program_id = $program_id AND 
                                        course_id = $course_id AND 
                                        section = '$section' AND 
                                        batch_id = $batch_id AND 
                                        session_id = $session_id
                                  ");
        return $query->row();
        
    }
   
    function FinalRes($program_id,$course_id,$section,$batch_id,$session_id,$student_id)
    {
        $query = $this->db->query("SELECT fr.*,s.roll_no,f.student_name FROM 
                                        final_result AS fr
                                        inner join students  AS s on s.student_id = fr.student_id
                                        inner join forms  AS f on f.form_id = s.form_id
                                        WHERE 
                                        fr.program_id = $program_id AND 
                                        fr.course_id = $course_id AND 
                                        fr.section = '$section' AND 
                                        fr.batch_id = $batch_id AND 
                                        fr.session_id = $session_id AND
                                        fr.student_id = $student_id
                                  ");
       // echo $this->db->last_query();die
        return $query->row();
        
    }
    function FinalStruc_semester($program_id,$course_id)
    {
        $query = $this->db->query("SELECT * FROM 
                                        final_course_structure 
                                        WHERE 
                                        program_id = $program_id AND 
                                        course_id = $course_id
                                  ");
        return $query->row();
        
    }
   
    function FinalRes_semester($program_id,$course_id,$semester,$student_id,$campaign_id)
    {
        $query = $this->db->query("SELECT fr.*,s.roll_no,f.student_name FROM 
                                        final_result AS fr
                                        inner join students  AS s on s.student_id = fr.student_id
                                        inner join forms  AS f on f.form_id = s.form_id
                                        WHERE 
                                        fr.program_id = $program_id AND 
                                        fr.course_id = $course_id AND 
                                        fr.semester = '$semester' AND
                                        fr.student_id = $student_id AND
                                        fr.campaign_id = $campaign_id
                                  ");
       // echo $this->db->last_query();die
        return $query->row();
        
    }
    
    function UpdateMidRes($mid_result,$student_id,$mid_result_id){
         $this->db->where('mid_result_id', $mid_result_id);
         $this->db->where('student_id', $student_id);
        $this->db->update('mid_result', $mid_result); 
        return $this->db->affected_rows();    
    }
    
    
    function UpdateFinalRes($final_result,$student_id,$final_result_id){
         $this->db->where('final_result_id', $final_result_id);
         $this->db->where('student_id', $student_id);
        $this->db->update('final_result', $final_result); 
        return $this->db->affected_rows();    
    }


    // *************** student gpa calculation ***************//
     
    
    function getTopperStudents($campaign_id,$program_id,$semester){
        $query      =   $this->db->query("select final_result.semester,final_result.student_id,students.roll_no,students.status,forms.student_name,programs.program_name from final_result
                                            inner join students ON students.student_id = final_result.student_id
                                            inner join forms ON students.form_id = forms.form_id
                                            inner join programs ON programs.program_id = forms.program_id
                                            where final_result.campaign_id = $campaign_id and final_result.program_id = $program_id and final_result.semester = $semester and students.status = 'ok'
                                            GROUP BY final_result.student_id
                                            order by final_result.program_id asc
                                        ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    function getTopperStudents_cr($program_id,$section,$batch_id,$session_id){
        $query      =   $this->db->query("select batch.*,final_result.session_id,final_result.student_id,students.roll_no,students.status,forms.student_name,programs.program_name,sessions.session from final_result
                                            inner join students ON students.student_id = final_result.student_id
                                            inner join forms ON students.form_id = forms.form_id
                                            inner join programs ON programs.program_id = forms.program_id
                                            inner join sessions ON sessions.session_id = final_result.session_id
                                            inner join batch ON batch.batch_id = students.batch_id
                                            where 
                                            final_result.program_id = $program_id
                                            and final_result.section = '$section'
                                            and final_result.session_id = $session_id
                                            and final_result.batch_id = $batch_id 
                                            and students.status = 'ok'
                                            GROUP BY final_result.student_id
                                            order by final_result.program_id asc
                                        ");
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    function getStdGpa($student_id,$semester){
        $query      =   $this->db->query("select programs.program_name,students.student_id,students.roll_no,forms.student_name,std_sem_gpa.gpa from std_sem_gpa
                                            inner join students on students.student_id = std_sem_gpa.student_id
                                            inner join forms on students.form_id = forms.form_id
                                            inner join programs on programs.program_id = forms.program_id
                                            where std_sem_gpa.student_id = $student_id and std_sem_gpa.semester = $semester
                                        ");
        return $query->row();
        
    }
    
    function getStdGpa_cr($student_id,$session_id){
        $query      =   $this->db->query("select programs.program_name,students.student_id,students.roll_no,forms.student_name,std_sem_gpa.gpa from std_sem_gpa
                                            inner join students on students.student_id = std_sem_gpa.student_id
                                            inner join forms on students.form_id = forms.form_id
                                            inner join programs on programs.program_id = forms.program_id
                                            where std_sem_gpa.student_id = $student_id and std_sem_gpa.session_id = $session_id
                                        ");
        return $query->row();
        
    }
    
    function getTotalMarks($student_id,$semester){
         $query      =   $this->db->query("SELECT f.course_id,(m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7)
                                            AS marks
                                            FROM final_result AS f
                                            INNER JOIN mid_result AS m ON m.`student_id` = f.`student_id`
                                            WHERE
                                            f.`student_id` = $student_id AND 
                                            f.`semester` = $semester AND
                                            m.`course_id` = f.`course_id`
                                        ");
        return $query->result_array();
    }
    
    function getTotalMarks_cr($student_id,$session_id,$batch_id){
         $query      =   $this->db->query("SELECT f.course_id,(m.mid_value_1+m.mid_value_2+m.mid_value_3+f.final_value_1+f.final_value_2+f.final_value_3+f.final_value_4+f.final_value_5+f.final_value_6+f.final_value_7)
                                            AS marks
                                            FROM final_result AS f
                                            INNER JOIN mid_result AS m ON m.`student_id` = f.`student_id`
                                            WHERE
                                            f.`student_id` = $student_id AND 
                                            f.`session_id` = $session_id AND
                                            f.`batch_id`   = $batch_id AND
                                            m.`course_id` = f.`course_id`
                                        ");
        return $query->result_array();
    }
    
    function getTotalMarks_crLab($student_id,$session_id,$batch_id){
         $query      =   $this->db->query("SELECT f.course_id,(f.final_value_1)
                                            AS labmarks
                                            FROM final_result AS f
                                            INNER JOIN courses AS c ON c.`course_id` = f.`course_id`
                                            WHERE
                                            f.`student_id` = $student_id AND 
                                            f.`session_id` = $session_id AND
                                            f.`batch_id`   = $batch_id AND
                                            c.`course_type` = 'Lab'
                                        ");
        // echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
    function getCGPA($student_id,$semester){
        
        $query  =   $this->db->query("SELECT final_result.course_id,coursess.credit_hours FROM final_result
                                        INNER JOIN coursess ON coursess.`course_id` = final_result.`course_id`
                                        WHERE
                                        final_result.`student_id` = $student_id AND
                                        final_result.`semester` <= $semester  
                                        ORDER BY
                                        final_result.course_id
                                    ");
        
        $courses    =   $query->result_array();
       
        $total_gpa              =   0 ;
        $total_crdt_hrs         =   0 ;
        
        foreach($courses AS $row){
            
                   $course_id       =   $row['course_id'];
                   $credit_hrs      =   $row['credit_hours'];
                   
                   // get mid marks
                   $q1          =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid   FROM    mid_result WHERE  student_id = $student_id AND course_id = $course_id ");              
                   $res1        =   $q1->row();
                   $mid         =   $res1->mid;
                   
                   // get final marks
                   $q2          =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final FROM  final_result    WHERE  student_id = $student_id AND course_id = $course_id");              
                   $res2        =   $q2->row();
                   $final       =   $res2->final;
                   
                   $total       =   $mid+$final;
                    
                    $gpa            =   $this->getGpa($total, $credit_hrs);
                    
                    $total_gpa      =   $total_gpa + $gpa;
                    $total_crdt_hrs =   $total_crdt_hrs + $credit_hrs;                  
        }
        
        return         $total_gpa/$total_crdt_hrs;
                
    }
    
    
    function getCGPA_Topper($student_id,$semester,$roll_no,$student_name){
        
        $query  =   $this->db->query("SELECT final_result.course_id,coursess.credit_hours FROM final_result
                                        INNER JOIN coursess ON coursess.`course_id` = final_result.`course_id`
                                        WHERE
                                        final_result.`student_id` = $student_id AND
                                        final_result.`semester` = $semester  
                                        ORDER BY
                                        final_result.course_id
                                    ");
        
        $courses    =   $query->result_array();
       
//        echo '<pre>'; print_r($courses);die;
        
        $total_gpa              =   0 ;
        $total_crdt_hrs         =   0 ;
        $total_obt              =   0;
        $total_marks            =   0;
        
        foreach($courses AS $row){
            
                   $course_id       =   $row['course_id'];
                   $credit_hrs      =   $row['credit_hours'];
                   
                   // get mid marks
                   $q1          =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid   FROM    mid_result WHERE  student_id = $student_id AND course_id = $course_id ");              
                   $res1        =   $q1->row();
                   $mid         =   $res1->mid;
                   
                   // get final marks
                   $q2          =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final FROM  final_result    WHERE  student_id = $student_id AND course_id = $course_id");              
                   $res2        =   $q2->row();
                   $final       =   $res2->final;
                   
                   $total       =   $mid+$final;
                    
                    $gpa            =   $this->getGpa($total, $credit_hrs);
                    
                    $total_gpa      =   $total_gpa + $gpa;
                    $total_crdt_hrs =   $total_crdt_hrs + $credit_hrs;         
                    $total_obt      =   $total_obt + $total;
                    $total_marks    =   $total_marks + 100;
        }
        
        $cgpa                       =   $total_gpa/$total_crdt_hrs;
        $array                      =   array('student_id' => $student_id, 'student_name' => $student_name , 'roll_no' => $roll_no, 'gpa' => $cgpa, 'total_obtained' => $total_obt, 'total_marks' => $total_marks);
        
        //echo '<pre>'; print_r($array);die;
        
        return         $array;
                
    }
    
    
    function getCGPA_cr($student_id,$session_id,$batch_id){
        
        $query  =   $this->db->query("SELECT final_result.course_id,courses.credit_hours FROM final_result
                                        INNER JOIN courses ON courses.`course_id` = final_result.`course_id`
                                        WHERE
                                        final_result.`student_id` = $student_id AND
                                        courses.`course_type` = 'Theory' AND
                                        final_result.`session_id` <= $session_id AND  
                                        final_result.`batch_id` = $batch_id  
                                        ORDER BY
                                        final_result.course_id
                                    ");
        
        $courses    =   $query->result_array();
               
     // echo $student_id.'<pre>';  print_r($courses);die;
        $total_gpa              =   0 ;
        $total_crdt_hrs         =   0 ;
        
        foreach($courses AS $row){
            
                   $course_id       =   $row['course_id'];
                   $credit_hrs      =   $row['credit_hours'];
                   
                   // get mid marks
                   $q1          =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid   FROM    mid_result WHERE    batch_id = $batch_id AND   student_id = $student_id AND course_id = $course_id ");              
                   $res1        =   $q1->row();
                   $mid         =   $res1->mid;
                   
                    
                   
                   // get final marks
                   $q2          =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final FROM  final_result    WHERE   batch_id = $batch_id AND   student_id = $student_id AND course_id = $course_id");              
                   $res2        =   $q2->row();
                   $final       =   $res2->final;
                   
                   // get lab marks 
                   $lab         =   $this->getLabMarks2( $student_id , $batch_id,$course_id);
                   
                   
                    if(count($lab) > 0){
                        $total      =   $mid+$final+$lab;
                        $credit_hrs =   $credit_hrs + 1;
                    }else{
                        $total      =   $mid+$final;
                    }
                    
                    
                    $gpa            =   $this->getGpa($total, $credit_hrs);
                    
                    $total_gpa      =   $total_gpa + $gpa;
                    $total_crdt_hrs =   $total_crdt_hrs + $credit_hrs;                  
        }
        
        return         $total_gpa/$total_crdt_hrs;
                
    }
    
    function getCGPA_Topper_cr($student_id,$session_id,$batch_id,$roll_no,$student_name){
        
        $query  =   $this->db->query("SELECT final_result.course_id,courses.credit_hours FROM final_result
                                        INNER JOIN courses ON courses.`course_id` = final_result.`course_id`
                                        WHERE
                                        final_result.`student_id` = $student_id AND
                                        courses.`course_type` = 'Theory' AND
                                        final_result.`session_id` = $session_id  AND
                                        final_result.`batch_id` = $batch_id  
                                        ORDER BY
                                        final_result.course_id
                                    ");
        
        $courses    =   $query->result_array();
        
        //echo '<pre>'; print_r($courses);die;
       
        $total_gpa              =   0 ;
        $total_crdt_hrs         =   0 ;
         $total_obt             =   0;
        $total_marks            =   0;
        
        foreach($courses AS $key=>$row){
            
                   $course_id       =   $row['course_id'];
                   $credit_hrs      =   $row['credit_hours'];
                   
                   // get mid marks
                   $q1          =   $this->db->query("SELECT (mid_value_1+mid_value_2+mid_value_3) AS mid   FROM    mid_result WHERE    batch_id = $batch_id AND   student_id = $student_id AND course_id = $course_id and session_id = $session_id ");              
                   $res1        =   $q1->row();
                   $mid         =   $res1->mid;
                 
                   // get final marks
                   $q2          =   $this->db->query("SELECT (final_value_1+final_value_2+final_value_3+final_value_4+final_value_5+final_value_6+final_value_7) AS final FROM  final_result    WHERE   batch_id = $batch_id AND   student_id = $student_id AND course_id = $course_id  and session_id = $session_id");              
                   $res2        =   $q2->row();
                   $final       =   $res2->final;
                    
                   // get lab marks 
                   $lab         =   $this->getLabMarks2_topper($student_id, $batch_id, $course_id, $session_id);
                   
                   
                    if(count($lab) > 0){
                        $total      =   $mid+$final+$lab;
                        $credit_hrs =   $credit_hrs + 1;
                    }else{
                        $total      =   $mid+$final;
                    }
                    
                    $gpa            =   $this->getGpa($total, $credit_hrs);
                    
                    $total_gpa      =   $total_gpa + $gpa;
                    $total_crdt_hrs =   $total_crdt_hrs + $credit_hrs;    
                    
                    $total_obt      =   $total_obt + $total;
                    $total_marks    =   $total_marks + 100;                   
        }
        
        $cgpa                       =   $total_gpa/$total_crdt_hrs;
        $array                      =   array('student_id' => $student_id, 'student_name' => $student_name , 'roll_no' => $roll_no, 'gpa' => $cgpa, 'total_obtained' => $total_obt, 'total_marks' => $total_marks);
        
        return         $array;
                
    }
    
    // for lab marks
    
     public function getLabMarks2( $student_id , $batch_id,$course_id){
        
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        
        //echo '<pre>';var_dump($result[0]["course_id"]);echo '</pre>';
        
        $course_idl = $result[0]["course_id"];
        //echo $course_idl;
        //die;
        if(!empty($course_idl)){
            $data1 = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl AND batch_id = $batch_id " );
            $result =    $data1->row();
            return $result->final_value_1;
        }else{
            return null;
        }
        
   }
    
    // for lab marks
    
     public function getLabMarks2_topper( $student_id , $batch_id,$course_id, $session_id){
        
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id" );
        $result     = $data->result_array();
        
        //echo '<pre>';var_dump($result[0]["course_id"]);echo '</pre>';
        
        $course_idl = $result[0]["course_id"];
        //echo $course_idl;
        //die;
        if(!empty($course_idl)){
            $data1 = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl AND batch_id = $batch_id and session_id = $session_id" );
            $result =    $data1->row();
            return $result->final_value_1;
        }else{
            return null;
        }
        
   }
   
   
   function AddVenue($venue){
       $query = $this->db->insert('datesheet_venues', $venue); 
        return $this->db->insert_id();
   }
   
   function CheckVenueCourse($data){
       $query = $this->db->get_where('datesheet_venue_courses', $data);
        return   $query->result_array();
   }
   
   function AddVenueCourses($courses){
       $query = $this->db->insert('datesheet_venue_courses', $courses); 
        return $this->db->insert_id();
   }

   
   function getAllVenues(){
       $query       =   $this->db->query("select dv.venue_id,dv.program_id,dv.venue,dv.semester,programs.program_name,campaign.campaign_name from datesheet_venues AS dv
                                          INNER JOIN programs ON programs.program_id = dv.program_id
                                          INNER JOIN campaign ON campaign.campaign_id = dv.campaign_id

                                        ");
       return           $query->result_array();
   }
   
   
   function getAllVenuesCR($section,$program_id,$session_id,$batch_id){
       $query       =   $this->db->query("SELECT dv.*,programs.program_name,sessions.session FROM datesheet_venues AS dv 
                                            INNER JOIN programs ON programs.program_id = dv.program_id 
                                            INNER JOIN sessions ON sessions.session_id = dv.session_id  
                                            WHERE
                                            dv.program_id   =   $program_id AND
                                            dv.session_id   =   $session_id AND
                                            dv.section      =   '$section' AND
                                            dv.batch_id     =   $batch_id
                                        ");
//       echo $this->db->last_query();die;
       return           $query->result_array();
   }
   
   
   function getRollNoSlipsInfo($campaign_id, $program_id, $semester){
       $query       =   $this->db->query("SELECT students.student_id,forms.`student_name`,forms.`father_name`,students.`roll_no`,programs.`program_name`,dv.venue,dv.venue_id,dv.semester,students.`status` 
                                            FROM forms

                                            INNER JOIN students ON students.`form_id` = forms.`form_id`
                                            INNER JOIN programs ON programs.`program_id` = forms.`program_id`
                                            INNER JOIN datesheet_venues AS dv ON dv.program_id = forms.`program_id`

                                            WHERE 
                                            
                                            forms.`campaign_id` = $campaign_id AND
                                            dv.program_id  = $program_id AND
                                            dv.semester    = $semester AND
                                            students.`roll_no` != '' AND 
                                            students.`status` = 'ok'
                                            ORDER BY students.roll_no ASC");
       
       return   $query->result_array();
   }
   
   
   function getDatesheetCourses($venue_id){
             $query       =   $this->db->query("SELECT coursess.`course_name`,dvc.* FROM coursess
                                                    INNER JOIN datesheet_venue_courses AS dvc ON dvc.course_id = coursess.`course_id`
                                                    WHERE
                                                    dvc.venue_id = $venue_id

                                                    ORDER BY dvc.date ASC");
       
       return   $query->result_array();
   }
   
   
   // for CR
   
   function checkVenue($venue)
    {
        $query = $this->db->get_where('datesheet_venues', $venue);
//        echo $this->db->last_query();die;
        return   $query->result_array();
    }
   
   
   function AddVenueCR($venue){
       $query = $this->db->insert('datesheet_venues', $venue); 
       //echo $this->db->last_query();die;
        return $this->db->insert_id();
   }
   
//   function getRollNoSlipsInfoCR($program_id, $section, $batch_id, $session_id){
//       $query       =   $this->db->query("SELECT students.student_id,dv.venue,dv.venue_id,student_sections.`roll_no`,forms.`student_name`, forms.`father_name`,sessions.`session`,programs.program_name
//                                            FROM 
//                                            datesheet_venues AS dv
//                                            INNER JOIN student_sections ON student_sections.`program_id` = dv.`program_id`
//                                            INNER JOIN forms ON forms.`program_id` = dv.`program_id`
//                                            INNER JOIN students ON students.`form_id` = forms.`form_id`
//                                            INNER JOIN sessions ON sessions.`session_id` = dv.`session_id`
//                                            INNER JOIN programs ON programs.`program_id` = dv.`program_id`
//                                            WHERE
//                                            dv.`section` = student_sections.`program_section`
//                                            AND
//                                            dv.`batch_id` = student_sections.`batch_id`
//                                            AND
//                                            student_sections.`student_id` = students.`student_id`
//                                            AND
//                                            students.`status` = 'ok'
//                                            AND
//                                            dv.`program_id` = $program_id AND
//                                            dv.`section` = '$section'   AND
//                                            dv.`session_id` = $session_id AND
//                                            dv.`batch_id`   = $batch_id                                             
//                                            ORDER BY students.roll_no ASC");
//       
//      // echo $this->db->last_query();die;
//       return   $query->result_array();
//   }
//   
   
   
     function getRollNoSlipsInfoCR($program_id, $section, $batch_id, $session_id){
       $query       =   $this->db->query("SELECT students.student_id,dv.venue,dv.venue_id,students.`roll_no`,forms.`student_name`, forms.`father_name`,sessions.`session`,programs.program_name
                                            FROM 
                                            datesheet_venues AS dv
                                            INNER JOIN student_course_sections ON student_course_sections.`program_id` = dv.`program_id`
                                            INNER JOIN forms ON forms.`program_id` = dv.`program_id`
                                            INNER JOIN students ON students.`form_id` = forms.`form_id`
                                            INNER JOIN sessions ON sessions.`session_id` = dv.`session_id`
                                            INNER JOIN programs ON programs.`program_id` = dv.`program_id`
                                            WHERE
                                            dv.`section` = student_course_sections.`course_section`
                                            AND
                                            dv.`batch_id` = student_course_sections.`batch_id`
                                            AND
                                            student_course_sections.`student_id` = students.`student_id`
                                            AND
                                            student_course_sections.`current_session_id` = dv.`session_id` 
                                            AND 
                                            students.`status` = 'ok'
                                            AND
                                            dv.`program_id` = $program_id AND
                                            dv.`section` = '$section'   AND
                                            dv.`session_id` = $session_id AND
                                            dv.`batch_id`   = $batch_id      
                                            GROUP BY
                                            students.`student_id`
                                            ORDER BY students.roll_no ASC");
       
//       echo $this->db->last_query();die;
       return   $query->result_array();
   }
   
   function getStudentCourses($venue_id,$student_id,$batch_id,$program_id,$session_id){
       
       $query       =   $this->db->query("SELECT dvc.day,dvc.date,dvc.time,courses.`course_name`,courses.`course_id` FROM `student_course_sections` AS scs
                                            INNER JOIN courses ON courses.`course_id` = scs.`course_id`
                                            INNER JOIN datesheet_venue_courses AS dvc ON dvc.`course_id` = courses.`course_id`
                                            WHERE
                                            dvc.venue_id 		= 	$venue_id AND
                                            scs.program_id 		= 	$program_id AND
                                            scs.batch_id   		= 	$batch_id AND
                                            scs.current_session_id	=	$session_id AND
                                            scs.student_id 		=	$student_id AND
                                            courses.`course_type`       =	'Theory'
                                            ORDER BY dvc.date ASC");
       
//       echo $this->db->last_query();die;
       return   $query->result_array();
   }
   
   function getProgCourses($program_id){
       $query   =   $this->db->query("SELECT * FROM coursess WHERE program_id = $program_id ORDER BY course_id ASC");
       return       $query->result_array();
   }

   
   
   function addLog($data){
       $query = $this->db->insert('datesheet_logs', $data); 
//       echo $this->db->last_query();die;
        return $this->db->insert_id();
   }

   
   
   // **** End Addded By Tariq For Examination ****  \\
}
