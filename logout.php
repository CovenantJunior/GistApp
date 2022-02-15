<?php
/*
	if (isset($_POST['logout']) && ($_POST['logout'] == true)) {
		if (isset($_COOKIE['drem'])) {
			header('location: saveuser?uid='.$_COOKIE['user_id'].'&ref=index');
		}
		else {
			$clear = setcookie('user_id', '', time() - 3600, '/');
			if ($clear) {
				echo "<p style='background-color: grey; color: white;'>You're logged out successfully! Thanks for your usage</p>";
				include 'sign-in.php';
			}
		}
	}
*/
?>
<?php
	if (isset($_POST['logout']) && ($_POST['logout']==true) && isset($_COOKIE['user_id']) && isset($_COOKIE['handshake'])) {
		require 'db.php';
		 $id = $_COOKIE['user_id'];
		 $sql = "SELECT * FROM users WHERE user_id = '".$id."'";
	     $query = mysqli_query($conn, $sql);
	     if ($query) {
	        $user = mysqli_fetch_array($query);
	        $fname = $user['fname'];
	        $lname = $user['lname'];
			setcookie('GID', '', time() - 3600, '/');
			setcookie('user_id', '', time() - 3600, '/');
			setcookie('handshake', '', time() - 3600, '/');
			//if ($clear&&$clear1) {
			$sql1 = "UPDATE users SET status = 'Offline' WHERE user_id = '".$id."'";
			$sql2 = "UPDATE ".$fname."_".$lname." SET status = 'offline' WHERE user_id = '".$id."'";
			$insert1 = mysqli_query($conn, $sql1);
			$insert2 = mysqli_query($conn, $sql2);
			if ($insert1&&$insert2) {				
				echo "Done";
			}
			else {
				echo mysqli_error($conn);
			}
		}
		else {
			echo mysqli_error($conn);
		}
	}

?>
<?php
	if (isset($_POST['inactivity']) && ($_POST['inactivity']==true) && isset($_COOKIE['handshake']) && isset($_COOKIE['user_id'])) {
		$id = $_COOKIE['user_id'];
		require 'db.php';
		$sql = "UPDATE users SET status = 'Offline' WHERE user_id = '".$id."'";
		$update = mysqli_query($conn, $sql);
	}
?>