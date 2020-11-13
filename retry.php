<?php

    if (isset($_SESSION['personal_id'])) {
        $_SESSION = array();
        session_destroy();
    }
    session_start();
    include_once("dbconnect.php");

    // if(isset($_POST['retry'])) {
    //     $_SESSION['personal_id'] = $personal_id;

    //     // $sql = "SELECT * FROM monacemebi WHERE piradi_id = $personal_id ORDER BY ID_r DESC LIMIT 1";

    //     // $results = mysqli_query($connection, $sql) or die("Connection Error1");
        
    //     // if(mysqli_num_rows($results) > 0) {
    //     //     while($row = mysqli_fetch_assoc($results)){
    //     //         $fname = $row['saxeli'];
    //     //         $lname = $row['gvari'];
    //     //         $email = $row['email'];
    //     //         $position = $row['pozicia'];
    //     //         $phone_number = $row['teleponi'];
    //     //         $piradi_id = $row['piradi_id'];
    //     //     }
    //     // }
    //     // $_SESSION["fname"] = $fname;
    //     // $_SESSION["lname"] = $lname;
    //     // $_SESSION["fname"] = $email;
    //     // $_SESSION["lname"] = $position;
    //     // $_SESSION["lname"] = $phone_number;

    //     header("Location: test.php");
    // }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body  style="background-color:aliceblue;">
    <form action="retry.php" method="POST" enctype="multipart/form-data" class="register">
    <table>
            <td><span class="register2">პირადი ნომერი: </span></td>
            <td><input placeholder="პირადი ნომერი" name="personal_id"  type="text" class="register2"></td>
        </tr>
        <tr>
        <td colspan="2" class="registerbutton">
        <input value="ტესტის დაწყება" class="registerbutton1" name="retry"     type="submit" >
        </td>
        </tr>
    </table>
</form>


    <?php
    if(isset($_POST['retry'])) {
        $personal_id = $_POST["personal_id"];
        $_SESSION["personal_id"] = $personal_id;

        // echo $personal_id;
        header("Location: test.php");
    }
    ?>
</body>
</html>