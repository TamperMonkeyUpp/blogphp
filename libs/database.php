<?php

$dbserver ="localhost";
$dbusername ="root";
$dbpassword = "";
$dbdatabase = "osmanblog";

$connection = mysqli_connect($dbserver,$dbusername,$dbpassword,$dbdatabase);

mysqli_set_charset($connection, "UTF8");

if (mysqli_connect_errno() > 0) {
    die("error: ".mysqli_connect_errno());
}

?>