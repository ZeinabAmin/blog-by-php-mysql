<?php
session_start();
require_once "../inc/dbConnection.php";

if (isset($_POST["submit"])) {
    // $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];
    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "must be email";
    }
    if (empty($password)) {
        $errors[] = "password is required";
    } elseif (!is_string($password)) {
        $errors[] = "password must be string";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM `users` WHERE email='$email' ";
        $runquery = mysqli_query($conn, $query);
        if (mysqli_num_rows($runquery) > 0) // or  == 1
        {
            $user = mysqli_fetch_assoc($runquery);
            // print_r($user);
            $userHashPassword = $user['password'];
            $iscorrect = password_verify($password, $userHashPassword); //true or false
            if ($iscorrect) {
                $_SESSION["id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                header("location:../index.php");
            } else {
                $errors[] ="password is not correct";
                $_SESSION["errors"] = $errors;
                header("location:../login.php");
            }
        } else {
            $errors[] ="Email not match";
            $_SESSION["errors"] = $errors;
            header("location:../login.php");
        }
    } else {
        $_SESSION["errors"] = $errors;
        print_r($errors);
        header("location:../login.php");
    }
}
