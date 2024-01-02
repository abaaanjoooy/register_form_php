<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "educational_institution";

$conn = mysqli_connect($hostName,$dbUser, $dbPassword, $dbName);

if (!$conn) {
    # code...
    die("Something went wrong");
}
?>