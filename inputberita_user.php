<?php
session_start();
	include 'koneksi.php';
if(!isset($_SESSION['sesiuser'])) {
	header("Location: login.php");
	exit;
}
echo "KONTOLATOS";

$cak = $_SESSION['sesiuser'];
$query = "SELECT * FROM user WHERE username = '$cak'";
$sql = mysqli_query($kon,$query);
if (!$sql) {
    printf("Error: %s\n", mysqli_error($kon));
}
$row = mysqli_fetch_array($sql);
	if(isset($_POST['input'])) {
		$judul = mysqli_real_escape_string($_POST['judul']);
		$headline = mysqli_real_escape_string($_POST['headline']);
		$isi = mysqli_real_escape_string($_POST['isi']);
		$foto = $_FILES['gambar']['name'];
		$tmp = $_FILES['gambar']['tmp_name'];
		$path = "upload_pic/".$foto;
		$user = $row['username'];

		if(move_uploaded_file($tmp,$path)) {
			$query1 = "INSERT INTO artikel VALUES (''.'$judul','$headline','$isi','$user',NOW(),'$foto')";
					if (!$query1) {
    printf("Error: %s\n", mysqli_error($kon));
}
			$sql = mysqli_query($kon,$query1);
			if($sql) {
				echo "<script>alert('kaga');window.location='inputberita_user.php';</script>";
				header("Location: index.php");
			}
			
		 else {
		 	echo "<script>alert('kaga');window.location='inputberita_user.php';</script>";
			echo "Terjadi kesalahan";
		}
	} else {
		echo "<script>alert('ngaco');window.location='inputberita_user.php';</script>";
		echo "Gambar gagal diinput";
	}
}



?>

<!DOCTYPE html>

<form>
	<h1>Input Berita</h1>

	<h2>Judul</h2>
	<input type="text" name="judul"/> 
	<h2>Headline</h2>
	<textarea name="headline"></textarea>
	<h2>Isi</h2>
	<textarea name="isi"/></textarea>
	<h2>Gambar Upload</h2>
	<input type="file" name="gambar">
	<input type="submit" name="input" value="Input Berita">
	<input type="reset" name="reset" value="Cancel">


</form>