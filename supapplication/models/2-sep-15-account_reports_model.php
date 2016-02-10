<?php

class Account_reports_model extends CI_Model {

    // get all campuses data from db
    
    function getAllcampaigns()
    {
        $query = $this->db->get_where('campaign');
        return $query->result_array();
            
    }   
    
    
     // *********** >>> START    package Report Actions   <<< **********  //
     
    
    // get all packages report campus wise
    
    function getCampusWise($campaign_id,$campus_id,$status,$start_date,$end_date)
    {
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
        
        if($status == 1){$statuss = "AND students.status = 'ok'";}
        if($status == 2){$statuss = "AND students.status != 'ok'";}
        if($status == 0){$statuss = "";}
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT  
                        programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, sfp.admission_fee,sfp.misc_fee,sfp.session_fee FROM students_os AS students 
                        INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                        INNER JOIN programs ON programs.program_id = forms.program_id 
                        INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                        INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id` 
                        INNER JOIN student_fee_package_os AS sfp ON sfp.student_id = students.student_id 
                        WHERE 
                        forms.campaign_id = '".$campaign_id."'
                        $campus
                        $statuss
                        and students.roll_no != ''
                        AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."' 
                        ORDER BY sfp.student_fee_pakage_id DESC ");
             
             }else{
                        
                       $query = $this->db->query("SELECT  
                        programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, sfp.admission_fee,sfp.misc_fee,sfp.session_fee FROM students 
                        INNER JOIN forms ON forms.form_id = students.form_id 
                        INNER JOIN programs ON programs.program_id = forms.program_id 
                        INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                        INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`
                        INNER JOIN student_fee_package AS sfp ON sfp.student_id = students.student_id 
                        WHERE 
                        forms.campaign_id = '".$campaign_id."'
                        $campus
                        $statuss
                        and students.roll_no != ''
                        AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."' 
                        ORDER BY sfp.student_fee_pakage_id DESC ");
             
                 
                  }
         
                //  echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    // get all packages report campus wise
    
    function getProgramWise($campaign_id,$campus_id,$program_id,$status,$start_date,$end_date)
    {
        if($campus_id == 0){
            $campus         =   $campus_id == 0 ? '': "AND forms.campus_id = ".$campus_id ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        } 
        
        $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
        
        if($status == 1){$statuss = "AND students.status = 'ok'";}
        if($status == 2){$statuss = "AND students.status != 'ok'";}
        if($status == 0){$statuss = "";}
        
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT  
                        programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, sfp.admission_fee,sfp.misc_fee,sfp.session_fee FROM students_os AS students 
                        INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                        INNER JOIN programs ON programs.program_id = forms.program_id 
                        INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                        INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id` 
                        INNER JOIN student_fee_package_os AS sfp ON sfp.student_id = students.student_id 
                        WHERE 
                        forms.campaign_id = '".$campaign_id."'
                        $campus
                        $program
                        $statuss
                        AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."' 
                        ORDER BY sfp.student_fee_pakage_id DESC ");
             
             }else{
                        
                       $query = $this->db->query("SELECT  
                        programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, sfp.admission_fee,sfp.misc_fee,sfp.session_fee FROM students 
                        INNER JOIN forms ON forms.form_id = students.form_id 
                        INNER JOIN programs ON programs.program_id = forms.program_id 
                        INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                        INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`
                        INNER JOIN student_fee_package AS sfp ON sfp.student_id = students.student_id 
                        WHERE 
                        forms.campaign_id = '".$campaign_id."'
                        $campus
                        $program
                        $statuss
                        AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."' 
                        ORDER BY sfp.student_fee_pakage_id DESC ");
             
                 
                  }
         
                  //echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    // get all packages report campus wise
    
