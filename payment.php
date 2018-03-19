<?php
session_start();

$con = mysqli_connect($servername = "localhost", $username = "root", $password = "","brs");
mysqli_select_db($con,"brs");

$username = $_SESSION['username'];
$boarding = $_SESSION['boarding'];
$departure = $_SESSION['departure'];
//$price = $_SESSION['price'];
$date = $_SESSION['date'];


if (!$con)

  {

  die('Could not connect: ' . mysqli_error());

  }

$sql = "INSERT INTO reservation(username,boarding,departure,date) VALUES('$username', '$boarding', '$departure','$date')";

 

if (!mysqli_query($con,$sql))

  {

  die('Error: ' . mysqli_error($con));

  }

echo "Your SEAT has been successfully booked.";
mysqli_close($con);

?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body bgcolor="#E6E6FA">
<center>
<form action="bill.php" method="post">
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>





