<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Examination extends CI_Controller {

    public function __construct() {

    parent::__construct();


    $this->load->model('Examination_model');    
    $this->load->model('Admission_r_model');
    $this->load->model('Teachers_model');
    $this->load->model('Admin_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validationstudent_result
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
    
  // Login for Admissions
  public function index() {
    $this->load->view('examination/login');
  }
  
  // for verification of admin login
 public function login_check() {

    if ($this->session->userdata('sub_login_id') == '' && $this->session->userdata('sub_login') == '') {
      redirect('examination');
    }
  }
  
  
  public function admin_login() {

    $this->form_validation->set_rules('username', 'User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      $this->load->view('examination/login');
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
                  redirect('examination/dashboard');
                } else {

                  $this->session->set_userdata('error', 'Incorrect Username OR Password');
                  redirect('examination/index');
                }
      }else{
                 $this->session->set_userdata('error', 'Please Login from Your Own login..');
                 redirect('examination/index');
          
      }
    }
  }
  
  
  
   public function dashboard() {

      $this->login_check();
    
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/dashboard');
      $this->load->view('admin_ace/admin_footer'); 
    
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
                 redirect('examination/dashboard');
      }else{
                $this->session->set_userdata('error_msg', 'Please Enter Your Correct Password');
                 redirect('examination/change_password_form');
      }
      
  }

  
   // add new course form
  public function add_course_form() {

    $this->login_check();
    
    $result['programs']             = $this->Admin_model->getAllprograms();

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/examination_side_menu');
    $this->load->view('examination/courses/addcourse',$result);
    $this->load->view('admin_ace/admin_footer');
  }

  // add new course in database

  public function add_course() {

    $this->login_check();

    $this->form_validation->set_rules('course_name', 'Course Name', 'required');
    $this->form_validation->set_rules('course_code', 'Course Code', 'required');
    $this->form_validation->set_rules('credit_hours', 'Credit Hours', 'required');
    

    if ($this->form_validation->run() == FALSE) {
      
        $result['programs']             = $this->Admin_model->getAllprograms();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/courses/addcourse',$result);
        $this->load->view('admin_ace/admin_footer');
    
    } else {

     
      $Insertdata = array(         
          'course_name' => $_POST['course_name'],
          'course_code' => $_POST['course_code'],
          'credit_hours' => $_POST['credit_hours'],
          'program_id' => $_POST['program_id']
      );

      //echo '<pre>';print_r($data);die;
      
      // check course name and code already exitsts or not

      $res = $this->Examination_model->checkcourse($Insertdata);
      if ($res) {
        $this->session->set_userdata('error_msg', 'Course Code  Already Exists');
        redirect('examination/add_course_form');
      } else {
        

        $result = $this->Examination_model->addCourse($Insertdata);
        if ($result) {
          $this->session->set_userdata('success_msg', 'New Course Added Successfully');
          redirect('examination/view_courses');
        }
      }
    }
  }

  // view all coursee 

  public function view_courses() {
    $this->login_check();

    $result['courses'] = $this->Examination_model->getAllCourses();
    

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/examination_side_menu');
    $this->load->view('examination/courses/viewcourses', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // get the name of course detail to be edited

  public function edit_course() {

    $this->login_check();

    $id = $this->uri->segment(3);
    $result['programs']             = $this->Admin_model->getAllprograms();
    $result['course']               = $this->Examination_model->getCourse($id);
     

    $this->load->view('admin_ace/admin_header');
    $this->load->view('admin_ace/examination_side_menu');
    $this->load->view('examination/courses/editcourse', $result);
    $this->load->view('admin_ace/admin_footer');
  }

  // update the course name 
  public function update_course() {

    $this->login_check();
    $id = $_POST['course_id'];

    $this->form_validation->set_rules('course_name', 'Course Name', 'required');
    $this->form_validation->set_rules('course_code', 'Course Code', 'required');
    $this->form_validation->set_rules('credit_hours', 'Credit Hours', 'required');
    

    if ($this->form_validation->run() == FALSE) {

        $result['programs']             = $this->Admin_model->getAllprograms();
        $result['course']               = $this->Examination_model->getCourse($id);


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/courses/editcourse', $result);
        $this->load->view('admin_ace/admin_footer');
    } 
    
    // check course name and code already exitsts or not

    $data = array(
          'course_name' => $_POST['course_name'],
          'course_code' => $_POST['course_code'],
          'credit_hours' => $_POST['credit_hours'],
          'program_id'  => $_POST['program_id']
      );
    
      $result = $this->Examination_model->updateCourse($id, $data);

      if ($result) {
        $this->session->set_userdata('success_msg', 'Course record updated Successfully');
        redirect('examination/view_courses');
      }
  }
  
  
  
    
    // *****   Start For Examination   ***** \\
    
    public function define_structure_form()
    {

      $this->login_check();
      
      $result['campus']         = $this->Admin_model->getAllCampuses();
      $result['campaigns']      = $this->Admin_model->getAllcampaigns2();
      $result['program']        = $this->Admin_model->getAllprograms();
     // $result['sessions']   = $this->Admin_model->getAllSessions();
        
          
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/define_structure',$result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    // get courses list against program
    
    public function get_Courses_list(){
            
        $this->login_check();
        $program_id         =   $_POST['program_id'];
        
        $result['courses']  =   $this->Examination_model->getCoursesList($program_id);
        
        $this->load->view('examination/course_partial',$result);
            
    }
 
    // **************   Start Define Mid and Final Structure
    
    
    public function define_structure(){
        $this->login_check();
              
       if($_REQUEST['term'] == 'mid'){           
           $this->define_mid_structure_form($_REQUEST['program'],$_REQUEST['course'],$_REQUEST['campaign']);
       }
       if($_REQUEST['term'] == 'final'){           
           $this->define_final_structure_form($_REQUEST['program'],$_REQUEST['course'],$_REQUEST['campaign']);
       }
    }


    public function define_mid_structure_form($program_id,$course_id,$campaign_id)
    {
      $this->login_check();
      
      $result['campaign_id']        =   $campaign_id;
      $result['program_id']         =   $program_id;
      $result['course_id']          =   $course_id;
                   
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/define_midstructure',$result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    public function define_mid_structure()
    {
        $this->login_check();
      
       
       $campus_id              =       $this->session->userdata('campus_id');
       $program_id             =       $_POST['program_id'];
       $course_id              =       $_POST['course_id'];
       $campaign_id            =       $_POST['campaign_id'];
       
       // check duplicate entry 
       
       $check_data             =       array(
                                            'campaign_id'           =>  $campaign_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id                                            
                                            );
       
       $res                    =   $this->Examination_model->checkMidStructure($check_data);
       if($res){
           
                $this->session->set_userdata('error_msg', 'Structure of this Course Already Defined.');
                 redirect('examination/define_structure_form');
           
       }else{
       
            $title                  =       array_values(array_filter($_POST['title']));
            $marks                  =       array_values(array_filter($_POST['marks']));


            if((count($title) != count($marks)) || count($title) == 0 )
            {
                $term       =   'mid';
                $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');                 
                redirect('examination/define_structure/?course='.$course_id.'&program='.$program_id.'&campaign='.$campaign_id.'&term='.$term);
            }
            

                        
            $mid_data            =   array(
                                         'campaign_id'           =>  $campaign_id,
                                         'program_id'            =>  $program_id,
                                         'course_id'             =>  $course_id,                                         
                                         'mid_title_1'           => $title[0],
                                         'mid_value_1'           => str_replace('', 0, $marks[0]),
                                         'mid_title_2'           => $title[1],
                                         'mid_value_2'           => str_replace('', 0, $marks[1]),
                                         'mid_title_3'           => $title[2],
                                         'mid_value_3'           => str_replace('', 0, $marks[2]),
                                         'created_date'          => date('Y-m-d')
                                     );

             $result                 =   $this->Examination_model->addMidStructure($mid_data);

             if($result){
                                  
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Added Successfully');
                          redirect('examination/define_structure_form');
             }else{
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Not Added Successfully');
                         redirect('examination/define_structure_form');
             }
       }
        
    }
    
    
     public function define_final_structure_form($program_id,$course_id,$campaign_id)
    {
        $this->login_check();
          
        $result['campaign_id']      =   $campaign_id;
        $result['program_id']       =   $program_id;
        $result['course_id']        =   $course_id;
        
        $res                              =       $this->Examination_model->getMidTotalMarks($campaign_id,$program_id,$course_id);        
        $result['mid_total']              =       $res->mid_total;
        
        if($result['mid_total'] == '')
        {
            $this->session->set_userdata('error_msg', 'First Defined Mid Term Structure then you can add Final Term Structure');
            redirect('examination/define_structure_form');
        }
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/define_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    public function define_final_structure()
    {
        $this->login_check();
      
       
       $program_id             =       $_POST['program_id'];
       $course_id              =       $_POST['course_id'];
       $campaign_id            =       $_POST['campaign_id'];
       
       $final_total_marks      =        $_POST['final_total_marks'];
       
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));
       
       if(array_sum($marks) > $final_total_marks || array_sum($marks) < $final_total_marks )
       {
           $term       =   'final';
           $this->session->set_userdata('error_msg', 'Final Term Marks Should  be '.$final_total_marks);
           redirect('examination/define_structure/?course='.$course_id.'&program='.$program_id.'&campaign='.$campaign_id.'&term='.$term);
       }else{
       
                // check duplicate entry 

                $check_data             =       array(                                                    
                                                     'campaign_id'           =>  $campaign_id,
                                                     'program_id'            =>  $program_id,
                                                     'course_id'             =>  $course_id
                                                     );

                $res                    =   $this->Examination_model->checkFinalStructure($check_data);
                if($res){

                         $this->session->set_userdata('error_msg', 'Structure of this Course Already Defined.');
                          redirect('examination/define_structure_form');

                }else{       

                         if((count($title) != count($marks)) || count($title) == 0 )
                         {
                              $term       =   'final';
                              $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                              redirect('examination/define_structure/?course='.$course_id.'&program='.$program_id.'&campaign='.$campaign_id.'&term='.$term);
                         }

                         $final_data            =   array(
                                                      'campaign_id'             =>  $campaign_id,
                                                      'program_id'              =>  $program_id,
                                                      'course_id'               =>  $course_id,                                                      
                                                      'final_title_1'           => $title[0],
                                                      'final_value_1'           => str_replace('', 0, $marks[0]),
                                                      'final_title_2'           => $title[1],
                                                      'final_value_2'           => str_replace('', 0, $marks[1]),
                                                      'final_title_3'           => $title[2],
                                                      'final_value_3'           => str_replace('', 0, $marks[2]),
                                                      'final_title_4'           => $title[3],
                                                      'final_value_4'           => str_replace('', 0, $marks[3]),
                                                      'final_title_5'           => $title[4],
                                                      'final_value_5'           => str_replace('', 0, $marks[4]),
                                                      'final_title_6'           => $title[5],
                                                      'final_value_6'           => str_replace('', 0, $marks[5]),
                                                      'final_title_7'           => $title[6],
                                                      'final_value_7'           => str_replace('', 0, $marks[6]),
                                                      'created_date'            => date('Y-m-d')
                                                  );

                          $result                 =   $this->Examination_model->addFinalStructure($final_data);

                          if($result){
                                      $this->session->set_userdata('error_msg', 'Final Term Structure Added Successfully');
                                      redirect('examination/define_structure_form');
                          }else{
                                      $this->session->set_userdata('error_msg', 'Final Term Structure Not Added Successfully');
                                      redirect('examination/define_structure_form');
                          }
                }
       }
        
    }
    
    
    // **************   End Define Mid and Final Structure
    
    
    
    
    // **************   Start View Mid and Final Structure
    
    public function view_structure_form()
    {

      $this->login_check();
      
      $result['campus']     = $this->Admin_model->getAllCampuses();
      $result['program']    = $this->Admin_model->getAllprograms();
      $result['campaigns']      = $this->Admin_model->getAllcampaigns2();
        
          
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/view_structure',$result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    public function view_structure(){
        $this->login_check();
              
       if($_REQUEST['term'] == 'mid'){             
           $this->view_mid_structure($_REQUEST['program'],$_REQUEST['course'],$_REQUEST['campaign']);
       }
       if($_REQUEST['term'] == 'final'){
           $this->view_final_structure($_REQUEST['program'],$_REQUEST['course'],$_REQUEST['campaign']);
       }
    }

    
    
    // view mid strtucture
    
    public function view_mid_structure($program_id,$course_id,$campaign_id)
    {
      $this->login_check();     
        
       $data             =       array(    
                                            'campaign_id'           =>  $campaign_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id
                                       );
       
       $result['mid']          =   $this->Examination_model->getMidStructure($data);
//        echo '<pre>';print_r($result);die;
       if(count($result['mid']) > 0){
            // echo '<pre>';print_r($result);die;
             // check if final structre define then edit in mid structure is not allowed

             $res                    =   $this->Examination_model->checkFinalStructure($data);
             $result['check_final']  =   count($res);


              $this->load->view('admin_ace/admin_header');
              $this->load->view('admin_ace/examination_side_menu');
              $this->load->view('examination/view_midstructure',$result);
              $this->load->view('admin_ace/admin_footer');
       
       }else{
                $this->session->set_userdata('error_msg', 'Structure of this course not Added.');
                redirect('examination/view_structure_form');
       }
//       echo '<pre>';
//       var_dump($res);die;
        
    }
    
     // view mid strtucture
    
    public function view_final_structure($program_id,$course_id,$campaign_id,$semester)
    {
        $this->login_check();
      
        
       $data             =       array(                                            
                                            'campaign_id'           =>  $campaign_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id
                                       );
       
       $result['final']          =   $this->Examination_model->getFinalStructure($data);
       
        if(count($result['final']) > 0){
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/view_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
       
//       echo '<pre>';
//       var_dump($res);die;
        }else{
                $this->session->set_userdata('error_msg', 'Structure of this course not Added.');
                redirect('examination/view_structure_form');
        }
    }
    
    
    public function edit_mid_structure()
    {
        $this->login_check();
      
        $mid_structure_id         =       $_GET['mid_structure_id'];
        
        $result['mid']            =       $this->Examination_model->MidStructure($mid_structure_id);
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_midstructure',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function update_mid_structure()
    {
        $this->login_check();
      
       $mid_course_id          =       $_POST['mid_course_structure_id'];
       
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));

     //              echo '<pre>';
     //              print_r($title);
     //              echo '<pre>';
     //              print_r($marks);die;
       
//             if(array_sum($marks) > 30  || array_sum($marks) < 30)
//            {
//                $term       =   'mid';
//                $this->session->set_userdata('error_msg', 'Mid Marks Should be Equal to 30');                 
//                redirect('examination/edit_mid_structure/?mid_structure_id='.$mid_course_id);
//            }

            if((count($title) != count($marks)) || count($title) == 0 )
            {
                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                 redirect('examination/edit_mid_structure/?mid_structure_id='.$mid_course_id);
            }

                        
            $mid_data            =   array(                                        
                                         'mid_title_1'           => $title[0],
                                         'mid_value_1'           => str_replace('', 0, $marks[0]),
                                         'mid_title_2'           => $title[1],
                                         'mid_value_2'           => str_replace('', 0, $marks[1]),
                                         'mid_title_3'           => $title[2],
                                         'mid_value_3'           => str_replace('', 0, $marks[2])
                                     );

             $result                 =   $this->Examination_model->updateMidStructure($mid_course_id,$mid_data);

             if($result > 0){
                                  
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Updated Successfully');
                          redirect('examination/view_structure_form');
             }else{
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Not Updated Successfully');
                         redirect('examination/edit_mid_structure/?mid_structure_id='.$mid_course_id);
             }
      
    }
    
    public function edit_final_structure()
    {
        $this->login_check();
      
        $final_structure_id         =       $_GET['final_course_structure_id'];
        
        $result['final']            =       $this->Examination_model->FinalStructure($final_structure_id);
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function update_final_structure()
    {
        $this->login_check();
      
       $final_course_id          =       $_POST['final_course_structure_id'];
       $final_total              =       $_POST['final_total'];
       
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));

     //              echo '<pre>';
     //              print_r($title);
     //              echo '<pre>';
     //              print_r($marks);die;

            if((count($title) != count($marks)) || count($title) == 0 )
            {
                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                 redirect('examination/edit_final_structure/?final_structure_id='.$final_course_id);
            }
            if( array_sum($marks) != $final_total )
            {
                $this->session->set_userdata('error_msg', 'Marks should be Equal to '.$final_total);
                 redirect('examination/edit_final_structure/?final_course_structure_id='.$final_course_id);
            };

                        
            $final_data            =   array(                                        
                                         'final_title_1'           => $title[0],
                                         'final_value_1'           => str_replace('', 0, $marks[0]),
                                         'final_title_2'           => $title[1],
                                         'final_value_2'           => str_replace('', 0, $marks[1]),
                                         'final_title_3'           => $title[2],
                                         'final_value_3'           => str_replace('', 0, $marks[2]),
                                         'final_title_4'           => $title[3],
                                         'final_value_4'           => str_replace('', 0, $marks[3]),
                                         'final_title_5'           => $title[4],
                                         'final_value_5'           => str_replace('', 0, $marks[4]),
                                         'final_title_6'           => $title[5],
                                         'final_value_6'           => str_replace('', 0, $marks[5]),
                                         'final_title_7'           => $title[6],
                                         'final_value_7'           => str_replace('', 0, $marks[6])
                                     );

            //echo '<pre>';print_r($final_data);die;
             $result                 =   $this->Examination_model->updateFinalStructure($final_course_id,$final_data);

             if($result){
                                  
                         $this->session->set_userdata('error_msg', 'Final Term Structure Updated Successfully');
                          redirect('examination/view_structure_form');
             }else{
                         $this->session->set_userdata('error_msg', 'Final Term Structure Not Updated Successfully');
                         redirect('examination/edit_final_structure/?final_structure_id='.$final_course_id);
             }
      
    }
    
    
    ///// *******************     START CODE FOR RESULT MODULE   ********************** \\\\\
    
    
    //*********   Start add result function 
    
    public function add_result_form()
    {        
        $this->login_check();
      
        $result['campaigns']     = $this->Admin_model->getAllcampaigns2();
        $result['program']       = $this->Admin_model->getAllprograms();
       // $result['sessions']   = $this->Admin_model->getAllSessions();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/add_result',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
    public function add_result(){
        $this->login_check();
              
       if($_REQUEST['term'] == 'mid'){           
           $this->add_mid_result_form($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester']);
       }
       if($_REQUEST['term'] == 'final'){
           $this->add_final_result_form($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester']);
       }
    }
    
    
    
    public function add_mid_result_form($campaign_id,$program_id,$course_id,$semester)
    {
        $this->login_check();
        
        
        $result['students']     =   $this->Examination_model->getStudent($campaign_id,$program_id);        
        $result['course_id']    =   $course_id; 
        $result['campaign_id']  =   $campaign_id; 
        $result['program_id']   =   $program_id; 
        $result['semester']     =   $semester; 
        
        
        $data                   =       array(                                            
                                                'campaign_id'           =>  $campaign_id,
                                                'semester'              =>  $semester,
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id
                                            );
        
        $res          =   $this->Examination_model->getMidStructure($data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_result_form');
        }

        $result['mid']   =   $res;
        
//        echo '<pre>';print_r($res);
//        echo '<pre>';print_r($result['students']);die;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/mid_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
 
     public function add_mid_result()
    {
         
       
       $this->login_check();
      
       $semester                =       $_POST['semester'];                            
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $campaign_id             =       $_POST['campaign_id'];
       
       $student_id              =       $_POST['student_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       $mid_total1              =       $_POST['mid_total_1'];
       $mid_total2              =       $_POST['mid_total_2'];
       $mid_total3              =       $_POST['mid_total_3'];
       
       for($i=0; $i < count($student_id); $i++)
      {
           
            if($marks_1[$i] > $mid_total1 || $marks_2[$i] > $mid_total2 || $marks_3[$i] > $mid_total3)
            {
                 $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/add_result_form');
            }
      }
      
      // check duplication for mid result
      
            $check_duplication        =   array(
                                                'semester'              =>  $semester,                                                   
                                                'program_id'            =>  $program_id,                                         
                                                'course_id'             =>  $course_id,
                                                'campaign_id'           =>  $campaign_id
                                        );
      
            $res                    =   $this->Examination_model->checkMidResult($check_duplication);
            
            if(count($res) == 0){
      
       
                                for($i=0; $i < count($student_id); $i++)
                                {
                                          $mid_result              =       array(
                                                                              'student_id'            =>  $student_id[$i],
                                                                              'semester'              =>  $semester,                                                   
                                                                              'program_id'            =>  $program_id,                                           
                                                                              'course_id'             =>  $course_id,                                            
                                                                              'mid_title_1'           => $title1,
                                                                              'mid_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                                              'mid_title_2'           => $title2,
                                                                              'mid_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                                              'mid_title_3'           => $title3,
                                                                              'mid_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                                              'status'                => $status[$i],
                                                                              'created_date'          => date('Y-m-d'),
                                                                              'campaign_id'           =>  $campaign_id
                                                                              );

                                                                            //  echo '<pre>';print_r($mid_result);die;


                                                  $mid_result_id          =   $this->Examination_model->AddMidResult($mid_result); 

                                                  if(!$mid_result_id){
                                                          $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Please try again.');
                                                          redirect('examination/add_result_form');
                                                      }

                                }
      
                                $mid_result_status              =       array(
                                                                             'semester'              =>  $semester,
                                                                             'program_id'            =>  $program_id,
                                                                             'course_id'             =>  $course_id,
                                                                             'campaign_id'           =>  $campaign_id,
                                                                             'result_status'         =>  1
                                                                             
                                                                             );

                                $mid_result_status_id           =   $this->Examination_model->AddMidResultStatus($mid_result_status,$campaign_id,$program_id,$course_id,$semester);

        
      
                                $this->session->set_userdata('error_msg', 'Mid Term Result Added Successfully.');
                                redirect('examination/add_result_form');
            }else{                
                        $this->session->set_userdata('error_msg', 'Result of this Semester Already Added.');
                        redirect('examination/add_result_form');
            }
     
      
    }
    
    
    public function add_final_result_form($campaign_id,$program_id,$course_id,$semester)
    {
        
        $this->login_check();
        
        
        $result['students']     = $this->Examination_model->getStudent($campaign_id,$program_id);
        $result['course_id']    =   $course_id; 
        $result['campaign_id']    =   $campaign_id; 
        $result['program_id']   =   $program_id; 
        $result['semester']     =   $semester; 
        
       
        $mid_data                   =       array(                                            
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id,
                                                'semester'              =>  $semester,
                                                'campaign_id'           =>  $campaign_id
                                            );
        
        $result['mid_res']                    =   $this->Examination_model->checkMidResult($mid_data);
       
        if(count($result['mid_res']) > 0){
                $res          =   $this->Examination_model->getFinalStructure($mid_data); 

                if(count($res) == 0){
                    $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term structure then add result.');
                    redirect('examination/add_result_form');
                }

                $result['final']   =   $res;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/examination_side_menu');
                $this->load->view('examination/final_std_list',$result);
                $this->load->view('admin_ace/admin_footer');
        }else{
            $this->session->set_userdata('error_msg', 'Please Add the Mid Result first then you can add final result.');
            redirect('examination/add_result_form');            
        }
    }
    
    public function add_final_result()
    {
       $this->login_check();
      
       $semester                =       $_POST['semester'];              
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $campaign_id             =       $_POST['campaign_id'];
       
       $student_id              =       $_POST['student_id'];
       
      $title1                  =       $_POST['title1'];
      $title2                  =       $_POST['title2'];
      $title3                  =       $_POST['title3'];
      $title4                  =       $_POST['title4'];
      $title5                  =       $_POST['title5'];
      $title6                  =       $_POST['title6'];
      $title7                  =       $_POST['title7'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $marks_4                 =       $_POST['o_marks4'];
       $marks_5                 =       $_POST['o_marks5'];
       $marks_6                 =       $_POST['o_marks6'];
       $marks_7                 =       $_POST['o_marks7'];
       
       $status                  =       $_POST['status'];
       
      // die('<br>add mis result');
      
       
       $final_total1              =       $_POST['final_total_1'];
       $final_total2              =       $_POST['final_total_2'];
       $final_total3              =       $_POST['final_total_3'];
       $final_total4              =       $_POST['final_total_4'];
       $final_total5              =       $_POST['final_total_5'];
       $final_total6              =       $_POST['final_total_6'];
       $final_total7              =       $_POST['final_total_7'];
       
       
       for($i=0; $i < count($student_id); $i++)
        {
              if($marks_1[$i] > $final_total1 || $marks_2[$i] > $final_total2 || $marks_3[$i] > $final_total3 || $marks_4[$i] > $final_total4 || $marks_5[$i] > $final_total5 || $marks_6[$i] > $final_total6 || $marks_7[$i] > $final_total7 )
              {
                   $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Obtained Marks should be less than total.');
                   redirect('examination/add_result_form');
              }
        } 
       
       
        // check duplication for mid result
      
            $check_duplication        =   array(
                                            'semester'              =>  $semester,                                                   
                                            'program_id'            =>  $program_id,                                           
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                        );
      
            $res                    =   $this->Examination_model->checkFinalResult($check_duplication);
            
            if(count($res) == 0){
        
                                for($i=0; $i < count($student_id); $i++)
                                {
                                           $final_result              =       array(
                                                                                           'student_id'            =>  $student_id[$i],
                                                                                           'semester'              =>  $semester,                                                   
                                                                                           'program_id'            =>  $program_id,                                          
                                                                                           'course_id'             =>  $course_id,  
                                                                                           'campaign_id'           =>  $campaign_id,
                                                                                           'final_title_1'           => $title1,
                                                                                           'final_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                                                           'final_title_2'           => $title2,
                                                                                           'final_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                                                           'final_title_3'           => $title3,
                                                                                           'final_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                                                           'final_title_4'           => $title4,
                                                                                           'final_value_4'           => str_replace('', 0, $marks_4[$i]),
                                                                                           'final_title_5'           => $title5,
                                                                                           'final_value_5'           => str_replace('', 0, $marks_5[$i]),
                                                                                           'final_title_6'           => $title6,
                                                                                           'final_value_6'           => str_replace('', 0, $marks_6[$i]),
                                                                                           'final_title_7'           => $title7,
                                                                                           'final_value_7'           => str_replace('', 0, $marks_7[$i]),
                                                                                           'status'                  => $status[$i],
                                                                                           'created_date'            => date('Y-m-d')
                                                                                           );


                                                  $final_result_id          =   $this->Examination_model->AddFinalResult($final_result); 

                                                  if(!$final_result_id){
                                                          $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Please try again.');
                                                          redirect('examination/add_result_form');
                                                      }
                                                      

                                }
                                  $this->calculate_save_std_gpa($campaign_id, $program_id, $semester);

                                  $final_result_status              =       array(                                                                                           
                                                                                           'semester'              =>  $semester,
                                                                                           'program_id'            =>  $program_id,
                                                                                           'course_id'             =>  $course_id,
                                                                                           'campaign_id'           =>  $campaign_id,
                                                                                           'result_status'         =>  1                                           
                                                                                           );

                                 $final_result_status_id           =   $this->Examination_model->AddFinalResultStatus($final_result_status,$campaign_id,$program_id,$course_id,$semester);

                                   $this->session->set_userdata('error_msg', 'Final Term Result Added Successfully.');
                                   redirect('examination/add_result_form');
                                   
            }else{                
                        $this->session->set_userdata('error_msg', 'Result of this Semester Already Added.');
                        redirect('examination/add_result_form');
            }
       
    }
    
    // for hole programs students
    public function calculate_save_std_gpa($campaign_id,$program_id,$semester){
      
      $students     =   $this->Examination_model->getStudents($campaign_id,$program_id,$semester);
    
      $i=1;
      foreach($students AS $row){   
          //echo $row['student_id']; die;
          $final_marks    =   $this->Examination_model->getFinalMarks($row['student_id'],$semester);
//          echo '<pre>';print_r($final_marks);die;
          $gpa = 0;
          $count = 0;
                        for($c=0; $c < count($final_marks); $c++){    
                                    $count++;
                                    $marks  =   $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2'];
                                    $res    = $this->Examination_model->getGpa($marks);
                                    $gpa    =   $gpa + $res;                                                             
                                  }
                                  
                                 $gpa = $gpa/$count;
                                 
                                    $check        =    $this->Examination_model->checkgpa($row['student_id'], $semester);
                                    if(count($check) > 0){
                                        $std_gpa_id   =   $this->Examination_model->UpdateStdgpa($row['student_id'],number_format((float)$gpa, 2, '.', ''),$semester);
                                    }else{
                                        $std_gpa_id   =   $this->Examination_model->SaveStdgpa($row['student_id'],number_format((float)$gpa, 2, '.', ''),$semester);
                                    }
                                  
                               }
  }
   
  
  // for single student
    public function calculate_save_std_gpa_std($semester,$student_id){
      
     
          $final_marks    =   $this->Examination_model->getFinalMarks($student_id,$semester);
//          echo '<pre>';print_r($final_marks);die;
          $gpa = 0;
          $count = 0;
                        for($c=0; $c < count($final_marks); $c++){    
                                    $count++;
                                    $marks  =   $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2'];
                                    $res    = $this->Examination_model->getGpa($marks);
                                    $gpa    =   $gpa + $res;                                                             
                                  }
                                  
                                 $gpa = $gpa/$count;
                                 
                                    $check        =    $this->Examination_model->checkgpa($student_id, $semester);
                                    if(count($check) > 0){
                                        $std_gpa_id   =   $this->Examination_model->UpdateStdgpa($student_id,number_format((float)$gpa, 2, '.', ''),$semester);
                                    }else{
                                        $std_gpa_id   =   $this->Examination_model->SaveStdgpa($student_id,number_format((float)$gpa, 2, '.', ''),$semester);
                                    }
                                  
    }
    
    // ************* Functions for Missed students entry 
    
    public function add_missed_form()
    {        
        $this->login_check();
      
        $result['campaigns']     = $this->Admin_model->getAllcampaigns2();
        $result['program']       = $this->Admin_model->getAllprograms();
       // $result['sessions']   = $this->Admin_model->getAllSessions();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/add_missed_result',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
    public function get_missedStudents_list(){
        
        $campaign_id        =   $_POST['campaign_id'];
        $program_id         =   $_POST['program_id'];
        $course_id          =   $_POST['course_id'];
        $semester           =   $_POST['semester'];
        $term               =   $_POST['term'];
        
        
        $result['rollno']         =   $this->Examination_model->getMissedStudents($campaign_id,$program_id,$course_id,$semester,$term);
        
        $this->load->view('examination/rollno_partial',$result);
        
        
        
        
    }
    
    public function add_missed_result(){
        $this->login_check();
              
       if($_REQUEST['term'] == 'mid'){           
           $this->add_mid_missed_result_form($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester'],$_REQUEST['roll_no']);
       }
       if($_REQUEST['term'] == 'final'){
           $this->add_final_missed_result_form($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester'],$_REQUEST['roll_no']);
       }
    }
    
    
    public function add_mid_missed_result_form($campaign_id,$program_id,$course_id,$semester,$student)
    {
        $this->login_check();
        
        
//        $result['students']     =   $this->Examination_model->getStudent($campaign_id,$program_id);  
        
        $std_array              = explode(',', $student);
        
        
        $result['student_id']       =   $std_array[0]; 
        $result['roll_no']          =   $std_array[1]; 
        $result['student_name']     =   $std_array[2]; 
        $result['course_id']        =   $course_id; 
        $result['campaign_id']      =   $campaign_id; 
        $result['program_id']       =   $program_id; 
        $result['semester']         =   $semester; 
        
        
        $data                   =       array(                                            
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id
                                            );
        
        $res          =   $this->Examination_model->getMidStructure($data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_missed_form');
        }

        $result['mid']   =   $res;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/mid_missed_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function add_mid_missed_result()
    {
         
       
       $this->login_check();
      
       $semester                =       $_POST['semester'];                            
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $campaign_id             =       $_POST['campaign_id'];
       
       $student_id              =       $_POST['student_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       $mid_total1              =       $_POST['mid_total_1'];
       $mid_total2              =       $_POST['mid_total_2'];
       $mid_total3              =       $_POST['mid_total_3'];
       
      
            if($marks_1 > $mid_total1 || $marks_2 > $mid_total2 || $marks_3 > $mid_total3)
            {
                 $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/add_missed_form');
            }
      
      
      // check duplication for mid result
      
            $check_duplication        =   array(                
                                                'student_id'            =>  $student_id,                                                   
                                                'semester'              =>  $semester,                                                   
                                                'program_id'            =>  $program_id,                                         
                                                'course_id'             =>  $course_id,
                                                'campaign_id'           =>  $campaign_id
                                        );
     
            $res                    =   $this->Examination_model->checkMidResult2($check_duplication);
           
            if(count($res) == 0){
      
       
                                          $mid_result              =       array(
                                                                              'student_id'            =>  $student_id,
                                                                              'semester'              =>  $semester,                                                   
                                                                              'program_id'            =>  $program_id,                                           
                                                                              'course_id'             =>  $course_id,                                            
                                                                              'mid_title_1'           => $title1,
                                                                              'mid_value_1'           => str_replace('', 0, $marks_1),
                                                                              'mid_title_2'           => $title2,
                                                                              'mid_value_2'           => str_replace('', 0, $marks_2),
                                                                              'mid_title_3'           => $title3,
                                                                              'mid_value_3'           => str_replace('', 0, $marks_3),
                                                                              'status'                => $status,
                                                                              'created_date'          => date('Y-m-d'),
                                                                              'campaign_id'           =>  $campaign_id
                                                                              );

                                                                              //echo '<pre>';print_r($mid_result);die;


                                                  $mid_result_id          =   $this->Examination_model->AddMidResult($mid_result); 

                                                  if(!$mid_result_id){
                                                          $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Please try again.');
                                                          redirect('examination/add_missed_form');
                                                      }

                                $this->session->set_userdata('error_msg', 'Mid Term Result Added Successfully.');
                                redirect('examination/add_missed_form');
            }else{                
                        $this->session->set_userdata('error_msg', 'Result of this Semester Already Added.');
                        redirect('examination/add_missed_form');
            }
     
      
    }
    
    
    public function add_final_missed_result_form($campaign_id,$program_id,$course_id,$semester,$student)
    {
        
        $this->login_check();
        
        
        $std_array              = explode(',', $student);
        
        
        $result['student_id']       =   $std_array[0]; 
        $result['roll_no']          =   $std_array[1]; 
        $result['student_name']     =   $std_array[2];
        $result['course_id']        =   $course_id; 
        $result['campaign_id']      =   $campaign_id; 
        $result['program_id']       =   $program_id; 
        $result['semester']         =   $semester; 
        
        
        $data                   =       array(                                            
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id
                                            );
        
        $mid_data                   =       array(                                            
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id,
                                                'semester'              =>  $semester,
                                                'campaign_id'           =>  $campaign_id
                                            );
        
        $result['mid_res']                    =   $this->Examination_model->checkMidResult($mid_data);
       
        if(count($result['mid_res']) > 0){
                $res          =   $this->Examination_model->getFinalStructure($data); 

                if(count($res) == 0){
                    $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term structure then add result.');
                    redirect('examination/add_missed_form');
                }

                $result['final']   =   $res;

                $this->load->view('admin_ace/admin_header');
                $this->load->view('admin_ace/examination_side_menu');                
                $this->load->view('examination/final_missed_std_list',$result);
                $this->load->view('admin_ace/admin_footer');
        }else{
            $this->session->set_userdata('error_msg', 'Please Add the Mid Result first then you can add final result.');
            redirect('examination/add_missed_form');            
        }
    }
    
    public function add_final_missed_result()
    {
       $this->login_check();
      
       $semester                =       $_POST['semester'];              
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $campaign_id             =       $_POST['campaign_id'];
       
       $student_id              =       $_POST['student_id'];
       
      $title1                  =       $_POST['title1'];
      $title2                  =       $_POST['title2'];
      $title3                  =       $_POST['title3'];
      $title4                  =       $_POST['title4'];
      $title5                  =       $_POST['title5'];
      $title6                  =       $_POST['title6'];
      $title7                  =       $_POST['title7'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $marks_4                 =       $_POST['o_marks4'];
       $marks_5                 =       $_POST['o_marks5'];
       $marks_6                 =       $_POST['o_marks6'];
       $marks_7                 =       $_POST['o_marks7'];
       
       $status                  =       $_POST['status'];
       
      // die('<br>add mis result');
      
       
       $final_total1              =       $_POST['final_total_1'];
       $final_total2              =       $_POST['final_total_2'];
       $final_total3              =       $_POST['final_total_3'];
       $final_total4              =       $_POST['final_total_4'];
       $final_total5              =       $_POST['final_total_5'];
       $final_total6              =       $_POST['final_total_6'];
       $final_total7              =       $_POST['final_total_7'];
       
          if($marks_1 > $final_total1 || $marks_2 > $final_total2 || $marks_3 > $final_total3 || $marks_4 > $final_total4 || $marks_5 > $final_total5 || $marks_6 > $final_total6 || $marks_7 > $final_total7 )
              {
                   $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Obtained Marks should be less than total.');
                   redirect('examination/add_missed_form');
              }
      
       
        // check duplication for mid result
      
            $check_duplication        =   array(
                                            'student_id'            =>  $student_id,                                                   
                                            'semester'              =>  $semester,                                                   
                                            'program_id'            =>  $program_id,                                           
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                        );
      
            $res                    =   $this->Examination_model->checkFinalResult2($check_duplication);
            
            if(count($res) == 0){
        
                                           $final_result              =       array(
                                                                                           'student_id'            =>  $student_id,
                                                                                           'semester'              =>  $semester,                                                   
                                                                                           'program_id'            =>  $program_id,                                          
                                                                                           'course_id'             =>  $course_id,  
                                                                                           'campaign_id'           =>  $campaign_id,
                                                                                           'final_title_1'           => $title1,
                                                                                           'final_value_1'           => str_replace('', 0, $marks_1),
                                                                                           'final_title_2'           => $title2,
                                                                                           'final_value_2'           => str_replace('', 0, $marks_2),
                                                                                           'final_title_3'           => $title3,
                                                                                           'final_value_3'           => str_replace('', 0, $marks_3),
                                                                                           'final_title_4'           => $title4,
                                                                                           'final_value_4'           => str_replace('', 0, $marks_4),
                                                                                           'final_title_5'           => $title5,
                                                                                           'final_value_5'           => str_replace('', 0, $marks_5),
                                                                                           'final_title_6'           => $title6,
                                                                                           'final_value_6'           => str_replace('', 0, $marks_6),
                                                                                           'final_title_7'           => $title7,
                                                                                           'final_value_7'           => str_replace('', 0, $marks_7),
                                                                                           'status'                  => $status,
                                                                                           'created_date'            => date('Y-m-d')
                                                                                           );


                                                  $final_result_id          =   $this->Examination_model->AddFinalResult($final_result); 

                                                  if(!$final_result_id){
                                                          $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Please try again.');
                                                          redirect('examination/add_missed_form');
                                                      }

                               
                                   $this->session->set_userdata('error_msg', 'Final Term Result Added Successfully.');
                                   redirect('examination/add_missed_form');
                                   
            }else{                
                        $this->session->set_userdata('error_msg', 'Result of this Semester Already Added.');
                        redirect('examination/add_missed_form');
            }
       
    }
    
    //*********   Start view,edit and update function for result
    
    
     public function view_result_form()
    {
        
        $this->login_check();
      
        $result['campaign']     = $this->Admin_model->getAllcampaigns2();
        $result['program']    = $this->Admin_model->getAllprograms();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/view_result',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
    public function view_result(){
        $this->login_check();
              
       if($_REQUEST['term'] == 'mid'){           
           $this->view_mid_result($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester']);
       }
       if($_REQUEST['term'] == 'final'){
           $this->view_final_result($_REQUEST['campaign'],$_REQUEST['program'],$_REQUEST['course'],$_REQUEST['semester']);
       }
    }
    
    
    
    public function view_mid_result($campaign_id,$program_id,$course_id,$semester)
    {
        $this->login_check();
        
        $result['campaign_id']  =   $campaign_id;
        $result['program_id']   =   $program_id;
        $result['course_id']    =   $course_id;
        $result['semester']     =   $semester;
        
        $check_data             =       array(
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                            );
      
        
        $res_status             =   $this->Examination_model->getMidResStatus($check_data); 
        $result['res_status']   =   $res_status->result_status;
         
        $this->session->set_userdata('mid_status_id',$res_status->mid_status_id);
        
        
        $result['mid_structure']                    =   $this->Examination_model->getMidStructure($check_data);
        
        $result['mid_result']                       =   $this->Examination_model->getMidResult($campaign_id,$program_id,$course_id,$semester); 

//        echo '<pre>';print_r($result['mid_result']);die;
        
        
        if(count($result['mid_structure']) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_view_result');
        }

        
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/mid_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function edit_mid_result()
    {
        $this->login_check();
        
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6);
        
        
        $result['students']     =   $this->Examination_model->getStudent($campaign_id,$program_id);        
        $result['course_id']    =   $course_id; 
        $result['campaign_id']  =   $campaign_id; 
        $result['program_id']   =   $program_id; 
        $result['semester']     =   $semester; 
        
        
        $data             =       array(
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                            );
        
        $result['mid']          =   $this->Examination_model->getMidStructure($data);            
       
        $result['mid_result']   =   $this->Examination_model->getMidResult($campaign_id,$program_id,$course_id,$semester); 

        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_std_mid_result',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    
     public function update_mid_result()
    {
       $this->login_check();
             
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $semester                =       $_POST['semester'];       
       $campaign_id             =       $_POST['campaign_id'];   
       
       $student_id              =       $_POST['student_id'];
       $mid_result_id           =       $_POST['mid_result_id'];
       
      // echo '<pre>';print_r($mid_result_id);die;
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       $mid_total1              =       $_POST['mid_total_1'];
       $mid_total2              =       $_POST['mid_total_2'];
       $mid_total3              =       $_POST['mid_total_3'];
       
       for($i=0; $i < count($student_id); $i++)
      {
            if($marks_1[$i] > $mid_total1 || $marks_2[$i] > $mid_total2 || $marks_3[$i] > $mid_total3)
            {
                 $this->session->set_userdata('error_msg', 'Mid Term Result Not Updated, Obtained Marks should be less than total.');
                 redirect('examination/view_result_form');
            }
      }
      
      for($i=0; $i < count($student_id); $i++)
      {
          
                 
                $mid_result              =       array(                                                                                               
                                                    'mid_title_1'           => $title1,
                                                    'mid_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                    'mid_title_2'           => $title2,
                                                    'mid_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                    'mid_title_3'           => $title3,
                                                    'mid_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                    'status'                => $status[$i]
                                                    );

                    //echo '<br><pre>'.$mid_result_id[$i];
                    //echo '<pre>';print_r($mid_result);
                                                   
                        $res          =   $this->Examination_model->UpdateMidResult($mid_result_id[$i],$mid_result); 
                        
                        if($res > 0){
                            
                             $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                                                               
                                        'course_id'             =>  $course_id,
                                        'student_id'            =>  $student_id[$i],
                                        'result_id'             =>  $mid_result_id[$i],
                                        'result_type'           =>  'mid',
                                        'edit_delete'           =>  1                                        
                                    );
                             
                            $log_id     =   $this->Examination_model->AddResultLog($log_data);
                        }
                        
                                        
      }
      
            $this->session->set_userdata('error_msg', 'Mid Term Result Updated Successfully.');
            redirect('examination/view_result_form');      
      
    }

    public function delete_mid_result(){
        
        $this->login_check();
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6);
     
        $mid_result_delete          =       array(                                                                                                
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester,
                                                    'campaign_id'         =>  $campaign_id
                                                );
        
        $log_data          =       array(                                                                                                
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester,
                                                    'campaign_id'         =>  $campaign_id,
                                                    'edit_delete'         =>  2,
                                                    'result_type'         =>  'mid',
                                                    'operator_id'         =>   $this->session->userdata('sub_login_id')
                                                );
        
        
        $result                     =   $this->Examination_model->del_mid_result($mid_result_delete,$campaign_id,$program_id,$course_id,$semester);
        if($result){
            
            $log_id     =   $this->Examination_model->AddResultLog($log_data);
            
             $this->session->set_userdata('error_msg', 'Mid Term Result Deleted Successfully');
             redirect('examination/view_result_form');
        }else{            
             $this->session->set_userdata('error_msg', 'Mid Term Result Not Deleted,');
             redirect('examination/view_result_form');
        }
        
    }
    
    function post_mid_result()
    {
        $this->login_check();
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6); 
        $status                     =   $this->uri->segment(7); 
     
        
        $data                       =       array(
                                                    'campaign_id'         =>  $campaign_id,                                            
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester
                                            );
        
        $result                     =   $this->Examination_model->post_mid_result($data,$status,$campaign_id,$program_id,$course_id,$semester);
        if($result){
            
             $this->session->set_userdata('error_msg', 'Mid Term Result Posted Successfully');
             redirect('examination/view_result_form');
        }else{            
             $this->session->set_userdata('error_msg', 'Mid Term Result Not Posted,');
             redirect('examination/view_result_form');
        }
    }
 
    
    
    
     public function view_final_result($campaign_id,$program_id,$course_id,$semester)
    {
        
        $this->login_check();
        
        $result['campaign_id']    =   $campaign_id;
        $result['program_id']   =   $program_id;
        $result['course_id']    =   $course_id;
        $result['semester']     =   $semester;
        
        $check_data             =       array(                                            
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                            );
        
        $res_status             =   $this->Examination_model->getFinalResStatus($check_data); 
        $result['res_status']   =   $res_status->result_status;
        
        $this->session->set_userdata('final_status_id',$res_status->final_status_id);
        
        
        $result['final_structure']                    =   $this->Examination_model->getFinalStructure($check_data); 
        $result['final_result']                       =   $this->Examination_model->getFinalResult($campaign_id,$program_id,$course_id,$semester); 

       // echo '<pre>';print_r($result['mid_result']);die;
        
        
        if(count($result['final_structure']) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term atructure then add result.');
            redirect('examination/view_result_form');
        }
        
               
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/final_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
     public function edit_final_result()
    {
        $this->login_check();
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6);
        
        
        $result['students']     =   $this->Examination_model->getStudent($campaign_id,$program_id);        
        $result['course_id']    =   $course_id; 
        $result['campaign_id']  =   $campaign_id; 
        $result['program_id']   =   $program_id; 
        $result['semester']     =   $semester; 
        
        
         $data             =       array(                                            
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'campaign_id'           =>  $campaign_id
                                            );
        
        $result['final']          =   $this->Examination_model->getFinalStructure($data);            
       
        $result['final_result']   =   $this->Examination_model->getfinalResult($campaign_id,$program_id,$course_id,$semester); 

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_std_final_result',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    
     public function update_final_result()
    {
       $this->login_check();
      
       $course_id               =       $_POST['course_id'];       
       $program_id              =       $_POST['program_id'];
       $semester                =       $_POST['semester'];       
       $campaign_id             =       $_POST['campaign_id'];   
       
       $student_id              =       $_POST['student_id'];
       $final_result_id         =       $_POST['final_result_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       $title4                  =       $_POST['title4'];
       $title5                  =       $_POST['title5'];
       $title6                  =       $_POST['title6'];
       $title7                  =       $_POST['title7'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $marks_4                 =       $_POST['o_marks4'];
       $marks_5                 =       $_POST['o_marks5'];
       $marks_6                 =       $_POST['o_marks6'];
       $marks_7                 =       $_POST['o_marks7'];
       
       $status                  =       $_POST['status'];
 
       $final_total1              =       $_POST['final_total_1'];
       $final_total2              =       $_POST['final_total_2'];
       $final_total3              =       $_POST['final_total_3'];
       $final_total4              =       $_POST['final_total_4'];
       $final_total5              =       $_POST['final_total_5'];
       $final_total6              =       $_POST['final_total_6'];
       $final_total7              =       $_POST['final_total_7'];
       
      for($i=0; $i < count($student_id); $i++)
      {
            if($marks_1[$i] > $final_total1 || $marks_2[$i] > $final_total2 || $marks_3[$i] > $final_total3 || $marks_4[$i] > $final_total4 || $marks_5[$i] > $final_total5 || $marks_6[$i] > $final_total6 || $marks_7[$i] > $final_total7 )
            {
                 $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Obtained Marks should be less than total.');
                 redirect('examination/view_result_form');
            }
      } 
     // echo count($student_id);die;
      for($i=0; $i < count($student_id); $i++)
      {
          
                 
                        $final_result              =       array(                                                                
                                                                 'final_title_1'           => $title1,
                                                                 'final_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                                 'final_title_2'           => $title2,
                                                                 'final_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                                 'final_title_3'           => $title3,
                                                                 'final_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                                 'final_title_4'           => $title4,
                                                                 'final_value_4'           => str_replace('', 0, $marks_4[$i]),
                                                                 'final_title_5'           => $title5,
                                                                 'final_value_5'           => str_replace('', 0, $marks_5[$i]),
                                                                 'final_title_6'           => $title6,
                                                                 'final_value_6'           => str_replace('', 0, $marks_6[$i]),
                                                                 'final_title_7'           => $title7,
                                                                 'final_value_7'           => str_replace('', 0, $marks_7[$i]),
                                                                 'status'                  => $status[$i]
                                                                 );

                    
                                                   
                        $res          =   $this->Examination_model->UpdateFinalResult($final_result_id[$i],$final_result);
                        
                        if($res > 0){
                            
                            $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                                                               
                                        'course_id'             =>  $course_id,
                                        'student_id'            =>  $student_id[$i],
                                        'result_id'             =>  $final_result_id[$i],
                                        'result_type'           =>  'final',
                                        'edit_delete'           =>  1                                        
                                    );
                            
                            $log_id     =   $this->Examination_model->AddResultLog($log_data);
                        }
                        
                        
      }

// for updating the student gpa
      
      $this->calculate_save_std_gpa($campaign_id, $program_id, $semester);
      
       
            $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
            redirect('examination/view_result_form');
        
    }
    
     public function delete_final_result(){
        
        $this->login_check();
        
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6);
     
        $final_result_delete        =       array(
                                                    'campaign_id'         =>  $campaign_id,                                            
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester
                                            );
        
        $log_data          =       array(                                                                                                
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester,
                                                    'campaign_id'         =>  $campaign_id,
                                                    'edit_delete'         =>  2,
                                                    'result_type'         =>  'Final',
                                                    'operator_id'         =>   $this->session->userdata('sub_login_id')
                                                );
        
              
        $result                     =   $this->Examination_model->del_final_result($final_result_delete,$campaign_id,$program_id,$course_id,$semester);
        if($result){
            
            $log_id     =   $this->Examination_model->AddResultLog($log_data);
            
             $this->session->set_userdata('error_msg', 'Final Term Result Deleted Successfully');
             redirect('examination/view_result_form');
        }else{            
             $this->session->set_userdata('error_msg', 'Final Term Result Not Deleted,');
             redirect('examination/view_result_form');
        }
        
    }
    
    function post_final_result()
    {
        $this->login_check();
        
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);            
        $course_id                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6); 
        $status                     =   $this->uri->segment(7); 
     
        
        $data                       =       array(
                                                    'campaign_id'         =>  $campaign_id,                                            
                                                    'program_id'          =>  $program_id,
                                                    'course_id'           =>  $course_id,
                                                    'semester'            =>  $semester
                                            );
        
        $result                     =   $this->Examination_model->post_final_result($data,$status,$campaign_id,$program_id,$course_id,$semester);
        if($result){
            
             $this->session->set_userdata('error_msg', 'Final Term Result Posted Successfully');
             redirect('examination/view_result_form');
        }else{            
             $this->session->set_userdata('error_msg', 'Final Term Result Not Posted,');
             redirect('examination/view_result_form');
        }
    }
 
 
    public function search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info($roll_no);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('examination/search_result');
        }
       
        $this->load->view('examination/reports/resultcard',$result);
        
    }
    
    public function req_search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/req_search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function req_student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $semester               =   $_POST['semester'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info_req($roll_no,$semester);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('examination/req_search_result');
        }
       
        $this->load->view('examination/reports/req_resultcard',$result);
        
    }
    
    public function rang_search_result()
    {
        $this->login_check();
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/rang_search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function rang_student_result()
    {  
        $this->login_check();
        $roll_no                =   $_POST['roll_no'];
        $semester               =   $_POST['semester'];
        $result['print_type']   =   $_POST['print_type'];
        
        $result['info']       =   $this->Examination_model->get_std_info_rang($roll_no,$semester);
//        echo '<pre>';print_r($result);die;
        if(!$result['info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('examination/rang_search_result');
        }
       
        $this->load->view('examination/reports/rang_resultcard',$result);
        
    }
    
    public function upload_marks_form()
  {
      $this->login_check();
      
      $result['campaign']     = $this->Admin_model->getAllcampaigns2();  
      $result['programs'] = $this->Admin_model->getAllprograms();     

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/uploadMarksForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
    
  public function upload_marks()
  {
      $this->login_check();
      
      $data     =   array('campaign_id'=>$_POST['campaign'],'program_id'=>$_POST['program'],'semester'=>$_POST['semester']);
     
     if($_POST['exam_type'] == 'Mid'){ 
         $result        =   $this->Examination_model->uploadMidMarks($data);        
     }
     
     if($_POST['exam_type'] == 'Final'){
         $result        =   $this->Examination_model->uploadFinalMarks($data);        
     }
     
     if($result > 0){
            $this->session->set_userdata('error_msg', 'Result Uploaded.');
            redirect('examination/upload_marks_form');
     }else{
            $this->session->set_userdata('error_msg', 'Result Not Uploaded.');
            redirect('examination/upload_marks_form');
     }
    
  }  
    
    
    // *****   End   For Examination   ***** \\
    
  // -------- Examination Reports Start -------- \\
  
  
  // -------- Start Subject Report -------- \\  
  public function subject_wise_form()
  {
      $this->login_check();
      
      $result['campaign']     = $this->Admin_model->getAllcampaigns2();  
      $result['programs'] = $this->Admin_model->getAllprograms();     

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/reports/subjectwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
  public function subject_wise_report()
  {
      $this->login_check();      
     
      $campaign_id   = $_POST['campaign'];            
      $program_id    = $_POST['program'];
      $course_id     = $_POST['course'];
      $exam_type     = $_POST['exam_type'];
      $semester      = $_POST['semester'];
      
      
      $data                     =       array(
                                            'program_id'                =>  $program_id,
                                            'course_id'                 =>  $course_id
                                       );
      
      $result['campaign_id']   = $campaign_id;  
      $result['program_id']    = $program_id;
      $result['exam_type']     = $exam_type;
      $result['semester']      = $semester;
      $result['course_id']     = $course_id;
      
      if($exam_type == 'Mid'){
          
        $result['students']       =   $this->Examination_model->getStudentsMidResult($campaign_id,$program_id,$course_id,$semester);
        $result['structure']      =   $this->Examination_model->getMidStructure($data);
        $result['total']          =   $result['structure']->mid_value_1 + $result['structure']->mid_value_2 + $result['structure']->mid_value_3;
        
       // echo '<pre>';print_r($result['students']);die;
        
        $this->load->view('admin_ace/admin_header');      
        $this->load->view('examination/reports/subjectwiseViewMid', $result);
        $this->load->view('admin_ace/admin_footer');
        
      }else{
          
          $result['students']     =   $this->Examination_model->getStudentsFinalResult($campaign_id,$program_id,$course_id,$semester);
          
          // mid structure 
          $result['mid_structure']      =   $this->Examination_model->getMidStructure($data);
          $result['total']          =   $result['mid_structure']->mid_value_1 + $result['mid_structure']->mid_value_2 + $result['mid_structure']->mid_value_3;
          
          
          // final structure
          $result['structure']    =   $this->Examination_model->getFinalStructure($data);      
//          echo '<pre>';print_r($result['total']);die;
          

          $result['total']        =   100-$result['total'];
          
          // echo '<pre>';print_r($result['students']);die;
          
          $this->load->view('admin_ace/admin_header');      
          $this->load->view('examination/reports/subjectwiseViewFinal', $result);
          $this->load->view('admin_ace/admin_footer');

      }      
  }
  
  public function subject_wise_report_print()
  {
      $this->login_check();      
     
      $campaign_id   = $this->uri->segment(3);            
      $program_id    = $this->uri->segment(4);
      $course_id     = $this->uri->segment(5);
      $exam_type     = $this->uri->segment(6);
      $semester      = $this->uri->segment(7);
      
      
      $data                     =       array(
                                            'program_id'                =>  $program_id,
                                            'course_id'                 =>  $course_id
                                       );
      
      $result['exam_type']     = $exam_type;
      
      if($exam_type == 'Mid'){
          
        $result['students']       =   $this->Examination_model->getStudentsMidResult($campaign_id,$program_id,$course_id,$semester);
        $result['structure']      =   $this->Examination_model->getMidStructure($data);
        $result['total']          =   $result['structure']->mid_value_1 + $result['structure']->mid_value_2 + $result['structure']->mid_value_3;
        
       // echo '<pre>';print_r($result['students']);die;
            
        $this->load->view('examination/reports/subjectwiseViewMidPrint', $result);       
        
      }else{
          
          $result['students']     =   $this->Examination_model->getStudentsFinalResult($campaign_id,$program_id,$course_id,$semester);
          
        // mid structure 
          $result['mid_structure']      =   $this->Examination_model->getMidStructure($data);
          $result['total']          =   $result['mid_structure']->mid_value_1 + $result['mid_structure']->mid_value_2 + $result['mid_structure']->mid_value_3;
          
          
          // final structure
          $result['structure']    =   $this->Examination_model->getFinalStructure($data);      
//          echo '<pre>';print_r($result['total']);die;
          

          $result['total']        =   100-$result['total'];
          
          // echo '<pre>';print_r($result['students']);die;
             
          $this->load->view('examination/reports/subjectwiseViewFinalPrint', $result);         

      }
            
      
      
  }
  
   public function get_subjects()
  {
    
    $program_id   = $_POST['program_id'];
            
    $result['subject']  = $this->Examination_model->getSubjects($program_id);
    //echo '<pre>';print_r($result);die;
    $this->load->view('examination/partials/subjects', $result);      
        
  }
  
  // -------- End Subject Report -------- \\ 
   
  
    // -------- Start Class Report -------- \\  
  public function class_wise_form()
  {
      $this->login_check();
      
      $result['campaign']     = $this->Admin_model->getAllcampaigns2();   
      $result['programs'] = $this->Admin_model->getAllprograms();     

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/reports/classwiseForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
  public function class_wise_report()
  {
      $this->login_check();      
      
      $campaign_id   = $_POST['campaign'];      
      $program_id    = $_POST['program'];
      $exam_type     = $_POST['exam_type'];
      $semester      = $_POST['semester'];
      
      
      
       if($exam_type == 'Mid'){
                $result['students']       =   $this->Examination_model->classWiseMidReport($campaign_id,$program_id,$semester); 
//                echo '<pre>';print_r($result);die;
      }else{          
                $result['students']     =   $this->Examination_model->classWiseFinalReport($campaign_id,$program_id,$semester);
           }
           
      
      $result['campaign_id']     = $campaign_id;  
      $result['program_id']    = $program_id;
      $result['exam_type']     = $exam_type;
      $result['semester']      = $semester;
       
     
//      echo '<pre>';print_r($result['students']);die;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('examination/reports/classwiseView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  public function class_wise_report_print()
  {
      $this->login_check();      
      
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);                    
        $exam_type                  =   $this->uri->segment(5);  
        $semester                   =   $this->uri->segment(6);
      
      
       if($exam_type == 'Mid'){
                $result['students']       =   $this->Examination_model->classWiseMidReport($campaign_id,$program_id,$semester);                
      }else{          
                $result['students']     =   $this->Examination_model->classWiseFinalReport($campaign_id,$program_id,$semester);
           }
      
      $result['exam_type']    =  $exam_type;
       
     
     // echo '<pre>';print_r($result['students']);die;
           
      $this->load->view('examination/reports/classwiseViewPrint', $result);      
  }
  

  
  // -------- End Class Report -------- \\ 
  
  
  // >>>>>>>>>>>>>>>>>>>>>   Topper List For Semester    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<  //
  
  public function topper_form()
  {
      $this->login_check();
      
      $result['campaign']     = $this->Admin_model->getAllcampaigns2();   
      $result['programs'] = $this->Admin_model->getAllprograms();     

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/reports/TopperForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
   public function topperList(){
      $campaign_id  = $this->input->post('campaign');
      $program_id   = $this->input->post('program');
      $semester     = $this->input->post('semester');
      
      $students     =   $this->Examination_model->getTopperStudents($campaign_id,$program_id,$semester);
            
      //echo '<pre>'; print_r($students);die;
      
      foreach($students AS $key=>$row){
          
          $array[$key]      =   $this->Examination_model->getStdGpa($row['student_id'],$semester);
      }
      
      $sorted_array;
      for($j=0; $j < count($array); $j++){
          for($i = 0; $i < count($array)-1; $i ++){
         
                   if($array[$i]->gpa < $array[$i+1]->gpa) {
                                                    $temp = $array[$i+1];
                                                    $array[$i+1]=$array[$i];
                                                    $array[$i]=$temp;
                                                }    
          }
          
      }
      
     // echo '<pre>'; print_r($array);die;
      
      $result['toppers']    =   $array;
      $result['semester']   =   $semester;
      
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('examination/reports/TopperView', $result);
      $this->load->view('admin_ace/admin_footer');
    
  }
  
// >>>>>>>>>>>>>>>>>>>>>>>    Failure List   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //
  
   public function failure_form()
  {
      $this->login_check();
      
      $result['campaign']     = $this->Admin_model->getAllcampaigns2();   
      $result['programs'] = $this->Admin_model->getAllprograms();     

      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('examination/reports/FailureForm', $result);
      $this->load->view('admin_ace/admin_footer');
  }  
  
  public function failureList()
  {
      $this->login_check();      
      
      $campaign_id   = $_POST['campaign'];      
      $program_id    = $_POST['program'];
      $semester      = $_POST['semester'];
      
            
      $result['students']     =   $this->Examination_model->FailureReport($campaign_id,$program_id,$semester);
     
      $result['campaign_id']   = $campaign_id;  
      $result['program_id']    = $program_id;
      $result['semester']      = $semester;
       
     
//      echo '<pre>';print_r($result['students']);die;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('examination/reports/FailureView', $result);
      $this->load->view('admin_ace/admin_footer');
  }
  
  
   public function attendance_sheet_form()
    {
        
        $this->login_check();
      
        $result['campaign']     = $this->Admin_model->getAllcampaigns2();
        $result['program']    = $this->Admin_model->getAllprograms();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/attendance_sheet_form',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
   public function attendance_sheet()
    {
        
        $this->login_check();
      
        $result['campaign_id']          = $_POST['campaign'];
        $result['program_id']           = $_POST['program'];
        
        $result['students']   =   $this->Examination_model->getAttendanceInfo($_POST['campaign'],$_POST['program']);
        
//        echo '<pre>'; print_r($result);die;

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/attendance_sheet_view',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
   public function attendance_sheet_print()
    {
        
        $this->login_check();
      
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);
        
        $result['students']   =   $this->Examination_model->getAttendanceInfo($campaign_id,$program_id);
        
//        echo '<pre>'; print_r($result);die;

        $this->load->view('examination/reports/attendance_sheet_viewprint',$result);
      
    }
 
       
    
   public function award_list_form()
    {
        
        $this->login_check();
      
        $result['campaign']     = $this->Admin_model->getAllcampaigns2();
        $result['program']    = $this->Admin_model->getAllprograms();


        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/award_list_form',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
   public function award_list()
    {
        
        $this->login_check();
      
        $result['campaign_id']          = $_POST['campaign'];
        $result['program_id']           = $_POST['program'];
        
        $result['students']   =   $this->Examination_model->getAttendanceInfo($_POST['campaign'],$_POST['program']);
        
//        echo '<pre>'; print_r($result);die;

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/award_list_view',$result);
        $this->load->view('admin_ace/admin_footer');
      
    }
    
   public function award_list_print()
    {
        
        $this->login_check();
      
        $campaign_id                =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);
        
        $result['students']   =   $this->Examination_model->getAttendanceInfo($campaign_id,$program_id);
        
//        echo '<pre>'; print_r($result);die;

        $this->load->view('examination/reports/award_list_viewprint',$result);
      
    }
 
       
    
    // Computer Science Department Starts
    public function csclassreportform()
    {
        $this->login_check();
        $this->load->model('Manager_model');

        $emp_id                 = $this->session->userdata('employee_id');
        $emp_depart_id          = $this->Manager_model->getEmployeeDept( $emp_id );
        $emp_department_id      = $emp_depart_id[0]['department_id'];

        //$result['programms']    = $this->Admin_model->getAllprogramsHR($emp_department_id);
        $result['programms']    = $this->Admin_model->getAllprograms();
        $result['all_session']  = $this->Admin_model->getAllSessions();
        $result['all_batches']  = $this->Admin_model->getAllbatches();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/csclassreportform' ,$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function csclass_wise_report()
    {
      $this->login_check();      
      
        $this->load->model('Section_model');
        $this->login_check();      
     
        $session_id             = $_POST['all_session'];            
        $program_id             = $_POST['program'];
        $batch_id               = $_POST['batch'];
        $section                = $_POST['section'];
        
        $result['students']     =   $this->Section_model->classWiseFinalReport($session_id,$program_id,$batch_id,$section);
        
        $result['program_id']   = $program_id;
        $result['session_id']   = $session_id;
        $result['batch_id']     = $batch_id;
        $result['section']      = $section;

        $sessions               = $this->Admin_model->getSession($session_id);
        $result['session']      = $sessions;
        //echo '<pre>';var_dump($result['students']);die;

        $this->load->view('admin_ace/admin_header');      
        $this->load->view('examination/reports/csclasswiseView', $result);
        $this->load->view('admin_ace/admin_footer');
     
//      $this->load->view('admin_ace/admin_header');      
//      $this->load->view('examination/reports/classwiseView', $result);
//      $this->load->view('admin_ace/admin_footer');
  }
    
    
    // Computer Science Department Ends
   
  
  
  
  
 //*********************      RESULT REPORTS FOR CR STDUENTS    START        *******************************************//
 
  
  
   public function cr_search_result_all()
    {
        $this->login_check();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/cr_search_result');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function cr_student_result_all()
    {  
        $this->login_check();
                
        $roll_no                    =   $this->input->post('roll_no');
        $result['print_type']       =   $this->input->post('print_type');        
        $result['student_info']     =   $this->Examination_model->getStdInfo($roll_no);
//        echo '<pre>';print_r($result);die;
        
        $result['student_id']   =   $result['student_info']->student_id;
        $result['program_id']   =   $result['student_info']->program_id;
        $result['batch_id']     =   $result['student_info']->batch_id;
        
        $result['sessions']     =   $this->Examination_model->getSessions($result['student_info']->student_id);
        
        if(!$result['student_info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('examination/cr_search_result');
        }
       
        $this->load->view('examination/reports/cr_resultcard',$result);
        
    }
    
    
   public function cr_search_result_pass()
    {
        $this->login_check();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/reports/cr_search_result_pass');
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function cr_student_result_pass()
    {  
        $this->login_check();
                
        $roll_no                    =   $this->input->post('roll_no');
        $result['print_type']       =   $this->input->post('print_type');        
        $result['student_info']     =   $this->Examination_model->getStdInfo($roll_no);
      //  echo '<pre>';print_r($result);die;
        
        $result['student_id']   =   $result['student_info']->student_id;
        $result['program_id']   =   $result['student_info']->program_id;
        $result['batch_id']     =   $result['student_info']->batch_id;
        
        $result['sessions']     =   $this->Examination_model->getSessions($result['student_info']->student_id);
        //  echo '<pre>';print_r($result['sessions']);die;
        if(!$result['student_info']){            
            $this->session->set_userdata('error_msg', 'Result Not Found.');
            redirect('examination/cr_search_result_pass');
        }
       
        $this->load->view('examination/reports/cr_resultcard_pass',$result);
        
    }
    
    //***********************************************************                Edit Single Student Result For Cr
    
     public function res_search_form_cr()
    {
        $this->login_check();
        
        $result['sessions']   = $this->Admin_model->getAllSessions();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/search_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function edit_single_std_result_cr(){
        
        $this->login_check();
        
        $roll_no            =   $this->input->post('roll_no');
        $session_id         =   $this->input->post('session');
        $type               =   $this->input->post('type');
        
        $result['info']   = $this->Examination_model->getSessionResult($roll_no,$session_id,$type);
        
        //echo '<pre>';print_r($result);die;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/sem_courses',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
     public function edit_mid_res_form_cr()
    {
        $this->login_check();
        
        $course_id                      =   $this->uri->segment(3);
        $program_id                     =   $this->uri->segment(4);
        $section                        =   $this->uri->segment(5);
        $batch_id                       =   $this->uri->segment(6);
        $session_id                     =   $this->uri->segment(7);
        $student_id                     =   $this->uri->segment(8);
      
        
        $res                            =   $this->Examination_model->MidStruc($program_id,$course_id,$section,$batch_id,$session_id);
        $res2                            =   $this->Examination_model->MidRes($program_id,$course_id,$section,$batch_id,$session_id,$student_id);
        
//        echo '<pre>';print_r($res);
        

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/res_search_form_cr');
        }elseif(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term Result Not found.');
            redirect('examination/res_search_form_cr');
        }

        $result['mid_s']   =   $res;
        $result['mid_r']   =   $res2;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/edit_mid_res',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function update_mid_res_cr()
    {
         
       
       $this->login_check();
      
     
       $mid_result_id           =       $_POST['mid_result_id'];
       $student_id              =       $_POST['student_id'];
       $course_id               =       $_POST['course_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       $mid_total1              =       $_POST['mid_total_1'];
       $mid_total2              =       $_POST['mid_total_2'];
       $mid_total3              =       $_POST['mid_total_3'];
       
      
            if($marks_1 > $mid_total1 || $marks_2 > $mid_total2 || $marks_3 > $mid_total3)
            {
                 $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/res_search_form_cr');
            }
      
                                        $mid_result              =       array(                                          
                                                                              'mid_title_1'           => $title1,
                                                                              'mid_value_1'           => str_replace('', 0, $marks_1),
                                                                              'mid_title_2'           => $title2,
                                                                              'mid_value_2'           => str_replace('', 0, $marks_2),
                                                                              'mid_title_3'           => $title3,
                                                                              'mid_value_3'           => str_replace('', 0, $marks_3),
                                                                              'status'                => $status
                                                                              );

                                                  $update       =   $this->Examination_model->UpdateMidRes($mid_result,$student_id,$mid_result_id); 

                                                  if($update > 0){
                                                      
                                                          $log_array    =   array(
                                                             'student_id'       =>  $student_id,
                                                              'course_id'       =>  $course_id,
                                                              'result_id'       =>  $mid_result_id,
                                                              'result_type'     =>  'Mid',
                                                              'edit_delete'     =>  1,
                                                              'operator_id'     =>  $this->session->userdata('sub_login_id')
                                                          );
                                                          
                                                          $log_id       =   $this->Examination_model->addLog($log_array);
                                                          if($log_id){                                                      
                                                                    $this->session->set_userdata('error_msg', 'Mid Term Result Updated Successfully.');
                                                                    redirect('examination/res_search_form_cr');
                                                          }else{
                                                                    $this->session->set_userdata('error_msg', 'Mid Term Result Not Updated, please try again.');
                                                                    redirect('examination/res_search_form_cr');
                                                          }
                                                      }else{
                                                           $this->session->set_userdata('error_msg', 'Mid Term Result Not updated.');
                                                            redirect('examination/res_search_form_cr');    
                                                      }

                                      
      
    }
    
     public function edit_final_res_form_cr()
    {
        $this->login_check();
        
        $course_id                      =   $this->uri->segment(3);
        $program_id                     =   $this->uri->segment(4);
        $section                        =   $this->uri->segment(5);
        $batch_id                       =   $this->uri->segment(6);
        $session_id                     =   $this->uri->segment(7);
        $student_id                     =   $this->uri->segment(8);
      
        
        $res                            =   $this->Examination_model->FinalStruc($program_id,$course_id,$section,$batch_id,$session_id);
        $res2                            =   $this->Examination_model->FinalRes($program_id,$course_id,$section,$batch_id,$session_id,$student_id);
        
//        echo '<pre>';print_r($res);
        

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/res_search_form_cr');
        }elseif(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term Result Not found.');
            redirect('examination/res_search_form_cr');
        }

        $result['final_s']   =   $res;
        $result['final_r']   =   $res2;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/edit_final_res',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function update_final_res_cr()
    {
         
       
       $this->login_check();
      
     
       $final_result_id         =       $_POST['final_result_id'];
       $student_id              =       $_POST['student_id'];
       $course_id               =       $_POST['course_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       $title4                  =       $_POST['title4'];
       $title5                  =       $_POST['title5'];
       $title6                  =       $_POST['title6'];
       $title7                  =       $_POST['title7'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $marks_4                 =       $_POST['o_marks4'];
       $marks_5                 =       $_POST['o_marks5'];
       $marks_6                 =       $_POST['o_marks6'];
       $marks_7                 =       $_POST['o_marks7'];
       
       $status                  =       $_POST['status'];
 
       $final_total1              =       $_POST['final_total_1'];
       $final_total2              =       $_POST['final_total_2'];
       $final_total3              =       $_POST['final_total_3'];
       $final_total4              =       $_POST['final_total_4'];
       $final_total5              =       $_POST['final_total_5'];
       $final_total6              =       $_POST['final_total_6'];
       $final_total7              =       $_POST['final_total_7'];
       
      
            if($marks_1 > $final_total1 || $marks_2 > $final_total2 || $marks_3 > $final_total3 || $marks_4 > $final_total4 || $marks_5 > $final_total5 || $marks_6 > $final_total6 || $marks_7 > $final_total7)
            {
                 $this->session->set_userdata('error_msg', 'Final Term Result Not Updated, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/res_search_form_cr');
            }
      
                                        $final_result              =       array(                                          
                                                                              'final_title_1'           => $title1,
                                                                              'final_value_1'           => str_replace('', 0, $marks_1),
                                                                              'final_title_2'           => $title2,
                                                                              'final_value_2'           => str_replace('', 0, $marks_2),
                                                                              'final_title_3'           => $title3,
                                                                              'final_value_3'           => str_replace('', 0, $marks_3),
                                                                              'final_title_4'           => $title4,
                                                                              'final_value_4'           => str_replace('', 0, $marks_4),
                                                                              'final_title_5'           => $title5,
                                                                              'final_value_5'           => str_replace('', 0, $marks_5),
                                                                              'final_title_6'           => $title6,
                                                                              'final_value_6'           => str_replace('', 0, $marks_6),
                                                                              'final_title_7'           => $title7,
                                                                              'final_value_7'           => str_replace('', 0, $marks_7),
                                                                              'status'                => $status
                                                                              );

                                                  $update       =   $this->Examination_model->UpdateFinalRes($final_result,$student_id,$final_result_id); 

                                                  if($update > 0){
                                                      
                                                           $log_array    =   array(
                                                             'student_id'       =>  $student_id,
                                                              'course_id'       =>  $course_id,
                                                              'result_id'       =>  $final_result_id,
                                                              'result_type'     =>  'Final',
                                                              'edit_delete'     =>  1,
                                                              'operator_id'     =>  $this->session->userdata('sub_login_id')
                                                          );
                                                          
                                                          $log_id       =   $this->Examination_model->addLog($log_array);
                                                          if($log_id){                                                      
                                                                    $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
                                                                    redirect('examination/res_search_form_cr');
                                                          }else{
                                                                    $this->session->set_userdata('error_msg', 'Final Term Result Not Updated, please try again.');
                                                                    redirect('examination/res_search_form_cr');
                                                          }
                                                      
                                                          $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
                                                          redirect('examination/res_search_form_cr');
                                                      }else{
                                                           $this->session->set_userdata('error_msg', 'Final Term Result Not updated.');
                                                            redirect('examination/res_search_form_cr');    
                                                      }
      
    }
    


    //***********************************************************                Edit Single Student Result For Semester 
    
     public function res_search_form()
    {
        $this->login_check();
               
        $result['campaigns']     = $this->Admin_model->getAllcampaigns2();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/search_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function edit_single_std_result(){
        
        $this->login_check();
        
        $roll_no            =   $this->input->post('roll_no');
        $semester           =   $this->input->post('semester');
        $campaign_id        =   $this->input->post('campaign');
        $type               =   $this->input->post('type');
        
        $result['info']   = $this->Examination_model->getSessionResult_semester($roll_no,$semester,$campaign_id,$type);
        
//        echo '<pre>';print_r($result);die;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/sem_courses',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
     public function edit_mid_res_form()
    {
        $this->login_check();
        
        $course_id                      =   $this->uri->segment(3);
        $program_id                     =   $this->uri->segment(4);
        $semester                       =   $this->uri->segment(5);
        $student_id                     =   $this->uri->segment(6);
        $campaign_id                    =   $this->uri->segment(7);
      
        
        $res                            =   $this->Examination_model->MidStruc_semester($program_id,$course_id);
        $res2                            =   $this->Examination_model->MidRes_semester($program_id,$course_id,$semester,$student_id,$campaign_id);
        
        //echo '<pre>';print_r($res2);
        

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/res_search_form');
        }elseif(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term Result Not found.');
            redirect('examination/res_search_form');
        }

        $result['mid_s']   =   $res;
        $result['mid_r']   =   $res2;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_mid_res',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function update_mid_res()
    {
         
       
       $this->login_check();
      
     
       $mid_result_id           =       $_POST['mid_result_id'];
       $student_id              =       $_POST['student_id'];
       $course_id               =       $_POST['course_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       $mid_total1              =       $_POST['mid_total_1'];
       $mid_total2              =       $_POST['mid_total_2'];
       $mid_total3              =       $_POST['mid_total_3'];
       
      
            if($marks_1 > $mid_total1 || $marks_2 > $mid_total2 || $marks_3 > $mid_total3)
            {
                 $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/res_search_form');
            }
      
                                        $mid_result              =       array(                                          
                                                                              'mid_title_1'           => $title1,
                                                                              'mid_value_1'           => str_replace('', 0, $marks_1),
                                                                              'mid_title_2'           => $title2,
                                                                              'mid_value_2'           => str_replace('', 0, $marks_2),
                                                                              'mid_title_3'           => $title3,
                                                                              'mid_value_3'           => str_replace('', 0, $marks_3),
                                                                              'status'                => $status
                                                                              );

                                                  $update       =   $this->Examination_model->UpdateMidRes($mid_result,$student_id,$mid_result_id); 

                                                  if($update > 0){
                                                      
                                                          $log_array    =   array(
                                                             'student_id'       =>  $student_id,
                                                              'course_id'       =>  $course_id,
                                                              'result_id'       =>  $mid_result_id,
                                                              'result_type'     =>  'Mid',
                                                              'edit_delete'     =>  1,
                                                              'operator_id'     =>  $this->session->userdata('sub_login_id')
                                                          );
                                                          
                                                          $log_id       =   $this->Examination_model->addLog($log_array);
                                                          if($log_id){                                                      
                                                                    $this->session->set_userdata('error_msg', 'Mid Term Result Updated Successfully.');
                                                                    redirect('examination/res_search_form');
                                                          }else{
                                                                    $this->session->set_userdata('error_msg', 'Mid Term Result Not Updated, please try again.');
                                                                    redirect('examination/res_search_form');
                                                          }
                                                      }else{
                                                           $this->session->set_userdata('error_msg', 'Mid Term Result Not updated.');
                                                            redirect('examination/res_search_form');    
                                                      }

                                      
      
    }
    
     public function edit_final_res_form()
    {
        $this->login_check();
        
        $course_id                      =   $this->uri->segment(3);
        $program_id                     =   $this->uri->segment(4);
        $semester                       =   $this->uri->segment(5);
        $student_id                     =   $this->uri->segment(6);
        $campaign_id                    =   $this->uri->segment(7);
      
        
        $res                            =   $this->Examination_model->FinalStruc_semester($program_id,$course_id);
        $res2                            =   $this->Examination_model->FinalRes_semester($program_id,$course_id,$semester,$student_id,$campaign_id);
        
//        echo '<pre>';print_r($res);
        

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/res_search_form');
        }elseif(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term Result Not found.');
            redirect('examination/res_search_form');
        }

        $result['final_s']   =   $res;
        $result['final_r']   =   $res2;
        $result['semester']  =   $semester;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/edit_final_res',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function update_final_res()
    {
         
       $this->login_check();
      
       $final_result_id         =       $_POST['final_result_id'];
       $student_id              =       $_POST['student_id'];
       $course_id               =       $_POST['course_id'];
       $semester                =       $_POST['semester'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       $title4                  =       $_POST['title4'];
       $title5                  =       $_POST['title5'];
       $title6                  =       $_POST['title6'];
       $title7                  =       $_POST['title7'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $marks_4                 =       $_POST['o_marks4'];
       $marks_5                 =       $_POST['o_marks5'];
       $marks_6                 =       $_POST['o_marks6'];
       $marks_7                 =       $_POST['o_marks7'];
       
       $status                  =       $_POST['status'];
 
       $final_total1              =       $_POST['final_total_1'];
       $final_total2              =       $_POST['final_total_2'];
       $final_total3              =       $_POST['final_total_3'];
       $final_total4              =       $_POST['final_total_4'];
       $final_total5              =       $_POST['final_total_5'];
       $final_total6              =       $_POST['final_total_6'];
       $final_total7              =       $_POST['final_total_7'];
       
      
            if($marks_1 > $final_total1 || $marks_2 > $final_total2 || $marks_3 > $final_total3 || $marks_4 > $final_total4 || $marks_5 > $final_total5 || $marks_6 > $final_total6 || $marks_7 > $final_total7)
            {
                 $this->session->set_userdata('error_msg', 'Final Term Result Not Updated, Obtained Marks should be less than or Equal to total.');
                 redirect('examination/res_search_form');
            }
      
                                        $final_result              =       array(                                          
                                                                              'final_title_1'           => $title1,
                                                                              'final_value_1'           => str_replace('', 0, $marks_1),
                                                                              'final_title_2'           => $title2,
                                                                              'final_value_2'           => str_replace('', 0, $marks_2),
                                                                              'final_title_3'           => $title3,
                                                                              'final_value_3'           => str_replace('', 0, $marks_3),
                                                                              'final_title_4'           => $title4,
                                                                              'final_value_4'           => str_replace('', 0, $marks_4),
                                                                              'final_title_5'           => $title5,
                                                                              'final_value_5'           => str_replace('', 0, $marks_5),
                                                                              'final_title_6'           => $title6,
                                                                              'final_value_6'           => str_replace('', 0, $marks_6),
                                                                              'final_title_7'           => $title7,
                                                                              'final_value_7'           => str_replace('', 0, $marks_7),
                                                                              'status'                => $status
                                                                              );

                                                  $update       =   $this->Examination_model->UpdateFinalRes($final_result,$student_id,$final_result_id); 

                                                  if($update > 0){
                                                      
                                                            $this->calculate_save_std_gpa_std($semester,$student_id);
                                                      
                                                           $log_array    =   array(
                                                             'student_id'       =>  $student_id,
                                                              'course_id'       =>  $course_id,
                                                              'result_id'       =>  $final_result_id,
                                                              'result_type'     =>  'Final',
                                                              'edit_delete'     =>  1,
                                                              'operator_id'     =>  $this->session->userdata('sub_login_id')
                                                          );
                                                          
                                                          $log_id       =   $this->Examination_model->addLog($log_array);
                                                          if($log_id){                                                      
                                                                    $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
                                                                    redirect('examination/res_search_form');
                                                          }else{
                                                                    $this->session->set_userdata('error_msg', 'Final Term Result Not Updated, please try again.');
                                                                    redirect('examination/res_search_form');
                                                          }
                                                      
                                                          $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
                                                          redirect('examination/res_search_form');
                                                      }else{
                                                           $this->session->set_userdata('error_msg', 'Final Term Result Not updated.');
                                                            redirect('examination/res_search_form');    
                                                      }
      
    }
    






    //*********************      RESULT REPORTS FOR CR STDUENTS    END        *******************************************//
    
    
    
    
      //*********************    EDIT / DELETE CR RESULT SHEET START        *******************************************//
      
      // Start for result
    
     public function add_view_result_form_cr()
    {
        $this->login_check();
               
        $teacher_id             =   $this->session->userdata('sub_login_id');   
        $result['batches']      =   $this->Teachers_model->getAllbatches();
        $result['sessions']     =   $this->Teachers_model->getAllSessions();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/all_courses2_form',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function add_view_result_cr()
            {
              $this->login_check();

              $teacher_id             =   $this->session->userdata('sub_login_id');    
              $session_id             = $_REQUEST['session'];
              $batch_id               = $_REQUEST['batch'];
              $result['info']         = $this->Teachers_model->getAllocatedCourseSectionLatest($teacher_id,$session_id,$batch_id);

                $i = 0;
                foreach($result['info'] AS $row){

                    $check_data             =       array(
                                                         'teacher_id'            =>  $row['teacher_id'],
                                                         'program_id'            =>  $row['program_id'],
                                                         'course_id'             =>  $row['course_id'],
                                                         'section'               =>  $row['course_section']
                                                         //'semester'              =>  $row['semester']
                                                         );
                    $resmid          =   $this->Teachers_model->checkMidStructure($row['program_id'],$row['course_id'],$row['course_section']);
                    if($resmid){$result['mid'][$i] = 1;}else{$result['mid'][$i] = 0;}
                    $resfinal        =   $this->Teachers_model->checkFinalStructure($row['program_id'],$row['course_id'],$row['course_section']);
                    if($resfinal){$result['final'][$i] = 1;}else{$result['final'][$i] = 0;}

                    $i++;
                }
              
                
                $result['batch_id']     =   $batch_id;
                
//                echo '<pre>'; print_r($result);die;

              $this->load->view('admin_ace/admin_header');
              $this->load->view('admin_ace/examination_side_menu');
              $this->load->view('examination/cr/all_courses2',$result);
              $this->load->view('admin_ace/admin_footer');
            }
            
            
     public function view_mid_result_cr()
    {
        
        $this->login_check();
        $course_id                  =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);  
        $section                    =   $this->uri->segment(5);  
        $batch_id                   =   $this->uri->segment(6);  
        $current_session_id         =   $this->uri->segment(7); 

        $result['students']         =   $this->Teachers_model->getStudentCourseSection($program_id, $current_session_id, $section, $course_id, $batch_id);
        
//        echo '<pre>';
//        var_dump($result['students']);
//        echo '</pre>';
//        die;
        $result['session_id']       =   $current_session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        $result['section_id']       =   $section; 
                        
        $res_status                 =   $this->Teachers_model->getMidResStatus($program_id,$course_id,$section,$batch_id,$current_session_id); 
        $result['res_status']       =   $res_status->result_status;
        
        $res                        =   $this->Teachers_model->getMidStructure($program_id,$course_id,$section,$batch_id,$current_session_id);

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_view_result_form_cr');
        }

        $result['mid']   =   $res;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/mid_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
     public function edit_mid_result_cr()
    {
        
        $this->login_check();
        $program_id                     =   $this->uri->segment(3);            
        $course_id                      =   $this->uri->segment(4); 
        $section                        =   $this->uri->segment(5);         
        $session_id                     =   $this->uri->segment(6);
        $batch_id                       =   $this->uri->segment(7);

        $result['students']         =   $this->Teachers_model->getStudentCourseSection($program_id, $session_id, $section, $course_id,$batch_id);
        
//        echo '<pre>';
//        var_dump($result['students']);
//        echo '</pre>';
//        die;
        
        $result['session_id']       =   $session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        $result['section_id']       =   $section; 
                        
        $res_status                 =   $this->Teachers_model->getMidResStatus($program_id,$course_id,$section,$batch_id,$current_session_id); 
        $result['res_status']       =   $res_status->result_status;
        
        $res                        =   $this->Teachers_model->getMidStructure($program_id,$course_id,$section,$batch_id,$current_session_id);

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_view_result_form_cr');
        }

        $result['mid']   =   $res;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/mid_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
     public function update_mid_result_cr()
    {
       $this->login_check();
      
       $session_id              =       $_POST['session_id'];
       $batch_id                =       $_POST['batch_id'];
       $course_id               =       $_POST['course_id'];
       $program_id              =       $_POST['program_id'];
//       $semester                =       $_POST['semester'];
       $course_section          =       $_POST['course_section'];
//       $teacher_id              =       $this->session->userdata('sub_login_id');
       
       $student_id              =       $_POST['student_id'];
       $mid_result_id           =       $_POST['mid_result_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       
      
      $total_stus              =       count($student_id);
            
       
      for($i=0; $i < $total_stus; $i++)
      {
                $mid_result              =       array(                                                                                               
                                                    'mid_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                    'mid_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                    'mid_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                    'status'                => $status[$i]
                                                    );
               // echo $mid_result_id[$i].'<pre>'; print_r($mid_result);die;
                    
               $mid                    =   $this->Teachers_model->UpdateMidResult($mid_result,$mid_result_id[$i]);
               if($mid > 0){
                            
                             $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                                                               
                                        'course_id'             =>  $course_id,
                                        'student_id'            =>  $student_id[$i],
                                        'result_id'             =>  $mid_result_id[$i],
                                        'result_type'           =>  'mid',
                                        'edit_delete'           =>  1                                        
                                    );
                             
                            $log_id     =   $this->Examination_model->AddResultLog($log_data);
                        }
                        
                                        
      }
      
            $this->session->set_userdata('error_msg', 'Mid Term Result Updated Successfully.');
            redirect('examination/add_view_result_form_cr');      
      
    }
    
    
    // ************* For update, delete and post mid result
    
   
    public function delete_mid_result_cr(){
        
        $this->login_check();
        
        $program_id                     =   $this->uri->segment(3);            
        $course_id                      =   $this->uri->segment(4); 
        $section                        =   $this->uri->segment(5);         
        $session_id                     =   $this->uri->segment(6);
        $batch_id                       =   $this->uri->segment(7);
     
        
        $data                       =       array(
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $section,
                                                    'session_id'            =>  $session_id,
                                                    'batch_id'              =>  $batch_id
                                            );
        
        
        $log_data                       =       array(
                                                    'operator_id'           =>  $this->session->userdata('sub_login_id'),                                             
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $section,
                                                    'session_id'            =>  $session_id,
                                                    'result_type'           =>  'mid',
                                                    'edit_delete'           =>  2
                                            );
        
        
        $result                     =   $this->Teachers_model->del_mid_result($program_id,$course_id,$section,$session_id,$batch_id,$log_data);
        if($result){
            
             $this->session->set_userdata('error_msg', 'Mid Term Result Deleted Successfully');
             redirect('examination/add_view_result_form_cr');
        }else{            
             $this->session->set_userdata('error_msg', 'Mid Term Result Not Deleted,');
             redirect('examination/add_view_result_form_cr');
        }
        
    }
    
    
    
     public function view_final_result_cr()
    {
       
         
        $this->login_check();
        $course_id                  =   $this->uri->segment(3);  
        $program_id                 =   $this->uri->segment(4);  
        $section                    =   $this->uri->segment(5);  
        $batch_id                   =   $this->uri->segment(6);  
        $current_session_id         =   $this->uri->segment(7); 

        $result['students']         =   $this->Teachers_model->getStudentCourseSection($program_id, $current_session_id, $section, $course_id,$batch_id);
        
        //echo '<pre>';
        //var_dump($result);
        //echo '</pre>';die;
        
        $result['session_id']       =   $current_session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        $result['section_id']       =   $section; 
        
       $res_status                 =   $this->Teachers_model->getFinalResStatus($program_id,$course_id,$section,$batch_id,$current_session_id); 
        $result['res_status']       =   $res_status->result_status;
        
        $res                        =   $this->Teachers_model->getFinalStructure($program_id,$course_id,$section,$batch_id,$current_session_id);

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_view_result_form_cr');
        }

        $result['final']   =   $res;
       
        //echo '<pre>';var_dump($result['students']   );echo '</pre>';die;
        
       $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/final_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
 
    // ********* for update,delete and post final result
    
   
     public function edit_final_result_cr()
    {
       
         
        $this->login_check();
         $program_id                     =   $this->uri->segment(3);            
        $course_id                      =   $this->uri->segment(4); 
        $section                        =   $this->uri->segment(5);         
        $session_id                     =   $this->uri->segment(6);
        $batch_id                       =   $this->uri->segment(7);

        $result['students']         =   $this->Teachers_model->getStudentCourseSection($program_id, $session_id, $section, $course_id,$batch_id);
        
        //echo '<pre>';
        //var_dump($result);
        //echo '</pre>';die;
        
        $result['session_id']       =   $session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        $result['section_id']       =   $section; 
        
       $res_status                 =   $this->Teachers_model->getFinalResStatus($program_id,$course_id,$section,$batch_id,$current_session_id); 
        $result['res_status']       =   $res_status->result_status;
        
        $res                        =   $this->Teachers_model->getFinalStructure($program_id,$course_id,$section,$batch_id,$current_session_id);

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('examination/add_view_result_form_cr');
        }

        $result['final']   =   $res;
       
        //echo '<pre>';var_dump($result['students']   );echo '</pre>';die;
        
       $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('examination/cr/final_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
 
    
    public function update_final_result_cr()
    {
        
        $this->login_check();

        $session_id              =       $_POST['session_id'];              
        $batch_id                =       $_POST['batch_id'];              
        $course_id               =       $_POST['course_id'];       
        $program_id              =       $_POST['program_id'];
        //$semester                =       $_POST['semester'];       
        $course_section          =       $_POST['course_section'];       
        //$teacher_id              =       $this->session->userdata('sub_login_id');
       
        $student_id              =       $_POST['student_id'];
        $final_result_id         =       $_POST['final_result_id'];

        $title1                  =       $_POST['title1'];
        $title2                  =       $_POST['title2'];
        $title3                  =       $_POST['title3'];
        $title4                  =       $_POST['title4'];
        $title5                  =       $_POST['title5'];
        $title6                  =       $_POST['title6'];
        $title7                  =       $_POST['title7'];
       
        $marks_1                 =       $_POST['o_marks1'];
        $marks_2                 =       $_POST['o_marks2'];
        $marks_3                 =       $_POST['o_marks3'];
        $marks_4                 =       $_POST['o_marks4'];
        $marks_5                 =       $_POST['o_marks5'];
        $marks_6                 =       $_POST['o_marks6'];
        $marks_7                 =       $_POST['o_marks7'];

        $status                  =       $_POST['status'];
       
        
        //$total = count($_POST);
        //for($i=0; $i < $total; $i++)
        foreach($student_id as $i => $p)
        {
            
                 $final_result              =       array(                                                                                                                               
                                                                 'final_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                                 'final_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                                 'final_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                                 'final_value_4'           => str_replace('', 0, $marks_4[$i]),
                                                                 'final_value_5'           => str_replace('', 0, $marks_5[$i]),
                                                                 'final_value_6'           => str_replace('', 0, $marks_6[$i]),
                                                                 'final_value_7'           => str_replace('', 0, $marks_7[$i]),
                                                                 'status'                  => $status[$i],                                                                 
                                                                 );
                    
                    
                        $final         =   $this->Teachers_model->UpdateFinalResult($final_result_id[$i],$final_result);
                        
                        if($final > 0){
                            
                            $log_data   =   array(
                                        'operator_id'           => $this->session->userdata('sub_login_id'),                                                                               
                                        'course_id'             =>  $course_id,
                                        'student_id'            =>  $student_id[$i],
                                        'result_id'             =>  $final_result_id[$i],
                                        'result_type'           =>  'final',
                                        'edit_delete'           =>  1                                        
                                    );
                            
                            $log_id     =   $this->Examination_model->AddResultLog($log_data);
                        }
                        
                        
      }
      
       
            $this->session->set_userdata('error_msg', 'Final Term Result Updated Successfully.');
            redirect('examination/add_view_result_form_cr');
        
    }
    // ********* for update,delete and post final result
    
   
    
    public function delete_final_result_cr(){
        
         $this->login_check();
        
        $program_id                     =   $this->uri->segment(3);            
        $course_id                      =   $this->uri->segment(4); 
        $section                        =   $this->uri->segment(5);         
        $session_id                     =   $this->uri->segment(6);
        $batch_id                       =   $this->uri->segment(7);
     
        
        $data                       =       array(
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $section,
                                                    'session_id'            =>  $session_id,
                                                    'batch_id'              =>  $batch_id
                                            );
        
        
        $log_data                       =       array(
                                                    'operator_id'           =>  $this->session->userdata('sub_login_id'),                                             
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $section,
                                                    'session_id'            =>  $session_id,
                                                    'result_type'           =>  'Final',
                                                    'edit_delete'           =>  2
                                            );
        
        
        $result                     =   $this->Teachers_model->del_final_result($program_id,$course_id,$section,$session_id,$batch_id,$log_data);
        if($result){
            
             $this->session->set_userdata('error_msg', 'Final Term Result Deleted Successfully');
             redirect('examination/add_view_result_form_cr');
        }else{            
             $this->session->set_userdata('error_msg', 'Final Term Result Not Deleted,');
             redirect('examination/add_view_result_form_cr');
        }
        
    }
    
    //******************  Class summary report for CR  START ****************************************//
    
        public function class_wise_form_cr()
                {
                    $this->login_check();

                    $result['batches']      =   $this->Teachers_model->getAllbatches();
                    $result['sessions']     =   $this->Teachers_model->getAllSessions();

                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/examination_side_menu');
                    $this->load->view('examination/cr/classwiseForm1',$result);
                    $this->load->view('admin_ace/admin_footer');
                }  

        public function all_classes_view_cr()
              {
                    $this->login_check();

                    $teacher_id             =   $this->session->userdata('sub_login_id');    
                    $session_id             = $_REQUEST['session'];
                    $batch_id               = $_REQUEST['batch'];
                    $result['info']         = $this->Teachers_model->getAllocatedCourseSectionLatest2($teacher_id,$session_id,$batch_id);

//                    echo '<pre>'; print_r($result['info']);die;
                    
                      $i = 0;
                      foreach($result['info'] AS $row){

                          $check_data             =       array(
                                                               'teacher_id'            =>  $row['teacher_id'],
                                                               'program_id'            =>  $row['program_id'],
                                                               'course_id'             =>  $row['course_id'],
                                                               'section'               =>  $row['course_section']
                                                               //'semester'              =>  $row['semester']
                                                               );
                          $resmid          =   $this->Teachers_model->checkMidStructure($row['program_id'],$row['course_id'],$row['course_section']);
                          if($resmid){$result['mid'][$i] = 1;}else{$result['mid'][$i] = 0;}
                          $resfinal        =   $this->Teachers_model->checkFinalStructure($row['program_id'],$row['course_id'],$row['course_section']);
                          if($resfinal){$result['final'][$i] = 1;}else{$result['final'][$i] = 0;}

                          $i++;
                      }


                      $result['batch_id']     =   $batch_id;

      //                echo '<pre>'; print_r($result);die;

                    $this->load->view('admin_ace/admin_header');
                    $this->load->view('admin_ace/examination_side_menu');
                    $this->load->view('examination/cr/classwiseForm2',$result);
                    $this->load->view('admin_ace/admin_footer');
            }
            
    Public function view_mid_result_summary_cr(){
         
        $this->login_check();
        
        $program_id                 =   $this->uri->segment(3);  
        $section                    =   $this->uri->segment(4);  
        $batch_id                   =   $this->uri->segment(5);  
        $session_id                 =   $this->uri->segment(6); 
        
        $result['students']         =   $this->Examination_model->classWiseMidReport_cr($program_id,$section,$batch_id,$session_id); 
        
      
        //$result['course_id']        = $course_id;  
        $result['program_id']       = $program_id;
        $result['section']          = $section;
        $result['session_id']       = $session_id;
        $result['batch_id']         = $batch_id;
       
     
      //echo '<pre>';print_r($result['students']);die;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('examination/cr/classwiseMidView', $result);
      $this->load->view('admin_ace/admin_footer');
        
    }
    
    Public function view_mid_result_summary_cr_print(){
         
        $this->login_check();
        
        $program_id                 =   $this->uri->segment(3);  
        $section                    =   $this->uri->segment(4);  
        $batch_id                   =   $this->uri->segment(5);  
        $session_id                 =   $this->uri->segment(6); 
        
        $result['students']         =   $this->Examination_model->classWiseMidReport_cr($program_id,$section,$batch_id,$session_id); 
        
      
        //$result['course_id']        = $course_id;  
        $result['program_id']       = $program_id;
        $result['section']          = $section;
        $result['session_id']       = $session_id;
        $result['batch_id']         = $batch_id;
       
     
          
      $this->load->view('examination/cr/classwiseMidViewPrint', $result);
     
        
    }
    
    Public function view_final_result_summary_cr(){
         
        $this->login_check();
        
        $program_id                 =   $this->uri->segment(3);  
        $section                    =   $this->uri->segment(4);  
        $batch_id                   =   $this->uri->segment(5);  
        $session_id                 =   $this->uri->segment(6); 
        
        $result['students']         =   $this->Examination_model->classWiseFinalReport_cr($program_id,$section,$batch_id,$session_id); 
        
        // for getting total structure marks
        
        
        
        //$result['course_id']        = $course_id;  
        $result['program_id']       = $program_id;
        $result['section']          = $section;
        $result['session_id']       = $session_id;
        $result['batch_id']         = $batch_id;
       
     
      //echo '<pre>';print_r($result['students']);die;
     
      $this->load->view('admin_ace/admin_header');      
      $this->load->view('examination/cr/classwiseFinalView', $result);
      $this->load->view('admin_ace/admin_footer');
        
    }
    
    Public function view_final_result_summary_cr_print(){
         
        $this->login_check();
        
        $program_id                 =   $this->uri->segment(3);  
        $section                    =   $this->uri->segment(4);  
        $batch_id                   =   $this->uri->segment(5);  
        $session_id                 =   $this->uri->segment(6); 
        
        $result['students']         =   $this->Examination_model->classWiseFinalReport_cr($program_id,$section,$batch_id,$session_id); 
        
         
        //$result['course_id']        = $course_id;  
        $result['program_id']       = $program_id;
        $result['section']          = $section;
        $result['session_id']       = $session_id;
        $result['batch_id']         = $batch_id;
       
     
      //echo '<pre>';print_r($result['students']);die;
     
      $this->load->view('examination/cr/classwiseFinalViewPrint', $result);
     
        
    }
    
    
    
    
    //******************  Class summary report for CR  END ****************************************//
    
      //*********************    EDIT / DELETE CR RESULT SHEET END        *******************************************//
  
  
  
  
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */