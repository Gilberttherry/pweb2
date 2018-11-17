<?php
	session_start();
		setcookie('cookie_username','',time()-3600);
		session_destroy();

		header("Location: login.php");
		exit();
?>