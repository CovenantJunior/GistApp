<?php
	if (isset($_COOKIE['dark'])) {
		setcookie('dark', '', time() - 3600, '/');
		header('location: light://');
	}
	else{
		setcookie('dark', 1, time() + 7200 * 365, '/');
		header('location: dark://');
	}
?>