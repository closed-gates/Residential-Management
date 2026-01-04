<!DOCTYPE html>
<html lang="en">
<?php
    require_once("auth.php");

    if (!isset($_POST['business_no'])) {
        die("Unauthorized access");
    }

    $_SESSION['business_no'] = $_POST['business_no'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResiCare | Management Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo"><a href = "Home-page.php">ResiCare</a></div>
            <ul>
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="Residents-page.php">Residents</a></li>
                <li><a href="Service-page.php">Maintenance</a></li>
                <li><a href="payment-history.php">Payments</a></li>
                <li><a href="review-page.php">Review</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <section class="table-section">
                <h2>Packages</h2>
                <select name="package" id="package" required>
                    <option value="">--Select--</option>
                    <?php
                    require_once("DBconnect.php");
                    require_once("auth.php");
                    $sql = "SELECT packages FROM services WHERE business_no = '" . $_SESSION['business_no'] . "'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $string = $row['packages'];
                    $array = explode(',',$string);
                    ?>
                    
                        <?php
                        foreach ($array as $a) {
                            echo "<option value='$a'>$a</option>";
                        }
                        ?>
                </select><br><br>
                <form action="payment-page.php" method="POST">
                    <input type="hidden" name="business_no" value="<?= $row[0]; ?>">
                    <button type="submit">Hire</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>