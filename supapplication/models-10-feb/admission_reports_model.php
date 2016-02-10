<?php

class Admission_reports_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // get all campuses data from db
    
    function getAllcampaigns()
    {
        $query = $this->db->get_where('campaign');
        return $query->result_array();
            
    } 
    
    
    // *********** >>> START    Inquiry Report Actions   <<< **********  //
     
    
    // get all inquiries report campus wise
    
    function getCampusWise($campaign_id,$campus_id,$inquiry_type,$start_date,$end_date)
    {
        $campus         =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
//        $inquiry_query  =   $inquiry_type == 0 ? '': "AND inquiry.inquiry_type = '".$inquiry_type."'";
        if($inquiry_type == 'Physical' || $inquiry_type == 'Telephonic' || $inquiry_type == 'Online')
         {
           $inquiry_query = "AND inquiry.inquiry_type = '".$inquiry_type."'";
         }
         else
         {         
           $inquiry_query = '';
         }
         
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
             
                    $query = $this->db->query("SELECT inquiry.* , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os AS inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        LEFT JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $inquiry_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."' AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             
             }else{
                        
                        $query = $this->db->query("SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        LEFT JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $inquiry_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."' AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                 
                  }
         
//                  echo $this->db->last_query();die;
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report campus wise
    
    function getShiftWise($campaign_id,$campus_id,$shift,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        if($shift != 0)
       {
         $shift_query = "AND initial_form.shift = '".$shift."'";
       }
       else
       {         
         $shift_query = '';
       }
       
       
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
       
                    $query = $this->db->query(
                                 "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                    FROM inquiry_os As inquiry
                                    INNER JOIN programs ON programs.program_id = inquiry.program_id
                                    INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                                    INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                    INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                    INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                                    LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                                    WHERE 
                                    inquiry.campaign_id = '".$campaign_id."'
                                    $campus 
                                    $shift_query
                                    AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                    ORDER BY inquiry.inquiry_id DESC
                                ");
             }else{
                                $query = $this->db->query(
                                 "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                    FROM inquiry
                                    INNER JOIN programs ON programs.program_id = inquiry.program_id
                                    INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                                    INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                    INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                    INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                                    LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                                    WHERE 
                                    inquiry.campaign_id = '".$campaign_id."'
                                    $campus 
                                    $shift_query
                                    AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                    ORDER BY inquiry.inquiry_id DESC
                                ");

             }

                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getProgramWise($campaign_id,$campus_id,$program,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        if($program != 0)
       {
         $program_query = "AND inquiry.program_id = ".$program;
       }
       else
       {         
         $program_query = '';
       }
       
       // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $program_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else
             {
                  $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $program_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                 
             }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getGenderWise($campaign_id,$campus_id,$gender,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        if($gender == 'male' || $gender == 'female')
       {
         $gender_query = "AND inquiry.gender = '".$gender."'";
       }
       else
       {         
         $gender_query = '';
       }
       
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os AS inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $gender_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else
                 {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $gender_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                 }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getReferenceWise($campaign_id,$campus_id,$reference,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        if($reference != 0)
       {
         $reference_query = "AND inquiry.reference_id = '".$reference."'";
       }
       else
       {         
         $reference_query = '';
       }
       
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $reference_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $reference_query
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }
        
      
        
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report institute wise
    
    function getInstituteWise($campaign_id, $institute_id,$campus_id,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        $institute  =   $institute_id == 0 ? '': "AND inquiry.previous_institute = ".$institute_id ;
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $institute                        
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                  $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus 
                        $institute                        
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report user wise
    
    function  getUserWise($campaign_id,$user_id,$start_date,$end_date)
    {   
        $user     =   $user_id == 0 ? '': "AND inquiry.operator_id= ".$user_id ;
        
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os AS inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '".$campaign_id."'
                        $user
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");     
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '".$campaign_id."'
                        $user
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");     
             }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report user wise
    
    function  getUserWiseSummary($campaign_id,$inquiry_type,$user_id,$start_date,$end_date)
    {
        $user     =   $user_id == 0 ? '': "AND inquiry.operator_id= ".$user_id ;
        $inquiry_type     =   $inquiry_type == 0 ? '': "AND inquiry.inquiry_type= ".$inquiry_type ;
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, gen_sub_logins.sub_login AS user_name , count(*) As total
                        FROM inquiry_os As inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id 
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id` 
                        LEFT JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id` 
                        WHERE                         
                        inquiry.campaign_id = '$campaign_id' 
                        $user
                        $inquiry_type
                        AND inquiry.`inquiry_date` BETWEEN '$start_date' AND '$end_date' 
                        group by inquiry.program_id
                        ORDER BY inquiry.inquiry_id ASC 

                    ");
             }else{
                 $query = $this->db->query(
                     "SELECT inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, gen_sub_logins.sub_login AS user_name , count(*) As total
                        FROM inquiry 
                        INNER JOIN programs ON programs.program_id = inquiry.program_id 
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id` 
                        LEFT JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id` 
                        WHERE                         
                        inquiry.campaign_id = '$campaign_id' 
                        $user
                        $inquiry_type
                        AND inquiry.`inquiry_date` BETWEEN '$start_date' AND '$end_date' 
                        group by inquiry.program_id
                        ORDER BY inquiry.inquiry_id ASC 

                    ");
             }
                   
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report institute wise
    
    function getProgramSummary($campaign_id,$program_id,$inquiry_type,$start_date,$end_date)
    {
        $inquiry_type     =   $inquiry_type == '0' ? '': 'AND inquiry.inquiry_type= '."'$inquiry_type'" ;
         
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, count(*) As total 
                            FROM inquiry_os As inquiry

                            INNER JOIN programs ON programs.program_id = inquiry.program_id 

                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`                           

                            WHERE 
                            inquiry.campaign_id = '$campaign_id' AND
                            inquiry.program_id = '$program_id'
                            $inquiry_type AND
                            inquiry.`inquiry_date` BETWEEN '$start_date' AND '$end_date' 
                            group by inquiry.campus_id
                            ORDER BY inquiry.inquiry_id ASC 
                         ");   
             }else{
                    $query = $this->db->query(
                     "SELECT inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, count(*) As total 
                            FROM inquiry 

                            INNER JOIN programs ON programs.program_id = inquiry.program_id 

                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`                           

                            WHERE 
                            inquiry.campaign_id = '$campaign_id' AND
                            inquiry.program_id = '$program_id'
                            $inquiry_type AND
                            inquiry.`inquiry_date` BETWEEN '$start_date' AND '$end_date' 
                            group by inquiry.campus_id
                            ORDER BY inquiry.inquiry_id ASC 
                         ");   
             }
                 //echo $this->db->last_query();die;
                    return $rows = $query->result_array();    
                    
    }
    
    // get campus against city 
    
    function getCampus($city_id)
    {
        if($city_id == 0){
                $query = $this->db->get('campus');
        }else{
                $query = $this->db->get_where('campus', array('city_id' => $city_id));
        }
        return $query->result_array();
    }
    
    // get user against campus 
    
    function getUser($campus_id)
    {
        if($campus_id == 0)
        {
            $query = $this->db->get('gen_sub_logins');
        
        }else{
            $query = $this->db->get_where('gen_sub_logins', array('campus_id' => $campus_id));
        }
        return $query->result_array();
    }
    
    // get Institute against city 
    
    function getInstitutes($city_id)
    {
        $query = $this->db->get_where('institutes', array('city_id' => $city_id));
        return $query->result_array();
    }
    
    
    
    
    
    
    
    // *********** >>> START  Prospectus Report Actions   <<< **********  //

    
    
        // get all inquiries report campus wise
    
    function getCampusWisePros($campaign_id,$campus_id,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND pros.campus_id = ".$campus_id ;
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT  inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os AS inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                         WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus            
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else
             {
                  $query = $this->db->query(
                     "SELECT  inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                         WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus            
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }
                    
        //echo $this->db->last_query();die;
        
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report shift wise
    
    function getShiftWisePros($campaign_id,$campus_id,$shift,$start_date,$end_date)
    {
        
        $campus     =   $campus_id == 0 ? '': "AND pros.campus_id = ".$campus_id ;
        $shift      =   $shift == '0' ? '': "AND inquiry.shift = "."'$shift'" ;
        
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $shift                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                 
                  $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $shift                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                 
             }
                   // echo $this->db->last_query();die;
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getProgramWisePros($campaign_id,$campus_id,$program_id,$start_date,$end_date)
    {
            
        $campus     =   $campus_id == 0 ? '': "AND pros.campus_id = ".$campus_id ;
        $program_id =   $program_id == 0 ? '': "AND inquiry.program_id = ".$program_id ;
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
        
                    $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $program_id                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY pros.prospectus_id DESC
                    ");
                    
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $program_id                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY pros.prospectus_id DESC
                    ");
             }
        
        
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getGenderWisePros($campaign_id,$campus_id,$gender,$start_date,$end_date)
    {   
        
        $campus     =   $campus_id == 0 ? '': "AND pros.campus_id = ".$campus_id ;
        $gender     =   $gender == 0 ? '': "AND inquiry.gender = ".$gender ;
        
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $gender        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                       WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $gender        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report program wise
    
    function getReferenceWisePros($campaign_id,$campus_id,$reference,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND pros.campus_id = ".$campus_id ;
        $reference     =   $reference == 0 ? '': "AND inquiry.reference_id = ".$reference ;
        
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $reference                       
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                    
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus
                        $reference                       
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                 
             }
                  //  echo $this->db->last_query();die;
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report institute wise
    
    function getUserWisePros($campaign_id,$user_id,$start_date,$end_date)
    {
        $user     =   $user_id == 0 ? '': "AND pros.operator_id = ".$user_id ;
        
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry_os As inquiry
                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE inquiry.campaign_id = '".$campaign_id."'
                        $user                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                 
                 $query = $this->db->query(
                     "SELECT inquiry . * ,pros.*,products.product_name, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` =  pros.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`                        
                        LEFT JOIN products ON pros.product_id = products.product_id

                        WHERE inquiry.campaign_id = '".$campaign_id."'
                        $user                        
                        AND pros.`sale_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
             }
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report institute wise
    
    function getUserWiseSummaryPros($campaign_id,$user_id,$start_date,$end_date)
    {
        $user     =   $user_id == 0 ? '': "AND pros.operator_id = ".$user_id ;
        
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                    $query = $this->db->query(
                     "SELECT  count(*) As total, 
                        programs.program_name, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name 


                        FROM inquiry_os As inquiry 

                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id 

                        INNER JOIN programs ON programs.program_id = inquiry.program_id 

                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id` 

                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = pros.`operator_id` 

                        LEFT JOIN products ON pros.product_id = products.product_id 

                        WHERE inquiry.campaign_id = '$campaign_id' 

                        $user 

                        AND pros.`sale_date` BETWEEN '$start_date' AND '$end_date' 

                        group by inquiry.program_id

                        ORDER BY inquiry.inquiry_id DESC 
                    ");
             }else{
                 
                 $query = $this->db->query(
                     "SELECT  count(*) As total, 
                        programs.program_name, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name 


                        FROM inquiry 

                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id 

                        INNER JOIN programs ON programs.program_id = inquiry.program_id 

                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id` 

                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = pros.`operator_id` 

                        LEFT JOIN products ON pros.product_id = products.product_id 

                        WHERE inquiry.campaign_id = '$campaign_id' 

                        $user 

                        AND pros.`sale_date` BETWEEN '$start_date' AND '$end_date' 

                        group by inquiry.program_id

                        ORDER BY inquiry.inquiry_id DESC 
                    ");
             }
       
                   
                    
                    return $rows = $query->result_array();        
    }
    
    // get all inquiries report institute wise
    
    function getProgramWiseSummaryPros($campaign_id,$program_id,$city_id,$start_date,$end_date)
    {
                    
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                
                $query = $this->db->query(
                     "SELECT  count(*) As total, 
                        programs.program_name,cities.city_name, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name 


                        FROM inquiry_os As inquiry 

                        INNER JOIN prospectus_os AS pros ON inquiry.inquiry_id = pros.inquiry_id 

                        INNER JOIN programs ON programs.program_id = inquiry.program_id 

                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id` 
                        
                        INNER JOIN cities ON campus.`city_id` = cities.`city_id` 

                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = pros.`operator_id` 

                        LEFT JOIN products ON pros.product_id = products.product_id 

                        WHERE inquiry.campaign_id = '$campaign_id' 

                        AND inquiry.program_id = '$program_id'
                            
                        AND campus.city_id = '$city_id' 

                        AND pros.`sale_date` BETWEEN '$start_date' AND '$end_date' 

                        group by pros.campus_id

                        ORDER BY inquiry.inquiry_id DESC 
                    ");
             }else{
                 
                  $query = $this->db->query(
                     "SELECT  count(*) As total, 
                        programs.program_name,cities.city_name, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name 


                        FROM inquiry 

                        INNER JOIN prospectus AS pros ON inquiry.inquiry_id = pros.inquiry_id 

                        INNER JOIN programs ON programs.program_id = inquiry.program_id 

                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id` 

                        INNER JOIN campus ON campus.`campus_id` = pros.`campus_id` 
                        
                        INNER JOIN cities ON campus.`city_id` = cities.`city_id` 

                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = pros.`operator_id` 

                        LEFT JOIN products ON pros.product_id = products.product_id 

                        WHERE inquiry.campaign_id = '$campaign_id' 

                        AND inquiry.program_id = '$program_id'
                            
                        AND campus.city_id = '$city_id' 

                        AND pros.`sale_date` BETWEEN '$start_date' AND '$end_date' 

                        group by pros.campus_id

                        ORDER BY inquiry.inquiry_id DESC 
                    ");
             }
        
                    //echo $this->db->last_query();die;
                    
                    return $rows = $query->result_array();        
    }
    
    
    
    // get record of all inquiries to prospectus for follow up reports
    
    function getInquiry2Prospectus($campaign_id,$campus_id,$start_date,$end_date)
    {
        
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
            $query = $this->db->query("SELECT inquiry . * ,prospectus.*, programs.program_name,campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                        FROM inquiry_os AS inquiry
                                        LEFT join prospectus_os As prospectus ON prospectus.inquiry_id = inquiry.inquiry_id
                                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`

                                          WHERE
                                          prospectus.inquiry_id is NULL
                                          AND inquiry.campus_id = '".$campus_id."'
                                          AND inquiry.campaign_id = '".$campaign_id."'
                                          AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                          ORDER BY inquiry.inquiry_id DESC");
             }else{
                 $query = $this->db->query("SELECT inquiry . * ,prospectus.*, programs.program_name,campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                        FROM inquiry
                                        LEFT join prospectus ON prospectus.inquiry_id = inquiry.inquiry_id
                                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`

                                          WHERE
                                          prospectus.inquiry_id is NULL
                                          AND inquiry.campus_id = '".$campus_id."'
                                          AND inquiry.campaign_id = '".$campaign_id."'
                                          AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                          ORDER BY inquiry.inquiry_id DESC");
                    
             }
                    
                    return $rows = $query->result_array();      
    }
    
    // get record of all prospectus to form for follow up reports
    
    function getProspectus2Form($campaign_id,$campus_id,$start_date,$end_date)
    {
        
        // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
                $query = $this->db->query("SELECT inquiry . * ,prospectus.*,initial_form.*, programs.program_name,campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                        FROM prospectus_os AS prospectus 
                                        INNER join inquiry_os AS inquiry ON prospectus.inquiry_id = inquiry.inquiry_id
                                        left JOIN initial_form_os AS initial_form ON prospectus.inquiry_id = initial_form.inquiry_id
                                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`

                                          WHERE
                                          initial_form.initial_form_id is NULL
                                          AND inquiry.campus_id = '".$campus_id."'
                                          AND inquiry.campaign_id = '".$campaign_id."'
                                          AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                          ORDER BY inquiry.inquiry_id DESC
                    ");
             }else{
                 $query = $this->db->query("SELECT inquiry . * ,prospectus.*,initial_form.*, programs.program_name,campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name
                                        FROM prospectus
                                        INNER join inquiry ON prospectus.inquiry_id = inquiry.inquiry_id
                                        left JOIN initial_form ON prospectus.inquiry_id = initial_form.inquiry_id
                                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`

                                          WHERE
                                          initial_form.initial_form_id is NULL
                                          AND inquiry.campus_id = '".$campus_id."'
                                          AND inquiry.campaign_id = '".$campaign_id."'
                                          AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                                          ORDER BY inquiry.inquiry_id DESC
                    ");
             }
                    
                    return $rows = $query->result_array();      
    }
    
    // get user name 
    
    function getUserName($userid)
    {
        $this->db->select('gen_sub_logins.sub_login');
        $this->db->from('gen_sub_logins');
        $this->db->where('sub_login_id',$userid);
        $query  =   $this->db->get();
        $result =   $query->row() ;
        return  $result->sub_login;
        
    }
    
    // get inquiry info 
    
    function getInquiryInfo($inquiryid)
    {
        $this->db->select('inq.inquiry_no,inq.name,inq.contact,inq.program_id,programs.program_name');
        $this->db->from('inquiry inq');
        $this->db->join('programs','inq.program_id = programs.program_id', 'left');
        $this->db->where('inq.inquiry_id',$inquiryid);
        $query  =   $this->db->get();
        return   $query->row() ;
    }
    
    
    // detail form info program wise
    function detail_from_report_prg($campaign_id,$campus_id,$program_id,$start_date,$end_date){
        
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
               
//        $var1    = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        $var1_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
         {
        
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms_os` As forms
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.program_id   = $program_id
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
                
                
         }else{
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms`
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.program_id   = $program_id
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
         }
        // echo $this->db->last_query();die;
            return $rows = $query->result_array(); 
            
            
            
    }
    
    // detail form info gnder wise
    function detail_from_gender_prg($campaign_id,$campus_id,$gender,$start_date,$end_date){
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
        
        $var1_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
            
           $query = $this->db->query(
                        "SELECT * FROM 
                            `forms_os` AS forms

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.gender   = '$gender'
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
            
        }else{
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms`

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.gender   = '$gender'
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
        }
            return $rows = $query->result_array();   
    }
    
    // shift wise
    function detail_from_shift_prg($campaign_id,$campus_id,$shift,$start_date,$end_date){
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
        
        
        $var_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
        
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms_os` AS forms

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.shift   = '$shift'
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
        }else{
            $query = $this->db->query(
                        "SELECT * FROM 
                            `forms`

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.shift   = '$shift'
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                    ");
        }
            return $rows = $query->result_array();   
    }
    
    
    // getting all operators
    
    function getAlloperators()
    {
        $query = $this->db->get_where('gen_sub_logins', array('account_role_id' => 3));
        return $query->result_array();
    }
    // operator wise
    function detail_from_user($campaign_id,$campus_id,$user_id,$start_date,$end_date){
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
        
        
        $var_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms_os`As forms

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.operator_id   = $user_id
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                ");
                
        }else{
            $query = $this->db->query(
                        "SELECT * FROM 
                            `forms`

                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        ".$var1."
                        AND
                            `forms`.operator_id   = $user_id
                        AND
                            forms.`form_submit_date` 
                        BETWEEN
                            '$start_date' AND '$end_date'  
                ");
        }
            return $rows = $query->result_array();   
    }
    
    // address wise 
    function detail_from_prg_address($campaign_id,$campus_id,$program_id){
        
        // for campus
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
        
        // for program
        
        if($program_id == 0){ $var2 = ''; }        
        else{ $var2 = "AND `forms`.program_id = $program_id";}
        
        $var1_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
                 $query = $this->db->query(
                        "SELECT * FROM 
                            `forms_os` AS forms
                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id
                        
                        INNER JOIN 
                            cities
                        ON 
                            cities.`city_id` = `forms`.present_city_id

                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        $var1
                        $var2                
                    ");
        }else{
                $query = $this->db->query(
                        "SELECT * FROM 
                            `forms`
                        INNER JOIN 
                            `campaign`
                        ON 
                            campaign.`campaign_id` = `forms`.campaign_id
                        INNER JOIN 
                            `campus`
                        ON 
                            campus.`campus_id`      = `forms`.campus_id
                        INNER JOIN 
                            programs
                        ON 
                            programs.`program_id` = `forms`.program_id

                        INNER JOIN 
                            cities
                        ON 
                            cities.`city_id` = `forms`.present_city_id

                        INNER JOIN 
                            `gen_sub_logins`
                        ON 
                            gen_sub_logins.`sub_login_id` = `forms`.operator_id
                        WHERE
                            `forms`.campaign_id     = $campaign_id
                        $var1
                        $var2            
                    ");
        }
            return $rows = $query->result_array();   
    }
    
    // function to progrma addrss

   
    function detail_from_form_sumary_user($campaign_id,$campus_id, $city_id , $start_date,  $end_date , $operator_id){
        
        if($campus_id == 0){ $var1 = ''; }
        elseif($campus_id == 1 || $campus_id == 3){ $var1 = "AND `forms`.campus_id = 3";}
        else{ $var1 = "AND `forms`.campus_id = $campus_id";}
        
        $var1_os = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
              $query = $this->db->query("   
                    SELECT * , count( forms.program_id ) AS counter
                    FROM `forms_os` AS forms
                    INNER JOIN `campaign` ON campaign.`campaign_id` = `forms`.campaign_id
                    INNER JOIN `campus` ON campus.`campus_id` = `forms`.campus_id
                    INNER JOIN programs ON programs.`program_id` = `forms`.program_id
                    INNER JOIN cities ON cities.`city_id` = `forms`.present_city_id
                    INNER JOIN `gen_sub_logins` ON gen_sub_logins.`sub_login_id` = `forms`.operator_id
                    WHERE
                        `forms`.campaign_id     = $campaign_id
                    ".$var1."
                    AND
                        `forms`.present_city_id   = $city_id
                    AND
                        `forms`.operator_id   = $operator_id
                    AND
                        forms.`form_submit_date` 
                    BETWEEN
                        '$start_date' AND '$end_date'  
                    GROUP BY forms.program_id
                ");
        }else{
                $query = $this->db->query("   
                    SELECT * , count( forms.program_id ) AS counter
                    FROM `forms`
                    INNER JOIN `campaign` ON campaign.`campaign_id` = `forms`.campaign_id
                    INNER JOIN `campus` ON campus.`campus_id` = `forms`.campus_id
                    INNER JOIN programs ON programs.`program_id` = `forms`.program_id
                    INNER JOIN cities ON cities.`city_id` = `forms`.present_city_id
                    INNER JOIN `gen_sub_logins` ON gen_sub_logins.`sub_login_id` = `forms`.operator_id
                    WHERE
                        `forms`.campaign_id     = $campaign_id
                    ".$var1."
                    AND
                        `forms`.present_city_id   = $city_id
                    AND
                        `forms`.operator_id   = $operator_id
                    AND
                        forms.`form_submit_date` 
                    BETWEEN
                        '$start_date' AND '$end_date'  
                    GROUP BY forms.program_id
                ");
        }
        //GROUP BY `forms`.program_id
            return $rows = $query->result_array();   
    }
    
    
    // summary reports start
    
    function detail_from_form_summary_program( $city_id ,$campaign_id,$program_id, $start_date,  $end_date){
        
        //$var1 = $campus_id == 0  ? ''  : "AND `forms`.campus_id = $campus_id";
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3)){
                $query = $this->db->query("
                            SELECT  count(*) As total, 
                                programs.program_name,cities.city_name, campaign.campaign_name, campus.campus_name,
                                forms_os.form_submit_date
                            FROM 
                                forms_os
                            INNER JOIN 
                                programs ON programs.program_id = forms_os.program_id 
                            INNER JOIN 
                                campaign ON campaign.`campaign_id` = forms_os.`campaign_id` 
                            INNER JOIN 
                                campus ON campus.`campus_id` = forms_os.`campus_id` 
                            INNER JOIN 
                                cities ON campus.`city_id` = cities.`city_id` 
                            WHERE 
                                forms_os.campaign_id = $campaign_id
                            AND 
                                forms_os.program_id = $program_id
                            AND 
                                forms_os.form_submit_date 
                            BETWEEN '$start_date' AND '$end_date' 
                            AND 
                                campus.city_id = $city_id
                            GROUP BY 
                                campus.campus_id
                            ORDER BY forms_os.form_id DESC
                        ");
        }else{
                $query = $this->db->query("
                            SELECT  count(*) As total, 
                                programs.program_name,cities.city_name, campaign.campaign_name, campus.campus_name,
                                forms.form_submit_date
                            FROM 
                                forms
                            INNER JOIN 
                                programs ON programs.program_id = forms.program_id 
                            INNER JOIN 
                                campaign ON campaign.`campaign_id` = forms.`campaign_id` 
                            INNER JOIN 
                                campus ON campus.`campus_id` = forms.`campus_id` 
                            INNER JOIN 
                                cities ON campus.`city_id` = cities.`city_id` 
                            WHERE 
                                forms.campaign_id = $campaign_id
                            AND 
                                forms.program_id = $program_id
                            AND 
                                forms.form_submit_date 
                            BETWEEN '$start_date' AND '$end_date' 
                            AND 
                                campus.city_id = $city_id
                            GROUP BY 
                                campus.campus_id
                            ORDER BY forms.form_id DESC
                        ");
        }
            return $rows = $query->result_array();   
    }
    
    
    
    // summary reports end
    
    
    
     // get all inquiries report stage
    
    function getInquiriesStageInfo($campaign_id,$campus_id,$start_date,$end_date)
    {
        $campus     =   $campus_id == 0 ? '': "AND inquiry.campus_id = ".$campus_id ;
        $query = $this->db->query("SELECT inquiry . * , programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE 
                        inquiry.campaign_id = '".$campaign_id."'
                        $campus                         
                        AND inquiry.`inquiry_date` BETWEEN '".$start_date."'   AND '".$end_date."'
                        ORDER BY inquiry.inquiry_id DESC
                    ");
                    
                    return $rows = $query->result_array();        
    }
    
    // get all Initial report campus wise
    
    function getCampusWiseInitial($campaign_id, $campus_id, $start_date, $end_date,$inquiry_type)
    {  
        
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
         {
           $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id;
         
            $query = $this->db->query("SELECT initial_form. * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, inquiry.inquiry_type, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form_os AS initial_form
                        INNER JOIN inquiry_os As inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                       
                        AND initial_form.`created_date` BETWEEN '$start_date'   
                        AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
         }
         else
         {           
           $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id;

          $inquiry = $inquiry_type == '0' ? '': "AND inquiry.inquiry_type = "."'$inquiry_type'";

        $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, inquiry.inquiry_type, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                      FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus 
                        $inquiry
                        AND initial_form.`created_date` BETWEEN '$start_date'   
                        AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
         }
//             echo $this->db->last_query();die;
                 return $rows = $query->result_array();        
         
    }
    
    // get all Initial report campus wise
    
    function getShiftWiseinitial($campaign_id, $campus_id, $shift, $start_date, $end_date)
    {
       
//        echo $shift_query = $shift == 0 ? '': "AND initial_form.shift = '".$shift."'";
        
       if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
       {
         $campus      = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id ;
       if($shift != 0)
       {
         $shift_query = "AND initial_form.shift = '".$shift."'";
       }
       else
       {         
         $shift_query = '';
       }
         $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM initial_form_os AS initial_form
                        INNER JOIN inquiry_os As inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus 
                        $shift_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
         
       }
       else
       {
         $campus      = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id ;
       if($shift != 0)
       {
         $shift_query = "AND initial_form.shift = '".$shift."'";
       }
       else
       {         
         $shift_query = '';
       }
         $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name
                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus 
                        $shift_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
                    
       }
            // echo $this->db->last_query();die;
                    return $rows = $query->result_array();        
    }
    
    // get all Initial report Program wise
    
    function getProgramWiseInitial($campaign_id, $campus_id, $program, $start_date, $end_date)
    {
       if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
       {
          $campus        = $campus_id == 0 ? '': "AND initial_form_os.campus_id = ".$campus_id;
       if($program != 0)
       {
         $program_query = "AND initial_form_os.program_id = ".$program;
       }
       else
       {         
         $program_query = '';
       }
         $query = $this->db->query("SELECT initial_form_os . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form_os
                        INNER JOIN inquiry_os As inquiry ON initial_form_os.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form_os.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form_os.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form_os.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $program_query                        
                        AND initial_form_os.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form_os.initial_form_id DESC
                    ");
       }
       else
       {
          $campus        = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id;
       if($program != 0)
       {
         $program_query = "AND initial_form.program_id = ".$program;
       }
       else
       {         
         $program_query = '';
       }
         $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $program_query                        
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
       }
        
                   // echo $this->db->last_query();die;
                    return $rows = $query->result_array();        
    }
    
     // get all inquiries report program wise
    
    function getReferenceWiseInitial($campaign_id, $campus_id, $reference, $start_date, $end_date)
    {
       if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
       {
         $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = '".$campus_id."'";
       if($reference != 0)
       {
         $reference_query = "AND inquiry.`reference_id` = '".$reference."'";
       }
       else
       {         
         $reference_query = '';
       }
          $query = $this->db->query("SELECT initial_form . *, inquiry.campaign_id, inquiry.inquiry_date, inquiry.previous_institute, inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name, inquiry_references.name as ref_name

                        FROM initial_form_os AS initial
                        INNER JOIN inquiry_os AS inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                        LEFT JOIN inquiry_references on inquiry.`inquiry_id` = inquiry_references.`inquiry_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $reference_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
       }
       else
       {
         $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = '".$campus_id."'";
       if($reference != 0)
       {
         $reference_query = "AND inquiry.`reference_id` = '".$reference."'";
       }
       else
       {         
         $reference_query = '';
       }
         $query = $this->db->query("SELECT initial_form . *, inquiry.campaign_id, inquiry.inquiry_date, inquiry.previous_institute, inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name, inquiry_references.name as ref_name

                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                        LEFT JOIN inquiry_references on inquiry.`inquiry_id` = inquiry_references.`inquiry_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $reference_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
       }
                    return $rows = $query->result_array();        
    }
    
    // get all Initial report Institute wise
    
    function getInstituteWiseInitial($campaign_id, $campus_id, $institute_id, $start_date, $end_date)
    {
      if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
       {
        $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id;
       if($institute_id != 0)
       {
         $institute_query = "AND institutes.institute_id = ".$institute_id;
       }
       else
       {         
         $institute_query = '';
       }
        $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form_os AS initial_form
                        INNER JOIN inquiry_os AS inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $institute_query                        
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
       }else{
         $campus = $campus_id == 0 ? '': "AND initial_form.campus_id = ".$campus_id;
       if($institute_id != 0)
       {
         $institute_query = "AND institutes.institute_id = ".$institute_id;
       }
       else
       {         
         $institute_query = '';
       }
         $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $campus
                        $institute_query                        
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    ");
       }
                    
                    return $rows = $query->result_array();        
    }
    
    function getUserWiseInitial($campaign_id, $user_id, $start_date, $end_date)
    {
       if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
       {
         if($user_id != 0)
        {
          $user_query = "AND initial_form.operator_id = ".$user_id;
        }
        else
        {         
          $user_query = '';
        }
           $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form_os AS initial_form
                        INNER JOIN inquiry_os AS inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $user_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    "); 
       }
       else{
         if($user_id != 0)
        {
          $user_query = "AND initial_form.operator_id = ".$user_id;
        }
        else
        {         
          $user_query = '';
        }
         $query = $this->db->query("SELECT initial_form . * ,inquiry.campaign_id,inquiry.previous_institute,inquiry.reference_id, programs.program_name, institutes.institute_name, campaign.campaign_name,reference.reference_source, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN institutes ON institutes.institute_id = inquiry.previous_institute
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`
                        LEFT JOIN reference ON reference.`reference_id` = inquiry.`reference_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $user_query
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        ORDER BY initial_form.initial_form_id DESC
                    "); 
       }
               
        
                    return $rows = $query->result_array();
    }
    
    function getUserWiseSummaryInitial($campaign_id, $user_id, $start_date, $end_date)
    { 
      if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
      {
        $user     =   $user_id == 0 ? '': "AND initial_form.operator_id= ".$user_id ;
        $query = $this->db->query("SELECT initial_form . * , inquiry.campaign_id, programs.program_name, COUNT(programs.program_name) AS program_count, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form_os AS initial_form
                        INNER JOIN inquiry_os As inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $user
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        GROUP BY programs.program_name        
                        ORDER BY initial_form.initial_form_id DESC                        
                    ");
      }else{
        $user     =   $user_id == 0 ? '': "AND initial_form.operator_id= ".$user_id ;
        $query = $this->db->query("SELECT initial_form . * , inquiry.campaign_id, programs.program_name, COUNT(programs.program_name) AS program_count, campaign.campaign_name, campus.campus_name, gen_sub_logins.sub_login AS user_name

                        FROM initial_form
                        INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                        INNER JOIN programs ON programs.program_id = initial_form.program_id
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = initial_form.`operator_id`

                        WHERE inquiry.campaign_id = '$campaign_id'
                        $user
                        AND initial_form.`created_date` BETWEEN '$start_date' AND '$end_date'
                        GROUP BY programs.program_name        
                        ORDER BY initial_form.initial_form_id DESC                        
                    ");
      }
      
                    return $rows = $query->result_array();
    }
    
    // Program Summary report
    
    function getProgramWiseSummaryInitial($campaign_id, $campus_id, $program, $start_date, $end_date)
    {
      if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
      {
        $query = $this->db->query(
                     "SELECT initial_form_os.*, inquiry.campaign_id, inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, count(*) As total 
                            FROM initial_form_os
                            INNER JOIN programs ON programs.program_id = initial_form_os.program_id
                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                            INNER JOIN campus ON campus.`campus_id` = initial_form_os.`campus_id`
                            WHERE 
                            inquiry.campaign_id = '$campaign_id' AND
                            initial_form_os.program_id = '$program_id' AND
                            inquiry.inquiry_type = '$inquiry_type' AND
                            initial_form_os.`created_date` BETWEEN '$start_date' AND '$end_date' 
                            group by inquiry.campus_id
                            ORDER BY initial_form_os.initial_form_os_id ASC 
                         ");
      }else{
        $query = $this->db->query(
                     "SELECT initial_form.*, inquiry.campaign_id, inquiry .inquiry_type , programs.program_name, campaign.campaign_name,campus.campus_name, count(*) As total 
                            FROM initial_form
                            INNER JOIN programs ON programs.program_id = initial_form.program_id
                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                            INNER JOIN campus ON campus.`campus_id` = initial_form.`campus_id`
                            WHERE 
                            inquiry.campaign_id = '$campaign_id' AND
                            initial_form.program_id = '$program_id' AND
                            inquiry.inquiry_type = '$inquiry_type' AND
                            initial_form.`created_date` BETWEEN '$start_date' AND '$end_date' 
                            group by inquiry.campus_id
                            ORDER BY initial_form.initial_form_id ASC 
                         ");
      }             
      
                    return $rows = $query->result_array();        
    }
    
    // Campus wise Analysis report    
    function getCampusWiseAnalysis($campaign_id)
    {
      if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
      {
        $query = $this->db->query("SELECT inquiry. * , programs.program_name, SUM( IF(inquiry.gender = 'male', 1, 0 ) ) AS males , SUM( IF(inquiry.gender = 'female', 1, 0 ) ) AS females , 
                        SUM(IF(inquiry.inquiry_type = 'Physical', 1, 0 ) ) AS physicals , SUM( IF(inquiry.inquiry_type = 'Telephonic', 1, 0 ) ) AS telephonics , campaign.campaign_name, gen_sub_logins.sub_login AS user_name,
                        COUNT(prospectus.prospectus_id) AS prospectuses, SUM(IF(initial_form_os.form_no != '', 1, 0 ) ) AS forms
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        INNER JOIN prospectus ON prospectus.`inquiry_id` = inquiry.`inquiry_id`
                        INNER JOIN initial_form_os ON initial_form_os.`inquiry_id` = inquiry.`inquiry_id`
                        WHERE inquiry.campaign_id = '1'
                        GROUP BY inquiry.program_id
                        ORDER BY inquiry.inquiry_id DESC
                    ");
      }else{
        $query = $this->db->query("SELECT inquiry. * , programs.program_name, SUM( IF(inquiry.gender = 'male', 1, 0 ) ) AS males , SUM( IF(inquiry.gender = 'female', 1, 0 ) ) AS females , 
                        SUM(IF(inquiry.inquiry_type = 'Physical', 1, 0 ) ) AS physicals , SUM( IF(inquiry.inquiry_type = 'Telephonic', 1, 0 ) ) AS telephonics , campaign.campaign_name, gen_sub_logins.sub_login AS user_name,
                        COUNT(prospectus.prospectus_id) AS prospectuses, SUM(IF(initial_form.form_no != '', 1, 0 ) ) AS forms
                        FROM inquiry
                        INNER JOIN programs ON programs.program_id = inquiry.program_id
                        INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                        INNER JOIN gen_sub_logins ON gen_sub_logins.`sub_login_id` = inquiry.`operator_id`
                        INNER JOIN prospectus ON prospectus.`inquiry_id` = inquiry.`inquiry_id`
                        INNER JOIN initial_form ON initial_form.`inquiry_id` = inquiry.`inquiry_id`
                        WHERE inquiry.campaign_id = '1'
                        GROUP BY inquiry.program_id
                        ORDER BY inquiry.inquiry_id DESC
                    ");
          
      }
        
                    return $query->result_array();     
    }
    
    
    
   // get a inquiry record for report
    function getInquiry($inquiry_id)
    {   
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inq.name,inq.inquiry_no,inq.contact,inq.shift,inq.qualification,inq.inquiry_date,programs.program_name,institutes.institute_name,reference.reference_source,gen_sub_logins.sub_login');
                $this->db->from('inquiry_os inq');
                
                $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = inq.operator_id');
                $this->db->join('programs', 'programs.program_id = inq.program_id');
                $this->db->join('reference', 'reference.reference_id = inq.reference_id');
                $this->db->join('institutes', 'institutes.institute_id = inq.previous_institute');                
                $this->db->where('inq.inquiry_id',$inquiry_id);
                $query = $this->db->get();
                
        }else{
               $this->db->select('inq.name,inq.inquiry_no,inq.contact,inq.shift,inq.qualification,inq.inquiry_date,programs.program_name,institutes.institute_name,reference.reference_source,gen_sub_logins.sub_login');
                $this->db->from('inquiry inq');
                
                $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = inq.operator_id');
                $this->db->join('programs', 'programs.program_id = inq.program_id');
                $this->db->join('reference', 'reference.reference_id = inq.reference_id');
                $this->db->join('institutes', 'institutes.institute_id = inq.previous_institute');                
                $this->db->where('inq.inquiry_id',$inquiry_id);
                $query = $this->db->get();
                
        }
        
//        echo $this->db->last_query();die;
        return $query->result_array();
        
    }
    
   // get a prospectus record for report
    function getProspectus($id)
    {   
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS')
        {
                $this->db->select('inq.name,pros.product_id,pros.price,pros.sale_date,gen_sub_logins.sub_login,product.product_name');
                $this->db->from('inquiry_os inq');
                $this->db->join('prospectus_os pros', 'inq.inquiry_id = pros.inquiry_id');
                $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = pros.operator_id');
                $this->db->join('product', 'product.product_id = pros.product_id');
                $this->db->where('inq.inquiry_id',$id);
                $query = $this->db->get();
                return $query->result_array();
        }else{
                $this->db->select('inq.name,pros.product_id,pros.price,pros.sale_date,gen_sub_logins.sub_login,products.product_name');
                $this->db->from('inquiry inq');
                $this->db->join('prospectus pros', 'inq.inquiry_id = pros.inquiry_id');
                $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = pros.operator_id');
                $this->db->join('products', 'products.product_id = pros.product_id');
                $this->db->where('inq.inquiry_id',$id);
                $query = $this->db->get();
                return $query->result_array();
        }
    }
    
    // get a Initial Form for report
    
    function getInitial($inquiry_id)
    {   
        
        // for out station campuses
     if($this->session->userdata('role') == 'OS' )
     {
        $this->db->select('initial_form.form_no,initial_form.student_name,initial_form.program_id,initial_form.created_date,gen_sub_logins.sub_login,programs.program_name');        
        $this->db->from('initial_form_os initial_form' );
        $this->db->join('programs', 'initial_form.program_id = programs.program_id' );             
        $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = initial_form.operator_id' );             
        $this->db->where('initial_form.inquiry_id = '.$inquiry_id);
        $query = $this->db->get();
             
     }else{
        $this->db->select('initial_form.form_no,initial_form.student_name,initial_form.program_id,initial_form.created_date,gen_sub_logins.sub_login,programs.program_name');        
        $this->db->from('initial_form');
        $this->db->join('programs', 'initial_form.program_id = programs.program_id' );             
        $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = initial_form.operator_id' );             
        $this->db->where('initial_form.inquiry_id = '.$inquiry_id);
        $query = $this->db->get();
     }

        return $query->result_array();
        
    }
    
    // get a complete Form for report
    
    function getComplete($inquiry_id)
    {   
        
        // for out station campuses
     if($this->session->userdata('role') == 'OS')
     {
        $this->db->select('forms.student_name,forms.father_name,forms.gender,forms.form_submit_date,gen_sub_logins.sub_login,programs.program_name');        
        $this->db->from('forms_os forms');
        $this->db->join('programs', 'forms.program_id = programs.program_id' );             
        $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = forms.operator_id' );             
        $this->db->where('forms.inquiry_id = '.$inquiry_id);
        $query = $this->db->get();
             
     }else{
        $this->db->select('forms.student_name,forms.father_name,forms.gender,forms.form_submit_date,gen_sub_logins.sub_login,programs.program_name');        
        $this->db->from('forms');
        $this->db->join('programs', 'forms.program_id = programs.program_id' );             
        $this->db->join('gen_sub_logins', 'gen_sub_logins.sub_login_id = forms.operator_id' );             
        $this->db->where('forms.inquiry_id = '.$inquiry_id);
        $query = $this->db->get();
     }

        return $query->result_array();
        
    }
    
    
    // get inquiry id from from no
    
    function getInqId($form_no)
    {
        $this->db->select('initial_form.inquiry_id,inquiry.admission_stage');
        $this->db->From('initial_form');
        $this->db->join('inquiry','inquiry.inquiry_id = initial_form.inquiry_id','inner');
        $this->db->where('initial_form.form_no',$form_no);
        $query  =   $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
  
    
    
   // get city id for out campus prospectus report
    
    function getCityId($campusid){
        
        $query = $this->db->query("select city_id from campus where campus_id = $campusid ");
        return $query->result_array();
    }
    
    
     // get inquiry id from mobile no
 
        function getInqId2($mobile_no)
        {
            // for out station campuses
               if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
               {
                       $this->db->select('inquiry_id,,admission_stage');
                       $this->db->from('inquiry_os');
                       $this->db->where('contact', $mobile_no);
                       $query = $this->db->get();
               }else{
                       $this->db->select('inquiry_id,admission_stage');
                       $this->db->from('inquiry');
                       $this->db->where('contact', $mobile_no);
                       $query = $this->db->get();
               }


             if($query->num_rows() > 0)
            {          
               return $query->row();
            }else{
                return NULL;
            }
        }
        
        
         // --------------- Analysis Report Start --------------- \\
    
    function getAnalysisReport($campaign_id, $campus_id)
    { 
      // for out station campuses
    if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
    {
                        $inquiry = $this->db->query("SELECT programs.program_name, inquiry.shift, campus.campus_name, campaign.campaign_name,
                                              SUM(IF(inquiry.inquiry_type='Telephonic', 1, 0)) AS tele,  programs.program_id,
                                              SUM(IF(inquiry.inquiry_type='Physical', 1, 0)) AS phys
                                              FROM inquiry_os AS inquiry                              
                                              INNER JOIN campus ON inquiry.campus_id = campus.campus_id
                                              INNER JOIN campaign ON inquiry.campaign_id = campaign.campaign_id
                                              INNER JOIN programs ON inquiry.program_id = programs.program_id
                                              WHERE inquiry.campus_id = $campus_id
                                              AND inquiry.campaign_id = $campaign_id
                                              GROUP BY inquiry.program_id
                                              ORDER BY programs.program_id
                        ");
                        //echo $this->db->last_query();die;
                        $roll_nos = $this->db->query("SELECT COUNT(DISTINCT(students.student_id)) AS std_roll_no, programs.program_name, programs.program_id, 
                                                SUM(IF(inquiry.gender='male', 1, 0)) AS male,
                                                SUM(IF(inquiry.gender='female', 1, 0)) AS female
                                                FROM students_os AS students                                 
                                                INNER JOIN forms_os AS forms ON students.form_id = forms.form_id                                
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                RIGHT JOIN inquiry_os AS inquiry ON forms.inquiry_id = inquiry.inquiry_id
                                                INNER JOIN initial_form_os AS initial_form ON inquiry.inquiry_id = initial_form.inquiry_id
                                                WHERE forms.campaign_id = $campaign_id
                                                AND initial_form.campus_id = $campus_id
                                                AND roll_no <> ''
                                                GROUP BY forms.program_id
                                                ORDER BY programs.program_id
                        ");

                        $forms = $this->db->query("SELECT COUNT(*) AS total_forms, programs.program_id
                                                FROM initial_form_os AS initial_form
                                                INNER JOIN inquiry_os AS inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                                                INNER JOIN programs ON initial_form.program_id = programs.program_id
                                                WHERE inquiry.campaign_id = $campaign_id
                                                AND initial_form.campus_id = $campus_id
                                                GROUP BY initial_form.program_id
                                                ORDER BY programs.program_id
                        ");

                        $prospectus = $this->db->query("SELECT SUM(quantity) AS pros, programs.program_id
                                                FROM inquiry_os AS inquiry
                                                INNER JOIN prospectus_os AS prospectus ON inquiry.inquiry_id = prospectus.inquiry_id
                                                INNER JOIN programs ON inquiry.program_id = programs.program_id
                                                WHERE prospectus.campus_id = $campus_id
                                                GROUP BY inquiry.program_id
                                                ORDER BY programs.program_id
                        ");
    }else{
        
            $inquiry = $this->db->query("SELECT programs.program_name, inquiry.shift, campus.campus_name, campaign.campaign_name,
                                              SUM(IF(inquiry.inquiry_type='Telephonic', 1, 0)) AS tele,  programs.program_id,
                                              SUM(IF(inquiry.inquiry_type='Physical', 1, 0)) AS phys
                                              FROM inquiry                              
                                              INNER JOIN campus ON inquiry.campus_id = campus.campus_id
                                              INNER JOIN campaign ON inquiry.campaign_id = campaign.campaign_id
                                              INNER JOIN programs ON inquiry.program_id = programs.program_id
                                              WHERE inquiry.campus_id = $campus_id
                                              AND inquiry.campaign_id = $campaign_id
                                              GROUP BY inquiry.program_id
                                              ORDER BY programs.program_id
                        ");
                        //echo $this->db->last_query();die;
                        $roll_nos = $this->db->query("SELECT COUNT(DISTINCT(students.student_id)) AS std_roll_no, programs.program_name, programs.program_id, 
                                                SUM(IF(inquiry.gender='male', 1, 0)) AS male,
                                                SUM(IF(inquiry.gender='female', 1, 0)) AS female
                                                FROM students                                 
                                                INNER JOIN forms ON students.form_id = forms.form_id                                
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                RIGHT JOIN inquiry ON forms.inquiry_id = inquiry.inquiry_id
                                                INNER JOIN initial_form ON inquiry.inquiry_id = initial_form.inquiry_id
                                                WHERE forms.campaign_id = $campaign_id
                                                AND initial_form.campus_id = $campus_id
                                                AND roll_no <> ''
                                                GROUP BY forms.program_id
                                                ORDER BY programs.program_id
                        ");

                        $forms = $this->db->query("SELECT COUNT(*) AS total_forms, programs.program_id
                                                FROM initial_form
                                                INNER JOIN inquiry ON initial_form.inquiry_id = inquiry.inquiry_id
                                                INNER JOIN programs ON initial_form.program_id = programs.program_id
                                                WHERE inquiry.campaign_id = $campaign_id
                                                AND initial_form.campus_id = $campus_id
                                                GROUP BY initial_form.program_id
                                                ORDER BY programs.program_id
                        ");

                        $prospectus = $this->db->query("SELECT SUM(quantity) AS pros, programs.program_id
                                                FROM inquiry
                                                INNER JOIN prospectus ON inquiry.inquiry_id = prospectus.inquiry_id
                                                INNER JOIN programs ON inquiry.program_id = programs.program_id
                                                WHERE prospectus.campus_id = $campus_id
                                                GROUP BY inquiry.program_id
                                                ORDER BY programs.program_id
                        ");

        
    }

      return $query = array($inquiry->result_array(), $roll_nos->result_array(), $forms->result_array(), $prospectus->result_array());
    }
    
    // --------------- Analysis Report End --------------- \\
    // --------------- Concession Report Start --------------- \\
    
    function getConcessionReport($campaign_id, $campus_id)
    { 

        if($campus_id == 3 || $campus_id ==1){
            $campus = '3';
        }else{
            $campus = $campus_id;
        }
        
        // for out station campuses
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
        {
            $query = $this->db->query("SELECT programs.program_name, forms.program_id, forms.shift, campus.campus_name, campaign.campaign_name, 
                              ROUND(student_fee_package.session_fee/program_fees.session_fee*100, 0) AS percentage,
                              COUNT(ROUND(student_fee_package.session_fee/program_fees.session_fee*100, 0)) AS total,
                              SUM(IF(student_fee_package.session_total_package='10', 1, 0)) AS total_ten
                              FROM forms_os AS forms
                              INNER JOIN students_os AS students ON forms.form_id = students.form_id
                              INNER JOIN student_fee_package_os AS student_fee_package ON students.student_id = student_fee_package.student_id
                              INNER JOIN campus ON forms.campus_id = campus.campus_id
                              INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                              INNER JOIN programs ON student_fee_package.program_id = programs.program_id
                              INNER JOIN program_fees ON student_fee_package.program_id = program_fees.program_id
                              INNER JOIN initial_form_os AS initial_form ON forms.inquiry_id = initial_form.inquiry_id
                              WHERE forms.campaign_id = $campaign_id
                              AND initial_form.campus_id = $campus_id
                              AND program_fees.campus_id = $campus
                              GROUP BY forms.program_id,students.shift
                              ORDER BY forms.program_id, percentage DESC     
                            ");       
        }else{
                $query = $this->db->query("SELECT programs.program_name, forms.program_id, forms.shift, campus.campus_name, campaign.campaign_name, 
                              ROUND(student_fee_package.session_fee/program_fees.session_fee*100, 0) AS percentage,
                              COUNT(ROUND(student_fee_package.session_fee/program_fees.session_fee*100, 0)) AS total,
                              SUM(IF(student_fee_package.session_total_package='10', 1, 0)) AS total_ten
                              FROM forms
                              INNER JOIN students ON forms.form_id = students.form_id
                              INNER JOIN student_fee_package ON students.student_id = student_fee_package.student_id
                              INNER JOIN campus ON forms.campus_id = campus.campus_id
                              INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
                              INNER JOIN programs ON student_fee_package.program_id = programs.program_id
                              INNER JOIN program_fees ON student_fee_package.program_id = program_fees.program_id
                              INNER JOIN initial_form ON forms.inquiry_id = initial_form.inquiry_id
                              WHERE forms.campaign_id = $campaign_id
                              AND initial_form.campus_id = $campus_id
                              AND program_fees.campus_id = $campus
                              GROUP BY forms.program_id,students.shift
                              ORDER BY forms.program_id, percentage DESC     
                            ");     
        }
     // echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    // --------------- Concession Report End --------------- \\
    
    
    
    // --------------- Reference Report Start --------------- \\
    
    function getReferenceReport($campaign_id, $campus_id)
    { 
      
//        $query = $this->db->query("SELECT programs.program_name, forms.shift, campus.campus_name, campaign.campaign_name, 
//                             
//                              SUM(IF(inquiry.reference_id='2', 1, 0)) AS jang,
//                              SUM(IF(inquiry.reference_id='3', 1, 0)) AS cable,
//                              SUM(IF(inquiry.reference_id='4', 1, 0)) AS steamers,
//                              SUM(IF(inquiry.reference_id='5', 1, 0)) AS banners,
//                              SUM(IF(inquiry.reference_id='6', 1, 0)) AS faculty,
//                              SUM(IF(inquiry.reference_id='7', 1, 0)) AS old_std,
//                              SUM(IF(inquiry.reference_id='8', 1, 0)) AS friends,
//                              SUM(IF(inquiry.reference_id='9', 1, 0)) AS nawai_waqt,
//                              SUM(IF(inquiry.reference_id='10', 1, 0)) AS khabrein,
//                              SUM(IF(inquiry.reference_id='11', 1, 0)) AS express,
//                              SUM(IF(inquiry.reference_id='12', 1, 0)) AS pakistan,
//                              SUM(IF(inquiry.reference_id='13', 1, 0)) AS others,
//                              SUM(IF(inquiry.reference_id='14', 1, 0)) AS internet,
//                              SUM(IF(inquiry.reference_id='15', 1, 0)) AS goodwill,
//                              SUM(IF(inquiry.reference_id='16', 1, 0)) AS the_news,
//                              SUM(IF(inquiry.reference_id='17', 1, 0)) AS the_nation,
//                              SUM(IF(inquiry.reference_id='18', 1, 0)) AS dawn,
//                              SUM(IF(inquiry.reference_id='19', 1, 0)) AS principal,
//                              SUM(IF(inquiry.reference_id='20', 1, 0)) AS admi_bus,
//                              SUM(IF(inquiry.reference_id='21', 1, 0)) AS email,
//                              SUM(IF(inquiry.reference_id='22', 1, 0)) AS live_chat,
//                              SUM(IF(inquiry.reference_id='23', 1, 0)) AS expo,
//                              SUM(IF(inquiry.reference_id='24', 1, 0)) AS sms,
//                              SUM(IF(inquiry.reference_id='25', 1, 0)) AS old_std,
//                              SUM(IF(inquiry.reference_id='26', 1, 0)) AS leaflet,
//                              SUM(IF(inquiry.reference_id='27', 1, 0)) AS cps,
//                              SUM(IF(inquiry.reference_id='28', 1, 0)) AS hoarding,
//                              SUM(IF(inquiry.reference_id='29', 1, 0)) AS online
//                              FROM students
//                              INNER JOIN forms ON students.form_id = forms.form_id
//                              INNER JOIN challan ON students.student_id = challan.student_id
//                              INNER JOIN inquiry ON forms.inquiry_id = inquiry.inquiry_id
//                              INNER JOIN campus ON forms.campus_id = campus.campus_id
//                              INNER JOIN campaign ON forms.campaign_id = campaign.campaign_id
//                              INNER JOIN programs ON forms.program_id = programs.program_id
//                              INNER JOIN initial_form ON forms.inquiry_id = initial_form.inquiry_id
//                              WHERE forms.campaign_id = $campaign_id
//                              AND inquiry.campus_id = $campus_id
//                              AND challan.status = 1
//                              GROUP BY forms.program_id
//                              ORDER BY forms.program_id
//        ");
        $query = $this->db->query("SELECT programs.program_name, campus.campus_name, campaign.campaign_name, 
                             
                              SUM(IF(inquiry.reference_id='2', 1, 0)) AS jang,
                              SUM(IF(inquiry.reference_id='3', 1, 0)) AS cable,
                              SUM(IF(inquiry.reference_id='4', 1, 0)) AS steamers,
                              SUM(IF(inquiry.reference_id='5', 1, 0)) AS banners,
                              SUM(IF(inquiry.reference_id='6', 1, 0)) AS faculty,
                              SUM(IF(inquiry.reference_id='7', 1, 0)) AS old_std,
                              SUM(IF(inquiry.reference_id='8', 1, 0)) AS friends,
                              SUM(IF(inquiry.reference_id='9', 1, 0)) AS nawai_waqt,
                              SUM(IF(inquiry.reference_id='10', 1, 0)) AS khabrein,
                              SUM(IF(inquiry.reference_id='11', 1, 0)) AS express,
                              SUM(IF(inquiry.reference_id='12', 1, 0)) AS pakistan,
                              SUM(IF(inquiry.reference_id='13', 1, 0)) AS others,
                              SUM(IF(inquiry.reference_id='14', 1, 0)) AS internet,
                              SUM(IF(inquiry.reference_id='15', 1, 0)) AS goodwill,
                              SUM(IF(inquiry.reference_id='16', 1, 0)) AS the_news,
                              SUM(IF(inquiry.reference_id='17', 1, 0)) AS the_nation,
                              SUM(IF(inquiry.reference_id='18', 1, 0)) AS dawn,
                              SUM(IF(inquiry.reference_id='19', 1, 0)) AS principal,
                              SUM(IF(inquiry.reference_id='20', 1, 0)) AS admi_bus,
                              SUM(IF(inquiry.reference_id='21', 1, 0)) AS email,
                              SUM(IF(inquiry.reference_id='22', 1, 0)) AS live_chat,
                              SUM(IF(inquiry.reference_id='23', 1, 0)) AS expo,
                              SUM(IF(inquiry.reference_id='24', 1, 0)) AS sms,
                              SUM(IF(inquiry.reference_id='25', 1, 0)) AS old_std,
                              SUM(IF(inquiry.reference_id='26', 1, 0)) AS leaflet,
                              SUM(IF(inquiry.reference_id='27', 1, 0)) AS cps,
                              SUM(IF(inquiry.reference_id='28', 1, 0)) AS hoarding,
                              SUM(IF(inquiry.reference_id='29', 1, 0)) AS online
                              FROM inquiry
                              
                              
                              INNER JOIN campus ON inquiry.campus_id = campus.campus_id
                              INNER JOIN campaign ON inquiry.campaign_id = campaign.campaign_id
                              INNER JOIN programs ON inquiry.program_id = programs.program_id
                              INNER JOIN initial_form ON initial_form.inquiry_id = inquiry.inquiry_id
                              WHERE inquiry.campaign_id = $campaign_id
                              AND inquiry.campus_id = $campus_id
                              
                              GROUP BY inquiry.program_id
                              ORDER BY inquiry.program_id
        ");
     // echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    function getProgram_wise_ConcessionReport($campaign_id, $campus_id,$shift,$program)
    {
        if($campus_id == 1 || $campus_id == 3){
            $campus_id = 3;
        }
        
         // for out station campuses
        if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
        {
                $query  =   $this->db->query("SELECT forms.`student_name`,forms.`form_no`,forms.`gender`,students.`roll_no`,inquiry_references.`name`,program_fees.session_fee AS total_fee,
                                              student_fee_package.`session_fee`,student_fee_package.`session_fee_discount`,campus.campus_name,programs.program_name,campaign.campaign_name

                                    FROM forms_os AS forms

                                    LEFT JOIN inquiry_references_os AS inquiry_references ON inquiry_references.`inquiry_id` = forms.`inquiry_id`

                                    INNER JOIN students_os AS students  ON students.`form_id` = forms.`form_id` 
                                    
                                    INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                    
                                    INNER JOIN programs ON programs.program_id = forms.program_id
                                    
                                    INNER JOIN campus ON campus.campus_id = forms.campus_id

                                    INNER JOIN student_fee_package_os AS student_fee_package ON student_fee_package.`student_id` = students.`student_id`

                                    INNER JOIN program_fees ON program_fees.program_id = forms.`program_id`

                                    WHERE

                                    forms.`campaign_id` = $campaign_id AND
                                    forms.`campus_id`   = $campus_id AND
                                    program_fees.campus_id = $campus_id AND
                                    students.`shift`    = '$shift' AND
                                    forms.`program_id`  = $program

                                    ORDER BY
                                    students.`student_id`
                                        
                                    ");
        }else{
            
            $query  =   $this->db->query("SELECT forms.`student_name`,forms.`form_no`,forms.`gender`,students.`roll_no`,inquiry_references.`name`,program_fees.session_fee AS total_fee,
                                              student_fee_package.`session_fee`,student_fee_package.`session_fee_discount`,campus.campus_name,programs.program_name,campaign.campaign_name

                                    FROM forms

                                    LEFT JOIN inquiry_references ON inquiry_references.`inquiry_id` = forms.`inquiry_id`

                                    INNER JOIN students ON students.`form_id` = forms.`form_id`
                                    
                                    INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                    
                                    INNER JOIN programs ON programs.program_id = forms.program_id
                                    
                                    INNER JOIN campus ON campus.campus_id = forms.campus_id

                                    INNER JOIN student_fee_package ON student_fee_package.`student_id` = students.`student_id`

                                    INNER JOIN program_fees ON program_fees.program_id = forms.`program_id`

                                    WHERE

                                    forms.`campaign_id` = $campaign_id AND
                                    forms.`campus_id`   = $campus_id AND
                                    program_fees.campus_id = $campus_id AND
                                    students.`shift`    = '$shift' AND
                                    forms.`program_id`  = $program

                                    ORDER BY
                                    students.`student_id`
                                        
                                    ");
            
        }
        
      //echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    
    
    function getAdmRefSummary($campus_id,$campaign_id){
        
        $campaign         =   $campaign_id == 0 ? '': "AND inquiry.campaign_id = ".$campaign_id ;
        
        
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
        {
                   $query  =   $this->db->query("SELECT COUNT(*)AS total,reference.*,campaign.`campaign_name`,campus.`campus_name`
                                        FROM inquiry_os AS inquiry
                                            INNER JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`  
                                        WHERE
                                            inquiry.`admission_stage` = 3 AND
                                            inquiry.campus_id         = $campus_id
                                            $campaign
                                        GROUP BY
                                            inquiry.reference_id                                        
                                    ");
        }else{
            
                        $query  =   $this->db->query("SELECT COUNT(*)AS total,reference.*,campaign.`campaign_name`,campaign.`campaign_id`,campus.`campus_name`,campus.`campus_id`
                                        FROM inquiry
                                            INNER JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`  
                                        WHERE
                                            inquiry.`admission_stage` = 3 AND
                                            inquiry.campus_id         = $campus_id
                                            $campaign
                                        GROUP BY
                                            inquiry.reference_id                                        
                                    ");
            }
     // echo $this->db->last_query();die;
      return $query->result_array();
    }
        
    function getAdmRefDetail($campus_id,$campaign_id,$reference_id){
        
        $campaign         =   $campaign_id == 0 ? '': "AND inquiry.campaign_id = ".$campaign_id ;
        
        
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
        {
                   $query  =   $this->db->query("SELECT forms.`student_name`,students.`roll_no`,reference.`reference_source`,campus.`campus_name`,campaign.`campaign_name`
                                        FROM forms_os AS forms
					    INNER JOIN students_os AS students ON students.`form_id` = forms.`form_id`
					    INNER JOIN inquiry_os AS inquiry ON inquiry.`inquiry_id` = forms.`inquiry_id`
                                            INNER JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`  
                                        WHERE
                                            inquiry.`admission_stage` = 3 AND
                                            inquiry.campus_id         = $campus_id AND
                                            inquiry.`reference_id`    = $reference_id 
                                            $campaign
                                    ");
        }else{
            
                        $query  =   $this->db->query("SELECT forms.`student_name`,students.`roll_no`,reference.`reference_source`,campus.`campus_name`,campaign.`campaign_name`
                                        FROM forms
					    INNER JOIN students ON students.`form_id` = forms.`form_id`
					    INNER JOIN inquiry ON inquiry.`inquiry_id` = forms.`inquiry_id`
                                            INNER JOIN reference ON reference.`reference_id` = inquiry.`reference_id`
                                            INNER JOIN campaign ON campaign.`campaign_id` = inquiry.`campaign_id`
                                            INNER JOIN campus ON campus.`campus_id` = inquiry.`campus_id`  
                                        WHERE
                                            inquiry.`admission_stage` = 3 AND
                                            inquiry.campus_id         = $campus_id AND
                                            inquiry.`reference_id`    = $reference_id 
                                            $campaign
                                    ");
            }
     // echo $this->db->last_query();die;
      return $query->result_array();
    }
    
    function get_adm_analysis_package($campaign_id,$campus_id,$program_id)
    {
        
        
        if($campus_id == 0){
            $campus         =   '' ;
        }elseif($campus_id == 1 || $campus_id == 3){
            $campus     =   "AND forms.campus_id = 3";
        } elseif($this->session->userdata('campus_id') == 31 && $this->session->userdata('role')  == 'OS'){
            $campus     =   "AND forms.campus_id = ".$campus_id;
        }else{
                 if($this->session->userdata('account_role_id') == 5){  $campus   =  "AND forms.campus_id = ".$campus_id ;   }
                 else{ $campus   =   "AND forms.campus_id = ".$this->session->userdata('campus_id') ; }
            
        }
        
         if($program_id == 0){
            $program         =   '' ;
        }else{
               $program   =   "AND forms.program_id = ".$program_id ;
        }
         
         // for out station campus
         
         if($this->session->userdata('role') == 'OS' || ($campus_id != 1 && $campus_id != 3))
             {
             
                    $query = $this->db->query("SELECT programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, 
                                                sfp.admission_fee,sfp.misc_fee,sfp.session_fee,(admission_fee_discount+session_fee_discount) AS discount,
                                                students.`shift`,inquiry_references.`name` AS reference
                                                FROM 
                                                students_os AS students
                                                INNER JOIN forms_os AS forms ON forms.form_id = students.form_id 
                                                INNER JOIN programs ON programs.program_id = forms.program_id 
                                                INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id` 
                                                INNER JOIN student_fee_package_os AS sfp ON sfp.student_id = students.student_id 
                                                LEFT JOIN inquiry_references_os AS inquiry_references ON inquiry_references.`inquiry_id` = forms.`inquiry_id`
                                                WHERE 
                                                forms.campaign_id = $campaign_id 
                                                $campus
                                                $program

                                                 ORDER BY sfp.student_fee_pakage_id DESC  ");
             
             }else{
                        
                       $query = $this->db->query("SELECT programs.program_name,campaign.campaign_name, campus.campus_name,forms.form_no,forms.student_name, 
                                                    sfp.admission_fee,sfp.misc_fee,sfp.session_fee,(admission_fee_discount+session_fee_discount) AS discount,
                                                    students.`shift`,inquiry_references.`name` AS reference
                                                    FROM 
                                                    students 
                                                    INNER JOIN forms ON forms.form_id = students.form_id 
                                                    INNER JOIN programs ON programs.program_id = forms.program_id 
                                                    INNER JOIN campus ON campus.`campus_id` = forms.`campus_id` 
                                                    INNER JOIN campaign ON forms.`campaign_id` = campaign.`campaign_id` 
                                                    INNER JOIN student_fee_package AS sfp ON sfp.student_id = students.student_id 
                                                    LEFT JOIN inquiry_references ON inquiry_references.`inquiry_id` = forms.`inquiry_id`
                                                    WHERE 
                                                    forms.campaign_id = $campaign_id 
                                                    $campus
                                                    $program

                                                     ORDER BY sfp.student_fee_pakage_id DESC ");
             
                 
                  }
         
                // echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
        
    // --------------- Reference Report End --------------- \\
    
        
}

