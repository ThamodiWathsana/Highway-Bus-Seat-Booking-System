<?php
// Replace with your actual database connection details
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "seat_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    // Retrieve form data
    $username = $_POST["txtUserName"];
    $currentPassword = $_POST["txtCurrentPW"];
    $newPassword = $_POST["txtNewPW"];
    $reEnteredPassword = $_POST["txtReNewPW"];

    // Validate form data (add more validation as needed)
    if (empty($username) || empty($currentPassword) || empty($newPassword) || empty($reEnteredPassword))
     {
        echo "Please fill in all fields.";
    } 
    elseif ($newPassword !== $reEnteredPassword) 
    {
        echo "<script>alert('New Password and Re-entered Password do not match.');</script>";
    } 
    else 
    {
        // Validate current password from your database (replace table_name and columns)
        $sql = "SELECT * FROM tblregister WHERE username = '$username' AND pwrd = '$currentPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            // Update password in the database (replace table_name and columns)
            $updateSql = "UPDATE tblregister SET pwrd = '$newPassword' WHERE username = '$username'";
            if ($conn->query($updateSql) === TRUE) 
            {
                echo "Password updated successfully!";
                
                // Redirect to login form
                header("Location: login.php");
                exit();
            }
            else
            {
                echo "Error updating password: " . $conn->error;
            }
        } 
        else 
        {
            echo "Invalid username or current password.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
	<title>Forgot Password</title>
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>LIYANAGE .</p>
        </div>
        <div class="nav-menu" id="navMenu">
        </div>
    </nav>

<form name="formResetPW" action="#" method="post" onsubmit="return Validation()">
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- Reset Password form -------------------------->

        <div class="login-container" id="resetPW">
            <div class="top">
                <header>Reset Password</header>
            </div>
            <div class="two-forms">
            <div class="input-box">
                <input type="text" class="input-field" name="txtUserName" id="txtUserName" placeholder="Username">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="txtCurrentPW" id="txtCurrentPW" placeholder="Current Password">
                <i class="bx bx-lock-alt"></i>
            </div>
        </div>
            <div class="input-box">
                <input type="text" class="input-field" name="txtNewPW" id="txtNewPW" placeholder="New Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="txtReNewPW" id="txtReNewPW" placeholder="Re Enter Pasword">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Reset Password" onclick="Validation()">
            </div>
     </div>
 </div>
</form>
</div>

<script type="text/javascript">
    function Validation()
    {
        var msg="# fix these errors #\n"
        var flag=0;

        if(document.getElementById("txtUserName").value=="")
        {
            msg=msg+"User name can't be blank\n";
            flag=1;
        }
        if(document.getElementById("txtCurrentPW").value=="")
        {
            mag=msg+"Please enter the current password\n";
            flag=1;
        }
        if(document.getElementById("txtNewPW").value=="")
        {
            msg=mag+"Please enter the new password\n";
            flag=1;
        }
        if(document.getElementById("txtReNewPW").value=="")
        {
            msg=msg+"Please re enter the new password\n";
            flag=1;
        }
        if(flag==1)
        {
            alert(msg);
            return false; //Prevent form submission
        }
        return true; //Allow form submission
    }
</script>


</body>
</html>