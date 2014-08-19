<?php
	require 'init.php';
	session_start();

	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] = true){
		echo '<h1>Welcome , '. $_SESSION["username"] .'</h1>';
	}else{
		echo "You are not logged in.";
	}
?>

			<a href="login.php">login.php</a><br>
			<a href="register.php">register.php</a><br>
			<a href="index.php">index.php</a><br>