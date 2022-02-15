<?php
	if (isset($_FILES)) {		
		//print_r($_FILES);
		function resizeImage($resourceType,$image_width,$image_height) {
	        $resizeWidth = 256;
		    $resizeHeight = 256;
	        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
	        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
	        return $imageLayer;
	    }
		if (isset($_FILES['file']) && ($_FILES['file']['name'] != '')) {
		require 'db.php';
		$user_id = $_COOKIE['user_id'];
		    	$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		    	$query = mysqli_query($conn, $sql);
		    	$user = mysqli_fetch_array($query);
		    	$fname = $user['fname'];
 	        	$lname = $user['lname'];
	        	$user_name = $fname."_".$lname;
		    	$alt = basename($_FILES['file']['name']);
				$alt = substr_replace($alt, '', -4);
				$image = explode('.', basename($_FILES['file']['name']));
				$image = strtolower($user_name).".".$image['1'];
				unlink('dist/img/avatars/'.$image.'');
				$fileName = $_FILES['file']['tmp_name'];
				if($sourceProperties = getimagesize($fileName)){
				}
				else{
					echo "Image not sent. Maximum limit of 2M exceeded!";
				}
		        $resizeFileName = time();
		        $size = $_FILES['file']['size']/1000;
		        $uploadPath = 'dist/img/avatars/'.$image.'';
		        $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		        $uploadImageType = $sourceProperties[2];
		        $sourceImageWidth = $sourceProperties[0];
		        $sourceImageHeight = $sourceProperties[1];
		        //if ($size>250) {
			        switch ($uploadImageType) {
			            case IMAGETYPE_JPEG:
			                $resourceType = imagecreatefromjpeg($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagejpeg($imageLayer,$uploadPath.'.'. $fileExt);
			                $move = move_uploaded_file($file, 'dist/img/avatars/'.$image.'');
			                break;
			 
			            case IMAGETYPE_GIF:
			                $resourceType = imagecreatefromgif($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagegif($imageLayer,$uploadPath.'.'. $fileExt);
			                $move = move_uploaded_file($file, 'dist/img/avatars/'.$image.'');
			                break;
			 
			            case IMAGETYPE_PNG:
			                $resourceType = imagecreatefrompng($fileName); 
			                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			                $file = imagepng($imageLayer,$uploadPath.'.'. $fileExt);
			                $move = move_uploaded_file($file, 'dist/img/avatars/'.$image.'');
			                break;
			 
			            default:
			                $imageProcess = 1;
			                break;
			        }
		        //}
		        //else{
		        	//$move = move_uploaded_file($_FILES['file']['tmp_name'], 'dist/img/avatars/'.$image.'');
		       //}
 				if ($move) {
					$sql1 = "UPDATE users SET image = '".$image."', alt = 'profile-pic' WHERE user_id = '".$user_id."'";
					$sql2 = "UPDATE ".$user_name." SET image = '".$image."', alt = 'profile-pic'";
					$update1 = mysqli_query($conn, $sql1);
					$update2 = mysqli_query($conn, $sql2);
					if ($update1&&$update2) {
						echo "Done";
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
			echo "No picture format";
		}
	}
?>