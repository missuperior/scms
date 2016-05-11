<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class teachers extends CI_Controller {

    public function __construct() {

    parent::__construct();


    $this->load->model('Teachers2_model');
    $this->load->model('Course_model');
    $this->load->model('Admin_model');
    
    $this->load->library('session');
    $this->load->library('encrypt');

    // for form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  public function index(){
      die('Welcome To :)');
  }
 
 public function login_check() {

    if ($this->session->userdata('sub_login_id') == '' && $this->session->userdata('sub_login') == '') {
      redirect('examination');
    }
  }
  
  
    
    // *****   Start For Examination   ***** \\
    
    public function all_courses_form()
    {
        $this->login_check();
        $result['batches']      =   $this->Teachers2_model->getAllbatches();
        $result['sessions']     =   $this->Teachers2_model->getAllSessions();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/all_courses_form',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    
    public function all_courses()
    {

        $this->login_check();
      
        if(empty($_POST['session'])){
            $this->session->set_userdata('error_msg', 'Select Session and Batch First.');redirect('teachers/all_courses_form');
        }

        $session_id             = $_POST['session'];
        $batch_id               = $_POST['batch'];
        $result['info']         = $this->Teachers2_model->getAllocatedCourseSectionLatest($session_id,$batch_id);
	
//        echo '<pre>'; print_r($result['info']);die;


        foreach($result['info'] as $kk =>  $row){
            $check_data             =  array(
                                        'teacher_id'            =>  $row['teacher_id'],
                                        'program_id'            =>  $row['program_id'],
                                        'course_id'             =>  $row['course_id'],
                                        'section'               =>  $row['course_section'],
                                        'batch_id'              =>  $row['batch_id'],
                                        'session_id'            =>  $row['current_session_id']
                                    );
            
            
            $resmid                 =   $this->Teachers2_model->checkMidStructure($check_data);
//            $resmid                 =   $this->Teachers2_model->checkMidStructure($check_data);
            $result['mid'][$kk]     = !(empty($resmid)) ? 1 : 0; 
            
            $resfinal               =   $this->Teachers2_model->checkFinalStructure($check_data);
            $result['final'][$kk]   = !(empty($resfinal)) ? 1 : 0; 
        }
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/all_courses',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function define_mid_structure_form()
    {
       $this->login_check();
      $teacher_id             =       $this->session->userdata('sub_login_id');
       
       // check whether this is the course of teacher or not
       $teacher_course_arr          =   $this->Teachers2_model->checkteacher_course($_GET['teacher_id'],$_GET['course_id'],$_GET['course_section'],$_GET['batch_id'],$_GET['program_id'],$_GET['session_id']);
       if($teacher_course_arr == 0){
           $this->session->set_userdata('error_msg', 'This Course Does not belongs to you.');redirect('teachers/all_courses_form');
       }else{
            $result['course_section']         =       $_GET['course_section'];
            $result['semester']               =       $_GET['semester'];
            $result['program_id']             =       $_GET['program_id'];
            $result['course_id']              =       $_GET['course_id'];
            $result['teacher_id']             =       $_GET['teacher_id'];
            $result['batch_id']               =       $_GET['batch_id'];
            $result['session_id']             =       $_GET['session_id'];
            

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/examination_side_menu');
            $this->load->view('teachers/examination/define_midstructure',$result);
            $this->load->view('admin_ace/admin_footer');
       }
    }
    
    public function define_mid_structure()
    {
        $this->login_check();
      
       $course_section         =       $_POST['course_section'];
       $semester               =       $_POST['semester'];
       $program_id             =       $_POST['program_id'];
       $course_id              =       $_POST['course_id'];
       $batch_id               =       $_POST['batch_id'];
       $session_id             =       $_POST['session_id'];
       $teacher_id             =       $_POST['teacher_id'];
       
       // check duplicate entry 
              
       $check_data             =       array(
                                            'teacher_id'            =>  $teacher_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'section'               =>  $course_section,
                                            'batch_id'              =>  $batch_id,
                                            'session_id'            =>  $session_id
                                            );
       
       $res                    =   $this->Teachers2_model->checkMidStructure($check_data);
       if($res){
           
                $this->session->set_userdata('error_msg', 'Structure of this Course Already Defined.');
                 redirect('teachers/all_courses');
           
       }else{
       
            $title                  =       array_values(array_filter($_POST['title']));
            $marks                  =       array_values(array_filter($_POST['marks']));
            
            
            
            $percent_title1         =       $_POST['percent_title1'];
            
            if(!empty($percent_title1)){
                $percent_marks      = $percent_title1;
            }
            if(!empty($percent_title2)){
                $percent_marks      = $percent_title2;
            }
            if(!empty($percent_title3)){
                $percent_marks      = $percent_title3;
            }
            
            
            //$percent_marks          = $percent_title1;

     //              print_r($marks);die;

            if((count($title) != count($marks)) || count($title) == 0 )
            {
                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                 redirect('teachers/define_mid_structure_form/?teacher_id='.$teacher_id.'&course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section);
            }

                        
            $mid_data            =   array(
                                         'teacher_id'            =>  $teacher_id,
                                         'program_id'            =>  $program_id,
                                         'course_id'             =>  $course_id,
                                         'section'               =>  $course_section,
                                         'semester'              =>  $semester,
                                         'mid_title_1'           => $title[0],
                                         'mid_value_1'           => str_replace('', 0, $marks[0]),
                                         'mid_title_2'           => $title[1],
                                         'mid_value_2'           => str_replace('', 0, $marks[1]),
                                         'mid_title_3'           => $title[2],
                                         'mid_value_3'           => str_replace('', 0, $marks[2]),
                                         'created_date'          => date('Y-m-d'),
                                         'batch_id'              =>  $batch_id,
                                         'session_id'            =>  $session_id,
                                         'operator_id'           =>  $this->session->userdata('sub_login_id')
                                     );

             $result                 =   $this->Teachers2_model->addMidStructure($mid_data);

             if($result){
                                  
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Added Successfully');
                          redirect('teachers/all_courses_form');
             }else{
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Not Added Successfully');
                         redirect('teachers/all_courses_form');
             }
       }
        
    }
    
    // view mid strtucture
    
    public function view_mid_structure()
    {
        $this->login_check();
        
        $course_section         =       $_GET['course_section'];
        $semester               =       $_GET['semester'];
        $program_id             =       $_GET['program_id'];
        $course_id              =       $_GET['course_id'];
        $session_id             =       $_GET['session_id'];
        $batch_id               =       $_GET['batch_id'];
        $teacher_id             =       $_GET['teacher_id'];

        // check duplicate entry 

        $check_data             =       array(
                                             'teacher_id'            =>  $teacher_id,
                                             'program_id'            =>  $program_id,
                                             'course_id'             =>  $course_id,
                                             'section'               =>  $course_section,
                                             'batch_id'              =>  $batch_id,
                                             'session_id'            =>  $session_id
                                             );

        $result['mid']          =   $this->Teachers2_model->getMidStructure($check_data);
       
       
       // check if final structre define then edit in mid structure is not allowed
       
       $res                    =   $this->Teachers2_model->checkFinalStructure($check_data);
       $result['check_final']  =   count($res);
//       echo '<pre>';
//       var_dump($result['check_final']);
//       exit;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/view_midstructure',$result);
        $this->load->view('admin_ace/admin_footer');
       
        //echo '<pre>';//       var_dump($res);die;
        
    }
    
    
    public function edit_mid_structure()
    {
        $this->login_check();
      
        $mid_structure_id         =       $_GET['mid_structure_id'];
        
        $result['mid']            =       $this->Teachers2_model->MidStructure($mid_structure_id);
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/edit_midstructure',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    
    // needs to check
    public function update_mid_structure()
    {
        $this->login_check();
      
       $mid_course_id          =       $_POST['mid_structure_id'];
       
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));

     //              echo '<pre>';
     //              print_r($title);
     //              echo '<pre>';
     //              print_r($marks);die;

            if((count($title) != count($marks)) || count($title) == 0 )
            {
                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                 redirect('teachers/edit_mid_structure/?mid_structure_id='.$mid_course_id);
            }

                        
            $mid_data            =   array(                                        
                                         'mid_title_1'           => $title[0],
                                         'mid_value_1'           => str_replace('', 0, $marks[0]),
                                         'mid_title_2'           => $title[1],
                                         'mid_value_2'           => str_replace('', 0, $marks[1]),
                                         'mid_title_3'           => $title[2],
                                         'mid_value_3'           => str_replace('', 0, $marks[2])
                                     );

             $result                 =   $this->Teachers2_model->updateMidStructure($mid_course_id,$mid_data);

             if($result){
                                  
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Updated Successfully');
                          redirect('teachers/all_courses_form');
             }else{
                         $this->session->set_userdata('error_msg', 'Mid Term Structure Not Updated Successfully');
                         redirect('teachers/edit_mid_structure/?mid_structure_id='.$mid_course_id);
             }
      
    }
    
    
    public function define_final_structure_form()
    {
        $this->login_check();
      
        $result['course_section']         =       $_GET['course_section'];
        $result['semester']               =       $_GET['semester'];
        $result['program_id']             =       $_GET['program_id'];
        $result['course_id']              =       $_GET['course_id'];
        $result['session_id']             =       $_GET['session_id'];
        $result['batch_id']               =       $_GET['batch_id'];        
        $result['teacher_id']             =       $_GET['teacher_id'];
        
        
        $result['credit_hours']           =       $_GET['crh'];
//        echo '<prE>';
//        var_dump($_GET);die;
        //if lab skip 
        $result['course_type']            =       $_GET['ctp'];
        
        
        if($result['course_type'] =! 'Lab' or $_GET['crh'] != '1'){
            $res                              =       $this->Teachers2_model->getMidTotalMarksLatest($_GET['teacher_id'],$_GET['course_section'],$_GET['program_id'],$_GET['semester'],$_GET['course_id'],$_GET['session_id'],$_GET['batch_id']);
            $result['mid_total']              =       $res->mid_total;
            if($result['mid_total'] == '')
            {
                $this->session->set_userdata('error_msg', 'First Defined Mid Term Structure then you can add Final Term Structure');
                redirect('teachers/all_courses_form');
            }
        }
       
        $result['course_type']    = $_GET['crh'] == '1' ? 'Lab' : $_GET['ctp'];
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/define_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    public function define_final_structure()
    {
       
        
        
        $this->login_check();
      
       $course_section         =       $_POST['course_section'];
       $semester               =       $_POST['semester'];
       $program_id             =       $_POST['program_id'];
       $course_id              =       $_POST['course_id'];
       $teacher_id             =       $_POST['teacher_id'];
       
       $batch_id               =       $_POST['batch_id'];
       $session_id             =       $_POST['session_id'];
       
       $course_type            =       $_POST['course_type'];
       $credit_hours           =       $_POST['credit_hours'];
       
       $final_total_marks      =       $_POST['final_marks'];
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));
       
//       if(array_sum($marks) > $final_total_marks || array_sum($marks) < $final_total_marks )
//       {
//           $this->session->set_userdata('error_msg', 'Final Term Marks Should  be '.$final_total_marks);
//           redirect('teachers/define_final_structure_form/?course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section.'&batch_id='.$batch_id.'&session_id='.$session_id);
//       }else{
       
                // check duplicate entry 

                $check_data             =       array(
                                                     'teacher_id'            =>  $teacher_id,
                                                     'program_id'            =>  $program_id,
                                                     'course_id'             =>  $course_id,
                                                     'section'               =>  $course_section,
                                                     'semester'              =>  $semester,
                                                     'batch_id'              =>  $batch_id,
                                                     'session_id'            =>  $session_id
                                                     );

                $res                    =   $this->Teachers2_model->checkFinalStructure($check_data);
                if($res){

                         $this->session->set_userdata('error_msg', 'Structure of this Course Already Defined.');
                          redirect('teachers/all_courses_form');

                }else{       

                         if($course_type != 'Lab' ||  $credit_hours != 1 ){
                             
                            if((count($title) != count($marks)) || count($title) == 0 )
                            {

//                               echo '<pre>';
//                               var_dump($_POST);die;

                                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                                 redirect('teachers/define_final_structure_form/?teacher_id='.$teacher_id.'&course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section);
                            }
                         }
                         

                         $final_data            =   array(
                                                      'teacher_id'              =>  $teacher_id,
                                                      'program_id'              =>  $program_id,
                                                      'course_id'               =>  $course_id,
                                                      'section'                 =>  $course_section,
                                                      'semester'                =>  $semester,
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
                                                      'created_date'            => date('Y-m-d'),
                                                      'batch_id'                =>  $batch_id,
                                                      'session_id'              =>  $session_id,
                                                      'operator_id'             =>  $this->session->userdata('sub_login_id')
                                                  );

                          $result                 =   $this->Teachers2_model->addFinalStructure($final_data);

                          if($result){
                                      $this->session->set_userdata('error_msg', 'Final Term Structure Added Successfully');
                                      redirect('teachers/all_courses_form');
                          }else{
                                      $this->session->set_userdata('error_msg', 'Final Term Structure Not Added Successfully');
                                      redirect('teachers/all_courses_form');
                          }
                //}
       }
        
    }
    
    
     // view mid strtucture
    
    public function view_final_structure()
    {
        $this->login_check();
      
        
       $course_section         =       $_GET['course_section'];
       $semester               =       $_GET['semester'];
       $program_id             =       $_GET['program_id'];
       $course_id              =       $_GET['course_id'];
       $session_id             =       $_GET['session_id'];
       $batch_id               =       $_GET['batch_id'];
       $teacher_id             =       $_GET['teacher_id'];
       
       // check duplicate entry 
       
       $check_data             =     array(
                                        'teacher_id'            =>  $teacher_id,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'section'               =>  $course_section,
                                        'session_id'            =>  $session_id,
                                        'batch_id'              =>  $batch_id
                                        //'semester'              =>  $semester
                                    );
       
       $result['final']        =   $this->Teachers2_model->getFianlStructure($check_data);
              
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/view_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    public function edit_final_structure()
    {
        $this->login_check();
      
        $final_structure_id         =       $_GET['final_structure_id'];
        $result['final']            =       $this->Teachers2_model->FinalStructure($final_structure_id);
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/edit_finalstructure',$result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function update_final_structure()
    {
        $this->login_check();
      
       $final_course_id        =       $_POST['final_structure_id'];
       $title                  =       array_values(array_filter($_POST['title']));
       $marks                  =       array_values(array_filter($_POST['marks']));

     //              echo '<pre>';
     //              print_r($title);
     //              echo '<pre>';
     //              print_r($marks);die;

            if((count($title) != count($marks)) || count($title) == 0 )
            {
                 $this->session->set_userdata('error_msg', 'Please Fill Title and Marks Equally');
                 redirect('teachers/edit_final_structure/?final_structure_id='.$final_course_id);
            }
            if( array_sum($marks) != $_POST['final_total'] )
            {
                $this->session->set_userdata('error_msg', 'Marks should be Equal to '.$_POST['final_total']);
                 redirect('teachers/edit_final_structure/?final_structure_id='.$final_course_id);
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
             $result                 =   $this->Teachers2_model->updateFinalStructure($final_course_id,$final_data);

             if($result){
                                  
                         $this->session->set_userdata('error_msg', 'Final Term Structure Updated Successfully');
                          redirect('teachers/all_courses');
             }else{
                         $this->session->set_userdata('error_msg', 'Final Term Structure Not Updated Successfully');
                         redirect('teachers/edit_final_structure/?final_structure_id='.$final_course_id);
             }
      
    }
    
    
    // Start for result
    
     public function add_view_result_form()
    {
        $this->login_check();
    
        $result['batches']      =   $this->Teachers2_model->getAllbatches();
        $result['sessions']     =   $this->Teachers2_model->getAllSessions();

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/all_courses2_form',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    
     public function add_view_result()
    {
      $this->login_check();
    
      $session_id             = $_REQUEST['session'];
      $batch_id               = $_REQUEST['batch'];
      $result['info']         = $this->Teachers2_model->getAllocatedCourseSectionLatest($session_id,$batch_id);
//      echo '<pre>'; print_r($result);die;
        $i = 0;
        foreach($result['info'] AS $row){
            $check_data             =  array(
                                        'teacher_id'            =>  $row['teacher_id'],
                                        'program_id'            =>  $row['program_id'],
                                        'course_id'             =>  $row['course_id'],
                                        'section'               =>  $row['course_section'],
                                        'batch_id'              =>  $row['batch_id'],
                                        'session_id'            =>  $row['current_session_id']
                                    );  
            
            $resmid          =   $this->Teachers2_model->checkMidStructure($check_data);
            if($resmid){$result['mid'][$i] = 1;}else{$result['mid'][$i] = 0;}
            $resfinal        =   $this->Teachers2_model->checkFinalStructure($check_data);
            if($resfinal){$result['final'][$i] = 1;}else{$result['final'][$i] = 0;}

            $i++;
        }
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('teachers/examination/all_courses2',$result);
      $this->load->view('admin_ace/admin_footer');
    }
    
    public function students_list_for_mid()
    {
        
        
        $this->login_check();
        $course_id                  =   $_GET['course_id'];  
        $program_id                 =   $_GET['program_id'];  
        $semester                   =   $_GET['semester'];  
        $section                    =   $_GET['course_section'];  
        $batch_id                   =   $_GET['batch_id'];  
        $session_id                 =   $_GET['session_id'];
        $teacher_id                 =   $_GET['teacher_id'];    
//getStudentCourseSection

        //$result['students']     = $this->Teachers2_model->getStudentCourseSection($teacher_id,$program_id, $current_session_id,$semester, $section);
        $result['students']         =   $this->Teachers2_model->getStudentCourseSectionLatest($teacher_id,$program_id, $session_id,$semester, $section, $batch_id , $course_id);
        $result['session_id']       =   $session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        
        
        $check_data             =   array(
                                        'teacher_id'            =>  $teacher_id,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'section'               =>  $section,
                                        'batch_id'              =>  $batch_id
                                        //'semester'              =>  $semester
                                    );
        
        $res          =   $this->Teachers2_model->getMidStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('teachers/add_view_result_form');
        }

        $result['mid']   =   $res;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/mid_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
 
     public function add_mid_result()
    {
       $this->login_check();
      
       $session_id              =       $_POST['session_id'];
       $batch_id                =       $_POST['batch_id'];
       $course_id               =       $_POST['course_id'];
       $program_id              =       $_POST['program_id'];
       $semester                =       $_POST['semester'];
       $course_section          =       $_POST['course_section'];
       $teacher_id              =       $_POST['teacher_id'];
       
       $student_id              =       $_POST['student_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       
      
       $total_stus              =       count($student_id);
       
       
//       echo '<pre>';
//       var_dump($_POST);
//       echo '</pre>';
//       echo '<pre>';
//       var_dump($total_stus);
//       echo '</pre>';die;
       
       
      for($i=0; $i < $total_stus; $i++)
      {
                $mid_result             =      array(
                                                    'student_id'            =>  $student_id[$i],
                                                    'session_id'            =>  $session_id,
                                                    'course_id'             =>  $course_id,
                                                    'teacher_id'            =>  $teacher_id,                                            
                                                    'mid_title_1'           => $title1,
                                                    'mid_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                    'mid_title_2'           => $title2,
                                                    'mid_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                    'mid_title_3'           => $title3,
                                                    'mid_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                    'status'                => $status[$i],
                                                    'created_date'          => date('Y-m-d'),
                                                    'batch_id'              => $batch_id,
                                                    'program_id'            => $program_id,
                                                    'section'               => $course_section,
                                                    'operator_id'           => $this->session->userdata('sub_login_id')
                                                );
                    
                $mid_result_id[]        =   $this->Teachers2_model->AddMidResult($mid_result); 

                if(!$mid_result_id){
                        $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Please try again.');
                        redirect('teachers/add_mid_result_form/?course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section.'&student_id='.$student_id.'&session_id='.$session_id.'&batch_id='.$batch_id);
                }
                
      }
      
        $mid_result_status              =       array(
                                                    'teacher_id'            =>  $teacher_id,
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $course_section,                                           
                                                    'semester'              =>  $semester,
                                                    'batch_id'              =>  $batch_id,
                                                    'session_id'            =>  $session_id,
                                                    'result_status'         =>  1                                           
                                                    );
       
        $mid_result_status_id           =   $this->Teachers2_model->AddMidResultStatus($mid_result_status);

        
        $this->session->set_userdata('error_msg', 'Mid Term Result Added Successfully.');
        redirect('teachers/view_mid_result/?teacher_id='.$teacher_id.'&session_id='.$session_id.'&batch_id='.$batch_id.'&course_id='.$course_id.'&program_id='.$program_id.'&course_section='.$course_section);
      
    }
    
    public function view_mid_result()
    {
        
        $this->login_check();
        $course_id                  =   $_GET['course_id'];  
        $program_id                 =   $_GET['program_id'];  
        $section                    =   $_GET['course_section'];  
        $current_session_id         =   $_GET['session_id'];  
        $batch_id                   =   $_GET['batch_id'];  
        $teacher_id                 =   $_GET['teacher_id'];    
        //$current_session_id         =   $this->session->userdata('current_session_id'); 

        $result['students']         =   $this->Teachers2_model->getStudentCourseSection($teacher_id,$program_id, $current_session_id, $section, $course_id,$batch_id);
        
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
        
        $check_data                 =   array(
                                            'teacher_id'            =>  $teacher_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'section'               =>  $section,
                                            'batch_id'              =>  $batch_id,
                                            'session_id'            =>  $current_session_id
                                        );
        
        $res_status                 =   $this->Teachers2_model->getMidResStatus($check_data); 
        $result['res_status']       =   $res_status->result_status;
        
        $res                        =   $this->Teachers2_model->getMidStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('teachers/add_view_result');
        }

        $result['mid']   =   $res;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/mid_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
   
    
    public function students_list_for_final()
    {
        $this->login_check();
        $course_id              =   $_GET['course_id'];  
        $program_id             =   $_GET['program_id'];  
        $semester               =   $_GET['semester'];  
        $section                =   $_GET['course_section'];  
        $teacher_id             =   $_GET['teacher_id'];    
        //$current_session_id         =   $this->session->userdata('current_session_id'); 
        $current_session_id     =   $_GET['session_id'];  
        $batch_id               =   $_GET['batch_id'];  

        $result['students']     =   $this->Teachers2_model->getStudentCourseSectionLatest($teacher_id,$program_id, $current_session_id,$semester, $section , $batch_id, $course_id);
        $result['session_id']   =   $current_session_id; 
        $result['course_id']    =   $course_id; 
        $result['teacher_id']   =   $teacher_id; 
        $result['program_id']   =   $program_id; 
        $result['batch_id']     =   $batch_id; 
        
        //echo '<pre>';var_dump($result['students']);exit;
        $check_data             =   array(
                                            'teacher_id'            =>  $teacher_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'section'               =>  $section,
                                            'batch_id'              =>  $batch_id,
                                            'session_id'            =>  $current_session_id
                                            );
        
        $res          =   $this->Teachers2_model->getFianlStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term atructure then add result.');
            redirect('teachers/all_courses_form');
        }

        $result['final']   =   $res;

//        echo '<pre>';//        var_dump($result['final']);//        echo '</pre>';
//        die;
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/final_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function add_final_result()
    {
        
        $this->login_check();

        $session_id              =       $_POST['session_id'];              
        $batch_id                =       $_POST['batch_id'];              
        $course_id               =       $_POST['course_id'];       
        $program_id              =       $_POST['program_id'];
        $semester                =       $_POST['semester'];       
        $course_section          =       $_POST['course_section'];       
        $course_type             =       $_POST['course_type'];       
        $teacher_id              =       $_POST['teacher_id'];
       
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
       
       
        foreach($student_id as $i => $p)
        {
            
                 $final_result              =       array(
                                                                 'student_id'              =>  $p,
                                                                 'teacher_id'              =>  $teacher_id,                                            
                                                                 'session_id'              =>  $session_id,
                                                                 'course_id'               =>  $course_id,
                                                                 
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
                                                                 'post_date'               => '0000-00-00',
                                                                 'created_date'            => date('Y-m-d'),
                                                                 'batch_id'                =>  $batch_id,
                                                                 'program_id'            => $program_id,
                                                                 'section'               => $course_section,
                                                                 'operator_id'           => $this->session->userdata('sub_login_id')
                                                                 );
                    
                    
                        $final_result_id[]          =   $this->Teachers2_model->AddFinalResult($final_result); 
                        
                        if(!$final_result_id){
                                $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Please try again.');
                                redirect('teachers/add_final_result_form/?course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section.'&student_id='.$student_id.'&session_id='.$session_id);
                        }
                
        }
        $this->calculate_save_std_gpa($teacher_id, $program_id, $course_id,$course_section,$batch_id,$session_id,$course_type);
        $final_result_status              =       array(
                                                    'teacher_id'            =>  $teacher_id,
                                                    'program_id'            =>  $program_id,
                                                    'course_id'             =>  $course_id,
                                                    'section'               =>  $course_section,                                           
                                                    'semester'              =>  $semester,
                                                    'batch_id'              =>  $batch_id,
                                                    'session_id'            =>  $session_id,
                                                    'result_status'         =>  1                                           
                                                    );
       
        $final_result_status_id           =   $this->Teachers2_model->AddFinalResultStatus($final_result_status);
     
        
        
        $this->session->set_userdata('error_msg', 'Final Term Result Added Successfully.');
        redirect('teachers/add_view_result_form');
    }
    
     public function view_final_result()
    {
         
        $this->login_check();
        $course_id                  =   $_GET['course_id'];  
        $program_id                 =   $_GET['program_id'];  
        $semester                   =   $_GET['semester'];  
        $section                    =   $_GET['course_section'];  
        $batch_id                   =   $_GET['batch_id'];  
        $current_session_id         =   $_GET['session_id'];  
        $teacher_id                 =   $_GET['teacher_id'];    
        //$current_session_id         =   $this->session->userdata('current_session_id'); 

        //$result['students']     =   $this->Teachers2_model->getStudentCourseSection($teacher_id,$program_id, $current_session_id,$semester, $section);
        $result['students']         =   $this->Teachers2_model->getStudentCourseSectionInd($teacher_id,$program_id, $current_session_id, $section, $course_id,$batch_id);
        
        //echo '<pre>';
        //var_dump($result);
        //echo '</pre>';die;
        
        $result['session_id']       =   $current_session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id;
        $result['section_id']       =   $section;
        
        $check_data                 =       array(
                                                'teacher_id'            =>  $teacher_id,
                                                'program_id'            =>  $program_id,
                                                'course_id'             =>  $course_id,
                                                'section'               =>  $section,
                                                'batch_id'              =>  $batch_id,
                                                'session_id'            =>  $current_session_id
                                                //'semester'              =>  $semester
                                            );
        
        $res_status             =   $this->Teachers2_model->getFinalResStatus($check_data); 
        $result['res_status']   =   $res_status->result_status;
        
        
        $res          =   $this->Teachers2_model->getFianlStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term atructure then add result.');
            redirect('teachers/add_view_result_form');
        }

        $result['final']   =   $res;
       
        //echo '<pre>';var_dump($result['students']   );echo '</pre>';die;
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/final_student_result',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    
    // for updating the student session gpa
    
    // public function calculate_save_std_gpa(){
     public function calculate_save_std_gpa($teacher_id, $program_id, $course_id,$course_section,$batch_id,$session_id,$course_type){
      
      if($course_type == 'Lab'){
          $course_id         =   $this->Teachers2_model->getParentCourseId($course_id);
          $students          =   $this->Teachers2_model->getStudentsLab($program_id, $course_id,$course_section,$batch_id,$session_id);
      }else{
          $students     =   $this->Teachers2_model->getStudents($teacher_id, $program_id, $course_id,$course_section,$batch_id,$session_id);
      }
      
    
      $i=1;
      foreach($students AS $row){         
          $final_marks    =   $this->Teachers2_model->getFinalMarks($row['student_id'],$session_id);      
         // echo '<pre>';print_r($final_marks);die;
          $gpa = 0;
          $total_credit_hours = 0;
                        for($c=0; $c < count($final_marks); $c++){  
                                                             
                                    $labi            =   $this->Teachers2_model->getLabMarks( $row['student_id'] , $batch_id,$final_marks[$c]['course_id']  ,$session_id);
                                   
                                     if($labi != null){
                                        $marks      = $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2']+$labi[0]['final_value_1'];
                                        $credit_hours = $final_marks[$c]['credit_hours'] +1;
                                    }else{
                                        $marks      = $final_marks[$c]['obtained1']+$final_marks[$c]['obtained2'];
                                        $credit_hours = $final_marks[$c]['credit_hours'];
                                    }
                                    
                                   $total_credit_hours = $total_credit_hours+$credit_hours;
                                   
                                    $res    = $this->Teachers2_model->calculateGpa($marks,$credit_hours);
                                    $gpa    =   $gpa + $res;                                                             
                                  }
                                  
                                    $total_gpa   =   $gpa;
                                    $gpa         =   $gpa/$total_credit_hours;
                                 
                                    $check        =    $this->Teachers2_model->checkgpa($row['student_id'], $session_id);
                                    if(count($check) > 0){
                                        $std_gpa_id   =   $this->Teachers2_model->UpdateStdgpa($row['student_id'],$gpa,$session_id,$total_gpa,$total_credit_hours);
                                    }else{
                                        $std_gpa_id   =   $this->Teachers2_model->SaveStdgpa($row['student_id'],$gpa,$session_id,$total_gpa,$total_credit_hours);
                                    }
                                  
                               }
  }
  
  
  // Add Single Student Result
  
   // Start for result
    
     public function add_single_student_result_form()
    {
        $this->login_check();
    
        $result['batches']      =   $this->Teachers2_model->getAllbatches();
        $result['sessions']     =   $this->Teachers2_model->getAllSessions();
        $result['programs']     =   $this->Admin_model->getAllprogramsHR(4);

        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/singleStudent/all_courses2_form',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function get_Students_list() {

       
        $program_id         = $_POST['program_id'];
        $batch_id           = $_POST['batch_id'];
        $session_id         = $_POST['session_id'];

        $result['rollno'] = $this->Teachers2_model->getStudentsRollNo($batch_id,$program_id);
        // echo '<pre>'; print_r($result);die;

        $this->load->view('teachers/examination/singleStudent/rollno_partial', $result);
    }
    
     public function add_single_student_result()
    {
      $this->login_check();
    
      $session_id             = $_REQUEST['session'];
      $batch_id               = $_REQUEST['batch'];
      $program_id             = $_REQUEST['program'];
      $array                  = $_REQUEST['roll_no'];
      
      $res                    = explode(',', $array);
      
      $result['student_id']   = $res[0];
//      echo '<pre>'; print_r($res);die;
      
      $result['info']         = $this->Teachers2_model->getAllocatedCourseSectionLatest_singleStudent($res[0],$session_id,$batch_id,$program_id);
//      echo '<pre>'; print_r($result);die;
        $i = 0;
        foreach($result['info'] AS $row){
            $check_data             =  array(
                                        'teacher_id'            =>  $row['teacher_id'],
                                        'program_id'            =>  $row['program_id'],
                                        'course_id'             =>  $row['course_id'],
                                        'section'               =>  $row['course_section'],
                                        'batch_id'              =>  $row['batch_id'],
                                        'session_id'            =>  $row['current_session_id']
                                    );  
            
            $resmid          =   $this->Teachers2_model->checkMidStructure($check_data);
            if($resmid){$result['mid'][$i] = 1;}else{$result['mid'][$i] = 0;}
            $resfinal        =   $this->Teachers2_model->checkFinalStructure($check_data);
            if($resfinal){$result['final'][$i] = 1;}else{$result['final'][$i] = 0;}

            $i++;
        }
      
      $this->load->view('admin_ace/admin_header');
      $this->load->view('admin_ace/examination_side_menu');
      $this->load->view('teachers/examination/singleStudent/all_courses2',$result);
      $this->load->view('admin_ace/admin_footer');
    }
    
     public function students_list_for_mid_SingleStudent()
    {
        
        
        $this->login_check();
        $course_id                  =   $_GET['course_id'];  
        $program_id                 =   $_GET['program_id'];  
        $semester                   =   $_GET['semester'];  
        $section                    =   $_GET['course_section'];  
        $batch_id                   =   $_GET['batch_id'];  
        $session_id                 =   $_GET['session_id'];
        $teacher_id                 =   $_GET['teacher_id'];    
        $result['student_id']       =   $_GET['student_id'];    
//getStudentCourseSection

        //$result['students']     = $this->Teachers2_model->getStudentCourseSection($teacher_id,$program_id, $current_session_id,$semester, $section);
        $result['students']         =   $this->Teachers2_model->getStudentCourseSectionLatest_SingleStudent($teacher_id,$program_id, $session_id,$semester, $section, $batch_id , $course_id);
        $result['session_id']       =   $session_id; 
        $result['course_id']        =   $course_id; 
        $result['teacher_id']       =   $teacher_id; 
        $result['program_id']       =   $program_id; 
        $result['batch_id']         =   $batch_id; 
        $result['section']          =   $section; 
        
        
        $check_data             =   array(
                                        'teacher_id'            =>  $teacher_id,
                                        'program_id'            =>  $program_id,
                                        'course_id'             =>  $course_id,
                                        'section'               =>  $section,
                                        'batch_id'              =>  $batch_id
                                        //'semester'              =>  $semester
                                    );
        
        $res          =   $this->Teachers2_model->getMidStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Mid Term structure not defined, Please define the Mid Term atructure then add result.');
            redirect('teachers/add_view_result_form');
        }

        $result['mid']   =   $res;
       
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/singleStudent/mid_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
     public function add_mid_result_SingleStudent()
    {
       $this->login_check();
      
       $session_id              =       $_POST['session_id'];
       $batch_id                =       $_POST['batch_id'];
       $course_id               =       $_POST['course_id'];
       $program_id              =       $_POST['program_id'];
       $semester                =       $_POST['semester'];
       $course_section          =       $_POST['course_section'];
       $teacher_id              =       $_POST['teacher_id'];
       
       $student_id              =       $_POST['student_id'];
       
       $title1                  =       $_POST['title1'];
       $title2                  =       $_POST['title2'];
       $title3                  =       $_POST['title3'];
       
       $marks_1                 =       $_POST['o_marks1'];
       $marks_2                 =       $_POST['o_marks2'];
       $marks_3                 =       $_POST['o_marks3'];
       $status                  =       $_POST['status'];
 
       
      
       $total_stus              =       count($student_id);
       
       
//       echo '<pre>';
//       var_dump($_POST);
//       echo '</pre>';
//       echo '<pre>';
//       var_dump($total_stus);
//       echo '</pre>';die;
       
       
      for($i=0; $i < $total_stus; $i++)
      {
                $mid_result             =      array(
                                                    'student_id'            =>  $student_id[$i],
                                                    'session_id'            =>  $session_id,
                                                    'course_id'             =>  $course_id,
                                                    'teacher_id'            =>  $teacher_id,                                            
                                                    'mid_title_1'           => $title1,
                                                    'mid_value_1'           => str_replace('', 0, $marks_1[$i]),
                                                    'mid_title_2'           => $title2,
                                                    'mid_value_2'           => str_replace('', 0, $marks_2[$i]),
                                                    'mid_title_3'           => $title3,
                                                    'mid_value_3'           => str_replace('', 0, $marks_3[$i]),
                                                    'status'                => $status[$i],
                                                    'created_date'          => date('Y-m-d'),
                                                    'batch_id'              => $batch_id,
                                                    'program_id'            => $program_id,
                                                    'section'               => $course_section,
                                                    'operator_id'           => $this->session->userdata('sub_login_id')
                                                );
                    
                $mid_result_id[]        =   $this->Teachers2_model->AddMidResult($mid_result); 

                if(!$mid_result_id){
                        $this->session->set_userdata('error_msg', 'Mid Term Result Not Added, Please try again.');
                        redirect('teachers/add_single_student_result_form');
                }
                
      }
      
               
        $this->session->set_userdata('error_msg', 'Mid Term Result Added Successfully.');
        redirect('teachers/add_single_student_result_form');
      
    }
    
    
     public function students_list_for_final_SingleStudent()
    {
        $this->login_check();
        $course_id              =   $_GET['course_id'];  
        $program_id             =   $_GET['program_id'];  
        $semester               =   $_GET['semester'];  
        $section                =   $_GET['course_section'];  
        $teacher_id             =   $_GET['teacher_id'];    
        //$current_session_id         =   $this->session->userdata('current_session_id'); 
        $current_session_id     =   $_GET['session_id'];  
        $batch_id               =   $_GET['batch_id'];  
            
        $result['student_id']       =   $_GET['student_id']; 

        $result['students']     =   $this->Teachers2_model->getStudentCourseSectionLatest_SingleStudent($teacher_id,$program_id, $current_session_id,$semester, $section , $batch_id, $course_id);
        $result['session_id']   =   $current_session_id; 
        $result['course_id']    =   $course_id; 
        $result['teacher_id']   =   $teacher_id; 
        $result['program_id']   =   $program_id; 
        $result['batch_id']     =   $batch_id; 
        $result['section']     =   $section; 
        
        
        //echo '<pre>';var_dump($result['students']);exit;
        $check_data             =   array(
                                            'teacher_id'            =>  $teacher_id,
                                            'program_id'            =>  $program_id,
                                            'course_id'             =>  $course_id,
                                            'section'               =>  $section,
                                            'batch_id'              =>  $batch_id,
                                            'session_id'            =>  $current_session_id
                                            );
        
        $res          =   $this->Teachers2_model->getFianlStructure($check_data); 

        if(count($res) == 0){
            $this->session->set_userdata('error_msg', 'Final Term structure not defined, Please define the Final Term atructure then add result.');
            redirect('teachers/all_courses_form');
        }

        $result['final']   =   $res;

//        echo '<pre>';//        var_dump($result['final']);//        echo '</pre>';
//        die;
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/examination_side_menu');
        $this->load->view('teachers/examination/singleStudent/final_std_list',$result);
        $this->load->view('admin_ace/admin_footer');
    }
    
    public function add_final_result_SingleStudent()
    {
        
        $this->login_check();

        $session_id              =       $_POST['session_id'];              
        $batch_id                =       $_POST['batch_id'];              
        $course_id               =       $_POST['course_id'];       
        $program_id              =       $_POST['program_id'];
        $semester                =       $_POST['semester'];       
        $course_section          =       $_POST['course_section'];       
        $course_type             =       $_POST['course_type'];       
        $teacher_id              =       $_POST['teacher_id'];
       
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
       
       
        foreach($student_id as $i => $p)
        {
            
                 $final_result              =       array(
                                                                 'student_id'              =>  $p,
                                                                 'teacher_id'              =>  $teacher_id,                                            
                                                                 'session_id'              =>  $session_id,
                                                                 'course_id'               =>  $course_id,
                                                                 
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
                                                                 'post_date'               => '0000-00-00',
                                                                 'created_date'            => date('Y-m-d'),
                                                                 'batch_id'                =>  $batch_id,
                                                                 'program_id'            => $program_id,
                                                                 'section'               => $course_section,
                                                                 'operator_id'           => $this->session->userdata('sub_login_id')
                                                                 );
                    
                    
                        $final_result_id[]          =   $this->Teachers2_model->AddFinalResult($final_result); 
                        
                        if(!$final_result_id){
                                $this->session->set_userdata('error_msg', 'Final Term Result Not Added, Please try again.');
                                redirect('teachers/add_final_result_form/?course_id='.$course_id.'&program_id='.$program_id.'&semester='.$semester.'&course_section='.$course_section.'&student_id='.$student_id.'&session_id='.$session_id);
                        }
                
        }
                
        $this->session->set_userdata('error_msg', 'Final Term Result Added Successfully.');
        redirect('teachers/add_view_result_form');
    }
    
    
    
 
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
