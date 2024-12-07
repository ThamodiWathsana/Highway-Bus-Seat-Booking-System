<?php

@include 'config.php';

$lisenceid = $_GET['edit'];

if(isset($_POST['update_driver'])){

   $driverid = $_POST['Driver_Id'];
   $drivername = $_POST['Driver_Name'];
   $pwrd = $_POST['Password'];
   $address = $_POST['Address'];
   $contact = $_POST['ContactNo'];

   if(empty($lisenceid) || empty($driverid) || empty($drivername) || empty($pwrd) || empty($address) || empty($contact)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE driverdetails SET Driver_Address='$address', Driver_Id='$driverid', pwrd='$pwrd', DriverName='$drivername', ContactNo='$contact'  WHERE Lisence_Id = '$lisenceid'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         header('location:admin_driver.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM driverdetails WHERE Lisence_Id = '$lisenceid'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update Driver Details</h3>
      <input type="text" class="box" name="Driver_Id" value="<?php echo $row['Driver_Id']; ?>" placeholder="Enter the Driver ID">
      <input type="text" class="box" name="Driver_Name" value="<?php echo $row['DriverName']; ?>" placeholder="Enter the Driver name">
      <input type="password" class="box" name="Password" value="<?php echo $row['pwrd']; ?>" placeholder="Enter the Password">
      <input type="text" class="box" name="Address" value="<?php echo $row['Driver_Address']; ?>" placeholder="Enter the Address">
      <input type="text" class="box" name="ContactNo" value="<?php echo $row['ContactNo']; ?>" placeholder="Enter the Contact No">
      <input type="submit" value="update driver" name="update_driver" class="btn">
      <a href="admin_driver.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>