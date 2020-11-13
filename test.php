<?php
    session_start();
    include_once("dbconnect.php");

    $test_chosen_answers = array();
    $temp_chosen_answers = array();
    $temp_correct_answer = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Testireba Test</title>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
    h3 { font-weight: normal; margin-left: 3%;}
    input { margin-left: 5%;}
    .testFinish { text-align: center; margin-left: 45%; font-weight: bold; font-size: 103%;}
    .td {font-size: 107%;}
    #idEmpty{visibility:hidden;}
    </style>
</head>
<body  style="background-color:aliceblue;">
<form  method="POST" name="forma" enctype="multipart/form-data" role="form" id="myform" action="session_end.php">
<?php
$questions = "";
$number = 0;
$q_ids = array();
$saved_ids_array = array();
$question = array();
$answer1 = array();
$answer2 = array();
$answer3 = array();
$correct_answer = array();
// $test_state = "";
$personal_id = "";
$string = "პასუხი არ არის არჩეული";
$check1 = "";
$check2 = "";
$check3 = "";
$check4 = "";

$temporary_correct_answer = array();
$test_chosen_answers = array();

// $test_state = $_SESSION["test_state"];
$personal_id = $_SESSION["personal_id"];
// $latest_id = $_SESSION["insert_id"];
$q = 1;
$y = 0;

    echo "<div>";
        $sql = "SELECT * FROM results WHERE piradi_id = $personal_id ORDER BY ID_r DESC LIMIT 1";

        $results = mysqli_query($connection, $sql) or die("Connection Error1");
        
        if(mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)){
                $table_row_id = $row['ID_r'];
                $piradi_id = $row['piradi_id'];
                $q_ids = unserialize($row['question_ids']);
                $question = unserialize($row['question']);
                $answer1 = unserialize($row['answers1']);
                $answer2 = unserialize($row['answers2']);
                $answer3 = unserialize($row['answers3']);
                $correct_answer = unserialize($row['correct_answers']);
                $temp_check_generation = unserialize($row['chosen_answers']);

                $temporary_correct_answer[] = $correct_answer;
                foreach($q_ids as $temp_q_ids){
                    $temporary_question = $question[$y];
                    $temporary_answer1 = $answer1[$y];
                    $temporary_answer2 = $answer2[$y];
                    $temporary_answer3 = $answer3[$y];

                    if ($temp_check_generation[$y] === $temporary_answer1) {
                        $check1 = "checked=\"checked\"";
                    }elseif ($temp_check_generation[$y] === $temporary_answer2) {
                        $check2 = "checked=\"checked\"";                    
                    }elseif ($temp_check_generation[$y] === $temporary_answer3) {
                        $check3 = "checked=\"checked\"";                    
                    } else {
                        $check4 = "checked=\"checked\""; 
                    }
                    // else {
                    //     $check4 = "\"checked=\"checked\""; 
                    // }
                    
                    //use if statement to check if there even ARE answers for the correct answers array
                //!!!!!!!!!!!!!!!!!!!!!!!!put the generation code here from session_end

                // echo "<h3><b>$q</b>)$temp_q_ids $temporary_question</h3> 
                echo "<h3><b>$q</b>) $temporary_question</h3> 
                      <tr><td><span class=\"td\"><input type=radio name='q$temp_q_ids' value=\"$temporary_answer1\" $check1>$temporary_answer1</span></td><br>
                      <td><span class=\"td\"><input type=radio name='q$temp_q_ids' value=\"$temporary_answer2\" $check2>$temporary_answer2 </span></td><br>
                      <td><span class=\"td\"><input type=radio name='q$temp_q_ids' value=\"$temporary_answer3\" $check3>$temporary_answer3 </span></td><br>
                      <td><input id=\"idEmpty\" type=radio name='q$temp_q_ids' value=\"პასუხი არ არის არჩეული\" $check4 > </td><br></tr><br>
                      <hr />";
                      
                      $y++;
                      $q++;
                      $check1 = "";
                      $check2 = "";
                      $check3 = "";
                      $check4 = "";
            }
        }

        // $_SESSION["test_state"] = $test_state;
        $_SESSION["saved_ids"] = $q_ids;
        $_SESSION["saved_questions"] = $question;
        $_SESSION["saved_answer1"] = $answer1;
        $_SESSION["saved_answer2"] = $answer2;
        $_SESSION["saved_answer3"] = $answer3;
        $_SESSION["saved_correct_answers"] = $correct_answer;
    }
        echo "</div>";
        // echo "<input value=\"ტესტის დასრულება\"     name=\"submit\"     type=\"submit\" class=\"testFinish\">"; 

        // print_r($correct_answer);
?>  
<input value="ტესტის დასრულება"     name="submit_test"     type="submit" class="testFinish">
</form>

<div id="log"></div>



<?php
// $x = 0;
$test_chosen_answers1 = array();
$temp_correct_answer1 = array();
$score = 0;
    $k = 0;

if (isset($_POST['submit_test'])) {
    
    // print_r($q_ids);
    foreach($q_ids as $temp_1_id){
        $test_chosen_answers1[] = $_POST["q$temp_1_id"];
    }
    $_SESSION["saved_chosen_answers"] = $test_chosen_answers1;
    // print_r($test_chosen_answers1);
    // foreach($_SESSION["saved_ids"] as $temp_1_id){
    //     $test_chosen_answers[] = $_POST["q$temp_1_id"];
    // }
    // $_SESSION["test_chosen_answers"] = $test_chosen_answers;
    // $temporary_chosen_ans = $_SESSION["test_chosen_answers"];
    // foreach($saved_ids_array as $temp_id){
    //     $temp_answer = $saved_correct_answers_array[$x];
    //     $temp_chosen_ans = $temporary_chosen_ans[$x];

    //     // $q = "q$temp_id";
                            
    //     // $q = trim($q);
    //     // $test_chosen_answers[] = $_POST[$q];
    //     if ($temp_chosen_ans == $temp_answer) {                
    //         $score++;
    //     }        
    //     $x++;
    // }


    foreach($_SESSION["saved_ids"] as $temp_id){
        $temp_correct_answer1 = $temporary_correct_answer[0][$k];
        $temp_chosen_answer11 = $test_chosen_answers1[$k];


        if($temp_correct_answer1 == $temp_chosen_answer11){
            $score++;
        }
        $k++;
    }
    // print_r($temporary_correct_answer[0]);

    print_r($test_chosen_answers1);
    echo $score;

        date_default_timezone_set('Asia/Tbilisi');
        $time = date("Y-m-d H:i");

        $test_chosen_answers1 = serialize($test_chosen_answers1);
        $sql_update_answers = "UPDATE results SET chosen_answers = '{$test_chosen_answers1}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
        $sql_update_answers1 = "UPDATE results SET score = '{$score}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
        $sql_update_answers2 = "UPDATE results SET date_time = '{$time}' WHERE piradi_id = '{$personal_id}' ORDER BY ID_r DESC LIMIT 1";
        $uploadThing = mysqli_query($connection, $sql_update_answers) or die("Connection Error. upload");
        $uploadThing1 = mysqli_query($connection, $sql_update_answers1) or die("Connection Error. upload");
        $uploadThing2 = mysqli_query($connection, $sql_update_answers2) or die("Connection Error. upload");

        //save and THEN clear the saved answers HERE but make sure the "if chosen answer is same as the radio name then print 'checked'" tech works 

         //-----------
        // header("Location: session_end.php");
    }

    // $w2 = new EvTimer(1, 2, function () {
    //     // echo "is called every 2 second, is launched after 1 seconds\n";
    //     // echo "is called every 180 second, is launched after 90 seconds\n";
    //     echo "saved!", Ev::iteration(), PHP_EOL;
    
    //     // Stop the watcher after 5 iterations
    //     Ev::iteration() == 2 and $w->stop();
    //     Ev::iteration() >= 59 and $w->stop();
    //     // Stop the watcher if further calls cause more than 10 iterations
    //     // Ev::iteration() >= 10 and $w->stop();
    // });

?>

<script>

$(document).ready(function() {
    $("input").click(function() {
        $("#log").html(function() {
            var str = '';
            $(":checked").each(function() {
                str += $(this).val() + "#!%";

            });
            // return str;
            $.ajax ({
                type: "POST",
                url:"insert.php",
                data: {'str':str},
                success: function() {
                    // console.log("message sent!");
                }
            });
        
        });
    });
});
        // $(document).ready(function() {
        //     $('input[type="radio"]').click(function() {
        //         event.preventDefault();
		// 		var elems = $('form[name=forma]');
        //                         var info = elems.serialize();
		// 		$.ajax({
		// 			url: 'register_subject.php',
		// 			type: 'POST',
		// 			data: info,//{ CB_section : arrayString},//$('input:radio[name=CB_section]:checked').val()},
		// 			success: function (data1) {
		// 				$('#registration_reply').html(data1);
        //             },
        //             success: function(data) {
        //                 $('#result').html(data);
        //             }
        //         });
        //     });
        // });
    </script>

</body>
</html>