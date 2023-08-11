<?php
session_start();
require_once "inc/dbConnection.php";

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 2;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM  `questions`";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$query = "SELECT  * FROM `questions`  LIMIT $offset, $no_of_records_per_page";
$runQuery = mysqli_query($conn, $query);
$questions = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

?>
<?php
require_once "inc/header.php";
?>



<div class="container py-5">
    <?php if (!isset($_SESSION['email'])) { ?>
        <a class="btn btn-primary" href="login.php">Login</a>
    <?php } ?>
    <?php if (!isset($_SESSION['email'])) { ?>
        <a class="btn btn-primary float-right" href="register.php">Sign Up</a>
    <?php } ?>


    <?php if (isset($_SESSION['email'])) { ?>
        <a class="btn btn-primary " href="profile.php" name="submit">My profile</a>
    <?php } ?>

    <?php if (isset($_SESSION['email'])) { ?>
        <a class="btn btn-primary " href="add-question.php">Add Question</a>
    <?php } ?>

    <?php if (isset($_SESSION['email'])) { ?>
        <a class="btn btn-primary float-end" href="logout.php">Logout</a>
    <?php } ?>

    <br>

    <form class="d-flex  mt-4 " action="search-question.php" method="GET">
        <input class="form-control  me-2" type="search" placeholder="Search about your question" aria-label="Search" name="search">
        <button type="subit" class="btn btn-success" name="submit">Search</button>


    </form>
    <br>

    <h1>All Questions: </h1>

    <div class="container mt-2 ">

        <?php foreach ($questions as $question) {  ?>

            <hr class="w-75 mb-4 ">

            <h4><?php echo $question["title"]; ?></h4>
            <h6><?php echo $question["body"]; ?></h6>

            <?php if (isset($_SESSION['email'])) { ?>
                <a href="add-answer.php?id=<?php echo $question["id"];   ?>">
                    <button class="btn btn- btn-outline-warning">add answer</button></a>
            <?php } ?>

            <a href="show-question.php?id=<?php echo $question["id"];   ?>">
                <button class="btn btn- btn-outline-warning">show question</button></a>

            <hr class="w-75 mt-4 ">

        <?php } ?>


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

    <?php
    require_once "inc/footer.php";

    ?>