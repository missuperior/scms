<?php
class Accounts_model extends CI_Model {


     function getAllcampaigns()
    {
        $query = $this->db->get_where('campaign');
        return $query->result_array();
            
    } 
    
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
    
    
     function getforms()
    { 
        // for out station campuses
        $campaign_id = $this->session->userdata('campaign_id');
        if($this->session->userdata('role') == 'OS')
        {
            $campus_id = $this->session->userdata('campus_id');
            $query =  $this->db->query("SELECT count(*)AS total_students From forms_os AS form inner join students_os ON students_os.form_id = form.form_id Where students_os.roll_no = '' AND form.campus_id = $campus_id and form.campaign_id = $campaign_id ");
        }else{
            $query =  $this->db->query("SELECT count(*)AS total_students From forms AS form inner join students ON students.form_id = form.form_id Where students.roll_no = '' and form.campaign_id = $campaign_id ");
        }
      //  echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result[0]['total_students'];
        
    }
    
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
    
    
 function getUserId($formNo, $roll_no)
   {

         $campus_id    =   $this->session->userdata('campus_id');
         if($campus_id == 1 OR $campus_id == 3)
         {
             $campus_id =    '(forms.campus_id = 1 OR forms.campus_id = 3) ';
         }  else {
             $campus_id =    'forms.campus_id = '.$campus_id;
         }
         
         
         if($formNo != '') { $roll_form_no = 'AND forms.form_no = '."'$formNo'";}
         if($roll_no != ''){ $roll_form_no = 'AND students.roll_no = '."'$roll_no'";}
         
         
         
    // for out station 
     if($this->session->userdata('role') == 'OS' )
     {
            $query = $this->db->query("select students.student_id,students.form_id,students.batch_id,students.roll_no,inquiry.admission_stage,forms.*
                            From students_os AS students
                            INNER JOIN forms_os AS forms ON students.form_id = forms.form_id
                            INNER JOIN inquiry_os AS inquiry ON forms.inquiry_id = inquiry.inquiry_id
                            WHERE
                            forms.inquiry_id != 0 AND
                            $campus_id 
                            $roll_form_no                            
                      ");    
     }else{
         
           $query = $this->db->query("select students.student_id,students.form_id,students.batch_id,students.roll_no,inquiry.admission_stage,forms.*
                            From students
                            INNER JOIN forms ON students.form_id = forms.form_id
                            INNER JOIN inquiry ON forms.inquiry_id = inquiry.inquiry_id
                            WHERE
                            forms.inquiry_id != 0 AND
                            $campus_id
                            $roll_form_no                            
                      ");      
         
    }
//    echo $this->db->last_query();die;
     return $query->result_array();
     
   }
    
// function getUserId($formNo, $roll_no)
//   {
//
//         $campus_id    =   $this->session->userdata('campus_id');
//                           
//         
//    // for out station 
//     if($this->session->userdata('role') == 'OS' )
//     {
//            $this->db->select('students.student_id,students.form_id,students.batch_id,students.roll_no');
//            $this->db->select('inquiry.admission_stage');
//            $this->db->select('forms.*');
//            $this->db->from('students_os students');
//            $this->db->join('forms_os forms', 'students.form_id = forms.form_id', 'inner');
//            $this->db->join('inquiry_os inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
//            $this->db->where('forms.inquiry_id != 0');
//            if($roll_no != '')
//            {
//              $this->db->where('students.roll_no',$roll_no);          
//            }
//            else{
//              $this->db->where('forms.form_no',$formNo);                  
//            }
//            $this->db->where('forms.campus_id',$this->session->userdata('campus_id'));
//            $query = $this->db->get();     
//     }else{
//         
//           $this->db->select('students.student_id,students.form_id,students.batch_id,students.roll_no');
//            $this->db->select('inquiry.admission_stage');
//            $this->db->select('forms.*');
//            $this->db->from('students');
//            $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
//            $this->db->join('inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
//            $this->db->where('forms.inquiry_id != 0');
//            
//            if($campus_id == 1 || $campus_id == 3)
//            {
//                        $this->db->where('forms.campus_id=1 or forms.campus_id=3');
//                        //$this->db->or_where('forms.campus_id',3);
//            }else{
//                            $this->db->where('forms.campus_id',$this->session->userdata('campus_id'));
//            }
//            if($roll_no != '')
//            {
//              $this->db->where('students.roll_no',$roll_no);          
//            }
//            else{
//              $this->db->where('forms.form_no',$formNo);                  
//            }
//            
//            $query = $this->db->get();       
//         
//    }
//    echo $this->db->last_query();die;
//     return $query->result_array();
//     
//   }
//    
    
    
    
   
   function getAllStudentForms()
   {

    // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->select('students.student_id,students.form_id,students.batch_id,students.roll_no');
            $this->db->select('inquiry.admission_stage');
            $this->db->select('forms.*');
            $this->db->select('batch.*');
            $this->db->from('students_os students');
            $this->db->join('forms_os forms', 'students.form_id = forms.form_id', 'inner');
            $this->db->join('inquiry_os inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
            $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');

            $this->db->where('forms.inquiry_id != 0');
            if($this->session->userdata('campus_id') == 1 || $this->session->userdata('campus_id') == 3)    
            {
                $this->db->where('forms.campus_id',1);
                $this->db->or_where('forms.campus_id',3);
            }else{
                $this->db->where('forms.campus_id',$this->session->userdata('campus_id'));
            }
            
            $this->db->order_by("students.student_id", "DESC");    
            $this->db->limit(50);
            $query = $this->db->get();    
           // echo $this->db->last_query();die;
     }else{
         
            $this->db->select('students.student_id,students.form_id,students.batch_id,students.roll_no');
            $this->db->select('inquiry.admission_stage');
            $this->db->select('forms.*');
            $this->db->select('batch.*');
            $this->db->from('students');
            $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
            $this->db->join('inquiry', 'inquiry.inquiry_id = forms.inquiry_id', 'inner');
            $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');

            $this->db->where('forms.inquiry_id != 0');
            if($this->session->userdata('campus_id') == 1 || $this->session->userdata('campus_id') == 3)    
            {
                $this->db->where('forms.campus_id',1);
                $this->db->or_where('forms.campus_id',3);
            }else{
                $this->db->where('forms.campus_id',$this->session->userdata('campus_id'));
            }
            
            $this->db->order_by("students.student_id", "DESC");
            $this->db->limit(50);
            $query = $this->db->get();     
         
     }
     return $query->result_array();
     
   }
   
    function getAllStudentForms_all($program_id=NULL,$campaing_id=NULL)
   {
   
     $campus_id         =   $this->session->userdata('campus_id');   
        
     if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        }     
        
        
    // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $query = $this->db->query("SELECT students.student_id,students.status, students.form_id,students.batch_id,students.roll_no, inquiry.admission_stage,forms.*,batch.*

                                        FROM students_os AS students

                                        INNER JOIN forms_os AS forms ON students.form_id = forms.form_id

                                        INNER JOIN inquiry_os AS inquiry ON inquiry.inquiry_id = forms.inquiry_id

                                        INNER JOIN batch ON students.batch_id = batch.batch_id 

                                        WHERE 

                                        forms.inquiry_id != 0 AND
                                        students.roll_no != '' 
                                        $campus

                                        ORDER BY 

                                        students.student_id DESC                      
                                    ");      
           // echo $this->db->last_query();die;
     }else{
         
            $query = $this->db->query("SELECT students.student_id,students.status, students.form_id,students.batch_id,students.roll_no, inquiry.admission_stage,forms.*,batch.*

                                        FROM students

                                        INNER JOIN forms ON students.form_id = forms.form_id

                                        INNER JOIN inquiry ON inquiry.inquiry_id = forms.inquiry_id

                                        INNER JOIN batch ON students.batch_id = batch.batch_id 

                                        WHERE 

                                        forms.inquiry_id != 0 AND
                                        students.roll_no != ''  
                                        $campus

                                        ORDER BY 

                                        students.student_id DESC                      
                                    ");    
     }
     
   //  echo $this->db->last_query();die;
     return $query->result_array();
     
   }
   
    function getStudentfor_left($program_id,$campaing_id)
   {
   
     $campus_id         =   $this->session->userdata('campus_id');   
        
     if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        }     
        
        
    // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $query = $this->db->query("SELECT students.student_id,students.status, students.form_id,students.batch_id,students.roll_no, inquiry.admission_stage,forms.*,batch.*

                                        FROM students_os AS students

                                        INNER JOIN forms_os AS forms ON students.form_id = forms.form_id

                                        INNER JOIN inquiry_os AS inquiry ON inquiry.inquiry_id = forms.inquiry_id

                                        INNER JOIN batch ON students.batch_id = batch.batch_id 

                                        WHERE 

                                        forms.inquiry_id != 0 AND
                                        students.roll_no != '' AND
                                        forms.campaign_id = $campaing_id AND
                                        forms.program_id  = $program_id
                                        $campus

                                        ORDER BY 

                                        students.student_id DESC                      
                                    ");      
           // echo $this->db->last_query();die;
     }else{
         
            $query = $this->db->query("SELECT students.student_id,students.status, students.form_id,students.batch_id,students.roll_no, inquiry.admission_stage,forms.*,batch.*

                                        FROM students

                                        INNER JOIN forms ON students.form_id = forms.form_id

                                        INNER JOIN inquiry ON inquiry.inquiry_id = forms.inquiry_id

                                        INNER JOIN batch ON students.batch_id = batch.batch_id 

                                        WHERE 

                                        forms.inquiry_id != 0 AND
                                        students.roll_no != '' AND
                                        forms.campaign_id = $campaing_id AND
                                        forms.program_id  = $program_id 
                                        $campus

                                        ORDER BY 

                                        students.student_id DESC                      
                                    ");    
     }
     
   //  echo $this->db->last_query();die;
     return $query->result_array();
     
   }
   
   // ******>>>>         Start functions for Student Pakage        <<<<******  //
        

// get student pakage 
        
        function getStudentPackage($program_id,$student_id)
        {
           
            if($this->session->userdata('campus_id') == 1 || $this->session->userdata('campus_id') == 3)
            {
                $campus_id         =   '(program_fees.campus_id = 3  OR program_fees.campus_id = 1) AND (forms.campus_id = 3  OR forms.campus_id = 1) ' ;
            }else{
                $campus_id         =   'program_fees.campus_id ='.$this->session->userdata('campus_id'). ' AND forms.campus_id = '.$this->session->userdata('campus_id');
            } 
            
           // for out station 
            if($this->session->userdata('role') == 'OS')
            { 
                      $query = $this->db->query("SELECT students.form_id,students.student_id, students.current_session_id, forms.program_id, program_fees.* 
                                                FROM students_os AS students
                                                INNER JOIN forms_os As forms ON students.form_id = forms.form_id 
                                                INNER JOIN program_fees ON program_fees.program_id = forms.program_id 
                                                WHERE 
                                                forms.program_id = '$program_id' AND
                                                students.student_id = '$student_id' AND
                                                forms.campaign_id   = program_fees.campaign_id AND
                                                $campus_id
                                                                   
                                            ");         
            }else{
                   $query = $this->db->query("SELECT students.form_id,students.student_id, students.current_session_id, forms.program_id, program_fees.* 
                                                FROM students
                                                INNER JOIN forms ON students.form_id = forms.form_id 
                                                INNER JOIN program_fees ON program_fees.program_id = forms.program_id 
                                                WHERE 
                                                forms.program_id = '$program_id' AND
                                                students.student_id = '$student_id' AND
                                                forms.campaign_id   = program_fees.campaign_id AND
                                                    
                                                $campus_id
                                                                   
                                            ");           
            }
            
            
            
          // echo $this->db->last_query();die;
            return $query->result_array();
            
        }
        
        
// add student package
        
    function addStudentPackage($student_package)
    {
         // for out station 
            if($this->session->userdata('role') == 'OS')
            { 
                $query = $this->db->insert('student_fee_package_os', $student_package); 
                $id    =    $this->db->insert_id();
            }else{
                $query = $this->db->insert('student_fee_package', $student_package); 
                $id    =    $this->db->insert_id();
            }
        
        
        // for  maintain log
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
    
    // get inquiry id 
    
    function getInquiry_Id($student_id)
    {
         // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('forms.inquiry_id');
                $this->db->from('forms_os forms');
                $this->db->join('students_os students','forms.form_id = students.form_id');
                $this->db->where('students.student_id',$student_id);
                $query = $this->db->get();
        }else{
                $this->db->select('forms.inquiry_id');
                $this->db->from('forms');
                $this->db->join('students','forms.form_id = students.form_id');
                $this->db->where('students.student_id',$student_id);
                $query = $this->db->get();
        }
        $res = $query->result_array();
        return $res[0]['inquiry_id'];
        
    }
    
    // update stage info for admission
    
    function updateStage($inquiry_id)
    {
        $this->db->where('inquiry_id', $inquiry_id);
            
             // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
            return $query = $this->db->update('inquiry_os', array('admission_stage' => 3)); 
        }else{
           return $query = $this->db->update('inquiry', array('admission_stage' => 3)); 
        }
    }
    
    
   // check student package 
    
   function  checkPackage($student_id)
   {
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->get_where('student_fee_package_os', array('student_id' =>$student_id));		
        }else{
            $query = $this->db->get_where('student_fee_package', array('student_id' =>$student_id));		
        }
        return $query->num_rows();
   }
   
   function getStudentId($challan_no){
       
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $query = $this->db->query("SELECT challan_os.* 
                                    FROM `challan_os`
                                    INNER JOIN students_os ON students_os.student_id = challan_os.student_id
                                    INNER JOIN forms_os ON students_os.form_id = forms_os.form_id
                                    WHERE 
                                    challan_os.challan_id = $challan_no
                                    AND forms_os.inquiry_id != 0 
                                    ");		
        }else{
            $query =  $query = $this->db->query("SELECT challan.* 
                                    FROM `challan`
                                    INNER JOIN students ON students.student_id = challan.student_id
                                    INNER JOIN forms ON students.form_id = forms.form_id
                                    WHERE 
                                    challan.challan_id = $challan_no
                                    AND forms.inquiry_id != 0 
                                    ");			
        }
       //echo $this->db->last_query();die;
        return $query->row();
       
   }
   
     
   
    // check sessions installments
    
   function  chkSession_inInstallment($check_data)
   {
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query = $this->db->get_where('installments_os', $check_data);		
        }else{
            $query = $this->db->get_where('installments', $check_data);		
        }
        return $query->num_rows();
   }
   
