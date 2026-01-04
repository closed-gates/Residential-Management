<!DOCTYPE html>
<html lang="en">
    <?php 
     require_once('auth.php')
    ?>
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
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="Residents-page.php">Residents</a></li>
                <li><a href="Service-page.php">Maintenance</a></li>
                <li><a href="payment-history.php">Payments</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <section class="table-section">
                <h2>List of Resident</h2>
                <table id="requestTable">
                    <thead>
                        <tr>
                            <th>NID</th>
                            <th>Occupation</th>
                            <th>Student</th>
                            <th>Currently Renting</th>
                            <th>Rental History</th>
                        </tr>
                        <?php 
                            require_once('DBconnect.php');
                            $sql = "select * from renters";
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result) != 0){
                                while($row = mysqli_fetch_array($result)){
                            
                        ?>
                        <tr>
                            <td><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php if ($row[2] == 1){
                                echo "Student";
                            }
                            else{
                                echo "Not A Student";
                            }
                            ?></td>
                            <td><?php if ($row[3] == 1){
                                echo "Currently Renting";
                            }
                            else{
                                echo "Not Currently Renting";
                            }
                            ?></td>
                            <td><?php echo $row[4];?></td>
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