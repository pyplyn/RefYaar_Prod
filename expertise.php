<?php
session_start();
ob_start();
require './config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$QueryUser = "select mob_verified from users where phone=?";
$stmtUser = $con->prepare($QueryUser);
$stmtUser->bind_param('s', $_SESSION["auth_mob"]);
$stmtUser->execute();
$stmtUser->bind_result($verified);
$stmtUser->store_result();
$stmtUser->fetch();
if ($verified != '1') {
    header("Location:verification.php?id=ver");
}
$stmtUser->close();
try {
    ?>
    <!--
    To change this template, choose Tools | Templates
    and open the template in the editor.
    -->
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Professional Expertise | RefYaar</title>
            <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
            <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
            <link href="https://s3.amazonaws.com/refyaar/staticContent/css/sign-up.css" type="text/css" rel="stylesheet" />
            <link href="https://s3.amazonaws.com/refyaar/staticContent/css/jquery.tokenize.css" type="text/css" rel="stylesheet" />
            <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.css" type="text/css" rel="stylesheet" />
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.js" type="text/javascript"></script>
            <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/expertise.js" type="text/javascript"></script>
            <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery.form.min.js"></script>
            <!-- plugin for gallery image view -->
            <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
            <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.colorbox-min.js"></script>
            <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
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
                                <span class="ref-yellow">Already a member?</span> <a href="#" class="anchor-login" data-toggle="modal" data-target="#myModal">Login</a>
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
                                                <span class="login-btn-sqr active">
                                                    <span class="login-btn-icon">
                                                        <span class="fa fa-facebook">

                                                        </span>
                                                    </span>
                                                    <span class="login-btn-text">
                                                        Connected with Facebook
                                                    </span>
                                                </span>

                                                <span class="login-btn-sqr">
                                                    <span class="login-btn-icon">
                                                        <span class="fa fa-twitter">

                                                        </span>
                                                    </span>
                                                    <span class="login-btn-text">
                                                        Connect with Twitter
                                                    </span>
                                                </span>

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

                                            <div class="clearfix text-center">
                                                <span class="or-seperator">or</span>
                                            </div>

                                            <div class="col-md-6 col-sm-11 col-xs-12 clearfix margin-auto no-padding">
                                                <h3>Login using Email</h3>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                                    <input type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                                <br />
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                                    <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                                </div>
                                                <br />
                                                <input type="submit" class="blue-btn" value="Login"/>
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
                    <div class="col-xs-12 col-md-12 text-right right no-padding">
                        <a href="#" data-toggle="modal" data-target="#myModalProfileInfo" class="ref-yellow"><h4>Skip to post an opening</h4></a>
                        </div>
                    <!-- Modal Profile Info-->
                            <div class="modal fade" id="myModalProfileInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h3 class="modal-title" id="myModalLabel">Are you not looking for a job change? </h3>
                                        </div>
                                        <div class="modal-body clearfix">
                                            <div class="text-center clearfix">
                                                <div class="col-md-10 col-sm-11 col-xs-12 clearfix margin-auto no-padding">
                                                    <h4 style="padding-left: 10px; text-align: justify;">Please follow the below steps to Post an Opening: </h4>
                                                    <br/>
                                                    <h4 style="padding-left: 10px; text-align: justify;">1. Click on the Continue button below.</h4>
                                                    <h4 style="padding-left: 10px; text-align: justify;">2. Please update your Current Company in your Profile by clicking on the Edit button.</h4>
                                                    <h4 style="padding-left: 10px; text-align: justify;">3. Click on the Submit button at the bottom of your Profile to save the changes.</h4>
                                                    <h4 style="padding-left: 10px; text-align: justify;">4. Click on the Post an Opening button.</h4>
                                                    <h4 style="padding-left: 10px; text-align: justify;">5. Voila! Post the opening.</h4>
                                                    <br/>
                                                    <div class="">
                                                        <a href="profile.php" class="btn blue-btn">Continue</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="main-nav clearfix"> 
                        <p>
                        </p>

                        <div class="sign-up-form-wrapper">
                            <form method="post" id="create-expertise"  action="src/create-expertise.php">

                                <div class="sign-up-form-container clearfix col-md-9 margin-auto no-padding">
                                    <h1 class="ref-white ref-white-h1">Professional Expertise <div class="pull-right"><img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/register/RG_ICN_Strip_2.png"  width="200"/></div></h1>
                                    <div class="ref-form-container">
                                        <div id="expertise-error" class="alert alert-danger hidden"></div>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6 ref-form-elt">
                                                <input type="text" id="cur-company" name="cur-company" class="form-control ref-form-control" placeholder="Current Company">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-2 ref-form-label no-padding">
                                                    Since
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <select id="since" name="since" class="form-control ref-form-control">
                                                        <option>Select</option>
                                                        <option>1990</option>
                                                        <option>1991</option>
                                                        <option>1992</option>
                                                        <option>1993</option>
                                                        <option>1994</option>
                                                        <option>1995</option>
                                                        <option>1996</option>
                                                        <option>1997</option>
                                                        <option>1998</option>
                                                        <option>1999</option>
                                                        <option>2000</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-1 no-padding">

                                                </div>
                                                <div class="col-md-5 no-padding ref-form-elt">
                                                    <select id="cur-industry" name="cur-industry" class="form-control ref-form-control">
                                                        <option>
                                                            Industry
                                                        </option>
                                                        <?php
//                                                   
                                                        $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($indusId, $industry);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {
                                                            echo "<option value='$indusId'>$industry</option>";
                                                        }
                                                        $stmt1->close();
//                                                    
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6">
                                                <input type="text" id="pre-company" name="pre-company[]" class="pre-company-auto form-control ref-form-control" placeholder="Previous Company">
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
                                                        $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($indusId, $industry);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {
                                                            echo "<option value='$indusId'>$industry</option>";
                                                        }
                                                        $stmt1->close();
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
                                                <input type="text" id="pre-company2" name="pre-company[]" class="pre-company-auto form-control ref-form-control" placeholder="Previous Company">
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
                                                        $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($indusId, $industry);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {
                                                            echo "<option value='$indusId'>$industry</option>";
                                                        }
                                                        $stmt1->close();
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
                                                <input type="text" id="pre-company3" name="pre-company[]" class="pre-company-auto form-control ref-form-control" placeholder="Previous Company">
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
                                                        $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($indusId, $industry);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {
                                                            echo "<option value='$indusId'>$industry</option>";
                                                        }
                                                        $stmt1->close();
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
                                                <input type="text" id="pre-company4" name="pre-company[]" class="pre-company-auto form-control ref-form-control" placeholder="Previous Company">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-2 ref-form-label no-padding ref-form-elt">
                                                    Years
                                                </div>
                                                <div  class="col-md-2 no-padding ref-form-elt">
                                                    <input type="text" id="pre-year4"  name="pre-year[]" class="form-control ref-form-control" />
                                                </div>
                                                <div class="col-md-1 no-padding ref-form-elt">

                                                </div>
                                                <div class="col-md-5 no-padding ref-form-elt">
                                                    <select id="pre-industry4" name="pre-industry[]" class="form-control ref-form-control">
                                                        <option>
                                                            Industry
                                                        </option>
                                                        <?php
                                                        $query1 = "select id, industry from  industry where status='Active' order by industry";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($indusId, $industry);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {
                                                            echo "<option value='$indusId'>$industry</option>";
                                                        }
                                                        $stmt1->close();
                                                        ?>

                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">

                                            <div class="col-md-6 ref-form-elt">
                                                <input type="text" id="designation" name="designation" class="form-control ref-form-control" placeholder="Present Designation">
                                            </div>

                                            <!--                                    <div class="col-md-6">
                                                                                    <select class="form-control ref-form-control">
                                                                                        <option>
                                                                                            CTC
                                                                                        </option>
                                                                                    </select>
                                                                                </div>-->
                                            <div class="col-md-6 ref-form-elt">
                                                <input type="text" id="ctc" name="ctc" class="form-control ref-form-control" placeholder="CTC (in INR)">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6 ref-form-elt">
                                                <div class="ref-form-sub-text">
                                                    Functional Area
                                                </div>
                                                <select id="area" name="area" class="form-control ref-form-control">
                                                    <option>
                                                        Functional Area
                                                    </option>
                                                    <?php
                                                    $query1 = "select id, area from  func_area where status='Active' order by area";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($funcId, $area);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$funcId'>$area</option>";
                                                    }
                                                    $stmt1->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="ref-form-sub-text col-xs-12 clearfix">
                                                Key Skills & Experience in the skill (Years)
                                                                                            
                                            </div>
                                            <br/>
                                            <div class="ref-form-sub-text col-xs-12 clearfix">
                                                    Please fill in your Key Skills carefully as all the jobs recommended to you would be based on these skills.
                                            </div>
                                            <div class="col-md-6 ref-form-elt">
                                                <div class="col-md-7 no-padding">
                                                    <select id="skill-area"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                            <!--<input type="text" id="skill-area"  name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                   
                                                    <input type="text" id="skill-year" name="skill-year[]" class="form-control ref-form-control" />
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-6 no-padding ref-form-elt">
                                                      <select id="skill-area2"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area2" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->

                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year2" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                            </div>

                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6">
                                                <div class="col-md-7 no-padding ref-form-elt">
                                                        <select id="skill-area3"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area3" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year3" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-6 no-padding ref-form-elt">
                                                      <select id="skill-area4"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area4" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                    <!--                                                        <option>
                                                                                                                Key Skill
                                                                                                            </option>
                                                    <?php
                                                    $query1 = "select id, area from  func_area where status='Active' order by area";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($funcId4, $area4);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$funcId4'>$area4</option>";
                                                    }
                                                    $stmt1->close();
                                                    ?>
                                                                                                        </select>
                                                                                                        </select>-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year4" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                                <div class="col-md-1 no-padding ref-form-elt text-center">
                                                    <div id="skillAdd1" class="yellow-btn ref-plus-btn">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                            <div class="col-md-2 no-padding ref-form-elt text-center">
                                                                                            <div id="skillAdd1" class="yellow-btn ref-plus-btn">
                                                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                                            </div>
                                                                                        </div>-->
                                        </div>
                                        </br>
                                        <div id="skill-another1" class="ref-form-box clearfix hidden">
                                            <div class="col-md-6">
                                                <div class="col-md-7 no-padding ref-form-elt">
                                                      <select id="skill-area5"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area5" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year5" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-6 no-padding ref-form-elt">
                                                      <select id="skill-area6"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area6" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year6" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                                <div class="col-md-1 no-padding ref-form-elt text-center">
                                                    <div id="skillAdd2" class="yellow-btn ref-plus-btn">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        </br>
                                        <div id="skill-another2" class="ref-form-box clearfix hidden">
                                            <div class="col-md-6">
                                                <div class="col-md-7 no-padding ref-form-elt">
                                                     <select id="skill-area7"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area7" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year7" name="skill-year[]" class="form-control ref-form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-6 no-padding ref-form-elt">
                                                     <select id="skill-area8"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                                    </select>
                                                    <!--<input type="text" id="skill-area8" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                                                    Year/s
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <input type="text" id="skill-year8" name="skill-year[]" class="form-control ref-form-control"/>
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
                                            <div class="col-md-6">
                                                <div class="ref-form-sub-text">
                                                    Basic/Graduation
                                                </div>
                                                <select id="graduation" name="education[]" class="form-control ref-form-control">
                                                    <option>
                                                        Graduation
                                                    </option>
                                                    <?php
                                                    $query1 = "select id, degree, edu_type from  education where status='Active' and edu_type='Graduation' order by degree";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($degreeId, $degree, $eduType);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {

                                                        echo "<option value='$degreeId'>$degree</option>";
                                                    }
                                                    $stmt1->close();
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 ref-form-elt">
                                                <div class="ref-form-sub-text">
                                                    Specialization
                                                </div>
    <!--                                            <select id="grad-specialization" name="edu-specialization[]" class="form-control ref-form-control">
                                                    <option>
                                                        Specialization
                                                    </option>
                                                    <option>
                                                        Accountant
                                                    </option>
                                                    <option>
                                                        Computer Science
                                                    </option>
                                                </select>-->
                                                <input type="text" id="grad-specialization" name="edu-specialization[]" class="form-control ref-form-control">
                                            </div>
                                            <div class="col-md-2 ref-form-elt">
                                                <div class="ref-form-sub-text">
                                                    %
                                                </div>
                                                <input type="text" id="percentage" name="percentage[]" class="form-control ref-form-control"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6">
                                                <div class="ref-form-sub-text ref-form-elt">
                                                    University/Institute
                                                </div>
                                                <select id="grad-university" name="edu-university[]" class="form-control ref-form-control">
                                                    <option>
                                                        University/Institute
                                                    </option>
                                                    <?php
                                                    $query1 = "select id,  institution from   institution where status='Active' and course='Graduation' order by  institution";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($insId, $institution);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {

                                                        echo "<option value='$insId'>$institution</option>";
                                                    }
                                                    $stmt1->close();
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="ref-form-sub-text ref-form-elt">
                                                    Year
                                                </div>
                                                <select id="grad-year" name="edu-year[]" class="form-control ref-form-control">
                                                    <option>Year</option>
                                                    <option>1990</option>
                                                    <option>1991</option>
                                                    <option>1992</option>
                                                    <option>1993</option>
                                                    <option>1994</option>
                                                    <option>1995</option>
                                                    <option>1996</option>
                                                    <option>1997</option>
                                                    <option>1998</option>
                                                    <option>1999</option>
                                                    <option>2000</option>
                                                    <option>2001</option>
                                                    <option>2002</option>
                                                    <option>2003</option>
                                                    <option>2004</option>
                                                    <option>2005</option>
                                                    <option>2006</option>
                                                    <option>2007</option>
                                                    <option>2008</option>
                                                    <option>2009</option>
                                                    <option>2010</option>
                                                    <option>2011</option>
                                                    <option>2012</option>
                                                    <option>2013</option>
                                                    <option>2014</option>
                                                    <option>2015</option>

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
                                                    <option>
                                                        Full Time
                                                    </option>
                                                    <option>
                                                        Part Time
                                                    </option>
                                                    <option>
                                                        Correspondence
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 clearfix">
                                            <hr class="hr-dotted"/>
                                        </div>
                                        <?php
                                        $_delete_post = "";
                                        if ($_COOKIE["delete-post-graduation"] == 1) {
                                            $_delete_post = "style='display:none;'";
                                        }
                                        ?>
                                        <div id="post-hide"  class="ref-form-box clearfix" <?= $_delete_post ?>>
                                            <div class="ref-form-box clearfix">
                                                <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                                    Education
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Post Graduation
                                                    </div>
                                                    <select id="post-graduation" name="education[]" class="form-control ref-form-control">
                                                        <option>
                                                            Post Graduation
                                                        </option>
                                                        <?php
                                                        $query1 = "select id, degree, edu_type from  education where status='Active' and edu_type='Post Graduation' order by degree";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($postId, $postDegree, $postType);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {

                                                            echo "<option value='$postId'>$postDegree</option>";
                                                        }
                                                        $stmt1->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Specialization
                                                    </div>
                                                    <input type="text" id="post-specialization" name="edu-specialization[]" class="form-control ref-form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        %
                                                    </div>
                                                    <input type="text" id="post-percentage" name="percentage[]" class="form-control ref-form-control" placeholder="100%"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="ref-form-box clearfix">
                                                <div class="col-md-6">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        University/Institute
                                                    </div>
                                                    <select id="post-university" name="edu-university[]" class="form-control ref-form-control">
                                                        <option>
                                                            University/Institute
                                                        </option>
                                                        <?php
                                                        $query1 = "select id,  institution from   institution where status='Active' and (course='Post-Graduation' or course='Doctorate') order by  institution";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($postInsId, $postInstitution);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {

                                                            echo "<option value='$postInsId'>$postInstitution</option>";
                                                        }
                                                        $stmt1->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Year
                                                    </div>
                                                    <select id="post-year" name="edu-year[]" class="form-control ref-form-control">
                                                        <option>Year</option>
                                                        <option>1990</option>
                                                        <option>1991</option>
                                                        <option>1992</option>
                                                        <option>1993</option>
                                                        <option>1994</option>
                                                        <option>1995</option>
                                                        <option>1996</option>
                                                        <option>1997</option>
                                                        <option>1998</option>
                                                        <option>1999</option>
                                                        <option>2000</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>



                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Type
                                                    </div>
                                                    <select id="post-type" name="edu-type[]" class="form-control ref-form-control">
                                                        <option>
                                                            Type
                                                        </option>
                                                        <option>
                                                            Full Time
                                                        </option>
                                                        <option>
                                                            Part Time
                                                        </option>
                                                        <option>
                                                            Correspondence
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <?php
                                        $_delete_doc = "style='display:none;'";
                                        if ($_COOKIE["delete-doctorate"] == 1) {
                                            $_delete_doc = "";
                                        }
                                        ?>
                                        <div  class="ref-form-box clearfix "  id="collapseExample"  <?= $_delete_doc ?>>
                                            <div class="ref-form-box clearfix">
                                                <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                                                    Education
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Doctorate
                                                    </div>
                                                    <select id="doctorate" name="education[]" class="form-control ref-form-control">
                                                        <option>
                                                            Doctorate
                                                        </option>
                                                        <?php
                                                        $query1 = "select id, degree, edu_type from  education where status='Active' and edu_type='Doctorate' order by degree";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($doctorateId, $doctorate, $doctorateType);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {

                                                            echo "<option value='$doctorateId'>$doctorate</option>";
                                                        }
                                                        $stmt1->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Specialization
                                                    </div>
                                                    <input type="text" id="doctorate-specialization" name="edu-specialization[]" class="form-control ref-form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        %
                                                    </div>
                                                    <input type="text" id="doctorate-percentage" name="percentage[]" class="form-control ref-form-control" placeholder="100%"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="ref-form-box clearfix">
                                                <div class="col-md-6">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        University/Institute
                                                    </div>
                                                    <select id="doctorate-university" name="edu-university[]" class="form-control ref-form-control">
                                                        <option>
                                                            University/Institute
                                                        </option>
                                                        <?php
                                                        $query1 = "select id,  institution from   institution where status='Active' and (course='Post-Graduation' or course='Doctorate') order by  institution";
                                                        $stmt1 = $con->prepare($query1);
                                                        $stmt1->execute();
                                                        $stmt1->bind_result($docId, $docInstitution);
                                                        $stmt1->store_result();
                                                        while ($stmt1->fetch()) {

                                                            echo "<option value='$docId'>$docInstitution</option>";
                                                        }
                                                        $stmt1->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="ref-form-sub-text ref-form-elt">
                                                        Year
                                                    </div>
                                                    <select id="doctorate-year" name="edu-year[]" class="form-control ref-form-control">
                                                        <option>Year</option>
                                                        <option>1990</option>
                                                        <option>1991</option>
                                                        <option>1992</option>
                                                        <option>1993</option>
                                                        <option>1994</option>
                                                        <option>1995</option>
                                                        <option>1996</option>
                                                        <option>1997</option>
                                                        <option>1998</option>
                                                        <option>1999</option>
                                                        <option>2000</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>



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
                                                        <option>
                                                            Full Time
                                                        </option>
                                                        <option>
                                                            Part Time
                                                        </option>
                                                        <option>
                                                            Correspondence
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <?php
                                        if ($_COOKIE["delete-post-graduation"] == 0) {
                                            ?>
                                            <div id="post-delete" class="col-md-12 clearfix pointer-cursor">
                                                <a >Delete Post Graduation</a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div id="post-delete" class="col-md-12 clearfix pointer-cursor">
                                                <a >Add Post Graduation</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($_COOKIE["delete-doctorate"] == 0) {
                                            ?>
                                            <div id="doc-delete" class="col-md-12 clearfix pointer-cursor">
                                                <a >Add PhD/Doctorate</a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div id="doc-delete" class="col-md-12 clearfix pointer-cursor">

                                                <a >Delete PhD/Doctorate</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-md-12 clearfix">
                                            <hr class="hr-dotted"/>
                                        </div>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-6">
                                                <div class="ref-form-sub-text">
                                                    Upload your Resume ( pdf/doc )
                                                </div>
                                                <input type="file" id="resume" name="resume" class="form-control" />
                                            </div>
                                        </div>
                                        <!--                                    <div class="col-xs-12 clear form-group col-md-6">
                                                                                <label for="profile-pic">Picture</label>
                                                                                <input type="file" class="form-control" id="profile-pic" name="img-path" placeholder="select pic">
                                                                            </div>-->

                                        <br/>

                                    </div>
                                    <div class="text-right">
                                        <br/>
                                        <br/>
                                        <div class="col-xs-6 col-md-6 text-left no-padding">
                                            <button  class="blue-btn" id="insertBack">BACK</button>
                                        </div>
                                        <input type="submit" id="insertExpert"  value="NEXT" class="blue-btn" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include './footer.php'; ?>

            <!-- external javascript -->

            <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>




        </body>
    </html>
    <?php
} catch (Exception $e) {
    $result = array();
    $result["err"] = "true";
    $result["msg"] = "Error: $e";
    print_r(json_encode($result));
}
$con->close();
?>