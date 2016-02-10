<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Studentoffice extends CI_Controller {

    public function __construct() {

    parent::__construct();

    
    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Accounts_model');
    $this->load->model('Examination_model');
    $this->load->model('Studentoffice_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {

    $this->load->view('studentoffice/login');
  }
  
  
     
  // for verification of admin login

  public function login_check(){
            
            if ($this->session->userdata('sub_login_id') == '' || $this->session->userdata('sub_login') == '' || $this->session->userdata('account_role_id') != 8) {
              redirect('studentoffice/index');
         }
        }
  
    public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('studentoffice/login');
    } else {

      $this->load->library('encrypt');

      $encrypted_password = $this->encrypt->sha1($_POST['password']);
      
      $login_data = array(
          'sub_login'    => $_POST['username'],
          'sub_password' => $encrypted_password,
      );

      $account_role_id      =   $_POST['account_role_id'];
      
      $result = $this->Studentoffice_model->adminLogin($login_data);
      

      if($account_role_id == $result->account_role_id)
      {
      
                if ($result) {

                  $sessionData = array(
                      'sub_login'             => $result->sub_login,
                      'sub_login_id'          => $result->sub_login_id,
                      'employee_id'           => $result->employee_id,
                      'campus_id'             => $result->campus_id,
                      'account_role_id'       => $result->account_role_id,
                      'role'                  => $result->role
                  );

                  $this->session->set_userdata($sessionData);
                  redirect('studentoffice/dashboard');
                } else {

                  $this->session->set_userdata('error', 'Incorrect Username OR Password');
                  redirect('studentoffice/index');
                }
      }else{
                 $this->session->set_userdata('error', 'Please Login from Your Own login..');
                 redirect('studentoffice/index');
          
      }
    }
  }
  
  
  
   // for change password
  
  public function change_password_form()
  {
      $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin_ace/changepassword');
        $this->load->view('admin_ace/admin_footer');
  }
  
  // for change password
  
  public function change_password()
  {
      $this->login_check();
      $old_pass         =   $_POST['old_pass'];
      $new_pass         =   $_POST['new_pass'];
      
      $this->load->library('encrypt');
      $old_password = $this->encrypt->sha1($old_pass);
      $new_password = $this->encrypt->sha1($new_pass);
      
      $result       =   $this->Admission_r_model->ChangePass($old_password,$new_password);
      if($result){
                $this->session->set_userdata('error', 'Password Successfully Changed.');
                 redirect('studentoffice/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('studentoffice/change_password_form');
      }
      
  }

   // for admin logout 
  public function logout() {
      $this->login_check();

    $this->session->unset_userdata('sub_login');
    $this->session->unset_userdata('sub_login_id');
    $this->session->unset_userdata('employee_id');
    $this->session->unset_userdata('campus_id');
    $this->session->sess_destroy();
    redirect('studentoffice/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
      
        
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/studentoffice_side_menu');
    $this->load->view('studentoffice/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }

  
  //  *******************  FOR EXAMINATION  ***************************** //
  
   public function search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/studentoffice_side_menu');
        $this->load->view('studentoffice/reports/search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info($roll_no);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('studentoffice/search_result');
        }
       
        $this->load->view('studentoffice/reports/resultcard',$result);
        
    }
    
    public function req_search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/studentoffice_side_menu');
        $this->load->view('studentoffice/reports/req_search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function req_student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $semester               =   $_POST['semester'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info_req($roll_no,$semester);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('studentoffice/req_search_result');
        }
       
        $this->load->view('studentoffice/reports/req_resultcard',$result);
        
    }
    
    public function rang_search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/studentoffice_side_menu');
        $this->load->view('studentoffice/reports/rang_search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function rang_student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $semester               =   $_POST['semester'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info_rang($roll_no,$semester);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('studentoffice/rang_search_result');
        }
       
        $this->load->view('studentoffice/reports/rang_resultcard',$result);
        
    }
  
    
    //  *******************  FOR EXAMINATION ENDDDDDDDDDDDDDDDDDDD  ***************************** //
  
    
    
    //  *******************  FOR STUDENT OFFICE  ***************************** //
    
     public function search_form()
    {
      
      $this->login_check();
      
            if($_POST)
            {
                    $formNo     =     $_POST['form_no'];                                
                    $roll_no    =     $_POST['roll_no'];                                
                    $challan_no =     $_POST['challan_no'];   
                    
                    if($formNo != '' || $roll_no != '')
                    {
                        $res            =       $this->Accounts_model->getUserId($formNo, $roll_no);
                        $student_id     =       $res[0]['student_id'];
                    }elseif ($challan_no != '') {                
                        $res            =       $this->Accounts_model->getStudentId($challan_no);
                        $student_id     =       $res->student_id;
                    }
                    
                    //echo $student_id = $res[0]['student_id'];die;
                    $student_package    =    $this->Accounts_model->checkPackage($student_id);
                   
                    if($res){
                                redirect('studentoffice/view_package/?student_id='.$student_id);                                
                    }else{                    
                            $this->session->set_userdata('error_msg','Record Not Found, Please try Another!');
                            redirect('studentoffice/search_form');
                    }
                
            }else{
     
              $this->load->view('admin_ace/admin_header');
              $this->load->view('admin_ace/studentoffice_side_menu');
              $this->load->view('studentoffice/searchform');            
              $this->load->view('admin_ace/admin_footer');
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
           $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
           
//           echo '<pre>';print_r($result);die;
           $program_id                       =  $result['std_package'][0]['program_id'];
           $campaign_id                       =  $result['std_package'][0]['campaign_id'];
           
           $res                               = $this->Admin_model->getAllcampaigns();
           
            $result['student_campaign_id']             =  $result['std_package'][0]['campaign_id'];
            $result['current_campaign_id']             =  $res[0]['campaign_id'];
             
            $this->session->set_userdata('package',$result['std_package'][0]['session_total_package']);

            $this->session->set_userdata($result);
            
            $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
            
            $result['challan']               =   $this->Accounts_model->getChallanInfoStudent($program_id,$campaign_id,$student_id);
            
           //echo '<pre>';print_r($result['challan']);die;
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/studentoffice_side_menu');
            $this->load->view('studentoffice/view_package', $result);
            $this->load->view('admin_ace/admin_footer');
        }
        
        
         // get form to be edited
        
        public function edit_studentform()
        {
            $this->login_check();
            
            //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
            
            $student_id                     = array('student_id' => $_GET['student_id']);
                        
            $result['sessions']             = $this->Admin_model->getAllSessions();
            $result['batches']              = $this->Admin_model->getAllbatches();
            $result['sections']             = $this->Admin_model->getAllsections();
            $result['programs']             = $this->Admin_model->getAllprograms();
            $result['cities']               = $this->Admin_model->getAllcities();
            $result['institutes']           = $this->Admin_model->getAllInstitutes();
            $result['student']              = $this->Admission_r_model->getStudentForm($student_id);
      
           // echo '<pre>';var_dump($result['student']);die;
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/studentoffice_side_menu');
            $this->load->view('studentoffice/editform',$result);
            $this->load->view('admin_ace/admin_footer');
            
        }
        
        
        
        
         // save form data into student and form table
        
        public function update_studentform()
        {             
            $this->login_check();
            
            
            
            $this->form_validation->set_rules('form_no', 'Form No ', 'required');
            //$this->form_validation->set_rules('roll_no', ' Roll No', 'required');
            $this->form_validation->set_rules('current_session', ' Current Session', 'required');
            $this->form_validation->set_rules('enrolment_session', ' Enrolment Session', 'required');
            $this->form_validation->set_rules('shift', 'Shift ', 'required');
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

                                          
                        $student_id     =   $_POST['student_id'];                                           
                        
                        $result['sessions']             = $this->Admin_model->getAllSessions();
                        $result['batches']              = $this->Admin_model->getAllbatches();
                        $result['sections']             = $this->Admin_model->getAllsections();
                        $result['programs']             = $this->Admin_model->getAllprograms();
                        $result['cities']               = $this->Admin_model->getAllcities();
                        $result['institutes']           = $this->Admin_model->getAllInstitutes();
                        $result['student']              = $this->Admission_r_model->getStudentForm($student_id);

                       // echo '<pre>';var_dump($result['student']);die;

                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/studentoffice_side_menu');
                        $this->load->view('studentoffice/editform',$result);
                        $this->load->view('admin_ace/admin_footer');
                       
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
                                                'operator_id'=>$this->session->userdata('sub_login_id'),
                                                //'campus_id'=>0,
                                                'student_name'=>$_POST['name'],
                                                'father_name'=>$_POST['father_name'],
                                                'gender'=>$_POST['gender'],
                                                'marital_status'=>$_POST['marital_status'],
                                                'form_submit_date'=>date('Y-m-d'),
                                                //'inquiry_id'=>0,

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
                       $result          =  $this->Admission_r_model->updateForm($student_data,$form_data,$form_id,$student_id);
                       if($result)
                       {
                           $this->session->set_userdata('success_msg','Student Info Updated Successfully');
                           redirect('studentoffice/view_package/?student_id='.$student_id);
                       }else{
                            $this->session->set_userdata('error_msg','Student Info  Not Updated, Please try again! ');
                            redirect('studentoffice/view_package/?student_id='.$student_id);                       
                       }
                
            
            }
        }
        
        
        
        
    
     public function view_form_student_info($id = null)
        {
          $this->login_check();
         //echo $id;die;
          
          $result['form_data'] = $this->Accounts_model->form_info($id);
          
          //echo '<pre>';var_dump($result['form_data']);die;
          
          $result['sessions']             = $this->Admin_model->getAllSessions();
          //$result['batches']              = $this->Admin_model->getAllbatches();
          $result['sections']             = $this->Admin_model->getAllsections();
          $result['programs']             = $this->Admin_model->getAllprograms();
          $result['campuses']             = $this->Admin_model->getAllCampuses();
          //$result['institutes']           = $this->Admin_model->getAllInstitutes();
          
          $result['student_id']           =     $id;
          
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/studentoffice_side_menu');
          $this->load->view('studentoffice/view_form_student_info', $result);
          $this->load->view('admin_ace/admin_footer');
          
        }
        
       function update_student_form_info(){
            $this->login_check();
            
            $student_id         = $_POST['student_id'];
            
            
            $old_shift          = $_POST['old_shift'];
            $old_program_id     = $_POST['old_program_id'];
            $old_campus_id      = $_POST['old_campus_id'];
            
            if($old_shift == $_POST['shift'] && $old_program_id == $_POST['program'] && $old_campus_id == $_POST['campus'])
            {
                    $this->session->set_userdata('success_msg','No Change Observed in Record!');                    
                    redirect('studentoffice/view_student_form');
                 
            }
            
            $program                = $this->Admission_r_model->getProgramCode($_POST['program']);
            $program_code           = $program->program_code;         
            
            $campaign               = $this->Admission_r_model->getCampaignCode($_POST['campaign_id']);
            $campaign_code          = $campaign->campaign_code;
            
            $campus                 = $this->Admission_r_model->getCampusCode($_POST['campus']);
            $campus_code            = $campus->campus_code;
            
            $last_initial_form      = $this->Admission_r_model->getLastinitialFormId($_POST['program'],$_POST['campus'],$_POST['shift'],$_POST['campaign_id']);
            
            //echo '<pre>';var_dump($last_initial_form);var_dump($_POST);echo '</pre>';echo '<pre>';var_dump($this->session->userdata('role'));
            
            
            $shift                  = substr($_POST['shift'], 0,1);
            
            $next_initial_form_id   = $last_initial_form->serial+1;
            
            $form_no                = $program_code.'-'.$campaign_code.'-'.$campus_code.'-'.$shift.$next_initial_form_id;
            

            $duplication_check = $this->Admission_r_model->checkformNoDuplication($form_no);
            
            if($duplication_check){
                $this->session->set_userdata('success_msg','Duplicated Record Found, Try again!');
                
                 redirect('studentoffice/view_student_form');
               
            }
    
            // For Form 
            $result1       =  $this->Admission_r_model->form_info_update(
                                    $form_no,$_POST['shift'],$_POST['program'],$_POST['campus'],$_POST['inquiry_id'],$_POST['form_id']
                                );
            
            // For Initial Form 
            $result2       =  $this->Admission_r_model->initial_form_info_update(
                                    $form_no,$_POST['shift'],$_POST['program'],$_POST['campus'],$_POST['inquiry_id'],$next_initial_form_id
                                );
            
            // For Student
            $result3       =  $this->Admission_r_model->student_update(
                                    $form_no,$_POST['shift'],$_POST['form_id']
                                );
            
            if( $result1  && $result2 && $result3)
            {
                
                    $delete_package         =   $this->Accounts_model->deletePackage($student_id);
                    $delete_roll_no         =   $this->Accounts_model->deleteRollNo($student_id);
                
                    if($delete_package && $delete_roll_no){
                        $this->session->set_userdata('success_msg','Student Form updated Successfully ');
                        redirect('studentoffice/view_package/?student_id='.$student_id);
                    }else{
                        $this->session->set_userdata('success_msg','Package Not Deleted ');
                        redirect('studentoffice/view_student_form');
                    }
                  
            }else{
                $this->session->set_userdata('error_msg','Student Form Info  not updated!');
                redirect('studentoffice/view_student_form');                 
            }
            
        }
        
        
          public function print_all_cards_form()
            {
               $this->login_check();

               $result['campaigns']  = $this->Admin_model->getAllcampaigns2();
               $result['program']    = $this->Admin_model->getAllprograms();

                 $this->load->view('admin_ace/admin_header');
                 $this->load->view('admin_ace/studentoffice_side_menu');
                 $this->load->view('studentoffice/print_allcards_form',$result);            
                 $this->load->view('admin_ace/admin_footer');

            }

            public function print_all_cards()
            {

                $campaign_id    =   $_POST['campaign'];
                $program_id     =   $_POST['program'];

                $result['stdinfo']      =   $this->Studentoffice_model->getStdInfoAll($campaign_id,$program_id);

                 //echo '<Pre>'; var_dump($result);die;
                if(count($result['stdinfo']) > 0){                 
                     $this->load->view('studentoffice/print_allcards',$result); 
                }else{
                     $this->session->set_userdata('error_msg','Record Not Found ');
                     redirect('studentoffice/print_all_cards_form');
                }

            }
            
            public function print_single_std_card_form(){
               
              $this->login_check();
      
              $this->load->view('admin_ace/admin_header');
              $this->load->view('admin_ace/studentoffice_side_menu');
              $this->load->view('studentoffice/searchstudentcard');            
              $this->load->view('admin_ace/admin_footer');
      
            }
            
             public function print_student_card()
            {

                $roll_no    =   $_POST['roll_no'];

                $result['stdinfo']      =   $this->Studentoffice_model->getStdInfo($roll_no);

//                 echo '<Pre>'; var_dump($result);die;
                if(count($result['stdinfo']) > 0){                 
                     $this->load->view('studentoffice/print_allcards',$result); 
                }else{
                     $this->session->set_userdata('error_msg','Record Not Found ');
                     redirect('studentoffice/print_single_std_card_form');
                }

            }
            
            
            
            // for student list program wise (roll no range)
            
            public function student_list_form()
                    {
                        $this->login_check();
                        
                        $result['program']  = $this->Admin_model->getAllprograms();
                        $result['campaign'] = $this->Admin_model->getAllcampaigns2();

                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/studentoffice_side_menu');
                        $this->load->view('studentoffice/stdlistform', $result);
                        $this->load->view('admin_ace/admin_footer');
                    }


            public function student_list()
                    {
                        $this->login_check();

                        $campaign_id          =   $_POST['campaign'];      
                        $program_id           =   $_POST['program'];      
                        $shift                =   $_POST['shift'];
                        $campus_id            =    3;


                       $result['address_report']     =   $this->Studentoffice_model->getStdList($campaign_id,$campus_id,$program_id,$shift);        

                       $result['campus_id']          =   $campus_id;

                       $this->load->view('admin_ace/admin_header');      
                       $this->load->view('studentoffice/stdlistView',$result);
                       $this->load->view('admin_ace/admin_footer');
                    }
                    
                public function get_program_info()
                    {

                     // $this->login_check();

                        $type   =   $_POST['type'];
                        $result['program']  =   $this->Admission_r_model->getProgramInfo($type);
                        $this->load->view('studentoffice/progPartial', $result);

                    }
                    
              public function get_RollNo_list(){
        
                    $campaign_id        =   $_POST['campaign_id'];
                    $program_id         =   $_POST['program_id'];
                    
                    $result['rollno']         =   $this->Studentoffice_model->getRollNoList($campaign_id,$program_id);

                    $this->load->view('examination/rollno_partial',$result);
                }
            
  
  
                public function fail_std_view()
                    {

                        $this->login_check();

                       if(!empty($_POST))
                        {
                          
                           $campaign_id             =    $_POST['campaign'];

                           $result['stdinfo']       =   $this->Studentoffice_model->getFailStdInfo($campaign_id);

                           $result['campaign']       = $this->Admin_model->getAllcampaigns2();
                           $result['campaign_id']   =  $campaign_id;

                           $this->load->view('admin_ace/admin_header');
                           $this->load->view('admin_ace/studentoffice_side_menu');
                           $this->load->view('studentoffice/failstdView', $result);
                           $this->load->view('admin_ace/admin_footer');


                        }else{

                            $result['campaign']       = $this->Admin_model->getAllcampaigns2();

                            $campaign_id            =   $result['campaign'][0]['campaign_id'];

                            $result['stdinfo']      =   $this->Studentoffice_model->getFailStdInfo($campaign_id);

                            $result['campaign_id']  =   $campaign_id;


                            $this->load->view('admin_ace/admin_header');
                            $this->load->view('admin_ace/studentoffice_side_menu');
                            $this->load->view('studentoffice/failstdView', $result);
                            $this->load->view('admin_ace/admin_footer');
                        }
                    }  

    
    //  *******************  FOR  STUDENT OFFICE ENDDDDDDDDDDDDDDDDDDD  ***************************** //
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */