<?php
session_start();
error_reporting(0);

// 000webhost
// $servername = "localhost"; 
// $username = "id21581569_admin";
// $password = "Admin123!"; 
// $dbname = "id21581569_cendash";

// localhost
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "cendashdb";

$db = mysqli_connect($servername, $username, $password, $dbname);
?>