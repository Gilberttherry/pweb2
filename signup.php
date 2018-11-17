<?php
session_start();
if(isset($_COOKIE['cookie_userid'])!="") {
	$_SESSION['sesiuser'] = $_COOKIE['cookie_userid'];
}

if(isset($_SESSION['sesiuser'])!="") {
	header("Location: index.php");
}
include 'koneksi.php';

	if(isset($_POST['buatakun'])) {
		$user = strip_tags($_POST['username']);
		$pass = strip_tags($_POST['password']);
		$cek = strip_tags($_POST['checkpassword']);

		$user = mysqli_real_escape_string($kon,$user);
		$pass = mysqli_real_escape_string($kon,$pass);
		$cek = mysqli_real_escape_string($kon,$cek);

		if($pass!=$cek) {
			echo "<script>alert('Password tidak sesuai, silahkan cek lagi');window.location='signup.php';</script>";
		}

		else {

		$hash_pass = md5($pass);

		$check_user = mysqli_query($kon,"SELECT username FROM user WHERE username='$user'");
		$itung = mysqli_num_rows($check_user);

		if($itung == 0) {
			$query = "INSERT INTO user(user_id,username,password) VALUES ('','$user','$hash_pass')";

			if(mysqli_query($kon,$query)) {
				
				$_SESSION['sesiuser'] = $user;
				header('Location: login.php');
			} 
			else {
				header('Location: signup.php');
			}

		}
		else {
			header('Location: signup.php');
		}
	}


	} else {
		echo "TODOS";
	}

?>
<!DOCTYPE html>
<head>
	<title>Tes Sign Up</title>
</head>

<body>
	<form method="post">
	<h1>Tes Sign Up</h1>

	<h2>Name</h2>
	<input type="text" name="username" required/></br>
	<h2>Pass</h2>
	<input type="password" name="password" required/></br>
	<h2>Re-enter Password</h2>
	<input type="password" name="checkpassword" required/></br>
	<button type="submit" name="buatakun">Buat Akun</button>
	<a href="login.php">Login</a>



	</form>

</body>


