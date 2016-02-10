<?php

class Admission_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    
    // admin login 
    
    function adminLogin($login_data)
    {
        
        $query = $this->db->get_where('gen_account_logins', $login_data);
        return $query->row();           
    }
    
    //   ***** Start function for Inquiry Module *****   //
    
    
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
    
    
    

    // add new inquiry in db
    
    function addInquiry($inquiry_data)
    {
        $query = $this->db->insert('inquiry', $inquiry_data); 
        return $this->db->insert_id();
    }
    
     // get all Inquiries data from db
    
    function getAllinquiries()
    {        
        $this->db->select('inquiry_id,inquiry_no,name,contact,inquiry_date');
        $this->db->select('prog.program_name');
        $this->db->from('inquiry inq');
        $this->db->join('programs prog', 'inq.program_id = prog.program_id');
        $this->db->order_by("inq.inquiry_id", "desc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a Inquiry record for update
    
    function getInquiry($id)
    {       
        $query = $this->db->get_where('inquiry', array('inquiry_id' => $id));
        return $query->result_array();
    }
        
     // update the Inquiry record
    
    function updateInquiry($id,$inquiry_data)
    {
        $this->db->where('inquiry_id', $id);
        $query = $this->db->update('inquiry', $inquiry_data); 
        return $query;        
    }
    
    
    
    
      
    
    //--------////  Start Initial Form \\\\--------\\
    
     // check duplication of Initial Form
    
    function checkInitialForm($check_initial_form)
    {
        $query = $this->db->get_where('initial_form', $check_initial_form);
        return $query->result_array();
    }
	
	 // add new Initial Form in db
    
    function addInitialForm($initial_form_data)
    {
        $query = $this->db->insert('initial_form', $initial_form_data); 
        return $this->db->insert_id();
    }
    
     //View all Initial Form
    
    function getAllInitialForms()
    {
        $this->db->select('initial_form.*');
        $this->db->select('inquiry.inquiry_no');
        $this->db->select('campus.campus_name');
        $this->db->select('operator_logins.operator_login_id','operator_logins.operator_type_id');        
        $this->db->select('operator_types.name');
        $this->db->from('initial_form');
        $this->db->join('inquiry', 'initial_form.inquiry_id = inquiry.inquiry_id', 'left');
        $this->db->join('campus', 'initial_form.campus_id = campus.campus_id', 'left');
        $this->db->join('operator_logins', 'initial_form.operator_id = operator_logins.operator_type_id', 'left');
        $this->db->join('operator_types', 'operator_logins.operator_type_id = operator_types.operator_type_id', 'left');
        $this->db->order_by("initial_form.initial_form_id", "DESC");         
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a Initial Form for update
    
    function getInitialForm($initial_form)
    {       
        $query = $this->db->get_where('initial_form', $initial_form);		
        return $query->result_array();
    }
    
    //update Initial Form Account
    
    function updateInitialForm($id, $initial_form_data)
    {
      $this->db->where('initial_form_id', $id);
      $result =  $this->db->update('initial_form', $initial_form_data);
      
      return $result;      
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
    
   function addForm($student_data,$form_data)
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
            return $student_id;
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
     $this->db->select('forms.*');
     $this->db->select('batch.*');
     $this->db->from('students');
     $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
     $this->db->join('batch', 'students.batch_id = batch.batch_id', 'left');
     $this->db->where(array('forms.inquiry_id' => 0 ,'forms.campaign_id' => 0 ));
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
    
   
   
   // ******>>>>         Start functions for Student Pakage        <<<<******  //
        

// get student pakage 
        
        function getStudentPackage($student_id)
        {
            $this->db->select('students.form_id,students.student_id');
            $this->db->select('forms.program_id');
            $this->db->select('program_fees.*');
            $this->db->from('students');
            $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
            $this->db->join('program_fees', 'program_fees.program_id = forms.program_id', 'left');
            $this->db->where('students.student_id', $student_id);                                   
            $query = $this->db->get();            
            return $query->result_array();
            
        }
        
        
// add student package
        
    function addStudentPackage($student_package)
    {
        $query = $this->db->insert('student_fee_package', $student_package); 
        return $this->db->insert_id();
    }
    
    
    
   // check student package 
    
   function  checkPackage($student_id)
   {
        $query = $this->db->get_where('student_fee_package', array('student_id' =>$student_id));		
        return $query->num_rows();
   }
   
   
    // check sessions installments
    
   function  chkSession_inInstallment($check_data)
   {
        $query = $this->db->get_where('installments', $check_data);		
        return $query->num_rows();
   }
   

// add installments
    
    function addInstallments($installment_data,$student_id)
    {
                
        $this->db->trans_start();
        
        $query              =   $this->db->insert('installments', $installment_data); 
        $installment_id     =   $this->db->insert_id(); 

        $challan_data       = array(
                                    'installment_id' => $installment_id,
                                    'student_id'     => $student_id,
                                    'status'         => 0,
                                    'created_date'   => date('Y-m-d')
                                   );
        
        $query              = $this->db->insert('challan', $challan_data);
        $challan_id         = $this->db->insert_id();

        $this->db->trans_complete(); 

        if($challan_id)
        {
            return $challan_id;
        }else
        {
             $this->db->where('installment_id', $installment_id);
             $this->db->delete('installments');
             return ;
        }
        
        
        
    }
        
    
 // get student package 
    
 function getStudentPackageInfo($student_id)
 {
            $this->db->select('students.student_id,students.roll_no,students.current_session_id');
            $this->db->select('forms.program_id,forms.student_name');
            $this->db->select('std_f_pkg.session_total_package,std_f_pkg.admission_fee,std_f_pkg.misc_fee,std_f_pkg.session_fee');
            $this->db->select('batch.batch, batch.batch_type');
            $this->db->select('programs.program_name');
            $this->db->select('sessions.session');
            $this->db->select('banks.bank_name,banks.bank_address');
            $this->db->select('bank_accounts.account_no');
            $this->db->select('cities.city_name AS bank_city');
            $this->db->from('students');
            
            $this->db->join('forms', 'students.form_id = forms.form_id', 'left');
            
            $this->db->join('student_fee_package std_f_pkg', 'students.student_id = std_f_pkg.student_id', 'left');
            
            $this->db->join('batch', 'students.batch_id = batch.batch_id', 'left');
            
            $this->db->join('programs', 'forms.program_id = programs.program_id', 'left');
            
            $this->db->join('sessions', 'students.current_session_id = sessions.session_id', 'left');
            
            $this->db->join('banks', 'forms.present_city_id = banks.city_id', 'left');
            
            $this->db->join('cities', 'banks.city_id = cities.city_id', 'left');
            
            $this->db->join('bank_accounts', 'banks.bank_id = bank_accounts.bank_id', 'left');
            
           
            $this->db->where('students.student_id', $student_id);                                   
            $query = $this->db->get();            
            return $query->result_array();
 }

 // get student Installments 
    
 function getStudentInstallments($student_id)
 {
            $this->db->select('installments.installment_id,installments.payable, installments.due_date');
            $this->db->select('sessions.session');
            $this->db->select('challan.challan_id, challan.status, challan.post_date');
            
            $this->db->from('installments');                       
            
            $this->db->join('sessions', 'installments.session_id = sessions.session_id', 'left');
            
            $this->db->join('challan', 'installments.installment_id = challan.installment_id', 'left');
                       
            $this->db->where('installments.student_id', $student_id);                                   
            $query = $this->db->get();            
            return $query->result_array();
 }
 
 // get challan info for challan view
 
 function getChallanInfo($challan_id,$student_id)
 {
     $this->db->select('challan.status,challan.post_date, installments.due_date,installments.payable AS amount');
     $this->db->From('challan');
     $this->db->join('installments', 'challan.installment_id = installments.installment_id', 'left');    
     $this->db->where(array('challan.challan_id' => $challan_id, 'challan.student_id' => $student_id));

            $query = $this->db->get();            
            return $query->result_array();
     
 }


// ******>>>>         Start functions for Student Pakage        <<<<******  //
  
  
   
 
 
 
  
}

