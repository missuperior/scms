<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounts extends CI_Controller {

    public function __construct() {

    parent::__construct();

    
    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Accounts_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {

    $this->load->view('accounts/login');
  }
  
  
     
  // for verification of admin login

  public function login_check(){
            
            if ($this->session->userdata('sub_login_id') == '' || $this->session->userdata('sub_login') == '' || $this->session->userdata('account_role_id') != 4) {
              redirect('accounts/index');
         }
        }
  
    public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('accounts/login');
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

                  $sessionData = array(
                      'sub_login'             => $result->sub_login,
                      'sub_login_id'          => $result->sub_login_id,
                      'employee_id'           => $result->employee_id,
                      'campus_id'             => $result->campus_id,
                      'account_role_id'       => $result->account_role_id,
                      'role'                  => $result->role
                  );

                  $this->session->set_userdata($sessionData);
                  redirect('accounts/dashboard');
                } else {

                  $this->session->set_userdata('error', 'Incorrect Username OR Password');
                  redirect('accounts/index');
                }
      }else{
                 $this->session->set_userdata('error', 'Please Login from Your Own login..');
                 redirect('accounts/index');
          
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
                 redirect('accounts/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('accounts/change_password_form');
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
    redirect('accounts/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
      
    
    
    $res['campaign_data']               =   $this->Admin_model->getAllcampaigns();
    $campaign_id                        =   $res['campaign_data'][0]['campaign_id'];       
    $this->session->set_userdata('campaign_id',$campaign_id);
    
//    $result['inquiry_without_pros']     =   $this->Admission_r_model->getinquiries();
//    $result['pros_without_initial']     =   $this->Admission_r_model->getprospectus();
//    $result['initial_without_detail']   =   $this->Admission_r_model->getinitial();
    $result['forms_without_student']    =   $this->Accounts_model->getforms();
   
    
    // total amount from table 
    $result['inquiries']                =   $this->Accounts_model->inquiries(); 
    $result['online']                   =   $this->Admission_r_model->onlineinquiries();
    $result['prospectus']               =   $this->Accounts_model->prospectus();
    $result['initial']                  =   $this->Accounts_model->initial();
    $result['detailed']                 =   $this->Accounts_model->detailed();
    $result['student']                  =   $this->Accounts_model->student();
    
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/accounts_side_menu');
    $this->load->view('accounts/dashboard', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  
  // Dashboard Quick Search
  
  public function quick_search(){
      
      
      $this->login_check();
      
      
      require_once('admission_reports.php');      
      $admission_report =   new Admission_reports();
      
      $campus_id    = $this->session->userdata('campus_id');
      
      $search_type      =   $_POST['type'];
      
      if($search_type == 1)
      {
            if($_POST['form_no']){          
                $student_id     =   $this->Accounts_model->getStdId($_POST['form_no']);
            }elseif ($_POST['roll_no']) {
                $student_id     =   $this->Accounts_model->getStdId2($_POST['roll_no'],$campus_id);
            }elseif($_POST['challan_no']){
                $student_id     =   $this->Accounts_model->getStdId($_POST['challan_no']);
            }
            
            if($student_id){
                
                $package        =   $this->Accounts_model->checkPackage($student_id);
                if($package)
                {
                    redirect('accounts/view_package/?student_id='.$student_id);
                }else{
                    redirect('accounts/student_package/?student_id='.$student_id);                   
                }
                
            }else{                
                $this->session->set_userdata('error', 'Record Not Found');
                 redirect('accounts/dashboard');                
            }
            
      }elseif($search_type == 2){
          
           if($_POST['form_no']){          
                $student_id     =   $this->Accounts_model->getStdId($_POST['form_no']);
            }elseif ($_POST['roll_no']) {
                $student_id     =   $this->Accounts_model->getStdId($_POST['roll_no']);
            }elseif($_POST['challan_no']){
                $student_id     =   $this->Accounts_model->getStdId($_POST['challan_no']);
            }
                        
            if($student_id){
                
                $package        =   $this->Accounts_model->checkPackage($student_id);
                if($package)
                {
                    redirect('accounts/view_package/?student_id='.$student_id);
                }else{
                    redirect('accounts/student_package/?student_id='.$student_id);                   
                }
                
                
                
            }else{                
                $this->session->set_userdata('error', 'Record Not Found');
                 redirect('accounts/dashboard');                
            }
          
      }elseif($search_type == 3){
          
            
           if($_POST['form_no']){          
                $student_id     =   $this->Accounts_model->getStdId($_POST['form_no']);
            }elseif ($_POST['roll_no']) {
                $student_id     =   $this->Accounts_model->getStdId($_POST['roll_no']);
            }elseif($_POST['challan_no']){
                $student_id     =   $this->Accounts_model->getStdId($_POST['challan_no']);
            }
                        
            if($student_id){
          
              if($_POST['challan_no']){
                  
                  $challan_id       =   $_POST['challan_no'];
                  
                  $result           =   $this->Accounts_model->getInsId($challan_id);
                  
                  $installment_id  =   $result->installment_id;
                  $due_date  =   $result->due_date;
                  
                  redirect('accounts/add_fine_form2/?installment_id='.$installment_id.'&student_id='.$student_id.'$due_date='.$due_date);
                  
                  
              }else{
               
                $package        =   $this->Accounts_model->checkPackage($student_id);
                if($package)
                {
                    redirect('accounts/view_package/?student_id='.$student_id);
                }else{
                    redirect('accounts/student_package/?student_id='.$student_id);                   
                }
                
              }
                
            }else{                
                $this->session->set_userdata('error', 'Record Not Found');
                 redirect('accounts/dashboard');                
            }
          
          
          
      }
      
  }

  
  
  
  
  
  
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
                    
                    if($student_package > 0){
                        
                            redirect('accounts/view_package/?student_id='.$student_id);
                            //redirect('accounts/view_package/'.$student_id);
                    }else {
                        redirect('accounts/student_package/?student_id='.$student_id);
                    }
                    }else{                    
                            $this->session->set_userdata('error_msg','Record Not Found, Please try Another!');
                            redirect('accounts/search_form');
                    }
                
            }else{
     
              $this->load->view('admin_ace/admin_header');
              $this->load->view('admin_ace/accounts_side_menu');
              $this->load->view('accounts/form/searchform');            
              $this->load->view('admin_ace/admin_footer');
            }
    }
  
  
  
  
  
   public function view_student_form()
    {
      $this->login_check();

      $result['form_data'] = $this->Accounts_model->getAllStudentForms();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/accounts_side_menu');
      $this->load->view('accounts/form/view_forms', $result);
      $this->load->view('admin_ace/admin_footer');
    }
  
   public function view_all_student_form()
    {
      $this->login_check();

      $result['form_data'] = $this->Accounts_model->getAllStudentForms_all();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/accounts_side_menu');
      $this->load->view('accounts/form/view_all_forms', $result);
      $this->load->view('admin_ace/admin_footer');
    }
  
  
   public function freeze_left_view()
    {
      $this->login_check();
      
       if(!empty($_POST))
            {
               $program_id              =    $_POST['program'];                
               $campaing_id             =    $_POST['campaign'];                
               
               $this->session->set_userdata('program_id', $program_id);
               $this->session->set_userdata('batch_id', $batch_id);
               
               $result['campaign']      = $this->Accounts_model->getAllcampaigns();
               $result['programs']      = $this->Admin_model->getAllprograms();
               
               $result['form_data'] = $this->Accounts_model->getStudentfor_left($program_id,$campaing_id);
                
               //echo '<pre>';var_dump($result);die;
              
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/form/freeze_left', $result);
                $this->load->view('admin_ace/admin_footer');
               
               
            }else{

                $result['campaign']      = $this->Accounts_model->getAllcampaigns();
                $result['programs']      = $this->Admin_model->getAllprograms();                

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/form/freeze_left', $result);
                $this->load->view('admin_ace/admin_footer');
            }
    }
  
   public function freeze_left()
    {
      $this->login_check();

      $student_id       =   $_GET['student_id'];
      $status           =   $_GET['status'];
      
      $result           =   $this->Accounts_model->updateStatus($student_id,$status);
      
      if($result){
              $this->session->set_userdata('success_msg','Student '.$status.' Successfully');
              redirect('accounts/freeze_left_view');
      }else{
              $this->session->set_userdata('success_msg','Student Not '.$status.' Please Try Again');
              redirect('accounts/freeze_left_view');
      }
      
    }
  
   public function freeze_left2()
    {
      $this->login_check();

      $student_id          =   $this->uri->segment(3);
      $session_id          =   $this->uri->segment(4);
      $semester            =   $this->uri->segment(5);
      $cur_status          =   $this->uri->segment(6);
      $status              =   $this->uri->segment(7);
      
      $result           =   $this->Accounts_model->updateStatus($student_id,$status);
      
      if($result > 0){
          
              $data     =   array(
                                    'student_id'            =>  $student_id,
                                    'operator_id'           =>  $this->session->userdata('sub_login_id'),
                                    'session_id'            =>  $session_id,
                                    'semester'              =>  $semester,
                                    'status_from'           =>  $cur_status,
                                    'status_to'             =>  $status
              );
          
              $freeze_left_log_id   =   $this->Accounts_model->addLog($data);
              if($freeze_left_log_id > 0){
                        $this->session->set_userdata('success_msg','Student '.$status.' Successfully');
                        redirect('accounts/view_package/?student_id='.$student_id);
              }else{
                    $this->session->set_userdata('success_msg','Student '.$status.'Log Not Added');
                    redirect('accounts/view_package/?student_id='.$student_id);
              }
      }else{
              $this->session->set_userdata('success_msg','Student Not '.$status.' Please Try Again');
              redirect('accounts/view_package/?student_id='.$student_id);
      }
      
    }
  
  
// ******>>>>         Start functions for Student Pakage        <<<<******  //
        

// define student pakage form 
        
        public function student_package()
        {
          
          $this->login_check();
          
                                      
          $student_id           = $_GET['student_id']; 
          
          $check                =   $this->Accounts_model->Check_Package($student_id);
          
          if($check){
              $this->session->set_userdata('error_msg','Package of this student Already Exists');
              redirect('accounts/view_package/?student_id='.$student_id);
          }
          else{          
              
              // check if package not defined and rollno assigned
              
          $rollno               =   $this->Accounts_model->Check_Rollno($student_id);
          if($rollno->roll_no){
              redirect('accounts/student_package2/?student_id='.$student_id);
          }else{
                $result['std_info']   =   $this->Accounts_model->getStudentPackageInfo($student_id);

                $program_id           = $result['std_info'][0]['program_id'];           
                $result['package']    = $this->Accounts_model->getStudentPackage($program_id,$student_id);

//                echo '<pre>';
//                print_r($result['package']);die;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/student_package/add_package', $result);
                $this->load->view('admin_ace/admin_footer');
          }
          }
            
        }

        public function student_package2()
        {
          
          $this->login_check();
          
          $check                =   $this->Accounts_model->Check_Package($student_id);
          if($check){
             $this->session->set_userdata('error_msg','Package of this student Already Exists');
             redirect('accounts/view_package/?student_id='.$student_id);
              
          }
          else{
                                                
            $student_id           = $_GET['student_id']; 
            $result['std_info']   =   $this->Accounts_model->getStudentPackageInfo($student_id);

            $program_id           = $result['std_info'][0]['program_id'];           
                $result['package']    = $this->Accounts_model->getStudentPackage($program_id,$student_id);

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/student_package/add_package2', $result);
            $this->load->view('admin_ace/admin_footer');
          
          }
        }


 // add student package
        
        public function add_student_package()
        {
            $this->login_check();
            
            $student_id         = $_POST['student_id'];
            $program_id         = $_POST['program_id'];
            $session_id         = $_POST['session_id'];
            $campaign_id         = $_POST['campaign_id'];
            $operator_id        = $this->session->userdata('sub_login_id');
            $session_package2   = $_POST['total_package'];
            if($_POST['type'] == 'Annual'){
                $session_package    = $_POST['session_payable']+$_POST['tax'];
            }else{
                $session_package    = $_POST['session_payable']+$_POST['misc_payable'];
            }
            
            $total_sessions     = $_POST['no_of_sessions'];
           // $degree_package     = $session_package * $total_sessions;
            $degree_package     =  $session_package * $total_sessions;
            $degree_package     =  $degree_package + $_POST['admission_payable'];
            
            if($_POST['type'] == 'Annual'){
                
                $student_package = array(
                                        'student_id'            =>$student_id,
                                        'program_id'            =>$program_id,
                                        'total_sessions'        =>$total_sessions,
                                        'admission_fee'         =>$_POST['admission_payable'],
                                        'tax'                   =>$_POST['tax'],
                                        'session_fee'           =>$_POST['session_payable'],
                                        'admission_fee_discount'=>$_POST['admission_discount1'],
                                        'session_fee_discount'  =>$_POST['session_discount1'],
                                        'session_total_package' =>$session_package,
                                        'degree_total_package'  =>$degree_package,
                                        'remarks'               =>$_POST['remarks'],
                                        'created_date'          =>date('Y-m-d'),
                                        'operator_id'           =>$operator_id
                                    );
                
            }else{
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
            }
            
            
             $result          = $this->Accounts_model->addStudentPackage($student_package);
             if($result)
                 {
                        
                    // for update stage to 3 for complete admission
                 
                        $inquiry_id         =   $this->Accounts_model->getInquiry_Id($student_id);
                        
                        
                        // Assign roll no to the student 
                        
                            $program                    = $this->Admission_r_model->getProgramCode($program_id);
                            $program_code               = $program->program_code;  
                        
                            $campaign                   = $this->Admission_r_model->getCampaignCode($campaign_id);
                            $campaign_code              = $campaign->campaign_code;
                        
                            //$last_roll_no               = $this->Accounts_model->getLastRollNo($program_code);
                            $last_roll_no               = $this->Accounts_model->getLastRollNo($program_code,$this->session->userdata('campus_id'),$campaign_code);
                            //echo '<pre>';print_r($last_roll_no);die;
                           
                        if($this->session->userdata('role') == 'OS'){
                                            if(count($last_roll_no) > 0)
                                           {
                                                   $rollno                     = $last_roll_no[0]['roll_no'];
                                                   $roolnoarray                = explode("-", $rollno);
                                                   $no                         =   $roolnoarray[2];
                                                   $nextno                     =   $no+1;
                                           }else{
                                                       $nextno                     =   1;
                                           }
                        }else {
                                            if(count($last_roll_no) > 0)
                                                {
                                                      $serial_no                    = $last_roll_no[0]['serial'];
                                                      $nextno                       = $serial_no+1;                                        
                                            }else{
                                                        $nextno                     =   1;
                                            }
                        }
                            
                            $length                                 = strlen($nextno);
                            
                            if($length == 1)
                            {
                                $nextno     =   str_pad($nextno,3,"0",STR_PAD_LEFT);
                                
                            }
                            if($length == 2)
                            {
                                $nextno     =   str_pad($nextno,3,"0",STR_PAD_LEFT);
                            }
                            
                           $roll_no                    = $program_code.'-'.$campaign_code.'-'.$nextno;
                            
                            $assign_rollno              =   $this->Accounts_model->addRollNo($student_id,$roll_no,$this->session->userdata('sub_login_id'),$nextno);
                            
                            if($assign_rollno > 0)
                            {
                                $res                =   $this->Accounts_model->updateStage($inquiry_id);
                                
                                if($res){
                 
                                $this->session->set_userdata('package',$session_package2);
                                $this->session->set_userdata('student_id',$student_id);
                                $this->session->set_userdata('program_id',$program_id);
                                $this->session->set_userdata('session_id',$session_id);
                                $this->session->set_userdata('success_msg','Student Package Added Successfully');
                                redirect('accounts/installments/?student_id='.$student_id);
                                }
                            }else{
                                    
                                $this->session->set_userdata('error_msg','Student Roll No not assigned Successfully');
                                redirect('accounts/student_package');
                            }
                        
                        
                 }
             else
                 {
                     $this->session->set_userdata('error_msg','Student Package Not Added Successfully, Please Try Again!');
                     redirect('accounts/student_package');
                 }
                 
            
        }
      
 // add student package
        
        public function add_student_package2()
        {
            $this->login_check();
            
            $student_id         = $_POST['student_id'];
            $program_id         = $_POST['program_id'];
            $session_id         = $_POST['session_id'];
            $campaign_id         = $_POST['campaign_id'];
            $operator_id        = $this->session->userdata('sub_login_id');
            $session_package2   = $_POST['total_package'];
            $session_package    = $_POST['session_payable']+$_POST['misc_payable'];
            
            $total_sessions     = $_POST['no_of_sessions'];
           // $degree_package     = $session_package * $total_sessions;
            $degree_package     =  $session_package * $total_sessions;
            $degree_package     =  $degree_package + $_POST['admission_payable'];
            
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
            
            
             $result          = $this->Accounts_model->addStudentPackage($student_package);
             if($result)
                 {
                        
                    // for update stage to 3 for complete admission
                 
                       // $inquiry_id         =   $this->Accounts_model->getInquiry_Id($student_id);
                        
                        
//                        // Assign roll no to the student 
//                        
//                            $program                    = $this->Admission_r_model->getProgramCode($program_id);
//                            $program_code               = $program->program_code;  
//                        
//                            $campaign                   = $this->Admission_r_model->getCampaignCode($campaign_id);
//                            $campaign_code              = $campaign->campaign_code;
//                        
//                            $last_roll_no               = $this->Accounts_model->getLastRollNo($program_code);
//                            
//                            if(count($last_roll_no) > 0)
//                                {
//                                        $rollno                     = $last_roll_no[0]['roll_no'];
//                                        $roolnoarray                = explode("-", $rollno);
//                                        $no                         =   $roolnoarray[2];
//                                        $nextno                     =   $no+1;
//                                        
//                            }else{
//                                        $nextno                     =   1;
//                            }
//                            
//                            $length                                 = strlen($nextno);
//                            
//                            if($length == 1)
//                            {
//                                $nextno     =   str_pad($nextno,3,"0",STR_PAD_LEFT);
//                                
//                            }
//                            if($length == 2)
//                            {
//                                $nextno     =   str_pad($nextno,3,"0",STR_PAD_LEFT);
//                            }
//                            
//                            $roll_no                    = $program_code.'-'.$campaign_code.'-'.$nextno;
//                            
//                            $assign_rollno              =   $this->Accounts_model->addRollNo($student_id,$roll_no,$this->session->userdata('sub_login_id'));
//                            
//                            if($assign_rollno)
//                            {
//                                $res                =   $this->Accounts_model->updateStage($inquiry_id);
//                                
//                                if($res){
                 
                                $this->session->set_userdata('package',$session_package2);
                                $this->session->set_userdata('student_id',$student_id);
                                $this->session->set_userdata('program_id',$program_id);
                                $this->session->set_userdata('session_id',$session_id);
                                $this->session->set_userdata('success_msg','Student Package Added Successfully');
                                redirect('accounts/installments/?student_id='.$student_id);
                               // }
//                            }else{
//                                    
//                                $this->session->set_userdata('error_msg','Student Roll No not assigned Successfully');
//                                redirect('accounts/student_package');
//                            }
                        
                        
                 }
             else
                 {
                     $this->session->set_userdata('error_msg','Student Package Not Added Successfully, Please Try Again!');
                     redirect('accounts/student_package');
                 }
                 
            
        }
      
        
 // add installments of student package
  
        public function installments()
        {
           $this->login_check();

           
           $result['student_id']        =    $_GET['student_id'];
          
           $res['packageInfo']          =    $this->Accounts_model->getPackageInfo($_GET['student_id']);
          
           $result['std_installments']  =    $this->Accounts_model->getStudentInstallments($_GET['student_id']);
           
          // echo '<pre>';print_r($result['std_installments']);die;
           
           $result['sessions']            = $this->Admin_model->getAllSessions();
           $current_session_id            = $this->Admin_model->getActiveSessionId();
           
           $chk_installment = 0;
           foreach($result['std_installments'] AS $row){               
               if($current_session_id > $row['session_id'])
               {
                   $chk_installment = 1;
               }
           }
                   
          // $chk_installment             =    strtotime($res['packageInfo'][0]['created_date']) - strtotime($result['std_installments'][0]['created_date']);
           //$chk_installment             =    count($result['std_installments']);
           
           if($chk_installment == 1 ){
              
               if($res['packageInfo'][0]['program_id'] == 53){ 
                        $tax     =   5*$res['packageInfo'][0]['session_fee']/100;
                        $result['package']       =    $res['packageInfo'][0]['session_fee']+$tax;
               }else{               
                    $result['package']       =    $res['packageInfo'][0]['session_total_package'];               
               }
           }else{
               $this->session->set_userdata('previours_installments','1');
              
               if($res['packageInfo'][0]['program_id'] == 53){
                        $tax     =   5*($res['packageInfo'][0]['session_fee']+$res['packageInfo'][0]['admission_fee'])/100;
                        $result['package']       =    $res['packageInfo'][0]['session_fee']+$tax+$res['packageInfo'][0]['admission_fee'];
               }else{ 
                    $result['package']       =    $res['packageInfo'][0]['session_total_package']+$res['packageInfo'][0]['admission_fee'];
               }
           }
           
           $result['program_id']        =    $res['packageInfo'][0]['program_id'];
           $result['session_id']        =    $res['packageInfo'][0]['enrolled_session_id'];
           $result['current_session_id']        =    $current_session_id;
           
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/student_package/add_installments', $result);
            $this->load->view('admin_ace/admin_footer');
            
        }
        
        
        
        // Add installments in db
        
        public function add_installments()
        {
            $this->login_check();
            
           // echo $this->session->userdata('previours_installments');die;
            
            $session_id     = $_POST['session'];
            $student_id     = $_POST['student_id'];
            $installment_no = $_POST['installment_no'];
                        
            
            $check_data     = array(
                                        'student_id' => $student_id,
                                        'session_id' => $session_id,
                                    );
            
//            if($this->session->userdata('previours_installments') == 1)
//            {
//               $result == 0;
//            }else{
//                $result         = $this->Accounts_model->chkSession_inInstallment($check_data);                
//            }
            
//            $result         = $this->Accounts_model->chkSession_inInstallment($check_data);                
//            
//            if($result == 0)
//            {
            
                        $student_id     = $student_id;
                        $program_id     = $_POST['program_id'];
                        $operator_id    = $this->session->userdata('sub_login_id');
     
                        $amount[]       = $_POST['installment_amount'];
                        $fine[]         = $_POST['fine'];
                        $discount[]     = $_POST['discount'];
                        $payable[]      = $_POST['payable'];
                        $due_date[]     = $_POST['due_date'];
                        $remarks[]      = $_POST['remarks'];

                        for($i=0; $i <= 3; $i++)
                        {

                          if($amount[0][$i] != '')
                          {
                            
                            if(count($installment_no) == 4){ $ins_no = $i+1;}  
                            else{$ins_no = $installment_no[$i];}
                              
                              
                              
                            $installment_data = array(
                                            'installment_no'         => $ins_no,
                                            'student_id'             => $student_id,
                                            'program_id'             => $program_id,
                                            'session_id'             => $session_id,
                                            'fee'                    => $amount[0][$i],
                                            'fine'                   => $fine[0][$i],
                                            'additional_discount'    => $discount[0][$i],
                                            'payable'                => $payable[0][$i],
                                            'due_date'               => $due_date[0][$i],
                                            'created_date'           =>date('Y-m-d'),
                                            'operator_id'            => $operator_id,
                                            'remarks'                => $remarks[0][$i]

                                            );
//                            echo '<pre>';
//                            print_r($installment_data);die;

                               $challan_id   =   $this->Accounts_model->addInstallments($installment_data,$student_id);
                               
                               if(!$challan_id)
                               {
                                   echo 'Not Added';
                               }
                               
                          }
                        }

                        $this->session->set_userdata('success_msg','Student Installments Added Successfully');
                        $this->session->unset_userdata('program_id');
                        $this->session->unset_userdata('package');
                        redirect('accounts/view_package/?student_id='.$student_id);
//            }else{
//                
//                     $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
//                     redirect('accounts/installments/?student_id='.$student_id);
//            } 
        }
        
         
         public function edit_installments()
            {
               $this->login_check();

               if($_GET['student_id']){
                   
                             $result['sessions']            = $this->Admin_model->getAllSessions();                             
                             
                             $res                           =   $this->Accounts_model->getEnrolledSeesion($_GET['student_id']);
                             $result['enrolled_session_id'] = $res->enrolled_session_id;
                             $result['student_id']          = $_GET['student_id'];
                             $result['flag']                = 0;
                             
//                             echo '<pre>';print_r($result);die;

                             $this->load->view('admin_ace/admin_header');
                             $this->load->view('admin_ace/accounts_side_menu');
                             $this->load->view('accounts/student_package/edit_installments', $result);
                             $this->load->view('admin_ace/admin_footer');                   
                   
               }else{
               
                            $result['student_id']           =    $_POST['student_id'];
                                                      
                            
                            $res['info']                   =   $this->Accounts_model->getEnrolledSeesion($_POST['student_id']);
                            $result['enrolled_session_id'] = $res['info']->enrolled_session_id;
                            
                            $session_id                     =   $_POST['session'];

                            $result['std_info']             =    $this->Accounts_model->getStudentPackageInfo($_POST['student_id']);
                            $res['packageInfo']             =    $this->Accounts_model->getPackageInfo($_POST['student_id']);
                            $result['std_installments']     =    $this->Accounts_model->getStudentInstallments2($_POST['student_id'],$session_id);
//                            echo '<pre>';
//                            echo $result['std_installments'][0]['fee']+$result['std_installments'][1]['fee'];;
                            //print_r($result['std_installments']);//die;
                            $chk_installment             =    count($result['std_installments']);
//
//                            $chk_installment                =    strtotime($res['packageInfo'][0]['created_date']) - strtotime($result['std_installments'][0]['created_date']);
//                            $chk_installment             =    count($result['std_installments']);
                          
                          
                        
                        // for MBBS STUDENTS
                            
                            if($result['std_info'][0]['program_id'] == 53){
                                
                                $tax  =   5*$res['packageInfo'][0]['session_fee']/100;
                                
                                if ($chk_installment == 0) {                   
                                    if ($result['std_info'][0]['enrolled_session_id'] == $session_id) {
                                        $result['package'] = $res['packageInfo'][0]['session_fee']+$tax + $res['packageInfo'][0]['admission_fee'];
                                    } else {
                                        $result['package'] = $res['packageInfo'][0]['session_fee']+$tax;
                                    }
                                } else {                                    
                                    $this->session->set_userdata('previours_installments', '1');

                                    if ($result['std_info'][0]['enrolled_session_id'] == $session_id) {
                                         $result['package'] = $res['packageInfo'][0]['session_fee']+$tax + $res['packageInfo'][0]['admission_fee'];
                                    } else {
                                       $result['package'] = $res['packageInfo'][0]['session_fee']+$tax;
                                    }
                                }
                            }else{
                                
                                if ($chk_installment == 0) {                   
                                    if ($result['std_info'][0]['enrolled_session_id'] == $session_id) {
                                        $result['package'] = $res['packageInfo'][0]['session_total_package'] + $res['packageInfo'][0]['admission_fee'];
                                    } else {
                                        $result['package'] = $res['packageInfo'][0]['session_total_package'];
                                    }
                                } else {                                    
                                    $this->session->set_userdata('previours_installments', '1');

                                    // get package from installments 
                                    $package = 0;
                                    foreach($result['std_installments'] AS $row){
                                        $package =  $package + $row['fee'];
                                    }
                                    //$result['package']  =   $package;

                                      if ($result['std_info'][0]['enrolled_session_id'] == $session_id) {
                                     $s_package =    $result['package'] = $res['packageInfo'][0]['session_total_package'] + $res['packageInfo'][0]['admission_fee'];
                                    } else {
                                     $s_package =    $result['package'] = $res['packageInfo'][0]['session_total_package'];
                                    }
                                    
                                    if($package == $s_package ){
                                        $result['package']  =   $package;
                                    }else{
                                        $result['package']  =   $s_package;
                                    }

                                    
//                                    if ($result['std_info'][0]['enrolled_session_id'] == $session_id) {
//                                        $result['package'] = $res['packageInfo'][0]['session_total_package'] + $res['packageInfo'][0]['admission_fee'];
//                                    } else {
//                                        $result['package'] = $res['packageInfo'][0]['session_total_package'];
//                                    }
                                }
                            }
                            
                            
                           
                          //  echo $result['package'];die;

                            $result['program_id']           =    $res['packageInfo'][0]['program_id'];
                            $result['session_id']           =    $res['packageInfo'][0]['enrolled_session_id'];
                            $result['session_id']           =    $session_id;

                             $result['sessions']            = $this->Admin_model->getAllSessions();
                             
                             $result['flag']                = 1;

                             $this->load->view('admin_ace/admin_header');
                             $this->load->view('admin_ace/accounts_side_menu');
                             $this->load->view('accounts/student_package/edit_installments', $result);
                             $this->load->view('admin_ace/admin_footer');
               }

            }
        
        
        
         public function update_installments()
        {
            $this->login_check();
            
            $session_id     = $_POST['session'];
            $student_id     = $_POST['student_id'];
            
                        $student_id     = $student_id;
                        $program_id     = $_POST['program_id'];
                        $operator_id    = $this->session->userdata('sub_login_id');
     
                        $amount[]       = $_POST['installment_amount'];                       
                        $installment_no[]  = $_POST['installment_no'];
                        $fine[]         = $_POST['fine'];
                        $discount[]     = $_POST['discount'];
                        $payable      = $_POST['payable'];
                        $due_date[]     = $_POST['due_date'];                        
                        $remarks[]     = $_POST['remarks'];                        
                        
                       // echo '<pre>'; print_r($payable);
                      $total_package = $_POST['package'];                        

                      $total_inst = array_sum($_POST['installment_amount']);
                      
                        if($total_package != $total_inst){
                          $this->session->set_userdata('error_msg','Installments Amount should not be greater/ less than Total Package');
                          redirect('accounts/edit_installments/?student_id='.$student_id);
                        }
                        
                        $due = array_filter($_POST['due_date']);
                        $total_dates = count($due);
                        
                        $am       = array_filter($_POST['installment_amount']);
                        $t_amount = count($am);
                        
                        
                        if($t_amount != $total_dates){
                          $this->session->set_userdata('error_msg','Due Date Required');
                          redirect('accounts/edit_installments/?student_id='.$student_id);
                        }
                        
                        $this->Accounts_model->deleteUnpaidInstallments($student_id,$session_id);  
                        
                        for($i=0; $i <= 4; $i++)
                        {
                          if($amount[0][$i] != '')
                          {                             
                            $installment_data = array(
                                            
                                            'installment_no'         => $installment_no[0][$i],
                                            'student_id'             => $student_id,
                                            'program_id'             => $program_id,
                                            'session_id'             => $session_id,
                                            'fee'                    => $amount[0][$i],
                                            'fine'                   => $fine[0][$i],
                                            'additional_discount'    => $discount[0][$i],
                                            'payable'                => $payable[$i],
//                                            'payable'                => $payable[0][$i],
                                            'due_date'               => $due_date[0][$i],
                                            'created_date'           => date('Y-m-d'),
                                            'operator_id'            => $operator_id,
                                            'remarks'                => $remarks[0][$i]

                                            );

//                            echo '<pre>';                            print_r($installment_data);
                            
                               $challan_id   =   $this->Accounts_model->addInstallments($installment_data,$student_id);
                               
                               if(!$challan_id)
                               {
                                   echo 'Not Added';
                               }
                               
                          }
                        }
                      // die;

                        $this->session->set_userdata('success_msg','Student Installments Added Successfully');
                        $this->session->unset_userdata('program_id');
                        $this->session->unset_userdata('package');
                        redirect('accounts/view_package/?student_id='.$student_id);
//            }else{
//                
//                     $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
//                     redirect('accounts/installments/?student_id='.$student_id);
//            } 
        }
        
        


// view student package Form
        
        public function view_package()
        {
            $this->login_check();

            if($_GET['student_id'])
            {
                $student_id                      =   $_GET['student_id'];           
            }else{
                $student_id                      =  $this->session->userdata('student_id');
           }
           $result['std_package']                =   $this->Accounts_model->getStudentPackageInfo($student_id);
           
//           echo '<pre>';print_r($result);die;
           $program_id                          =  $result['std_package'][0]['program_id'];
           $campaign_id                         =  $result['std_package'][0]['campaign_id'];
           
           $res                                 = $this->Admin_model->getAllcampaigns();
           
            $result['student_campaign_id']             =  $result['std_package'][0]['campaign_id'];
            $result['current_campaign_id']             =  $res[0]['campaign_id'];
             
            $this->session->set_userdata('package',$result['std_package'][0]['session_total_package']);

            $this->session->set_userdata($result);
            
            $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
            
            $result['challan']               =   $this->Accounts_model->getChallanInfoStudent($program_id,$campaign_id,$student_id);
            
            
            
            $result['student_id']            =  $student_id;
            $result['program_id']            =  $program_id;
            $result['campaign_id']           =  $campaign_id;
            $result['sessions']              =  $this->Accounts_model->getSessions($student_id);
            
          // echo '<pre>';print_r($result['sessions']);die;
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/student_package/view_package', $result);
            $this->load->view('admin_ace/admin_footer');
        }

        
// view challan
        
        public function view_challan()
        {
            
            
            $this->login_check();
      
            if(!empty($_POST))
            {
               $program_id              =    $_POST['program']; 
               $campaign_id             =    $_POST['campaign'];
               
               $result['challan']       =   $this->Accounts_model->getChallanInfo($program_id,$campaign_id);
                
               $result['campaign']      = $this->Accounts_model->getAllcampaigns();
               $result['programs']      = $this->Admin_model->getAllprograms();
               
               $result['campaign_id']   =  $campaign_id;
               $result['program_id']    =  $program_id;

               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/accounts_side_menu');
               $this->load->view('accounts/student_package/viewchallan', $result);
               $this->load->view('admin_ace/admin_footer');
               
               
            }else{
                
                $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                $result['programs']     = $this->Admin_model->getAllprograms();
                
                                   
             //  echo '<pre>'; var_dump($result['campaign']);die;
                
                $program_id             =   10;                
                $campaign_id            =   $result['campaign'][0]['campaign_id'];             
                
                $result['challan']      =   $this->Accounts_model->getChallanInfo($program_id,$campaign_id);
                
                //echo '<pre>'; var_dump($result['challan']);die;
                
             
                
                $result['campaign_id']  =   $campaign_id;
                $result['program_id']   =   $program_id;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/student_package/viewchallan', $result);
                $this->load->view('admin_ace/admin_footer');
            }
            
        }
        
      
// post challan form
        
        public function post_challan_form()
        {
            
            $this->login_check();
      
           if(!empty($_POST))
            {
               $program_id              =    $_POST['program']; 
               $campaign_id             =    $_POST['campaign'];
               
               $this->session->set_userdata('program_id', $program_id);
               //$this->session->set_userdata('batch_id', $batch_id);
               
               $result['challan']       =   $this->Accounts_model->getChallanInfo($program_id,$campaign_id);
                
               //echo '<pre>';var_dump($result);die;
               
               $result['programs']      = $this->Admin_model->getAllprograms();
               $result['campaign']       = $this->Admin_model->getAllcampaigns();
               $result['campaign_id']   =  $campaign_id;
               $result['program_id']    =  $program_id;

               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/accounts_side_menu');
               $this->load->view('accounts/student_package/postchallanform', $result);
               $this->load->view('admin_ace/admin_footer');
               
               
            }else{
                
                $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                $result['programs']       = $this->Admin_model->getAllprograms();                              
                
                $campaign_id            =   $result['campaign'][0]['campaign_id'];
                $program_id             =   10;
                
                if($this->session->userdata('program_id') != '')
                {
                    $program_id             =   $this->session->userdata('program_id');                
                    //$batch_id               =   $this->session->userdata('batch_id'); 
                   
                }
                
                $result['challan']      =   $this->Accounts_model->getChallanInfo($program_id,$campaign_id);
                
                //echo '<pre>'; var_dump($result['challan']);die;
                
                $result['campaign_id']  =   $campaign_id;
                $result['program_id']   =   $program_id;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/student_package/postchallanform', $result);
                $this->load->view('admin_ace/admin_footer');
            }
        }        
        
        
// post challan
        
        public function post_challan()
        {
            
      $this->login_check();
      
          $challan_id     =   $_POST['challan_id'];
          $post_date      =   $_POST['post_date'];
          $type           =   $_POST['type'];
          $slip_no        =   $_POST['slip_no'];
          
            $result         =   $this->Accounts_model->postChallan($challan_id,$post_date,$type,$slip_no);
            
            if($result)
            {
                        $this->session->set_userdata('success_msg','Challan Posted Successfully');                        
                        redirect('accounts/post_challan_form');
            }else{
                        $this->session->set_userdata('error_msg','Challan Not Posted Successfully');                        
                        redirect('accounts/post_challan_form');
            }
        }
        
// post challan
        
        public function post_challan2()
        {
            
            
      $this->login_check();
      
          $challan_id     =   $_POST['challan_id'];
          $post_date      =   $_POST['post_date'];
          $type           =   $_POST['type'];
          $slip_no        =   $_POST['slip_no'];
          $student_id        =   $_POST['student_id'];
          
            $result         =   $this->Accounts_model->postChallan($challan_id,$post_date,$type,$slip_no);
            
            if($result)
            {
                        $this->session->set_userdata('success_msg','Challan Posted Successfully');                        
                        redirect('accounts/view_package/?student_id='.$student_id);
            }else{
                        $this->session->set_userdata('error_msg','Challan Not Posted Successfully');                        
                        redirect('accounts/view_package/?student_id='.$student_id);
            }
        }
        
        
// print challan for installment
        
        public function print_challan()
        {   
            
      $this->login_check();
      
            
           $challan_id                      =   $_GET['challan_id'];
           $student_id                      =   $_GET['student_id'];
           $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
           $result['challan_info']          =   $this->Accounts_model->getChalanInfo($challan_id,$student_id);
           $amount                          =   $result['challan_info'][0]['amount'];
           $amount_in_word                  =   $this->convert_number_to_words($amount);
           
           if($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Spring 2015'){
               $session     =   'Semester 2';
           }elseif($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Fall 2015'){
               $session     =   'Semester 3';
           }elseif($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 4';
           }
           
           elseif($result['std_package'][0]['campaign_id'] == 2 && $result['challan_info'][0]['session'] == 'Fall 2015'){
               $session     =   'Semester 2';
           }elseif($result['std_package'][0]['campaign_id'] == 2 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 3';
           }
           
           elseif($result['std_package'][0]['campaign_id'] == 3 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 2';
           }
           
           else{
               $session     =   'Semester 1';
           }
           
           
           $result['challan']   = array(
               
               'amount'           =>$amount,
               'amount_in_words'  =>$amount_in_word,
               'due_date'         =>$result['challan_info'][0]['due_date'],
               'post_date'        =>$result['challan_info'][0]['post_date'],
               'status'           =>$result['challan_info'][0]['status'],
               'challan_no'       =>$challan_id,
               'roll_no'          =>$result['std_package'][0]['roll_no'],
               'student_name'     =>$result['std_package'][0]['student_name'],
               'batch'            =>$result['std_package'][0]['batch'],
               'batch_type'       =>$result['std_package'][0]['batch_type'],
               'program_name'     =>$result['std_package'][0]['program_name'],
               'session'          =>$session,
              // 'session'          =>$result['challan_info'][0]['session'],
               'bank_name'        =>$result['std_package'][0]['bank_name'],
               'bank_address'     =>$result['std_package'][0]['bank_address'],
               'challan_title'    =>$result['std_package'][0]['challan_title'],
               'account_no'       =>$result['std_package'][0]['account_no'],
               'bank_city'        =>$result['std_package'][0]['bank_city']

            );
                   
            $this->load->view('accounts/student_package/challan', $result);
        }
        
// print challan for installment
        
        public function show_challan()
        {  
            
      $this->login_check();
      
            
           $challan_id                      =   $_GET['challan_id'];
           $student_id                      =   $_GET['student_id'];
           $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
           $result['challan_info']          =   $this->Accounts_model->getChalanInfo($challan_id,$student_id);
           $amount                          =   $result['challan_info'][0]['amount'];
           $amount_in_word                  =   $this->convert_number_to_words($amount);
           
          // echo '<pre>'; print_r($result['std_package']);die;
           
           if($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Spring 2015'){
               $session     =   'Semester 2';
           }elseif($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Fall 2015'){
               $session     =   'Semester 3';           
           }elseif($result['std_package'][0]['campaign_id'] == 1 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 4';
           }
           
           elseif($result['std_package'][0]['campaign_id'] == 2 && $result['challan_info'][0]['session'] == 'Fall 2015'){
               $session     =   'Semester 2';
           }elseif($result['std_package'][0]['campaign_id'] == 2 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 3';
           }
           
           elseif($result['std_package'][0]['campaign_id'] == 3 && $result['challan_info'][0]['session'] == 'Spring 2016'){
               $session     =   'Semester 2';
           }
           
           else{
               $session     =   'Semester 1';
           }
           
           
           
           $result['challan']   = array(
               
               'amount'           =>$amount,
               'amount_in_words'  =>$amount_in_word,
               'due_date'         =>$result['challan_info'][0]['due_date'],
               'post_date'        =>$result['challan_info'][0]['post_date'],
               'status'           =>$result['challan_info'][0]['status'],
               'challan_no'       =>$challan_id,
               'roll_no'          =>$result['std_package'][0]['roll_no'],
               'student_name'     =>$result['std_package'][0]['student_name'],
               'batch'            =>$result['std_package'][0]['batch'],
               'batch_type'       =>$result['std_package'][0]['batch_type'],
               'program_name'     =>$result['std_package'][0]['program_name'],
               //'session'          =>$result['std_package'][0]['semester'],
               'session'          =>$session,
               //'session'          =>$result['challan_info'][0]['session'],
               'bank_name'        =>$result['std_package'][0]['bank_name'],
               'bank_address'     =>$result['std_package'][0]['bank_address'],
               'challan_title'    =>$result['std_package'][0]['challan_title'],
               'account_no'       =>$result['std_package'][0]['account_no'],
               'bank_city'        =>$result['std_package'][0]['bank_city']

            );
           
          
                   
            $this->load->view('accounts/student_package/challan2', $result);
        }
     
        
        // add fine to student installment
        
        public function add_fine_form(){
            
            
      $this->login_check();
      
            
                $installment_id         =   $_GET['installment_id'];
                $student_id             =   $_GET['student_id'];
                $result['due_date']     =   $_GET['due_date'];
                //$result['challan_id']   =   $_GET['challan_id'];

                $result['installment']  =   $this->Accounts_model->InstallmentInfo($installment_id);
                $result['std_package']  =   $this->Accounts_model->getStudentPackageInfo($student_id);
                $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/student_package/addfine', $result);
                $this->load->view('admin_ace/admin_footer');
        }
        
        // add fine to student installment
        
        public function add_fine(){                        
           
            
            $this->login_check();
      
            $fine         =   $_POST['pre_fine'] + $_POST['fine'];
            if(isset($_POST['save']))
            {
                $payable        =   $_POST['payable']+$_POST['fine'];
                $fine_data = array(
                                    'fine'          =>  $fine,
                                    'payable'       =>  $payable,
                                    'due_date'      =>  $_POST['due_date'],
                                    );

                $result         =   $this->Accounts_model->addFine($_POST['id'],$fine_data);
                if($result){

                    $this->session->set_userdata('error_msg', 'Fine Added ..');
                     redirect('accounts/post_challan_form');
                }
            }
            if(isset($_POST['post']))
            {
                $payable        =   $_POST['payable']+$_POST['fine'];
                $fine_data = array(
                                    'fine'          =>  $fine,
                                    'payable'       =>  $payable,
                                    'due_date'      =>  $_POST['due_date'],
                                    );

                $result         =   $this->Accounts_model->addFine($_POST['id'],$fine_data);
                if($result){

                    $challan_id     =   $_POST['challan_id'];
                    $post_date      =   $_POST['post_date'];
                    $type           =   $_POST['type'];
                    $slip_no        =   $_POST['slip_no'];
          
                    $result         =   $this->Accounts_model->postChallan($challan_id,$post_date,$type,$slip_no);

                    if($result)
                    {
                                $this->session->set_userdata('success_msg','Challan Posted Successfully');                        
                                redirect('accounts/post_challan_form');
                    }else{
                                $this->session->set_userdata('error_msg','Challan Not Posted Successfully');                        
                                redirect('accounts/post_challan_form');
                    }
                 
                }
            }
            
            
            
        }
        
        // add fine to student installment
        
        public function add_fine_form2(){
            
            
      $this->login_check();
      
            
                $installment_id         =   $_GET['installment_id'];
                $student_id             =   $_GET['student_id'];
                $result['due_date']     =   $_GET['due_date'];
                $result['student_id']   =   $student_id;

                $result['installment']  =   $this->Accounts_model->InstallmentInfo($installment_id);
                
                $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
                $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/student_package/addfine2', $result);
                $this->load->view('admin_ace/admin_footer');
        }
        
        // add fine to student installment
        
        public function add_fine2(){                        
            
            
      $this->login_check();
      
            
            $student_id   =   $_POST['student_id'];            
            $fine         =   $_POST['pre_fine'] + $_POST['fine'];
            
            if(isset($_POST['save']))
            {
                $payable        =   $_POST['payable']+$_POST['fine'];
                $fine_data = array(
                                    'fine'          =>  $fine,
                                    'payable'       =>  $payable,
                                    'due_date'      =>  $_POST['due_date'],
                                    );

                $result         =   $this->Accounts_model->addFine($_POST['id'],$fine_data);
                if($result){

                    $this->session->set_userdata('error_msg', 'Fine Added ..');
                     redirect('accounts/view_package/?student_id='.$student_id);
                }
            }
            if(isset($_POST['post']))
            {
                $payable        =   $_POST['payable']+$_POST['fine'];
                $fine_data = array(
                                    'fine'          =>  $fine,
                                    'payable'       =>  $payable,
                                    'due_date'      =>  $_POST['due_date'],
                                    );

                $result         =   $this->Accounts_model->addFine($_POST['id'],$fine_data);
                if($result){

                    $challan_id     =   $_POST['challan_id'];
                    $post_date      =   $_POST['post_date'];
                    $type           =   $_POST['type'];
                    $slip_no        =   $_POST['slip_no'];
          
                    $result         =   $this->Accounts_model->postChallan($challan_id,$post_date,$type,$slip_no);

                    if($result)
                    {
                                $this->session->set_userdata('success_msg','Challan Posted Successfully');                        
                                redirect('accounts/view_package/?student_id='.$student_id);
                    }else{
                                $this->session->set_userdata('error_msg','Challan Not Posted Successfully');                        
                                redirect('accounts/view_package/?student_id='.$student_id);
                    }
                 
                }
            }
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
            40 => 'Fourty',
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
          $this->load->view('admin_ace/accounts_side_menu');
          $this->load->view('accounts/form/view_form_student_info', $result);
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
                    redirect('accounts/view_student_form');
                 
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
                
                 redirect('accounts/view_student_form');
               
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
                        redirect('accounts/student_package/?student_id='.$student_id);
                    }else{
                        $this->session->set_userdata('success_msg','Package Not Deleted ');
                        redirect('accounts/view_student_form');
                    }
                  
            }else{
                $this->session->set_userdata('error_msg','Student Form Info  not updated!');
                redirect('accounts/view_student_form');                 
            }
            
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
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/form/editform',$result);
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
                        $this->load->view('admin_ace/accounts_side_menu');
                        $this->load->view('accounts/form/editform',$result);
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
                           redirect('accounts/view_student_form');
                       }else{
                            $this->session->set_userdata('error_msg','Student Info  Not Updated, Please try again! ');
                            redirect('accounts/view_student_form');                            
                       }
                
            
            }
        }
        
        
    public function revise_package(){
      $this->login_check();
      
        
       $student_id             =   $_GET['student_id'];        
        $delete_package         =   $this->Accounts_model->deletePackage($student_id);
        
        if($delete_package){
            $this->session->set_userdata('success_msg','Package Revised Successfully ');
            redirect('accounts/student_package2/?student_id='.$student_id);
        }else{
            $this->session->set_userdata('success_msg','Package Not Revised ');
            redirect('accounts/view_student_form');
        }
        
    }
    
    
    public function test()
    {
        echo strtotime('2014-09-30')- strtotime('2014-09-24');
    }
    
    
    //   ********************************      Print All Challan    *******************************************   \\
    
        public function print_challan_form()
        {
          $this->login_check();
          $result['campus']   = $this->Admin_model->getAllCampuses();
          $result['campaign'] = $this->Accounts_model->getAllcampaigns();
          $result['sessions'] = $this->Admin_model->getAllsessions();
          
//          echo '<pre>';
//          var_dump($result['sessions']);die;
         
          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/accounts_side_menu');
          $this->load->view('accounts/student_package/print_challan_form', $result);
          $this->load->view('admin_ace/admin_footer');          
        }
        
        public function print_all_challans()
        {
          $this->login_check();
       
          if($this->session->userdata('role') != 'HOD'){
            $campus_id = $this->session->userdata('campus_id');        
          }else{
            $campus_id = $_POST['campus'];
          } 
          //echo $campus_id;die;
          $campaign_id  = $_POST['campaign']; 
          $program_id   = $_POST['program']; 
          $session_id   = $_POST['session']; 
          
          $start_date   = $_POST['start_date']; 
          $end_date     = $_POST['end_date']; 
         //echo $start_date; echo '<br>'.$end_date;die;
          
          $res_ch = $this->Accounts_model->getPrintChallans($campaign_id, $campus_id, $program_id,$session_id, $start_date, $end_date); 
         // echo '<pre>';var_dump($res_ch);die;
          
          $result['challans'] = $res_ch;          
         
          if(count($res_ch) > 0){
          
          
          
          for($i=0; $i<count($res_ch); $i++){
            $std_id = $res_ch[$i]['student_id'];
            
            $result['installments'][] = $this->Accounts_model->getInstallments($std_id,$end_date);            
            $result['amount_in_word'][] = $this->convert_number_to_words($res_ch[$i]['payable']);
          }          
          //echo '<pre>';var_dump($result);echo '</pre>';exit;
          $this->load->view('accounts/student_package/printAllChallan', $result);
          
          }else{
              
              $this->session->set_userdata('success_msg','Record  Not Found');
                redirect('accounts/print_challan_form');
          }
        }
    
    
    //   ********************************    END  Print All Challan    *******************************************   \\
    
        
    //   ********************************    START  change due of Challan    *******************************************   \\
    
    
         public function due_date_form()
                {
                  $this->login_check();

                  $result['campus']   = $this->Admin_model->getAllCampuses();
                  $result['campaign'] = $this->Accounts_model->getAllcampaigns();
                  $result['program']  = $this->Admin_model->getAllprograms();

                  $this->load->view('admin_ace/admin_header');
                  $this->load->view('admin_ace/accounts_side_menu');
                  $this->load->view('accounts/due_date/change_due_date', $result);
                  $this->load->view('admin_ace/admin_footer');   

                }
  
        public function change_due_date()
                {
                  $this->login_check();

                  if($this->session->userdata('role') != 'HOD'){
                    $campus_id = $this->session->userdata('campus_id');        
                  }else{
                    $campus_id = $_POST['campus'];
                  }         
                  
                  $campaign_id= $this->input->post('campaign');
                  $program_id = $_POST['program'];
                  $start_date = $_POST['start_date'];
                  $end_date   = $_POST['end_date'];
                  $new_date   = $_POST['new_date'];
                 
                
                  $res = $this->Accounts_model->changeDueDate($campaign_id,$campus_id, $program_id,  $start_date, $end_date);
                  
                 // echo count($res);die;

                  if(count($res) > 0)
                  {
                      foreach($res AS $row){
                          $installment_id       =   $row['installment_id'];
                          $result               =   $this->Accounts_model->UpdateDueDate($installment_id,$new_date);
                      }
                      
                      $this->session->set_userdata('success_msg', 'Due Date Successfully Changed'); 
                      redirect('accounts/due_date_form');
                      
                  }else{
                      $this->session->set_userdata('error_msg', 'Record Not Found'); 
                      redirect('accounts/due_date_form');
                  }
                

                }
                
                
                public function challan_issue_form()
                    {
                      $this->login_check();

                      $result['campus']   = $this->Admin_model->getAllCampuses();
                      $result['campaign'] = $this->Accounts_model->getAllcampaigns();
                      $result['program']  = $this->Admin_model->getAllprograms();

                      $this->load->view('admin_ace/admin_header');
                      $this->load->view('admin_ace/accounts_side_menu');
                      $this->load->view('accounts/challan_issue/challanissueForm', $result);
                      $this->load->view('admin_ace/admin_footer');   

                    }


                public function challan_issue()
                    {
                      $this->login_check();

                      if($this->session->userdata('role') != 'HOD'){
                            $campus_id = $this->session->userdata('campus_id');        
                          }else{
                            $campus_id = $_POST['campus'];
                          }  
                          
                      $program_id  = $_POST['program'];
                      $campaign_id = $_POST['campaign'];
                      $start_date  = $_POST['start_date'];
                      $end_date    = $_POST['end_date'];
                      
                     
                      $result['challan'] = $this->Accounts_model->challanIssue($campus_id, $campaign_id, $program_id, $start_date, $end_date);

                     // echo '<pre>';var_dump($result);die;
                      
                      $result['s_date'] = $start_date;
                      $result['e_date'] = $end_date;
                      $result['campus_id'] = $campus_id;

                      $this->load->view('admin_ace/admin_header');
                      $this->load->view('accounts/challan_issue/challanissueView', $result);
                      $this->load->view('admin_ace/admin_footer'); 

                    } 
                    
                    
                              
                    
            public function printStudentInfo()
            {
                $this->login_check();
                $student_id = $_GET['student_id'];

                
                $result['std_package']           =   $this->Accounts_model->getStudentPackageInfo($student_id);
                
                $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
              
                $this->load->view('accounts/student_package/printStudentStatus', $result);
            }


		   
             // get program info shift wise
    
            public function get_program_info()
            {

             // $this->login_check();

                $type   =   $_POST['type'];
                $result['program']  =   $this->Admission_r_model->getProgramInfo($type);
                $this->load->view('admissions_r/inquiry/progPartial', $result);

            }
            
            
            function unpaid_challan_status(){
                
                        $this->login_check();

                        $challan_id = $this->uri->segment(3);
                        $student_id = $this->uri->segment(4);

                        $res = $this->Accounts_model->challanStatusUnpaid($challan_id);

                        if($res != 0){
                          $this->session->set_userdata('success_msg', 'Challan Successfully Unpaided');
                          redirect('accounts/view_package/?student_id='.$student_id);      
                        }
                        else{
                          $this->session->set_userdata('success_msg', 'Challan could not be Unpaided');
                          redirect('accounts/view_package/?student_id='.$student_id);            
                        }
              }
                  
                    
        
    //   ********************************    END  change due of Challan    *******************************************   \\
    
    
