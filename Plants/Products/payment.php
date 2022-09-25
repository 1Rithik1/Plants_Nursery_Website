<?php
	$Fullname = $_POST['fullname'];
	$Email = $_POST['email'];
	$Address = $_POST['address'];
	$City = $_POST['city'];
	$State = $_POST['state'];
	$Zip = $_POST['zip'];
	$Cardname = $_POST['cardname'];
	$Cardnumber = $_POST['cardnumber'];
	$Expmonth = $_POST['expmonth'];
	$Expyear = $_POST['expyear'];
	$CVV = $_POST['cvv'];

	// Database connection
	$conn = new mysqli('localhost','root','Rithik3010','Plants Nursery');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("Insert into Checkout (Name, Email, Address, City, State, Zipcode, CardName, CardNumber, Expmonth, Expyear, CVV) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssisiiii", $Fullname, $Email, $Address, $City, $State, $Zip, $Cardname, $Cardnumber, $Expmonth, $Expyear, $CVV);
		$execval = $stmt->execute();
		if ($execval == 'success')
		{
			echo '<script> alert("Payment Done Sucessfully !"); window.location="receipt.php" </script>';	

	    }
		else {
			echo '<script> alert("Enter Data Correctly !"); window.location="Checkout.php" </script>';
		}
		
		$stmt->close();
		$conn->close();
	}
?>