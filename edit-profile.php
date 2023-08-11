<?php

session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

if (isset($_GET['id']) && $_SESSION['id'] == $_GET['id']) {
    $id = $_GET['id'];

    $email = $_SESSION['email'];

    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  ";

    $runQuery = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($runQuery);
} else {
    header("location:index.php");
}


?>


<div class="container mt-5">

    <?php if (isset($_SESSION['errors'])) { ?>

        <div class="alert alert-danger w-50">
            <?php foreach ($_SESSION['errors'] as $error) { ?>
                <p><?php echo $error ?></p>
            <?php }
            unset($_SESSION['errors']) ?>
        </div>

    <?php } ?>



    <form action="handlers/handle-edit-data.php?id=<?php echo $result['id'] ?>" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">userName</label>
            <input value="<?= $result['userName'] ?>" name="userName" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">email</label>
            <input name="email" type="email" class="form-control" value="<?= $result['email'] ?>">

        </div>

        <div class="mb-3">
            <label class="form-label"> Image </label>
            <input name="image" class="form-control" type="file">
        </div>

        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form>
    <br>
    <a href="edit-password.php?id=<?php echo $result['id'] ?>" class="btn btn-primary">edit password</a>
    <br> <br>
    <a href="profile.php" class="btn btn-primary">back</a>
</div>


<?php

require_once "inc/footer.php";

?>