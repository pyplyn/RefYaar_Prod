<?php
// Textlocal account details
function sendSMS($mobile, $msg) {
// Authorisation details.
    $username = "soham@refyaar.com";
    $hash = "47e00839b0f076712c96ac40422828acbdbb23e9";
    
// Configuration variables. Consult http://api.textlocal.in/docs for more info.
    $test = "0";

// Data for text message. This is the text message data.
    $sender = "RFYAAR"; // This is who the message appears to be from.
// Message details
    $numbers = array($mobile);
    $message = rawurlencode($msg);

    $numbers = implode(',', $numbers);

// Prepare data for POST request
    $data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message, 'test' => $test);
    //$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
// Send the POST request with cURL
    $ch = curl_init('http://api.textlocal.in/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

// Process your response here
    echo $response;
}

function sendMail($to, $from, $subject, $messageee) {
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
    $headers .= "From:Team RefYaar <$from>" . "\r\n";
    mail($to, $subject, $messageee, $headers);
}

function sendMail1($to1, $from1, $subject1, $messageee1, $fromName1) {
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
    $headers .= "From:Team RefYaar <$from1>" . "\r\n";
    mail($to1, $subject1, $messageee1, $headers);
}
function sendMail2($to2, $from2, $subject2, $messageee1) {
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
    $headers .= "From:Team RefYaar <$from2>" . "\r\n";
  mail($to2, $subject2, $messageee1, $headers);
}
?>