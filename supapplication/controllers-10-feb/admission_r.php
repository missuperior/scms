<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_r extends CI_Controller {

    public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Admission_reports_model');
    $this->load->model('Manager_model');
    $this->load->model('Entrytest_model');
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('smsapi');
    $this->load->library('form_validation');
    }    
    
  
  // Login for Admissions
  public function index() {

    $this->load->view('admissions_r/login');
  }
  
  
     
  // for verification of admin login

  public function login_check() {
     
            if ($this->session->userdata('sub_login_id') == '' || $this->session->userdata('sub_login') == '' || $this->session->userdata('account_role_id') != 3) {
                redirect('admission_r/index');
          }
    }
  
  
  
  // check the right of user
  
  public function check_user_rights($employee_id,$action)
  {
      
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD'){
      $rights_data      =   array('employee_id' => $employee_id,'module_name'=>$action);
      $result           =   $this->Admission_r_model->checkRights($rights_data);
      
      if(!$result){
           $this->session->set_userdata('error', 'Sorry, You are not allowed to perform this action.');
           redirect('admission_r/dashboard');
      }
      }
  }
  
  
   public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admissions_r/login');
    } else {

      $this->load->library('encrypt');

      $encrypted_password = $this->encrypt->sha1($_POST['password']);
      
      $login_data = array(
          'sub_login'    => $_POST['username'],
          'sub_password' => $encrypted_password,
      );

      $account_role_id      =   $_POST['account_role_id'];
      
      $result = $this->Admission_r_model->adminLogin($login_data);
      

      if($account_role_id == $result->account_role_id)
      {
      
                if ($result) {

                // get cureent campaign id 
                    
                  $campaign            = $this->Admission_r_model->getOpenCampaign();
                  $campaign_id         = $campaign->campaign_id;
                    
                  $sessionData = array(
                      'sub_login'             => $result->sub_login,
                      'sub_login_id'          => $result->sub_login_id,
                      'employee_id'           => $result->employee_id,
                      'campus_id'             => $result->campus_id,
                      'account_role_id'       => $result->account_role_id,
                      'role'                  => $result->role,
                      'campaign_id'           => $campaign_id
                  );

                  $this->session->set_userdata($sessionData);
                  redirect('admission_r/dashboard');
                } else {

                  $this->session->set_userdata('error', 'Incorrect Username OR Password');
                  redirect('admission_r/index');
                }
      }else{
                 $this->session->set_userdata('error', 'Please Login from Your Own login..');
                 redirect('admission_r/index');
          
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
                 redirect('admission_r/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('admission_r/change_password_form');
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
    redirect('admission_r/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
    
    $campaign            = $this->Admission_r_model->getOpenCampaign();
      
    $campaign_id         = $campaign->campaign_id;
    
    $result['campaign']                 =   $campaign->campaign_name;        
    
    
//    $result['inquiry_without_pros']     =   $this->Admission_r_model->getinquiries();
//    $result['pros_without_initial']     =   $this->Admission_r_model->getprospectus();
//    $result['initial_without_detail']   =   $this->Admission_r_model->getinitial();
     $result['forms_without_student']    =   $this->Admission_r_model->getforms();
   
    
    // total amount from table 
    $result['inquiries']                =   $this->Admission_r_model->inquiries();        
    $result['online']                   =   $this->Admission_r_model->onlineinquiries();
    //print_r($result['inquiries']);die;
    $result['prospectus']               =   $this->Admission_r_model->prospectus();
    
    
    $result['initial']                  =   $this->Admission_r_model->initial();     
    $result['detailed']                 =   $this->Admission_r_model->detailed();
    $result['student']                  =   $this->Admission_r_model->student();
   
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/dashboard', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
  
  // Dashboard Quick Search
  
  public function quick_search(){
      
      
      $this->login_check();
      
      
      require_once('admission_reports.php');      
      $admission_report =   new Admission_reports();
      
      $search_type      =   $_POST['type'];
      
      if($search_type == 1)
      {
            if($_POST['inquiry']){          
                $admission_report->search_inquiry_no($_POST['inquiry_no']);
            }elseif ($_POST['form']) {
                $admission_report->search_form_no($_POST['form_no']);
            }elseif($_POST['mobile']){
                $admission_report->search_mobile_no($_POST['mobile_no']);
            }
            
      }elseif($search_type == 2){
          
            if($_POST['inquiry']){   
                
               $res                    =    $this->Admission_r_model->getInquiryId($_POST['inquiry_no']);
               $inquiry_id             =    $res->inquiry_id;
               $prospectus_sale        =    $res->prospectus_sale;
               
               if($prospectus_sale == 0){
                   redirect('admission_r/sale_prospectus_form/?inquiry_id='.$inquiry_id);
               }elseif($prospectus_sale == 1) {
                 
                    $result['prospectus'] = $this->Admission_r_model->getSingleprospectus($inquiry_id);
        
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/prospectus/viewprospectus', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }
            }elseif ($_POST['form']) {
                
               $res                    =    $this->Admission_reports_model->getInqId($_POST['form_no']);
               
               $inquiry_id             =    $res[0]['inquiry_id'];
               
                $result['prospectus'] = $this->Admission_r_model->getSingleprospectus($inquiry_id);

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/prospectus/viewprospectus', $result);
                $this->load->view('admin_ace/admin_footer');
                 
                
            }elseif($_POST['mobile']){
                
                $res                 =    $this->Admission_reports_model->getInqId2($_POST['mobile_no']);
        
                $inquiry_id             =    $res->inquiry_id;
                $prospectus_sale        =    $res->prospectus_sale;
                
                if($prospectus_sale == 0){
                   redirect('admission_r/sale_prospectus_form/?inquiry_id='.$inquiry_id);
               }elseif($prospectus_sale == 1) {
                 
                    $result['prospectus'] = $this->Admission_r_model->getSingleprospectus($inquiry_id);
        
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/prospectus/viewprospectus', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }             
            }
          
      }elseif($search_type == 3){
          
            if($_POST['inquiry']){   
                
               $res                    =    $this->Admission_r_model->getInquiryId($_POST['inquiry_no']);
               $inquiry_id             =    $res->inquiry_id;
               $admission_stage        =    $res->admission_stage;
               $prospectus_sale        =    $res->prospectus_sale;
               
               $res2                   =    $this->Admission_r_model->getInitialFormId2($inquiry_id);
               $initial_form_id        =    $res2->initial_form_id;
               
               if($admission_stage == 0 && $prospectus_sale == 1){
                   redirect('admission_r/add_initial_form/?inquiry_id='.$inquiry_id);
               }elseif($admission_stage == 1 && $prospectus_sale == 1){
                   $result['initial_form'] = $this->Admission_r_model->getSingleInitialForms($inquiry_id);    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');    
                    $this->load->view('admissions_r/initial_form/view_initial_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
               }
               elseif($admission_stage == 2) {
                 
                    $result['initial_form'] = $this->Admission_r_model->getSingleInitialForms($inquiry_id);    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');    
                    $this->load->view('admissions_r/initial_form/view_initial_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }elseif($admission_stage == 3){
                   $result['form_data'] = $this->Admission_r_model->getSingleStudentForms($inquiry_id);                    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/form/view_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
               }
            }elseif ($_POST['form']) {
                
                $res                    =    $this->Admission_reports_model->getInqId($_POST['form_no']);
                $inquiry_id             =    $res[0]['inquiry_id'];
               
                $result['initial_form'] = $this->Admission_r_model->getSingleInitialForms($inquiry_id);    
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');    
                $this->load->view('admissions_r/initial_form/view_initial_forms', $result);
                $this->load->view('admin_ace/admin_footer');

                
            }elseif($_POST['mobile']){
                
                $res                 =    $this->Admission_reports_model->getInqId2($_POST['mobile_no']);
        
                $inquiry_id             =    $res->inquiry_id;
               
                $result['initial_form'] = $this->Admission_r_model->getSingleInitialForms($inquiry_id);    
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');    
                $this->load->view('admissions_r/initial_form/view_initial_forms', $result);
                $this->load->view('admin_ace/admin_footer');
                                  
            }
          
      }elseif($search_type == 4){
           
            if($_POST['inquiry']){   
               
               $res                    =    $this->Admission_r_model->getInquiryId($_POST['inquiry_no']);
               $inquiry_id             =    $res->inquiry_id;
               $admission_stage        =    $res->admission_stage;
               $prospectus_sale        =    $res->prospectus_sale;
               
               $res2                   =    $this->Admission_r_model->getInitialFormId2($inquiry_id);
               $initial_form_id        =    $res2->initial_form_id;
               
               if($admission_stage == 2){                   
                   redirect('admission_r/form/?initial_form_id='.$initial_form_id);
               }elseif($admission_stage == 3 ) {                   
                    $result['form_data'] = $this->Admission_r_model->getSingleStudentForms($inquiry_id);                    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/form/view_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }elseif($admission_stage == 1 || $admission_stage == 0){
                   $this->session->set_userdata('error','Record Not Found In Detailed Forms ');
                   redirect('admission_r/dashboard');
               }
            }elseif ($_POST['form']) {
                
                $res                    =    $this->Admission_reports_model->getInqId($_POST['form_no']);                
                $inquiry_id             =    $res[0]['inquiry_id'];
                $admission_stage        =    $res[0]['admission_stage'];
                
                $res2                   =    $this->Admission_r_model->getInitialFormId2($inquiry_id);
                $initial_form_id        =    $res2->initial_form_id;
                
                if($admission_stage == 1){                   
                   redirect('admission_r/form/?initial_form_id='.$initial_form_id);
               }elseif($admission_stage == 2 || $admission_stage ==3 ) {                   
                    $result['form_data'] = $this->Admission_r_model->getSingleStudentForms($inquiry_id);                    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/form/view_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }elseif($admission_stage == 0){
                   $this->session->set_userdata('error','Record Not Found In Detailed Forms ');
                   redirect('admission_r/dashboard');
               }

                
            }elseif($_POST['mobile']){
                
                $res                    =    $this->Admission_reports_model->getInqId2($_POST['mobile_no']);       
                $inquiry_id             =    $res->inquiry_id;
                $admission_stage        =    $res->admission_stage;
                
                $res2                   =    $this->Admission_r_model->getInitialFormId2($inquiry_id);
                $initial_form_id        =    $res2->initial_form_id;
                
                if($admission_stage == 1){                   
                   redirect('admission_r/form/?initial_form_id='.$initial_form_id);
               }elseif($admission_stage == 2 || $admission_stage ==3 ) {                   
                    $result['form_data'] = $this->Admission_r_model->getSingleStudentForms($inquiry_id);                    
                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/admin_side_menu');
                    $this->load->view('admissions_r/form/view_forms', $result);
                    $this->load->view('admin_ace/admin_footer');
                   
               }elseif($admission_stage == 0){
                   $this->session->set_userdata('error','Record Not Found In Detailed Forms ');
                   redirect('admission_r/dashboard');
               }
                                  
            }
          
      }
      
  }

    
 //  *****    Start Functions for Inquiry Module   *****  //       
  // Form to Add Inquiry 

  public function add_inquiry_form() {

  
    $this->login_check();
    //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
    
    $result['campus'] = $this->Admin_model->getAllCampuses();
    $result['campaign'] = $this->Admin_model->getAllcampaigns();
    $result['reference'] = $this->Admin_model->getAllreferences();
    $result['institute'] = $this->Admin_model->getAllInstitutes();
    $result['program'] = $this->Admin_model->getAllprograms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/inquiry/addinquiry', $result);
    //$this->load->view('admissions_r/inquiry/inquiryform', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Inquiry in database

  public function add_inquiry() {

    $this->login_check();
   
    
    $this->form_validation->set_rules('campaign', ' Campaign ', 'required');
    $this->form_validation->set_rules('name', ' Name ', 'required');
    $this->form_validation->set_rules('contact', ' Contact ', 'required');    
    $this->form_validation->set_rules('program', ' Program ', 'required');
    $this->form_validation->set_rules('shift', ' Shift ', 'required');
    $this->form_validation->set_rules('gender', ' Gender ', 'required');
    $this->form_validation->set_rules('qualification', ' Qualification ', 'required');
    $this->form_validation->set_rules('obtained_marks', ' Obtained Marks ', 'required');
    $this->form_validation->set_rules('total_marks', ' Total Marks ', 'required');
    $this->form_validation->set_rules('reference', ' Reference ', 'required');
    $this->form_validation->set_rules('inquiry_type', 'Inquiry Type ', 'required');
    $this->form_validation->set_rules('institute', 'Institute  ', 'required');    
    
    

    if ($this->form_validation->run() == FALSE) {

      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admin_model->getAllcampaigns();
      $result['reference'] = $this->Admin_model->getAllreferences();
      $result['institute'] = $this->Admin_model->getAllInstitutes();
      $result['program'] = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');    
      $this->load->view('admissions_r/inquiry/addinquiry', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
      if($this->session->userdata('role') == 'HOD')
      {
          $campus_id      = $_POST['campus'];   
      }else{
          $campus_id      = $this->session->userdata('campus_id');   
      }
      
      if($campus_id == 0)
      {
          $this->session->set_userdata('error_msg', 'Please Select Campus , then Try Again');
          redirect('admission_r/add_inquiry_form');
      }
      
      
   
      $campaign           = $this->Admission_r_model->getCampaignCode($_POST['campaign']);
      $campaign_code      = $campaign->campaign_code;
           
      //$campus             = $this->Admission_r_model->getCampusCode($_POST['campus']);
      $campus             = $this->Admission_r_model->getCampusCode($campus_id);
      $campus_code        = $campus->campus_code;
            
      $last_inquiry_id    = $this->Admission_r_model->getLastInquiryId();
      $next_inquiry_id    = $last_inquiry_id->inquiry_id+1;
      
      $inquiry_no         = $campus_code.'-'.$campaign_code.'-'.$next_inquiry_id;
      
      if($_POST['result_waiting']!= '')
      {
          $obtained_marks = $_POST['result_waiting'];
      }else{
          $obtained_marks = $_POST['obtained_marks'];
      }
      if(empty($obtained_marks))
      {
          $this->session->set_userdata('error_msg', 'Please Select Obtained Marks, then Try Again');
          redirect('admission_r/add_inquiry_form');
      }
      
      
      
      
      
    
      // Check Inquiry Already Existance
      $check_inquiry = array(
          'name'       => $_POST['name'],
          'contact'    => $_POST['contact'],
          'program_id' => $_POST['program']          
      );

      
      $mobile             =     $_POST['contact'];
      
      $inquiry_type       =     $_POST['inquiry_type'];
      $name               =     $_POST['name'];

      
      $res = $this->Admission_r_model->checkInquiry($check_inquiry);
      if($res)
      {
        $this->session->set_userdata('error_msg', 'Name, Contact, Program Already Exist');
        
        $result['campus'] = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admin_model->getAllcampaigns();
        $result['reference'] = $this->Admin_model->getAllreferences();
        $result['institute'] = $this->Admin_model->getAllInstitutes();
        $result['program'] = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');    
        $this->load->view('admissions_r/inquiry/addinquiry', $result);
        $this->load->view('admin_ace/admin_footer');     
      }
      
      else
      {
        $inquiry_data = array(
          'inquiry_no' => $inquiry_no,
          'campaign_id' => $_POST['campaign'],
          'name' => $name,
          'contact' => $mobile,
          'phone' => $_POST['phone'],
          'program_id' => $_POST['program'],
          'shift' => $_POST['shift'],
          'gender' => $_POST['gender'],
          'qualification' => $_POST['qualification'],
          'total_marks' => $_POST['total_marks'],
          'obtained_marks' => $obtained_marks,
          'reference_id' => $_POST['reference'],
          'inquiry_type' => $inquiry_type,
          'previous_institute' => $_POST['institute'],
          'remarks' => $_POST['remarks'],
          'operator_id' => $this->session->userdata('sub_login_id'),
          'campus_id' => $campus_id,
          'inquiry_date' => date('Y-m-d')
      );
                     
          $inquiry_id    = $this->Admission_r_model->addInquiry($inquiry_data);
          
          if($inquiry_id)
          {
              // ***** Send SMS to user At inquiry ***** \\
              
                // set the format of mobile num to 923016506016
                 $explode_num     =   explode("-",$mobile);
                 $mobile          =   $explode_num[0].$explode_num[1];
                 $mobile_trim     =   trim($mobile,'0');
                 $number          =   '92'.$mobile_trim;
              
                if($inquiry_type == 'Physical')
                {        
                     // for out station campuses
                    if($this->session->userdata('role') == 'OS')
                    {
                        $msg = "Dear ".$name.",".PHP_EOL."Thanks for visiting Superior.".PHP_EOL."Your Inquiry #:".PHP_EOL."".$inquiry_no." ".PHP_EOL."Bring your inquiry # when you will visit again.".PHP_EOL."Admission Dept.";
                    }else{
                        $msg = "Dear ".$name.",".PHP_EOL."Thanks for visiting Superior.".PHP_EOL."Your Inquiry #:".PHP_EOL."".$inquiry_no." ".PHP_EOL."Bring your inquiry # when you will visit again.".PHP_EOL."Admission Dept.".PHP_EOL."Ph #:04238104221";
                    }
                   // $this->smsapi->sendSMS($number, $msg);
                }
                if($inquiry_type == 'Telephonic')
                {
                    // for out station campuses
                    if($this->session->userdata('role') == 'OS')
                    {
                        $msg = "Dear ".$name.",".PHP_EOL."We appreciate your interest.".PHP_EOL."Your Inquiry #:".PHP_EOL."".$inquiry_no." ".PHP_EOL."For details visit Superior with your inquiry #.".PHP_EOL."Admission Dept.";
                    }else{
                        $msg = "Dear ".$name.",".PHP_EOL."We appreciate your interest.".PHP_EOL."Your Inquiry #:".PHP_EOL."".$inquiry_no." ".PHP_EOL."For details visit Superior with your inquiry #.".PHP_EOL."Admission Dept.".PHP_EOL."Ph #:04238104221";
                    }
                    //$this->smsapi->sendSMS($number, $msg);
                }
              
              
              // ***** Send SMS to user At inquiry ***** \\
              
              
              
              $reference        =   $_POST['reference'];
              if($reference == '13')
                {
                    $reference_data     = array(
                                                'inquiry_id'    =>  $inquiry_id,
                                                'others'        =>  $_POST['new_reference'],
                                                'created_date'  =>  date('Y-m-d')
                                                );
                        $inquiry_reference_id    =   $this->Admission_r_model->addInquiryReference($reference_data);
                        if($inquiry_reference_id){
                            $this->session->set_userdata('success_msg', 'Inquiry Added Successfully');
                            redirect('admission_r/view_inquiries');
                        }
                } 
              else if($reference == '6')
                {
                    $reference_data     = array(
                                                'inquiry_id'    =>  $inquiry_id,
                                                'name'          =>  $_POST['ref_name'],
                                                'designation'   =>  $_POST['ref_designation'],
                                                'campus_id'     =>  $_POST['ref_campus'],
                                                'created_date'  =>  date('Y-m-d')
                                                );
                    
                        $inquiry_reference_id    =   $this->Admission_r_model->addInquiryReference($reference_data);
                        if($inquiry_reference_id){
                            $this->session->set_userdata('success_msg', 'Inquiry Added Successfully');
                            redirect('admission_r/view_inquiries');
                        }
                }else{ 
                            $this->session->set_userdata('success_msg', 'Inquiry Added Successfully');
                            redirect('admission_r/view_inquiries');
                     }
                
          } else {              
            $this->session->set_userdata('error_msg', 'Inquiry Not Added, Please Try Again');
            redirect('admission_r/view_inquiries');
          }
      }
      
      
        //}
      }
      

  // display all the Inquiries

  public function view_inquiries() {
    $this->login_check();
    //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
     
    $result['inquiries'] = $this->Admission_r_model->getAllinquiries();
    
//    echo '<pre>';print_r($result);die;
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/inquiry/viewinquiries', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the record of Inquiry to be edited

  public function edit_inquiry() {
    $this->login_check();
    //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));

    $id = $_GET['inquiry_id'];
    
    $result['inquiry']              = $this->Admission_r_model->getInquiry($id);
    $result['inquiry_reference']    = $this->Admission_r_model->getInquiryReference($id);
    
   // echo '<br><pre>';var_dump($result);die;
    
    $result['campus']               = $this->Admin_model->getAllCampuses();
    $result['campaign']             = $this->Admin_model->getAllcampaigns();
    $result['reference']            = $this->Admin_model->getAllreferences();
    $result['institute']            = $this->Admin_model->getAllInstitutes();
    $result['program']              = $this->Admin_model->getAllprograms();   

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/inquiry/editinquiry', $result);
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
    $this->form_validation->set_rules('program', ' Program ', 'required');
    $this->form_validation->set_rules('shift', ' Shift ', 'required');
    $this->form_validation->set_rules('gender', ' Gender ', 'required');
    $this->form_validation->set_rules('qualification', ' Qualification ', 'required');
    $this->form_validation->set_rules('obtained_marks', ' Obtained Marks ', 'required');
    $this->form_validation->set_rules('reference', ' Reference ', 'required');
    $this->form_validation->set_rules('inquiry_type', 'Inquiry Type ', 'required');
    $this->form_validation->set_rules('institute', 'Institute  ', 'required');
    $this->form_validation->set_rules('remarks', 'Remarks  ', 'required');
    

    if ($this->form_validation->run() == FALSE) {
        
      $result = $this->Admission_r_model->getInquiry($id);
      $result['inquiry'] = $result;

      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admin_model->getAllcampaigns();
      $result['reference'] = $this->Admin_model->getAllreferences();
      $result['institute'] = $this->Admin_model->getAllInstitutes();
      $result['program'] = $this->Admin_model->getAllprograms();   
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');    
      $this->load->view('admissions_r/inquiry/editinquiry', $result);
      $this->load->view('admin_ace/admin_footer');
    }
   
         if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
         }else{
             $campus_id     =   $this->session->userdata('campus_id');
         }
    
      $inquiry_data = array(
          'inquiry_no'      => $_POST['inquiry_no'],
          'campaign_id'     => $_POST['campaign'],
          'name'            => $_POST['name'],
          'contact'         => $_POST['contact'],
          'phone'           => $_POST['phone'],
          'program_id'      => $_POST['program'],
          'shift'           => $_POST['shift'],
          'gender'          => $_POST['gender'],
          'qualification'   => $_POST['qualification'],
          'obtained_marks'  => $_POST['obtained_marks'],
          'reference_id'    => $_POST['reference'],
          'inquiry_type'    => $_POST['inquiry_type'],
          'previous_institute' => $_POST['institute'],
          'remarks'         => $_POST['remarks'],          
          'campus_id'       => $campus_id
          
      );
            
       $result = $this->Admission_r_model->updateInquiry($id, $inquiry_data);
          if($result)
          {
              $reference        =   $_POST['reference'];
              if($reference == '13')
                {
                    $reference_data     = array(
                                                'name'          =>  '',
                                                'designation'   =>  '',
                                                'campus_id'     =>  0,
                                                'others'        =>  $_POST['new_reference']                                              
                                                );
                        $inquiry_reference_id    =   $this->Admission_r_model->updateInquiryReference($id,$reference_data);
                        if($inquiry_reference_id){
                            $this->session->set_userdata('success_msg', 'Inquiry Updated Successfully');
                            redirect('admission_r/view_inquiries');
                        }
                } 
              else if($reference == '6')
                {
                    $reference_data     = array(
                                                'name'          =>  $_POST['ref_name'],
                                                'designation'   =>  $_POST['ref_designation'],
                                                'campus_id'     =>  $_POST['ref_campus'],
                                                'others'        =>  ''                                              
                                                );
                                               
                    
                        $inquiry_reference_id    =   $this->Admission_r_model->updateInquiryReference($id,$reference_data);
                        if($inquiry_reference_id){
                            $this->session->set_userdata('success_msg', 'Inquiry updated Successfully');
                            redirect('admission_r/view_inquiries');
                        }
                } else{
                            $this->session->set_userdata('success_msg', 'Inquiry updated Successfully');
                            redirect('admission_r/view_inquiries');
                }
          
                
          } else {              
            $this->session->set_userdata('error_msg', 'Inquiry Not Updated, Please Try Again');
            redirect('admission_r/view_inquiries');
          }
        //}
      }
   
  
  
  
  
  
   //  *****    Start Functions for Initital Form Module   *****  //      
  // form to Initial Form 

  public function initial_form()
  {
      
      $this->login_check();
      
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/initial_form/add_initial_form');
    $this->load->view('admin_ace/admin_footer'); 
  }
  
  public function search_initial_form()
  {
     
      $this->login_check();
      
                $inquiry_no         = $_POST['inquiry_no'];
                $res                = $this->Admission_r_model->getInquiryId($inquiry_no);
                if($res)
                {
                     $id                = $res->inquiry_id;
                     $result['inquiry'] = $this->Admission_r_model->getInquiry($id); 
                     if($result['inquiry'])
                     {
                         if(!empty($result['inquiry'][0]['prospectus_id'])){
                       
                                $result['campus']  = $this->Admin_model->getAllCampuses();    
                                $result['program'] = $this->Admin_model->getAllprograms();   
                                $this->load->view('admin_ace/admin_header');
                                $this->load->view('admin_ace/admin_side_menu');
                                $this->load->view('admissions_r/initial_form/add_initial_form2', $result);
                                $this->load->view('admin_ace/admin_footer');
                         }else{
                                $this->session->set_userdata('error_msg','Please Process the Prospectus stage first');
                                redirect('admission_r/initial_form');
                         }
                     }else{
                            $this->session->set_userdata('error_msg','Record Not Found Against this Inquiry No. Please try Another!');
                            redirect('admission_r/initial_form');
                     }
                     
                }else{
                     $this->session->set_userdata('error_msg','Record Not Found Against this Inquiry No. Please try Another!');
                     redirect('admission_r/initial_form');
                }
                }
  
  
  
  public function add_initial_form() {

      
      
    $this->login_check();
    //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));

    $id                 = $_GET['inquiry_id'];
    $result['inquiry']  = $this->Admission_r_model->getInquiry2($id);     
    $result['campus']   = $this->Admin_model->getAllCampuses();    
    $result['program']  = $this->Admin_model->getAllprograms();   
          
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/initial_form/add_initial_form2', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
  // add Initial Form in database

  public function add_initial_form_data() {
//    echo "Sorry, Restriction from Examination Department";
  //  die;
    $this->login_check();

    $this->form_validation->set_rules('name', ' Name ', 'required');
    $this->form_validation->set_rules('mobile', ' Mobile ', 'required');
    $this->form_validation->set_rules('program', ' Program ', 'required');
    $this->form_validation->set_rules('shift', ' Shift ', 'required');
    $this->form_validation->set_rules('gender', ' Gender ', 'required');
    $this->form_validation->set_rules('qualification', ' Qualification ', 'required');
    $this->form_validation->set_rules('total_marks', ' Total Marks ', 'required');    
    $this->form_validation->set_rules('obtained_marks', ' Obtained Marks ', 'required');    

    if ($this->form_validation->run() == FALSE) {

            $id = $_GET['inquiry_id'];
            $result['inquiry'] = $this->Admission_r_model->getInquiry($id);

            $result['campus']       = $this->Admin_model->getAllCampuses();
            $result['campaign']     = $this->Admin_model->getAllcampaigns();
            $result['reference']    = $this->Admin_model->getAllreferences();
            $result['institute']    = $this->Admin_model->getAllInstitutes();
            $result['program']      = $this->Admin_model->getAllprograms();   

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/initial_form/add_initial_form2', $result);
            $this->load->view('admin_ace/admin_footer');
    } 
    else {
      
        // ******   Start Generate Form Number ******* //
        
         
        
            if($this->session->userdata('role') == 'HOD'){
                $campus_id     =   $_POST['campus'];
            }else{
                $campus_id     =   $this->session->userdata('campus_id');
            }
        
        
                $program                    = $this->Admission_r_model->getProgramCode($_POST['program']);
                $program_code               = $program->program_code;                
                $campaign                   = $this->Admission_r_model->getCampaignCode($_POST['campaign_id']);
                $campaign_code              = $campaign->campaign_code;
                //$campus                     = $this->Admission_r_model->getCampusCode($_POST['campus']);
                $campus                     = $this->Admission_r_model->getCampusCode($campus_id);
                $campus_code                = $campus->campus_code;               
                $shift                      = substr($_POST['shift'], 0,1);
                
                $last_initial_form          = $this->Admission_r_model->getLastInitialFormId($_POST['program'],$campus_id,$_POST['shift'],$_POST['campaign_id']);
                //echo '<pre>';var_dump($last_initial_form);die;

                $next_initial_form_id       = $last_initial_form->serial+1;

                $form_no                    = $program_code.'-'.$campaign_code.'-'.$campus_code.'-'.$shift.$next_initial_form_id;

               $res                         =   $this->Admission_r_model->checkformNoDuplication($form_no);
               if($res){
                   
                   $last_initial_form          = $this->Admission_r_model->getLastInitialFormId($_POST['program'],$campus_id,$_POST['shift'],$_POST['campaign_id']);
                   $next_initial_form_id       = $last_initial_form->serial+1;
                   $form_no                    = $program_code.'-'.$campaign_code.'-'.$campus_code.'-'.$shift.$next_initial_form_id;
               }
               
               
               
        // ******   End Generate Form Number ******* //
        
        
        $mobile             =       $_POST['mobile'];
        $name               =       $_POST['name'];
                
        
        $inquiry_id        =    $_POST['inquiry_id'];
        $initial_form_data = array(                        
            'inquiry_id'        => $inquiry_id,
            'form_no'           => $form_no,
            'serial'            => $next_initial_form_id,
            'student_name'      => $name,
            'mobile'            => $mobile,
            'program_id'        => $_POST['program'],
            'shift'             => $_POST['shift'],
            'gender'            => $_POST['gender'],
            'qualification'     => $_POST['qualification'],
            'total_marks'       => $_POST['total_marks'],
            'obtained_marks'    => $_POST['obtained_marks'],        
            'campus_id'         => $campus_id,
            'operator_id'       => $this->session->userdata('sub_login_id'),
            'created_date'      => date('Y-m-d')
           
        );
        
        $check  = $this->Admission_r_model->checkInitialDuplication($inquiry_id);
        
    if($check){
                        $this->session->set_userdata('error_msg', 'Record Already Exists');
                        redirect('admission_r/add_initial_form/?inquiry_id='.$inquiry_id);
    }else{
        
        
        $result = $this->Admission_r_model->addInitialForm($initial_form_data,$inquiry_id);

        if ($result) {  
            
                        // ***** Send SMS to user At inquiry ***** \\
              
                            // set the format of mobile num to 923016506016
                             $explode_num     =   explode("-",$mobile);
                             $mobile          =   $explode_num[0].$explode_num[1];
                             $mobile_trim     =   trim($mobile,'0');
                             $number          =   '92'.$mobile_trim;

                             // for out station campuses
                            if($this->session->userdata('role') == 'OS')
                            {
                                $msg = "Dear ".$name.",".PHP_EOL."Your application form has been submitted.".PHP_EOL."Your Form #:".PHP_EOL."".$form_no."".PHP_EOL."Bring Test Card on Test day.".PHP_EOL."Best of Luck.".PHP_EOL."Admission Dept.";                                
                            }else{
                                $msg = "Dear ".$name.",".PHP_EOL."Your application form has been submitted.".PHP_EOL."Your Form #:".PHP_EOL."".$form_no."".PHP_EOL."Bring Test Card on Test day.".PHP_EOL."Best of Luck.".PHP_EOL."Admission Dept.".PHP_EOL."Ph #:04238104221";                                
                            }
                           // $this->smsapi->sendSMS($number, $msg);
                                
                                
                            
                          // ***** Send SMS to user At inquiry ***** \\
            
            
                        $this->session->set_userdata('success_msg', 'Initial Form Added Successfully');
                        redirect('admission_r/view_initial_forms');
        }else{
                        $this->session->set_userdata('error_msg', 'Initial Form Not Added');
                        redirect('admission_r/add_initial_form/?inquiry_id='.$_POST['inquiry_id']);
            }
        }        
     
    }
  }
  
  // view all Initial Form 

  public function view_initial_forms() {
    $this->login_check();
    //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));

    $result['initial_form'] = $this->Admission_r_model->getAllInitialForms();    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');    
    $this->load->view('admissions_r/initial_form/view_initial_forms', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
  
    //---------------End of Initial Form----------------//

    
    
    //   Start function for complete form  ////
    
  
    // search initial form
  
    public function search_form()
    {
        
      $this->login_check();
      
        
            if($_POST)
            {
                $formNo =    $_POST['form_no'];
                $result =    $this->Admission_r_model->getInitialFormId($formNo);

                if($result->initial_form_id)
                {
                    $res =    $this->Admission_r_model->getFormId($formNo);
                    if($res){
                            $this->session->set_userdata('error_msg','Detailed Form Already Submitted, Please try Another!');
                            redirect('admission_r/search_form');
                    }else{
                    
                    $initial_form_id                =   $result->initial_form_id;
                    redirect('admission_r/form/?initial_form_id='.$initial_form_id);
                    }
                }else{
                            $this->session->set_userdata('error_msg','Record Not Found Against this Form No. Please try Another!');
                            redirect('admission_r/search_form');
                     }
                
            }else{
     
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/form/searchform');            
            $this->load->view('admin_ace/admin_footer');
            }
    }


    // Student Complete form
        
        public function form()
        {
            $this->login_check();
            
            // ************ For lock data entry 
            
//            if($this->session->userdata('role') == 'HOD' && ($this->session->userdata('campus_id') == '3' || $this->session->userdata('campus_id') == '1') )
//            {
//                $this->load->view('admin_ace/admin_header');
//                $this->load->view('admin_ace/admin_side_menu');
//                $this->load->view('admissions_r/form/lock_entry');            
//                $this->load->view('admin_ace/admin_footer');
//            }else{
            
            // ************ For lock data entry END
            
                $campaign            = $this->Admission_r_model->getOpenCampaign();            
                $arr                 = explode(' ',$campaign->campaign_name);
                $result['c_year']    = $arr[1];
                               

                 //echo $this->session->userdata('campus_id');die;
                //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));

                $initial_form_id                =   $_GET['initial_form_id'];
                $result['initial']              =   $this->Admission_r_model->getInitialForm($initial_form_id);            

                $result['sessions']             = $this->Admin_model->getAllSessions();
                $result['batches']              = $this->Admin_model->getAllbatches();
                
                $result['sections']             = $this->Admin_model->getAllsections();
                $result['programs']             = $this->Admin_model->getAllprograms();
                $result['cities']               = $this->Admin_model->getAllcities();
                $result['institutes']           = $this->Admin_model->getAllInstitutes();

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/form/addform',$result);            
                $this->load->view('admin_ace/admin_footer');
                
          //}
        }
        
        
        // save form data into student and form table
        
        public function add_studentform()
        {             
            
            //echo "Sorry, Restriction from Examination Department";
            //die;
            $this->login_check();
            
                    
            $this->form_validation->set_rules('form_no', 'Form No ', 'required');
            $this->form_validation->set_rules('shift', ' Shift', 'required');
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
            $this->form_validation->set_rules('guardian_mobile', 'Guardian Mobile ', 'required');
                       
            $this->form_validation->set_rules('emergency_name', 'Emergency Contact Name ', 'required');            
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
                
                     $campaign            = $this->Admission_r_model->getOpenCampaign(); 

                     $result['sessions']            = $this->Admin_model->getAllSessions();
                     $result['batches']             = $this->Admin_model->getCurrentbatches($campaign->campaign_id);
                     $result['sections']             = $this->Admin_model->getAllsections();
                     $result['programs']             = $this->Admin_model->getAllprograms();
                     $result['cities']               = $this->Admin_model->getAllcities();
                     $result['institutes']           = $this->Admin_model->getAllInstitutes();
                        
                     $this->load->view('admin_ace/admin_header');
                     $this->load->view('admin_ace/admin_side_menu');
                     $this->load->view('admissions_r/form/addform',$result);
                       
            } else {
                                      
            $form_no = array('form_no' => $_POST['form_no']);
            $res = $this->Admission_r_model->checkFormNo($form_no);
            if($res)
            {
                 $this->session->set_userdata('error_msg','Form No Already Exists!');
                 redirect('admission_r/form');
            }
            else
                {
                
                 // get session id
                
                    $session_id     =   $this->Admission_r_model->getSessionId($_POST['campaign_name']);
                
                    // enter others for nationality
                    
                    if($_POST['nationality'] != 0)
                    {
                        $natinality = $_POST['nationality'];
                    }else{
                        $natinality = $_POST['new_nationality'];
                    }  
                    
                    if($natinality == '')
                    {
                        $natinality = 'Pakistani';
                    }
                    
                    
                    // enter cgpa 
                    
                    if($_POST['previous_grade'] != 0)
                    {
                        $grade = $_POST['previous_grade'];
                    }else{
                        $grade = $_POST['cgpa'];
                    }
                    
                   
//                    if($this->session->userdata('campus_id') == 1 || $this->session->userdata('campus_id') == 3)
                    if($this->session->userdata('role') == 'OS')
                    {  
                        $campus_id = $_POST['campus_id'];
                    }else{                       
                        
                        $campus_id = 3;
                    }
                    
                    
                    
                        $student_data = array(
                                                'form_no'               =>$_POST['form_no'],                                                
                                                'current_session_id'    =>$session_id,
                                                'enrolled_session_id'   =>$session_id,
                                                'shift'                 =>$_POST['shift'],
                                                'batch_id'              =>$_POST['batch']                                    
                                             );
                       
                        $form_data = array(
                                                'form_no'               =>$_POST['form_no'],
                                                'program_id'            =>$_POST['program'],
                                                'operator_id'           =>$this->session->userdata('sub_login_id'),
                                                'campaign_id'           =>$_POST['campaign_id'],
                                                //'campus_id'             =>$_POST['campus_id'],                                                
                                                'campus_id'             =>$campus_id,                                                                                                
                                                'student_name'          =>$_POST['name'],
                                                'father_name'           =>$_POST['father_name'],
                                                'gender'                =>$_POST['gender'],
                                                'marital_status'        =>$_POST['marital_status'],
                                                'form_submit_date'      =>date('Y-m-d'),
                                                'inquiry_id'            =>$_POST['inquiry_id'],
                                                'dob'                   =>$_POST['dob'],
                                                'shift'                 =>$_POST['shift'],
                                                'nationality'           =>$natinality,
                                                'religion'              =>$_POST['religion'],
                                                'nic_no'                =>$_POST['cnic'],
                                                'mobile'                =>$_POST['mobile'],

                                                'email'                 =>$_POST['email'],
                                                'present_address'       =>$_POST['present_address'],
                                                'present_city_id'       =>$_POST['present_city'],
                                                'permanent_address'     =>$_POST['permanent_address'],
                                                'permanent_city_id'     =>$_POST['permanent_city'],

                                                'guardian_name'         =>$_POST['guardian_name'],                                                                
                                                'guardian_mobile'       =>$_POST['guardian_mobile'],

                                                'emergency_contact_name'    =>$_POST['emergency_name'],                                                                
                                                'emergency_contact_mobile'  =>$_POST['emergency_mobile'],

                                                'kinship_name'              =>$_POST['kinship_name'],                                               
                                                'kinship_rollno'            =>$_POST['kinship_rollno'],

                                                'previous_qualification'    =>$_POST['previous_qualification'],                
                                                'previous_institute'        =>$_POST['previous_institute'],
                                                'previous_rollno'           =>$_POST['previous_rollno'],
                                                'previous_subjects'         =>$_POST['previous_subject'],
                                                'previous_total_marks'      =>$_POST['previous_totalmarks'],
                                                'previous_obtained_marks'   =>$_POST['previous_obtainedmarks'],
                                                'previous_grade'            =>$_POST['previous_grade'],
                                                'previous_degree_year'      =>$_POST['previous_year'],

                                             );

                      // echo '<pre>';print_r($form_data);die;
                        
                        
                       $inquiry_id  = $_POST['inquiry_id']; 
                       $program_id  = $_POST['program']; 
                       $batch_id    = $_POST['batch']; 
                       $student_id =  $this->Admission_r_model->addForm($student_data,$form_data,$inquiry_id);
                       if($student_id)
                       {
                           $this->session->set_userdata('success_msg','Student Form Info  added successfully ');
                           redirect('admission_r/view_student_form');
                       }else{
                            $this->session->set_userdata('error_msg','Student Form Info  Not added, Please try again! ');
                           redirect('admission_r/view_student_form');
                       }
                }
            
            }
        }
        
        public function view_student_form()
        {
          $this->login_check();
          //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
          
          $result['form_data'] = $this->Admission_r_model->getAllStudentForms();
          
          //echo '<pre>';var_dump($result['form_data']);die;
          
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admissions_r/form/view_forms', $result);
          $this->load->view('admin_ace/admin_footer');
          
        }
        
        public function view_form_student_info($id = null)
        {
          $this->login_check();
         
          //$id 
          //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
          
          $result['form_data'] = $this->Admission_r_model->form_info($id);
          
          $result['sessions']             = $this->Admin_model->getAllSessions();
          //$result['batches']              = $this->Admin_model->getAllbatches();
          $result['sections']             = $this->Admin_model->getAllsections();
          $result['programs']             = $this->Admin_model->getAllprograms();
          $result['campuses']               = $this->Admin_model->getAllCampuses();
          //$result['institutes']           = $this->Admin_model->getAllInstitutes();
                    
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admissions_r/form/view_form_student_info', $result);
          $this->load->view('admin_ace/admin_footer');
          
        }
        
       function update_student_form_info(){
            $this->login_check();
            
            $old_shift= $_POST['old_shift'];
            $old_program_id= $_POST['old_program_id'];
            $old_campus_id= $_POST['old_campus_id'];
            
            if($old_shift == $_POST['shift'] && $old_program_id == $_POST['program'] && $old_campus_id == $_POST['campus'])
            {
                    $this->session->set_userdata('success_msg','No Change Observed in Record!');
                    redirect('admission_r/view_student_form/');
                    
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
            

            if($_POST['campus'] == 1 or $_POST['campus'] == 3){
                $campus_id      =   3;
            }else{
                $campus_id      =  $_POST['campus'];
            }
            
            
            
            $duplication_check = $this->Admission_r_model->checkformNoDuplication($form_no);
            
            if($duplication_check){
                $this->session->set_userdata('success_msg','Duplicated Record Found, Try again!');
                
                redirect('admission_r/view_student_form/');                
            }
            $cur_date = date('Y-m-d');
            // For Form 
            $result1       =  $this->Admission_r_model->form_info_update(
                                    $form_no,$_POST['shift'],$_POST['program'],$campus_id,$_POST['inquiry_id'],$_POST['form_id'],$cur_date
                                );
            
            // For Initial Form 
            $result2       =  $this->Admission_r_model->initial_form_info_update(
                                    $form_no,$_POST['shift'],$_POST['program'],$_POST['campus'],$_POST['inquiry_id'],$next_initial_form_id
                                );
            
            // For Student
            $result3       =  $this->Admission_r_model->student_update($form_no,$_POST['shift'],$_POST['form_id'] );
            
            if( $result1  && $result2 && $result3)
            {
                $this->session->set_userdata('success_msg','Student Form updated Successfully ');
                redirect('admission_r/view_student_form/');
                
            }else{
                $this->session->set_userdata('error_msg','Student Form Info  not updated!');
                redirect('admission_r/view_student_form/');                
            }
            
        }

        
        
        // get form to be edited
        
        public function edit_studentform()
        {
            $this->login_check();
            
            //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
            
            $campaign            = $this->Admission_r_model->getOpenCampaign(); 
            
            $student_id                     = array('student_id' => $_GET['student_id']);
                        
            $result['sessions']             = $this->Admin_model->getAllSessions();
            $result['batches']              = $this->Admin_model->getCurrentbatches($campaign->campaign_id);
            $result['sections']             = $this->Admin_model->getAllsections();
            $result['programs']             = $this->Admin_model->getAllprograms();
            $result['cities']               = $this->Admin_model->getAllcities();
            $result['institutes']           = $this->Admin_model->getAllInstitutes();
            $result['student']              = $this->Admission_r_model->getStudentForm($student_id);
      
           // echo '<pre>';var_dump($result['student']);die;
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/form/editform',$result);
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
            $this->form_validation->set_rules('guardian_mobile', 'Guardian Mobile ', 'required');

            $this->form_validation->set_rules('emergency_name', 'Emergency Contact Name ', 'required');
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
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/form/editform',$result);
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
                                                'guardian_mobile'=>$_POST['guardian_mobile'],

                                                'emergency_contact_name'=>$_POST['emergency_name'],                                                                
                                                'emergency_contact_mobile'=>$_POST['emergency_mobile'],

                                                'kinship_name'=>$_POST['kinship_name'],                                               
                                                'kinship_rollno'=>$_POST['kinship_rollno'],

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
                           redirect('admission_r/view_student_form');                           
                       }else{
                            $this->session->set_userdata('error_msg','Student Info  Not Updated, Please try again! ');
                            redirect('admission_r/view_student_form');
                            }
                
            
            }
        }
   
        //   End function for complete form ///
 

// ******>>>>         Start functions for Prospectus   <<<<******  //
  
    
    public function  add_prospectus_form()
    {
        
      $this->login_check();
      
        
            //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
            $result['products'] =  $this->Admin_model->getAllproducts();
            $result['campus'] = $this->Admin_model->getAllCampuses();
        
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/prospectus/add_prospectus', $result);
            $this->load->view('admin_ace/admin_footer');
        
    }
    
    
    
    public function  sale_prospectus_form()
    {
          
      $this->login_check();
        
            $inquiry_id         = $_GET['inquiry_id'];
           
            $result['inquiry']  = $this->Admission_r_model->getInquiryInfo($inquiry_id);
            
            $result['products'] =  $this->Admin_model->getAllproducts();
            $result['campus']   = $this->Admin_model->getAllCampuses();
        
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/prospectus/add_prospectus2', $result);
            $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function  sale_prospectus_form2()
    {
           
      $this->login_check();
       
                $inquiry_no         = $_POST['inquiry_no'];
                $res                = $this->Admission_r_model->getInquiryId($inquiry_no);
                if($res)
                {
                    $inquiry_id         = $res->inquiry_id;
                    $result['inquiry']  = $this->Admission_r_model->getInquiryInfo($inquiry_id);
                
                    if($result)
                    {
                        $result['products'] =  $this->Admin_model->getAllproducts();
                        $result['campus']   = $this->Admin_model->getAllCampuses();

                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/prospectus/add_prospectus2', $result);
                        $this->load->view('admin_ace/admin_footer');
                    
                    }else
                        {                    
                            $this->session->set_userdata('error_msg','Record Not Found Against this Inquiry No. Please try Another!');
                            redirect('admission_r/add_prospectus_form');
                        }
                     
                }else{
                     $this->session->set_userdata('error_msg','Record Not Found Against this Inquiry No. Please try Another!');
                     redirect('admission_r/add_prospectus_form');
                }
                
                
                
               
        
    }
  
  // get product price
    
    public function get_price()
    {      
        
      $this->login_check();
      
        $product_id = $_GET['product_id'];
        $result     =  $this->Admission_r_model->getPrice($product_id);        
        echo     $result->price;
        
    }
  
  // add prospectus data 
    
    public function add_prospectus()
    {
         
      $this->login_check();
        
        $this->form_validation->set_rules('inquiry_no', 'Inquiry #', 'required');
        $this->form_validation->set_rules('product', 'Product', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        

    if ($this->form_validation->run() == FALSE) {
            
            $result['products'] =  $this->Admin_model->getAllproducts();
            $result['campus'] = $this->Admin_model->getAllCampuses();
        
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/prospectus/add_prospectus', $result);
            $this->load->view('admin_ace/admin_footer');
    }else{
        
        if($this->session->userdata('role') == 'HOD'){
            $campus_id      =   $_POST['campus'];
        }else{
            $campus_id      =   $this->session->userdata('campus_id');
        }
        
        // get price of product 
        
        $res                =   $this->Admission_r_model->getPrice($_POST['product']);
        $price              =   $res->price;
        $total_price        =   $price * $_POST['quantity'];
        
        $inquiry_no         = $_POST['inquiry_no'];
        $result             = $this->Admission_r_model->getInquiryId($inquiry_no);
        $inquiry_id         = $result->inquiry_id;
        
        $prospectus_data    =   array(
                                        'inquiry_id'        =>$inquiry_id,
                                        'product_id'        =>$_POST['product'],
                                        'price'             =>$price,
                                        'quantity'          =>$_POST['quantity'],
                                        'total_price'       =>$total_price,
                                        'operator_id'       =>$this->session->userdata('sub_login_id'),
                                        'campus_id'         =>$campus_id,
                                        'sale_date'         =>date('Y-m-d')
                                        
        );
        
        
        
        $result             =   $this->Admission_r_model->addProspectus($prospectus_data,$inquiry_id);
        
        if($result)
                 {  
                        $result         =   $this->Admission_r_model->update($inquiry_id);
                        
                        $this->session->set_userdata('success_msg','Prospectus Info Added Successfully');
                        redirect('admission_r/view_prospectus');
                 }
             else
                 {
                     $this->session->set_userdata('error_msg','Prospectus Info Not Added Successfully, Please Try Again!');
                     redirect('admission_r/add_prospectus_form');
                 }
        
    }      
        
        
    }
    
    
    // View sold prospectuses
    
    public function view_prospectus()
    {        
        $this->login_check();
        //$this->check_user_rights($this->session->userdata('employee_id'),$this->uri->segment(2));
        
        $result['prospectus'] = $this->Admission_r_model->getAllprospectus();
        
        
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admissions_r/prospectus/viewprospectus', $result);
        $this->load->view('admin_ace/admin_footer');
    }
  
  // get program info shift wise
    
    public function get_program_info()
    {
       
      //$this->login_check();
      
        $type   =   $_POST['type'];
        $result['program']  =   $this->Admission_r_model->getProgramInfo($type);
        $this->load->view('admissions_r/inquiry/progPartial', $result);
        
    }
    
    // fill guardian info as in case of emergency info
    
    public function fill_address_info()
    {
      $this->login_check();
      
       $result['address_info']    =   array(
                                            'address'       =>   $_POST['address'],                                            
                                            'city'          =>   $_POST['city']
                                        );
       $result['cities']               = $this->Admin_model->getAllcities();
       
       //echo '<pre>';       print_r($result['address_info']);
              
       $this->load->view('admissions_r/form/partial_address', $result);
        
    }
    // fill guardian info as in case of emergency info
    
    public function fill_emergency_info()
    {
      $this->login_check();
      
       $result['emergency_info']    =   array(
                                            'name'       =>   $_POST['name'],                                            
                                            'mobile'     =>   $_POST['mobile']
                                        );
       $result['cities']               = $this->Admin_model->getAllcities();
       
       
       $this->load->view('admissions_r/form/partial_sameasabove', $result);
        
    }
    
    /* User Management Modules Started              Author: Jamal Ahmed*/


  public function add_user_form() {

    $this->login_check();

    $result['campus'] = $this->Admin_model->getAllCampuses();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/users/adduser', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  public function view_users() {

    $this->login_check();

    $result['users'] = $this->Admission_r_model->getusers_departmentWise();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/users/viiewuser', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  
    public function get_campus_employess()
    {
       
      $this->login_check();
      
        $campus_id   =   $_POST['campus_id'];
        $result['employes']  =   $this->Admission_r_model->getcampusemployee($campus_id);
        $this->load->view('admissions_r/users/employeePartial', $result);
        
    }
    
     public function add_user_data() {

    $this->login_check();

    
    $this->form_validation->set_rules('campus', ' Campaign ', 'required');
    $this->form_validation->set_rules('user_name', ' User Name ', 'required');
    $this->form_validation->set_rules('password', ' Password ', 'required');    
    $this->form_validation->set_rules('employee_id', ' Employee ', 'required');
      
    if ($this->form_validation->run() == FALSE) {

    $result['campus'] = $this->Admin_model->getAllCampuses();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admissions_r/users/adduser', $result);
    $this->load->view('admin_ace/admin_footer');
    } 

         $employee_id = $_POST['employee_id'];
         $check_user    = $this->Admission_r_model->get_user_login($employee_id);
    
        if($check_user){
             $this->session->set_userdata('error_msg', 'User Already Exists.');
             redirect('admission_r/add_user_form');
        }else{
        $this->load->library('encrypt');
        $user_data = array(
          'sub_login' => $_POST['user_name'],
          'sub_password' => $this->encrypt->sha1($_POST['password']),
          'created_date' => date("Y-m-d"),
          'last_login' => date("Y-m-d"),
          'account_role_id' => $_POST['acc_role_id'],
          'sub_status' => '1',
          'employee_id' => $_POST['employee_id'],
          'campus_id' => $_POST['campus'],
      );
     
      $user_login_id    = $this->Admission_r_model->addUserData($user_data);
      if($user_login_id){
      
          foreach($_POST['admission_modules'] as $adm_modules){
              
          $user_modules = array(
          'employee_id' => $employee_id,
          'module_name' => $adm_modules,
          'created_date' => date("Y-m-d")
          );
          $user_module    = $this->Admission_r_model->addUserModule($user_modules);
            }    
      } else {
         
            $this->session->set_userdata('error_msg', 'User Not Added, Please Try Again');
            redirect('admission_r/add_user_form');
          }
          
            $this->session->set_userdata('success_msg', 'user Added Successfully');
            redirect('admission_r/view_users');
        
      }
     
      
     }
     
      public function edit_user($employee_id)
    {
      
      $this->login_check();
      
            $result['employes']  =   $this->Admission_r_model->getEmployeeLoginData($employee_id);
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/users/editUser', $result);
            $this->load->view('admin_ace/admin_footer');
        
    }
    
    
    
    
//    *****************                Entry Test Module              ***************

    
         // get students info room wise for entry test
  
            public function award_list_form()
            {
               
                $this->login_check();
      
                $result['rooms']              = $this->Entrytest_model->getAllrooms();
                 //die('adfl;');
                $result['tests']              = $this->Entrytest_model->getOpentests();                

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/entrytest/awardlistForm', $result);
                $this->load->view('admin_ace/admin_footer');
            }

            // get students info room wise for entry test

            public function award_list()
            {
                $this->login_check();
      
                $room_id              = $_POST['rooms'];
                $tes_id               = $_POST['test'];
                
                $res                  = $this->Admission_r_model->checkEntryTestResult($room_id,$tes_id);
                if(count($res) > 0){
                     $this->session->set_userdata('error_msg', 'Result of this room already exists');
                     redirect('admission_r/award_list_form');
                }
                
                $result['programslist']     =   $this->Entrytest_model->getAllocatedProg($room_id,$tes_id);
                            
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/entrytest/awardlistView', $result);
                $this->load->view('admin_ace/admin_footer');
            }
            
            // add entry result in database
            
            public function add_marks()
            {
                
                $this->login_check();
      
                $form_id                =   $_POST['form_id'];
                $mobile                 =   $_POST['mobile'];
                $room_id                =   $_POST['room_id'];
                $test_id                =   $_POST['test_id'];
                $form_no                =   $_POST['form_no'];
                $program_id             =   $_POST['program'];
                $student_name           =   $_POST['student_name'];
                $marks                  =   $_POST['marks'];
                
                $total                  =   count($form_id);
                
                for($i=0; $i < $total; $i++)
                {
                    
                    $number         =   $mobile[$i];                   
                    $result_data    =   array(
                                                'form_id'           =>      $form_id[$i],
                                                'form_no'           =>      $form_no[$i],
                                                'test_id'           =>      $test_id[$i],
                                                'room_id'           =>      $room_id[$i],
                                                'name'              =>      $student_name[$i],
                                                'program_id'        =>      $program_id[$i],
                                                'marks'             =>      $marks[$i]                                                
                                            );
                    
//                    $check           =   $this->Admission_r_model->CheckResult($form_id[$i]);
//                    if($check){
//                                $this->session->set_userdata('error_msg', 'Result Duplication Not Allowed, Plz try again');
//                                redirect('admission_r/award_list_form');
//                    }else{

                            $result         =   $this->Admission_r_model->addMarks($result_data);
                            if(!$result){
                                        $this->session->set_userdata('error_msg', 'Marks Not Added, Plz try again');
                                        redirect('admission_r/award_list_form');
                            }else{
                                
                               if($marks[$i] != 'a' && $marks[$i] != 'A'){ 
                                   $msg = "Dear Applicant! ".PHP_EOL."Thank you very much for appearing in Superior ".PHP_EOL."Admission Entry Test Today.".PHP_EOL."Your Result will be displayed on website on Monday ".PHP_EOL."14-July-2014 at 10:00 AM".PHP_EOL."You can also download Superior Mobile App from www.superior.edu.pk";                                 
                                   //$this->smsapi->sendSMS($number, $msg);
                               }
                                    
                            }
                  //  }
                }
                
                $this->session->set_userdata('error_msg', 'Marks  Added Successfully');
                redirect('admission_r/view_marks');
              
            }
            
            
            public function showhideResult_form(){ 
            
                $this->login_check();
      
                $result['tests']              = $this->Entrytest_model->getOpentests();                

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/entrytest/showhideResult', $result);
                $this->load->view('admin_ace/admin_footer');
                
            }
            
            public function showhideResult(){           
                $this->login_check();
                $result     =   $this->Admission_r_model->ShowHideResult($_POST['test'],$_POST['status']);
                
                if($result > 0 ){
                    $this->session->set_userdata('error_msg', 'Entry Test Result Uploaded Successfully.');
                    redirect('admission_r/showhideResult_form');                    
                }else{
                    $this->session->set_userdata('error_msg', 'Not Updated.');
                    redirect('admission_r/showhideResult_form');                    
                }
            }
            
            
            
    
    // view marks of entry test
             
            public function view_marks()
            {
                
      $this->login_check();
      
                $result['tests']              = $this->Entrytest_model->getOpentests();                
                $result['marks']              =   $this->Admission_r_model->getallMarks($result['tests'][0]['test_id']);
                                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/entrytest/marksView', $result);
                $this->load->view('admin_ace/admin_footer');
            }
            
            
            // edit entry test result 
            
            public function edit_marks()
            {
                
      $this->login_check();
      
               $id     = $_GET['result_id'];
                
                $result['marks']     =   $this->Admission_r_model->getMarks($id);
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions_r/entrytest/editmarks',$result);
                $this->load->view('admin_ace/admin_footer');
                
                
            }
            
            // update entry test marks
            
            public function  update_marks()
            {
                
      $this->login_check();
      
                $id     = $_POST['result_id'];
                
                $marks  = array('marks'=>$_POST['marks']);
                $result = $this->Admission_r_model->updateMarks($id, $marks);
                if($result)
                {
                    $this->session->set_userdata('error_msg', 'Marks updated Successfully');
                    redirect('admission_r/view_marks');
                }else{
                    $this->session->set_userdata('error_msg', 'Marks not updated ');
                    redirect('admission_r/view_marks');
                }
            }


                // ***   Entry Test Reports Start   *** \\
            
                   // program wise result summary 
            
                   public function result_summary_program_form()
                   {
                        
      $this->login_check();
      
                        $result['tests']              = $this->Entrytest_model->getOpentests();

                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/entrytest/reports/resultsummaryprogramwiseForm', $result);
                        $this->load->view('admin_ace/admin_footer');
                   }
            
                   // program wise result summary 
            
                   public function result_summary_program()
                   {
                        
                        $this->login_check();
      
                        
                        $tes_id                     = $_POST['test'];     
                        $result['result']           =   $this->Admission_r_model->resultSummaryProgram($tes_id);
                        
                        $this->load->view('admin_ace/admin_header');
                        //$this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/entrytest/reports/resultsummaryprogramwiseView', $result);
                        $this->load->view('admin_ace/admin_footer');
                   }
                   
                   // program wise detail report
                   
                   public function program_detail_form()
                   {
                       
      $this->login_check();
      
                       $result['tests']              = $this->Entrytest_model->getOpentests();
                       $result['program']            = $this->Admin_model->getAllprograms();
                       
                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/entrytest/reports/programwiseForm', $result);
                        $this->load->view('admin_ace/admin_footer');
                       
                   }
            
                   // program wise detail report
                   
                   public function program_detail()
                   {
                       
      $this->login_check();
      
                        $test_id            =   $_POST['test'];
                        $program_id         =   $_POST['program'];
                        $status             =   $_POST['status'];
                        
                        if($status == 0){
                                $status = '';
                        }
                        
                        if($status == 1){
                               $status = "AND e_r.marks >= 50 ";
                        }
                        
                        if($status == 2){
                               $status = "AND e_r.marks < 50 AND e_r.marks <> 'A' ";
                        }
                        if($status == 3){
                               $status = "AND e_r.marks = 'A' ";
                        }
                        
                        $result['result']           =   $this->Admission_r_model->programDetail($status,$program_id,$test_id);
                       
                        $this->load->view('admin_ace/admin_header');
                        
                        $this->load->view('admissions_r/entrytest/reports/programwiseView', $result);
                        $this->load->view('admin_ace/admin_footer');
                       
                   }
                   
                   // program wise detail report
                   
                   public function program_detail_info_form()
                   {
                       
      $this->login_check();
      
                       $result['tests']              = $this->Entrytest_model->getOpentests();
                       $result['program']            = $this->Admin_model->getAllprograms();
                       
                        $this->load->view('admin_ace/admin_header');
                        $this->load->view('admin_ace/admin_side_menu');
                        $this->load->view('admissions_r/entrytest/reports/programwisedetailinfoForm', $result);
                        $this->load->view('admin_ace/admin_footer');
                       
                   }
            
                   // program wise detail report
                   
                   public function program_detail_info()
                   {
                       
      $this->login_check();
      
                        $test_id            =   $_POST['test'];
                        $program_id         =   $_POST['program'];
                        $status             =   $_POST['status'];
                        $greater_than       =   $_POST['greater_than'];
                        $less_than          =   $_POST['less_than'];
                        
                        if($program_id == 0 )
                        {
                            $program_id = '';
                        }else{
                            $program_id  = "AND e_r.program_id = ".$program_id; 
                        }
                        
                        if($greater_than == '' && $less_than == '')
                        {
                                if($status == 0){
                                        $status = '';
                                }

                                if($status == 1){
                                       $status = "AND e_r.marks >= 50 ";
                                }

                                if($status == 2){
                                       $status = "AND e_r.marks < 50 AND e_r.marks <> 'A' ";
                                }
                                if($status == 3){
                                       $status = "AND e_r.marks = 'A' ";
                                }
                        }else{
                            
                            if($greater_than != '' && $less_than != '')
                            {
                                $status = "AND e_r.marks >= $greater_than AND e_r.marks <= $less_than";
                            }
                            
                            if($greater_than != '' && $less_than == '')
                            {
                                $status = "AND e_r.marks >= $greater_than ";
                            }
                             if($greater_than == '' && $less_than != '')
                            {
                                $status = "AND e_r.marks <= $less_than AND e_r.marks <> 'A'";
                            }
                            
                            
                        }
                        
                        $result['result']           =   $this->Admission_r_model->programDetailInfo($status,$program_id,$test_id);
                       
                                                
                        $this->load->view('admin_ace/admin_header');
                        
                        $this->load->view('admissions_r/entrytest/reports/programwisedetailinfoView', $result);
                        $this->load->view('admin_ace/admin_footer');
                       
                   }
                   
                   
                   // add grace marks to fail students 
                   
                   public function add_grace_marks_form()
                   {
                       
      $this->login_check();
      
                       $result['tests']              = $this->Entrytest_model->getOpentests();
                       $result['program']            = $this->Admin_model->getAllprograms();
                       
                       $this->load->view('admin_ace/admin_header');
                       $this->load->view('admin_ace/admin_side_menu');
                       $this->load->view('admissions_r/entrytest/reports/gracemarkForm', $result);
                       $this->load->view('admin_ace/admin_footer');
                       
                   }
            
                   // add grace marks to fail students 
                   
                   public function add_grace_marks()
                   {
                       
      $this->login_check();
      
                        $test_id            =   $_POST['test'];
                        $program_id         =   $_POST['program'];
                        $criteria           =   $_POST['criteria'];
                        $number             =   $_POST['number'];
                       
                        $result             =   $this->Admission_r_model->getFailStudents($test_id,$program_id,$criteria);                       
                        
                        $total              =   count($result);
                        
                        for($i=0; $i < $total; $i++)
                        {
                           
                            $id               =   $result[$i]['id'];
                            $marks            =   $result[$i]['marks']+$number;
                            $grace_marks      =   $number;
                            
                            $update_data      =   array(                                                            
                                                            'marks'             => $marks,
                                                            'grace_marks'       => $grace_marks
                                                        );
                            
                           $res               =    $this->Admission_r_model->addGraceMarks($id,$update_data);
                            
                           if(!$res){
                                        $this->session->set_userdata('error_msg', 'Marks NOt updated ');
                                        redirect('admission_r/add_grace_marks_form');
                           }
                            
                        }
                        
                                        $this->session->set_userdata('error_msg', 'Grace Marks Added ');
                                        redirect('admission_r/add_grace_marks_form');
                   }
            
            
                // ***   Entry Test Reports End   *** \\


                   
                   
         /* for intervire*/
    public function add_interview_form(){
        
        
        $this->login_check();
        $result['campus']   = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admin_model->getAllcampaigns();
        $result['program']  = $this->Admin_model->getAllprograms();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admissions_r/interview/addinterviewform', $result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function view_interview_list(){
        
        $this->login_check();
        
        $program                    = $this->Admission_r_model->getProgramName($_POST['programs']);
        $result['program']          = $program->program_name;
        
        $campaign                   = $this->Admission_r_model->getCampaignName($_POST['campaign']);
        $result['campaign_name']    = $campaign->campaign_name;               
        
        $campus                     = $this->Admission_r_model->getCampusCode($_POST['campus']);
        $result['campus_code']      = $campus->campus_code;               
        
        //already entry in interview table
        $get_id                     = $this->Admission_r_model->interview_ids($_POST['programs']);
        //echo '<pre>';var_dump($get_id );echo '</pre><br/>';
        
        $exisitng_ids;
        if(sizeof($get_id) > 0){
            foreach($get_id as $id ){
                $exisitng_ids .= $id['entrytest_result_id'].',';
            }
            $exisitng_ids             = rtrim($exisitng_ids , ',');
        }else{
            $exisitng_ids = '';
        }
        
        //echo $exisitng_ids             ;exit;
        $result['all_listings']   = $this->Admission_r_model->getinterview_listing($_POST['programs'],$_POST['campus'],$_POST['campaign'], $exisitng_ids);
        
        
        //echo '<pre>';var_dump($result['all_listings']   );echo '</pre>';exit;
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admissions_r/interview/view_interview_list', $result);
        $this->load->view('admin_ace/admin_footer');

    }
    
    public function SinfoInter(){
        
        
        
      $this->login_check();
      
        $result     = $this->Admission_r_model->SinfoInter(
                        $_POST['form_id'],
                        $_POST['form_no'],
                        $_POST['name'],
                        $_POST['program_id'],
                        date('Y-m-d'),
                        $this->session->userdata('sub_login_id'),
                        $_POST['entrytest_result_id']
                        
                        
                        
                );
        
        $mobile          = $_POST['mobile'];
        $explode_num     = explode("-",$mobile);
        $mobile          = $explode_num[0].$explode_num[1];
        $mobile_trim     = trim($mobile,'0');
        $number          = '92'.$mobile_trim;
        $msg             = "Dear ".$_POST['name'].",".PHP_EOL."Thanks for visiting Superior for interview.".PHP_EOL;
        $this->smsapi->sendSMS($number, $msg);
        echo $result;exit;
    }
    
    
    public function conducted_interviews(){
            
            
      $this->login_check();
      
            $result['all_listings']   = $this->Admission_r_model->conducted_interviews();
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/interview/conducted_interviews', $result);
            $this->load->view('admin_ace/admin_footer');
    }
    
    public function programwise_interview_report_form(){
            
      $this->login_check();
      
            $result['getTests']   = $this->Admission_r_model->getTests();
            
            //echo '<pre>';var_dump($result);echo '</pre>';exit;
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/interview/programwise_interview_report_form', $result);
            $this->load->view('admin_ace/admin_footer');
    }
    
    public function programwise_interview_view_report(){
           
      $this->login_check();
       
            $test_id = $_POST['test_id'];
            
            $result['all_listings']   = $this->Admission_r_model->programwise_interview_view_report($test_id);
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions_r/interview/conducted_interviews', $result);
            $this->load->view('admin_ace/admin_footer');
    }
    
    /* for intervire end*/ 
                   
                   
                   
                   
                   
                   



//    *****************                Entry Test Module              ***************

    
    public function check_sms(){

        $number = "923438018055";
        $msg = "Dear Tariq Mayo, ".PHP_EOL."Your Entry Test details are as follows, ".PHP_EOL."Room : Auditorium No.2".PHP_EOL."Floor : 2nd".PHP_EOL."Date : 17 Sep".PHP_EOL."Time : 09:00".PHP_EOL."Best of luck. ";
        //$msg = "Dear Abdullah,".PHP_EOL."We appreciate your interest.".PHP_EOL."Your Inquiry #:".PHP_EOL."LHR-F14-72".PHP_EOL."For details visit Superior with your inquiry #.".PHP_EOL."Admission Dept".PHP_EOL."Ph #:04238104221";
        echo $this->smsapi->sendSMS($number, $msg);
    }
    
    public function set_form_numbers()
    {
      
      $this->login_check();
      
            
            $campus_id = '3';
            $shift = 'Evening';
            $code = 'E';
            
            $result_all  =   $this->Admission_r_model->getInitialFormDataProgram($campus_id, $shift);
            $count = count($result_all);
//            echo "<pre>";
//            var_dump($result_all[0]);
//            die;
            
            for($j=0; $j < $count; $j++){
                $program_id = $result_all[$j]['program_id'];
                $result  =   $this->Admission_r_model->getInitialFormData($program_id, $campus_id);
                $i = 1;
                foreach ($result as $data){
                $initial_id = $data['initial_form_id'];
                $inquiry_id = $data['inquiry_id'];
                $form_num = explode('-', $data['form_no']);
                $new_form_num = $form_num[0]."-".$form_num[1]."-".$form_num[2]."-".$code.$i;
                //$update  =   $this->Admission_r_model->UpdateInitial($initial_id, $i, $new_form_num);
                $update_final  =   $this->Admission_r_model->UpdateFinal($inquiry_id,$new_form_num);
                $i++;
                    }
            }
           
//            echo "<pre>";
//            var_dump($result);
//            die;
            
        die;
    
    }

    
    //   ***** For  Revise program code   *****   \\
    
    public function updateProgramCode()
    {
        
      $this->login_check();
      
        $old    =   $_GET['old'];
        $new    =   $_GET['new'];
        
        $result =   $this->Admission_r_model->getInitialData($old);
        if(count($result) < 1)
        {
            die('Record Not found');
        }
        
        foreach($result AS $row)
        {
            $id             =    $row['initial_form_id'];
            $form_no        =    $row['form_no']; 
            $array          =    explode('-',$form_no);
            $new_form_no    =    $new.'-'.$array[1].'-'.$array[2].'-'.$array[3];
            
            $result         =    $this->Admission_r_model->updateCode($id,$new_form_no);
            if(!$result)
            {
                die('Form No not updated');
            }
        }
        
        die('Program Code Updated Successfully');
    }
    
    
    // update form_no in forms table
    
    public function UpdateFormNo()
    {
        
      $this->login_check();
      
        $result         =   $this->Admission_r_model->getNewFormNo();
        foreach($result AS $row)
        {
           $newFormNo      =   $row['new_form_no'];
           $student_id        =   $row['student_id'];
           
           $result                      =   $this->Admission_r_model->updateFormNo($newFormNo,$student_id);
           if(!$result)
           {
               die('Form No not updated');
           }
        }
        echo 'Form No updated Successfully';
    }
    
    public function updateStatus()
    {
        
      $this->login_check();
      
        $result['inquiries'] = $this->Admission_r_model->getAllinquiries2();
        
//        echo "<pre>";
//        var_dump($result['inquiries']);
//        die;
        foreach($result['inquiries'] AS $row){
            if($row['prospectus_id']){
                
                $inquiry_id     =   $row['inquiry_id'];
                $result         =   $this->Admission_r_model->update($inquiry_id);
                
            }
        }
        echo 'Updated';
        
    }
    
    
    public function all_remaining_students(){
       
        
      $this->login_check();
      
        $result['students']     =   $this->Admission_r_model->getAllRemaining();
        echo '<pre>';
        var_dump($result);die;
        
    }
   

/* User Management Modules Ended              Author: Jamal Ahmed*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */