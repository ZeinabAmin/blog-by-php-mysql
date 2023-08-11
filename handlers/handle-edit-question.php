<?php

session_start();
require_once "../inc/dbConnection.php";

if(isset($_POST['submit']) && isset($_GET['id'])){
  $id = $_GET['id'];
  $title=trim(htmlspecialchars($_POST['title']));

  $body=trim(htmlspecialchars($_POST['body']));
   
    $errors=[];
    if(empty($title)){
        $errors[]="title is required";
    }elseif (!is_string($title)) {
        $errors[]="title must be string";
    }
    if (empty($body)) {
     $errors[] = "body is required"; //push
 } elseif (!is_string($body)) {
     $errors[] = "body must be string";
 }

    if(empty($errors))
    { 
            $query="UPDATE `questions` SET `title`='$title', `body`='$body'where id=$id";
            $runQuery=mysqli_query($conn,$query);

            header("location:../index.php");
        
    } else {
        $_SESSION['errors']=$errors;
        header("location:../edit-question.php.php?id=$id");
    }
    }

?>