   // get package info for installments 
   
   function getPackageInfo($student_id)
   {
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $this->db->select('sfp.*,std.enrolled_session_id');
            $this->db->from('student_fee_package_os sfp');
            $this->db->join('students_os std', 'std.student_id = sfp.student_id', 'inner');
            $this->db->where('sfp.student_id', $student_id);
            $query   = $this->db->get();
        }else{
            $this->db->select('sfp.*,std.enrolled_session_id');
            $this->db->from('student_fee_package sfp');
            $this->db->join('students std', 'std.student_id = sfp.student_id', 'inner');
            $this->db->where('sfp.student_id', $student_id);
            $query   = $this->db->get();
        }
      //  echo $this->db->last_query();die;
       return $query->result_array();
   }
   

// add installments
    
    function addInstallments($installment_data,$student_id)
    {
       $controller =  $this->uri->segment(1);
       if($controller == 'accounts_de')
       {
           $status = 1;
       }else{
           $status = 0;
       }
       
        $this->db->trans_start();
        
        // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query              =   $this->db->insert('installments_os', $installment_data); 
            $installment_id     =   $this->db->insert_id(); 
        }else{
            $query              =   $this->db->insert('installments', $installment_data); 
            $installment_id     =   $this->db->insert_id(); 

        }

        $challan_data       = array(
                                    'installment_id' => $installment_id,
                                    'student_id'     => $student_id,
                                    'status'         => $status,
                                    'created_date'   => date('Y-m-d')
                                   
                                   );
         // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query              = $this->db->insert('challan_os', $challan_data);
            $challan_id         = $this->db->insert_id();
        }else{
            $query              = $this->db->insert('challan', $challan_data);
            $challan_id         = $this->db->insert_id();
        }

        $this->db->trans_complete(); 

        if($challan_id)
        {
                        // for  maintain log
                    if($installment_id){

                        $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                        $log_data   =   array(
                                                'operator_id'   => $this->session->userdata('sub_login_id'),
                                                'reference_id'  => $installment_id,
                                                'action'        => $action
                                            );

                        $query = $this->db->insert('user_log', $log_data); 
                        return $challan_id;

                    }else{
                        return false;
                    }
        }else
        {
             $this->db->where('installment_id', $installment_id);
       
             // for out station 
            if($this->session->userdata('role') == 'OS')
            {
             $this->db->delete('installments_os');
            }else{
                $this->db->delete('installments');
            }
             return ;
        }
        
        
        
    }
        
    
    function addInstallments2($installment_data,$student_id,$post_date)
    {
       $controller =  $this->uri->segment(1);
       if($controller == 'accounts_de')
       {
           $status = 1;
       }else{
           $status = 0;
       }
       
        $this->db->trans_start();
        
        // for out station 
     if($this->session->userdata('role') == 'OS')
     {
        $query              =   $this->db->insert('installments_os', $installment_data); 
        $installment_id     =   $this->db->insert_id(); 
     }else{
         $query              =   $this->db->insert('installments', $installment_data); 
         $installment_id     =   $this->db->insert_id(); 
     }

        $challan_data       = array(
                                    'installment_id' => $installment_id,
                                    'student_id'     => $student_id,
                                    'status'         => $status,
                                    'created_date'   => date('Y-m-d'),
                                    'post_date'      => $post_date
                                   );
        
          // for out station 
     if($this->session->userdata('role') == 'OS')
     {
        $query              = $this->db->insert('challan_os', $challan_data);
        $challan_id         = $this->db->insert_id();
     }else{
           $query              = $this->db->insert('challan', $challan_data);
          $challan_id         = $this->db->insert_id();
     }

        $this->db->trans_complete(); 

        if($challan_id)
        {
            return $challan_id;
        }else
        {
              // for out station 
            if($this->session->userdata('role') == 'OS')
            {
                $this->db->where('installment_id', $installment_id);
                $this->db->delete('installments_os ');
                return ;
            }else{
                $this->db->where('installment_id', $installment_id);
                $this->db->delete('installments');
                return ;
            }
        }
        
        
        
    }
     
    function Check_Package($student_id){
      
     if($this->session->userdata('role') == 'OS')
        {  
            $this->db->select('*');
            $this->db->from('student_fee_package_os');
            $this->db->where('student_id',$student_id);
            $query  =   $this->db->get();
            return  $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from('student_fee_package');
            $this->db->where('student_id',$student_id);
            $query  =   $this->db->get();
            return  $query->result_array();
        }   
    }
    
    
    function Check_Rollno($student_id){
      
     if($this->session->userdata('role') == 'OS')
        {  
            $this->db->select('roll_no');
            $this->db->from('students_os');
            $this->db->where('student_id',$student_id);
            $query  =   $this->db->get();
            return  $query->row();
        }else{
            $this->db->select('roll_no');
            $this->db->from('students');
            $this->db->where('student_id',$student_id);
            $query  =   $this->db->get();
           // echo $this->db->last_query();die;
            return  $query->row();
        }   
    }
    
    
    
 // get student package 
    
 function getStudentPackageInfo($student_id)
 {
      // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->select('students.student_id,students.status,students.roll_no,students.current_session_id,students.enrolled_session_id,students.semester');
            $this->db->select('forms.program_id,forms.student_name,forms.campaign_id,forms.form_no');
            $this->db->select('std_f_pkg.session_total_package,std_f_pkg.admission_fee,std_f_pkg.misc_fee,std_f_pkg.session_fee,std_f_pkg.remarks,std_f_pkg.tax');
            $this->db->select('batch.batch, batch.batch_type');
            $this->db->select('programs.program_name');
            $this->db->select('sessions.session');
            $this->db->select('banks.bank_name,banks.bank_address,banks.challan_title');
            $this->db->select('bank_accounts.account_no');
            $this->db->select('cities.city_name AS bank_city');
            $this->db->from('students_os students');
            
            $this->db->join('forms_os forms', 'students.form_id = forms.form_id', 'left');
            
            $this->db->join('student_fee_package_os std_f_pkg', 'students.student_id = std_f_pkg.student_id', 'left');
            
            $this->db->join('batch', 'students.batch_id = batch.batch_id', 'left');
            
            $this->db->join('programs', 'forms.program_id = programs.program_id', 'left');
            
            $this->db->join('sessions', 'students.current_session_id = sessions.session_id', 'left');
            
            $this->db->join('banks', 'forms.present_city_id = banks.city_id', 'left');
            
            $this->db->join('cities', 'banks.city_id = cities.city_id', 'left');
            
            $this->db->join('bank_accounts', 'banks.bank_id = bank_accounts.bank_id', 'left');
            
            
            $this->db->where('students.student_id', $student_id);                                   
                                            
            $query = $this->db->get();      
     }else{
         
            $this->db->select('students.student_id,students.status,students.roll_no,students.current_session_id,students.enrolled_session_id,students.semester');
            $this->db->select('forms.program_id,forms.student_name,forms.campaign_id,forms.form_no');
            $this->db->select('std_f_pkg.session_total_package,std_f_pkg.admission_fee,std_f_pkg.misc_fee,std_f_pkg.session_fee,std_f_pkg.remarks,std_f_pkg.tax');
            $this->db->select('batch.batch, batch.batch_type');
            $this->db->select('programs.program_name,programs.cr');
            $this->db->select('sessions.session');
            $this->db->select('banks.bank_name,banks.bank_address,banks.challan_title');
            $this->db->select('bank_accounts.account_no');
            $this->db->select('cities.city_name AS bank_city');
            $this->db->from('students');
            
            $this->db->join('forms', 'students.form_id = forms.form_id', 'inner');
            
            $this->db->join('student_fee_package std_f_pkg', 'students.student_id = std_f_pkg.student_id', 'left');
            
            $this->db->join('batch', 'students.batch_id = batch.batch_id', 'inner');
            
            $this->db->join('programs', 'forms.program_id = programs.program_id', 'inner');
            
            $this->db->join('sessions', 'students.current_session_id = sessions.session_id', 'inner');
            
            $this->db->join('campus', 'forms.campus_id = campus.campus_id', 'inner');
            
            $this->db->join('banks', 'campus.city_id = banks.city_id', 'left');
            
            $this->db->join('cities', 'banks.city_id = cities.city_id', 'left');
            
            $this->db->join('bank_accounts', 'banks.bank_id = bank_accounts.bank_id', 'left');
            
           
            $this->db->where('students.student_id', $student_id);                                   
            $query = $this->db->get();       

         
     }
    // echo $this->db->last_query();die;
            return $query->result_array();
 }

 function getEnrolledSeesion($student_id){
     $this->db->select('students.enrolled_session_id,forms.campaign_id');
     $this->db->from('students');
     $this->db->join('forms','forms.form_id = students.form_id','inner');
     $this->db->where('students.student_id',$student_id);
     $query         =   $this->db->get();
     return         $query->row();
 }
 
 
 
 // get student Installments 
    
 function getStudentInstallments($student_id)
 {
     
       // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->select('installments.*');
            $this->db->select('sessions.session');
            $this->db->select('challan.challan_id, challan.status');
            
            $this->db->from('installments_os installments');                       
            
            $this->db->join('sessions', 'installments.session_id = sessions.session_id', 'inner');
            
            $this->db->join('challan_os challan', 'installments.installment_id = challan.installment_id', 'inner');
                       
            $this->db->where('installments.student_id', $student_id);  
            $this->db->order_by('installments.installment_id','asc'); 
            $query = $this->db->get();            
     }else{
            
            $this->db->select('installments.*');
            $this->db->select('sessions.session');
            $this->db->select('challan.challan_id, challan.status');
            
            $this->db->from('installments');                       
            
            $this->db->join('sessions', 'installments.session_id = sessions.session_id', 'inner');
            
            $this->db->join('challan', 'installments.installment_id = challan.installment_id', 'inner');
                       
            $this->db->where('installments.student_id', $student_id);                                   
            $this->db->order_by('installments.installment_id','asc');                                   
            $query = $this->db->get();            
      
     }
            return $query->result_array();
 }

function getStudentInstallments2($student_id,$session_id)
 {
     
       // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $this->db->select('installments.*');
            $this->db->select('sessions.session');
            $this->db->select('challan.challan_id, challan.status');
            
            $this->db->from('installments_os installments');                       
            
            $this->db->join('sessions', 'installments.session_id = sessions.session_id', 'inner');
            
            $this->db->join('challan_os challan', 'installments.installment_id = challan.installment_id', 'inner');
                       
            $this->db->where('installments.student_id', $student_id);  
            $this->db->where('installments.session_id', $session_id);  
            $this->db->order_by('installments.installment_id','asc'); 
            $query = $this->db->get();            
     }else{
            
            $this->db->select('installments.*');
            $this->db->select('sessions.session');
            $this->db->select('challan.challan_id, challan.status');
            
            $this->db->from('installments');                       
            
            $this->db->join('sessions', 'installments.session_id = sessions.session_id', 'inner');
            
            $this->db->join('challan', 'installments.installment_id = challan.installment_id', 'inner');
                       
            $this->db->where('installments.student_id', $student_id); 
            $this->db->where('installments.session_id', $session_id);  
            $this->db->order_by('installments.installment_id','asc');                                   
            $query = $this->db->get();            
      
     }
            return $query->result_array();
 }
 
 // get inquiry id
 
 function getInquiryId($inquiry_no)
 {
     // for out stations 
     if($this->session->userdata('role') == 'OS')
     {
        $this->db->select('inquiry_id');
        $this->db->from('inquiry_os');
        $this->db->where('inquiry_no', $inquiry_no);
        $query = $this->db->get();
     }else{
            $this->db->select('inquiry_id');
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
     // for out stations 
     if($this->session->userdata('role') == 'OS')
     {
        $this->db->select('initial_form_id');
        $this->db->from('initial_form_os');
        $this->db->where('form_no', $formNo);
        $query = $this->db->get();
     }else{
        $this->db->select('initial_form_id');
        $this->db->from('initial_form');
        $this->db->where('form_no', $formNo);
        $query = $this->db->get();
     }
     
     
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
     // for out stations 
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
 
 
 // get all challans against given params
 
 function getChallanInfo($program_id,$campaign_id)
 {
     
     $campus_id     =   $this->session->userdata('campus_id');
     
     if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND forms.campus_id = 3"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        } 
     
       // for out station 
     if($this->session->userdata('role') == 'OS')
     {
         
            $query = $this->db->query(
                     "SELECT ch.status,ch.challan_id,ins.installment_id,ins.payable,ins.due_date,programs.program_name,students.roll_no,students.student_id,forms.student_name
                     FROM challan_os AS ch
                     inner JOIN installments_os AS ins ON ch.installment_id = ins.installment_id
                     inner JOIN students_os AS students ON ch.student_id = students.student_id
                     inner JOIN forms_os AS forms ON students.form_id = forms.form_id
                     inner JOIN programs ON programs.program_id = forms.program_id
                     WHERE forms.program_id = ".$program_id."
                     AND forms.campaign_id  = ".$campaign_id."
                     $campus
                     ORDER BY ch.challan_id DESC
                    ");
     }else{
        
                $query = $this->db->query(
                     "SELECT ch.status,ch.challan_id,ins.installment_id,ins.payable,ins.due_date,programs.program_name,students.roll_no,students.student_id,forms.student_name
                     FROM challan AS ch
                     inner JOIN installments AS ins ON ch.installment_id = ins.installment_id
                     inner JOIN students ON ch.student_id = students.student_id
                     inner JOIN forms ON students.form_id = forms.form_id
                     inner JOIN programs ON programs.program_id = forms.program_id
                     WHERE forms.program_id = ".$program_id."
                     AND forms.campaign_id  = ".$campaign_id."
                     $campus
                     ORDER BY ch.challan_id DESC
                    ");
     }
                   //echo $this->db->last_query();die; 
                    return  $query->result_array();
 }

 // get students challans against given params
 
 function getChallanInfoStudent($program_id,$campaign_id,$student_id)
 {
       // for out station 
     if($this->session->userdata('role') == 'OS')
     {
            $query = $this->db->query(
                     "SELECT ch.status,ch.challan_id,ins.installment_id,ins.payable,ins.fee,ins.fine,ins.due_date,programs.program_name,students.roll_no,forms.student_name
                     FROM challan_os AS ch
                     inner JOIN installments_os AS ins ON ch.installment_id = ins.installment_id
                     inner JOIN students_os AS students ON ch.student_id = students.student_id
                     inner JOIN forms_os AS forms ON students.form_id = forms.form_id
                     inner JOIN programs ON programs.program_id = forms.program_id
                     WHERE forms.program_id = ".$program_id."
                     AND forms.campaign_id  = ".$campaign_id."
                     AND students.student_id  = ".$student_id."
                     AND ch.status  = '0'
                     ORDER BY ch.challan_id ASC
                    ");
     }else{
                $query = $this->db->query(
                     "SELECT ch.status,ch.challan_id,ins.installment_id,ins.payable,ins.fee,ins.fine,ins.due_date,programs.program_name,students.roll_no,forms.student_name
                     FROM challan AS ch
                     inner JOIN installments AS ins ON ch.installment_id = ins.installment_id
                     inner JOIN students ON ch.student_id = students.student_id
                     inner JOIN forms ON students.form_id = forms.form_id
                     inner JOIN programs ON programs.program_id = forms.program_id
                     WHERE forms.program_id = ".$program_id."
                     AND forms.campaign_id  = ".$campaign_id."
                     AND students.student_id  = ".$student_id."
                     AND ch.status  = '0'
                     ORDER BY ch.challan_id ASC
                    ");
     }
                  
                    return  $query->result_array();
 }






 // update challan status to 1
 
 function postChallan($challan_id,$post_date,$type,$slip_no)
 {
     $update_data = array(
                            'status'        =>  1,
                            'type'          =>  $type,
                            'slip_no'       =>  $slip_no,
                            'post_date'     =>  $post_date,
                            'operator_id'   =>  $this->session->userdata('sub_login_id')
                        );
     
     $this->db->where('challan_id', $challan_id);
     
        // for out station 
     if($this->session->userdata('role') == 'OS')
     {
        $query = $this->db->update('challan_os', $update_data);
     }else{
         $query = $this->db->update('challan', $update_data);
     }
     
     if($query){

                        $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                        $log_data   =   array(
                                                'operator_id'   => $this->session->userdata('sub_login_id'),
                                                'reference_id'  => $challan_id,
                                                'action'        => $action
                                            );

                        $query = $this->db->insert('user_log', $log_data); 
                        return $challan_id;

      }else{
                       return false;
      }
 }
 
 
 
 // get challan info for challan view
 
 function getChalanInfo($challan_id,$student_id)
 {
      // for out station 
     if($this->session->userdata('role') == 'OS')
     {
        $this->db->select('challan.status,challan.post_date, installments.due_date,installments.payable AS amount,sessions.session');
        $this->db->From('challan_os challan');
        $this->db->join('installments_os installments', 'challan.installment_id = installments.installment_id', 'inner');    
        $this->db->join('sessions', 'sessions.session_id = installments.session_id', 'inner');    
        $this->db->where(array('challan.challan_id' => $challan_id, 'challan.student_id' => $student_id));
     }else{
         
            $this->db->select('challan.status,challan.post_date, installments.due_date,installments.payable AS amount,sessions.session');
            $this->db->From('challan');
            $this->db->join('installments', 'challan.installment_id = installments.installment_id', 'inner');    
            $this->db->join('sessions', 'sessions.session_id = installments.session_id', 'inner');    
            $this->db->where(array('challan.challan_id' => $challan_id, 'challan.student_id' => $student_id));
     }

            $query = $this->db->get();            
            return $query->result_array();
     
 }
 
 
 // get installment info 
 
 function InstallmentInfo($installment_id)
 {
     // for out stations 
     if($this->session->userdata('role') == 'OS')
     {
          //$query = $this->db->get_where('installments_os', array('installment_id' => $installment_id));
         
         $this->db->select('ins.*,ch.challan_id');
         $this->db->from('installments_os ins');
         $this->db->join('challan_os ch','ins.installment_id = ch.installment_id','inner');
         $this->db->where('ins.installment_id',$installment_id);
         $query = $this->db->get();
     }else{
              //$query = $this->db->get_where('installments', array('installment_id' => $installment_id));
         $this->db->select('ins.*,ch.challan_id');
         $this->db->from('installments ins');
         $this->db->join('challan ch','ins.installment_id = ch.installment_id','inner');
         $this->db->where('ins.installment_id',$installment_id);
         $query = $this->db->get();
         //echo $this->db->last_query();die;
     }
        return $query->result_array();
 }
 
 
 // add fine and update payable amount
 
 function addFine($id,$fine_data)
 {
        $this->db->where('installment_id', $id);
      // for out stations 
     if($this->session->userdata('role') == 'OS')
     {
        $query = $this->db->update('installments_os', $fine_data);
     }else{
           $query = $this->db->update('installments', $fine_data);
     }
		 
        return $query;    
 }

 // get last roll no of same program code 
 
    function getLastRollNo($program_code,$campus_id,$campaign_code)
    {
        
         if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND forms.campus_id = 3"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        } 
        
        
         // for out stations 
        if($this->session->userdata('role') == 'OS')
        {
         $query = $this->db->query("SELECT students.* 
                                    FROM `students_os` AS students
                                    INNER JOIN forms_os AS forms ON students.form_id = forms.form_id
                                    WHERE 
                                    students.roll_no like '$program_code-$campaign_code-%'
                                    $campus 
                                    ORDER BY students.roll_no DESC
                                    Limit 1");
         //$query = $this->db->query("SELECT * FROM `students_os` WHERE `roll_no` like '$program_code-%' ORDER BY roll_no DESC ");
        }else{
            //$query = $this->db->query("SELECT * FROM `students` WHERE `roll_no` like '$program_code-%' ORDER BY roll_no DESC ");
            
            $query = $this->db->query("SELECT students.* 
                                    FROM `students`
                                    INNER JOIN forms ON students.form_id = forms.form_id
                                    WHERE 
                                    students.roll_no like '$program_code-$campaign_code-%'
                                    $campus
                                    ORDER BY students.roll_no DESC
                                    Limit 1");
            
        }
         //echo $this->db->last_query();die;
         return  $query->result_array();
    }
 
 //  add roll no 
    
    function addRollNo($student_id,$roll_no,$operator_id,$serial)
    {
         // for out stations 
        if($this->session->userdata('role') == 'OS')
        {
            $this->db->query("UPDATE `students_os` SET `roll_no` = '$roll_no', `operator_id` = '$operator_id', `semester` = '1' WHERE student_id = $student_id "); 
            return $this->db->affected_rows();
        }else{
             $this->db->query("UPDATE `students` SET `roll_no` = '$roll_no', serial = $serial, `operator_id` = '$operator_id', `semester` = '1' WHERE student_id = $student_id "); 
            // echo  $this->db->last_query(); die;
             return $this->db->affected_rows();
        }
    }
    
    
    // delete package of student who's program is changed OR pakage revised
    
    function deletePackage($student_id)
    {
       if($this->session->userdata('role') == 'OS')
        {
            $query  =   $this->db->delete('student_fee_package_os', array('student_id' => $student_id)); 
            if($query == 1){
                
                $this->db->select('installment_id,challan_id');
                $this->db->from('challan_os challan');
                $this->db->where('challan.student_id',$student_id);
                $this->db->where('challan.status',0);
                $query = $this->db->get();
                $this->db->last_query();
                $result = $query->result_array();
                
                foreach ($result AS $row){
                    $challan_id     =   $row['challan_id'];
                    $installment_id =   $row['installment_id'];
                    
                    $del1  =   $this->db->delete('installments_os', array('installment_id' => $installment_id)); 
                    if($del1){
                        $del2  =   $this->db->delete('challan_os', array('challan_id' => $challan_id)); 
                    }
                }
                 return $query;
                
            }else{
                return false;
            }
            
        }else{
           
             $query  =   $this->db->delete('student_fee_package', array('student_id' => $student_id)); 
              if($query == 1){
                    
                $this->db->select('installment_id,challan_id');
                $this->db->from('challan');
                $this->db->where('challan.student_id',$student_id);
                $this->db->where('challan.status',0);
                $query = $this->db->get();
                $result = $query->result_array();
                
                foreach ($result AS $row){
                    $challan_id     =   $row['challan_id'];
                    $installment_id =   $row['installment_id'];
                    
                    $del1  =   $this->db->delete('installments', array('installment_id' => $installment_id)); 
                    if($del1){
                        //die('ajksdl;f');
                        $del2  =   $this->db->delete('challan', array('challan_id' => $challan_id)); 
                    }
                }
                return $query;
                
            }else{
                return false;
            }
            
            
        } 
    }
    
    
     function form_info($student_id){
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
                                WHERE students.student_id = '$student_id'
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
                                WHERE students.student_id = '$student_id'
                                ");
              }
              
                
                //$query = $this->db->get_where('forms', array('form_id' => $form_id));
                //echo $this->db->last_query();die;
                return $query->result_array();
            }
 
            
    function deleteRollNo($student_id){
        
              $this->db->where('student_id', $student_id);
                
              if($this->session->userdata('role') == 'OS'){    
                $query = $this->db->update('students_os', array('roll_no'=>''));
              }  else {
                  $query = $this->db->update('students', array('roll_no'=>''));
              }
              return query;
                
    }
    
    
    //********  get Challans for Print********\\
    
    function getPrintChallans($campaign_id, $campus_id, $program_id,$session_id, $start_date, $end_date)
    {
      
        
          if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        } 
        
       if($this->session->userdata('role') == 'OS'){      
                        $query = $this->db->query("SELECT installments.due_date, installments.payable, students.roll_no, students.student_id,students.semester, forms.form_no, forms.student_name,forms.campaign_id,
                            campaign.campaign_name, campus.campus_name, programs.program_name, banks.bank_name, banks.bank_address,banks.challan_title, sessions.session,
                            bank_accounts.account_no, cities.city_name, challan.* 
                            FROM forms_os AS forms
                            INNER JOIN students_os AS students ON forms.form_id = students.form_id 
                            INNER JOIN installments_os As installments ON students.student_id = installments.student_id 
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id 
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id 
                            INNER JOIN sessions ON installments.session_id = sessions.session_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN banks ON campus.city_id = banks.city_id
                            INNER JOIN cities ON banks.city_id = cities.city_id
                            INNER JOIN bank_accounts ON banks.bank_id = bank_accounts.bank_id 
                            WHERE 
                            forms.program_id = ".$program_id."
                            $campus
                            AND forms.campaign_id = $campaign_id
                            AND installments.due_date BETWEEN '$start_date' AND '$end_date' 
                            AND challan.status = '0'
                            AND students.status = 'ok'
                            AND installments.session_id = $session_id
                            ORDER BY students.roll_no ASC
                ");        
       }else{
           
            $query = $this->db->query("SELECT installments.due_date, installments.payable, students.roll_no, students.student_id,students.semester, forms.form_no, forms.student_name,forms.campaign_id,
                            campaign.campaign_name, campus.campus_name, programs.program_name, banks.bank_name, banks.bank_address,banks.challan_title,sessions.session ,
                            bank_accounts.account_no, cities.city_name, challan.* 
                            FROM forms
                            INNER JOIN students ON forms.form_id = students.form_id 
                            INNER JOIN installments ON students.student_id = installments.student_id 
                            INNER JOIN challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id 
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id 
                            INNER JOIN sessions ON installments.session_id = sessions.session_id 
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN banks ON campus.city_id = banks.city_id
                            INNER JOIN cities ON banks.city_id = cities.city_id
                            INNER JOIN bank_accounts ON banks.bank_id = bank_accounts.bank_id 
                            WHERE 
                            forms.program_id = ".$program_id."
                            $campus
                            AND forms.campaign_id = $campaign_id
                            AND installments.due_date BETWEEN '$start_date' AND '$end_date' 
                            AND challan.status = '0'
                            AND students.status = 'ok'
                            AND installments.session_id = $session_id
                            ORDER BY students.roll_no ASC
                ");        
         
       }
     //echo $this->db->last_query();die;
      return $query->result_array();      
    }
    
    function getInstallments($std_id,$end_date)
    {
        
      if($this->session->userdata('role') == 'OS'){   
                      $query = $this->db->query("SELECT installments.due_date, installments.payable,challan.challan_id
                        FROM installments_os AS installments
                        INNER JOIN challan_os AS challan on installments.installment_id = challan.installment_id
                        WHERE installments.student_id = $std_id
                        AND challan.status = 0
                        AND installments.due_date > '$end_date'
                        ORDER BY due_date ASC 
        "); 
      }else{
          
          $query = $this->db->query("SELECT installments.due_date, installments.payable,challan.challan_id
                        FROM installments
                        INNER JOIN challan on installments.installment_id = challan.installment_id
                        WHERE installments.student_id = $std_id
                        AND challan.status = 0
                        AND installments.due_date > '$end_date'
                        ORDER BY due_date ASC 
        "); 
          
      }
      // $this->db->last_query();die;
      return $query->result_array();
    }
    
    function getInstallments2($std_id)
    {
        
      if($this->session->userdata('role') == 'OS'){   
                      $query = $this->db->query("SELECT installments.due_date, installments.payable,challan.challan_id
                        FROM installments_os AS installments
                        INNER JOIN challan_os AS challan on installments.installment_id = challan.installment_id
                        WHERE installments.student_id = $std_id
                        AND challan.status = 0                        
                        ORDER BY due_date ASC 
        "); 
      }else{
          
          $query = $this->db->query("SELECT installments.due_date, installments.payable,challan.challan_id
                        FROM installments
                        INNER JOIN challan on installments.installment_id = challan.installment_id
                        WHERE installments.student_id = $std_id
                        AND challan.status = 0                        
                        ORDER BY due_date ASC 
        "); 
          
      }
      // $this->db->last_query();die;
      return $query->result_array();
    }
    
    
    function changeDueDate($campaign_id,$campus_id, $program_id, $start_date, $end_date)
    {      
        if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        } 
        $program     = $program_id == '' ? '': "AND forms.program_id = ".$program_id;
      
        if($this->session->userdata('role') == 'OS'){   
            $query = $this->db->query("SELECT installments.installment_id,installments.student_id,challan.status,installments.due_date 
                                FROM installments_os AS installments 

                                INNER JOIN students_os AS students ON installments.student_id = students.student_id 

                                INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 

                                INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id 

                                where 
                                forms.campaign_id = $campaign_id AND
                                installments.due_date BETWEEN '$start_date' AND '$end_date' 
                                $program
                                $campus
                                and challan.status = 0                                    
                                ");
        }else{
                        
            $query = $this->db->query("SELECT installments.installment_id,installments.student_id,challan.status,installments.due_date FROM installments 

                                INNER JOIN students ON installments.student_id = students.student_id 

                                INNER JOIN forms ON forms.form_id = students.form_id 

                                INNER JOIN challan ON installments.installment_id = challan.installment_id 

                                where 
                                forms.campaign_id = $campaign_id AND
                                installments.due_date BETWEEN '$start_date' AND '$end_date' 
                                $program
                                $campus
                                and challan.status = 0                                    
                                ");
        }
//      echo $this->db->last_query();die;
      return $query->result_array();
      
    }
    
    function UpdateDueDate($installment_id,$new_date)
    {
            
        $data   =   array('due_date' => $new_date);
        $this->db->where('installment_id', $installment_id);
     
        
        if($this->session->userdata('role') == 'OS'){ 
                return $query = $this->db->update('installments_os', $data);
        }else{
                return $query = $this->db->update('installments', $data);
        }
    }
    
    
    function challanIssue($campus_id, $campaign_id, $program_id, $start_date, $end_date)
    { 
        
        if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }else{
            $campus         =  "AND forms.campus_id = ".$campus_id ;
        } 
        
      if($this->session->userdata('role') == 'OS'){ 
          
                $query = $this->db->query("SELECT roll_no, payable, due_date, campus.campus_name, 
                            campaign.campaign_name, program_name,student_name
                            FROM students_os AS students
                            INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                            INNER JOIN forms_os AS forms ON students.form_id = forms.form_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.program_id = $program_id
                            $campus
                            AND forms.campaign_id = $campaign_id                            
                            AND installments.due_date BETWEEN '$start_date' AND '$end_date'
                            AND challan.status = 0
                            ORDER BY roll_no ASC
                      ");
          
      }else{
          
                $query = $this->db->query("SELECT roll_no, payable, due_date, campus.campus_name, 
                            campaign.campaign_name, program_name,student_name
                            FROM students
                            INNER JOIN installments ON students.student_id = installments.student_id
                            INNER JOIN challan ON installments.installment_id = challan.installment_id
                            INNER JOIN forms ON students.form_id = forms.form_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.program_id = $program_id
                            $campus
                            AND forms.campaign_id = $campaign_id                            
                            AND installments.due_date BETWEEN '$start_date' AND '$end_date'
                            AND challan.status = 0
                            ORDER BY roll_no ASC
                      ");
          
      }
      
      //echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    function updateStatus($student_id,$status)
    {
       $log_data    =   array(
                                'student_id'        =>  $student_id,
                                'status'            =>  $status,
                                'operator_id'       =>  $this->session->userdata('sub_login_id')
                            ); 
        
        
       if($this->session->userdata('role') == 'OS'){
           
           $query           = $this->db->insert('left_freeze_log', $log_data); 
           $id              =    $this->db->insert_id();
           if($id){
             $query2   = $this->db->query("update students_os set status = '$status' where student_id = $student_id ");
             return $this->db->affected_rows();
           }else{
            return false;
           }
           
       }else{
           
           $query           = $this->db->insert('left_freeze_log', $log_data); 
           $id              =    $this->db->insert_id();
           if($id){
            $query2 = $this->db->query("update students set status = '$status' where student_id = $student_id ");
            return $this->db->affected_rows();
           }else{
            return false;
           }
           
       }
    }
    
    function addLog($data){
            $query = $this->db->insert('freeze_left_logs', $data); 
            return  $this->db->insert_id();
    }
  
    
    function deleteUnpaidInstallments($std_id,$session_id)
    {
        
      if($this->session->userdata('role') == 'OS'){
             
          $query =  $this->db->query("DELETE installments, challan
                              FROM installments_os AS installments
                              INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                              WHERE installments.student_id = $std_id
                              AND installments.session_id = $session_id
                              AND challan.status = 0                              
                            ");
      }else{
          
          $query =  $this->db->query("DELETE installments, challan
                              FROM installments
                              INNER JOIN challan ON installments.installment_id = challan.installment_id
                              WHERE installments.student_id = $std_id                                  
                              AND installments.session_id = $session_id
                              AND challan.status = 0                              
                            ");
          
      }
      return $query;      
    }
    
    
    // functions for quick search  *************************************
    
    function getStdId($no){
       
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $query = $this->db->query("select Distinct(students.student_id) 
                                                 From students_os AS students 
                                                 LEFT JOIN challan_os AS challan ON challan.student_id = students.student_id 
                                                 where 
                                                 students.form_no = '$no' OR
                                                 challan.challan_id = '$no' 
                                    ");		
        }else{
            $query =  $query = $this->db->query("select Distinct(students.student_id) 
                                                 From students 
                                                 LEFT JOIN challan ON challan.student_id = students.student_id 
                                                 where 
                                                 students.form_no = '$no' OR
                                                 challan.challan_id = '$no'
                                    ");			
        }
       //echo $this->db->last_query();die;
        $result = $query->row();
        
        return $result->student_id;
       
   }
   
    // functions for quick search  *************************************
    
    function getStdId2($rollno,$campus_id){
       
        if($campus_id == 1 OR $campus_id == 3)
         {
             $campus_id =    3;
         } 
        
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $query = $this->db->query("select Distinct(students.student_id) 
                                                 From students_os AS students 
                                                 INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                                                 where 
                                                 students.roll_no = '$rollno' AND 
                                                 forms.campus_id = $campus_id
                                    ");		
        }else{
            $query =  $query = $this->db->query("select Distinct(students.student_id) 
                                                 From students 
                                                 INNER JOIN forms ON forms.form_id = students.form_id 
                                                 where 
                                                 students.roll_no = '$rollno' AND 
                                                 forms.campus_id = $campus_id
                                    ");			
        }
       //echo $this->db->last_query();die;
        $result = $query->row();
        
        return $result->student_id;
       
   }
   
   function getInsId($challan_id)
   {
       // for out station 
        if($this->session->userdata('role') == 'OS')
        {
            $query =  $query = $this->db->query("Select ins.installment_id,ins.due_date 
                                                 From installments_os AS ins 
                                                 INNER JOIN challan_os AS challan ON challan.installment_id = ins.installment_id 
                                                 where
                                                 challan.challan_id = $challan_id 
                                                ");		
        }else{
            $query =  $query = $this->db->query("Select ins.installment_id,ins.due_date 
                                                 From installments AS ins 
                                                 INNER JOIN challan ON challan.installment_id = ins.installment_id 
                                                 where
                                                 challan.challan_id = $challan_id 
                                                ");			
        }
       //echo $this->db->last_query();die;
        return  $query->row();
        
   }
   
   
   function challanStatusUnpaid($challan_id)
    {
       // for out station 
        if($this->session->userdata('role') == 'OS')
        { 
            $this->db->query("update challan_os set status = 0, type = '', slip_no = '', post_date = '0000-00-00' where challan_id = $challan_id");
            $rows   =    $this->db->affected_rows();
        }else{
            $this->db->query("update challan set status = 0, type = '', slip_no = '', post_date = '0000-00-00' where challan_id = $challan_id");
            $rows = $this->db->affected_rows();
        }
        
            if($rows > 0)
                {
                        $action     =   $this->uri->segment(1).'/'.$this->uri->segment(2);
                        $log_data   =   array(
                                                'operator_id'   => $this->session->userdata('sub_login_id'),
                                                'reference_id'  => $challan_id,
                                                'action'        => $action
                                            );
                        $query = $this->db->insert('user_log', $log_data); 
                        return $rows;                 
                }else{  
                    return $rows;
                }
      
    }
    
    
    // functions for quick search  *************************************
    
    function  getCurrentSession(){
        $this->db->select('session_id');
        $this->db->from('sessions');
        $this->db->where('active',1);
        $this->db->limit(1);
        $query = $this->db->get();
       //echo $this->db->last_query();die;
        return $query->row();
        
    }
    
    function promoteStudents($program_id,$pre_session_id,$campaign_id){
        
         if($this->session->userdata('role') == 'OS')
        {
            $campus_id  =   $this->session->userdata('campus_id');
            $query      =   $this->db->query("SELECT students.*,sfp.session_fee,sfp.misc_fee,sfp.tax
                                                FROM students_os AS students
                                                INNER JOIN student_fee_package_os AS sfp ON sfp.`student_id` = students.`student_id`
                                                INNER JOIN forms_os AS forms ON forms.`form_id` = students.`form_id`

                                                WHERE                                                
                                                forms.`program_id` = $program_id AND 
                                                forms.campus_id    = $campus_id AND
                                                students.`current_session_id` = $pre_session_id AND
                                                students.`status` = 'ok'
                                                
                                                ORDER BY students.student_id ASC
                                            ");
        }else{
            
            $query      =   $this->db->query("SELECT students.*,sfp.session_fee,sfp.misc_fee,sfp.tax
                                                FROM students
                                                INNER JOIN student_fee_package AS sfp ON sfp.`student_id` = students.`student_id`
                                                INNER JOIN forms ON forms.`form_id` = students.`form_id`

                                                WHERE                                                
                                                forms.`program_id` = $program_id AND 
                                                students.`current_session_id` = $pre_session_id AND
                                                forms.campaign_id   =   $campaign_id AND
                                                students.`status` = 'ok'
                                                
                                                ORDER BY students.student_id ASC
                                            ");
        }
        
        
        //echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function update_semester($student_id,$next_semester,$cur_session){
        
         if($this->session->userdata('role') == 'OS')
        {
                           $query      =   $this->db->query("update students_os set current_session_id = $cur_session, semester = $next_semester 
                                            where student_id = $student_id
                                         ");
        }else{
                           $query      =   $this->db->query("update students set current_session_id = $cur_session
                                            where student_id = $student_id
                                         ");
        }
        return $this->db->affected_rows();
    }
    
    function  getStudentsRollNo($program_id,$campaign_id){
        $query      =   $this->db->query("SELECT students.* FROM students
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        where
                                        forms.program_id = $program_id AND forms.campaign_id = $campaign_id AND students.status= 'ok' AND students.roll_no != ''
                                        ORDER BY students.roll_no ASC
                                         ");
//        echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
    function getFeeInfo($student_id,$session_id){
        $query      =   $this->db->query("SELECT  programs.program_id,sessions.session,forms.`student_name`,students.student_id,students.roll_no,scs.course_id,scs.current_session_id,courses.course_name,programs.`program_name` FROM student_course_sections AS scs
                                            INNER JOIN courses ON courses.`course_id` = scs.`course_id`
                                            INNER JOIN students ON students.`student_id` = scs.`student_id`
                                            INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                            INNER JOIN programs ON programs.`program_id` = forms.`program_id`
                                            INNER JOIN sessions ON sessions.`session_id` = scs.`current_session_id`
                                            WHERE
                                            scs.`student_id` = $student_id AND
                                            scs.`current_session_id` = $session_id AND
                                            courses.course_type = 'Theory'
                                         ");
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    function getOriginalFeePerCourse($program_id,$no_of_courses,$campaign_id){
        $query      =   $this->db->query("SELECT (SUM(misc_fee+session_fee) * no_of_sessions) AS total_fee FROM program_fees WHERE program_id = $program_id AND campus_id = 3  AND campaign_id = $campaign_id ");
       
        $result     =   $query->row();
        
        // for per course fee divide total fee of a degree to the total  no of courses of the program 
        return round($result->total_fee/$no_of_courses);
    }
    
    
    function getDiscountedFeePerCourse($program_id,$student_id,$no_of_courses){
        $query      =   $this->db->query("SELECT (session_total_package * total_sessions) AS total_fee FROM student_fee_package WHERE program_id = $program_id AND student_id = $student_id ");       
        $result     =   $query->row();
        
        // for per course fee divide total fee of a degree to the total  no of courses of the program 
        return round($result->total_fee/$no_of_courses);
    }
    
    function getResult($course_id,$student_id,$current_session_id){
        
         $query      =   $this->db->query("SELECT mid_result_id FROM mid_result 
                                            WHERE
                                            student_id = $student_id AND
                                            course_id  = $course_id AND
                                            session_id < $current_session_id
                                         ");
        //echo $this->db->last_query();//die;
        return $query->num_rows();
        
    }
    
    function Add_CR_StdSessionFee($data){
                $query = $this->db->insert('cr_student_fees', $data); 
                return $this->db->insert_id();
    }
    
    function chk_cr_record($chkdata){
        
       $query = $this->db->get_where('cr_student_fees', $chkdata);		
       return $query->num_rows();
    }
    
    function getNoOfCourses($program_id){
        $query  =   $this->db->query("SELECT no_of_courses FROM programs WHERE program_id = $program_id");
        $result =   $query->row();
        return      $result->no_of_courses;
    }
    
    
    
    function getNextSession($session_id){
        $query  =   $this->db->query("SELECT *
                                        FROM 
                                            sessions 
                                        WHERE 
                                            session_id > $session_id AND 
                                            (session LIKE 'Fall%' OR session LIKE 'Spring%') 
                                        ORDER BY 
                                            session_id 
                                        limit 1 ");
        
        return $query->row();
    }
    
    function getSessions($student_id)
      {
          $this->db->select('ins.session_id,sessions.session');
          $this->db->from('installments ins');
          $this->db->join('sessions','sessions.session_id = ins.session_id','inner');
          $this->db->where('ins.student_id',$student_id);
          //$this->db->orderby('ins.session_id','ASC');
          $this->db->group_by('ins.session_id');
          
          $query = $this->db->get();
          
          return $query->result_array();
          
      }
      
     function getRepeatedCourse($course_id,$student_id,$session_id){
         
         $query         =   $this->db->query("SELECT id,course_id,current_session_id FROM student_course_sections WHERE student_id = $student_id AND course_id = $course_id ORDER BY id ASC");
         
     if($query->num_rows() < 2 ){
         return $query->num_rows();
     }else{
         $result        =   $query->result_array();
                if($result[0]['current_session_id'] == $session_id){
                    return 1;
                }else{
                    return $query->num_rows();
                }
     }
    
}
    
}