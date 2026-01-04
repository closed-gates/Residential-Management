<!DOCTYPE html>
<html lang="en">
    <?php
    require_once("auth.php");
    require_once("Dbconnect.php");
    if (!isset($_POST['PIN'])) {
        die("Unauthorized access");
    }
    $_SESSION['PIN'] = $_POST['PIN'];
    $_SESSION['user_id']   = $_POST['nid']; 
    $sql = "select * from flat_plot_rent_selling where pin = ".$_SESSION['PIN']."";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    ?>
<?php include 'head.php'; ?>
<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <div class="stats-grid">
                <div class="card">
                    <h3>PIN</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php echo $row[0];?>
                    </p>
                </div>
                <div class="card">
                    <h3>Utilities</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php echo $row[1];?>
                    </p>
                </div>
                <div class="card">
                    <h3>Furnishing</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php echo $row[2];?>
                    </p>
                </div>
                <div class="card">
                    <h3>Price</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php if($row[4] == 'Sale'){
                            echo "".$row[3]." Tk";
                            }
                            else{
                                echo "".$row[3]." Tk/Month";
                            }
                    ?>
                    </p>
                </div>
            </div>
            <div class="leftcard">
            <?php
            if ($row[4] === 'Sale') $label = 'Buy';
            elseif ($row[4] === 'Rent') $label = 'Rent';
            elseif ($$row[4] === 'Sub-let') $label = 'Sub-let';
            echo '<form action="payment-page.php" method="POST">
                                    <input type="hidden" name="PIN" value="'.$_SESSION['PIN'].'">
                                    <input type="hidden" name="nid" value="'.$_SESSION['user_id'].'">
                                    <button class="btn-primary">'.$label.'</button>
                                </form>';
            ?>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>