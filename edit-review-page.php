<!DOCTYPE html>
<html lang="en">
<?php
require_once('DBconnect.php');
require_once('auth.php');
?>

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <form action="edit-review.php" class="form_design" method="POST">
                <?php
                $t = $_POST['t_id'];
                $sql = "select u.name,r.review_id from user_info u join review r on r.nid = u.nid where r.token_id = $t";
                $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                ?>
                Editing review of <?php echo $result['name'] ?><br> Review ID:<?php echo $result['review_id'] ?><br><br>
                Suggestion: <input type="text" name="sugg"> </br>
                Complaint: <input type="text" name="com"> </br>
                Feedback: <input type="text" name="feed"> </br>
                <br><br><br>
                <input type="hidden" name="t_id" value="<?php echo $t ?>">
                <button type="submit" class="btn-primary">Review</button>
            </form>
        </main>
</body>

</html>