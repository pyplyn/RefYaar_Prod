<?php

session_start();
ob_start();
require("../../config.php");


$_q = "%$_GET[q]%";

$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$countQuery = "select id,company from prev_com  where company like ?";
$stmt1 = $con->prepare($countQuery);
//$pwd = md5($_POST["login-password"]);
$stmt1->bind_param('s', $_q);
$stmt1->execute();
$stmt1->bind_result($_id, $_category);
$stmt1->store_result();
$result = array();
while ($stmt1->fetch()) {
    $item = array();
    $item["label"] = $_category;
    $item["id"] = $_id;
    $result[] = $item;
}
print_r(json_encode($result));
$stmt1->close();
$con->close();
?>
