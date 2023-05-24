<?php 
function produkSearch($keyword){
	$query="SELECT * FROM `produk` WHERE nama_produk LIKE '%$keyword%' OR kode_produk LIKE '%$keyword%' ORDER BY `nama_produk` ASC";
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
?>