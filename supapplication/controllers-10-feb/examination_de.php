<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include_once (dirname(__FILE__) . "/MAIN_Controller.php");

//class Examination extends MAIN_Controller {
class Examination_de extends CI_Controller {

	public function __construct() 
        {

            parent::__construct();

            $this->load->model('Admin_model');
            $this->load->model('Admission_r_model');
            $this->load->model('Accounts_model');
            $this->load->model('Examination_model');
            $this->load->model('Course_model');

            $this->load->library('session');
            $this->load->library('encrypt');
            
            // for form validation
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
        }
        
	public function index()
	{
		$this->load->view('examinations_de/login');
	}
        
         public function login() 
         {

                        $this->form_validation->set_rules('username', 'User Name', 'required');
                        $this->form_validation->set_rules('password', 'Password', 'required');

                        if ($this->form_validation->run() == FALSE) {
                               $this->load->view('examinations_de/login');
                        } else {

                          $this->load->library('encrypt');

                          $encrypted_password = $this->encrypt->sha1($_POST['password']);

                          $login_data = array(
                              'acc_login'    => $_POST['username'],
                              'acc_password' => $encrypted_password,
                          );


                          $result = $this->Examination_model->Login($login_data);


                          if ($result) {

                            $sessionData = array(
                                'username'        => $result->acc_login,
                                'admin_id'        => $result->acc_login_id,
                                'account_role_id' => $result->account_role_id,
                            );

                            $this->session->set_userdata($sessionData);

                            redirect('examination_de/dashboard');
                          } else {

                            $this->session->set_userdata('error', 'Incorrect Username OR Password');
                            redirect('examination_de/index');
                          }
                        }
            }

 
  // admin dashboard

  public function dashboard() {
    
    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/admin_side_menu');
    $this->load->view('admin_ace/dashboard');
    $this->load->view('admin_ace/admin_footer');
  }
  
  
  // view students program wise
  
  public function view_students()
  {
      if(!empty($_POST))
            {
          
               $program_id              =    $_POST['program']; 
                                   
               //$result['students']      =   $this->Examination_model->getStudentsInfo($program_id);
               $result['students']      =   $this->Examination_model->getStudentslists_de($program_id);
                
               $result['programs']      = $this->Admin_model->getAllprograms();
               $result['program_id']    =  $program_id;

               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('examinations_de/viewstudents', $result);
               $this->load->view('admin_ace/admin_footer');
               
               
            }else{
                
                $program_id             =   10;                
                //$result['students']     =   $this->Examination_model->getStudentsInfo($program_id);
                $result['students']     =   $this->Examination_model->getStudentslists_de($program_id);
                                              
                $result['programs']     =   $this->Admin_model->getAllprograms();                
                $result['program_id']   =   $program_id;
                
                //echo '<pre>';var_dump($result['students']);                echo '</pre>';exit;
                
                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/admin_side_menu');
                $this->load->view('examinations_de/viewstudents', $result);
                $this->load->view('admin_ace/admin_footer');
            }
   
  }
         
  
  // add student result
  
  public function add_result_form()
  {
        
               $result['student_id']         =   $_GET['student_id'];
               $res                          =   $this->Examination_model->getSessionId($_GET['student_id']);

               $result['program_id']         =   $res[0]['program_id'];
               $result['start_session_id']   =   $res[0]['enrolled_session_id'];
               $result['sessions']           =   $this->Admin_model->getAllSessions();
               $result['courses']            =   $this->Course_model->getAllCourses();
      
               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('examinations_de/addresult2', $result);
               $this->load->view('admin_ace/admin_footer');
      
  }
  
  
   // Add mid term result
        
