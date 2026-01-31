<!DOCTYPE html>
<html lang="en">
<?php
require_once("DBconnect.php");
require_once('auth.php');
$_SESSION['pin'] = $_POST['PIN'];
?>
<?php include 'head.php'; ?>

<body>
    <?php include 'head-nav.php'; ?>
    <main class="main-content">
        <header>
            <h1>Change Property for Property PIN: <?php echo '' . $_SESSION['pin'] . ''; ?></h1>
        </header>
        <form action="edit-property.php" class="form_design" method="POST">
            PIN: <input type="number" name="pin">
            Utilities: <input type="text" name="util">
            Furnished: <input type="checkbox" name="is_furnished">
            Price: <input type="number" step="0.01" name="price">
            <label for="flat_type">Select Renting Type:</label>
            <select id="flat_type" name="flat_type">
                <option value="">
                    Keep Same</option>
                <option value="Sale">Sale</option>
                <option value="Rent">Rent</option>
                <option value="Sub-Let">Sub-Let</option>
            </select><br><br>
            <input type="hidden" name="nid" value="<?php $_SESSION['user_id'] ?>">
            <input type="submit" value="Confirm">
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>