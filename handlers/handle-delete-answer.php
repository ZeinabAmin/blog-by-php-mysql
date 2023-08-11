<?php
session_start();
require_once "../inc/dbConnection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //   $user=$_SESSION["id"]
    // echo $id;
    $query = "SELECT * FROM `answers` WHERE id=$id ";
    $runquery = mysqli_query($conn, $query);
    // var_dump($runquery);

    if (mysqli_num_rows($runquery) > 0) {
        $query_d = "DELETE FROM `answers` where id=$id ";
        $runquery_d = mysqli_query($conn, $query_d);
        if ($runquery_d) {
            header("location:../index.php");
        } else {
            $errors = ['failed to delete'];
            $_SESSION['errors'] = $errors;

            header("location:../show-question.php");
        }
    } else {
        $errors = ['question not found'];
        $_SESSION['errors'] = $errors;
        header("location:../show-question.php");
    }
}
