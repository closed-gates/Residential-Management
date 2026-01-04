<?php
require_once("auth.php");
require_once("Dbconnect.php");

if (!isset($_POST['PIN'])) {
    die("Unauthorized access");
}

$_SESSION['pin'] = $_POST['PIN'];
$_SESSION['user_id'] = $_POST['nid'];

$pin = $_SESSION['pin'];
$user_id = $_SESSION['user_id'];

// Fetch flat details
$sql = "SELECT * FROM flat_plot_rent_selling WHERE pin = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $pin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    die("Flat not found.");
}

// Determine the action label
$label = '';
$can_proceed = true;
$message = '';

if ($row['renting_type'] === 'Sale') {
    $label = 'Buy';
    // Check if the user already owns it
    $sql = "SELECT * FROM owns WHERE nid = ? AND pin = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $pin);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($res) > 0) {
        $can_proceed = false;
        $message = "You already own this flat";
    }
    mysqli_stmt_close($stmt);

    // Check if someone else owns it
    $sql = "SELECT * FROM owns WHERE pin = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $pin);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($res) > 0) {
        $row_owned = mysqli_fetch_assoc($res);
        if ($row_owned['nid'] != $user_id) {
            $can_proceed = false;
            $message = "Flat already sold";
        }
    }
    mysqli_stmt_close($stmt);

} elseif ($row['renting_type'] === 'Rent' || $row['renting_type'] === 'Sub-let') {
    $label = $row['renting_type'];

    // Check max occupants
    $sql_occupants = "SELECT no_of_occupants FROM can_occupy WHERE pin = ?";
    $stmt = mysqli_prepare($conn, $sql_occupants);
    mysqli_stmt_bind_param($stmt, "i", $pin);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && mysqli_num_rows($res) > 0) {
        $occupants = mysqli_fetch_assoc($res);
        if ($occupants['no_of_occupants'] >= 4) {
            $can_proceed = false;
            $message = "Flat is full";
        }
    }
    mysqli_stmt_close($stmt);

    // Check if user already rented
    $sql_user_rented = "SELECT * FROM can_occupy WHERE pin = ? AND nid = ?";
    $stmt = mysqli_prepare($conn, $sql_user_rented);
    mysqli_stmt_bind_param($stmt, "ii", $pin, $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && mysqli_num_rows($res) > 0) {
        $can_proceed = false;
        $message = "You have already rented this flat";
    }
    mysqli_stmt_close($stmt);

} else {
    $label = 'N/A';
    $can_proceed = false;
    $message = "Action not available";
}

if ($can_proceed && $message === '') {
    $message = $label;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <div class="stats-grid">
                <div class="card">
                    <h3>PIN</h3>
                    <p class="stat-number" style="color: #e67e22;"><?php echo $row['pin']; ?></p>
                </div>
                <div class="card">
                    <h3>Utilities</h3>
                    <p class="stat-number" style="color: #e67e22;"><?php echo $row['utilities']; ?></p>
                </div>
                <div class="card">
                    <h3>Furnishing</h3>
                    <p class="stat-number" style="color: #e67e22;"><?php echo $row['is_furnished']; ?></p>
                </div>
                <div class="card">
                    <h3>Price</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php
                        if ($row['renting_type'] == 'Sale')
                            echo $row['price_rent'] . " Tk";
                        else
                            echo $row['price_rent'] . " Tk/Month";
                        ?>
                    </p>
                </div>
            </div>

            <div class="leftcard">
                <?php if ($can_proceed): ?>
                    <form action="payment-page.php" method="POST">
                        <input type="hidden" name="pin" value="<?php echo $pin; ?>">
                        <input type="hidden" name="nid" value="<?php echo $user_id; ?>">
                        <button class="btn-primary"><?php echo $message; ?></button>
                    </form>
                <?php else: ?>
                    <button class="btn-primary" disabled style="opacity:0.5; cursor:not-allowed;">
                        <?php echo $message; ?>
                    </button>
                <?php endif; ?>
            </div>
            <div class="stats-grid">
                <?php
                $pin = $_SESSION['pin'];

                $sql = "
                    SELECT 
                        u.name,
                        cs.suggestion,
                        cs.complain,
                        cs.feedback
                    FROM review r
                    JOIN complaint_suggestion cs 
                        ON r.token_id = cs.token_id
                    JOIN user_info u
                        ON r.nid = u.nid
                    WHERE r.pin = ?
                ";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $pin);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No reviews available for this flat.</p>";
                } else {
                    while ($review = mysqli_fetch_assoc($result)) {
                        echo '
                            <div class="card">
                                <h4>Reviewed by: ' . htmlspecialchars($review['name']) . '</h4>
                                <p><strong>Suggestion:</strong> ' . htmlspecialchars($review['suggestion']) . '</p>
                                <p><strong>Complaint:</strong> ' . htmlspecialchars($review['complain']) . '</p>
                                <p><strong>Feedback:</strong> ' . htmlspecialchars($review['feedback']) . '</p>
                            </div>
                        ';
                    }
                }

                mysqli_stmt_close($stmt);
                ?>
            </div>



        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>