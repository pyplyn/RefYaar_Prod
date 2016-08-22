<?php
//
require("config.php");
session_start();
ob_start();
?>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Profile | RefYaar</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/theme.css" type="text/css" rel="stylesheet" />
        <link href="css/profile.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/custom/profile.js" type="text/javascript"></script>
        <!--<script src="js/custom/login.js" type="text/javascript"></script>-->
        <script src="includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include './header.php'; ?>
        <div class="page-wrapper">
            <div class="page-container clearfix">
                <div class="col-md-11 col-xs-12 col-sm-11 margin-auto no-padding">
                    <div class="ref-container-left col-md-9">
                        <?php
                        $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                        $query1 = "select e.id,e.title,e.f_name,e.l_name,e.email,e.phone,g.country,a.user_id,a.cur_company,a.cur_com_since,a.ctc,a.resume,a.cur_com_industry,b.industry,a.func_area, a.designation from user_profile a , industry b, func_area c, designation d, users e,  location__country g where b.id=a.cur_com_industry and c.id=a.func_area and d.id=a.designation and a.user_id=e.id and e.country=g.id  and e.id=?";
                        $stmt1 = $con->prepare($query1);
                        $stmt1->bind_param('i', $_SESSION["social_id"]);
                        $stmt1->execute();
                        $stmt1->bind_result($id, $title, $fname, $lname, $email, $mobile, $country, $userId, $curCompnay, $curSince, $ctc, $resume, $currentIndustry, $curIndustry, $area, $designation);
                        $stmt1->store_result();
                        if ($stmt1->fetch()) {
                            
                        }
                        ?>
                        <div class="panel panel-default panel-personal">
                            <span class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>
                            <div class="panel-body clearfix">
                                <div class="col-xs-12 col-md-3 clearfix">
                                    <div class="thumbnail text-center">
                                        <img src="img/default/home-banner/bg.jpg" class="img-responsive"/>
                                        <label>
                                            (Upload Photo)
                                            <input type="file" class="hidden" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-5">
                                    <h3>Welcome <?= $title ?> <?= $fname ?> <?= $lname ?></h3>
                                    <div class="personal-section">
                                        <span class="fa fa-envelope-o icon-left"></span> <?= $email ?>
                                    </div>
                                    <div class="personal-section">
                                        <span class="fa fa-phone icon-left"></span> +91 <?= $mobile ?>
                                    </div>
                                    <div class="personal-section">
                                        <span class="fa fa-home icon-left"></span> New Delhi, <?= $state ?>, <?= $country ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="col-md-12 no-padding">
                                        <span id="fb-login-btn" class="login-btn-sqr active">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-facebook">

                                                </span>
                                            </span>
                                            <span class="login-btn-text">
                                                Connected with Facebook
                                            </span>
                                        </span>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 no-padding">
                                        <span class="login-btn-sqr">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-twitter">

                                                </span>
                                            </span>
                                            <span class="login-btn-text">
                                                Connect with Twitter
                                            </span>
                                        </span>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 no-padding">
                                        <span class="login-btn-sqr">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-linkedin">

                                                </span>
                                            </span>
                                            <span class="login-btn-text">
                                                Connect with LinkedIn
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="post" id="update-profile"  action="src/update-profile.php">
                            <div class="panel panel-default panel-expertise">
                                <div class="panel-body clearfix">
                                    <span class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>
                                    <div id="expertise-error" class="alert alert-danger hidden"></div>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <input type="text" id="cur-company" name="cur-company" class="form-control ref-form-control" value="<?= $curCompnay ?>" placeholder="Current Company">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-2 ref-form-label no-padding">
                                                Since
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <select id="since" name="since" class="form-control ref-form-control">
                                                    <option>Select</option>
                                                    <option>
                                                        <?= $curSince ?>
                                                    </option>
                                                    <option <?php
                                                    if ($curSince == "1990") {
                                                        echo "selected";
                                                    }
                                                    ?>>1990</option>
                                                    <option <?php
                                                    if ($curSince == "1991") {
                                                        echo "selected";
                                                    }
                                                    ?>>1991</option>
                                                    <option <?php
                                                    if ($curSince == "1992") {
                                                        echo "selected";
                                                    }
                                                    ?>>1992</option>
                                                    <option <?php
                                                    if ($curSince == "1993") {
                                                        echo "selected";
                                                    }
                                                    ?>>1993</option>

                                                    <option <?php
                                                    if ($curSince == "1994") {
                                                        echo "selected";
                                                    }
                                                    ?>>1994</option>
                                                    <option <?php
                                                    if ($curSince == "1995") {
                                                        echo "selected";
                                                    }
                                                    ?>>1995</option>
                                                    <option <?php
                                                    if ($curSince == "1996") {
                                                        echo "selected";
                                                    }
                                                    ?>>1996</option>

                                                    <option <?php
                                                    if ($curSince == "1997") {
                                                        echo "selected";
                                                    }
                                                    ?>>1997</option>
                                                    <option <?php
                                                    if ($curSince == "1998") {
                                                        echo "selected";
                                                    }
                                                    ?>>1998</option>
                                                    <option <?php
                                                    if ($curSince == "1999") {
                                                        echo "selected";
                                                    }
                                                    ?>>1999</option>

                                                    <option <?php
                                                    if ($curSince == "2000") {
                                                        echo "selected";
                                                    }
                                                    ?>>2000</option>
                                                    <option <?php
                                                    if ($curSince == "2001") {
                                                        echo "selected";
                                                    }
                                                    ?>>2001</option>
                                                    <option <?php
                                                    if ($curSince == "2002") {
                                                        echo "selected";
                                                    }
                                                    ?>>2002</option>

                                                    <option <?php
                                                    if ($curSince == "2003") {
                                                        echo "selected";
                                                    }
                                                    ?>>2003</option>
                                                    <option <?php
                                                    if ($curSince == "2004") {
                                                        echo "selected";
                                                    }
                                                    ?>>2004</option>
                                                    <option <?php
                                                    if ($curSince == "2005") {
                                                        echo "selected";
                                                    }
                                                    ?>>2005</option>
                                                    <option <?php
                                                    if ($curSince == "2006") {
                                                        echo "selected";
                                                    }
                                                    ?>>2006</option>
                                                    <option <?php
                                                    if ($curSince == "2007") {
                                                        echo "selected";
                                                    }
                                                    ?>>2007</option>
                                                    <option <?php
                                                    if ($curSince == "2008") {
                                                        echo "selected";
                                                    }
                                                    ?>>2008</option>
                                                    <option <?php
                                                    if ($curSince == "2009") {
                                                        echo "selected";
                                                    }
                                                    ?>>2009</option>
                                                    <option <?php
                                                    if ($curSince == "2010") {
                                                        echo "selected";
                                                    }
                                                    ?>>2010</option>
                                                    <option <?php
                                                    if ($curSince == "2011") {
                                                        echo "selected";
                                                    }
                                                    ?>>2011</option>
                                                    <option <?php
                                                    if ($curSince == "2012") {
                                                        echo "selected";
                                                    }
                                                    ?>>2012</option>
                                                    <option <?php
                                                    if ($curSincer == "2013") {
                                                        echo "selected";
                                                    }
                                                    ?>>2013</option>
                                                    <option <?php
                                                    if ($curSince == "2014") {
                                                        echo "selected";
                                                    }
                                                    ?>>2014</option>
                                                    <option <?php
                                                    if ($curSince == "2015") {
                                                        echo "selected";
                                                    }
                                                    ?>>2015</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 no-padding">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <select id="cur-industry" name="cur-industry" class="form-control ref-form-control">
                                                    <option>Industry</option>
                                                    <?php
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($indusId, $industry);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        $selected = "";
                                                        if ($indusId == $currentIndustry) {
                                                            $selected = "selected";
                                                        }
                                                        echo "<option value='$indusId' $selected>$industry</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <?php
                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                    $query1 = "select id, user_id,company,year,pre_com_industry from  prev_com where user_id=?";
                                    $stmt1 = $con->prepare($query1);
                                    $stmt1->bind_param('i', $_SESSION["social_id"]);
                                    $stmt1->execute();
                                    $stmt1->bind_result($id, $preUserId, $preCompany, $preYear, $preIndustry);
                                    $stmt1->store_result();
                                    while ($stmt1->fetch()) {
                                        ?>
                                        <div class="ref-form-box clearfix">

                                            <div class="col-md-6">
                                                <input type="text" id="pre-company" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company" value="<?= $preCompany ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="pre1" id="pre1" value="<?= $id ?>">
                                                <div class="col-md-2 ref-form-label no-padding">
                                                    Years
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text"  id="pre-year"  name="pre-year[]" class="form-control ref-form-control" value="<?= $preYear ?>" />
                                                </div>
                                                <div class="col-md-1 no-padding">

                                                </div>
                                                <div class="col-md-5 no-padding ref-form-elt">
                                                    <select id="pre-industry" name="pre-industry[]" class="form-control ref-form-control">
                                                        <option>Industry</option>
                                                        <?php
                                                        require("config.php");
                                                        $con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                        $query11 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt11 = $con1->prepare($query11);
                                                        $stmt11->execute();
                                                        $stmt11->bind_result($preIndusId, $preIndus);
                                                        $stmt11->store_result();
                                                        while ($stmt11->fetch()) {
                                                            $selected = "";
                                                            if ($preIndusId == $preIndustry) {
                                                                $selected = "selected";
                                                            }
                                                            echo "<option value='$preIndusId' $selected>$preIndus</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <br/>
                                        <?php
                                    }
//                                    $stmt1->close();
//                                    $con->close();
                                    ?>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <input type="text" id="pre-company" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company">
                                        </div>
                                        <div class="col-md-6 ref-form-elt">
                                            <div class="col-md-2 ref-form-label no-padding">
                                                Years
                                            </div>
                                            <div  class="col-md-2 no-padding">
                                                <input type="text" id="pre-year"  name="pre-year[]" class="form-control ref-form-control" />
                                            </div>
                                            <div class="col-md-1 no-padding ref-form-elt hidden-xs">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <select id="pre-industry" name="pre-industry[]" class="form-control ref-form-control">
                                                    <option>
                                                        Industry
                                                    </option>
                                                    <?php
                                                    require './config.php   ';
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($indusId, $industry);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$indusId'>$industry</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-md-2 no-padding ref-form-elt">
                                                <div id="add1" class="yellow-btn ref-plus-btn">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="pre-another2" class="ref-form-box clearfix hidden">
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="pre-company2" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company">
                                        </div>
                                        <div class="col-md-6 ref-form-elt">
                                            <div class="col-md-2 ref-form-label no-padding">
                                                Years
                                            </div>
                                            <div  class="col-md-2 no-padding ref-form-elt">
                                                <input type="text" id="pre-year2"  name="pre-year[]" class="form-control ref-form-control" />
                                            </div>
                                            <div class="col-md-1 no-padding">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <select id="pre-industry2" name="pre-industry[]" class="form-control ref-form-control">
                                                    <option>
                                                        Industry
                                                    </option>
                                                    <?php
                                                    require './config.php   ';
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($indusId, $industry);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$indusId'>$industry</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-md-2 no-padding ref-form-elt text-center">
                                                <div id="add2" class="yellow-btn ref-plus-btn">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="pre-another3" class="ref-form-box clearfix hidden">
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="pre-company3" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-2 ref-form-label no-padding ref-form-elt">
                                                Years
                                            </div>
                                            <div  class="col-md-2 no-padding ref-form-elt">
                                                <input type="text" id="pre-year3"  name="pre-year[]" class="form-control ref-form-control" />
                                            </div>
                                            <div class="col-md-1 no-padding ref-form-elt">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <select id="pre-industry3" name="pre-industry[]" class="form-control ref-form-control">
                                                    <option>
                                                        Industry
                                                    </option>
                                                    <?php
                                                    require './config.php   ';
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($indusId, $industry);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$indusId'>$industry</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-md-2 no-padding ref-form-elt text-center">
                                                <div id="add3" class="yellow-btn ref-plus-btn">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="pre-another4" class="ref-form-box clearfix hidden">
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="pre-company3" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-2 ref-form-label no-padding ref-form-elt">
                                                Years
                                            </div>
                                            <div  class="col-md-2 no-padding ref-form-elt">
                                                <input type="text" id="pre-year3"  name="pre-year[]" class="form-control ref-form-control" />
                                            </div>
                                            <div class="col-md-1 no-padding ref-form-elt">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <select id="pre-industry3" name="pre-industry[]" class="form-control ref-form-control">
                                                    <option>
                                                        Industry
                                                    </option>
                                                    <?php
                                                    require './config.php   ';
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($indusId, $industry);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$indusId'>$industry</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Designation
                                            </div>
                                            <select id="designation" name="designation" class="form-control ref-form-control">
                                                <option>
                                                    Present Designation
                                                </option>                                               
                                                <?php
                                                $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query1 = "select id, designation from  designation where status='Active' order by designation";
                                                $stmt1 = $con->prepare($query1);
                                                $stmt1->execute();
                                                $stmt1->bind_result($desigId, $desig);
                                                $stmt1->store_result();
                                                while ($stmt1->fetch()) {
                                                    $selected = "";
                                                    if ($desigId == $designation) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$desigId' $selected>$desig</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="ref-form-sub-text">
                                            &nbsp;&nbsp; CTC
                                        </div>
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="ctc" name="ctc" class="form-control ref-form-control" value="<?= round($ctc) ?>" placeholder="CTC">
                                        </div>

                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Functional Area
                                            </div>
                                            <select id="area" name="area" class="form-control ref-form-control">
                                                <option>
                                                    Functional Area
                                                </option>
                                                <?php
                                                $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query1 = "select id, area from  func_area where status='Active' order by area";
                                                $stmt1 = $con->prepare($query1);
                                                $stmt1->execute();
                                                $stmt1->bind_result($funcId, $area1);
                                                $stmt1->store_result();
                                                while ($stmt1->fetch()) {
                                                    $selected = "";
                                                    if ($funcId == $area) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$funcId' $selected>$area1</option>";
                                                }
                                                $stmt1->close();
                                                $con->close();
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="ref-form-sub-text col-xs-12 clearfix">
                                            Key Skills & Experience in the skill ( Years )
                                        </div>
                                        <?php
                                        $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $query1 = "select id, key_skill,years from  key_skill where user_id=? ";
                                        $stmt1 = $con->prepare($query1);
                                        $stmt1->bind_param('i', $_SESSION["social_id"]);
                                        $stmt1->execute();
                                        $stmt1->bind_result($keyId, $keySkill, $keyYear);
                                        $stmt1->store_result();
                                        while ($stmt1->fetch()) {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="col-md-7 no-padding">
                                                    <select id="skill-area"  name="skill-area[]" class="form-control ref-form-control">
                                                        <option>
                                                            Key Skill
                                                        </option>                                                       
                                                        <?php
                                                        $con12 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                        $query12 = "select id, area from  func_area where status='Active' order by area";
                                                        $stmt12 = $con12->prepare($query12);
                                                        $stmt12->execute();
                                                        $stmt12->bind_result($funcId, $area1);
                                                        $stmt12->store_result();
                                                        while ($stmt12->fetch()) {
                                                            $selected = "";
                                                            if ($funcId == $keySkill) {
                                                                $selected = "selected";
                                                            }
                                                            echo "<option value='$funcId' $selected>$area1</option>";
                                                        }
                                                        $stmt12->close();
                                                        $con12->close();
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year" name="skill-year[]" class="form-control ref-form-control" value="<?= $keyYear ?>" />
                                                </div>
                                            </div>

                                            <?php
                                        }

                                        $stmt1->close();
                                        $con->close();
                                        ?>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="col-md-7 no-padding ref-form-elt">
                                                <select id="skill-area" name="skill-area[]" class="form-control ref-form-control">
                                                    <option>
                                                        Key Skill
                                                    </option>
                                                    <?php
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, area from  func_area where status='Active' order by area";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($funcId3, $area3);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$funcId3'>$area3</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>
                                                </select>
                                                </select>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                Year/s
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="text" id="skill-year" name="skill-year[]" class="form-control ref-form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-7 no-padding ref-form-elt">
                                                <select id="skill-area4" name="skill-area[]" class="form-control ref-form-control">
                                                    <option>
                                                        Key Skill
                                                    </option>
                                                    <?php
                                                    $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                    $query1 = "select id, area from  func_area where status='Active' order by area";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($funcId4, $area4);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$funcId4'>$area4</option>";
                                                    }
                                                    $stmt1->close();
                                                    $con->close();
                                                    ?>
                                                </select>
                                                </select>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                Year/s
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="text" id="skill-year4" name="skill-year[]" class="form-control ref-form-control"/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div class="ref-form-box clearfix">
                                        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                            Education
                                        </div>
                                        <?php
                                        $con112 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $query112 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Graduation' and a.user_id=? ";
                                        $stmt112 = $con112->prepare($query112);
                                        $stmt112->bind_param('i', $_SESSION["social_id"]);
                                        $stmt112->execute();
                                        $stmt112->bind_result($gradId, $eduGradId, $gradSpecialization, $gradPercentage, $gradInstId, $gradYear, $gradTypeID, $gradDegree, $gradEduType);
                                        $stmt112->store_result();
                                        while ($stmt112->fetch()) {
                                            
                                        }
                                        $stmt112->close();
                                        $con112->close();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Basic/Graduation
                                            </div>
                                            <select id="graduation" name="education[]" class="form-control ref-form-control">
                                                <option>
                                                    Graduation
                                                </option>
                                                <?php
                                                $con122 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query122 = "select id, degree from  education where status='Active' and edu_type='Graduation' order by degree";
                                                $stmt122 = $con122->prepare($query122);
                                                $stmt122->execute();
                                                $stmt122->bind_result($gradDegreeId, $gradDegree);
                                                $stmt122->store_result();
                                                while ($stmt122->fetch()) {
                                                    $selected = "";
                                                    if ($gradDegreeId == $eduGradId) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$gradDegreeId' $selected>$gradDegree</option>";
                                                }
                                                $stmt122->close();
                                                $con122->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Specialization
                                            </div>
    <!--                                            <select class="form-control ref-form-control">
                                                <option>
                                                    Computer Science
                                                </option>
                                            </select>-->
                                            <input id="grad-specialization" name="edu-specialization[]" type="text" class="form-control ref-form-control" value="<?= $gradSpecialization ?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                %
                                            </div>
                                            <input type="text" id="percentage" name="percentage[]" class="form-control ref-form-control" value="<?= $gradPercentage ?>"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                University/Institute
                                            </div>
                                            <select id="grad-university" name="edu-university[]" class="form-control ref-form-control">
                                                <option>
                                                    University/Institute
                                                </option>
                                                <?php
                                                $con122 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query122 = "select id, institution from  institution where status='Active'";
                                                $stmt122 = $con122->prepare($query122);
                                                $stmt122->execute();
                                                $stmt122->bind_result($gradInst, $gradInstitute);
                                                $stmt122->store_result();
                                                while ($stmt122->fetch()) {
                                                    $selected = "";
                                                    if ($gradInst == $gradInstId) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$gradInst' $selected>$gradInstitute</option>";
                                                }
                                                $stmt122->close();
                                                $con122->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Year
                                            </div>
                                            <select id="grad-year" name="edu-year[]" class="form-control ref-form-control">
                                                <option <?php
                                                if ($gradYear == "1990") {
                                                    echo "selected";
                                                }
                                                ?>>1990</option>

                                                <option <?php
                                                if ($gradYear == "1991") {
                                                    echo "selected";
                                                }
                                                ?>>1991</option>
                                                <option <?php
                                                if ($gradYear == "1992") {
                                                    echo "selected";
                                                }
                                                ?>>1992</option>
                                                <option <?php
                                                if ($gradYear == "1993") {
                                                    echo "selected";
                                                }
                                                ?>>1993</option>

                                                <option <?php
                                                if ($gradYear == "1994") {
                                                    echo "selected";
                                                }
                                                ?>>1994</option>
                                                <option <?php
                                                if ($gradYear == "1995") {
                                                    echo "selected";
                                                }
                                                ?>>1995</option>
                                                <option <?php
                                                if ($gradYear == "1996") {
                                                    echo "selected";
                                                }
                                                ?>>1996</option>

                                                <option <?php
                                                if ($gradYear == "1997") {
                                                    echo "selected";
                                                }
                                                ?>>1997</option>
                                                <option <?php
                                                if ($gradYear == "1998") {
                                                    echo "selected";
                                                }
                                                ?>>1998</option>
                                                <option <?php
                                                if ($gradYear == "1999") {
                                                    echo "selected";
                                                }
                                                ?>>1999</option>

                                                <option <?php
                                                if ($gradYear == "2000") {
                                                    echo "selected";
                                                }
                                                ?>>2000</option>
                                                <option <?php
                                                if ($gradYear == "2001") {
                                                    echo "selected";
                                                }
                                                ?>>2001</option>
                                                <option <?php
                                                if ($gradYear == "2002") {
                                                    echo "selected";
                                                }
                                                ?>>2002</option>

                                                <option <?php
                                                if ($gradYear == "2003") {
                                                    echo "selected";
                                                }
                                                ?>>2003</option>
                                                <option <?php
                                                if ($gradYear == "2004") {
                                                    echo "selected";
                                                }
                                                ?>>2004</option>
                                                <option <?php
                                                if ($gradYear == "2005") {
                                                    echo "selected";
                                                }
                                                ?>>2005</option>
                                                <option <?php
                                                if ($gradYear == "2006") {
                                                    echo "selected";
                                                }
                                                ?>>2006</option>
                                                <option <?php
                                                if ($gradYear == "2007") {
                                                    echo "selected";
                                                }
                                                ?>>2007</option>
                                                <option <?php
                                                if ($gradYear == "2008") {
                                                    echo "selected";
                                                }
                                                ?>>2008</option>
                                                <option <?php
                                                if ($gradYear == "2009") {
                                                    echo "selected";
                                                }
                                                ?>>2009</option>
                                                <option <?php
                                                if ($gradYear == "2010") {
                                                    echo "selected";
                                                }
                                                ?>>2010</option>
                                                <option <?php
                                                if ($gradYear == "2011") {
                                                    echo "selected";
                                                }
                                                ?>>2011</option>
                                                <option <?php
                                                if ($gradYear == "2012") {
                                                    echo "selected";
                                                }
                                                ?>>2012</option>
                                                <option <?php
                                                if ($gradYear == "2013") {
                                                    echo "selected";
                                                }
                                                ?>>2013</option>
                                                <option <?php
                                                if ($gradYear == "2014") {
                                                    echo "selected";
                                                }
                                                ?>>2014</option>
                                                <option <?php
                                                if ($gradYear == "2015") {
                                                    echo "selected";
                                                }
                                                ?>>2015</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Type
                                            </div>
                                            <select id="grad-type" name="edu-type[]" class="form-control ref-form-control">
                                                <option>
                                                    Type
                                                </option>
                                                <option <?php
                                                if ($gradTypeID == "Full Time") {
                                                    echo "selected";
                                                }
                                                ?>>Full Time</option>

                                                <option <?php
                                                if ($gradTypeID == "Part Time") {
                                                    echo "selected";
                                                }
                                                ?>>Part Time</option>
                                                <option <?php
                                                if ($gradTypeID == "Correspondence") {
                                                    echo "selected";
                                                }
                                                ?>>Correspondence</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div class="ref-form-box clearfix">
                                        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                            Education
                                        </div>
                                        <?php
                                        $con12 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $query12 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Post Graduation' and a.user_id=? ";
                                        $stmt12 = $con12->prepare($query12);
                                        $stmt12->bind_param('i', $_SESSION["social_id"]);
                                        $stmt12->execute();
                                        $stmt12->bind_result($postId, $eduPostId, $postSpecialization, $postPercentage, $postInstId, $postYear, $postTypeID, $postDegree, $postEduType);
                                        $stmt12->store_result();
                                        while ($stmt12->fetch()) {
                                            
                                        }
                                        $stmt12->close();
                                        $con12->close();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Post Graduation
                                            </div>
                                            <select id="post-graduation" name="education[]" class="form-control ref-form-control">
                                                <option>
                                                    Post Graduation
                                                </option>
                                                <?php
                                                $con122 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query122 = "select id, degree from  education where status='Active' and edu_type='Post Graduation' order by degree";
                                                $stmt122 = $con122->prepare($query122);
                                                $stmt122->execute();
                                                $stmt122->bind_result($postDegreeId, $postDegree);
                                                $stmt122->store_result();
                                                while ($stmt122->fetch()) {
                                                    $selected = "";
                                                    if ($postDegreeId == $eduPostId) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$postDegreeId' $selected>$postDegree</option>";
                                                }
                                                $stmt122->close();
                                                $con122->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Specialization
                                            </div>
                                            <input type="text" id="post-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $postSpecialization ?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                %
                                            </div>
                                            <input type="text" id="post-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $postPercentage ?>"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                University/Institute
                                            </div>
                                            <select id="post-university" name="edu-university[]" class="form-control ref-form-control">
                                                <option>
                                                    University/Institute
                                                </option>
                                                <?php
                                                $con122 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query122 = "select id, institution from  institution where status='Active'";
                                                $stmt122 = $con122->prepare($query122);
                                                $stmt122->execute();
                                                $stmt122->bind_result($postInst, $postInstitute);
                                                $stmt122->store_result();
                                                while ($stmt122->fetch()) {
                                                    $selected = "";
                                                    if ($postInst == $postInstId) {
                                                        $selected = "selected";
                                                    }
                                                    echo "<option value='$postInst' $selected>$postInstitute</option>";
                                                }
                                                $stmt122->close();
                                                $con122->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Year
                                            </div>
                                            <select id="post-year" name="edu-year[]" class="form-control ref-form-control">
                                                <option <?php
                                                if ($postYear == "1990") {
                                                    echo "selected";
                                                }
                                                ?>>1990</option>

                                                <option <?php
                                                if ($postYear == "1991") {
                                                    echo "selected";
                                                }
                                                ?>>1991</option>
                                                <option <?php
                                                if ($postYear == "1992") {
                                                    echo "selected";
                                                }
                                                ?>>1992</option>
                                                <option <?php
                                                if ($postYear == "1993") {
                                                    echo "selected";
                                                }
                                                ?>>1993</option>

                                                <option <?php
                                                if ($postYear == "1994") {
                                                    echo "selected";
                                                }
                                                ?>>1994</option>
                                                <option <?php
                                                if ($postYear == "1995") {
                                                    echo "selected";
                                                }
                                                ?>>1995</option>
                                                <option <?php
                                                if ($postYear == "1996") {
                                                    echo "selected";
                                                }
                                                ?>>1996</option>

                                                <option <?php
                                                if ($postYear == "1997") {
                                                    echo "selected";
                                                }
                                                ?>>1997</option>
                                                <option <?php
                                                if ($postYear == "1998") {
                                                    echo "selected";
                                                }
                                                ?>>1998</option>
                                                <option <?php
                                                if ($postYear == "1999") {
                                                    echo "selected";
                                                }
                                                ?>>1999</option>

                                                <option <?php
                                                if ($postYear == "2000") {
                                                    echo "selected";
                                                }
                                                ?>>2000</option>
                                                <option <?php
                                                if ($postYear == "2001") {
                                                    echo "selected";
                                                }
                                                ?>>2001</option>
                                                <option <?php
                                                if ($postYear == "2002") {
                                                    echo "selected";
                                                }
                                                ?>>2002</option>

                                                <option <?php
                                                if ($postYear == "2003") {
                                                    echo "selected";
                                                }
                                                ?>>2003</option>
                                                <option <?php
                                                if ($postYear == "2004") {
                                                    echo "selected";
                                                }
                                                ?>>2004</option>
                                                <option <?php
                                                if ($postYear == "2005") {
                                                    echo "selected";
                                                }
                                                ?>>2005</option>
                                                <option <?php
                                                if ($postYear == "2006") {
                                                    echo "selected";
                                                }
                                                ?>>2006</option>
                                                <option <?php
                                                if ($postYear == "2007") {
                                                    echo "selected";
                                                }
                                                ?>>2007</option>
                                                <option <?php
                                                if ($postYear == "2008") {
                                                    echo "selected";
                                                }
                                                ?>>2008</option>
                                                <option <?php
                                                if ($postYear == "2009") {
                                                    echo "selected";
                                                }
                                                ?>>2009</option>
                                                <option <?php
                                                if ($postYear == "2010") {
                                                    echo "selected";
                                                }
                                                ?>>2010</option>
                                                <option <?php
                                                if ($postYear == "2011") {
                                                    echo "selected";
                                                }
                                                ?>>2011</option>
                                                <option <?php
                                                if ($postYear == "2012") {
                                                    echo "selected";
                                                }
                                                ?>>2012</option>
                                                <option <?php
                                                if ($postYear == "2013") {
                                                    echo "selected";
                                                }
                                                ?>>2013</option>
                                                <option <?php
                                                if ($postYear == "2014") {
                                                    echo "selected";
                                                }
                                                ?>>2014</option>
                                                <option <?php
                                                if ($postYear == "2015") {
                                                    echo "selected";
                                                }
                                                ?>>2015</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Type
                                            </div>

                                            <select id="post-type" name="edu-type[]" class="form-control ref-form-control">
                                                <option <?php
                                                if ($postTypeID == "Full Time") {
                                                    echo "selected";
                                                }
                                                ?>>Full Time</option>

                                                <option <?php
                                                if ($postTypeID == "Part Time") {
                                                    echo "selected";
                                                }
                                                ?>>Part Time</option>
                                                <option <?php
                                                if ($postTypeID == "Correspondence") {
                                                    echo "selected";
                                                }
                                                ?>>Correspondence</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div  class=" ref-form-box clearfix">
                                        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                            Education
                                        </div>
                                        <?php
                                        $con12 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $query12 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
                                        $stmt12 = $con12->prepare($query12);
                                        $stmt12->bind_param('i', $_SESSION["social_id"]);
                                        $stmt12->execute();
                                        $stmt12->bind_result($docId, $eduDocId, $docSpecialization, $docPercentage, $docInstId, $docYear, $docTypeID, $docDegree, $docEduType);
                                        $stmt12->store_result();
                                        while ($stmt12->fetch()) {
                                            
                                        }
                                        $stmt12->close();
                                        $con12->close();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Doctorate
                                            </div>
                                            <select id="doctorate" name="education[]" class="form-control ref-form-control">
                                                <option>
                                                    Doctorate
                                                </option>
                                                <?php
                                                $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query1 = "select id, degree, edu_type from  education where status='Active' and edu_type='Doctorate' order by degree";
                                                $stmt1 = $con->prepare($query1);
                                                $stmt1->execute();
                                                $stmt1->bind_result($doctorateId, $doctorate, $doctorateType);
                                                $stmt1->store_result();
                                                while ($stmt1->fetch()) {

                                                    echo "<option value='$doctorateId'>$doctorate</option>";
                                                }
                                                $stmt1->close();
                                                $con->close();
                                                ?>                          
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Specialization
                                            </div>
                                            <input type="text" id="doc-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $docSpecialization ?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                %
                                            </div>
                                            <input type="text" id="doc-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $docPercentage ?>"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                University/Institute
                                            </div>
                                            <select id="doc-university" name="edu-university[]" class="form-control ref-form-control">
                                                <option>
                                                    University/Institute
                                                </option>
                                                <?php
                                                $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $query1 = "select id,  institution from   institution where status='Active' order by  institution";
                                                $stmt1 = $con->prepare($query1);
                                                $stmt1->execute();
                                                $stmt1->bind_result($docId, $docInstitution);
                                                $stmt1->store_result();
                                                while ($stmt1->fetch()) {

                                                    echo "<option value='$docId'>$docInstitution</option>";
                                                }
                                                $stmt1->close();
                                                $con->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Year
                                            </div>
                                            <select id="doctorate-year" name="edu-year[]" class="form-control ref-form-control">
                                                <option>Year</option>
                                                <option <?php
                                                if ($docYear == "1990") {
                                                    echo "selected";
                                                }
                                                ?>>1990</option>

                                                <option <?php
                                                if ($docYear == "1991") {
                                                    echo "selected";
                                                }
                                                ?>>1991</option>
                                                <option <?php
                                                if ($docYear == "1992") {
                                                    echo "selected";
                                                }
                                                ?>>1992</option>
                                                <option <?php
                                                if ($docYear == "1993") {
                                                    echo "selected";
                                                }
                                                ?>>1993</option>

                                                <option <?php
                                                if ($docYear == "1994") {
                                                    echo "selected";
                                                }
                                                ?>>1994</option>
                                                <option <?php
                                                if ($docYear == "1995") {
                                                    echo "selected";
                                                }
                                                ?>>1995</option>
                                                <option <?php
                                                if ($docYear == "1996") {
                                                    echo "selected";
                                                }
                                                ?>>1996</option>

                                                <option <?php
                                                if ($docYear == "1997") {
                                                    echo "selected";
                                                }
                                                ?>>1997</option>
                                                <option <?php
                                                if ($docYear == "1998") {
                                                    echo "selected";
                                                }
                                                ?>>1998</option>
                                                <option <?php
                                                if ($docYear == "1999") {
                                                    echo "selected";
                                                }
                                                ?>>1999</option>

                                                <option <?php
                                                if ($docYear == "2000") {
                                                    echo "selected";
                                                }
                                                ?>>2000</option>
                                                <option <?php
                                                if ($docYear == "2001") {
                                                    echo "selected";
                                                }
                                                ?>>2001</option>
                                                <option <?php
                                                if ($docYear == "2002") {
                                                    echo "selected";
                                                }
                                                ?>>2002</option>

                                                <option <?php
                                                if ($docYear == "2003") {
                                                    echo "selected";
                                                }
                                                ?>>2003</option>
                                                <option <?php
                                                if ($docYear == "2004") {
                                                    echo "selected";
                                                }
                                                ?>>2004</option>
                                                <option <?php
                                                if ($docYear == "2005") {
                                                    echo "selected";
                                                }
                                                ?>>2005</option>
                                                <option <?php
                                                if ($docYear == "2006") {
                                                    echo "selected";
                                                }
                                                ?>>2006</option>
                                                <option <?php
                                                if ($docYear == "2007") {
                                                    echo "selected";
                                                }
                                                ?>>2007</option>
                                                <option <?php
                                                if ($docYear == "2008") {
                                                    echo "selected";
                                                }
                                                ?>>2008</option>
                                                <option <?php
                                                if ($docYear == "2009") {
                                                    echo "selected";
                                                }
                                                ?>>2009</option>
                                                <option <?php
                                                if ($docYear == "2010") {
                                                    echo "selected";
                                                }
                                                ?>>2010</option>
                                                <option <?php
                                                if ($docYear == "2011") {
                                                    echo "selected";
                                                }
                                                ?>>2011</option>
                                                <option <?php
                                                if ($docYear == "2012") {
                                                    echo "selected";
                                                }
                                                ?>>2012</option>
                                                <option <?php
                                                if ($docYear == "2013") {
                                                    echo "selected";
                                                }
                                                ?>>2013</option>
                                                <option <?php
                                                if ($docYear == "2014") {
                                                    echo "selected";
                                                }
                                                ?>>2014</option>
                                                <option <?php
                                                if ($docYear == "2015") {
                                                    echo "selected";
                                                }
                                                ?>>2015</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Type
                                            </div>

                                            <select id="doctorate-type" name="edu-type[]" class="form-control ref-form-control">
                                                <option>
                                                    Type
                                                </option>
                                                <option <?php
                                                if ($docTypeID == "Full Time") {
                                                    echo "selected";
                                                }
                                                ?>>Full Time</option>

                                                <option <?php
                                                if ($docTypeID == "Part Time") {
                                                    echo "selected";
                                                }
                                                ?>>Part Time</option>
                                                <option <?php
                                                if ($docTypeID == "Correspondence") {
                                                    echo "selected";
                                                }
                                                ?>>Correspondence</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 clearfix">
                                        <a href="#">Delete Post Graduation</a>
                                    </div>
                                    <div class="col-md-12 clearfix">
                                        <a href="#">Add PhD/Doctorate</a>
                                    </div>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Upload your Resume ( pdf/doc )
                                            </div>
                                            <input type="file" class="form-control ref-form-control" />
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="text-right">
                                <br/>
                                <br/>
                                <input type="submit" value="SUBMIT" class="blue-btn" />
                            </div>
                        </form>
                    </div>
                    <div class="ref-container-right col-md-3">
                        <div class="profile-complete-container clearfix">
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="img/default/My Profile/MP_ICN_AWRD.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="img/default/My Profile/MP_ICN_ORG_DETL.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="img/default/My Profile/MP_ICN_CNTCT_DETL.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="img/default/My Profile/MP_ICN_EDCTN_1.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="img/default/My Profile/MP_ICN_SCL_NTWRK.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="img/default/My Profile/MP_ICN_TSTMNL.png" width="60"/>
                            </div>
                        </div>

                        <h3>Advertise Here</h3>
                        <div class="advertise" style="height: 150px;">

                        </div>
                        <br/>
                        <div class="advertise" style="height: 400px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
require("config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query01 = "select e.id,e.title,e.f_name,e.l_name,e.email,e.phone,e.state,e.country,e.image from users e,  location__country g where  e.country=g.id  and e.id=?";
$stmt01 = $con->prepare($query01);
$stmt01->bind_param('i', $_SESSION["social_id"]);
$stmt01->execute();
$stmt01->bind_result($id, $title, $fname, $lname, $email, $mobile, $state, $country, $imgPath);
$stmt01->store_result();
if ($stmt01->fetch()) {
    
}
$stmt01->close();
?>
<div id="select-update-image" class="panel panel-default panel-personal">
<!--    <span  class="btn-edit">
        <a class="edit-image-view-view" attr-id="<?= $_SESSION["social_id"] ?>">
            <img src="img/default/My Profile/MP_BTN_EDIT.png" width="20" style="border: 2px solid red"/>  
        </a>
    </span>-->
    <!--<span class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>-->
    <form method="post" id="update-image-container"  action="src/update-profile-image.php">
        <div class="panel-body clearfix">

            <div id="image-error" class="alert alert-danger hidden"></div>
            <div class="col-xs-12 col-md-3 clearfix">

                <div class="thumbnail text-center">
                    <img src="<?= $imgPath ?>" class="img-responsive"/>
                    <?php if ($imgPath) { ?>
                    <?php } else { ?>
                        <img src="img/default/home-banner/bg.jpg" class="img-responsive"/>
                    <?php } ?>
                    <input type="hidden" name="old_image" value="<?= $imgPath ?>" >
                    <label>
                        (Upload Photo)
                        <input name="image" id="image" type="file" class="hidden" />
                    </label>
                </div>



            </div>

            <div class="col-xs-12 col-md-8">
                <h3>Welcome  <?= $fname ?> <?= $lname ?></h3><br>
                <div class="ref-form-box clearfix">
                    <div class="col-md-8 ref-form-elt">
                        <input type="text" id="email" name="email" class="form-control ref-form-control" placeholder="E-mail Address*" value="<?= $email ?>">
                    </div>
                    <div class="col-md-4 ref-form-elt">
                        <input type="text" id="mobile" name="mobile" value="<?= $mobile ?>" class="form-control ref-form-control" placeholder="Phone Number*">
                    </div>
                </div>
                <br/>
                <div class="ref-form-box clearfix">

                </div>
                <br>
                <div class="ref-form-box clearfix">
                    <div class="col-md-6 ref-form-elt">

                        <select id="country" name="country" class="form-control ref-form-control">
                            <option>Select a Country*</option>  
                            <?php
                            $query = "select id, country from location__country where status='Active' order by country";
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            $stmt->bind_result($id, $country1country);
                            $stmt->store_result();
                            while ($stmt->fetch()) {
                                $selected = "";
                                if ($id == $country) {
                                    $selected = "selected";
                                }
                                echo "<option value='$id' $selected>$country1country</option>";
                            }
                            $stmt->close();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 ref-form-elt">

                        <select id="state" name="state" class="form-control ref-form-control">
                            <option>
                                Not Applicable*
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12 clearfix">
                <div class="text-right">
                    <input id="profile-updation" type="submit" value="UPDATE IMAGE" class="blue-btn" />
                </div>
            </div>
        </div>


    </form>
</div>
        <?php include './footer.php'; ?>


        <!-- external javascript -->

        <script src="js/jquery.form.min.js"></script>


    </body>
</html>