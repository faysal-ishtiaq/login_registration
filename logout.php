<?php
	require 'init.php';

	session_start();

	if(isset($_SESSION['logged_in'])){
		setcookie("user", "a_cookie", time()-3600, "/");
	}	

	session_destroy();
?>

			<a href="login.php">login.php</a><br>
			<a href="register.php">register.php</a><br>
			<a href="index.php">index.php</a><br>