// *********************  START Promote Students to the next session and generate 2 challans of 50% amount of package (session_fee+ mis_fee)   
              
    public function promote_students_form(){
        
        $this->login_check();
        
        
        $result['campaign']       = $this->Accounts_model->getAllcampaigns(); 
        $result['programs']      = $this->Admin_model->getAllprograms();
        $result['campus']        = $this->Admin_model->getAllCampuses();
        $result['sessions']      = $this->Admin_model->getAllSessions();
        $res                     = $this->Accounts_model->getCurrentSession();
        $result['crnt_ses_id']   = $res->session_id;
        
        //echo '<pre>';print_r($result['current_session_id']);die;
                        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/accounts_side_menu');
        $this->load->view('accounts/promoteForm', $result);
        $this->load->view('admin_ace/admin_footer');   
        
    }   
    
    public function promote_students_form2(){
        
        $this->login_check();
        
        $result['campaign']       = $this->Accounts_model->getAllcampaigns();
        $result['programs']      = $this->Admin_model->getAllprograms();
        $result['campus']        = $this->Admin_model->getAllCampuses();
        $result['sessions']      = $this->Admin_model->getAllSessions();
        $res                     = $this->Accounts_model->getCurrentSession();
        $result['crnt_ses_id']   = $res->session_id;
        
        //echo '<pre>';print_r($result['current_session_id']);die;
                        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/accounts_side_menu');
        $this->load->view('accounts/promoteForm2', $result);
        $this->load->view('admin_ace/admin_footer');   
        
    }   
    
    
    public function get_Next_session(){
        $session_id     =   $this->input->post('session_id');
        
        $result['next_session']   =   $this->Accounts_model->getNextSession($session_id);
        
//        echo '<pre>';print_r($next_session);
        
        $this->load->view('accounts/sessionPartial',$result);
    }
    
    public function promote_students(){
        
        $this->login_check();
        
        
        $this->form_validation->set_rules('program', 'Program', 'required');
        $this->form_validation->set_rules('pre_session', 'Session (For Promote)', 'required');
        $this->form_validation->set_rules('cur_session', 'Session (To Promote)', 'required');
        $this->form_validation->set_rules('first', '1st Challan Due Date', 'required');
        $this->form_validation->set_rules('second', '2nd Challan Due Date', 'required');
        

        if ($this->form_validation->run() == FALSE) {

            $result['programs']      = $this->Admin_model->getAllprograms();
            $result['campus']        = $this->Admin_model->getAllCampuses();
            $result['sessions']      = $this->Admin_model->getAllSessions();
            $res                     = $this->Accounts_model->getCurrentSession();
            $result['crnt_ses_id']   = $res->session_id;

            //echo '<pre>';print_r($result['current_session_id']);die;

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/promoteForm', $result);
            $this->load->view('admin_ace/admin_footer');
            
        } else {
        
                $program_id      =   $_POST['program'];
                $campaign_id     =   $_POST['campaign'];
                $pre_session     =   $_POST['pre_session'];
                $cur_session     =   $_POST['cur_session'];
                $first_date      =   $_POST['first'];
                $second_date     =   $_POST['second'];

                $result          =   $this->Accounts_model->promoteStudents($program_id,$pre_session,$campaign_id);
//                echo count($result);die;
                if(count($result) > 0){

                                                            //  echo '<pre>'; var_dump($result);die;

                                                              foreach($result AS $row){

                                                                              $operator_id    = $this->session->userdata('sub_login_id');
                                                                              $student_id     = $row['student_id'];
                                                                              $next_semester  = $row['semester']+1;

                                                                              $total_fee      =   $row['session_fee']+ $row['misc_fee'];
                                                                              // For MBBS
                                                                              if($total_fee >= 100000){
                                                                                  $tax            =   5*$total_fee/100;
                                                                                  $fee            =   $total_fee+$tax;
                                                                              }else{                                    
                                                                                  $fee            = $row['session_fee']+$row['misc_fee'];
                                                                              }


                                                                              $check_data     = array(
                                                                                                  'student_id' => $student_id,
                                                                                                  'session_id' => $cur_session
                                                                                              );
                                                                             // echo '<pre>'; var_dump($check_data);
                                                                              $res            = $this->Accounts_model->chkSession_inInstallment($check_data);
                                                                             // echo '<br>';
                                                                              if($res == 0){

                                                                                  // For Mbbs 
                                                                                  if($program_id == 53 ||  $program_id == 9){                                        
                                                                                                          for($i=0; $i < 1; $i++)
                                                                                                          {                                
                                                                                                              if($i==0){$due_date = $first_date;}else{$due_date = $second_date;}
                                                                                                              $installment_data = array(
                                                                                                                              'installment_no'         => $i+1,
                                                                                                                              'student_id'             => $student_id,
                                                                                                                              'program_id'             => $program_id,
                                                                                                                              'session_id'             => $cur_session,
                                                                                                                              'fee'                    => $fee,
                                                                                                                              'fine'                   => 0,
                                                                                                                              'additional_discount'    => 0,
                                                                                                                              'payable'                => $fee,
                                                                                                                              'due_date'               => $due_date,
                                                                                                                              'created_date'           =>date('Y-m-d'),
                                                                                                                              'operator_id'            => $operator_id
                                                                                                                              );
                                                                                                              $challan_id   =   $this->Accounts_model->addInstallments($installment_data,$student_id);
                                                                                                              if(!$challan_id)
                                                                                                              {
                                                                                                                  $this->session->set_userdata('success_msg', 'Installments Not Added.');
                                                                                                                  redirect('accounts/promote_students_form');
                                                                                                              }else{
                                                                                                                      
                                                                                                                          $res   =   $this->Accounts_model->update_semester($student_id,$next_semester,$cur_session);
                                                                                                                      
                                                                                                              }
                                                                                                          }

                                                                                  }else{
                                                                                                          for($i=0; $i < 2; $i++)
                                                                                                          {                                

                                                                                                              if($i==0){$due_date = $first_date;}else{$due_date = $second_date;}

                                                                                                              $installment_data = array(
                                                                                                                              'installment_no'         => $i+1,
                                                                                                                              'student_id'             => $student_id,
                                                                                                                              'program_id'             => $program_id,
                                                                                                                              'session_id'             => $cur_session,
                                                                                                                              'fee'                    => $fee/2,
                                                                                                                              'fine'                   => 0,
                                                                                                                              'additional_discount'    => 0,
                                                                                                                              'payable'                => $fee/2,
                                                                                                                              'due_date'               => $due_date,
                                                                                                                              'created_date'           =>date('Y-m-d'),
                                                                                                                              'operator_id'            => $operator_id
                                                                                                                              );
                                                                                                              $challan_id   =   $this->Accounts_model->addInstallments($installment_data,$student_id);
                                                                                                              if(!$challan_id)
                                                                                                              {
                                                                                                                  $this->session->set_userdata('success_msg', 'Installments Not Added.');
                                                                                                                  redirect('accounts/promote_students_form');
                                                                                                              }else{
                                                                                                                     
                                                                                                                          $res   =   $this->Accounts_model->update_semester($student_id,$next_semester,$cur_session);
                                                                                                                     
                                                                                                              }
                                                                                                          }
                                                                                  }

                                                                              }
                                              //                                else{
                                              //                                    $this->session->set_userdata('success_msg', 'Installments of this Session Already Added.');
                                              //                                    redirect('accounts/promote_students_form');
                                              //                                }
                                                              }


                                        $this->session->set_userdata('success_msg', 'Students Promoted Successfully.');
                                        redirect('accounts/promote_students_form');
                                }else{
                                       $this->session->set_userdata('success_msg', 'Record Not Found.');
                                        redirect('accounts/promote_students_form');
                                }
                                
        }
    }
              
