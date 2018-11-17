<?php
session_start();

include 'koneksi.php';
/*if(isset($_COOKIE['cookie_userid'])!="") {
	$_SESSION['sesiuser'] = $_COOKIE['cookie_userid'];
}*/
if(isset($_SESSION['sesiuser'])!="") {
	header("Location: index.php");
	exit;
}

if(isset($_POST['loggin'])) {
	$user = strip_tags($_POST['username']);
	$pass = strip_tags($_POST['password']);

	$user = mysqli_real_escape_string($kon,$user);
	$pass = mysqli_real_escape_string($kon,$pass);
	//echo $user;

	$query = mysqli_query($kon,"SELECT user_id,username,password FROM user WHERE username='$user'");
	$row = mysqli_fetch_array($query);

	$count = mysqli_num_rows($query);
	//echo $count;

	if(md5($pass)==$row['password'] && $count==1) {
		$_SESSION['sesiuser'] = $_POST['username'];
		if(!empty($_POST['remember'])) {
			//echo "<script>alert('Cookie jalan');window.location='login.php';</script>";
			setcookie("cookie_username",$_POST['username'],time()+30*24*60*60,"/");
		} else {
			//echo "<script>alert('Cookie g mw jalan');window.location='login.php';</script>";
			if(isset($_COOKIE['cookie_username'])) {
				setcookie("cookie_username","");
			}
			if(isset($_COOKIE['cookie_pass'])) {
				setcookie("cookie_pass","");
			}
		}
		header("Location: index.php");

	} else {
		echo "<script>alert('Password/username tidak sesuai');window.location='login.php';</script>";
	}

	print_r($_COOKIE);

}

?>

<!DOCTYPE html>
<head>
<title>Login kuy</title>
</head>

<body>
<form method="post">
	<h1>Tes Login</h1>

	<h2>Name</h2>
	<input type="text" name="username" required/></br>
	<h2>Pass</h2>
	<input type="password" name="password" required/></br>
	<input type="checkbox" name="remember"/><p>Remember Me (30 days)</p></br>
	<button type="submit" name="loggin">Login</button>
	<a href="signup.php">Daftar</a>



	</form>
</body>