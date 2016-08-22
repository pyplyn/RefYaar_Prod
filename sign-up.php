<?php
session_start();
ob_start();
require("config.php");
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
        <title>Sign Up | RefYaar</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/sign-up.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/jquery.tokenize.css" type="text/css" rel="stylesheet" />
        <!-- jQuery -->
        
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/signup.js"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/login1.js"></script>
        <!--<script src="js/custom/login1.js"></script>-->
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/client:platform.js" async defer></script>
        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 75az4i6vywxr8i
            authorize: true
            onLoad: onLinkedInLoad
        </script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>
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
                    <a href="index.php"> <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-03.png" width="150" /></a>
                    <div class="login-container pull-right">
                        <div class="login-links">
                            <span class="ref-yellow">Already a member?</span> <a href="#" id="login-btn-header" class="anchor-login" data-toggle="modal" data-target="#myModal">Login</a>
                        </div>
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

                                            <!--
                                            -->                                            
                                            <span id="google-login-btn-fix" class="login-btn-sqr">
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
                                            <form method="post" id="user-login" action="src/user-login.php">

                                                <div id="user-error" class="alert alert-danger hidden">sameer</div>
                                                <div id="register-er"  class="alert alert-danger <?php if ($_GET["err"] != "invEmail") { ?>hidden<?php } ?>">
                                                    <?php
                                                    if ($_GET["err"] == "invEmail") {
                                                        echo "Enter correct Email or Password";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                                    <input type="text" id="user-email" name="login-email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                                <br />
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                                    <input type="password" id="user-password" name="login-password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
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
                    <p>
                    </p>
                    <div class="sign-up-form-wrapper">
                        <div class="sign-up-form-container clearfix col-md-8 margin-auto no-padding">
                            <h1 class="ref-white ref-white-h1">Personal Details <div class="pull-right"><img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/register/RG_ICN_Strip.png"  width="200"/></div></h1>
                            <form method="post" id="create-signup" action="src/create-signup.php">
                                <div class="ref-form-container">
                                    <div class="text-center clearfix">
                                        <span id="fb-connect" class="login-btn-sqr">
                                            <span class="login-btn-icon">
                                                <span class="fa fa-facebook">

                                                </span>
                                            </span>
                                            <span id="fb-register-btn" class="login-btn-text">
                                                Connect with Facebook
                                            </span>
                                        </span>

                                        <span id="google-login-btn" class="login-btn-sqr">
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

                                        <span  id="linkedin-register-btn"  class="login-btn-sqr">
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
                                    <br/>

                                    <div id="create-signUp" class = "alert alert-danger  <?php if ($_GET["id"] != "ver") { ?> hidden  <?php } ?>">You are not a verified user, verify your account</div>

                                    <div id="create-signUp-error" class="alert alert-danger hidden"></div>
                                    <?php
                                    if ($_GET["id"] == "ver") {
                                        $countQuery = "select f_name,l_name,email from users where id=?";
                                        $stmt1 = $con->prepare($countQuery);
                                        $stmt1->bind_param('s', $_SESSION["social_id"]);
                                        $stmt1->execute();
                                        $stmt1->bind_result($fName, $lastName, $email);
                                        $stmt1->store_result();
                                        if ($stmt1->fetch()) {
                                            $result["err"] = "true";
                                            $result["msg"] = "Error for signup";
                                        }
                                        $stmt1->close();
                                    }
                                    ?>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6 clearfix ref-form-elt">
                                            <select id="title" name="title" class="form-control ref-form-control ref-form-control-left"> 
                                                <option>Title</option>
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Ms.</option>
                                                <option>Dr.</option>
                                            </select>
                                            <input type="text" id="fname" name="fname" class="form-control ref-form-control ref-form-control-right" placeholder="First Name*" value="<?= $fName ?>" disabled>
                                        </div>
                                        <div class="col-md-6 clearfix ref-form-elt">
                                            <input type="text" id="lname" name="lname" class="form-control ref-form-control" placeholder="Last Name*" value="<?= $lastName ?>" disabled>
                                        </div>
                                    </div>
                                    <input type="hidden" id="providerId" name="providerId"  value="">
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="email" name="email" class="form-control ref-form-control" placeholder="E-mail Address*" value="<?= $email ?>">
                                        </div>
                                        <div class="col-md-6 ref-form-elt">
                                            <input type="text" id="mobile" name="mobile" class="form-control ref-form-control" placeholder="Phone Number*">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6 ref-form-elt">
                                            <select id="country" name="country" class="form-control ref-form-control">
                                                <option>Select a Country*</option>  
                                                <?php
                                                $query = "select id, country from location__country where status='Active' order by country";
                                                $stmt = $con->prepare($query);
                                                $stmt->execute();
                                                $stmt->bind_result($id, $country);
                                                $stmt->store_result();
                                                while ($stmt->fetch()) {
                                                    echo "<option value='$id'>$country</option>";
                                                }
                                                $stmt->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 ref-form-elt">

                                            <select id="state" name="state" class="form-control ref-form-control">
                                                <option>
                                                    State / Province*
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6 ref-form-elt">
                                            <input id="password" name="password" type="password" class="form-control ref-form-control" placeholder="Password*">
                                        </div>
                                        <div class="col-md-6 ref-form-elt">
                                            <input id="cpassword" name="cpassword" type="password" class="form-control ref-form-control" placeholder="Confirm password*">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6 ref-form-elt">
                                            <div class="ref-form-sub-text">
                                                How did you hear about us ?
                                            </div>
                                            <select id="about-us" name="about-us" class="form-control ref-form-control">
                                                <option>
                                                    Select an option*
                                                </option>
                                                <option>Word of Mouth</option>
                                                <option>Social Media Advertisements</option>
                                                <option>Advertisements in other web sites</option>
                                                <option>Google</option>
                                                <option>Other Search Engines</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div id="hide" class="col-md-6 hidden ref-form-elt">
                                            <div class="ref-form-sub-text ">
                                                Please Specify
                                            </div>
                                            <input  type="text" id="specify" name="specify" class="form-control ref-form-control">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix" style="padding-left: 10px; padding-top: 5px;">
                                        * By signing up you choose to agree to all our <a href="html/termsAndConditions.php" target="_blank">Terms & Conditions</a>.
                                    </div>
                                    <br/>
                                    <?php //                                    }   ?>
                                </div>
                                <?php //                                if ($_SESSION["socialLink"] == "true") {  ?>
                                <div class="text-right">
                                    <br/>
                                    <br/>
                                    <input type="submit" value="NEXT" class="blue-btn" />
                                </div>
                                <?php //                                                }    ?>
                            </form>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include './footer.php'; ?>


    </body>
</html>
