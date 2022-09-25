
<html>
	<head>
		<style>
			body {
				background: lightgreen;
			}
			h1 {
				color: green;
			}
			h2 {
				font-size: 30px;
			}
			h3 {
				font-size: 30px;
				color: red;
			}
			form {
				border:solid;
				border-left-style: double;
				border-right-style: double;
				border-radius: 10px;
				border-width: 5px;
				text-align: center;
				width: 30%;
				padding: 20px;
				margin-top: 160px; 
				margin-left: 500px;
				background: yellow;
			}
			.input-field {
				width: 100%;
				padding: 10px 0;
				margin: 5px 0;
				border-top: 0;
				border-right: 0;
				border-left: 0;
				border-bottom: 1px solid #999;
				outline: none;
				background: transparent;
				font-size: 20px;
			}
			.submit-btn {
				width: 90%;
				padding: 10px 30px;
				cursor: pointer;
				display: block;
				margin: 15px;
				background: lightgreen;
				border: 0;
				outline: none;
				border-radius: 30px;
				font-size: 20px;
			}
			.submit-btn:hover {
				background: skyblue;
			}
			.submit-btn2 {
				width: 30%;
				padding: 10px 30px;
				cursor: pointer;
				display: block;
				margin: 15px;
				background: skyblue;
				border: 0;
				outline: none;
				border-radius: 30px;
				font-size: 20px;
				margin-left: 525px;
			}
			.submit-btn2:hover {
				background: yellow;
			}
			a {
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<form method="POST">

			<?php

				$conn = new mysqli('localhost','root','Rithik3010','Plants Nursery');
				
				if($_POST){
					$email = $_POST['email'];
					
					$selectquery = mysqli_query($conn,"select * from Registration where email ='{$email}'") or die(mysqli_error($conn));
					
					$count = mysqli_num_rows($selectquery);
					$row = mysqli_fetch_array($selectquery);

					if ($count > 0) {
						?>

						<h1><?php echo "Your Password is " . $row['Password'] . " !"; ?> </h1><hr>	

					<?php
					}else {
					?>
						<h3><?php echo "Email Not Found !"; ?> </h3><hr>	
					<?php
					}
				}

			?>

			<h2>Forgot Password</h2><br>
		
			<input type="email" class="input-field" placeholder="Enter your Email" name="email" required><br><br>
			<button type="submit" class="submit-btn">Submit</button><br>
		</form>
		<br>
		<a href="Login_Register.html"><button type="submit" class="submit-btn2">Back</button></a><br>
	</body>
</html>
