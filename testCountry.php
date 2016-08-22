<?php
require("config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
try {
?>
<div class="col-md-6 ref-form-elt">

    <select id="country" name="country" class="form-control ref-form-control">
        <option>Select a Country*</option>  
        <?php
        $query = "select id, country from location__country where status='Active' order by country";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $country);
        $stmt->store_result();
        while ($stmt->fetch()) {
            echo "<option value='$id'>$country</option>";
        }
        $stmt->close();
        ?>
    </select>
</div>
<?php
}
catch (Exception $e) {
   
    echo "Error: $e";
   
}
?>
