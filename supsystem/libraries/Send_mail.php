<?php

require("phpmailer/class.phpmailer.php");

class send_mail {

    public function send_email($to, $subject, $message, $headers) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        //$mail->SMTPSecure = "ssl";
        $mail->Host = 'smtpout.secureserver.net';
        $mail->Mailer = 'smtp';
        $mail->Port = '25';
        $mail->Username = "Careers@naibaat.tv";
        $mail->Password = "naibaat123";
        $email = $to;
        $name = $email; // Recipient's name
        $webmaster_email = "Careers@naibaat.tv";
        $mail->From = $webmaster_email;
        $mail->FromName = "Nai Baat TV";
        $mail->AddAddress($email, $name);
        $mail->AddReplyTo($webmaster_email, "Nai Baat TV");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $message; //HTML Body
        $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
        $mail->SMTPDebug = 1;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Nai Baat TV' . "\r\n";
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            
        }
    }

}

?>
