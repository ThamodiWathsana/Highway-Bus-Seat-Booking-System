<?php

@include 'config.php';

$busno = $_GET['edit'];

if(isset($_POST['update_bus'])){

   $facilities = $_POST['Facilities'];
   $noseats = $_POST['No_Of_Seats'];
   $schedules = $_POST['Schedules'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($facilities) || empty($noseats) || empty($schedules) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE bus SET Facilities='$facilities', No_Of_Seats='$noseats', Schedule='$schedules', image='$product_image' WHERE BusNo ='$busno'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:BusDetails.php');
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
      
      $select = mysqli_query($conn, "SELECT * FROM bus WHERE BusNo = '$busno'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update Driver Details</h3>
      <input type="text" class="box" name="Facilities" value="<?php echo $row['Facilities']; ?>" placeholder="Facilities">
      <input type="text" class="box" name="No_Of_Seats" value="<?php echo $row['No_Of_Seats']; ?>" placeholder="No Of Seats">
      <input type="text" class="box" name="Schedules" value="<?php echo $row['Schedule']; ?>" placeholder="Bus Schedules">
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="update bus" name="update_bus" class="btn">
      <a href="BusDetails.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>