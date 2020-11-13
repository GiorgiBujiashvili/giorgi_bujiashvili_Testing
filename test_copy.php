<?php
    session_start();
    include_once("dbconnect.php");

    $test_chosen_answers = array();

    if (isset($_POST['submit'])) {
        $k = 0;
        foreach($_SESSION["saved_ids"] as $temp_1_id){
            $test_chosen_answers[] = $_POST["q$temp_1_id"];
        }

    $_SESSION["test_chosen_answers"] = $test_chosen_answers;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Testireba Test</title>
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
<form  method="POST"  enctype="multipart/form-data" role="form" id="myform" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php
$questions = "";
$number = 0;
$saved_ids_array = array();
$saved_questions_array = array();
$saved_answer1_array = array();
$saved_answer2_array = array();
$saved_answer3_array = array();
$saved_correct_answers_array = array();

// $test_chosen_answers = array();
$test_state = $_SESSION["test_state"];
$q = 1;

    echo "<div>";
    if($test_state > 0){
        $y = 0;
        
        $remake_question = $_SESSION["saved_questions"];
        $remake_answer1 = $_SESSION["saved_answer1"];
        $remake_answer2 = $_SESSION["saved_answer2"];
        $remake_answer3 = $_SESSION["saved_answer3"];

        foreach($saved_ids_array as $temporary_id){
            $temporary_question = $remake_question[$y];
            $temporary_answer1 = $remake_answer1[$y];
            $temporary_answer2 = $remake_answer2[$y];
            $temporary_answer3 = $remake_answer3[$y];
            
            
        echo "<h3>$q). $question</h3>
            <tr><td><input type=radio name='q$temporary_id' value=\"$temporary_answer1\">$temporary_answer1</td><br>
            <td><input type=radio name='q$temporary_id' value=\"$temporary_answer2\">$temporary_answer2 </td><br>
            <td><input type=radio name='q$temporary_id' value=\"$temporary_answer3\">$temporary_answer3 </td><br></tr>
            <hr />";    
            $y++;
            $q++;
        }
        
    }
    if ($test_state < 1) {
        $sql = "SELECT * FROM questions_2 ORDER BY RAND(), ID_qs";
        // $sql = "SELECT * FROM questions_2 ORDER BY RAND(), ID_qs LIMIT 2";

        $results = mysqli_query($connection, $sql) or die("Connection Error1");
    
        
        if(mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)){
                
                $id = $row['ID_qs'];
                $question = $row['question'];
                $answer1 = $row['answer1'];
                $answer2 = $row['answer2'];
                $answer3 = $row['answer3'];
                $correct_answer = $row['correct_answer'];
                //
                $ans_array = array($row['answer1'],$row['answer2'],$row['answer3']);
                shuffle($ans_array);
                //

                $saved_ids_array[] = $id;
                $saved_questions_array[] = $question;
                // $saved_answer1_array[] = $answer1;
                // $saved_answer2_array[] = $answer2;
                // $saved_answer3_array[] = $answer3;
                $saved_answer1_array[] = $ans_array[0];
                $saved_answer2_array[] = $ans_array[1];
                $saved_answer3_array[] = $ans_array[2];

                $saved_correct_answers_array[] = $correct_answer;
    
                echo "<h3><b>$q</b>) $question</h3>
                      <tr><td><span class=\"td\"><input type=radio name='q$id' value=\"$ans_array[0]\">$ans_array[0]</span></td><br>
                      <td><span class=\"td\"><input type=radio name='q$id' value=\"$ans_array[1]\">$ans_array[1] </span></td><br>
                      <td><span class=\"td\"><input type=radio name='q$id' value=\"$ans_array[2]\">$ans_array[2] </span></td><br>
                      <td><input id=\"idEmpty\" type=radio name='q$id' value=\"\" checked=\"checked\"> </td><br></tr><br>
                      <hr />";
                      $q++;
            }
        }
        echo "</div>";
        // echo "<input value=\"ტესტის დასრულება\"     name=\"submit\"     type=\"submit\" class=\"testFinish\">"; 

        
        $test_state++;
        $_SESSION["test_state"] = $test_state;
        $_SESSION["saved_ids"] = $saved_ids_array;
        $_SESSION["saved_questions"] = $saved_questions_array;
        $_SESSION["saved_answer1"] = $saved_answer1_array;
        $_SESSION["saved_answer2"] = $saved_answer2_array;
        $_SESSION["saved_answer3"] = $saved_answer3_array;
        $_SESSION["saved_correct_answers"] = $saved_correct_answers_array;
    } 
?>  
</form>
<input value="ტესტის დასრულება"     name="submit"     type="submit" class="testFinish">";

<script type="text/javascript">
    $(document).ready(function(){
    $('#submit').click(function(){
        $.post($(this).attr("action"), $("#myform").serialize(),function(response){
            alert(response) // you can get the success response return by php after submission success
        });
    )};
});
</script>

<?php
$x = 0;
$score = 0;

if (isset($_POST['submit'])) {
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
        // echo $score."<br>";
        // print_r($test_chosen_answers[0]);
        // echo $test_chosen_answers;
    
        $_SESSION["score"] = $score;
        // $_SESSION["test_chosen_answers"] = $test_chosen_answers;
        // $_SESSION["test_chosen_answers"];
        
        // header("Location: session_end.php");
    
    }

?>

</body>
</html>