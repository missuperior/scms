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
        $this->db->from('inquiry');
        $this->db->order_by("inquiry_id", "DESC");         
        $query = $this->db->get();
        return $query->row();
    }

    // get last table initial_form id
    
   /* function getLastInitialFormId($program_id)
    {
        $this->db->select('initial_form_id');
        $this->db->from('initial_form');
        $this->db->where('program_id',$program_id);
        $this->db->order_by("initial_form_id", "DESC");         
        $query = $this->db->get();
        return $query->row();
    }*/
    // get last table initial_form id
    
    function getLastInitialFormId()
    {
        $this->db->select('initial_form_id');
        $this->db->from('initial_form');        
        $this->db->order_by("initial_form_id", "DESC");         
        $query = $this->db->get();
        return $query->row();
    }



    // add new inquiry in db
    
    function addInquiry($inquiry_data)
    {
        $query = $this->db->insert('inquiry', $inquiry_data); 
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
        $query = $this->db->insert('inquiry_references', $reference_data); 
        return $this->db->insert_id();
    }
    
     // get all Inquiries data from db
    
    function getAllinquiries()
    {        
        $this->db->select('inq.*');
        $this->db->select('prog.program_name');
        $this->db->select('ref.reference_source');
        $this->db->select('pros.prospectus_id');
        $this->db->from('inquiry inq');
        $this->db->join('programs prog', 'inq.program_id = prog.program_id');
        $this->db->join('reference ref', 'inq.reference_id = ref.reference_id');
        $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id', 'left');
        if($this->session->userdata('role') != 'HOD'){
            $this->db->where('inq.campus_id',$this->session->userdata('campus_id') );
        }
        $this->db->order_by("inq.inquiry_id", "desc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a Inquiry record for update
    function getInquiry($id)
    {    
        $this->db->select('inq.*,pros.prospectus_id');
        $this->db->from('inquiry inq');
        $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id','left');
        $this->db->where('inq.inquiry_id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*function getInquiry($id)
    {        
        $query = $this->db->get_where('inquiry', array('inquiry_id' => $id));
        return $query->result_array();
    }*/
     
    
    // get a Inquiry reference record for update
    function getInquiryReference($id)
    {        
        $query = $this->db->get_where('inquiry_references', array('inquiry_id' => $id));
        return $query->result_array();
    }
     
    
    
    
    function getInquiry2($id)
    {   
        $this->db->select('inquiry.inquiry_id,inquiry_no,campaign_id,name,contact,phone,program_id,shift,gender,qualification,total_marks,obtained_marks,reference_id,inquiry_type,previous_institute,remarks,inquiry.operator_id,inquiry_date,admission_stage');
        $this->db->select('prospectus.campus_id');
        $this->db->from('inquiry');
        $this->db->join('prospectus', 'inquiry.inquiry_id = prospectus.inquiry_id');
        $this->db->where('inquiry.inquiry_id ='.$id);
        $query = $this->db->get();
        return $query->result_array();
        
        
//        $query = $this->db->get_where('inquiry', array('inquiry_id' => $id));
//        return $query->result_array();
    }
        
     // update the Inquiry record
    
    function updateInquiry($id,$inquiry_data)
    {
        $this->db->where('inquiry_id', $id);
        $query = $this->db->update('inquiry', $inquiry_data); 
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
        $query = $this->db->update('inquiry_references', $reference_data); 
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
        $query = $this->db->get_where('initial_form', $inquiry);
        return $query->result_array();
    }
	
	 // add new Initial Form in db
    
    function addInitialForm($initial_form_data,$inquiry_id)
    {
        
        $query          = $this->db->insert('initial_form', $initial_form_data); 
        $initial_id     =   $this->db->insert_id();
        if($initial_id)
        {
            $this->db->where('inquiry_id', $inquiry_id);
            $query2 = $this->db->update('inquiry', array('admission_stage' => 1)); 
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
        $this->db->select('initial_form.*');
        $this->db->select('inquiry.inquiry_no,inquiry.admission_stage');
        $this->db->select('campus.campus_name');
        $this->db->select('programs.program_name');
        $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
        $this->db->select('operator_types.name');
        $this->db->from('initial_form');
        $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'left');
        $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'left');
        $this->db->join('programs', 'programs.program_id = initial_form.program_id', 'left');
        $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
        $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
        if($this->session->userdata('role') != 'HOD'){
            $this->db->where('initial_form.campus_id',$this->session->userdata('campus_id') );
        }
        $this->db->order_by("initial_form.initial_form_id", "DESC");         
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a Initial Form for update
    
    function getInitialForm($initial_form_id)
    {   
        $this->db->select('initial_form.initial_form_id,initial_form.form_no,initial_form.student_name,initial_form.mobile,initial_form.program_id,initial_form.shift,initial_form.gender,initial_form.qualification,initial_form.total_marks,initial_form.obtained_marks,initial_form.campus_id');
        $this->db->select('inquiry.inquiry_id,inquiry.campaign_id,inquiry.previous_institute');
        $this->db->select('campaign.campaign_name');
        $this->db->from('initial_form');
        $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'left');             
        $this->db->join('campaign', 'inquiry.campaign_id = campaign.campaign_id', 'left');             
        $this->db->where('initial_form.initial_form_id = '.$initial_form_id);
        $query = $this->db->get();

        return $query->result_array();
        
    }
    
    
   
    //--------------End Initial Form----------\\
    
    
    
    // ------------    Start Complete form -----------------\\
     
    // check form no duplication
    function checkFormNo($form_no)
    {
        $query = $this->db->get_where('forms', $form_no);
	return $query->result_array();
    }

    // insert data into student and forms table
    
   function addForm($student_data,$form_data,$inquiry_id)
   {
        $this->db->trans_start();

        $query = $this->db->insert('forms', $form_data);
        $form_id = $this->db->insert_id();
        
        $student_data['form_id'] = $form_id;
        
        $query = $this->db->insert('students', $student_data);
        $student_id = $this->db->insert_id();

        $this->db->trans_complete(); 

        if($student_id)
        {
            $this->db->where('inquiry_id', $inquiry_id);
            $query = $this->db->update('inquiry', array('admission_stage' => 2)); 
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
             $this->db->delete('forms');
             return $form_id.' Record Not Added';
        }
   } 
   
   function getAllStudentForms()
   {

     $this->db->select('students.student_id', 'students.form_id', 'students.batch_id');
     $this->db->select('students.student_id','students.form_id', 'students.batch_id');
     $this->db->select('inquiry.admission_stage');
     $this->db->select('forms.*');
     $this->db->select('batch.*');
     $this->db->from('students');
     $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
     $this->db->join('inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'left');
     $this->db->join('batch', 'students.batch_id = batch.batch_id', 'left');
     if($this->session->userdata('role') != 'HOD'){
            $this->db->where('forms.campus_id',$this->session->userdata('campus_id') );            
        }
     $this->db->where('forms.inquiry_id != 0');
     $this->db->order_by("students.student_id", "DESC");
     $query = $this->db->get();
     
     return $query->result_array();
   }
   
   // get student to be edited
   
   function getStudentForm($student_id)
   {
     $this->db->select('students.*');
     $this->db->select('forms.*');
     $this->db->from('students');
     $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
     $this->db->where($student_id);
     $query = $this->db->get();
     
     return $query->result_array();
   }
   
   // update student record
   
   function updateForm($student_data,$form_data,$form_id,$student_id)
   {
       
       $this->db->where('form_id', $form_id);
       $result =  $this->db->update('forms', $form_data);
       
       if($result)
       {
           $this->db->where('student_id', $student_id);
           return $res =  $this->db->update('students', $student_data);
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
     $this->db->select('inquiry_id');
     $this->db->from('inquiry');
     $this->db->where('inquiry_no', $inquiry_no);
     $query = $this->db->get();
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
     $this->db->from('initial_form');
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
     
     $this->db->select('inq.inquiry_no,inq.name,inq.contact,inq.qualification,inq.campus_id,inq.inquiry_date');
     $this->db->select('prog.program_name');
     $this->db->from('inquiry inq');
     $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'left');
     $this->db->where('inq.inquiry_id ='.$inquiry_id);
     $query = $this->db->get();
//     if($query->num_rows() > 0)
//     {          
        return $query->row();
//     }else{
//         echo 'in else';
//     }
     
 }




 // add prospectus data in database 
 
 function addProspectus($prospectus_data)
 {
     $query = $this->db->insert('prospectus', $prospectus_data); 
     $id    = $this->db->insert_id();
     
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
        $this->db->select('inq.inquiry_id,inq.inquiry_no,inq.name,inq.contact,inq.admission_stage');
        $this->db->select('prog.program_name');
        $this->db->select('pros.quantity,pros.total_price,pros.sale_date');
        $this->db->select('products.product_name');
                
        $this->db->from('inquiry inq');
        $this->db->join('programs prog', 'inq.program_id = prog.program_id', 'left');
        $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id', 'left');
        $this->db->join('products', 'products.product_id = pros.product_id', 'left');        
        if($this->session->userdata('role') != 'HOD'){
            $this->db->where('inq.campus_id =',$this->session->userdata('campus_id') );
            $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
        }else{
        $this->db->where('inq.inquiry_id = pros.inquiry_id' );        
        }
        $this->db->order_by("pros.prospectus_id", 'DESC'); 
        $query = $this->db->get();

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
        return $this->db->count_all_results('inquiry');
    }
    
    // get total no of inquiries 
    
    function getinquiries()
    { 
        $query =  $this->db->query('SELECT count(*)AS total_inquiries FROM inquiry AS inq right join prospectus AS pros ON pros.inquiry_id = inq.inquiry_id');
        $result = $query->result_array();
        return $result[0]['total_inquiries'];
        
    }
    
    // get total no of prospectus sale
    
    function prospectus()
    {
        return $this->db->count_all_results('prospectus');
    }
    
    // get total no of initital forms 
    
    function initial()
    {
        return $this->db->count_all_results('initial_form');
    }
    
    // get total no of complete forms
    
    function detailed()
    {
        $query =  $this->db->query('select count(*) from forms where inquiry_id != "0" ');
        $result = $query->result_array();
        return $result[0]['count(*)'];
    }
    
    // get total no of students
    
    function student()
    {
        $query =  $this->db->query('select count(*) from students INNER JOIN forms ON forms.form_id = students.form_id where inquiry_id != "0" ');
        $result = $query->result_array();
        return $result[0]['count(*)'];
        
    }
    
}

