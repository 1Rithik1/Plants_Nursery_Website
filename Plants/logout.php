<?php

	session_start();

	if(isset($_SESSION['email'])){

		session_destroy();
		echo '<script> alert("Logout Successfull !"); window.location="Login_Register.html" </script>';
		
	}
	else{
		echo '<script> alert("Logout Successfull !"); window.location="Login_Register.html" </script>';
		
	}
?>