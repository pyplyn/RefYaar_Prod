<?php

require("../../config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
//if ($_SESSION["admin_role"] == "Super Admin") {
try {
    $QueryEmail = "select email_verified,veri_email from users where id=?";
    $stmtEmail = $con->prepare($QueryEmail);
    $stmtEmail->bind_param('i', $_SESSION["social_id"]);
    $stmtEmail->execute();
    $stmtEmail->bind_result($verifyEmail, $VerifyCode);
    $stmtEmail->store_result();
    $stmtEmail->fetch();
    if ($VerifyCode == 1) {
        $QueryOrg = "select cur_company,func_area from user_profile where user_id=?";
        $stmtOrg = $con->prepare($QueryOrg);
        $stmtOrg->bind_param('i', $_SESSION["social_id"]);
        $stmtOrg->execute();
        $stmtOrg->bind_result($currentOrg, $funcArea);
        $stmtOrg->store_result();
        $stmtOrg->fetch();
        if ($currentOrg == $_POST["organizationName"]) {
            $queryTime = "select count(*) from job_post where post_time >= curdate() - interval 1 month and user_id=?";
            $stmtTime = $con->prepare($queryTime);
            $stmtTime->bind_param('i', $_SESSION["social_id"]);
            $stmtTime->execute();
            $stmtTime->bind_result($timeCount);
            $stmtTime->store_result();
            $stmtTime->fetch();
            if ($timeCount < 10) {
                $querySame = "select count(*) from job_post where post_time >= curdate() - interval 1 month and user_id=? and func_area_id=?";
                $stmtSame = $con->prepare($querySame);
                $stmtSame->bind_param('ii', $_SESSION["social_id"], $funcArea);
                $stmtSame->execute();
                $stmtSame->bind_result($sameCount);
                $stmtSame->store_result();
                $stmtSame->fetch();
                if (($sameCount < 7) || ($funcArea != $_POST["funcArea"])) {
                    $queryDiff = "select count(*) from job_post where post_time >= curdate() - interval 1 month and user_id=? and func_area_id !=?";
                    $stmtDiff = $con->prepare($queryDiff);
                    $stmtDiff->bind_param('ii', $_SESSION["social_id"], $funcArea);
                    $stmtDiff->execute();
                    $stmtDiff->bind_result($diffCount);
                    $stmtDiff->store_result();
                    $stmtDiff->fetch();
                    if (($diffCount < 5) || ($funcArea == $_POST["funcArea"])) {
                        $query = "insert into job_post (user_id,organization,headline,func_area_id,min_req_exp,max_req_exp,city_id,detailed_jd,additional_info) values(?,?,?,?,?,?,?,?,?)";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('issiiiiss', $_SESSION["social_id"], $_POST["organizationName"], $_POST["headline"], $_POST["funcArea"], $_POST["minExp"], $_POST["maxExp"], $_POST["city"], $_POST["detailDesc"], $_POST["additional"]);
                        $result = array();
                        if (!$stmt->execute()) {
                            $result["status"] = "303";
                            $result["err"] = "true";
                            $result["msg"] = "Errors for creating job post";
//        $result["msg"] = $_POST["city-select"];
                        } else {
                            $id = $con->insert_id;
                            if (is_array($_POST["keyword"]) || is_object($_POST["keyword"])) {
                                $i = 0;
                                foreach ($_POST["keyword"] as $key) {
                                    $queryKey = "select id,keyword from keywords where keyword=?";
                                    $stmtKey = $con->prepare($queryKey);
                                    $stmtKey->bind_param('s', $key);
                                    $stmtKey->execute();
                                    $stmtKey->bind_result($keyId, $keyw);
                                    $stmtKey->store_result();
                                    if ($stmtKey->fetch()) {
                                        $query1 = "insert into job_keyword (job_post_id,keyword_id) values(?,?)";
                                        $stmt1 = $con->prepare($query1);
                                        $stmt1->bind_param('ii', $id, $keyId);
                                        $result = array();
                                        if (!$stmt1->execute()) {
                                            $result["status"] = "303";
                                            $result["err"] = "false";
                                            $result["msg"] = "Error for creating keyword";
//                           
                                        } else {
                                            $result["status"] = "200";
                                            $result["err"] = "false";
                                            $result["msg"] = "Job posted succesfully!";
                                        }
                                        $i++;
                                        $stmt1->close();
                                    }
                                    $stmtKey->close();
                                }
//                                else {
//                                $result["status"] = "200";
//                                $result["err"] = "false";
//                                $result["msg"] = "Job posted successfully!";
//                            }
                            } else {
                                $result["status"] = "200";
                                $result["err"] = "false";
                                $result["msg"] = "Job posted Successfully!";
                            }
                        }
                        if (isset($_FILES['jd']) && $_FILES['jd']['error'] == 0) { {
//                                $id = $con->insert_id;
                                $pid = uniqid();
                                $allowed = array('doc', 'DOC', 'docx', 'DOCX', 'pdf', 'PDF');
                                $extension = pathinfo($_FILES['jd']['name'], PATHINFO_EXTENSION);
                                $path1 = 'img/JD/' . $id . $pid . "." . $extension;
                                if ((!in_array(strtolower($extension), $allowed))) {
                                    $result = array();
                                    $result["status"] = "303";
                                    $result["err"] = "true";
                                    $result["msg"] = "Invalid file format for Job Description";
                                } else {
                                    if (move_uploaded_file($_FILES['jd']['tmp_name'], "../../" . $path1)) {
                                        $queryUp = "update job_post  set jd_path=? where id=?";
                                        $stmtUp = $con->prepare($queryUp);
                                        $stmtUp->bind_param('si', $path1, $id);
                                        $result = array();
                                        if ($stmtUp->execute()) {
//                    $result = array();
//                                            $result["status"] = "200";
//                                            $result["err"] = "false";
//                                            $result["msg"] = "Job Posted successfully!";
                                        } else {
                                            $result["status"] = "303";
                                            $result["err"] = "true";
                                            $result["msg"] = "Error";
                                        }

                                        $stmtUp->close();
                                    } else {
                                        $result["status"] = "303";
                                        $result["err"] = "true";
                                        $result["msg"] = "Upload Error1, try again later!";
                                    }
//                                        $stmtUp->close();
                                }
                            }
                        }

//                        $stmt->close();
                    } else {
                        $result["status"] = "402";
                        $result["err"] = "false";
                        $result["msg"] = "You have completed the maximum number of job posts allowed for other functional ares apart from your specified functional area during this month. Kindly try again next month. We appreciate your patience.";
                    }
                    $stmtDiff->close();
                } else {
                    $result["status"] = "403";
                    $result["err"] = "false";
                    $result["msg"] = "You have completed the maximum number of job posts allowed for your specified functional area during this month. Kindly try again next month. We appreciate your patience.";
                }
                $stmtSame->close();
            } else {
                $result["status"] = "201";
                $result["err"] = "true";
                $result["msg"] = "You have completed the maximum number of job posts allowed during this month. Kindly try again next month. We appreciate your patience.";
            }
            $stmtTime->close();
        } else {
            $result["status"] = "301";
            $result["err"] = "true";
            $result["msg"] = "Incorrect organisation name, job post valid only for your registered organisation !";
        }
        $stmtOrg->close();
    } else {
        $result["status"] = "401";
        $result["err"] = "true";
        $result["msg"] = "You are not a verified user, please verify your account.";
    }

    $stmtEmail->close();
    print_r(json_encode($result));
} catch (Exception $e) {
    $result = array();
    $result["err"] = "true";
    $result["msg"] = "Error: $e";
    print_r(json_encode($result));
    $con->close();
}

//} else {
//    $result = array();
//    $result["err"] = "true";
//    $result["msg"] = "Permission not allowed";
//    print_r(json_encode($result));
//}

