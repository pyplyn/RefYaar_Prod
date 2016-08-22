<?php
require '../../config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query01 = "select e.id,e.title,e.f_name,e.l_name,e.email,e.phone,e.state,g.country,e.image from users e,  location__country g where  e.country=g.id  and e.id=?";
$stmt01 = $con->prepare($query01);
$stmt01->bind_param('i', $_GET["id"]);
$stmt01->execute();
$stmt01->bind_result($id, $title, $fname, $lname, $email, $mobile, $state, $country, $imgPath);
$stmt01->store_result();
if ($stmt01->fetch()) {
    
}
$stmt01->close();
$queryResume = "select resume from user_profile where user_id=?";
$stmtResume = $con->prepare($queryResume);
$stmtResume->bind_param('i', $_GET["id"]);
$stmtResume->execute();
$stmtResume->bind_result($resume);
$stmtResume->store_result();
if ($stmtResume->fetch()) {
    
}
$stmtResume->close();
?>
<?php
$query11 = "select a.user_id,a.cur_company,a.cur_com_since,a.ctc,a.cur_com_industry,b.industry,c.area, a.designation from user_profile a , industry b, func_area c where b.id=a.cur_com_industry and c.id=a.func_area    and a.user_id=?";
$stmt11 = $con->prepare($query11);
$stmt11->bind_param('i', $_GET["id"]);
$stmt11->execute();
$stmt11->bind_result($userId, $curCompnay, $curSince, $ctc, $currentIndustry, $curIndustry, $area, $designation);
$stmt11->store_result();
if ($stmt11->fetch()) {
    
}
$stmt11->close();
?>


 <!--<span class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>-->
<div class="clearfix">
    <div class="ref-form-box clearfix">

        <div class="col-md-6">
            <div class="thumbnail text-center"><?php if ($imgPath) { ?>
                    <img src="<?= $imgPath ?>" class="img-responsive"/>

                <?php } else { ?>
                    <img src="https://s3.amazonaws.com/refyaar/staticContent/img/default/home-banner/bg.jpg" class="img-responsive"/>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <input type="hidden" name="resume" value="<?= $resume ?>" >
            <br/>
            <div><a href="<?= $resume ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-download-alt"></span> View Resume</a></div>
        </div>

        <div class="col-md-12 clearfix">
            <hr class="hr-dotted"/>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1"> Name</label>
        <div id="delete-admin-username"><?= $fname ?> <?= $lname ?></div>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Email</label>
        <div id="delete-admin-username"><?= $email ?></div>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Address</label>
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
                <div id="delete-admin-username"><?= $locationState ?>, <?= $country ?></div><?php
            }
            $stmtState->close();
        } else {
            ?>
            <div id="delete-admin-username"><?= $country ?></div><?php } ?>
    </div>
</div>
<div class="col-md-12 clearfix">
    <hr class="hr-dotted"/>
</div>
<div class="form-group col-md-6">
    <label for="exampleInputEmail1">Current Company</label>
    <div id="delete-admin-username"><?= $curCompnay ?></div>
</div>
<div class="form-group col-md-2">
    <label for="exampleInputEmail1">Since</label>
    <div id="delete-admin-username"><?= $curSince ?></div>
</div>
<div class="form-group col-md-4">
    <label for="exampleInputEmail1">Current Industry</label>
    <div id="delete-admin-username"><?= $curIndustry ?></div>
