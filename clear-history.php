<?php if (isset($_POST['clear']) && ($_POST['clear'] == true) && isset($_POST['bond']) && isset($_POST['contact']) && ($_POST['bond'] != "")) : ?>
<?php
	//For both users
	if (isset($_COOKIE['user_id'])&&isset($_COOKIE['handshake'])) {
	    require 'db.php';                                
		$user_id = $_COOKIE['user_id'];
		$bond = $_POST['bond'];
		$recipient = $_POST['recipient'];
	    $sql2 = "DELETE FROM conversation_log WHERE bond = '".$bond."'";
	    $delete2 = mysqli_query($conn, $sql2);
	    
	}
	else {
		header('location: sign-in');
	}
?>
<?php else: header('location: sign-in'); ?>
<?php endif; ?>