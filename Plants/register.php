<?php
	$Firstname = $_POST['firstname'];
	$Lastname = $_POST['lastname'];
	$Email = $_POST['email'];
	$Mobile = $_POST['mobile'];
	$Address = $_POST['address'];
	$Password = $_POST['password'];

	// Database connection
	$conn = new mysqli('localhost','root','','Plants Nursery');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("Insert into Registration(FirstName, LastName, Email, Mobile, Address, Password) 
			values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssiss", $Firstname, $Lastname, $Email, $Mobile, $Address, $Password);
		$execval = $stmt->execute();
		if ($execval == 'success')
		{
			echo '<script> alert("Registered Sucessfully !"); window.location="Homepage.html" </script>';
		}
		else {
			echo '<script> alert("Enter Data Correctly !"); window.location="Login_Register.html" </script>';
		}
		
		$stmt->close();
		$conn->close();
	}
?>