// *********************  END Promote Students to the next session and generate 2 challans of 50% amount of package (session_fee+ mis_fee)                 
              
  
    
    
    
    
// Accounts Module for Course Registration Students Start

     public function add_submitted_fee_form()
    {
        $this->login_check();
      
                $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
                $result['sessions']       = $this->Admin_model->getAllSessions();
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/CR/add_std_fee_form', $result);
                $this->load->view('admin_ace/admin_footer');
            

    }
  
     public function add_submitted_fee_form2()
    {
        $this->login_check();
      
          
        $program_id              =    $_POST['program']; 
        $campaign_id             =    $_POST['campaign'];
        $student_id              =    $_POST['roll_no'];
        $session_id              =    $_POST['session'];

        $no_of_courses           =    $this->Accounts_model->getNoOfCourses($program_id);
        
        $check_data              =    array('student_id' => $student_id,'session_id' => $session_id);


        $res         = $this->Accounts_model->chkSession_inInstallment($check_data);       

        //echo $res;

        if($res == 0)
        {
            $result['info']             =    $this->Accounts_model->getFeeInfo($student_id,$session_id);

            
            $result['original_fpc']    =   $this->Accounts_model->getOriginalFeePerCourse($program_id,$no_of_courses,$campaign_id); 
            
            $result['discounted_fpc']  =   $this->Accounts_model->getDiscountedFeePerCourse($program_id,$student_id,$no_of_courses); 
            //echo '<pre>';print_r($result['info']);die;
            


            $this->session->set_userdata('program_id', $program_id);
            $this->session->set_userdata('campaign_id', $campaign_id);


            $result['campaign']       = $this->Accounts_model->getAllcampaigns();
            $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
            $result['sessions']       = $this->Admin_model->getAllSessions();

            $result['campaign_id']   =  $campaign_id;
            $result['program_id']    =  $program_id;

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/CR/add_std_fee_form2', $result);
            $this->load->view('admin_ace/admin_footer');
        }else{

                 $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
                  redirect('accounts/view_package/?student_id='.$student_id);
        } 
    }
  
     public function add_submitted_fee()
    {
        $this->login_check();
        
        
            $session_id     = $_POST['session'];
            $student_id     = $_POST['student_id'];
            $installment_no = $_POST['installment_no'];
            
            
            $check_data     = array('student_id' => $student_id, 'session_id' => $session_id);
            
            $result         = $this->Accounts_model->chkSession_inInstallment($check_data);                
            
            if($result == 0)
            {
            
                        $student_id     = $student_id;
                        $program_id     = $_POST['program'];
                        $operator_id    = $this->session->userdata('sub_login_id');
     
                        $amount[]       = $_POST['installment_amount'];                       
                        $due_date[]     = $_POST['due_date'];

                        for($i=0; $i <= 1; $i++)
                        {

                          if($amount[0][$i] != '')
                          {
                                          
                            $installment_data = array(
                                            'installment_no'         => $i+1,
                                            'student_id'             => $student_id,
                                            'program_id'             => $program_id,
                                            'session_id'             => $session_id,
                                            'fee'                    => $amount[0][$i],                                            
                                            'payable'                => $amount[0][$i],
                                            'due_date'               => $due_date[0][$i],
                                            'created_date'           =>date('Y-m-d'),
                                            'operator_id'            => $operator_id

                                            );
//                            echo '<pre>';
//                            print_r($installment_data);die;

                               $challan_id   =   $this->Accounts_model->addInstallments($installment_data,$student_id);
                               
                               if(!$challan_id)
                               {
                                   echo 'Not Added';
                               }
                               
                          }
                        }

                        $this->session->set_userdata('success_msg','Student Installments Added Successfully');
                        $this->session->unset_userdata('program_id');
                        $this->session->unset_userdata('package');
                        redirect('accounts/view_package/?student_id='.$student_id);
            }else{
                
                     $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
                    redirect('accounts/view_package/?student_id='.$student_id);
            } 

               
    }
  
    public function  get_students_rollno(){
        $program_id  = $_POST['program_id'];
        $campaign_id = $_POST['campaign_id'];
        $result['roll_no']       =   $this->Accounts_model->getStudentsRollNo($program_id,$campaign_id);
        
        echo $this->load->view('accounts/CR/roll_no_partial',$result);
        
        //echo '<pre>';var_dump($result);die;
               
    }
    
    
     public function printStudentCoursesInfo()
            {
                $this->login_check();
                
               $program_id              =    $this->uri->segment(5);                
               $student_id              =    $this->uri->segment(3);
               $session_id              =    $this->uri->segment(4);
               
               $no_of_courses           =    $this->Accounts_model->getNoOfCourses($program_id);
               
                $result['info']             =    $this->Accounts_model->getFeeInfo($student_id,$session_id);

                 $result['original_fpc']    =   $this->Accounts_model->getOriginalFeePerCourse($program_id,$no_of_courses); 
                 $result['discounted_fpc']  =   $this->Accounts_model->getDiscountedFeePerCourse($program_id,$student_id,$no_of_courses); 

//                 echo '<pre>';print_r($result);die;


                 $this->session->set_userdata('program_id', $program_id);
                 $this->session->set_userdata('campaign_id', $campaign_id);




                  $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                  $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
                  $result['sessions']       = $this->Admin_model->getAllSessions();

                 $result['campaign_id']   =  $campaign_id;
                 $result['program_id']    =  $program_id;
                               
                $this->load->view('accounts/CR/printStudentCoursesinfo', $result);
            }
    
