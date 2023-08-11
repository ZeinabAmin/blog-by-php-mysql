<?php 

session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

if(isset($_GET['id']) && $_SESSION['id'] == $_GET['id'])
{
    $id=$_GET['id'];

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

    <form action="handlers/handle-edit-password.php?id=<?php echo $result['id']?>" method="post" enctype="multipart/form-data">
      
        <div class="mb-3">
            <label  class="form-label">password</label>
            <input value=""  name="password" type="password" class="form-control">

        </div>
        
        <div class="mb-3">
            <label  class="form-label">confirmPassword</label>
            <input value=""  name="confirmPassword" type="password" class="form-control">

        </div>


        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form> 
    <br>
    <a href="edit-profile.php?id=<?php echo $result['id']?>" class="btn btn-primary" >back</a>

</div>


<?php 

require_once "inc/footer.php";

?>
