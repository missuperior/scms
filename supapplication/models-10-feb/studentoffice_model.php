<?php
class Studentoffice_model extends CI_Model {


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
    
    function getStdInfoAll($campaign_id,$program_id)
    {
        $program         =   $program_id == 0 ? '': "AND forms.program_id = ".$program_id ;
         
        $query = $this->db->query("SELECT forms.student_name, forms.father_name, forms.form_no, students.roll_no, forms.form_submit_date,programs.program_name
                                   FROM forms
                                   INNER JOIN students ON students.form_id = forms.form_id 
                                   INNER JOIN programs ON programs.program_id = forms.program_id 
                                   WHERE  
                                   forms.campaign_id = $campaign_id
                                   AND students.roll_no != ''
                                   AND students.status = 'ok'
                                   $program
                                  ");
        
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
    function getStdInfo($roll_no)
    {
        
        $query = $this->db->query("SELECT forms.student_name, forms.father_name, forms.form_no, students.roll_no, forms.form_submit_date,programs.program_name
                                   FROM forms
                                   INNER JOIN students ON students.form_id = forms.form_id 
                                   INNER JOIN programs ON programs.program_id = forms.program_id 
                                   WHERE  
                                   students.roll_no = '$roll_no'
                                   AND students.status = 'ok'
                                  ");
        
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
    
    
     function getRollNoList($campaign_id,$program_id){
        
       
        
        $query      =   $this->db->query("SELECT students.student_id, students.`roll_no` 
                                            FROM students 
                                            INNER JOIN forms ON forms.`form_id` = students.`form_id`
                                            WHERE
                                            forms.`campaign_id` = $campaign_id AND
                                            forms.`program_id` = $program_id AND
                                            students.`roll_no` != '' AND
                                            students.status = 'ok'
                                            ORDER BY students.roll_no ASC
                                            ");
//        echo $this->db->last_query();die;
        return      $query->result_array();
        
    }
    
    function getStdList($campaign_id,$campus_id,$program_id,$shift)
    {
        
                        $query = $this->db->query("SELECT forms.student_name,forms.father_name,forms.	present_address,forms.mobile,forms.form_no,students.roll_no,students.shift,campus.campus_name,campaign.campaign_name,programs.program_name

                                                From forms

                                                INNER JOIN students ON forms.form_id = students.form_id
                                                INNER JOIN campus ON forms.campus_id = campus.campus_id
                                                INNER JOIN campaign ON campaign.campaign_id = forms.campaign_id
                                                INNER JOIN programs ON forms.program_id = programs.program_id
                                                
                                                WHERE 

                                                forms.campaign_id = $campaign_id 
                                                AND forms.program_id = $program_id
                                                AND forms.campus_id = $campus_id 
                                                AND students.shift = '$shift'
                                                AND students.roll_no != ''
                                                AND students.status = 'ok'
                                                ORDER BY students.roll_no ASC");
             
//                  echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
    
    function getFailStdInfo($campaign_id){
        
                                            $query = $this->db->query("SELECT forms.`student_name`,forms.`form_no`, students.`roll_no`, ROUND((forms.previous_obtained_marks * 100 / forms.previous_total_marks),0) AS marks 
                                                                        FROM forms 
                                                                        INNER JOIN students ON students.`form_id` = forms.`form_id`
                                                                        WHERE 
                                                                        forms.campaign_id = $campaign_id AND
                                                                        students.`roll_no` != '' AND
                                                                        students.`status` = 'ok' AND
                                                                        ROUND((forms.previous_obtained_marks * 100 / forms.previous_total_marks),0) < 33
                                                                        ORDER BY students.student_id ASC ");
             
//                  echo $this->db->last_query();die;

                    return $rows = $query->result_array();        
    }
    
   
    
}