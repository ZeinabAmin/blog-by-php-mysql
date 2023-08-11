<?php
session_start();
require_once "../inc/dbConnection.php";

if(isset($_POST['submit']) && isset($_GET['id'])){

    $id=$_GET["id"];
    // $user_id=$_SESSION["id"];
  $answer=trim(htmlspecialchars($_POST['body']));

    $errors=[];
    if(empty($answer)){
        $errors[]="answer is required";
    }

    if(empty($errors))
    {  
        $query="UPDATE `answers` SET `body`='$answer' where id=$id";
        $runQuery=mysqli_query($conn,$query);

            header("location:../index.php");
    } else {
        $_SESSION['errors']=$errors;
        header("location:../edit-answer.php?id=$id");

    }
    }
?>

