<?php if (isset($_POST['delete']) && ($_POST['delete'] == true) && isset($_POST['bond']) && isset($_POST['recipient']) && ($_POST['bond'] != "")) : ?>
<?php
	//For both users
	if (isset($_COOKIE['user_id'])&&isset($_COOKIE['handshake'])) {
	    require 'db.php';                                
		$user_id = $_COOKIE['user_id'];
		$bond = $_POST['bond'];
		$recipient =$_POST['recipient'];
	    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    $query = mysqli_query($conn, $sql);
	    $user = mysqli_fetch_array($query);
	    $fname = $user['fname'];
	    $lname = $user['lname'];
	    $phone = $user['phone'];
	    $sql1 = "SELECT * FROM users WHERE phone = '".$recipient."'";
	    $query1 = mysqli_query($conn, $sql1);
	    $user1 = mysqli_fetch_array($query1);
	    $fname1 = $user1['fname'];
	    $lname1 = $user1['lname'];
	    $user_friend_list = $fname."_".$lname."_friend_list";
	    $user_discussion_list = $fname."_".$lname."_discussion_list";
	    $reciever_friend_list = $fname1."_".$lname1."_friend_list";
	    $reciever_discussion_list = $fname1."_".$lname1."_discussion_list";
	    $sql2 = "DELETE FROM conversation_log WHERE bond = '".$bond."'";
	    $sql3 = "DELETE FROM ".$user_discussion_list." WHERE recipient = '".$recipient."' OR sender = '".$recipient."'";
	    $sql4 = "DELETE FROM ".$reciever_discussion_list." WHERE recipient = '".$phone."' OR sender = '".$phone."'";
	    $sql5 = "DELETE FROM ".$user_friend_list." WHERE phone = '".$recipient."'";
	    $sql6 = "DELETE FROM ".$reciever_friend_list." WHERE phone = '".$phone."'";
	    $sql7 = "DELETE FROM ".$fname."_".$lname." WHERE phone = '".$recipient."'";
	    $sql8 = "DELETE FROM ".$fname1."_".$lname1." WHERE phone = '".$phone."'";	     
	    $delete2 = mysqli_query($conn, $sql2);
	    $delete3 = mysqli_query($conn, $sql3);
	    $delete4 = mysqli_query($conn, $sql4);
	    $delete5 = mysqli_query($conn, $sql5);
	    $delete6 = mysqli_query($conn, $sql6);
	    
	}
	else {
		header('location: sign-in');
	}
?>
<?php else: header('location: sign-in'); ?>
<?php endif; ?>