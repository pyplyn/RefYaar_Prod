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

    $queryExist = "select count(*) from user_profile where user_id=?";
    $stmtExist = $con->prepare($queryExist);
    $stmtExist->bind_param('i', $_SESSION["social_id"]);
    $stmtExist->execute();
    $stmtExist->bind_result($countSes);
    $stmtExist->store_result();
    $stmtExist->fetch();
    if ($countSes == "0") {

        $con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
        $query = "insert into user_profile(user_id,cur_company,cur_com_since,cur_com_industry,designation,ctc,func_area) values(?,?,?,?,?,?,?)";
        $stmt = $con1->prepare($query);
        $pwd = md5($_POST["password"]);
        $stmt->bind_param('ississi', $_SESSION["social_id"], $_POST["cur-company"], $since, $curIndustry, $designation, $_POST["ctc"], $area);
        $result = array();
        if (!$stmt->execute()) {
            $result["status"] = "403";
            $result["err"] = "true";
            $result["msg"] = "Error for creating user profile";
        } else {
            $j = 0;
            foreach ($_POST["pre-company"] as $previousCompany) {
                if ($previousCompany != "Previous Company Skill") {
                    $query1 = "insert into prev_com(user_id,company,year,pre_com_industry) values(?,?,?,?)";
                    $stmt1 = $con->prepare($query1);
                    $stmt1->bind_param('issi', $_SESSION["social_id"], $previousCompany, $_POST["pre-year"][$j], $_POST["pre-industry"][$j]);
                    if ($stmt1->execute()) {
                        
                    }
                    $stmt1->close();
//                echo "Succesfully creating previous company" . "</br>" . $previousCompany . "/" . $_POST["pre-year"][$j] . "/" . $_POST["pre-industry"][$j];
                }
                $j++;
            }
        }
        $stmt->close();
        $k = 0;
        foreach ($_POST["education"] as $qualification) {
            if ($qualification != "Key Skill") {
                $query2 = "insert into user_edu(user_id,education_id,specialization,percentage,institution_id,_year,edu_type) values(?,?,?,?,?,?,?)";
                $stmt2 = $con->prepare($query2);
                $stmt2->bind_param('iissiis', $_SESSION["social_id"], $qualification, $_POST["edu-specialization"][$k], $_POST["percentage"][$k], $_POST["edu-university"][$k], $_POST["edu-year"][$k], $_POST["edu-type"][$k]);
                if ($stmt2->execute()) {
                    
                }
                $stmt2->close();
//            echo "Successsfully creating user educations" . "</br>" . $qualification . "/" . $_POST["edu-year"][$k] . "/" . $_POST["edu-type"][$k] . "/" . $_POST["edu-university"][$k];
            }
            $k++;
        }
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
//            $countSes == "0"



        $id = $con1->insert_id;
        $pid = uniqid();
        $allowed = array('doc', 'DOC', 'docx', 'DOCX', 'pdf', 'PDF');
        $extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $path1 = 'img/images/' . $id . $pid . "." . $extension;
        if ((!in_array(strtolower($extension), $allowed))) {
            $result = array();
            $result["status"] = "201";
            $result["err"] = "true";
            $result["msg"] = "Invalid file format for  picture";
        } else {
            if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
                $query4 = "update user_profile  set resume=? where id=?";
                $stmt4 = $con->prepare($query4);
                $stmt4->bind_param('si', $path1, $id);
                if ($stmt4->execute()) {
                    $result = array();
                    $result["status"] = "200";
                    $result["err"] = "true";
                    $result["msg"] = "Expertise created successfully!";
                } else {
                    $result["status"] = "201";
                    $result["err"] = "true";
                    $result["msg"] = "Error";
                }
                $stmt4->close();
            } else {
                $result["status"] = "201";
                $result["err"] = "true";
                $result["msg"] = "Upload Error1, try again later!";
            }
        }
        print_r(json_encode($result));
        $con1->close();
