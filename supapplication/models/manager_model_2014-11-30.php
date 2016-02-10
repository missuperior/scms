<?php

class Manager_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
    
    
    
    
    
    // manager login 
    function managerLogin($login_data)
    {
        $query = $this->db->get_where('gen_account_logins', $login_data);
        return $query->row();           
    }
    

    function submanagerLogin($login_data)
    {
        $query = $this->db->get_where('gen_sub_logins', $login_data);
        return $query->row();           
    }
    
      
    // add mid term structre
    
    function addMidStructure($mid_data)
    {
        $query = $this->db->insert('mid_course_structure', $mid_data); 
		
        return $this->db->insert_id();
    }
    
    
    // get mid info
    
    function getMidInfo($id)
    {       
        $query = $this->db->get_where('mid_course_structure', array('course_allocation_id' => $id));
		
        return $query->result_array();
    }
    
    // update mid structure
    
    function updateMidStructure($mid_id,$mid_data)
    {
        $this->db->where('mid_course_structure_id', $mid_id);
        $query = $this->db->update('mid_course_structure', $mid_data);
		 
        return $query;      
    }
    
    
    // add final term structre
    
    function addFinalStructure($final_data)
    {
        $query = $this->db->insert('final_course_structure', $final_data); 
		
        return $this->db->insert_id();
    }
    
    // get final info
    
    function getFinalInfo($id)
    {       
        $query = $this->db->get_where('final_course_structure', array('course_allocation_id' => $id));
		
        return $query->result_array();
    }
    
    // update Final structure
    
    function updateFinalStructure($final_id,$final_data)
    {
        $this->db->where('final_course_structure_id', $final_id);
        $query = $this->db->update('final_course_structure', $final_data);
		 
        return $query;      
    }

    
    // get all students 
    
    function getAllStudents()
    {
        $this->db->select('forms.student_name, students.student_id, students.roll_no');
        $this->db->from('forms');
        $this->db->join('students', 'forms.form_id = students.form_id ', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // get all mid structure 
    
    function getMStructure()
    {    
        $query = $this->db->get_where('mid_course_structure', array('mid_course_structure_id' => 1));
        return $query->result_array();    
    }
    
    // get final sturcture 
    
    function getFStructure()
    {    
        $query = $this->db->get_where('final_course_structure', array('final_course_structure_id' => 1));
        return $query->result_array();    
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
            
            
            // get capacity of room
            
            function getRoomCapacity($room_id)
            {
                $this->db->select('room_capacity');
                $this->db->from('rooms');
                $this->db->where('room_id',$room_id);
                $query  =   $this->db->get();
                $result =   $query->result_array();
                
                return $result[0]['room_capacity'];
                
            }
            
            // get room allocated students
            
            function getRoomAllocated($room_id,$test_id)
            {
                $query  = $this->db->query("SELECT Sum(no_of_students) As allocated from entrytest_rooms where room_id = $room_id AND test_id = $test_id");
                $result = $query->result_array();
                
                if(count($result) > 0){
                    return  $result[0]['allocated'];
                }else{
                    return 0;
                }
                
                
            }
            
            // get students of same program
            
            function getProgramStudents($program_id)
            {
                $query  = $this->db->query("SELECT count(*)AS students FROM forms where program_id = $program_id and campaign_id > 0");
                $result = $query->result_array();
                return $result[0]['students'];
                
            }
            
            // get start form id 
            
            function getStartId($programid)
            {                
                $query  = $this->db->query("select `last_form_id` from entrytest_rooms where program_id = $programid ORDER BY entrytest_room_id DESC limit 1");
                $result = $query->result_array();
                return $result[0]['last_form_id'];
            }
            
            // get students of same program
            
            function getProgramStudentsAllocated($program_id)
            {
                $query  = $this->db->query("SELECT Sum(no_of_students) As allocated from entrytest_rooms where program_id = $program_id");
                $result = $query->result_array();
                
                if(count($result) > 0){
                    return  $result[0]['allocated'];
                }else{
                    return 0;
                }
               
            }
            
            // get program wise allocated detail
            
             function getProgramDetail($program_id)
            {
                $query  = $this->db->query("SELECT entrytest_rooms.no_of_students,rooms.room_name, entry_test.test_no from entrytest_rooms 
                        INNER JOIN rooms ON rooms.room_id = entrytest_rooms.room_id 
                        INNER JOIN entry_test on entrytest_rooms.test_id = entry_test.test_id
                        where program_id = $program_id");                
                return $query->result_array();
              
            }
            
            // get last form id
            
            function getLastId($students,$programid,$start_form_id)
            {
                $query  = $this->db->query("select form_id  from forms where program_id = $programid and form_id > $start_form_id and campaign_id > 0 ORDER BY form_id asc limit $students");               
               // echo "select form_id  from forms where program_id = $programid and form_id > $start_form_id and campaign_id > 0 ORDER BY form_id asc limit $students";
                $result = $query->result_array();
                $last_result = end($result);
                return $last_result['form_id'];
            }
            
            
            // add room allocation data 
            
            function addAllocationData($data)
            {
                $query = $this->db->insert('entrytest_rooms', $data); 		
                return $this->db->insert_id();
            }
            
            // get info of allocated rooms
            
            function getAllocatedInfo()
            {
                $this->db->select('entrytest_rooms.no_of_students,programs.program_name,rooms.room_name,rooms.room_capacity,entry_test.test_no');
                $this->db->from('entrytest_rooms');
                $this->db->join('programs','programs.program_id = entrytest_rooms.program_id');
                $this->db->join('rooms','rooms.room_id = entrytest_rooms.room_id');
                $this->db->join('entry_test','entry_test.test_id = entrytest_rooms.test_id');
                $this->db->where('entry_test.status', 'In Process');
                $query  =   $this->db->get();
                return $query->result_array();
            }

            
            // delete data from entrytest_rooms of specific room
            
            function emptyRoom($room_id)
            {
                
                 return $query  = $this->db->query("DELETE FROM entrytest_rooms WHERE room_id = $room_id");
                                 
            }
            
            
            // get test info for program wise report
            
            function getReportInfo($test_id)
            {
                $query  = $this->db->query("select entrytest_rooms.no_of_students,
                                            rooms.room_name,
                                            rooms.floor,
                                            entry_test.test_time,
                                            programs.program_name

                                            From entrytest_rooms
                                            INNER JOIN rooms ON rooms.room_id = entrytest_rooms.room_id
                                            INNER JOIN entry_test ON entry_test.test_id = entrytest_rooms.test_id
                                            INNER JOIN programs ON programs.program_id = entrytest_rooms.program_id
                                            WHERE entrytest_rooms.test_id = $test_id
                                            ORDER BY entrytest_rooms.program_id ASC");
               return $query->result_array();
               
            }

            // check program in entrytest_rooms table
            
            function checkProgram($programid)
            {
                $program_id = array('program_id'=>$programid);
                $query = $this->db->get_where('entrytest_rooms', $program_id);
		return $query->result_array();
            }
            
            
            // get allocated programs from entrytest_rooms table
            
            function getAllocatedProg($room_id,$test_id)
            {
                
                $this->db->select('entrytest_rooms.room_id,entrytest_rooms.test_id,entrytest_rooms.program_id,entrytest_rooms.start_form_id,entrytest_rooms.last_form_id,rooms.room_name,entry_test.test_no');
                $this->db->from('entrytest_rooms');
                $this->db->join('rooms','entrytest_rooms.room_id = rooms.room_id');
                $this->db->join('entry_test','entrytest_rooms.test_id = entry_test.test_id');
                //$this->db->where('entrytest_rooms.room_id',$room_id);
                $this->db->where(array('entrytest_rooms.room_id' =>$room_id, 'entrytest_rooms.test_id' =>$test_id));
                $query  =   $this->db->get();
                return $query->result_array();
            }

            
            // get studetns info 
            
            function getStudents($program_id,$start_form_id,$last_form_id)
            {
                $start_form_id = $start_form_id + 1;
                $query  = $this->db->query("select forms.form_id,forms.mobile,forms.form_no,forms.program_id,forms.student_name,                                            
                                            programs.program_name
                                            From forms
                                            INNER JOIN programs ON programs.program_id = forms.program_id
                                            Where forms.program_id = $program_id
                                            AND campaign_id > 0
                                            AND forms.form_id BETWEEN $start_form_id AND $last_form_id
                                            ORDER BY forms.form_id ASC");
                
               
               return $query->result_array();
            }

            // **************           Entry Test Module         END************** \\
    
    
    
    
        /* Added By Zohaib To add Login start */
            
        // ALL THOSE WILL COME TO WHICH COURSE HAS BEEN ALLOCATED
        function EmployerList(){
            $this->db->select('hr_employee_record.* , campus.*, hr_designations.*, hr_departments.department_name'  );
            $this->db->from('hr_employee_record');
            $this->db->join('campus', 'hr_employee_record.campus_id = campus.campus_id', 'inner');
            $this->db->join('hr_departments', 'hr_departments.department_id =  hr_employee_record.department_id', 'inner');
            $this->db->join('hr_designations', 'hr_designations.designation_id =  hr_employee_record.designation_id', 'inner');
            $this->db->join('student_course_sections', 'student_course_sections.teacher_id 	 =  hr_employee_record.emp_id', 'inner');

            //$this->db->where('hr_departments.account_role_id' , '6');
            $this->db->where( 'hr_employee_record.campus_id' , '3');
            $this->db->group_by('emp_id'); 

            $query = $this->db->get();
            return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
            
            //return $query->result_array();
        }
    
        function getAlllogins(){
            $query = "  SELECT gen_sub_logins.* ,"
                    . " campus.*, hr_employee_record.* "
                    . "FROM "
                    . "gen_sub_logins "
                    . "INNER JOIN hr_employee_record "
                    . "ON hr_employee_record.emp_id = gen_sub_logins.employee_id "
                    . "INNER JOIN campus ON gen_sub_logins.campus_id = campus.campus_id"
                    . " where role = 'Teacher'";
            $query_data = $this->db->query($query);
            return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;

        }
        
        function checklogingenerated( $emp_id )
        {
            $query      = "SELECT * FROM gen_sub_logins WHERE employee_id= '$emp_id' ";
            $query_data = $this->db->query($query);
            return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        }

        /* Added By Zohaib To add Login End*/
            
    
    
}