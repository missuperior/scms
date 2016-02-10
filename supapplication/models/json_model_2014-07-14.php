<?php 
class Json_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getEntryTest($program_id)
    {
        
        $query  = $this->db->query(
                "
                SELECT *
                FROM 
                    entrytest_rooms
                INNER JOIN 
                    rooms 
                ON 
                    rooms.room_id = entrytest_rooms.room_id
                INNER JOIN 
                    entry_test 
                ON 
                    entry_test.test_id = entrytest_rooms.test_id
                WHERE program_id =$program_id
                ");
        $result = $query->result_array();
        return $result;

    }
    
}