<?php
	if (isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake']) && isset($_COOKIE['PHPSESSID']) && isset($_POST['fetch']) && ($_POST['fetch']==true)):
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		$query = mysqli_query($conn, $sql);
		$user = mysqli_fetch_array($query);
		$fname = $user['fname'];
		$lname = $user['lname'];
		$user_friend_list = $fname."_".$lname."_friend_list";
		$sql1 = "SELECT * FROM ".$user_friend_list."";
		$get = mysqli_query($conn, $sql1);
		$data = mysqli_num_rows($get);
?>
	<?php echo "<h2>$data</h2><h3>Fellas</h3>\n\n"; ?>
<?php endif;?>