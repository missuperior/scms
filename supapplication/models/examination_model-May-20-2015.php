<?php
class Examination_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // admin login 
    
    function Login($login_data)
    {
        
        $query = $this->db->get_where('gen_account_logins', $login_data);
        return $query->row();           
    }
    
    // get students of selected program
    
    function  getStudentsInfo($program_id)
    {
        
            $this->db->select('students.student_id,students.roll_no,students.enrolled_session_id');
            $this->db->select('forms.student_name');
            $this->db->select('programs.program_name');
            $this->db->from('students');
            $this->db->join('forms', 'students.form_id = forms.form_id', 'left');            
            $this->db->join('programs', 'forms.program_id = programs.program_id', 'left');            
            $this->db->where('forms.program_id', $program_id);
            $this->db->order_by("students.student_id", "DESC");
            $query = $this->db->get();

            return $query->result_array();
     }
     
     
     // check duplication of mid result 
    
    function checkMidResult($mid)
    {
        $query = $this->db->get_where('mid_result', $mid);
		
        return $query->result_array();
    }
    
    
    // get enrolled session id 
    
    function getSessionId($student_id)
    {
        $this->db->select('std.enrolled_session_id,forms.program_id');
        $this->db->from('students std');
        $this->db->join('forms', 'std.form_id = forms.form_id', 'left');            
        $this->db->where('student_id',$student_id);
        $query = $this->db->get();
        return $query->result_array(); 
    }


    // Add mid term result in db
     
     function addMidResult($mid_result)
     {
         $query = $this->db->insert('mid_result', $mid_result); 
	 return $this->db->insert_id();
     }
  
     // Add final term result in db
     
     function addFinalResult($final_result)
     {
         $query = $this->db->insert('final_result', $final_result); 
	 return $this->db->insert_id();
     }
     
     // get student result
     
     function getResult($student_id)
     {
         $query = $this->db->query(
                     "SELECT m.mid_title_1,m.mid_value_1,m.mid_title_2,m.mid_value_2,m.mid_title_3,m.mid_value_3,f.*,c.course_name,s.session,std.roll_no,forms.student_name
                     FROM mid_result AS m
                     LEFT JOIN final_result As f ON m.student_id = f.student_id                     
                     LEFT JOIN courses As c ON m.course_id = c.course_id                     
                     LEFT JOIN sessions As s ON m.session_id = s.session_id                     
                     LEFT JOIN students As std ON m.student_id = std.student_id                     
                     LEFT JOIN forms  ON std.form_id = forms.form_id                     
                     WHERE m.student_id = ".$student_id."
                     AND m.session_id  = f.session_id
                     AND m.course_id  = f.course_id                     
                     ");
                    
                    return $rows = $query->result_array();
         
     }
     
     
     // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure_de', $mid_data); 
		
        return $this->db->insert_id();
    }
     
    // add final term structre
    
    function addFinalStructure($final_data)
    {
        $query = $this->db->insert('final_course_structure_de', $final_data); 
		
        return $this->db->insert_id();
    }
    
    
    // get mid info
    
    function getMidInfo()
    {       
        $this->db->select('mcsd.*, programs.program_name,courses.course_name,sessions.session');
        $this->db->from('mid_course_structure_de mcsd');
        $this->db->join('programs','mcsd.program_id = programs.program_id', 'left');
        $this->db->join('sessions','mcsd.session_id = sessions.session_id', 'left');
        $this->db->join('courses','mcsd.course_id = courses.course_id', 'left');
        $this->db->order_by("mcsd.mid_course_structure_de_id", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
  
     // get final info
    
    function getFinalInfo()
    {       
        $this->db->select('fcsd.*, programs.program_name,courses.course_name,sessions.session');
        $this->db->from('final_course_structure_de fcsd');
        $this->db->join('programs','fcsd.program_id = programs.program_id', 'left');
        $this->db->join('sessions','fcsd.session_id = sessions.session_id', 'left');
        $this->db->join('courses','fcsd.course_id = courses.course_id', 'left');
        $this->db->order_by("fcsd.final_course_structure_de_id", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    

// get mid structure against course id and session id for data entry
    
    function get_mid_structure($mid_data)
    {
        
        $query = $this->db->get_where('mid_course_structure_de', $mid_data);        
        return $query->row();    
    }
    
// get final structure against course id and session id for data entry
    
    function get_final_structure($final_data)
    {
        
        $query = $this->db->get_where('final_course_structure_de', $final_data);        
        return $query->row();    
    }
    function  getStudentslists_de($program_id)
    {
        
            $this->db->select('students.student_id,students.roll_no,students.enrolled_session_id');
            $this->db->select('forms.student_name');
            $this->db->select('programs.program_name');
            $this->db->from('students');
            $this->db->join('forms', 'students.form_id = forms.form_id', 'left');            
            $this->db->join('programs', 'forms.program_id = programs.program_id', 'left');            
            $this->db->where(array('forms.program_id' => $program_id  ,'forms.campaign_id' => 0,'forms.inquiry_id' => 0));
            //$this->db->and('forms.campaign_id', 0);
            $this->db->order_by("students.student_id", "DESC");
            $query = $this->db->get();

            return $query->result_array();
     }
    
    
}