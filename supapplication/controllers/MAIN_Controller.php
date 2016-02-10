<?php

class MAIN_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // checking on which we have to run code autmoticvally
        $controller     =  $this->uri->segment(1); 
        $methd          =  $this->uri->segment(2); 
        
        
        if($controller == 'programmanagers' ){
            
            $prg_mng_list   = array('dashboard','teacher');
            
            if (in_array($methd , $prg_mng_list)) {
                $this->mng_logged_in();
            }
        }
        if($controller == 'examination' ){
            
            $prg_mng_list   = array('dashboard','view_students','add_result_form','add_mid_result','add_final_result','view_result');
            
            if (in_array($methd , $prg_mng_list)) {
                $this->mng_logged_in();
            }
        }
    }

    public function mng_logged_in()
    {
        
        
        //if ($this->session->userdata('prgmng_username') == '' && $this->session->userdata('prgmng_id') == '') 
        if ($this->session->userdata('username') == '' && $this->session->userdata('admin_id') == '' && $this->session->userdata('account_role_id') == '') 
        {
            $controller     =  $this->uri->segment(1);
            redirect($controller);
        }
    }
    
    // Login check for 
    // Program managwer
    public function prgmng_login_check() 
    {
        if ($this->session->userdata('prgmng_id') == '' && $this->session->userdata('prgmng_username') == '') 
        {
            redirect('programmanagers/index');
        }
    }
    
}