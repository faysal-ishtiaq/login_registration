<?php
	require 'init.php';
	session_start();

	if(isset($_SESSION['username']) == true && $_SESSION['logged_in'] == true ){
		echo 'You are logged in as '. $_SESSION['username'] .'.<br />';
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="registration-form">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<label>Name : </label><input type="text" name="name"><br />
				<label>Email : </label><input type="text" name="email"><br />
				<label>Username : </label><input type="text" name="username"><br />
				<label>Password : </label><input type="password" name="password"><br />
				<input type="submit" class="button" name="submit" value="Register">
			</form>
			<a href="login.php">login.php</a><br>
			<a href="register.php">register.php</a><br>
			<a href="index.php">index.php</a><br>
		</div>
	</body>
</html>

<?php
	if(isset($_POST['submit'])){
		
		$username = mysqli_real_escape_string($link, stripslashes(trim($_POST['username'])));
		$password = mysqli_real_escape_string($link, stripslashes(trim($_POST['password'])));
		$name = mysqli_real_escape_string($link, stripslashes(trim($_POST['name'])));
		$email = mysqli_real_escape_string($link, stripslashes(trim($_POST['email'])));

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$email = "";
		}

		if(empty($username) || empty($password) || empty($name) || empty($email)){
			echo "All of the fields are required. Try again !!!";
		}else{
			$result = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'");

			$row = mysqli_num_rows($result);

			if($row > 0){
				echo "$username is already in use. Try another one.<br />";
			}else{
				$sql = "SELECT * FROM users WHERE email = '$email'";

				$result = mysqli_query($link, $sql);

				$row = mysqli_num_rows($result);

				if($row > 0){
					echo "Email address is already used. Try another one.<br />";
				}else{
					$sql = "INSERT INTO users (username, password, name, email) VALUES ('$username', '$password', '$name', '$email')";

					$result = mysqli_query($link, $sql) or die( mysqli_errno($link) );
				}
			}
		}
	}	
?>