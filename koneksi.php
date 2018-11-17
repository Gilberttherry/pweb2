<?php
		$namaserver = "localhost";
		$uname = "root";
		$pass = "";
		$namadb = "pweb2";

		//Buat Koneksi
		$kon = mysqli_connect($namaserver,$uname,$pass,$namadb);
		if(!$kon) {
			die("Can't connect into database!! " . mysqli_connect_error());
		}
?>
