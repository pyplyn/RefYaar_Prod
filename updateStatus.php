<?php

require("config.php");
session_start();
ob_start();
include 'Function/email-msg.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$status = 'Inactive';
$query = "update job_post set status=?  where post_time < curdate() - interval 5 day  and post_time > curdate() - interval 15 day";
$stmt = $con->prepare($query);
$stmt->bind_param('s', $status);
if ($stmt->execute()) {
    echo "Update status greater 6 than days <br>";
} else {
    echo "Error for updating status upto previous six days <br>";
}
?>

<?php

require("config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$sta = 'Closed';
$query = "update job_post set status=?  where post_time  <   curdate() - interval 15 day";
$stmt = $con->prepare($query);
$stmt->bind_param('s', $sta);
if ($stmt->execute()) {
    echo "Update status greater 16 than days";
} else {
    echo "Error for updating status greater 6  days";
}
?>
<?php

require("config.php");
session_start();
ob_start();
$count = "";
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query = "select id,user_id,organization,headline from job_post where  post_time  >   curdate() - interval 13  day and  post_time  <  curdate() - interval 12 day";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($id, $jobPoster, $org, $headline);
$stmt->store_result();
while ($stmt->fetch()) {
    $queryApp = "select user_id,job_post_id from  job_applied where job_post_id=?";
    $stmtApp = $con->prepare($queryApp);
    $stmtApp->bind_param('i', $id);
    $stmtApp->execute();
    $stmtApp->bind_result($userId, $postId);
    $stmtApp->store_result();
    while ($stmtApp->fetch()) {
        $queryApp = "select count(*) from  short_listed where job_post_id=? and user_id=?";
        $stmtApp = $con->prepare($queryApp);
        $stmtApp->bind_param('ii', $postId, $userId);
        $stmtApp->execute();
        $stmtApp->bind_result($count1);
        $stmtApp->store_result();
        if ($stmtApp->fetch()) {
            if ($count1 > 0) {
                echo "<br>User Already taking action";
            } else {
                $queryEmail = "select email from  users where id=?";
                $stmtEmail = $con->prepare($queryEmail);
                $stmtEmail->bind_param('i', $jobPoster);
                $stmtEmail->execute();
                $stmtEmail->bind_result($email);
                $stmtEmail->store_result();
                if ($stmtEmail->fetch()) {
                    echo "<br>Sent mail to " . $email;
                    $to = $email;
                    $from = "RefYaar@refyaar.com";
                    $subject = "Gentle Reminder: Shortlist candidates for the posted job.";
                    $messageee = "Hello,"
                                . "<br/><br/>"
                                . "Your Job Post has received the required number of suitable candidates."
                                . "<br/>"
                                . "Kindly shortlist a few candidates who you think are fit for the role."
                                ."<br/><br/>"
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
            }
//            echo $postId."/".$userId;
//            $count = $count + $count1;
        }
    }
}
?>
