<?php

class Admin_model extends CI_Model {

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
    
    
    //   ***** Start function for City Module *****   //
    
    // check duplication of city name
    
    function checkCity($city)
    {
        $query = $this->db->get_where('cities', $city);
		
        return $query->result_array();
    }
    
    
    // add city in db
    
    function addCity($city)
    {
        $query = $this->db->insert('cities', $city); 
		
        return $this->db->insert_id();
    }
    
    // get all cities from db
    
    function getAllcities()
    {
        $this->db->order_by('city_name', 'ASC'); 
        $query = $this->db->get('cities');
		
        return $query->result_array();
    }
    
    // get a city for update
    
    function getCity($id)
    {       
        $query = $this->db->get_where('cities', array('city_id' => $id));
		
        return $query->result_array();
    }
    
    // update the city name
    
    function updateCity($id,$city)
    {
        $this->db->where('city_id', $id);
        $query = $this->db->update('cities', $city);
		 
        return $query;        
    }
    
    
    
    //   ***** Start function for Campus Module *****   //
    
    
    // check duplication of campus name
    
    function checkcampus($check_campus_data)
    {
        $query = $this->db->get_where('campus', $check_campus_data);
        return $query->result_array();
    }
    
    
    // add new campus in db
    
    function addCampus($campus_data)
    {
        $query = $this->db->insert('campus', $campus_data); 
        return $this->db->insert_id();
    }
    
     // get all campuses data from db
    
