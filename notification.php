<?php
	if (isset($_COOKIE['handshake'])&&isset($_COOKIE['user_id'])) {
		require 'db.php';
		$sql="SELECT * FROM notifications WHERE reciever = '".$_COOKIE['handshake']."' AND seen = 0 AND created_at <= CURRENT_TIMESTAMP()";
		$fetch = mysqli_query($conn, $sql);		
		$notification = mysqli_fetch_all($fetch);
		echo json_encode($notification);
		$seen = mysqli_query($conn, "UPDATE notifications SET seen = 1 WHERE reciever = '".$_COOKIE['handshake']."' AND seen = 0 AND created_at < CURRENT_TIMESTAMP()");
		if ($seen==true) {
			$sql1="SELECT * FROM notifications WHERE reciever = '".$_COOKIE['handshake']."' AND seen = 0 AND created_at <= CURRENT_TIMESTAMP()";
			$fetch1 = mysqli_query($conn, $sql1);
			$notification1 = mysqli_fetch_array($fetch1);
			if ($notification1==null) {				
				$delete = mysqli_query($conn, "DELETE FROM notifications WHERE reciever = '".$_COOKIE['handshake']."' AND seen = 1 AND created_at < CURRENT_TIMESTAMP()");
			}
		}		
	}
?>
<?php
	if (isset($_POST['delete'])&&isset($_POST['sender'])&&isset($_COOKIE['handshake'])&&isset($_COOKIE['user_id'])) {
		require 'db.php';
		$sender = $_POST['sender'];
		$delete = mysqli_query($conn, "DELETE FROM notifications WHERE reciever = '".$_COOKIE['handshake']."' AND sender = '".$sender."' AND created_at <= CURRENT_TIMESTAMP()");
	}
?>
<?php
	if (isset($_GET['read'])&&($_GET['read']!='')&&isset($_COOKIE['handshake'])&&isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
			$bond = $_GET['read'];
	        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	        $select = mysqli_query($conn, $sql);
	        if ($select) {
		        $user = mysqli_fetch_array($select);
		        $fname = $user['fname'];
		        $lname = $user['lname'];
		        $user_name = $fname." ".$lname;	        
		        $user_discussion_list = $fname."_".$lname."_discussion_list";
		        $sql1 = "UPDATE ".$user_discussion_list." SET seen = 1, unseen = 0 WHERE bond = '".$bond."'";
		        $update = mysqli_query($conn, $sql1);
		        if ($update) {
		        	echo "Read";
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