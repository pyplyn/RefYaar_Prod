<?php

require("../../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query = "select id,country from location__country where  country like ? ";
$stmt = $con->prepare($query);
$q = "%$_GET[search]%";
$stmt->bind_param("s", $q);
$stmt->execute();
$stmt->bind_result($id, $country);
$stmt->store_result();
$result = array();
if ($stmt->fetch()) {
    $obj = array();
    $obj["value"] = $id;
    $obj["text"] = "$country";
    $result [] = $obj;
}
print_r(json_encode($result));
$stmt->close();
$con->close();
?>