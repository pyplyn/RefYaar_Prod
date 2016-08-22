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
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
<!--        <script type="text/javascript" src="//platform.linkedin.com/in.js">
            api_key: 75
            iqoaazbusjri
            authorize: true
            onLoad: onLinkedInLoad
        </script>-->
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>       
        <style>
            #home-nav {
                background-size: cover;
            }
            h1.ref-white.ref-white-h1 {
                margin-top: 25px;
            }
            @media (max-width:768px){
                h1.ref-white.ref-white-h1 {
                    /*margin-top: 100px;*/
                }
                #home-nav{
                    background-position: -27px -145px;
                }
            }
        </style>


    </head>
    <body>
        <div id="home-nav" class="home-nav">
            <div id="home-nav-cont" class="clearfix">
                <nav>
                    <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/logo/refyaar-Final-PNG-03.png" width="150" />
                    <div class="pull-right">


                    </div>
                </nav>
                <div class="main-nav clearfix">
<!--                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>-->

                    <div class="sign-up-form-wrapper">
                        <div class="sign-up-form-container clearfix col-md-6 margin-auto no-padding">
                            <h1 class="ref-white ref-white-h1">Verify Mobile Number </h1>
                            <form method="post" id="verify_mobile" action="verify-process.php">
                                <div class="ref-form-container">



                                    <div id="create-signUp-error" class="alert alert-danger hidden"></div>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-8">
                                            <input disabled="text" id="mobile" name="mobile" value="7530895503"  class="form-control ref-form-control" placeholder="Password*">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-8">
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
                            <div class="main-nav clearfix" style="width: 800px;">
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
        <?php include './footer.php'; ?>


    </body>
</html>
