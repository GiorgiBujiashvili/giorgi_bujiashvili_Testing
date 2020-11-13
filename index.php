<?php
    session_start();
    include_once("dbconnect.php");

    // header("Location: register.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Testireba Index</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .beginButton{ display: block; margin-top: 23%; margin-left: 47%; text-align: center; }
    </style>
</head>
<body  style="background-color:aliceblue;">

<!-- <a href="register.php">testireba</a> <br> -->
<!-- <a href="#">login</a> <br> -->
<form action="register.php" class="flexbox">
    <input class="beginButton" type="submit" value="ტესტირების დაწყება"/>
</form>
    
</body>
</html> 