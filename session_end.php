<?php
    session_start();
    include_once("dbconnect.php");
    $personal_id = $_SESSION["personal_id"];

    $sql_info = "SELECT * FROM monacemebi WHERE piradi_id = '{$personal_id}' ORDER BY ID_m DESC LIMIT 1";
    $loremIpsum = mysqli_query($connection, $sql_info) or die("Connection Error. upload");

    if(mysqli_num_rows($loremIpsum) > 0) {
        while($row1 = mysqli_fetch_assoc($loremIpsum)){
                $fname = $row1['saxeli'];
                $lname = $row1['gvari'];
                // $lname = $row1['pozicia'];
                // $lname = $row1['email'];
                // $lname = $row1['teleponi'];
        }
    }

    $sql_results = "SELECT * FROM results WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
    $loremIpsum1 = mysqli_query($connection, $sql_results) or die("Connection Error. upload1");
    if(mysqli_num_rows($loremIpsum1) > 0) {
        while($row2 = mysqli_fetch_assoc($loremIpsum1)){
                $score = $row2['score'];
                $test_chosen_answers = unserialize($row2['chosen_answers']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
    h3 { font-weight: normal; margin-left: 3%;}
    p { margin-left: 5%;}
    /* .testFinish { text-align: center; margin-left: 45%; font-weight: bold; font-size: 103%;} */
    .score{font-size: 105%; font-weight: bold; margin-left: auto; margin-right: auto;}
    /* .scoremove1{margin-left: 45%;} */
    </style>
</head>
<body  style="background-color:aliceblue;">
<?php  
$saved_ids_array = $_SESSION["saved_ids"];
$saved_questions_array = $_SESSION["saved_questions"];
$saved_answer1_array = $_SESSION["saved_answer1"];
$saved_answer2_array = $_SESSION["saved_answer2"];
$saved_answer3_array = $_SESSION["saved_answer3"];
$saved_correct_answers = $_SESSION["saved_correct_answers"];
// $test_chosen_answers = $_SESSION["test_chosen_answers"];
// $score = $_SESSION["score"];
// $register_id = $_SESSION["register_id"];
// $fname = $_SESSION["fname"];
// $lname = $_SESSION["lname"];

$q = 1;
$y = 0;
$x = 0;

// echo "თქვენი ქულა არის: $score <br>";
echo "  <table style=\"margin-left: auto; margin-right: auto;\">
            <tr class=\"score\">
                <td><span class=\"scoremove1\">თქვენი ქულა არის: </span></td>
                <td><span class=\"\">$score</span></td>
            </tr>
        </table> <hr />";

        foreach($saved_ids_array as $temporary_id){
            $temporary_question = $saved_questions_array[$y];
            $temporary_answer1 = $saved_answer1_array[$y];
            $temporary_answer2 = $saved_answer2_array[$y];
            $temporary_answer3 = $saved_answer3_array[$y];
            $temporary_correct_answer = $saved_correct_answers[$y];
            $temporary_chosen_answer = $test_chosen_answers[$y];
            
            // <td><p><b>სწორი პასუხი:</b> $temporary_correct_answer </p>
            // <td><p><b>თქვენი არჩეული პასუხი:</b> $temporary_chosen_answer </p>
        // echo "<h3>$temporary_id). $temporary_question</h3>
        echo "<h3>$q). $temporary_question</h3>
            <tr>
            <td><p>$temporary_answer1 </p>
            <td><p>$temporary_answer2 </p>
            <td><p>$temporary_answer3 </p>
            
            <td><p><b>შეკითხვის სწორი პასუხი:</b> $temporary_correct_answer </p>
            <td><p><b>თქვენი არჩეული პასუხი:</b> $temporary_chosen_answer </p>
            </tr>
            <hr /></div>";    
            $y++;
            $q++;
        }

        // foreach($saved_ids_array as $temp_id){
        //     $temp_correct_answer = $saved_correct_answers[$x];
        //     $temp_chosen_answer = $test_chosen_answers[$x];

        //     if($temp_chosen_answer == $temp_correct_answer){
        //         $score++;
        //     }
        //     $x++;
        // }

        // echo "თქვენი ქულა არის: $score <br>";

        // info prep
        $sql_ids_array = serialize($saved_ids_array);
        $sql_questions_array = serialize($saved_questions_array);
        $sql_answer1_array = serialize($saved_answer1_array);
        $sql_answer2_array = serialize($saved_answer2_array);
        $sql_answer3_array = serialize($saved_answer3_array);
        $sql_correct_answers = serialize($saved_correct_answers);
        $sql_chosen_answers = serialize($test_chosen_answers);
        $sql_score = $score;

        date_default_timezone_set('Asia/Tbilisi');
        $time = date("Y-m-d H:i");

        //upload the results and stuff i guess.
        // $sql_store = "INSERT INTO results (ID_m, piradi_id, question_ids, question, answers1, answers2, answers3, correct_answers, chosen_answers, score, date_time) VALUES 
        // ('$register_id', '$personal_id', '$sql_ids_array', '$sql_questions_array', '$sql_answer1_array', '$sql_answer2_array', '$sql_answer3_array', '$sql_correct_answers', '$sql_chosen_answers', '$score', '$time')";

        $sql_store = "INSERT INTO results (piradi_id, question_ids, question, answers1, answers2, answers3, correct_answers, chosen_answers, score, date_time) VALUES 
        ('$personal_id', '$sql_ids_array', '$sql_questions_array', '$sql_answer1_array', '$sql_answer2_array', '$sql_answer3_array', '$sql_correct_answers', '$sql_chosen_answers', '$score', '$time')";

            
        mysqli_query($connection, $sql_store);
        // $_SESSION = array();
        // session_destroy();
?>
</body>
</html>