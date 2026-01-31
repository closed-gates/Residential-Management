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
            <h1>Change Account details</h1>
        </header>
        <form action="change.php" class="form_design" method="POST">
            Changing for (NID): <input type="number" name="oldnid" placeholder="nid" required> </br></br>
            NID: <input type="number" name="nid" placeholder="nid" required> </br>
            Name: <input type="text" name="uname"></br>
            Date of Birth: <input type="date" name="dob"> </br>
            Street: <input type="text" name="street"> </br>
            City: <input type="text" name="city"> </br></br>
            District: <input type="text" name="district"> </br>
            Change Membership:
            <input type="checkbox" name="mem" id="mem"> <br>

            <div id="memRef" style="display:none;">
                Membership Referer:
                <input type="number" name="memnum">
            </div>
            <br>
            <script>
                document.getElementById("mem").addEventListener("change", function () {
                    document.getElementById("memRef").style.display = this.checked ? "block" : "none";
                });
            </script>

            <input type="submit" value="Confirm">
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>