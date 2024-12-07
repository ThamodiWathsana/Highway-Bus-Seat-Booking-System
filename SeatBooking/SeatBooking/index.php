<?php
require('config1.php');

session_start();
$USERID = 1;
$PRIVILEGE = 'user';


$sql = "SELECT * FROM `users` WHERE `id`='$USERID' ";
$result = $connection->query($sql);
$count = $result->num_rows;
if($count == 1){
    while($row = $result->fetch_assoc()) {
        $USER_NAME = $row['name'];
    }
}

if(isset($_POST['create_new_booking'])){
    $sql = "INSERT INTO `bookings`(`user_id`) VALUES ('$USERID')";

    if($connection->query($sql) === TRUE) {
        $_SESSION['BOOKING_ID'] = $connection -> insert_id;
        header('location:booking.php');
    }
    else {
        $error = "Failed to create booking, Error: " . $sql . "<br>" . $connection->error;
    }
}

if(isset($_POST['open_booking'])){
    if(isset($_POST['booking_id']) && $_POST['booking_id']>0){
        $_SESSION['BOOKING_ID'] = $_POST['booking_id'];
        header('location:booking.php');
    }
    else {
        $error = "Failed to open booking, No booking id found in the request !";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Bus Booking System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
          </ul>
        </div>
        <div class="text-end">
            <a href="#" class="btn btn-warning">Logout (<?php if(isset($USER_NAME)) echo $USER_NAME;?>)</a>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Bus Seat Booking System</h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <?php 
                if(isset($error) && !empty($error)) {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }

                if(isset($msg) && !empty($msg)) {
                    echo '<div class="alert alert-success">'.$msg.'</div>';
                }
                ?>                
            </div>
        </div>
        <div class="row">
            <div class="col text-end">
                <form method="post">
                <button class="btn btn-xs btn-info" type="submit" name="create_new_booking">Place A Booking</button>
                </form>
            </div>
        </div>    

        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Booked Date</th>
                            <th>No. of Seats</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT bookings.id AS booking_id, booking_details.booking_date, COUNT(booking_details.seat_id) AS `no_of_seats` FROM bookings 
                    LEFT JOIN booking_details ON booking_details.booking_id=bookings.id WHERE bookings.user_id='$USERID' AND booking_details.status=1 GROUP BY bookings.id, booking_details.booking_date";
                    $result = $connection->query($sql);
                    $count = $result->num_rows;
                    if($count>0){
                        while($row = $result->fetch_assoc()) {
                           echo '<tr>
                                <td>'.$row['booking_id'].'</td>
                                <td>'.$row['booking_date'].'</td>
                                <td>'.$row['no_of_seats'].'</td>
                                <td align="right">
                                <form method="post">
                                    <button class="btn btn-xs btn-info" name="open_booking">Open</button>
                                    <input type="hidden" name="booking_id" value="'.$row['booking_id'].'" />
                                </form>
                                </td>
                            </tr>';
                        }
                    }
                    else {
                        echo '<tr>
                            <td colspan="5">No booking details found !</td>
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
