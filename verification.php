<?php
session_start();
ob_start();

require("config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$QueryUser = "select mob_verified from users where phone=?";
$stmtUser = $con->prepare($QueryUser);
$stmtUser->bind_param('s', $_SESSION["auth_mob"]);
$stmtUser->execute();
$stmtUser->bind_result($verified);
$stmtUser->store_result();
$stmtUser->fetch();
if ($verified == '1') {
    header("Location:profile.php");
}
$stmtUser->close();
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
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>       
        <style type="text/css">
            #home-nav {
                background-image: url('https://s3.amazonaws.com/refyaar/staticContent/img/default/register/RG_BG_IMG_Masked.png');
                width: 100%;
                background-size: cover;
                background-position: 0px -125px;
                background-repeat: no-repeat;
            }
        </style>
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
        <div id="home-nav" class="home-nav">
            <div id="home-nav-cont" class="clearfix">
                <nav>
                    <a class="navbar-brand" href="index.php"><img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-03.png" width="150" /></a>
                    <div class="pull-right">


                    </div>
                </nav>
                <div class="main-nav clearfix">
    <!--                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>-->

                    <div class="sign-up-form-wrapper">
                        <div class="sign-up-form-container clearfix col-md-8 margin-auto no-padding">
                            <h1 class="ref-white ref-white-h1">VERIFY MOBILE NUMBER </h1>
                            <form method="post" id="verify_mobile" action="verify-process.php">
                                <div class="ref-form-container">


                                    <?php if ($_GET["code"] == 'send') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            OTP has been sent on your registered Mobile number.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["id"] == 'ver') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Verify  mobile number
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
                                            <strong>Congratulations! Your mobile number verified and your Account is  Activated.</strong>
											<br/>
											A verification e-mail has been sent to your registered mail id. 
											<br/>
											Kindly click on the verification link present in the mail.
											<br/>
											Note. You might have received the mail from Refyaar@refyaar.com in your spam folder.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["id"] == 'invcode') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            Invalid code, kindly enter the correct code.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_GET["code"] == 'valid') { ?>
                                        <div class="alert alert-danger" id="verify-error">
                                            We have sent a code on your registered mobile number, kindly enter the code to retrieve your password and press reset password.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <div id="create-signUp-error" class="alert alert-danger hidden"></div>








                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <input <?php if ($_SESSION["auth_mob"]) { ?>disabled<?php } else { ?>type    <?php } ?>="text" id="mobile" name="mobile" value="<?= $_SESSION["auth_mob"] ?>"  class="form-control ref-form-control" placeholder="Mobile no*">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <input id="opt" name="otp" type="text" class="form-control ref-form-control" placeholder="Enter OTP number">
                                        </div>
                                    </div>


                                </div>
                                <div class="text-right">
                                    <br/>
                                    <br/>
                                    <input type="submit" value="NEXT" class="blue-btn" />
                                </div>
                            </form>
                            <div class="main-nav clearfix" style="width: 800px; text-align: right;">
                            <center>
                                <p style="text-align: justify;">
				A verification e-mail has been sent to your registered mail id. 
				<br/>
				Kindly click on the verification link present in the mail.
				<br/>
                                <strong>
                                    Note: You might have received the mail from RefYaar in your spam folder.
                                </strong>
                            </p>
                            </center>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        include './footer.php';
        $con->close();
        ?>


    </body>
</html>
