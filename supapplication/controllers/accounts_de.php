<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounts_de extends CI_Controller {

    public function __construct() {

    parent::__construct();

    
    $this->load->model('Admin_model');
    $this->load->model('Admission_r_model');
    $this->load->model('Admission_model');
    $this->load->model('Accounts_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {

    $this->load->view('admissions/accounts/login');
  }
  
  
     
  // for verification of admin login

  public function login_check() {

    if ($this->session->userdata('admin_id') == '' && $this->session->userdata('username') == '') {
      redirect('accounts_de/index');
    }
  }
  
   public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
           $this->load->view('admissions/accounts/login');
    } else {

      $this->load->library('encrypt');

      $encrypted_password = $this->encrypt->sha1($_POST['password']);
      
      $login_data = array(
          'acc_login'    => $_POST['username'],
          'acc_password' => $encrypted_password,
      );

      
      $result = $this->Admin_model->adminLogin($login_data);
           

      if ($result) {
          
        $sessionData = array(
            'username'        => $result->acc_login,
            'admin_id'        => $result->acc_login_id,
            'account_role_id' => $result->account_role_id,
        );

        $this->session->set_userdata($sessionData);
     
        redirect('accounts_de/dashboard');
      } else {

        $this->session->set_userdata('error', 'Incorrect Username OR Password');
        redirect('accounts_de/index');
      }
    }
  }

  // for admin logout 
  public function logout() {

    $this->session->unset_userdata('admin_id');
    $this->session->unset_userdata('username');
    $this->session->sess_destroy();
    redirect('accounts_de/index');
  }

  // admin dashboard

  public function dashboard() {

    $this->login_check();
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }
  
  
   public function view_student_form()
    {
      $this->login_check();

      $result['form_data'] = $this->Accounts_model->getAllStudentForms();

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/admin_side_menu');
      $this->load->view('admissions/accounts/form/view_forms', $result);
      $this->load->view('admin_ace/admin_footer');
    }
  
  
// ******>>>>         Start functions for Student Pakage        <<<<******  //
        

// define student pakage form 
        
        public function student_package()
        {
          
          $this->login_check();
          
                                      
          $student_id           = $_REQUEST['student_id'];                   
          $program_id           = $this->session->userdata('program_id');           
          $result['package']    = $this->Accounts_model->getStudentPackage($student_id);
                    
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
            $session_id         = $_POST['session_id'];
            $operator_id        = $this->session->userdata('admin_id');
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
                        
                        $this->session->set_userdata('package',$session_package2);
                        $this->session->set_userdata('student_id',$student_id);
                        $this->session->set_userdata('program_id',$program_id);
                        $this->session->set_userdata('session_id',$session_id);
                        $this->session->set_userdata('success_msg','Student Package Added Successfully');
                        redirect('accounts_de/installments/?student_id='.$student_id);
                 }
             else
                 {
                        $this->session->set_userdata('error_msg','Student Package Not Added Successfully, Please Try Again!');
                        redirect('accounts_de/student_package');
                 }
                 
            
        }
        
        
        
        
        
 // add installments of student package
        
        public function installments()
        {
           $this->login_check();

           
           $result['student_id']        =    $_GET['student_id'];
          
           $res['packageInfo']          =    $this->Accounts_model->getPackageInfo($_GET['student_id']);
           $result['std_installments']  =    $this->Accounts_model->getStudentInstallments($_GET['student_id']);
           $chk_installment             =    count($result['std_installments']);
           
           if($chk_installment > 0 ){
               $result['package']       =    $res['packageInfo'][0]['session_total_package'];
           }else{
               $result['package']       =    $res['packageInfo'][0]['session_total_package']+$res['packageInfo'][0]['admission_fee'];
           }
           
           $result['program_id']        =    $res['packageInfo'][0]['program_id'];
           $result['session_id']        =    $res['packageInfo'][0]['enrolled_session_id'];
           
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
            $student_id     = $_POST['student_id'];
            
            $check_data     = array(
                                        'student_id' => $student_id,
                                        'session_id' => $session_id,
                                    );
            
            $result         = $this->Accounts_model->chkSession_inInstallment($check_data);
            
            if($result == 0)
            {
            
                        $student_id     = $student_id;
                        $program_id     = $_POST['program_id'];
                        $operator_id    = $this->session->userdata('admin_id');
     
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

                               $challan_id   =   $this->Accounts_model->addInstallments2($installment_data,$student_id,$due_date[0][$i]);
                                                            
                               if(!$challan_id)
                               {
                                   echo 'Not Added';
                               }
                               
                          }
                        }

                        $this->session->set_userdata('success_msg','Student Installments Added Successfully');
                        $this->session->unset_userdata('program_id');
                        $this->session->unset_userdata('package');
                        redirect('accounts_de/view_package/?student_id='.$student_id);
            }else{
                
                     $this->session->set_userdata('error_msg','Installments of this session Already Exists.. Please try Another!');
                     redirect('accounts_de/installments');
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
        
            $this->session->set_userdata('package',$result['std_package'][0]['session_total_package']);

            $this->session->set_userdata($result);
            
            $result['std_installments']      =   $this->Accounts_model->getStudentInstallments($student_id);
            
                        
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admissions/accounts/student_package/view_package', $result);
            $this->load->view('admin_ace/admin_footer');
        }

        
