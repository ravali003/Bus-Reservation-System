<?php 
session_start();
$con=mysqli_connect("localhost","root","","brs");
if(mysqli_connect_error())
{
echo "failed";
}
$username = $_SESSION["username"];
$date = $_SESSION['date'];
$boarding = $_SESSION['boarding'];
$departure = $_SESSION['departure'];

	if(isset($_POST["submit"]))
	{
		//echo "submitted";
		//$mno = $_POST["mno"];
		//$message =  $_POST["message"];

		$ch = curl_init();
				$user="ravalialamuri@gmail.com:sujatha22";
		$sql="select phno from passenger where username='$username'";
	
		if($result=mysqli_query($con,$sql))
		{
			if($result->num_rows>0)
			{
					curl_setopt($ch,CURLOPT_URL,"http://api.mVaayoo.com/mvaayooapi/MessageCompose");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
		
				while($row=mysqli_fetch_assoc($result))
				{
					
					$no=$row["phno"];
					$senderID="TEST SMS"; 
					$msgtxt= "your ticket has been successfully cancelled on date $date from $boarding to $departure - TRAVELS"; 
					
					curl_setopt($ch, CURLOPT_POSTFIELDS,"user=$user&senderID=$senderID&receipientno=$no&msgtxt=$msgtxt");
					$buffer = curl_exec($ch);
					if(empty ($buffer))
					{
						 echo " buffer is empty ";
			 		}
					else
					{ 
						echo $buffer;
						echo 'Message Send.';
					} 
					
				}
			}
		}curl_close($ch);
		
	}
?>
 
<html>
	<head>
		<title>SMS Sending Using PHP and Mvaayoo API</title>
	</head>
	<body align="center">
	<h1>SMS Sending Using PHP and Mvaayoo API</h1>
		<form action="" method="post">
			 
			  <br>
			  <input type="submit"  name="submit" value="Send"/>
		</form>
		<h3>Total Remaining SMS</h3>
		<?php 
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,  "http://api.mvaayoo.com/mvaayooapi/APIUtil");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=ravalialamuri@gmail.com:sujatha22&type=0");
			$buffer = curl_exec($ch);
			echo $buffer;
			curl_close($ch);
		?>
 
		
	</body>
</html>