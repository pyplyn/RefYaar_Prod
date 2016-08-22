<?php

require 'config.php';
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
if (($_POST["resend"]) == 'resend') {
    header("Location:send-verification.php?res=resnd");
}
$QueryUser = "select veri_mob, phone from users where phone=?";
$stmtUser = $con->prepare($QueryUser);
$stmtUser->bind_param('s', $_SESSION["auth_mob"]);
$stmtUser->execute();
$stmtUser->bind_result($mobileCode, $mobile);
$stmtUser->store_result();
if ($stmtUser->fetch()) {
    if (($_POST["otp"] == $mobileCode) && ($_SESSION["auth_mob"] == $mobile)) {
        $query = "update users set Status='Active',mob_verified='1' where veri_mob=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $mobileCode);
        $stmt->execute();
        header("Location:expertise.php");
//        $_SESSION["bw_auth"] = "true";
////        $auth=$_SESSION["bw_auth"];
//        $_SESSION["bw_authh"] = $_SESSION["bw_auth"];
    } else {
        header("Location:verification.php?id=invcode");
    }
} else {
    header("Location:verification.php?id=invMob");
}
$stmtUser->close();
$con->close();
?>