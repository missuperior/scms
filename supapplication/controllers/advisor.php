<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advisor extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Admin_model');
        $this->load->model('Advisor_model');
        $this->load->model('Admission_model');
        $this->load->model('Manager_model');
        $this->load->library('session');

        // for form validation
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    
     
  // Login for Admissions
    public function index() {
        //echo phpinfo();
        $this->load->view('advisor/login');
    }
  
  
     
    //for verification of admin login
    // in gen sub logins  id will be 11
    
    public function login_check() {

      if ($this->session->userdata('advisor_id') == '' && $this->session->userdata('username') == '') {
        redirect('advisor/index');
      }
    }
  
   public function login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

        $this->load->view('advisor/login');
    } else {

        $this->load->library('encrypt');

        $encrypted_password = $this->encrypt->sha1($_POST['password']);

        $login_data = array(
            'sub_login'       => $_POST['username'],
            'sub_password'    => $encrypted_password,
            'account_role_id' => '11'
        );

        $result = $this->Advisor_model->Login($login_data);
        if ($result) {

            $sessionData = array(
                'advisor_login'     => $result->sub_login,
                'advisor_id'        => $result->sub_login_id,
                'employee_id'       => $result->employee_id,
                'account_role_id'   => $result->account_role_id
            );
//            echo '<pre>';
//            var_dump($sessionData);die;
            $this->session->set_userdata($sessionData);
            redirect('advisor/dashboard');
        } else {

            $this->session->set_userdata('error', 'Incorrect Username OR Password');
            redirect('advisor/index');
        }
    }
}

  // for admin logout 
  public function logout() {

    $this->session->unset_userdata('advisor_id');
    $this->session->unset_userdata('advisor_login');
    $this->session->sess_destroy();
    redirect('advisor/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
    //echo 'rocking one';exit;
    
    $this->load->view('advisor/advisor_header');
    $this->load->view('advisor/advisor_side_menu');

    $this->load->view('advisor/dashboard');

    $this->load->view('advisor/advisor_footer');

  }
  
    public function view_students_form() {

        $this->login_check();
        $this->load->model('Course_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');

        
         $emp_id                 = $this->session->userdata('employee_id');
         $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
         $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session']; 
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        $result['all_session']  = $this->Admin_model->getAllSessions();

        $this->load->view('advisor/view_students_form' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    public function getAllStudents(){

        $batch_id               = $_REQUEST['batch'];
        $program_id             = $_REQUEST['program'];
        $session_id             = $_REQUEST['session'];
        
        //$result                 = $this->Advisor_model->getStudentList($batch_id,$program_id,$session_id);
        $result                 = $this->Advisor_model->getStudentList($batch_id,$program_id);
        
        //echo '<pre>';var_dump($result);//echo '</pre>';exit;
        
        $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Student Name</th><th>Roll No</th><th>Register Courses</th></tr></thead><tbody>';

        $i = 1;
        foreach( $result as  $pp){

            $student_id     = $pp["student_id"];
            
            $query_string   = '?session_id='.$session_id.'&batch_id='.$batch_id.'&program_id='.$program_id.'&student_id='.$student_id;
            $register_link  = site_url().'advisor/register_student_courses/'.$query_string;
            
            $test           .='<tr  id="row'.$i.'"><td><label   style="width: 100%;">'.$i.'</td><td>'.$pp["student_name"].'</td><td>'.$pp["roll_no"].'</td><td><a  style="cursor:pointer !important;" target="_blank" href="'.$register_link.'">Register Student</a></td></tr>';
            $i++; 
        } 
        $test.='</tbody></table>';
        echo $test;exit;
    }
    
    
    public function register_student_courses() {

        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $batch_id               = $_REQUEST['batch_id'];
        $program_id             = $_REQUEST['program_id'];
        $session_id             = $_REQUEST['session_id'];
        $student_id             = $_REQUEST['student_id'];

        $result['batch_id']     = $batch_id;
        $result['program_id']   = $program_id;
        
        
        $session                = $this->Advisor_model->getSession($session_id);
        $result['session_id']   = $session_id;
        $session_na             = $session[0]['session'];
        $result['sessionna']    = $session_na;

        
        //$result['all_session']  = $this->Admin_model->getAllSessions();
        
        //echo  '<pre>';var_dump($_REQUEST);echo  '</pre>';die;
        
        $result['student_id']   = $student_id; 

        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        
        $result['student_data'] = $this->Student_model->getStudentProfile($student_id);
        //$result['OfferedCourse']= $this->Course_model->allocatedCourseSectionsSettings($current_session[0]['session_id'] , $emp_id);
        $result['OfferedCourse']= $this->Course_model->allocatedCourseSectionsSettings($session_id,  $emp_id , $batch_id ,$program_id);
        
        
        $result['student_result'] = $this->Advisor_model->getstresult($student_id);
        
//        echo '<pre>';
//        var_dump($result['student_result'] );
//        echo '</pre>';
//        die;
        
        // checking if student is already registered
        
        $result['RegisteredCourse']= $this->Advisor_model->student_course($student_id , $session_id);
        
        
        //echo '<pre>';var_dump($result['OfferedCourse']);echo '</pre>';die;
         
        $this->load->view('advisor/CourseOfferedlist' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    
    public function UpdateStudentCourse(){
        $session_id  = $_POST['session']; 
        $student_id  = $_POST['student']; 
        $section     = $_POST['section']; 
        // remaining check if result exits can't update 
        $RegisteredCourse= $this->Advisor_model->UpCourseSec( $section, $student_id , $session_id);
        if($RegisteredCourse  == 'Section Updated'){
            echo $section;
        }
    }
    
    // saving courses for a student for current session
    public function SaveStudentCourseList(){
        $this->login_check();
        
        
        $courses_array = array($_POST['course_list']);
        
        if(count($courses_array) != count(array_unique($courses_array))){
            $this->session->set_userdata('error_msg', 'Duplicate Courses Registrations are not allowed against a Single Student.');
            redirect('advisor/view_students_form');
        }
        
        
        foreach($_POST['course_list'] as $k => $p){
            $arr = explode('=', $p);
            
            $course_id      = $arr[0];
            $teacher_id     = $arr[1];
            $course_section = $arr[2];
            
            $data_array  =  
                array(
                    'course_section'        => $course_section,
                    'teacher_id'            => $teacher_id,
                    'course_id'             => $course_id,
                    'student_id'            => $_POST['student_id'],
                    'program_id'            => $_POST['program_id'],
                    'current_session_id'    => $_POST['session_id'],
                    'batch_id'              => $_POST['batch_id']
               );
            
                // check course id // check if exits 
                //$parent_course_id     = $this->Advisor_model->getPreReq($course_id); 
               
               //if($parent_course_id != null  ){
                   
//                    $final              = $this->Advisor_model->final_result($_POST['student_id'],$parent_course_id);
//                    //echo '<pre>';var_dump($final);echo '</pre>';die;
//                    echo $finale_marks       = $final[0]['final'];
//                    echo '<pre>';
//               
//                    $mid                = $this->Advisor_model->mid_result($_POST['student_id'],$course_id);
//                    echo $mid_marks          = $mid[0]['mid'];
//                  echo '<pre>';
//               // cahck has lab
//               $lab                 = $this->Student_model->getLabMarks($student_id,$res['course_id']  );
//               if ($lab != null){
//                   
//                    $lab_marks        = $final[0]['final'];
//               }
//               
               //}
               
               // check result of this course

//               $marks   = $finale_marks + $mid_marks + $lab_marks;
//               
                //Data Structures & Algorithms
            
               $ids[] = $this->Advisor_model->addStCourses($data_array);
               
               // check pre requisite
               
               
//            echo '<pre>';
//            var_dump($data_array);echo '</pre>';
        }
        //die;
        $this->session->set_userdata('success_msg', 'Student registered.');
        redirect('advisor/view_students_form');
        
    }
    
    
    public function view_students_registered_courses() {

        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');

        $emp_id                     = $this->session->userdata('employee_id');
        $emp_depart_id              = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id          = $emp_depart_id[0]['department_id'];
        
        $batch_id                   = $_REQUEST['batch'];
        $program_id                 = $_REQUEST['program'];
        $session_id                 = $_REQUEST['session'];
        $student_id                 = $_REQUEST['student_id'];

        $result['student_data']     = $this->Student_model->getStudentProfile($student_id);
        $result['OfferedCourse']    = $this->Course_model->registeredCoursesOfStudents($session_id, $student_id , $emp_id);
        
        $this->load->view('advisor/view_students_registered_courses' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    public function all_reg_students_form(){
        
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');
        
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        $result['all_session']  = $this->Admin_model->getAllSessions();
        //$result['OfferedCourse']= $this->Course_model->allocatedCourseSectionsSettings($session_id,  $emp_id , $batch_id ,$program_id);
        
        $this->load->view('advisor/all_reg_students_form' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    public function assigned_courses(){
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');
        
        $batch_id               = $_REQUEST['batch'];
        $program_id             = $_REQUEST['program'];
        $session_id             = $_REQUEST['session'];
        
        $emp_id                 = $this->session->userdata('employee_id');
        $result                 = $this->Course_model->allocatedCourseSectionsSettings($session_id , $emp_id , $batch_id , $program_id);

        if($result == null){
            $test = 'Not Authorize to view courses';
        }else{
            $test   .='<div class="control-group"><label class="control-label" for="courses">Course and Section:</label><div class="controls"><div class="span12"><select name="offered_courses" id="offered_courses">';
            $i      = 1;
            foreach( $result as  $pp){
                $test.='<option value="'.$pp["course_id"].'=='.$pp["section_name"].'"> '.$pp["course_name"].' == '.$pp["course_code"].' == '.$pp["course_type"].' == '.$pp["section_name"].'</option>';
                $i++; 
            } 
            $test.='</select></div></div></div>';
        }
        echo $test;exit;
    }
    
    public function all_registered_students_list(){
        
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');
        
        $program_id     = $_POST['program'];
        $batch_id       = $_POST['batch'];
        $session_id     = $_POST['session'];
        $offerd_course  = $_POST['offered_courses'];
        //        echo '<pre>';//        var_dump($_POST);//        die;
        $afrr           = explode('==' , $offerd_course);
        
        $course_id      = $afrr[0];
        $section        = $afrr[1];
        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');
        //$result['courses']  = $this->Course_model->getcoursestd_list($section, $course_id, $session_id, $batch_id , $program_id);
        $result['courses']  = $this->Course_model->getcoursestd_list($section, $course_id, $session_id, $batch_id , $program_id);
        
        $this->load->view('advisor/all_registred_students_list' , $result);
        $this->load->view('advisor/advisor_footer');
        
    }
    
    // change pasword
    public function change_password_form(){
        
        $this->login_check();
        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');
        $this->load->view('advisor/change_password_form' );
        $this->load->view('advisor/advisor_footer');
    }
    
    public function change_password(){
        
        $this->login_check();
        $this->load->library('encrypt');
        
        $oldpassword        = $_POST['oldpassword'];
        $newpassword        = $_POST['newpassword'];
        $confirmpassword    = $_POST['confirmpassword'];
        $teacher_id         = $this->session->userdata('employee_id');
        
        
        $oldpasswords        = $this->encrypt->sha1($oldpassword);
        
        // current old match password
        $chk_password_flg = $this->Advisor_model->oldpassword($oldpasswords , $teacher_id);
        
        if($chk_password_flg  != true){ 
            $this->session->set_userdata('success_msg', 'Old password  does not match.');
            redirect('advisor/change_password_form/');
        }
        
        //echo $newpassword.'=='.$confirmpassword;die;
        
        if($newpassword != $confirmpassword){ 
            $this->session->set_userdata('success_msg', 'Password and Confirm password must match.');
            redirect('advisor/change_password_form/');
        }
        
        $newpassword        = $this->encrypt->sha1($newpassword);
        
        $old_password_flg = $this->Advisor_model->updatepassword($newpassword , $teacher_id);
        $this->session->set_userdata('success_msg', 'Password updated Successfully.');
        redirect('advisor/change_password_form/');
    }
    
    
    public function student_registered_courses_form(){
        
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');
        
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        $result['all_session']  = $this->Admin_model->getAllSessions();
        
        $this->load->view('advisor/student_registered_courses_form' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    
    
    public function AllStudentsList(){

        $batch_id               = $_REQUEST['batch'];
        $program_id             = $_REQUEST['program'];
        $session_id             = $_REQUEST['session'];
        
        //$result                 = $this->Advisor_model->getStudentList($batch_id,$program_id,$session_id);
        $result                 = $this->Advisor_model->getStudentList($batch_id,$program_id);
        
        //echo '<pre>';var_dump($result);//echo '</pre>';exit;
        
        $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Student Name</th><th>Roll No</th><th>Register Courses</th></tr></thead><tbody>';

        $i = 1;
        foreach( $result as  $pp){
            $student_id     = $pp["student_id"];
            $query_string   = '?session_id='.$session_id.'&batch_id='.$batch_id.'&program_id='.$program_id.'&student_id='.$student_id;
            $register_link  = site_url().'advisor/view_student_registered_courses/'.$query_string;
            $test           .='<tr  id="row'.$i.'"><td><label   style="width: 100%;">'.$i.'</td><td>'.$pp["student_name"].'</td><td>'.$pp["roll_no"].'</td><td><a  style="cursor:pointer !important;" target="_blank" href="'.$register_link.'">View Regitered Courses</a></td></tr>';
            $i++; 
        } 
        $test.='</tbody></table>';
        echo $test;exit;
    }
    
    public function view_student_registered_courses(){
        
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');

        
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $student_id             = $_GET['student_id']; 
        $session_id             = $_GET['session_id']; 
        $program_id             = $_GET['program_id']; 
        $batch_id               = $_GET['batch_id']; 
        
        $result['OfferedCourse']= $this->Course_model->allocatedCourseSectionsSettings($session_id,  $emp_id , $batch_id ,$program_id);
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        
        $result['student_data'] = $this->Student_model->getStudentProfile($student_id);
        
        $result['RegisteredCourse']= $this->Advisor_model->student_course($student_id , $session_id);
        
        // redirect if other program_courses
        if($result['RegisteredCourse'] == null){
            $this->session->set_userdata('success_msg', 'Un-athorized to delete');
            redirect('advisor/student_registered_courses_form');
        }
        
        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');
        $this->load->view('advisor/single_student_registered_courses' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
    public function dstudent_course(){
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');
        $this->load->model('Advisor_model');
        
        $emp_id                 = $this->session->userdata('employee_id');
//        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
//        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $student_id             = $_GET['student_id']; 
        $session_id             = $_GET['session_id']; 
        $program_id             = $_GET['program_id']; 
        $batch_id               = $_GET['batch_id']; 
        $section                = $_GET['section']; 
        $course_id              = $_GET['course_id']; 
        //$deleted                = $this->Advisor_model->dstudent_course($student_id , $session_id , $section , $batch_id, $program_id,  $emp_id , $course_id);
        $deleted                = $this->Advisor_model->dstudent_course($student_id , $session_id , $section , $batch_id, $program_id,   $course_id);
        
        if($deleted == false){
            echo 0 ; 
        }else{
            echo 1 ; 
        }
    }
    
    public function upstudent_course(){
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Student_model');
        $this->load->model('Advisor_model');
        
        $emp_id                 = $this->session->userdata('employee_id');
//        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
//        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $student_id             = $_GET['student_id']; 
        $session_id             = $_GET['session_id']; 
        $program_id             = $_GET['program_id']; 
        $batch_id               = $_GET['batch_id']; 
        $section                = $_GET['section']; 
        $course_id              = $_GET['course_id']; 
        $new_section             = $_GET['new_section']; 
        //$deleted                = $this->Advisor_model->dstudent_course($student_id , $session_id , $section , $batch_id, $program_id,  $emp_id , $course_id);
        $deleted                = $this->Advisor_model->upstudent_course($student_id , $session_id , $section , $batch_id, $program_id,   $course_id , $new_section);
        
        if($deleted == false){
            echo 0 ; 
        }else{
            echo 1 ; 
        }
    }
    
    public function student_list_export_form(){
        $this->login_check();
        $this->load->model('Course_model');

        $this->load->view('advisor/advisor_header');
        $this->load->view('advisor/advisor_side_menu');

        
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
        $emp_department_id      = $emp_depart_id[0]['department_id'];
            
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session']; 
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        $result['all_session']  = $this->Admin_model->getAllSessions();

        $this->load->view('advisor/export_student_list_form' , $result);
        $this->load->view('advisor/advisor_footer');
        
    }
    
    
    public function student_list_export(){
        
        $this->login_check();
        $this->load->model('Course_model');
        $this->load->model('Section_model');
        $program        = $_POST['program2'];
        $batch          = $_POST['batch2'];
        $session_id     = $_POST['session2'];
        $section        = $_POST['section'];
        
        $course_ar      = $_POST['offered_courses'];
        
        $arr            = explode( '==', $course_ar);
        $course         = $arr[0];
        $teacher_id     = $arr[1];
        
        $result['stus'] = $this->Section_model->getStudentCourseSectionWise($teacher_id, $session_id, $section,$course, $batch, $program);
        
        $this->load->view('advisor/advisor_header');
        //$this->load->view('advisor/advisor_side_menu' );
        $this->load->view('advisor/export_student_list' , $result);
        $this->load->view('advisor/advisor_footer');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