        public function add_mid_result()
        {
            $student_id              =   $_POST['student_id'];
            $course                  =   $_POST['course'];
            $title1[]                =   $_POST['mtitle1'];
            $title2[]                =   $_POST['mtitle2'];
            $title3[]                =   $_POST['mtitle3'];
            $value1[]                =   $_POST['mvalue1'];
            $value2[]                =   $_POST['mvalue2'];
            $value3[]                =   $_POST['mvalue3'];
            $result;
            
           
            if(count(array_unique($course))< count($course))
            {
                $this->session->set_userdata('error', 'Course Duplication Occured, please try again');
                redirect('examination_de/add_result_form/?student_id='.$student_id);                 
            }
            else
            {
                for ($i = 0; $i < count($course); $i++) {
          
                    $mid_result = array(
                        'student_id' => $student_id,
                        'session_id' => $_POST['mid_session'],
                        'course_id' => $course[$i],
                        'mid_title_1' => $title1[0][$i],
                        'mid_value_1' => $value1[0][$i],
                        'mid_title_2' => $title2[0][$i],
                        'mid_value_2' => $value2[0][$i],
                        'mid_title_3' => $title3[0][$i],
                        'mid_value_3' => $value3[0][$i],
                        'created_date' => date('Y-m-d')
                    );

                $result = $this->Examination_model->addMidResult($mid_result);
            }


            if ($result) {
                $this->session->set_userdata('success', 'Mid Term Result Add Successfully');
                redirect('examination_de/add_result_form/?student_id=' . $student_id);
            } else {
                $this->session->set_userdata('error', 'Mid Term Result Not Add Successfully, Please Try Again');
                redirect('examination_de/add_result_form/?student_id=' . $student_id);
            }
          }
    }

    // define final term structure
        
         public function add_final_result()
        {
            $student_id              =   $_POST['student_id'];
            $course                  =   $_POST['course'];
            $title1[]                =   $_POST['ftitle1'];
            $title2[]                =   $_POST['ftitle2'];
            $title3[]                =   $_POST['ftitle3'];
            $title4[]                =   $_POST['ftitle4'];
            $title5[]                =   $_POST['ftitle5'];
            $title6[]                =   $_POST['ftitle6'];
            $title7[]                =   $_POST['ftitle7'];
            $value1[]                =   $_POST['fvalue1'];
            $value2[]                =   $_POST['fvalue2'];
            $value3[]                =   $_POST['fvalue3'];
            $value4[]                =   $_POST['fvalue4'];
            $value5[]                =   $_POST['fvalue5'];
            $value6[]                =   $_POST['fvalue6'];
            $value7[]                =   $_POST['fvalue7'];
            $result;
            
            if(count(array_unique($course))< count($course))
            {
                $this->session->set_userdata('error', 'Course Duplication Occured, please try again');
                redirect('examination_de/add_result_form/?student_id='.$student_id);                 
            }
            else
            {
                for ($i = 0; $i < count($course); $i++) {
                $final_result = array(
                    'student_id' => $student_id,
                    'session_id' => $_POST['final_session'],
                    'course_id' => $course[$i],
                    'final_title_1' => $title1[0][$i],
                    'final_value_1' => $value1[0][$i],
                    'final_title_2' => $title2[0][$i],
                    'final_value_2' => $value2[0][$i],
                    'final_title_3' => $title3[0][$i],
                    'final_value_3' => $value3[0][$i],
                    'final_title_4' => $title4[0][$i],
                    'final_value_4' => $value4[0][$i],
                    'final_title_5' => $title5[0][$i],
                    'final_value_5' => $value5[0][$i],
                    'final_title_6' => $title6[0][$i],
                    'final_value_6' => $value6[0][$i],
                    'final_title_7' => $title7[0][$i],
                    'final_value_7' => $value7[0][$i],
                    'created_date' => date('Y-m-d')
                );

                $result = $this->Examination_model->addFinalResult($final_result);
            }

            if ($result) {
                $this->session->set_userdata('success', 'Final Term Result Add Successfully');
                redirect('examination_de/add_result_form/?student_id=' . $student_id);
            } else {
                $this->session->set_userdata('error', 'Final Term Result Not Add Successfully, Please Try Again');
                redirect('examination_de/add_result_form/?student_id=' . $student_id);
            } 
          }
        }

      
      // view student result 
        
        public function view_result()
        {
               $student_id              = $_GET['student_id'];
               $result['result']        = $this->Examination_model->getResult($student_id);
               $result['student_id']    =   $student_id;
               /*echo '<pre>';
               var_dump($result);die;*/
               
               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('examinations_de/viewresult', $result);
               $this->load->view('admin_ace/admin_footer');
        }


// define course structure for mid and final term
        
        public function define_structure()
        {
            $result['sessions']           =   $this->Admin_model->getAllSessions();
            $result['courses']            =   $this->Course_model->getAllCourses();  
            $result['programs']           = $this->Admin_model->getAllprograms();
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('examinations_de/definestructure',$result);
            $this->load->view('admin_ace/admin_footer');
        }
        
        // define mid term structure
        
