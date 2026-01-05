<!DOCTYPE html>
<html lang="en">
<?php
require_once('DBconnect.php');
require_once('auth.php');

$n = $_SESSION['user_id'] ?? 0;
$tr = $_POST['tr'] ?? random_int(1000000, 99999999);
$bn = $_POST['business_no'] ?? 0;      // business services
$p = $_POST['pin'] ?? 0;      // flat rent/buy
$in = $_POST['in'] ?? 0;      // groceries
$pay = $_POST['pay'] ?? 'unknown';

?>
<?php include 'head.php'; ?>

<body>
    <div class="container">
        <?php include 'head-nav.php';
        ?>

        <main class="main-content">
            <div class="card">
                <?php
                $tax = 15;
                $tr = random_int(1000000, 99999999);
                echo "ID: $tr<br><br>";
                echo "Discount: None<br><br>";
                echo "Tax: 15%<br><br>";
                if (!empty($p) && $p != 0) {
                    $sql = "Select * from flat_plot_rent_selling where pin = $p";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $price = $row['price_rent'] + $row['price_rent'] * ($tax / 100);
                }
                if (!empty($bn) && $bn != 0) {
                    $sql = "Select * from services where business_no = $bn";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $price = $row['service_price'] + $row['service_price'] * ($tax / 100);
                }
                if (!empty($in)) {
                    $sql = "Select * from online_groceries where invoice_no = $in";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $price = ($row['price'] - ($row['price'] * $row['deal']) + ($row['price'] * ($tax / 100)));
                }
                echo "Amount to pay: " . $price . " Tk";
                ?>

            </div>
            <div class="card">
                <h3>Choose a Payment Method</h3>
                <form action="payments.php" class="form_design" method="POST">
                    <select name="pay" id="pay">
                        <option value="">--select--</option>
                        <option value="bkash">Bkash</option>
                        <option value="nagad">Nagad</option>
                        <option value="rocket">Rocket</option>
                        <option value="online_banking">online_banking</option>
                    </select>
                    <input type="hidden" name="nid" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" name="tr" value="<?php echo $tr ?>">
                    <input type="hidden" name="pin" value="<?php echo $_POST['pin'] ?? ''; ?>">
                    <input type="hidden" name="bn" value="<?php echo $_POST['business_no'] ?? ''; ?>">
                    <input type="hidden" name="in" value="<?php echo $_POST['in'] ?? ''; ?>">
                    <br><br>
                    <button type="submit" class="btn-primary">Pay</button>
                </form>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>