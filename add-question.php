<?php 
session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

?>

 <?php if(isset($_SESSION['email'])) {?>

<div class="container mt-5">

    <?php if(isset($_SESSION['errors'])) {?>

        <div class="alert alert-danger w-50">
            <?php foreach($_SESSION['errors'] as $error) {?>
                <p><?php echo $error?></p>
            <?php } unset($_SESSION['errors'])?>
        </div>

    <?php }?>


   
    <form action="handlers/handle-add-question.php" method="post">
       
        <div class="mb-3">
            <label  class="form-label">title</label>
            <input value=""  name="title" type="text" class="form-control">

        </div>
        <div class="mb-3">
            <label  class="form-label">body</label>
            <input  name="body" type="text" class="form-control"  value="">

        </div>
       
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form> 
    <br> <br>
    <a href="profile.php" class="btn btn-primary" >back</a>
</div>

<?php }else{
    header("location:index.php");
}


?> 

<?php 

require_once "inc/footer.php"; 

?>
