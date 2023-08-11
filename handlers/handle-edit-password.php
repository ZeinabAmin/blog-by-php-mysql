<?php
session_start();
require_once "../inc/dbConnection.php";

if(isset($_POST['submit']) && isset($_GET['id'])){

// if( isset($_GET['id'])){
$id=$_GET["id"];
echo $id;

$newPassword=$_POST["password"];
$confirmNewPassword=$_POST["confirmPassword"];

    $errors = [];

    if (empty($newPassword)) {
        $errors[] = "new Password is required";
    } elseif (!is_string($newPassword)) {
        $errors[] = "new Password must be string";
    }

    if (empty($confirmNewPassword)) {

        $errors[] = "confirm new Password is required";
    } elseif (!is_string($newPassword)) {
        $errors[] = "new Password must be string";
    } elseif ($newPassword != $confirmNewPassword) {
        $errors[] = "check your new Password and confirm new Password";
    }

    if (empty($errors)) {
        $newPasswordHash = password_hash($confirmNewPassword, PASSWORD_BCRYPT);
        $query = "UPDATE `users` set `password`='$newPasswordHash' where id=$id";
        $runquery = mysqli_query($conn, $query);
    
unset($_SESSION["email"]);
header("location:../login.php");
    } else {

        
$_SESSION["errors"]=$errors;
     
header("location:../edit-password.php?id=$id");

 }

}