</div>
<?php
$i = 0;
$query1 = "select a.id, a.user_id,a.company,a.year,b.industry from  prev_com a,industry b where b.id=a.pre_com_industry and a.user_id=?";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param('i', $_GET["id"]);
$stmt1->execute();
$stmt1->bind_result($id, $preUserId, $preCompany, $preYear, $preIndustry);
$stmt1->store_result();
while ($stmt1->fetch()) {
    ?>
    <div class="form-group col-md-6">
        <?php if ($i == 0) { ?>
            <label for="exampleInputEmail1">Previous Company</label>
        <?php } ?>
        <div id="delete-admin-username"><?= $preCompany ?></div>
    </div>
    <div class="form-group col-md-2">
        <?php if ($i == 0) { ?>
            <label for="exampleInputEmail1">year</label>
        <?php } ?>
        <div id="delete-admin-username"><?= $preYear ?></div>
    </div>
    <div class="form-group col-md-4">
        <?php if ($i == 0) { ?>
            <label for="exampleInputEmail1">Previous Industry</label>
        <?php } ?>
        <div id="delete-admin-username"><?= $preIndustry ?></div>
    </div>
    <br/>
    <?php
    $i++;
}
$stmt1->close();
//                                   
?>

<div class="form-group col-md-5">
    <label for="exampleInputEmail1">Designation</label>
    <div id="delete-admin-username"><?= $designation ?></div>
</div>
<div class="form-group col-md-3">
    <label for="exampleInputEmail1">CTC (in INR)</label>
    <div id="delete-admin-username"><?php if ($ctc) { ?><?= round($ctc) ?><?php } else { ?><?= $ctc ?><?php } ?></div>
</div>

<div class="form-group col-md-4">
    <label for="exampleInputEmail1">Functional area</label>
    <div id="delete-admin-username"><?= $area ?></div>
</div>
<div class="col-md-12 clearfix">
    <hr class="hr-dotted"/>
</div>
<div class="ref-form-sub-text col-xs-12 clearfix">
    Key Skills & Experience in the skill ( Years )
</div>
<?php
$query1 = "select a.id, b.keyword,a.years from  key_skill a,keywords b where a.key_skill=b.id and  a.user_id=? and b.status='Active'";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param('i', $_GET["id"]);
$stmt1->execute();
$stmt1->bind_result($keyId, $keySkill, $keyYear);
$stmt1->store_result();
while ($stmt1->fetch()) {
    ?>
    <div class="form-group col-md-4">
        <div id="delete-admin-username"><?= $keySkill ?></div>
    </div>
    <div class="form-group col-md-2">
        <div id="delete-admin-username"><?= $keyYear ?></div>
    </div>
    <br/>
    <?php
    $i++;
}

$stmt1->close();
?>
<div class="panel-body clearfix">

    <br/>
    <div class="col-md-12 clearfix">
        <hr class="hr-dotted"/>
    </div>
    <div class="ref-form-box clearfix">
        <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
            Education
        </div>
        <?php
        $query112 = "select a.id,  a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where a.institution_id=c.id and a.education_id=b.id and b.edu_type='Graduation' and a.user_id=? ";
        $stmt112 = $con->prepare($query112);
        $stmt112->bind_param('i', $_GET["id"]);
        $stmt112->execute();
        $stmt112->bind_result($gradId, $eduGradId, $gradSpecialization, $gradPercentage, $gradInstId, $gradYear, $gradTypeID, $gradDegree, $gradEduType);
        $stmt112->store_result();
        while ($stmt112->fetch()) {
            
        }
        $stmt112->close();
        ?>
        <div class="col-md-6">
            <label for="exampleInputEmail1">
               Graduation
            </label>
            <!--<input type="text" value="<?= $gradDegree ?>" id="graduation" name="education[]" class="form-control ref-form-control" disabled>-->
            <div id="delete-admin-username"><?= $gradDegree ?></div>
        </div>
        <div class="col-md-4">
            <label for="exampleInputEmail1">
                Specialization
            </label>
