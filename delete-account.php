<?php if (isset($_POST['delete-account']) && ($_POST['delete-account'] == true) && isset($_COOKIE['user_id'])  && isset($_COOKIE['handshake'])) : ?>
<?php
	require 'db.php';
	$user_id = $_COOKIE['user_id'];
	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		$user = mysqli_fetch_array($query);
		$user_image = $user['image'];
		$fname = $user['fname'];
		$lname = $user['lname'];
		$user_name = $fname."_".$lname;
		$sql = "DELETE FROM users WHERE user_id = '".$user_id."'";
		$sql1 = "DROP TABLE ".$user_name."";
		$sql2 = "DROP TABLE ".$user_name."_friend_list";		
		$sql3 = "DROP TABLE ".$user_name."_discussion_list";				
		$delete = mysqli_query($conn, $sql);		
	}
	if ($delete == true) {
	   	$delete1 = mysqli_query($conn, $sql1);
	   	if ($delete1 == true) {
			$delete2 = mysqli_query($conn, $sql2);
			if ($delete2 == true) {
				$delete3 = mysqli_query($conn, $sql3);
				if ($delete3 == true) {
							setcookie("GID", '', time() - 3600, "/");
							setcookie("user_id", '', time() - 3600, "/");
							setcookie("handshake", '', time() - 3600, "/");
							echo "Deleted";
				}
				else {
	   				echo mysqli_error($conn);
				}
			}
			else {
	   			echo mysqli_error($conn);
			}
		}
		else {
	   	echo mysqli_error($conn);
		}
	}
	else {
	   	echo mysqli_error($conn);
	}
?>
<?php else: //header('location: sign-up'); ?>
<?php endif; ?>