// Accounts Module for Course Registration Students End
 
         
        
        public function test22(){
                $this->login_check();
      
                $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
                $result['sessions']       = $this->Admin_model->getAllSessions();
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/accounts_side_menu');
                $this->load->view('accounts/CR/add_std_fee_form22', $result);
                $this->load->view('admin_ace/admin_footer');
        }
            
        
        public function add_submitted_fee_form222()
        {
        $this->login_check();
      
          
               $program_id              =    $_POST['program']; 
               $campaign_id             =    $_POST['campaign'];
               $student_id              =    $_POST['roll_no'];
               $session_id              =    $_POST['session'];
               
               $no_of_courses           =    $this->Accounts_model->getNoOfCourses($program_id);
               
               echo '<pre>';
               var_dump($no_of_courses);
               echo '</pre>';
               
               
               $check_data              =    array('student_id' => $student_id,'session_id' => $session_id);
               $res         = $this->Accounts_model->chkSession_inInstallment($check_data);       
               
               if($res == 0)
                        {
                                             $result['info']             =    $this->Accounts_model->getFeeInfo($student_id,$session_id);

                                              $result['original_fpc']    =   $this->Accounts_model->getOriginalFeePerCourse($program_id,$no_of_courses,$campaign_id); 
                                              $result['discounted_fpc']  =   $this->Accounts_model->getDiscountedFeePerCourse($program_id,$student_id,$no_of_courses); 

//                                              echo '<pre>';print_r($result);die;


                                              $this->session->set_userdata('program_id', $program_id);
                                              $this->session->set_userdata('campaign_id', $campaign_id);




                                               $result['campaign']       = $this->Accounts_model->getAllcampaigns();
                                               $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
                                               $result['sessions']       = $this->Admin_model->getAllSessions();

                                              $result['campaign_id']   =  $campaign_id;
                                              $result['program_id']    =  $program_id;

                                              $this->load->view('admin_ace/admin_header');
                                              $this->load->view('admin_ace/accounts_side_menu');
                                              $this->load->view('accounts/CR/add_std_fee_form222', $result);
                                              $this->load->view('admin_ace/admin_footer');
                        }else{

                                 $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
                                  redirect('accounts/view_package/?student_id='.$student_id);
                        } 
    }
    
  // ************** view fee per course 
    
    public function view_fee_per_course()
    {
        $this->login_check();
      
          
        $student_id              =    $this->uri->segment(3);
        $program_id              =    $this->uri->segment(4);
        $campaign_id             =    $this->uri->segment(5);
        $session_id              =    $this->uri->segment(6);

        $no_of_courses           =    $this->Accounts_model->getNoOfCourses($program_id);
        
        $check_data              =    array('student_id' => $student_id,'session_id' => $session_id);


        $res         = $this->Accounts_model->chkSession_inInstallment($check_data);       

        //echo $res;

        if($res > 0)
        {
            $result['info']             =    $this->Accounts_model->getFeeInfo($student_id,$session_id);

            
            $result['original_fpc']    =   $this->Accounts_model->getOriginalFeePerCourse($program_id,$no_of_courses,$campaign_id); 
            
            $result['discounted_fpc']  =   $this->Accounts_model->getDiscountedFeePerCourse($program_id,$student_id,$no_of_courses); 
            //echo '<pre>';print_r($result['discounted_fpc']);die;
            


            $this->session->set_userdata('program_id', $program_id);
            $this->session->set_userdata('campaign_id', $campaign_id);


            $result['campaign']       = $this->Accounts_model->getAllcampaigns();
            $result['programs']       = $this->Admin_model->getAllprogramsHR(4);                              
            $result['sessions']       = $this->Admin_model->getAllSessions();

            $result['campaign_id']   =  $campaign_id;
            $result['program_id']    =  $program_id;

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/accounts_side_menu');
            $this->load->view('accounts/CR/view_per_course_fee', $result);
            $this->load->view('admin_ace/admin_footer');
        }else{

                 $this->session->set_userdata('error_msg','Record Not Found!');
                  redirect('accounts/view_package/?student_id='.$student_id);
        } 
    }
        
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */