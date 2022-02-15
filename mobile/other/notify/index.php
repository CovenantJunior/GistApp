<?php 
SESSION_START();
include('inc/header.php');
?>
<title>webdamn.com : Demo Build Push Notification System with PHP & MySQL</title>
<script src="js/notification.js"></script>
<?php include('inc/container.php');?>
<div class="container">		
	<h2>Example: Build Push Notification System with PHP & MySQL</h2>	
	<h3>User Account </h3>
	<?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') { ?>
		<a href="manage.php">Manage Notification</a> | 
	<?php } ?>
	<?php if(isset($_SESSION['username']) && $_SESSION['username']) { ?>
		Logged in : <strong><?php echo $_SESSION['username']; ?></strong> | <a href="logout.php">Logout</a>
	<?php } else { ?>
		<a href="login.php">Login</a>
	<?php } ?>
	<hr> 
	<?php if (isset($_SESSION['username']) && $_SESSION['username']) { ?>
		<div <?php if($_SESSION['username'] != 'admin') { ?> id="loggedIn" <?php } ?>>
			<h4>
				You're welcome! You can manage 
			</h4>
		</div>
	<?php } ?>	
	
</div>	
<?php include('inc/footer.php');?>






