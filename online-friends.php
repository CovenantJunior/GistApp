<?php
if (isset($_COOKIE['user_id'])) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		        $query = mysqli_query($conn, $sql);
		        if ($query) {
			        $user = mysqli_fetch_array($query);
		        $fname = $user['fname'];
		        $lname = $user['lname'];
		        $user_friend_list = $fname."_".$lname."_friend_list";
				$sql1 = "SELECT * FROM ".$user_friend_list."";
		$select = mysqli_query($conn, $sql1);
		if ($select) {
			$users = mysqli_fetch_all($select);													
		 	foreach ($users as $user) {
		 		$img = "SELECT image FROM users WHERE email = '".$user['4']."'";
	            $select1 = mysqli_query($conn, $img);
	            $result1 = mysqli_fetch_array($select1);
	            if ($result1['0'] == '') {
					$image = 'profile.png';
				}
				else {
					$image = $result1['0'];
				}
				$time = new DateTime();
	    		$time = $time->getTimestamp();
	    		$active = $time - 300;
				$sql = "SELECT last_log FROM users WHERE email = '".$user['4']."' AND last_log >= $active";
				$select = mysqli_query($conn, $sql);
				if ($select) {
					$result = mysqli_fetch_array($select);
					if (!empty($result)) {
						$status = 'online';
						echo "
							<a href='#' class='filterMembers all ".$status." contact' data-toggle='list'>
								<img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".$user['2']." ".$user['3']."' alt='avatar'>
								<div class='status'>
									<i class='material-icons ".$status."'>fiber_manual_record</i>
								</div>
								<div class='data'>
									<h5>".$user['2']." ".$user['3']."</h5>
									<p><!--Country--><!--About--></p>
								</div>
								<div class='person-add'>
									<i class='material-icons'>person</i>
								</div>
							</a>
						";
					}
				}
				else {
					echo mysqli_error($conn);
				}
			}
		}
		else {
			echo mysqli_error($conn);
		}
	}
}
?>