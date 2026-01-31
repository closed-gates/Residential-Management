<!DOCTYPE html>
<html lang="en">
<?php
require_once('DBconnect.php');
require_once('auth.php'); // ensures user is logged in
?>

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <section class="table-section">
                <h2>My Payment History</h2>

                <?php
                $user_id = $_SESSION['user_id'];

                // Fetch all payments for this user
                $sql = "SELECT * FROM payment WHERE nid = ? ORDER BY transaction_id DESC";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo '<table id="requestTable">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Flat PIN</th>
                                    <th>Business No</th>
                                    <th>Invoice No</th>
                                    <th>Details / Receipt</th>
                                </tr>
                            </thead>
                            <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr stlye= 'overflow-wrap: break-word; word-break: break-word;'>
                                <td>{$row['transaction_id']}</td>
                                <td>" . ($row['pin'] ?: '-') . "</td>
                                <td>" . ($row['business_phn_no'] ?: '-') . "</td>
                                <td>" . ($row['invoice'] ?: '-') . "</td>
                                <td style=' max-width: 300px; white-space: normal; overflow-wrap: anywhere; word-break: break-word; '>{$row['receipt']}</td>
                              </tr>";
                    }
                    echo '</tbody></table>';
                } else {
                    echo "<p>No payment records found.</p>";
                }

                mysqli_stmt_close($stmt);
                ?>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>