<!DOCTYPE html>
<html>
<head>

<style>

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: DarkCyan;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>

</head>
<body bgcolor="#E6E6FA">

<ul>
  <li><a class="active" href="home.html">Home</a></li>
  <li><a href="home.html">Logout</a></li>
  <li><a href="registration.html">Registration</a></li>
  <li><a href="booking.html">Booking</a></li>
  <li><a href="cancellation.html">Cancellation</a></li>
  <li><a href="history.html">Travel history</a></li>
  <li><a href="booking.html">Availability check</a></li>
  <li><a href="feedback.html">Feedback</a></li>
  <li><a href="about.html">About</a></li>
</ul>
<center>
<br><br>
<?php

session_start();

$con = @mysqli_connect("localhost","root","","brs") or die("couldnot connect" .mysqli_error());


if(isset($_SESSION['date']))
 {

$date = $_SESSION["date"];

$query = "SELECT * FROM reservation WHERE date = '$date'";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);
if( $count==0 ){
        echo 'No Data to Display';
      }

else
{

while($row = mysqli_fetch_array($result))
        
 {
 	    
        echo  "resid: {$row["resid"]} <br>".
              "seatno: {$row["seatno"]} <br>".
              "boarding: {$row["boarding"]} <br>".
              "departure: {$row["departure"]} <br>".
              "price: {$row["price"]} <br>".
              "Date: {$row["date"]} <br>boarding time:9PM <br>departure time:5AM";
              
 }


}
}

else
    echo "Sorry, your credentials are not valid, Please try again."; 


mysqli_close($con);

?>


<br><br>
<form action="sms.php" method="post">

<input type="submit" name="submit" value="done">

</form>
</body>
</html>