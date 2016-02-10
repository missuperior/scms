<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_reports extends CI_Controller {

    public function __construct() {

    parent::__construct();
    
    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Account_reports_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  // for verification of admin login

  public function login_check() {

    if ($this->session->userdata('sub_login_id') == '' && $this->session->userdata('sub_login') == '') {
      redirect('admission_r/index');
    }
  }
  
   // admin dashboard

  public function dashboard() { 
      
    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }
  
  //    *****   Package Reports Start   *****   \\
  
   public function campus_wise_form()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }           
      $this->load->view('accounts/reports/package/campuswiseform', $result);      
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function campus_wise_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      //echo $campus_id;die;
     
      $campaign_id          =   $_POST['campaign'];      
      $status               =   $_POST['status'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['package_report']     =   $this->Account_reports_model->getCampusWise($campaign_id,$campus_id,$status,$start_date,$end_date);        

     $result['campus_id']          =   $campus_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/package/campuswiseView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
 
  
  
   public function program_wise_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/package/programwiseform', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function program_wise_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];
      $status               =   $_POST['status'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['package_report']     =   $this->Account_reports_model->getProgramWise($campaign_id,$campus_id,$program_id,$status,$start_date,$end_date);        

     $result['campus_id']          =   $campus_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/package/programwiseView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
 
  //    *****   Installments Reports Start   *****   \\
  
   public function ins_campus_wise_form()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }     
      $this->load->view('accounts/reports/installments/inscampuswiseForm', $result);      
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function ins_campus_wise()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['ins_report']     =   $this->Account_reports_model->getCampusWiseInstallment($campaign_id,$campus_id,$program_id,$start_date,$end_date);        

     //echo '<pre>';var_dump($result);die;
     
     $result['campus_id']          =   $campus_id;
     $result['program_id']          =   $program_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/installments/inscampuswiseView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
 
  
   public function non_ins_form()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
     
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }     
      $this->load->view('accounts/reports/installments/nonInsForm', $result);      
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function non_ins()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['ins_report']     =   $this->Account_reports_model->getNonInstallment($campaign_id,$campus_id,$program_id,$start_date,$end_date);        

     //echo '<pre>';var_dump($result);die;
     
     $result['campus_id']          =   $campus_id;
     $result['program_id']          =   $program_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/installments/nonInsView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
 
  
  
  
 
  
  //   *************** Start For Student Info Tab   *****************   \\
  
     public function address_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/studentinfo/addressform', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function address_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $shift                =   $_POST['shift'];
      
      
     $result['address_report']     =   $this->Account_reports_model->getAddressWise($campaign_id,$campus_id,$program_id,$shift);        

     $result['campus_id']          =   $campus_id;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/studentinfo/addressView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  
     public function section_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/studentinfo/sectionform', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function section_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $shift                =   $_POST['shift'];
      
      
     $result['address_report']     =   $this->Account_reports_model->getSectionWise($campaign_id,$campus_id,$program_id,$shift);        

     $result['campus_id']          =   $campus_id;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/studentinfo/sectionView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
  
   public function status_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/studentinfo/statusform', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function status_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
     
      $campaign_id          =   $_POST['campaign'];      
      $program_id           =   $_POST['program'];      
      $shift                =   $_POST['shift'];
      $status               =   $_POST['status'];
      
      
     $result['address_report']     =   $this->Account_reports_model->getStatusWise($campaign_id,$campus_id,$program_id,$shift,$status);        

     $result['campus_id']          =   $campus_id;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('accounts/reports/studentinfo/statusView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  
  // bank cash reports 
  
    public function date_wise_bank_cash_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['sessions']  = $this->Admin_model->getAllSessions();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/bank_cash_reports/datewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function date_wise_bank_cash_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      
      $session_id           =   $_POST['session'];  
      $campaign_id  =   $_POST['campaign'];
      $shift        =   $_POST['shift'];
      $program_id   =   $_POST['program'];
      $start_date   =   $_POST['s_date'];
      $end_date     =   $_POST['e_date'];
     
    
            
      $result['posted_report']      =   $this->Account_reports_model->dateWiseBankCashReport($session_id,$shift,$campus_id, $campaign_id, $program_id,  $start_date, $end_date);
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      $result['program']            =   $program_id;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/bank_cash_reports/datewiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
    public function program_wise_bank_cash_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      $result['sessions']  = $this->Admin_model->getAllSessions();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/bank_cash_reports/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_bank_cash_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $session_id           =   $_POST['session'];  
      $campaign_id  =   $_POST['campaign'];
      $shift        =   $_POST['shift'];
      $program_id   =   $_POST['program'];
      $type         =   $_POST['type'];
      $start_date   =   $_POST['s_date'];
      $end_date     =   $_POST['e_date'];
            
      $result['posted_report']      =   $this->Account_reports_model->programWiseBankCashReport($session_id,$shift,$campus_id, $campaign_id, $program_id, $type, $start_date, $end_date);
//      echo '<pre>';
//      var_dump($result);die;
      
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      $result['program']            =   $program_id;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/bank_cash_reports/programwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  //   *************** ENd  For Student Info Tab   *****************   \\

   public function receivable_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
//            echo '<pre>';
//      print_r($result); die;
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();      

      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/month_receivable/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  } 
  
  
  public function receivable_report()
  {
      $this->login_check();      
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      
      $campaign_id  = $_POST['campaign'];      
      $start_date   = $_POST['s_date'];      
      $end_date     = $_POST['e_date'];      

//      $campus   = $this->Accounts_model->getCampusClosinName($campus_id);
//      $campaign = $this->Accounts_model->getCampaignName($campaign_id);
      
     
       $result['receivable'] = $this->Account_reports_model->campusClosingReceivable($campaign_id, $campus_id, $start_date, $end_date);        
     
      
//      echo '<pre>';
//      print_r($result); die;
      
      $result['start_date']     =   $start_date;
      $result['end_date']       =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/month_receivable/campuswiseclosingView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function received_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();      

      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/month_received/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  } 
  
  
  public function received_report()
  {
      $this->login_check();      
      
        
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
     
      $campaign_id  = $_POST['campaign'];      
      $start_date   = $_POST['s_date'];      
      $end_date     = $_POST['e_date'];      
      
      
      $result['receivable'] = $this->Account_reports_model->campusClosingReceived($campaign_id, $campus_id, $start_date, $end_date);        
      
      
      $result['start_date']     =   $start_date;
      $result['end_date']       =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/month_received/campuswiseclosingView', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
  // ****************  DEFAULTER REPORTS START    *********************  \\
  
  
  public function campus_wise_defaulter_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
//      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_reports/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_defaulter_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['defaulter_report']     =   $this->Account_reports_model->getCampusWiseDefaulter($campaign_id,$campus_id,$shift,$start_date,$end_date);
            
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_reports/campuswisedefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_cell_defaulter_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
//      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_reports/campuswisecellForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_cell_defaulter_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['defaulter_report']     =   $this->Account_reports_model->getCampusWiseDefaulter($campaign_id,$campus_id,$shift,$start_date,$end_date);
      
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_reports/campuswisecelldefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_defaulter_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_reports/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_defaulter_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $program_id           =   $_POST['program'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
            
      $result['defaulter_report']   =   $this->Account_reports_model->getProgramWiseDefaulter($campaign_id,$campus_id,$shift,$program_id,$start_date,$end_date);
      
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_reports/programwisedefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_cell_defaulter_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_reports/programwisecellForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_cell_defaulter_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];
      $program_id           =   $_POST['program'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['defaulter_report']   =   $this->Account_reports_model->getProgramWiseDefaulter($campaign_id,$campus_id,$shift,$program_id,$start_date,$end_date);
      
            
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_reports/programwisecelldefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function program_wise_defaulter_summary_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
//      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_reports/programwisedefaulterSummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_defaulter_summary_report()
  {
      $this->login_check();
      
     if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['defaulter_report']   =   $this->Account_reports_model->getProgramWiseDefaulterSummary($campaign_id,$campus_id,$shift,$start_date,$end_date);
      
            
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_reports/programwisedefaulterSummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  // ************ MONTH CLOSING REPORT  ************************* \\
  
  public function campus_wise_closing_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();      

      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/month_closing/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
  public function campus_wise_closing_report()
  {
      $this->login_check();      
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id  = $_POST['campaign'];
      $program_id   = $_POST['program'];
      $start_date   = $_POST['s_date'];      
      $end_date     = $_POST['e_date'];      

      $campus   = $this->Account_reports_model->getCampusClosinName($campus_id);
      $campaign = $this->Account_reports_model->getCampaignName($campaign_id);
      
//      $result['closing']  = $this->Account_reports_model->campusWiseClosingReport($campaign_id, $campus_id, $start_date, $end_date);
//      $result['closing_received']  = $this->Account_reports_model->campusWiseClosingReceived($campaign_id, $campus_id, $start_date, $end_date);
      
      $result['campus_id']      =   $campus_id;
      $result['campus_name']    =   $campus->campus_name;
      $result['campaign_id']    =   $campaign_id;
      $result['campaign_name']  =   $campaign->campaign_name;
      $result['start_date']     =   $start_date;
      $result['end_date']       =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/month_closing/campuswiseclosingView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  
  //   ****************     Revenue Report     *****************    \\
  
    public function campus_wise_defaulter_revenue_form()
  {
      $this->login_check();
      

      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();            

      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_revenue/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
 
  public function campus_wise_defaulter_revenue_report()
  {
      $this->login_check();
            
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      
      $campaign_id  = $_POST['campaign'];     
      $start_date   = $_POST['s_date'];      
      $end_date     = $_POST['e_date'];      
      
      $result['defaulter_report'] = $this->Account_reports_model->campusWiseDefaulterRevenue($campaign_id, $campus_id, $start_date, $end_date);
      $result['campus_pkg']       = $this->Account_reports_model->campusWisePackageReceivable($campaign_id, $campus_id);
      
//      echo '<pre>';
//      print_r($result['defaulter_report']);
//      die;
      
      $result['campus_id']    =   $campus_id;
      $result['start_date']   =   $start_date;
      $result['end_date']     =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_revenue/campuswisedefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
   public function program_wise_defaulter_revenue_form()
  {
      $this->login_check();
      
//      $result['campus']   = $this->Admin_model->getAllCampusesZone();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();      
      $result['program']  = $this->Admin_model->getAllprograms();

      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/defaulter_revenue/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_defaulter_revenue_report()
  {
      $this->login_check();     
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      
      $campaign_id  = $_POST['campaign'];
      //$program_id   = $_POST['program'];
      $start_date   = $_POST['s_date'];
      $end_date     = $_POST['e_date'];
            
      $result['defaulter_report']     =   $this->Account_reports_model->programWiseDefaulterRevenue($campaign_id, $campus_id, $start_date, $end_date);
      
      $result['campus_id']    =   $campus_id;
      $result['start_date']   =   $start_date;
      $result['end_date']     =   $end_date;
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_revenue/programwisedefaulterView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // campus & campaign wise revenue summary report
  
    public function campus_wise_revenue_summary_form()
  {
      $this->login_check();
      

      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();            

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/accounts_side_menu');
      $this->load->view('accounts/reports/defaulter_revenue/campRevenueSummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
 
  public function campus_wise_revenue_summary_report()
  {
      $this->login_check();
            
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $this->input->post('campus');
      }
      
      
      $campaign_id  =       $this->input->post('campaign');  
      $status       =       $this->input->post('status');
      
      $result['data']     =   $this->Account_reports_model->campusRevenueSummary($campaign_id, $campus_id, $status);
      
//      echo '<pre>';
//      print_r($result['data']);
//      die;
      
      $result['status']    =   $status;
     
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/defaulter_revenue/campRevenueSummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  // *********** for analysis report
  
 public function analysis_report_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Account_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 4){            $this->load->view('admin_ace/accounts_side_menu');           }
      $this->load->view('accounts/reports/analysis_report2/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function analysis_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD'){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id = $_POST['campus'];
      }
      $campaign_id          =   $_POST['campaign'];
      $status               =   $_POST['status'];
//      $s_date               =   $_POST['s_date'];
//      $e_date               =   $_POST['e_date'];
            
      $result['analysis_report']  = $this->Account_reports_model->getAnalysisReport($campaign_id, $campus_id,$status);
      //$result['analysis_report']  = $this->Accounts_reports_model->getAnalysisReport($campaign_id, $campus_id,$status,$s_date,$e_date);
           
//      echo '<pre>';
//      print_r($result); die;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('accounts/reports/analysis_report2/campuswiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */