<?php
class Admission_r_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    //   ***** Start function for Inquiry Module *****   //
    
     function adminLogin($login_data)
    {
        
        $query  = $this->db->get_where('gen_sub_logins', $login_data);
        $result = $query->row();           
        if($result){
            
            // update last login date and time
                $id     =   $result->sub_login_id;
                $data   =   array('last_login'=>date('Y-m-d H:i:s'));
                $this->db->where('sub_login_id', $id);
                $query = $this->db->update('gen_sub_logins', $data);
                if($query == 1)
                {
                        $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                        $log_data   =   array(
                                                'operator_id'   => $id,
                                                'reference_id'  => $id,
                                                'action'        => $action
                                            );
                        $query = $this->db->insert('user_log', $log_data); 
                        return $result;
                 }
                }else{  
                    return false;
                }
    }
    
    
    function getOpenCampaign()
    {
        $query = $this->db->get_where('campaign', array('status' => 'open'));
        return $query->row();
            
    }
    
    // change password
    
    function ChangePass($old_password,$new_password)
    {
        $old_password = array('sub_password'=>$old_password);
        $query = $this->db->get_where('gen_sub_logins', $old_password);
        $res =  $query->result_array();
        
        $id = $this->session->userdata('sub_login_id');
        
        if(count($res) > 0)
        {
          $query =  $this->db->query("update gen_sub_logins set `sub_password` = '$new_password'  WHERE sub_login_id 	=  $id ");
        
                $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                $log_data   =   array(
                                        'operator_id'   => $this->session->userdata('sub_login_id'),
                                        'reference_id'  => $this->session->userdata('sub_login_id'),
                                        'action'        => $action
                                    );

                $query = $this->db->insert('user_log', $log_data); 
                return $query;
        }else{
            return false;
        }
        
    }
    
    
    
    // check duplication of Inquiry name
    
    function checkInquiryNo($inquiry_no)
    {
        $query = $this->db->get_where('inquiry', $inquiry_no);
        return $query->result_array();
    }
   

    // funciton to add the student
    function addStudent($students_data)
    {
        $query = $this->db->insert('students', $students_data); 
        return $this->db->insert_id();
    }
    
    
    // get campaign code 
    
    function getCampaignCode($campaign_id)
    {
        $this->db->select('campaign_code');
        $query = $this->db->get_where('campaign', array('campaign_id' => $campaign_id));
        return $query->row();
    }

    // get program code 
    
    function getProgramCode($program_id)
    {
        $this->db->select('program_code');
        $query = $this->db->get_where('programs', array('program_id' => $program_id));
        return $query->row();
    }

    // get campus code 
    
    function getCampusCode($campus_id)
    {
        $this->db->select('campus_code');
        $query = $this->db->get_where('campus', array('campus_id' => $campus_id));
        return $query->row();
    }

    // get last table inquiry id
    
    function getLastInquiryId()
    {
        $this->db->select('inquiry_id');
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $this->db->from('inquiry_os');
        }else
        {
            $this->db->from('inquiry');
        }
        $this->db->order_by("inquiry_id", "DESC");         
        $query = $this->db->get();
        return $query->row();
    }

    // get last table initial_form id
    
    function getLastInitialFormId($program_id,$campus_id,$shift,$campaign_id)
    {
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                    $this->db->select('initial_form.serial');
                    $this->db->select('inq.campaign_id');
                    $this->db->from('initial_form_os initial_form');
                    $this->db->join('inquiry_os inq', 'initial_form.inquiry_id = inq.inquiry_id');
                    $this->db->where(array('initial_form.program_id' =>$program_id, 'initial_form.campus_id' =>$campus_id, 'initial_form.shift' => $shift, 'inq.campaign_id'=> $campaign_id));
                    $this->db->order_by("serial", "DESC");         
                    $query = $this->db->get();
        }else{
                    $this->db->select('initial_form.serial');
                    $this->db->select('inq.campaign_id');
                    $this->db->from('initial_form');
                    $this->db->join('inquiry inq', 'initial_form.inquiry_id = inq.inquiry_id');
                    $this->db->where(array('initial_form.program_id' =>$program_id, 'initial_form.campus_id' =>$campus_id, 'initial_form.shift' => $shift, 'inq.campaign_id'=> $campaign_id));
                    $this->db->order_by("serial", "DESC");         
                    $query = $this->db->get();
        }
        
        return $query->row();
    }
    
    // get last table initial_form id
    
    /*function getLastInitialFormId()
    {
        $this->db->select('initial_form_id');
        $this->db->from('initial_form');        
        $this->db->order_by("initial_form_id", "DESC");         
        $query = $this->db->get();
        return $query->row();
    }*/



    // add new inquiry in db
    
    function addInquiry($inquiry_data)
    {
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->insert('inquiry_os', $inquiry_data); 
        }else{
                $query = $this->db->insert('inquiry', $inquiry_data); 
        }
        $id    =    $this->db->insert_id();
        if($id){

            $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
            $log_data   =   array(
                                    'operator_id'   => $this->session->userdata('sub_login_id'),
                                    'reference_id'  => $id,
                                    'action'        => $action
                                );
            
            $query = $this->db->insert('user_log', $log_data); 
            return $id;
            
        }else{
            return false;
        }
        
    }
    

    // add new reference in db
    
    function  addInquiryReference($reference_data)
    {   
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->insert('inquiry_references_os', $reference_data); 
        }else{
            $query = $this->db->insert('inquiry_references', $reference_data); 
        }
        return $this->db->insert_id();
    }
    
     // get all Inquiries data from db
    
      function getAllinquiries()
    {   
        
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        { 
                    $this->db->select('inq.*');
                    $this->db->select('prog.program_name');
                    $this->db->select('ref.reference_source');                    
                    $this->db->from('inquiry_os inq');
                    $this->db->join('programs prog', 'inq.program_id = prog.program_id','inner');
                    $this->db->join('reference ref', 'inq.reference_id = ref.reference_id','inner');                    
                    $this->db->where('inq.campus_id',$this->session->userdata('campus_id') );
                    $this->db->where('inq.prospectus_sale',0 );
                    $this->db->where('inq.campaign_id',$this->session->userdata('campaign_id') );
                    $this->db->order_by("inq.inquiry_id", "desc");  
                    $this->db->limit(100);
                    $query = $this->db->get();         
                    
        }else{
                    $this->db->select('inq.*');
                    $this->db->select('prog.program_name');
                    $this->db->select('ref.reference_source');                    
                    $this->db->select('user_records.draft');                    
                    $this->db->from('inquiry inq');
                    $this->db->join('programs prog', 'inq.program_id = prog.program_id','inner');
                    $this->db->join('reference ref', 'inq.reference_id = ref.reference_id','inner');                    
                    $this->db->join('user_records', 'inq.inquiry_id = user_records.inquiry_id','left');                    
                    if($this->session->userdata('role') != 'HOD'){
                        $this->db->where('inq.campus_id',$this->session->userdata('campus_id') );
                    }
                    $this->db->where('inq.prospectus_sale',0 );
                    $this->db->where('inq.campaign_id',$this->session->userdata('campaign_id') );
                    $this->db->order_by("inq.inquiry_id", "desc"); 
                    $this->db->limit(500);
                    $query = $this->db->get();
                   

        }
       //echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    // get a Inquiry record for update
    function getInquiry($id)
    {   
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inq.*,pros.prospectus_id');
                $this->db->from('inquiry_os inq');
                $this->db->join('prospectus_os pros', 'inq.inquiry_id = pros.inquiry_id','inner');
                $this->db->where('inq.inquiry_id',$id);
                $query = $this->db->get();
                return $query->result_array();
        }else{
                $this->db->select('inq.*,pros.prospectus_id');
                $this->db->from('inquiry inq');
                $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id','left');
                $this->db->where('inq.inquiry_id',$id);
                $query = $this->db->get();
                return $query->result_array();
        }
    }
    
    /*function getInquiry($id)
    {        
        $query = $this->db->get_where('inquiry', array('inquiry_id' => $id));
        return $query->result_array();
    }*/
     
    
    // get a Inquiry reference record for update
    function getInquiryReference($id)
    {    
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->get_where('inquiry_references_os', array('inquiry_id' => $id));
        }else{
            $query = $this->db->get_where('inquiry_references', array('inquiry_id' => $id));
        }
        return $query->result_array();
    }
     
    
    
    
    function getInquiry2($id)
    {   
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inquiry.inquiry_id,inquiry_no,campaign_id,name,contact,phone,program_id,shift,gender,qualification,total_marks,obtained_marks,reference_id,inquiry_type,previous_institute,remarks,inquiry.operator_id,inquiry_date,admission_stage');
                $this->db->select('prospectus.campus_id');
                $this->db->from('inquiry_os inquiry');
                $this->db->join('prospectus_os prospectus', 'inquiry.inquiry_id = prospectus.inquiry_id');
                $this->db->where('inquiry.inquiry_id ='.$id);
                $query = $this->db->get();
        }else{
                $this->db->select('inquiry.inquiry_id,inquiry_no,campaign_id,name,contact,phone,program_id,shift,gender,qualification,total_marks,obtained_marks,reference_id,inquiry_type,previous_institute,remarks,inquiry.operator_id,inquiry_date,admission_stage');
                $this->db->select('prospectus.campus_id');
                $this->db->from('inquiry');
                $this->db->join('prospectus', 'inquiry.inquiry_id = prospectus.inquiry_id');
                $this->db->where('inquiry.inquiry_id ='.$id);
                $query = $this->db->get();
            
        }
        return $query->result_array();
        
        
//        $query = $this->db->get_where('inquiry', array('inquiry_id' => $id));
//        return $query->result_array();
    }
        
     // update the Inquiry record
    
    function updateInquiry($id,$inquiry_data)
    {
        $this->db->where('inquiry_id', $id);
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->update('inquiry_os', $inquiry_data); 
        }else{
            $query = $this->db->update('inquiry', $inquiry_data);
        }
        
         if($query){

            $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
            $log_data   =   array(
                                    'operator_id'   => $this->session->userdata('sub_login_id'),
                                    'reference_id'  => $id,
                                    'action'        => $action
                                );
            
            $query1 = $this->db->insert('user_log', $log_data); 
            return $query;
            
        }else{
            return false;
        }
    }
    
    
     // update the Inquiry reference record
    
    function updateInquiryReference($id,$reference_data)
    {        
        $this->db->where('inquiry_id', $id);
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->update('inquiry_references_os', $reference_data); 
        }else{
            $query = $this->db->update('inquiry_references', $reference_data); 
        }
        
        return $query;        
    }
    
    
    
    
      
    
    //--------////  Start Initial Form \\\\--------\\
    
     // check duplication of Initial Form
    
    function checkInitialForm($check_initial_form)
    {
        $query = $this->db->get_where('initial_form', $check_initial_form);
        return $query->result_array();
    }
    
     // check duplication of Initial Form
    
    function checkInitialDuplication($inquiry_id)
    {
        $inquiry    =   array('inquiry_id'=>$inquiry_id);
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $query = $this->db->get_where('initial_form_os', $inquiry);
        }else{
                $query = $this->db->get_where('initial_form', $inquiry);
        }
        return $query->result_array();
    }
     // check duplication of Initial Form
    
    function checkformNoDuplication($form_no)
    {
        $formNo    =   array('form_no'=>$form_no);
        $query = $this->db->get_where('initial_form', $formNo);
        return $query->result_array();
    }
	
	 // add new Initial Form in db
    
    function addInitialForm($initial_form_data,$inquiry_id)
    {
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $query          = $this->db->insert('initial_form_os', $initial_form_data); 
        }else{
                $query          = $this->db->insert('initial_form', $initial_form_data); 
        }
        
        $initial_id     =   $this->db->insert_id();
        if($initial_id)
        {
            $this->db->where('inquiry_id', $inquiry_id);
            
             // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query2 = $this->db->update('inquiry_os', array('admission_stage' => 1)); 
        }else{
            $query2 = $this->db->update('inquiry', array('admission_stage' => 1)); 
        }
            if($query2)
            {
                    $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                    $log_data   =   array(
                                    'operator_id'   => $this->session->userdata('sub_login_id'),
                                    'reference_id'  => $initial_id,
                                    'action'        => $action
                                );
            
                    $query1 = $this->db->insert('user_log', $log_data); 
                    return $initial_id;
            }
        }
    }
    
     //View all Initial Form
    
    function getAllInitialForms()
    {
          // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('initial_form.*');
                $this->db->select('inquiry.inquiry_no,inquiry.admission_stage');
                $this->db->select('campus.campus_name');
                $this->db->select('programs.program_name');
                $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
                $this->db->select('operator_types.name');
                $this->db->from('initial_form_os initial_form');
                $this->db->join('inquiry_os inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');
                $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'inner');
                $this->db->join('programs', 'programs.program_id = initial_form.program_id', 'inner');
                $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
                $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
//                if($this->session->userdata('role') != 'HOD'){
                    $this->db->where('initial_form.campus_id',$this->session->userdata('campus_id') );
//                }
                $this->db->where('inquiry.admission_stage',1 );
                $this->db->where('inquiry.campaign_id',$this->session->userdata('campaign_id'));
                $this->db->order_by("initial_form.initial_form_id", "DESC"); 
                $this->db->limit(30);
                $query = $this->db->get();
        }else{
            
                $this->db->select('initial_form.*');
                $this->db->select('inquiry.inquiry_no,inquiry.admission_stage');
                $this->db->select('campus.campus_name');
                $this->db->select('programs.program_name');
                $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
                $this->db->select('operator_types.name');
                $this->db->from('initial_form');
                $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');
                $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'inner');
                $this->db->join('programs', 'programs.program_id = initial_form.program_id', 'inner');
                $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
                $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
                if($this->session->userdata('role') != 'HOD'){
                    $this->db->where('initial_form.campus_id',$this->session->userdata('campus_id') );
                }
                $this->db->where('inquiry.admission_stage',1 );
                $this->db->where('inquiry.campaign_id',$this->session->userdata('campaign_id'));
                $this->db->order_by("initial_form.initial_form_id", "DESC"); 
                $this->db->limit(30);
                $query = $this->db->get();
        }                

        return $query->result_array();
    }
    
    // get a Initial Form for update
    
    function getInitialForm($initial_form_id)
    {   
        
        // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
        $this->db->select('initial_form.initial_form_id,initial_form.form_no,initial_form.student_name,initial_form.mobile,initial_form.program_id,initial_form.shift,initial_form.gender,initial_form.qualification,initial_form.total_marks,initial_form.obtained_marks,initial_form.campus_id');
        $this->db->select('inquiry.inquiry_id,inquiry.campaign_id,inquiry.previous_institute');
        $this->db->select('campaign.campaign_name');
        $this->db->select('programs.program_name');
        $this->db->from('initial_form_os initial_form');
        $this->db->join('inquiry_os inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');             
        $this->db->join('programs', 'initial_form.program_id = programs.program_id', 'inner');             
        $this->db->join('campaign', 'inquiry.campaign_id = campaign.campaign_id', 'inner');             
        $this->db->where('initial_form.initial_form_id = '.$initial_form_id);
        $query = $this->db->get();
             
     }else{
        $this->db->select('initial_form.initial_form_id,initial_form.form_no,initial_form.student_name,initial_form.mobile,initial_form.program_id,initial_form.shift,initial_form.gender,initial_form.qualification,initial_form.total_marks,initial_form.obtained_marks,initial_form.campus_id');
        $this->db->select('inquiry.inquiry_id,inquiry.campaign_id,inquiry.previous_institute');
        $this->db->select('campaign.campaign_name');
        $this->db->select('programs.program_name');
        $this->db->from('initial_form');
        $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');             
        $this->db->join('programs', 'initial_form.program_id = programs.program_id', 'inner');             
        $this->db->join('campaign', 'inquiry.campaign_id = campaign.campaign_id', 'inner');             
        $this->db->where('initial_form.initial_form_id = '.$initial_form_id);
        $query = $this->db->get();
     }

        return $query->result_array();
        
    }
    
    
   
    //--------------End Initial Form----------\\
    
    
    
    // ------------    Start Complete form -----------------\\
     
    // check form no duplication
    function checkFormNo($form_no)
    {
         // for out station campuses
            if($this->session->userdata('role') == 'OS')
            {
               $query = $this->db->get_where('forms_os', $form_no);
            }else{
                $query = $this->db->get_where('forms', $form_no);
            }
     
     
	return $query->result_array();
    }

    // insert data into student and forms table
    
   function addForm($student_data,$form_data,$inquiry_id)
   {
       
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->insert('forms_os', $form_data);
        }else{
            $query = $this->db->insert('forms', $form_data);
        }
        
        $form_id = $this->db->insert_id();
        
        if(!$form_id){
            return false;
        }
        
        $student_data['form_id'] = $form_id;
       
        
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->insert('students_os', $student_data);
            $student_id = $this->db->insert_id();
        }else{
            $query = $this->db->insert('students', $student_data);
            $student_id = $this->db->insert_id();
        }
        
//      echo $student_id;die;
        $this->db->trans_complete(); 

        if($student_id)
        {
            $this->db->where('inquiry_id', $inquiry_id);
            
            // for out station campuses
            if($this->session->userdata('role') == 'OS')
            {
                $query = $this->db->update('inquiry_os', array('admission_stage' => 2)); 
            }else{
                $query = $this->db->update('inquiry', array('admission_stage' => 2)); 
            }
            
            if($query)
            {
                $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                $log_data   =   array(
                                    'operator_id'   => $this->session->userdata('sub_login_id'),
                                    'reference_id'  => $form_id,
                                    'action'        => $action
                                );
               $query1 = $this->db->insert('user_log', $log_data);              
                return $student_id;
            }
           
        }else
        {
             $this->db->where('form_id', $form_id);
             
              // for out station campuses
            if($this->session->userdata('role') == 'OS')
            {
                $this->db->delete('forms_os');
            }else{
                $this->db->delete('forms');
            }
            
             return $form_id.' Record Not Added';
        }
   } 
   
   function getAllStudentForms()
   {

     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
                $this->db->select('students.student_id','students.form_id', 'students.batch_id');
                $this->db->select('inquiry.admission_stage');
                //$this->db->select('forms.*');
                $this->db->select('forms.*,forms.form_id as FORMID');
                $this->db->select('batch.*');
                $this->db->from('students_os students');
                $this->db->join('forms_os forms', 'students.form_id = forms.form_id', 'inner');
                $this->db->join('inquiry_os inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
                $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');
                if($this->session->userdata('role') != 'HOD'){
                       $this->db->where('forms.campus_id',$this->session->userdata('campus_id') );            
                   }
                $this->db->where('forms.inquiry_id != 0');
                $this->db->where('forms.campaign_id',$this->session->userdata('campaign_id'));
                $this->db->where('inquiry.admission_stage',2);
                
                $this->db->order_by("forms.form_modified_date", "DESC");
               // $this->db->order_by("forms.form_id", "DESC");
                $this->db->order_by("students.student_id", "DESC");
                $this->db->limit(50);
                $query = $this->db->get();
     }else{
                $this->db->select('students.student_id','students.form_id', 'students.batch_id');
                $this->db->select('inquiry.admission_stage');
                //$this->db->select('forms.*');
                $this->db->select('forms.*,forms.form_id  as FORMID');
                $this->db->select('batch.*');
                $this->db->from('students');
                $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
                $this->db->join('inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
                $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');
                if($this->session->userdata('role') != 'HOD'){
                       $this->db->where('forms.campus_id',$this->session->userdata('campus_id') );            
                   }
                $this->db->where('forms.inquiry_id != 0');
                $this->db->where('forms.campaign_id',$this->session->userdata('campaign_id'));
                $this->db->where('inquiry.admission_stage',2);
               // $this->db->order_by("forms.form_modified_date", "DESC");
                $this->db->order_by("forms.form_id", "DESC");
                $this->db->order_by("students.student_id", "DESC");
                $this->db->limit(50);
                $query = $this->db->get();
                
     }
    // echo $this->db->last_query();die;
     return $query->result_array();
   }
   
   // get student to be edited
   
   function getStudentForm($student_id)
   {
     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {  
            $this->db->select('students.*');
            $this->db->select('forms.*');
            $this->db->from('students_os students');
            $this->db->join('forms_os  forms', 'students.form_id = forms.form_id', 'inner');
            $this->db->where($student_id);
            $query = $this->db->get();
     }else{
            $this->db->select('students.*');
            $this->db->select('forms.*');
            $this->db->from('students');
            $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
            $this->db->where($student_id);
            $query = $this->db->get();
     }
     
     return $query->result_array();
   }
   
   // update student record
   
   function updateForm($student_data,$form_data,$form_id,$student_id)
   {
       
       $this->db->where('form_id', $form_id);
       
     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     { 
        $result =  $this->db->update('forms_os', $form_data);
     }else{
         $result =  $this->db->update('forms', $form_data);
     }
       
       if($result)
       {
           $this->db->where('student_id', $student_id);
           
           // for out station campuses
            if($this->session->userdata('role') == 'OS')
            {
                return $res =  $this->db->update('students_os', $student_data);
            }else{
                return $res =  $this->db->update('students', $student_data);
            }
       }
       
       
   }

   // ------------    End Complete form -----------------\\
    
   
   
  
 // get product price 
 
 function getPrice($product_id)
 {
     $this->db->select('price');
     $this->db->from('products');
     $this->db->where('product_id', $product_id);
     $query = $this->db->get();
     return $query->row();
 }
 
 
 // get inquiry id
 
 function getInquiryId($inquiry_no)
 {
     // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inquiry_id,prospectus_sale,admission_stage');
                $this->db->from('inquiry_os');
                $this->db->where('inquiry_no', $inquiry_no);
                $query = $this->db->get();
        }else{
                $this->db->select('inquiry_id,prospectus_sale,admission_stage');
                $this->db->from('inquiry');
                $this->db->where('inquiry_no', $inquiry_no);
                $query = $this->db->get();
        }
     
     
      if($query->num_rows() > 0)
     {          
        return $query->row();
     }else{
         return NULL;
     }
 }
 
 // get initial form id
 
 function getInitialFormId($formNo)
 {
     $this->db->select('initial_form_id');
     
     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->from('initial_form_os');
     }else{
            $this->db->from('initial_form');
     }
     $this->db->where('form_no', $formNo);
     $query = $this->db->get();
     
      if($query->num_rows() > 0)
     {          
        return $query->row();
     }else{
         return NULL;
     }
 }
 
 // get initial form id
 
 function getFormId($formNo)
 {
     $this->db->select('form_id');
     
     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->from('forms_os');
     }else{
            $this->db->from('forms');
     }
     $this->db->where('form_no', $formNo);
     $query = $this->db->get();
      if($query->num_rows() > 0)
     {          
        return $query->row();
     }else{
         return NULL;
     }
 }
 
 
 // get inquiry info
 
 function getInquiryInfo($inquiry_id)
 {
     // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $this->db->select('inq.inquiry_no,inq.name,inq.contact,inq.qualification,inq.campus_id,inq.inquiry_date');
            $this->db->select('prog.program_name');
            $this->db->from('inquiry_os inq');
            $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
            $this->db->where('inq.inquiry_id ='.$inquiry_id);
            $query = $this->db->get();
        }else{
                $this->db->select('inq.inquiry_no,inq.name,inq.contact,inq.qualification,inq.campus_id,inq.inquiry_date');
                $this->db->select('prog.program_name');
                $this->db->from('inquiry inq');
                $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
                $this->db->where('inq.inquiry_id ='.$inquiry_id);
                $query = $this->db->get();
        }
       
     return $query->row();
     
 }




 // add prospectus data in database 
 
 function addProspectus($prospectus_data)
 {
     // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->insert('prospectus_os', $prospectus_data);
            $id    = $this->db->insert_id();
        }else{
            $query = $this->db->insert('prospectus', $prospectus_data);
            $id    = $this->db->insert_id();
        }

     
     if($id){

            $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
            $log_data   =   array(
                                    'operator_id'   => $this->session->userdata('sub_login_id'),
                                    'reference_id'  => $id,
                                    'action'        => $action
                                );
            
            $query = $this->db->insert('user_log', $log_data); 
            return $id;
            
        }else{
            return false;
        }
     
 }
 
 
 // get all  sold prospectuses
 
    
    function getAllprospectus()
    {    
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inq.inquiry_id,inq.inquiry_no,inq.name,inq.contact,inq.admission_stage');
                $this->db->select('prog.program_name');
                $this->db->select('pros.quantity,pros.total_price,pros.sale_date');
                $this->db->select('products.product_name');

                $this->db->from('inquiry_os inq');
                $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
                $this->db->join('prospectus_os pros', 'inq.inquiry_id = pros.inquiry_id', 'inner');
                $this->db->join('products', 'products.product_id = pros.product_id', 'inner');        
                if($this->session->userdata('role') != 'HOD'){
                    $this->db->where('inq.campus_id =',$this->session->userdata('campus_id') );
                    $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                }else{
                $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                }
                $this->db->where('inq.admission_stage',0 );
                $this->db->where('inq.prospectus_sale',1 );
                $this->db->where('inq.campaign_id',$this->session->userdata('campaign_id') );
                $this->db->order_by("pros.prospectus_id", 'DESC'); 
                $this->db->limit(30);
                $query = $this->db->get();
        }else
            {
                $this->db->select('inq.inquiry_id,inq.inquiry_no,inq.name,inq.contact,inq.admission_stage');
                $this->db->select('prog.program_name');
                $this->db->select('pros.quantity,pros.total_price,pros.sale_date');
                $this->db->select('products.product_name');

                $this->db->from('inquiry inq');
                $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
                $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id', 'inner');
                $this->db->join('products', 'products.product_id = pros.product_id', 'inner');        
                if($this->session->userdata('role') != 'HOD'){
                    $this->db->where('inq.campus_id =',$this->session->userdata('campus_id') );
                    $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                }else{
                $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                }
                $this->db->where('inq.admission_stage',0 );
                $this->db->where('inq.prospectus_sale',1 );
                $this->db->where('inq.campaign_id',$this->session->userdata('campaign_id') );
                $this->db->order_by("pros.prospectus_id", 'DESC');
                $this->db->limit(30);
                $query = $this->db->get();
            }

        return $query->result_array();
    }
    
    // get session id using campaign name
    
    function getSessionId($campaign_name)
    {
        $campaignName   =   array('session'=>$campaign_name);
        $query = $this->db->get_where('sessions', $campaignName);
        $result =  $query->result_array();
        return  $result[0]['session_id'];
    }