    function getAddressWise($campaign_id,$campus_id,$program_id,$shift)
    {
        
        if($campus_id == 0){
            $campus         =   $campus_id == 0 ? '': "AND forms.campus_id = ".$campus_id ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
        
        $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
        $shift          =   $shift == 0 ? '': "AND students.shift = ".$shift ;
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.present_address,forms.mobile,forms.form_no,students.roll_no,students.shift,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms_os AS forms

                                                INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id

                                                WHERE 

                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
             }else{
                        
                        $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.	present_address,forms.mobile,forms.form_no,students.roll_no,students.shift,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms

                                                INNER JOIN students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                
                                                WHERE 

                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
                 
                  }
         
                //  echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    function getStatusWise($campaign_id,$campus_id,$program_id,$shift,$status)
            {
        
        if($campus_id == 0){
            $campus         =   $campus_id == 0 ? '': "AND forms.campus_id = ".$campus_id ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
        
        $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
        $shift          =   $shift == 0 ? '': "AND students.shift = ".$shift ;
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.present_address,forms.mobile,forms.form_no,students.roll_no,students.shift,students.status,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms_os AS forms

                                                INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id

                                                WHERE 
                                                students.status = '$status' AND
                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
             }else{
                        
                        $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.	present_address,forms.mobile,forms.form_no,students.roll_no,students.shift,students.status,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms

                                                INNER JOIN students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                
                                                WHERE 
                                                students.status = '$status' AND
                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
                 
                  }
         
                  //echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    function getSectionWise($campaign_id,$campus_id,$program_id,$shift)
    {
        if($campus_id == 0){
            $campus         =   $campus_id == 0 ? '': "AND forms.campus_id = ".$campus_id ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
        
        
        $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
        
        if($shift == '0') {$shift   =   '';} else{ $shift = "AND students.shift = "."'$shift'";}
        //echo $shift;die; 
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.form_no,students.roll_no,students.shift,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms_os AS forms

                                                INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                
                                                WHERE 

                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
             }else{
                        
                        $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.form_no,students.roll_no,students.shift,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms

                                                INNER JOIN students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id

                                                WHERE 

                                                forms.campaign_id = $campaign_id 
                                                $program
                                                $campus 
                                                $shift 
                                                AND students.roll_no != ''
                                                ORDER BY students.roll_no ASC");
             
                 
                  }
         
//                  echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    
    
     // *********** >>> START    Installments Report Actions   <<< **********  //
     
    
    // get all packages report campus wise
    
    function getCampusWiseInstallment($campaign_id,$campus_id,$program_id,$start_date,$end_date)
    {
        
        
        $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
                
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT  
                                                students.student_id,students.semester,students.roll_no,forms.form_no,forms.student_name,programs.program_name,campaign.campaign_name, campus.campus_name,sfp.admission_fee,sfp.session_total_package
                                                FROM 
                                                students_os AS students 

                                                INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 
                                                INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                LEFT JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`                                                 
                                                INNER JOIN student_fee_package_os AS sfp ON students.student_id = sfp.student_id
                                                WHERE 
                                                forms.campaign_id = '".$campaign_id."'
                                                $campus
                                                $program
                                                AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."'

                                                ORDER BY 
                                                students.roll_no DESC
                                                ");
             
             }else{
                        
                       $query = $this->db->query("SELECT  
                                                students.student_id,students.semester,students.roll_no,forms.form_no,forms.student_name,programs.program_name,campaign.campaign_name, campus.campus_name,sfp.admission_fee,sfp.session_total_package
                                                FROM 
                                                students 

                                                INNER JOIN forms ON forms.form_id = students.form_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 
                                                INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                LEFT JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`                                                 
                                                INNER JOIN student_fee_package AS sfp ON students.student_id = sfp.student_id
                                                WHERE 
                                                forms.campaign_id = '".$campaign_id."'
                                                $campus
                                                $program
                                                AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."'                                                 
                                                ORDER BY 
                                                students.roll_no DESC");
             
                 
                  }
         
                // echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    // get all packages report campus wise
    
    function getNonInstallment($campaign_id,$campus_id,$program_id,$start_date,$end_date)
    {
        
        
            $program        =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
        
        
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
             
                    $query = $this->db->query("SELECT  
                                                students.student_id,students.semester,students.roll_no,forms.form_no,forms.student_name,programs.program_name,campaign.campaign_name, campus.campus_name,sfp.admission_fee,sfp.session_total_package
                                                FROM 
                                                students_os AS students 

                                                INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 
                                                INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                LEFT JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`                                                 
                                                INNER JOIN student_fee_package_os AS sfp ON students.student_id = sfp.student_id
                                                WHERE 
                                                forms.campaign_id = '".$campaign_id."'
                                                $campus
                                                $program
                                                AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."'
                                                ORDER BY 
                                                students.roll_no DESC
                                                ");
             
             }else{
                        
                       $query = $this->db->query("SELECT  
                                                students.student_id,students.semester,students.roll_no,forms.form_no,forms.student_name,programs.program_name,campaign.campaign_name, campus.campus_name,sfp.admission_fee,sfp.session_total_package
                                                FROM 
                                                students 

                                                INNER JOIN forms ON forms.form_id = students.form_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 
                                                INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                LEFT JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id`                                                 
                                                INNER JOIN student_fee_package AS sfp ON students.student_id = sfp.student_id
                                                WHERE 
                                                forms.campaign_id = '".$campaign_id."'
                                                $campus
                                                $program
                                                AND sfp.`created_date` BETWEEN '".$start_date."' AND '".$end_date."'                                                 
                                                ORDER BY 
                                                students.roll_no DESC");
             
                 
                  }
         
             //    echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    function getInstallments($student_id)
    {
       
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
        
                $this->db->select('*');
                $this->db->from('installments_os');
                $this->db->where('student_id',$student_id);
                $this->db->group_by('installment_id');
                $query  =   $this->db->get();
                
             }else{
                $this->db->select('*');
                $this->db->from('installments');
                $this->db->where('student_id',$student_id);
                $this->db->group_by('installment_id');
                $query  =   $this->db->get();
             }
        
           //  echo $this->db->last_query();die;
             
             return $query->result_array();
        
    }
    
  // Bank cash report 
    
     function dateWiseBankCashReport($shift,$campus_id, $campaign_id, $program_id,  $start_date, $end_date)
    { 
      
      $program     = $program_id == 0 ? '': "AND forms.program_id = ".$program_id;
      //$campus      = $campus_id == 0 ? '': "AND forms.campus_id = ".$campus_id;
      
       if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
     
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
        
                $query = $this->db->query("SELECT challan.post_date, SUM(IF(challan.type = 'Bank', 1, 0)) AS bank, 
                                      SUM(IF(challan.type = 'Cash', 1, 0)) AS cash, SUM(installments.payable) AS amount,
                                      SUM(IF(challan.type = 'Bank', installments.payable, 0)) AS bank_total,
                                      SUM(IF(challan.type = 'Cash', installments.payable, 0)) AS cash_total,
                                      campus.campus_name, campaign.campaign_name, programs.program_name          
                                      FROM forms_os AS forms
                                      INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                      INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                                      INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id  
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id  
                                      INNER JOIN programs ON forms.program_id = programs.program_id 
                                      WHERE forms.campaign_id = $campaign_id
                                      $campus
                                      $program   
                                      AND students.shift = '$shift'
                                      AND challan.status = 1
                                      AND DATE(challan.post_date) BETWEEN '$start_date' AND '$end_date'
                                      GROUP BY challan.post_date
                                ");
             }else{
                 $query = $this->db->query("SELECT challan.post_date, SUM(IF(challan.type = 'Bank', 1, 0)) AS bank, 
                                      SUM(IF(challan.type = 'Cash', 1, 0)) AS cash, SUM(installments.payable) AS amount,
                                      SUM(IF(challan.type = 'Bank', installments.payable, 0)) AS bank_total,
                                      SUM(IF(challan.type = 'Cash', installments.payable, 0)) AS cash_total,
                                      campus.campus_name, campaign.campaign_name, programs.program_name          
                                      FROM forms
                                      INNER JOIN students ON forms.form_id = students.form_id
                                      INNER JOIN installments ON students.student_id = installments.student_id
                                      INNER JOIN challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id  
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id  
                                      INNER JOIN programs ON forms.program_id = programs.program_id 
                                      WHERE forms.campaign_id = $campaign_id
                                      $campus
                                      $program 
                                      AND students.shift = '$shift'
                                      AND challan.status = 1
                                      AND DATE(challan.post_date) BETWEEN '$start_date' AND '$end_date'
                                      GROUP BY challan.post_date
                                ");
             }

      //echo $this->db->last_query();die;       
             
      return $query->result_array();
      
    }
  
    function programWiseBankCashReport($shift,$campus_id, $campaign_id, $program_id, $type, $start_date, $end_date)
    { 
        
      $campaign     = $campaign_id == 0 ? '': "AND forms.campaign_id = ".$campaign_id;
      
      $program     = $program_id == 0 ? '': "AND forms.program_id = ".$program_id;
      if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "forms.campus_id = 3"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "forms.campus_id = ".$this->session->userdata('campus_id') ;
        }
     
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
                $query = $this->db->query("SELECT challan.post_date, challan.type, students.roll_no, forms.student_name, 
                                      installments.payable,installments.installment_no, installments.fine, installments.due_date,
                                      campus.campus_name, campaign.campaign_name, programs.program_name          
                                      FROM students_os AS students
                                      INNER JOIN forms_os AS forms ON forms.form_id = students.form_id
                                      INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                                      INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id  
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id  
                                      INNER JOIN programs ON forms.program_id = programs.program_id 
                                      WHERE 
                                      $campus
                                      $campaign
                                      $program
                                      AND students.shift = '$shift'
                                      AND challan.status = 1
                                      AND challan.type = '$type'
                                      AND DATE(challan.post_date) BETWEEN '$start_date' AND '$end_date'
                                      ORDER BY students.roll_no                            
                                ");
             }else{
                  $query = $this->db->query("SELECT challan.post_date, challan.type, students.roll_no, forms.student_name, 
                                      installments.payable,installments.installment_no, installments.fine, installments.due_date,
                                      campus.campus_name, campaign.campaign_name, programs.program_name          
                                      FROM students
                                      INNER JOIN forms ON forms.form_id = students.form_id
                                      INNER JOIN installments ON students.student_id = installments.student_id
                                      INNER JOIN challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id  
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id  
                                      INNER JOIN programs ON forms.program_id = programs.program_id 
                                      WHERE 
                                      $campus
                                      $campaign
                                      $program
                                      AND students.shift = '$shift'
                                      AND challan.status = 1
                                      AND challan.type = '$type'
                                      AND DATE(challan.post_date) BETWEEN '$start_date' AND '$end_date'
                                      ORDER BY students.roll_no                            
                                ");
             }
     
      //echo $this->db->last_query();die;
      return $query->result_array();
      
    }

    function campusClosingReceivable($campaign_id, $campus_id, $start_date, $end_date){
        
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
     
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
                    $query = $this->db->query("SELECT SUM(installments.payable) AS amount, campus.campus_id, campus.campus_name, 
                                MONTH(installments.due_date) AS mon, YEAR(installments.due_date) AS year
                                FROM installments_os AS installments
                                INNER JOIN students_os AS students ON installments.student_id = students.student_id 
                                INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                                INNER JOIN campus ON forms.campus_id = campus.campus_id 
                                WHERE forms.campaign_id = $campaign_id
                                $campus 
                                AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                                GROUP BY campus.campus_id, MONTH(installments.due_date)
                                ORDER BY campus.campus_id, YEAR(installments.due_date), MONTH(installments.due_date)                    
                    ");
             }else{
                 $query = $this->db->query("SELECT SUM(installments.payable) AS amount, campus.campus_id, campus.campus_name, 
                                MONTH(installments.due_date) AS mon, YEAR(installments.due_date) AS year
                                FROM installments
                                INNER JOIN students ON installments.student_id = students.student_id 
                                INNER JOIN forms ON forms.form_id = students.form_id 
                                INNER JOIN campus ON forms.campus_id = campus.campus_id 
                                WHERE forms.campaign_id = $campaign_id
                                $campus 
                                AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                                GROUP BY campus.campus_id, MONTH(installments.due_date)
                                ORDER BY campus.campus_id, YEAR(installments.due_date), MONTH(installments.due_date)                    
                    ");
             }
      
      
      //echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    function campusClosingReceived($campaign_id, $campus_id, $start_date, $end_date){
        
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
       
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
                    $query = $this->db->query("SELECT SUM(installments.payable) AS amount, campus.campus_id, campus.campus_name, 
                            MONTH(installments.due_date) AS mon, YEAR(installments.due_date) AS year
                            FROM installments_os AS installments
                            INNER JOIN students_os AS students ON installments.student_id = students.student_id 
                            INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id 
                            INNER JOIN challan ON installments.installment_id = challan.installment_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus  
                            AND challan.status = '1'
                            AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY campus.campus_id, MONTH(installments.due_date)
                            ORDER BY campus.campus_id, YEAR(installments.due_date), MONTH(installments.due_date)                    
                    ");
             }else{
                  $query = $this->db->query("SELECT SUM(installments.payable) AS amount, campus.campus_id, campus.campus_name, 
                            MONTH(installments.due_date) AS mon, YEAR(installments.due_date) AS year
                            FROM installments
                            INNER JOIN students ON installments.student_id = students.student_id 
                            INNER JOIN forms ON forms.form_id = students.form_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id 
                            INNER JOIN challan ON installments.installment_id = challan.installment_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus  
                            AND challan.status = '1'
                            AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY campus.campus_id, MONTH(installments.due_date)
                            ORDER BY campus.campus_id, YEAR(installments.due_date), MONTH(installments.due_date)                    
                    ");
             }
      
      
      
      //echo $this->db->last_query();die;
      return $query->result_array();
    }

     //********  Campus Wise Defaulter  ********\\
    
    function getCampusWiseDefaulter($campaign_id,$campus_id,$shift,$start_date,$end_date)
    { 
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
                    $query = $this->db->query("SELECT installments.*, challan.*, students.student_id, students.roll_no, students.form_id, forms.campus_id, 
                                    forms.student_name, forms.mobile, campaign.campaign_name, campus.campus_name,program_name
                                    FROM forms_os AS forms 
                                    INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                    INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                                    INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                                    INNER JOIN campus ON forms.campus_id = campus.campus_id
                                    INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                    INNER JOIN programs ON forms.program_id = programs.program_id
                                    WHERE DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                                    $campus
                                    AND forms.campaign_id = $campaign_id
                                    AND students.status = 'ok'
                                    AND students.shift  = '$shift'
                                    AND challan.status = 0
                                    ORDER BY installments.due_date DESC
                    ");      
             }else{
                 $query = $this->db->query("SELECT installments.*, challan.*, students.student_id, students.roll_no, students.form_id, forms.campus_id, 
                                    forms.student_name, forms.mobile, campaign.campaign_name, campus.campus_name,program_name
                                    FROM forms 
                                    INNER JOIN students ON forms.form_id = students.form_id
                                    INNER JOIN installments ON students.student_id = installments.student_id
                                    INNER JOIN challan ON installments.installment_id = challan.installment_id
                                    INNER JOIN campus ON forms.campus_id = campus.campus_id
                                    INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                    INNER JOIN programs ON forms.program_id = programs.program_id
                                    WHERE DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                                    $campus
                                    AND forms.campaign_id = $campaign_id
                                    AND students.status = 'ok'
                                    AND students.shift  = '$shift'
                                    AND challan.status = 0
                                    ORDER BY installments.due_date DESC
                    ");   
             }
      
        
      return $query->result_array();
      
    }      
    
    //********  Program Wise Defaulter  ********\\
    
    function getProgramWiseDefaulter($campaign_id,$campus_id,$shift,$program_id, $start_date, $end_date)
    {
      
      if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
        
        
      $program  = $program_id == 0 ? '': "AND forms.program_id = ".$program_id;       
     
       // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
      
                    $query = $this->db->query("SELECT installments.*, challan.*, students.student_id, students.roll_no, students.form_id, forms.campus_id, forms.student_name, forms.mobile, campaign.campaign_name, campus.campus_name, programs.program_name
                                      FROM forms_os AS forms
                                      INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                      INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                                      INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN programs ON forms.program_id = programs.program_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                      WHERE installments.due_date BETWEEN '$start_date' AND  '$end_date'
                                      $campus
                                      AND students.status = 'ok'
                                      AND students.shift  = '$shift'
                                      $program                        
                                      AND challan.status = 0
                                      AND forms.campaign_id = $campaign_id
                                      ORDER BY students.roll_no ASC
                              ");        
             }else{
                 
                  $query = $this->db->query("SELECT installments.*, challan.*, students.student_id, students.roll_no, students.form_id, forms.campus_id, forms.student_name, forms.mobile, campaign.campaign_name, campus.campus_name, programs.program_name
                                      FROM forms
                                      INNER JOIN students ON forms.form_id = students.form_id
                                      INNER JOIN installments ON students.student_id = installments.student_id
                                      INNER JOIN challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN programs ON forms.program_id = programs.program_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                      WHERE installments.due_date BETWEEN '$start_date' AND  '$end_date'
                                      $campus
                                      AND students.status = 'ok'
                                      AND students.shift  = '$shift'
                                      $program                        
                                      AND challan.status = 0
                                      AND forms.campaign_id = $campaign_id
                                      ORDER BY students.roll_no ASC
                              ");   
                 
             }
      //echo $this->db->last_query();die;
      return $query->result_array();
      
    }
    
    //********  Program Wise Defaulter Summary  ********\\
    
    function getProgramWiseDefaulterSummary($campaign_id,$campus_id,$shift,$start_date,$end_date)
    {
      
      if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
         
     
       // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
      
                    $query = $this->db->query("SELECT programs.program_name,SUM(installments.payable) AS defaulter,campaign.campaign_name, campus.campus_name
                                      FROM forms_os AS forms
                                      INNER JOIN students_os AS students ON forms.form_id = students.form_id
                                      INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                                      INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN programs ON forms.program_id = programs.program_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                      WHERE installments.due_date BETWEEN '$start_date' AND  '$end_date'
                                      $campus
                                      AND students.status = 'ok'
                                      AND students.shift  = '$shift'
                                      AND challan.status = 0
                                      AND forms.campaign_id = $campaign_id
                                      GROUP BY forms.program_id
                                      ORDER BY students.roll_no ASC
                              ");        
             }else{
                 
                  $query = $this->db->query("SELECT programs.program_name,SUM(installments.payable) AS defaulter,campaign.campaign_name, campus.campus_name
                                      FROM forms
                                      INNER JOIN students ON forms.form_id = students.form_id
                                      INNER JOIN installments ON students.student_id = installments.student_id
                                      INNER JOIN challan ON installments.installment_id = challan.installment_id
                                      INNER JOIN programs ON forms.program_id = programs.program_id
                                      INNER JOIN campus ON forms.campus_id = campus.campus_id
                                      INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                                      WHERE installments.due_date BETWEEN '$start_date' AND  '$end_date'
                                      $campus
                                      AND students.status = 'ok' 
                                      AND students.shift  = '$shift'
                                      AND challan.status = 0
                                      AND forms.campaign_id = $campaign_id
                                      GROUP BY forms.program_id
                                      ORDER BY students.roll_no ASC
                              ");   
                 
             }
//      echo $this->db->last_query();die;
      return $query->result_array();
      
    }
    
    
   function getCampusClosinName($campus)
    { 
      $query = $this->db->get_where('campus', array('campus_id' => $campus));
      return $query->row();
      
    }
    
    function getCampaignName($campaign)
    {
      $query = $this->db->get_where('campaign', array('campaign_id' => $campaign));
      return $query->row();
      
    }
    
     function campusWiseClosingReport($campaign_id, $campus_id, $start_date, $end_date)
    { 
         
      // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {    
                    $query = $this->db->query("SELECT MONTH(due_date) AS month, YEAR(due_date) AS year, SUM(payable) AS rec_able,
                            SUM(IF(challan.status='1', payable, 0)) AS rec_ed,
                            SUM(IF(challan.status='0', payable, 0)) AS def,
                            campus.campus_name, campaign.campaign_name, campaign.campaign_id
                            FROM forms_os AS forms
                            INNER JOIN students_os AS students ON forms.form_id = students.form_id
                            INNER JOIN installments_os AS installments ON students.student_id = installments.student_id 
                            INNER JOIN programs ON forms.program_id = programs.program_id 
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            AND forms.campus_id = $campus_id 
                            AND forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY YEAR(due_date), MONTH(due_date)
                            ");
             }else{
                 
                 $query = $this->db->query("SELECT MONTH(due_date) AS month, YEAR(due_date) AS year, SUM(payable) AS rec_able,
                            SUM(IF(challan.status='1', payable, 0)) AS rec_ed,
                            SUM(IF(challan.status='0', payable, 0)) AS def,
                            campus.campus_name, campaign.campaign_name, campaign.campaign_id
                            FROM forms
                            INNER JOIN students ON forms.form_id = students.form_id
                            INNER JOIN installments ON students.student_id = installments.student_id 
                            INNER JOIN programs ON forms.program_id = programs.program_id 
                            INNER JOIN challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            AND forms.campus_id = $campus_id 
                            AND forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY YEAR(due_date), MONTH(due_date)
                            ");
                 
             }
      
      return $query->result_array(); 
    }
    
     function campusWiseClosingReceived($campaign_id, $campus_id, $start_date, $end_date)
    { 
       // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {    
         
                    $query = $this->db->query("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year,
                            SUM(IF(challan.status='1', payable, 0)) AS rec_ed,
                            campus.campus_name, campaign.campaign_name, campaign.campaign_id
                            FROM forms
                            INNER JOIN students ON forms.form_id = students.form_id
                            INNER JOIN installments ON students.student_id = installments.student_id 
                            INNER JOIN programs ON forms.program_id = programs.program_id 
                            INNER JOIN challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            AND forms.campus_id = $campus_id 
                            AND forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY YEAR(due_date), MONTH(due_date)
                            ");
             }else{
                 
                 $query = $this->db->query("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year,
                            SUM(IF(challan.status='1', payable, 0)) AS rec_ed,
                            campus.campus_name, campaign.campaign_name, campaign.campaign_id
                            FROM forms_os AS forms
                            INNER JOIN students_os AS students ON forms.form_id = students.form_id
                            INNER JOIN installments_os AS installments ON students.student_id = installments.student_id 
                            INNER JOIN programs ON forms.program_id = programs.program_id 
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id 
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            AND forms.campus_id = $campus_id 
                            AND forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' 
                            GROUP BY YEAR(due_date), MONTH(due_date)
                            ");
                 
             }
      
      return $query->result_array(); 
    }
    
    
     function getReceivable($campaign_id, $campus_id, $start_date, $end_date){
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             { 
                        $query = $this->db->query("SELECT SUM(installments.payable) AS rcvable, installments.due_date,
                            SUM(IF(challan.status = '0', payable, 0)) AS defaulter,
                            SUM(fine) AS lft              
                            FROM challan_os AS challan
                            INNER JOIN installments_os AS installments ON challan.installment_id = installments.installment_id
                            INNER JOIN students_os AS students ON students.student_id = challan.student_id
                            INNER JOIN forms_os AS forms ON forms.form_id = students.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.campus_id = $campus_id 
                            AND  forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(installments.due_date , '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                    ");
             }else{
                 
                 $query = $this->db->query("SELECT SUM(installments.payable) AS rcvable, installments.due_date,
                            SUM(IF(challan.status = '0', payable, 0)) AS defaulter,
                            SUM(fine) AS lft              
                            FROM challan
                            INNER JOIN installments ON challan.installment_id = installments.installment_id
                            INNER JOIN students ON students.student_id = challan.student_id
                            INNER JOIN forms ON forms.form_id = students.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.campus_id = $campus_id 
                            AND  forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(installments.due_date , '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                    ");
                 
             }
      return $query->row();
    }
    
    function getReceived($campaign_id, $campus_id, $start_date, $end_date){
        
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS')
             {
                    $query = $this->db->query("SELECT SUM(installments.payable) AS rced, installments.due_date 
                            FROM challan_os AS challan
                            INNER JOIN installments_os AS installments ON challan.installment_id = installments.installment_id
                            INNER JOIN students_os AS students ON students.student_id = challan.student_id
                            INNER JOIN forms_os AS forms ON forms.form_id = students.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.campus_id = $campus_id 
                            AND challan.status = 1      
                            AND  forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(challan.post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                    ");
             }else{
                 
                 $query = $this->db->query("SELECT SUM(installments.payable) AS rced, installments.due_date 
                            FROM challan
                            INNER JOIN installments ON challan.installment_id = installments.installment_id
                            INNER JOIN students ON students.student_id = challan.student_id
                            INNER JOIN forms ON forms.form_id = students.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            WHERE forms.campus_id = $campus_id 
                            AND challan.status = 1 
                            AND  forms.campaign_id = $campaign_id
                            AND DATE_FORMAT(challan.post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'
                    ");
                 
             }
             
      return $query->row();
    }
    
    
    function campusWiseDefaulterRevenue($campaign_id, $campus_id, $start_date, $end_date)
    {
        
       if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
        
      if($this->session->userdata('role') == 'OS')
             {
                 $query = $this->db->query("SELECT  programs.program_name, COUNT(DISTINCT(students.student_id)) as total_std,
                            SUM(IF(students.status = 'left', 1, 0)) AS total_left, 
                            SUM(IF(DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_able, 
                            SUM(IF(challan.status = '1' AND DATE_FORMAT(challan.post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' , payable, 0)) AS rec_ed, 
                            SUM(IF(challan.status = '0' AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' , payable, 0)) AS rem_amount, 
                            SUM(IF(students.status = 'left', payable, 0)) AS left_amount,
                            campus.campus_name, campus.campus_id, campaign.campaign_name, campaign.campaign_id
                            FROM forms_os As forms
                            INNER JOIN students_os AS students ON forms.form_id = students.form_id
                            INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN student_fee_package_os AS student_fee_package ON students.student_id = student_fee_package.student_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.campus_id
                            ORDER BY forms.campus_id
                            ");
             }else{
                    $query = $this->db->query("SELECT  programs.program_name, COUNT(DISTINCT(students.student_id)) as total_std,
                            SUM(IF(students.status = 'left', 1, 0)) AS total_left, 
                            SUM(IF(DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_able, 
                            SUM(IF(challan.status = '1' AND DATE_FORMAT(challan.post_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' , payable, 0)) AS rec_ed, 
                            SUM(IF(challan.status = '0' AND DATE_FORMAT(installments.due_date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' , payable, 0)) AS rem_amount, 
                            SUM(IF(students.status = 'left', payable, 0)) AS left_amount,
                            campus.campus_name, campus.campus_id, campaign.campaign_name, campaign.campaign_id
                            FROM forms
                            INNER JOIN students ON forms.form_id = students.form_id
                            INNER JOIN installments ON students.student_id = installments.student_id
                            INNER JOIN challan ON installments.installment_id = challan.installment_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN student_fee_package ON students.student_id = student_fee_package.student_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.campus_id
                            ORDER BY forms.campus_id
                            ");
             }
      
      //echo $this->db->last_query();die;
      return $query->result_array();      
    }
      
    
     function campusWisePackageReceivable($campaign_id, $campus_id)
    {  
         
        if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
      
        if($this->session->userdata('role') == 'OS')
             {
                $query = $this->db->query("SELECT SUM(session_total_package+admission_fee) AS total_pkg
                            FROM student_fee_package_os AS student_fee_package
                            INNER JOIN students_os AS students ON student_fee_package.student_id = students.student_id
                            INNER JOIN forms_os AS forms ON students.form_id = forms.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.campus_id
                            ORDER BY forms.campus_id
                            ");
             }else{
                 $query = $this->db->query("SELECT SUM(session_total_package+admission_fee) AS total_pkg
                            FROM student_fee_package
                            INNER JOIN students ON student_fee_package.student_id = students.student_id
                            INNER JOIN forms ON students.form_id = forms.form_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.campus_id
                            ORDER BY forms.campus_id
                            ");
             }
     //echo $this->db->last_query();die;
      return $query->result_array();      
    }
    
    
     function programWiseDefaulterRevenue($campaign_id, $campus_id, $start_date, $end_date)
    {            
      if($campus_id == 0){
            $campus         =   '' ;
        }
        else if($campus_id == 1 || $campus_id == 3)
        {
            $campus         =   "AND (forms.campus_id = 1 OR forms.campus_id = 3)"  ;
        }elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
            $campus         =   "AND forms.campus_id = ".$campus_id ;
        }
      
         if($this->session->userdata('role') == 'OS')
             {
                $query = $this->db->query("SELECT  programs.program_name, COUNT(DISTINCT(roll_no)) AS std_total, 
                            SUM(IF(DATE(due_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_able, 
                            SUM(IF(challan.status = '1' AND DATE(post_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_ed, campus.campus_name, campaign.campaign_name,
                            SUM(IF(students.status = 'left' AND DATE(due_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS left_amount, 
                            SUM(IF(students.status = 'left' AND DATE(due_date) BETWEEN '$start_date' AND '$end_date', 1, 0)) AS std_left 
                            FROM forms_os AS forms
                            INNER JOIN students_os AS students ON forms.form_id = students.form_id
                            INNER JOIN installments_os AS installments ON students.student_id = installments.student_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN challan_os AS challan ON installments.installment_id = challan.installment_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.program_id
                            ORDER BY forms.program_id ASC
                            ");
             }else{
                 $query = $this->db->query("SELECT  programs.program_name, COUNT(DISTINCT(roll_no)) AS std_total, 
                            SUM(IF(DATE(due_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_able, 
                            SUM(IF(challan.status = '1' AND DATE(post_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS rec_ed, campus.campus_name, campaign.campaign_name,
                            SUM(IF(students.status = 'left' AND DATE(due_date) BETWEEN '$start_date' AND '$end_date', payable, 0)) AS left_amount, 
                            SUM(IF(students.status = 'left' AND DATE(due_date) BETWEEN '$start_date' AND '$end_date', 1, 0)) AS std_left 
                            FROM forms
                            INNER JOIN students ON forms.form_id = students.form_id
                            INNER JOIN installments ON students.student_id = installments.student_id
                            INNER JOIN programs ON forms.program_id = programs.program_id
                            INNER JOIN challan ON installments.installment_id = challan.installment_id
                            INNER JOIN campus ON forms.campus_id = campus.campus_id
                            INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                            WHERE forms.campaign_id = $campaign_id
                            $campus                             
                            GROUP BY forms.program_id
                            ORDER BY forms.program_id ASC
                            ");
             }
      // echo $this->db->last_query();die;
      return $query->result_array();      
    }
    
    
    // for analysis report
    
    function getAnalysisReport($campaign_id, $campus_id,$status){
                
        if($status == 1){ $statuss   =   "AND students.status = 'ok' ";}
        if($status == 2){ $statuss   =   "AND students.status != 'ok' ";}
        if($status == 0){ $statuss   =   "";}
        
                        $query  =   $this->db->query("select count(*) AS total_students,programs.program_name,campus.campus_name,campaign.campaign_name
                                        From students
                                        INNER JOIN forms ON forms.form_id = students.form_id
                                        INNER JOIN programs ON programs.program_id = forms.program_id
                                        INNER JOIN campus ON campus.campus_id = forms.campus_id
                                        INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                        
                                        WHERE
                                        
                                        forms.campus_id =   $campus_id AND
                                        forms.campaign_id = $campaign_id AND
                                        students.roll_no != ''
                                        $statuss
                                            
                                        Group By forms.program_id
                                        ");                              
       //echo $this->db->last_query();die;
        return $query->result_array();
        
    }
}

