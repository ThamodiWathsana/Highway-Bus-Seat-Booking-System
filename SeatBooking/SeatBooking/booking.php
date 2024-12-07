<?php
require('config1.php');

session_start();
$USERID = 1;
$PRIVILEGE = 'user';

if(isset($_POST['close_booking'])){
    if(isset($_SESSION['BOOKING_ID'])) unset($_SESSION['BOOKING_ID']);
}

if(isset($_SESSION['BOOKING_ID']) && $_SESSION['BOOKING_ID']>0) {
    $BOOKING_ID = $_SESSION['BOOKING_ID'];
}
else {
    header('location:index.php');
    exit();
}

$sql = "SELECT * FROM `users` WHERE `id`='$USERID' ";
$result = $connection->query($sql);
$count = $result->num_rows;
if($count == 1){
    while($row = $result->fetch_assoc()) {
        $USER_NAME = $row['name'];
    }
}

if(isset($_POST['submit'])){
    if(isset($_POST['booking_date']) && !empty($_POST['booking_date'])){
        $_SESSION['BOOKING_DATE'] = $_POST['booking_date'];
    }
    else {
        $error = "Booking date is required !";
    }
}

if(isset($_POST['delete_seat'])){
    if(isset($_POST['booking_detail_id']) && $_POST['booking_detail_id']>0){
       $sql = "UPDATE `booking_details` SET status=0 WHERE id='".$_POST['booking_detail_id']."'";
        if($connection->query($sql) === TRUE) {
            $msg = "Delete success.";
        }
        else {
            $error = "Failed to create booking, Error: " . $sql . "<br>" . $connection->error;
        }
    }
    else {
        $error = "Failed to delete seat, No seat id found in the request !";
    }
}

if(isset($_SESSION['BOOKING_DATE']) && !empty($_SESSION['BOOKING_DATE'])){

    if(isset($_POST['select_seat'])){
        if(isset($_POST['seat_id']) && $_POST['seat_id']>0){
            $sql = "INSERT INTO `booking_details`(`booking_date`,`booking_id`, `seat_id`) VALUES ('".$_SESSION['BOOKING_DATE']."','$BOOKING_ID ','".$_POST['seat_id']."')";
            if($connection->query($sql) === TRUE) {
                $msg = "Booking success.";
            }
            else {
                $error = "Failed to create booking, Error: " . $sql . "<br>" . $connection->error;
            }
        }
        else {
            $error = "Seat id not found in the request ! !";
        }
    }
    //////////////////////////////////////////////////////////////////////////////

    $sql = "SELECT `seats`.*, `buses`.`bus_no` FROM `seats` JOIN `buses` ON `buses`.`id`=`seats`.`bus_id` WHERE `seats`.`status`=1 
    AND `seats`.`id` NOT IN (
        SELECT `booking_details`.seat_id FROM `booking_details` JOIN `bookings` ON 
        `bookings`.`id`=`booking_details`.`booking_id` WHERE `booking_details`.`booking_date`='".$_SESSION['BOOKING_DATE']."' AND `booking_details`.`status`=1
    )";
    $result = $connection->query($sql);
    $count = $result->num_rows;
    $available_seats = [];
    if($count > 0){
        while($row = $result->fetch_assoc()) {
            $available_seats[$row['bus_id']][] = $row;
        }
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
                <form method="post">
                    <button class="btn btn-warning" type="submit" name="close_booking">Close Booking</button>
                </form>
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
            <div class="col">
                <form method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Booking Date</label>
                                <input type="date" name="booking_date" class="form-control" value="<?php if(isset($_SESSION['BOOKING_DATE'])) echo $_SESSION['BOOKING_DATE'];?>" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button class="btn btn-info form-control" type="submit" name="submit">Check Availability</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col"><br/></div>
        </div>

        <?php if(isset($_SESSION['BOOKING_DATE'])){ ?>
        <div class="row">
            <div class="col">
                <h4>Available Seats for <?php echo $_SESSION['BOOKING_DATE'];?></h4>
                <hr/>
                <?php
                if(isset($available_seats) && is_array($available_seats) && count($available_seats)>0){
                    $bus_id = 0;
                    $i=1;
                    foreach($available_seats as $index => $buses){
                         foreach($buses as $index => $row){
                            if($bus_id!=$row['bus_id']) {
                                if($i>1) echo '<br/><br/>';
                                echo 'BUS NO: '.$row['bus_no']."<br/>";
                                echo '<form method="post" style="min-width:50px; float:left; margin:0px 2px;">
                                <button type="submit" name="select_seat" class="btn btn-xs btn-info">'.$row['seat_no'].'</button>
                                <input type="hidden" name="seat_id" value="'.$row['id'].'">
                                </form>';
                            }
                            else {
                                 echo '<form method="post" style="min-width:50px; float:left; margin:0px 2px;">
                                 <button type="submit" name="select_seat" class="btn btn-xs btn-info">'.$row['seat_no'].'</button>
                                 <input type="hidden" name="seat_id" value="'.$row['id'].'">
                                 </form>';
                            }
                            $bus_id = $row['bus_id'];
                            $i++;
                        }
                    }
                }
                ?>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col">
                <br/>
                <h4>Booking Details</h4>
            </div>
        </div> 
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Booked Date</th>
                            <th>Bus No.</th>
                            <th>Seat No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT bookings.id AS booking_id, booking_details.booking_date, booking_details.id, buses.bus_no, seats.seat_no 
                    FROM `booking_details` JOIN bookings ON bookings.id=booking_details.booking_id JOIN seats ON seats.id=booking_details.seat_id 
                    JOIN buses ON buses.id=seats.bus_id WHERE bookings.id='$BOOKING_ID' AND booking_details.status=1";
                    $result = $connection->query($sql);
                    $count = $result->num_rows;
                    if($count>0){
                        while($row = $result->fetch_assoc()) {
                           echo '<tr>
                                <td>'.$row['booking_id'].'</td>
                                <td>'.$row['booking_date'].'</td>
                                <td>'.$row['bus_no'].'</td>
                                <td>'.$row['seat_no'].'</td>
                                <td align="right">
                                <form method="post">
                                    <button class="btn btn-xs btn-danger" type="submit" name="delete_seat">Delete Seat</button>
                                    <input type="hidden" name="booking_detail_id" value="'.$row['id'].'" />
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

        <div class="row">
            <div class="col text-center">
                <form method="post" action="Payment.html"> <!-- Assuming payment_form.php is the URL of your payment form -->
                    <button class="btn btn-primary" type="submit" name="next">Next</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
  </body>
</html>
