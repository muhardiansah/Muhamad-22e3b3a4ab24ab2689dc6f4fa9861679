<?php 
	include("koneksi.php");
	$sql = mysqli_query("SELECT * FROM tbuser ORDER BY nama_lengkap ASC");
	$result = array();
	 
	while($row = mysql_fetch_array($sql)){
		array_push($result, array('nama_lengkap' => $row[1]));
	}
	echo json_encode(array("result" => $result));

 ?>