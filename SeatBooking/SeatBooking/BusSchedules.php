<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bus Details</title>
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
       h1 {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #ccc;
            background-color: darkblue;
         }
    </style>
</head>
<body>
   <h1>Bus Schedules</h1>
<div class="container">
    <?php
    $conn = mysqli_connect("localhost:3306", "root", "", "seat_booking");
    $select = mysqli_query($conn, "SELECT * FROM bus");
    ?>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <th>Bus Image</th>
                <th>Bus No</th>
                <th>Facilities</th>
                <th>No Of Seats</th>
                <th>Schedules</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                <tr>
                    <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                    <td><?php echo $row['BusNo']; ?></td>
                    <td><?php echo $row['Facilities']; ?></td>
                    <td><?php echo $row['No_Of_Seats']; ?></td>
                    <td><?php echo $row['Schedule']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

   <h1>Find Your Routes</h1>
<div class="container">
   <?php
    $conn = mysqli_connect("localhost:3306", "root", "", "seat_booking");
    $select = mysqli_query($conn, "SELECT * FROM route");
    ?>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
            <tr>
                <th>Route ID</th>
                <th>Route Description</th>
                <th>Bus No</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                <tr>
                    <td><?php echo $row['Route_Id']; ?></td>
                    <td><?php echo $row['RouteDescription']; ?></td>
                    <td><?php echo $row['BusNo']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
 </div>
</body>
</html>
