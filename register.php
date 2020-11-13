<?php
    session_start();
    // if(isset($_SESSION['id'])) {
    //     header("Location: index.php");
    // }
$fname = "";
$lname = "";
$email = "";
$position = "";
$phone_number = "";

    if(isset($_POST['submit'])) {
        include_once("dbconnect.php");

        $fname = strip_tags($_POST['fname']);
        $lname = strip_tags($_POST['lname']);
        $personal_id = strip_tags($_POST['personal_id']);
        $email = strip_tags($_POST['email']);
        $position = strip_tags($_POST['position']);
        $phone_number = strip_tags($_POST['phone_number']);

        $fname = stripslashes($fname);
        $lname = stripslashes($lname);
        $personal_id = stripslashes($personal_id);
        $email = stripslashes($email);
        $position = stripslashes($position);
        $phone_number = stripslashes($phone_number);

        $fname = mysqli_real_escape_string($connection, $fname);
        $lname = mysqli_real_escape_string($connection, $lname);
        $personal_id = mysqli_real_escape_string($connection, $personal_id);
        $email = mysqli_real_escape_string($connection, $email);
        $position = mysqli_real_escape_string($connection, $position);
        $phone_number = mysqli_real_escape_string($connection, $phone_number);

        $sql_store = "INSERT INTO monacemebi (piradi_id, saxeli, gvari, pozicia, email, teleponi) VALUES ('$personal_id', '$fname', '$lname', '$position', '$email', '$phone_number')";

        if($fname == "" || $lname == "" ) {
            echo "სახელი და გვარი შეიყვანეთ";
            return;
        }
        if($personal_id == "" ) {
            echo "პირადობის ნომერი შეიყვანეთ";
            return;
        }
        if(strlen($personal_id) != 11) {
            echo "პირადობის ნომერი შეიყვანეთ სწორად";
            return;
        }
        if(!is_numeric($personal_id)) {
            echo "პირადობის ნომერი შეიყვანეთ სწორად";
            return;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email = "" ) {
            echo "E-mail არასწორად არის შეყვანილი";
            return;
        }
        if($position == "" ) {
            echo "პოზიცია შეიყვანეთ";
            return;
        }
        if($phone_number == "" ) {
            echo "ტელეფონის ნომერი შეიყვანეთ";
            return;
        }

        //-----ID check 
        $id_check = "SELECT * FROM results WHERE piradi_id = '$personal_id' ORDER BY ID_r DESC LIMIT 1";
    
        if (mysqli_num_rows($id_check) > 0) {
            mysqli_query($connection, $sql_store);

            $_SESSION["register_id"] = $latest_id;
            $_SESSION["personal_id"] = $personal_id;
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["test_state"] = 0;

            $latest_id =  mysqli_insert_id($connection);    
            $_SESSION["insert_id"] = $latest_id;

            header("Location: test.php");
        }
        if (mysqli_num_rows($id_check) == 0)  {
            mysqli_query($connection, $sql_store);

            $_SESSION["register_id"] = $latest_id;
            $_SESSION["personal_id"] = $personal_id;
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["test_state"] = 0;
    
            $latest_id =  mysqli_insert_id($connection);    
            $_SESSION["insert_id"] = $latest_id;
            // echo "Insert successful. Latest ID is: " . $latest_id;        }

            $questions = "";
            $number = 0;
            $saved_ids_array = array();
            $saved_questions_array = array();
            $saved_answer1_array = array();
            $saved_answer2_array = array();
            $saved_answer3_array = array();
            $temp_chosen_ans_generation = array();
            $string = "პასუხი არ არის არჩეული";


            $sql = "SELECT * FROM questions_3 ORDER BY RAND(), ID_qs";
            
            //------

            $results = mysqli_query($connection, $sql) or die("Connection Error1");

            if(mysqli_num_rows($results) > 0) {
                while($row = mysqli_fetch_assoc($results)){
                    
                    $id = $row['ID_qs'];
                    $question = $row['question'];
                    $answer1 = $row['answer1'];
                    $answer2 = $row['answer2'];
                    $answer3 = $row['answer3'];
                    $correct_answer = $row['correct_answer'];

                    $ans_array = array($row['answer1'],$row['answer2'],$row['answer3']);
                    shuffle($ans_array);

                    $saved_ids_array[] = $id;
                    $saved_questions_array[] = $question;
                    $saved_answer1_array[] = $ans_array[0];
                    $saved_answer2_array[] = $ans_array[1];
                    $saved_answer3_array[] = $ans_array[2];
                    $saved_correct_answers_array[] = $correct_answer;
                    $temp_chosen_ans_generation[] = $string;
                }
            // }

        $sql_ids_array = serialize($saved_ids_array);
        $sql_questions_array = serialize($saved_questions_array);
        $sql_answer1_array = serialize($saved_answer1_array);
        $sql_answer2_array = serialize($saved_answer2_array);
        $sql_answer3_array = serialize($saved_answer3_array);
        $sql_correct_answers = serialize($saved_correct_answers_array);
        $sql_chosen_answer_generation = serialize($temp_chosen_ans_generation);
        
        //upload the results and stuff i guess.
        
        }
        $sql_store = "INSERT INTO results (piradi_id, question_ids, question, answers1, answers2, answers3, correct_answers, chosen_answers) VALUES 
        ('$personal_id', '$sql_ids_array', '$sql_questions_array', '$sql_answer1_array', '$sql_answer2_array', '$sql_answer3_array', '$sql_correct_answers', '$sql_chosen_answer_generation')";
        mysqli_query($connection, $sql_store) or die("Connection Error2");


        header("Location: test.php");
    }
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Testireba Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body  style="background-color:aliceblue;">

<form action="register.php" method="post" enctype="multipart/form-data" class="register">
    <table>
        <tr>
            <td><span class="register2">სახელი: </span></td>
            <td><input placeholder="სახელი"         name="fname"        type="text" class="register2" autofocus></td>
        </tr>
        <tr>
            <td><span class="register2">გვარი: </span></td>
            <td><input placeholder="გვარი"          name="lname"        type="text"class="register2"></td>
        </tr>
        <tr>
            <td><span class="register2">პირადი ნომერი: </span></td>
            <td><input placeholder="პირადი ნომერი" name="personal_id"  type="text"class="register2"></td>
        </tr>
        <tr>
            <td><span class="register2">E-Mail: </span></td>
            <td><input placeholder="E-Mail"         name="email"        type="text"class="register2"></td>
        </tr>
        <tr>
            <td><span class="register2">პოზიცია: </span></td>
            <td><input placeholder="პოზიცია"        name="position"     type="text"class="register2"></td>
        </tr>
        <tr>
            <td><span class="register2">ტელეფონი: </span></td>
            <td><input placeholder="ტელეფონი"      name="phone_number" type="text"class="register2"></td> 
        </tr>
        <tr>
        <td colspan="2" class="registerbutton"><input value="ტესტის დაწყება" class="registerbutton1"         name="submit"     type="submit" ></td>
        </tr>
    </table>
</form>


</body>
</html>