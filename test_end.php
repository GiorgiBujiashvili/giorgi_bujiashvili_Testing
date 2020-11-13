<?php
    session_start();
    $saved_ids_array = $_SESSION["saved_ids"];
$saved_correct_answers = $_SESSION["saved_correct_answers"];
$test_chosen_answers = $_SESSION["test_chosen_answers"];
$score = $_SESSION["score"];
$register_id = $_SESSION["register_id"];
$personal_id = $_SESSION["personal_id"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];

$x = 0;

        foreach($saved_ids_array as $temp_id){
            $temp_correct_answer = $saved_correct_answers[$x];
            $temp_chosen_answer = $test_chosen_answers[$x];

            if($temp_chosen_answer == $temp_correct_answer){
                $score++;
            }
            $x++;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php  


        echo $register_id."<br>";
        echo $personal_id."<br>";
        echo $score."<br>";
?>


<?php

?>
</body>
</html>