<?php
    session_start();
    include_once("dbconnect.php");

    // if (isset($_POST['submit'])) { 
    // echo "test";
    // header("Location: index.php");
    // }

    // if (isset($_POST['submit'])) {      

    //     $score = 0;    
    //     $total = mysql_num_rows($results);        
        
    //     while ($result = mysql_fetch_array($results)) {                            
        
    //     $answer = $result['correct_answer'];            
    //     $q = "q$result[id]";                    
    //     $q = trim($q);
    //     if ($_POST[$q] == $answer) {                
    //     $score++;                 
    //     }        
    //     }        
        
    //     echo "<p>$score</p>";    
          
    //     }  
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Testireba Test</title>
</head>
<body>
<form  action="testingPost.php" method="post"  enctype="multipart/form-data">
<?php
    //$sql = "SELECT * FROM questions ORDER BY RAND(), ID_q";
    $sql = "SELECT * FROM questions_2 ORDER BY RAND(), ID_qs";
    // $sqlSave = "INSERT INTO test_test (temp_data) VALUES ('$array')";

    $results = mysqli_query($connection, $sql) or die("Connection Error1");

    $questions = "";
    $number = 0;
    $array = array();
    $saved_answers_array = array();
    $saved_ids_array = array();
    $test_answers = array();
    // $array_save = mysqli_query($connection, $sqlSave) or die("Connection Error2");

    if(mysqli_num_rows($results) > 0) {
        while($row = mysqli_fetch_assoc($results)){
            //$id = $row['ID_q'];
            $id = $row['ID_qs'];
            $question = $row['question'];
            // $correct_answer = $row['correct_answer'];
            // $wrong_answer_1 = $row['wrong_answer_1'];
            // $wrong_answer_2 = $row['wrong_answer_2'];
            $answer1 = $row['answer1'];
            $answer2 = $row['answer2'];
            $answer3 = $row['answer3'];
            $correct_answer = $row['correct_answer'];
            $saved_answers_array[] = $correct_answer;
            $saved_ids_array[] = $id;
            // $ans_array = array($row['correct_answer'],$row['wrong_answer_1'],$row['wrong_answer_2']);
            // shuffle($ans_array);
            // $array[] = $id;
            // $questions .= "<div><h2><a href='view_post.php?pid=$id'>$question</a></h2><h3>$correct_answer</h3><p>$wrong_answer_1</p><p>$wrong_answer_2</p><hr /></div>";
            // $questions .= "<div><h2>$question</h2><p>$correct_answer</p><p>$wrong_answer_1</p><p>$wrong_answer_2</p><hr /></div>";
            
            // $testing .= "<div><h2>$question</h2>
            // <p>$ans_array[0];</p>
            // <p>$ans_array[1];</p>
            // <p>$ans_array[2];</p>
            // echo "<h3>$question</h3>
            //       <tr><td><input type=radio name='q$id' value=\"$ans_array[0]\">$ans_array[0]</td><br>
            //       <td><input type=radio name='q$id' value=\"$ans_array[1]\">$ans_array[1] </td><br>
            //       <td><input type=radio name='q$id' value=\"$ans_array[2]\">$ans_array[2] </td><br></tr>
            //       <hr /></div>";

            echo "<h3>$question</h3>
                  <tr><td><input type=radio name='q$id' value=\"$answer1\">$answer1</td><br>
                  <td><input type=radio name='q$id' value=\"$answer2\">$answer2 </td><br>
                  <td><input type=radio name='q$id' value=\"$answer3\">$answer3 </td><br></tr>
                  <hr /></div>";

        }
        // echo $questions;
        // echo $testing;
    }
    echo "<input value=\"test\"     name=\"submit\"     type=\"submit\" >"
    
?>  

</form>

<?php
$x = 0;
$score = 0;

// $sql1 = "SELECT * FROM questions ORDER BY ASC";
// $results1 = mysqli_query($conn, $sql1) or die("Connection Error2");
if (isset($_POST['submit'])) {
    foreach($saved_ids_array as $temp_id){
        $temp_answer = $saved_answers_array[$x];

        $q = "q$temp_id";
                            
        $q = trim($q);
        $test_answers[] = $_POST[$q];
        if ($_POST[$q] == $temp_answer) {                
            $score++;
            // echo $score;  
                     
        }        
        // echo $q;
        $x++;
    }
    
    // if(mysqli_num_rows($results) > 0) {
    //     while($row1 = mysqli_fetch_assoc($results)){
    //         $id1 = $row['ID_q'];
    //         $question1 = $row['question'];
    //         $correct_answer1 = $row['correct_answer'];
            
    //         $q = "q$id1";                    
    //         $q = trim($q);
    //         if ($_POST[$q] == $correct_answer1) {                
    //             $score++;
    //             // echo $score;            
    //         }        
    //         }        
    //         }  
        echo $score."<br>";
        print_r($test_answers);
        echo $test_answers[0];
        // $string = implode(',',$test_answers); 
        // echo $string; 
    }
    
    // while($x < 3) {
    //     $answer = $result['correct_answer'];            
    //     $q = "q$result[id]";                    
    //     $q = trim($q);
    //     if ($_POST[$q] == $correct_answer) {                
    //     $score++;          
        
        
    //     $x++;
    //   }
    // }
    // echo "$score";
    // }
    
    // while ($result = mysql_fetch_array($results)) {                            
    // $answer = $result['correct_answer'];            
    // $q = "q$result[id]";                    
    // $q = trim($q);
    // if ($_POST[$q] == $correct_answer) {                
    // $score++;                 
    // }        
    // }        
    // echo $score;    
    // }  

?>

</body>
</html>