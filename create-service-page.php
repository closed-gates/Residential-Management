<?php
require_once('auth.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: Home-page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>

    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <section class="form-section">
                <h2>Create New Service</h2>

                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color:red"><?= $_SESSION['error'];
                    unset($_SESSION['error']); ?></p>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <p style="color:green"><?= $_SESSION['success'];
                    unset($_SESSION['success']); ?></p>
                <?php endif; ?>

                <form action="create-service.php" method="POST">
                    <label>Business Number</label>
                    <input type="text" name="business_no" required>

                    <label>Service Name</label>
                    <input type="text" name="service_name" required>

                    <label>Packages</label>
                    <input type="text" name="packages" required>

                    <label>Date & Time</label>
                    <input type="datetime-local" name="service_datetime" required>

                    <label>Service Price</label>
                    <input type="number" name="price" required>

                    <label>Contact Info</label>
                    <input type="text" name="contact_info" required>

                    <button type="submit" class="btn-primary">Create Service</button>
                </form>
            </section>
        </main>
    </div>

</body>

</html>