<?php
	#YOU MIGHT NOT FOLLOW THIS STRICTLY
	//header('Content-Type: text/event-stream');
	//header('Cache-Control: no-cache');	
	if (isset($_POST['messageCount']) /*ANY OTHER PARAMETER LIKE COOKIE - user_id is used here*/) {		
		require 'db.php';
		$bond = $_POST['bond'];
		$sql3 = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";
	    $all = mysqli_query($conn, $sql3);
	    $rows = mysqli_num_rows($all);
	    /*
	    if ($rows >= 20) {
	        $offset = ($rows - 20);
	    }
	    else {
	        $offset = 0;
	    }
	    */
	    $count = 20;
	    $sql = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";    
	    $select = mysqli_query($conn, $sql);
	    $user_id = $_COOKIE['user_id'];
	    $sql1 = "SELECT * FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
	    $query = mysqli_query($conn, $sql1);
	    $user = mysqli_fetch_array($query);
	    $user_image = $user['image'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $user_name = $fname." ".$lname;
	    $logs  = mysqli_fetch_all($select);
	    if (mysqli_num_rows($select) > 0) {
	    	$data=mysqli_num_rows($select);
	    	echo $data;
	    }
	}
	//flush();
?>
