<?php

require("../config.php");
session_start();
ob_start();
//if ($_SESSION["admin_role"] == "Super Admin") {
try {
    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
    $countQueryCheck = "select count(*) from users  where  email=? and provider_id=? and id=?";
    $stmtCheck = $con->prepare($countQueryCheck);
    $stmtCheck->bind_param('ssi', $_POST["email"], $_POST["providerId"], $_SESSION["social_id"]);
    $stmtCheck->execute();
    $stmtCheck->bind_result($socioCount);
    $stmtCheck->store_result();
    $result = array();
    $stmtCheck->fetch();
//    if ($socioCount != 0) {
    if ($_POST["about-us"] == "Other") {
//            $emailQuery = "select mob_verified,veri_email,provider_id from users where  email=?";
//            $stmt2221 = $con->prepare($emailQuery);
//            $stmt2221->bind_param('s', $_POST["email"]);
//            $stmt2221->execute();
//            $stmt2221->bind_result($verMob, $verEmail, $countEmail);
//            $stmt2221->store_result();
//            $result = array();
//            $stmt2221->fetch();
//            if ((($countEmail == $_POST["providerId"]) || (strlen($countEmail) < 1)) && (($verEmail == 0) || ($verMob == 0))) {




        $mobileQuery = "select provider_id from users where  phone=?";
        $stmt222 = $con->prepare($mobileQuery);
        $stmt222->bind_param('s', $_POST["mobile"]);
        $stmt222->execute();
        $stmt222->bind_result($count);
        $stmt222->store_result();
        $result = array();
        $stmt222->fetch();
        if (($count == $_POST["providerId"]) || (strlen($count) < 1)) {
            $query = "update users set title=?,email=?,phone=?,country=?,state=?,about_us=?,pwd=?  ,last_updated=now() where id=?";
            $stmt = $con->prepare($query);
            $pwd = md5($_POST["password"]);
            $stmt->bind_param('sssiissi', $_POST["title"], $_POST["email"], $_POST["mobile"], $_POST["country"], $_POST["state"], $_POST["specify"], $pwd, $_SESSION["social_id"]);
            $result = array();
            if (!$stmt->execute()) {
                $result["err"] = "true";
                $result["msg"] = "Error for signup";
            } else {
                $queryUp = "update users set mob_verified='0' where id=?";
                $stmtUp = $con->prepare($queryUp);
                $stmtUp->bind_param('s', $_SESSION["social_id"]);
                $stmtUp->execute();

                $_SESSION["bw_auth"] = "true";
                $_SESSION["bw_fname"] = $_POST["fname"];
                $_SESSION["auth_mob"] = $_POST["mobile"];
                $_SESSION["auth_email"] = $_POST["email"];
                $result["err"] = "false";
                $result["msg"] = "Registered successfully!";
            }
//                print_r(json_encode($result));
            $stmt->close();
        } else {
//                $query = "update users set title=?,email=?,country=?,state=?,about_us=?,pwd=?  ,last_updated=now() where id=?";
//                $stmt = $con->prepare($query);
//                $pwd = md5($_POST["password"]);
//                $stmt->bind_param('ssiissi', $_POST["title"], $_POST["email"], $_POST["country"], $_POST["state"], $_POST["specify"], $pwd, $_SESSION["social_id"]);
//                $result = array();
//                $stmt->execute();
////            $result["err"] = "true";
//                $_SESSION["auth_mob"] = $_POST["mobile"];
            $result["err"] = "exist";
            $result["msg"] = $_POST["mobile"] . "  already exist";
        }
//        print_r(json_encode($result));
//        $stmt22->close();
//    print_r(json_encode($result));
//    $stmt222->close();
//    $con->close();
//        } 
//        else {
//            $result["err"] = "exist";
//            $result["msg"] = $_POST["email"] . " Already Register";
//        }
//        print_r(json_encode($result));
    } else {
//        $emailQuery = "select mob_verified,veri_email,provider_id from users where  email=?";
//        $stmt2221 = $con->prepare($emailQuery);
//        $stmt2221->bind_param('s', $_POST["email"]);
//        $stmt2221->execute();
//        $stmt2221->bind_result($verMob, $verEmail, $countEmail);
//        $stmt2221->store_result();
//        $result = array();
//        $stmt2221->fetch();
//        if ((($countEmail == $_POST["providerId"]) || (strlen($countEmail) < 1)) && (($verEmail == 0) || ($verMob == 0))) {




        $mobileQuery = "select provider_id from users where  phone=?";
        $stmt222 = $con->prepare($mobileQuery);
        $stmt222->bind_param('s', $_POST["mobile"]);
        $stmt222->execute();
        $stmt222->bind_result($count);
        $stmt222->store_result();
        $result = array();
        $stmt222->fetch();
        if (($count == $_POST["providerId"]) || (strlen($count) < 1)) {
            $query = "update users set title=?,email=?,phone=?,country=?,state=?,about_us=?,pwd=?  ,last_updated=now() where id=?";
            $stmt = $con->prepare($query);
            $pwd = md5($_POST["password"]);
            $stmt->bind_param('sssiissi', $_POST["title"], $_POST["email"], $_POST["mobile"], $_POST["country"], $_POST["state"], $_POST["about-us"], $pwd, $_SESSION["social_id"]);
            $result = array();
            if (!$stmt->execute()) {
                $result["err"] = "true";
                $result["msg"] = "Error for signup";
            } else {
                $queryUp = "update users set mob_verified='0' where id=?";
                $stmtUp = $con->prepare($queryUp);
                $stmtUp->bind_param('s', $_SESSION["social_id"]);
                $stmtUp->execute();
                $_SESSION["bw_auth"] = "true";
                $_SESSION["bw_fname"] = $_POST["fname"];
                $_SESSION["auth_mob"] = $_POST["mobile"];
                $_SESSION["auth_email"] = $_POST["email"];
                $result["err"] = "false";
                $result["msg"] = "Registered successfully!";
            }
//            print_r(json_encode($result));
            $stmt->close();
        } else {
//                $query = "update users set title=?,email=?,country=?,state=?,about_us=?,pwd=?  ,last_updated=now() where id=?";
//                $stmt = $con->prepare($query);
//                $pwd = md5($_POST["password"]);
//                $stmt->bind_param('ssiissi', $_POST["title"], $_POST["email"], $_POST["country"], $_POST["state"], $_POST["about-us"], $pwd, $_SESSION["social_id"]);
//                $result = array();
//                $stmt->execute();
////            $result["err"] = "true";
//                $_SESSION["auth_mob"] = $_POST["mobile"];
            $result["err"] = "exist";
            $result["msg"] = $_POST["mobile"] . "  already exist";
        }
//        } else {
//            $result["err"] = "exist";
//            $result["msg"] = $_POST["email"] . " Already register";
//        }
//        $stmt22->close();
//    print_r(json_encode($result));
//    $stmt222->close();
//    $con->close();
    }

    print_r(json_encode($result));
} catch (Exception $e) {
    $result = array();
    $result["err"] = "true";
    echo "Error: $e";
    print_r(json_encode($result));
}
