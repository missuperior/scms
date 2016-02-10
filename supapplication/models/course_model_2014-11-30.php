<?php

class Course_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    // check duplication of city name
    function checkCourse($course)
    {
        $query = $this->db->get_where('courses', $course);
        return $query->result_array();
    }
    
    // check duplication of city name
    function checkCourseNew($course_name , $course_code , $course_type, $credit_hours )
    {
        $query      = "SELECT * FROM courses WHERE course_name='$course_name' AND course_code='$course_code' AND course_type='$course_type' AND credit_hours='$credit_hours'";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    // check course update
    function checkCourseUnique($course_name , $course_code , $course_type,  $course_id)
    {
        $query      = "SELECT * FROM courses WHERE course_name='$course_name' AND course_code='$course_code' AND course_type='$course_type' AND course_id!='$course_id'";
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
    // add city in db
    function addCourse($course)
    {
        $query = $this->db->insert('courses', $course); 
        return $this->db->insert_id();
    }
    
    // add city in db
    function addCoursePreReq($course)
    {
        $query = $this->db->insert('courses_pre_req', $course); 
        return $this->db->insert_id();
    }
    
    // get all cities from db
    function getAllCourses()
    {
        $this->db->order_by('course_name', 'ASC'); 
        $query = $this->db->get('courses');
        return $query->result_array();
    }
    
    // get a city for update
    
    function getCourse($course_id)
    {       
        $query = $this->db->get_where('courses', array('course_id' => $course_id));
        return $query->result_array();
    }
    
    // update the city name
    
    function updateCourse($id,$course)
    {
        $this->db->where('course_id', $id);
        $query = $this->db->update('courses', $course);
        return $query;        
    }
    
    function getAllPreReqCourses($course_id)
    {
        $query = $this->db->get_where('courses_pre_req', array('course_id' => $course_id));
        return $query->result_array();
    }
    
    function deleteAllPreReqCourses($course_id)
    {
        //$query = $this->db->get_where('courses_pre_req', array('course_id' => $course_id));
        $query = $this->db->delete('courses_pre_req', array('course_id' => $course_id));
        return $query;
    }
    
    
    // course allocation modules
    function saveAllocatedCourse($allocated_arr)
    {
        $query = $this->db->insert('courses_allocation', $allocated_arr); 
        return $this->db->insert_id();
    }
    
    // udopate course allocation modules
    function updateAllocatedCourse($allocated_arr , $allocated_id)
    {
        
        $this->db->where('course_allocation_id', $allocated_id);
        $query = $this->db->update('courses_allocation', $allocated_arr); 
        return $query;
    }
    
    
    // all alocated courses list
    function allAllocatedCourses()
    {
        $this->db->select('programs.*');
        $this->db->select('sessions.*');
        $this->db->select('courses.*');
        $this->db->select('hr_employee_record.*');
        $this->db->select('courses_allocation.*');
        $this->db->from('courses_allocation');
        
        $this->db->join('courses', 'courses_allocation.course_id = courses.course_id', 'inner');
        $this->db->join('programs', 'courses_allocation.program_id = programs.program_id', 'inner');
        $this->db->join('sessions', 'courses_allocation.session_id = sessions.session_id', 'inner');
        $this->db->join('hr_employee_record', 'courses_allocation.teacher_id = hr_employee_record.emp_id', 'inner');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // all alocated courses list
    function getAllocateCourse($course_allocation_id)
    {       
        $query = $this->db->get_where('courses_allocation', array('course_allocation_id' => $course_allocation_id));
        return $query->result_array();
    }
    
    // all alocated courses list
    function currentAllocatedCourses($year)
    {
        $this->db->select('programs.*');
        $this->db->select('sessions.*');
        $this->db->select('courses.*');
        $this->db->select('courses_allocation.*');
        $this->db->from('courses_allocation');
        
        $this->db->join('courses', 'courses_allocation.course_id = courses.course_id', 'inner');
        $this->db->join('programs', 'courses_allocation.program_id = programs.program_id', 'inner');
        $this->db->join('sessions', 'courses_allocation.session_id = sessions.session_id', 'inner');
        //$this->db->where(array('students.student_id' => $student_id));
        //$this->db->where(array('sessions.session' => $student_id));
        $this->db->like('sessions.session', $year);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
 
    
    // get a city for update
    function saveofferedCourse($offered_courses)
    {
        $query = $this->db->insert('offered_courses', $offered_courses); 
        return $this->db->insert_id();
    }
    
    
    // View Offered Courses
    function getOfferedCourses($year)
    {
        $this->db->select('sessions.*');
        $this->db->select('courses.*');
        $this->db->select('offered_courses.*');
        $this->db->from('offered_courses');
        
        $this->db->join('courses', 'offered_courses.course_id = courses.course_id', 'inner');
        //$this->db->join('programs', 'courses_allocation.program_id = programs.program_id', 'inner');
        $this->db->join('sessions', 'offered_courses.session_id = sessions.session_id', 'inner');
        //$this->db->where(array('sessions.session' => $student_id));
        $this->db->like('sessions.session', $year);
        
        $query = $this->db->get();
        return $query->result_array();
    }
 
    // all Offered course list seesion wise
    function getOfferedCourse($prg_mng_id)
    {       
        //$query = $this->db->get_where('offered_courses', array('id' => $course_offered_id));
        $query = $this->db->get_where('offered_courses', array('prg_manager_id' => $prg_mng_id));
        return $query->result_array();
    }
    
    function getSessionOfferedCourse($prg_mng_id,$session_id)
    {       
        //$query = $this->db->get_where('offered_courses', array('id' => $course_offered_id));
        $query = $this->db->get_where('offered_courses', array('prg_manager_id' => $prg_mng_id , 'session_id' => $session_id));
        return $query->result_array();
    }
    
    // all Offered course list seesion wise
    function getOfferedCourseDetail($prg_mng_id,$course_id)
    {       
        
        $this->db->select('courses.*');
        $this->db->select('offered_courses.*');
        //$this->db->from('offered_courses');
        $this->db->from('courses');
        
        $this->db->join('offered_courses', 'offered_courses.course_id = courses.course_id', 'inner');
        $this->db->where(array('offered_courses.course_id' => $course_id , 'offered_courses.prg_manager_id' => $prg_mng_id));
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    // all Offered course list seesion wise
    function deleteOfferedCourses($prg_manager_id,$session_id)
    {       
        $query = $this->db->delete('offered_courses', array('prg_manager_id' => $prg_manager_id, 'session_id' => $session_id));
        return $query;
    }
    
    function deleteSingleOfferedCourse($prg_manager_id,$session_id,$course_id)
    {       
        $query = $this->db->delete('offered_courses', array('prg_manager_id' => $prg_manager_id, 'session_id' => $session_id,'course_id' => $course_id));
        return $query;
    }
    
    function getSessionsOfferedCourses($cur_sesssion)
    {       
        $query = $this->db->get_where('offered_courses', array('session_id' => $cur_sesssion));
        return $val =  $query->num_rows() > 0 ? $query->row(): null;
    }
    
    /* AddedZ */ 
    function get_pre_req($course_id)
    
    {       
        $query = $this->db->get_where('courses_pre_req', array('course_id' => $course_id));
        //echo '<pre>';var_dump($query->result_array() );echo '</pre>';exit;
        return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
    }
    
    // all alocated courses list
    function allAllocatedCoursesNew()
    {
        $this->db->select('programs.*');
        $this->db->select('sessions.*');
        $this->db->select('courses.*');
        $this->db->select('courses_allocation.*');
        $this->db->from('courses_allocation');
        
        $this->db->join('courses', 'courses_allocation.course_id = courses.course_id', 'inner');
        $this->db->join('programs', 'courses_allocation.program_id = programs.program_id', 'inner');
        $this->db->join('sessions', 'courses_allocation.session_id = sessions.session_id', 'inner');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /* AddedZ */ 
    
    
    // bug: all teachers of all depts will be displayed 
    //function get_all_teachers($dept_it, $session_id){
    function get_all_teachers(){
        
        
//        $this->db->select('hr_employee_record.* , campus.*');
//        $this->db->from('hr_employee_record');
//        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
//        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
//        
        $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
        $this->db->from('hr_employee_record');
        $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
        $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
        $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
        $this->db->where('hr_departments.account_role_id' , '6' );
        $this->db->where( 'hr_employee_record.campus_id' , '3');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // get teacher data
    function get_teacher_data($teacher_id){
        $this->db->select( 'hr_employee_record.*' );
        $this->db->from( 'hr_employee_record' );
        $this->db->where( 'hr_employee_record.emp_id' , $teacher_id );
        $query = $this->db->get();
        return $query->result_array();
    }
/* added by zohaib*/
    
    public function getAllocatedCourses_smester( $program_id , $cur_session_id){
    //public function getAllocatedCourses_smester($semester, $program_id , $cur_session_id){
        $this->db->select('programs.*');
        $this->db->select('sessions.*');
        $this->db->select('courses.*');
        $this->db->select('hr_employee_record.*');
        $this->db->select('courses_allocation.*');
        $this->db->from('courses_allocation');
        
        $this->db->join('courses', 'courses_allocation.course_id = courses.course_id', 'inner');
        $this->db->join('programs', 'courses_allocation.program_id = programs.program_id', 'inner');
        $this->db->join('sessions', 'courses_allocation.session_id = sessions.session_id', 'inner');
        $this->db->join('hr_employee_record', 'courses_allocation.teacher_id = hr_employee_record.emp_id', 'inner');
        $this->db->where( "programs.program_id = $program_id");
        $this->db->where( "courses_allocation.session_id = $cur_session_id");
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function save(){}
    
    function getCurrentSession(){
        $this->db->select('session_id,session');
        $this->db->from('sessions');
        $this->db->where('active',1);
        $query      =   $this->db->get();
        return $query->result_array();
    }
    
    
    //function get_all_students($semester, $program_id , $cur_session_id){
    function get_all_students( $program_id , $cur_session_id){
        
        $query      = 
                "SELECT "
                . "forms.student_name, "
                . "forms.form_id, "
                . "forms.inquiry_id, "
                . "students.student_id, "
                . "students.current_session_id, "
                . "students.roll_no "
                . "FROM forms "
                . "INNER JOIN students " 
                . "ON students.form_id = forms.form_id "
                . "WHERE forms.program_id = $program_id "
                . "AND students.roll_no !='' "
                . "AND forms.inquiry_id != 0 "
                . "AND students.current_session_id  = $cur_session_id" 
                . " AND students.enrolled_session_id = $cur_session_id AND forms.campus_id = 3 ORDER BY students.roll_no ASC";
        //echo $query.'<br/>';
        $query_data = $this->db->query($query);
        return $query_data->result_array();
    }
    
    
    
     // saving student courses
    function addStudentOfferdCourse($data_array)
    {
        $query = $this->db->insert('student_courses', $data_array); 
        return $this->db->insert_id();
    }
    
    function addStudentSectionCourse ($data_array)
    {
        $query = $this->db->insert('student_sections', $data_array); 
        return $this->db->insert_id();
    }
    
    // check if student already registered in it 
    function StudentregisteredCourse ($course_id , $student_id)
    {
        
        $this->db->select('course_id,student_id');
        $this->db->from('student_courses');
        $this->db->where('course_id',$course_id);
        $this->db->where('student_id',$student_id);
        
        $query      =   $this->db->get();
        return $query->result_array();
        
    }
    
    
 
    function allTeachersList(){
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
        return $query->result_array();
    }
    
    function allTeachersLoginList(){
        $query = "SELECT gen_sub_logins.* , campus.*, hr_employee_record.* FROM gen_sub_logins INNER JOIN hr_employee_record ON hr_employee_record.emp_id = gen_sub_logins.employee_id INNER JOIN campus ON gen_sub_logins.campus_id = campus.campus_id";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        
    }
    
    
    /* added by zohaib*/
    
}