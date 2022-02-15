<?php
	if (isset($_POST['typing']) && ($_POST['typing'] == true) && isset($_POST['bond']) && isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		$bond = $_POST['bond'];
        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
	        $user = mysqli_fetch_array($query);
	        $user_image = $user['image'];
	        $user_name = $user['fname'];
			$message = mysqli_real_escape_string($conn, "<br><br><p style='color:yellow; margin-left:35px;'> is typing...</p>");
			$sql1 = "INSERT INTO `".$bond."_typing_message` (user_id, image, user_name, message) VALUES ('".$user_id."', '".$user_image."', '".$user_name."', '".$message."')";
			$insert = mysqli_query($conn, $sql1);
		}
		mysqli_close($conn);
	}
?>
<?php
	if (isset($_COOKIE['user_id']) && isset($_COOKIE['handshake']) && isset($_POST['bond']) && (strlen($_POST['bond'])!=0)) {
		require 'db.php';
		$bond = $_POST['bond'];
			$sql2 = "SELECT * FROM `".$bond."_typing_message` WHERE user_id != '".$_COOKIE['user_id']."'";
				$select = mysqli_query($conn, $sql2);
				if (mysqli_num_rows($select)>=1) {
					$result = mysqli_fetch_array($select);
					/*
					if ($result) {
						//$result = json_encode($result);
						$user_id = $_COOKIE['user_id'];
				        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
				        $query = mysqli_query($conn, $sql);
				        if ($query) {
					        $user = mysqli_fetch_array($query);
					        $user_name = $user['fname'];
							if ($result['3'] == $user_name) {
								echo "";
							}
							else {
								*/
								echo "
										<div class='col-md-12 zoomInLeft'>
											<div class='message'>
												<img class='avatar-md' src='dist/img/avatars/".$result['2']."' data-toggle='tooltip' data-placement='top' title='".$result['3']."' alt='avatar'>
												<div class='text-main'>
													<div class='text-group'>
														<div class='text typing'>
															<div class='wave'>
																<span class='dot'></span>
																<span class='dot'></span>
																<span class='dot'></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
								";
								echo "<script>console.log('".$result['3']." is typing...')</script>";
							/*}
						}
					}*/
				}
			mysqli_close($conn);
	}
?>
<?php
	if (isset($_POST['typed']) && ($_POST['typed'] == true) && isset($_POST['user']) && isset($_POST['bond'])) {
		require 'db.php';
		$user = $_POST['user'];
		$bond = $_POST['bond'];
		$sql = "DELETE FROM `".$bond."_typing_message` WHERE user_id = '".$_COOKIE['user_id']."'";
		$delete = mysqli_query($conn, $sql);
		mysqli_close($conn);
	}
?>