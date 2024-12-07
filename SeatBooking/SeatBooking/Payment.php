<?php

$con=mysqli_connect("localhost:3306","root","","seat_booking");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$noc=mysqli_real_escape_string($con, $_POST["txtNOC"]);
$cn=mysqli_real_escape_string($con, $_POST["txtCN"]);
$expiry=mysqli_real_escape_string($con, $_POST["txtExpiry"]);
$cvv=mysqli_real_escape_string($con, $_POST["txtCVV"]);
$amount=mysqli_real_escape_string($con, $_POST["txtAmount"]);
$bookingid=mysqli_real_escape_string($con, $_POST["txtBooking"]);
$paydate=mysqli_real_escape_string($con, $_POST["txtPayDate"]);

$sql = "INSERT INTO payment(PayDate,Amount,Booking_Id,NameOnCard,CardNumber,Expiry,CVV) VALUES('$paydate','$amount','$bookingid','$noc','$cn','$expiry','$cvv')";

if ($con->query($sql) === TRUE) {
    echo "<script>alert('Payment successful!')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
    

$con->close();

?>