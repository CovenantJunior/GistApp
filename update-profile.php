<?php
	if (isset($_POST['update'])) {
		/*
		if (isset($_FILES['image']) && ($_FILES['image']['name'] != '')) {			
			require 'db.php';
			$user_id = $_COOKIE['user_id'];
	    	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
	    	$query = mysqli_query($conn, $sql);
	    	$user = mysqli_fetch_array($query);
	    	$pfname = $user['fname'];
			$plname = $user['lname'];
	    	$puser_name = $pfname."_".$plname;
			//image
			$alt = basename($_FILES['image']['name']);
			$alt = substr_replace($alt, '', -4);
			$image = explode('.', basename($_FILES['image']['name']));
			$image = md5($image['0']).".".$image['1'];
			$move = move_uploaded_file($_FILES['image']['tmp_name'], 'dist/img/avatars/'.$image.'');
			if ($move) {
				//Fname
				$fname = mysqli_real_escape_string($conn, strip_tags($_POST['fname']));

				//Lname
				$lname = mysqli_real_escape_string($conn, strip_tags($_POST['lname']));

				//New name
				$user_name = $fname."_".$lname;

				//Email
				$email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));

				//Phone
				$phone = mysqli_real_escape_string($conn, strip_tags($_POST['phone']));

				//Password
				$password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));

				//About
				$about = mysqli_real_escape_string($conn, strip_tags($_POST['about']));

				//User ID
				$user_id = $_COOKIE['user_id'];


				$sql1 = "UPDATE users SET image = '".$image."', alt = 'profile-pic', fname = '".$fname."', lname = '".$lname."', email = '".$email."', phone = '".$phone."', password = '".md5($password)."', about = '".$about."' WHERE user_id = '".$user_id."'";				
				$sql2 = "ALTER TABLE ".$puser_name." RENAME TO ".$user_name."";				
				$sql3 = "ALTER TABLE ".$puser_name."_friend_list RENAME TO ".$user_name."_friend_list";				
				$sql4 = "UPDATE ".$fname."_".$lname." SET image = '".$image."', alt = 'profile-pic', fname = '".$fname."', lname = '".$lname."', email = '".$email."', phone = '".$phone."', password = '".md5($password)."', about = '".$about."' WHERE user_id = '".$user_id."'";
				$update4 = mysqli_query($conn, $sql4);
				$update3 = mysqli_query($conn, $sql3);
				$update2 = mysqli_query($conn, $sql2);
				$update1 = mysqli_query($conn, $sql1);
				if ($update1&&$update2&&$update3&&$update4) {
					header('location: ./');
				}
				else {
					echo mysqli_error($conn);
				}
			 }
			else {
				echo "<p style='background-color: #2196f3; color: white;'>Error updating your profile! Please try again later</p>";
				include 'index.php';
			}
			
		}
		else {*/
				require 'db.php';
				$user_id = $_COOKIE['user_id'];
		    	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		    	$query = mysqli_query($conn, $sql);
		    	$user = mysqli_fetch_array($query);
		    	$pfname = $user['fname'];
				$plname = $user['lname'];
		    	$puser_name = $pfname."_".$plname;

				//Fname
				$fname = mysqli_real_escape_string($conn, strip_tags($_POST['fname']));

				//Lname
				$lname = mysqli_real_escape_string($conn, strip_tags($_POST['lname']));


				//New name
				$user_name = $fname."_".$lname;

				//Email
				//$email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));

				//Phone
				$phone = mysqli_real_escape_string($conn, strip_tags($_POST['phone']));

				//Password
				//$password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));

				//About
				$about = mysqli_real_escape_string($conn, strip_tags($_POST['about']));

				//User ID
				$user_id = $_COOKIE['user_id'];


				$sql1 = "UPDATE users SET alt = 'profile-pic', fname = '".$fname."', lname = '".$lname."', phone = '".$phone."', about = '".$about."' WHERE user_id = '".$user_id."'";				
				$sql2 = "ALTER TABLE ".$puser_name." RENAME TO ".$user_name."";				
				$sql3 = "ALTER TABLE ".$puser_name."_friend_list RENAME TO ".$user_name."_friend_list";				
				$sql4 = "ALTER TABLE ".$puser_name."_discussion_list RENAME TO ".$user_name."_discussion_list";				
				$sql5 = "UPDATE ".$fname."_".$lname." SET alt = 'profile-pic', fname = '".$fname."', lname = '".$lname."', phone = '".$phone."', about = '".$about."' WHERE user_id = '".$user_id."'";
				$update5 = mysqli_query($conn, $sql5);
				$update4 = mysqli_query($conn, $sql4);
				$update3 = mysqli_query($conn, $sql3);
				$update2 = mysqli_query($conn, $sql2);
				$update1 = mysqli_query($conn, $sql1);
				if ($update1&&$update2&&$update3&&$update4&&$update5) {
					echo "Updated";
				}
				else {
					echo mysqli_error($conn);
				}
			//}
		
	}
?>