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
        <title>My Job Posts | RefYaar</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/my-jobs.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- data table plugin -->
        <script src='https://s3.amazonaws.com/refyaar/staticContent/js/jquery.dataTables.min.js'></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/my-job.js"></script>
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
                                    My Job Posts
                                </div>
                                <input type="hidden" id="id" name="id" value="<?= $_SESSION["social_id"] ?>">
                                <div class="filter-actions pull-right">
                                    <select class="ref-filter-select">
                                        <option> Location</option>
                                        <?php
                                        $QueryCity = "select distinct a.city,a.id from location__city a ,job_post b where b.city_id=a.id and b.user_id=?";
                                        $stmtCity = $con->prepare($QueryCity);
                                        $stmtCity->bind_param('s', $_SESSION["social_id"]);
                                        $stmtCity->execute();
                                        $stmtCity->bind_result($locationCity, $cityId);
                                        $stmtCity->store_result();
                                        while ($stmtCity->fetch()) {
                                            ?>
                                            <option value="<?= $locationCity ?>" class="cityFilter"><?= $locationCity ?></option>
                                        <?php } ?>
                                    </select>
                                    <button class="yellow-btn ref-yellow-btn-select">Filter</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br/>
                    <div   id="ajax-job-post" class="jobs-container col-md-12 no-padding clearfix">
                        <div  class="ref-table-container col-md-9 clearfix">
                            <table id="example" class="table-bordered table-hover table-responsive table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Job Title (Years of Experience)</th>
                                        <th>Location</th>
                                        <th>Post Date</th>    
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Job Title (Years of Experience)</th>
                                        <th>Location</th>
                                        <th>Post Date</th>    
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $Query = "select a.id,a.organization,a.headline,c.area,a.min_req_exp,a.max_req_exp,b.city,a.status,a.post_time from job_post a,location__city b, func_area c where a.city_id=b.id and a.func_area_id=c.id and user_id=? order by a.post_time desc";
                                    $stmt = $con->prepare($Query);
                                    $stmt->bind_param('s', $_SESSION["social_id"]);
                                    $stmt->execute();
                                    $stmt->bind_result($myPostId, $organization, $headline, $area, $minExp, $maxExp, $city, $status, $postTime);
                                    $stmt->store_result();
                                    while ($stmt->fetch()) {
                                        ?>
                                        <tr>
                                            <td><span class="view-admin" attr-id="<?= $myPostId ?>" attr-ses="<?= $_SESSION["social_id"] ?>" data-toggle="modal" data-target="#viewAdminModal"><?= $organization ?> - <?= $area ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</span></td>
    <!--                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>-->
                                            <td><?= $city ?></td>
                                            <td><?= $postTime ?></td>
                                            <td class="externalPosted"><label <?php if ($status == "Open") { ?>class="label label-success" <?php } elseif ($status == "In Progress") { ?>class="label label-warning"<?php } else { ?>class="label label-danger" <?php } ?>><?= $status ?></label> <?php if (($status == "In Progress") || ($status == "Inactive")) { ?><a href="view-job-actions.php?id=<?= $myPostId ?>" class="label label-info"><span class="fa fa-search"></span> View</a> <?php } ?> <span class="fa fa-times remove-record"></span></td>
                                        </tr>
                                    <?php } ?>

<!--                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-success">OPEN</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-danger">CLOSED</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-danger">CLOSED</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-danger">CLOSED</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-warning">IN PROGRESS</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-warning">IN PROGRESS</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-warning">IN PROGRESS</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-warning">IN PROGRESS</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>
                                    <tr>
                                        <td>IIT Delhi - Manager - Corporate Communication (3-5 yrs)</td>
                                        <td>Delhi</td>
                                        <td>23/07/2015</td>
                                        <td><label class="label label-warning">IN PROGRESS</label> <span class="fa fa-times remove-record"></span></td>
                                    </tr>-->
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
                            <!--<div class="advertise" style="height: 400px;">-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="viewAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">My Job Post</h4>
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
        <?php include './footer.php'; ?>
    </body>
</html>
