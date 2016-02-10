<?php
class Smsapi {
function sendSMS($number, $msg)
{
    
    $type = "xml"; 
    $id = "superiorsol"; 
    $pass = "super123"; 
    $lang = "English"; 
    $mask = "SUPERIOR"; // Data for text message 
    
    $to = $number; 
    $message = $msg; 
    $message = urlencode($message); // Prepare data for POST request 
    $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;
    
    $ch = curl_init();
    $ch = curl_init('http://www.outreach.pk/api/sendsms.php/sendsms/url');
    //curl_setopt($ch, CURLOPT_URL, 'http://66.172.38.168/my/api/sms-http.php' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $chk = curl_exec($ch);
    curl_close($ch );  
    return $chk;
}

function chkBAL($username,$pass)
{
    $data = array();
    $data['login'] = $username;
    $data['pass'] = $pass;
    $data['chk_bal'] = 1;
    
    
    $post_str = '';
    foreach($data as $key=>$val) {
    	$post_str .= $key.'='.urlencode($val).'&';
    }
    $post_str = substr($post_str, 0, -1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://smsroaming.com/my/api/curl.php' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $chk = curl_exec($ch);
    curl_close($ch );  
    return $chk;
}


function getMsgs($username,$pass)
{
    $data = array();
    $data['login'] = $username;
    $data['pass'] = $pass;
    
    $post_str = '';
    foreach($data as $key=>$val) {
    	$post_str .= $key.'='.urlencode($val).'&';
    }
    $post_str = substr($post_str, 0, -1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://smsroaming.com/my/api/curl_inbox.php' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $chk = curl_exec($ch);
    curl_close($ch );  
    return $chk;
}

function getMsgsDone($username,$pass)
{
    $data = array();
    $data['login'] = $username;
    $data['pass'] = $pass;
    $data['read'] = 1;
    
    $post_str = '';
    foreach($data as $key=>$val) {
    	$post_str .= $key.'='.urlencode($val).'&';
    }
    $post_str = substr($post_str, 0, -1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://smsroaming.com/my/api/curl_inbox.php' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $chk = curl_exec($ch);
    curl_close($ch );  
    return $chk;
}

}

?>