// ******>>>>         Start functions for Student Pakage        <<<<******  //
  

    
    // get program shift wise
    
    function getProgramInfo($type)
    {
     $this->db->select('program_name,program_id');
     $this->db->from('programs');
     $this->db->where('program_type', $type);
     $query = $this->db->get();
     return $query->result_array();
    }
 
    // get prospectus report against inquiry number
    
    function getProspectusTotal($inquiry_id)
    {
        $this->db->like('inquiry_id', $inquiry_id);
        $this->db->from('prospectus');
        return $this->db->count_all_results();
    
    }
    
    /* Functions for USer management*/
    
     // get employes
    
    function getcampusemployee($campus_id)
    {
    $query = $this->db->query("SELECT * FROM hr_employee_record	
                        INNER JOIN hr_departments ON hr_employee_record.department_id = hr_departments.department_id
                        INNER JOIN gen_account_roles ON gen_account_roles.account_role_id = hr_departments.account_role_id
                        WHERE gen_account_roles.account_role_id = '3' AND hr_employee_record.campus_id = '".$campus_id."'
                        ORDER BY hr_employee_record.employee_name ASC");
     return $query->result_array();
    }
    
    function getusers_departmentWise()
    {
    $query = $this->db->query("SELECT gen_sub_logins.*, hr_employee_record.employee_name, campus.* FROM gen_sub_logins
                                INNER JOIN campus ON campus.campus_id = gen_sub_logins.campus_id
                                INNER JOIN hr_employee_record ON hr_employee_record.emp_id = gen_sub_logins.employee_id
                                ORDER BY gen_sub_logins.sub_login_id DESC");
     return $query->result_array();
    }
    function getEmployeeLoginData($employee_id)
    {
    $query = $this->db->query("SELECT gen_sub_logins.*, hr_employee_record.employee_name, campus.* FROM gen_sub_logins
                                INNER JOIN campus ON campus.campus_id = gen_sub_logins.campus_id
                                INNER JOIN hr_employee_record ON hr_employee_record.emp_id = gen_sub_logins.employee_id
                                WHERE gen_sub_logins.employee_id = '$employee_id'");
     return $query->result_array();
    }
    
      function addUserData($user_data)
    {
        $query = $this->db->insert('gen_sub_logins', $user_data); 
        return $this->db->insert_id();
    }
      function addUserModule($user_modules)
    {
        $query = $this->db->insert('user_module_rights', $user_modules); 
        return true;
        
    }
     function get_user_login($employee_id)
    {
        $this->db->select('sub_login_id');
        $query = $this->db->get_where('gen_sub_logins', array('employee_id' => $employee_id));
        return $query->row();
    }
    
    // check user rights 
    
    function checkRights($rights_data)
    {
        $query = $this->db->get_where('user_module_rights', $rights_data);
        return $query->result_array();
    }
    
    
    // get total no of inquiries 
    
    function inquiries()
    {
       
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {            
            $this->db->where('campus_id',$this->session->userdata('campus_id'));
            $this->db->where('campaign_id',$this->session->userdata('campaign_id'));
            return  $this->db->count_all_results('inquiry_os');
            
        }else{
            $this->db->where('campus_id',$this->session->userdata('campus_id'));
            $this->db->where('campaign_id',$this->session->userdata('campaign_id'));
            return $this->db->count_all_results('inquiry');
        }
    }
    
    // get total no of inquiries 
    
    function onlineinquiries()
    {
       $campaign_id     =   $this->session->userdata('campaign_id');
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {            
            $query      =   $this->db->query("select count(*) AS online from inquiry_os where inquiry_type = 'Online' and campaign_id = $campaign_id");            
            $result     =   $query->row();
            return          $result->online;
            
        }else{
            $query      =   $this->db->query("select count(*) AS online from inquiry where inquiry_type = 'Online' and campaign_id = $campaign_id");            
            $result     =   $query->row();
            return          $result->online;
        }
    }
    
    // get total no of inquiries 
    
    function getinquiries()
    { 
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $this->db->query('SELECT count(*)AS total_inquiries FROM inquiry_os AS inq right join prospectus_os AS pros ON pros.inquiry_id = inq.inquiry_id');
        }else{
            $query =  $this->db->query('SELECT count(*)AS total_inquiries FROM inquiry AS inq right join prospectus AS pros ON pros.inquiry_id = inq.inquiry_id');
        }
        $result = $query->result_array();
        return $result[0]['total_inquiries'];
        
    }
    // get prospectus inquiries 
    
    function getprospectus()
    { 
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $this->db->query('SELECT count(*)AS total_initial FROM prospectus_os AS pros right join initial_form_os AS initial ON initial.inquiry_id = pros.inquiry_id');
        }else{
            $query =  $this->db->query('SELECT count(*)AS total_initial FROM prospectus AS pros right join initial_form AS initial ON initial.inquiry_id = pros.inquiry_id');
        }
        $result = $query->result_array();
        return $result[0]['total_initial'];
        
    }
    // get initial
    
    function getinitial()
    { 
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $this->db->query('SELECT count(*)AS total_form FROM forms_os AS form inner join initial_form_os AS initial ON initial.inquiry_id = form.inquiry_id');
        }else{
            $query =  $this->db->query('SELECT count(*)AS total_form FROM forms AS form inner join initial_form AS initial ON initial.inquiry_id = form.inquiry_id');
        }
        $result = $query->result_array();
        return $result[0]['total_form'];
        
    }
    // get forms
    
    function getforms()
    { 
        $campus_id = $this->session->userdata('campus_id');
        if($campus_id == 1){$campus_id = 3;}
        $campaign_id = $this->session->userdata('campaign_id');
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {            
            $query =  $this->db->query("SELECT count(*)AS total_students From forms_os AS form inner join students_os ON students_os.form_id = form.form_id Where students_os.roll_no = '' AND form.campus_id = $campus_id AND form.campaign_id = $campaign_id ");
        }else{
            $query =  $this->db->query("SELECT count(*)AS total_students From forms AS form inner join students ON students.form_id = form.form_id Where students.roll_no = '' AND form.campus_id = $campus_id AND form.campaign_id = $campaign_id ");
        }
        $result = $query->result_array();
        //echo $this->db->last_query();die;
        return $result[0]['total_students'];
        
    }
    
    // get total no of prospectus sale
    
    function prospectus()
    {
        $campus_id = $this->session->userdata('campus_id');
        $campaign_id = $this->session->userdata('campaign_id');
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
           $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM prospectus_os AS prospectus RIGHT JOIN inquiry_os AS inquiry ON inquiry.`inquiry_id` = prospectus.`inquiry_id` WHERE inquiry.`campaign_id` = $campaign_id AND inquiry.`campus_id` = $campus_id");
        }else{
            $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM prospectus RIGHT JOIN inquiry ON inquiry.`inquiry_id` = prospectus.`inquiry_id` WHERE inquiry.`campaign_id` = $campaign_id AND inquiry.`campus_id` = $campus_id");
        }
        //echo $this->db->last_query();die;
        $result = $query->result_array();
        
        return $result[0]['total_students'];
    }
    
    // get total no of initital forms 
    
    function initial()
    {
       $campus_id = $this->session->userdata('campus_id');
        $campaign_id = $this->session->userdata('campaign_id');
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
           $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM initial_form_os AS initial_form RIGHT JOIN inquiry_os AS inquiry ON inquiry.`inquiry_id` = initial_form.`inquiry_id` WHERE inquiry.`campaign_id` = $campaign_id AND inquiry.`campus_id` = $campus_id AND inquiry.`admission_stage` > 0");
        }else{
            $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM initial_form RIGHT JOIN inquiry ON inquiry.`inquiry_id` = initial_form.`inquiry_id` WHERE inquiry.`campaign_id` = $campaign_id AND inquiry.`campus_id` = $campus_id AND inquiry.`admission_stage` > 0");
        }
