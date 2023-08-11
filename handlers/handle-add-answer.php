<?php
session_start();
require_once "../inc/dbConnection.php";

if (isset($_POST['submit']) && isset($_GET['id'])) {

    $question_id = $_GET["id"];
    $user_id = $_SESSION["id"];
    $body = trim(htmlspecialchars($_POST['body']));

    $errors = [];
    if (empty($body)) {
        $errors[] = "answer is required";
    }


    if (empty($errors)) {

        $query = "INSERT INTO `answers` (`body`,`question_id`,`user_id`) VALUES ('$body',$question_id,$user_id)";
        $runQuery = mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn) > 0) {

            // echo "Answer added successfully";
            header("location:../index.php");
        } else {
            $errors = ['failed to add answer'];
            $_SESSION['errors'] = $errors;
            header("location:add-answer.php");
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location:../add-answer.php?id=$question_id");
    }
}
