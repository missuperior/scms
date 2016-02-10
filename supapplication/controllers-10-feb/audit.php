<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Audit extends CI_Controller {

    public function __construct() {

    parent::__construct();

    
    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Accounts_model');
    $this->load->model('Account_reports_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {

    $this->load->view('audit/login');
  }
  
  
     
  // for verification of admin login

  public function login_check() {

            
            if ($this->session->userdata('sub_login_id') == '' || $this->session->userdata('sub_login') == '' || $this->session->userdata('account_role_id') != 5) {
              redirect('audit/index');
         }
        }
  
    public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('audit/login');
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
                  redirect('audit/dashboard');
                } else {

                  $this->session->set_userdata('error', 'Incorrect Username OR Password');
                  redirect('audit/index');
                }
      }else{
                 $this->session->set_userdata('error', 'Please Login from Audit Login.');
                 redirect('audit/index');
          
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
                 redirect('audit/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('audit/change_password_form');
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
    $this->load->view('admin_ace/audit_side_menu');
    $this->load->view('audit/dashboard', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  public function all_ins_report_form(){
      
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['sessions']  = $this->Admin_model->getAllSessions();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/audit_side_menu');
//      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }     
      $this->load->view('audit/reports/installments/all_ins_form', $result);      
      $this->load->view('admin_ace/admin_footer');
      
  } 
  
   public function all_ins()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $session_id           =   $_POST['session'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     
      $result['session']    =   $this->Admin_model->getSession($session_id);
      
      
      
     $result['ins_report']     =   $this->Account_reports_model->getAllIns($campaign_id,$campus_id,$program_id,$start_date,$end_date);        

     //echo '<pre>';var_dump($result);die;
     
     $result['campus_id']          =   $campus_id;
     $result['program_id']         =   $program_id;
     $result['session_id']         =   $session_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('audit/reports/installments/all_ins_view',$result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  public function paid_ins_report_form(){
      
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['sessions']  = $this->Admin_model->getAllSessions();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/audit_side_menu');
//      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }     
      $this->load->view('audit/reports/installments/paid_ins_form', $result);      
      $this->load->view('admin_ace/admin_footer');
      
  } 
  
   public function paid_ins()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $session_id           =   $_POST['session'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     
      $result['session']    =   $this->Admin_model->getSession($session_id);
      
      
      
     $result['ins_report']     =   $this->Account_reports_model->getAllIns($campaign_id,$campus_id,$program_id,$start_date,$end_date);        

     //echo '<pre>';var_dump($result);die;
     
     $result['campus_id']          =   $campus_id;
     $result['program_id']         =   $program_id;
     $result['session_id']         =   $session_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('audit/reports/installments/paid_ins_view',$result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  
  
  public function ins_sum_form(){
      
      
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['sessions']  = $this->Admin_model->getAllSessions();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/audit_side_menu');
      $this->load->view('audit/reports/installments/ins_sum_form', $result);      
      $this->load->view('admin_ace/admin_footer');
      
      
  }
  
  
   public function ins_sum()
        {
            $this->login_check();

           if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
              $campus_id     =   $this->session->userdata('campus_id');        
            }else{
              $campus_id     =    $_POST['campus'];
            }

            $campaign_id          =   $_POST['campaign'];      
            $program_id           =   $_POST['program'];      
            $session_id           =   $_POST['session'];      
            $start_date           =   $_POST['s_date'];
            $end_date             =   $_POST['e_date'];


            $result['session']    =   $this->Admin_model->getSession($session_id);



           $result['ins_report']     =   $this->Account_reports_model->getAllIns($campaign_id,$campus_id,$program_id,$start_date,$end_date);        

           //echo '<pre>';var_dump($result);die;

           $result['campus_id']          =   $campus_id;
           $result['program_id']         =   $program_id;
           $result['session_id']         =   $session_id;
           $result['start_date']         =   $start_date;
           $result['end_date']           =   $end_date;

           $this->load->view('admin_ace/admin_header');      
           $this->load->view('audit/reports/installments/ins_sum_view',$result);
           $this->load->view('admin_ace/admin_footer');
        }
  
  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */