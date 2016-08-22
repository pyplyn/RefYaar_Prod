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
        <title>Job | RefYaar</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/view-job-actions.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.js" type="text/javascript"></script>
        <!-- data table plugin -->
        <script src='https://s3.amazonaws.com/refyaar/staticContent/js/jquery.dataTables.min.js'></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/my-job.js"></script>
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
        <?php include './header.php'; ?>
        <?php
        $Query = "select a.status  from job_post a where id=?";
        $stmt = $con->prepare($Query);
        $stmt->bind_param('s', $_GET["id"]);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->store_result();
        $stmt->fetch();
        if (($status == "In Progress") || ($status == "Inactive")) {
            ?>  <div class="page-wrapper">
                <div class="page-container clearfix">
                    <div class="col-md-11 col-xs-12 col-sm-11 margin-auto no-padding clearfix">
                        <div class="col-md-12 no-padding clearfix">
                            <div class="ref-container-left col-md-9">

                                <div class="clearfix">
                                    <div class="ref-head-xl pull-left">
                                        Take Action
                                    </div>
                                    <div class="filter-actions pull-right">
                                        <?php
                                        $Query1 = "select a.organization, a.headline, b.area, c.city, a.min_req_exp, a.max_req_exp from job_post a,func_area b, location__city c where a.func_area_id=b.id and a.city_id=c.id and a.id=?";
                                        $stmt1 = $con->prepare($Query1);
                                        $stmt1->bind_param('s', $_GET["id"]);
                                        $stmt1->execute();
                                        $stmt1->bind_result($organization, $headline, $area, $city, $minExp, $maxExp);
                                        $stmt1->store_result();
                                        if ($stmt1->fetch()) {
                                            ?>
                                            <div class="ref-head-lg">
                                                <?= $organization ?> <?= $city ?>
                                            </div>
                                            <div class="ref-head-sm">
                                                <?= $area ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)
                                            </div>
                                            <?php
                                        }
                                        $stmt1->close();
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br/>
                        <div class="jobs-container col-md-12 no-padding clearfix">
                            <div class="ref-table-container col-md-9 clearfix">
                                <form method="post" id="done-action"  action="src/post-job/view-action.php">
                                    <div class="alert alert-danger hidden" id="checkbox-error">Email sent successfully</div>
                                    <table id="example" class="table-bordered table-hover table-responsive table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Candidate</th>
                                                <th>Present Co.</th>
                                                <th>Shortlist</th>    
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Candidate</th>
                                                <th>Present Co.</th>
                                                <th>Shortlist</th>    
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $resultRank = array();
                                            $QueryJobId = "select a.id from users a where ((select sum(year) from prev_com where user_id=a.id)+(select YEAR(CURDATE()) - cur_com_since from user_profile where user_id=a.id)) >= (select min_req_exp from job_post where id=?) and ((select sum(year) from prev_com where user_id=a.id)+(select YEAR(CURDATE()) - cur_com_since from user_profile where user_id=a.id)) <= (select max_req_exp from job_post where id=?) and (select cur_company from user_profile where user_id=a.id) != (select organization from job_post where id=?) and (select func_area from user_profile where user_id=a.id) = (select func_area_id from job_post where id=?) and (select id from job_post where id=?) in (select distinct z.job_post_id from job_keyword z, key_skill y where y.user_id=a.id and y.key_skill=z.keyword_id)";
                                            $stmtJobId = $con->prepare($QueryJobId);
                                            $stmtJobId->bind_param('iiiii', $_GET["id"], $_GET["id"], $_GET["id"], $_GET["id"], $_GET["id"]);
                                            $stmtJobId->execute();
                                            $stmtJobId->bind_result($selectedUserId);
                                            $stmtJobId->store_result();
                                            while ($stmtJobId->fetch()) {
                                                $con4 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                                $QueryRank = "call one_rank(?,?)";
                                                $stmtRank = $con4->prepare($QueryRank);
                                                $stmtRank->bind_param('ii', $selectedUserId, $_GET["id"]);
                                                $stmtRank->execute();
                                                $stmtRank->bind_result($userRank);
                                                $stmtRank->store_result();
                                                if ($stmtRank->fetch()) {
                                                    $resultRank[$selectedUserId] = $userRank;
                                                }
                                            }
                                            arsort($resultRank);
