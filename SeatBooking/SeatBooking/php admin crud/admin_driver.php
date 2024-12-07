<?php

@include 'config.php';

if(isset($_POST['btnSubmit'])){ // changed from 'add_driver' to 'btnSubmit'

   $lisenceid = $_POST['Lisence_Id'];
   $driverid = $_POST['Driver_Id'];
   $drivername = $_POST['Driver_Name'];
   $pwrd = $_POST['Password'];
   $address = $_POST['Address'];
   $contact = $_POST['ContactNo'];

   if(empty($lisenceid) || empty($driverid) || empty($drivername) || empty($pwrd) || empty($address) || empty($contact)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO driverdetails(Lisence_Id,Driver_Address,Driver_Id,pwrd,DriverName,ContactNo) VALUES('$lisenceid', '$address', '$driverid', '$pwrd', '$drivername', '$contact')"; // changed table name from diverdetails to driverdetails
      $upload = mysqli_query($conn,$insert);
      if($upload){
         $message[] = 'new driver added successfully';
      }else{
         $message[] = 'could not add the driver';
      }
   }

};

if(isset($_GET['delete'])){
   $lisenceid = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM driverdetails WHERE Lisence_Id = '$lisenceid'"); // added single quotes for proper escaping
   header('location:admin_driver.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Driver Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $msg){ // changed variable name from message to msg to avoid conflict
      echo '<span class="message">'.$msg.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> <!-- added echo before $_SERVER['PHP_SELF'] -->
         <h3>Add a Driver</h3>
         <input type="text" placeholder="Lisence ID" name="Lisence_Id" class="box">
         <input type="text" placeholder="Driver ID" name="Driver_Id" class="box">
         <input type="text" placeholder="Driver Name" name="Driver_Name" class="box">
         <input type="password" placeholder="Password" name="Password" class="box">
         <input type="text" placeholder="Address" name="Address" class="box">
         <input type="text" placeholder="Contact No" name="ContactNo" class="box">
         <input type="submit" class="btn" name="btnSubmit" value="Add Driver">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM driverdetails");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Lisence ID</th>
            <th>Driver ID</th>
            <th>Driver Name</th>
            <th>Password</th>
            <th>Address</th>
            <th>Contact No</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['Lisence_Id']; ?></td>
            <td><?php echo $row['Driver_Id']; ?></td>
            <td><?php echo $row['DriverName']; ?></td>
            <td><?php echo $row['pwrd']; ?></td>
            <td><?php echo $row['Driver_Address']; ?></td>
            <td><?php echo $row['ContactNo']; ?></td> <!-- removed $ sign and slash -->
            <td>
               <a href="admin_driver_update.php?edit=<?php echo $row['Lisence_Id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_driver.php?delete=<?php echo $row['Lisence_Id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>
