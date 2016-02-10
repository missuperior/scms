<?php

class Entrytest_model extends CI_Model {

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

            // get all test from db 29 jan

            function getAlltests()
            {                   
                $this->db->select('entry_test.*,campaign.campaign_name');
                $this->db->from('entry_test');
                $this->db->join('campaign','entry_test.campaign_id = campaign.campaign_id');                
                $this->db->order_by('entry_test.test_id', 'DESC'); 
                $query = $this->db->get();

                return $query->result_array();
            }
            
            // get all test from db 29 jan

            function getOpentests()
            {   
                $status = 'In Process';
                $this->db->select('entry_test.*,campaign.campaign_name');
                $this->db->from('entry_test');
                $this->db->join('campaign','entry_test.campaign_id = campaign.campaign_id');
                $this->db->where('entry_test.status = ',$status);
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
                $result = $query->row();
                
                if(count($result) > 0){
                    return  $result->allocated;
                }else{
                    return '0';
                }
                
                
            }
            
            // get students of same program 29 jan
            
            function getProgramStudents($program_id,$start_date)
            {                
                $campaign_id    =   $this->session->userdata('campaign_id');
                $campus_id      =   $this->session->userdata('campus_id');
                $query  = $this->db->query("SELECT count(*)AS students FROM initial_form where program_id = $program_id and form_no like '%F15%' and created_date >= '$start_date' ");
                $result = $query->result_array();
                //echo $this->db->last_query();die;
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
            
            function getLastId($students,$programid,$start_form_id, $s_date)
            {
                $campaign_code    =   $this->session->userdata('campaign_code');
                $query  = $this->db->query("select initial_form_id from initial_form where program_id = $programid and initial_form_id >= $start_form_id and form_no like '%$campaign_code%' and created_date >= '$s_date' ORDER BY initial_form_id asc limit $students");               
               
//                echo $this->db->last_query();die;
                $result = $query->result_array();
                $last_result = end($result);
                return $last_result['initial_form_id'];
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
            
            
            function getStartIdForm($programid, $s_date){
                $campaign_code    =   $this->session->userdata('campaign_code');
                $query      =   $this->db->query("SELECT * FROM initial_form WHERE program_id = $programid AND form_no like '%$campaign_code%' and created_date >= '$s_date' ORDER BY initial_form_id ASC limit 1");
                $result     =   $query->row();
//                echo $this->db->last_query();
//                die;
                return      $result->initial_form_id;
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
                $campaign_id    =   $this->session->userdata('campaign_id');
               // $start_form_id = $start_form_id + 1;
                $query  = $this->db->query("select initial_form.initial_form_id,initial_form.mobile,initial_form.form_no,initial_form.program_id,initial_form.student_name,                                            
                                            programs.program_name
                                            From initial_form
                                            INNER JOIN programs ON programs.program_id = initial_form.program_id
                                            Where initial_form.program_id = $program_id
                                            AND form_no like '%F15%'
                                            AND initial_form.initial_form_id BETWEEN $start_form_id AND $last_form_id
                                            ORDER BY initial_form.initial_form_id ASC");
                
              // echo $this->db->last_query();die;
               return $query->result_array();
            }

            // **************           Entry Test Module         END************** \\
    
    
    
             function check_result($check_data)
            {
                $query = $this->db->get_where('entrytest_results', $check_data);
                return $query->row();
            }    

            // add entry test  in db

            function add_result($data)
            {
                $query = $this->db->insert('entrytest_results', $data); 		
                return $this->db->insert_id();
            }
            
            
            // ************* functions for send sms of entry test
            
            function getAllocatedRooms(){
                $query  = $this->db->query("SELECT * FROM entrytest_rooms INNER JOIN entry_test ON entry_test.`test_id` = entrytest_rooms.`test_id` INNER JOIN rooms ON rooms.`room_id` = entrytest_rooms.`room_id`");
                
              // echo $this->db->last_query();die;
               return $query->result_array();
            }
            
            function getStdInfo($program_id,$start_form_id,$last_form_id){
                
                $query  = $this->db->query("SELECT initial_form_id,student_name,form_no,mobile
                                            FROM
                                            initial_form 
                                            WHERE
                                            program_id = $program_id AND 
                                            initial_form_id BETWEEN '$start_form_id' AND '$last_form_id'");
                
              // echo $this->db->last_query();die;
               return $query->result_array();
            }
    
    
    
}