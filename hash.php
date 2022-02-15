<?php
	function user($id, $email) {	
		if (CRYPT_BLOWFISH == 1) {
			$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
			$salt = base64_encode($email);
			// crypt uses a modified base64 variant
			$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
			$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$salt = strtr(rtrim($salt, '='), $source, $dest);
			$salt = substr($salt, 0, 22);
			// `crypt()` determines which hashing algorithm to use by the form of the salt string
			// that is passed in
			$hashedId = crypt($id, '$2y$10$'.$salt.'$');
			return $hashedId;
		}
	}
?>
<?php
	function crypto($password, $email) {	
		if (CRYPT_BLOWFISH == 1) {
			$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
			$salt = base64_encode($email);
			// crypt uses a modified base64 variant
			$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
			$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$salt = strtr(rtrim($salt, '='), $source, $dest);
			$salt = substr($salt, 0, 22);
			// `crypt()` determines which hashing algorithm to use by the form of the salt string
			// that is passed in
			$hashedPassword = crypt($password, '$2y$10$'.$salt.'$');
			return $hashedPassword;
		}
	}
?>

<?php
	function gid($email) {	
		if (CRYPT_BLOWFISH == 1) {
			$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
			$salt = base64_encode($email);
			// crypt uses a modified base64 variant
			$source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
			$dest = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$salt = strtr(rtrim($salt, '='), $source, $dest);
			$salt = substr($salt, 0, 22);
			// `crypt()` determines which hashing algorithm to use by the form of the salt string
			// that is passed in
			$hashedId = crypt($email, '$2y$10$'.$salt.'$');
			return $hashedId;
		}
	}
?>