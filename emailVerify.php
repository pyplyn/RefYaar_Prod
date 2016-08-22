<?php
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
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
        <title>Sign Up | RefYaar</title>
        <link rel = "shortcut icon" href = "https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href = "https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel = "stylesheet" type = "text/css" />
        <link href = "https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type = "text/css" rel = "stylesheet" />
        <link href = "https://s3.amazonaws.com/refyaar/staticContent/css/sign-up.css" type = "text/css" rel = "stylesheet" />
        <link href = 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel = 'stylesheet' type = 'text/css'>
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href = "https://s3.amazonaws.com/refyaar/staticContent/css/jquery.tokenize.css" type = "text/css" rel = "stylesheet" />
        <!--jQuery-->

        <script src = "https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type = "text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/signup.js"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
        <!--        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 75
            iqoaazbusjri
            authorize: true
            onLoad: onLinkedInLoad
        </script>-->
        <script src="js/jquery.form.min.js"></script>       
        <style type="text/css">
            #home-nav {
                background-image: url('https://s3.amazonaws.com/refyaar/staticContent/img/default/register/RG_BG_IMG_Masked.png');
                width: 100%;
                background-size: cover;
                background-position: 0px -266px;
                background-repeat: no-repeat;
            }
        </style>


    </head>
    <body>
        <div id="home-nav" class="home-nav">
            <div id="home-nav-cont" class="clearfix">
                <nav>
                    <a class="navbar-brand" href="index.php"> <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-03.png" width="150" /></a>
                    <div class="pull-right">


                    </div>
                </nav>
                <div class="main-nav clearfix">
    <!--                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>-->

                    <div class="sign-up-form-wrapper">
                        <div class="sign-up-form-container clearfix col-md-8 margin-auto no-padding">
                            <h1 class="ref-white ref-white-h1">VERIFY EMAIL ID </h1>
                            <form method="post" id="verify_mobile" action="emailVerify-process.php">
                                <div class="ref-form-container">
                                    <?php if ($_GET["id"] == 'ver') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Verify  email id
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["code"] == 'ses') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Sorry your session is not created, To take our services firstly create session
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["id"] == 'val') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Mobile number varified and your Account is  Activated
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["id"] == 'invcode') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Invalid code, kindly enter correct code
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["code"] == 'valid') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            we have send code on your registered mobile no,kindly enter code to retreive your password and press reset password
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <div id="create-signUp-error" class="alert alert-danger hidden"></div>







                                    <div>&nbsp;&nbsp;&nbsp;&nbsp;A Verification e-mail has been sent to your registered e-mail ID. Kindly click on the Verify button in the e-mail to activate your account</div>
                                    <br/>
                                    <!--<div>"Kindly verify your email address by click  link" . '<a href="http://localhost/refyaar/emailVerify-process.php?email=mdsameer8246@gmail.com&code=6231">http://refyaar.larva.co.in/RefYaar/emailVerify-process.php</a>'</div>-->
<!--                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            '<a href="emailVerify.php">CLICK</a>' . "To verify email"
                                            <input disabled="text" id="email" name="email" value="<?= $_SESSION["auth_email"] ?>"  class="form-control ref-form-control" placeholder="Email Id*">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <input id="code" name="code" type="text" class="form-control ref-form-control" placeholder="Enter email verify code">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <br/>
                                    <br/>
                                    <input type="submit" value="NEXT" class="blue-btn" />
                                </div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './footer.php'; ?>
    </body>
</html>