    function getAllCampuses()
    {        
        $this->db->select('*');
        $this->db->select('city.city_id','city.city_name');
        $this->db->from('campus cam');
        $this->db->join('cities city', 'cam.city_id = city.city_id');
        $this->db->order_by("cam.campus_name", "asc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a campus record for update
    
    function getCampus($id)
    {       
        $query = $this->db->get_where('campus', array('campus_id' => $id));
        return $query->result_array();
    }
        
     // update the campus record
    
    function updateCampus($id, $campus)
    {
        $this->db->where('campus_id', $id);
        $query = $this->db->update('campus', $campus); 
        return $query;        
    }
    
    
  
    
    //   ***** Start function for Campaign Module *****   //
    
    
    // check duplication of campus name
    
    function checkCampaign($campaign)
    {
        $query = $this->db->get_where('campaign', $campaign);
        return $query->result_array();
    }
    
    
    // add new campus in db
    
    function addCampaign($campaign_data)
    {
        $query = $this->db->insert('campaign', $campaign_data); 
        return $this->db->insert_id();
    }
    
     // get all campuses data from db
    
    function getAllcampaigns()
    {
        $query = $this->db->get_where('campaign', array('status' => 'open'));
        return $query->result_array();
            
    }
    
     function getAllcampaigns2()
    {
        $query = $this->db->get('campaign');
        return $query->result_array();
            
    }
    
    
    // get a campus record for update
    
    function getCampaign($id)
    {       
        $query = $this->db->get_where('campaign', array('campaign_id' => $id));
        return $query->result_array();
    }
        
     // update the campus record
    
    function updateCampaign($id, $campaign)
    {
        $this->db->where('campaign_id', $id);
        $query = $this->db->update('campaign', $campaign); 
        return $query;
        
    }


    
    

    //   ***** Start function for Session Module *****   //
    
    // check duplication of Semester name
    
    function checkSession($session)
    {
        $query = $this->db->get_where('sessions', $session);
        return $query->result_array();
    }
        

    // add Session in db
    
    function addSession($session)
    {
        $query = $this->db->insert('sessions', $session); 
        return $this->db->insert_id();
    }
    
    // get all Session from db
    
    function getAllSessions()
    {
        $this->db->order_by("session_id", "asc"); 
        $query = $this->db->get('sessions');
        return $query->result_array();
    }
    
    function getActiveSessionId()
    {
        $query  =   $this->db->query("select session_id from sessions where active = 1 ");        
        $result =   $query->row();
        return $result->session_id;
    }
    
    // get all current year sessions
    function getYearSessions($year)
    {
        // $this->db->order_by("session_id", "asc"); 
        $this->db->like('session', $year);
        $query = $this->db->get('sessions');
        return $query->result_array();
        
    }

    
    function getSessionId($session)
    {
        $query = $this->db->get_where('sessions', array('session' => $session));
        
        $data = $query->result_array();
        return $data[0]['session_id'];  
        //return $query->result_array();
    }
    
    
     // check duplication of Bank Name
    
    function checkbank($check_bank_data)
    {
        $query = $this->db->get_where('banks', $check_bank_data);
        return $query->result_array();
    }
	
	 // add new Bank in db
    
    function addBank($bank_data)
    {
        $query = $this->db->insert('banks', $bank_data); 
        return $this->db->insert_id();
    }
   
     // get all Banks data from db
    
    function getAllBanks()
    {      
        $this->db->select('*', 'city.city_name');
        $this->db->from('banks');
        $this->db->join('cities', 'banks.city_id = cities.city_id', 'left');
        $this->db->order_by("banks.bank_name", "ASC"); 
        $query = $this->db->get();
        
        return $query->result_array();
    }
    	
    // get a campus record for update
    
    function getBank($id)
    {       
        $query = $this->db->get_where('banks', array('bank_id' => $id));
		
        return $query->result_array();
    }
	
	 // update the bank record
    
    function updateBank($id, $bank)
    {       
        $this->db->where('bank_id', $id);
        $query = $this->db->update('banks', $bank); 
        
        return $query;        
    }

    
    
    //   ***** Start function for City Module *****   //
    
    // check duplication of city name
    
    function checkSection($section)
    {
        $query = $this->db->get_where('sections', $section);
		
        return $query->result_array();
    }
    
    
    // add section in db
    
    function addSection($section)
    {
        $query = $this->db->insert('sections', $section); 
		
        return $this->db->insert_id();
    }
    
    // get all sections from db
    
    function getAllsections()
    {
        $this->db->order_by('section', 'ASC'); 
        $query = $this->db->get('sections');
		
        return $query->result_array();
    }
    
    // get a section for update
    
    function getSection($id)
    {       
        $query = $this->db->get_where('sections', array('section_id' => $id));
		
        return $query->result_array();
    }
    
    // update the section name
    
    function updateSection($id,$section)
    {
        $this->db->where('section_id', $id);
        $query = $this->db->update('sections', $section);
		 
        return $query;        
    }
    
    
    
    
    //   ***** Start function for Bank Account Module *****   //
    
    // check duplication of Account
    
    function checkBankAccount($bank_account)
    {
        $query = $this->db->get_where('bank_accounts', $bank_account);
        
        return $query->result_array();
    }
    
    
    // add section in db
    
    function addBankAccount($bank_account)
    {
        $query = $this->db->insert('bank_accounts', $bank_account); 
		
        return $this->db->insert_id();
    }
    
    //View all Bank Accounts
    
    function getAllBankAccounts()
    {
        $this->db->select('*');
        $this->db->select('bank.bank_id','bank.bank_name');
        $this->db->from('bank_accounts');
        $this->db->join('banks bank', 'bank_accounts.bank_id = bank.bank_id');
        $this->db->order_by("bank_accounts.bank_account_id", "asc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    // get a Bank Account for update
    
    function getBankAccount($id)
    {       
        $query = $this->db->get_where('bank_accounts', $id);		
        return $query->result_array();
    }
    
    //update Bank Account
    
    function updateBankAccount($id, $bank_account)
    {
      $this->db->where('bank_account_id', $id);
      $result =  $this->db->update('bank_accounts', $bank_account);
      
      return $result;      
    }
    
    


     
    //   ***** Start function for batch Module *****   //    
    
    // check duplication of batch name
    
    function checkBatch($batch)
    {
        $query = $this->db->get_where('batch', $batch);
        return $query->result_array();
    }    

    // add batch in db
    
    function addBatch($batch)
    {
        $query = $this->db->insert('batch', $batch); 		
        return $this->db->insert_id();
    }
    
    // get all batch from db
    
    function getAllbatches()
    {      
        $this->db->order_by('batch', 'ASC'); 
        $query = $this->db->get('batch');
		
        return $query->result_array();
    }
    
    // get a batch for update
    
    function getBatch($id)
    {       
        $query = $this->db->get_where('batch', array('batch_id' => $id));
		
        return $query->result_array();
    }
    
    // update the batch name
    
    function updateBatch($id,$batch)
    {
        $this->db->where('batch_id', $id);
        $query = $this->db->update('batch', $batch);
		 
        return $query;        
    }

    
// *******  Start Institute Module     *******//
    
    function checkInstitute($check_institute)
    {
        $query = $this->db->get_where('institutes', $check_institute);
        return $query->result_array();
    }        
    
    public function addInstitute($institute_data)
     {
        $query = $this->db->insert('institutes', $institute_data); 		
        return $this->db->insert_id();
      
    }
    
    public function getAllInstitutes(){
        $this->db->select('*');
        $this->db->select('city.city_id','city.city_name');
        $this->db->from('institutes inst');
        $this->db->join('cities city', 'inst.city_id = city.city_id');
        $this->db->order_by("inst.institute_id", "asc"); 
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function getInstitute($id){
        
        $query = $this->db->get_where('institutes', array('institute_id' => $id));
        return $query->result_array();
    }
    
    function updateInstitute($id, $institute)
    {
        $this->db->where('institute_id', $id);
        $query = $this->db->update('institutes', $institute); 
        return $query;        
    }
    
// *******  End Institute Module     *******//
    
    
    
     //   ***** Start function for Reference Module *****   //
    
    // check duplication of Reference
    
    function checkReference($reference)
    {
        $query = $this->db->get_where('reference', $reference);
		
        return $query->result_array();
    }    
    
    // add Reference in db
    
    function addReference($reference)
    {
        $query = $this->db->insert('reference', $reference); 		
        return $this->db->insert_id();
    }
    
    // get all References from db
    
    function getAllReferences()
    {
        $this->db->order_by('reference_id', 'ASC'); 
        $query = $this->db->get('reference');		
        return $query->result_array();
    }
    
    // get a Reference for update
    
    function getReference($id)
    {       
        $query = $this->db->get_where('reference', array('reference_id' => $id));		
        return $query->result_array();
    }
    
    // update the Reference
    
    function updateReference($id,$reference)
    {
        $this->db->where('reference_id', $id);
        $query = $this->db->update('reference', $reference);		 
        return $query;        
    }

    

    
    
   

    // funciton to add the student
    function addStudent($students_data)
    {
        $query = $this->db->insert('students', $students_data); 
        return $this->db->insert_id();
    }
    
 
    
    //     ****************** Programs Module *************************//
    
     // check duplication of Program Department name
    
    function checkProgDept($prog_dept)
    {
        $query = $this->db->get_where('program_departments', $prog_dept);
        return $query->result_array();
    }
    
    // add Program Department in db
    
    function addProgDept($prog_dept)
    {
        $query = $this->db->insert('program_departments', $prog_dept); 
        return $this->db->insert_id();
    }
    
    // get all Program Departments from db
    
    function getAllProgDepts()
    {
        $this->db->order_by('program_department_name', 'ASC'); 
        $query = $this->db->get('program_departments');
		
        return $query->result_array();
    }
    
    // get a Program Department for update
    
    function getProgDept($id)
    {       
        $query = $this->db->get_where('program_departments', array('program_department_id' => $id));
        return $query->result_array();
    }
    
    // update the Program Department name
    
    function updateProgDept($id,$prog_dept)
    {
        $this->db->where('program_department_id', $id);
        $query = $this->db->update('program_departments', $prog_dept);
		 
        return $query;        
    }
    
    //--------------End of Program Department----------//
    




    //--------////  Start Program Form \\\\--------\\
    
    // check duplication of Program
    
    function checkProgram($program)
    {
        $query = $this->db->get_where('programs', $program);
        
        return $query->result_array();
    }
    
    
    // add Program in db
    
    function addProgram($program)
    {
        $query = $this->db->insert('programs', $program); 
		
        return $this->db->insert_id();
    }
    
    //View all Programs
    
    function getAllprograms()
    {
        $this->db->select('programs.*');
        $this->db->select('program_departments.program_department_name');
        $this->db->from('programs');
        $this->db->join('program_departments', 'programs.program_department_id = program_departments.program_department_id', 'left');
        $this->db->order_by('programs.program_name', 'ASC'); 
        $query = $this->db->get();	
        //echo $this->db->last_query();exit; 
        return $query->result_array();   
    }
    function getAllprogramsHR($id)
    {
        $this->db->select('programs.*');
        //$this->db->select('program_departments.program_department_name');
        $this->db->from('programs');
        $this->db->where('hr_department_id', $id);
        //$this->db->join('program_departments', 'programs.program_department_id = program_departments.program_department_id', 'left');
        $this->db->order_by('programs.program_name', 'ASC'); 
        $query = $this->db->get();	
        //echo $this->db->last_query();exit; 
        return $query->result_array(); 
    }
    
    // get a Program for update
    
    function getProgram($program)
    {       
        $query = $this->db->get_where('programs', $program);		
        return $query->result_array();
    }
    
    //update Program
    
    function updateProgram($prog_id, $program)
    {
      $this->db->where('program_id', $prog_id);
      $result =  $this->db->update('programs', $program);
      
      return $result;      
    }
    
    
     //View all Programs
    
//    function getAllprograms()
//    {
//        $this->db->select('programs.*');
//        //$this->db->select('program_departments.program_department_name');
//        $this->db->from('programs');
//        //$this->db->join('program_departments', 'programs.program_department_id = program_departments.program_department_id', 'left');
//        $this->db->order_by('programs.program_name', 'ASC'); 
//        $query = $this->db->get();	
//        //echo $this->db->last_query();exit; 
//        return $query->result_array();   
//    }
    
    function getAllMngPrograms($mng_dept_id = null)
    {
        $this->db->select('programs.*');
        //$this->db->select('program_departments.program_department_name');
        $this->db->from('programs');
        //$this->db->join('program_departments', 'programs.program_department_id = program_departments.program_department_id', 'left');
        $this->db->order_by('programs.program_name', 'ASC'); 
        $this->db->where('hr_department_id', $mng_dept_id);
        $query = $this->db->get();	
        //echo $this->db->last_query();exit; 
        return $query->result_array();   
    }
    
     //--------------End of Programs----------\\
    
    
    




    //--------////  Start Program Fee Form \\\\--------\\
    
    // check duplication of Program Fee
    
    function checkProgramFee($date,$program_id,$campus_id)
    {
        $this->db->like('year_date', $date, 'after');
        $this->db->where('program_id', $program_id);
        $this->db->where('campus_id', $campus_id);
        $query = $this->db->get('program_fees');
        return $query->result_array();
    }
    
    
    // add Program Fee in db
    
    function addProgramFee($program_fee)
    {
        $query = $this->db->insert('program_fees', $program_fee); 
		
        return $this->db->insert_id();
    }
    
    //View all Programs Fee
    
    function getAllprogramsFee()
    {
        $this->db->select('program_fees.*');
        $this->db->select('programs.program_name,campus.campus_name');
        $this->db->from('program_fees');
        $this->db->join('programs', 'programs.program_id = program_fees.program_id', 'inner');
        $this->db->join('campus', 'campus.campus_id = program_fees.campus_id', 'inner');
        $this->db->order_by('programs.program_name', 'ASC'); 
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();   
    }
    
    // get a Program Fee for update
    
    function getProgramFee($program_fee_id)
    {       
        $query = $this->db->get_where('program_fees', $program_fee_id);		
        return $query->result_array();
    }
    
    //update Program Fee
    
    function updateProgramFee($program_fee_id, $program_fee)
    {
      $this->db->where('program_fee_id', $program_fee_id);
      $result =  $this->db->update('program_fees', $program_fee);
      
      return $result;      
    }
    
     //--------------End of Program Fee----------\\

    
    
   //   ***** Start function for product Module *****   //    
    
    // check duplication of product name
    
    function checkProduct($product)
    {
        $query = $this->db->get_where('products', $product);
        return $query->result_array();
    }    

    // add product in db
    
    function addProduct($product)
    {
        $query = $this->db->insert('products', $product); 		
        return $this->db->insert_id();
    }
    
    // get all product from db
    
    function getAllproducts()
    {      
        $this->db->order_by('product_id', 'ASC'); 
        $query = $this->db->get('products');
		
        return $query->result_array();
    }
    
    //--------------End product Form----------\\   
    
    
    //--------------Added By Zohaib Start----------\\   
    
    function checklogingenerated( $sub_login,  $role )
    {
        $query      = "SELECT * FROM gen_sub_logins WHERE sub_login = '$sub_login' or role='$role '";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }  
    
    function addlogin($login_data)
    {
        $query = $this->db->insert('gen_sub_logins', $login_data); 
        return $this->db->insert_id();
    }
    
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
        return $query->result_array();
    }
    
    function getAlllogins(){
        $query = "SELECT gen_sub_logins.* , campus.*, hr_employee_record.* FROM gen_sub_logins INNER JOIN hr_employee_record ON hr_employee_record.emp_id = gen_sub_logins.employee_id INNER JOIN campus ON gen_sub_logins.campus_id = campus.campus_id";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
        
    }
    
    //--------------Added By Zohaib Ends----------\\   
    //--------------Added By Zohaib News start----------\\   
    
    function addingNews($news_array){
        $query = $this->db->insert('anouncements', $news_array); 
        return $this->db->insert_id();
    }
    function getAllNews($admin){
        $query      = "SELECT * FROM  anouncements WHERE added_by  = '$admin' and deleted != 1";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }
 
    function getallProgramNews(){
        $query      = "SELECT * FROM  anouncements WHERE added_by  = '$admin' and deleted != 1";
        $query_data = $this->db->query($query);
        return $val =  $query_data->num_rows() > 0 ? $query_data->result_array(): null;
    }
    
    function getNews($id)
    {       
        $query = $this->db->get_where('cities', array('city_id' => $id));
        return $val =  $query->num_rows() > 0 ? $query->result_array(): null;
    }
    
    function delNews($id)
    {   
        $query      = "UPDATE anouncements SET deleted   = 1 WHERE id  = '$id'";
        return $query;
    }
    
      
    //--------------Added By Zohaib News ENds----------\\   
}