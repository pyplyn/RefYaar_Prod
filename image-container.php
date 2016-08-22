<?php
require("config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query01 = "select e.id,e.title,e.f_name,e.l_name,e.email,e.phone,e.state,g.country,e.image from users e,  location__country g where  e.country=g.id  and e.id=?";
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
<!--            <div class="col-xs-12 col-md-4">
                <div class="col-md-12 no-padding">
                    <span id="fb-login-btn" class="login-btn-sqr">
                        <span class="login-btn-icon">
                            <span class="fa fa-facebook">

                            </span>
                        </span>
                        <span class="login-btn-text">
                            Connect with Facebook
                        </span>
                    </span>
                </div>
                <br/>

                <div class="col-md-12 no-padding">
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
                </div>
                <br/>
                <div class="col-md-12 no-padding">
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
            </div>-->
            <div class="col-md-12 clearfix">
                <div class="text-right">
                    <input id="profile-updation" type="submit" value="UPDATE IMAGE" class="blue-btn" />
                </div>
            </div>
        </div>


    </form>
</div>