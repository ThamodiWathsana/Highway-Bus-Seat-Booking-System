<?php

@include 'config.php';

if(isset($_POST['btnSubmit'])){ // changed from 'add_driver' to 'btnSubmit'

   $busno = $_POST['Bus_No'];
   $facilities = $_POST['Facilities'];
   $noseats = $_POST['No_Of_Seats'];
   $schedules = $_POST['Schedules'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;


   if(empty($busno) || empty($facilities) || empty($noseats) || empty($schedules) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO bus(BusNo,Facilities,No_Of_Seats,Schedule,image) VALUES('$busno', '$facilities', '$noseats', '$schedules', '$product_image')"; 
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'Bus details added successfully';
      }else{
         $message[] = 'could not add the bus details';
      }
   }

};

if(isset($_GET['delete'])){
   $busno = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM bus WHERE BusNo = '$busno'"); // added single quotes for proper escaping
   header('location:BusDetails.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Bus Details</title>

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
         <h3>Add Bus Details & Schedules</h3>
         <input type="text" placeholder="Bus No" name="Bus_No" class="box">
         <input type="text" placeholder="Facilities" name="Facilities" class="box">
         <input type="text" placeholder="No Of Seats" name="No_Of_Seats" class="box">
         <input type="text" placeholder="Schedules" name="Schedules" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="btnSubmit" value="Add Bus Details & Shedules">
      </form>

   </div>

   <?php

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
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['BusNo']; ?></td>
            <td><?php echo $row['Facilities']; ?></td>
            <td><?php echo $row['No_Of_Seats']; ?></td>
            <td><?php echo $row['Schedule']; ?></td> <!-- removed $ sign and slash -->
            <td>
               <a href="UpdateBus.php?edit=<?php echo $row['BusNo']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="BusDetails.php?delete=<?php echo $row['BusNo']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>
