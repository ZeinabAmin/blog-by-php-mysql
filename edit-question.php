<?php 
session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

if(isset($_SESSION['email'])) {

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $query  = "SELECT * FROM `questions`  WHERE questions.id=$id  " ;
    $runQuery=mysqli_query($conn,$query);
    $result=mysqli_fetch_assoc($runQuery);
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

    <form action="handlers/handle-edit-question.php?id=<?php echo $result['id']?>" method="post">
       
        <div class="mb-3">
            <label  class="form-label">title</label>
            <input  value="<?php echo $result['title']?>"  name="title" type="text" class="form-control">

        </div>
        <div class="mb-3">
            <label  class="form-label">body</label>
            <input  name="body" type="text" class="form-control"   value="<?php echo $result['body']?>">

        </div>
       
        <button class="btn btn-primary" type="submit" name="submit">Edit</button>
    </form> 
   
    <br> <br>
    <a href="my-questions.php" class="btn btn-primary" >back</a>
</div>

<?php }else{
    header("location:index.php");
}
?> 

<?php 
require_once "inc/footer.php"; 
?>

      