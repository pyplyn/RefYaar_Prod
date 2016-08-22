<?php

require("../../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query = "select id,keyword from keywords where status='Active' and keyword like ?";
$stmt = $con->prepare($query);
$q = "%$_GET[search]%";
$stmt->bind_param("s", $q);
$stmt->execute();
$stmt->bind_result($id, $skill);
$stmt->store_result();
$result = array();
while ($stmt->fetch()) {
    $obj = array();
    $obj["value"] = $skill;
    $obj["text"] = "$skill";
    $result [] = $obj;
}
print_r(json_encode($result));
$stmt->close();
$con->close();
?>