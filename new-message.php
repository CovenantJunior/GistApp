<?php
	if (isset($_POST['bond'])&&isset($_COOKIE['user_id'])&&isset($_POST['fetch'])&&($_POST['fetch']==true)) {		
		require 'db.php';
		$bond = $_POST['bond'];
		$sql3 = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";
	    $all = mysqli_query($conn, $sql3);
	    $rows = mysqli_num_rows($all);
	    if ($rows >= 20) {
	        $offset = ($rows - 20);
	    }
	    else {
	        $offset = 0;
	    }
	    $count = 20;
	    $sql = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id DESC LIMIT 1";    
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
	            if ($result1['0'] == '') {
					$image = 'profile.png';
				}
				else {
					$image = $result1['0'];
				}
				if ($log['8'] != '') {
	            	$message = "<p id='exec'>".$log['8']."</p>";
	            }
	            else{
	            	if ($log['9'] != '') {
	            		$message = "<p id='exec'><div class'preview'><img src='assets/image/".$log['9']."' style='max-height: 200px;max-width: 250px;aspect-ratio: auto;'></div></p>";
	            	}
	            	else {
	            		if ($log['10'] != '') {
		            		$message = "<p id='exec'><div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a href='assets/files/".$log['10']."'>".$log['11']."</a></h5> <span>".$log['12']."kb Document</span> </div> </div></p>";
		            	}
		            	else {
		            		if ($log['13'] != '') {
			            		$message = "<p id='exec'><audio controls src='assets/audio/".$log['13']."'></audio></p>";
			            	}
			            	else {
			            		$message = '<em><i class="material-icons">block</i> This message was unsent.</em>';
			            	}
		            	}
	            	}
	            }
	            $delete = "onmouseup=\"var audio=document.getElementById('audio2');audio.play();document.getElementById('id01').style.display='block';$('#delete').attr('onclick', 'deleteMessage(".$sender_id.", ".$message_id.")');$('#ans').html('".$message."');\"";
	            if ($user_name == implode(' ', explode('_', $log['5']))) {
	                /*echo "
	                    <div class='message me'>
	                        <div class='text-main'>
	                            <div class='text-group me'>
	                                <div class='text me' ".$delete.">
	                                    ".$message."
	                                </div>
	                            </div>
	                            <span><i class='material-icons'>check</i>".date('g:i A', strtotime($log['14']))."</span>                            
	                        </div>
	                    </div>";*/
	                }
	            else {
	                echo "
	                    <div class='message zoomInLeft'>
	                        <img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".implode(' ', explode('_', $log['5']))."' alt='avatar'>
	                            <div class='text-main'>
	                                <div class='text-group'>
	                                    <div class='text' ".$delete.">
	                                        ".$message."
	                                    </div>
	                                </div>
	                                <span>".date('g:i A', strtotime($log['14']))."</span>
	                            </div>
	                    </div>";
	            }
	                
	        }
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
?>