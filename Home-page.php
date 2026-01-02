<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResiCare | Management Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo"><a href = "Home-page.php">ResiCare</a></div>
            <ul>
                <?php

                ?>
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="#">Residents</a></li>
                <li><a href="#">Maintenance</a></li>
                <li><a href="#">Payments</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <header>
                <h1>Property Overview</h1>
                <button id="addResidentBtn" class="btn-primary">+ Add Resident</button>
            </header>

            <div class="stats-grid">
                <div class="card">
                    <h3>Total Residents</h3>
                    <p class="stat-number">
                        <?php 
                            require_once('DBconnect.php');
                            $sql = "select count(*) as total_renters from renters";
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
                <h2>List of Property</h2>
                <table id="requestTable">
                    <thead>
                        <tr>
                            <th>PIN</th>
                            <th>Price/Rent</th>
                            <th>Furnishing</th>
                            <th>Utilities</th>
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
                            <td><a href = "Buy-page.php"><button><?php if ($row[4] == "Rent"){
                                echo "Rent";
                            }
                            else if($row[4] == "Sale") {
                                echo "Buy";
                            }
                            else{
                                echo "Sub-let";
                            }
                            ?></button></a></td>
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