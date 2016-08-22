<?php
require '../../config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query = "select a.id,a.user_id,a.organization,a.headline,b.area,a.min_req_exp,a.max_req_exp,c.city,a.detailed_jd,a.additional_info,a.jd_path,a.status,a.post_time from job_post a, func_area b,location__city c where a.func_area_id=b.id and a.city_id=c.id and a.id=?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $_GET["id"]);
$stmt->execute();
$stmt->bind_result($id, $userId, $organization, $headline, $area, $minExp, $maxExp, $city, $detailed, $additionalInfo, $jdPath, $status, $postTime);
$stmt->store_result();
if ($stmt->fetch()) {
    ?>
    <div class="clearfix">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Organization</label>
            <div id="delete-admin-username"><?= $organization ?></div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Headline</label>
            <div id="delete-admin-fullname"><?= $headline ?></div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Area</label>
            <div id="delete-admin-fullname"><?= $area ?></div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">City</label>
            <div id="delete-admin-designation"><?= $city ?></div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Minimum required Experience</label>
            <div id="delete-admin-fullname"><?= $minExp ?> Years</div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Maximum required Experience</label>
            <div id="delete-admin-fullname"><?= $maxExp ?> Years</div>
        </div>
        <?php if ((strlen($detailed) > 0)) { ?>
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Detailed Description</label>
                <div id="delete-admin-fullname" style="text-align: justify;"><?= $detailed ?></div>
            </div>
        <div class="form-group col-md-12">
            <label for="exampleInputEmail1">Job keyword</label>

            <div id="delete-admin-status"><?php
                $i = 0;
                $queryCount = "select count(*) from job_keyword where job_post_id=?";
                $stmtCount = $con->prepare($queryCount);
                $stmtCount->bind_param('i', $id);
                $stmtCount->execute();
                $stmtCount->bind_result($count);
                $stmtCount->store_result();
                $stmtCount->fetch();
                $comma = ($count - 1);
                $stmtCount->close();
                $query = "select b.keyword from job_keyword a,keywords b where a.keyword_id=b.id and a.job_post_id=?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->bind_result($jobKeyword);
                $stmt->store_result();
                while ($stmt->fetch()) {
                    if ($i < $comma) {
                        echo $jobKeyword . ", ";
                    } else {
                        echo $jobKeyword . ".";
                    }
                    $i++;
                }
               
                ?></div>

        </div>
        <?php } if ($additionalInfo == "1") { ?>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Post-Graduation required?</label>
                <div id="delete-admin-fullname">Yes</div>
            </div>
        <?php } ?>
        
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Status</label>
            <div id="delete-admin-status"><?= $status ?></div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Post time</label>
            <div id="delete-admin-reg-date"><?= $postTime ?></div>
        </div>
        <?php if ((strlen($jdPath) > 0)) { ?>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <input type="hidden" name="resume" value="<?= $jdPath ?>" >
                    <br/>
                    <div><a href="<?= $jdPath ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-download-alt"></span> Job description</a></div>
                </div>
            </div></br>
        <?php } ?>
    </div>
    <?php
    $Query1 = "select count(*) from job_applied where job_post_id=? and user_id=?";
    $stmt1 = $con->prepare($Query1);
    $stmt1->bind_param('ii', $id, $_GET["social_id"]);
    $stmt1->execute();
    $stmt1->bind_result($countapplied);
    $stmt1->store_result();
    $stmt1->fetch();
    $stmt1->close();
    ?>
    <div class="modal-footer">
        <?php
        if ((($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) || (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed"))) {
            ?>
            <button type="button" class="btn btn-success " attr-id="<?= $id ?>"  <?php if (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) {
                ?> id="open"
                    <?php }
                    ?>> <?php
                        if (($countapplied > 0) && ($status != "Inactive") && ($status != "Closed")) {
                            echo "Applied";
                        } elseif (($countapplied < 1) && ($status != "Inactive") && ($status != "Closed")) {
                            echo "Apply";
                        } else {
                            echo $status;
                        }
                        ?></button>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close </button>
    </div>
    <?php
}
$stmt->close();
$con->close();
?>