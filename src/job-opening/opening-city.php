<?php
session_start();
ob_start();
require("../../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$con3 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$totalEcperience = $_GET["totalExp"];
$session = $_GET["id"];
?>
<div   id="select-job" class="jobs-container col-md-12 no-padding clearfix">
    <div  class="ref-table-container col-md-9 clearfix">
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
                if ($_GET["key"] == "Location") {
                    $con1 = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
                    $Query = "call select_job(?)";
                    $stmt = $con1->prepare($Query);
                    $stmt->bind_param('i', $_SESSION["social_id"]);
                    $stmt->execute();
                    $stmt->bind_result($postJobId, $funcArea, $organization, $headline, $minExp, $maxExp, $city, $status, $postTime);
                    $stmt->store_result();
                    while ($stmt->fetch()) {
                        ?>
                        <tr>
                            <td ><span class="view-admin" attr-id="<?= $postJobId ?>"  data-toggle="modal" data-target="#viewAdminModal"><?= $organization ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</span></td>
                            <td><?= $funcArea ?></td>
                            <td><?= $city ?></td>
                            <td><?= $postTime ?></td>
                            <?php
                            $Query1 = "select count(*) from job_applied where job_post_id=? and user_id=?";
                            $stmt1 = $con->prepare($Query1);
                            $stmt1->bind_param('ii', $postJobId, $_SESSION["social_id"]);
                            $stmt1->execute();
                            $stmt1->bind_result($countapplied);
                            $stmt1->store_result();
                            $stmt1->fetch();
                            ?>
                            <td class="externalPosted"><label <?php if (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-primary" id="open" attr-id="<?= $postJobId ?>" <?php } elseif (($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-danger"<?php } else { ?>class="label label-success"<?php } ?>><?php if (($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>APPLIED <?php } else if (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>NOT APPLIED<?php } else { ?><?= $status ?><?php } ?></label> <span class="fa fa-times remove-record"></span></td>
                        </tr>

                        <?php
                    }
                    $stmt->close();
                    $con1->close();
                } else {
                    $queryCityProce = "call select_job(?)";
                    $stmtCityProce = $con->prepare($queryCityProce);
                    $stmtCityProce->bind_param('s', $_SESSION["social_id"]);
                    $stmtCityProce->execute();
                    $stmtCityProce->bind_result($cityPostId, $funcArea, $organization, $headline, $minExp, $maxExp, $city, $status, $postTime);
                    $stmtCityProce->store_result();
                    while ($stmtCityProce->fetch()) {
                        $Query = "select c.id,e.area,c.organization,c.headline,c.min_req_exp,c.max_req_exp,c.status,c.post_time,d.city from job_post c,location__city d,func_area e where c.city_id=d.id  and c.func_area_id=e.id   and d.city=? and c.id=?";
                        $stmt = $con3->prepare($Query);
                        $stmt->bind_param('si', $_GET["key"], $cityPostId);
                        $stmt->execute();
                        $stmt->bind_result($postJobId, $funcArea, $organization, $headline, $minExp, $maxExp, $status, $postTime, $city);
                        $stmt->store_result();
                        while ($stmt->fetch()) {
                            ?>
                            <tr>
                                <td ><span class="view-admin" attr-id="<?= $postJobId ?>"  data-toggle="modal" data-target="#viewAdminModal"><?= $organization ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</span></td>
                                <td><?= $funcArea ?></td>
                                <td><?= $city ?></td>
                                <td><?= $postTime ?></td>
                                <?php
                                $Query11 = "select count(*) from job_applied where job_post_id=? and user_id=?";
                                $stmt11 = $con3->prepare($Query11);
                                $stmt11->bind_param('ii', $cityPostId, $_SESSION["social_id"]);
                                $stmt11->execute();
                                $stmt11->bind_result($countapplied1);
                                $stmt11->store_result();
                                $stmt11->fetch();
                                ?>
                                <td class="externalPosted"><label <?php if (($countapplied1 < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-primary" id="open" attr-id="<?= $cityPostId ?>" <?php } elseif (($countapplied1 > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>class="label label-danger"<?php } else { ?>class="label label-success"<?php } ?>><?php if (($countapplied1 > 0) && ($status != "Inactive") && ($status != "Closed")) { ?>APPLIED <?php } else if (($countapplied1 < 1) && ($status != "Inactive") && ($status != "Closed")) { ?>NOT APPLIED<?php } else { ?><?= $status ?><?php } ?></label> <span class="fa fa-times remove-record"></span></td>
                            </tr>

                            <?php
                        }
                    }
                    $stmt->close();
                    $con3->close();
                    $stmtCityProce->close();
                    $con->close();
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
</div>