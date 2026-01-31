<!DOCTYPE html>
<html lang="en">
<?php
require_once('auth.php')
    ?>

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <?php include 'head-nav.php' ?>
    <main class="main-content">
        <header>
            <h1>Change Account details for <?php echo '' . $_SESSION['username'] . ''; ?></h1>
        </header>
        <form action="change.php" class="form_design" method="POST">
            NID: <input type="number" name="nid" placeholder="nid"> </br></br>
            Name: <input type="text" name="uname"></br>
            Date of Birth: <input type="date" name="dob"> </br>
            Street: <input type="text" name="street"> </br>
            City: <input type="text" name="city"> </br></br>
            District: <input type="text" name="district"> </br>


            <input type="submit" value="Confirm">
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>