        public function mid_term_structure()
        {
            $program_id             =   $_POST['program'];
            $session_id             =   $_POST['session'];
            $course_id              =   $_POST['course'];
            $title[]                =   $_POST['mtitle'];
            $value[]                =   $_POST['mvalue'];
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {                 
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('examination_de/define_structure');
                 
            }else{
                                   
                    $mid_data               =   array(
                                                        'program_id'            => $program_id,
                                                        'session_id'            => $session_id,
                                                        'course_id'             => $course_id,
                                                        'mid_title_1'           => $title[0][0],
                                                        'mid_value_1'           => $value[0][0],
                                                        'mid_title_2'           => $title[0][1],
                                                        'mid_value_2'           => $value[0][1],
                                                        'mid_title_3'           => $title[0][2],
                                                        'mid_value_3'           => $value[0][2],
                                                        'created_date'          => date('Y-m-d')
                                                     );

                    $result                 =   $this->Examination_model->addMidStructure($mid_data);

                    if($result)
                    {
                                $this->session->set_userdata('success', 'Mid Term Structure is Define Successfully');
                                redirect('examination_de/define_structure');
                    }else{
                                 $this->session->set_userdata('error', 'Mid Term Structure is Not Defined, Please Try Again');
                                redirect('examination_de/define_structure');
                    }
           
            }                                   
        }

        // define final term structure
        
        public function final_term_structure()
        {
            $program_id             =   $_POST['program'];
            $session_id             =   $_POST['session'];
            $course_id              =   $_POST['course'];
            $title[]                =   $_POST['ftitle'];
            $value[]                =   $_POST['fvalue'];
        
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {
                 
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('examination_de/define_structure');
                 
            }else{
                            $final_data             =   array(
                                                                'program_id'              => $program_id,
                                                                'session_id'              => $session_id,
                                                                'course_id'               => $course_id,
                                                                'final_title_1'           => $title[0][0],
                                                                'final_value_1'           => $value[0][0],
                                                                'final_title_2'           => $title[0][1],
                                                                'final_value_2'           => $value[0][1],
                                                                'final_title_3'           => $title[0][2],
                                                                'final_value_3'           => $value[0][2],
                                                                'final_title_4'           => $title[0][3],
                                                                'final_value_4'           => $value[0][3],
                                                                'final_title_5'           => $title[0][4],
                                                                'final_value_5'           => $value[0][4],
                                                                'final_title_6'           => $title[0][5],
                                                                'final_value_6'           => $value[0][5],
                                                                'final_title_7'           => $title[0][6],
                                                                'final_value_7'           => $value[0][6],
                                                                'created_date'            => date('Y-m-d')
                                                             );

                            $result                 =   $this->Examination_model->addFinalStructure($final_data);

                            if($result)
                            {
                                        $this->session->set_userdata('success', 'Final Term Structure is Define Successfully');
                                        redirect('examination_de/define_structure');
                            }else{
                                         $this->session->set_userdata('error', 'Final Term Structure is Not Defined, Please Try Again');
                                        redirect('examination_de/define_structure');
                            }
            }
            
            
        }

        
        // view structure 
        
        public function view_structure()
        {
               $result['mid']      =   $this->Examination_model->getMidInfo();
               $result['final']    =   $this->Examination_model->getFinalInfo();
            
               $this->load->view('admin_ace/admin_header');
               $this->load->view('admin_ace/admin_side_menu');
               $this->load->view('examinations_de/viewstructure', $result);
               $this->load->view('admin_ace/admin_footer');
        }
        
        
        // get mid structure
        
        public function getMidStructure()
        {
            //$mid_data                    =   array('program_id'=>10,'session_id'=>5,'course_id'=>2);
            $mid_data                    =   array('program_id'=>$_POST['program_id'],'session_id'=>$_POST['session_id'],'course_id'=>$_POST['course_id']);
            $result['mid_structure']     =   $this->Examination_model->get_mid_structure($mid_data);
            $result['div_id']            =   $_POST['div_id'];
            
            $this->load->view('examinations_de/mid_partial',$result);
        }
        
        // get mid structure
        
        public function getFinalStructure()
        {
            //$mid_data                    =   array('program_id'=>10,'session_id'=>5,'course_id'=>2);
            $final_data                    =   array('program_id'=>$_POST['program_id'],'session_id'=>$_POST['session_id'],'course_id'=>$_POST['course_id']);
            $result['final_structure']     =   $this->Examination_model->get_final_structure($final_data);
            $result['div_id']            =   $_POST['div_id'];
            
            $this->load->view('examinations_de/final_partial',$result);
        }
        
        

         
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */