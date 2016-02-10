<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admission_reports extends CI_Controller {

    public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->model('Admission_reports_model');
    $this->load->model('Admission_r_model');
    $this->load->library('session');

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
    if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }
  
  
  // Login for Admissions
  public function index() { 
      
      
//      $campus_id            =   1;
//      $campaign_id          =   1;
//      $inquiry_type         =   'Physical';
//      $start_date           =   '2014-05-05';
//      $end_date             =   '2014-05-30';
//      
//      $result['inquiry_report']     =   $this->Admission_reports_model->getCampusWise($campaign_id,$campus_id,$inquiry_type,$start_date,$end_date);
//            
//      $this->load->view('admission_reports/inquiry_reports/index', $result);
  }
 
  
  
  // *********** >>> START    Inquiry Report Actions   <<< **********  //
  
  
  public function campus_wise_form()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
     
      $campaign_id          =   $_POST['campaign'];
      $inquiry_type         =   $_POST['inquiry_type'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['inquiry_report']     =   $this->Admission_reports_model->getCampusWise($campaign_id,$campus_id,$inquiry_type,$start_date,$end_date);   
     $result['campus_id']          =   $campus_id;
     $result['start_date']         =   $start_date;
     $result['end_date']           =   $end_date;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/inquiry_reports/campuswiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  public function shift_wise_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/shiftwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function shift_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getShiftWise($campaign_id,$campus_id,$shift,$start_date,$end_date);
      $result['campus_id']          =   $campus_id; 
      $result['shift']              =   $shift; 
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/shiftwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $program              =   $_POST['program'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getProgramWise($campaign_id,$campus_id,$program,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/programwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function gender_wise_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/genderwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function gender_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $gender               =   $_POST['gender'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getGenderWise($campaign_id,$campus_id,$gender,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['gender']             =   $gender;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/genderwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_wise_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['reference']= $this->Admin_model->getAllReferences();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/referencewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $reference            =   $_POST['reference'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['campus_id']          =   $campus_id;
      $result['reference']          =   $reference;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      $result['inquiry_report']     =   $this->Admission_reports_model->getReferenceWise($campaign_id,$campus_id,$reference,$start_date,$end_date);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/referencewiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function institute_wise_form()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/institutewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function institute_wise_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $institute_id         =   $_POST['institutes'];
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getInstituteWise($campaign_id,$institute_id,$campus_id,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/institutewiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // get campus and institutes against the selected city
  
  public function get_institute_info()
  {
      $this->login_check();
      $city_id              =  $_POST['city_id'];
      $result['campus']     =  $this->Admission_reports_model->getCampus($city_id);      
      $result['institutes'] =  $this->Admission_reports_model->getInstitutes($city_id); 
      
      $this->load->view('admission_reports/initial_reports/partials/instituteinfo', $result);
  }
  
  // get campus and campus against the selected city
  
  public function get_campus_info()
  {
      $this->login_check();
      $city_id              =  $_POST['city_id'];
      $result['campus']     =  $this->Admission_reports_model->getCampus($city_id);      
      
      
      $this->load->view('admission_reports/inquiry_reports/partials/campusinfo', $result);
  }
  
  // get campus and user against the selected campus
  
  public function get_user_info()
  {
      $this->login_check();
      $campus_id              =  $_POST['campus_id'];
      $result['users']     =  $this->Admission_reports_model->getUser($campus_id);      
      
      
      $this->load->view('admission_reports/inquiry_reports/partials/userinfo', $result);
  }
  
  
  public function program_summary_form()
  {
      $this->login_check();
      
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/programsummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_summary_report()
  {
      $this->login_check();
      
      $program_id           =   $_POST['program'];
      $campaign_id          =   $_POST['campaign'];      
      $inquiry_type         =   $_POST['inquiry_type'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getProgramSummary($campaign_id,$program_id,$inquiry_type,$start_date,$end_date);
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date; 
      $result['inquiry_type']       =   $inquiry_type; 
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/programsummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // user wise report form
   public function user_wise_form()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/userwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function user_wise_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id        =   $_POST['user'];
      }else{
            $user_id        =   $this->session->userdata('sub_login_id');
      }
      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getUserWise($campaign_id,$user_id,$start_date,$end_date);
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      $result['user_id']            =   $user_id;
      $result['campus_id']          =   $campus_id;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/userwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // user wise report form
   public function user_wise_summary_form()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/inquiry_reports/userwisesummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function user_wise_summary_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id        =   $_POST['user'];
      }else{
            $user_id        =   $this->session->userdata('sub_login_id');
      }
      
      $campaign_id          =   $_POST['campaign'];      
      $inquiry_type         =   $_POST['inquiry_type'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['inquiry_report']     =   $this->Admission_reports_model->getUserWiseSummary($campaign_id,$inquiry_type,$user_id,$start_date,$end_date);
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      $result['campus_id']          =   $campus_id;
      $result['inquiry_type']       =   $inquiry_type;
      //echo '<pre>';var_dump($result);die;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/inquiry_reports/userwisesummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  // *********** >>> END    Inquiry Report Actions   <<< **********  //
  
  
  
  
  
  
  // *********** >>> START  Prospectus Report Actions   <<< **********  //
  
  
  //  function for campus wise report
  public function campus_wise_form_pros()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_report_pros()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getCampusWisePros($campaign_id,$campus_id,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
            
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/campuswiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  //  function for program wise report
  public function program_wise_form_pros()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_report_pros()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $program_id          =   $_POST['program'];      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getProgramWisePros($campaign_id,$campus_id,$program_id,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['program_id']         =   $program_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/programwiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  //  function for gender wise report
  public function gender_wise_form_pros()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/genderwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function gender_wise_report_pros()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $gender               =   $_POST['gender'];      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getGenderWisePros($campaign_id,$campus_id,$gender,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['gender']             =   $gender;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/genderwiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  //  function for shift wise report
  public function shift_wise_form_pros()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/shiftwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function shift_wise_report_pros()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $shift                =   $_POST['shift'];      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getShiftWisePros($campaign_id,$campus_id,$shift,$start_date,$end_date);
      $result['campus_id']             =   $campus_id;
      $result['shift']                 =   $shift;
      $result['start_date']            =   $start_date;
      $result['end_date']              =   $end_date;
      
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/shiftwiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  //  function for reference wise report
  public function reference_wise_form_pros()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['reference']= $this->Admin_model->getAllReferences();
      
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/referencewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_wise_report_pros()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $reference            =   $_POST['reference'];      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getReferenceWisePros($campaign_id,$campus_id,$reference,$start_date,$end_date);
      $result['campus_id']          =   $campus_id; 
      $result['reference']          =   $reference; 
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/referencewiseView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  
   
  // user wise report form
   public function user_wise_form_pros()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/userwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function user_wise_report_pros()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id        =   $_POST['user'];
      }else{
            $user_id        =   $this->session->userdata('sub_login_id');
      }
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getUserWisePros($campaign_id,$user_id,$start_date,$end_date);
      $result['campus_id']          =   $campus_id; 
      $result['user_id']            =   $user_id; 
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/prospectus_reports/userwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  // user wise report form
   public function user_wise_summary_form_pros()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/userwisesummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function user_wise_summary_report_pros()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id        =   $_POST['user'];
      }else{
            $user_id        =   $this->session->userdata('sub_login_id');
      }
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getUserWiseSummaryPros($campaign_id,$user_id,$start_date,$end_date);
      $result['campus_id']          =   $campus_id;
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/prospectus_reports/userwisesummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  
  
  //  function for program wise report
  public function program_wise_summary_form_pros()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllCities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/prospectus_reports/programwisesummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_summary_report_pros()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'OS')
      {
          $result               =   $this->Admission_reports_model->getCityId($this->session->userdata('campus_id'));
          $city_id              =   $result[0]['city_id'];
      }else{
          $city_id          =   $_POST['city'];
      }
      $program_id           =   $_POST['program'];      
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['prospectus_report']     =   $this->Admission_reports_model->getProgramWiseSummaryPros($campaign_id,$program_id,$city_id,$start_date,$end_date);
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date;     
      $result['program_id']         =   $program_id;     
      
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/prospectus_reports/programwisesummaryView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  
  
  // *********** >>> END    Prospectus Report Actions   <<< **********  //
  
  
  
  
  
  
  
  // *********** >>> Start   Follow Up  Report Actions   <<< **********  //
  
  
    // inquiry to prospectus report form
  
    public function inquiry2prospectus_form()
    {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/follow_up_reports/inquiry_2_prospectusForm', $result);
      $this->load->view('admin_ace/admin_footer');  
    }
    
    //  view inquiry to prospectus 
    
    public function inquiry2prospectus_view()
    {
        $this->login_check();
        if($this->session->userdata('role') == 'HOD'){
               $campus_id            =   $_POST['campus'];
        }else{
               $campus_id            =   $this->session->userdata('campus_id');
        }
        $campaign_id                 =   $_POST['campaign'];
        $start_date                  =   $_POST['s_date'];
        $end_date                    =   $_POST['e_date'];

       $result['inquiry_report']     =   $this->Admission_reports_model->getInquiry2Prospectus($campaign_id,$campus_id,$start_date,$end_date);   
       
       //echo '<pre>';var_dump($result);die;
       
       $this->load->view('admin_ace/admin_header');      
       $this->load->view('admission_reports/follow_up_reports/inquiry_2_prospectusView', $result);
       $this->load->view('admin_ace/admin_footer');
    }
  
  
    // inquiry to prospectus report form
  
    public function prospectus2form_form()
    {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/follow_up_reports/prospectus_2_formForm', $result);
      $this->load->view('admin_ace/admin_footer');  
    }
    
    //  view inquiry to prospectus 
    
    public function prospectus2form_view()
    {
        $this->login_check();
        if($this->session->userdata('role') == 'HOD'){
               $campus_id            =   $_POST['campus'];
        }else{
               $campus_id            =   $this->session->userdata('campus_id');
        }
        $campaign_id                 =   $_POST['campaign'];
        $start_date                  =   $_POST['s_date'];
        $end_date                    =   $_POST['e_date'];

       $result['inquiry_report']     =   $this->Admission_reports_model->getProspectus2Form($campaign_id,$campus_id,$start_date,$end_date);   
       
       //echo '<pre>';var_dump($result);die;
       
       $this->load->view('admin_ace/admin_header');      
       $this->load->view('admission_reports/follow_up_reports/prospectus_2_formView', $result);
       $this->load->view('admin_ace/admin_footer');
    }
  
    // stage report
    
    public function stagereport_form()
  {
      $this->login_check();
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/follow_up_reports/stagereportForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function stage_report()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
     $result['inquiry_report']     =   $this->Admission_reports_model->getInquiriesStageInfo($campaign_id,$campus_id,$start_date,$end_date);   
     $result['campus_id']          =   $campus_id;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/follow_up_reports/stagereportView', $result);
     $this->load->view('admin_ace/admin_footer');
  }
  
  // *********** >>> END    Follow Up Report Actions   <<< **********  //
  
    
    // form detail reports start
    public function form_detail_prg_wise_form ()
    {
        $this->login_check();
        $result['campus']   = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
        $result['program']  = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_prg_wise_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_prg_wise_view ()
    {
        $this->login_check();
//        if($this->session->userdata('role') == 'HOD'){
//               $campus_id            =   $_POST['campus'];
//        }else{
//               $campus_id            =   $this->session->userdata('campus_id');
//        }
        
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        $campaign_id                 =   $_POST['campaign'];
        $program_id                  =   $_POST['program'];
        $start_date                  =   $_POST['s_date'];
        $end_date                    =   $_POST['e_date'];

        $result['detail_from_report'] =   $this->Admission_reports_model->detail_from_report_prg($campaign_id,$campus_id,$program_id,$start_date,$end_date);   
        //echo '<pre>';var_dump($result);die;
        
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_prg_wise_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    public function form_detail_gender_wise_form ()
    {
        $this->login_check();
        $result['campus']   = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
        //$result['program']  = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_gender_wise_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_gender_wise_view ()
    {
        $this->login_check();
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        
        $campaign_id                    =   $_POST['campaign'];
        $gender                         =   $_POST['gender'];
        $start_date                     =   $_POST['s_date'];
        $end_date                       =   $_POST['e_date'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_gender_prg($campaign_id,$campus_id,$gender,$start_date,$end_date);
        
        //echo '<pre>';var_dump($result);echo '</pre>';
        
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_gender_wise_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    public function form_detail_shift_wise_form ()
    {
        $this->login_check();
        $result['campus']   = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
        //$result['program']  = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_shift_wise_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_shift_wise_view ()
    {
        $this->login_check();
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        
        $campaign_id                    =   $_POST['campaign'];
        $shift                          =   $_POST['shift'];
        $start_date                     =   $_POST['s_date'];
        $end_date                       =   $_POST['e_date'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_shift_prg($campaign_id,$campus_id,$shift,$start_date,$end_date);
        
        //echo '<pre>';var_dump($result);echo '</pre>';
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_shift_wise_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    public function form_detail_user_wise_form ()
    {
        $this->login_check();
        $result['campus']       = $this->Admin_model->getAllCampuses();
        $result['campaign']     = $this->Admission_reports_model->getAllcampaigns();
        $result['operators']    = $this->Admission_reports_model->getAlloperators();

        //echo '<pre>';var_dump($result['operators']);echo '</pre>';exit;
        
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_user_wise_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_user_wise_view ()
    {
        $this->login_check();
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        
        $campaign_id                    =   $_POST['campaign'];
        $start_date                     =   $_POST['s_date'];
        $end_date                       =   $_POST['e_date'];
        $user_id                        =   $_POST['user'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_user($campaign_id,$campus_id,$user_id,$start_date,$end_date);
        
        //echo '<pre>';var_dump($result);echo '</pre>';
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_user_wise_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    // form detail reports end
    
    

    public function form_detail_program_address_form()
    {
        $this->login_check();
        $result['campus']       = $this->Admin_model->getAllCampuses();
        $result['campaign']     = $this->Admission_reports_model->getAllcampaigns();
        $result['program']      = $this->Admin_model->getAllprograms();

        //echo '<pre>';var_dump($result['operators']);echo '</pre>';exit;
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_program_address_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_program_address_view()
    {
        $this->login_check();
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        
        $campaign_id                    =   $_POST['campaign'];
        $program                        =   $_POST['program'];
        //$campus                         =   $_POST['campus'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_prg_address($campaign_id,$campus_id ,$program);
        
        //echo '<pre>';var_dump($result);echo '</pre>';
        
        $result['program_id']           =   $program;
        
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_program_address_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    
    // form detail reports end
    public function form_detail_summary_user_form()
    {
        $this->login_check();
        $result['campus']       = $this->Admin_model->getAllCampuses();
        $result['campaign']     = $this->Admission_reports_model->getAllcampaigns();
        //$result['program']      = $this->Admin_model->getAllprograms();
        $result['cities']       = $this->Admin_model->getAllcities();
        $result['operators']    = $this->Admission_reports_model->getAlloperators();

        //echo '<pre>';var_dump($result['operators']);echo '</pre>';exit;
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_summary_user_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_summary_user_view()
    {
        $this->login_check();
        $campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        
        $campaign_id                    =   $_POST['campaign'];
        $city                           =   $_POST['city'];
        $start_date                     =   $_POST['s_date'];
        $end_date                       =   $_POST['e_date'];
        $sub_login                      =   $_POST['sub_login'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_form_sumary_user($campaign_id,$campus_id ,$city , $start_date , $end_date,$sub_login);
        
        //echo '<pre>';var_dump($result);echo '</pre>';
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_summary_user_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    // form detail reports end
    public function form_detail_summary_program_form()
    {
        $this->login_check();
        $result['campus']       = $this->Admin_model->getAllCampuses();
        $result['campaign']     = $this->Admission_reports_model->getAllcampaigns();
        $result['program']      = $this->Admin_model->getAllprograms();
        $result['cities']       = $this->Admin_model->getAllcities();
        //$result['operators']    = $this->Admission_reports_model->getAlloperators();

        //echo '<pre>';var_dump($result['operators']);echo '</pre>';exit;
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/form_detailed_reports/form_detail_summary_program_form', $result);
        $this->load->view('admin_ace/admin_footer');  
    } 
    
    public function form_detail_summary_program_view()
    {
        $this->login_check();
        //$campus_id = $this->session->userdata('role') == 'HOD' ? $_POST['campus'] :$this->session->userdata('campus_id');
        $campaign_id                    =   $_POST['campaign'];
        $city_id                        =   $_POST['city'];
        $start_date                     =   $_POST['s_date'];
        $end_date                       =   $_POST['e_date'];
        $program_id                      =   $_POST['program'];
        $result['detail_from_report']   =   $this->Admission_reports_model->detail_from_form_summary_program($city_id ,$campaign_id,$program_id, $start_date,  $end_date);
        
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/form_detailed_reports/form_detail_summary_program_view', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    // form detail reports end
    
    
     // *********** >>> START    Initial Report Actions   <<< **********  //
  
  
  public function campus_wise_form_initial()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_report_initial()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      $inquiry_type         =   $_POST['inquiry_type'];
      
      
     $result['start_date'] = $start_date; 
     $result['end_date']   = $end_date; 
     $result['campus']     = $campus_id; 
     //$result['inquiry']    = $inquiry_type; 
     
     $result['initial_report']     =   $this->Admission_reports_model->getCampusWiseInitial($campaign_id, $campus_id, $start_date, $end_date,$inquiry_type);   
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/initial_reports/campuswiseView', $result, $start_date, $end_date);
     $this->load->view('admin_ace/admin_footer');
  }
  
  public function shift_wise_form_initial()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/shiftwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
   public function shift_wise_report_initial()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $shift                =   $_POST['shift'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
      $result['campus']     = $campus_id;
      
      $result['initial_report']     =   $this->Admission_reports_model->getShiftWiseInitial($campaign_id,$campus_id,$shift,$start_date,$end_date);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/initial_reports/shiftwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_form_initial()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_report_initial()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $program              =   $_POST['program'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
     $result['campus']      = $campus_id;
      
      $result['initial_report']     =   $this->Admission_reports_model->getProgramWiseInitial($campaign_id,$campus_id,$program,$start_date,$end_date);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/initial_reports/programwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_wise_form_initial()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['reference']= $this->Admin_model->getAllReferences();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/referencewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_wise_report_initial()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $campaign_id          =   $_POST['campaign'];
      $reference            =   $_POST['reference'];
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date;
      $result['campus']     = $campus_id; 
      
      $result['initial_report']     =   $this->Admission_reports_model->getReferenceWiseInitial($campaign_id,$campus_id,$reference,$start_date,$end_date);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/initial_reports/referencewiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function institute_wise_form_initial()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/institutewiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function institute_wise_report_initial()
  {
      $this->login_check();
      if($this->session->userdata('role') == 'HOD'){
             $campus_id     =   $_POST['campus'];
      }else{
             $campus_id     =   $this->session->userdata('campus_id');
      }
      $institute_id         =   $_POST['institutes'];
      $campaign_id          =   $_POST['campaign'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
      $result['campus']     = $campus_id;
      
      $result['initial_report']     =   $this->Admission_reports_model->getInstituteWiseInitial($campaign_id,$campus_id,$institute_id,$start_date,$end_date);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/initial_reports/institutewiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // user wise report form
   public function user_wise_form_initial()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/userwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
  public function user_wise_report_initial()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id = $_POST['user'];
      }else{
            $user_id = $this->session->userdata('sub_login_id');
      }
      $campaign_id = $_POST['campaign'];
      $start_date  = $_POST['s_date'];
      $end_date    = $_POST['e_date'];
      $user        = $_POST['user'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
      $result['campus']     = $_POST['campus'];
      $result['user']       = $user;
      
      $result['initial_report'] = $this->Admission_reports_model->getUserWiseInitial($campaign_id,$user_id,$start_date,$end_date);
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admission_reports/initial_reports/userwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  // user summary wise report form
   public function user_wise_form_summary_initial()
  {
      $this->login_check();
      $result['cities']   = $this->Admin_model->getAllcities();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
            
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/userwisesummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
 
  public function user_wise_report_summary_initial()
  {
      $this->login_check();
      
      if($this->session->userdata('role') == 'HOD'){
            $user_id = $_POST['user'];
      }else{
            $user_id = $this->session->userdata('sub_login_id');
      }
      $campaign_id = $_POST['campaign'];
      $start_date = $_POST['s_date'];
      $end_date = $_POST['e_date'];
      
      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
      
      $result['initial_report'] = $this->Admission_reports_model->getUserWiseSummaryInitial($campaign_id,$user_id,$start_date,$end_date);
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admission_reports/initial_reports/userwisesummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_wise_form_summary_initial()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      $result['program']  = $this->Admin_model->getAllprograms();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/initial_reports/programsummaryForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function program_summary_report_initial()
  {
      $this->login_check();
      
      $program_id           =   $_POST['program'];
      $campaign_id          =   $_POST['campaign'];      
      $inquiry_type         =   $_POST['inquiry_type'];      
      $start_date           =   $_POST['s_date'];
      $end_date             =   $_POST['e_date'];

      $result['start_date'] = $start_date; 
      $result['end_date']   = $end_date; 
      
      $result['initial_report']     =   $this->Admission_reports_model->getProgramSummary($campaign_id,$program_id,$inquiry_type,$start_date,$end_date);
      $result['start_date']         =   $start_date;
      $result['end_date']           =   $end_date; 
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/initial_reports/programsummaryView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
//  public function program_wise_report_summary_initial()
//  {
//      $this->login_check();
//      if($this->session->userdata('role') == 'HOD'){
//             $campus_id     =   $_POST['campus'];
//      }else{
//             $campus_id     =   $this->session->userdata('campus_id');
//      }
//      $campaign_id          =   $_POST['campaign'];
//      $program              =   $_POST['program'];
//      $start_date           =   $_POST['s_date'];
//      $end_date             =   $_POST['e_date'];
//      
//      $result['start_date'] = $start_date; 
//      $result['end_date']   = $end_date; 
//      
//      $result['initial_report']     =   $this->Admission_reports_model->getProgramWiseSummaryInitial($campaign_id,$campus_id,$program,$start_date,$end_date);
//            
//      $this->load->view('admin_ace/admin_header');      
//      $this->load->view('admission_reports/initial_reports/programsummaryView', $result);
//      $this->load->view('admin_ace/admin_footer');
//  }
  
  public function campus_wise_form_analysis()
  {
      $this->login_check();
      
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/analysis_reports/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function campus_wise_report_analysis()
  {
      $this->login_check();
      
      $campaign_id  = $_POST['campaign'];
      
      $result['analysis_report']  = $this->Admission_reports_model->getCampusWiseAnalysis($campaign_id);
            
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/analysis_reports/campuswiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  //   *****   STatus Report   *****   \\
  
    public function status_report_form(){
       
        
      $this->login_check();
      
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/status/statusreportForm');
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    // get report using inquiry number
    
    public function search_inquiry_no($inquiryno = null ){
        
 
      $this->login_check();
          
        if($inquiryno == null){
            $inquiry_no             =    $_POST['inquiry_no'];
        }else{
            $inquiry_no             =   $inquiryno;
        }
       
        $res                    =    $this->Admission_r_model->getInquiryId($inquiry_no);
                
        if(count($res) > 0){
        $inquiry_id             =    $res->inquiry_id;
        
        $result['inquiry']      =    $this->Admission_reports_model->getInquiry($inquiry_id);
        
//        echo '<pre>';var_dump($result['inquiry']);die;
        $result['prospectus']   =    $this->Admission_reports_model->getProspectus($inquiry_id);
        $result['initial']      =    $this->Admission_reports_model->getInitial($inquiry_id);
        $result['detailed']     =    $this->Admission_reports_model->getComplete($inquiry_id);
        $result['inquiry_no']   =    $inquiry_no;
        $result['form_no']      =    '';
        
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/status/statusreportView', $result);
        $this->load->view('admin_ace/admin_footer');
        
        }else{
                $this->session->set_userdata('error', 'Sorry, Record Not Found.');
                redirect('admission_reports/status_report_form');
            }
    
    }
    // get report using inquiry number
    
    public function search_form_no($formno = null ){
        
        
      $this->login_check();
      
        if($formno == null){
            $form_no             =    $_POST['form_no'];
        }else{
            $form_no             =    $formno;
        }
        
        
        $res                 =    $this->Admission_reports_model->getInqId($form_no);
        
        if(count($res) > 0){
        $inquiry_id             =    $res[0]['inquiry_id'];
        
        $result['inquiry']      =    $this->Admission_reports_model->getInquiry($inquiry_id);
        $result['prospectus']   =    $this->Admission_reports_model->getProspectus($inquiry_id);
        $result['initial']      =    $this->Admission_reports_model->getInitial($inquiry_id);
        $result['detailed']     =    $this->Admission_reports_model->getComplete($inquiry_id);
        $result['inquiry_no']   =    '';
        $result['form_no']      =    $form_no;
        
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/status/statusreportView', $result);
        $this->load->view('admin_ace/admin_footer');
        
        }else{
                $this->session->set_userdata('error', 'Sorry, Record Not Found.');
                redirect('admission_reports/status_report_form');
            }
        
    }
    
    
    // get report using inquiry number
    
    public function search_mobile_no($mobileno){
       
      $this->login_check();
      
        
        $res                 =    $this->Admission_reports_model->getInqId2($mobileno);
        
        if(count($res) > 0){
        $inquiry_id             =    $res->inquiry_id;
        
        $result['inquiry']      =    $this->Admission_reports_model->getInquiry($inquiry_id);
        $result['prospectus']   =    $this->Admission_reports_model->getProspectus($inquiry_id);
        $result['initial']      =    $this->Admission_reports_model->getInitial($inquiry_id);
        $result['detailed']     =    $this->Admission_reports_model->getComplete($inquiry_id);
        $result['inquiry_no']   =    '';
        $result['form_no']      =    $form_no;
        
        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/status/statusreportView', $result);
        $this->load->view('admin_ace/admin_footer');
        
        }else{
                $this->session->set_userdata('error', 'Sorry, Record Not Found.');
                redirect('admission_reports/status_report_form');
            }
        
    }
    
    
    public function analysis_report_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/analysis_report2/campuswiseForm', $result);
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
            
      $result['analysis_report']  = $this->Admission_reports_model->getAnalysisReport($campaign_id, $campus_id);
           
//      echo '<pre>';
//      print_r($result); die;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/analysis_report2/campuswiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function concession_report_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/concession_report/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function concession_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD'){
        $campus_id  = $this->session->userdata('campus_id');        
      }else{
        $campus_id = $_POST['campus'];
      }
      $campaign_id  = $_POST['campaign'];
      
      $result['concession_report']  = $this->Admission_reports_model->getConcessionReport($campaign_id, $campus_id);           
            
//      echo '<pre>';
//      print_r($result); die;  
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/concession_report/campuswiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function reference_report_form()
  {
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/reference_report/campuswiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function reference_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD'){
        $campus_id  = $this->session->userdata('campus_id');        
      }else{
        $campus_id = $_POST['campus'];
      }
      $campaign_id  = $_POST['campaign'];
      
      $result['reference_report'] = $this->Admission_reports_model->getReferenceReport($campaign_id, $campus_id);   
      
      //echo '<pre>';
      //print_r($result); die; 
      
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/reference_report/campuswiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
  public function program_wise_concession_report_form(){
      
      $this->login_check();
      $result['campus']   = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();
      
      $this->load->view('admin_ace/admin_header');
      if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
      $this->load->view('admission_reports/concession_report/programwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
      
  }
    
  public function program_wise_concession_report(){
      
     $this->login_check();
      
      if($this->session->userdata('role') != 'HOD'){
        $campus_id  = $this->session->userdata('campus_id');        
      }else{
        $campus_id = $_POST['campus'];
      }
      
        $campaign_id  = $_POST['campaign'];
        $shift        = $_POST['shift'];
        $program      = $_POST['program'];

        $result['data']  = $this->Admission_reports_model->getProgram_wise_ConcessionReport($campaign_id, $campus_id,$shift,$program);           
      
        $result['shift'] =  $shift;
                
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/concession_report/programwiseView', $result);
        $this->load->view('admin_ace/admin_footer');
      
  }
  
  public function adm_ref_summary_report_form(){
      
        $this->login_check();
        $result['campus']   = $this->Admin_model->getAllCampuses();
        $result['campaign'] = $this->Admission_reports_model->getAllcampaigns();

        $this->load->view('admin_ace/admin_header');
        if($this->session->userdata('account_role_id') == 5){           $this->load->view('admin_ace/audit_side_menu');       }elseif($this->session->userdata('account_role_id') == 3){            $this->load->view('admin_ace/admin_side_menu');           }     
        $this->load->view('admission_reports/reference_report/admRefSummaryForm', $result);
        $this->load->view('admin_ace/admin_footer');
      
  }
    
  
  public function adm_ref_summary_report(){
      
        $this->login_check();
      
        if($this->session->userdata('role') != 'HOD'){
             $campus_id  = $this->session->userdata('campus_id');        
        }else{
           $campus_id = $_POST['campus'];
        }
        
        $result['campaign_id']    =   $_POST['campaign'];
      
        $result['ref_summary']   =   $this->Admission_reports_model->getAdmRefSummary($campus_id,$_POST['campaign']);
      
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('admission_reports/reference_report/admRefSummaryView', $result);
        $this->load->view('admin_ace/admin_footer');
      
  }
  
  public function adm_ref_detail(){
      
      $campus_id             =   $this->uri->segment(3);
      $campign_id            =   $this->uri->segment(4);
      $reference_id          =   $this->uri->segment(5);
      
      $result['ref_detail']     =   $this->Admission_reports_model->getAdmRefDetail($campus_id,$campign_id,$reference_id);
      
      $result['campaign_id'] = $campign_id;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('admission_reports/reference_report/admRefDetailView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
    
  
  //   *****   STatus Report   *****   \\

  
  // >>>>>>>>>>>>>>>>>  Admission Analysis Report  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
  
   //    *****   Package Reports Start   *****   \\
  
   public function adm_analysis_form()
  {
      $this->login_check();
      
      $result['campus'] = $this->Admin_model->getAllCampuses();
      $result['campaign'] = $this->Admin_model->getAllcampaigns2();      
      $result['program']  = $this->Admin_model->getAllprograms();
     //die('ajsdl');  
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admission_reports/analysis_reports/packageForm', $result);      
      $this->load->view('admin_ace/admin_footer');
  }
 
 
   public function adm_analysis_report()
  {
      $this->login_check();
      
      if($this->session->userdata('role') != 'HOD' && $this->session->userdata('campus_id') != 31){
        $campus_id     =   $this->session->userdata('campus_id');        
      }else{
        $campus_id     =    $_POST['campus'];
      }
      //echo $campus_id;die;
     
      $campaign_id          =   $_POST['campaign']; 
      $program_id           =   $_POST['program']; 
      
     $result['package_report']     =   $this->Admission_reports_model->get_adm_analysis_package($campaign_id,$campus_id,$program_id);        

     $result['campus_id']          =   $campus_id;
     $result['program_id']         =   $program_id;
     
     $this->load->view('admin_ace/admin_header');      
     $this->load->view('admission_reports/analysis_reports/packageView',$result);
     $this->load->view('admin_ace/admin_footer');
  }
 
  
  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */