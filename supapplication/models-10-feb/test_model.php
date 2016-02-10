<?php
class Test_model extends CI_Model {
  
    
    function getCampus_os(){
        $query      =   $this->db->query("select campus_id from forms_os 
                                            where campaign_id = 3
                                            GROUP BY campus_id
                                            order by campus_id asc
                                        ");
        return $query->result_array();
    }
    
    function getPrograms_os($campus_id){
        $query      =   $this->db->query("select program_id from forms_os 
                                            where campaign_id = 3 and campus_id = $campus_id
                                            GROUP BY program_id
                                            order by program_id asc
                                        ");
        return $query->result_array();
    }
   
    function getStudents_os($program_id,$campus_id){
        $query      =   $this->db->query("SELECT student_id,roll_no FROM students_os AS students
                                            INNER JOIN forms_os AS forms ON forms.`form_id` = students.`form_id`
                                            WHERE roll_no != ''AND roll_no LIKE '%-%-%' AND forms.`program_id` = $program_id AND forms.campus_id = $campus_id AND forms.`campaign_id` = 3
                                            ORDER BY roll_no ASC
                                        ");
        return $query->result_array();
    }
    
    
    function updateSerial_os($student_id,$roll_no,$serial){
        $this->db->query("update students_os set serial = '$serial' where student_id = $student_id and roll_no = '$roll_no'");
        echo $this->db->last_query();die;
        return $this->db->affected_rows();
        
    }
    
    
    
//     function getPrograms(){
//        $query      =   $this->db->query("select program_id from forms 
//                                            where campaign_id = 3
//                                            GROUP BY program_id
//                                            order by program_id asc
//                                        ");
//        return $query->result_array();
//    }
    
    
    
//    function getStudents($program_id){
//        $query      =   $this->db->query("SELECT student_id,roll_no FROM students
//                                            INNER JOIN forms ON forms.`form_id` = students.`form_id`
//                                            WHERE roll_no != ''AND roll_no LIKE '%-%-%' AND forms.`program_id` = $program_id AND forms.`campaign_id` = 3
//                                            ORDER BY roll_no ASC
//                                        ");
//        return $query->result_array();
//    }
    
    function updateSerial($student_id,$roll_no,$serial){
        $this->db->query("update students set serial = '$serial' where student_id = $student_id and roll_no = '$roll_no'");
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
        
    }
    
    function getAllStudents(){
        $query      =   $this->db->query("SELECT students_os.* FROM students_os
                                            INNER JOIN forms_os ON forms_os.`form_id` = students_os.`form_id`
                                            WHERE
                                            forms_os.`campus_id` = 5 AND
                                            students_os.`roll_no` != ''"
                                        );
        return $query->result_array();
    }
    
    function updateStudents($student_id,$session_id){
        $query      =   $this->db->query("update students_os set roll_no = '', current_session_id = $session_id, semester = 0, operator_id = 0
                                            where
                                            student_id = $student_id
                                        ");
        return $this->db->affected_rows();
    }
    
    function delete_Accounts($student_id){
        
        $query1     =   $this->db->query("DELETE  FROM student_fee_package_os WHERE student_id = $student_id");
        $query2     =   $this->db->query("DELETE  FROM installments_os WHERE student_id = $student_id");
        $query3     =   $this->db->query("DELETE  FROM challan_os WHERE student_id = $student_id");
        
        return $query3;
    }






    // ****** For Inquiry   
    
    function getAllInquiries(){
        $this->db->select('*');
        $this->db->from('inquiry');
        $this->db->where('campus_id',15);
        $query =    $this->db->get();
        return $query->result_array();
    }
    
    function addInquiry($data){
        $query = $this->db->insert('inquiry_os', $data); 		
        return $this->db->insert_id();
    }
    
//// ****** For Prospectus
    
    function getAllProspectus(){
        $this->db->select('*');
        $this->db->from('prospectus');
        $this->db->where('campus_id',15);
        $query =    $this->db->get();
        return $query->result_array();
    }
    
    function getInquiryId($inquiry_id){
        $this->db->select('inquiry_id');
        $this->db->from('inquiry_os');
        $this->db->where('old_inquiry_id',$inquiry_id);
        $query  =   $this->db->get();
        $result =   $query->row();
        return $result->inquiry_id;
    }
    
    function addProspectus($data){
        $query = $this->db->insert('prospectus_os', $data); 		
        return $this->db->insert_id();
    }
    
//// ****** For Initial
    
    function getAllInitials(){
        $this->db->select('*');
        $this->db->from('initial_form');
        $this->db->where('campus_id',15);
        $query =    $this->db->get();
        return $query->result_array();
    }
    
    function addInitial($data){
        $query = $this->db->insert('initial_form_os', $data); 		
        return $this->db->insert_id();
    }
    
//// ****** For Forms
    
    function getAllForms(){
        $this->db->select('*');
        $this->db->from('forms');
        $this->db->where('campus_id',15);
        $query =    $this->db->get();
        return $query->result_array();
    }
    
    function addForm($data){
        $query = $this->db->insert('forms_os', $data); 		
        return $this->db->insert_id();
    }
    
//// ****** For Students
    
//    function getAllStudents(){
//        $this->db->select('students.*');
//        $this->db->from('students');
//        $this->db->join('forms','students.form_id = forms.form_id','inner');
//        $this->db->where('forms.campus_id',15);
//        $query =    $this->db->get();
//        return $query->result_array();
//    }
    
     function getFormId($form_no){
        $this->db->select('form_id');
        $this->db->from('forms_os');
        $this->db->where('form_no',$form_no);
        $query  =   $this->db->get();
        $result =   $query->row();
        return $result->form_id;
    }
    
    function addStudent($data){
        $query = $this->db->insert('students_os', $data); 		
        return $this->db->insert_id();
    }
    
    
//// ****** For packages
    
    function getAllPackages(){
        $query =    $this->db->query("select students.form_no,sfp.*
                                        From student_fee_package AS sfp
                                        INNER JOIN students ON students.`student_id` = sfp.student_id
                                        INNER join forms ON forms.`form_id` = students.`form_id`
                                        where
                                        forms.`campus_id` = 15");
        return $query->result_array();
    }
    
     function getStudentId($form_no){
        $this->db->select('student_id');
        $this->db->from('students_os');
        $this->db->where('form_no',$form_no);
        $query  =   $this->db->get();
       // echo $this->db->last_query();die;
        $result =   $query->row();
        return $result->student_id;
    }
    
    function addPackage($data){
        $query = $this->db->insert('student_fee_package_os', $data); 		
        return $this->db->insert_id();
    }

//// ****** For installments
    
    function getAllInstallments(){
        $query =    $this->db->query("SELECT students.`form_no`,installments.*
                                        FROM installments
                                        INNER JOIN students ON students.`student_id` = installments.student_id
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                        WHERE
                                        forms.`campus_id` = 15");
        return $query->result_array();
    }
    

    function addInstallments($data){
        $query = $this->db->insert('installments_os', $data); 		
        return $this->db->insert_id();
    }
    
    
//// ****** For challan
    
    function getChallan($installment_id){
        $query =    $this->db->query("SELECT challan.*
                                        FROM challan
                                        INNER JOIN students ON students.`student_id` = challan.student_id
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                        WHERE
                                        forms.`campus_id` = 15 AND
                                        challan.installment_id = $installment_id");
        return $query->row();
    }
    

    function addChallan($data){
        $query = $this->db->insert('challan_os', $data); 		
        return $this->db->insert_id();
    }
    
    
    
    function getStudentsPackag($campus_id){
        $query      =   $this->db->query("select students.`form_no`,students.`roll_no`,forms.campus_id,sfp.student_id,sfp.`admission_fee`,
                                            sfp.`session_fee`,sfp.`misc_fee`,sfp.`session_total_package`,sfp.`degree_total_package`  
                                            FROM student_fee_package_os AS sfp
                                            INNER JOIN students_os AS students ON students.`student_id` = sfp.student_id
                                            INNER JOIN forms_os AS forms ON forms.`form_id` = students.`form_id`
                                            WHERE
                                            forms.`campus_id` = $campus_id AND 
                                            students.`status` = 'ok' AND 
                                            students.`roll_no` != ''
                                            ");
        
        return $query->result_array();
    }

    function update_fees($student_id,$new_admission_fee,$new_misc_fee,$new_total_package){
        $query  =   $this->db->query("update student_fee_package_os set admission_fee = $new_admission_fee, misc_fee = $new_misc_fee, session_total_package = $new_total_package where student_id = $student_id");
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }   
 
    
    function getAllStd(){
        $query  =   $this->db->query("SELECT students.*
                                        FROM students
                                        INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                        WHERE 
                                        students.`roll_no` != '' AND students.`status` = 'ok' AND forms.`campaign_id` > 0");
        return $query->result_array();
    }
    
    function getSessionId($student_id){
        $query  =   $this->db->query("SELECT session_id FROM installments WHERE student_id = $student_id order by installment_id desc limit 1 ");
        $result =   $query->row();
        return $result->session_id;
    }
    
    function UpdateStdCurrentSession($student_id,$session_id){
        
         $query      =   $this->db->query("update students set current_session_id = $session_id
                                            where
                                            student_id = $student_id
                                        ");
        return $this->db->affected_rows();
        
    }
    
    
     function getStudents($semester){
        $query      =   $this->db->query("SELECT student_id FROM final_result where semester = $semester  GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
//        echo $this->db->last_query();die;
        return      $query->result_array();
    } 
    
     function getStudentsCR($session_id){
        $query      =   $this->db->query("SELECT student_id FROM final_result where section != '' and batch_id != '' and session_id = $session_id GROUP BY student_id ORDER BY `final_result`.`student_id` ASC");
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
    
    function getFinalMarksCR($student_id,$session_id){
        
       // echo $student_id;die;
         $query      =   $this->db->query("SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course,
                                        (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1,
                                        mid_result.`course_id`  AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2,
                                        final_result.session_id,final_result.course_id, courses.`course_name`,courses.credit_hours,programs.`program_name`,campus.`campus_name`,campus.`campus_code`,batch.*

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
                                        students.`student_id` = $student_id AND
                                        courses.course_type = 'Theory'

                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id`");   
         
        //echo $this->db->last_query();die;
         return      $query->result_array();
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
    
    function checkgpa($student_id,$semester){
        $query = $this->db->query("select * from std_sem_gpa where student_id = $student_id and semester = $semester"); 		
        return $query->row();
    }
    
    function checkgpaCR($student_id,$session_id){
        $query = $this->db->query("select * from std_sem_gpa where student_id = $student_id and session_id = $session_id"); 		
        return $query->row();
    }
    
    function SaveStdgpa($student_id,$gpa,$semester,$total_gpa,$credit_hours){
        $query = $this->db->insert('std_sem_gpa', array('semester'=>$semester,'gpa'=>$gpa, 'student_id'=>$student_id, 'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 		
        return $this->db->insert_id();
    }
    
    function SaveStdgpaCR($student_id,$gpa,$session_id,$total_gpa,$credit_hours){
        $query = $this->db->insert('std_sem_gpa', array('session_id'=>$session_id,'gpa'=>$gpa, 'student_id'=>$student_id,'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 		
        return $this->db->insert_id();
    }
    
    function UpdateStdgpa($student_id,$gpa,$semester,$total_gpa,$credit_hours){
        $this->db->where(array('student_id'=> $student_id,'semester'=>$semester));
        $this->db->update('std_sem_gpa', array('gpa'=>$gpa, 'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 
        return $this->db->affected_rows();  
    }
    
    function UpdateStdgpaCR($student_id,$gpa,$session_id,$total_gpa,$credit_hours){
        $this->db->where(array('student_id'=> $student_id,'session_id'=>$session_id));
        $this->db->update('std_sem_gpa', array('gpa'=>$gpa,'total_gpa'=>$total_gpa, 'credit_hours'=>$credit_hours)); 
        return $this->db->affected_rows();  
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
        
        $res    =   $gpa * $credit_hours;
        return $res;
        
    }
    
    
}