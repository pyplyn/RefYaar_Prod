<?php
session_start();
ob_start();
require("../../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
?>
<div    id="select-job" class="jobs-container col-md-12 no-padding clearfix">
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
                if ($_GET["key"] == "Location") {
                    $Query = "select a.organization,a.headline,c.area,a.min_req_exp,a.max_req_exp,b.city,a.status,a.post_time from job_post a,location__city b, func_area c where a.city_id=b.id and a.func_area_id=c.id and user_id=? order by a.post_time desc";
                    $stmt = $con->prepare($Query);
                    $stmt->bind_param('s', $_GET["id"]);
                    $stmt->execute();
                    $stmt->bind_result($organization, $headline, $area, $minExp, $maxExp, $city, $status, $postTime);
                    $stmt->store_result();
                    while ($stmt->fetch()) {
                        ?>
                        <tr id="select-job">
                            <td><?= $organization ?> - <?= $area ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</td>
                            <td><?= $city ?></td>
                            <td><?= $postTime ?></td>
                            <td><label class="label <?php if ($status == "Open") { ?>label-success <?php } elseif ($status == "In Progress") { ?>label-warning<?php } else { ?>label-danger <?php } ?>"><?= $status ?></label> <span class="fa fa-times remove-record"></span></td>
                        </tr>
                        <?php
                    }
                } else {
                    $Query = "select a.organization,a.headline,c.area,a.min_req_exp,a.max_req_exp,b.city,a.status,a.post_time from job_post a,location__city b, func_area c where a.city_id=b.id and a.func_area_id=c.id and a.status=? order by a.post_time desc";
                    $stmt = $con->prepare($Query);
                    $stmt->bind_param('s', $_GET["key"]);
                    $stmt->execute();
                    $stmt->bind_result($organization, $headline, $area, $minExp, $maxExp, $city, $status, $postTime);
                    $stmt->store_result();
                    while ($stmt->fetch()) {
                        ?>
                        <tr>
                            <td><?= $organization ?> - <?= $area ?> - <?= $headline ?> (<?= $minExp ?>-<?= $maxExp ?> yrs)</td>
                            <td><?= $city ?></td>
                            <td><?= $postTime ?></td>
                            <td><label class="label <?php if ($status == "Open") { ?>label-success <?php } elseif ($status == "In Progress") { ?>label-warning<?php } else { ?>label-danger <?php } ?>"><?= $status ?></label> <span class="fa fa-times remove-record"></span></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
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