//                                            print_r($resultRank);
                                            $arrayCount = count($resultRank);
                                            $i = 0;
                                            foreach ($resultRank as $x => $x_value) {
                                                if ($arrayCount < 10) {
                                                    $Query1 = "select a.f_name,a.id,b.cur_company from users a,user_profile b where a.id=? and b.user_id=a.id ";
                                                    $stmt1 = $con->prepare($Query1);
                                                    $stmt1->bind_param('i', $x);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($userName, $userId, $curCompany);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        ?>
                                                        <tr>
                                                            <td ><span class="view-profile" attr-id="<?= $userId ?>" attr-ses="<?= $_SESSION["social_id"] ?>" data-toggle="modal" data-target="#viewAdminModal"><?= $userName ?></span></td>
                                                            <td><?= $curCompany ?></td>
                                                            <td><input type="checkbox" name="checkbox[]" value="<?= $userId ?>" id="checkbox"/></td>
                                                    <input type="hidden" id="appId" name="appId" value="<?= $_GET["id"] ?>">
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                if ($i < 10) {
                                                    $Query1 = "select a.f_name,a.id,b.cur_company from users a,user_profile b where a.id=? and b.user_id=a.id ";
                                                    $stmt1 = $con->prepare($Query1);
                                                    $stmt1->bind_param('i', $x);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($userName, $userId, $curCompany);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        ?>
                                                        <tr>
                                                            <td ><span class="view-profile" attr-id="<?= $userId ?>" attr-ses="<?= $_SESSION["social_id"] ?>" data-toggle="modal" data-target="#viewAdminModal"><?= $userName ?></span></td>
                                                            <td><?= $curCompany ?></td>
                                                            <td><input type="checkbox" name="checkbox[]" value="<?= $userId ?>" id="checkbox"/></td>
                                                        <input type="hidden" id="appId" name="appId" value="<?= $_GET["id"] ?>">
                                                        </tr>
                                                        <?php
                                                    }
                                                    $i++;
                                                }
                                            }
                                        }
                                        ?>

                                        </tbody>
                                        <input type="hidden" id="applicantId" name="applicantId" value="<?= $_GET["id"] ?>">
                                    </table>
                                    <div class="text-left clearfix">

                                        <input type="submit" value="SUBMIT" class="blue-btn">
                                    </div>
                                </form>
                            </div>
                            <!--<div class="ref-container-right col-md-3 clearfix">
                                <h3 style="margin-top: 0px;">Advertise Here</h3>
                                <div class="advertise" style="height: 150px;">

                                </div>
                                <br/>
                                <div class="advertise" style="height: 400px;">

                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="modal fade" id="viewAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">My Profile</h4>
                                </div>
                                <div id="viewAdminModalBody" class="modal-body">
                                    Loading...
                                </div>
                                <!--                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php } else { ?>

            <div class="page-wrapper">
                <div class="page-container clearfix">
                    <div class="col-md-11 col-xs-12 col-sm-11 margin-auto no-padding clearfix">
                        <div class="col-md-12 no-padding clearfix">
                            <div class="ref-container-left col-md-9">

                                <div class="clearfix">
                                    <div class="ref-head-xl pull-left">
                                        Opps no action performed
                                    </div>

                                    <div class="filter-actions pull-right">


                                        <div class="ref-head-lg">

                                        </div>
                                        <div class="ref-head-sm">

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <br/>
                        <div class="jobs-container col-md-12 no-padding clearfix">
                            <div class="ref-table-container col-md-9 clearfix">
                                <table id="example" class="table-bordered table-hover table-responsive table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Candidate</th>
                                            <th>Present Co.</th>
                                            <th>Shortlist</th>    
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Candidate</th>
                                            <th>Present Co.</th>
                                            <th>Shortlist</th>    
                                        </tr>
                                    </tfoot>
                                    <tbody>  </tbody>
                                </table>
                            </div>
                            <div class="ref-container-right col-md-3 clearfix">
                                <h3 style="margin-top: 0px;">Advertise Here</h3>
                                <div class="advertise" style="height: 150px;">

                                </div>
                                <br/>
                                <div class="advertise" style="height: 400px;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="viewAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">My Profile</h4>
                                </div>
                                <div id="viewAdminModalBody" class="modal-body">
                                    Loading...
                                </div>
                                <!--                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php include './footer.php'; ?>
    </body>
</html>
