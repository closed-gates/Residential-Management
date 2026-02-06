<!DOCTYPE html>
<html lang="en">
<?php
require_once("DBconnect.php");
require_once('auth.php');
$_SESSION['business_no'] = $_POST['business_no'];
?>
<?php include 'head.php'; ?>

<body>
    <?php include 'head-nav.php'; ?>
    <main class="main-content">
        <header>
            <h1>Change Service for: <?php
            $sql = "select service_name from services where business_no = '" . $_SESSION['business_no'] . "'";
            $service_name = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            echo $service_name['service_name']; ?> , Pin:<?php echo $_SESSION['business_no']; ?> </h1>
        </header>
        <div style="max-width:100%;">
            <form action="edit-services.php" method="POST" style="
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
          ">

                <span>
                    Business No:<br>
                    <input type="number" name="business_no" style="min-width:200px; flex:1 1 220px;">
                </span>

                <span>
                    Datetime:<br>
                    <input type="datetime-local" name="date" style="min-width:200px; flex:1 1 220px;">
                </span>

                <span>
                    Packages:<br>
                    <input type="text" name="packages" style="min-width:200px; flex:1 1 220px;">
                </span>

                <span>
                    Price:<br>
                    <input type="number" step="0.01" name="price" style="min-width:200px; flex:1 1 220px;">
                </span>

                <span>
                    Service Name:<br>
                    <input type="text" name="name" style="min-width:200px; flex:1 1 220px;">
                </span>

                <span>
                    Contact No:<br>
                    <input type="number" name="contact_no" style="min-width:200px; flex:1 1 220px;">
                </span>

                <input type="hidden" name="business_no" value="<?php echo $_SESSION['business_no']; ?>">

                <div style="flex:1 1 100%;">
                    <input type="submit" value="Confirm">
                </div>

            </form>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>