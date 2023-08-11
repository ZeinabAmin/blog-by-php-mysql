<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit']) && isset($_GET['id'])){

    $id = $_GET['id'];
    $newUserName = trim(htmlspecialchars($_POST['userName']));
    $newEmail = trim(htmlspecialchars($_POST['email']));
    $image = $_FILES['image']; //arr
    // print_r($image);
    $imageName = $image['name'];
    $imageType = $image['type'];
    $imageTmpName = $image['tmp_name']; 
    $imageError = $image['error'];
    $imageSize = $image['size']; //byte
    $imageSizeMb = $imageSize / (1024 ** 2); //mb
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    $errors = [];


    if (empty($newUserName)) {
        $errors[] = "new user name  is required";
    } elseif (!is_string($newUserName)) {
        $errors[] = "new user name must be string";
    } elseif (strlen($newUserName) >= 50) {
        $errors[] = "max length 50 ";
    }

    if (empty($newEmail)) {
        $errors[] = "email is required";
    } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "must be email";
    }

    if(empty($errors))
    {  
        if(!empty($imageName))
        {

            $randstr = uniqid();
            $imageNewName = "$randstr.$ext";
            move_uploaded_file($imageTmpName, "../upload/$imageNewName");

            $query="UPDATE `users` SET `userName`='$newUserName' ,`email`='$newEmail', `image`='$imageNewName' where id=$id";
            
            $runQuery=mysqli_query($conn,$query);
            unset($_SESSION["email"]);
            header("location:../login.php");
            // header("location:../profile.php");

        } else {

            $query="UPDATE `users` SET `userName`='$newUserName' ,`email`='$newEmail' where id=$id";

            $runQuery=mysqli_query($conn,$query);
    
            unset($_SESSION["email"]);
            header("location:../login.php");
            // header("location:../profile.php");
        }
        
    } else {
        $_SESSION['errors']=$errors;
        header("location:../edit-profile.php?id=$id");

    }

    }

?>