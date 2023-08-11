<?php
//handle-create
session_start();
require_once "../inc/dbConnection.php";

if(isset($_POST["submit"]))
{

$title=trim(htmlspecialchars($_POST['title']));
$body=trim(htmlspecialchars($_POST['body']));

// $id=$_SESSION["id"];
    $email = $_SESSION['email'];
    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  " ;
    $runQuery = mysqli_query($conn,$query);
    $result=mysqli_fetch_assoc($runQuery);
    $id = $result['id'];
    // echo $question , $id;
    
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
        $query="INSERT INTO `questions` (`title`,`body`,`user_id`) VALUES ('$title', '$body',$id)";//true or false //zero or one
        $runQuery=mysqli_query($conn,$query);

        header("location:../index.php");
    } else {
        $_SESSION['errors']=$errors;
        header("location:../add-question.php");
    }
}

 ?>