<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class student extends CI_Controller {

  public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->model('Student_model');
    $this->load->model('Course_model');
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
     $this->load->library('send_mail');
    $this->load->library('form_validation');
  }

  // For Signup Form student
  public function index() {
    
    $this->load->view('student/login');
  }

  // for verification of student login

  public function login_check() {

    if ($this->session->userdata('roll_no') == '' && $this->session->userdata('student_login_id') == '') {
      redirect('student/index');
    }
  }

  // Student login 
  public function student_login() {

    $this->form_validation->set_rules('roll_no', 'Roll No', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('student/login');
    } 
    else {      
      $this->load->library('encrypt');
      $encrypted_password = $this->encrypt->sha1($_POST['password']);

      $login_data = array(
          'student_logins.roll_no'  => $_POST['roll_no'],
          'student_logins.password' => $encrypted_password
      );

      $result = $this->Student_model->studentLogin($login_data);
      if ($result) 
      {             
          $loginData = array(
              'roll_no'            => $result->roll_no,
              'student_login_id'   => $result->student_login_id,
              'student_name'       => $result->student_name,                         
              'student_id'         => $result->student_id
          );

          $this->session->set_userdata('success', 'Successfully Logged In');
          $this->session->set_userdata($loginData);
          redirect('student/home');
      } 
      else {
        $this->session->set_userdata('error', 'Incorrect Username OR Password');
        redirect('student/index');
      }
    }
  }

  // for student logout 
  public function logout() {

    $this->session->unset_userdata('student_login_id');
    $this->session->unset_userdata('roll_no');
    $this->session->sess_destroy();
    redirect('student/index');
  }

  // student dashboard
  public function home() {

    $this->login_check(); 
    //$this->load->view('student_ace/student_header');
    $this->load->view('student_ace/student_header_new');
    
    // getting all allcotied courses
    $year = date('Y');
    $result['courses_data'] = $this->Course_model->currentAllocatedCourses($year);
    
    $this->load->view('student_new/home', $result);    
    $this->load->view('student_ace/student_footer_new');
  }
  
  // Student signup form
  public function signup_form() {

    $result['programs'] = $this->Admin_model->getAllprograms();
//    $result['batches']  = $this->Admin_model->getAllbatches();
    
    $this->load->view('student/signup', $result);
  }
  
  // Save Student signup form
  public function signup()
  {
    $program_id = $_POST['prog_id'];
    $roll_no    = $_POST['roll_no'];
    
    $this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required');
    $this->form_validation->set_rules('student_name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('prog_id', 'Program', 'required');

    
    if($this->form_validation->run() == FALSE)
    {
        $result['programs'] = $this->Admin_model->getAllprograms();
        $this->load->view("student/signup", $result);
    }
    else
    {  
      //--- Check Student Existance in Student Login table ---\\
      $check_student = $this->Student_model->checkSignUpStudent($roll_no);   

      if($check_student)
      {
        $this->session->set_userdata('error', 'Already Registered');
        redirect("student/signup_form");
      }
      else
      {
          //--- Check Availability of Student Record ---\\      
          $res = $this->Student_model->checkStudentRecord($program_id, $roll_no);  

          if($res)
          {        
            //--- Generate Student Password ---\\
            $this->load->library('encrypt');
            $encrypted_password = $this->encrypt->sha1('student123');

            $student_data = array(        
                'roll_no'      =>  $_POST['roll_no'],
                'student_id'   =>  $res->student_id,
                'password'     =>  $encrypted_password,
                'created_date' =>  date('Y-m-d'),
                'status'       =>  1 
            );

            //--- Store Registration data in Student logins Table ---\\
            $std_reg = $this->Student_model->signUpStudent($student_data);

            if($std_reg)
            { 
              //--- Student's Password send @email ---\\  
              $config = Array(
                  'protocol'  => 'smtp',
                  'smtp_host' => 'ssl://smtp.googlemail.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'hafiz.mabuzar@superior.edu.pk', // change it to yours
                  'smtp_pass' => 'hafizmabuzarsuperior', // change it to yours
                  'mailtype'  => 'html',
                  'charset'   => 'iso-8859-1',
                  'wordwrap'  => TRUE
              );

              $message = 'Testing email sending';
              $this->load->library('email', $config);
              $this->email->set_newline("\r\n");
              $this->email->from('hafiz.mabuzar@superior.edu.pk'); // change it to yours
              $this->email->to('hafizmabuzar@gmail.com');// change it to yours
              $this->email->subject('Password');
              $this->email->message('<b>Your Password is :</b> student123');
              $this->email->send();
    //           show_error($this->email->print_debugger());

              //--- Login Registered Student ---\\
              $student_login = array(
                  'student_logins.roll_no'  => $_POST['roll_no'],
                  'student_logins.password' => $encrypted_password
              );

              $login_res = $this->Student_model->studentLogin($student_login);
              if ($login_res) {
                 $loginData = array(
                    'roll_no'            => $login_res->roll_no,
                    'student_login_id'   => $login_res->student_login_id,
                    'student_name'       => $login_res->student_name,                         
                    'student_id'         => $login_res->student_id
                         
                  );

                $this->session->set_userdata($loginData);
                $this->session->set_userdata('success', 'Successfully Registered');
                $this->load->view("student/home");
              }
            }
          }
          else
          {
            $this->session->set_userdata('error', 'Record not Found');
            redirect('student/signup_form');
          }
      }              
   }  
  }
  
  //-----  Student Profile -----\\
  public function student_profile()
  {
    $this->login_check();
    $student_id = $this->session->userdata('student_id');
    
    //-------- Get Student Infromation --------\\
    $result['profile'] = $this->Student_model->getStudentProfile($student_id); 
    //echo json_encode($result);
    
    $this->load->view('student_ace/student_header_new');
    $this->load->view('student_new/view_profile', $result);  
    $this->load->view('student_ace/student_footer_new');    
  }
  
    public function view_financial()
    {
        $this->load->model('Accounts_model');
        $student_id = $this->session->userdata('student_id');

        $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
        $this->session->set_userdata('package',$result['std_package'][0]['session_total_package']);

        $this->session->set_userdata($result);
        $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);

        $this->load->view('student_ace/student_header_new');
        $this->load->view('student/view_financial', $result);  
        $this->load->view('student_ace/student_footer_new');
    }
  
    
    // for course registration
    public function course_registration()
    {
        
        $year = date('Y');
        $result['courses_data'] = $this->Course_model->currentAllocatedCourses($year);
        
        $this->load->view('student_ace/student_header_new');
        
        $this->load->view('student/course_regristration', $result);  
        $this->load->view('student_ace/student_footer_new');    
    }
    
    
    
    // for course registration
    public function stu_new()
    {
        
        
        $this->load->view('student_ace/student_header_new');
        $this->load->view('student_new/home');  
        $this->load->view('student_ace/student_footer_new');    
    }
    
    public function test(){

        $from = "eng.khjamal@gmail.com";
        $to = "m.tariq@superior.edu.pk";
        $subject = "ABCD";
        $message = "asdsa";
        $headers = $from;
        
        
        $sendmail = new send_mail();
        echo $sendmail->send_email($to, $subject, $message, $headers);
        die;
        
        
//         $config = Array(
//                  'protocol'  => 'smtp',
//                  'smtp_host' => 'ssl://smtp.googlemail.com',
//                  'smtp_port' => 465,
//                  'smtp_user' => 'superiorsolutionz@gmail.com', // change it to yours
//                  'smtp_pass' => 'a1b2c3d456', // change it to yours
//                  'mailtype'  => 'html',
//                  'charset'   => 'iso-8859-1',
//                  'wordwrap'  => TRUE
//              );
//        
//         $msg = "asdsa";
//                            $logo = "<img src=".base_url()."\user_assets/images/nai_baat_logo.png\  alt=\"logo\"/>";
//                           
//                                        $message = "Dear User  <span style='margin-left:200px'><img src=http://careers.naibaat.tv/user_assets/images/nai_baat_logo.png width='100' height='50' alt=\"logo\"/></span>
//
//                                            <br /><br />
//
//                                            You can login to Nai Baat TV Career Portal using the following Information.
//                                            <br />
//                                            <br />
//                                            Username: m.tariq@superior.edu.pk    <br/>
//                                            <br />
//                                            Password: 0123654789 <span style='margin-left:50px'> (http://careers.naibaat.tv)</span><br />
//                                            <br />  
//
//                                            <b>Note: You can only apply after completing the entire application form.</b>
//                                            <br/><br />
//                                            For queries, please contact HR Department, Nai Baat TV via email at careers@naibaat.com 
//                                            <br/><br/>
//
//
//                                            <br />Regards,<br />                                            
//                                            <br />Nai Baat TV.";
//
//
//                                        $this->load->library('email', $config);
//                                        //$this->email->set_newline("\r\n");                            
//                                        $this->email->from('Careers@naibaat.tv', 'Nai Baat TV '); // change it to yours
//                                        $this->email->to('m.tariq@superior.edu.pk');// change it to yours
//                                        $this->email->subject('Reset Password');
//                                        $this->email->message($msg);
//                                       
//                                                        if (!$this->email->send())
//                                             show_error($this->email->print_debugger());
//                                                else
//                                                    echo 'Your e-mail has been sent!';

                            
                            
        exit;
    
                            
   } 
    
    
    
    
    
   
}