// view challan
        
        public function view_challan()
        {
            if(!empty($_POST))
            {
               $program_id              =    $_POST['program']; 
               $batch_id                =    $_POST['batch']; 
               $date_range              =    $_POST['date-range-picker']; 
               if($date_range == '')
               {
                $date1                  =   date('Y-m-d');
                $date2                  =   date('Y-m-d', strtotime("$date1 +3 month"));
               }else{
               $dateArray               =    explode("-", $date_range);
               $date1                   =    date("Y-m-d", strtotime($dateArray[0]));
               $date2                   =    date("Y-m-d", strtotime($dateArray[1]));
               }
               
               $result['challan']       =   $this->Accounts_model->getChallanInfo($program_id,$batch_id,$date1,$date2);
                
               $result['batches']       = $this->Admin_model->getAllbatches();
               $result['programs']      = $this->Admin_model->getAllprograms();
               $result['batch_id']     =  $batch_id;
               $result['program_id']   =  $program_id;

               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('admissions/accounts/student_package/viewchallan', $result);
               $this->load->view('admin_ace/admin_footer');
               
               
            }else{
                
                $program_id             =   23;                
                $batch_id               =   1;             
                $date1                  =   date('Y-m-d');
                $date2                  =   date('Y-m-d', strtotime("$date1 +3 month"));
                
                $result['challan']      =   $this->Accounts_model->getChallanInfo($program_id,$batch_id,$date1,$date2);
                
                //echo '<pre>'; var_dump($result['challan']);die;
                
                $result['batches']      = $this->Admin_model->getAllbatches();
                $result['programs']     = $this->Admin_model->getAllprograms();
                $result['batch_id']     =   1;
                $result['program_id']   =   23;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions/accounts/student_package/viewchallan', $result);
                $this->load->view('admin_ace/admin_footer');
            }
            
        }
        
      
