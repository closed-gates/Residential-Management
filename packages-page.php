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
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <section class="table-section">
                <h2>Packages</h2>
                <select name="package" id="package" required>
                    <option value="">--Select--</option>
                    <?php
                    require_once("DBconnect.php");
                    require_once("auth.php");
                    $sql = "SELECT packages FROM services WHERE business_no = '" . $_SESSION['business_no'] . "'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $string = $row['packages'];
                    $array = explode(',', $string);
                    ?>

                    <?php
                    foreach ($array as $a) {
                        echo "<option value='$a'>$a</option>";
                    }
                    ?>
                </select><br><br>
                <form action="payment-page.php" method="POST">
                    <input type="hidden" name="business_no" value="<?= $_SESSION['business_no']; ?>">
                    <input type="hidden" name="package" id="selected_package">
                    <button type="submit" class="btn-primary" onclick="setPackage()">Hire</button>
                </form>

                <script>
                    function setPackage() {
                        var pkg = document.getElementById('package').value;
                        document.getElementById('selected_package').value = pkg;
                    }
                </script>
            </section>
        </main>
    </div>
</body>

</html>