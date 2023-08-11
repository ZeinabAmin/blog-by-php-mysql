<?php

require_once "../inc/dbConnection.php";

if($_SERVER['REQUEST_METHOD']="POST"){
    $data = json_decode(file_get_contents("php://input")); //ass arr //to read data from body raw in postman or html file
    // (php://input) file in php //json
    //(php://input) is a PHP stream that allows you to read raw data from the request body of an HTTP request, and can be accessed using the file_get_contents() function.

    // print_r($data);
   $title = $data->title;
   $body = $data->body;
    $user_id = $data->user_id;

    $query = "INSERT INTO `questions` (`title`,`body`,`user_id`) VALUES ('$title','$body', $user_id)";
    $runQuery = mysqli_query($conn, $query);

    if($runQuery){
        echo json_encode(["msg"=>'Add Successfully']);

    }else{
        echo json_encode(["msg"=>'Failed to Add']);

    }
}else{
    echo json_encode(["msg" => "method not allowed"]);
    http_response_code(405);
}




?>
