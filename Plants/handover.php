<?php
	$Firstname = $_POST['firstname'];
	$Lastname = $_POST['lastname'];
	$Email = $_POST['email'];
	$Mobile = $_POST['mobile'];
	$PlantType = $_POST['type'];
	$PlantSize = $_POST['size'];
	$State = $_POST['state'];
	$District = $_POST['district'];
	$Address = $_POST['add'];
	$Handover = $_POST['handover'];

	// Database connection
	$conn = new mysqli('localhost','root','Rithik3010','Plants Nursery');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("Insert into Handover (FirstName, LastName, Email, Mobile, PlantType, PlantSize, State, District, Address, Handover) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssisissss", $Firstname, $Lastname, $Email, $Mobile, $PlantType, $PlantSize, $State, 
			$District, $Address, $Handover);
		$execval = $stmt->execute();
		if ($execval == 'success')
		{
			echo '<script> alert("Form Submitted Sucessfully !"); window.location="Homepage.html" </script>';
		}
		else {
			echo '<script> alert("Enter Data Correctly !"); window.location="Handover.html" </script>';
		}
		
		$stmt->close();
		$conn->close();
	}
?>