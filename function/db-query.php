<?php 
function query($query){
	global $connection;
	$fetch=mysqli_query($connection, $query);
	$rows=[];
	while ($row=mysqli_fetch_assoc($fetch)) {
		$rows[]=$row;
	}
	return $rows;
}
?>