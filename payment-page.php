<!DOCTYPE html>
<html lang="en">
<?php
require_once('DBconnect.php');
require_once('auth.php');
?>
<?php include 'head.php'; ?>

<body>
    <div class="container">
        <?php include 'head-nav.php';
        ?>

        <main class="main-content">
            <div class="card">
                <?php
                $tr = random_int(1000000, 99999999);
                echo "ID: $tr<br><br>";
                echo "Discount: None<br><br>";
                echo "Tax: 15%<br><br>";
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