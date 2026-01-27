<!DOCTYPE html>
<html lang="en">
<?php
require_once('auth.php')
    ?>
<head>
<?php include 'head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <form action="review.php" class="form_design" method="POST">
                Which Flat You Want To Review: <input type="number" name="pin" placeholder="pin" required> </br>
                Suggestion: <input type="text" name="sugg"> </br>
                Complaint: <input type="text" name="com"> </br>
                Feedback: <input type="text" name="feed"> </br>
                <br><br><br>
                <input type="hidden" name="nid" value="<?php echo $_SESSION['user_id'] ?>">
                <input type="hidden" name="token" value="<?php echo random_int(100000, 999999) ?>">
                <button type="submit" class="btn-primary">Review</button>
            </form>
        </main>
</body>

</html>