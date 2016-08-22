<?php

session_start();
ob_start();
require("../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$countQuery = "select id,title,f_name,l_name,phone,email,status  from users where email=?  and pwd=? and status='Active'";
$stmt1 = $con->prepare($countQuery);
$pwd = md5($_POST["login-password"]);
$stmt1->bind_param('ss', $_POST["login-email"], $pwd);
$stmt1->execute();
$stmt1->bind_result($userId, $title, $firstName, $lastName, $mobile, $email, $status);
$stmt1->store_result();
$result = array();
if ($stmt1->fetch()) {
    if ($status == 'Active') {
        $_SESSION["bw_auth"] = "true";
        $_SESSION["bw_title"] = "$title";
        $_SESSION["bw_fname"] = "$firstName";
        $_SESSION["bw_lname"] = "$lastName";
        $_SESSION["auth_mob"] = "$mobile";
        $_SESSION["auth_email"] = "$email";
        $_SESSION["bw_status"] = "$status";
        $_SESSION["social_id"] = "$userId";
        $result["status"] = "201";
        $result["msg"] = "Login Succesfully";
//        header("Location:../profile.php");
    } else {
        $result["err"] = "exist";
        $result["msg"] = "Status is not Active";
//        header("Location:../sign-up.php?err=actv");
    }
} else {
    $result["err"] = "exist";
    $result["msg"] = "Enter correct Email or Password";
}
print_r(json_encode($result));
$stmt1->close();
$con->close();
?>