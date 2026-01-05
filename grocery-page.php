<!DOCTYPE html>
<html lang="en">
<?php
require_once('DBconnect.php');
require_once('auth.php');
?>
<?php include 'head.php'; ?>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <section class="table-section">
                <h2>List of Grocery</h2>

                <?php
                $user = $_SESSION['user_type'];
                $allowed = ($user === 'admin');

                if ($allowed) {
                    echo '<form action="add-grocery.php" method="POST">
                            <button class="btn-primary">Add item</button>
                        </form><br>';
                } else {
                    echo '<button class="btn-primary" disabled style="opacity:0.5; cursor:not-allowed;">
                            Not Allowed
                        </button><br>';
                }
                ?>

                <table id="requestTable">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Deals</th>
                            <th>Inventory List</th>
                            <th>Price (Tk)</th>
                            <th>Contact Info</th>
                            <th>Buy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM online_groceries";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$row['invoice_no']}</td>
                                    <td>{$row['deals']}%</td>
                                    <td>{$row['inventory_list']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['contact_info']}</td>
                                    <td>
                                        <form action='payment-page.php' method='POST'>
                                            <input type='hidden' name='in' value='{$row['invoice_no']}'>
                                            <button type='submit' class='btn-primary'>Buy</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No grocery items available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>