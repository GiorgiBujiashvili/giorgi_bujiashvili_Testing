<?php
    session_start();
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
    h3 { font-weight: normal;}
    p { margin-left: 3%;}
    tr { margin-left: 10%;}
    /* td{ max-width: justify;}
    .results1{ margin-left:14%; text-align: left; }
    .results2{text-align: left; margin-left: 15%; } */
    </style>
</head>
<body  style="background-color:aliceblue;">
<h1>ტესტის მოძებნა</h1>
    <form action="view_test.php" method="post">
        <input placeholder="პირადი ნომერი" name="nomeri" type="text" autofocus>
        <input type="submit" name="login" value="Search">
    </form>
<?php

$y = 0;
    $q = 1;
    if(isset($_POST['login'])) {
        include_once("dbconnect.php");
        
        $entered_id = $_POST['nomeri'];
    
            // $sql = "SELECT * FROM questions_2 ORDER BY ASC, ID_qs LIMIT 2";
            //$sql1 = "SELECT saxeli, gvari, email, teleponi, pozicia FROM monacemebi WHERE piradi_id='$entered_id' ORDERED BY"
        $sql = "SELECT monacemebi.saxeli, monacemebi.gvari, monacemebi.email, monacemebi.teleponi, monacemebi.pozicia, results.ID_r, results.piradi_id, results.question_ids, results.question, results.answers1, results.answers2, results.answers3, results.correct_answers, results.chosen_answers, results.score, results.date_time
            FROM results 
            INNER JOIN monacemebi ON results.piradi_id = monacemebi.piradi_id 
            WHERE results.piradi_id = $entered_id ORDER BY ID_r DESC LIMIT 1";
    
        $results = mysqli_query($connection, $sql) or die("Connection Error1");
    
        //aq daamate monacemebi mere!!!!!!!!!!
        
        //
        if(mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)){

                $saxeli = $row['saxeli'];
                $gvari = $row['gvari'];
                $email = $row['email'];
                $teleponi = $row['teleponi'];
                $pozicia = $row['pozicia'];
                $ID_r = $row['ID_r'];
                $piradi_id = $row['piradi_id'];
                $question_ids = unserialize($row['question_ids']);
                $question = unserialize($row['question']);
                $answer1 = unserialize($row['answers1']);
                $answer2 = unserialize($row['answers2']);
                $answer3 = unserialize($row['answers3']);
                $correct_answer = unserialize($row['correct_answers']);
                $chosen_answers = unserialize($row['chosen_answers']);
                $score = $row['score'];
                $date_time = $row['date_time'];    

                if (strlen($piradi_id) == 10) {
                    echo " <br><hr />
                    <table>
                        <tr>
                            <td><span class=\"results1\">saxeli: </span></td>
                            <td><span class=\"results2\">$saxeli</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">gavri: </span></td>
                            <td><span class=\"results2\">$gvari</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">piradi nomeri: </span></td>
                            <td><span class=\"results2\">0$piradi_id</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">teleponi: </span></td>
                            <td><span class=\"results2\">$teleponi</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">pozicia: </span></td>
                            <td><span class=\"results2\">$pozicia</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">email: </span></td>
                            <td><span class=\"results2\">$email</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">testis nomeri: </span></td>
                            <td><span class=\"results2\">$ID_r</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">score: </span></td>
                            <td><span class=\"results2\">$score</span></td>
                        </tr>
                        <tr>
                            <td><span class=\"results1\">date time: </span></td>
                            <td><span class=\"results2\">$date_time</span></td>
                        </tr>
                    </table> <hr />
                    ";
                }else{
                echo " <br><hr />
                <table>
                    <tr>
                        <td><span class=\"results1\">saxeli: </span></td>
                        <td><span class=\"results2\">$saxeli</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">gavri: </span></td>
                        <td><span class=\"results2\">$gvari</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">piradi nomeri: </span></td>
                        <td><span class=\"results2\">$piradi_id</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">teleponi: </span></td>
                        <td><span class=\"results2\">$teleponi</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">pozicia: </span></td>
                        <td><span class=\"results2\">$pozicia</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">email: </span></td>
                        <td><span class=\"results2\">$email</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">testis nomeri: </span></td>
                        <td><span class=\"results2\">$ID_r</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">score: </span></td>
                        <td><span class=\"results2\">$score</span></td>
                    </tr>
                    <tr>
                        <td><span class=\"results1\">date time: </span></td>
                        <td><span class=\"results2\">$date_time</span></td>
                    </tr>
                </table> <hr />
                ";
            }

                foreach($question_ids as $temporary_id){
                    $temporary_question = $question[$y];
                    $temporary_answer1 = $answer1[$y];
                    $temporary_answer2 = $answer2[$y];
                    $temporary_answer3 = $answer3[$y];
                    $temporary_correct_answer = $correct_answer[$y];
                    $temporary_chosen_answer = $chosen_answers[$y];
                    
                    
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
            }
        }
    }


?>
</body>
</html>