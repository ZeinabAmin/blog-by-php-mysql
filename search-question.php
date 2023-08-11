<?php
require_once "inc/dbConnection.php";
require_once "inc/header.php";


if (!isset($_GET['search']) || $_GET['search'] === '') {
    header("location:index.php");
    // exit();
}

?>
<div class="container  my-5">
    <form class="d-flex  mt-4 " action="search-question.php" method="GET">
        <input class="form-control  me-2" type="search" placeholder="Search about your question" aria-label="Search" name="search">
        <button type="submit" class="btn btn-success" name="submit">Search</button>

    </form>
    <br>
    <h1>Search Results: </h1>
    <div class="row">

        <?php

        if (isset($_GET['search']) && isset($_GET['submit'])) {
            $term = $_GET['search'];
            $query = "SELECT * from `questions` where `title` like '%$term%' or `body` like '%$term%' ";
            $runQuery = mysqli_query($conn, $query);
            if (mysqli_num_rows($runQuery) > 0) {
                $searchResult = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
        ?>
                <?php foreach ($searchResult as $result) { ?>
                    <div class="col-md-12 mt-4 p-3 result d-flex">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <div>
                                <div class="increment up">
                                    <svg aria-hidden="true" class="svg-icon iconArrowUpLg" width="30" height="36" viewBox="0 0 36 36">
                                        <path d="M2 26h32L18 10 2 26z"></path>
                                    </svg>
                                </div>
                                <h5 class="count text-center">0</h5>
                                <div class="increment down">
                                    <svg aria-hidden="true" class="svg-icon iconArrowDownLg" width="30" height="36" viewBox="0 0 36 36">
                                        <path d="M2 10h32L18 26 2 10z"></path>
                                    </svg>
                                </div>
                            </div>
                        <?php  } ?>
                        <div class="ml-4">
                            <h5><?php echo $result['title'] ?></h5>
                            <p><?php echo $result['body'] ?></p>

                            <a class="btn btn-info" href="show-question.php?id=<?php echo $result['id'] ?>">Show Details</a>
                        </div>
                    </div>
                <?php }
            } else {
                echo 'Not Found';
                ?>
                <a href="index.php" class="btn btn-primary">back</a>

        <?php
            }
        } else {
            http_response_code(404);
        }
        ?>
    </div>
</div>
<?php
require_once "inc/footer.php";
?>