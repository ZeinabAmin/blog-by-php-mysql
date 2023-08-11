<?php
session_start();
require_once "inc/dbConnection.php";


if (isset($_SESSION['email'])) {


    $email = $_SESSION['email'];
    $queryUser = "SELECT * FROM `users` WHERE  `email`= '$email'  ";
    $runQueryUser = mysqli_query($conn, $queryUser);
    $result = mysqli_fetch_assoc($runQueryUser);
    $id = $result['id'];


    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 2;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM  `questions` WHERE questions.user_id='$id'";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $query = "SELECT  * FROM `questions`  WHERE questions.user_id='$id'  LIMIT $offset, $no_of_records_per_page";
    $runQuery = mysqli_query($conn, $query);
    $myQuestions = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

?>

    <?php


    $email = $_SESSION['email'];

    $query = "SELECT * FROM `users` WHERE  `email`= '$email'  ";

    $runQuery = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($runQuery);

    $id = $result['id'];

    $sql  = "SELECT * FROM `questions` WHERE questions.user_id='$id'  ";
    $runSQl = mysqli_query($conn, $sql);
    $myQuestions = mysqli_fetch_all($runSQl, MYSQLI_ASSOC);

    ?>


    <?php
    require_once "inc/header.php";
    ?>

    <div class="w-50 m-auto border text-center mt-5">
        <h2>My Profile</h2>
        <img style="width:300px; height:300px" src="upload/<?php echo $result['image'] ?>" alt="">
        <p>Username: <?php echo $result['userName'] ?></p>
        <p>Email: <?php echo $result['email'] ?></p>

        <a class="btn btn-primary mb-3 w-50" href="edit-profile.php?id=<?php echo $result['id'] ?>">Edit</a>

    </div>

    <div class="container">
        <div class="row">
            <h4 class="text-center mt-4">My Questions:</h4>
            <br>

            <?php foreach ($myQuestions as $myQuestion) { ?>
                <div class="col-md-12 mt-4 p-3 result">
                    <h5><?php echo $myQuestion['title'] ?></h5>
                    <h6><?php echo $myQuestion['body'] ?></h6>
                    <a class="btn btn-warning" href="edit-question.php?id=<?php echo $myQuestion['id'] ?>">Edit</a>
                    <a class="btn btn-danger" href="handlers/handel-delete-question.php?id=<?php echo $myQuestion['id'] ?>">Delete</a>


                </div>
            <?php } ?>

            <br>

            <ul class="pagination justify-content-center mt-4">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                <li class="page-item    <?php if ($pageno <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                    echo '#';
                                                } else {
                                                    echo "?pageno=" . ($pageno - 1);
                                                } ?>">Prev</a>
                </li>
                <li class=" page-item   <?php if ($pageno >= $total_pages) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                    echo '#';
                                                } else {
                                                    echo "?pageno=" . ($pageno + 1);
                                                } ?>">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </div>

    </div>

    <a href="index.php" class="btn btn-primary">back</a>


<?php } else {
    header("location:index.php");
}

?>

<?php
require_once "inc/footer.php";
?>