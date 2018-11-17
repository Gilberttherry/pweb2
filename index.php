<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['sesiuser'])) {
	header("Location: login.php");
	exit;
}
$cak = $_SESSION['sesiuser'];
$query = "SELECT * FROM user WHERE username = '$cak'";
$sql = mysqli_query($kon,$query);
if (!$sql) {
    printf("Error: %s\n", mysqli_error($kon));
}
$row = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<head>
	<title>Harusnya dah login</title>
</head>
<body>
		<h1>Met dateng <?php echo $row['username'];?> </h1>
		<a href="logout.php">Logout</a>
</body>