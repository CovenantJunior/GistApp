<?php
	require 'db.php';
	$sql = "SELECT * FROM conversation_log WHERE `bond` = '5ed704dcfcaee7b8941d5cba847706be.c80bcadf8111f15e9d88803eed2d4224' ORDER BY id ASC LIMIT 0,5"; 
	$select = mysqli_query($conn, $sql);
	$logs  = mysqli_fetch_all($select);
	print_r($logs);
?>