<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "testing";

$connection = mysqli_connect($servername, $username, $password, "$dbname");
$conn = mysqli_connect($servername, $username, $password, "$dbname");

if(!$connection){
    die ("Connection Error");
 }
 ?>