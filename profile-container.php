<?php
//
require("config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query11 = "select a.user_id,a.cur_company,a.cur_com_since,a.ctc,a.cur_com_industry,b.industry,a.func_area, a.designation from user_profile a , industry b, func_area c where b.id=a.cur_com_industry and c.id=a.func_area and a.user_id=?";
$stmt11 = $con->prepare($query11);
$stmt11->bind_param('i', $_SESSION["social_id"]);
$stmt11->execute();
$stmt11->bind_result($userId, $curCompnay, $curSince, $ctc, $currentIndustry, $curIndustry, $area, $designation);
$stmt11->store_result();
if ($stmt11->fetch()) {
    
}
$stmt11->close();
$queryResume = "select resume from user_profile where user_id=?";
$stmtResume = $con->prepare($queryResume);
$stmtResume->bind_param('i', $_SESSION["social_id"]);
$stmtResume->execute();
$stmtResume->bind_result($resume);
$stmtResume->store_result();
if ($stmtResume->fetch()) {
    
}
$stmtResume->close();
?>

<div id="select-profile-container" class="panel panel-default panel-expertise"> 
    <form method="post" id="update-profile"  action="src/update-profile.php">
        <div class="panel-body clearfix">
    <!--        <span  class="btn-edit"><img src="img/default/My Profile/MP_BTN_EDIT.png" width="20"/></span>-->
            <div id="expertise-error" class="alert alert-danger hidden"></div>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <input type="text" id="cur-company" name="cur-company" class="form-control ref-form-control" value="<?= $curCompnay ?>" placeholder="Current Company">
                </div>
                <div class="col-md-6">
                    <div class="col-md-2 ref-form-label no-padding">
                        Since
                    </div>
                    <div class="col-md-4 no-padding">
                        <select id="since" name="since" class="form-control ref-form-control">
                            <option>Select</option>
                            <option <?php
                            if ($curSince == "1990") {
                                echo "selected";
                            }
                            ?>>1990</option>
                            <option <?php
                            if ($curSince == "1991") {
                                echo "selected";
                            }
                            ?>>1991</option>
                            <option <?php
                            if ($curSince == "1992") {
                                echo "selected";
                            }
                            ?>>1992</option>
                            <option <?php
                            if ($curSince == "1993") {
                                echo "selected";
                            }
                            ?>>1993</option>

                            <option <?php
                            if ($curSince == "1994") {
                                echo "selected";
                            }
                            ?>>1994</option>
                            <option <?php
                            if ($curSince == "1995") {
                                echo "selected";
                            }
                            ?>>1995</option>
                            <option <?php
                            if ($curSince == "1996") {
                                echo "selected";
                            }
                            ?>>1996</option>

                            <option <?php
                            if ($curSince == "1997") {
                                echo "selected";
                            }
                            ?>>1997</option>
                            <option <?php
                            if ($curSince == "1998") {
                                echo "selected";
                            }
                            ?>>1998</option>
                            <option <?php
                            if ($curSince == "1999") {
                                echo "selected";
                            }
                            ?>>1999</option>

                            <option <?php
                            if ($curSince == "2000") {
                                echo "selected";
                            }
                            ?>>2000</option>
                            <option <?php
                            if ($curSince == "2001") {
                                echo "selected";
                            }
                            ?>>2001</option>
                            <option <?php
                            if ($curSince == "2002") {
                                echo "selected";
                            }
                            ?>>2002</option>

                            <option <?php
                            if ($curSince == "2003") {
                                echo "selected";
                            }
                            ?>>2003</option>
                            <option <?php
                            if ($curSince == "2004") {
                                echo "selected";
                            }
                            ?>>2004</option>
                            <option <?php
                            if ($curSince == "2005") {
                                echo "selected";
                            }
                            ?>>2005</option>
                            <option <?php
                            if ($curSince == "2006") {
                                echo "selected";
                            }
                            ?>>2006</option>
                            <option <?php
                            if ($curSince == "2007") {
                                echo "selected";
                            }
                            ?>>2007</option>
                            <option <?php
                            if ($curSince == "2008") {
                                echo "selected";
                            }
                            ?>>2008</option>
                            <option <?php
                            if ($curSince == "2009") {
                                echo "selected";
                            }
                            ?>>2009</option>
                            <option <?php
                            if ($curSince == "2010") {
                                echo "selected";
                            }
                            ?>>2010</option>
                            <option <?php
                            if ($curSince == "2011") {
                                echo "selected";
                            }
                            ?>>2011</option>
                            <option <?php
                            if ($curSince == "2012") {
                                echo "selected";
                            }
                            ?>>2012</option>
                            <option <?php
                            if ($curSince == "2013") {
                                echo "selected";
                            }
                            ?>>2013</option>
                            <option <?php
                            if ($curSince == "2014") {
                                echo "selected";
                            }
                            ?>>2014</option>
                            <option <?php
                            if ($curSince == "2015") {
                                echo "selected";
                            }
                            ?>>2015</option>
                        </select>
                    </div>
                    <div class="col-md-1 no-padding">

                    </div>
                    <div class="col-md-5 no-padding ref-form-elt">
                        <select id="cur-industry" name="cur-industry" class="form-control ref-form-control">
                            <option>Industry</option>
                            <?php
                            $query1 = "select id, industry from  industry where status='Active' order by industry";
                            $stmt1 = $con->prepare($query1);
                            $stmt1->execute();
                            $stmt1->bind_result($indusId, $industry);
                            $stmt1->store_result();
                            while ($stmt1->fetch()) {
                                $selected = "";
                                if ($indusId == $currentIndustry) {
                                    $selected = "selected";
                                }
                                echo "<option value='$indusId' $selected>$industry</option>";
                            }
                            $stmt1->close();
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <br/>
            <?php
            $query1 = "select id, user_id,company,year,pre_com_industry from  prev_com where user_id=?";
            $stmt1 = $con->prepare($query1);
            $stmt1->bind_param('i', $_SESSION["social_id"]);
            $stmt1->execute();
            $stmt1->bind_result($id, $preUserId, $preCompany, $preYear, $preIndustry);
            $stmt1->store_result();
            while ($stmt1->fetch()) {
                ?>
                <div class="ref-form-box clearfix">

                    <div class="col-md-6">
                        <input type="text" id="pre-company" name="pre-company[]" class="pre-company-pre form-control ref-form-control  pre-company-auto" placeholder="Previous Company" value="<?= $preCompany ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="pre1" id="pre1" value="<?= $id ?>">
                        <div class="col-md-2 ref-form-label no-padding">
                            Years
                        </div>
                        <div class="col-md-2 no-padding">
                            <input type="text"  id="pre-year"  name="pre-year[]" class="pre-year-class form-control ref-form-control" value="<?= $preYear ?>" />
                        </div>
                        <div class="col-md-1 no-padding">

                        </div>
                        <div class="col-md-5 no-padding ref-form-elt">
                            <select id="pre-industry" name="pre-industry[]" class="pre-industry-pre form-control ref-form-control">
                                <option>Industry</option>
                                <?php
                                $query11 = "select id, industry from  industry where status='Active' order by industry";
                                $stmt11 = $con->prepare($query11);
                                $stmt11->execute();
                                $stmt11->bind_result($preIndusId, $preIndus);
                                $stmt11->store_result();
                                while ($stmt11->fetch()) {
                                    $selected = "";
                                    if ($preIndusId == $preIndustry) {
                                        $selected = "selected";
                                    }
                                    echo "<option value='$preIndusId' $selected>$preIndus</option>";
                                }
                                $stmt11->close();
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <br/>
                <?php
            }
            $stmt1->close();
//                                   
            ?>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <input type="text" id="pre-company1" name="pre-company[]" class="form-control ref-form-control  pre-company-auto" placeholder="Previous Company">
                </div>
                <div class="col-md-6 ref-form-elt">
                    <div class="col-md-2 ref-form-label no-padding">
                        Years
                    </div>
                    <div  class="col-md-2 no-padding">
                        <input type="text" id="pre-year1"  name="pre-year[]" class="form-control ref-form-control" />
                    </div>
                    <div class="col-md-1 no-padding ref-form-elt hidden-xs">

                    </div>
                    <div class="col-md-5 no-padding ref-form-elt">
                        <select id="pre-industry1" name="pre-industry[]" class="form-control ref-form-control">
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
                    <input type="text" id="pre-company2" name="pre-company[]" class="form-control ref-form-control  pre-company-auto" placeholder="Previous Company">
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
                    <input type="text" id="pre-company3" name="pre-company[]" class="form-control ref-form-control  pre-company-auto" placeholder="Previous Company">
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
                    <input type="text" id="pre-company4" name="pre-company[]" class="form-control ref-form-control pre-company-auto" placeholder="Previous Company">
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
                <div class="col-md-6">
                    <div class="ref-form-sub-text">
                        Designation
                    </div>
                    <input type="text" id="designation" value="<?= $designation ?>" name="designation" class="form-control ref-form-control">


                </div>
                <div class="ref-form-sub-text">
                    &nbsp;&nbsp; CTC (in INR)
                </div>
                <div class="col-md-6 ref-form-elt">
                    <input type="text" id="ctc" name="ctc" class="form-control ref-form-control" <?php if ($ctc) { ?>value="<?= round($ctc) ?>"<?php } else { ?>value="<?= $ctc ?>"<?php } ?> placeholder="CTC">
                </div>

            </div>
            <br/>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
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
                        $stmt1->bind_result($funcId, $area1);
                        $stmt1->store_result();
                        while ($stmt1->fetch()) {
                            $selected = "";
                            if ($funcId == $area) {
                                $selected = "selected";
                            }
                            echo "<option value='$funcId' $selected>$area1</option>";
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
                    <br/>
                        <p>
                            Please fill in your Key Skills carefully as all the jobs recommended to you would be based on these skills.
                        </p>
                </div>
                <?php
                $query1 = "select a.id, b.keyword,a.years from  key_skill a,keywords b where a.key_skill=b.id and  a.user_id=? and b.status='Active'";
                $stmt1 = $con->prepare($query1);
                $stmt1->bind_param('i', $_SESSION["social_id"]);
                $stmt1->execute();
                $stmt1->bind_result($keyId, $keySkill, $keyYear);
                $stmt1->store_result();
                while ($stmt1->fetch()) {
                    ?>
                    <div class="col-md-6 key-skill-container">
                        <div class="col-md-6 no-padding">
                            <select id="skill-area" name="skill-area[]" class="area-skill-area skill-tok single-autocomplete autocomplete">
                                <option value="<?= $keySkill ?>" selected=""><?= $keySkill ?></option>
                            </select>  
                            <!--<input type="text" id="skill-area"  name="skill-area[]" class="area-skill-area form-control ref-form-control" value="<?= $keySkill ?>">-->
                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-2 no-padding ref-form-label">
                            Year/s
                        </div>
                        <div class="col-md-2 no-padding">
                            <input type="text" id="skill-year" name="skill-year[]" class="year-skill-year form-control ref-form-control" value="<?= $keyYear ?>" />
                        </div>
                    </div>

                    <?php
                }

                $stmt1->close();
                ?>
            </div>
            <br/>




            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <div class="col-md-6 no-padding ref-form-elt">
                        <select id="skill-area1"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                        </select>
<!--<input type="text" id="skill-area1" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->

                    </div>
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                        Year/s
                    </div>
                    <div class="col-md-2 no-padding">
                        <input type="text" id="skill-year1" name="skill-year[]" class="form-control ref-form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6 no-padding ref-form-elt">
                        <!--<input type="text" id="skill-area2" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                        <select id="skill-area2"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                        </select>
                    </div>
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-2 no-padding ref-form-label ref-form-elt">
                        Year/s
                    </div>
                    <div class="col-md-2 no-padding">
                        <input type="text" id="skill-year2" name="skill-year[]" class="form-control ref-form-control"/>
                    </div>
                    <div class="col-md-1 no-padding ref-form-elt text-center">
                        <div id="skillAdd1" class="yellow-btn ref-plus-btn">
                            <span class="glyphicon glyphicon-plus"></span>
                        </div>
                    </div>
                </div>

            </div>
            </br>
            <div id="skill-another1" class="ref-form-box clearfix hidden">
                <div class="col-md-6">
                    <div class="col-md-6 no-padding ref-form-elt">
                        <!--<input type="text" id="skill-area3" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                        <select id="skill-area3"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                        </select>
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
                        <!--<input type="text" id="skill-area4" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                        <select id="skill-area4"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                        </select>
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
                        <div id="skillAdd2" class="yellow-btn ref-plus-btn">
                            <span class="glyphicon glyphicon-plus"></span>
                        </div>
                    </div>
                </div>

            </div>
            </br>
            <div id="skill-another2" class="ref-form-box clearfix hidden">
                <div class="col-md-6">
                    <div class="col-md-6 no-padding ref-form-elt">
                        <!--<input type="text" id="skill-area5" name="skill-area[]" class="form-control ref-form-control" placeholder="Key Skill">-->
                        <select id="skill-area5"  name="skill-area[]"  placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                        </select>
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
                </div>
            </div>
            <div class="col-md-12 clearfix">
                <hr class="hr-dotted"/>
            </div>
            <div class="ref-form-box clearfix">
                <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                    Education
                </div>
                <?php
                $query112 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Graduation' and a.user_id=? ";
                $stmt112 = $con->prepare($query112);
                $stmt112->bind_param('i', $_SESSION["social_id"]);
                $stmt112->execute();
                $stmt112->bind_result($gradId, $eduGradId, $gradSpecialization, $gradPercentage, $gradInstId, $gradYear, $gradTypeID, $gradDegree, $gradEduType);
                $stmt112->store_result();
                while ($stmt112->fetch()) {
                    
                }
                $stmt112->close();
                ?>
                <div class="col-md-6">
                    <div class="ref-form-sub-text">
                        Basic/Graduation
                    </div>
                    <select id="graduation" name="education[]" class="form-control ref-form-control">
                        <option>
                            Graduation
                        </option>
                        <?php
                        $query122 = "select id, degree from  education where status='Active' and edu_type='Graduation' order by degree";
                        $stmt122 = $con->prepare($query122);
                        $stmt122->execute();
                        $stmt122->bind_result($gradDegreeId, $gradDegree);
                        $stmt122->store_result();
                        while ($stmt122->fetch()) {
                            $selected = "";
                            if ($gradDegreeId == $eduGradId) {
                                $selected = "selected";
                            }
                            echo "<option value='$gradDegreeId' $selected>$gradDegree</option>";
                        }
                        $stmt122->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="ref-form-sub-text ref-form-elt">
                        Specialization
                    </div>
    <!--                                            <select class="form-control ref-form-control">
                        <option>
                            Computer Science
                        </option>
                    </select>-->
                    <input id="grad-specialization" name="edu-specialization[]" type="text" class="form-control ref-form-control" value="<?= $gradSpecialization ?>"/>
                </div>
                <div class="col-md-2">
                    <div class="ref-form-sub-text ref-form-elt">
                        %
                    </div>
                    <input type="text" id="percentage" name="percentage[]" class="form-control ref-form-control" value="<?= $gradPercentage ?>"/>
                </div>
            </div>
            <br/>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <div class="ref-form-sub-text">
                        University/Institute
                    </div>
                    <select id="grad-university" name="edu-university[]" class="form-control ref-form-control">
                        <option>
                            University/Institute
                        </option>
                        <?php
                        $query122 = "select id,  institution from   institution where status='Active' and course='Graduation' order by  institution";
                        $stmt122 = $con->prepare($query122);
                        $stmt122->execute();
                        $stmt122->bind_result($gradInst, $gradInstitute);
                        $stmt122->store_result();
                        while ($stmt122->fetch()) {
                            $selected = "";
                            if ($gradInst == $gradInstId) {
                                $selected = "selected";
                            }
                            echo "<option value='$gradInst' $selected>$gradInstitute</option>";
                        }
                        $stmt122->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="ref-form-sub-text ref-form-elt">
                        Year
                    </div>
                    <select id="grad-year" name="edu-year[]" class="form-control ref-form-control">
                        <option>
                            Year
                        </option>
                        <option <?php
                        if ($gradYear == "1990") {
                            echo "selected";
                        }
                        ?>>1990</option>

                        <option <?php
                        if ($gradYear == "1991") {
                            echo "selected";
                        }
                        ?>>1991</option>
                        <option <?php
                        if ($gradYear == "1992") {
                            echo "selected";
                        }
                        ?>>1992</option>
                        <option <?php
                        if ($gradYear == "1993") {
                            echo "selected";
                        }
                        ?>>1993</option>

                        <option <?php
                        if ($gradYear == "1994") {
                            echo "selected";
                        }
                        ?>>1994</option>
                        <option <?php
                        if ($gradYear == "1995") {
                            echo "selected";
                        }
                        ?>>1995</option>
                        <option <?php
                        if ($gradYear == "1996") {
                            echo "selected";
                        }
                        ?>>1996</option>

                        <option <?php
                        if ($gradYear == "1997") {
                            echo "selected";
                        }
                        ?>>1997</option>
                        <option <?php
                        if ($gradYear == "1998") {
                            echo "selected";
                        }
                        ?>>1998</option>
                        <option <?php
                        if ($gradYear == "1999") {
                            echo "selected";
                        }
                        ?>>1999</option>

                        <option <?php
                        if ($gradYear == "2000") {
                            echo "selected";
                        }
                        ?>>2000</option>
                        <option <?php
                        if ($gradYear == "2001") {
                            echo "selected";
                        }
                        ?>>2001</option>
                        <option <?php
                        if ($gradYear == "2002") {
                            echo "selected";
                        }
                        ?>>2002</option>

                        <option <?php
                        if ($gradYear == "2003") {
                            echo "selected";
                        }
                        ?>>2003</option>
                        <option <?php
                        if ($gradYear == "2004") {
                            echo "selected";
                        }
                        ?>>2004</option>
                        <option <?php
                        if ($gradYear == "2005") {
                            echo "selected";
                        }
                        ?>>2005</option>
                        <option <?php
                        if ($gradYear == "2006") {
                            echo "selected";
                        }
                        ?>>2006</option>
                        <option <?php
                        if ($gradYear == "2007") {
                            echo "selected";
                        }
                        ?>>2007</option>
                        <option <?php
                        if ($gradYear == "2008") {
                            echo "selected";
                        }
                        ?>>2008</option>
                        <option <?php
                        if ($gradYear == "2009") {
                            echo "selected";
                        }
                        ?>>2009</option>
                        <option <?php
                        if ($gradYear == "2010") {
                            echo "selected";
                        }
                        ?>>2010</option>
                        <option <?php
                        if ($gradYear == "2011") {
                            echo "selected";
                        }
                        ?>>2011</option>
                        <option <?php
                        if ($gradYear == "2012") {
                            echo "selected";
                        }
                        ?>>2012</option>
                        <option <?php
                        if ($gradYear == "2013") {
                            echo "selected";
                        }
                        ?>>2013</option>
                        <option <?php
                        if ($gradYear == "2014") {
                            echo "selected";
                        }
                        ?>>2014</option>
                        <option <?php
                        if ($gradYear == "2015") {
                            echo "selected";
                        }
                        ?>>2015</option>
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
                        <option <?php
                        if ($gradTypeID == "Full Time") {
                            echo "selected";
                        }
                        ?>>Full Time</option>

                        <option <?php
                        if ($gradTypeID == "Part Time") {
                            echo "selected";
                        }
                        ?>>Part Time</option>
                        <option <?php
                        if ($gradTypeID == "Correspondence") {
                            echo "selected";
                        }
                        ?>>Correspondence</option>
                    </select>
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
                    $query12 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Post Graduation' and a.user_id=? ";
                    $stmt12 = $con->prepare($query12);
                    $stmt12->bind_param('i', $_SESSION["social_id"]);
                    $stmt12->execute();
                    $stmt12->bind_result($postId, $eduPostId, $postSpecialization, $postPercentage, $postInstId, $postYear, $postTypeID, $postDegree, $postEduType);
                    $stmt12->store_result();
                    while ($stmt12->fetch()) {
                        
                    }
                    $stmt12->close();
                    ?>
                    <div class="col-md-6">
                        <div class="ref-form-sub-text">
                            Post Graduation
                        </div>
                        <select id="post-graduation" name="education[]" class="form-control ref-form-control">
                            <option>
                                Post Graduation
                            </option>
                            <?php
                            $query122 = "select id, degree from  education where status='Active' and edu_type='Post Graduation' order by degree";
                            $stmt122 = $con->prepare($query122);
                            $stmt122->execute();
                            $stmt122->bind_result($postDegreeId, $postDegree);
                            $stmt122->store_result();
                            while ($stmt122->fetch()) {
                                $selected = "";
                                if ($postDegreeId == $eduPostId) {
                                    $selected = "selected";
                                }
                                echo "<option value='$postDegreeId' $selected>$postDegree</option>";
                            }
                            $stmt122->close();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="ref-form-sub-text ref-form-elt">
                            Specialization
                        </div>
                        <input type="text" id="post-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $postSpecialization ?>"/>
                    </div>
                    <div class="col-md-2">
                        <div class="ref-form-sub-text ref-form-elt">
                            %
                        </div>
                        <input type="text" id="post-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $postPercentage ?>"/>
                    </div>
                </div>
                <br/>
                <div class="ref-form-box clearfix">
                    <div class="col-md-6">
                        <div class="ref-form-sub-text">
                            University/Institute
                        </div>
                        <select id="post-university" name="edu-university[]" class="form-control ref-form-control">
                            <option>
                                University/Institute
                            </option>
                            <?php
                            $query122 = "select id,  institution from   institution where status='Active' and (course='Post-Graduation' or course='Doctorate') order by  institution";
                            $stmt122 = $con->prepare($query122);
                            $stmt122->execute();
                            $stmt122->bind_result($postInst, $postInstitute);
                            $stmt122->store_result();
                            while ($stmt122->fetch()) {
                                $selected = "";
                                if ($postInst == $postInstId) {
                                    $selected = "selected";
                                }
                                echo "<option value='$postInst' $selected>$postInstitute</option>";
                            }
                            $stmt122->close();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="ref-form-sub-text ref-form-elt">
                            Year
                        </div>
                        <select id="post-year" name="edu-year[]" class="form-control ref-form-control">
                            <option>
                                Year
                            </option>
                            <option <?php
                            if ($postYear == "1990") {
                                echo "selected";
                            }
                            ?>>1990</option>

                            <option <?php
                            if ($postYear == "1991") {
                                echo "selected";
                            }
                            ?>>1991</option>
                            <option <?php
                            if ($postYear == "1992") {
                                echo "selected";
                            }
                            ?>>1992</option>
                            <option <?php
                            if ($postYear == "1993") {
                                echo "selected";
                            }
                            ?>>1993</option>

                            <option <?php
                            if ($postYear == "1994") {
                                echo "selected";
                            }
                            ?>>1994</option>
                            <option <?php
                            if ($postYear == "1995") {
                                echo "selected";
                            }
                            ?>>1995</option>
                            <option <?php
                            if ($postYear == "1996") {
                                echo "selected";
                            }
                            ?>>1996</option>

                            <option <?php
                            if ($postYear == "1997") {
                                echo "selected";
                            }
                            ?>>1997</option>
                            <option <?php
                            if ($postYear == "1998") {
                                echo "selected";
                            }
                            ?>>1998</option>
                            <option <?php
                            if ($postYear == "1999") {
                                echo "selected";
                            }
                            ?>>1999</option>

                            <option <?php
                            if ($postYear == "2000") {
                                echo "selected";
                            }
                            ?>>2000</option>
                            <option <?php
                            if ($postYear == "2001") {
                                echo "selected";
                            }
                            ?>>2001</option>
                            <option <?php
                            if ($postYear == "2002") {
                                echo "selected";
                            }
                            ?>>2002</option>

                            <option <?php
                            if ($postYear == "2003") {
                                echo "selected";
                            }
                            ?>>2003</option>
                            <option <?php
                            if ($postYear == "2004") {
                                echo "selected";
                            }
                            ?>>2004</option>
                            <option <?php
                            if ($postYear == "2005") {
                                echo "selected";
                            }
                            ?>>2005</option>
                            <option <?php
                            if ($postYear == "2006") {
                                echo "selected";
                            }
                            ?>>2006</option>
                            <option <?php
                            if ($postYear == "2007") {
                                echo "selected";
                            }
                            ?>>2007</option>
                            <option <?php
                            if ($postYear == "2008") {
                                echo "selected";
                            }
                            ?>>2008</option>
                            <option <?php
                            if ($postYear == "2009") {
                                echo "selected";
                            }
                            ?>>2009</option>
                            <option <?php
                            if ($postYear == "2010") {
                                echo "selected";
                            }
                            ?>>2010</option>
                            <option <?php
                            if ($postYear == "2011") {
                                echo "selected";
                            }
                            ?>>2011</option>
                            <option <?php
                            if ($postYear == "2012") {
                                echo "selected";
                            }
                            ?>>2012</option>
                            <option <?php
                            if ($postYear == "2013") {
                                echo "selected";
                            }
                            ?>>2013</option>
                            <option <?php
                            if ($postYear == "2014") {
                                echo "selected";
                            }
                            ?>>2014</option>
                            <option <?php
                            if ($postYear == "2015") {
                                echo "selected";
                            }
                            ?>>2015</option>
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
                            <option <?php
                            if ($postTypeID == "Full Time") {
                                echo "selected";
                            }
                            ?>>Full Time</option>

                            <option <?php
                            if ($postTypeID == "Part Time") {
                                echo "selected";
                            }
                            ?>>Part Time</option>
                            <option <?php
                            if ($postTypeID == "Correspondence") {
                                echo "selected";
                            }
                            ?>>Correspondence</option>
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
                <div class="col-md-12 clearfix">
                    <hr class="hr-dotted"/>
                </div>
                <div  class=" ref-form-box clearfix">
                    <div class="ref-form-sub-text ref-form-super-text col-xs-12 clearfix">
                        Education
                    </div>
                    <?php
                    $query12 = "select a.id, a.education_id,a.specialization,a.percentage,a.institution_id,a._year,a.edu_type,b.degree,b.edu_type from  user_edu a, education b where a.education_id=b.id and b.edu_type='Doctorate' and a.user_id=? ";
                    $stmt12 = $con->prepare($query12);
                    $stmt12->bind_param('i', $_SESSION["social_id"]);
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
                        <select id="doctorate" name="education[]" class="form-control ref-form-control">
                            <option>
                                Doctorate
                            </option>
                            <?php
                            $query1 = "select id, degree from  education where status='Active' and edu_type='Doctorate' order by degree";
                            $stmt1 = $con->prepare($query1);
                            $stmt1->execute();
                            $stmt1->bind_result($doctorateId, $doctorate);
                            $stmt1->store_result();
                            while ($stmt1->fetch()) {
                                $selected = "";
                                if ($doctorateId == $eduDocId) {
                                    $selected = "selected";
                                }
                                echo "<option value='$doctorateId' $selected>$doctorate</option>";
                            }
                            $stmt1->close();
                            ?>                          
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="ref-form-sub-text ref-form-elt">
                            Specialization
                        </div>
                        <input type="text" id="doc-specialization" name="edu-specialization[]" class="form-control ref-form-control" value="<?= $docSpecialization ?>"/>
                    </div>
                    <div class="col-md-2">
                        <div class="ref-form-sub-text ref-form-elt">
                            %
                        </div>
                        <input type="text" id="doc-percentage" name="percentage[]"  class="form-control ref-form-control" value="<?= $docPercentage ?>"/>
                    </div>
                </div>
                <br/>
                <div class="ref-form-box clearfix">
                    <div class="col-md-6">
                        <div class="ref-form-sub-text">
                            University/Institute
                        </div>
                        <select id="doc-university" name="edu-university[]" class="form-control ref-form-control">
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
                                $selected = "";
                                if ($docId == $docInstId) {
                                    $selected = "selected";
                                }
                                echo "<option value='$docId' $selected>$docInstitution</option>";
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
                            <option <?php
                            if ($docYear == "1990") {
                                echo "selected";
                            }
                            ?>>1990</option>

                            <option <?php
                            if ($docYear == "1991") {
                                echo "selected";
                            }
                            ?>>1991</option>
                            <option <?php
                            if ($docYear == "1992") {
                                echo "selected";
                            }
                            ?>>1992</option>
                            <option <?php
                            if ($docYear == "1993") {
                                echo "selected";
                            }
                            ?>>1993</option>

                            <option <?php
                            if ($docYear == "1994") {
                                echo "selected";
                            }
                            ?>>1994</option>
                            <option <?php
                            if ($docYear == "1995") {
                                echo "selected";
                            }
                            ?>>1995</option>
                            <option <?php
                            if ($docYear == "1996") {
                                echo "selected";
                            }
                            ?>>1996</option>

                            <option <?php
                            if ($docYear == "1997") {
                                echo "selected";
                            }
                            ?>>1997</option>
                            <option <?php
                            if ($docYear == "1998") {
                                echo "selected";
                            }
                            ?>>1998</option>
                            <option <?php
                            if ($docYear == "1999") {
                                echo "selected";
                            }
                            ?>>1999</option>

                            <option <?php
                            if ($docYear == "2000") {
                                echo "selected";
                            }
                            ?>>2000</option>
                            <option <?php
                            if ($docYear == "2001") {
                                echo "selected";
                            }
                            ?>>2001</option>
                            <option <?php
                            if ($docYear == "2002") {
                                echo "selected";
                            }
                            ?>>2002</option>

                            <option <?php
                            if ($docYear == "2003") {
                                echo "selected";
                            }
                            ?>>2003</option>
                            <option <?php
                            if ($docYear == "2004") {
                                echo "selected";
                            }
                            ?>>2004</option>
                            <option <?php
                            if ($docYear == "2005") {
                                echo "selected";
                            }
                            ?>>2005</option>
                            <option <?php
                            if ($docYear == "2006") {
                                echo "selected";
                            }
                            ?>>2006</option>
                            <option <?php
                            if ($docYear == "2007") {
                                echo "selected";
                            }
                            ?>>2007</option>
                            <option <?php
                            if ($docYear == "2008") {
                                echo "selected";
                            }
                            ?>>2008</option>
                            <option <?php
                            if ($docYear == "2009") {
                                echo "selected";
                            }
                            ?>>2009</option>
                            <option <?php
                            if ($docYear == "2010") {
                                echo "selected";
                            }
                            ?>>2010</option>
                            <option <?php
                            if ($docYear == "2011") {
                                echo "selected";
                            }
                            ?>>2011</option>
                            <option <?php
                            if ($docYear == "2012") {
                                echo "selected";
                            }
                            ?>>2012</option>
                            <option <?php
                            if ($docYear == "2013") {
                                echo "selected";
                            }
                            ?>>2013</option>
                            <option <?php
                            if ($docYear == "2014") {
                                echo "selected";
                            }
                            ?>>2014</option>
                            <option <?php
                            if ($docYear == "2015") {
                                echo "selected";
                            }
                            ?>>2015</option>
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
                            <option <?php
                            if ($docTypeID == "Full Time") {
                                echo "selected";
                            }
                            ?>>Full Time</option>

                            <option <?php
                            if ($docTypeID == "Part Time") {
                                echo "selected";
                            }
                            ?>>Part Time</option>
                            <option <?php
                            if ($docTypeID == "Correspondence") {
                                echo "selected";
                            }
                            ?>>Correspondence</option>
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
            <!--            <div id="post-delete" class="col-md-12 clearfix pointer-cursor">
                            <a >Delete Post Graduation</a>
                        </div>
                        <div id="add-phd" class="col-md-12 clearfix">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Add PhD/Doctorate</a>
                        </div>-->
            <div class="col-md-12 clearfix">
                <hr class="hr-dotted"/>
            </div>
            <div class="ref-form-box clearfix">
                <div class="col-md-6">
                    <div class="ref-form-sub-text">
                        Upload your Resume ( pdf/doc )
                    </div>
                    <input type="file" id="resume" name="resume" class="form-control" />
                    <input type="hidden" name="old_resume" value="<?= $resume ?>" >
                    <br/>
                    <div><a href="<?= $resume ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-download-alt"></span> View Resume</a></div>
                </div>
            </div>
            <br/>
            <div class="col-md-12 clearfix">
                <div class="text-right">
                    <input id="profile-updation" type="submit" value="SUBMIT" class="blue-btn" />
                </div>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div id="profile-container-error" class="alert alert-danger hidden"></div>
                <!--                <div class="modal-body">
                                    Changes successfully made
                                </div>-->
                <div class="modal-footer">
                    <a href="profile.php" class="btn btn-default">Okay</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div id="profile-container-error" class="alert alert-danger hidden"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
