<?php
	ini_set('display_errors', 'off');
	if (isset($_FILES)&&isset($_POST['recipient'])) {
		function resizeImage($resourceType,$image_width,$image_height) {
	        if ($image_width>2000) {
		        $resizeWidth = $image_width/5;
		        $resizeHeight = $image_height/5;
		    }
		    elseif ($image_height>=1500) {
		        $resizeWidth = $image_width/4;
		        $resizeHeight = $image_height/4;
		    }
		    elseif ($image_height>=1000) {
		        $resizeWidth = $image_width/3;
		        $resizeHeight = $image_height/3;
		    }
		    elseif ($image_height>=500) {
		        $resizeWidth = $image_width/0.5;
		        $resizeHeight = $image_height/0.5;
		    }
		    else{
		        $resizeWidth = $image_width;
		        $resizeHeight = $image_height;
		    }
	        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
	        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
	        return $imageLayer;
	    }
		//print_r($_FILES);
		$recipient = $_POST['recipient'];
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
				$image = explode('.', basename($_FILES['file']['name']));
				$image = md5(htmlspecialchars($image['0'])).".".$image['1'];
				$fileName = $_FILES['file']['tmp_name'];
				if($sourceProperties = getimagesize($fileName)){
				}
				else{
					echo "Image not sent. Maximum limit of 2M exceeded!";
				}
		        $resizeFileName = time();
		        $size = $_FILES['file']['size']/1000;
		        $uploadPath = 'assets/image/'.$image.'';
		        $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		        $uploadImageType = $sourceProperties[2];
		        $sourceImageWidth = $sourceProperties[0];
		        $sourceImageHeight = $sourceProperties[1];
		        if ($size>250) {
			        switch ($uploadImageType) {
			            case IMAGETYPE_JPEG:
			                $resourceType = imagecreatefromjpeg($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagejpeg($imageLayer,$uploadPath);
			                break;
			 
			            case IMAGETYPE_GIF:
			                $resourceType = imagecreatefromgif($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagegif($imageLayer,$uploadPath);
			                break;
			 
			            case IMAGETYPE_PNG:
			                $resourceType = imagecreatefrompng($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagepng($imageLayer,$uploadPath);
			                break;
			 
			            default:
			                $imageProcess = 0;
			                break;
			        }
			        move_uploaded_file($file, $uploadPath);
			        //if ($move) {
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
				            $sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, image) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$image."')";

				            $sql1 = "INSERT INTO ".$fname."_".$lname."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">image</i>', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">image</i>', seen = 1, unseen = 0";
				            
				            $sql2 = "INSERT INTO ".$reciever['fname']."_".$reciever['lname']."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">image</i>', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">image</i>', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";
				            $insert = mysqli_query($conn, $sql);
				            if ($insert) {
				                $insert1 = mysqli_query($conn, $sql1);
				                if ($insert1) {
				                    $insert2 = mysqli_query($conn, $sql2);
				                    if ($insert2) {
						            	$timestamp = "SELECT * FROM conversation_log WHERE image = '".$image."'";
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
				    //}
					//else {
						//echo mysqli_error($conn);
					//}
		        }
		        else{
		        	move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath);
		        	//if ($move) {
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
				            $sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, image) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$image."')";

				            $sql1 = "INSERT INTO ".$fname."_".$lname."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">image</i>', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">image</i>', seen = 1, unseen = 0";
				            
				            $sql2 = "INSERT INTO ".$reciever['fname']."_".$reciever['lname']."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '<i class=\"material-icons\">image</i>', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '<i class=\"material-icons\">image</i>', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";
				            $insert = mysqli_query($conn, $sql);
				            if ($insert) {
				                $insert1 = mysqli_query($conn, $sql1);
				                if ($insert1) {
				                    $insert2 = mysqli_query($conn, $sql2);
				                    if ($insert2) {
						            	$timestamp = "SELECT * FROM conversation_log WHERE image = '".$image."'";
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
				    //}
					//else {
						//echo mysqli_error($conn);
					//}
		        }
				
		}
		else {
			echo "No picture format";
		}
	}
?>