<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/MAIN_Controller.php");

class Programmanagers extends MAIN_Controller {
    
        public function __construct() 
        {

            parent::__construct();

            $this->load->model('Manager_model');
            $this->load->model('Course_model');
            $this->load->model('Section_model');
            $this->load->library('session');
            $this->load->model('Admin_model');
            $this->load->model('Admission_r_model');
            
            $this->load->library('smsapi');

            // for form validation
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
        } 
        
        // For Index Page Program Manager
        public function index() 
        {
            $this->load->view('prgmanager/login');
        }
        

   //   ******* >>>>>      Tariq Mayo     <<<<< *******   //     
        
        
        // for verification of admin login

            public function login_check() {

              if ($this->session->userdata('sub_login_id') == '' && $this->session->userdata('sub_login') == '') {
                redirect('programmanagers/index');
              }
            }
  
            
        // for examination login
        public function admin_login() {

                $this->form_validation->set_rules('username', 'User Name', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() == FALSE) {

                  $this->load->view('programmanagers');
                } else {

                  $this->load->library('encrypt');

                  $encrypted_password = $this->encrypt->sha1($_POST['password']);

                  $login_data = array(
                      'sub_login'    => $_POST['username'],
                      'sub_password' => $encrypted_password,
                  );
                  
                  $account_role_id      =   $_POST['account_role_id'];
                  
//                  echo '<pre>';
//                  var_dump($login_data);
//                  echo '</pre>';exit;
                  
                  
                  $result = $this->Manager_model->adminLogin($login_data);
                  
                  // check login only admisssions department
                  
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
                          redirect('programmanagers/dashboard');
                        } else {

                            $this->session->set_userdata('error', 'Incorrect Username OR Password');
                            redirect('programmanagers/index');
                        }
                      }else{
                          
                            $this->session->set_userdata('error', 'Please Login from Your Own login..');
                            redirect('programmanagers/index');
                      }
                }
              }

       
        
        // program manager dashboard
        public function sub_dashboard()
        {
            
            // qurying the aloocated courses list
            $result['courses_data'] = $this->Course_model->allAllocatedCourses();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('admin_ace/prgmanager_dashboard', $result);
            $this->load->view('admin_ace/prgmanager_footer');
             
        }
        
        // define course structure for mid and final term
        
        public function define_structure()
        {
            $id                 =   $_REQUEST['course_allocation_id'];
            
            $result['mid']      =   $this->Manager_model->getMidInfo($id);
            $result['final']    =   $this->Manager_model->getFinalInfo($id);
            $result['id']       =   $id;
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/course_structure/definestructure', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        // define mid term structure
        
        public function mid_term_structure()
        {
            $title[]                =   $_POST['mtitle'];
            $value[]                =   $_POST['mvalue'];
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {
                 $id                     =   $_POST['course_allocation_id'];
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                 
            }else{
                
                    $id                     =   $_POST['course_allocation_id'];

                    $mid_data               =   array(
                                                        'course_allocation_id'  => $id,
                                                        'mid_title_1'           => $title[0][0],
                                                        'mid_value_1'           => $value[0][0],
                                                        'mid_title_2'           => $title[0][1],
                                                        'mid_value_2'           => $value[0][1],
                                                        'mid_title_3'           => $title[0][2],
                                                        'mid_value_3'           => $value[0][2],
                                                        'created_date'          => date('Y-m-d')
                                                     );

                    $result                 =   $this->Manager_model->addMidStructure($mid_data);

                    if($result)
                    {
                                $this->session->set_userdata('success', 'Mid Term Structure is Define Successfully');
                                redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                    }else{
                                 $this->session->set_userdata('error', 'Mid Term Structure is Not Defined, Please Try Again');
                                redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                    }
           
            }                                   
        }

        // define final term structure
        
        public function final_term_structure()
        {
            $title[]                =   $_POST['ftitle'];
            $value[]                =   $_POST['fvalue'];
        
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {
                 $id                     =   $_POST['course_allocation_id'];
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                 
            }else{
                            $id                     =   $_POST['course_allocation_id'];

                            $final_data             =   array(
                                                                'course_allocation_id'    => $id,
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

                            $result                 =   $this->Manager_model->addFinalStructure($final_data);

                            if($result)
                            {
                                        $this->session->set_userdata('success', 'Final Term Structure is Define Successfully');
                                        redirect('programmanagers/define_structure?course_allocation_id='.$id);
                            }else{
                                         $this->session->set_userdata('error', 'Final Term Structure is Not Defined, Please Try Again');
                                        redirect('programmanagers/define_structure?course_allocation_id='.$id);
                            }
            }
            
            
        }



        // for admin logout 
        public function logout() {

          $this->session->unset_userdata('prgmng_username');
          $this->session->unset_userdata('prgmng_id');
          $this->session->unset_userdata('account_role_id');
          $this->session->sess_destroy();
          redirect();
        }
        
        
        // get mid term structure to be edited
        
        public function edit_mid_term()
        {
            
            $mid_id         =   $_GET['mid_course_structure_id'];
            $id             =   $_GET['course_allocation_id'];
            
            $result['mid']  =   $this->Manager_model->getMidInfo($mid_id);
            $result['id']   =   $id;
            
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/course_structure/editmidstructure', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        // Update mid term structure
        
        public function update_mid_term_structure()
        {
            $title[]                =   $_POST['mtitle'];
            $value[]                =   $_POST['mvalue'];
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {
                 $id                     =   $_POST['course_allocation_id'];
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('programmanagers/edit_mid_term/?course_allocation_id='.$id);
                 
            }else{
            
            $mid_id                 =   $_POST['mid_id'];
            $id                     =   $_POST['course_allocation_id'];
            
            $mid_data               =   array(
                                                
                                                'mid_title_1'           => $title[0][0],
                                                'mid_value_1'           => $value[0][0],
                                                'mid_title_2'           => $title[0][1],
                                                'mid_value_2'           => $value[0][1],
                                                'mid_title_3'           => $title[0][2],
                                                'mid_value_3'           => $value[0][2],
                                                'created_date'          => date('Y-m-d')
                                             );
            
            $result                 =   $this->Manager_model->updateMidStructure($mid_id,$mid_data);
            
            if($result)
            {
                        $this->session->set_userdata('success', 'Mid Term Structure is Updated Successfully');
                        redirect('programmanagers/define_structure/?course_allocation_id='.$id);
            }else{
                         $this->session->set_userdata('error', 'Mid Term Structure is Not Updated, Please Try Again');
                        redirect('programmanagers/define_structure/?course_allocation_id='.$id);
            }
            
         }  
           
        }

        
        
         
        
        

        // get final term structure to be edited
        
        public function edit_final_term()
        {
            $final_id         =   $_GET['final_course_structure_id'];
            $id               =   $_GET['course_allocation_id'];
            
            $result['final']  =   $this->Manager_model->getFinalInfo($final_id);
            $result['id']     =   $id;
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/course_structure/editfinalstructure', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }


        // Update final term structure
        
        public function update_final_term_structure()
        {
            
            $title[]                =   $_POST['ftitle'];
            $value[]                =   $_POST['fvalue'];
        
            
            if(count($title[0]) == 0 || count($value[0]) == 0 )
            {
                 $id                     =   $_POST['course_allocation_id'];
                 $this->session->set_userdata('error', 'Select Some fields to Enter, Please Try Again');
                 redirect('programmanagers/edit_final_term/?course_allocation_id='.$id);
                 
            }else{
            
            
                    $final_id               =   $_POST['final_id'];            
                    $id                     =   $_POST['course_allocation_id'];

                    $final_data             =   array(
                                                
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

                    $result                 =   $this->Manager_model->updateFinalStructure($final_id,$final_data);

                    if($result)
                    {
                                $this->session->set_userdata('success', 'Final Term Structure is Updated Successfully');
                                redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                    }else{
                                 $this->session->set_userdata('error', 'Final Term Structure is Not Updated, Please Try Again');
                                redirect('programmanagers/define_structure/?course_allocation_id='.$id);
                    }
          }  
            
        }
        
        
        
        
        
        
        //   ******* >>>>>      Tariq Mayo     <<<<< *******   //
      
        
        // Dashboard Rocking
        public function dashboard()
        {
            //echo 'ssssss';
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('admin_ace/prgmanager_dashboard');
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        // Teacher Allocation
        public function teacher()
        {
            //$this->load->view('prgmanager/login');
        }
        
        public function pmg_logout()
        {
            // for manager logout 
            $this->session->unset_userdata('prgmng_username');
            $this->session->unset_userdata('prgmng_id');
            $this->session->sess_destroy();
            redirect('programmanagers/index');
        }
        
        
        // Add Course allocation
        public function add_course_allocation_form()
        {
            
            $this->login_check();
            
            // loading all of the 
            // required models
            $this->load->model('Admin_model');
            $this->load->model('Course_model');
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            $emp_id                 = $this->session->userdata('employee_id');
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];

            
            // Current Year Sessions 
            //$cur_year = date('Y');
            //$result['sessions']         = $this->Admin_model->getYearSessions($cur_year);
            $result['sessions']         = $this->Admin_model->getAllSessions();
            $result['programms']        = $this->Admin_model->getAllprogramsHr($emp_department_id);
            
//            // courses that m
//            $result['offered_courses']  = $this->Course_model->getAllCourses();
            
            // for Teachers newly added
            $result['teachers']         = $this->Course_model->get_all_teachers();
            $result['all_batches']      = $this->Admin_model->getAllbatches();
            //echo '<pre>';var_dump($result['teachers']);echo '</pre>';exit;
            
            $this->load->view('prgmanager/courseallocation/add_course_allocation_form',$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        // getting drop down of ajax xourses offeres
        public function SesionPrgBthOfferedCourses(){
            $batch_id               = $_REQUEST['batch'];
            $program_id             = $_REQUEST['program'];
            $session_id             = $_REQUEST['session'];
            $result                 = $this->Course_model->getofferedProgCourses($batch_id,$program_id,$session_id);
            
            $test   .='<select name="offered_courses" id="offered_courses">';
            
            $i      = 1;
            foreach( $result as  $pp){
                $test.='<option value="'.$pp["course_id"].'"> '.$pp["course_name"].' == '.$pp["course_code"].' == '.$pp["course_type"].'</option>';
                $i++; 
            } 
            $test.='</select>';
            echo $test;exit;
        }
            
        
        // Add Course allocation save
        public function add_course_allocation()
        {
            
            $this->login_check();
            
            $this->load->model('Course_model');
            $this->form_validation->set_rules('offered_courses', 'Offered Courses', 'required');
            $this->form_validation->set_rules('program', 'Program', 'required');
            $this->form_validation->set_rules('sessions', 'Session', 'required');
            $this->form_validation->set_rules('teacher', 'Teacher', 'required');
            $this->form_validation->set_rules('shifts', 'Shifts', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                    //echo 'mamao shioced lets view again';
                    //$cur_year = date('Y');
                    $this->load->model('Admin_model');
                    //$result['sessions']         = $this->Admin_model->getYearSessions($cur_year);
                    
                    $emp_id                     = $this->session->userdata('employee_id');
                    $emp_depart_id              = $this->Manager_model->getEmployeeDept( $emp_id );
                    $emp_department_id          = $emp_depart_id[0]['department_id'];

                    $result['sessions']         = $this->Admin_model->getAllSessions();
                    $result['programms']        = $this->Admin_model->getAllprogramsHr($emp_department_id);
                    $result['offered_courses']  = $this->Course_model->getAllCourses();
                    $result['all_batches']      = $this->Admin_model->getAllbatches();
                    

                    $this->load->view('admin_ace/prgmanager_header');
                    $this->load->view('admin_ace/prgmanager_side_menu');
                    $this->load->view('prgmanager/courseallocation/add_course_allocation_form',$result);
                    $this->load->view('admin_ace/prgmanager_footer');
                    
            }else{
                
                    foreach($_REQUEST['teacher'] as $p => $k){
                        // lets make its entry 
                        $data_array = array(
                                        'course_id'     => $_POST['offered_courses'],
                                        'program_id'    => $_POST['program'],
                                        'teacher_id'    => $k,
                                        'session_id'    => $_POST['sessions'],
                                        'shift'         => $_POST['shifts'],
                                        'batch_id'      => $_POST['batch']
                                    );
                        $result     = $this->Course_model->saveAllocatedCourse($data_array);
                        
                        
                        
                        //$teach_data = $this->Course_model->get_teacher_data($k);
                        //$user_name  = str_replace(' ', '_' ,$teach_data[0]['employee_name']);
                        
//                        $this->load->library('encrypt');
//                        $user_pwde  = $this->encrypt->sha1($_POST['password']);
//                        $campus_id  = $teach_data[0]['campus_id'];
                        // generating teacher login , 
                        // if not generated sms an
                        /*
                        $user_data = array(
                            'sub_login'         => $user_name,
                            'sub_password'      => $user_pwde,
                            'created_date'      => date("Y-m-d"),
                            'last_login'        => date("Y-m-d"),
                            'account_role_id'   => 6,
                            'sub_status'        => '1',
                            'employee_id'       => $_POST['techer_id'],
                            'campus_id'         => $_POST['campus'],
                        );

                        $user_login_id    = $this->Admission_r_model->addUserData($user_data);
                        $this->Course_model->addUserData();*/
                    }
                    
                    if($result){
                        $mesage = $this->session->set_userdata('success_msg', 'Course has allocated.');
                    }else{
                        $mesage = $this->session->set_userdata('error_msg', 'Course has not allocated.');
                    }
                    redirect('programmanagers/view_course_allocation');
            }
            
        }
        
        
        public function view_course_allocation()
        {
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            // qurying the aloocated courses list
            $result['courses_data'] = $this->Course_model->allAllocatedCourses();
            
            // getting all data for the all allocated courses
            $this->load->view('prgmanager/courseallocation/view_allocated_courses' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        // for course allocation  update 
        public function update_course_allocation($id = null)
        {
            $this->login_check();
            
            if(empty( $id ) && empty($_REQUEST))
            {
                $mesage = $this->session->set_userdata('error_msg', 'Respected Course allocation does not exist.');
                redirect('programmanagers/view_course_allocation');
            }
           
            
            if($_POST){
                    // lets make its entry 
                    $data_array = array(
                                'course_id'             => $_POST['offered_courses'],
                                'program_id'            => $_POST['program'],
                                'teacher_id'            => $_POST['teacher'],
                                'session_id'            => $_POST['sessions'],
                                'shift'                 => $_POST['shifts'],
                                'batch_id'              => $_POST['batch'],
                                'course_allocation_id'  => $_POST['id']
                            );
                    //echo '<pre>';var_dump($data_array);exit;
                $result = $this->Course_model->updateAllocatedCourse($data_array , $_POST['id']);

                if($result){
                    $mesage = $this->session->set_userdata('success_msg', 'Course allocation has been updated.');
                }else{
                    $mesage = $this->session->set_userdata('error_msg', 'Course allocation has not updated.');
                }
                redirect('programmanagers/view_course_allocation');
            }
            
            
            // getting the course data Current Year Sessions 
            //$result['sessions']             = $this->Admin_model->getYearSessions($cur_year);
            
            $emp_id                         = $this->session->userdata('employee_id');
            $emp_depart_id                  = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id              = $emp_depart_id[0]['department_id'];
            // Current Year Sessions 
            //$cur_year = date('Y');
            //$result['sessions']           = $this->Admin_model->getYearSessions($cur_year);
            $result['sessions']             = $this->Admin_model->getAllSessions();
            $result['programms']            = $this->Admin_model->getAllprogramsHr($emp_department_id);
            
            $result['offered_courses']      = $this->Course_model->getAllCourses();
            $result['allocated_course']     = $this->Course_model->getAllocateCourse($id);
            $result['teachers']             = $this->Course_model->get_all_teachers();
            $result['all_batches']          = $this->Admin_model->getAllbatches();
            
            
            //echo '<pre>';var_dump($this->Course_model->getAllocateCourse($id));exit;
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/courseallocation/update_course_allocation' , $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        // Add Course Offered
        public function add_courses_offered_form()
        {
            
                $this->login_check();
            
                $this->load->model('Admin_model');
                $this->load->model('Course_model');
                $this->load->view('admin_ace/prgmanager_header');
                $this->load->view('admin_ace/prgmanager_side_menu');

                $emp_id                 = $this->session->userdata('employee_id');
                $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
                $emp_department_id      = $emp_depart_id[0]['department_id'];

                $current_session        = $this->Course_model->getCurrentSession();
                $result['session_id']   = $current_session[0]['session_id']; 
                $result['session']      = $current_session[0]['session']; 

                $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
                $result['all_batches']  = $this->Admin_model->getAllbatches();
                $result['all_session']  = $this->Admin_model->getAllSessions();

                $this->load->view('prgmanager/courseoffered/add_course_offered',$result);
                $this->load->view('admin_ace/prgmanager_footer');
            
//            if($cur_session_offered > 0){
//                $this->session->set_userdata('success_msg', 'Offered Courses has been already saved for current Session kindly update existing ones.');
//                redirect('programmanagers/view_offered_courses');
//                
//            }else{
                        // loading all of the // required models
//            $this->load->model('Admin_model');
//            $this->load->model('Course_model');
//            $this->load->view('admin_ace/prgmanager_header');
//            $this->load->view('admin_ace/prgmanager_side_menu');
//
//            $cur_year           = date('Y');
//            // All Sessions
//            $result['sessions'] = $this->Admin_model->getYearSessions($cur_year );
//
//            // all outlined courses
//            $allcourses                = $this->Course_model->alreadyCourseofStudySaved();
//            $result['offered_courses'] = $allcourses;
//
//            $html .= '<select name="courses[]"><option value="">Course Name -- Course Code</option>'; 
//            foreach( $allcourses as $kk => $pp){
//                $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
//            }
//            $html .= '</select>'; 
//            $result['dropdown']     = $html ;
//
//            $this->load->view('prgmanager/courseoffered/add_course_offered',$result);
//            $this->load->view('admin_ace/prgmanager_footer');
            //}
        }
        
        public function ajax_ist_sections()
        {
            
            
            $this->load->model('Admin_model');
            $this->load->model('Course_model');
            
            $batch_id               = $_REQUEST['batch'];
            $program_id             = $_REQUEST['program'];
            $session                = $_REQUEST['session'];
            
            $result                 = $this->Course_model->getfirstSections($batch_id,$program_id, $session);
            $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Section</th><th>Students list</th></tr></thead><tbody>';
            
            $i = 0;
            foreach( $result as  $pp){ 
                //$test.='<tr><td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="'.$pp["course_id"].'"></label></td><td>'.$pp["course_name"].'</td><td>'.$pp["course_code"].'</td></tr>';
                $test.='<tr><td><label  class="checkbox" style="width: 100%;"></label></td><td>'.$pp["program_section"].'</td><td><a target="_blank" href="'.site_url().'programmanagers/view_section_students?sec='.$pp["program_section"].'&prg='.$program_id.'&sess='.$session.'" >View Students</a></td></tr>';
                $i++; 
            } 
            $test.='</tbody></table>';
            echo $test;exit;
        }
        
        public function ajax_course_of_study()
        {
            
            
            $this->load->model('Admin_model');
            $this->load->model('Course_model');
            
            $batch_id               = $_REQUEST['batch'];
            $program_id             = $_REQUEST['program'];
            $session                = $_REQUEST['session'];
            
            $result                 = $this->Course_model->alreadyStudyCoursess($batch_id,$program_id, $session);
            $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Course Name</th><th>Course Code</th></tr></thead><tbody>';
            
            $i = 0;
            foreach( $result as  $pp){ 
                $test.='<tr><td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="'.$pp["course_id"].'"></label></td><td>'.$pp["course_name"].'</td><td>'.$pp["course_code"].'</td></tr>';
                $i++; 
            } 
            $test.='</tbody></table>';
            echo $test;exit;
        }
        
        // Add Course Offered Save
        public function add_courses_offered()
        {
            $this->login_check();
            $session_id     = $_REQUEST['sessions'];
            $batch          = $_REQUEST['batch'];
            $program        = $_REQUEST['program'];

            if(empty($session_id) or empty($batch) or empty($program)){
                $mesage = $this->session->set_userdata('error_msg', 'Offered Courses has not been saved.');
                redirect('programmanagers/add_courses_offered_form');
            }
            
            foreach($_REQUEST['allcourses'] as $p => $k )
            {
                // checking if offered course already in db for current session
                $result = $this->Course_model->courseAlreadyOffer($k,$session_id,$batch , $program);
                if($result > 0){
                    continue;
                }else{
                    $data_array = array(
                                    'course_id'         => $k,
                                    'session_id'        => $session_id,
                                    'program_id'        => $program,
                                    'batch_id'          => $batch
                                );
                    $result = $this->Course_model->saveofferedCourse($data_array); 
                }
            }
            if($result){ $mesage = $this->session->set_userdata('success_msg', 'Offered Courses has been saved.');}
            else{  $mesage = $this->session->set_userdata('error_msg', 'Offered Courses has not been saved.');}
            redirect('programmanagers/view_offered_courses');
        }
        
        
        public function view_offered_courses_form()
        {
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            $emp_id                 = $this->session->userdata('employee_id');
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];

            $current_session        = $this->Course_model->getCurrentSession();
            $result['session_id']   = $current_session[0]['session_id']; 
            $result['session']      = $current_session[0]['session']; 
            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            $result['all_batches']  = $this->Admin_model->getAllbatches();
            $result['all_session']  = $this->Admin_model->getAllSessions();
            
            $this->load->view('prgmanager/courseoffered/view_offered_courses_form' , $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        
        public function view_offered_courses()
        {
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            $emp_id                 = $this->session->userdata('employee_id');
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];

            $current_session        = $this->Course_model->getCurrentSession();
            $result['session_id']   = $current_session[0]['session_id']; 
            $result['session']      = $current_session[0]['session']; 

            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            $result['all_batches']  = $this->Admin_model->getAllbatches();
            $result['all_session']  = $this->Admin_model->getAllSessions();
            
            $result['OfferedCourse']  = $this->Course_model->cursessionofferedcourses($emp_department_id , $current_session[0]['session_id']);
            $this->load->view('prgmanager/courseoffered/view_offered_courses' , $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        public function delofferedCourse(){
            $session_id                 = $_REQUEST['session'];
            $batch                      = $_REQUEST['batch'];
            $program                    = $_REQUEST['program'];
            $course                     = $_REQUEST['course'];
            
            // check remianing 
            // student already registered in course unable to delete it 
            $result                     = $this->Course_model->delOfferedCourses( $batch, $program, $session_id, $course );
            echo $result;
            exit;
        } 
        
        public function getofferedProgCourses(){
            $this->load->model('Admin_model');
            $this->load->model('Course_model');
            
            $batch_id               = $_REQUEST['batch'];
            $program_id             = $_REQUEST['program'];
            $session_id             = $_REQUEST['session'];
            $result                 = $this->Course_model->getofferedProgCourses($batch_id,$program_id,$session_id);
            $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Course Name</th><th>Course Code</th><th>Remove</th></tr></thead><tbody>';
            
            $i = 1;
            foreach( $result as  $pp){
              
                $course_id      = $pp["course_id"];
                $session_id     = $pp["session_id"];
                $program_id     = $pp["program_id"];
                $batch_id       = $pp["batch_id"];
                
                //$remove         = '<a style="cursor:pointer;" href="javascript:void(0);" onclick="rmcourse('.$course_id.','.$session_id.', '.$program_id.', '.$batch_id.' , '.$i.')" />Remove</a>';
                $remove         = 'onclick="rmcourse('.$course_id.','.$session_id.', '.$program_id.', '.$batch_id.' , '.$i.')" ';
                $test.='<tr  id="row'.$i.'"><td><label   style="width: 100%;">'.$i.'</td><td>'.$pp["course_name"].'</td><td>'.$pp["course_code"].'</td><td '.$remove.'>Remove</td></tr>';
                $i++; 
            } 
            $test.='</tbody></table>';
            echo $test;exit;
        }
        
        // for course allocation  update 
        public function update_course_offered_pre($id = null)
        {
            
            if($id){
                    $this->load->view('admin_ace/prgmanager_header');
                    $this->load->view('admin_ace/prgmanager_side_menu');

                    $cur_year = date('Y');
                    // All Sessions
                    $result['sessions'] = $this->Admin_model->getYearSessions($cur_year );

                    $allcourses                = $this->Course_model->getAllCourses();
                    $result['offered_courses'] = $allcourses;

                    $html .= '<select name="courses[]"><option value="">Course Name -- Course Code</option>'; 
                    foreach( $allcourses as $kk => $pp){
                        $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                    }
                    $html .= '</select>'; 

                    $result['dropdown']             = $html ;
                    
                    $offeredcourses                 = $this->Course_model->getOfferedCourse($id);
                    //echo '<pre>';var_dump($offeredcourses);echo '</pre>';exit;
                    
                    $result['offered_courses']      = $offeredcourses;
                    $result['all_courses']          = $allcourses;

                    $this->load->view('prgmanager/courseoffered/update_course_offered',$result);
                    $this->load->view('admin_ace/prgmanager_footer');
            }else{
                if(!empty($_POST))
                {
                   
                    // first deleting all offereed courses of 
                    $prg_manager_id = $this->session->userdata('employee_id');
                   
                    // adding new ones 
                    $session_id     = $_POST['sessions'];
                    $del_result     = $this->Course_model->deleteOfferedCourses($prg_manager_id,$session_id);
                
                    foreach($_POST['allcourses'] as $p => $k )
                    {
                            $data_array = array('course_id'         => $k,
                                                'session_id'        => $session_id,
                                                'prg_manager_id'    => $prg_manager_id
                                                );
                            //echo '<pre>';var_dump($data_array);echo '</pre>';echo '<br/>';
                            $result = $this->Course_model->saveofferedCourse($data_array);
                    }

                    if($result){
                            $this->session->set_userdata('success_msg', 'Offered Courses has been saved.');

                    }else{
                            $this->session->set_userdata('error_msg', 'Offered Courses has not been saved.');
                    }
                    redirect('programmanagers/view_offered_courses');

                }
            }   
            
            
        }
        
        // for course allocation  update 
        public function update_course_offered_single($id = null, $course_id = null)
        {
            
            if($id){
                    $this->load->view('admin_ace/prgmanager_header');
                    $this->load->view('admin_ace/prgmanager_side_menu');

                    $cur_year = date('Y');
                    // All Sessions
                    $result['sessions'] = $this->Admin_model->getYearSessions($cur_year );

                    $allcourses                = $this->Course_model->getAllCourses();
                    $result['offered_courses'] = $allcourses;

                    $html .= '<select name="courses[]"><option value="">Course Name -- Course Code</option>'; 
                    foreach( $allcourses as $kk => $pp){
                        $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                    }
                    $html .= '</select>'; 

                    $result['dropdown']             = $html ;
                    $offeredcourses                 = $this->Course_model->getOfferedCourseDetail($id ,$course_id);
                    $result['offered_courses']      = $offeredcourses;

                    $this->load->view('prgmanager/courseoffered/update_course_offered',$result);
                    $this->load->view('admin_ace/prgmanager_footer');
            }else{
                if(!empty($_POST))
                {
                   
                    // first deleting all offereed courses of 
                    $prg_manager_id = $this->session->userdata('employee_id');
                   
                    // adding new ones 
                    $session_id     = $_POST['sessions'];
                    $course_id      = $_POST['course_id'];
                    $course_id_chk  = $_POST['course_id_chk'];
                    
                    if(empty($course_id_chk))
                    {
                        // we will remove its entry 
                        $del_result     = $this->Course_model->deleteSingleOfferedCourse($prg_manager_id,$session_id,$course_id);
                    }

                    if($del_result){
                            $mesage = $this->session->set_userdata('success_msg', 'Offered Courses has been removed.');
                    }else{
                            $mesage = $this->session->set_userdata('error_msg', 'Offered Courses has been saved.');
                    }
                    redirect('programmanagers/view_offered_courses');
                }
            }
            
            
        }
        
        // for course allocation  update 
        public function update_course_offered()
        {
            $prg_manager_id  = $this->session->userdata('employee_id');
            $current_session = $this->Course_model->getCurrentSession();
            $cur_session_id  = $current_session[0]['session_id']; 
            $cur_session_na  = $current_session[0]['session']; 
            
                if(!empty($_POST))
                {
                    // first deleting all offereed courses of 
                    $del_result     = $this->Course_model->deleteOfferedCourses($prg_manager_id,$cur_session_id);
                
                    foreach($_POST['allcourses'] as $p => $k )
                    {
                            $data_array = array('course_id'         => $k,
                                                'session_id'        => $cur_session_id,
                                                'prg_manager_id'    => $prg_manager_id
                                                );
                            //echo '<pre>';var_dump($data_array);echo '</pre>';echo '<br/>';
                            $result = $this->Course_model->saveofferedCourse($data_array);
                    }

                    if($result){
                            $mesage = $this->session->set_userdata('success_msg', 'Offered Courses has been saved.');
                    }else{
                            $mesage = $this->session->set_userdata('error_msg', 'Offered Courses has not been saved.');
                    }
                    redirect('programmanagers/view_offered_courses');

                }else{
                    $this->load->view('admin_ace/prgmanager_header');
                    $this->load->view('admin_ace/prgmanager_side_menu');

                    $cur_year = date('Y');
                    // All Sessions
                    $result['sessions']     = $this->Admin_model->getYearSessions($cur_year );
                    $allcourses             = $this->Course_model->getAllCourses();
                    $result['all_courses']  = $allcourses;
                    

                    $html .= '<select name="courses[]"><option value="">Course Name -- Course Code</option>'; 
                    foreach( $allcourses as $kk => $pp){
                        $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                    }
                    $html .= '</select>'; 

                    $result['dropdown']             = $html ;
                    
                    // offered cpurse id
                    $offeredcourses                 = $this->Course_model->getSessionOfferedCourse( $prg_manager_id , $cur_session_id );
                    $result['offered_courses']      = $offeredcourses;

                    $this->load->view('prgmanager/courseoffered/update_course_offered',$result);
                    $this->load->view('admin_ace/prgmanager_footer');
                }
        }
    
        
        // add result of whole class
        
        public function add_result_form()
        {
            $result['courses']  =   $this->Course_model->getAllCourses();
            $result['students']         =   $this->Manager_model->getAllStudents();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu'); 
            $this->load->view('prgmanager/results/addresult', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        // add result of whole class
        
        public function add_result()
        {
            $term                       =   $_POST['term'];
            $result['courses']          =   $this->Course_model->getAllCourses();
            $result['students']         =   $this->Manager_model->getAllStudents();
            if($term == 1){
            $result['structure']        =   $this->Manager_model->getMStructure();
            }else{
            $result['structure']        =   $this->Manager_model->getFStructure();
            }
            
            $result['term']             =   $term;
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu'); 
            $this->load->view('prgmanager/results/addresult', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        
        
        
  
  // course pre requisite check
  // fucniton will be called before course registration
  // all the pre requsite with multiple 
  public function coures_pre_reqs_check($course_id = null)
  {
      //echo '<pre>';var_dump($pre_req_array);echo '</pre>';exit;
      $result['pre_req_courses']   =   $this->Course_model->get_pre_req($course_id);
      $this->load->view('admin_ace/admin_header');
      $this->load->view('prgmanager/entrytest/reports/awardlistView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
        
  
    // i/p : course_id 
    // o/p : all_pre_req_array
    public function getPreRqs($course_id = null){
        
        $this->login_check();
        $course_id              = 8;
        $pre_req_courses        = $this->Course_model->get_pre_req($course_id);
        
        if( $pre_req_courses != NULL ){
            
            /* courses level1 start */
            $ii = 0;
            $jj = 0;
            $pre_req_array = array();
            foreach( $pre_req_courses as $k => $p ) {
                
                $course_data                =  $this->Course_model->getCourse($p['course_pre_req_id']);
                //$pre_req_array[$ii]         = $course_data[0]['course_name'].'-'.$p['course_pre_req_id'];
                $pre_req_array[]              = $course_data[0]['course_name'].'-'.$p['course_pre_req_id'];
                $first_level_sub_course     = $p['course_pre_req_id'];
                $pre_req_courses_sub        = $this->Course_model->get_pre_req($first_level_sub_course);
                
//                if($pre_req_courses_sub != null){
//                    foreach( $pre_req_courses_sub as $kj => $pj ) {
//                        $sub_course_data                    = $this->Course_model->getCourse($pj['course_pre_req_id']);
//                        $pre_req_array[$ii]['Sub'][$jj]     = $sub_course_data[0]['course_name'].'-'.$pj['course_pre_req_id'];
//                        $jj++;
//                    }
//                }
                $ii++;
            }
            /* courses level1 end */
              
              
            echo '<pre>';var_dump($pre_req_array);echo '</pre>';exit;
              //return $pre_req_array;
        }else{
            // no prerequisite exits
            return NULL;
        }
    }
    
    public function add_student_course_reg_form()
        {   
            $this->login_check();
            
            $this->load->model('Course_model');
            $this->form_validation->set_rules('offered_courses', 'Offered Courses', 'required');
            $this->form_validation->set_rules('program', 'Program', 'required');
            $this->form_validation->set_rules('sessions', 'Session', 'required');
            $this->form_validation->set_rules('teacher', 'Teacher', 'required');
            $this->form_validation->set_rules('shifts', 'Shifts', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                    //echo 'mamao shioced lets view again';
//                    $cur_year = date('Y');
//                    $result['sessions']         = $this->Admin_model->getYearSessions($cur_year);
//                    $result['programms']        = $this->Admin_model->getAllprograms();
                
                    $emp_id                     = $this->session->userdata('employee_id');
                    $emp_depart_id              = $this->Manager_model->getEmployeeDept( $emp_id );
                    $emp_department_id          = $emp_depart_id[0]['department_id'];
                                
                    $current_session            = $this->Course_model->getCurrentSession();
                    $result['session_id']       = $current_session[0]['session_id']; 
                    $result['session']          = $current_session[0]['session']; 

                    $result['programms']        = $this->Admin_model->getAllprogramsHR($emp_department_id);
                
                    $result['offered_courses']  = $this->Course_model->getAllCourses();
                    
                    $this->load->model('Admin_model');

                    $this->load->view('admin_ace/prgmanager_header');
                    $this->load->view('admin_ace/prgmanager_side_menu');
                    $this->load->view('prgmanager/coursestudents/add_student_course_reg_form',$result);
                    $this->load->view('admin_ace/prgmanager_footer');
                    
            }else{
                
                    foreach($_REQUEST['teacher'] as $p => $k){
                        // lets make its entry 
                        $data_array = array(
                                        'course_id'     => $_POST['offered_courses'],
                                        'program_id'    => $_POST['program'],
                                        'teacher_id'    => $k,
                                        'session_id'    => $_POST['sessions'],
                                        'shift'         => $_POST['shifts']
                                    );
                        $result = $this->Course_model->saveAllocatedCourse($data_array);
                    }
                    
                    if($result){
                        $mesage = $this->session->set_userdata('success_msg', 'Course has allocated.');
                        
                    }else{
                        $mesage = $this->session->set_userdata('error_msg', 'Course has not allocated.');
                    }
                    redirect('programmanagers/view_course_allocation');
            }
            
        }
        
        
        public function view_student_course_reg()
        {
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            
            // qurying the aloocated courses list
            $result['courses_data'] = $this->Course_model->allAllocatedCourses();
            
            // getting all data for the all allocated courses
            $this->load->view('prgmanager/coursestudents/view_student_course_reg' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        /****  ADDED BY ZOHAIB START*/
        
        public function create_student_sections(){
            
                        
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            
            $emp_id                 = $this->session->userdata('employee_id');
            // getting dept id 
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];
            
            //getting all programs of
            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            
//            $current_session        = $this->Course_model->getCurrentSession();
//            $cur_session_id         = $current_session[0]['session_id']; 
//            $result['session_na']   = $current_session[0]['session']; 
            
            $result['sessions']     = $this->Admin_model->getAllSessions();
            $result['batches']      = $this->Admin_model->getAllbatches();

            $this->load->view('prgmanager/studentsections/add_ist_student_section' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        public function make_student_section_new(){
            
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
//            $current_session = $this->Course_model->getCurrentSession();
//            $cur_session_id  = $current_session[0]['session_id']; 
            $cur_session_id  = $_POST['session']; 
            
            
            if($_POST){
                
                $program_id                 = $_POST['program'];
                $section                    = $_POST['section'];
                $batch                      = $_POST['batch'];
                $limit                      = $_POST['no_of_students'];
                
                $single_section_students    = $this->Course_model->single_section_students( $cur_session_id , $program_id , $section, $batch);
                
                if($single_section_students != null){
                    $this->session->set_userdata('error_msg', 'This Section already generated for this program.');
                    redirect('programmanagers/view_student_sections_form');
                }
                
                $total_prg_students         = $this->Course_model->total_prg_students( $cur_session_id , $program_id );
                $total_section_students     = $this->Course_model->total_sections_students( $cur_session_id , $program_id );
                
                // all sections already created
                if($total_section_students == $total_prg_students){
                    $this->session->set_userdata('error_msg', 'Sections already generated for this program.');
                    redirect('programmanagers/view_student_sections_form');
                }
                
                
                $all_section_stu_nos           = $this->Course_model->allread_section_students( $cur_session_id , $program_id );
                
                // getting last roll no , student id 
                if( $all_section_stu_nos != null ){
                    
                    $all_semester_students      = $this->Course_model->get_all_students_bylimit( $program_id , $cur_session_id, $all_section_stu_nos, $limit );
                    
                    foreach($all_semester_students as $k => $p){

                        if($k < $limit ){
                            $data_array      = 
                                array(
                                    'student_id'      => $p['student_id'],
                                    'roll_no'         => $p['roll_no'],
                                    'program_section' => $section,
                                    'shift'           => 'Morning',
                                    'semester'        => 1,
                                    'program_id'      => $program_id,
                                    'session_id'      => $cur_session_id,
                                    'batch'           => $batch
                                );
                            $save_section[] = $this->Section_model->addStudentSection($data_array);
                        }
                    }
                    $this->session->set_userdata('error_msg', 'Section Successfully generated for this program.');
                    redirect('programmanagers/view_student_sections_form');
                }else{
                    
                    $all_semester_students      = $this->Course_model->get_all_students_new( $program_id , $cur_session_id, $limit );
                    
                    foreach($all_semester_students as $k => $p){

                        $data_array      = 
                            array(
                                'student_id'      => $p['student_id'],
                                'roll_no'         => $p['roll_no'],
                                'program_section' => $section,
                                'shift'           => 'Morning',
                                'semester'        => 1,
                                'program_id'      => $program_id,
                                'session_id'      => $cur_session_id,
                            );
                        $save_section[] = $this->Section_model->addStudentSection($data_array);
                    }
                    $this->session->set_userdata('error_msg', 'Section Successfully generated for this program.');
                    redirect('programmanagers/view_student_sections_form');
                }
            }
            
            //exit;echo '<pre>';var_dump($save_section);echo '</pre>';echo  '------------------------------------------------';echo '<br/>';exit;
            redirect('programmanagers/view_student_sections_form');
        }
        
        
        public function make_student_section(){
            
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            $current_session = $this->Course_model->getCurrentSession();
            $cur_session_id  = $current_session[0]['session_id']; 
            $cur_session_na  = $current_session[0]['session']; 
            
            if($_POST){
                
                $program_id              = $_POST['program'];
                // already creatd sections
                $all_semester_students  = $this->Course_model->already_sections( $program_id , $cur_session_id);
                if($all_semester_students > 0 ){
                    $this->session->set_userdata('error_msg', 'Sections already generated for this program.');
                    redirect('programmanagers/view_student_sections_form');
                }
                
                
                $all_semester_students  = $this->Course_model->get_all_students( $program_id , $cur_session_id);
                //echo '<pre>';var_dump($all_semester_students);echo '</pre>';
                $I = 0;
                foreach($all_semester_students as $k => $p){
                    
                    if($I >= 0 &&  $I < 600){
                        $section = 'A';
                    }
//                    if($I >= 60 &&  $I < 120){
//                        $section = 'B';
//                    }
//                    if($I >= 120 &&  $I <= 180){
//                        $section = 'C';
//                    }
//                    if($I >= 180 &&  $I <= 240){
//                        $section = 'D';
//                    }
//                    if($I >= 240 &&  $I <= 650){
//                        $section = 'E';
//                    }
                    $I++;
//                    if($k >= 240 &&  $k < 300){ 
//                        $section = 'E';
//                    }
//                    if($k >= 360 &&  $k < 420){ 
//                        $section = 'F';
//                    }
//                    if($k >= 420 &&  $k < 480){ 
//                        $section = 'G';
//                    }
//                    if($k >= 540 &&  $k < 600){ 
//                        $section = 'H';
//                    }
//                    if($k >= 600 &&  $k < 660){ 
//                        $section = 'I';
//                    }
//                   
                    
                    $data_array      = 
                            array(
                                'student_id'      => $p['student_id'],
                                'roll_no'         => $p['roll_no'],
                                'program_section' => $section,
                                'shift'           => 'Morning',
                                'semester'        => 1,
                                'program_id'      => $program_id,
                                'session_id'      => $cur_session_id,
                            );
                    //echo '<pre>';var_dump($data_array);echo '</pre>';echo  '------------------------------------------------';echo '<br/>';
                    $save_section[] = $this->Section_model->addStudentSection($data_array);
                }
            }
            
            //exit;echo '<pre>';var_dump($save_section);echo '</pre>';echo  '------------------------------------------------';echo '<br/>';exit;
            redirect('programmanagers/view_student_sections_form');
        }
        
        
        public function view_section_students(){
            
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            $session                        = $_GET['sess'];
            $program                        = $_GET['prg'];
            $section                        = $_GET['sec'];

              //getting all programs of
            $result['student_sections']    = $this->Section_model->getSectionStudent($session , $program , $section);
            
            // getting all data for the all allocated courses
            $this->load->view('prgmanager/studentsections/student_sections' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        // used in ajax partial
        public function get_sections(){
//            $current_session        = $this->Course_model->getCurrentSession();
//            $cur_session_id         = $current_session[0]['session_id']; 
            $program_id                 =   $_POST['program'];
            $cur_session_id             =   $_POST['session'];
            $batch                      =   $_POST['batch'];
            
            //$result['sections']     = $this->Section_model->getAllsections($program_id , 1 ,$cur_session_id);
            $result['sections']         =   $this->Section_model->getAllsections($program_id , $cur_session_id, $batch);
            
            $result['allocated']        =   $this->Course_model->getAllocatedCourses_smester( $program_id , $cur_session_id,$batch);
            
            $this->load->view('prgmanager/studentsections/sectionPartial', $result);
        }
        
        // used in ajax partial
        public function get_created_sections(){
            
            $this->login_check();
            $current_session            = $this->Course_model->getCurrentSession();
            $cur_session_id             = $current_session[0]['session_id']; 
            $program_id                 = $_POST['program'];
            //echo $program_id.' ,'. $cur_session_id.'<br/>';
            $result['sections']         = $this->Section_model->getAllsections($program_id , $cur_session_id);
            $result['program_id']       = $program_id;
            $result['cur_session_id']   = $cur_session_id;
            
            $this->load->view('prgmanager/studentsections/GetCreatedSectionPartial', $result);
        }
        
        // used for assigning section to a teacher
        public function allocate_teacher_to_section_form(){
            
            $this->login_check();
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            // qurying the aloocated courses list
            //$result['programms'] = $this->Admin_model->getAllprograms();
            $emp_id                 = $this->session->userdata('employee_id');
            // getting dept id 
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];
            
            //getting all programs of
            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            
//            $current_session        = $this->Course_model->getCurrentSession();
//            $cur_session_id         = $current_session[0]['session_id']; 
//            $result['session_na']   = $current_session[0]['session']; 
            
            $result['sessions']     = $this->Admin_model->getAllSessions();
            $result['batches']      = $this->Admin_model->getAllbatches();
            
            // getting all data for the all allocated courses
            $this->load->view('prgmanager/studentsections/allocate_teacher_to_section_form' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        public function allocate_teacher_to_section(){
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
//            $current_session = $this->Course_model->getCurrentSession();
//            $cur_session_id  = $current_session[0]['session_id']; 
            $cur_session_id = $_POST['session'];
            
            if($_POST){
                //echo '<pre>';var_dump($_POST);echo '</pre>';exit;
                
                $program_id              = $_POST['program'];
                $section                 = $_POST['section'];
                $batch_id                = $_POST['batch'];
                $teachercourse           = $_POST['teachercourse'];
                $teachercourse_arr       = explode('-',$teachercourse);
                $teacher_id              = $teachercourse_arr[0];
                $course_id               = $teachercourse_arr[1];
                $all_semester_students   = $this->Section_model->get_all_section_students( $program_id , $cur_session_id, $section);
                
                foreach($all_semester_students as $k => $p){
                    
                    
                    
                    // fiding student main section 
                    $student_id      = $p['student_id'];
                    $section_arr     = $this->Section_model->get_section($student_id);
                    $course_section  = $section_arr[0]['program_section'];
                    $data_array      = array(
                                            'course_section'        => $course_section,
                                            'teacher_id'            => $teacher_id,
                                            'course_id'             => $course_id,
                                            'student_id'            => $p['student_id'],
                                            'semester'              => 1,
                                            'program_id'            => $program_id,
                                            'current_session_id'    => $cur_session_id,
                                            'batch_id'              => $batch_id
                                        );
                    //echo '<pre>';var_dump($data_array);echo '</pre>';
                    
                    $save_course_section[] = $this->Section_model->addStudentCourseSection($data_array);
                }
            }
            //exit;
            redirect('programmanagers/view_student_sections_teachers_form');
        }
        
        
        // view all the sections
        public function view_student_sections_teachers_form(){
            
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            // qurying the aloocated courses list
            //$result['programms'] = $this->Admin_model->getAllprograms();
            $emp_id                 = $this->session->userdata('employee_id');
            // getting dept id 
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];
            
            //getting all programs of
            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            $result['all_session']  = $this->Admin_model->getAllSessions();
            $result['all_batches']  = $this->Admin_model->getAllbatches();
            
            $this->load->view('prgmanager/studentsections/view_student_sections_teachers_form' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        public function ajax_section_batch_teachser(){
            $program_id             = $_POST['program'];
            $section                = $_POST['section'];
            $batch_id               = $_POST['batch'];
            $session                = $_POST['session'];
            
            $result                 = $this->Section_model->getTeacherBatchSection($batch_id,$program_id, $session, $section);
            $i                      = 0;
            $test.='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><tr><td><label  class="checkbox" style="width: 100%;">Sr#</label></td><td>Name</td><td>Course</td><td>Section</td></tr>';
            
            foreach( $result as  $pp){ 
                $test.='<tr><td><label  class="checkbox" style="width: 100%;"></label></td><td>'.$pp["employee_name"].'</td><td>'.$pp["course_name"].'</td><td>'.$pp["course_section"].'</td></tr>';
                $i++; 
            } 
            $test.='</tbody></table>';
            echo $test;exit;
        }
        
        // view all the sections
        public function view_student_sections_form(){
            
            $this->login_check();
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            // qurying the aloocated courses list
            //$result['programms'] = $this->Admin_model->getAllprograms();
            $emp_id                 = $this->session->userdata('employee_id');
            // getting dept id 
            $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
            $emp_department_id      = $emp_depart_id[0]['department_id'];
            
            //getting all programs of
            $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
            $result['all_session']  = $this->Admin_model->getAllSessions();
            $result['all_batches']  = $this->Admin_model->getAllbatches();
            
            $this->load->view('prgmanager/studentsections/view_student_section_form' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        // view all the sections
        public function view_student_sections(){
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $current_session            = $this->Course_model->getCurrentSession();
            $cur_session_id             = $current_session[0]['session_id']; 
            if($_POST){
                $program_id             = $_POST['program'];
                $section                = $_POST['section'];
                $result['all_sec_stu']  = $this->Section_model->get_all_section_students( $program_id , $cur_session_id , $section);
            }
            $this->load->view('prgmanager/studentsections/view_student_section' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        // view all the sections
        public function sectionStudents(){
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            
            if($_GET){
                $program_id             = $_GET['program_id'];
                $section                = $_GET['section'];
                $cur_session_id         = $_GET['cur_session'];
                $result['all_stu_sec']  = $this->Section_model->get_all_section_students( $program_id , $cur_session_id , $section);
                //echo '<pre>';var_dump($result['all_stu_sec']);echo '</pre>';exit;   
            }
            $this->load->view('prgmanager/studentsections/view_student_section' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        public function sectionTeachers(){
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $current_session            = $this->Course_model->getCurrentSession();
            $cur_session_id             = $current_session[0]['session_id']; 
            
            if($_GET){
                $program_id             = $_GET['program_id'];
                $section                = $_GET['section'];
                $cur_session_id         = $_GET['cur_session'];
                //echo '<pre>';var_dump($_POST);echo '</pre>';
                //echo '<br/>---------------------------------------------------------------------------<br/>';
                
                $result['all_teachers']      = $this->Section_model->get_all_section_teachers( $program_id , $cur_session_id , $section);
                
                //echo '<pre>';var_dump($result['all_teachers']);echo '</pre>';exit;   
            }
            $this->load->view('prgmanager/studentsections/view_section_teachers' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        
        
        public function view_teacher_course(){
            
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $current_session            = $this->Course_model->getCurrentSession();
            $cur_session_id             = $current_session[0]['session_id']; 
            
            if($_GET){
                $teach_id               = $_GET['teach_id'];
                $result['teach_course'] = $this->Section_model->teacher_section_courses(  $cur_session_id , $teach_id );
            }
            
            exit;
            
            $this->load->view('prgmanager/studentsections/view_section_teachers' ,$result);
            $this->load->view('admin_ace/prgmanager_footer');
        }

        
        // for generating logins 
        
        public function generate_login_form(){
       
            $this->login_check();
            //if ($this->form_validation->run() == FALSE) {
            // get all campuses
            $result['campuses'] = $this->Admin_model->getAllCampuses();
            $result['all_emps'] = $this->Manager_model->EmployerList();
             
            if($result['all_emps'] == null){
                $this->session->set_userdata('error_msg', 'Kindly Allocate Teacher to a course. Only those teachers accounts <br/>can be generated to whom course is allocated.');
                redirect('programmanagers/allocate_teacher_to_section_form');
            }
            
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('prgmanager/teacherlogins/addlogins', $result);
            $this->load->view('admin_ace/admin_footer');

            if ($_POST) {
        
                $this->load->library('encrypt');

                $sub_password = $this->encrypt->sha1($_POST['sub_password']);

                //sub_status 	employee_id 	campus_id 	role
              $res = $this->Manager_model->checklogingenerated( $_POST['employer'] );

              if ($res != null ) {
                    $this->session->set_userdata('error_msg', 'This User Already Exists.');
                    redirect('programmanagers/generate_login_form');
              } else {
                    $date_array = array(
                        'sub_login'         => $_POST['sub_login'],
                        'sub_password'      => $sub_password,
                        'created_date'      => date('y-m-d'),
                        'last_login'        => date('Y-m-d H:i:s'),
                        'employee_id'       => $_POST['employer'],
                        'account_role_id'   => 6,
                        'sub_status'        => 1,
                        'campus_id'         => $_POST['campus'],
                        'role'              => $_POST['role']
                    );

                    $result = $this->Admin_model->addlogin($date_array);

                if ($result) {
                  $this->session->set_userdata('success_msg', 'Teacher Added Successfully');
                  redirect('programmanagers/view_logins');
                }
              }
           }
        }
  
 /*****************Generte progrma manager login ends  **************************/ 
  
    public function view_logins(){
           $this->login_check();
           $result['all_logins'] = $this->Manager_model->getAlllogins();
           $this->load->view('admin_ace/admin_header');
           $this->load->view('admin_ace/admin_side_menu');
           $this->load->view('prgmanager/teacherlogins/viewlogins', $result);
           $this->load->view('admin_ace/admin_footer');
    }
        
        
        /**** ADED BY ZOHAIB ENDS*/
    
    /*Courses ,Controller mergence start By Zohaib*/
    public function add_course_form() {
        
        $this->login_check();
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $result['all_programs'] = $this->Admin_model->getAllprogramsHR($emp_depart_id[0]['department_id']);
        
        $allcourses             = $this->Course_model->getAllCourses();
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        
        
        //echo '<pre>';var_dump($result['all_programs']);exit;
        
        $html .= '<select name="pre_reqs[]"><option value="">Course Name -- Course Code</option>'; 
            foreach( $allcourses as $pp){
                $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
            }
        $html .= '</select>'; 
        
        $result['dropdown']     = $html ;
        $result['allcourses']   = $allcourses;
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        $this->load->view('prgmanager/courses/addcourse' ,  $result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    
    public function add_course() {
            
        $this->login_check();
        $this->form_validation->set_rules('course_name', 'Course Name', 'required');
        $this->form_validation->set_rules('course_code', 'Course Code', 'required');
        $this->form_validation->set_rules('credit_hours', 'Credit Hours', 'required');
            

        if ($this->form_validation->run() == FALSE) {
            $allcourses = $this->Course_model->getAllCourses();
            
            $html .= '<select name="pre_reqs[]"><option value="">Course Name -- Course Code</option>'; 
                foreach( $allcourses as $kk => $pp){
                    $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                }
            $html .= '</select>'; 

            $result['dropdown']     = $html ;
            $result['allcourses']   = $allcourses;
            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/courses/addcourse' ,  $result);
            $this->load->view('admin_ace/prgmanager_footer');
        } else {
            
            $course_data_array = array(
                'course_name'       => $_POST['course_name'],
                'course_code'       => $_POST['course_code'],
                'credit_hours'      => $_POST['credit_hours'],
                'parent_course_id'  => $_POST['parent_course'],
                'course_added_date' => date('Y-m-d'),
                'course_type'       => $_POST['course_type'],
                'batch_id'          => $_POST['batch'],
                'program_id'        => $_POST['programs']
            );
            
            // check city name already exitsts
            $res = $this->Course_model->checkAlreadyCourseExist($_POST['course_name'] , $_POST['course_code'] , $_POST['course_type'], $_POST['credit_hours'], $_POST['batch'], $_POST['programs']);

            if ($res) {
                $this->session->set_userdata('error_msg', 'Course Already Exists');
                redirect('programmanagers/add_course_form');
            } else {

                $result = $this->Course_model->addCourse($course_data_array);
                if ($result) {
                    $message1           = 'Course Added Successfully';
                    $inserted_course_id = $result;
                    if($_POST['pre_reqs']){
                        foreach($_POST['pre_reqs'] as $op => $k){
                            $arra = array(  'course_id'         => $inserted_course_id,
                                            'course_pre_req_id' => $k,
                                            'batch_id'          => $_POST['batch'] );
                            $result2 = $this->Course_model->addCoursePreReq($arra);
                        }
                    }
                    if( $result2 or $message1 ){
                        $message2 = 'Course and its pre-requisite added successfully';   
                        $this->session->set_userdata('success_msg', $message1 .' '.$message2);
                    }else{
                        $message2 = 'Pre-requisite not added.';
                        $this->session->set_userdata('success_msg', $message1 .' '.$message2);
                    }
                    redirect('programmanagers/view_courses');
                }else{
                    $this->session->set_userdata('error_msg', 'Course not Added.');
                    redirect('programmanagers/view_courses');
                }
                
            }
        }
    }    
    
    
    public function view_courses() {
        
        // view loading 
        $this->login_check();
        //$result['courses'] = $this->Course_model->getAllCourses();
        $result['courses'] = $this->Course_model->getAllBatchCourses();
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        $this->load->view('prgmanager/courses/viewcourses' ,  $result);
        $this->load->view('admin_ace/prgmanager_footer');
        
    }
    
    
    public function edit_course($id) {

        $this->login_check();
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $result['all_programs'] = $this->Admin_model->getAllprogramsHR($emp_depart_id[0]['department_id']);
        $allcourses             = $this->Course_model->getAllCourses();
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        
        $html .= '<select name="pre_reqs[]"><option value="">Course Name -- Course Code</option>'; 
            foreach( $allcourses as $kk => $pp){
                $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
            }
        $html .= '</select>'; 
        
        $result['dropdown']     = $html ;
        $result['allcourses']   = $allcourses;
        $result['course']       = $this->Course_model->getCourse($id);
        
        
        $allprereqcourses           = $this->Course_model->getAllPreReqCourses($id);
        
        //echo '<pre>';var_dump($allprereqcourses);echo '</pre>';exit;
        
        $sizeofprereq               = sizeof($allprereqcourses);
        $result['total_prerq_size'] = $sizeofprereq;
        $result['allprereqcourses'] = $allprereqcourses;
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        $this->load->view('prgmanager/courses/editcourse', $result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    

    // update the course data
    public function update_course() {
        
        //$this->login_check();
        $course_id = $_POST['course_id'];

        $this->form_validation->set_rules('course_name', 'Course Name', 'required');
        $this->form_validation->set_rules('course_code', 'Course Code', 'required');
        
        if ($this->form_validation->run() == FALSE) {

            $result = $this->Course_model->getCourse($course_id);
            $result['course'] = $result;

            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/courses/editcourse', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        } 

        // check course name and course code already exitsts or not
        $course_name    = $_POST['course_name'];
        $course_code    = $_POST['course_code'];
        $course_type    = $_POST['course_type'];
        $programs       = $_POST['programs'];
        $batch          = $_POST['batch'];
        
        $res = $this->Course_model->checkCourseUnique($batch,$programs,$course_name , $course_code , $course_type ,$course_id);
        
        if ($res) {
            $this->session->set_userdata('error_msg', 'Course Name and  Course Code  Already Exists');
            $result = $this->Course_model->getCourse($course_id);
            $result['course'] = $result;

            $this->load->view('admin_ace/prgmanager_header');
            $this->load->view('admin_ace/prgmanager_side_menu');
            $this->load->view('prgmanager/courses/editcourse', $result);
            $this->load->view('admin_ace/prgmanager_footer');
        }
        else 
        {
            // for the lab
            $course_type = $_POST['hidden_flag'];
            if($course_type == 'Lab' ){
                    $theory_course_array = array(
                    'course_name'       => $_POST['course_name'],
                    'course_code'       => $_POST['course_code'],
                    'credit_hours'      => $_POST['credit_hours'],
                    'parent_course_id'  => $_POST['parent_course'],
                    'program_id'        => $_POST['programs'],
                    'batch_id'          => $_POST['batch'],
                    'course_type'       => $course_type
                );
                
                $result     = $this->Course_model->updateCourse($_POST['course_id'], $theory_course_array);
                $query      = $this->Course_model->deleteAllPreReqCourses($course_id);
                $message    = 'Course has been updated'; 
                
                if( $message ){
                    $this->session->set_userdata('error_msg', 'Course record updated Successfully.');
                }else{
                    $this->session->set_userdata('success_msg', 'Error occur while updating.');
                }    
                    
            }else{
                
                // data array
                $theory_course_array = array(
                    'course_name'       => $_POST['course_name'],
                    'course_code'       => $_POST['course_code'],
                    'credit_hours'      => $_POST['credit_hours'],
                    'course_type'       => $course_type,
                    'program_id'          => $_POST['programs'],
                    'batch_id'             => $_POST['batch']
                );
                
                $result  = $this->Course_model->updateCourse($_POST['course_id'], $theory_course_array);
                $message = 'Course has been updated'; 
                
                // all pre requisite list
                if($_POST['pre_reqs'] && $course_type == 'Theory' ){
                    // dleeting all previous added course pre requitise
                    if( sizeof($_POST['pre_reqs']) > 0 ){
                        $query = $this->Course_model->deleteAllPreReqCourses($course_id);
                        foreach($_POST['pre_reqs'] as $op => $k){
                            $arra = array(
                                        'course_id'         => $course_id,
                                        'course_pre_req_id' => $k
                                    );
                            $result2 = $this->Course_model->addCoursePreReq($arra);
                        }
                        $message2 = !empty($result2) ? 'Course pre requisites has been updated.' : 'Course pre requisites has not updated.' ;
                    }
                }
                if( $message2  or  $message ){
                    $this->session->set_userdata('error_msg', 'Course record updated Successfully.');
                }else{
                    $this->session->set_userdata('success_msg', 'Error occur while updating.');
                }
            }
            redirect('programmanagers/view_courses');
        }
    }
    /*Courses ,Controller mergence end By Zohaib*/
    
    
    /*New Section ganaraion by Zohaib start */
    
    public function create_stu_section_form(){
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $result['programms'] = $this->Admin_model->getAllprograms();

        $this->load->view('prgmanager/studentsectionsnew/add_student_section_form' ,$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function get_program_total_stus(){
        
        $program_id         = $_POST['program'];
        $cur_session_id     = $_POST['session'];
        // dont delete commented for current session 
//        $current_session  = $this->Course_model->getCurrentSession();
//        $cur_session_id   = $current_session[0]['session_id']; 
        $get_program_Stus = $this->Section_model->all_prog_stus($program_id,$cur_session_id);
        echo $get_program_Stus;exit;
    }
    public function get_program_total_sections(){
        
        $program_id       = $_POST['program'];
        $cur_session_id   = $_POST['session'];
        //$current_session  = $this->Course_model->getCurrentSession();
        //$cur_session_id   = $current_session[0]['session_id']; 
        $get_program_Stus = $this->Section_model->noOfSections($program_id,$cur_session_id);
        
        $str = '';
        if($get_program_Stus != null){
            foreach($get_program_Stus as $k => $p){
                $str.=  $p['program_section'].',';
            }
            echo substr($str, 0, -1);exit;
        }else{
            echo 'None of Sections Created.';exit;
        }
    }
    
    /*New Section ganaraion by Zohaib ends*/
    
    
    
    /*News Section by Zohaib starts*/
    public function add_program_news_form(){
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        //$result['unidepartments']        = $this->Admin_model->getUniDepartments();
        $result['programms']       = $this->Admin_model->getAllprograms();
        $this->load->view('news/add_program_news_form' ,$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function save_news(){
        $this->login_check();
        if($_POST){
            $date_array = array(
                'added_date'       => date('Y-m-d H:i:s'),
                'title'             => $_POST['title'],
                'description'       => $_POST['description'],
                'added_by'          => 'ProgramManager',
                'program_id'        => $_POST['program'],
                'employer_id'       => $this->session->userdata('employee_id')
            );
            
            $result = $this->Admin_model->addingNews($date_array);
            $this->session->set_userdata('error', "News Added Successfully.");
            redirect('programmanagers/view_news');
        }else{
            $this->session->set_userdata('error', "Some error occur.");
            redirect('admin/view_news');
        }
    }
    
    
    public function view_news(){
        $this->login_check();
        $employee_id = $this->session->userdata('employee_id');
        $result['all_logins'] = $this->Admin_model->getAllNews('ProgramManager' , $employee_id);
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        $this->load->view('news/view_news', $result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function remove_news($newsid = null){
        $this->login_check();
        
        // GET NEWS 
        $news_recod = $this->Admin_model->getNews($newsid);
        if($news_recod  > 0){
            $result['all_logins'] = $this->Admin_model->delNews($newsid);
            $this->session->set_userdata('error', "News Deleted Successfully.");
            redirect('programmanagers/view_news');
        }else{
            $this->session->set_userdata('error', "News Does Not Exists.");
            redirect('programmanagers/view_news');
        }
        
        
    }
    /*New Section by Zohaib ends*/
    
    public function generate_student_login_form(){
        $this->login_check();
        
        $employee_id            = $this->session->userdata('employee_id');
        $result['programms']    = $this->Admin_model->getAllprograms();
        //$result['batches']      = $this->Admin_model->all_prog_stus();
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        $this->load->view('prgmanager/studentlogins/addlogin', $result);
        $this->load->view('admin_ace/prgmanager_footer');
        
    }
    public function generate_student_logins(){
        $this->login_check();
        $this->load->library('encrypt');
        
        $employee_id        = $this->session->userdata('employee_id');
        $program_id         = $_POST['program'];
        $current_session    = $this->Course_model->getCurrentSession();
        $cur_session_id     = $current_session[0]['session_id']; 
        
        if($program_id){
            
            $all_stus           = $this->Section_model->all_prog_stus_array($program_id,$cur_session_id);
            $characters         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength   = strlen($characters);
            $randomString       = '';
            
            foreach($all_stus as $k => $p){
                
                for ($i = 0; $i < 5; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                //echo $randomString.'<br/>';
                $encrypted_password = $this->encrypt->sha1($randomString);
                
                $data_array = array(
                    'student_id'     => $p['student_id'],
                    'roll_no'        => $p['roll_no'],
                    'password'       => $encrypted_password,
                    'created_date'   => date('Y-m-d'),
                    'status'         => 1,
                );
                                
                $result = $this->Manager_model->addingLogin($data_array);
                $this->session->set_userdata('success', "Logins Generated.");
                //echo '<pre>';var_dump($data_array);echo '</pre>--------------------';
            }
        }
        redirect('programmanagers/view_logins');
    }
    
     public function check_sms(){

        $number = "923004517876";
        $msg = "Dear Student! ".PHP_EOL."Thank you very much for appearing in Superior ".PHP_EOL."Admission Entry Test Today.".PHP_EOL."Your Result will be displayed on website on Monday ".PHP_EOL."14-July-2014 at 10:00 AM".PHP_EOL."You can also download Superior Mobile App from www.superior.edu.pk";
        //$msg = "Dear Abdullah,".PHP_EOL."We appreciate your interest.".PHP_EOL."Your Inquiry #:".PHP_EOL."LHR-F14-72".PHP_EOL."For details visit Superior with your inquiry #.".PHP_EOL."Admission Dept".PHP_EOL."Ph #:04238104221";
        echo $this->smsapi->sendSMS($number, $msg);
    }
    

    /*********For Subject Of Studies Starts *******************/
    
    // Add Subject Of Study
    public function add_course_of_study_form()
    {

        $this->load->model('Admin_model');
        $this->load->model('Course_model');
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
//        $current_session        = $this->Course_model->getCurrentSession();
//        $result['session_id']   = $current_session[0]['session_id']; 
//        $result['session']      = $current_session[0]['session']; 
        
        $result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        $this->load->view('prgmanager/subjectofstudies/add_course_of_study_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function getBatchProgCourses(){
            
            $program_id                 = $_POST['program'];
            $bacth_id                   = $_POST['batch'];
            $result['courses']          = $this->Course_model->getProgBatchCourses($program_id , $bacth_id);
            $result['program_id']       = $program_id;
            $this->load->view('prgmanager/courses/getBatchProgCourses', $result); 
    }
            
            
            
    
    // Add Course Offered Save
    public function save_course_of_studies()
    {
            
            $batch_id       = $_REQUEST['batch'];
            $program_id     = $_REQUEST['program'];
            $prg_manager_id = $this->session->userdata('employee_id');
            

            foreach($_REQUEST['allcourses'] as $p => $k )
            {
                // checking if offered course already in db for current session
                $result = $this->Course_model->alreadyCourseofStudySaved($batch_id,$program_id,$k);
                if($result > 0){
                    continue;
                }else{
                   $data_array = array('course_id'   => $k,
                                    //'session_id'     => $session_id,
                                    'employee_id'    => $prg_manager_id,
                                    'batch_id'       => $batch_id,
                                    'program_id'     => $program_id
                                    );
                    $result = $this->Course_model->saveCourseofStudy($data_array); 
                    
               }
            }

            if($result){
                    $mesage = $this->session->set_userdata('success_msg', 'Courses to study has been saved.');
            }else{
                    $mesage = $this->session->set_userdata('error_msg', 'Courses to study not saved.');
            }
            redirect('programmanagers/view_course_of_study_form');
    }


    public function view_course_of_study_form()
    {
            
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');


        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];

        
        $result['programms']    = $this->Admin_model->getAllprogramsHr($emp_department_id);
        
        $result['all_batches']  = $this->Admin_model->getAllbatches();
        //$result['all_session']  = $this->Admin_model->getAllSessions();

        $this->load->view('prgmanager/subjectofstudies/view_course_of_study_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function view_course_of_studies(){
        
        
        $this->load->model('Admin_model');
        $this->load->model('Course_model');
        
        
        $batch_id       = $_REQUEST['batch'];
        $program_id     = $_REQUEST['program'];
        //$session_id     = $_REQUEST['session'];
        $prg_manager_id = $this->session->userdata('employee_id');
        
        //$result['StudyCourses'] = $this->Course_model->alreadyCourseofStudySaved($session_id,$batch_id,$program_id);
        $result['StudyCourses'] = $this->Course_model->alreadyStudyCoursess($batch_id,$program_id);
        
        //echo '<pre>';var_dump($result['StudyCourses']);echo '</pre>';exit;
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        
        
        $this->load->view('prgmanager/subjectofstudies/view_course_of_study',$result);
        $this->load->view('admin_ace/prgmanager_footer');
            

    }
    
    /*********For Subject Of Studies Ends *******************/
    
    
    /********* Generation of Advisors start *******************/
    
    // use to generate logins
    public function add_advisor_form(){
        
        $this->login_check();
            
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        $result['teachers']     = $this->Manager_model->all_emp_list( $emp_department_id );
        
        $this->load->view('prgmanager/sectionadvisor/add_advisor_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    // use to generate logins
    public function add_advisor_login(){
        
        $this->login_check();
            
        if(empty($_POST)){
            $this->session->set_userdata('error_msg', 'Select an employee first');
            redirect('programmanagers/view_advisors');
        }

        $emp_id                 = $_POST['teacher'];
        $username               = $_POST['username'];
        $password               = $_POST['password'];
        $val                    = $this->Manager_model->advisorlogingenerated( $emp_id , $username);
        
        //echo $val.'ddddd';die;
        
        if($val > 0 ){
            $this->session->set_userdata('error_msg', 'Aleady Exists. ');
            redirect('programmanagers/view_advisors');
        }else{
            
            $data   =   array(
                            'sub_login'             => $username,
                            'employee_id'           => $emp_id,
                            'sub_password'           => md5($password),
                            'campus_id'             => 3,
                            'role'                  => 'ADVISOR',
                            'created_date'          => date('Y-m-d'),
                            'account_role_id'       => 11
                        );
            
            $val    = $this->Manager_model->advisoradd( $data );
            
            $this->session->set_userdata('error_msg', 'Created ');
            redirect('programmanagers/view_advisors');
       }
        
    }
    
    // use to generate logins
    public function view_advisors(){
        
        $this->login_check();
            
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        $result['advisors']     = $this->Manager_model->all_advisor_list( $emp_department_id );
                
        //echo '<pre>';var_dump($result);echo '</pre>';exit;
        
        $this->load->view('prgmanager/sectionadvisor/view_advisors',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    
    public function create_sections_form(){
        
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];
        
        
        $result['programms']    = $this->Admin_model->getAllprogramsHr($emp_department_id);
        $result['batches']      = $this->Admin_model->getAllbatches();

        $this->load->view('prgmanager/sectionadvisor/create_section',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    public function sections_generated_soFar(){
        
        $this->login_check();
            
        $result                 = $this->Course_model->getfirstSections($batch_id,$program_id, $session);
        $test .='<table id="sample-table-2" class="table table-striped table-bordered table-hover"><thead><tr><th>#</th><th>Section</th><th>Students list</th></tr></thead><tbody>';

        $i = 0;
        foreach( $result as  $pp){ 
            //$test.='<tr><td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="'.$pp["course_id"].'"></label></td><td>'.$pp["course_name"].'</td><td>'.$pp["course_code"].'</td></tr>';
            $test.='<tr><td><label  class="checkbox" style="width: 100%;"></label></td><td>'.$pp["program_section"].'</td><td><a target="_blank" href="'.site_url().'programmanagers/view_section_students?sec='.$pp["program_section"].'&prg='.$program_id.'&sess='.$session.'" >View Students</a></td></tr>';
            $i++; 
        } 
        
        $test.='</tbody></table>';
        echo $test;exit;
    }
    
    public function view_sections_generated(){
        
        $this->login_check();
            
        // loading all of the 
        // required models
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        

        // Current Year Sessions 
        //$cur_year = date('Y');
        //$result['sessions']         = $this->Admin_model->getYearSessions($cur_year);
        $result['sessions']         = $this->Admin_model->getAllSessions();
        $result['programms']        = $this->Admin_model->getAllprogramsHr($emp_department_id);

//            // courses that m
//            $result['offered_courses']  = $this->Course_model->getAllCourses();

        // for Teachers newly added
        $result['teachers']         = $this->Course_model->get_all_teachers();
        $result['all_batches']      = $this->Admin_model->getAllbatches();
        //echo '<pre>';var_dump($result['teachers']);echo '</pre>';exit;

        $this->load->view('prgmanager/courseallocation/add_course_allocation_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    
            
    public function create_subject_sections_form(){
        
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];
        
        
        $result['programms']    = $this->Admin_model->getAllprogramsHr($emp_department_id);
        $result['batches']      = $this->Admin_model->getAllbatches();

        $this->load->view('prgmanager/sectionadvisor/create_subject_sections_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    /********* Generation of Advisors Ends  *******************/
    
    
    /********* Generation of Section Definition Start *******************/
    
    public function section_definition_start_form(){
        
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];
        
        $result['programms']    = $this->Admin_model->getAllprogramsHr($emp_department_id);
        $result['batches']      = $this->Admin_model->getAllbatches();
      
        $this->load->view('prgmanager/studentsections/section_definition_start_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    // saves trhe section definition
    public function section_definition_save(){
        
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $sections_array         = $_POST['section'];
        
        // checking if same section selected again and again
        if(count($sections_array) != count(array_unique($sections_array))){
            $this->session->set_userdata('error_msg', 'Duplicate Sections are not allowed against a Single Course.');
            redirect('programmanagers/section_definition_start_form');
        }
        
        $cur_date           = date('Y-m-d');
        
        foreach ($_POST['no_of_students'] as $p => $k){
            $data_array  = 
                array(
                    'course_id'             => $_POST['offered_courses'],
                    'program_id'            => $_POST['program'],
                    'batch_id'              => $_POST['batch'],
                    'session_id'            => $_POST['session'],
                    'pm_id'                 => $emp_id,
                    'no_of_students'        => $k,
                    'section_name'          => $sections_array[$p],
                    'section_created_date'  => $cur_date
                );
            $emp_depart_id[]         = $this->Manager_model->CourseSectionSettings( $data_array );
        }
        
        $this->session->set_userdata('error_msg', 'Sections has been defined for the course.');
        redirect('programmanagers/section_course_settings_list');
    }
    
    
    public function section_course_settings_list(){
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        
        $this->login_check();
        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];

        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];

        $result['all_list']     = $this->Manager_model->CourseSectionSettingsList($current_session[0]['session_id'] , $emp_id);
              
        $this->load->view('prgmanager/studentsections/section_course_settings_list',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    // edit / delete needs to be deveoped
    
    public function section_course_adAllocation_form(){
        
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];

        $result['advisors']     = $this->Manager_model->all_advisor_list($emp_depart_id[0]['department_id']);
        $result['all_list']     = $this->Manager_model->CourseSectionSettingsList($current_session[0]['session_id'] , $emp_id);
      
        $this->load->view('prgmanager/studentsections/section_course_adAllocation_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    //this will update the course section with respect to adivosr
    public function save_course_section_advisor_allocate(){
        
        $current_session        = $this->Course_model->getCurrentSession();
        $advisor_id             = $_POST['advisor'];
        $curdate                = date('Y-m-d');
        $sizeof                 = count($_POST['courses_section_id']);
        
        if (( $sizeof < 1 )) {
            $this->session->set_userdata('error_msg', 'Atleast 1 course section is desired.');
            redirect('programmanagers/section_course_adAllocation_form');
        }
        
        
        foreach( $_POST['courses_section_id'] as $k => $p){
            $this->Manager_model->saveAdvisorAllocation($p , $current_session[0]['session_id'] , $advisor_id , $curdate);
        }
        
        $this->session->set_userdata('error_msg', 'Course section has been allocated to Advisor.');
        redirect('programmanagers/section_course_adAllocation_form');
    }
    
    
    public function advisor_section_course_settings_list(){
        
        $this->login_check();
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        
        $emp_id                 = $this->session->userdata('employee_id');
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];

        $result['all_list']     = $this->Manager_model->all_advisor_associated( $emp_id , $current_session[0]['session_id'] );
              
        $this->load->view('prgmanager/studentsections/advisor_section_course_settings_list',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    

    public function allocate_teacher_to_course_section_form(){
        $this->login_check();
            
        $this->load->model('Admin_model');
        $this->load->model('Course_model');

        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];

        $result['teachers']     = $this->Course_model->get_all_teachers();
        $result['batches']      = $this->Admin_model->getAllbatches();
        $result['all_list']     = $this->Manager_model->CourseSectionSettingsList($current_session[0]['session_id'] , $emp_id);
      
        $this->load->view('prgmanager/studentsections/allocate_teacher_to_course_section_form',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
    
    public function save_allocate_teacher_to_course_section(){
        $this->login_check();
        
        $current_session        = $this->Course_model->getCurrentSession();
        $teacher_id             = $_POST['teacher'];
        $curdate                = date('Y-m-d');
        $sizeof                 = count($_POST['courses_section_id']);
        
        if (( $sizeof < 1 )) {
            $this->session->set_userdata('error_msg', 'Atleast 1 course section Selection is desired.');
            redirect('programmanagers/allocate_teacher_to_course_section_form');
        }
        
        foreach( $_POST['courses_section_id'] as $k => $p){
            $this->Manager_model->saveTeacherAllocation($p , $current_session[0]['session_id'] , $teacher_id , $curdate);
        }
        
        $this->session->set_userdata('error_msg', 'Course section has been allocated to Teacher.');
        redirect('programmanagers/allocatedTeacherCourseSectionList');
    }
    
     public function allocatedTeacherCourseSectionList(){
        
        $this->login_check();
        
        $this->load->view('admin_ace/prgmanager_header');
        $this->load->view('admin_ace/prgmanager_side_menu');
        
        $emp_id                 = $this->session->userdata('employee_id');
        $current_session        = $this->Course_model->getCurrentSession();
        $result['session_id']   = $current_session[0]['session_id']; 
        $result['session']      = $current_session[0]['session'];
        $result['all_list']     = $this->Manager_model->all_teacher_associated( $emp_id , $current_session[0]['session_id'] );
              
        $this->load->view('prgmanager/studentsections/teacher_section_course_settings_list',$result);
        $this->load->view('admin_ace/prgmanager_footer');
    }
    
}