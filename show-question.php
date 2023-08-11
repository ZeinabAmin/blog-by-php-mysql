<?php
session_start();
require_once "inc/dbConnection.php";
require_once "inc/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `questions` JOIN `users` ON users.id = questions.user_id WHERE questions.id = $id";
    $runQuery = mysqli_query($conn, $query);
    if ($runQuery && mysqli_num_rows($runQuery) > 0) {
        $result = mysqli_fetch_assoc($runQuery);
?>

        <div class="container my-5">
            <div class="row">
                <div class="col-md-12 result p-3">
                    <h5>Question: <?php echo $result['title'] ?></h5>
                    <p><?php echo $result['body'] ?></p>
                    <p class="mb-3">
                        <?php
                        $queryA = "SELECT answers.*, users.userName FROM `answers` JOIN `users` ON users.id = answers.user_id WHERE answers.question_id = $id";
                        $runQueryA = mysqli_query($conn, $queryA);
                        $resAnswer = mysqli_fetch_all($runQueryA, MYSQLI_ASSOC);

                        echo "Answers:<br> ";

                        foreach ($resAnswer as $ans) {
                            echo "- " . $ans['body'] . "<br>";
                            echo    "<p>User Name: " . $ans['userName'] . "</p>";

                            if (isset($_SESSION['id']) && $_SESSION['id'] == $ans['user_id']) { ?>
                                <a class="btn btn-primary" href="edit-answer.php?id=<?php echo $ans['id'] ?> ">edit</a>
                                <a class="btn btn-primary" href="handlers/handle-delete-answer.php?id=<?php echo $ans['id'] ?> ">delete</a>

                        <?php
                                echo "<br>";
                            }
                        }
                        ?>
                    </p>
                    <a href="add-question.php" class="btn btn-primary">back</a>
                </div>
            </div>
        </div>

    <?php
    } else {
        echo "Question not found.";
    ?>
        <a href="index.php" class="btn btn-primary">back</a>
    <?php
    }
} else {
    echo "Invalid question ID.";
    ?>
    <a href="index.php" class="btn btn-primary">back</a>
<?php
}
?>
<?php
require_once "inc/footer.php";
?>