//    $stmt->close();
    } else {

        $con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
        $query = "update  user_profile set cur_company=?,cur_com_since=?,cur_com_industry=?,designation=?,ctc=?,func_area=?,last_updated=now() where user_id=?";
        $stmt = $con1->prepare($query);
        $pwd = md5($_POST["password"]);
        $stmt->bind_param('ssissii', $_POST["cur-company"], $since, $curIndustry, $designation, $_POST["ctc"], $area, $_SESSION["social_id"]);
        $result = array();
        if (!$stmt->execute()) {
            $result["status"] = "403";
            $result["err"] = "true";
            $result["msg"] = "Error for creating user profile";
        } else {
            $queryPre = "delete from prev_com where user_id=?";
            $stmtPre = $con->prepare($queryPre);
            $stmtPre->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
            if (!$stmtPre->execute()) {
                $result["status"] = "403";
                $result["err"] = "false";
                $result["msg"] = "Error for deleting previous";
            } else {
                $j = 0;
                foreach ($_POST["pre-company"] as $previousCompany) {
                    if ($previousCompany != "Previous Company Skill") {
                        $query1 = "insert into prev_com(user_id,company,year,pre_com_industry) values(?,?,?,?)";
                        $stmt1 = $con->prepare($query1);
                        $stmt1->bind_param('issi', $_SESSION["social_id"], $previousCompany, $_POST["pre-year"][$j], $_POST["pre-industry"][$j]);
                        if ($stmt1->execute()) {
                            
                        }
                        $stmt1->close();
//                echo "Succesfully creating previous company" . "</br>" . $previousCompany . "/" . $_POST["pre-year"][$j] . "/" . $_POST["pre-industry"][$j];
                    }
                    $j++;
                }
            }
        }
        $stmt->close();

        $queryQua = "delete from user_edu where user_id=?";
        $stmtQua = $con->prepare($queryQua);
        $stmtQua->bind_param('i', $_SESSION["social_id"]);
//    $result = array();
        if (!$stmtQua->execute()) {
            $result["status"] = "403";
            $result["err"] = "false";
            $result["msg"] = "Error for deleting Qualification";
        } else {
            $k = 0;
            foreach ($_POST["education"] as $qualification) {
                if ($qualification != "Key Skill") {
                    $query2 = "insert into user_edu(user_id,education_id,specialization,percentage,institution_id,_year,edu_type) values(?,?,?,?,?,?,?)";
                    $stmt2 = $con->prepare($query2);
                    $stmt2->bind_param('iissiis', $_SESSION["social_id"], $qualification, $_POST["edu-specialization"][$k], $_POST["percentage"][$k], $_POST["edu-university"][$k], $_POST["edu-year"][$k], $_POST["edu-type"][$k]);
                    if ($stmt2->execute()) {
                        
                    }
                    $stmt2->close();
//            echo "Successsfully creating user educations" . "</br>" . $qualification . "/" . $_POST["edu-year"][$k] . "/" . $_POST["edu-type"][$k] . "/" . $_POST["edu-university"][$k];
                }
                $k++;
            }
        }
        $querySkill = "delete from key_skill where user_id=?";
        $stmtSkill = $con->prepare($querySkill);
        $stmtSkill->bind_param('i', $_SESSION["social_id"]);
        $result = array();
        if (!$stmtSkill->execute()) {
            $result["status"] = "403";
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
//                        $stmt3->close();
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
//        $id = $con1->insert_id;
        $id = $_SESSION["social_id"];
        $pid = uniqid();
        $allowed = array('doc', 'DOC', 'docx', 'DOCX', 'pdf', 'PDF');
        $extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $path1 = 'img/images/' . $id . $pid . "." . $extension;
        if ((!in_array(strtolower($extension), $allowed))) {
            $result = array();
            $result["status"] = "201";
            $result["err"] = "true";
            $result["msg"] = "Invalid file format for  picture";
        } else {
            if (move_uploaded_file($_FILES['resume']['tmp_name'], "../" . $path1)) {
                $query4 = "update user_profile  set resume=? where id=?";
                $stmt4 = $con->prepare($query4);
                $stmt4->bind_param('si', $path1, $id);
                if ($stmt4->execute()) {
                    $result = array();
                    $result["status"] = "200";
                    $result["err"] = "true";
                    $result["msg"] = "Expertise created successfully!";
                } else {
                    $result["status"] = "201";
                    $result["err"] = "true";
                    $result["msg"] = "Error";
                }
                $stmt4->close();
            } else {
                $result["status"] = "201";
                $result["err"] = "true";
                $result["msg"] = "Upload Error1, try again later!";
            }
        }
        print_r(json_encode($result));
        $con1->close();
//    $stmt->close();
//        $result["err"] = "true";
//        $result["msg"] = "Already Exist".$countSes;
//        print_r(json_encode($result));
    }
} catch (Exception $e) {
    $result["status"] = "201";
    $result["err"] = "true";
    $result["msg"] = "Error: $e";
    print_r(json_encode($result));
    $con->close();
}