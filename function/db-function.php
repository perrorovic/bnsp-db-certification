<?php 
function produkSearch($keyword){
	$query="SELECT * FROM `produk` 
    WHERE nama_produk 
    LIKE '%$keyword%' 
    OR kode_produk LIKE '%$keyword%' 
    ORDER BY `nama_produk` ASC";
	return query($query);
}
function sortPrice_ASC(){
	$query="SELECT * FROM `produk` ORDER BY `harga` ASC";
	return query($query);
}
function sortPrice_DESC(){
	$query="SELECT * FROM `produk` ORDER BY `harga` DESC";
	return query($query);
}
function sortStock_ASC(){
	$query="SELECT * FROM `produk` ORDER BY `stok` ASC";
	return query($query);
}
function sortStock_DESC(){
	$query="SELECT * FROM `produk` ORDER BY `stok` DESC";
	return query($query);
}
function sortName_ASC(){
	$query="SELECT * FROM `produk` ORDER BY `nama_produk` ASC";
	return query($query);
}
function sortName_DESC(){
	$query="SELECT * FROM `produk` ORDER BY `nama_produk` DESC";
	return query($query);
}
function databaseInsert($data){
	global $connection;

	$kode_produk=htmlspecialchars($data["kode_produk"]);
	$nama_produk=htmlspecialchars($data["nama_produk"]);
	$harga_temp=htmlspecialchars($data["harga"]);
	$harga=str_replace(',','.',str_replace('.','',$harga_temp));
	settype($harga, "integer");
	$stok=htmlspecialchars($data["stok"]);

	$query="INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`) 
	VALUES (NULL, '$kode_produk', '$nama_produk', '$harga', '$stok');";
	mysqli_query($connection, $query);
	return mysqli_affected_rows($connection);
}
function databaseDelete($id){
	global $connection;

	mysqli_query($connection, "DELETE FROM produk WHERE id=$id");
	return mysqli_affected_rows($connection);
}
?>