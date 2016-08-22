<?php

require("../../config.php");
session_start();
ob_start();
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());

$Query1 = "select count(*) from job_applied where job_post_id=? and user_id=?";
$stmt1 = $con->prepare($Query1);
$stmt1->bind_param('ii', $_GET["id"], $_SESSION["social_id"]);
$stmt1->execute();
$stmt1->bind_result($countapplied);
$stmt1->store_result();
$stmt1->fetch();
if ($countapplied < 1) {
    $query = "insert into job_applied(user_id,job_post_id) values(?,?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ii', $_SESSION["social_id"], $_GET["id"]);
    if ($stmt->execute()) {
        echo $con->insert_id . "Success";
    } else {
        echo "error";
    }
}
$stmt1->close();
$con->close();
?>
