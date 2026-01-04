<!DOCTYPE html>
<html lang="en">
    <?php 
     require_once('auth.php');
    ?>
<?php include 'head.php'; ?>
<body>
    <div class="container">
        <?php include 'head-nav.php'; ?>

        <main class="main-content">
            <header>
                <h1>Property Overview</h1>
                <form action="logout.php" class="form_design" method="POST">
                    <button type="submit" class="btn-primary">Logout</button>
                </form>
            </header>

            <div class="stats-grid">
                <div class="card">
                    <h3>Total Residents</h3>
                    <p class="stat-number">
                        <?php 
                            require_once('DBconnect.php');
                            $sql = "select count(*) as total_renters from renters where current_rent_status = 1";
                            $result = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?></p>
                </div>
                <div class="card">
                    <h3>Availabe Property</h3>
                    <p class="stat-number" style="color: #e67e22;">
                        <?php
                        require_once('DBconnect.php');
                        $sql = "select count(*) as t_count from flat_plot_rent_selling";
                        $result = mysqli_query($conn,$sql);
                        if ($result){
                            $row = mysqli_fetch_assoc($result);
                            echo $row['t_count'];}
                        ?>
                    </p>
                </div>
            </div>
            <section class="table-section">
                <h2>List of property</h2>
                <?php
                if (in_array($_SESSION['user_type'], ['admin', 'landlord'])) {
                    echo '
                    <div style="display:flex; justify-content:flex-end;">
                        <form action="add-property.php" class="form_design" method="POST">
                            <button type="submit" class="btn-primary">+Add property</button>
                        </form>
                    </div>
                    ';
                }
                ?>
                <table id="requestTable">
                    <thead>
                        <tr>
                            <th>PIN</th>
                            <th>Price/Rent</th>
                            <th>Furnishing</th>
                            <th>Utilities</th>
                            <th>Available for Sell/Rent/Sublet</th>
                            <th>Buy/Rent</th>
                        </tr>
                        <?php 
                            require_once('DBconnect.php');
                            $sql = "select * from flat_plot_rent_selling";
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result) != 0){
                                while($row = mysqli_fetch_array($result)){
                            
                        ?>
                        <tr>
                            <td><?php echo $row[0];?></td>
                            <td><?php echo $row[3];?></td>
                            <td><?php if ($row[2] == 1){
                                echo "Furnished";
                            }
                            else{
                                echo "Not Furnished";
                            }
                            ?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[4];?></td>
                            <td>
                            <?php
                            $user = $_SESSION['user_type'];
                            $propertyType = $row[4];
                            $allowed = false;
                            $label = "";
                            if ($user === 'admin') {
                                $allowed = true;
                            }
                            elseif ($user === 'landlord' && $propertyType === 'Sale') {
                                $allowed = true;
                            }
                            elseif ($user === 'renter' && in_array($propertyType, ['Rent', 'Sub-let'])) {
                                $allowed = true;
                            }
                            if ($propertyType === 'Sale') $label = 'Buy';
                            elseif ($propertyType === 'Rent') $label = 'Rent';
                            elseif ($propertyType === 'Sub-let') $label = 'Sub-let';
                            if ($allowed) {
                                echo '<form action="Buy-page.php" method="POST">
                                    <input type="hidden" name="PIN" value="'.$row[0].'">
                                    <input type="hidden" name="nid" value="'.$_SESSION['user_id'].'">
                                    <button class="btn-primary">' . $label . '</button>
                                </form>';
                            } else {
                                echo '<button class="btn-primary" disabled style="opacity:0.5; cursor:not-allowed;">
                                        Not Allowed
                                    </button>';
                            }
                            ?>
                            
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
</body>
</html>