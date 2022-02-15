 <?php
	if (isset($_POST['bond'])&&isset($_COOKIE['user_id'])&&isset($_POST['fetch'])&&($_POST['fetch']==true)) {
		ini_set('display_errors', 'off');		
		require 'db.php';
		$bond = $_POST['bond'];
		$sql3 = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";
	    $all = mysqli_query($conn, $sql3);
		$rows = mysqli_num_rows($all);
		if ($rows > 20) {
			$offset = $rows - 20;
		    setcookie('G-L-OFFSET', $offset, time()+86400, '/');
		}
		else{
			$offset = 0;
			setcookie('G-L-OFFSET', 0, time()+86400, '/');
		}
	    $count = 20;
	    $sql = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC LIMIT ".$offset.",".$count."";    
	    $select = mysqli_query($conn, $sql);
	    $user_id = $_COOKIE['user_id'];
	    $sql1 = "SELECT * FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
	    $query = mysqli_query($conn, $sql1);
	    $user = mysqli_fetch_array($query);
	    $user_image = $user['image'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $user_name = $fname." ".$lname;
	    $logs  = mysqli_fetch_all($select);
	    if (mysqli_num_rows($select) > 0) {
	        foreach ($logs as $log) {           	            
	            	$sender_id = "\'".$log['7']."\'";
	            	$message_id = $log['0'];
	                
	            $img = "SELECT image FROM users WHERE user_id = '".$log['7']."'";
	            $select1 = mysqli_query($conn, $img);
	            $result1 = mysqli_fetch_array($select1);
	            $delete = "onmouseup=\"\"";
	            if ($result1['0'] == '') {
					$image = 'profile.png';
				}
				else {
					$image = $result1['0'];
				}
				if ($log['8'] != '') {
	            	$message = "<div class='text me' ".$delete."><p id='exec'>".$log['8']."</p></div>";
	            }
	            else{
	            	if ($log['9'] != '') {
	            		$message = "<div class='text' ".$delete." style='background: transparent;background-image: url(loader.gif); background-repeat: no-repeat; background-position-y: center; background-position-x: center;'><p id='exec'><div class'preview'><img src='assets/image/".$log['9']."' style='max-height: 200px;max-width: 250px;aspect-ratio: auto;border-radius:10px;'></div></p></div>";;
	            	}
	            	else {
	            		if ($log['10'] != '') {
		            		$message = "<div class='text me' ".$delete."><p id='exec'><div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a target='_blank' href='assets/files/".$log['10']."'>".$log['11']."</a></h5> <span>".$log['12']."kb Document</span> </div> </div></p></div>";;
		            	}
		            	else {
		            		if ($log['13'] != '') {
			            		$message = "<div class='text me' ".$delete."><p id='exec'><audio controls src='assets/audio/".$log['13']."'></audio></p></div>";;
			            	}
			            	else {
			            		$message = "<div class='text me' ".$delete."><p><em><i class='material-icons'>block</i> This message was unsent.</em></p></div>";
			            	}
		            	}
	            	}
	            }
	            if ($user_name == implode(' ', explode('_', $log['5']))) {
	                echo "
	                    <div class='message me zoomInLeft'>
	                        <div class='text-main'>
	                            <div class='text-group me'>
	                                
	                                    ".$message."
	                                
	                            </div>
	                            <span><i class='material-icons'>check</i>".date('g:i A', strtotime($log['14']))."</span>                            
	                        </div>
	                    </div>";
	                }
	            else {
	                echo "
	                    <div class='message zoomInRight'>
	                        <img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".implode(' ', explode('_', $log['5']))."' alt='avatar'>
	                            <div class='text-main'>
	                                <div class='text-group'>
	                                        
	                                    <div class='you'>".$message."</div>

	                                </div>
	                                <span>".date('g:i A', strtotime($log['14']))."</span>
	                            </div>
	                    </div>";
	            }
	                
	        }
	        setcookie('G-L-ROW', $rows, time()+86400, '/');
	    }
	    else {
	        echo "
	        					<div class='content empty'>
									<div class='container'>
										<div class='col-md-12'>
											<div class='no-messages'>
												<i class='material-icons md-48'>forum</i>
												<p>Seems people are shy to start the chat. Break the ice send the first message.</p>
											</div>
										</div>
									</div>
								</div>";
	    }
	}
	if (isset($_POST['offset'])&&isset($_COOKIE['user_id'])&&($_POST['offset']==true)) {
		ini_set('display_errors', 'off');	
		require 'db.php';
		$bond = $_POST['bond'];
		$sql3 = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";
	    $all = mysqli_query($conn, $sql3);
		$rows = mysqli_num_rows($all);
		if (isset($_COOKIE['G-L-OFFSET'])) {
			$off = intval($_COOKIE['G-L-OFFSET']);
			//$row = intval($_COOKIE['G-L-ROW']);
			if ($off >= 20) {
				$offset = $off - 20;
				setcookie('G-L-OFFSET', $off - 20, time()+86400, '/');
				$count = 20;
			}
			else{
				$offset = 0;
				setcookie('G-L-OFFSET', 0, time()+86400, '/');
				$count = $off;
			}
		}
		else{
			echo ""; exit();
		}
	    $sql = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC LIMIT ".$offset.",".$count."";
	    $select = mysqli_query($conn, $sql);
	    $user_id = $_COOKIE['user_id'];
	    $sql1 = "SELECT * FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
	    $query = mysqli_query($conn, $sql1);
	    $user = mysqli_fetch_array($query);
	    $user_image = $user['image'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $user_name = $fname." ".$lname;
	    $logs  = mysqli_fetch_all($select);
	    if (mysqli_num_rows($select) > 1) {
	        foreach ($logs as $log) {           	            
	            	$sender_id = "\'".$log['7']."\'";
	            	$message_id = $log['0'];
	                
	            $img = "SELECT image FROM users WHERE user_id = '".$log['7']."'";
	            $select1 = mysqli_query($conn, $img);
	            $result1 = mysqli_fetch_array($select1);
	            if ($result1['0'] == '') {
					$image = 'profile.png';
				}
				else {
					$image = $result1['0'];
				}
				if ($log['8'] != '') {
	            	$message = "<div class='text me' ".$delete."><p id='exec'>".$log['8']."</p></div>";
	            }
	            else{
	            	if ($log['9'] != '') {
	            		$message = "<div class='text' ".$delete." style='background: transparent;background-image: url(loader.gif); background-repeat: no-repeat; background-position-y: center; background-position-x: center;'><p id='exec'><div class'preview'><img src='assets/image/".$log['9']."' style='max-height: 200px;max-width: 250px;aspect-ratio: auto;border-radius:10px;'></div></p></div>";;
	            	}
	            	else {
	            		if ($log['10'] != '') {
		            		$message = "<div class='text me' ".$delete."><p id='exec'><div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a target='_blank' href='assets/files/".$log['10']."'>".$log['11']."</a></h5> <span>".$log['12']."kb Document</span> </div> </div></p></div>";;
		            	}
		            	else {
		            		if ($log['13'] != '') {
			            		$message = "<div class='text me' ".$delete."><p id='exec'><audio controls src='assets/audio/".$log['13']."'></audio></p></div>";;
			            	}
			            	else {
			            		$message = "<div class='text me' ".$delete."><p><em><i class='material-icons'>block</i> This message was unsent.</em></p></div>";
			            	}
		            	}
	            	}
	            }
	            $delete = "onmouseup=\"\"";
	            if ($user_name == implode(' ', explode('_', $log['5']))) {
	                echo "
	                    <div class='message me zoomInLeft'>
	                        <div class='text-main'>
	                            <div class='text-group me'>

	                                    ".$message."

	                            </div>
	                            <span><i class='material-icons'>check</i>".date('g:i A', strtotime($log['14']))."</span>                            
	                        </div>
	                    </div>";
	                }
	            else {
	                echo "
	                    <div class='message zoomInRight'>
	                        <img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".implode(' ', explode('_', $log['5']))."' alt='avatar'>
	                            <div class='text-main'>
	                                <div class='text-group'>

	                                        <div class='you'>".$message."</div>

	                                </div>
	                                <span>".date('g:i A', strtotime($log['14']))."</span>
	                            </div>
	                    </div>";
	            }
	                
	        }
	    }
	    else {
	        echo "";
	    }
	}
?>