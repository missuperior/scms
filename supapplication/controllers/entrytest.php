<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/MAIN_Controller.php");
class Entrytest extends MAIN_Controller { public function __construct()
{
parent::__construct();
$this->load->model('Entrytest_model');
$this->load->model('Course_model');
$this->load->library('session');
$this->load->model('Admin_model');
$this->load->model('Admission_r_model');

// for form validation            
$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->library('smsapi');
}
//   For Index Page Program Manager      

public function index() {
$this->load->view('entrytest/login');
}

//  for verification of admin login          
public function login_check()
{
if ($this->session->userdata('sub_login_id') == '' && $this->session->userdata('sub_login') == '')
{ redirect('entrytest/index');
}
}
public function admin_login()
{ 
    $this->form_validation->set_rules('username', 'User Name', 'required');
$this->form_validation->set_rules('password', 'Password', 'required');
if ($this->form_validation->run() == FALSE) {
$this->load->view('entrytest');
} else {
$this->load->library('encrypt');
$encrypted_password = $this->encrypt->sha1($_POST['password']);
$login_data = array(
'sub_login' => $_POST['username'],
 'sub_password' => $encrypted_password,
);
$account_role_id = $_POST['account_role_id'];
$result = $this->Entrytest_model->adminLogin($login_data);
if($account_role_id == $result->account_role_id)
{
if ($result)
{
$campaign = $this->Admission_r_model->getOpenCampaign();
$campaign_id = $campaign->campaign_id;
$campaign_code = $campaign->campaign_code;
$sessionData = array(
'sub_login' => $result->sub_login,
 'sub_login_id' => $result->sub_login_id,
 'employee_id' => $result->employee_id,
 'campus_id' => $result->campus_id,
 'account_role_id' => $result->account_role_id,
 'role' => $result->role,
 'campaign_code' => $campaign_code,
 'campaign_id' => $campaign_id
);
$this->session->set_userdata($sessionData);
redirect('entrytest/dashboard');
} else {
$this->session->set_userdata('error', 'Incorrect Username OR Password');
redirect('entrytest/index');
} }
else{
$this->session->set_userdata('error', 'Please Login from Your Own login..');
redirect('entrytest/index');
}
}
}
public function logout() {
$this->session->unset_userdata('prgmng_username');
$this->session->unset_userdata('prgmng_id');
$this->session->unset_userdata('account_role_id');
$this->session->sess_destroy();
redirect();
} 
 public function dashboard() { 
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/entrytest_dashboard');
$this->load->view('entrytest/entrytest_footer');
} 
public function add_room_form() { $this->login_check();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/room/addroom');
$this->load->view('entrytest/entrytest_footer');
} 
public function add_room() { $this->login_check();
$this->form_validation->set_rules('room', 'Room Name ', 'required');
$this->form_validation->set_rules('capacity', 'Room Capacity ', 'required');
if ($this->form_validation->run() == FALSE) { $this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/room/addroom');
$this->load->view('entrytest/entrytest_footer');
} else { $room = array( 'room_name' => $_POST['room'] );
 $res = $this->Entrytest_model->checkRoom($room);
if ($res) { $this->session->set_userdata('error_msg', 'This room Already Exists');
redirect('entrytest/add_room_form');
} else { $room_data = array( 'room_name' => $_POST['room'], 'room_capacity' => $_POST['capacity'], 'floor' => $_POST['floor'] );
$result = $this->Entrytest_model->addRoom($room_data);
if ($result) { $this->session->set_userdata('success_msg', 'Room Added Successfully');
redirect('entrytest/view_rooms');
} } } } 
public function view_rooms() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/room/viewrooms', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function edit_room() { $this->login_check();
$id = $_GET['room_id'];
$result = $this->Entrytest_model->getRoom($id);
$result['room'] = $result;
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/room/editroom', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function update_room() { $this->login_check();
$id = $_POST['room_id'];
$this->form_validation->set_rules('room', 'Room ', 'required');
$this->form_validation->set_rules('capacity', 'Capacity', 'required');
if ($this->form_validation->run() == FALSE) { $result = $this->Entrytest_model->getRoom($id);
$result['room'] = $result;
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/room/editroom', $result);
$this->load->view('entrytest/entrytest_footer');
}  $room_data = array( 'room_name' => $_POST['room'], 'room_capacity' => $_POST['capacity'], 'floor' => $_POST['floor'] );
$result = $this->Entrytest_model->updateRoom($id, $room_data);
if ($result) { $this->session->set_userdata('success_msg', 'Room updated Successfully');
redirect('entrytest/view_rooms');
} }   public function add_test_form() { $this->login_check();
$result['campaign'] = $this->Admin_model->getAllcampaigns();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/test/addtest', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function add_test() { $this->login_check();
$this->form_validation->set_rules('number', 'Test Number', 'required');
$this->form_validation->set_rules('campaign', 'Campaign', 'required');
$this->form_validation->set_rules('date', 'Date', 'required');
$this->form_validation->set_rules('time', 'Time ', 'required');
$this->form_validation->set_rules('venue', 'Venue ', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');
if ($this->form_validation->run() == FALSE) { $result['campaign'] = $this->Admin_model->getAllcampaigns();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/test/addtest', $result);
$this->load->view('entrytest/entrytest_footer');
} else { $test = array( 'test_no' => $_POST['number'], 'campaign_id' => $_POST['campaign'] );
 $res = $this->Entrytest_model->checkTest($test);
if ($res) { $this->session->set_userdata('error_msg', 'Test Number Already Exists');
redirect('entrytest/add_test_form');
} else { $test_data = array( 'test_no' => $_POST['number'], 'campaign_id' => $_POST['campaign'], 'test_date' => $_POST['date'], 'test_time' => $_POST['time'], 'test_venue' => $_POST['venue'], 'status' => $_POST['status'] );
$result = $this->Entrytest_model->addTest($test_data);
if ($result) { $this->session->set_userdata('success_msg', 'Test Added Successfully');
redirect('entrytest/view_tests');
} } } }  public function view_tests() { $this->login_check();
$result['tests'] = $this->Entrytest_model->getAlltests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/test/viewtests', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function edit_test() { $this->login_check();
$id = $_GET['test_id'];
$result['test'] = $this->Entrytest_model->getTest($id);
$result['campaign'] = $this->Admin_model->getAllcampaigns2();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/test/edittest', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function update_test() { $this->login_check();
$id = $_POST['test_id'];
$this->form_validation->set_rules('number', 'Test Number', 'required');
$this->form_validation->set_rules('campaign', 'Campaign ', 'required');
$this->form_validation->set_rules('date', 'Date', 'required');
$this->form_validation->set_rules('time', 'Time ', 'required');
$this->form_validation->set_rules('venue', 'Venue ', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');
if ($this->form_validation->run() == FALSE) { $id = $_GET['test_id'];
$result['test'] = $this->Entrytest_model->getTest($id);
$result['campaign'] = $this->Admin_model->getAllcampaigns2();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/test/edittest', $result);
$this->load->view('entrytest/entrytest_footer');
} if($_POST['status'] == 'In Process') { $res = $this->Entrytest_model->getOpentests();
if(count($res) > 0){ $this->session->set_userdata('success_msg', 'Only one Test should be In Process at a time');
redirect('entrytest/view_tests');
} }  $test_data = array( 'test_no' => $_POST['number'], 'campaign_id' => $_POST['campaign'], 'test_date' => $_POST['date'], 'test_time' => $_POST['time'], 'test_venue' => $_POST['venue'], 'status' => $_POST['status'] );
$result = $this->Entrytest_model->updateTest($id, $test_data);
if ($result) { $this->session->set_userdata('success_msg', 'Test updated Successfully');
redirect('entrytest/view_tests');
} } public function allocate_room_form() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['program'] = $this->Admin_model->getAllprograms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/allocateroom/allocateroom_form', $result);
$this->load->view('entrytest/entrytest_footer');
}  public function getCapacity() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$test_id = $_POST['test_id'];
$room_id = $_POST['room_id'];
$result['room_id'] = $room_id;
$result['capacity'] = $this->Entrytest_model->getRoomCapacity($room_id);
$result['room_allocated'] = $this->Entrytest_model->getRoomAllocated($room_id, $test_id);
$this->load->view('entrytest/allocateroom/room_partial', $result);
}  public function getStudents() { $this->login_check();
$program_id = $_POST['program_id'];
$start_date = $_POST['start_date'];
$result['students'] = $this->Entrytest_model->getProgramStudents($program_id, $start_date);

$result['students_allocated'] = $this->Entrytest_model->getProgramStudentsAllocated($program_id);
$result['program_detail'] = $this->Entrytest_model->getProgramDetail($program_id);
$result['program'] = $this->Admin_model->getAllprograms();
$result['program_id'] = $program_id;
$this->load->view('entrytest/allocateroom/program_partial', $result);
}
public function allocate_room() { $this->login_check();
$testid = $_POST['test'];
$roomid = $_POST['rooms'];
$programid = $_POST['program'];
$students = $_POST['students'];
$s_date = $_POST['s_date'];
$checkprogram = $this->Entrytest_model->checkProgram($programid);
if($checkprogram){ $start_form_id = $this->Entrytest_model->getStartId($programid);
$start_form_id = $start_form_id + 1;
$last_form_id = $this->Entrytest_model->getLastId($students, $programid, $start_form_id, $s_date);

}else{ $start_form_id = $this->Entrytest_model->getStartIdForm($programid, $s_date);
$last_form_id = $this->Entrytest_model->getLastId($students, $programid, $start_form_id, $s_date);
} $room_allocation_data = array( 'room_id' => $roomid, 'program_id' => $programid, 'test_id' => $testid, 'no_of_students' => $students, 'start_form_id' => $start_form_id, 'last_form_id' => $last_form_id );

$result = $this->Entrytest_model->addAllocationData($room_allocation_data);
if($result) { $this->session->set_userdata('error_msg', 'Room Allocated Successfully');
redirect('entrytest/view_allocated');
}else{ $this->session->set_userdata('error_msg', 'Room Not Allocated, Please try again');
redirect('entrytest/view_allocated');
} } 
public function view_allocated() { $this->login_check();
$result['allocated'] = $this->Entrytest_model->getAllocatedInfo();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/allocateroom/viewallocated', $result);
$this->load->view('entrytest/entrytest_footer');
} 
public function empty_room() { $this->login_check();
$room_id = $_GET['room_id'];
$result = $this->Entrytest_model->emptyRoom($room_id);
if($result){ $this->session->set_userdata('success_msg', 'Empty Room Successfully');
redirect('entrytest/view_rooms');
}else{ $this->session->set_userdata('success_msg', 'Room Not Empty, Please try again');
redirect('entrytest/view_rooms');
} } 
public function program_room_report_form() { $this->login_check();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/reports/programwiseForm', $result);
$this->load->view('entrytest/entrytest_footer');
} 
public function program_room_report() { $this->login_check();
$tes_id = $_POST['test'];
$result['report_info'] = $this->Entrytest_model->getReportInfo($tes_id);
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/reports/programwiseView', $result);
$this->load->view('entrytest/entrytest_footer');
} public function students_list_form() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/reports/studentlistForm', $result);
$this->load->view('entrytest/entrytest_footer');
} public function students_list() { $this->login_check();
$room_id = $_POST['rooms'];
$tes_id = $_POST['test'];
$result['programslist'] = $this->Entrytest_model->getAllocatedProg($room_id, $tes_id);

$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/reports/studentlistView', $result);
$this->load->view('entrytest/entrytest_footer');
} public function attendance_form() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/reports/attendancelistForm', $result);
$this->load->view('entrytest/entrytest_footer');
} public function attendance() { $this->login_check();
$room_id = $_POST['rooms'];
$tes_id = $_POST['test']; 
$result['programslist'] = $this->Entrytest_model->getAllocatedProg($room_id, $tes_id);

$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/reports/attendancelistView', $result);
$this->load->view('entrytest/entrytest_footer');
} public function award_list_form() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/reports/awardlistForm', $result);
$this->load->view('entrytest/entrytest_footer');
} public function award_list() { $this->login_check();
$room_id = $_POST['rooms'];
$tes_id = $_POST['test'];
$result['programslist'] = $this->Entrytest_model->getAllocatedProg($room_id, $tes_id);
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/reports/awardlistView', $result);
$this->load->view('entrytest/entrytest_footer');
} public function add_entrytest_result_form() { $this->login_check();
$result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['program'] = $this->Admin_model->getAllprograms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/dataentry/addresult', $result);
$this->load->view('entrytest/entrytest_footer');
} public function add_entrytest_result() { $this->login_check();
$this->form_validation->set_rules('formno', 'Form No ', 'required');
$this->form_validation->set_rules('name', 'Name', 'required');
$this->form_validation->set_rules('test', 'Test', 'required');
$this->form_validation->set_rules('rooms', 'Room', 'required');
$this->form_validation->set_rules('program', 'Program', 'required');
$this->form_validation->set_rules('marks', 'Marks', 'required');
if ($this->form_validation->run() == FALSE) { $result['rooms'] = $this->Entrytest_model->getAllrooms();
$result['program'] = $this->Admin_model->getAllprograms();
$result['tests'] = $this->Entrytest_model->getOpentests();
$this->load->view('entrytest/entrytest_header');
$this->load->view('entrytest/entrytest_side_menu');
$this->load->view('entrytest/dataentry/addresult', $result);
$this->load->view('entrytest/entrytest_footer');
} $check_data = array( 'form_no' => $_POST['formno'] );
$res = $this->Entrytest_model->check_result($check_data);
if($res){ $mesage = $this->session->set_userdata('error_msg', 'This form no already exists.');
redirect('entrytest/add_entrytest_result_form');
}else{ $data = array( 'form_no' => strtoupper($_POST['formno']), 'name' => strtoupper($_POST['name']), 'test_id' => $_POST['test'], 'room_id' => $_POST['rooms'], 'program_id' => $_POST['program'], 'marks' => $_POST['marks'] );
} $result_id = $this->Entrytest_model->add_result($data);
if($result_id){ $mesage = $this->session->set_userdata('error_msg', 'Result Added Successfully.');
redirect('entrytest/add_entrytest_result_form');
}else{ $mesage = $this->session->set_userdata('error_msg', 'Result Not Added Successfully.');
redirect('entrytest/add_entrytest_result_form');
} } public function send_messages(){ $rooms = $this->Entrytest_model->getAllocatedRooms();

$i = 0;
foreach($rooms AS $row){ $std_info = $this->Entrytest_model->getStdInfo($row['program_id'], $row['start_form_id'], $row['last_form_id']);
foreach($std_info AS $key => $roww ){ $name = $roww['student_name'];
$room = $row['room_name'];
$floor = $row['floor'];
$date = date('d M', strtotime($row['test_date']));
$time = substr($row['test_time'], 0, 5);
$explode_num = explode("-", $roww['mobile']);
$mobile = $explode_num[0].$explode_num[1];
$mobile_trim = trim($mobile, '0');
$number = '92'.$mobile_trim;
$number = '923224661584';
$msg = "Dear $name, ".PHP_EOL."Your Entry Test details are as follows,  ".PHP_EOL."Room : $room ".PHP_EOL."Floor : $floor ".PHP_EOL."Date : $date ".PHP_EOL."Time : $time ".PHP_EOL."Best of luck. ";
echo $this->smsapi->sendSMS($number, $msg);
$i++;
} echo '<pre>';
print_r($std_info);
} echo $i;
} }
?>