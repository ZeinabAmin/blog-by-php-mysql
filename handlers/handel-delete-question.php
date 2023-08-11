<?php

session_start();
require_once "../inc/dbConnection.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //   $user=$_SESSION["id"];

    $query = "SELECT * FROM `questions` WHERE id=$id ";
    $runquery = mysqli_query($conn, $query);
    // $result=mysqli_fetch_assoc($runquery);
    // print_r($result);
    // var_dump($runquery);
    if (mysqli_num_rows($runquery) > 0) {

        $query_d = "DELETE FROM `questions` where id=$id ";
        $runquery_d = mysqli_query($conn, $query_d);
        if ($runquery_d) {
            header("location:../profile.php");
        } else {
            $errors = ['failed to delete'];
            $_SESSION['errors'] = $errors;

            header("location:my-questions.php");
        }
    } else {
        $errors = ['question not found'];
        $_SESSION['errors'] = $errors;
        header("location:my-questions.php");
    }
}
