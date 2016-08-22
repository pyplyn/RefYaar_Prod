<?php

session_start();
ob_start();
require("../../config.php");


$_q = "%$_GET[q]%";

$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$countQuery = "select company from company where company like ? and status='Active' order by company limit 10";
$stmt1 = $con->prepare($countQuery);
//$pwd = md5($_POST["login-password"]);
$stmt1->bind_param('s', $_q);
$stmt1->execute();
$stmt1->bind_result($_category);
$stmt1->store_result();
$result = array();
while ($stmt1->fetch()) {
    $item = array();
    $item["label"] = $_category;
    $item["id"] = $_category;
    $result[] = $item;
}
print_r(json_encode($result));
$stmt1->close();
$con->close();
?>
