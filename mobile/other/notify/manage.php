<?php 
SESSION_START(); 
include_once 'config/Database.php';
include_once 'class/Notification.php';
include_once 'class/User.php';
$database = new Database();
$db = $database->getConnection();
$notification = new Notification($db);
$user = new User($db);
include('inc/header.php');
?>
<title>webdamn.com : Demo Build Push Notification System with PHP & MySQL</title>
<?php include('inc/container.php');?>
<style>
.borderless tr td {
    border: none !important;
    padding: 2px !important;
}
</style>
<div class="container">		
	<h2>Example: Push Notification System with PHP & MySQL</h2>	
	<a href="index.php">Home</a> | <a href="logout.php">Logout</a>
	<hr>
	<div class="row">
		<div class="col-sm-6">
			<h3>Add New Notification:</h3>
			<form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>">										
				<table class="table borderless">
					<tr>
						<td>Title</td>
						<td><input type="text" name="title" class="form-control" required></td>
					</tr>	
					<tr>
						<td>Message</td>
						<td><textarea name="message" cols="50" rows="4" class="form-control" required></textarea></td>
					</tr>			
					<tr>
						<td>Broadcast time</td>
						<td><select name="ntime" class="form-control"><option>Now</option></select> </td>
					</tr>
					<tr>
						<td>Loop (time)</td>
						<td><select name="loops" class="form-control">
						<?php 
							for ($i=1; $i<=5 ; $i++) { ?>
								<option value="<?php echo $i ?>"><?php echo $i ?></option>
						<?php } ?>
						</select></td>
					</tr>
					<tr>
						<td>Loop Every (Minute)</td>
						<td><select name="loop_every" class="form-control">
						<?php 
						for ($i=1; $i<=60 ; $i++) { ?>
							<option value="<?php echo $i ?>"><?php echo $i ?></option>
						<?php } ?>
						</select> </td>
					</tr>
					<tr>
						<td>For</td>
						<td><select name="user" class="form-control">
						<?php 		
						$allUser = $user->listAll(); 							
						while ($user = $allUser->fetch_assoc()) { 	
						?>
						<option value="<?php echo $user['username'] ?>"><?php echo $user['username'] ?></option>
						<?php } ?>
						</select></td>
					</tr>
					<tr>
						<td colspan=1></td>
						<td colspan=1></td>
					</tr>					
					<tr>
						<td colspan=1></td>
						<td><button name="submit" type="submit" class="btn btn-info">Add Message</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php 
	if (isset($_POST['submit'])) { 
		if(isset($_POST['message']) and isset($_POST['ntime']) and isset($_POST['loops']) and isset($_POST['loop_every']) and isset($_POST['user'])) {
			$notification->title = $_POST['title'];
			$notification->message = $_POST['message'];
			$notification->ntime = date('Y-m-d H:i:s'); 
			$notification->repeat = $_POST['loops']; 
			$notification->nloop = $_POST['loop_every']; 
			$notification->username = $_POST['user'];	
			if($notification->saveNotification()) {
				echo '* save new notification success';
			} else {
				echo 'error save data';
			}
		} else {
			echo '* completed the parameter above';
		}
	} 
	?>
	<h3>Notifications List:</h3>
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Next Schedule</th>
				<th>Title</th>
				<th>Message</th>
				<th>Remains</th>
				<th>User</th>
			</tr>
		</thead>
		<tbody>
			<?php $notificationCount =1; 
			$notificationList = $notification->listNotification(); 			
			while ($notif = $notificationList->fetch_assoc()) { 	
			?>
			<tr>
				<td><?php echo $notificationCount ?></td>
				<td><?php echo $notif['ntime'] ?></td>
				<td><?php echo $notif['title'] ?></td>
				<td><?php echo $notif['message'] ?></td>
				<td><?php echo $notif['nloop']; ?></td>
				<td><?php echo $notif['username'] ?></td>
			</tr>
			<?php $notificationCount++; } ?>
		</tbody>
	</table>
</div>	
<?php include('inc/footer.php');?>