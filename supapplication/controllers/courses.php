<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {
    
    public function __construct() {

        parent::__construct();

        $this->load->model('Course_model');
        $this->load->library('session');

        // for form validation
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    
    public function add_course_form() {
        
        
        //echo 'ffffff';
        // sending all of the courses list
        //$result['allcourses'] = $this->Course_model->getAllCourses();
        $allcourses = $this->Course_model->getAllCourses();
        
        $html .= '<select name="pre_reqs[]"><option value="">Course Name -- Course Code</option>'; 
            foreach( $allcourses as $kk => $pp){
                //$html .='<option value="">Course Name -- Course Code</option>';
                $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                //$html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].'</option>';
            }
        $html .= '</select>'; 
        
        $result['dropdown']     = $html ;
        $result['allcourses']   = $allcourses;
        
        
        // view loading 
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin/courses/addcourse' ,  $result);
        $this->load->view('admin_ace/admin_footer');
        
        
    }
    
    
    public function add_course() {
            // fiel name
            $this->form_validation->set_rules('course_name', 'Course Name', 'required');
            $this->form_validation->set_rules('course_code', 'Course Code', 'required');
            $this->form_validation->set_rules('credit_hours', 'Credit Hours', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admin/courses/addcourse');
            $this->load->view('admin_ace/admin_footer');
        } else {
            
                // here for lab and theory form lab
            
            
                $course_type    = $_POST['hidden_flag'];
                
                $course_array   = array(
                    'course_name' => $_POST['course_name'],
                    'course_code' => $_POST['course_code'],
                    'course_type' => $_POST['hidden_flag'],
                );
                

                $course_data_array = array(
                    'course_name'       => $_POST['course_name'],
                    'course_code'       => $_POST['course_code'],
                    'credit_hours'      => $_POST['credit_hours'],
                    'parent_course_id'  => $_POST['parent_course'],
                    'course_added_date' => date('Y-m-d'),
                    'course_type'       => $course_type
                );

                
                
                // check city name already exitsts
                $res = $this->Course_model->checkCourseNew($_POST['course_name'] , $_POST['course_code'] , $course_type, $_POST['credit_hours']);
                
                
                if ($res) {
                    $this->session->set_userdata('error_msg', 'Course Name Already Exists');
                    redirect('course/add_course_form');
                } else {
                    
                    $result = $this->Course_model->addCourse($course_data_array);
                    if ($result) {
                        $message1 = 'Course Added Successfully';
                        $inserted_course_id = $result;
                        //$this->session->set_userdata('success_msg', 'Course Added Successfully');
                        //redirect('courses/view_courses');
                    }else{
                        $this->session->set_userdata('error_msg', 'Course not Added.');
                    }
                    
                    if($_POST['hidden_flag'] != 'Lab'){
                        if($_POST['pre_reqs']){
                            foreach($_POST['pre_reqs'] as $op => $k){
                                $arra = array(
                                            'course_id'         => $inserted_course_id,
                                            'course_pre_req_id' => $k
                                        );
                                $result2 = $this->Course_model->addCoursePreReq($arra);
                            }
                        }
                    }
                        

                    if( $result2 or $message1 ){
                        $message2 = 'Course and its pre-requisite added successfully';   
                        $this->session->set_userdata('success_msg', $message1 .' '.$message2);
                    }else{
                        // pre requisite not added.
                        $this->session->set_userdata('error_msg', 'Pre Requisite Not Added.');
                    }
                    redirect('courses/view_courses');
                }
        }
    }    
    
    
    public function view_courses() {
        
        // view loading 
        $result['courses'] = $this->Course_model->getAllCourses();
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin/courses/viewcourses' ,  $result);
        $this->load->view('admin_ace/admin_footer');
        
    }
    
    public function edit_course($id) {

        //$this->login_check();
        $allcourses = $this->Course_model->getAllCourses();
        
        $html .= '<select name="pre_reqs[]"><option value="">Course Name -- Course Code</option>'; 
            foreach( $allcourses as $kk => $pp){
                $html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
            }
        $html .= '</select>'; 
        
        $result['dropdown']     = $html ;
        $result['allcourses']   = $allcourses;
        $result['course']       = $this->Course_model->getCourse($id);
        
        
        // getting all pre requsite courses
        $allprereqcourses           = $this->Course_model->getAllPreReqCourses($id);
        
        //echo '<pre>';var_dump($allprereqcourses);echo '</pre>';exit;
        
        $sizeofprereq               = sizeof($allprereqcourses);
        $result['total_prerq_size'] = $sizeofprereq;
        $result['allprereqcourses'] = $allprereqcourses;
        
        
        
        $this->load->view('admin_ace/admin_header');
        $this->load->view('admin_ace/admin_side_menu');
        $this->load->view('admin/courses/editcourse', $result);
        $this->load->view('admin_ace/admin_footer');
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

            $this->load->view('admin_ace/admin_header');
            $this->load->view('admin_ace/admin_side_menu');
            $this->load->view('admin/courses/editcourse', $result);
            $this->load->view('admin_ace/admin_footer');
        } 

        // check course name and course code already exitsts or not
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $course_type = $_POST['course_type'];
        
        $res = $this->Course_model->checkCourseUnique($course_name , $course_code , $course_type ,$course_id);
        
        if ($res) {
          $this->session->set_userdata('error_msg', 'Course Name and  Course Code  Already Exists');
          $result = $this->Course_model->getCourse($course_id);
          $result['course'] = $result;

          $this->load->view('admin_ace/admin_header');
          $this->load->view('admin_ace/admin_side_menu');
          $this->load->view('admin/courses/editcourse', $result);
          $this->load->view('admin_ace/admin_footer');
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
                    'course_type'       => $course_type
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
            redirect('courses/view_courses');
        }
    }
    
}