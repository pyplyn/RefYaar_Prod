<?php

require("../../config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
$query1 = "select country from location__country where id=?";
$stmt1 = $con->prepare($query1);
$stmt1->bind_param("i", $_GET["id"]);
$stmt1->execute();
$stmt1->bind_result($country);
$stmt1->store_result();
$stmt1->fetch();
if ($country == "India") {
    $query = "select id,state from location__state where country_id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $stmt->bind_result($id, $state);
    $stmt->store_result();
    echo "<option> State / Province*</option>";
    while ($stmt->fetch()) {
        echo "<option value='$id'>$state</option>";
    }
    $stmt->close();
} else {
    echo "<option>Not Applicable</option>";
}
$stmt1->close();
$con->close();
?>