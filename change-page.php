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
        <form action="change.php" class="form_design" method="POST">
            NID: <input type="number" name="nid" placeholder="nid" required> </br></br>
            Name: <input type="text" name="uname" required></br>
            Date of Birth: <input type="date" name="dob"> </br>
            Street: <input type="text" name="street"> </br>
            City: <input type="text" name="city"> </br></br>
            District: <input type="text" name="district"> </br>
            Membership Referer: <input type="number" name="mem"> </br></br>

            <input type="submit" value="Confirm">
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>