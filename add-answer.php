<?php 
session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

if(isset($_GET['id']) && isset($_SESSION['id']))
{
    $question_id=$_GET['id'];

    $email = $_SESSION['email'];

    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  " ;

    $runQuery = mysqli_query($conn,$query);
    
    $result=mysqli_fetch_assoc($runQuery);

}else{
    header("location:index.php");
}

?>

<div class="container mt-5">

    <?php if(isset($_SESSION['errors'])) {?>

        <div class="alert alert-danger w-50">
            <?php foreach($_SESSION['errors'] as $error) {?>
                <p><?php echo $error?></p>
            <?php } unset($_SESSION['errors'])?>
        </div>

    <?php }?>

    <form action="handlers/handle-add-answer.php?id=<?php echo $question_id;?>" method="post">
       
        <div class="mb-3">
            <label  class="form-label">body</label>
            <input  name="body" type="text" class="form-control"  value="">

        </div>
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form> 
    <br> <br>
    <a href="profile.php" class="btn btn-primary" >back</a>
</div>


<?php 
require_once "inc/footer.php"; 
?>
