<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Admin extends CI_Controller {

  public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }

  // For Index Page Admin
  public function index() {
    $this->load->view('landing');
  }

  // admin login form 
  
  public function login_form()
  {
        $this->load->view('admin/login');
  }


  // for verification of admin login

  public function login_check() {

    if ($this->session->userdata('admin_id') == '' && $this->session->userdata('username') == '') {
      redirect('admin/index');
    }
  }

  // admin login 

  public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {       
      $this->load->view('admin/login');
    } else {

      $this->load->library('encrypt');

      $encrypted_password = $this->encrypt->sha1($_POST['password']);
      
      $login_data = array(
          'acc_login'    => $_POST['username'],
          'acc_password' => $encrypted_password,
      );
      
      $result = $this->Admin_model->adminLogin($login_data);
//echo '<pre>';var_dump($result);die;
      if ($result) {
        
          
        $sessionData = array(
            'username'        => $result->acc_login,
            'admin_id'        => $result->acc_login_id,
            'account_role_id' => $result->account_role_id,
        );

        $this->session->set_userdata($sessionData);
        redirect('admin/dashboard');
      } else {
        
        $this->session->set_userdata('error', 'Incorrect Username OR Password');
        redirect('admin/login_form');
      }
    }
  }
  
  
   // for change password
  
  public function change_password_form()
  {
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin_ace/changepassword');
        $this->load->view('admin_ace/admin_footer');
  }
  
  // for change password
  
  public function change_password()
  {
      $old_pass         =   $_POST['old_pass'];
      $new_pass         =   $_POST['new_pass'];
      
      $this->load->library('encrypt');
      $old_password = $this->encrypt->sha1($old_pass);
      $new_password = $this->encrypt->sha1($new_pass);
      
      $result       =   $this->Admin_model->ChangePass($old_password,$new_password);
      if($result){
                $this->session->set_userdata('error', 'Password Successfully Changed.');
                 redirect('admin/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('admin/change_password_form');
      }
      
  }


  // for admin logout 
  public function logout() {

    $this->session->unset_userdata('sub_login');
    $this->session->unset_userdata('sub_login_id');
    $this->session->unset_userdata('employee_id');
    $this->session->unset_userdata('campus_id');    
    $this->session->sess_destroy();
    redirect('');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }

  //  *****    Start Functions for City Module   *****  //      
  // form to Add city 

  public function add_city_form() {

    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/city/addcity');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add city in database

  public function add_city() {

    $this->login_check();

    $this->form_validation->set_rules('city', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/city/addcity');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $city = array(
          'city_name' => $_POST['city']
      );

      // check city name already exitsts

      $res = $this->Admin_model->checkCity($city);
      if ($res) {
        $this->session->set_userdata('error_msg', 'City Name Already Exists');
        redirect('admin/add_city_form');
      } else {
        $result = $this->Admin_model->addCity($city);

        if ($result) {
          $this->session->set_userdata('success_msg', 'City Added Successfully');
          redirect('admin/view_cities');
        }
      }
    }
  }

  // display all the cities 

  public function view_cities() {
    $this->login_check();

    $result['cities'] = $this->Admin_model->getAllcities();
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/city/viewcities', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of city to be edited

  public function edit_city() {
    $this->login_check();

    $id = $_GET['city_id'];
    $result = $this->Admin_model->getCity($id);
    $result['city'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/city/editcity', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the city name 
  public function update_city() {

    $this->login_check();
    $id = $_POST['city_id'];

    $this->form_validation->set_rules('city', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getCity($id);
      $result['city'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/city/editcity', $result);
      $this->load->view('admin_ace/admin_footer');
    }       
    
    // check city name already exitsts 
     $city = array(
          'city_name' => $_POST['city']
      );
    $res = $this->Admin_model->checkCity($city);
    if ($res) {
      $this->session->set_userdata('error_msg', 'City Name Already Exists');
      
      $result = $this->Admin_model->getCity($id);
      $result['city'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/city/editcity', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $city = array('city_name' => $_POST['city']);
      $result = $this->Admin_model->updateCity($id, $city);

      if ($result) {
        $this->session->set_userdata('success_msg', 'City Name updated Successfully');
        redirect('admin/view_cities');
      }
    }
  }
  
  
  
  
  
  
  
  
   //  *****    Start Functions for user Module   *****  //   
  // add new user 
  public function add_user_form() {

    $this->login_check();

    $result['campus'] = $this->Admin_model->getAllCampuses();


    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/user/adduser', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // add new campus in database

  public function add_user() {

    $this->login_check();

    $this->form_validation->set_rules('campus', 'Campus Name', 'required');
    $this->form_validation->set_rules('module', 'Module', 'required');
    $this->form_validation->set_rules('role', 'Role', 'required');
    $this->form_validation->set_rules('username', 'User Name', 'required');

    if ($this->form_validation->run() == FALSE) {

       $result['campus'] = $this->Admin_model->getAllCampuses();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin/user/adduser', $result);
        $this->load->view('admin_ace/admin_footer');
        
    } else {

      $data = array(
          'sub_login'       => $_POST['username'],
          'sub_password'    => 'f865b53623b121fd34ee5426c792e5c33af8c227',
          'created_date'    => date('Y-m-d'),
          'account_role_id' => $_POST['module'],
          'sub_status'      => 1,
          'employee_id'     => 6,
          'campus_id'       => $_POST['campus'],
          'role'            => $_POST['role']
      );

      // check campus name and code already exitsts or not

        $result = $this->Admin_model->addUser($data);
        if ($result) {
          $this->session->set_userdata('success_msg', 'New User Added Successfully');
          redirect('admin/view_users');
        }
    
    }
  }

  // view all campuse 

  public function view_users() {
    $this->login_check();

    $result['users'] = $this->Admin_model->getAllUsers();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/user/viewusers', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of campus detail to be edited

  public function reset_password() {

    $this->login_check();

    $sub_login_id    = $this->uri->segment(3);
    $password        = 'f865b53623b121fd34ee5426c792e5c33af8c227';
    
    $result          = $this->Admin_model->updateUserPassword($sub_login_id,$password);

    if($result > 0) {
         $this->session->set_userdata('success_msg', 'Password Reset Successfully');
          redirect('admin/view_users');
    }else{
         $this->session->set_userdata('success_msg', 'Password Not Reset');
          redirect('admin/view_users');
    }
  }

 

  //  *****    Start Functions for user Module   *****  //     
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  //  *****    Start Functions for Campus Module   *****  //   
  // add new campus form
  public function add_campus_form() {

    $this->login_check();

    $result = $this->Admin_model->getAllcities();

    $result['cities'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campus/addcampus', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // add new campus in database

  public function add_campus() {

    $this->login_check();

    $this->form_validation->set_rules('campus_name', 'Campus Name', 'required');
    $this->form_validation->set_rules('campus_code', 'Campus Code', 'required');
    $this->form_validation->set_rules('cities', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getAllcities();
      $result['cities'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campus/addcampus', $result);
      $this->load->view('admin_ace/admin_footer');
    } else {

      $check_campus_data = array(
          'campus_name' => $_POST['campus_name'],
          'campus_code' => $_POST['campus_code']
      );

      // check campus name and code already exitsts or not

      $res = $this->Admin_model->checkcampus($check_campus_data);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Campus Name and  Campus Code  Already Exists');
        redirect('admin/add_campus_form');
      } else {
        $campus_data = array(
            'campus_name' => $_POST['campus_name'],
            'campus_code' => $_POST['campus_code'],
            'city_id' => $_POST['cities']
        );

        $result = $this->Admin_model->addCampus($campus_data);
        if ($result) {
          $this->session->set_userdata('success_msg', 'New Campus Added Successfully');
          redirect('admin/view_campuses');
        }
      }
    }
  }

  // view all campuse 

  public function view_campuses() {
    $this->login_check();

    $result['campuses'] = $this->Admin_model->getAllCampuses();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campus/viewcampuses', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of campus detail to be edited

  public function edit_campus() {

    $this->login_check();

    $city_result = $this->Admin_model->getAllcities();
    $result['cities'] = $city_result;

    $id = $_GET['campus_id'];
    $campus_result = $this->Admin_model->getCampus($id);
    $result['campus'] = $campus_result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campus/editcampus', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the campus name 
  public function update_campus() {

    $this->login_check();
    $id = $_POST['campus_id'];

    $this->form_validation->set_rules('campus_name', 'Campus Name', 'required');
    $this->form_validation->set_rules('campus_code', 'Campus Code', 'required');
    $this->form_validation->set_rules('cities', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getCampus($id);
      $result['campus'] = $result;

      $city_result = $this->Admin_model->getAllcities();
      $result['cities'] = $city_result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campus/editcampus', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
    // check campus name and code already exitsts or not

    $check_campus_data = array(
            'campus_name' => $_POST['campus_name'],
            'campus_code' => $_POST['campus_code']
    );
    $res = $this->Admin_model->checkcampus($check_campus_data);
    if ($res) {
      $this->session->set_userdata('error_msg', 'Campus Name and  Campus Code  Already Exists');
      
      $result = $this->Admin_model->getCampus($id);
      $result['campus'] = $result;

      $city_result = $this->Admin_model->getAllcities();
      $result['cities'] = $city_result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campus/editcampus', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $campus = array(
          'campus_name' => $_POST['campus_name'],
          'campus_code' => $_POST['campus_code'],
          'city_id' => $_POST['cities'],
      );
      $result = $this->Admin_model->updateCampus($id, $campus);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Campus record updated Successfully');
        redirect('admin/view_campuses');
      }
    }
  }

  //  *****    Start Functions for Campaign Module   *****  //     
  // form to Add new campaign

  public function add_campaign_form() {
    $this->login_check();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campaign/addcampaign');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add new campaign 

  public function add_campaign() {
    $this->login_check();

    $this->form_validation->set_rules('campaign_name', 'Campaign Name', 'required');
    $this->form_validation->set_rules('campaign_code', 'Campaign Code', 'required');
    $this->form_validation->set_rules('campaign_type', 'Campaign Type', 'required');
    $this->form_validation->set_rules('status', 'Campaign Status', 'required');
    $this->form_validation->set_rules('remarks', 'Remarks', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campaign/addcampaign');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $campaign = array(
          'campaign_name' => $_POST['campaign_name'],
          'campaign_code' => $_POST['campaign_code']
      );

      // check campaign name and code already exitsts

      $res = $this->Admin_model->checkCampaign($campaign);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Campaign Name and Code Already Exists');
        redirect('admin/add_campaign_form');
      } else {

        $campaign_data = array(
            'campaign_name' => $_POST['campaign_name'],
            'campaign_code' => $_POST['campaign_code'],
            'campaign_type' => $_POST['campaign_type'],
            'status' => $_POST['status'],
            'remarks' => $_POST['remarks']
        );

        $result = $this->Admin_model->addCampaign($campaign_data);
        if ($result) {
          $this->session->set_userdata('success_msg', 'Campaign Added Successfully');
          redirect('admin/view_campaigns');
        }
      }
    }
  }

  // display all the campaigns

  public function view_campaigns() {
    $this->login_check();

    // this function displayed all the campaigns having status open

    $result['campaigns'] = $this->Admin_model->getAllcampaigns2();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campaign/viewcampaigns', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the record of campaign to be edited

  public function edit_campaign() {
    $this->login_check();

    $id = $_GET['campaign_id'];
    $result = $this->Admin_model->getCampaign($id);
    $result['campaign'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/campaign/editcampaign', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the campaign record 
  public function update_campaign() {
    $this->login_check();
    $id = $_POST['campaign_id'];

    $this->form_validation->set_rules('campaign_name', 'Campaign Name', 'required');
    $this->form_validation->set_rules('campaign_code', 'Campaign Code', 'required');
    $this->form_validation->set_rules('campaign_type', 'Campaign Type', 'required');
    $this->form_validation->set_rules('status', 'Campaign Status', 'required');
    $this->form_validation->set_rules('remarks', 'Remarks', 'required');

    if ($this->form_validation->run() == FALSE) {
      $result = $this->Admin_model->getCampaign($id);
      $result['campaign'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campaign/editcampaign', $result);
      $this->load->view('admin_ace/admin_footer');
    }
        
      // check campaign name and code already exitsts
//    $campaign = array(
//          'campaign_name' => $_POST['campaign_name'],
//          'campaign_code' => $_POST['campaign_code']
//    );
//    $res = $this->Admin_model->checkCampaign($campaign);
//    if ($res) {
//      $this->session->set_userdata('error_msg', 'Campaign Name and Code Already Exists');
//      
//      $result = $this->Admin_model->getCampaign($id);
//      $result['campaign'] = $result;
//
//      $this->load->view('admin_ace/admin_header');
//      $this->load->view('admin_ace/admin_side_menu');
//      $this->load->view('admin/campaign/editcampaign', $result);
//      $this->load->view('admin_ace/admin_footer');
//    }
//    else {
      $campaign = array(
          'campaign_name' => $_POST['campaign_name'],
          'campaign_code' => $_POST['campaign_code'],
          'campaign_type' => $_POST['campaign_type'],
          'status'        => $_POST['status'],
          'remarks'       => $_POST['remarks']
      );
      $result = $this->Admin_model->updateCampaign($id, $campaign);
      if ($result) {
        $this->session->set_userdata('success_msg', 'campaign updated Successfully');
        redirect('admin/view_campaigns');
      }
   // }
  }



  //  ***********>>>>>>    Start Functions for Semester Module   <<<<<<**********  //     
  // form to Add New Session

  public function add_session_form() {
    $this->login_check();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/session/addsession');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Session in database

  public function add_session() {
    $this->login_check();

    $this->form_validation->set_rules('session', 'Session', 'required');
    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/session/addsession');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $session = array(
          'session' => $_POST['session']
      );

      // check session already exitsts

      $res = $this->Admin_model->checkSession($session);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Session Already Exists');
        redirect('admin/add_session_form');
      } else {
        $result = $this->Admin_model->addSession($session);
        if ($result) {
          $this->session->set_userdata('success_msg', ' New Session Added Successfully');
          redirect('admin/view_sessions');
        }
      }
    }
  }

  // display all the Session

  public function view_sessions() {
    $this->login_check();

    $result['sessions'] = $this->Admin_model->getAllSessions();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/session/viewsessions', $result);
    $this->load->view('admin_ace/admin_footer');
  }
  

  

  //  *****    Start Functions for Bank Module   *****  //      
  // form to Add Bank 

  public function add_bank_form() {

    $this->login_check();

    $result = $this->Admin_model->getAllcities();
    $result['cities'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank/addbank', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // add new campus in database

  public function add_bank() {

    $this->login_check();

    $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
    $this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
    $this->form_validation->set_rules('bank_phone', 'Bank Phone');
    $this->form_validation->set_rules('cities', 'City Name', 'required');
    $this->form_validation->set_rules('challan_title', 'Challan Title', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      
      $result['cities'] = $this->Admin_model->getAllcities();

      $this->load->view('admin/bank/addbank', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    else {
      $check_bank_data = array(
          'bank_name'    => $_POST['bank_name'],
          'bank_address' => $_POST['bank_address'],
          'bank_phone'   => $_POST['bank_phone']
      );

      // check bank name and code already exitsts or not

      $res = $this->Admin_model->checkbank($check_bank_data);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Bank Name, Address and Phone Already Exists');

        redirect('admin/add_bank_form');
      } 
      else {
        $bank_data = array(
            'bank_name'    => $_POST['bank_name'],
            'bank_address' => $_POST['bank_address'],
            'challan_title' => $_POST['challan_title'],
            'bank_phone'   => $_POST['bank_phone'],
            'city_id'      => $_POST['cities']
        );

        $result = $this->Admin_model->addBank($bank_data);

        if ($result) {          
          $this->session->set_userdata('success_msg', 'New Bank Added Successfully');
          redirect('admin/view_banks');
        }
      }
    }
  }

  // view all banks 

  public function view_banks() {
    $this->login_check();

    $result['banks'] = $this->Admin_model->getAllBanks();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank/viewbanks', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of campus detail to be edited

  public function edit_bank() {

    $this->login_check();

    $result['cities'] = $this->Admin_model->getAllcities();

    $id = $_GET['bank_id'];
    $bank_result    = $this->Admin_model->getBank($id);
    $result['bank'] = $bank_result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank/editbank', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the bank name 
  public function update_bank() {

    $this->login_check();    
    $id = $_POST['bank_id'];
    
    $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
    $this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
    $this->form_validation->set_rules('bank_phone', 'Bank Phone', 'required');
    $this->form_validation->set_rules('cities', 'City Name', 'required');
    $this->form_validation->set_rules('challan_title', 'Challan Title', 'required');

    if($this->form_validation->run() == FALSE) {
      
      $result['bank'] = $this->Admin_model->getBank($id);
      $result['cities'] = $this->Admin_model->getAllcities();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/bank/editbank', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    
   
      $bank = array(
          'bank_name'    => $_POST['bank_name'],
          'bank_address' => $_POST['bank_address'],
          'challan_title' => $_POST['challan_title'],
          'bank_phone'   => $_POST['bank_phone'],
          'city_id'      => $_POST['cities']
      );
      $result = $this->Admin_model->updateBank($id, $bank);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Bank record updated Successfully');
        redirect('admin/view_banks');
      }
    }
 
  //  *****    Start Functions for Section Module   *****  //      
  // Form to Add Section 

  public function add_section_form() {

    $this->login_check();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/section/addsection');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add section in database

  public function add_section() {

    $this->login_check();

    $this->form_validation->set_rules('section', 'Section Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/section/addsection');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $section = array(
          'section' => $_POST['section']
      );

      // check section name already exitsts
      $res = $this->Admin_model->checkSection($section);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Section Name Already Exists');
        redirect('admin/add_section_form');
      } 
      else {
        $result = $this->Admin_model->addSection($section);
        if ($result) {
          $this->session->set_userdata('success_msg', 'Section Added Successfully');
          redirect('admin/view_sections');
        }
      }
    }
  }

  // display all the sections 

  public function view_sections() {
    $this->login_check();

    $result['sections'] = $this->Admin_model->getAllsections();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/section/viewsections', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of section to be edited

  public function edit_section() {
    $this->login_check();

    $id = $_GET['section_id'];
    $result['section'] = $this->Admin_model->getSection($id);

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/section/editsection', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the section name 
  public function update_section() {

    $this->login_check();
    $id = $_POST['section_id'];

    $this->form_validation->set_rules('section', 'Section Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getSection($id);
      $result['section'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/section/editsection', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
      // check section name already exitsts
    $section = array(
        'section' => $_POST['section']
    );
    $res = $this->Admin_model->checkSection($section);
    if ($res) {
      $this->session->set_userdata('error_msg', 'Section Name Already Exists');
      
      $result = $this->Admin_model->getSection($id);
      $result['section'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/section/editsection', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $section = array('section' => $_POST['section']);
      $result = $this->Admin_model->updateSection($id, $section);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Section Name updated Successfully');
        redirect('admin/view_sections');
      }
    }
  }

  //  *****    Start Functions for Bank Account Module   *****  //   
  // add new Bank Acocunt form
  public function add_bank_account_form() {

    $this->login_check();

    $result = $this->Admin_model->getAllBanks();
    $result['bank'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank_account/add_bank_account', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // Add Bank Account in database

  public function add_bank_account() {

    $this->login_check();

    $this->form_validation->set_rules('account_no', 'Account #', 'required|numeric');
    $this->form_validation->set_rules('account_type', 'Account Type', 'required');
    $this->form_validation->set_rules('bank', 'Bank Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['bank'] = $this->Admin_model->getAllBanks();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/bank_account/add_bank_account', $result);
      $this->load->view('admin_ace/admin_footer');
    } else {
      $bank_account = array(
          'account_no'   => $_POST['account_no'],
          'account_type' => $_POST['account_type'],
          'bank_id'      => $_POST['bank']
      );

      // check Bank Account already exitsts
      $res = $this->Admin_model->checkBankAccount($bank_account);
      if ($res) {
        $this->session->set_userdata('error_msg', 'This Bank Account Already Exists');
        redirect('admin/add_bank_account_form');
      } else {
        $result = $this->Admin_model->addBankAccount($bank_account);

        if ($result) {
          $this->session->set_userdata('success_msg', 'Bank Account Added Successfully');
          redirect('admin/view_bank_accounts');
        }
      }
    }
  }

  // Display all the Bank Accounts 

  public function view_bank_accounts() {

    $this->login_check();

    $result['accounts'] = $this->Admin_model->getAllBankAccounts();
   
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank_account/view_bank_accounts', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the Bank Account to be edited

  public function edit_bank_account() {

    $this->login_check();

    $bank_account = array(
        'bank_account_id' => $_GET['bank_account_id']
    );
    $result['account'] = $this->Admin_model->getBankAccount($bank_account);

    $result['bank'] = $this->Admin_model->getAllBanks();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/bank_account/edit_bank_account', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Bank Account Name 

  public function update_bank_account() {

    $this->login_check();

    $this->form_validation->set_rules('account_no', 'Account #', 'required|numeric');
    $this->form_validation->set_rules('account_type', 'Account Type', 'required');
    $this->form_validation->set_rules('bank', 'Bank Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['bank'] = $this->Admin_model->getAllBanks();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/bank_account/edit_bank_account', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
    // check Bank Account already exitsts
    $check_bank_account = array(
          'account_no' => $_POST['account_no']
    );
    $res = $this->Admin_model->checkBankAccount($check_bank_account);
    if ($res) {
      $this->session->set_userdata('error_msg', 'This Bank Account Already Exists');
            
      $bank_account = array(
        'bank_account_id' => $_POST['bank_account_id']
      );
      $result['account'] = $this->Admin_model->getBankAccount($bank_account);    
      $result['bank'] = $this->Admin_model->getAllBanks();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/bank_account/edit_bank_account', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $id = $_POST['bank_account_id'];
      $bank_account = array(
          'account_no' => $_POST['account_no'],
          'account_type' => $_POST['account_type'],
          'bank_id' => $_POST['bank']
      );

      $result = $this->Admin_model->updateBankAccount($id, $bank_account);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Bank Account updated Successfully');
        redirect('admin/view_bank_accounts');
      }
    }
  }


  

  //  *****    Start Functions for batch Module   *****  //  
  // Form to Add batch 

  public function add_batch_form() {

    $this->login_check();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/batch/addbatch');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add batch in database

  public function add_batch() {

    $this->login_check();

    $this->form_validation->set_rules('batch', 'Batch ', 'required');
    $this->form_validation->set_rules('batch_type', 'Batch Type ', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/batch/addbatch');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $batch = array(
          'batch' => $_POST['batch']
      );

      // check session name already exitsts

      $res = $this->Admin_model->checkBatch($batch);

      if ($res) {
        $this->session->set_userdata('error_msg', 'This batch  Already Exists');
        redirect('admin/add_batch_form');
      } else {
        $batch_data = array(
            'batch' => $_POST['batch'],
            'batch_type' => $_POST['batch_type']
        );
        $result = $this->Admin_model->addBatch($batch_data);

        if ($result) {
          $this->session->set_userdata('success_msg', 'batch Added Successfully');
          redirect('admin/view_batches');
        }
      }
    }
  }

  // display all the batches 

  public function view_batches() {
    $this->login_check();

    $result['batches'] = $this->Admin_model->getAllbatches();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/batch/viewbatches', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of batch to be edited

  public function edit_batch() {
    $this->login_check();

    $id = $_GET['batch_id'];
    $result = $this->Admin_model->getBatch($id);
    $result['batch'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/batch/editbatch', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the batch name 
  public function update_batch() {

    $this->login_check();
    $id = $_POST['batch_id'];

    $this->form_validation->set_rules('batch', 'Batch ', 'required');
    $this->form_validation->set_rules('batch_type', 'Batch Type', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getBatch($id);
      $result['batch'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/batch/editbatch', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
      // check batch name already exitsts
    
    $batch = array(
        'batch' => $_POST['batch']
    );
    $res = $this->Admin_model->checkBatch($batch);
    if ($res) {
      $this->session->set_userdata('error_msg', 'This batch  Already Exists');
      
      $result = $this->Admin_model->getBatch($id);
      $result['batch'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/batch/editbatch', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $batch = array(
          'batch' => $_POST['batch'],
          'batch_type' => $_POST['batch_type']
      );
      $result = $this->Admin_model->updateBatch($id, $batch);

      if ($result) {
        $this->session->set_userdata('success_msg', 'batch updated Successfully');
        redirect('admin/view_batches');
      }
    }
  }


  //  *****    Start Functions for institute Module   *****  //  
  // Form to Add institute 

  public function add_institute_form() {

    $this->login_check();

    $result = $this->Admin_model->getAllcities();
    $result['cities'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/institutes/addinstitutes', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  public function add_institutes() {

    $this->login_check();

    $this->form_validation->set_rules('institute_name', 'Institute Name', 'required');
    $this->form_validation->set_rules('cities', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getAllcities();
      $result['cities'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/campus/addinstitutes', $result);
      $this->load->view('admin_ace/admin_footer');
    } else {

      $check_institute = array(
          'institute_name' => $_POST['institute_name'],
      );

      // check campus name and code already exitsts or not

      $res = $this->Admin_model->checkInstitute($check_institute);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Institute Name Already Exists');
        redirect('admin/add_campus_form');
      } else {
        $institute_data = array(
            'institute_name' => $_POST['institute_name'],
            'city_id' => $_POST['cities']
        );

        $result = $this->Admin_model->addInstitute($institute_data);
        if ($result) {
          $this->session->set_userdata('success_msg', 'New Institute Added Successfully');
          redirect('admin/view_institutes');
        }
      }
    }
  }

  public function view_institutes() {

    $this->login_check();

    $result['institutes'] = $this->Admin_model->getAllInstitutes();
     

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/institutes/viewinstitutes', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  public function edit_institute() {

    $this->login_check();
    $city_result = $this->Admin_model->getAllcities();
    $result['cities'] = $city_result;

    $id = $_GET['institute_id'];

    $institute_result = $this->Admin_model->getInstitute($id);
    $result['institute'] = $institute_result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/institutes/editinstitute', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the campus name 
  public function update_institute() {

    $this->login_check();
    $id = $_POST['institute_id'];

    $this->form_validation->set_rules('institute_name', 'Institute Name', 'required');
    $this->form_validation->set_rules('cities', 'City Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result = $this->Admin_model->getInstitute($id);
      $result['institute'] = $result;

      $city_result = $this->Admin_model->getAllcities();
      $result['cities'] = $city_result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/institutes/editinstitute', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
    // check campus name and code already exitsts or not

    $check_institute = array(
        'institute_name' => $_POST['institute_name']
    );
    $res = $this->Admin_model->checkInstitute($check_institute);
    if ($res) {
      $this->session->set_userdata('error_msg', 'Institute Name Already Exists');
      
      $result = $this->Admin_model->getInstitute($id);
      $result['institute'] = $result;

      $city_result = $this->Admin_model->getAllcities();
      $result['cities'] = $city_result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/institutes/editinstitute', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    else {
      $institute = array(
          'institute_name' => $_POST['institute_name'],
          'city_id' => $_POST['cities']
      );
      $result = $this->Admin_model->updateInstitute($id, $institute);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Institute record updated Successfully');
        redirect('admin/view_institutes');
      }
    }
  }

  //  *****    Start Functions for Reference Module   *****  //      
  // form to Add Reference

  public function add_reference_form() {

    $this->login_check();
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/reference/addreference');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Reference in database

  public function add_reference() {

    $this->login_check();
    
    $this->form_validation->set_rules('reference', 'Reference Name', 'required');

    if ($this->form_validation->run() == FALSE) {      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/reference/addreference');
      $this->load->view('admin_ace/admin_footer');
    } 
    else {
      $reference = array(
          'reference_source' => $_POST['reference']
      );

      // check Reference name already exitsts

      $res = $this->Admin_model->checkReference($reference);

      if ($res) {
        $this->session->set_userdata('error_msg', 'Reference Already Exists');
        redirect('admin/add_reference_form');
      } else {
        $result = $this->Admin_model->addReference($reference);

        if ($result) {
          $this->session->set_userdata('success_msg', 'Reference Added Successfully');
          redirect('admin/view_references');
        }
      }
    }
  }

  // display all the References 

  public function view_references() {
    $this->login_check();

    $result['references'] = $this->Admin_model->getAllReferences();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/reference/viewreferences', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of Reference to be edited

  public function edit_reference() {
    $this->login_check();

    $id = $_GET['reference_id'];
    $result = $this->Admin_model->getReference($id);
    $result['reference'] = $result;

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/reference/editreference', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Reference
  public function update_reference() {

    $this->login_check();
    $id = $_POST['reference_id'];
    
    $this->form_validation->set_rules('reference', 'Reference Name', 'required');

    if ($this->form_validation->run() == FALSE) {      
      $result = $this->Admin_model->getReference($id);
      $result['reference'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/reference/editreference', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    // check Reference name already exitsts
    $reference = array(
          'reference_source' => $_POST['reference']
    );
    $res = $this->Admin_model->checkReference($reference);
    if ($res) {
      $this->session->set_userdata('error_msg', 'Reference Already Exists');
      
      $result = $this->Admin_model->getReference($id);
      $result['reference'] = $result;

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/reference/editreference', $result);
      $this->load->view('admin_ace/admin_footer');
    }    
    else {
      $id = $_POST['reference_id'];
      $reference = array('reference_source' => $_POST['reference']);
      $result = $this->Admin_model->updateReference($id, $reference);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Reference updated Successfully');
        redirect('admin/view_references');
      }
    }
  }
  
  
  //  *****    Start Functions for City Module   *****  //      
  // form to Add city 

  public function add_prog_dept_form() {

    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_department/add_prog_dept');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Program Department in database

  public function add_prog_dept() {

    $this->login_check();

    $this->form_validation->set_rules('prog_dept_name', 'Program Department Name', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/program_department/add_prog_dept');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $prog_dept = array(
          'program_department_name' => $_POST['prog_dept_name']
      );

      // check Program Department Name already exitsts
      $res = $this->Admin_model->checkProgDept($prog_dept);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Program Department Name Already Exists');
        redirect('admin/add_prog_dept_form');
      } 
      else {
        $result = $this->Admin_model->addProgDept($prog_dept);
        
        if ($result) {
          $this->session->set_userdata('success_msg', 'Program Department Name Added Successfully');
          redirect('admin/view_prog_depts');
        }
      }
    }
  }

  // display all the Program Department 

  public function view_prog_depts() {
    $this->login_check();

    $result['prog_dept'] = $this->Admin_model->getAllProgDepts();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_department/view_prog_depts', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of Program Department to be edited

  public function edit_prog_dept() {
    $this->login_check();

    $id = $_GET['prog_dept_id'];
    $result['prog_dept'] = $this->Admin_model->getProgDept($id);

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_department/edit_prog_dept', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Program Dapertment name 
  public function update_prog_dept() {

    $this->login_check();
    $id = $_POST['prog_dept_id'];
    
    $this->form_validation->set_rules('prog_dept_name', 'Program Department Name', 'required');
    
    if ($this->form_validation->run() == FALSE) {
      
      $result['prog_dept'] = $this->Admin_model->getProgDept($id);

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/program_department/edit_prog_dept', $result);
      $this->load->view('admin_ace/admin_footer');
    }  
    
    // check Program Department Name already exitsts
    $prog_dept = array(
          'program_department_name' => $_POST['prog_dept_name']
      );
    $res = $this->Admin_model->checkProgDept($prog_dept);
    if ($res) {
      $this->session->set_userdata('error_msg', 'Program Department Name Already Exists');

      $result['prog_dept'] = $this->Admin_model->getProgDept($id);

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/program_department/edit_prog_dept', $result);
      $this->load->view('admin_ace/admin_footer');
    }
    else {
      $prog_dept = array('program_department_name' => $_POST['prog_dept_name']);
      $result = $this->Admin_model->updateProgDept($id, $prog_dept);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Program Department Name updated Successfully');
        redirect('admin/view_prog_depts');
      }
    }
  }
  
  //---------------End of Program Departments----------------//


  //  *****    Start Functions for Program Module   *****  //   
  // add new Program form
  public function add_program_form() {

    $this->login_check();

    $result['prog_dept'] = $this->Admin_model->getAllProgDepts();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program/add_program', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // for Program in database

  public function add_program() {

    $this->login_check();

    $this->form_validation->set_rules('prog_name', 'Program Name', 'required');
    $this->form_validation->set_rules('prog_code', 'Program Code', 'required');
    $this->form_validation->set_rules('prog_type', 'Program Type', 'required');
    $this->form_validation->set_rules('no_of_sessions', 'No. of Sessions', 'required|numeric|max_length[2]');
    $this->form_validation->set_rules('prog_dept', 'Program Department', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['prog_dept'] = $this->Admin_model->getAllProgDepts();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/program/add_program', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    else {
      $program = array(
          'program_name'          => $_POST['prog_name'],
          'program_code'          => $_POST['prog_code'],
          'program_type'          => $_POST['prog_type'],
          'no_of_sessions'       => $_POST['no_of_sessions'],
          'program_department_id' => $_POST['prog_dept']
      );

      // check Program already exitsts
      $res = $this->Admin_model->checkProgram($program);
      if ($res) {
        $this->session->set_userdata('error_msg', 'The Program Already Exists');
        redirect('admin/add_program_form');
      } 
      else {
        $result = $this->Admin_model->addProgram($program);

        if ($result) {
          $this->session->set_userdata('success_msg', 'Program Added Successfully');
          redirect('admin/view_programs');
        }
      }
    }
  }

  // Display all the Programs 

  public function view_programs() {

    $this->login_check();

    $result['programs'] = $this->Admin_model->getAllPrograms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program/view_programs', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the Program to be edited

  public function edit_program() {

    $this->login_check();

    $prog_data = array('program_id' => $_GET['program_id']);
    $result['program'] = $this->Admin_model->getProgram($prog_data);
    $result['prog_dept'] = $this->Admin_model->getAllProgDepts();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program/edit_program', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Program Name 

  public function update_program() {

    $this->login_check();
    $prog_id = $_POST['prog_id'];    
    
    $this->form_validation->set_rules('prog_name', 'Program Name', 'required');
    $this->form_validation->set_rules('prog_code', 'Program Code', 'required');
    $this->form_validation->set_rules('prog_type', 'Program Type', 'required');
    $this->form_validation->set_rules('no_of_sessions', 'No.of Sessions', 'required|numeric|max_length[2]');
    $this->form_validation->set_rules('prog_dept', 'Program Department', 'required');

    if($this->form_validation->run() == FALSE) {

      $prog_data = array('program_id' => $prog_id);
      $result['program'] = $this->Admin_model->getProgram($prog_data);
      $result['prog_dept'] = $this->Admin_model->getAllProgDepts();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/program/edit_program', $result);
      $this->load->view('admin_ace/admin_footer');
    } 
    
    
      $program = array(
          'program_name' => $_POST['prog_name'],
          'program_code' => $_POST['prog_code'],
          'program_type' => $_POST['prog_type'],
          'no_of_sessions' => $_POST['no_of_sessions'],
          'program_department_id' => $_POST['prog_dept']
      );

      $result = $this->Admin_model->updateProgram($prog_id, $program);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Program updated Successfully');
        redirect('admin/view_programs');
      }
    
  }

  //---------------End of Programs----------------//
  
  
  
  //  *****    Start Functions for Program Fee Module   *****  //   
  // add new Program fee form
  public function add_program_fee_form() {

    $this->login_check();
    
    $result['program'] = $this->Admin_model->getAllprograms();
    $result['campus']  = $this->Admin_model->getAllCampuses();
    $result['campaign']  = $this->Admin_model->getAllcampaigns();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_fee/add_program_fee', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // for Program fee in database

  public function add_program_fee() {

    $this->login_check();

    $this->form_validation->set_rules('program[]', 'Program', 'required');
    $this->form_validation->set_rules('campus', 'Campus', 'required');
    $this->form_validation->set_rules('campaign', 'campaign', 'required');
    $this->form_validation->set_rules('no_of_sessions', 'No of Sessions', 'required');
    $this->form_validation->set_rules('admission_fee', 'Admission Fee', 'required');
    $this->form_validation->set_rules('session_fee', 'Session Fee', 'required');
    $this->form_validation->set_rules('misc_fee', 'Misc Fee', 'required');
    //$this->form_validation->set_rules('year_date', 'Date', 'required');

    if ($this->form_validation->run() == FALSE) {

      $result['program'] = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin/program_fee/add_program_fee', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    else {
        
         foreach($_POST['program'] as $program){
          $program_fee = array(
          'program_id'          => $program,
          'no_of_sessions'      => $_POST['no_of_sessions'],
          'misc_fee'            => $_POST['misc_fee'],
          'admission_fee'       => $_POST['admission_fee'],
          'session_fee'         => $_POST['session_fee'],
          'campus_id'           => $_POST['campus'],
          'campaign_id'         => $_POST['campaign'],
          'year_date'           => date('Y-m-d'),
          'type'                => $_POST['type']
      );

      // check Program fee already exitsts
     
      $date = $result = substr($_POST['year_date'], 0, 7);
      $program_id     = $program; 
      $campus_id      = $_POST['campus']; 
      $campaign_id    = $_POST['campaign']; 
      $res = $this->Admin_model->checkProgramFee($date, $program_id, $campus_id, $campaign_id);
      if ($res) {
        $this->session->set_userdata('error_msg', 'The Program Fee of this program Already Revised in This Month');
        redirect('admin/add_program_fee');
      } 
      else {
        $result = $this->Admin_model->addProgramFee($program_fee);

      }
          
            } 
            
        if ($result) {
          $this->session->set_userdata('success_msg', 'Program Fee Added Successfully');
          redirect('admin/view_program_fee');
        }
        
        
      
    }
  }

  // Display all the Programs fee 

  public function view_program_fee() {

    $this->login_check();
    
    $result['campaign'] =   $this->Admin_model->getAllcampaigns();
    $campaign_id        =   $result['campaign'][0]['campaign_id'];

    $result['programs_fee'] = $this->Admin_model->getAllprogramsFee($campaign_id);

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_fee/view_program_fee', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the Program fee to be edited

  public function edit_program_fee() {

    $this->login_check();

    $program_fee_id = array('program_fee_id' => $_GET['program_fee_id']);
    $result['program_fee'] = $this->Admin_model->getProgramFee($program_fee_id);
    $result['program'] = $this->Admin_model->getAllprograms();
    $result['campus']  = $this->Admin_model->getAllCampuses();
    $result['campaign']  = $this->Admin_model->getAllcampaigns2();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_fee/edit_program_fee', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the Program fee 

  public function update_program_fee() {

    $this->login_check();
    $program_fee_id = $_POST['program_fee_id'];    
    
    $this->form_validation->set_rules('program', 'Program', 'required');
    $this->form_validation->set_rules('campus', 'Campus', 'required');
    $this->form_validation->set_rules('campaign', 'campaign', 'required');
    $this->form_validation->set_rules('no_of_sessions', 'No of Sessions', 'required');
    $this->form_validation->set_rules('admission_fee', 'Admission Fee', 'required');
    $this->form_validation->set_rules('session_fee', 'Session Fee', 'required');
    $this->form_validation->set_rules('misc_fee', 'Misc Fee', 'required');
    //$this->form_validation->set_rules('year_date', 'Date', 'required');

    if($this->form_validation->run() == FALSE) {

    $program_fee_id = array('program_fee_id' => $_POST['program_fee_id']);
    $result['program_fee'] = $this->Admin_model->getProgramFee($program_fee_id);
    $result['program'] = $this->Admin_model->getAllprograms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/program_fee/edit_program_fee', $result);
    $this->load->view('admin_ace/admin_footer');
    } 
    
    
       $program_fee = array(
          'program_id'          => $_POST['program'],
          'no_of_sessions'      => $_POST['no_of_sessions'],
          'admission_fee'       => $_POST['admission_fee'],
          'misc_fee'            => $_POST['misc_fee'],
          'session_fee'         => $_POST['session_fee'],
          'campus_id'           => $_POST['campus'],
          'campaign_id'         => $_POST['campaign'],
          'year_date'           => date('Y-m-d'),
          'type'                => $_POST['type']
      );

      $result = $this->Admin_model->updateProgramFee($program_fee_id, $program_fee);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Program Fee updated Successfully');
        redirect('admin/view_program_fee');
      }
    
  }

  //---------------End of Programs Fee----------------//
  
  
  
  
  //  *****    Start Functions for Product Module   *****  //  
  // Form to Add Product 

  public function add_product_form() {

    $this->login_check();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/product/addproduct');
    $this->load->view('admin_ace/admin_footer');
  }

  // for Add Product in database

  public function add_product() {

    $this->login_check();

    
    
    $this->form_validation->set_rules('product', 'product ', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admin/product/addproduct');
      $this->load->view('admin_ace/admin_footer');
    } else {
      $product = array(
          'product_name' => $_POST['product']
      );

      // check Product name already exitsts

      $res = $this->Admin_model->checkProduct($product);

      if ($res) {
        $this->session->set_userdata('error_msg', 'This product  Already Exists');
        redirect('admin/add_product_form');
      } else {
        $product_data = array(
            'product_name' => $_POST['product'],
            'price' => $_POST['price']
        );
        $result = $this->Admin_model->addProduct($product_data);

        if ($result) {
          $this->session->set_userdata('success_msg', 'product Added Successfully');
          redirect('admin/view_products');
        }
      }
    }
  }

  // display all the Products 

  public function view_products() {
    $this->login_check();

    $result['products'] = $this->Admin_model->getAllproducts();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin/product/viewproducts', $result);
    $this->load->view('admin_ace/admin_footer');
  }

    
  
  //---------------End of Product----------------//
  

  
  
  
  
  
}