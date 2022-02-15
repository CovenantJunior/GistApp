<?php	
	if (isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake']) && isset($_COOKIE['PHPSESSID']) && isset($_POST['fetch']) && ($_POST['fetch']==true)):
        require 'db.php';
	        $user_id = $_COOKIE['user_id'];
	        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	        $query = mysqli_query($conn, $sql);
	        $user = mysqli_fetch_array($query);
	        $email = $user['email'];
			$sql3 = "SELECT * FROM conversation_log WHERE recipient = '".$email."' OR sender = '".$email."'";
			$query1 = mysqli_query($conn, $sql3);
			$data = mysqli_num_rows($query1);
?>
	<?php echo "<h2>$data</h2><h3>Chats</h3>"; ?>

<?php endif;?>