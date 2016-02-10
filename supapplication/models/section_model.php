<?php

class Section_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    
    
    function StudentInfo ($student_id){
        $query      = "
            SELECT * FROM `forms` 
            INNER JOIN students on forms.form_id =   students.form_id
            WHERE students.student_id = $student_id ";
            //AND students.roll_no = '$roll_no' ";
         
        $query_data = $this->db->query($query);
        return $val =  $query_data->result_array();
    }
    
    
    //function addStudentSection($program_id,$semeter_id,$student_id)
    function addStudentSection($data_array)
    {
        $query = $this->db->insert('student_sections', $data_array); 
        //echo $this->db->last_query().'<br/>';
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
    function getAllsections($program_id , $session_id , $batch)
    {
        //$query = $this->db->get_where('courses', $program_id);
        $query      = ""
                . "SELECT program_section "
                . "FROM student_sections "
                . "WHERE program_id='$program_id' "
                //. "and semester ='$semester' and session_id ='$session_id' "
                . " and batch_id ='$batch' "
                . "and session_id ='$session_id' "
                . "group by program_section";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    function getSectionStudent($session , $program , $section){
        
        $query      = ""
                . "SELECT *  "
                . "FROM student_sections  "
                . "INNER JOIN students ON students.student_id = student_sections.student_id "
                . "INNER JOIN forms ON forms.form_id = students.form_id "
                . "WHERE student_sections.program_id ='$program' AND  student_sections.session_id ='$session'  "
                . "AND  student_sections.program_section ='$section' ";
        
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
    // getting a single section
    function get_section_row($student_id)
    {
        $query   = "SELECT id , student_id , program_section FROM student_sections  WHERE student_id='$student_id'";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->num_rows(): null;
        //return $query_data->result_array();
    }
    
    
    //function addStudentSection($program_id,$semeter_id,$student_id)
    function addStudentCourseSection($data_array)
    {
        $query = $this->db->insert('student_course_sections', $data_array); 
        //echo $this->db->last_query().'<br/>';
        return $this->db->insert_id();
    }
    
    
    // teahers of a section
    
    function getTeacherBatchSection($batch_id,$program_id, $cur_session_id, $section){
        
//        
//        echo $query = "SELECT `hr_employee_record`.*, `student_course_sections`.`course_section` ,`courses`.course_name, `hr_designations`.*, `hr_departments`.`department_name`
//            FROM (`hr_employee_record`)
//            INNER JOIN `campus` ON `hr_employee_record`.`campus_id` = `campus`.`campus_id`
//            INNER JOIN `hr_departments` ON `hr_departments`.`department_id` =  `hr_employee_record`.`department_id`
//            INNER JOIN `hr_designations` ON `hr_designations`.`designation_id` =  `hr_employee_record`.`designation_id`
//            INNER JOIN `student_course_sections` ON `student_course_sections`.`teacher_id` 	 =  `hr_employee_record`.`emp_id`
//            INNER JOIN `courses` ON `courses`.`course_id` 	 =  `student_course_sections`.`course_id`
//            WHERE `hr_departments`.`account_role_id` =  '6'
//            AND `hr_employee_record`.`campus_id` =  '3'
//            AND `student_course_sections`.`current_session_id` =  '$cur_session_id'
//            AND `student_course_sections`.`program_id` =  '$program_id'
//            GROUP BY `course_id`";
        //AND `student_course_sections`.`course_section` =  '$section'
        
        echo $query = "SELECT course_section, student_course_sections.course_id, courses.course_name, hr_employee_record.employee_name
        FROM `student_course_sections`
        INNER JOIN courses ON courses.course_id = student_course_sections.course_id
        INNER JOIN hr_employee_record ON `hr_employee_record`.emp_id = student_course_sections.teacher_id
        WHERE 
        `student_course_sections`.`current_session_id` =  '$cur_session_id'
        AND `student_course_sections`.`program_id` =  '$program_id'
        AND `student_course_sections`.`batch_id` =  '$batch_id'
        
        GROUP BY student_course_sections.course_section, student_course_sections.teacher_id
        ORDER BY employee_name ASC";
        //GROUP BY student_course_sections.course_section
        $query_data = $this->db->query($query);
        
        return $query_data->result_array();
    }
    
    function TeacherBatchSection($batch_id,$program_id, $cur_session_id , $section){
        
//        
//        echo $query = "SELECT `hr_employee_record`.*, `student_course_sections`.`course_section` ,`courses`.course_name, `hr_designations`.*, `hr_departments`.`department_name`
//            FROM (`hr_employee_record`)
//            INNER JOIN `campus` ON `hr_employee_record`.`campus_id` = `campus`.`campus_id`
//            INNER JOIN `hr_departments` ON `hr_departments`.`department_id` =  `hr_employee_record`.`department_id`
//            INNER JOIN `hr_designations` ON `hr_designations`.`designation_id` =  `hr_employee_record`.`designation_id`
//            INNER JOIN `student_course_sections` ON `student_course_sections`.`teacher_id` 	 =  `hr_employee_record`.`emp_id`
//            INNER JOIN `courses` ON `courses`.`course_id` 	 =  `student_course_sections`.`course_id`
//            WHERE `hr_departments`.`account_role_id` =  '6'
//            AND `hr_employee_record`.`campus_id` =  '3'
//            AND `student_course_sections`.`current_session_id` =  '$cur_session_id'
//            AND `student_course_sections`.`program_id` =  '$program_id'
//            GROUP BY `course_id`";
        //AND `student_course_sections`.`course_section` =  '$section'
        
        $query = "SELECT course_section, student_course_sections.course_id, student_course_sections.teacher_id, courses.course_name, hr_employee_record.employee_name
        FROM `student_course_sections`
        INNER JOIN courses ON courses.course_id = student_course_sections.course_id
        INNER JOIN hr_employee_record ON `hr_employee_record`.emp_id = student_course_sections.teacher_id
        WHERE 
        `student_course_sections`.`current_session_id` =  '$cur_session_id'
        AND `student_course_sections`.`program_id` =  '$program_id'
        AND `student_course_sections`.`batch_id` =  '$batch_id'
        AND `student_course_sections`.`course_section` =  '$section'
        
        GROUP BY student_course_sections.course_id
        ORDER BY employee_name ASC";
        //GROUP BY student_course_sections.course_section
        $query_data = $this->db->query($query);
        
        return $query_data->result_array();
    }
    
    function get_all_section_students( $program_id , $cur_session_id , $section){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`, `students`.`roll_no` , `forms`.`email`   
        FROM (`forms`)
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        INNER JOIN `student_sections` ON `student_sections`.`student_id` = `students`.`student_id`
        WHERE `forms`.`program_id`                  = $program_id
        AND `student_sections`.`session_id`         = $cur_session_id
        
        AND `student_sections`.`program_section`    = '$section'
        GROUP BY form_id ORDER BY roll_no ASC";
        //AND `students`.`enrolled_session_id`        = $cur_session_id
        
        
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
    
    function get_batch_section_students( $program_id , $batch_id, $section){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`, `students`.`roll_no` , `forms`.`email`   
        FROM (`forms`)
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        INNER JOIN `student_sections` ON `student_sections`.`student_id` = `students`.`student_id`
        WHERE `forms`.`program_id`                  = $program_id
        AND `student_sections`.`batch_id`         = $batch_id
        AND `student_sections`.`program_section`    = '$section'
        GROUP BY form_id ORDER BY roll_no ASC";
        $query_data = $this->db->query($query);
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
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    
    function all_prog_stus( $program_id , $cur_session_id ){
        
        $query = 
        "SELECT `forms`.`student_name` , `forms`.`form_id` ,`forms`.`mobile` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`, `students`.`roll_no` , `forms`.`email`   
        FROM (`forms`)
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        WHERE `forms`.`program_id` = $program_id
        AND `students`.`current_session_id` = $cur_session_id
        AND `students`.`enrolled_session_id` = $cur_session_id
        AND `forms`.`campus_id` = 3
        AND `students`.`roll_no` != '' GROUP BY forms.form_id order by `students`.`roll_no` 
        ";
        //GROUP BY form_id";
       $query_data = $this->db->query($query);
       //echo $this->db->last_query();
       return $val =  $query_data->num_rows() > 0 ? $query_data->num_rows(): null;
       
        //return $query_data->num_rows();
    }
    
    function all_prog_stus_array( $program_id , $cur_session_id ){
        
        $query = 
        "SELECT `forms`.`student_name` ,students.student_id, `forms`.`form_id` ,`forms`.`mobile` , `forms`.`inquiry_id` , `students`.`student_id` , `students`.`current_session_id`, `students`.`roll_no` , `forms`.`email`   
        FROM (`forms`)
        INNER JOIN `students` ON `students`.`form_id` = `forms`.`form_id`
        WHERE `forms`.`program_id` = $program_id
        AND `students`.`current_session_id` = $cur_session_id
        AND `students`.`enrolled_session_id` = $cur_session_id
        AND `students`.`roll_no` != '' order by `students`.`roll_no` 
        ";
        //GROUP BY form_id";
        
       $query_data = $this->db->query($query);
       //echo $this->db->last_query();
       return $query_data->result_array();
       
    }
    
    function noOfSections($program_id , $session_id)
    {
        $query      = ""
                . "SELECT program_section "
                . "FROM student_sections "
                . "WHERE program_id='$program_id' "
                . "and session_id ='$session_id' "
                . "group by program_section";
        $query_data = $this->db->query($query);
        
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }
    
    function registeredCoursesOfStudents( $session_id , $program_id)
    {
        $query      = ""
                . "SELECT program_section "
                . "FROM student_sections "
                . "WHERE program_id='$program_id' "
                . "and session_id ='$session_id' "
                . "group by program_section";
        $query_data = $this->db->query($query);
        
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }

    /* added by zohaib*/
    /* prg result added by zohaib*/
    function getbatch_coursesresult( $batch_id,$program_id, $session, $section)
    {
         $query      = ""
                . "SELECT *  "
                . "FROM mid_result  INNER JOIN courses ON courses.course_id = mid_result.course_id "
                . "WHERE mid_result.program_id='$program_id' "
                . "and mid_result.session_id ='$session' "
                . "and mid_result.section ='$section' "
                . "and mid_result.batch_id ='$batch_id' "
                . "group by mid_result.course_id";
        $query_data = $this->db->query($query);
        
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }
    
    function batch_coursesresult( $batch_id,$program_id, $session, $section, $course_id)
    {
         $query      = ""
                . "SELECT *  FROM  mid_result , final_result"
                
                . "WHERE mid_result.program_id='$program_id' "
                . "and mid_result.session_id ='$session' "
                . "and mid_result.section ='$section' "
                . "and mid_result.batch_id ='$batch_id' "
                . "and mid_result.course_id ='$course_id' ";
                //. "group by mid_result.course_id";
        $query_data = $this->db->query($query);
        
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }
    

    function section_students_result($program_id, $batch_id,$session_id , $section,  $course_id){
        $query      =   $this->db->query("
                        SELECT students.`roll_no`,forms.`student_name`,final_result.semester,
                            final_result.final_value_1,final_result.`final_value_2`,final_result.`final_value_3`,final_result.final_value_4,final_result.`final_value_5`,final_result.`final_value_6`,final_result.`final_value_7`,
                            mid_result.`mid_value_1`,mid_result.`mid_value_2`,mid_result.`mid_value_3`,
                            final_result.`status`,campus.campus_name,coursess.course_name,programs.program_name

                        FROM 
                            students
                                        
                        INNER JOIN forms ON forms.form_id = students.form_id
                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id`
                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                        INNER JOIN campus on campus.campus_id = forms.campus_id
                        INNER JOIN coursess on coursess.course_id = final_result.course_id
                        INNER JOIN programs on programs.program_id = forms.program_id
                                        
                        WHERE
                            forms.program_id = $program_id 
                        AND                                        
                            final_result.`course_id` = $course_id 
                        AND
                            mid_result.`course_id` = final_result.`course_id` 
                        AND
                                final_result.`section` = '$section'
                        AND
                                final_result.`session_id` = $session_id
                        AND
                                final_result.`batch_id` = $batch_id
                        ORDER BY students.roll_no ASC");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    
    function classWiseFinalReport($session_id,$program_id,$batch_id,$section){
    $query      =   $this->db->query("
                                        SELECT students.`student_id`,students.roll_no,forms.student_name,final_result.`program_id`,final_result.`course_id` AS final_course, (final_result.`final_value_1`+final_result.`final_value_2`+final_result.`final_value_3`+final_result.`final_value_4`+final_result.`final_value_5`+final_result.`final_value_6`+final_result.`final_value_7`) AS obtained1, mid_result.`course_id` AS mid_course,(mid_result.mid_value_1+mid_result.mid_value_2+mid_result.mid_value_3) AS obtained2, final_result.semester, courses.`course_id`,courses.`course_name`,courses.credit_hours,programs.`program_name`,campus.`campus_name` ,batch.*
                                        FROM students INNER JOIN forms ON forms.form_id =students.form_id 
                                        INNER JOIN mid_result ON mid_result.`student_id` = students.`student_id` 
                                        INNER JOIN final_result ON final_result.`student_id` = students.`student_id`
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id 

                                        INNER JOIN courses ON courses.course_id = final_result.course_id 
                                        INNER JOIN programs ON programs.program_id = forms.program_id 
                                        INNER JOIN batch ON batch.batch_id = students.batch_id
                                        WHERE forms.`program_id`= $program_id 
                                        AND mid_result.`course_id` = final_result.`course_id` 
                                        AND final_result.`session_id` = $session_id 
                                        AND final_result.`batch_id` = $batch_id 
                                        AND final_result.`program_id` = $program_id 
                                        AND final_result.`section` = '$section'
                                        GROUP BY final_result.`student_id`,final_result.`course_id`,mid_result.`course_id` 
                                        ORDER BY students.roll_no ASC, courses.course_id ASC
                                        ");
        //echo $this->db->last_query();
        return $query->result_array();
    
    }
    
    public function chkLabExists(  $batch_id,$course_id  ){
        
        //echo "SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id ";
        
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id " );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        if($course_idl != ''){
            return $course_idl;
        }else{
            return 0;
        }
        
    }
    
    
    // getting lab marks
    public function getLabMarks( $student_id , $batch_id,$course_id  ,$session_id , $section){
        $data       = $this->db->query("SELECT  course_id FROM courses WHERE parent_course_id = $course_id AND batch_id = $batch_id " );
        $result     = $data->result_array();
        $course_idl = $result[0]['course_id'];
        
        if(!empty($course_idl)){
            $data = $this->db->query("SELECT  final_value_1 FROM final_result WHERE student_id = $student_id AND course_id = $course_idl AND session_id = $session_id AND section = '$section'" );
            return $data->result_array();
        }else{
            return 0;
        }
    }
    
    public function  dupStudentCourseSection($data_array){
        $query = $this->db->get_where('student_course_sections', $data_array);
        //return $query->num_rows();
        return $val =  $query->num_rows() > 0 ? $query->num_rows() : 0;
    }
    

    
    
    function getStudentCourseSectionWise($teacher_id, $current_session_id, $section,$course_id, $batch, $program){
        //echo $query      = "SELECT * FROM `student_course_sections` INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id where teacher_id = $teacher_id and semester= $semester and current_session_id = $current_session_id  group by course_section";
        $query      = "SELECT * FROM `student_course_sections` "
                . "INNER JOIN courses on `student_course_sections`.COURSE_ID = `courses`.course_id "
                . "INNER JOIN programs on `student_course_sections`.program_id = `programs`.program_id "
                . "INNER JOIN students on `student_course_sections`.student_id = `students`.student_id "
                . "INNER JOIN batch on `student_course_sections`.batch_id = `batch`.batch_id "
                . "INNER JOIN forms on `forms`.form_id = `students`.form_id "
                . "where teacher_id = $teacher_id "
                . "and student_course_sections.current_session_id = $current_session_id "
                //. " and student_course_sections.semester = $semester "
                . "and student_course_sections.course_section = '$section' "
                . "and student_course_sections.program_id = '$program' "
                . "and student_course_sections.batch_id = '$batch' "
                . "and student_course_sections.course_id = '$course_id' ORDER BY students.roll_no ASC";
        
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
    
    public function sectionStudentList( $program , $batch, $section, $course_id,$session){
        $query      = "
                    SELECT student_id FROM student_course_sections 
                    WHERE program_id = $program 
                    AND batch_id = $batch  
                    AND course_section = '$section'
                    AND course_id = $course_id
                    AND current_session_id= $session "; 
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    public function update_teacher_section( $teacher_id , $program , $batch, $section,  $course_id,$session){
        $query      = "
                    UPDATE  student_course_sections 
                    SET  teacher_id = $teacher_id 
                    WHERE program_id = $program 
                    AND batch_id = $batch  
                    AND course_section = '$section'
                    AND course_id = $course_id
                    AND current_session_id= $session "; 
        $query_data = $this->db->query($query);
        return $query_data;
    }
    /* prg result added by zohaib*/
    
}
