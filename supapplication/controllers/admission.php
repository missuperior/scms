<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admission extends CI_Controller {

    public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->model('Admission_model');
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
     
  // Login for Admissions
  public function index() {

    $this->load->view('admissions/login');
  }
  
  
     
  // for verification of admin login

  public function login_check() {

    if ($this->session->userdata('admin_id') == '' && $this->session->userdata('username') == '') {
      redirect('admission/index');
    }
  }
  
   public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admissions/login');
    } else {

      $this->load->library('encrypt');

      $encrypted_password = $this->encrypt->sha1($_POST['password']);
      
      $login_data = array(
          'acc_login'    => $_POST['username'],
          'acc_password' => $encrypted_password,
          'account_role_id' => $_POST['account_role_id'],
      );

      $result = $this->Admission_model->adminLogin($login_data);

      if ($result) {
          
        $sessionData = array(
            'username'        => $result->acc_login,
            'admin_id'        => $result->acc_login_id,
            'account_role_id' => $result->account_role_id,
        );

        $this->session->set_userdata($sessionData);
        redirect('admission/dashboard');
      } else {

        $this->session->set_userdata('error', 'Incorrect Username OR Password');
        redirect('admission/index');
      }
    }
  }

  // for admin logout 
  public function logout() {

    $this->session->unset_userdata('admin_id');
    $this->session->unset_userdata('username');
    $this->session->sess_destroy();
    redirect('admission/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }

    
  
  
    
 //  *****    Start Functions for Inquiry Module   *****  //       
  // Form to Add Inquiry 

  public function add_inquiry_form() {

    $this->login_check();

    $result['campus'] = $this->Admin_model->getAllCampuses();
    $result['campaign'] = $this->Admin_model->getAllcampaigns();
    $result['reference'] = $this->Admin_model->getAllreferences();
    $result['institute'] = $this->Admin_model->getAllInstitutes();
    $result['program'] = $this->Admin_model->getAllprograms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions/inquiry/addinquiry', $result);
    //$this->load->view('admissions/inquiry/inquiryform', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Inquiry in database

  public function add_inquiry() {

    $this->login_check();

    $this->form_validation->set_rules('inquiry_no', 'Inquiry No ', 'required');
    $this->form_validation->set_rules('campaign', ' Campaign ', 'required');
    $this->form_validation->set_rules('name', ' Name ', 'required');
    $this->form_validation->set_rules('contact', ' Contact ', 'required');
    $this->form_validation->set_rules('phone', ' Phone ', 'required');
    $this->form_validation->set_rules('program', ' Program ', 'required');
    $this->form_validation->set_rules('shift', ' Shift ', 'required');
    $this->form_validation->set_rules('gender', ' Gender ', 'required');
    $this->form_validation->set_rules('qualification', ' Qualification ', 'required');
    $this->form_validation->set_rules('obtained_marks', ' Obtained Marks ', 'required');
    $this->form_validation->set_rules('reference', ' Reference ', 'required');
    $this->form_validation->set_rules('inquiry_type', 'Inquiry Type ', 'required');
    $this->form_validation->set_rules('institute', 'Institute  ', 'required');
    $this->form_validation->set_rules('remarks', 'Remarks  ', 'required');
    $this->form_validation->set_rules('campus', ' Campus ', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admin_model->getAllcampaigns();
      $result['reference'] = $this->Admin_model->getAllreferences();
      $result['institute'] = $this->Admin_model->getAllInstitutes();
      $result['program'] = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');    
      $this->load->view('admissions/inquiry/addinquiry', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
     // check Inquiry already exitsts
    $inquiry_no = array('inquiry_no' => $_POST['inquiry_no']);
    $res = $this->Admission_model->checkInquiryNo($inquiry_no);

    if ($res) {
      $this->session->set_userdata('error_msg', 'Inquiry # Already Exists');
      redirect('admission/add_inquiry_form');
    }
    else {
      $inquiry_data = array(
          'inquiry_no' => $_POST['inquiry_no'],
          'campaign_id' => $_POST['campaign'],
          'name' => $_POST['name'],
          'contact' => $_POST['contact'],
          'phone' => $_POST['phone'],
          'program_id' => $_POST['program'],
          'shift' => $_POST['shift'],
          'gender' => $_POST['gender'],
          'qualification' => $_POST['qualification'],
          'obtained_marks' => $_POST['obtained_marks'],
          'reference_id' => $_POST['reference'],
          'inquiry_type' => $_POST['inquiry_type'],
          'previous_institute' => $_POST['institute'],
          'remarks' => $_POST['remarks'],
          'operator_id' => $this->session->userdata('admin_id'),
          'campus_id' => $_POST['campus'],
          'inquiry_date' => date('Y-m-d')
      );
               
          $result = $this->Admission_model->addInquiry($inquiry_data);

          if ($result) {
            $this->session->set_userdata('success_msg', 'Inquiry Added Successfully');
            redirect('admission/view_inquiries');
          }
        }
      }
      

  // display all the Inquiries

  public function view_inquiries() {
    $this->login_check();

    $result['inquiries'] = $this->Admission_model->getAllinquiries();
     

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions/inquiry/viewinquiries', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the record of Inquiry to be edited

  public function edit_inquiry() {
    $this->login_check();

    $id = $_GET['inquiry_id'];
    $result = $this->Admission_model->getInquiry($id);
    $result['inquiry'] = $result;
    
    $result['campus'] = $this->Admin_model->getAllCampuses();
    $result['campaign'] = $this->Admin_model->getAllcampaigns();
    $result['reference'] = $this->Admin_model->getAllreferences();
    $result['institute'] = $this->Admin_model->getAllInstitutes();
    $result['program'] = $this->Admin_model->getAllprograms();   

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions/inquiry/editinquiry', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Inquiry Record
  public function update_inquiry() {

    $this->login_check();
    $id = $_POST['inquiry_id'];

    $this->form_validation->set_rules('inquiry_no', 'Inquiry No ', 'required');
    $this->form_validation->set_rules('campaign', ' Campaign ', 'required');
    $this->form_validation->set_rules('name', ' Name ', 'required');
    $this->form_validation->set_rules('contact', ' Contact ', 'required');
    $this->form_validation->set_rules('phone', ' Phone ', 'required');
    $this->form_validation->set_rules('program', ' Program ', 'required');
    $this->form_validation->set_rules('shift', ' Shift ', 'required');
    $this->form_validation->set_rules('gender', ' Gender ', 'required');
    $this->form_validation->set_rules('qualification', ' Qualification ', 'required');
    $this->form_validation->set_rules('obtained_marks', ' Obtained Marks ', 'required');
    $this->form_validation->set_rules('reference', ' Reference ', 'required');
    $this->form_validation->set_rules('inquiry_type', 'Inquiry Type ', 'required');
    $this->form_validation->set_rules('institute', 'Institute  ', 'required');
    $this->form_validation->set_rules('remarks', 'Remarks  ', 'required');
    $this->form_validation->set_rules('campus', ' Campus ', 'required');

    if ($this->form_validation->run() == FALSE) {
        
      $result = $this->Admission_model->getInquiry($id);
      $result['inquiry'] = $result;

      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admin_model->getAllcampaigns();
      $result['reference'] = $this->Admin_model->getAllreferences();
      $result['institute'] = $this->Admin_model->getAllInstitutes();
      $result['program'] = $this->Admin_model->getAllprograms();   
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');    
      $this->load->view('admissions/inquiry/editinquiry', $result);
      $this->load->view('admin_ace/admin_footer');
    }
   
      $inquiry_data = array(
          'inquiry_no' => $_POST['inquiry_no'],
          'campaign_id' => $_POST['campaign'],
          'name' => $_POST['name'],
          'contact' => $_POST['contact'],
          'phone' => $_POST['phone'],
          'program_id' => $_POST['program'],
          'shift' => $_POST['shift'],
          'gender' => $_POST['gender'],
          'qualification' => $_POST['qualification'],
          'obtained_marks' => $_POST['obtained_marks'],
          'reference_id' => $_POST['reference'],
          'inquiry_type' => $_POST['inquiry_type'],
          'previous_institute' => $_POST['institute'],
          'remarks' => $_POST['remarks'],
          'operator_id' => $this->session->userdata('admin_id'),
          'campus_id' => $_POST['campus'],
          'inquiry_date' => date('Y-m-d')
      );
      $result = $this->Admission_model->updateInquiry($id, $inquiry_data);
      if ($result) {
        $this->session->set_userdata('success_msg', 'Inquiry updated Successfully');
        redirect('admission/view_inquiries');
      }
    
  }
  
  
  
  
  
   //  *****    Start Functions for Initital Form Module   *****  //      
  // form to Initial Form 

  public function add_initial_form() {

    $this->login_check();
    
    $result['campus']  = $this->Admin_model->getAllCampuses();
    $result['inquiry'] = $this->Admission_model->getAllInquiries();
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions/initial_form/add_initial_form', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
  // add Initial Form in database

  public function add_initial_form_data() {

    $this->login_check();

    $this->form_validation->set_rules('form_no', 'Form #', 'required');
    $this->form_validation->set_rules('inquiry', 'Inquiry', 'required');
    $this->form_validation->set_rules('campus', 'Campus', 'required');
    $this->form_validation->set_rules('date', 'Submit Date', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['campus']  = $this->Admin_model->getAllCampuses();
      $result['inquiry'] = $this->Admission_model->getAllInquiries();
    
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admissions/initial_form/add_initial_form', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    else {
      $check_initial_form = array(
          'form_no' => $_POST['form_no']
      );

      
      
      // check Initial Form already exitsts or not

      $res = $this->Admission_model->checkInitialForm($check_initial_form);
      if ($res) {
        $this->session->set_userdata('error_msg', 'This Form # already Exists');
        redirect('admission/add_initial_form');
      } 
      else {
          
       $inquiry_id             = $_POST['inquiry']; 
       $result                 = $this->Admission_model->getInquiry($inquiry_id);

       
     $initial_form_data = array(                        
            'inquiry_id'        => $inquiry_id,
            'form_no'           => $_POST['form_no'],
            'student_name'      => $result[0]['name'],
            'mobile'            => $result[0]['contact'],
            'program_id'        => $result[0]['program_id'],
            'shift'             => $result[0]['shift'],
            'gender'            => $result[0]['gender'],
            'qualification'     => $result[0]['qualification'],
            'obtained_marks'    => $result[0]['obtained_marks'],
            'campus_id'         => $result[0]['campus_id'],
            'operator_id'       => $this->session->userdata('admin_id'),
            'created_date'      => $_POST['date']
           
        );
   
        $res = $this->Admission_model->addInitialForm($initial_form_data);

        if ($res) {          
          $this->session->set_userdata('success_msg', 'Initial Form Added Successfully');
          redirect('admission/view_initial_forms');
        }
      }
    }
  }
  
  // view all Initial Form 

  public function view_initial_forms() {
    $this->login_check();

    $result['initial_form'] = $this->Admission_model->getAllInitialForms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');    
    $this->load->view('admissions/initial_form/view_initial_forms', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
  // get the Initial Form to be edited

  public function edit_initial_form() {

    $this->login_check();
    $id = $_GET['initial_form_id'];
    
    $initial_form = array('initial_form_id' => $id); 
    $result['initial'] = $this->Admission_model->getInitialForm($initial_form);    
    $result['inquiry'] = $this->Admission_model->getAllinquiries();        
    $result['campus']  = $this->Admin_model->getAllCampuses();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions/initial_form/edit_initial_form', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update Initial Form in database

  public function update_initial_form() {

    $this->login_check();
    $id = $_POST['initial_form_id'];

    $this->form_validation->set_rules('form_no', 'Form #', 'required');
    $this->form_validation->set_rules('inquiry', 'Inquiry', 'required');
    $this->form_validation->set_rules('campus', 'Campus', 'required');
    $this->form_validation->set_rules('date', 'Submit Date', 'required');

    if ($this->form_validation->run() == FALSE) {
      
      $initial_form = array('initial_form_id' => $id); 
      $result['initial']  = $this->Admission_model->getInitialForm($initial_form);
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['inquiry']  = $this->Admission_model->getAllInquiries();
    
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admissions/initial_form/edit_initial_form', $result);
      $this->load->view('admin_ace/admin_footer');
    }       
      // check Initial Form already exitsts or not      
      $check_initial_form = array(
            'form_no' => $_POST['form_no']
      );
      
       $inquiry_id             = $_POST['inquiry']; 
       $result                 = $this->Admission_model->getInquiry($inquiry_id);

       
       $initial_form_data = array(                        
            'inquiry_id'        => $inquiry_id,
            'form_no'           => $_POST['form_no'],
            'student_name'      => $result[0]['name'],
            'mobile'            => $result[0]['contact'],
            'program_id'        => $result[0]['program_id'],
            'shift'             => $result[0]['shift'],
            'gender'            => $result[0]['gender'],
            'qualification'     => $result[0]['qualification'],
            'obtained_marks'    => $result[0]['obtained_marks'],
            'campus_id'         => $_POST['campus'],
            'operator_id'       => $this->session->userdata('admin_id'),
            'created_date'      => $_POST['date']
           
        );

        $result = $this->Admission_model->updateInitialForm($id, $initial_form_data);

        if ($result) {          
          $this->session->set_userdata('success_msg', 'Initial Form updated Successfully');
          redirect('admission/view_initial_forms');
        }
      
    }
  
    //---------------End of Initial Form----------------//

    
    
    //   Start function for complete form  ////
    
    
    // Student Complete form
        
        public function form()
        {
           $this->login_check();
                         
            $result['sessions']            = $this->Admin_model->getAllSessions();
            $result['batches']             = $this->Admin_model->getAllbatches();
            $result['sections']             = $this->Admin_model->getAllsections();
            $result['programs']             = $this->Admin_model->getAllprograms();
            $result['cities']               = $this->Admin_model->getAllcities();
            $result['institutes']           = $this->Admin_model->getAllInstitutes();
            
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions/form/form',$result);
            $this->load->view('admin_ace/admin_footer');
        }
        
        
        // save form data into student and form table
        
        public function add_studentform()
        {             
            $this->login_check();
            
            $this->form_validation->set_rules('form_no', 'Form No ', 'required');
            $this->form_validation->set_rules('roll_no', ' Roll No', 'required');
            $this->form_validation->set_rules('current_session', ' Current Session', 'required');
            $this->form_validation->set_rules('enrolment_session', ' Enrolment Session', 'required');
            $this->form_validation->set_rules('shift', 'Shift', 'required');
            $this->form_validation->set_rules('batch', ' Batch', 'required');
            $this->form_validation->set_rules('program', ' Program', 'required');
            $this->form_validation->set_rules('name', ' Name ', 'required');
            $this->form_validation->set_rules('father_name', ' Father Name ', 'required');
            $this->form_validation->set_rules('nationality', ' Nationality ', 'required');
            $this->form_validation->set_rules('religion', ' Religion ', 'required');
            $this->form_validation->set_rules('email', ' Email ', 'trim|required|valid_email');
            $this->form_validation->set_rules('cnic', ' CNIC ', 'required|minLength[15]|maxLength[15]');
            $this->form_validation->set_rules('mobile', ' Mobile ', 'required');
            $this->form_validation->set_rules('present_address', ' Present Address ', 'required');
            $this->form_validation->set_rules('present_city', ' Present City ', 'required');
            $this->form_validation->set_rules('permanent_address', ' Permanent Address ', 'required');
            $this->form_validation->set_rules('permanent_city', ' Permanent City ', 'required');
            $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'required');
            $this->form_validation->set_rules('guardian_relation', 'Guardian Relation ', 'required');
            $this->form_validation->set_rules('guardian_occupation', 'Guardian Occupation ', 'required');
            $this->form_validation->set_rules('guardian_address', ' Guardian Address ', 'required');
            $this->form_validation->set_rules('guardian_city', ' Guardian City ', 'required');
            $this->form_validation->set_rules('guardian_mobile', 'Guardian Mobile ', 'required');            
            $this->form_validation->set_rules('guardian_income', 'Guardian Income ', 'required');
            $this->form_validation->set_rules('emergency_name', 'Emergency Contact Name ', 'required');
            $this->form_validation->set_rules('emergency_relation', 'Emergency Contact Relation ', 'required');
            $this->form_validation->set_rules('emergency_address', 'Emergency Contact Address ', 'required');
            $this->form_validation->set_rules('emergency_city', 'Emergency Contact City ', 'required');
            $this->form_validation->set_rules('emergency_mobile', ' Mobile ', 'required');
            $this->form_validation->set_rules('previous_qualification', ' Qualification ', 'required');
            $this->form_validation->set_rules('previous_rollno', 'Previous Roll No ', 'required');
            $this->form_validation->set_rules('previous_totalmarks', ' Total Marks ', 'required');
            $this->form_validation->set_rules('previous_institute', ' Previous Institute ', 'required');
            $this->form_validation->set_rules('previous_obtainedmarks', ' Previous Obtained ', 'required');
            $this->form_validation->set_rules('previous_subject', ' Previous Subjects ', 'required');
            $this->form_validation->set_rules('previous_grade', ' Previous Grade ', 'required');
            $this->form_validation->set_rules('previous_year', ' Previous Year ', 'required');
            
            if ($this->form_validation->run() == FALSE) {

                     $result['sessions']            = $this->Admin_model->getAllSessions();
                     $result['batches']             = $this->Admin_model->getAllbatches();
                     $result['sections']             = $this->Admin_model->getAllsections();
                     $result['programs']             = $this->Admin_model->getAllprograms();
                     $result['cities']               = $this->Admin_model->getAllcities();
                     $result['institutes']           = $this->Admin_model->getAllInstitutes();
                        
                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions/form/form',$result);
                       
            } else {
              
                        
            $form_no = array('form_no' => $_POST['form_no']);
            $res = $this->Admission_model->checkFormNo($form_no);
            if($res)
            {
                 $this->session->set_userdata('error_msg','Form No Already Exists!');
                 redirect('admission/form');
            }
            else
                {
                        $student_data = array(
                                                'form_no'=>$_POST['form_no'],
                                                'roll_no'=>$_POST['roll_no'],
                                                'current_session_id'=>$_POST['current_session'],
                                                'enrolled_session_id'=>$_POST['enrolment_session'],
                                                'shift'=>$_POST['shift'],
                                                'batch_id'=>$_POST['batch']                                    
                                             );


                        $form_data = array(
                                                'form_no'=>$_POST['form_no'],
                                                'program_id'=>$_POST['program'],
                                                'operator_id'=>$this->session->userdata('admin_id'),
                                                'campus_id'=>1,
                                                'student_name'=>$_POST['name'],
                                                'father_name'=>$_POST['father_name'],
                                                'gender'=>$_POST['gender'],
                                                'marital_status'=>$_POST['marital_status'],
                                                'form_submit_date'=>date('Y-m-d'),
                                                'inquiry_id'=>0,

                                                'dob'=>$_POST['dob'],
                                                'shift'=>'Morning',
                                                'nationality'=>$_POST['nationality'],
                                                'religion'=>$_POST['religion'],
                                                'nic_no'=>$_POST['cnic'],
                                                'mobile'=>$_POST['mobile'],

                                                'email'=>$_POST['email'],
                                                'present_address'=>$_POST['present_address'],
                                                'present_city_id'=>$_POST['present_city'],
                                                'permanent_address'=>$_POST['permanent_address'],
                                                'permanent_city_id'=>$_POST['permanent_city'],

                                                'guardian_name'=>$_POST['guardian_name'],                
                                                'guardian_relation'=>$_POST['guardian_relation'],
                                                'guardian_occupation'=>$_POST['guardian_occupation'],
                                                'guardian_designation'=>$_POST['guardian_designation'],
                                                'guardian_address'=>$_POST['guardian_address'],
                                                'guardian_city_id'=>$_POST['guardian_city'],
                                                'guardian_phone'=>$_POST['guardian_phone'],
                                                'guardian_mobile'=>$_POST['guardian_mobile'],
                                                'guardian_income'=>$_POST['guardian_income'],

                                                'emergency_contact_name'=>$_POST['emergency_name'],                
                                                'emergency_contact_relation'=>$_POST['emergency_relation'],
                                                'emergency_contact_address'=>$_POST['emergency_address'],
                                                'emergencay_city_id'=>$_POST['emergency_city'],
                                                'emergency_contact_phone'=>$_POST['emergency_phone'],
                                                'emergency_contact_mobile'=>$_POST['emergency_mobile'],

                                                'kinship_name'=>$_POST['kinship_name'],
                                                'kinship_relation'=>$_POST['kinship_relation'],
                                                'kinship_program'=>$_POST['kinship_program'],
                                                'kinship_rollno'=>$_POST['kinship_rollno'],
                                                'kinship_batch'=>$_POST['kinship_batch'],

                                                'previous_qualification'=>$_POST['previous_qualification'],                
                                                'previous_institute'=>$_POST['previous_institute'],
                                                'previous_rollno'=>$_POST['previous_rollno'],
                                                'previous_subjects'=>$_POST['previous_subject'],
                                                'previous_total_marks'=>$_POST['previous_totalmarks'],
                                                'previous_obtained_marks'=>$_POST['previous_obtainedmarks'],
                                                'previous_grade'=>$_POST['previous_grade'],
                                                'previous_degree_year'=>$_POST['previous_year'],

                                             );

                       $program_id  = $_POST['program']; 
                       $batch_id    = $_POST['batch']; 
                       $student_id =  $this->Admission_model->addForm($student_data,$form_data);
                       if($student_id)
                       {
                           $this->session->set_userdata('success_msg','Student and Form Info  added ');
                           redirect('admission/view_student_form');
                       }else{
                            $this->session->set_userdata('error_msg','Student and Form Info  Not added, Please try again! ');
                           redirect('admission/view_student_form');
                       }
                }
            
            }
        }
        
        public function view_student_form()
        {
          $this->login_check();
          
          $result['form_data'] = $this->Admission_model->getAllStudentForms();
                    
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admissions/form/view_forms', $result);
          $this->load->view('admin_ace/admin_footer');
          
        }
        
        
        // get form to be edited
        
        public function edit_studentform()
        {
            $this->login_check();
            
            $student_id                     = array('student_id' => $_GET['student_id']);
            
            $result['sessions']             = $this->Admin_model->getAllSessions();
            $result['batches']              = $this->Admin_model->getAllbatches();
            $result['sections']             = $this->Admin_model->getAllsections();
            $result['programs']             = $this->Admin_model->getAllprograms();
            $result['cities']               = $this->Admin_model->getAllcities();
            $result['institutes']           = $this->Admin_model->getAllInstitutes();
            $result['student']              = $this->Admission_model->getStudentForm($student_id);
            
            
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions/form/editform',$result);
            $this->load->view('admin_ace/admin_footer');
            
            
        }
        
        
        
        
         // save form data into student and form table
        
        public function update_studentform()
        {             
            $this->login_check();
            
            $this->form_validation->set_rules('form_no', 'Form No ', 'required');
            $this->form_validation->set_rules('roll_no', ' Roll No', 'required');
            $this->form_validation->set_rules('current_session', ' Current Session', 'required');
            $this->form_validation->set_rules('enrolment_session', ' Enrolment Session', 'required');
            $this->form_validation->set_rules('shift', 'Shift', 'required');
            $this->form_validation->set_rules('batch', ' Batch', 'required');
            $this->form_validation->set_rules('program', ' Program', 'required');
            $this->form_validation->set_rules('name', ' Name ', 'required');
            $this->form_validation->set_rules('father_name', ' Father Name ', 'required');
            $this->form_validation->set_rules('nationality', ' Nationality ', 'required');
            $this->form_validation->set_rules('religion', ' Religion ', 'required');
            $this->form_validation->set_rules('email', ' Email ', 'trim|required|valid_email');
            $this->form_validation->set_rules('cnic', ' CNIC ', 'required|minLength[15]|maxLength[15]');
            $this->form_validation->set_rules('mobile', ' Mobile ', 'required');
            $this->form_validation->set_rules('present_address', ' Present Address ', 'required');
            $this->form_validation->set_rules('present_city', ' Present City ', 'required');
            $this->form_validation->set_rules('permanent_address', ' Permanent Address ', 'required');
            $this->form_validation->set_rules('permanent_city', ' Permanent City ', 'required');
            $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'required');
            $this->form_validation->set_rules('guardian_relation', 'Guardian Relation ', 'required');
            $this->form_validation->set_rules('guardian_occupation', 'Guardian Occupation ', 'required');
            $this->form_validation->set_rules('guardian_address', ' Guardian Address ', 'required');
            $this->form_validation->set_rules('guardian_city', ' Guardian City ', 'required');
            $this->form_validation->set_rules('guardian_mobile', 'Guardian Mobile ', 'required');            
            $this->form_validation->set_rules('guardian_income', 'Guardian Income ', 'required');
            $this->form_validation->set_rules('emergency_name', 'Emergency Contact Name ', 'required');
            $this->form_validation->set_rules('emergency_relation', 'Emergency Contact Relation ', 'required');
            $this->form_validation->set_rules('emergency_address', 'Emergency Contact Address ', 'required');
            $this->form_validation->set_rules('emergency_city', 'Emergency Contact City ', 'required');
            $this->form_validation->set_rules('emergency_mobile', ' Mobile ', 'required');
            $this->form_validation->set_rules('previous_qualification', ' Qualification ', 'required');
            $this->form_validation->set_rules('previous_rollno', 'Previous Roll No ', 'required');
            $this->form_validation->set_rules('previous_totalmarks', ' Total Marks ', 'required');
            $this->form_validation->set_rules('previous_institute', ' Previous Institute ', 'required');
            $this->form_validation->set_rules('previous_obtainedmarks', ' Previous Obtained ', 'required');
            $this->form_validation->set_rules('previous_subject', ' Previous Subjects ', 'required');
            $this->form_validation->set_rules('previous_grade', ' Previous Grade ', 'required');
            $this->form_validation->set_rules('previous_year', ' Previous Year ', 'required');
            
            if ($this->form_validation->run() == FALSE) {

                     $result['sessions']            = $this->Admin_model->getAllSessions();
                     $result['batches']             = $this->Admin_model->getAllbatches();
                     $result['sections']             = $this->Admin_model->getAllsections();
                     $result['programs']             = $this->Admin_model->getAllprograms();
                     $result['cities']               = $this->Admin_model->getAllcities();
                     $result['institutes']           = $this->Admin_model->getAllInstitutes();
                        
                     $this->load->view('admin_ace/admin_header');
                     $this->load->view('admin_ace/admin_side_menu');
                     $this->load->view('admissions/form/form',$result);
                       
            } else {
              
                        
                        $student_data = array(
                                                'form_no'=>$_POST['form_no'],
                                                'roll_no'=>$_POST['roll_no'],
                                                'current_session_id'=>$_POST['current_session'],
                                                'enrolled_session_id'=>$_POST['enrolment_session'],
                                                'shift'=>$_POST['shift'],
                                                'batch_id'=>$_POST['batch']                                    
                                             );


                        $form_data = array(
                                                'form_no'=>$_POST['form_no'],
                                                'program_id'=>$_POST['program'],
                                                'operator_id'=>$this->session->userdata('admin_id'),
                                                'campus_id'=>1,
                                                'student_name'=>$_POST['name'],
                                                'father_name'=>$_POST['father_name'],
                                                'gender'=>$_POST['gender'],
                                                'marital_status'=>$_POST['marital_status'],
                                                'form_submit_date'=>date('Y-m-d'),
                                                'inquiry_id'=>0,

                                                'dob'=>$_POST['dob'],
                                                'shift'=>'Morning',
                                                'nationality'=>$_POST['nationality'],
                                                'religion'=>$_POST['religion'],
                                                'nic_no'=>$_POST['cnic'],
                                                'mobile'=>$_POST['mobile'],

                                                'email'=>$_POST['email'],
                                                'present_address'=>$_POST['present_address'],
                                                'present_city_id'=>$_POST['present_city'],
                                                'permanent_address'=>$_POST['permanent_address'],
                                                'permanent_city_id'=>$_POST['permanent_city'],

                                                'guardian_name'=>$_POST['guardian_name'],                
                                                'guardian_relation'=>$_POST['guardian_relation'],
                                                'guardian_occupation'=>$_POST['guardian_occupation'],
                                                'guardian_designation'=>$_POST['guardian_designation'],
                                                'guardian_address'=>$_POST['guardian_address'],
                                                'guardian_city_id'=>$_POST['guardian_city'],
                                                'guardian_phone'=>$_POST['guardian_phone'],
                                                'guardian_mobile'=>$_POST['guardian_mobile'],
                                                'guardian_income'=>$_POST['guardian_income'],

                                                'emergency_contact_name'=>$_POST['emergency_name'],                
                                                'emergency_contact_relation'=>$_POST['emergency_relation'],
                                                'emergency_contact_address'=>$_POST['emergency_address'],
                                                'emergencay_city_id'=>$_POST['emergency_city'],
                                                'emergency_contact_phone'=>$_POST['emergency_phone'],
                                                'emergency_contact_mobile'=>$_POST['emergency_mobile'],

                                                'kinship_name'=>$_POST['kinship_name'],
                                                'kinship_relation'=>$_POST['kinship_relation'],
                                                'kinship_program'=>$_POST['kinship_program'],
                                                'kinship_rollno'=>$_POST['kinship_rollno'],
                                                'kinship_batch'=>$_POST['kinship_batch'],

                                                'previous_qualification'=>$_POST['previous_qualification'],                
                                                'previous_institute'=>$_POST['previous_institute'],
                                                'previous_rollno'=>$_POST['previous_rollno'],
                                                'previous_subjects'=>$_POST['previous_subject'],
                                                'previous_total_marks'=>$_POST['previous_totalmarks'],
                                                'previous_obtained_marks'=>$_POST['previous_obtainedmarks'],
                                                'previous_grade'=>$_POST['previous_grade'],
                                                'previous_degree_year'=>$_POST['previous_year'],

                                             );

                       $program_id      = $_POST['program']; 
                       $batch_id        = $_POST['batch']; 
                       $student_id      = $_POST['student_id']; 
                       $form_id         = $_POST['form_id']; 
                       $result          =  $this->Admission_model->updateForm($student_data,$form_data,$form_id,$student_id);
                       if($result)
                       {
                           $this->session->set_userdata('success_msg','Student Info Updated Successfully');
                           redirect('admission/view_student_form');
                       }else{
                            $this->session->set_userdata('error_msg','Student Info  Not Updated, Please try again! ');
                           redirect('admission/view_student_forms');
                       }
                
            
            }
        }
        
        
        
        
        
        
        
        
        
        
        //   End function for complete form ///
  
  
  
  
// ******>>>>         Start functions for Student Pakage        <<<<******  //
        

// define student pakage form 
        
        public function student_package()
        {
            $this->login_check();
                                      
          $student_id = $_REQUEST['student_id'];  
          $result['std_info']   =   $this->Admission_model->getStudentPackageInfo($student_id);
          $program_id = $this->session->userdata('program_id');           
          $result['package']   =  $this->Admission_model->getStudentPackage($student_id);
                    
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admissions/accounts/student_package/add_package', $result);
          $this->load->view('admin_ace/admin_footer');
            
        }


 // add student package
        
        public function add_student_package()
        {
            $this->login_check();
            
            $student_id         = $_POST['student_id'];
            $program_id         = $_POST['program_id'];
            $operator_id        = $this->session->userdata('admin_id');
            $session_package    = $_POST['total_package'];
            $total_sessions     = $_POST['no_of_sessions'];
            $degree_package     = $session_package * $total_sessions;
            
            $student_package = array(
                                        'student_id'            =>$student_id,
                                        'program_id'            =>$program_id,
                                        'total_sessions'        =>$total_sessions,
                                        'admission_fee'         =>$_POST['admission_payable'],
                                        'misc_fee'              =>$_POST['misc_payable'],
                                        'session_fee'           =>$_POST['session_payable'],
                                        'admission_fee_discount'=>$_POST['admission_discount1'],
                                        'session_fee_discount'  =>$_POST['session_discount1'],
                                        'session_total_package' =>$session_package,
                                        'degree_total_package'  =>$degree_package,
                                        'remarks'               =>$_POST['remarks'],
                                        'created_date'          =>date('Y-m-d'),
                                        'operator_id'           =>$operator_id
                                    );
            
            
             $result          = $this->Admission_model->addStudentPackage($student_package);
             if($result)
                 {
                        
                        $this->session->set_userdata('package',$session_package);
                        $this->session->set_userdata('student_id',$student_id);
                        $this->session->set_userdata('program_id',$program_id);
                        $this->session->set_userdata('success_msg','Student Package Added Successfully');
                        redirect('admission/installments');
                 }
             else
                 {
                     $this->session->set_userdata('error_msg','Student Package Not Added Successfully, Please Try Again!');
                     redirect('admission/student_package');
                 }
                 
            
        }
        
        
        
        
        
 // add installments of student package
        
        public function installments()
        {
          $this->login_check();
           
          $result['sessions']            = $this->Admin_model->getAllSessions();
            
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admissions/accounts/student_package/add_installments', $result);
          $this->load->view('admin_ace/admin_footer');
            
            
        }
        
        
        // Add installments in db
        
        public function add_installments()
        {
            $this->login_check();
            
            $session_id     = $_POST['session'];
            $student_id     = $this->session->userdata('student_id');
            
            $check_data     = array(
                                        'student_id' => $student_id,
                                        'session_id' => $session_id,
                                    );
            
            $result         = $this->Admission_model->chkSession_inInstallment($check_data);
            
            if($result == 0)
            {
            
                        $student_id     = $this->session->userdata('student_id');
                        $program_id     = $this->session->userdata('program_id');
                        $operator_id    = $this->session->userdata('admin_id');
            //          

                        $amount[]       = $_POST['installment_amount'];
                        $fine[]         = $_POST['fine'];
                        $discount[]     = $_POST['discount'];
                        $payable[]      = $_POST['payable'];
                        $due_date[]     = $_POST['due_date'];

                        for($i=0; $i <= 3; $i++)
                        {

                          if($amount[0][$i] != '')
                          {
                            $installment_data = array(
                                            'student_id'             => $student_id,
                                            'program_id'             => $program_id,
                                            'session_id'             => $session_id,
                                            'fee'                    => $amount[0][$i],
                                            'fine'                   => $fine[0][$i],
                                            'additional_discount'    => $discount[0][$i],
                                            'payable'                => $payable[0][$i],
                                            'due_date'               => $due_date[0][$i],
                                            'created_date'           =>date('Y-m-d'),
                                            'operator_id'            => $operator_id

                                            );

                               $challan_id   =   $this->Admission_model->addInstallments($installment_data,$student_id);
                               
                               if(!$challan_id)
                               {
                                   echo 'Not Added';
                               }
                               
                          }
                        }

                        $this->session->set_userdata('success_msg','Student Installments Added Successfully');
                        //$this->session->unset_userdata('student_id');
                        $this->session->unset_userdata('program_id');
                        $this->session->unset_userdata('package');

                        redirect('admission/view_package');
            }else{
                
                     $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
                     redirect('admission/installments');
            } 
        }


// view student package Form
        
        public function view_package()
        {
            $this->login_check();

            if($_GET['student_id'])
            {
            $student_id                      =   $_GET['student_id'];           
            }else{
                $student_id                  =  $this->session->userdata('student_id');
            }
            $result['std_package']           =   $this->Admission_model->getStudentPackageInfo($student_id);
            
            
            $this->session->set_userdata('package',$result['std_package'][0]['session_total_package']);            
            $this->session->set_userdata($result);            
            
            $result['std_installments']      =   $this->Admission_model->getStudentInstallments($student_id);
                                              
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions/accounts/student_package/view_package', $result);
            $this->load->view('admin_ace/admin_footer');
        }

        
// print challan for installment
        
        public function print_challan()
        {
         
           $this->login_check();
           $amount         = $_GET['amount'];
           $amount_in_word = $this->convert_number_to_words($amount);
           $challan_id     = $_GET['challan_id'];
           $due_date       = $_GET['due_date'];
           $std_package    = $this->session->all_userdata();
           
           $result['challan']   = array(
                                         'amount'           =>$amount,
                                         'amount_in_words'  =>$amount_in_word,
                                         'due_date'         =>$due_date,
                                         'challan_no'       =>$challan_id,
                                         'roll_no'          =>$std_package['std_package'][0]['roll_no'],
                                         'student_name'     =>$std_package['std_package'][0]['student_name'],
                                         'batch'            =>$std_package['std_package'][0]['batch'],
                                         'batch_type'       =>$std_package['std_package'][0]['batch_type'],
                                         'program_name'     =>$std_package['std_package'][0]['program_name'],
                                         'session'          =>$std_package['std_package'][0]['session'],
                                         'bank_name'        =>$std_package['std_package'][0]['bank_name'],
                                         'bank_address'     =>$std_package['std_package'][0]['bank_address'],
                                         'account_no'       =>$std_package['std_package'][0]['account_no'],
                                         'bank_city'        =>$std_package['std_package'][0]['bank_city']
                                         
                                        );
          
            $this->load->view('admissions/accounts/student_package/challan', $result);
        }
        
        
        // convert numbers into words 
        
        public function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Tourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Sighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }




// ******>>>>         Start functions for Student Pakage        <<<<******  //
  
  
  
  
  
  
  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */