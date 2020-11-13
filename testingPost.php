<?php
$x = 0;
$score = 0;
$saved_ids_array = $_POST[''];

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
        echo $test_answers[0];
        // $string = implode(',',$test_answers); 
        // echo $string; 
    }





    ?>