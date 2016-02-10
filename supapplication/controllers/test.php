<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {

    public function __construct() {

    parent::__construct();

    $this->load->model('Test_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {
      
           $to_time = strtotime("2008-12-12 19:00:00");
$from_time = strtotime("2008-12-13 04:00:00");
echo round(abs($to_time - $from_time) / 60,2). " minute";
      
  }
  
  public function calculate_save_std_gpa_semester(){
     
      $semester     = 3;
      
      $students     =   $this->Test_model->getStudents($semester);
      
     //echo '<pre>';print_r(count($students));die;
      
      
      $i=1;
      foreach($students AS $row){   
          //echo $row['student_id']; die;
          $final_marks    =   $this->Test_model->getFinalMarks($row['student_id'],$semester);
          //echo '<pre>';print_r($final_marks);die;
          $gpa = 0;
          $total_credit_hours = 0;
                        for($c=0; $c < count($final_marks); $c++){    
                                    $total_credit_hours = $total_credit_hours+$final_marks[$c]['credit_hours'];
                                    $marks  =   $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2'];
                                    $res    = $this->Test_model->calculateGpa($marks,$final_marks[$c]['credit_hours']);
                                    $gpa    =   $gpa + $res;                                                             
                                  }
                                  
                                 $total_gpa =   $gpa; 
                                 $gpa = $gpa/$total_credit_hours;
                                 
                                    $check        =    $this->Test_model->checkgpa($row['student_id'], $semester);
                                    if(count($check) > 0){
                                        $std_gpa_id   =   $this->Test_model->UpdateStdgpa($row['student_id'],number_format((float)$gpa, 2, '.', ''),$semester,$total_gpa,$total_credit_hours);
                                    }else{
                                        $std_gpa_id   =   $this->Test_model->SaveStdgpa($row['student_id'],number_format((float)$gpa, 2, '.', ''),$semester,$total_gpa,$total_credit_hours);
                                    }
                                  
                               }
  }
  
   public function calculate_save_std_gpa_cr(){
      $session_id        =   13;
      $students     =   $this->Test_model->getStudentsCR($session_id);
      
   //  echo '<pre>';print_r(count($students));die;
      
      
      $i=1;
      foreach($students AS $row){   
          //echo $row['student_id']; die;
          $final_marks    =   $this->Test_model->getFinalMarksCR($row['student_id'],$session_id);
          //echo '<pre>';print_r($final_marks);die;
          $gpa = 0;
          $total_credit_hours = 0;
                        for($c=0; $c < count($final_marks); $c++){    
                                                                        
                                    $labi       =  $this->Test_model->getLabMarks($row['student_id'],$final_marks[$c]['batch_id'],$final_marks[$c]['course_id'], $session_id);
                    
                                    if($labi != null){
                                        $marks      = $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2']+$labi[0]['final_value_1'];
                                        $credit_hours = $final_marks[$c]['credit_hours'] +1;
                                    }else{
                                        $marks      = $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2'];
                                        $credit_hours = $final_marks[$c]['credit_hours'];
                                    }
                                    
                                   $total_credit_hours = $total_credit_hours+$credit_hours;
                                                                       
                                    $res    = $this->Test_model->calculateGpa($marks,$credit_hours);
                                    $gpa    =   $gpa + $res;                                                             
                                  }
                                  
                                  $total_gpa =   $gpa; 
                                  $gpa = $gpa/$total_credit_hours;
                                 
                                    $check        =    $this->Test_model->checkgpaCR($row['student_id'], $session_id);
                                    if(count($check) > 0){
                                        $std_gpa_id   =   $this->Test_model->UpdateStdgpaCR($row['student_id'],$gpa,$session_id,$total_gpa,$total_credit_hours);
                                    }else{
                                        $std_gpa_id   =   $this->Test_model->SaveStdgpaCR($row['student_id'],$gpa,$session_id,$total_gpa,$total_credit_hours);
                                    }
                                  
                               }
  }
  
  
  public function set_roll_no_duplication(){
      
      $programs     =   $this->Test_model->getPrograms();
//      echo '<pre>';            print_r($programs);die;
      
      foreach($programs AS $row){
                $students     =   $this->Test_model->getStudents($row['program_id']);
                
                foreach($students AS $roww){
                    
                            $roll_no_array  =   explode('-', $roww['roll_no']);
                            $serial         =   $roll_no_array[2];
                            
                            $result         =   $this->Test_model->updateSerial($roww['student_id'],$roww['roll_no'],$serial);
                    
                }
               // die;
      }
      
      
  }
  
  
  
  
  
//  public function delete_accounts_record(){
//      
//      $result       =   $this->Test_model->getAllStudents();
//      
//      foreach ($result AS $row){
//          
//            $res    =   $this->Test_model->updateStudents($row['student_id'],$row['enrolled_session_id']);
//            if($res > 0){
//                $ress   =   $this->Test_model->delete_Accounts($row['student_id']);
//            }
//          
//      }
//      die('Accounts record deleted successfully');
//  }
  
  
  // for transfor inquiry data from inquiry to inquiry_os
  
//  public function transfer_inquiry(){
//      
//      $result   =   $this->Test_model->getAllInquiries();
//      
////      echo '<pre>';
////      var_dump($result);die;
//      
//      foreach($result AS $row){
//          
//                $inquiry_data = array(
//                                'old_inquiry_id'    => $row['inquiry_id'],
//                                'inquiry_no'        => $row['inquiry_no'],
//                                'campaign_id'       => $row['campaign_id'],
//                                'name'              => $row['name'],
//                                'contact'           => $row['contact'],
//                                'phone'             => $row['phone'],
//                                'program_id'        => $row['program_id'],
//                                'shift'             => $row['shift'],
//                                'gender'            => $row['gender'],
//                                'qualification'     => $row['qualification'],
//                                'total_marks'       => $row['total_marks'],
//                                'obtained_marks'    => $row['obtained_marks'],
//                                'reference_id'      => $row['reference_id'],
//                                'inquiry_type'      => $row['inquiry_type'],
//                                'previous_institute'=> $row['previous_institute'],
//                                'remarks'           => $row['remarks'],
//                                'operator_id'       => $row['operator_id'],
//                                'campus_id'         => $row['campus_id'],
//                                'inquiry_date'      => $row['inquiry_date'],
//                                'admission_stage'   => $row['admission_stage'],
//                                'prospectus_sale'   => $row['prospectus_sale']
//                );
//                    
//                $res    =   $this->Test_model->addInquiry($inquiry_data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Inquiry Transfers Successfully');
//      
//  }
// 
//  public function transfer_prospectus(){
//      
//      $result   =   $this->Test_model->getAllProspectus();
//      
////      echo '<pre>';
////      var_dump($result);die;
//      
//      foreach($result AS $row){
//          
//                $inquiry_id     =   $this->Test_model->getInquiryId($row['inquiry_id']);
//          
//                $data = array(
//                                'inquiry_id'        => $inquiry_id,
//                                'product_id'        => $row['product_id'],
//                                'price'             => $row['price'],
//                                'quantity'          => $row['quantity'],
//                                'total_price'       => $row['total_price'],
//                                'operator_id'       => $row['operator_id'],
//                                'campus_id'         => $row['campus_id'],
//                                'sale_date'         => $row['sale_date']
//                            );
//                
////                echo '<pre>';
////                var_dump($data);die;
//                    
//                $res    =   $this->Test_model->addProspectus($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Prospectus Transfers Successfully');
//      
//  }
// 
//  public function transfer_initial(){
//      
//      $result   =   $this->Test_model->getAllInitials();
//      
////      echo '<pre>';
////      var_dump($result);
//      
//      foreach($result AS $row){
//          
//                $inquiry_id     =   $this->Test_model->getInquiryId($row['inquiry_id']);
//          
//                $data = array(
//                                'inquiry_id'        => $inquiry_id,
//                                'old_form_no'       => $row['old_form_no'],
//                                'form_no'           => $row['form_no'],
//                                'serial'            => $row['serial'],
//                                'student_name'      => $row['student_name'],
//                                'mobile'            => $row['mobile'],
//                                'program_id'        => $row['program_id'],
//                                'shift'             => $row['shift'],
//                                'gender'            => $row['gender'],
//                                'qualification'     => $row['qualification'],
//                                'total_marks'       => $row['total_marks'],
//                                'obtained_marks'    => $row['obtained_marks'],
//                                'campus_id'         => $row['campus_id'],
//                                'operator_id'       => $row['operator_id'],
//                                'created_date'      => $row['created_date']
//                            );
//                
////                echo '<pre>';
////                var_dump($data);die;
//                    
//                $res    =   $this->Test_model->addInitial($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Initial Transfers Successfully');
//      
//  }
// 
//  public function transfer_form(){
//      
//      $result   =   $this->Test_model->getAllForms();
//      
////      echo '<pre>';
////      var_dump($result);die;
// 
//      foreach($result AS $row){
//          
//                $inquiry_id     =   $this->Test_model->getInquiryId($row['inquiry_id']);
//          
//                $data = array(
//                                
//                                'campaign_id'                       => $row['campaign_id'],
//                                'form_no'                           => $row['form_no'],
//                                'program_id'                        => $row['program_id'],
//                                'student_name'                      => $row['student_name'],
//                                'father_name'                       => $row['father_name'],
//                                'gender'                            => $row['gender'],
//                                'marital_status'                    => $row['marital_status'],
//                                'dob'                               => $row['dob'],
//                                'shift'                             => $row['shift'],
//                                'nationality'                       => $row['nationality'],
//                                'religion'                          => $row['religion'],
//                                'nic_no'                            => $row['nic_no'],
//                                'mobile'                            => $row['mobile'],
//                                'email'                             => $row['email'],
//                    
//                    
//                                'present_address'                   => $row['present_address'],
//                                'present_city_id'                   => $row['present_city_id'],
//                                'permanent_address'                 => $row['permanent_address'],
//                                'permanent_city_id'                 => $row['permanent_city_id'],
//                    
//                                'guardian_name'                     => $row['guardian_name'],
//                                'guardian_relation'                 => $row['guardian_relation'],
//                                'guardian_occupation'               => $row['guardian_occupation'],
//                                'guardian_designation'              => $row['guardian_designation'],
//                                'guardian_address'                  => $row['guardian_address'],
//                                'guardian_city_id'                  => $row['guardian_city_id'],
//                                'guardian_phone'                    => $row['guardian_phone'],
//                                'guardian_mobile'                   => $row['guardian_mobile'],
//                                'guardian_income'                   => $row['guardian_income'],
//                    
//                                'emergency_contact_name'            => $row['emergency_contact_name'],                                        
//                                'emergency_contact_relation'        => $row['emergency_contact_relation'],
//                                'emergency_contact_address'         => $row['emergency_contact_address'],
//                                'emergencay_city_id'                => $row['emergencay_city_id'],
//                                'emergency_contact_phone'           => $row['emergency_contact_phone'],
//                                'emergency_contact_mobile'          => $row['emergency_contact_mobile'],
//                    
//                                'kinship_name'                      => $row['kinship_name'],
//                                'kinship_relation'                  => $row['kinship_relation'],
//                                'kinship_program'                   => $row['kinship_program'],
//                                'kinship_rollno'                    => $row['kinship_rollno'],
//                                'kinship_batch'                     => $row['kinship_batch'],
//                    
//                                'previous_qualification'            => $row['previous_qualification'],
//                                'previous_institute'                => $row['previous_institute'],
//                                'previous_rollno'                   => $row['previous_rollno'],
//                                'previous_subjects'                 => $row['previous_subjects'],
//                                'previous_total_marks'              => $row['previous_total_marks'],
//                                'previous_obtained_marks'           => $row['previous_obtained_marks'],
//                                'previous_grade'                    => $row['previous_grade'],
//                                'previous_degree_year'              => $row['previous_degree_year'],
//                    
//                                'operator_id'                       => $row['operator_id'],
//                                'campus_id'                         => $row['campus_id'],
//                                'form_submit_date'                  => $row['form_submit_date'],
//                                'form_modified_date'                => $row['form_modified_date'],
//                                'inquiry_id'                        => $inquiry_id
//                    
//                    
//                            );
//                
////                echo '<pre>';
////                var_dump($data);die;
//                    
//                $res    =   $this->Test_model->addForm($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Forms Transfers Successfully');
//      
//  }
//  
//  
//  
//  public function transfer_student(){
//      
//      $result   =   $this->Test_model->getAllStudents();
//      
////      echo '<pre>';
////      var_dump($result);die;
// 
//      foreach($result AS $row){
//          
//                $form_id     =   $this->Test_model->getFormId($row['form_no']);
//          
//                $data = array(
//                                
//                                'form_id'                       => $form_id,
//                                'form_no'                       => $row['form_no'],
//                                'roll_no'                       => $row['roll_no'],
//                                'batch_id'                      => $row['batch_id'],
//                                'shift'                         => $row['shift'],
//                                'enrolled_session_id'           => $row['enrolled_session_id'],
//                                'current_session_id'            => $row['current_session_id'],
//                                'operator_id'                   => $row['operator_id'],
//                                'semester'                      => $row['semester'],
//                                'status'                        => $row['status']
//                            );
//                
////                echo '<pre>';
////                var_dump($data);die;
//   
//                $res    =   $this->Test_model->addStudent($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Students Transfers Successfully');
//      
//  }
//  
//  
//  public function transfer_package(){
//      
//      $result   =   $this->Test_model->getAllPackages();
//      
////      echo '<pre>';
////      var_dump($result);die;
// 
//      foreach($result AS $row){
//          
//                $student_id     =   $this->Test_model->getStudentId($row['form_no']);
//          
//                $data = array(
//                                
//                                'student_id'                        => $student_id,
//                                'program_id'                        => $row['program_id'],
//                                'total_sessions'                    => $row['total_sessions'],
//                                'admission_fee'                     => $row['admission_fee'],
//                                'misc_fee'                          => $row['misc_fee'],
//                                'tax'                               => $row['tax'],
//                                'session_fee'                       => $row['session_fee'],
//                                'admission_fee_discount'            => $row['admission_fee_discount'],
//                                'session_fee_discount'              => $row['session_fee_discount'],
//                                'session_total_package'             => $row['session_total_package'],
//                                'degree_total_package'              => $row['degree_total_package'],
//                                'remarks'                           => $row['remarks'],
//                                'created_date'                      => $row['created_date'],
//                                'operator_id'                       => $row['operator_id']
//                            );
//                
////               echo '<pre>';
////               var_dump($data);die;
//   
//                $res    =   $this->Test_model->addPackage($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Package Transfers Successfully');
//      
//  }
//  
//  
//  public function transfer_installments(){
//      
//      $result   =   $this->Test_model->getAllInstallments();
//      
////      echo '<pre>';
////      var_dump($result);die;
// 
//      foreach($result AS $row){
//          
//                $student_id     =   $this->Test_model->getStudentId($row['form_no']);
//          
//                $data = array(
//                                
//                                'student_id'                 => $student_id,
//                                'installment_no'             => $row['installment_no'],
//                                'program_id'                 => $row['program_id'],
//                                'session_id'                 => $row['session_id'],
//                                'fee'                        => $row['fee'],
//                                'fine'                       => $row['fine'],
//                                'additional_discount'        => $row['additional_discount'],
//                                'payable'                    => $row['payable'],
//                                'due_date'                   => $row['due_date'],
//                                'created_date'               => $row['created_date'],
//                                'operator_id'                => $row['operator_id']
//                            );
//                
////               echo '<pre>';
////               var_dump($data);die;
//   
//                $installment_id    =   $this->Test_model->addInstallments($data);
//                if(!$installment_id){
//                    die('Result Not Added');
//                }else{
//                    
//                    $result2   =   $this->Test_model->getChallan($row['installment_id']);
//                   
//                                    $data = array(
//
//                                                    'student_id'                 => $student_id,
//                                                    'installment_id'             => $installment_id,
//                                                    'status'                     => $result2->status,
//                                                    'type'                       => $result2->type,
//                                                    'slip_no'                    => $result2->slip_no,
//                                                    'created_date'               => $result2->created_date,
//                                                    'post_date'                  => $result2->post_date,
//                                                    'operator_id'                => $result2->operator_id
//                                                );
//
//                                    $res    =   $this->Test_model->addChallan($data);
//                                    if(!$res){
//                                        die('Result Not Added');
//                                    }
//                          
//                    
//                }
//      }
//      die('Installments Transfers Successfully');
//      
//  }
//  
  
//  public function transfer_challans(){
//      
//      $result   =   $this->Test_model->getAllChallans();
//      
//      echo '<pre>';
//      var_dump($result);die;
// 
//      foreach($result AS $row){
//          
//                $student_id     =   $this->Test_model->getStudentId($row['form_no']);
//          
//                $data = array(
//                                
//                                'student_id'                 => $student_id,
//                                'installment_no'             => $row['installment_no'],
//                                'program_id'                 => $row['program_id'],
//                                'session_id'                 => $row['session_id'],
//                                'fee'                        => $row['fee'],
//                                'fine'                       => $row['fine'],
//                                'additional_discount'        => $row['additional_discount'],
//                                'payable'                    => $row['payable'],
//                                'due_date'                   => $row['due_date'],
//                                'created_date'               => $row['created_date'],
//                                'operator_id'                => $row['operator_id']
//                            );
//                
////               echo '<pre>';
////               var_dump($data);die;
//   
//                $res    =   $this->Test_model->addaddChallan($data);
//                if(!$res){
//                    die('Result Not Added');
//                }
//      }
//      die('Challan Transfers Successfully');
//      
//  }
  
//  public function Update_package_os(){
//      $campus_id    =   2;
//      $result   =   $this->Test_model->getStudentsPackag($campus_id);
//      
//      //echo '<pre>';print_r($result);
//      
//      foreach($result AS $row){
//          
//                $student_id                   =   $row['student_id'];
//                $misc_fee                     =   $row['misc_fee'];
//                $session_fee                  =   $row['session_fee'];
//                $admission_fee                =   $row['admission_fee'];
//                $session_total_package        =   $row['session_total_package'];
//                $new_total_package            =   $session_total_package-$misc_fee;
//                $new_admission_fee            =   $admission_fee+$misc_fee;
//                $new_misc_fee                 =   $misc_fee-$misc_fee;
//               echo  $res                          =   $this->Test_model->update_fees($student_id,$new_admission_fee,$new_misc_fee,$new_total_package);
//        
//      }
//      
//  }
  
  
  
  ///*****************************       Set student cureent session according to installments sesssion
  
  public function setSession(){
      
      $students     =   $this->Test_model->getAllStd();
      
      foreach($students AS $row){
              $session_id     =   $this->Test_model->getSessionId($row['student_id']);
              
              $result         =   $this->Test_model->UpdateStdCurrentSession($row['student_id'],$session_id);
      }
      
  }
  
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */