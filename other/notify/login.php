<?php 
ob_start();
SESSION_START();
$message = '';
if (!empty($_POST['username']) && !empty($_POST['password'])) {
	
	include_once 'config/Database.php';
	include_once 'class/User.php';

	$database = new Database();
	$db = $database->getConnection();
	$user = new User($db);

	$user->username = $_POST['username'];
    $user->password = $_POST['password'];	
	
	if($user->login()) {
		$_SESSION['username'] = $user->username;
		header("Location:index.php");
	} else {
		$message = "Invalid username or password!";
	}
}
include('inc/header.php');
?>
<title>webdamn.com : Demo Build Push Notification System with PHP & MySQL</title>
<?php include('inc/container.php');?>
<div class="container">		
	<h2>User Login:</h2>
	<div class="row">
		<div class="col-sm-4">
			<form method="post">
				<div class="form-group">
				<?php if ($message ) { ?>
					<div class="alert alert-warning"><?php echo $message; ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="username" class="form-control" name="username" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password" required>
				</div>  
				<button type="submit" name="login" class="btn btn-default">Login</button>
			</form><br>
			
			<strong>Administrator login to create push notification and assign to user:</strong><br>
			<strong>username:</strong> admin <br>
			<strong>Pass:</strong> 12345
			<br><br>
			<strong>user login details:</strong><br>
			<strong>username:</strong> webdamn <br>
			<strong>Pass:</strong> 12345			
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>






