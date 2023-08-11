<?php
session_start();

require_once "../inc/dbConnection.php";

if($_SERVER['REQUEST_METHOD']="GET"){


    $query = "SELECT *  FROM `users` JOIN `questions` JOIN `answers` ON users.id=questions.user_id AND users.id=answers.user_id";
    
    $runQuery = mysqli_query($conn, $query);
    $results = mysqli_fetch_all($runQuery , MYSQLI_ASSOC);
    $jsonData = json_encode($results);
    print_r($jsonData);

}else{
    echo json_encode(["msg" => "method not allowed"]);
    http_response_code(405);
}


?>




   






   


  
 




