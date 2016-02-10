<?php

class Inquiry_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function validInquiry($inquiry_no ,$mobile_no)
    {
        $arr = array('inquiry_no' =>  $inquiry_no,'contact' => $mobile_no );
        
        $query = $this->db->get_where('inquiry',$arr);
        return $query->result_array();
    }
    
    function validInquiryNew($inquiry_id)
    {
        $arr = array('inquiry_id' =>  $inquiry_id);
        
        $query = $this->db->get_where('inquiry',$arr);
        return $query->result_array();
    }
    
    // geting all the inital form data against inuiery_id
    function initialformData($inquiry_id)
    {
        $arr = array( 'inquiry_id' =>  $inquiry_id );
        
        $query = $this->db->get_where('initial_form',$arr);
        return $query->result_array();
    }
    
    function finlaformData($inquiry_id)
    {
        $arr = array( 'inquiry_id' =>  $inquiry_id );
        
        $query = $this->db->get_where('forms',$arr);
        return $query->result_array();
    }
    
    function validform($form_no ,$mobile_no)
    {
//        $arr = array('form_no' =>  $form_no, 'mobile' => $mobile_no );
//        
//        
//        $query = $this->db->get_where('forms',$arr);
        $query  = $this->db->query(
                "SELECT * FROM forms WHERE 
                    mobile  = '$mobile_no'
                AND
                    form_no  = '$form_no'
                ");
        
        return $query->result_array();

    }
    
    
    
}