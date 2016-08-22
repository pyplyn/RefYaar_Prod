<?php
//
require("config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
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
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href='https://s3.amazonaws.com/refyaar/staticContent/css/uploadify.css' rel='stylesheet'>
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/jquery.tokenize.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/profile.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/index.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.js" type="text/javascript"></script>
        <!--<script src="js/jquery.uploadify-3.1.min.js"></script>-->
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
    <!--<script src="js/custom/login1.js" type="text/javascript"></script>-->
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- plugin for gallery image view -->
        <!--<script src="js/jquery.colorbox-min.js"></script>-->
        <script src="https://apis.google.com/js/client:platform.js" async defer></script>
        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 75az4i6vywxr8i
            authorize: true
            onLoad: onLinkedInLoad
        </script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.uploadify-3.1.min.js"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/565e002faad22388665e7fab/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </head>
    <head>
    </head>
    <body>
        <?php include './header.php'; ?>
        <div class="page-wrapper">
            <div class="page-container clearfix">
                <div class="col-md-11 col-xs-12 col-sm-11 margin-auto no-padding">
                    <div class="ref-container-left col-md-9">
                        <?php
                        $query01 = "select e.id,e.title,e.f_name,e.l_name,e.email,e.phone,e.state,g.country,e.image from users e,  location__country g where  e.country=g.id  and e.id=?";
                        $stmt01 = $con->prepare($query01);
                        $stmt01->bind_param('i', $_SESSION["social_id"]);
                        $stmt01->execute();
                        $stmt01->bind_result($id, $title, $fname, $lname, $email, $mobile, $state, $country, $imgPath);
                        $stmt01->store_result();
                        if ($stmt01->fetch()) {
                            
                        }
                        $stmt01->close();
                        $queryResume = "select resume from user_profile where user_id=?";
                        $stmtResume = $con->prepare($queryResume);
                        $stmtResume->bind_param('i', $_SESSION["social_id"]);
                        $stmtResume->execute();
                        $stmtResume->bind_result($resume);
                        $stmtResume->store_result();
                        if ($stmtResume->fetch()) {
                            
                        }
                        $stmtResume->close();
                        ?>
                        <?php
                        $query11 = "select a.user_id,a.cur_company,a.cur_com_since,a.ctc,a.cur_com_industry,b.industry,c.area, a.designation from user_profile a , industry b, func_area c where b.id=a.cur_com_industry and c.id=a.func_area    and a.user_id=?";
                        $stmt11 = $con->prepare($query11);
                        $stmt11->bind_param('i', $_SESSION["social_id"]);
                        $stmt11->execute();
                        $stmt11->bind_result($userId, $curCompnay, $curSince, $ctc, $currentIndustry, $curIndustry, $area, $designation);
                        $stmt11->store_result();
                        if ($stmt11->fetch()) {
                            
                        }
                        $stmt11->close();
                        ?>
                        <div id="update-image" class="panel panel-default panel-personal">
                            <span  class="btn-edit-image">
                                Edit&nbsp;
                                <img class="edit-image-view" attr-id="<?= $_SESSION["social_id"] ?>" src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_BTN_EDIT.png" width="20"/>  
                            </span>
                            <!--<span class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>-->
                            <div class="panel-body clearfix">
                                <div class="col-xs-12 col-md-3 clearfix">
                                    <div class="thumbnail text-center"><?php if ($imgPath) { ?>
                                            <img src="<?= $imgPath ?>" class="img-responsive"/>

                                        <?php } else { ?>
                                            <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home-banner/bg.jpg" class="img-responsive"/>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-5">
                                    <h3>Welcome  <?= $fname ?> <?= $lname ?></h3>
                                    <div class="personal-section">
                                        <span class="fa fa-envelope-o icon-left"></span> <?= $email ?>
                                    </div>
                                    <div class="personal-section">
                                        <span class="fa fa-phone icon-left"></span> +91 <?= $mobile ?>
                                    </div>
                                    <div class="personal-section">
                                        <?php
                                        if ($country == "India") {
                                            $queryState = "select id,state from location__state where id=?";
                                            $stmtState = $con->prepare($queryState);
                                            $stmtState->bind_param('i', $state);
                                            $stmtState->execute();
                                            $stmtState->bind_result($stateId, $locationState);
                                            $stmtState->store_result();
                                            if ($stmtState->fetch()) {
                                                ?>
                                                <span class="fa fa-home icon-left"></span><?= $locationState ?>, <?= $country ?><?php
                                            }
                                            $stmtState->close();
                                        } else {
                                            ?>
                                            <span class="fa fa-home icon-left"></span><?= $country ?><?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <?php
                                    $queryFb = "select id,provider from social_con where user_id=? and  provider='Facebook'";
                                    $stmtFb = $con->prepare($queryFb);
                                    $stmtFb->bind_param('i', $_SESSION["social_id"]);
                                    $stmtFb->execute();
                                    $stmtFb->bind_result($id, $facebookNetwork);
                                    $stmtFb->store_result();
                                    if ($stmtFb->fetch()) {
                                        
                                    }
                                    $queryLi = "select id,provider from social_con where user_id=? and provider='LinkedIn'";
                                    $stmtLi = $con->prepare($queryLi);
                                    $stmtLi->bind_param('i', $_SESSION["social_id"]);
                                    $stmtLi->execute();
                                    $stmtLi->bind_result($id, $LinkedInNetwork);
                                    $stmtLi->store_result();
                                    if ($stmtLi->fetch()) {
                                        
                                    }
                                    $queryGm = "select id,provider from social_con where user_id=? and provider='Gmail'";
                                    $stmtGm = $con->prepare($queryGm);
                                    $stmtGm->bind_param('i', $_SESSION["social_id"]);
                                    $stmtGm->execute();
                                    $stmtGm->bind_result($id, $gmailNetwork);
                                    $stmtGm->store_result();
                                    if ($stmtGm->fetch()) {
                                        
                                    }
                                    ?>
                                    <div class="col-md-12 no-padding">
                                        <span id="fb-login-btn" class="login-btn-sqr <?php if (($_SESSION["bw_type"] == "Facebook") || ($_SESSION["fb_type"] == "Facebook") || $facebookNetwork == "Facebook") { ?> active<?php } ?>">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-facebook">

                                                </span>
                                            </span>
                                            <span class="login-btn-text">
                                                <?php if (($_SESSION["bw_type"] == "Facebook") || ($_SESSION["fb_type"] == "Facebook") || ($_SESSION["fb_type"] == "Facebook") || $facebookNetwork == "Facebook") { ?> Connected with Facebook<?php } else { ?>Connect with  Facebook<?php } ?>

                                            </span>
                                        </span>
                                    </div>
                                    <br/>

                                    <div class="col-md-12 no-padding">
                                        <span 
                                            id="google-login-btn" class="login-btn-sqr <?php if (($_SESSION["bw_type"] == "Gmail") || ($_SESSION["pro_type"] == "Gmail") || $gmailNetwork == "Gmail") { ?> active<?php } ?>">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-google">

                                                </span>
                                            </span>
                                            <span
                                                data-callback="signinCallback"
                                                data-clientid="317918819208-j6li3mflq058q02p2nh4hilb1997igkt.apps.googleusercontent.com"
                                                data-cookiepolicy="single_host_origin"
                                                data-requestvisibleactions="http://schema.org/AddAction"
                                                data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
                                                class="login-btn-text g-signin">
                                                <?php if (($_SESSION["bw_type"] == "Gmail") || ($_SESSION["pro_type"] == "Gmail") || $gmailNetwork == "Gmail") { ?> Connected with Google<?php } else { ?>Connect with Google<?php } ?>
                                            </span>
                                        </span>
                                        
                                    </div>
                                    <br/>
                                    <div class="col-md-12 no-padding">
                                        <span  id="linkedin-login-btn"  class="login-btn-sqr <?php if (($_SESSION["bw_type"] == "linkedin") || ($_SESSION["link_type"] == "linkedin") || $LinkedInNetwork == "LinkedIn") { ?> active<?php } ?>">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-linkedin">

                                                </span>
                                            </span>
                                            <span class="login-btn-text">
                                                <?php if (($_SESSION["bw_type"] == "linkedin") || ($_SESSION["link_type"] == "linkedin") || $LinkedInNetwork == "LinkedIn") { ?> Connected with LinkedIn<?php } else { ?>Connect with LinkedIn<?php } ?>

                                            </span>
                                            <script type="in/Login"></script>
                                        </span>
                                    </div>
                                    <?php
                                    $stmtFb->close();
                                    $stmtGm->close();
                                    $stmtLi->close();
                                    ?>
                    
                        </div>
                        <br/>
                        <br/>
                       <div class="panel-body clearfix" style="padding-top: 15px; padding-bottom: 10px; padding-left: 30px;">
                        <table width="100%" align="center">
                            <tr>
                                <td width="25%"></td>
                                <td width="20%">
                                    <div id="findOpenings" class="login-btn-text">
                                        <a href="my-jobs.php" target="_blank">My Job Openings</a>
                                    </div>
                                </td>
                                 <td width="20%">
                                   <div id="findOpenings" class="login-btn-text">
                                        <a href="post-job.php" target="_blank">Post an Opening</a>
                                    </div> 
                                </td>
                                 <td width="20%">
                                    <div id="postOpenings" class="login-btn-text">
                                        <a href="my-job-posted.php" target="_blank">My Job Posts</a>
                                    </div> 
                                </td>
                                <td width="15%"></td>
                            </tr>
                        </table>
                        </div>
                        </div>
                        </div>
                        
                        <!--<form method="post" id="update-profile"  action="src/update-profile.php">-->
                        <div id="update-profile" class="panel panel-default panel-expertise">
                            <div class="panel-body clearfix">
                                <span class="btn-edit">
                                    Edit&nbsp;
                                    <a class="edit-vendor-view" attr-id="<?= $_SESSION["social_id"] ?>" href="#" data-toggle="modal" data-target="#editVendorModal">
                                        <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_BTN_EDIT.png" width="20"/>  
                                    </a>
                                </span>
                                <div id="expertise-error" class="alert alert-danger hidden"></div>
                                <div class="ref-form-box clearfix">
                                    <div class="col-md-6">
                                        <input type="text" id="cur-company" name="cur-company" class="form-control ref-form-control" value="<?= $curCompnay ?>" placeholder="Current Company" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-2 ref-form-label no-padding">
                                            Since
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <input type="text" value="<?php
                                            if ($curSince == '0') {
                                                echo Year;
                                            } else {
                                                ?><?= $curSince ?><?php } ?>" id="since" name="since" class="form-control ref-form-control"  disabled>

                                        </div>
                                        <div class="col-md-1 no-padding">

                                        </div>
                                        <div class="col-md-5 no-padding ref-form-elt">
                                            <input type="text" value="<?= $curIndustry ?>" id="cur-industry" name="cur-industry" class="form-control ref-form-control" placeholder="Industry" disabled>

                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <?php
                                $query1 = "select a.id, a.user_id,a.company,a.year,b.industry from  prev_com a,industry b where b.id=a.pre_com_industry and a.user_id=?";
                                $stmt1 = $con->prepare($query1);
                                $stmt1->bind_param('i', $_SESSION["social_id"]);
                                $stmt1->execute();
                                $stmt1->bind_result($id, $preUserId, $preCompany, $preYear, $preIndustry);
                                $stmt1->store_result();
                                while ($stmt1->fetch()) {
                                    ?>
                                    <div class="ref-form-box clearfix">

                                        <div class="col-md-6">
                                            <input type="text" id="pre-company" name="pre-company[]" class="form-control ref-form-control" placeholder="Previous Company" value="<?= $preCompany ?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="pre1" id="pre1" value="<?= $id ?>">
                                            <div class="col-md-2 ref-form-label no-padding">
                                                Years
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="text"  id="pre-year"  name="pre-year[]" class="form-control ref-form-control" value="<?= $preYear ?>" disabled/>
                                            </div>
                                            <div class="col-md-1 no-padding">

                                            </div>
                                            <div class="col-md-5 no-padding ref-form-elt">
                                                <input type="text" value="<?= $preIndustry ?>" id="pre-industry" name="pre-industry[]" class="form-control ref-form-control" disabled>

                                            </div>
                                        </div>

                                    </div>
                                    <br/>
                                    <?php
                                }
                                $stmt1->close();
//                                   
                                ?>

                                <br/>
                                <div class="ref-form-box clearfix">
                                    <div class="col-md-6">
                                        <div class="ref-form-sub-text">
                                            Designation
                                        </div>
                                        <input type="text" value="<?= $designation ?>" id="designation" name="designation" class="form-control ref-form-control" disabled>
                                    </div>
                                    <div class="ref-form-sub-text">
                                        &nbsp;&nbsp; CTC (in INR)
                                    </div>
                                    <div class="col-md-6 ref-form-elt">
                                        <input type="text" id="ctc" name="ctc"  class="form-control ref-form-control" <?php if ($ctc) { ?>value="<?= round($ctc) ?>"<?php } else { ?>value="<?= $ctc ?>"<?php } ?> placeholder="CTC" disabled>
                                    </div>

                                </div>
                                <br/>
                                <div class="ref-form-box clearfix">
                                    <div class="col-md-6">
                                        <div class="ref-form-sub-text">
                                            Functional Area
                                        </div>
                                        <input type="text" value="<?= $area ?>" id="area" name="area" class="form-control ref-form-control" disabled>
                                    </div>
                                </div>
                                <br/>



                                <div class="ref-form-box clearfix">
                                    <div class="ref-form-sub-text col-xs-12 clearfix">
                                        Key Skills & Experience in the skill (Years)
                                    </div>
                                    <?php
//                                    $query1 = "select id, key_skill,years from  key_skill where user_id=? ";
                                    $query1 = "select a.id, b.keyword,a.years from  key_skill a,keywords b where a.key_skill=b.id and  a.user_id=? and b.status='Active'";
                                    $stmt1 = $con->prepare($query1);
                                    $stmt1->bind_param('i', $_SESSION["social_id"]);
                                    $stmt1->execute();
                                    $stmt1->bind_result($keyId, $keySkill, $keyYear);
                                    $stmt1->store_result();
                                    while ($stmt1->fetch()) {
                                        ?>
                                        <div class="col-md-6 key-skill-container">
                                            <div class="col-md-7 no-padding">
                                                <input type="text" value="<?= $keySkill ?>" id="skill-area"  name="skill-area[]" class="form-control ref-form-control" disabled>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-2 no-padding ref-form-label">
                                                Year/s
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <input type="text" id="skill-year" name="skill-year[]" class="form-control ref-form-control" value="<?= $keyYear ?>" disabled/>
                                            </div>
                                        </div>

                                        <?php
                                    }

                                    $stmt1->close();
                                    ?>
                                </div>
                                <br/>
                                <div class="col-md-12 clearfix">
                                    <hr class="hr-dotted"/>
                                </div>
                                <div class="ref-form-box clearfix">
                                    <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                        Education
                                    </div>
                                    <?php
                                    $query112 = "select a.id,  a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where a.institution_id=c.id and a.education_id=b.id and b.edu_type='Graduation' and a.user_id=? ";
                                    $stmt112 = $con->prepare($query112);
                                    $stmt112->bind_param('i', $_SESSION["social_id"]);
                                    $stmt112->execute();
                                    $stmt112->bind_result($gradId, $eduGradId, $gradSpecialization, $gradPercentage, $gradInstId, $gradYear, $gradTypeID, $gradDegree, $gradEduType);
                                    $stmt112->store_result();
                                    while ($stmt112->fetch()) {
                                        
                                    }
                                    $stmt112->close();
                                    ?>
                                    <div class="col-md-6">
                                        <div class="ref-form-sub-text">
                                            Basic/Graduation
                                        </div>
                                        <input type="text" value="<?= $gradDegree ?>" id="graduation" name="education[]" class="form-control ref-form-control" disabled>

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
                                        <input id="grad-specialization" name="edu-specialization[]" type="text" class="form-control ref-form-control" value="<?= $gradSpecialization ?>" disabled/>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="ref-form-sub-text ref-form-elt">
                                            %
                                        </div>
                                        <input type="text" id="percentage" name="percentage[]" class="form-control ref-form-control" value="<?= $gradPercentage ?>" disabled/>
                                    </div>
                                </div>
                                <br/>
                                <div class="ref-form-box clearfix">
                                    <div class="col-md-6">
                                        <div class="ref-form-sub-text">
                                            University/Institute
                                        </div>
                                        <input type="text" value="<?= $gradInstId ?>" id="grad-university" name="edu-university[]" class="form-control ref-form-control" disabled>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="ref-form-sub-text ref-form-elt">
                                            Year
                                        </div>
                                        <input type="text" value="<?= $gradYear ?>" id="grad-year" name="edu-year[]" class="form-control ref-form-control" disabled>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="ref-form-sub-text ref-form-elt">
                                            Type
                                        </div>
                                        <input type="text" value="<?= $gradTypeID ?>" id="grad-type" name="edu-type[]" class="form-control ref-form-control" disabled>

                                    </div>
                                </div>
                                <?php
                                $_delete_post = "";
                                if ($_COOKIE["delete-post-graduation"] == 1) {
                                    $_delete_post = "style='display:none;'";
                                }
                                ?>
                                <div id="post-hide"  class="ref-form-box clearfix" <?= $_delete_post ?>>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div class="ref-form-box clearfix">
                                        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                            Education
                                        </div>
                                        <?php
                                        $query12 = "select a.id, a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Post Graduation' and a.user_id=? ";
                                        $stmt12 = $con->prepare($query12);
                                        $stmt12->bind_param('i', $_SESSION["social_id"]);
                                        $stmt12->execute();
                                        $stmt12->bind_result($postId, $eduPostId, $postSpecialization, $postPercentage, $postInstId, $postYear, $postTypeID, $postDegree, $postEduType);
                                        $stmt12->store_result();
                                        while ($stmt12->fetch()) {
                                            
                                        }
                                        $stmt12->close();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Post Graduation
                                            </div>
                                            <input type="text" value="<?= $postDegree ?>" id="post-graduation" name="education[]" class="form-control ref-form-control" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Specialization
                                            </div>
                                            <input type="text" id="post-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $postSpecialization ?>" disabled/>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                %
                                            </div>
                                            <input type="text" id="post-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $postPercentage ?>" disabled/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                University/Institute
                                            </div>
                                            <input type="text" value="<?= $postInstId ?>" id="post-university" name="edu-university[]" class="form-control ref-form-control" disabled>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Year
                                            </div>
                                            <input type="text" value="<?= $postYear ?>" id="post-year" name="edu-year[]" class="form-control ref-form-control" disabled>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Type
                                            </div>

                                            <input type="text" value="<?= $postTypeID ?>" id="post-type" name="edu-type[]" class="form-control ref-form-control" disabled>

                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <?php
                                $queryCoc = "select count(b.edu_type) from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
                                $stmtCoc = $con->prepare($queryCoc);
                                $stmtCoc->bind_param('i', $_SESSION["social_id"]);
                                $stmtCoc->execute();
                                $stmtCoc->bind_result($cookiesCount);
                                $stmtCoc->store_result();
                                $stmtCoc->fetch();
                                if (($cookiesCount > 0) && ($_COOKIE["delete-doctorate"] == 1)) {
                                    $_delete_doc = "";
                                } else if (($cookiesCount > 0) && ($_COOKIE["delete-doctorate"] != 1) && ($_COOKIE["delete-doctorate"] != 0)) {
                                    $_delete_doc = "";
                                } else {
                                    $_delete_doc = "style='display:none;'";
                                }
                                $stmtCoc->close();
//                                if ($_COOKIE["delete-doctorate"] == 1) {
//                                    $_delete_doc = "";
//                                }
                                ?>
                                <div  class="ref-form-box clearfix "  id="collapseExample"  <?= $_delete_doc ?>>
                                    <div class="col-md-12 clearfix">
                                        <hr class="hr-dotted"/>
                                    </div>
                                    <div  class=" ref-form-box clearfix">
                                        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                            Education
                                        </div>
                                        <?php
                                        $query12 = "select a.id, a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
                                        $stmt12 = $con->prepare($query12);
                                        $stmt12->bind_param('i', $_SESSION["social_id"]);
                                        $stmt12->execute();
                                        $stmt12->bind_result($docId, $eduDocId, $docSpecialization, $docPercentage, $docInstId, $docYear, $docTypeID, $docDegree, $docEduType);
                                        $stmt12->store_result();
                                        while ($stmt12->fetch()) {
                                            
                                        }
                                        $stmt12->close();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Doctorate
                                            </div>
                                            <input type="text" value="<?= $docDegree ?>" id="doctorate" name="education[]" class="form-control ref-form-control" disabled> 

                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Specialization
                                            </div>
                                            <input type="text" id="doc-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $docSpecialization ?>" disabled/>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                %
                                            </div>
                                            <input type="text" id="doc-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $docPercentage ?>" disabled/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                University/Institute
                                            </div>
                                            <input type="text" value="<?= $docInstId ?>" id="doc-university" name="edu-university[]" class="form-control ref-form-control" disabled>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Year
                                            </div>
                                            <input type="text" value="<?= $docYear ?>" id="doctorate-year" name="edu-year[]" class="form-control ref-form-control" disabled>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Type
                                            </div>

                                            <input type="text" value="<?= $docTypeID ?>" id="doctorate-type" name="edu-type[]" class="form-control ref-form-control" disabled>

                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <!--                                <div id="add-phd" class="col-md-12 clearfix">
                                                                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Add PhD/Doctorate</a>
                                                                </div>-->
                                <div class="col-md-12 clearfix">
                                    <hr class="hr-dotted"/>
                                </div>
                                <div class="ref-form-box clearfix">
                                    <div class="col-md-6">


                                        <input type="hidden" name="resume" value="<?= $resume ?>" >
                                        <br/>
                                        <div><a href="<?= $resume ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-download-alt"></span> View Resume</a></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--                            <div class="text-right">
                                                        <br/>
                                                        <br/>
                                                        <input type="submit" value="SUBMIT" class="blue-btn" />
                                                    </div>-->
                        <!--</form>-->
                    </div>
                    <div class="ref-container-right col-md-3">
                        <div class="profile-complete-container clearfix">
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_AWRD.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_ORG_DETL.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_CNTCT_DETL.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_EDCTN.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_SCL_NTWRK.png" width="60"/>
                            </div>
                            <div class="col-xs-6 col-md-6 profile-complete-tile active">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/My_Profile/MP_ICN_TSTMNL.png" width="60"/>
                            </div>
                        </div>

                        <!--<h3>Advertise Here</h3>-->
                        <div style="height: 600px; padding-top: 20px;">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- RefYaar - Demo -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-2072883661383317"
                                 data-ad-slot="6602520781"
                                 data-ad-format="auto">
                            </ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <br/>
                        <!--<div class="advertise" style="height: 100px;">

                        </div>-->
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div id="modal-error" class="alert alert-danger hidden"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include './footer.php';
        $con->close();
        ?>


        <!-- external javascript -->

        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/profile.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>

        <!--<script src="js/jquery.uploadify-3.1.min.js"></script>-->
    </body>
</html>