<?php
	if (isset($_FILES)&&isset($_POST['recipient'])&&isset($_POST['file-name'])&&isset($_POST['file-size'])) {		
		//print_r($_FILES);
		$recipient = $_POST['recipient'];
		$file_name = $_POST['file-name'];
		$file_size = $_POST['file-size'];
		if (isset($_FILES['file']) && ($_FILES['file']['name'] != '')) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		    	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		    	$query = mysqli_query($conn, $sql);
		    	$user = mysqli_fetch_array($query);
	            $user_image = $user['image'];
	            $fname = $user['fname'];
	            $lname = $user['lname'];
	            $user_name = $fname." ".$lname;
	            $sender = $user['email'];
	            $sender_name = $fname."_".$lname;
	            $user_discussion_list = $fname."_".$lname."_discussion_list";
		    	$alt = basename($_FILES['file']['name']);
				$alt = substr_replace($alt, '', -4);
				$file = explode('.', basename($_FILES['file']['name']));
				$file = md5($file['0']).".".$file['1'];
				$move = move_uploaded_file($_FILES['file']['tmp_name'], 'assets/files/'.$file.'');
				if ($move) {
					$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$recipient."'");
			        $reciever = mysqli_fetch_array($query);
			        $reciever_dicussion_list = $reciever['fname']."_".$reciever['lname']."_discussion_list";        
			        $status = $reciever['status'];
			        $get_blocked = "SELECT block FROM ".$user_discussion_list."";
			        $select1 = mysqli_query($conn, $get_blocked);
			        $result1 = mysqli_fetch_array($select1);
			        $blocked = $result1['0'];
			        $bond = [];
			        $bond[] = md5($sender);
			        $bond[] = md5($recipient);
			        sort($bond);
			        $bond = implode('.', $bond);
					if ($blocked == 0) {
			            $notify = "INSERT INTO notifications (title, message, icon, reciever, sender, bond, seen) VALUES ('".$user_name."', '<i class=\"material-icons\">image</i>', '".$user_image."', '".md5($reciever['email'])."', '".$user_name."', '".$bond."', 0) ON DUPLICATE KEY UPDATE title = '".$user_name."', message = 'New messages...', icon = '".$user_image."', sender = '".$user_name."', bond = '".$bond."', seen = 0";
			            $ins = mysqli_query($conn, $notify);
			            $sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, file, file_name, file_size) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$file."', '".$file_name."', $file_size)";

			            $sql1 = "INSERT INTO ".$fname."_".$lname."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">attach_file</i>', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">attach_file</i>', seen = 1, unseen = 0";
			            
			            $sql2 = "INSERT INTO ".$reciever['fname']."_".$reciever['lname']."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">attach_file</i>', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">attach_file</i>', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";
			            $insert = mysqli_query($conn, $sql);
			            if ($insert) {
			                $insert1 = mysqli_query($conn, $sql1);
			                if ($insert1) {
			                    $insert2 = mysqli_query($conn, $sql2);
			                    if ($insert2) {
					            	$timestamp = "SELECT * FROM conversation_log WHERE file = '".$file."'";
									$q = mysqli_query($conn, $timestamp);
									$time = mysqli_fetch_array($q);
						    		$time = date('g:i A', strtotime($time['created_at']));
			                    	echo $time;
			                    }
			                    else {
			                        echo "Error ".mysqli_error($conn);
			                    }
			                }
			                else {
			                    echo "Error ".mysqli_error($conn);
			                }
			            }
			            else {
			                echo "Error ".mysqli_error($conn);
			            }
			        }
			    }
				else {
					echo mysqli_error($conn);
				}
		}
		else {
			echo "No file format";
		}
	}
?>