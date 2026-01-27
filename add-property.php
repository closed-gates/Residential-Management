<!DOCTYPE html>
<html lang="en">
<?php
require_once('auth.php')
    ?>

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <main class="main-content">
        <header>
            <h1>Adding property</h1>
        </header>
        <form action="property.php" class="form_design" method="POST">
            <?php
            if ($_SESSION['user_type'] == "admin") {
                echo "Landlord NID: <input type='number' name='nid' placeholder='NID' required></br>";
            }
            ?>
            PIN: <input type="number" name="pin" placeholder="PIN" required> </br>
            Utilities: <input type="text" name="util" placeholder="Wi-fi,Fridge etc..."></br>
            Furnished: <input type="checkbox" name="is_furnished"> </br>
            Price/Rent: <input type="number" name="price" placeholder="0000" required> </br></br>
            <label for="flat_type">Select Renting Type:</label>
            <select id="flat_type" name="flat_type" required>
                <option value="">-- Select --</option>
                <option value="Sale">Sale</option>
                <option value="Rent">Rent</option>
                <option value="Sub-Let">Sub-Let</option>
            </select><br><br>

            <button type="submit" class="btn-primary">Add property</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>