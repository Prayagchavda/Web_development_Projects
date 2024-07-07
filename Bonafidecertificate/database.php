<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword);
if (!$conn) {
    die("Something went wrong;");
}

?>