//        echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result[0]['total_students'];
    }
    
    // get total no of complete forms
    
    function detailed()
    {
        $campus_id = $this->session->userdata('campus_id');
        $campaign_id = $this->session->userdata('campaign_id');
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
           $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM forms_os AS forms  WHERE campaign_id = $campaign_id AND campus_id = $campus_id");
        }else{            
            $query =  $this->db->query("SELECT COUNT(*) AS total_students FROM forms inner join inquiry on inquiry.inquiry_id = forms.inquiry_id WHERE forms.campaign_id = $campaign_id AND inquiry.campus_id = $campus_id and inquiry.admission_stage > 1");
        }
        // echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result[0]['total_students'];
    }
    
    // get total no of students
    
    function student()
    {
        $campus_id = $this->session->userdata('campus_id');
        if($campus_id == 1){$campus_id = 3;}
        $campaign_id = $this->session->userdata('campaign_id');
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            
            $query =  $this->db->query("select count(*) from students_os INNER JOIN forms_os ON forms_os.form_id = students_os.form_id where students_os.roll_no != '' AND  forms_os.inquiry_id != '0'  AND forms_os.campus_id = $campus_id AND forms_os.campaign_id = $campaign_id ");
        }else{
            $query =  $this->db->query("select count(*) from students INNER JOIN forms ON forms.form_id = students.form_id where students.roll_no != '' AND forms.inquiry_id != '0' AND forms.campus_id = $campus_id AND forms.campaign_id = $campaign_id ");
        }
        
       // echo $this->db->last_query();die;
        $result = $query->result_array();
        
        return $result[0]['count(*)'];
        
    }
    
    // Check Inquiry Record fromm DB
    function checkInquiry($check_inquiry)
    {
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->get_where('inquiry_os', $check_inquiry);
            return $query->row();
        }
        else{
              $query = $this->db->get_where('inquiry', $check_inquiry);
              return $query->row();
            }
    }
    function getInitialFormData($program_id, $campus_id)
    {
        $query =  $this->db->query("SELECT * FROM initial_form
                            WHERE initial_form.campus_id = '$campus_id' AND program_id = '$program_id'
                            ORDER BY initial_form_id ASC");
        $result = $query->result_array();
        return $result;
        
    }
    
    function getInitialFormDataProgram($campus_id, $shift)
    {
        $query =  $this->db->query("SELECT initial_form.program_id FROM initial_form
                                    WHERE initial_form.campus_id = '$campus_id' AND shift  = '$shift'
                                    GROUP BY initial_form.program_id
                                    ORDER BY initial_form_id ASC");
        $result = $query->result_array();
        return $result;
        
    }
    function UpdateInitial($initial_form_id, $serial, $form_num)
    {
        $query =  $this->db->query("update initial_form set serial = '$serial', f_num = '$form_num' where initial_form_id = '$initial_form_id'");
        //$result = $query->result_array();
        echo "update initial_form set serial = '$serial', f_num = '$form_num' where initial_form_id = '$initial_form_id'";
        return $query;
        
    }
    function UpdateFinal($inquiry_id,$new_form_num)
    {
        $query =  $this->db->query("update forms set f_new = '$new_form_num' where inquiry_id = '$inquiry_id'");
        //$result = $query->result_array();
        return $query;
        
    }
    // **************START           Entry Test Module         ************** \\
    
        // check duplication of $room name
    
            function checkRoom($room)
            {
                $query = $this->db->get_where('rooms', $room);
                return $query->result_array();
            }    

            // add Room in db

            function addRoom($room)
            {
                $query = $this->db->insert('rooms', $room); 		
                return $this->db->insert_id();
            }

            // get all Room from db

            function getAllrooms()
            {      
                $this->db->order_by('room_id', 'DESC'); 
                $query = $this->db->get('rooms');

                return $query->result_array();
            }

            // get a Room for update

            function getRoom($id)
            {       
                $query = $this->db->get_where('rooms', array('room_id' => $id));

                return $query->result_array();
            }

            // update the Room name

            function updateRoom($id,$room)
            {
                $this->db->where('room_id', $id);
                $query = $this->db->update('rooms', $room);

                return $query;        
            }
            
            
            
            
    
        // check duplication of test name
    
            function checkTest($test)
            {
                $query = $this->db->get_where('entry_test', $test);
                return $query->result_array();
            }    

            // add test in db

            function addTest($test)
            {
                $query = $this->db->insert('entry_test', $test); 		
                return $this->db->insert_id();
            }

            // get all test from db

            function getAlltests()
            {   
                $this->db->select('entry_test.*,campaign.campaign_name');
                $this->db->from('entry_test');
                $this->db->join('campaign','entry_test.campaign_id = campaign.campaign_id');
                $this->db->order_by('entry_test.test_id', 'DESC'); 
                $query = $this->db->get();

                return $query->result_array();
            }

            // get a Room for update

            function getTest($id)
            {       
                $query = $this->db->get_where('entry_test', array('test_id' => $id));

                return $query->result_array();
            }

            // update the Room name

            function updateTest($id,$test)
            {
                $this->db->where('test_id', $id);
                $query = $this->db->update('entry_test', $test);

                return $query;        
            }
    
    // **************           Entry Test Module         END************** \\
     function form_info($form_id){
              if($this->session->userdata('role') == 'OS'){  
                $query =  $this->db->query("
                                SELECT students.*,forms.*,programs.program_name,campaign.campaign_name,campus.campus_name
                                FROM students_os AS students
                                INNER JOIN forms_os AS forms ON students.form_id = forms.form_id
                                INNER JOIN 
                                    programs
                                ON 
                                    programs.program_id = forms.program_id
                                INNER JOIN 
                                    campaign
                                ON 
                                    campaign.campaign_id = forms.campaign_id
                                INNER JOIN 
                                    campus
                                ON 
                                    campus.campus_id = forms.campus_id
                                WHERE forms.form_id = '$form_id'
                                ");
              }else{
                  
                  $query =  $this->db->query("
                                SELECT students.*,forms.*,programs.program_name,campaign.campaign_name,campus.campus_name 
                                FROM students
                                INNER JOIN forms ON students.form_id = forms.form_id
                                INNER JOIN 
                                    programs
                                ON 
                                    programs.program_id = forms.program_id
                                INNER JOIN 
                                    campaign
                                ON 
                                    campaign.campaign_id = forms.campaign_id
                                INNER JOIN 
                                    campus
                                ON 
                                    campus.campus_id = forms.campus_id
                                WHERE forms.form_id = '$form_id'
                                ");
              }
              
                
                //$query = $this->db->get_where('forms', array('form_id' => $form_id));
                //echo $this->db->last_query();die;
                return $query->result_array();
            }
            
            // update form data 
            function form_info_update($form_no,$shift,$program,$campus,$inquiry_id,$form_id,$modify_date){
                
                if($this->session->userdata('role') == 'OS'){
                    $query =  $this->db->query("  
                                    UPDATE 
                                        forms_os
                                    SET 
                                        form_no = '$form_no',shift =  '$shift' , program_id = '$program' , campus_id = '$campus' ,inquiry_id  = $inquiry_id , form_modified_date = '$modify_date' WHERE form_id = '$form_id'");
                }else{
                    $query =  $this->db->query("  
                                    UPDATE 
                                        forms
                                    SET 
                                        form_no = '$form_no',shift =  '$shift' , program_id = '$program' , campus_id = '$campus' ,inquiry_id  = $inquiry_id , form_modified_date = '$modify_date' WHERE form_id = '$form_id'");
                }
                return $query;
            }
            
            function initial_form_info_update($form_no,$shift,$program,$campus,$inquiry_id, $serial){
                if($this->session->userdata('role') == 'OS'){
                    $query =  $this->db->query("  
                                    UPDATE 
                                         initial_form_os
                                    SET 
                                        form_no = '$form_no',shift =  '$shift' , program_id = '$program' , campus_id = '$campus', serial = '$serial'  WHERE  inquiry_id  = $inquiry_id");
                }else{
                    $query =  $this->db->query("  
                                    UPDATE 
                                         initial_form
                                    SET 
                                        form_no = '$form_no',shift =  '$shift' , program_id = '$program' , campus_id = '$campus', serial = '$serial'  WHERE  inquiry_id  = $inquiry_id");
                }
                return $query;
                
            }
            
            function student_update($form_no,$shift,$form_id){
                
                if($this->session->userdata('role') == 'OS'){
                    $query =  $this->db->query("  
                                UPDATE 
                                     students_os
                                SET 
                                    form_no = '$form_no', shift= '$shift' WHERE form_id = $form_id ");
                    
                }else{
                    $query =  $this->db->query("  
                                UPDATE 
                                     students
                                SET 
                                    form_no = '$form_no', shift= '$shift' WHERE form_id = $form_id ");
                }
                return $query;
                
            }
            
            
            // ********************   Entry Test Function   ******************** \\
            
            
               // get students list program wise
            
                function getStudentsList($campus_id,$program_id,$campaign_id)
                {
                     $this->db->select('forms.form_id,forms.form_no,forms.student_name,forms.program_id,programs.program_name');
                     $this->db->from('forms');
                     $this->db->join('programs','forms.program_id = programs.program_id');
                     $this->db->where(array('forms.program_id' =>$program_id, 'forms.campus_id' =>$campus_id, 'campaign_id'=>$campaign_id));
                     $this->db->order_by("form_id", "ASC");         
                     $query = $this->db->get();
                     return $query->result_array();
                }
                
                // check duplicate result
                
                function checkEntryTestResult($room_id,$tes_id)
                {
                    $this->db->select('*');
                    $this->db->from('entrytest_results');
                    $this->db->where(array('room_id'=>$room_id,'test_id'=>$tes_id));
                    $query = $this->db->get();
                    //echo $this->db->last_query();die;
                    return  $query->result_array();                    
                }
                
                
                // add entry test result  in database
                
                function addMarks($result_data){
                    
                            $query = $this->db->insert('entrytest_results', $result_data); 
                            return $this->db->insert_id();
                }
                
                function ShowHideResult($test_id,$status){
                    $query  =   $this->db->query("update entrytest_results set live_status = $status where test_id = $test_id");
                    return $this->db->affected_rows();
                }

                // check marks not already exitst
                
                function CheckResult($form_id)
                {
                    $form_id = array('form_id'=>$form_id);
                    $query = $this->db->get_where('entrytest_results', $form_id);
                    return $query->result_array();
                }


                // get all students entry test marks
                
                function getallMarks($test_id){
                    
                    $this->db->select('res.entrytest_result_id,res.form_no,res.name,res.marks,programs.program_name,rooms.room_name');                    
                    $this->db->from('entrytest_results res');
                    $this->db->join('programs ', 'res.program_id = programs.program_id');
                    $this->db->join('rooms', 'res.room_id = rooms.room_id');                    
                    $this->db->where('res.test_id',$test_id);    
                    $this->db->order_by("res.entrytest_result_id", "ASC"); 
                    $query = $this->db->get();
                    return $query->result_array();
                }
                
                // get all students entry test marks
                
                function getMarks($id){
                    
                    $this->db->select('res.entrytest_result_id,res.form_no,res.name,res.marks,programs.program_name,rooms.room_name');                    
                    $this->db->from('entrytest_results res');
                    $this->db->join('programs ', 'res.program_id = programs.program_id');
                    $this->db->join('rooms', 'res.room_id = rooms.room_id');
                    $this->db->where('res.entrytest_result_id',$id);                    
                    $query = $this->db->get();
                   
                    
                    return $query->result_array();
                }
                
                // update marks in database
                
                function updateMarks($id, $marks)
                {
                    
                    $this->db->where('entrytest_result_id', $id);
                    return $query = $this->db->update('entrytest_results', $marks);
                        
                    
                }
                
                
                // ***   Entry Test Reports Start   *** \\
            
                   // program wise result summary 
                    
                    function resultSummaryProgram($tes_id)
                    {
                        $query =  $this->db->query("SELECT count(e_r.marks != 'a') As total, sum(e_r.`marks` >= 50)As pass, sum(e_r.`marks` < 50 and e_r.marks != 'a' )As fail,
                                                        sum(e_r.marks = 'a') AS absent,
                                                        programs.program_name,rooms.room_name,entry_test.test_no,entry_test.test_date,entry_test.test_time
                                                        from entrytest_results as e_r

                                                        INNER JOIN programs on programs.program_id = e_r.program_id
                                                        INNER JOIN rooms on rooms.room_id = e_r.room_id
                                                        INNER JOIN entry_test on entry_test.test_id = e_r.test_id

                                                        where e_r.test_id = $tes_id 
                                                        AND e_r.marks != 'Z'
                                                        group by e_r.program_id");
                        
                       // echo $this->db->last_query();die;
                        return $query->result_array();
                        
                    }
                
                   // program wise result summary 
                    
                    function programDetail($status,$program_id,$tes_id)
                    {
                        
                        $query =  $this->db->query("SELECT e_r.form_no,e_r.name,e_r.marks,
                                                        programs.program_name,entry_test.test_no,entry_test.test_date,entry_test.test_time
                                                        from entrytest_results as e_r
                                                        INNER JOIN programs on programs.program_id = e_r.program_id
                                                        INNER JOIN entry_test on entry_test.test_id = e_r.test_id
                                                        where 
                                                        e_r.marks  != 'z' AND
                                                        e_r.test_id = $tes_id AND
                                                        e_r.program_id = $program_id 
                                                         $status
                                                        order by e_r.`entrytest_result_id`
                                                        ");
                        
                        //echo $this->db->last_query();die;
                        return $query->result_array();
                        
                    }
                    
                    
                    // program wise result summary 
                    
                    function programDetailInfo($status,$program_id,$tes_id)
                    {
                        
                        $query =  $this->db->query("SELECT e_r.form_no,e_r.name,e_r.marks,initial_form.mobile,
                                                        programs.program_name,entry_test.test_no,entry_test.test_date,entry_test.test_time
                                                        from entrytest_results as e_r
                                                        INNER JOIN initial_form ON initial_form.initial_form_id = e_r.form_id
                                                        INNER JOIN programs on programs.program_id = e_r.program_id
                                                        INNER JOIN entry_test on entry_test.test_id = e_r.test_id
                                                        where 
                                                        e_r.test_id = $tes_id
                                                        $program_id 
                                                        $status
                                                        and e_r.marks != 'z'
                                                        order by e_r.`entrytest_result_id`
                                                        ");
                        
                        //echo $this->db->last_query();die;
                        return $query->result_array();
                        
                    }
                    
                    
                    // get fail students for add grace marks
                    
                    function getFailStudents($test_id,$program_id,$criteria)
                    {
                        $query =  $this->db->query("SELECT marks,`entrytest_result_id` as id FROM `entrytest_results` 
                                                        where 
                                                        program_id = $program_id AND 
                                                        test_id    = $test_id AND 
                                                        marks <= $criteria and
                                                        marks != 'A' and
                                                        marks != 'Z'
                                
                                                        ");
                        return $query->result_array();
                    }
                    
                    // add grace marks to fail students
                    
                    function addGraceMarks($id,$update_data)
                    {
                        $this->db->where('entrytest_result_id', $id);
                        return $query = $this->db->update('entrytest_results', $update_data);
                    }
                
                    
                    
                    
                    
                    
          /* for interview start */
 
            public function getinterview_listing($programs_id,$campus_id,$campaign_id , $exisitng_ids)
            {
                
                $var1          = $campus_id   == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
                $var2          = $programs_id == 0  ? ''  : "AND `forms`.program_id = $programs_id";
                
                $exisitng_ids  = $exisitng_ids == ''  ? ''  : "AND `forms`.form_id NOT IN ($exisitng_ids)";
                //SELECT *  , (entrytest_results.marks + entrytest_results.grace_marks ) as sumTotal FROM 
         /*       echo "
                    SELECT *  FROM 
                        forms
                    INNER JOIN 
                        programs
                    ON 
                        programs.program_id = forms.program_id
                    INNER JOIN 
                        campaign
                    ON 
                        campaign.campaign_id = forms.campaign_id
                    INNER JOIN 
                        campus
                    ON 
                        campus.campus_id = forms.campus_id
                    INNER JOIN 
                        entrytest_results 
                    ON 
                        entrytest_results.form_id = forms.form_id
                    Where 
                        entrytest_results.marks >= 50 
                    AND
                        forms.program_id 	 = '$programs_id'
                    AND 
                        `forms`.campus_id        = $campus_id
                    AND 
                        forms.campaign_id 	 = '$campaign_id'
                    $exisitng_ids

                ";exit; */
                $query = $this->db->query("
                    SELECT *  FROM 
                        forms
                    INNER JOIN 
                        programs
                    ON 
                        programs.program_id = forms.program_id
                    INNER JOIN 
                        campaign
                    ON 
                        campaign.campaign_id = forms.campaign_id
                    INNER JOIN 
                        campus
                    ON 
                        campus.campus_id = forms.campus_id
                    
                    Where 
                        
                        forms.program_id 	 = '$programs_id'
                    AND 
                        `forms`.campus_id        = $campus_id
                    AND 
                        forms.campaign_id 	 = '$campaign_id'
                    $exisitng_ids

                ");
                //echo $this->db->last_query();exit;
                return $query->result_array();
                
            }
 
            public function SinfoInter($form_id,$form_no,$name,$program_id,$opertaor_id,$date ){
                
                // check duplication 
                $query1 = $this->db->get_where('interview_results', array('form_no' => $form_no));
                
                if ($query1->num_rows() > 0){
                    //echo '<pre>';var_dump($query1);exit;
                    $query = 'Already exists';
                    return $query;
                }else{
                    //echo "INSERT INTO interview_results VALUES ('','$form_id','$form_no','$name','$program_id','$opertaor_id','$date','$entrytest_result_id')";exit;
                     $date = date('Y-m-d');
                    $query = $this->db->query("INSERT INTO interview_results VALUES ('','$form_id','$form_no','$name','$program_id','$date',".$this->session->userdata('sub_login_id').",'')");
                
                    return $query;
                }
                
            }
            
            public function interview_ids($program_id){
                $query = $this->db->get_where('interview_results', array('program_id' => $program_id));
                
                return $query->result_array();
            }
            
            public function forms_ids($program_id){
                $query = $this->db->get_where('interview_results', array('program_id' => $program_id));
                return $query->result_array();
            }
            
            
            // get campaign code 
    
            function getCampaignName($campaign_id)
            {
                $this->db->select('campaign_name');
                $query = $this->db->get_where('campaign', array('campaign_id' => $campaign_id));
                return $query->row();
            }

            // get program code 

            function getProgramName($program_id)
            {
                $this->db->select('program_name');
                $query = $this->db->get_where('programs', array('program_id' => $program_id));
                return $query->row();
            }
            
            function getCampusName($campus_id)
            {
                $this->db->select('campus_name');
                $query = $this->db->get_where('campus', array('campus_id' => $campus_id));
                return $query->row();
            }
            
            public function conducted_interviews(){
                    $query = $this->db->query("
                    SELECT *  FROM 
                         interview_results
                    INNER JOIN 
                        programs
                    ON 
                        programs.program_id = interview_results.program_id

                ");
                return $query->result_array();
            }
            
            public function getTests(){
                
                $query = $this->db->get('entry_test');
                return $query->result_array();
            }
            
            public function programwise_interview_view_report($test_id){
                
                $query =  $this->db->query(
                                "SELECT 
                                        count(e_r.marks != 'a') As total, sum(e_r.`marks` >= 50)As pass, 
                                        sum(e_r.`marks` < 50)As fail,
                                        programs.program_name,rooms.room_name,entry_test.test_no,entry_test.test_date,entry_test.test_time
                                from entrytest_results as e_r

                                INNER JOIN programs on programs.program_id = e_r.program_id
                                INNER JOIN rooms on rooms.room_id = e_r.room_id
                                INNER JOIN entry_test on entry_test.test_id = e_r.test_id
                                INNER JOIN entry_test on entry_test.test_id = entrytest_results.test_id
                                INNER entrytest_results on entrytest_results.test_id = interview_results.entrytest_result_id

                                where e_r.test_id = $test_id
                                group by e_r.program_id");
                return $query->result_array();
            }
            
            
            
            
            /* for interview end*/
            
            
            
            //   *****   Revise program code   *****   \\
            
            function  getInitialData($old)
            {
                $query = $this->db->query("select initial_form_id,form_no from initial_form
                                    where form_no like '$old'  ");
                return $query->result_array();
            }
            
            function updateCode($id,$new_form_no)
            {
                $this->db->where('initial_form_id', $id);
                            
                return $query = $this->db->update('initial_form', array('form_no'=>$new_form_no)); 
            }


            // get new form no from initial_form table
            
            function getNewFormNo()
            {
                $query = $this->db->query("SELECT  forms.form_no As new_form_no,students.student_id from `forms` 
                                            INNER JOIN students ON forms.form_id = students.form_id
                                            where 
                                            forms.inquiry_id != 0");
//                $query = $this->db->query("SELECT  initial_form.form_no As new_form_no,forms.form_id from `initial_form` 
//                                            INNER JOIN forms ON initial_form.inquiry_id = forms.inquiry_id ");
                return $query->result_array();
            }
            
            // update new form no in forms table
            function updateFormNo($newFormNo,$student_id)
            {
                 $this->db->where('student_id', $student_id);
                            
                return $query = $this->db->update('students', array('form_no'=>$newFormNo)); 
            }


            
            function getAllinquiries2()
    {   
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        { 
                    $this->db->select('inq.*');
                    $this->db->select('prog.program_name');
                    $this->db->select('ref.reference_source');
                    $this->db->select('pros.prospectus_id');
                    $this->db->from('inquiry_os inq');
                    $this->db->join('programs prog', 'inq.program_id = prog.program_id','inner');
                    $this->db->join('reference ref', 'inq.reference_id = ref.reference_id','inner');
                    $this->db->join('prospectus_os pros', 'inq.inquiry_id = pros.inquiry_id', 'left');
                    //$this->db->where('inq.campus_id',$this->session->userdata('campus_id') );
                    $this->db->order_by("inq.inquiry_id", "desc");                     
                    $query = $this->db->get();         
                    
        }else{
                    $this->db->select('inq.*');
                    $this->db->select('prog.program_name');
                    $this->db->select('ref.reference_source');
                    $this->db->select('pros.prospectus_id');
                    $this->db->from('inquiry inq');
                    $this->db->join('programs prog', 'inq.program_id = prog.program_id','inner');
                    $this->db->join('reference ref', 'inq.reference_id = ref.reference_id','inner');
                    $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id', 'left');
                    if($this->session->userdata('role') != 'HOD'){
                        $this->db->where('inq.campus_id',$this->session->userdata('campus_id') );
                    }
                    
                    $this->db->order_by("inq.inquiry_id", "desc");                     
                    
                    $query = $this->db->get();
                    //echo $this->db->last_query();die;

        }
       
        return $query->result_array();
    } 
            
            
         function  update($inquiry_id){
               if($this->session->userdata('role') == 'OS'){
                   $this->db->where('inquiry_id', $inquiry_id);
                $this->db->update('inquiry_os', array('prospectus_sale'=>1)); 
                return $this->db->affected_rows();
               }else{
                   $this->db->where('inquiry_id', $inquiry_id);
                   $this->db->update('inquiry', array('prospectus_sale'=>1)); 
                   return $this->db->affected_rows();
               }
            }
            
     // get all  sold prospectuses
 
    
    function getSingleprospectus($inquiry_id)
    {    
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inq.inquiry_id,inq.inquiry_no,inq.name,inq.contact,inq.admission_stage');
                $this->db->select('prog.program_name');
                $this->db->select('pros.quantity,pros.total_price,pros.sale_date');
                $this->db->select('products.product_name');

                $this->db->from('inquiry_os inq');
                $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
                $this->db->join('prospectus_os pros', 'inq.inquiry_id = pros.inquiry_id', 'inner');
                $this->db->join('products', 'products.product_id = pros.product_id', 'inner');        
                $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                $this->db->where('inq.prospectus_sale',1 );
                $this->db->where('pros.inquiry_id',$inquiry_id );
                $this->db->order_by("pros.prospectus_id", 'DESC'); 
                $query = $this->db->get();
        }else
            {
                $this->db->select('inq.inquiry_id,inq.inquiry_no,inq.name,inq.contact,inq.admission_stage');
                $this->db->select('prog.program_name');
                $this->db->select('pros.quantity,pros.total_price,pros.sale_date');
                $this->db->select('products.product_name');

                $this->db->from('inquiry inq');
                $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'inner');
                $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id', 'inner');
                $this->db->join('products', 'products.product_id = pros.product_id', 'inner');                     
                $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
                $this->db->where('inq.prospectus_sale',1 );
                $this->db->where('pros.inquiry_id',$inquiry_id );
                $this->db->order_by("pros.prospectus_id", 'DESC'); 
                $query = $this->db->get();
            }
        //echo $this->db->last_query();die;
        return $query->result_array();
    } 
    
    
     //View  single Initial Form
    
    function getSingleInitialForms($inquiry_id)
    {
          // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('initial_form.*');
                $this->db->select('inquiry.inquiry_no,inquiry.admission_stage');
                $this->db->select('campus.campus_name');
                $this->db->select('programs.program_name');
                $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
                $this->db->select('operator_types.name');
                $this->db->from('initial_form_os initial_form');
                $this->db->join('inquiry_os inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');
                $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'inner');
                $this->db->join('programs', 'programs.program_id = initial_form.program_id', 'inner');
                $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
                $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
                $this->db->where('inquiry.inquiry_id',$inquiry_id );                                
                $query = $this->db->get();
        }else{
            
                $this->db->select('initial_form.*');
                $this->db->select('inquiry.inquiry_no,inquiry.admission_stage');
                $this->db->select('campus.campus_name');
                $this->db->select('programs.program_name');
                $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
                $this->db->select('operator_types.name');
                $this->db->from('initial_form');
                $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'inner');
                $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'inner');
                $this->db->join('programs', 'programs.program_id = initial_form.program_id', 'inner');
                $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
                $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
                $this->db->where('inquiry.inquiry_id',$inquiry_id );
                $query = $this->db->get();
                //echo $this->db->last_query();die;
        }                

        return $query->result_array();
    }
     
    
    // get initial form id using inquriy id
 
        function getInitialFormId2($inquiry_id)
        {
            $this->db->select('initial_form_id');
      
            if($this->session->userdata('role') == 'OS')
            {
                   $this->db->from('initial_form_os');
            }else{
                   $this->db->from('initial_form');
            }
            $this->db->where('inquiry_id', $inquiry_id);
            $query = $this->db->get();
                       
             if($query->num_rows() > 0)
            {          
               return $query->row();
            }else{
                return NULL;
            }
        }
    

 function getSingleStudentForms($inquiry_id)
   {

     // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
                $this->db->select('students.student_id','students.form_id', 'students.batch_id');
                $this->db->select('inquiry.admission_stage');
                //$this->db->select('forms.*');
                $this->db->select('forms.*,forms.form_id as FORMID');
                $this->db->select('batch.*');
                $this->db->from('students_os students');
                $this->db->join('forms_os forms', 'students.form_id = forms.form_id', 'inner');
                $this->db->join('inquiry_os inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
                $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');
                $this->db->where('forms.inquiry_id != 0');
                $this->db->where('forms.inquiry_id',$inquiry_id);
                $query = $this->db->get();
     }else{
                $this->db->select('students.student_id','students.form_id', 'students.batch_id');
                $this->db->select('inquiry.admission_stage');
                //$this->db->select('forms.*');
                $this->db->select('forms.*,forms.form_id  as FORMID');
                $this->db->select('batch.*');
                $this->db->from('students');
                $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
                $this->db->join('inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
                $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');                
                $this->db->where('forms.inquiry_id != 0');
                $this->db->where('forms.inquiry_id',$inquiry_id);
                $query = $this->db->get();
     }
     
     return $query->result_array();
   }        
   
   
   
        
            // ********************   Entry Test Functions End   ******************** \\
            
}