<!--                                            <select class="form-control ref-form-control">
                <option>
                    Computer Science
                </option>
            </select>-->
            <div id="delete-admin-username"><?= $gradSpecialization ?></div>
            <!--<input id="grad-specialization" name="edu-specialization[]" type="text" class="form-control ref-form-control" value="<?= $gradSpecialization ?>" disabled/>-->
        </div>
        <div class="col-md-2">
            <label for="exampleInputEmail1">
                %
            </label>
            <div id="delete-admin-username"><?= $gradPercentage ?></div>
            <!--<input type="text" id="percentage" name="percentage[]" class="form-control ref-form-control" value="<?= $gradPercentage ?>" disabled/>-->
        </div>
    </div>
    <br/>
    <div class="ref-form-box clearfix">
        <div class="col-md-6">
            <label for="exampleInputEmail1">
                University/Institute
            </label>
            <div id="delete-admin-username"><?= $gradInstId ?></div>
            <!--<input type="text" value="<?= $gradInstId ?>" id="grad-university" name="edu-university[]" class="form-control ref-form-control" disabled>-->

        </div>
        <div class="col-md-4">
            <label for="exampleInputEmail1">
                Type
            </label>
            <div id="delete-admin-username"><?= $gradTypeID ?></div>
            <!--<input type="text" value="<?= $gradTypeID ?>" id="grad-type" name="edu-type[]" class="form-control ref-form-control" disabled>-->

        </div>
        <div class="col-md-2">
            <label for="exampleInputEmail1">
                Year
            </label>
            <div id="delete-admin-username"><?= $gradYear ?></div>
            <!--<input type="text" value="<?= $gradYear ?>" id="grad-year" name="edu-year[]" class="form-control ref-form-control" disabled>-->

        </div>
    </div>
    <?php
    $_delete_post = "";
    if ($_COOKIE["delete-post-graduation"] == 1) {
        $_delete_post = "style='display:none;'";
    }
    ?>
    <div id="post-hide"  class="ref-form-box clearfix" <?= $_delete_post ?>>
        <div class="col-md-12 clearfix">
            <hr class="hr-dotted"/>
        </div>
        <div class="ref-form-box clearfix">
            <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                Education
            </div>
            <?php
            $query12 = "select a.id, a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Post Graduation' and a.user_id=? ";
            $stmt12 = $con->prepare($query12);
            $stmt12->bind_param('i', $_GET["id"]);
            $stmt12->execute();
            $stmt12->bind_result($postId, $eduPostId, $postSpecialization, $postPercentage, $postInstId, $postYear, $postTypeID, $postDegree, $postEduType);
            $stmt12->store_result();
            while ($stmt12->fetch()) {
                
            }
            $stmt12->close();
            ?>
            <div class="col-md-6">
                <label for="exampleInputEmail1">
                    Post Graduation
                </label>
                <div id="delete-admin-username"><?= $postDegree ?></div>
                <!--<input type="text" value="<?= $postDegree ?>" id="post-graduation" name="education[]" class="form-control ref-form-control" disabled>-->
            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail1">
                    Specialization
                </label>
                <div id="delete-admin-username"><?= $postSpecialization ?></div>
                <!--<input type="text" id="post-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $postSpecialization ?>" disabled/>-->
            </div>
            <div class="col-md-2">
                <label for="exampleInputEmail1">
                    %
                </label>
                <div id="delete-admin-username"><?= $postPercentage ?></div>
                <!--<input type="text" id="post-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $postPercentage ?>" disabled/>-->
            </div>
        </div>
        <br/>
        <div class="ref-form-box clearfix">
            <div class="col-md-6">
                <label for="exampleInputEmail1">
                    University/Institute
                </label>
                <div id="delete-admin-username"><?= $postInstId ?></div>
                <!--<input type="text" value="<?= $postInstId ?>" id="post-university" name="edu-university[]" class="form-control ref-form-control" disabled>-->

            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail1">
                    Type
                </label>
                <div id="delete-admin-username"><?= $postTypeID ?></div>
                <!--<input type="text" value="<?= $postTypeID ?>" id="post-type" name="edu-type[]" class="form-control ref-form-control" disabled>-->

            </div>
            <div class="col-md-2">
                <label for="exampleInputEmail1">
                    Year
                </label>
                <div id="delete-admin-username"><?= $postYear ?></div>
                <!--<input type="text" value="<?= $postYear ?>" id="post-year" name="edu-year[]" class="form-control ref-form-control" disabled>-->

            </div>

        </div>
    </div>
    <br/>
    <?php
    $queryCoc = "select count(b.edu_type) from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
    $stmtCoc = $con->prepare($queryCoc);
    $stmtCoc->bind_param('i', $_GET["id"]);
    $stmtCoc->execute();
    $stmtCoc->bind_result($cookiesCount);
    $stmtCoc->store_result();
    $stmtCoc->fetch();
    if (($cookiesCount > 0) && ($_COOKIE["delete-doctorate"] == 1)) {
        $_delete_doc = "";
    } else if (($cookiesCount > 0) && ($_COOKIE["delete-doctorate"] != 1) && ($_COOKIE["delete-doctorate"] != 0)) {
        $_delete_doc = "";
    } else {
        $_delete_doc = "style='display:none;'";
    }
    $stmtCoc->close();
