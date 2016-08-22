<?php
session_start();
ob_start();
if ($_SESSION["bw_auth"] != "true") {
    header("location:index.php?page=my");
}
require("config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());

$QueryPre = "select sum(year) from prev_com where user_id=?";
$stmtPre = $con->prepare($QueryPre);
$stmtPre->bind_param('s', $_SESSION["social_id"]);
$stmtPre->execute();
$stmtPre->bind_result($preYear);
$stmtPre->store_result();
$stmtPre->fetch();
if ($preYear == NULL) {
    $preExperience = 0;
} else {
    $preExperience = $preYear;
}
$QueryCur = "select cur_com_since from user_profile where user_id=?";
$stmtCur = $con->prepare($QueryCur);
$stmtCur->bind_param('s', $_SESSION["social_id"]);
$stmtCur->execute();
$stmtCur->bind_result($curYear);
$stmtCur->store_result();
$stmtCur->fetch();

if ($curYear == 0) {
    $curExperience = 0;
} else {
    $QueryCurExp = "select YEAR(CURDATE()) - cur_com_since from user_profile where user_id=?";
    $stmtCurExp = $con->prepare($QueryCurExp);
    $stmtCurExp->bind_param('s', $_SESSION["social_id"]);
    $stmtCurExp->execute();
    $stmtCurExp->bind_result($curExperience);
    $stmtCurExp->store_result();
    $stmtCurExp->fetch();
}
$totalExperience = $curExperience + $preExperience;
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>My Job Openings | RefYaar</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/my-jobs.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- jQuery -->
        <!-- data table plugin -->
        <script src='https://s3.amazonaws.com/refyaar/staticContent/js/jquery.dataTables.min.js'></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/job-opening.js"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
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
        <div class="page-wrapper">
            <div class="page-container clearfix">
                <div class="col-md-11 col-xs-12 col-sm-11 margin-auto no-padding clearfix">
                    <div class="col-md-12 no-padding clearfix">
                        <div class="ref-container-left col-md-9">

                            <div class="clearfix">
                                <div class="ref-head-xl pull-left">
                                    My Job Openings
                                </div>
                                <input type="hidden" id="totalExp" name="id" value="<?= $totalExperience ?>">
                                <input type="hidden" id="id" name="id" value="<?= $_SESSION["social_id"] ?>">
                                <div class="filter-actions pull-right">
                                    <select class="ref-filter-select">
                                        <option> Location</option>
                                        <?php
                                        $con4 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $QueryCity = "call select_job_city(?)";
                                        $stmtCity = $con4->prepare($QueryCity);
                                        $stmtCity->bind_param('i', $_SESSION["social_id"]);
                                        $stmtCity->execute();
                                        $stmtCity->bind_result($cityId, $locationCity);
                                        $stmtCity->store_result();
                                        while ($stmtCity->fetch()) {
                                            ?>
                                            <option value="<?= $locationCity ?>"   class="cityFilter"><?= $locationCity ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="filter-actions pull-right">
                                    <select class="ref-filter-select-funcArea">
                                        <option> Functional Area</option>
                                        <?php
                                        $con5 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                        $QueryFuncArea = "call select_job_func_area(?)";
                                        $stmtFuncArea = $con5->prepare($QueryFuncArea);
                                        $stmtFuncArea->bind_param('i', $_SESSION["social_id"]);
                                        $stmtFuncArea->execute();
                                        $stmtFuncArea->bind_result($funcAreaId, $funcArea);
                                        $stmtFuncArea->store_result();
                                        while ($stmtFuncArea->fetch()) {
                                            ?>
                                            <option value="<?= $funcArea ?>"   class="cityFilter"><?= $funcArea ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <!--<button class="yellow-btn ref-yellow-btn-select">Filter</button>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <br/>
                    <div id="ajax-job-post" class="jobs-container col-md-12 no-padding clearfix">
                        <div class="ref-table-container col-md-9 clearfix">

                            <table id="example" class="table-bordered table-hover table-responsive table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Job Title (Years of Experience)</th>
                                        <th>Functional Area</th>
                                        <th>Location</th>
                                        <th>Post Date</th>    
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Job Title (Years of Experience)</th>
                                        <th>Functional Area</th>
                                        <th>Location</th>
                                        <th>Post Date</th>    
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $con3 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                                    $queryProcedure = "call select_job(?)";
                                    $stmtProcedure = $con3->prepare($queryProcedure);
                                    $stmtProcedure->bind_param('i', $_SESSION["social_id"]);
                                    $stmtProcedure->execute();
                                    $stmtProcedure->bind_result($postJobId, $funcArea, $organization, $headline, $minExp, $maxExp, $city, $status, $postTime);
                                    $stmtProcedure->store_result();
                                    while ($stmtProcedure->fetch()) {
                                        ?>
                                        <tr>
                                            <td><span class="view-admin" attr-id="<?= $postJobId ?>"  data-toggle="modal" data-target="#viewAdminModal"><?= $organization ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</span></td>
                                            <td><?= $funcArea ?></td>
                                            <td><?=$city?></td>
                                            <td><?= $postTime ?></td>
                                            <?php
                                            $Query1 = "select count(*) from job_applied where job_post_id=? and user_id=?";
                                            $stmt1 = $con1->prepare($Query1);
                                            $stmt1->bind_param('ii', $postJobId, $_SESSION["social_id"]);
                                            $stmt1->execute();
                                            $stmt1->bind_result($countapplied);
                                            $stmt1->store_result();
                                            $stmt1->fetch();
                                            ?>
                                            <td class="externalJob"><label <?php if (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-primary" id="open" attr-id="<?= $postJobId ?>" <?php } elseif (($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-danger"<?php } else { ?>class="label label-success"<?php } ?>><?php if (($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>APPLIED <?php } else if (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>CLICK TO APPLY<?php } else { ?><?= $status ?><?php } ?></label> <span class="fa fa-times remove-record"></span></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="ref-container-right col-md-3 clearfix">
                            <!--<h3 style="margin-top: 0px;">Advertise Here</h3>-->
                            <div style="height: 150px;">
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
                            <!--<div class="advertise" style="height: 400px;">

                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="viewAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">My Job Opening</h4>
                            </div>
                            <div id="viewAdminModalBody" class="modal-body">
                                Loading...
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
