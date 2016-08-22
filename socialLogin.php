<?php

session_start();
ob_start();
require("config.php");
$email = $_POST["email"];
$id = $_POST["id"];
$type = $_POST["type"];
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
if ($type == "Facebook") {
    $countQuery = "select id,provider,provider_id,provider_token,email,f_name,l_name,user_id from social_con where   provider_id=? and email=? and provider='Facebook'";
    $stmt1 = $con->prepare($countQuery);
//$pwd = md5($_POST["login-password"]);
    $stmt1->bind_param('ss', $id, $email);
    $stmt1->execute();
    $stmt1->bind_result($socialId, $provider, $providerId, $providerToken, $email, $fName, $lastName, $userId);
    $stmt1->store_result();
    if ($stmt1->fetch()) {
        $QueryUser = "select mob_verified,veri_email,phone from users where email=?";
        $stmtUser = $con->prepare($QueryUser);
        $stmtUser->bind_param('s', $_POST["email"]);
        $stmtUser->execute();
        $stmtUser->bind_result($verified, $emailVerified, $phone);
        $stmtUser->store_result();
        $stmtUser->fetch();
        if (($verified == '0')) {
            $result["status"] = "120";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";
        } else {
            $_SESSION["bw_auth"] = "true";
            $_SESSION["bw_title"] = "$provider";
            $_SESSION["bw_fname"] = "$fName";
            $_SESSION["bw_lname"] = "$lastName";
            $_SESSION["bw_mobile"] = "$providerToken";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";

//        header("Location:profile.php");
            $result["err"] = "false";
            $result["status"] = "200";
            $result["msg"] = "Login successfully by " . $type . "!";
        }
        $stmtUser->close();
    } else {
//        header("Location:../index.php?err=invEmail");
        $result["err"] = "true";
        $result["status"] = "404";
        $result["msg"] = "This account is not registered with us, Please signup";
    }
    $stmt1->close();
} elseif ($type == "linkedin") {
    $countQuery = "select id,provider,provider_id,email,f_name,l_name,user_id from social_con where   provider_id=? and email=? and provider='linkedin'";
    $stmt1 = $con->prepare($countQuery);
//$pwd = md5($_POST["login-password"]);
    $stmt1->bind_param('ss', $id, $email);
    $stmt1->execute();
    $stmt1->bind_result($socialId, $provider, $providerId, $email, $fName, $lastName, $userId);
    $stmt1->store_result();
    if ($stmt1->fetch()) {
        $QueryUser = "select mob_verified,veri_email,phone from users where email=?";
        $stmtUser = $con->prepare($QueryUser);
        $stmtUser->bind_param('s', $_POST["email"]);
        $stmtUser->execute();
        $stmtUser->bind_result($verified, $emailVerified,$phone);
        $stmtUser->store_result();
        $stmtUser->fetch();
        if (($verified == '0')) {
            $result["status"] = "120";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";
        } else {
            $_SESSION["bw_auth"] = "true";
            $_SESSION["bw_title"] = "$provider";
            $_SESSION["bw_fname"] = "$fName";
            $_SESSION["bw_lname"] = "$lastName";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";
//        header("Location:profile.php");
            $result["err"] = "false";
            $result["msg"] = "Login successfully by " . $type . "!";
        }
        $stmtUser->close();
    } else {
//    header("Location:../index.php?err=invEmail");
        $result["err"] = "true";
        $result["msg"] = "This account is not registered with us, Please signup";
    }
    $stmt1->close();
} elseif ($type == "Gmail") {
    $countQuery = "select id,provider,provider_id,email,f_name,l_name,user_id from social_con where   provider_id=? and email=? and provider='Gmail'";
    $stmt1 = $con->prepare($countQuery);
//$pwd = md5($_POST["login-password"]);
    $stmt1->bind_param('ss', $id, $email);
    $stmt1->execute();
    $stmt1->bind_result($socialId, $provider, $providerId, $email, $fName, $lastName, $userId);
    $stmt1->store_result();
    if ($stmt1->fetch()) {
        $QueryUser = "select mob_verified,veri_email,phone from users where email=?";
        $stmtUser = $con->prepare($QueryUser);
        $stmtUser->bind_param('s', $_POST["email"]);
        $stmtUser->execute();
        $stmtUser->bind_result($verified, $emailVerified,$phone);
        $stmtUser->store_result();
        $stmtUser->fetch();
        if (($verified == '0')) {
            $result["status"] = "120";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";
        } else {
            $_SESSION["bw_auth"] = "true";
            $_SESSION["bw_title"] = "$provider";
            $_SESSION["bw_fname"] = "$fName";
            $_SESSION["bw_lname"] = "$lastName";
            $_SESSION["auth_email"] = "$email";
            $_SESSION["social_id"] = "$userId";
            $_SESSION["auth_mob"] = "$phone";
            $_SESSION["bw_type"] = "$type";
//        header("Location:profile.php");
            $result["err"] = "false";
            $result["msg"] = "Login successfully by " . $type . "!";
        }
        $stmtUser->close();
    } else {
//    header("Location:../index.php?err=invEmail");
        $result["err"] = "true";
        $result["msg"] = "This account is not registered with us, Please signup";
    }
    $stmt1->close();
}

print_r(json_encode($result));


$con->close();
?>