<?php
require_once "../inc/dbConnection.php";

if($_SERVER['REQUEST_METHOD']="DELETE"){
    $URI = $_SERVER['REQUEST_URI'];
    $uriArray = explode("/" , $URI );
    $id = end($uriArray);

    $query ="DELETE FROM `questions` WHERE id=$id ";
    $runQuery = mysqli_query($conn, $query);

    if($runQuery){
        echo json_encode(["msg"=>'Deleted Successfully']);

    }else{
        echo json_encode(["msg"=>'Failed to Delete']);
    }

}else{
    echo json_encode(["msg" => "method not allowed"]);
    http_response_code(405);
}

?>