<?php

$imageCheck = $_POST["old_image"];
require("../config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
try {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) { {
            $id = $_SESSION["social_id"];
            $pid = uniqid();
            $allowed = array('jpg', 'jpeg', 'JPG', 'JPEG', 'GIF', 'gif');
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $path1 = 'img/profile_img/' . $id . $pid . "." . $extension;
            $result = array();
            if ((in_array(strtolower($extension), $allowed))) {
                if ($imageCheck) {
                    $filename = (dirname(dirname(__FILE__)) . "/" . $_POST["old_image"]);
                    if (file_exists($filename)) {
                        (unlink(dirname(dirname(__FILE__)) . "/" . $_POST["old_image"]));
                        if (move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path1)) {
                            $query = "update users  set image=? where id=?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('si', $path1, $id);
                            if ($stmt->execute()) {
                                $result = array();
                                $result["status"] = "200";
                                $result["err"] = "false";
                                $result["msg"] = "Changes successfully made";
                            } else {
                                $result["status"] = "120";
                                $result["err"] = "true";
                                $result["msg"] = "Error";
                            }
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "true";
                            $result["msg"] = "Upload Error1, try again later!";
                        }
                    } else {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path1)) {
                            $query = "update users  set image=? where id=?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('si', $path1, $id);
                            if ($stmt->execute()) {
                                $result = array();
                                $result["status"] = "200";
                                $result["err"] = "false";
                                $result["msg"] = "Changes successfully made";
                            } else {
                                $result["status"] = "120";
                                $result["err"] = "true";
                                $result["msg"] = "Error";
                            }
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "true";
                            $result["msg"] = "Upload Error1, try again later!";
                        }
                    }
                } else {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], "../" . $path1)) {
                        $query = "update users  set image=? where id=?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('si', $path1, $id);
                        if ($stmt->execute()) {
                            $result = array();
                            $result["status"] = "200";
                            $result["err"] = "false";
                            $result["msg"] = "Changes successfully made";
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "true";
                            $result["msg"] = "Error";
                        }
                    } else {
                        $result["status"] = "120";
                        $result["err"] = "true";
                        $result["msg"] = "Upload Error1, try again later!";
                    }
                }
            } else {
                $result["status"] = "120";
                $result["err"] = "true";
                $result["msg"] = "Invalid file format for  image";
            }
        }
    } else {
        $result["status"] = "120";
        $result["err"] = "false";
        $result["msg"] = "Invalid file format for  image";
    }
    print_r(json_encode($result));
} catch (Exception $e) {
    $result["status"] = "120";
    $result["err"] = "true";
    $result["msg"] = "Error: $e";
    print_r(json_encode($result));
}
?>
