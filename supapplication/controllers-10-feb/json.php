<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class json extends CI_Controller {

  public function __construct() {

    parent::__construct();

    $this->load->model('Admin_model');
    $this->load->model('Student_model');
    $this->load->model('Accounts_model');
    $this->load->model('Inquiry_model');
    $this->load->model('Json_model');
    $this->load->model('Admission_r_model');
    
    $this->load->library('session');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }

 
  // Signup Student Programs list
  public function signup_program_list() {

    $result['signup_programs']['programs'] = $this->Admin_model->getAllprograms();
    echo json_encode($result['signup_programs']['programs']);
  }
  
  
  // Student Signup 
  public function signup()
  {      
      $roll_no    = $_REQUEST['roll_no'];
      $program_id = $_REQUEST['prog_id'];
      $email      = $_REQUEST['email'];

      $this->form_validation->set_rules('roll_no', 'Roll No', 'trim|required');
      $this->form_validation->set_rules('student_name', 'Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('prog_id', 'Program', 'required');

      if ($this->form_validation->run() == FALSE) {
        
          $result['status'] = "Error";
          $result['msg']    = "Empty Field";
          echo json_encode($result);
      }
      else
      {
          //--- Check Student Existance in Student Login table ---\\
          $check_student = $this->Student_model->checkSignUpStudent($roll_no);   

          if($check_student)
          {
              $result['status']   = 'Error';
              $result['msg']      = 'Already Registered';
              echo json_encode($result);
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
                    'roll_no'      =>  $roll_no,
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
                   // $this->email->to('hafizmabuzar@gmail.com');// change it to yours
                    $this->email->to($email);// change it to yours
                    $this->email->subject('Password');
                    $this->email->message('<b>Your Password is :</b> student123');
                    $this->email->send();
          //           show_error($this->email->print_debugger());

                    
                $result['status']   = 'Success';
                $result['msg']      = 'Successfully Registered';
                echo json_encode($result);

                }
              }
              else
              {
                  $result['status']   = 'Error';
                  $result['msg']      = 'Record Not Found';
                  echo json_encode($result);
              }
          }
      }
  }
  
  
  // Student Login 
  public function student_login() {
    
      $roll_no  = $this->input->get_post('roll_no');
      $password = $this->input->get_post('password');
   
      $this->load->library('encrypt');
      $encrypted_password = $this->encrypt->sha1($password);

    
     $res = $this->Student_model->studentLogin($roll_no,$encrypted_password);     
      if ($res) {
          $result['status']            =  "Success";
          $result['msg']               =  "Successfully Logged In";
          $result['student_login_id']  =  $res->student_login_id;
          $result['roll_no']           =  $res->roll_no;
          $result['student_name']      =   $res->student_name;
          $result['student_id']        =   $res->student_id;

          echo json_encode($result);
      } 
      else 
      {
          $result['status']            =  "Error";
          $result['msg']               =  "Invalid Username or Password";
          echo json_encode($result);
      }
  }
  
  
  // Student Profile
  public function student_profile()
  {
    $student_id = $this->input->get_post('student_id');
    
    //-------- Get Student Infromation --------\\
    $result['student_profile'] = $this->Student_model->getStudentProfile($student_id); 
    $total_records             = count($result['student_profile']);
    
    if($total_records > 0)
    {
        $result['status'] = 'Success';
        echo json_encode($result);      
    }else{
        $result['status'] = 'Error';
        echo json_encode($result);      
    }
    
    
  }
   
  
  // view student package Form
        
        public function view_package()
        {
      
            $student_id                      =   $this->input->get_post('student_id');
           
            $res                             =   $this->Accounts_model->getStudentPackageInfo($student_id);
            if($res)
            {
                $result['status']            =   'Success';
                $result['std_package']       =   $res;
                $result['std_installments']  =   $this->Accounts_model->getStudentInstallments($student_id);
            
                echo json_encode($result);   
            }
            
            else 
            {
                $result['status']            =  "Error";
                $result['msg']               =  "Record Not Found";
                echo json_encode($result);
            }
            
        }

        
        
        // added on 6-20-2014
        
        public function inquiry_data(){
            
            
            $form_no        = urlencode($_REQUEST['form_no']);
            $mobile_no      = urlencode($_REQUEST['mobile_no']);
            
            $res11          = $this->Inquiry_model->validform($form_no ,$mobile_no);
            
            //echo '<pre>';var_dump($res11);echo '</pre>';exit;
            
            if(empty($res11)){
                $resx4['error']   = 'Invalid inquiry.';
                echo json_encode($resx4);exit;
            }
            
            $inquiry_id     = $res11[0]['inquiry_id'];
            $form_id        = $res11[0]['form_id'];
            
            
            $res            = $this->Inquiry_model->validInquiryNew($inquiry_id );
            $pre_inst       = $this->Admin_model->getInstitute($res[0]['previous_institute']);
            
            $resx['Personal']['success']     = 'Success';
            $resx['Personal']['inquiry_no']  = $res[0]['inquiry_no'];
            //$resx['inquiry_date']             = $res[0]['Inquiry_date'];
            $resx['Personal']['name']        = $res[0]['name'];
            $resx['Personal']['gender']      = $res[0]['gender'];
            
            $prg_arra                        = array('program_id' => $res[0]['program_id']);
            
            $prg_inst                        = $this->Admin_model->getProgram($prg_arra);
            $prg_name                        = $prg_inst[0]['program_name'];
            
            $resx['Personal']['program']                = $prg_name;
            $resx['Personal']['previousqualification']  = $res[0]['qualification'];
            $resx['Personal']['shift']                  = $res[0]['shift'];
            $resx['Personal']['previous_inst']          = $pre_inst[0]['institute_name'];
            $admission_stage                            = $res[0]['admission_stage'];
            $resx['Personal']['inquiry_date']           = date('d-M-Y',strtotime($res[0]['inquiry_date']));
            
            switch ($admission_stage) {
                
               case "0":
                 $vara                          = 'Inquiry submitted.';
                 $chk                           = '0';
                 break;
             
               case "1":
                 $vara                          = 'Initial form filled.';
                 $chk                           = '1';
                 $form_data                     = $this->Inquiry_model->initialformData($inquiry_id);
                 $resx['Personal']['form_no']    = $form_data[0]['form_no'];
                 $resx['Personal']['date']      = date('d-M-Y',strtotime($form_data[0]['created_date']));
               break;
             
               case "2":
                 $vara                      = 'Form completed.';
                 $chk                       = '2';
                 $form_data                 = $this->Inquiry_model->finlaformData($inquiry_id);
                 //echo '<pre>';var_dump($form_data);echo '</pre>';exit;
                 
                 $resx['Personal']['date']              = date('d-M-Y',strtotime($form_data[0]['form_submit_date']));
                 $resx['Personal']['form_no']           = $form_data[0]['form_no'];
               break;
             
//               case "2":
//                 $vara                      = 'Form completed.';
//                 $chk                       = '2';
//                 $form_data                 = $this->Inquiry_model->finlaformData($inquiry_id);
//                 
//                 $resx['Personal']['date']  = date('d-M-Y',strtotime($form_data[0]['created_date']));
//                 //$resx['Personal']['date']  = date('d-M-Y',strtotime($form_data[0]['form_submit_date']));
//                 $resx['Personal']['form_no']= $form_data[0]['form_no'];
//               break;
             
               case "3":
                 $vara  = 'In Accounts.';
                 $chk   = '3';
                 $resx['Personal']['date']          = null;
               break;
               default:
            }
            
            $resx['Personal']['admission_stage']    = $vara;
            
            $program_id                          = $res[0]['program_id'];
            
            $data = $this->Json_model->getEntryTestNew($program_id,$form_id);
            //echo '<pre>';var_dump($data );echo '</pre>';exit;
            
            $resx['EntryTest']['date']           = $data[0]['test_date'];
            $resx['EntryTest']['time']           = $data[0]['test_time'];
            
            $test_venue                          = $data[0]['test_venue'];
            $resx['EntryTest']['venue']          = $test_venue ;
            
            $resx['EntryTest']['program']        = $prg_name;
            $resx['EntryTest']['floor']          = $data[0]['floor'];
            $resx['EntryTest']['room']           = $data[0]['room_name'];
            
            
            $resultdata = $this->Json_model->getEntryTestResult($program_id,$form_id);
            
            $created_date  = $resultdata[0]['created_date'];
            $arr = explode(' ', $created_date);
            //echo '<pre>';var_dump($created_date);echo '</pre>';exit;
            
            $resx['Result']['date']              = $arr[0];
            $resx['Result']['time']              = $arr[1];
            //$resx['Result']['venue']             = 'Superior Univeristy ';
            $resx['Result']['venue']             = $test_venue;
            $resx['Result']['program']           = $prg_name;
            $marks = $resultdata[0]['marks'];
            $resx['Result']['marksobtained']     = $marks ;
            $resx['Result']['totalmarks']        = '100';
            $percent                             = ($marks /100 )*100;
            
            $resx['Result']['percentage']        = $percent;
            
            $resulti  =  $marks  >= 50 ? 'Pass' : 'Fail';
            
            
            $resx['Result']['status']            = $resulti;
//            if( $resulti == 'Pass'){
//                $resx['Interview']['date']       = '2014-08-12';
//                $resx['Interview']['time']       = '10:30 am';
//                $resx['Interview']['venue']      = 'Superior Univeristy ';
//                $resx['Interview']['program']    = 'Bachelor in Computer Science';
//            }
            
            
            if(!empty($res)){
                echo json_encode($resx);exit;
            }else{
                //echo json_encode('Invalid inquiry.');exit;
                $resx4['error']   = 'Invalid inquiry.';
                echo json_encode($resx4);exit;
            }

        }
        
        
        
        
        public function save_inquiry(){
            
            
                // $inquiry_no 
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';exit;
            
                $uni    =  '';
                $jessi  = '';
                $inquiry_data = array(
                    'inquiry_no'    => $inquiry_no ,
                    'campaign_id'   => $_POST['campaign'],
                    'name'          => $_POST['name'],
                    'contact'       => $_POST['mobile'],
                    'phone'         => $_POST['phone'],
                    'program_id'    => $_POST['program'],
                    'shift'         => $_POST['shift'],
                    'gender'        => $_POST['gender'],
                    'qualification' => $_POST['qualification'],
                    'total_marks'   => $_POST['total_marks'],
                    'obtained_marks'=> $_POST['total_marks'],
                    'reference_id'  => $_POST['reference'],
                    'inquiry_type'  => 'Electronic',
                    'previous_institute' => null,
                    'remarks'       => null,
                    'operator_id'   => $jessi,
                    'campus_id'     => $uni,
                    'inquiry_date'  => $_POST['apply_date']
                );

                $inquiry_id    = $this->Admission_r_model->addInquiry($inquiry_data);
                
                // refrence _id
                $reference        =   $_POST['reference'];
                
                                
              if($reference == '13')
                {
                    $reference_data     = array(
                                                'inquiry_id'    =>  $inquiry_id,
                                                'others'        =>  $_POST['new_reference'],
                                                'created_date'  =>  $_POST['apply_date']
                                                );
                    $inquiry_reference_id    =   $this->Admission_r_model->addInquiryReference($reference_data);
                }
//                if($reference == '6'){
//                    $reference_data     = array(
//                                    'inquiry_id'    =>  $inquiry_id,
//                                    'name'          =>  $_POST['ref_name'],
//                                    'designation'   =>  $_POST['ref_designation'],
//                                    'campus_id'     =>  $_POST['ref_campus'],
//                                    'created_date'  =>  date('Y-m-d')
//                                                );
//                    
//                    $inquiry_reference_id    =   $this->Admission_r_model->addInquiryReference($reference_data);
//                }
                echo 'Saved';
                exit;
        }
              
}