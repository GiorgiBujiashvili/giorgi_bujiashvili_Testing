<?php
session_start();
include_once("dbconnect.php");

$personal_id = $_SESSION["personal_id"];
$answersHere = $_POST['str'];

$processed_answers = explode( '#!%', $answersHere );

$post_processed_answer = serialize($processed_answers); 
$correct_answers = $_SESSION["saved_correct_answers"];

$score = 0;
$k = 0;
foreach($_SESSION["saved_ids"] as $temp_id){
    $temp_correct_answer1 = $processed_answers[$k];
    $temp_chosen_answer11 = $correct_answers[$k];


    if($temp_correct_answer1 == $temp_chosen_answer11){
        $score++;
    }
    $k++;
} 

date_default_timezone_set('Asia/Tbilisi');
$time = date("Y-m-d H:i");


$sql_update_answers = "UPDATE results SET chosen_answers = '{$post_processed_answer}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
$sql_update_score = "UPDATE results SET score = '{$score}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
$sql_update_time = "UPDATE results SET date_time = '{$time}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";

$loremIpsum = mysqli_query($connection, $sql_update_answers) or die("Connection Error. upload");
$uploadThing1 = mysqli_query($connection, $sql_update_score) or die("Connection Error. upload1");
$uploadtime = mysqli_query($connection, $sql_update_time) or die("Connection Error. upload2");





?>