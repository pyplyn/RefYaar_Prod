<?php

session_start();
ob_start();
require 'config.php';
include './Function/email-msg.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
//$QueryUser = "select code from users where mobile=? ";
$confirm_code11 = str_pad(mt_rand(1000, 9999), 4, '0', STR_PAD_LEFT);
$verified_mobile = str_pad(mt_rand(1111, 9999), 4, '0', STR_PAD_LEFT);
$query = "update users set veri_mob=?,email_verified=? where id=?";
$stmt = $con->prepare($query);
$stmt->bind_param('ssi', $confirm_code11, $verified_mobile, $_SESSION["social_id"]);
$stmt->execute();
$QueryUser = "select veri_mob,email_verified from users where id=? ";
$stmtUser = $con->prepare($QueryUser);
//$stmtUser->bind_param('i', $_SESSION["bw_mobile"]);
$stmtUser->bind_param('i', $_SESSION["social_id"]);
$stmtUser->execute();
$stmtUser->bind_result($confirm_code, $emailVer);
$stmtUser->store_result();
$stmtUser->fetch();
if ($_SESSION["social_id"]) {
    $mob = $_SESSION["auth_mob"];
    $message1 = "Welcome aboard RefYaar! Please enter the OTP code to continue with the Registration process. Your OTP Code is: $confirm_code";
    //echo $mob, $message1;
    sendSMS($mob, $message1);
    header("Location:verification.php?code=send");
} else {
    header("Location:sign-up.php?code=send");
}
if ($_SESSION["social_id"]) {
    $to = $_SESSION["auth_email"];
    $from = "RefYaar@refyaar.com";
    $subject = "A Warm Welcome from Team RefYaar";
    $message = "Hello there! <br/><br/>"
            ."Welcome aboard RefYaar!"
            ."<br/><br/>"
            ."Kindly verify your email address by clicking the following link: " 
            ."<br/>"
            .'<a href="http://www.refyaar.com/emailVerify-process.php?email='.$to.'&code='.$emailVer.'">Please click here to verify</a>'
            ."<br/><br/>"
            ."<strong>Good Luck & May the Force Be with You!</strong>"
            ."<br/><br/>"
            ."Regards,"
            ."<br/>"
            ."<strong>Team RefYaar</strong>"
            ."<br/><br/>"
            .'<a href="https://www.youtube.com/watch?v=S6O9HZ_L6fg">Watch the Video</a>'
            ."&nbsp;&nbsp;&nbsp;&nbsp;"
            .'<a href="https://www.facebook.com/refyaar">Like Us on Facebook</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
            .'<a href="https://twitter.com/refyaar">Follow Us on Twitter</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
            .'<a href="https://www.linkedin.com/company/refyaar">Follow Us on LinkedIn</a>'."&nbsp;&nbsp;&nbsp;&nbsp;";
    sendMail($to, $from, $subject, $message);
}
$stmt->close();
$stmtUser->close();
$con->close();
//    if ($sentmail) {
//        echo "Your Confirmation link Has Been Sent To Your Email Address.";
//    } else {
//        echo "Cannot send Confirmation link to your e-mail address";
//    }
?>