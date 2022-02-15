<?php if (isset($_POST['block']) && ($_POST['block'] == true) && isset($_POST['contact']) && ($_POST['contact'] != "")) : ?>
	<?php
		if (isset($_COOKIE['user_id'])&&isset($_COOKIE['handshake'])) {
		    require 'db.php';                                
			$user_id = $_COOKIE['user_id'];
			$recipient =$_POST['contact'];
		    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		    $query = mysqli_query($conn, $sql);
		    $user = mysqli_fetch_array($query);
		    $fname = $user['fname'];
		    $lname = $user['lname'];
		    $phone = $user['phone'];
		    $user_discussion_list = $fname."_".$lname."_discussion_list";
		    $sql1 = "UPDATE ".$user_discussion_list." SET blocked = 1 WHERE recipient = '".$recipient."' OR sender = '".$recipient."'";
		    $update1 = mysqli_query($conn, $sql1);
		    $recipient =$_POST['contact'];
		    $sql2 = "SELECT * FROM users WHERE phone = '".$recipient."'";
		    $query2 = mysqli_query($conn, $sql2);
		    $user2 = mysqli_fetch_array($query2);
		    $fname2 = $user2['fname'];
		    $lname2 = $user2['lname'];
		    $user2_discussion_list = $fname2."_".$lname2."_discussion_list";
		    $sql3 = "UPDATE ".$user2_discussion_list." SET blocked = 1 WHERE recipient = '".$phone."' OR sender = '".$phone."'";
		    $update2 = mysqli_query($conn, $sql3);
		    if ($update1&&$update2) {
		    	echo "blocked";
		    }
		    else {
		    	echo mysqli_error($conn);
		    }
		    

		}
		else {
			header('location: sign-in');
		}
	?>
<?php else: header('location: sign-in'); ?>
<?php endif; ?>



<?php if (isset($_POST['unblock']) && ($_POST['unblock'] == true) && isset($_POST['contact']) && ($_POST['contact'] != "")) : ?>
	<?php
		if (isset($_COOKIE['user_id'])&&isset($_COOKIE['handshake'])) {
		    require 'db.php';                                
			$user_id = $_COOKIE['user_id'];
			$recipient =$_POST['contact'];
		    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		    $query = mysqli_query($conn, $sql);
		    $user = mysqli_fetch_array($query);
		    $fname = $user['fname'];
		    $lname = $user['lname'];
		    $user_discussion_list = $fname."_".$lname."_discussion_list";
		    $sql1 = "UPDATE ".$user_discussion_list." SET blocked = 0 WHERE recipient = '".$recipient."' OR sender = '".$recipient."'";		    
		    $update1 = mysqli_query($conn, $sql1);
		    $recipient =$_POST['contact'];
		    $sql2 = "SELECT * FROM users WHERE phone = '".$recipient."'";
		    $query2 = mysqli_query($conn, $sql2);
		    $user2 = mysqli_fetch_array($query2);
		    $fname2 = $user2['fname'];
		    $lname2 = $user2['lname'];
		    $user2_discussion_list = $fname2."_".$lname2."_discussion_list";
		    $sql3 = "UPDATE ".$user2_discussion_list." SET blocked = 0 WHERE recipient = '".$phone."' OR sender = '".$phone."'";
		    $update2 = mysqli_query($conn, $sql3);		    
		     if ($update1&&$update2) {
		    	echo "unblocked";
		    }
		    else {
		    	echo mysqli_error($conn);
		    }
		}
		else {
			header('location: sign-in');
		}
	?>
<?php else: header('location: sign-in'); ?>
<?php endif; ?>