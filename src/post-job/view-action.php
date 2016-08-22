<?php

//
require("../../config.php");
session_start();
ob_start();

include './../../Function/email-msg.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$messageee = "Congratulations!"
                        . "<br/><br/>"
                        . "Hope you are doing well."
                        . "<br/><br/>"
                        . "Please find below the details of the job for which you have been shortlisted by our algorithm: "
                        . "<br/><br/>";
$messageee1 = "Hello!"
                . "<br/><br/>"
                . "Hope you are doing well."
                . "<br/><br/>"
                . "Please find below the list of candidates who have been shortlisted by our algorithm: "
                . "<br/><br/>";
$result = array();
if (is_array($_POST["checkbox"]) || is_object($_POST["checkbox"])) {
    $j = 0;
//$previousCompany = 1;
    foreach ($_POST['checkbox'] as $selected) {
        $Query1 = "select a.id,a.f_name,a.email,a.phone,b.resume from users a,user_profile b where a.id=b.user_id and a.id=?";
        $stmt1 = $con->prepare($Query1);
        $stmt1->bind_param('i', $selected);
        $stmt1->execute();
        $stmt1->bind_result($userid, $userName, $email, $phone, $resume);
        $stmt1->store_result();
        while ($stmt1->fetch()) {
            $Query1 = "select count(*) from short_listed where job_post_id=? and user_id=?";
            $stmt1 = $con->prepare($Query1);
            $stmt1->bind_param('ii', $_POST["applicantId"], $selected);
            $stmt1->execute();
            $stmt1->bind_result($countapplied);
            $stmt1->store_result();
            $stmt1->fetch();
            if ($countapplied < 1) {
                $query = "insert into short_listed(user_id,job_post_id) values(?,?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('ii', $selected, $_POST["applicantId"]);
                $stmt->execute();
            }
            $Query1 = "select a.organization, a.headline,b.email,b.phone,c.city from users b,job_post a, location__city c where a.city_id=c.id and a.user_id=b.id  and a.id=? and a.user_id=?";
            $stmt1 = $con->prepare($Query1);
            $stmt1->bind_param('ii', $_POST["applicantId"], $_SESSION["social_id"]);
            $stmt1->execute();
            $stmt1->bind_result($organization, $headline, $applicantEmail, $applicantPhone, $city);
            $stmt1->store_result();
            if ($stmt1->fetch()) {
                $to = $email;
                $from = "RefYaar@refyaar.com";
                $subject = "Shortlisted for the position of ".$headline." at ".$organization.": Location - ".$city;
                $messageee = $messageee ."<div>"
                                        . "<table>"
                                            . "<tr>"
                                                . "<td>Company Name: </td>"
                                                . "<td>$organization</td>"
                                            . "</tr>"
                                            ."<tr>"
                                                . "<td>Job Location: </td>"
                                                . "<td>$city</td>"
                                            . "</tr>"
                                            . "<tr>"
                                                . "<td>Email ID of Your Referrer: </td>"
                                                . "<td>$applicantEmail</td>"
                                            . "</tr>"
                                            . "<tr>"
                                                . "<td>Job Headline: </td>"
                                                . "<td>$headline</td>"
                                            . "</tr>"
                                        . "</table>"
                                        . "</div>"
                                        ."<br/><br/>"
                                        ."<p><strong>NOTE: </strong>"
                                        . "We would request you to refrain form contacting your referrer directly, "
                                        ."unless such a dialogue has been intiated by your referrer.</p>"
                                        ."<br/>"
                                        ."<strong>Good Luck & May the Force Be with You!</strong>"
                                        ."<br/><br/>"
                                        ."Regards,"
                                        ."<br/>"
                                        ."<strong>Team RefYaar</strong>"
                                        ."<br/><br/>"
                                        .'<a href="https://www.youtube.com/watch?v=S6O9HZ_L6fg">Watch the Video</a>'
                                        ."&nbsp;&nbsp;&nbsp;&nbsp;"
                                        .'<a href="https://www.facebook.com/refyaar">Like Us on Facebook</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
                                        .'<a href="https://twitter.com/refyaar">Follow Us on Twitter</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
                                        .'<a href="https://www.linkedin.com/company/refyaar">Follow Us on LinkedIn</a>'."&nbsp;&nbsp;&nbsp;&nbsp;";
                sendMail($to, $from, $subject, $messageee);
            }
            $messageee1 = $messageee1   . "<div>"
                                        . "<table>"
                                            . "<tr>"
                                                . "<td>Name: </td>"
                                                . "<td>$userName</td>"
                                            . "</tr>"
                                            . "<tr>"
                                                . "<td>Email: </td>"
                                                . "<td>$email</td>"
                                            . "</tr>"
                                            . "<tr>"
                                                . "<td>Phone: </td>"
                                                . "<td>$phone</td>"
                                            . "</tr>"
                                            . "<tr>"
                                                . "<td>Resume: </td>"
                                                . " <td>" 
                                                    . '<a href="'.$resume .'">Applicant Resume</a>' 
                                                . "</td>"
                                            . "</tr>"
                                        . "</table>"
                                        . "</div>"
                                        ."<br/>";
                                        
        }
        $j++;
    }
    $messageee1 = $messageee1   ."<strong>Good Luck & May the Force Be with You!</strong>"
                                ."<br/><br/>"
                                ."Regards,"
                                ."<br/>"
                                ."<strong>Team RefYaar</strong>"
                                ."<br/><br/>"
                                .'<a href="https://www.youtube.com/watch?v=S6O9HZ_L6fg">Watch the Video</a>'
                                ."&nbsp;&nbsp;&nbsp;&nbsp;"
                                .'<a href="https://www.facebook.com/refyaar">Like Us on Facebook</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
                                .'<a href="https://twitter.com/refyaar">Follow Us on Twitter</a>'."&nbsp;&nbsp;&nbsp;&nbsp;"
                                .'<a href="https://www.linkedin.com/company/refyaar">Follow Us on LinkedIn</a>'."&nbsp;&nbsp;&nbsp;&nbsp;";
    $Query11 = "select email from users where id=?";
    $stmt11 = $con->prepare($Query11);
    $stmt11->bind_param('i', $_SESSION["social_id"]);
    $stmt11->execute();
    $stmt11->bind_result($posterEmail);
    $stmt11->store_result();
    if ($stmt11->fetch()) {
        $to1 = $posterEmail;
        $from1 = "RefYaar@refyaar.com";
        $subject1 = "Applicant Information for the position of ".$headline." at ".$organization.": Location - ".$city;
        sendMail1($to1, $from1, $subject1, $messageee1);
    }
    $to2 = "soham@refyaar.com";
    $from2 = "Refyaar@refyaar.com";
    $subject2 = "Applicant Information";
    sendMail2($to2, $from2, $subject1, $messageee1);
    sendMail2($to2, $from2, $subject, $messageee);
    echo "succ";
} else {
    echo "Err";
}
?>

