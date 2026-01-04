<!DOCTYPE html>
<html lang="en">
    <?php 
     require_once("auth.php");
     require_once("Dbconnect.php");
     $sql  = "select * from user_info";
     $row = mysqli_fetch_array(mysqli_query($conn,$sql));
    ?>
<?php include 'head.php'; ?>
<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>
    <main class="main-content">
        <div style="display:flex; justify-content:flex-end;">
            <form action="change-page.php" class="form_design" method="POST">
                    <button type="submit" class="btn-primary">Change Account Details</button>
            </form>
        </div>
            <div class="card">
                <h3>NID</h3>
                <p class="stat-number">
                    <?php echo $_SESSION['user_id'];?>
                </p>
            </div>
            <div class="card">
                <h3>UserName</h3>
                <p class="stat-number" >
                    <?php echo $_SESSION['username']?>
                </p>
            </div>
            <div class="card">
                <h3>Date of Birth</h3>
                <p class="stat-number" >
                    <?php echo $row[2]?>
                </p>
            </div>
            <div class="card">
                <h3>Street</h3>
                <p class="stat-number" >
                    <?php echo $row[3];
                ?>
                </p>
            </div>
            <div class="card">
                <h3>City</h3>
                <p class="stat-number" >
                    <?php echo $row[4];?>
                </p>
            </div>
            <div class="card">
                <h3>District</h3>
                <p class="stat-number" >
                    <?php echo $row[5];?>
                </p>
            </div>
            <div class="card">
                <h3>Has A Membership</h3>
                <p class="stat-number" >
                    <?php echo $row[6];?>
                </p>
            </div>
            <div class="card">
                <h3>Membership Referer</h3>
                <p class="stat-number" >
                    <?php echo $row[7];?>
                </p>
            </div>

    </main>
</body>
</html>