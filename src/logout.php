<?php
session_start();
ob_start();
require '../config.php';
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>RefYaar | Logout</title>
    </head>
    <body>
        <?php
        header("Location: ../index.php?q=logout");
        ?>
    </body>
</html>
