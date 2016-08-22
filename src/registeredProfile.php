<?php

require("../config.php");
session_start();
ob_start();
//if ($_SESSION["admin_role"] == "Super Admin") {
try {
    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
//    $pic = $_POST["pic"];
    $token = $_POST["token"];
    $provider = $_POST["type"];
//    $friendList = $_POST["friendList"];
    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
    if ($provider == "Facebook") {
        $countQueryCheck = "select count(*) from social_con  where  email=? and provider_id=? and user_id=?";
        $stmtCheck = $con->prepare($countQueryCheck);
        $stmtCheck->bind_param('ssi', $email, $id,$_SESSION["social_id"]);
        $stmtCheck->execute();
        $stmtCheck->bind_result($socioCount);
        $stmtCheck->store_result();
        $result = array();
        $stmtCheck->fetch();
        if ($socioCount == 0) {
            $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $_SESSION["social_id"]);
            $result = array();
            if ($stmt->execute()) {
                $result["status"] = "121";
                $result["err"] = "false";
                $result["msg"] = "Connected with $provider !";
                $_SESSION["fb_type"] = $provider;
            }
        } else {
            $result["status"] = "121";
            $result["err"] = "false";
            $result["msg"] = "You are existing user !";
            $_SESSION["fb_type"] = $provider;
//                $_SESSION["social_id"] = $socioId;
        }
    } else if ($provider == "Gmail") {
        $countQueryCheck = "select count(*) from social_con  where  email=? and provider_id=? and user_id=?";
        $stmtCheck = $con->prepare($countQueryCheck);
        $stmtCheck->bind_param('ssi', $email, $id, $_SESSION["social_id"]);
        $stmtCheck->execute();
        $stmtCheck->bind_result($socioCount);
        $stmtCheck->store_result();
        $result = array();
        $stmtCheck->fetch();
        if ($socioCount == 0) {
            $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $_SESSION["social_id"]);
            $result = array();
            if ($stmt->execute()) {
                $result["status"] = "121";
                $result["err"] = "false";
                $result["msg"] = "Connected with Google !";
                $_SESSION["pro_type"] = $provider;
            }
        } else {
            $_SESSION["pro_type"] = $provider;
            $result["status"] = "121";
            $result["err"] = "false";
            $result["msg"] = "You are existing user !";

//                $_SESSION["social_id"] = $socioId;
        }
    } else if ($provider == "linkedin") {
        $countQueryCheck = "select count(*) from social_con  where  email=? and provider_id=? and user_id=?";
        $stmtCheck = $con->prepare($countQueryCheck);
        $stmtCheck->bind_param('ssi', $email, $id, $_SESSION["social_id"]);
        $stmtCheck->execute();
        $stmtCheck->bind_result($socioCount);
        $stmtCheck->store_result();
        $result = array();
        $stmtCheck->fetch();
        if ($socioCount == 0) {
            $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
            $stmt = $con->prepare($query);
            $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $_SESSION["social_id"]);
            $result = array();
            if ($stmt->execute()) {
                $result["status"] = "121";
                $result["err"] = "false";
                $result["msg"] = "Connected with $provider !";
                $_SESSION["link_type"] = $provider;
            }
        } else {
            $result["status"] = "121";
            $result["err"] = "false";
            $result["msg"] = "You are existing user  !";
            $_SESSION["link_type"] = $provider;
//                $_SESSION["social_id"] = $socioId;
        }
    }

    print_r(json_encode($result));

    $con->close();
} catch (Exception $e) {
    $result = array();
    $result["err"] = "true";
    echo "Error: $e";
    print_r(json_encode($result));
}