// post challan form
        
        public function post_challan_form()
        {
            
           if(!empty($_POST))
            {
               $program_id              =    $_POST['program']; 
               $batch_id                =    $_POST['batch']; 
               
               $this->session->set_userdata('program_id', $program_id);
               $this->session->set_userdata('batch_id', $batch_id);
               
               $date_range              =    $_POST['date-range-picker']; 
               if($date_range == '')
               {
                $date1                  =   date('Y-m-d');
                $date2                  =   date('Y-m-d', strtotime("$date1 +3 month"));
               }else{
               $dateArray               =    explode("-", $date_range);
               $date1                   =    date("Y-m-d", strtotime($dateArray[0]));
               $date2                   =    date("Y-m-d", strtotime($dateArray[1]));
               }
               $result['challan']       =   $this->Accounts_model->getChallanInfo($program_id,$batch_id,$date1,$date2);
                
               $result['batches']       = $this->Admin_model->getAllbatches();
               $result['programs']      = $this->Admin_model->getAllprograms();
               $result['batch_id']     =  $batch_id;
               $result['program_id']   =  $program_id;

               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('admissions/accounts/student_package/postchallanform', $result);
               $this->load->view('admin_ace/admin_footer');
               
               
            }else{
                
                if($this->session->userdata('program_id') != '')
                {
                    $program_id             =   $this->session->userdata('program_id');                
                    $batch_id               =   $this->session->userdata('batch_id'); 
                    
                    
                }else{
                    $program_id             =   23;                
                    $batch_id               =   1;    
                    
                }
                
                $date1                  =   date('Y-m-d');
                $date2                  =   date('Y-m-d', strtotime("$date1 +3 month"));
                
                $result['challan']      =   $this->Accounts_model->getChallanInfo($program_id,$batch_id,$date1,$date2);
                
                //echo '<pre>'; var_dump($result['challan']);die;
                
                $result['batches']      = $this->Admin_model->getAllbatches();
                $result['programs']     = $this->Admin_model->getAllprograms();
                $result['batch_id']     =   $batch_id;
                $result['program_id']   =   $program_id;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('admissions/accounts/student_package/postchallanform', $result);
                $this->load->view('admin_ace/admin_footer');
            }
        }        
        
        
// post challan
        
        public function post_challan()
        {
            
            
            
            $challan_id     =   $_POST['challan_id'];
            $post_date      =   $_POST['post_date'];
            
            $result         =   $this->Accounts_model->postChallan($challan_id,$post_date);
            
            if($result)
            {
                        $this->session->set_userdata('success_msg','Challan Posted Successfully');                        
                        redirect('accounts_de/post_challan_form');
            }else{
                        $this->session->set_userdata('error_msg','Challan Not Posted Successfully');                        
                        redirect('accounts_de/post_challan_form');
            }
        }
        
        
// print challan for installment
        
        public function print_challan()
        {         
           $challan_id                      =   $_GET['challan_id'];
           $student_id                      =   $_GET['student_id'];
           $result['std_package']           =   $this->Admission_model->getStudentPackageInfo($student_id);
           $result['challan_info']          =   $this->Admission_model->getChallanInfo($challan_id,$student_id);
           $amount                          =   $result['challan_info'][0]['amount'];
           $amount_in_word                  =   $this->convert_number_to_words($amount);
           
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
               'session'          =>$result['std_package'][0]['session'],
               'bank_name'        =>$result['std_package'][0]['bank_name'],
               'bank_address'     =>$result['std_package'][0]['bank_address'],
               'account_no'       =>$result['std_package'][0]['account_no'],
               'bank_city'        =>$result['std_package'][0]['bank_city']

            );
          
            $this->load->view('admissions/accounts/student_package/challan', $result);
        }
        
        
// print challan for installment
        
        public function show_challan()
        {         
           
           $challan_id                      =   $_GET['challan_id'];
           $student_id                      =   $_GET['student_id'];
           $result['std_package']           =   $this->Admission_model->getStudentPackageInfo($student_id);
           $result['challan_info']          =   $this->Admission_model->getChallanInfo($challan_id,$student_id);
           $amount                          =   $result['challan_info'][0]['amount'];
           $amount_in_word                  =   $this->convert_number_to_words($amount);
           
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
               'session'          =>$result['std_package'][0]['session'],
               'bank_name'        =>$result['std_package'][0]['bank_name'],
               'bank_address'     =>$result['std_package'][0]['bank_address'],
               'account_no'       =>$result['std_package'][0]['account_no'],
               'bank_city'        =>$result['std_package'][0]['bank_city']

            );
//          echo '<pre>';
//          var_dump($result['challan']);die;
            $this->load->view('admissions/accounts/student_package/challan2',$result);
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



  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */