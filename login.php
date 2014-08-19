<?php
	require_once 'logout.php';

	session_start();

	if(isset($_SESSION["username"]) && $_SESSION['logged_in'] == true){
		echo 'You are logged in as '. $_SESSION['username'] .'.<br />';

	}else{
		if(isset($_POST["submit"])){
			$username = mysqli_real_escape_string($link, stripslashes(trim($_POST['username'])));
			$password = mysqli_real_escape_string($link, stripslashes(trim($_POST['password'])));

			if(!empty($username) && !empty($password)){

				$result = mysqli_query($link, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

				$row = mysqli_num_rows($result);

				if ($row == 1) {

					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $username;

					$cookie_value = "a_cookie";

					setcookie("user", $cookie_value, time()+3600, "/");

					echo 'You are logged in as '. $_SESSION['username'] .'.<br />';
				}else{
					echo "Wrong username or passsword. Try again !!!<br />";
				}
			}else{
				echo "Enter both username and passworrd.<br />";
			}
		}

	}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="login-form">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<label>Username : </label><input type="text" name="username"><br />
				<label>Password : </label><input type="password" name="password"><br />
				<input type="submit" class="button" name="submit" value="Login">
			</form>
			<a href="login.php">login.php</a><br>
			<a href="register.php">register.php</a><br>
			<a href="index.php">index.php</a><br>
		</div>

	</body>
</html>