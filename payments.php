<?php
require_once('DBconnect.php');
require_once('session.php');

$n = $_POST['nid'] ?? 0;
$tr = $_POST['tr'] ?? random_int(1000000, 99999999);
$bn = $_POST['bn'] ?? 0;      // business services
$p = $_POST['pin'] ?? 0;      // flat rent/buy
$in = $_POST['in'] ?? 0;      // groceries
$pay = $_POST['pay'] ?? 'unknown';

if (!$n) {
    die("User not identified.");
}

// general online_payment record
$sql = "INSERT INTO online_payment (transaction_id, discount_voucher, tax) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
$discount = "None";
$tax = 15;
mysqli_stmt_bind_param($stmt, "ssi", $tr, $discount, $tax);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// function for payment table
function insertPayment($conn, $tr, $n, $p, $bn, $in, $desc)
{
    $sql = "INSERT INTO payment (transaction_id, nid, pin, business_phn_no, invoice, receipt) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiiiis", $tr, $n, $p, $bn, $in, $desc);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Services 
if (!empty($bn) && $bn != 0) {
    $sql = "SELECT * FROM services WHERE business_no = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $bn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $service = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($service) {
        $price = $property['service_price'] + $property['service_price'] * ($tax / 100);
        $desc = $_SESSION['username'] . " requested maintenance service from business " . $bn . " Price: " . $price . " Paid Through: $pay";
        insertPayment($conn, $tr, $n, $price, $bn, 0, $desc);
    }

    header("Location: Service-page.php");
    exit();
}

// Flats
if (!empty($p) && $p != 0) {
    $sql = "SELECT * FROM flat_plot_rent_selling WHERE pin = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $p);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $property = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($property) {
        $price = $property['price_rent'] + $property['price_rent'] * ($tax / 100);
        $type = $property['renting_type'] ?? '';

        if ($type === "Rent" || $type === "Sub-let") {
            $sql_check = "SELECT * FROM can_occupy WHERE pin = ? AND nid = ?";
            $stmt = mysqli_prepare($conn, $sql_check);
            mysqli_stmt_bind_param($stmt, "ii", $p, $n);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $already_rented = mysqli_num_rows($res) > 0;
            mysqli_stmt_close($stmt);
            $sql_occupants = "SELECT no_of_occupants FROM can_occupy WHERE pin = ?";
            $stmt = mysqli_prepare($conn, $sql_occupants);
            mysqli_stmt_bind_param($stmt, "i", $p);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $occupants = mysqli_fetch_assoc($res);
            mysqli_stmt_close($stmt);

            $num_occupants = $occupants['no_of_occupants'] ?? 0;

            if ($already_rented) {
                die("You have already rented this flat.");
            } elseif ($num_occupants >= 4) {
                die("Flat is full. Cannot rent.");
            } else {
                $desc = $_SESSION['username'] . " rented the flat $p Price: $price Paid Through: $pay";
                insertPayment($conn, $tr, $n, $p, 0, 0, $desc);

                $sql_update = "UPDATE renters SET current_rent_status = 1 WHERE nid = ?";
                $stmt = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt, "i", $n);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if ($num_occupants > 0) {
                    $sql_update_occupants = "UPDATE can_occupy SET no_of_occupants = no_of_occupants + 1 WHERE pin = ?";
                    $stmt = mysqli_prepare($conn, $sql_update_occupants);
                    mysqli_stmt_bind_param($stmt, "i", $p);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    $sql_insert_occupants = "INSERT INTO can_occupy (nid, pin, no_of_occupants) VALUES (?, ?, 1)";
                    $stmt = mysqli_prepare($conn, $sql_insert_occupants);
                    mysqli_stmt_bind_param($stmt, "ii", $n, $p);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            }
        } elseif ($type === "Sale") {
            $sql_check_own = "SELECT * FROM owns WHERE pin = ? AND nid = ?";
            $stmt = mysqli_prepare($conn, $sql_check_own);
            mysqli_stmt_bind_param($stmt, "ii", $p, $n);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $already_owns = mysqli_num_rows($res) > 0;
            mysqli_stmt_close($stmt);

            $sql_check_other = "SELECT * FROM owns WHERE pin = ?";
            $stmt = mysqli_prepare($conn, $sql_check_other);
            mysqli_stmt_bind_param($stmt, "i", $p);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $other_owner = mysqli_fetch_assoc($res);
            mysqli_stmt_close($stmt);

            if ($already_owns) {
                die("You already own this flat.");
            } elseif ($other_owner) {
                die("Flat is already sold to another user.");
            } else {
                $desc = $_SESSION['username'] . " bought the flat $p Price: $price Paid Through: $pay";
                insertPayment($conn, $tr, $n, $p, 0, 0, $desc);

                $sql_own = "INSERT INTO owns (nid, pin) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql_own);
                mysqli_stmt_bind_param($stmt, "ii", $n, $p);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }

        header("Location: Home-page.php");
        exit();
    }
}

//  Groceries 
if (!empty($in)) {
    $sql = "SELECT * FROM online_groceries WHERE invoice_no = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $in);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $groceries = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($groceries) {
        $price = ($groceries['price'] - ($groceries['price'] * $groceries['deals']) + ($groceries['price'] * ($tax / 100)));
        $desc = $_SESSION['username'] . " bought groceries " . $groceries['inventory_list'] . " Price: $price Paid Through: $pay";
        insertPayment($conn, $tr, $n, $price, 0, $in, $desc);
    }

    header("Location: grocery-page.php");
    exit();
}
?>