<?php
	if (isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake'])):
        require 'db.php';
	        $user_id = $_COOKIE['user_id'];
	        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	        $query = mysqli_query($conn, $sql);
	        $user = mysqli_fetch_array($query);
	        $image = $user['image'];
?>
<?php echo "dist/img/avatars/".$image.""; ?>
<?php endif;?>