<?php
session_start();
if (!isset($_SESSION["auth_check"])) {
    header("location: login.php");
    exit;
}

include_once('db-connection.php');
include('db-query.php');
include('db-function.php'); 

	$id=$_GET["id"];

	if (databaseDelete($id)) {
		echo "
		<script>
			alert('Produk berhasil dihapus!');
			document.location.href = 'database.php';
		</script>
		";
	}else{
		echo "
		<script>
			alert('Produk gagal dihapus!');
			document.location.href = 'database.php';
		</script>
		";
	}

?>