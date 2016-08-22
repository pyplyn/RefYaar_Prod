<?php
session_start();
ob_start();
require("config.php");
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="Jobs, IT Jobs, Finance Jobs, Big4 Jobs, Referral Jobs, Referrals, Referral, 
                                        Soham, Soham Basak, Referral Recruitment, Best Jobs, TCS Jobs, Wipro Jobs, 
                                        Infosys Jobs, Cognizant Jobs, HCL Jobs, Deloitte Jobs, JPMC Jobs, PwC Jobs, 
                                        EY Jobs, KPMG Jobs, McKinsey Jobs, Best fit candidates, Recruitment algorithm,
                                        Best way to recruit, referral bonus, Inernal Job Portal, Consulting Jobs, 
                                        Accenture Jobs" />
        <meta name="description" content="Redefining referrals for empowered hiring!"/>
        <title>RefYaar | Your Gateway to the Best Jobs</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/index.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/Home_page_video.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/login.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/client:platform.js" async defer></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/Home_page_video.js" type="text/javascript"></script>
        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 75az4i6vywxr8i
            authorize: true
            onLoad: onLinkedInLoad
        </script>
        <?php if ($_GET["err"] == "invEmail") { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(function() {
                        console.log("true");
                        $("#login-btn-header").trigger("click");
                        console.log("hello");

                    });
                });

            </script>
        <?php } ?>
        <?php if ($_GET["err"] == "invSocial") { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(function() {
                        console.log("true");
                        $("#login-btn-header").trigger("click");
                        console.log("hello");

                    });
                });

            </script>
        <?php } ?>
        <?php if ($_GET["page"] == "post") { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(function() {
                        console.log("true");
                        $("#login-btn-header").trigger("click");
                        console.log("hello");

                    });
                });

            </script>
        <?php } ?>
        <?php if ($_GET["page"] == "my") { ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(function() {
                        console.log("true");
                        $("#login-btn-header").trigger("click");
                        console.log("hello");

                    });
                });

            </script>
        <?php } ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#home-nav-cont").height($(window).height());
                $("#howShow").height($(window).height());
            });

        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("body").on("click", "#howWork", function() {
                    $("html, body").animate({scrollTop: $(".how-it-works-wrapper").offset().top}, "slow");
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("body").on("click", "#readOn", function() {
                    $("html, body").animate({scrollTop: $(".job-switch-wrapper").offset().top}, "medium");
                });
            });
        </script>
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
    <body>
        <div class="home-wrapper">
            <div class="home-container">
                <div id="home-nav" class="home-nav">
                    <div id="home-top">
                    <video autoplay loop poster="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_BG_IMG_Masked.png" id="bgvid">
                            <source src="https://s3.amazonaws.com/refyaar/staticContent/video/City-Nights/MP4/City-Nights.mp4" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.</source>
                            <source src="https://s3.amazonaws.com/refyaar/staticContent/video/City-Nights/WEBM/City-Nights.webm" type="video/webm">Your browser does not support the video tag. I suggest you upgrade your browser.</source>
                        </video>
                       
                        <div id="home-nav-cont" class="clearfix">
                        <nav>
                            <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-04.png" width="50" /><?php if ($_SESSION["bw_auth"] == "true") { ?> Hi,  <?= $_SESSION["bw_fname"] ?><?php } ?>
                            <div class="pull-right">
                                <?php if ($_SESSION["bw_auth"] == "true") { ?>
                                 
                                <div class="">
                                        <a href="profile.php" class="anchor-login btn blue-btn my-profile-btn">My Profile</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="login-links">
                                        <a href="sign-up.php" class="anchor-login">Register</a> | <a href="#" id="login-btn-header"     class="anchor-login" data-toggle="modal" data-target="#myModal">Login</a>
                                    </div>
                                <?php } ?>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">RefYaar Login</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="text-center clearfix">
                                                    <span id="fb-login-btn" class="login-btn-sqr">
                                                        <span class="login-btn-icon">
                                                            <span class="fa fa-facebook">

                                                            </span>
                                                        </span>
                                                        <span class="login-btn-text">
                                                            Connect with Facebook
                                                        </span>
                                                    </span>

                                                    <span 
                                                        id="google-login-btn" class="login-btn-sqr">
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
                                                            Connect with Google
                                                        </span>
                                                    </span>


                                                    <span  id="linkedin-login-btn"  class="login-btn-sqr">
                                                        <span class="login-btn-icon">
                                                            <span class="fa fa-linkedin">

                                                            </span>
                                                        </span>
                                                        <span class="login-btn-text">
                                                            Connect with LinkedIn
                                                        </span>
                                                        <script type="in/Login"></script>
                                                    </span>
                                                </div>

                                                <div class="clearfix text-center">
                                                    <span class="or-seperator">or</span>
                                                </div>

                                                <div class="col-md-6 col-sm-11 col-xs-12 clearfix margin-auto no-padding">
                                                    <h3>Login using Email</h3>
                                                    <form method="post" id="login" action="src/login.php">
                                                        <div id="login-error" class="alert alert-danger hidden"></div>
                                                        <div id="register-er"  class="alert alert-danger <?php if ($_GET["err"] != "invEmail") { ?>hidden<?php } ?>">
                                                            <?php
                                                            if ($_GET["err"] == "invEmail") {
                                                                echo "Enter correct Email or Password";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div   class="alert alert-danger <?php if ($_GET["err"] != "invSocial") { ?>hidden<?php } ?>">
                                                            <?php
                                                            if ($_GET["err"] == "invSocial") {
                                                                echo "This account is not registered with us, Please signup";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div id="register-er"  class="alert alert-danger <?php if (($_GET["page"] != "my") && ($_GET["page"] != "post")) { ?>hidden<?php } ?>">
                                                            Login First
                                                        </div>

                                                        <div class="input-group input-group-lg">
                                                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                                            <input type="text" id="login-email" name="login-email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                                                        </div>
                                                        <input type="hidden" name="post" id="post" value="<?= $_GET["page"] ?>">
                                                        <input type="hidden" name="my" id="my" value="<?= $_GET["page"] ?>">
                                                        <br />
                                                        <div class="input-group input-group-lg">
                                                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                                            <input type="password" id="login-password" name="login-password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                                        </div>
                                                        <br />
                                                        <input type="submit" class="blue-btn" value="Login"/>
                                                    </form>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <div class="main-nav clearfix">
                            <div>
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-03.png" width="300" />
                            </div>
                            <div id="howWork" class="how-it-work-btn blue-btn">
                                How it works?
                            </div>
                            <div class="opening-btns">
                                <div id="postOpenings" class="yellow-btn">
                                    Post Openings
                                </div>
                                <div id="findOpenings" class="yellow-btn">
                                    Find Openings
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    
                <div id="howShow" class="how-it-works-wrapper section">
                    <div  class="how-it-works-cont clearfix">
                        <p class="hiw-main-para">
                            Are you aware that you can earn a   <strong>substantial referral bonus from your employer</strong> when you recommend some for a position there?
                        </p>
                        <div class="how-it-work-section col-md-3">
                            <div class="img-container clearfix">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_HIW_ICN_1.png" />
                            </div>
                            <div class="hiw-para">
                                Just post an open position in your company on Refyaar (free of cost!).
                            </div>
                        </div>
                        <div class="how-it-work-section col-md-3">
                            <div class="img-container clearfix">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_HIW_ICN_2.png" />
                            </div>
                            <div class="hiw-para">
                                We will send you 10 CVs that best match the requirements for the position.
                            </div>
                        </div>
                        <div class="how-it-work-section col-md-3">
                            <div class="img-container clearfix">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_HIW_ICN_3.png" />
                            </div>
                            <div class="hiw-para">
                                Shortlist and forward these CVs to your company's recruitment team.
                            </div>
                        </div>
                        <div class="how-it-work-section col-md-3">
                            <div class="img-container clearfix">
                                <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_HIW_ICN_4.png" />
                            </div>
                            <div class="hiw-para">
                                If your referee is hired, you get the referral bonus from your company!
                            </div>
                        </div>
                    </div>
                    <div class="opening-btns" align="right" style="padding-right: 5px; padding-top: 25px;">
                           <div id="readOn" class="yellow-btn">
                                Job seekers read on
                           </div>
                    </div>
                </div>
                <div class="job-switch-wrapper">
                    <div class="job-switch-container col-md-12 margin-auto clearfix" style="background-color: #FFF;">
                        <div class="col-md-10 margin-auto clearfix">
                        <div class="col-md-5">
                            <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home/HP_HIW_IMG_Walk.png" class="walking-man"/>
                        </div>
                        <div class="walking-right-container col-md-7 text-right">
                            <h1 class="ref-underline">
                                And Hey, if you are looking for a <br/> <strong>Job Switch</strong>
                            </h1>
                            <p class="para-blue">
                                Be rest assured, that you are looking at <strong>valid and actual openings</strong> posted by employees of companies on our websites. Your resumes will only be perused by actual employees who are keen on utilizing their company's referral program! 
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
        <?php include './footer.php'; ?>
    </body>
</html>
