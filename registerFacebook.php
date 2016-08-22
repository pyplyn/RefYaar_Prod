<?php

require("config.php");
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
    $countQuery = "select count(*) from users where  email=? or provider_id=?";
    $stmt22 = $con->prepare($countQuery);
    $stmt22->bind_param('ss', $email, $id);
    $stmt22->execute();
    $stmt22->bind_result($emailCount);
    $stmt22->store_result();
    $result = array();
    $stmt22->fetch();
    if ($emailCount == 0) {
        if ($_POST["type"] == "Facebook") {
            $query1 = "insert into users (f_name,l_name,email,provider_id) values(?,?,?,?)";
            $stmt1 = $con->prepare($query1);
            $stmt1->bind_param('ssss', $fname, $lname, $email, $id);
            $result1 = array();
            if (!$stmt1->execute()) {
                $result["err"] = "true";
                $result["msg"] = "Error for signup";
            } else {
                $userId = $con->insert_id;
                $query = "insert into social_con (provider,provider_id,provider_token,email,f_name,l_name,user_id) values(?,?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('ssssssi', $provider, $id, $token, $email, $fname, $lname, $userId);
                $result = array();
                if (!$stmt->execute()) {
                    $result["err"] = "true";
                    $result["msg"] = "Error for signup";
                } else {
//                    $_SESSION["bw_auth"] = "true";
                    $_SESSION["bw_fname"] = "$fname";
                    $_SESSION["bw_lname"] = "$lname";
                    $result["err"] = "false";
                    $result["msg"] = "Registered successfully by " . $provider . "!";
                    $_SESSION["social_id"] = "$userId";
                    $_SESSION["auth_email"] = "$email";
                    $_SESSION["socioProvider"] = "$provider";
                    $_SESSION["bw_type"] = "$provider";
                }
                $stmt->close();
            }
            $stmt1->close();
        } else if ($provider == "linkedin") {
            $query1 = "insert into users (f_name,l_name,email,provider_id) values(?,?,?,?)";
            $stmt1 = $con->prepare($query1);
            $stmt1->bind_param('ssss', $fname, $lname, $email, $id);
            $result1 = array();
            if (!$stmt1->execute()) {
                $result["err"] = "true";
                $result["msg"] = "Error for signup";
            } else {
                $userId = $con->insert_id;
                $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $userId);
                $result = array();
                if (!$stmt->execute()) {
                    $result["err"] = "true";
                    $result["msg"] = "Error for signup";
                } else {
                    $result["err"] = "false";
                    $result["msg"] = "Registered successfully by " . $provider . "!";
//                    $_SESSION["bw_auth"] = "true";
                    $_SESSION["bw_fname"] = "$fname";
                    $_SESSION["bw_lname"] = "$lname";
                    $_SESSION["social_id"] = "$userId";
                    $_SESSION["auth_email"] = "$email";
                    $_SESSION["socioProvider"] = "$provider";
                    $_SESSION["bw_type"] = "$provider";
                }
                $stmt->close();
            }
            $stmt1->close();
        } else if ($provider == "Gmail") {
            $query1 = "insert into users (f_name,l_name,email,provider_id) values(?,?,?,?)";
            $stmt1 = $con->prepare($query1);
            $stmt1->bind_param('ssss', $fname, $lname, $email, $id);
            $result1 = array();
            if (!$stmt1->execute()) {
                $result["err"] = "true";
                $result["msg"] = "Error for signup";
            } else {
                $userId = $con->insert_id;
                $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $userId);
                $result = array();
                if (!$stmt->execute()) {
                    $result["err"] = "true";
                    $result["msg"] = "Error for signup";
                } else {
                    $result["err"] = "false";
                    $result["msg"] = "Registered successfully by " . $provider . " !";
//                    $_SESSION["bw_auth"] = "true";
                    $_SESSION["bw_fname"] = "$fname";
                    $_SESSION["bw_lname"] = "$lname";
                    $_SESSION["social_id"] = "$userId";
                    $_SESSION["auth_email"] = "$email";
                    $_SESSION["socioProvider"] = "$provider";
                    $_SESSION["bw_type"] = "$provider";
                }
                $stmt->close();
            }
            $stmt1->close();
        }
    } else {
        $countQuery1 = "select provider,user_id from social_con  where  email=?";
        $stmt221 = $con->prepare($countQuery1);
        $stmt221->bind_param('s', $email);
        $stmt221->execute();
        $stmt221->bind_result($providerCount, $socioId);
        $stmt221->store_result();
        $result = array();
        if ($stmt221->fetch()) {
            $countQueryCheck = "select count(*) from social_con  where  email=? and provider_id=? and provider=?";
            $stmtCheck = $con->prepare($countQueryCheck);
            $stmtCheck->bind_param('sss', $email, $id, $provider);
            $stmtCheck->execute();
            $stmtCheck->bind_result($socioCount);
            $stmtCheck->store_result();
            $result = array();
            $stmtCheck->fetch();
            if ($socioCount == 0) {
                $query = "insert into social_con (provider,provider_id,email,f_name,l_name,user_id) values(?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('sssssi', $provider, $id, $email, $fname, $lname, $socioId);
                $result = array();
                if ($stmt->execute()) {
                    $result["err"] = "false";
                    $result["msg"] = "Registered Succesfully!";
//                    $_SESSION["bw_auth"] = "true";
                    $_SESSION["bw_fname"] = "$fname";
                    $_SESSION["bw_lname"] = "$lname";
                    $_SESSION["social_id"] = $socioId;
                    $_SESSION["auth_email"] = "$email";
                    $_SESSION["socioProvider"] = "$providerCount";
                    $_SESSION["bw_type"] = "$provider";
                }
                $stmt->close();
            } else {
                $result["err"] = "false";
                $result["msg"] = "You are existing user, Please login" . " !";
                $_SESSION["social_id"] = $socioId;
                $_SESSION["auth_email"] = "$email";
                $_SESSION["socioProvider"] = "$providerCount";
                $_SESSION["bw_type"] = "$provider";
            }
            $stmtCheck->close();
        }
        $stmt221->close();
    }
    print_r(json_encode($result));
    $stmt22->close();
    $con->close();
} catch (Exception $e) {
    $result = array();
    $result["err"] = "true";
    echo "Error: $e";
    print_r(json_encode($result));
}
