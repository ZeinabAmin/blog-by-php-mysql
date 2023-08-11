<?php 

require_once "inc/dbConnection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>

.register-form{
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.register-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.register-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>

    <div class="register-form">

    <?php 
            session_start();
             if (isset($_SESSION['errors'])) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION['errors'] as $error) { ?>
                        <p><?= $error ?></p>
                    <?php } ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php } ?>

    <form action="handlers/handle-register.php" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Registration </h2>  

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="userName" class="form-control" placeholder="UserName" >
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" >
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password" >
            </div>
            <div class="form-group">
                <label>Confirm password</label>
                <input name="confirmPassword" type="password" class="form-control" placeholder="Confirm Password" >
            </div>
            <div class="form-group">
                <label>image</label>
                <input name="image" type="file" class="form-control" placeholder="image" required="required">
            </div>
            <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">register</button>
            </div>
            <p>
                Already a member? <a href="login.php">Login in</a>
            </p>


        </form>

    </div>

</body>
</html>
