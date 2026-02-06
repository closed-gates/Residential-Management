<!DOCTYPE html>
<html lang="en">
<?php
require_once('auth.php')
    ?>

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <section class="table-section">
                <h2>List of Available Services</h2>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                    <div style="margin-bottom: 15px;">
                        <a href="create-service-page.php" class="btn-primary">
                            + Create New Service
                        </a>
                    </div>
                <?php endif; ?>

                <table id="requestTable">
                    <thead>
                        <tr>
                            <th>Business Number</th>
                            <th>Service Name</th>
                            <th>Packages</th>
                            <th>Datetime</th>
                            <th>Service Price</th>
                            <th>Contact Info</th>
                            <th>Hire</th>
                        </tr>
                        <?php
                        require_once('DBconnect.php');
                        $sql = "select * from services";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) != 0) {
                            while ($row = mysqli_fetch_array($result)) {

                                ?>
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[4]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
                                    <td><?php echo $row[5]; ?></td>
                                    <td>
                                        <div style="display: flex; gap: 20px;">
                                            <form action="packages-page.php" method="POST">
                                                <input type="hidden" name="business_no" value="<?= $row[0]; ?>">
                                                <button type="submit" class="btn-primary">Hire</button>
                                            </form>
                                            <?php
                                            if ($_SESSION['user_type'] == "admin") {
                                                echo '<form action="edit-services-page.php" method="POST">
                                    <input type="hidden" name="business_no" value="' . $row[0] . '">
                                    <button class="btn-primary">' . "Edit" . '</button></form>';
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                    </thead>
                </table>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>

</html>