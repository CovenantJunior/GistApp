<?php
    if (isset($_COOKIE['user_id'])) {
        require 'db.php';
        $last_id = "SELECT LAST_INSERT_ID(frequency) FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
        $id  = mysqli_query($conn, $last_id);
        $get = mysqli_fetch_array($id);
        $frequency = ($get['0'] + 1)."Hz";
        $sql = "UPDATE users SET frequency = '".$frequency."' WHERE user_id = '".$_COOKIE['user_id']."'";
        $update = mysqli_query($conn, $sql);
    }
?>
<?php
	//Create account action
	if (isset($_POST['create'])) {
		//image
		/*$alt = basename($_FILES['image']['username']);
		$alt = substr_replace($alt, '', -4);
		$image = basename($_FILES['image']['username']);
		$move = move_uploaded_file($_FILES['image']['tmp_name'], 'img/'.$image.'');
	if ($move) {		*/
			require 'db.php';
			//Fname
			$fname = mysqli_real_escape_string($conn, strip_tags($_POST['fname']));

			//Lname
			$lname = mysqli_real_escape_string($conn, strip_tags($_POST['lname']));

			//Email
			$email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));

			//Phone
			$phone = mysqli_real_escape_string($conn, strip_tags($_POST['phone']));

			//Password
			$password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));
			$password = md5($password);
			/*if (CRYPT_BLOWFISH == 1) {
				$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
				$salt = base64_encode($email);
				// crypt uses a modified base64 variant
				$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
				$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$salt = strtr(rtrim($salt, '='), $source, $dest);
				$salt = substr($salt, 0, 22);
				// `crypt()` determines which hashing algorithm to use by the form of the salt string
				// that is passed in
				$password = crypt($password, '$2y$10$'.$salt.'$');
			}*/
			//About
			$about = mysqli_real_escape_string($conn, strip_tags($_POST['about']));


			$last_id = "SELECT LAST_INSERT_ID(id) FROM users ORDER BY id DESC";
			$id  = mysqli_query($conn, $last_id);
			$get = mysqli_fetch_array($id);
			$id = $get['0'];
			$user_id = $get['0'] + 1;
			$user_id = md5($user_id);
			/*if (CRYPT_BLOWFISH == 1) {
				$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
				$salt = base64_encode($email);
				// crypt uses a modified base64 variant
				$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
				$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$salt = strtr(rtrim($salt, '='), $source, $dest);
				$salt = substr($salt, 0, 22);
				// `crypt()` determines which hashing algorithm to use by the form of the salt string
				// that is passed in
				$user_id = crypt($user_id, '$2y$10$'.$salt.'$');										
			}*/
			$sql2 = "SELECT * FROM users WHERE phone = '".$phone."' OR email = '".$email."'";
			$sql1 = "INSERT INTO users (frequency, user_id, image, alt, fname, lname, email, phone, password, about) VALUES ('', '".$user_id."', 'profile.png', 'profile-pic', '".$fname."', '".$lname."', '".$email."', '".$phone."', '".$password."', '".$about."')";
			$sql = "
				  CREATE TABLE IF NOT EXISTS `".$fname."_".$lname."` (
				  frequency varchar(11) NOT NULL,
				  user_id varchar(100) NOT NULL,
				  image varchar(30) NOT NULL,
				  alt varchar(30) NOT NULL,
				  fname varchar(40) NOT NULL,
				  lname varchar(40) NOT NULL,
				  email varchar(100) NOT NULL,
				  phone varchar(15) NOT NULL,
				  password varchar(100) NOT NULL,
				  about varchar(767) NOT NULL,
				  status varchar(15) NOT NULL,
				  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,				  
				  UNIQUE KEY `email` (`email`),
				  UNIQUE KEY `phone` (`phone`)
				);
				";
			$friend_list = "
				  CREATE TABLE IF NOT EXISTS `".$fname."_".$lname."_friend_list` (
				  id int(11) NOT NULL AUTO_INCREMENT,
				  bond varchar(70) NOT NULL,				  
				  fname varchar(40) NOT NULL,
				  lname varchar(40) NOT NULL,
				  email varchar(100) NOT NULL,
				  phone varchar(15) NOT NULL,
				  about varchar(767) NOT NULL,
				  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY(`id`),
				  UNIQUE KEY `bond` (`bond`),
				  UNIQUE KEY `email` (`email`),
				  UNIQUE KEY `phone` (`phone`)
				);
				";
				
							$discussion_list = "
							  CREATE TABLE IF NOT EXISTS `".$fname."_".$lname."_discussion_list` (
							  id int(11) NOT NULL AUTO_INCREMENT,
							  recipient varchar(40) NOT NULL,
							  sender varchar(40) NOT NULL,
							  bond varchar(70) NOT NULL,
							  recipient_name varchar(70) NOT NULL,
							  sender_name varchar(70) NOT NULL,
							  recipient_id varchar(40) NOT NULL,
							  sender_id varchar(40) NOT NULL,
							  message varchar(767) NOT NULL,							  
							  seen int(1) NOT NULL,
							  unseen int(10) NOT NULL,
							  block int(1) NOT NULL,
							  created_at timestamp ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
							  PRIMARY KEY(`id`),
							  UNIQUE KEY `bond` (`bond`)
							);
							";
				
			

			//Insert
			require 'db.php';
			if (mysqli_num_rows(mysqli_query($conn, $sql2)) >= 1) {
			 	echo "Sorry, this account already exists or either this email '".$email."' or phone number '".$phone."' has been used.";
		 	}
		 	else {
				$insert = mysqli_query($conn, $sql1);
				if ($insert == true) {
					global $user_id;
					$create = mysqli_query($conn, $sql);
					if ($create) {
						$data = mysqli_query($conn, "INSERT INTO `".$fname."_".$lname."` (`frequency`, `user_id`, `image`, `alt`, `fname`, `lname`, `email`, `phone`, `password`, `about`) VALUES ('', '".$user_id."', 'profile.png', 'profile-pic', '".$fname."', '".$lname."', '".$email."', '".$phone."', '".$password."', '".$about."');");
						if ($data) {
							$create_list = mysqli_query($conn, $friend_list);
							if ($create_list) {
								$create_list1 = mysqli_query($conn, $discussion_list);
								if ($create_list1) {
									/*if (CRYPT_BLOWFISH == 1) {
										$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
										$salt = base64_encode($email);
										// crypt uses a modified base64 variant
										$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
										$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
										$salt = strtr(rtrim($salt, '='), $source, $dest);
										$salt = substr($salt, 0, 22);
										// `crypt()` determines which hashing algorithm to use by the form of the salt string
										// that is passed in
										$gId = crypt($email, '$2y$10$'.$salt.'$');
									}*/
									setcookie("GID", md5($email), time() + 86400*90, "/");
									setcookie("user_id", $user_id, time() + 86400*90, "/");
									setcookie("handshake", md5($email), time() + 86400*90, "/");
									echo "Success";
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
				}
				else {
					echo mysqli_error($conn);
				}
			
				if ($insert == false) {
					echo mysqli_error($conn);
				}
			}

	}
?>
<?php
	//Login action
	if (isset($_POST['login'])) {

		//Name
		$email = $_POST['email'];
		if ($email == "admin@gmail.com") {
			/*
			echo "<p style='background-color: #2196f3; color: white;'>Please use the official Admin-login form</p>";
			include 'admin-login.php';
			return;
			*/
		}

		//Password
		$password = md5($_POST['password']);
		/*if (CRYPT_BLOWFISH == 1) {
			$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
			$salt = base64_encode($email);
			// crypt uses a modified base64 variant
			$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
			$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$salt = strtr(rtrim($salt, '='), $source, $dest);
			$salt = substr($salt, 0, 22);
			// `crypt()` determines which hashing algorithm to use by the form of the salt string
			// that is passed in
			$password = crypt($password, '$2y$10$'.$salt.'$');
		}*/

		$sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
		require 'db.php';		
		$select = mysqli_query($conn, $sql);
		if ($select) {
			$row = mysqli_num_rows($select);			
			if ($row) {
			$result = mysqli_fetch_array($select);
			$user_id = $result['2'];
			$user_name = $result['5']." ".$result['6'];
			$email = $result['7'];
			setcookie("user_id", $user_id, time() + 86400*90, "/");
			setcookie("handshake", md5($email), time() + 86400*90, "/");
			/*if (CRYPT_BLOWFISH == 1) {
				$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
				$salt = base64_encode($email);
				// crypt uses a modified base64 variant
				$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
				$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$salt = strtr(rtrim($salt, '='), $source, $dest);
				$salt = substr($salt, 0, 22);
				// `crypt()` determines which hashing algorithm to use by the form of the salt string
				// that is passed in
				$gId = crypt($email, '$2y$10$'.$salt.'$');
			}*/
			setcookie("GID", md5($email), time() + 86400*90, "/");
			/*
			if (isset($_GET['ref']) && $_GET['ref'] == 'conversation') {
				session_start();
				if (isset($_COOKIE['drem'])) {
					header('location: keepLoggedIn?uid='.$_COOKIE['user_id'].'&ref='.$_GET['ref'].'');
				}
				else {
					header('location: '.$_GET['ref'].'');
				}
			}
			if (isset($_GET['ref']) && $_GET['ref'] == 'mobile-conversation') {
				session_start();
				if (isset($_COOKIE['drem'])) {
					header('location: keepLoggedIn?uid='.$_COOKIE['user_id'].'&ref='.$_GET['ref'].'');
				}
				else {
					header('location: '.$_GET['ref'].'');
				}
			}
			else {
			*/
				session_start();
				header('location:  home');
			}
		}
		if (mysqli_num_rows($select) == false) {
			echo "<p style='background-color: #2196f3; color: white;'>Error signing you in. You don't have an account.</p>";
			include 'sign-up.php';
		}
		else {
			echo mysqli_error($conn);
		}
	}

?>