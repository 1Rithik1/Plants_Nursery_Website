<?php
	$Email = $_POST['email'];
	$Message = $_POST['msg'];

	$conn = new mysqli('localhost','root','','Plants Nursery');
	
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("Insert into ContactUs(Email, Message) values(?, ?)");
		$stmt->bind_param("ss", $Email, $Message);
		$execval = $stmt->execute();
		if ($execval == 'success')
		{
			echo '<script> alert("Message Sent Sucessfully !"); window.location="Homepage.html" </script>';
		}
		else {
			echo '<script> alert("Try again !"); window.location="Homepage.html" </script>';
		}
		

		$stmt->close();
		$conn->close();
	}
?>