<?php

session_start();
ob_start();
require 'config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$QueryUser = "select email_verified, email from users where email=?";
$stmtUser = $con->prepare($QueryUser);
$stmtUser->bind_param('s', $_GET["email"]);
$stmtUser->execute();
$stmtUser->bind_result($emailCode, $email);
$stmtUser->store_result();
if ($stmtUser->fetch()) {
    if (($_GET["code"] == $emailCode) && ($_GET["email"] == $email)) {
        $query = "update users set Status='Active',veri_email='1' where email_verified=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $emailCode);
        $stmt->execute();
        header("Location:profile.php");
    } else {
        header("Location:emailVerify.php?id=invcode");
    }
//    $stmt->close();
} else {
//    header("Location:verification.php?id=invMob");
}
$stmtUser->close();
$con->close();
?>
