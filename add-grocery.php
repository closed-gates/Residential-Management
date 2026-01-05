<!DOCTYPE html>
<html lang="en">
<?php
require_once('auth.php')
    ?>
<?php include 'head.php'; ?>

<body>
    <?php include 'head-nav.php' ?>
    <main class="main-content">
        <header>
            <h1>Change</h1>
        </header>
        <form action="grocery.php" class="form_design" method="POST">
            Name: <input type="text" name="name" placeholder=""></br>
            Deal: <input type="number" name="deal" min="0" max="100"> </br>
            Price: <input type="number" name="p" required> </br>
            <input type="hidden" name="id" value="<?php echo random_int(100000, 999999) ?>">

            <button type="submit" class="btn-primary">Add grocery</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>