//                                if ($_COOKIE["delete-doctorate"] == 1) {
//                                    $_delete_doc = "";
//                                }
    ?>
    <div  class="ref-form-box clearfix "  id="collapseExample"  <?= $_delete_doc ?>>
        <div class="col-md-12 clearfix">
            <hr class="hr-dotted"/>
        </div>
        <div  class=" ref-form-box clearfix">
            <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                Education
            </div>
            <?php
            $query12 = "select a.id, a.education_id,a.specialization,a.percentage,c.institution,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b,institution c where c.id=a.institution_id and a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
            $stmt12 = $con->prepare($query12);
            $stmt12->bind_param('i', $_GET["id"]);
            $stmt12->execute();
            $stmt12->bind_result($docId, $eduDocId, $docSpecialization, $docPercentage, $docInstId, $docYear, $docTypeID, $docDegree, $docEduType);
            $stmt12->store_result();
            while ($stmt12->fetch()) {
                
            }
            $stmt12->close();
            ?>
            <div class="col-md-6">
                <div class="ref-form-sub-text ref-form-elt">
                    Doctorate
                </div>
                <div id="delete-admin-username"><?= $docDegree ?></div>
                <!--<input type="text" value="<?= $docDegree ?>" id="doctorate" name="education[]" class="form-control ref-form-control" disabled>--> 

            </div>
            <div class="col-md-4">
                <div class="ref-form-sub-text ref-form-elt">
                    Specialization
                </div>
                <div id="delete-admin-username"><?= $docSpecialization ?></div>
                <!--<input type="text" id="doc-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $docSpecialization ?>" disabled/>-->
            </div>
            <div class="col-md-2">
                <div class="ref-form-sub-text ref-form-elt">
                    %
                </div>
                <div id="delete-admin-username"><?= $docPercentage ?></div>
                <!--<input type="text" id="doc-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $docPercentage ?>" disabled/>-->
            </div>
        </div>
        <br/>
        <div class="ref-form-box clearfix">
            <div class="col-md-6">
                <label for="exampleInputEmail1">
                    University/Institute
                </label>
                <div id="delete-admin-username"><?= $docInstId ?></div>
                <!--<input type="text" value="<?= $docInstId ?>" id="doc-university" name="edu-university[]" class="form-control ref-form-control" disabled>-->

            </div>
            <div class="col-md-2">
                <label for="exampleInputEmail1">
                    Year
                </label>
                <div id="delete-admin-username"><?= $docYear ?></div>
                <!--<input type="text" value="<?= $docYear ?>" id="doctorate-year" name="edu-year[]" class="form-control ref-form-control" disabled>-->

            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail1">Type</label>
                <div id="delete-admin-username"><?= $docTypeID ?></div>
                <!--<input type="text" value="<?= $docTypeID ?>" id="doctorate-type" name="edu-type[]" class="form-control ref-form-control" disabled>-->

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close </button>
</div>
<br/>

<!--                                <div id="add-phd" class="col-md-12 clearfix">
                                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Add PhD/Doctorate</a>
                                </div>-->


</div>