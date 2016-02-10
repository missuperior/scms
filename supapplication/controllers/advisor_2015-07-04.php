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
                'username'          => $result->sub_login,
                'advisor_id'        => $result->sub_login_id,
                'employee_id'       => $result->employee_id,
                'account_role_id'   => $result->account_role_id
            );
            
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
    $this->session->unset_userdata('username');
    $this->session->sess_destroy();
    redirect('advisor/index');
  }

  // admin dashboard

  public function dashboard() {

    //$this->login_check();
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
        $result['OfferedCourse']= $this->Course_model->allocatedCourseSectionsSettings($session_id,  $emp_id , $batch_id );
        
        
        $result['student_result'] = $this->Advisor_model->getstresult($student_id);
        
        
        //echo '<pre>';var_dump($result['OfferedCourse']);echo '</pre>';
         
        $this->load->view('advisor/CourseOfferedlist' , $result);
        $this->load->view('advisor/advisor_footer');
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
               $ids[] = $this->Advisor_model->addStCourses($data_array);
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */