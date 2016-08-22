<?php

require("../config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
//if ($_SESSION["admin_role"] == "Super Admin") {
try {
    $since = $_POST["since"];
    if ($since == "Select") {
        $since = "";
    }
    $curIndustry = $_POST["cur-industry"];
    if ($curIndustry == "Industry") {
        $curIndustry = NULL;
    }
    $area = $_POST["area"];
    if ($area == "Functional Area") {
        $area = NULL;
    }
    $designation = $_POST["designation"];
    if ($designation == "Present Designation") {
        $designation = NULL;
    }
    $graduation = $_POST["graduation"];
    if ($graduation == "Graduation") {
        $graduation = NULL;
        $graSpec = "";
        $graUni = NULL;
        $graYear = "";
        $graType = "";
    } else {
        $graSpec = $_POST["grad-specialization"];
        $graUni = $_POST["grad-university"];
        $graYear = $_POST["grad-year"];
        $graType = $_POST["grad-type"];
    }
    $postGraduation = $_POST["post-graduation"];
    if ($postGraduation == "Post Graduation") {
        $postGraduation = NULL;
        $postSpec = "";
        $postUni = NULL;
        $postYear = "";
        $postType = "";
    } else {
        $postSpec = $_POST["post-specialization"];
        $postUni = $_POST["post-university"];
        $postYear = $_POST["post-year"];
        $postType = $_POST["post-type"];
    }
    $doctorate = $_POST["doctorate"];
    if ($doctorate == "Doctorate") {
        $doctorate = NULL;
        $doctorateSpec = "";
        $doctorateUni = NULL;
        $doctorateYear = "";
        $doctorateType = "";
    } else {
        $doctorateSpec = $_POST["doctorate-specialization"];
        $doctorateUni = $_POST["doctorate-university"];
        $doctorateYear = $_POST["doctorate-year"];
        $doctorateType = $_POST["doctorate-type"];
    }
    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
    $con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
//    $queryDel = "delete from user_profile where user_id=?";
//    $stmtDel = $con->prepare($queryDel);
//    $stmtDel->bind_param('i', $_SESSION["social_id"]);
////    $result = array();
//    if (!$stmtDel->execute()) {
//        echo "Error for deleting user profile";
//    }
//    else {
    $queryId = "select count(*)  from  user_profile where user_id=?";
    $stmtId = $con->prepare($queryId);
    $stmtId->bind_param('i', $_SESSION["social_id"]);
    $stmtId->execute();
    $stmtId->bind_result($idCount);
    $stmtId->store_result();
    $result = array();
    $stmtId->fetch();
    if ($idCount > 0) {
        $query = "update  user_profile set cur_company=?,cur_com_since=?,cur_com_industry=?,designation=?,ctc=?,func_area=?,last_updated=now() where user_id=?";
        $stmt = $con1->prepare($query);
        $pwd = md5($_POST["password"]);
        $stmt->bind_param('ssissii', $_POST["cur-company"], $since, $curIndustry, $designation, $_POST["ctc"], $area, $_SESSION["social_id"]);
        $result = array();
        if (!$stmt->execute()) {
            $result["status"] = "120";
            $result["err"] = "false";
            $result["msg"] = "Error for Updating user profile";
        } else {
            $queryPre = "delete from prev_com where user_id=?";
            $stmtPre = $con->prepare($queryPre);
            $stmtPre->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
            if (!$stmtPre->execute()) {
                $result["status"] = "120";
                $result["err"] = "false";
                $result["msg"] = "Error for deleting previous";
            } else {
                $j = 0;
                foreach ($_POST["pre-company"] as $previousCompany) {
                    if ($previousCompany != "Previous Company") {
                        $query = "insert into prev_com(user_id,company,year,pre_com_industry) values(?,?,?,?)";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('issi', $_SESSION["social_id"], $previousCompany, $_POST["pre-year"][$j], $_POST["pre-industry"][$j]);
                        if ($stmt->execute()) {
                            
                        }
//                        echo "Succesfully creating previous company" . "</br>" . $previousCompany . "/" . $_POST["pre-year"][$j] . "/" . $_POST["pre-industry"][$j];
                    }
                    $j++;
                }
            }
        }
    } else {
        $query = "insert into  user_profile(user_id,cur_company,cur_com_since,cur_com_industry,designation,ctc,func_area) values(?,?,?,?,?,?,?)";
        $stmt = $con1->prepare($query);
        $pwd = md5($_POST["password"]);
        $stmt->bind_param('ississi', $_SESSION["social_id"], $_POST["cur-company"], $since, $curIndustry, $designation, $_POST["ctc"], $area);
        $result = array();
        if (!$stmt->execute()) {
            $result["status"] = "120";
            $result["err"] = "false";
            $result["msg"] = "Error for Updating user profile";
        } else {
            $queryPre = "delete from prev_com where user_id=?";
            $stmtPre = $con->prepare($queryPre);
            $stmtPre->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
            if (!$stmtPre->execute()) {
                $result["status"] = "120";
                $result["err"] = "false";
                $result["msg"] = "Error for deleting previous";
            } else {
                $j = 0;
                foreach ($_POST["pre-company"] as $previousCompany) {
                    if ($previousCompany != "Previous Company") {
                        $query = "insert into prev_com(user_id,company,year,pre_com_industry) values(?,?,?,?)";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('issi', $_SESSION["social_id"], $previousCompany, $_POST["pre-year"][$j], $_POST["pre-industry"][$j]);
                        if ($stmt->execute()) {
                            
                        }
//                        echo "Succesfully creating previous company" . "</br>" . $previousCompany . "/" . $_POST["pre-year"][$j] . "/" . $_POST["pre-industry"][$j];
                    }
                    $j++;
                }
            }
        }
    }
    $queryQua = "delete from user_edu where user_id=?";
    $stmtQua = $con->prepare($queryQua);
    $stmtQua->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
    if (!$stmtQua->execute()) {
        $result["status"] = "120";
        $result["err"] = "false";
        $result["msg"] = "Error for deleting Qualification";
    } else {
        $k = 0;
        foreach ($_POST["education"] as $qualification) {
            if ($qualification != "Key Skill") {
                $query = "insert into user_edu(user_id,education_id,specialization,percentage,institution_id,_year,edu_type) values(?,?,?,?,?,?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('iissiis', $_SESSION["social_id"], $qualification, $_POST["edu-specialization"][$k], $_POST["percentage"][$k], $_POST["edu-university"][$k], $_POST["edu-year"][$k], $_POST["edu-type"][$k]);
                if ($stmt->execute()) {
                    
                }
//                echo "Successsfully creating user educations" . "</br>" . $qualification . "/" . $_POST["edu-year"][$k] . "/" . $_POST["edu-type"][$k] . "/" . $_POST["edu-university"][$k];
            }
            $k++;
        }
    }
    $querySkill = "delete from key_skill where user_id=?";
    $stmtSkill = $con->prepare($querySkill);
    $stmtSkill->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
    if (!$stmtSkill->execute()) {
        $result["status"] = "120";
        $result["err"] = "false";
        $result["msg"] = "Error for deleting Skill";
    } else {
       if (is_array($_POST["skill-area"]) || is_object($_POST["skill-area"])) {
            $i = 0;
            foreach ($_POST["skill-area"] as $key) {
                $queryKey = "select id,keyword from keywords where keyword=?";
                $stmtKey = $con->prepare($queryKey);
                $stmtKey->bind_param('s', $key);
                $stmtKey->execute();
                $stmtKey->bind_result($keyId, $keyw);
                $stmtKey->store_result();
                if ($stmtKey->fetch()) {
                    if (($key != "Key Skill") && ($_POST["skill-year"][$i] > 0)) {
                        $query3 = "insert into key_skill(user_id,key_skill,years) values(?,?,?)";
                        $stmt3 = $con->prepare($query3);
                        $stmt3->bind_param('iss', $_SESSION["social_id"], $keyId, $_POST["skill-year"][$i]);
                        if ($stmt3->execute()) {
                            
                        }
                        $stmt3->close();
//            echo "Skill created successfully" . "</br>" . $key . "/" . $_POST["skill-year"][$i];
                    }
                    $i++;
                } else {
                    $a = "Suspended";
                    $queryWord = "insert into keywords(keyword,status) values(?,?)";
                    $stmtWord = $con->prepare($queryWord);
                    $stmtWord->bind_param('ss', $key, $a);
                    $stmtWord->execute();
                    $keywordID = $con->insert_id;
                    $query3 = "insert into key_skill(user_id,key_skill,years) values(?,?,?)";
                    $stmt3 = $con->prepare($query3);
                    $stmt3->bind_param('iss', $_SESSION["social_id"], $keywordID, $_POST["skill-year"][$i]);
                    if ($stmt3->execute()) {
                        
                    }
                }
            }
        }
    }

//    $id = $_SESSION["social_id"];
//    $pid = uniqid();
//    $allowed = array('doc', 'DOC', 'docx', 'DOCX', 'pdf', 'PDF');
//    $extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
//    $path1 = 'img/images/' . $id . $pid;
//    if ((!in_array(strtolower($extension), $allowed))) {
//        $result = array();
//        echo "Invalid file format for  resume";
//    } else {
//        if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
//            $query = "update user_profile  set resume=? where id=?";
//            $stmt = $con->prepare($query);
//            $stmt->bind_param('si', $path1, $id);
//            if ($stmt->execute()) {
//                $result = array();
//                echo "Profile updated successfully!";
//            } else {
//                echo "Error";
//            }
//        } else {
//            echo "Upload Error1, try again later!";
//        }
//    }
//    $stmt->close();
//
//
//
//
//
    $resumeCheck = $_POST["old_resume"];
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) { {
            $id = $_SESSION["social_id"];
            $pid = uniqid();
            $allowed = array('doc', 'DOC', 'docx', 'DOCX', 'pdf', 'PDF');
            $extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
            $path1 = 'img/images/' . $id . $pid . "." . $extension;
            if ((in_array(strtolower($extension), $allowed))) {
                if ($resumeCheck) {
                    $filename = (dirname(dirname(__FILE__)) . "/" . $_POST["old_resume"]);
                    if (file_exists($filename)) {
                        (unlink(dirname(dirname(__FILE__)) . "/" . $_POST["old_resume"]));


                        if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
                            $query = "update user_profile  set resume=? where user_id=?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('si', $path1, $id);
                            if ($stmt->execute()) {
                                $result = array();
                                $result["status"] = "300";
                                $result["err"] = "false";
                                $result["msg"] = "Changes successfully made";
                            } else {
                                $result["status"] = "120";
                                $result["err"] = "false";
                                $result["msg"] = "Error";
                            }
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "false";
                            $result["msg"] = "Upload Error1, try again later!";
                        }
                    } else {
                        if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
                            $query = "update user_profile  set resume=? where user_id=?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('si', $path1, $id);
                            if ($stmt->execute()) {
                                $result = array();
                                $result["status"] = "300";
                                $result["err"] = "false";
                                $result["msg"] = "Changes successfully made";
                            } else {
                                $result["status"] = "120";
                                $result["err"] = "false";
                                $result["msg"] = "Error";
                            }
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "false";
                            $result["msg"] = "Upload Error1, try again later!";
                        }
                    }
                } else {
                    if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
                        $query = "update user_profile  set resume=? where user_id=?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('si', $path1, $id);
                        if ($stmt->execute()) {
                            $result = array();
                            $result["status"] = "300";
                            $result["err"] = "false";
                            $result["msg"] = "Changes successfully made";
                        } else {
                            $result["status"] = "120";
                            $result["err"] = "false";
                            $result["msg"] = "Error";
                        }
                    } else {
                        $result["status"] = "120";
                        $result["err"] = "false";
                        $result["msg"] = "Upload Error1, try again later!";
                    }
                }
            } else {
                $result["status"] = "120";
                $result["err"] = "false";
                $result["msg"] = "Invalid file format for  resume";
            }
        }
    } else {
        $result["status"] = "300";
        $result["err"] = "false";
        $result["msg"] = "Changes successfully made";
    }
    print_r(json_encode($result));
} catch (Exception $e) {
//    $result["status"] = "120";
    $result["err"] = "false";
    $result["msg"] = "Error: $e";
    print_r(json_encode($result));
}