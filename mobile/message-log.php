<?php if (isset($_POST['fetch']) && ($_POST['fetch'] == true) && isset($_COOKIE['user_id']) && isset($_COOKIE['GID']) && isset($_COOKIE['handshake'])) : ?>
<?php
    if (isset($_COOKIE['user_id'])) {
        require 'db.php';
        $user_id = $_COOKIE['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $user = mysqli_fetch_array($query);
            $user_image = $user['image'];
            $fname = $user['fname'];
            $lname = $user['lname'];
            $user_name = $fname." ".$lname;
            $sender_name = $fname."_".$lname;
            $user_discussion_list = $fname."_".$lname."_discussion_list";
            // Starting the session
            session_start();
            // Storing the value in session
            $_SESSION['user_name'] = $user_name;
            session_write_close();
        }
        else {
            echo "Error".mysqli_error($conn);
        }
    }
    else {
        header('location: login');
    }
?>
<?php
    if (isset($_POST['message']) && (trim($_POST['message']) !== "") && ($_POST['message'] != false) && isset($_POST['recipient']) && isset($_POST['sender'])) {
        require 'db.php';
        global $user_name;
        $message = htmlspecialchars($_POST['message']);
        $message = mysqli_real_escape_string($conn, $message);
        $sender = $_POST['sender'];
        $recipient = $_POST['recipient'];
        $bond = [];
        $bond[] = md5($sender);
        $bond[] = md5($recipient);
        sort($bond);
        $bond = implode('.', $bond);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$recipient."'");
        $reciever = mysqli_fetch_array($query);
        $reciever_dicussion_list = $reciever['fname']."_".$reciever['lname']."_discussion_list";        
        $status = $reciever['status'];
        $get_blocked = "SELECT block FROM ".$user_discussion_list."";
        $select1 = mysqli_query($conn, $get_blocked);
        $result1 = mysqli_fetch_array($select1);
        $blocked = $result1['0'];
        if ($blocked == 0) {
            $notify = "INSERT INTO notifications (title, message, icon, reciever, sender, bond, seen) VALUES ('".$user_name."', '".substr_replace($message, '...', 40)."', '".$user_image."', '".md5($reciever['email'])."', '".$user_name."', '".$bond."', 0) ON DUPLICATE KEY UPDATE title = '".$user_name."', message = 'New messages...', icon = '".$user_image."', sender = '".$user_name."', bond = '".$bond."', seen = 0";
            $ins = mysqli_query($conn, $notify);        
            $sql = "INSERT INTO conversation_log (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$message."')";

            $sql1 = "INSERT INTO ".$fname."_".$lname."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$message."', 1, 0) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 1, unseen = 0";
            
            $sql2 = "INSERT INTO ".$reciever['fname']."_".$reciever['lname']."_discussion_list (recipient, sender, bond, recipient_name, sender_name, recipient_id, sender_id, message, seen, unseen) VALUES ('".$recipient."', '".$sender."', '".$bond."', '".$reciever['fname']."_".$reciever['lname']."', '".$sender_name."', '".$reciever['user_id']."', '".$user_id."', '".$message."', 0, LAST_INSERT_ID(unseen)+1) ON DUPLICATE KEY UPDATE recipient = '".$recipient."', sender = '".$sender."', recipient_name = '".$reciever['fname']."_".$reciever['lname']."', sender_name = '".$sender_name."', recipient_id = '".$reciever['user_id']."', sender_id = '".$user_id."', message = '".$message."', seen = 0, unseen = LAST_INSERT_ID(unseen)+1";


            $insert = mysqli_query($conn, $sql);
            if ($insert) {
                $insert1 = mysqli_query($conn, $sql1);
                if ($insert1) {
                    $insert2 = mysqli_query($conn, $sql2);
                    if ($insert2) {
                        $timestamp = "SELECT * FROM conversation_log WHERE message = '".$message."' ORDER BY id DESC LIMIT 1";
                        $q = mysqli_query($conn, $timestamp);
                        $time = mysqli_fetch_array($q);
                        $time = date('g:i A', strtotime($time['created_at']));
                        $sql3 = "SELECT * FROM conversation_log WHERE `bond` = '".$bond."' ORDER BY id ASC";
                        $all = mysqli_query($conn, $sql3);
                        $rows = mysqli_num_rows($all);
                        setcookie('G-L-ROW', $rows, time()+86400, '/');
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
    /*
    if (isset($_POST['like']) && ($_POST['like'] !== "") && ($_POST['like'] !== undefined)) {
        global $user_name;
        $message = "<br><img src='fonts/like.svg' style='height: 50px; width: 50px; margin-left: 35px; margin-bottom: 10px;'><br>";
        $message = mysqli_real_escape_string($conn, $message);
        $sql = "INSERT INTO conversation_log (user_id, user_name, message) VALUES ('".$user_id."', '".$user_name."', '".$message."')";
        require 'db.php';
        $insert = mysqli_query($conn, $sql);
        if ($insert == true) {
            
        }
        else {
            echo "Error ".mysqli_error($conn);
        }
    }
    */
?>
<?php
/*
    global $bond;
    $sql3 = "SELECT * FROM conversation_log WHERE (`bond` LIKE '%".$bond."%') ORDER BY id ASC";
    $all = mysqli_query($conn, $sql3);
    $rows = mysqli_num_rows($all);
    if ($rows >= 20) {
        $offset = ($rows - 20);
    }
    else {
        $offset = 0;
    }
    $count = 20;
    $sql1 = "SELECT * FROM conversation_log WHERE (`bond` LIKE '%".$bond."%') ORDER BY id ASC LIMIT ".$offset.",".$count."";
    $select1 = mysqli_query($conn, $sql1);
    $sql2 = "SELECT * FROM users WHERE user_id = '".$_COOKIE['user_id']."'";
    $select2 = mysqli_query($conn, $sql2);
    $result2 = mysqli_fetch_array($select2);    

    $user_id = $_COOKIE['user_id'];
    if (mysqli_num_rows($select1) > 0) {
        $logs  = mysqli_fetch_all($select1);
        foreach ($logs as $log) {           
            if (($_COOKIE['user_id'] == $log['7']) || ($_COOKIE['user_id'] == "c4ca4238a0b923820dcc509a6f75849b")) {
                $delete = "onmouseup=\"var audio=document.getElementById('audio2');audio.play();del=confirm('Do you want to delete this message?');setTimeout(del,2000);if(del==true){\$.ajax({url : 'delete-message', type : 'POST', data : {'delete' : true, 'sender_id' : '".$log['7']."', 'message_id' : '".$log['0']."'}, cache : false, success: function (data) {console.log('Deleted'); }, error: function (data) {alert('Not deleted'); } }); } \"";
            }
            else {
                $delete = "";
            }
            $img = "SELECT image FROM users WHERE user_id = '".$log['7']."'";
            $select1 = mysqli_query($conn, $img);
            $result1 = mysqli_fetch_array($select1);
            $image = $result1['0'];
            if ($user_name == implode(' ', explode('_', $log['5']))) {
                echo "
                    <div class='message me'>
                        <div class='text-main'>
                            <div class='text-group me'>
                                <div class='text me' ".$delete.">
                                    <p>".$log['8']."</p>
                                </div>
                            </div>
                            <span>".date('g:i A', strtotime($log['9']))."</span>                            
                        </div>
                    </div>";
                }
            else {
                echo "
                    <div class='message'>
                        <img class='avatar-md' src='dist/img/avatars/".$image."' data-toggle='tooltip' data-placement='top' title='".implode(' ', explode('_', $log['5']))."' alt='avatar'>
                            <div class='text-main'>
                                <div class='text-group'>
                                    <div class='text' ".$delete.">
                                        <p>".$log['8']."</p>
                                    </div>
                                </div>
                                <span>".date('g:i A', strtotime($log['9']))."</span>
                            </div>
                    </div>";
            }
                
        }
    }
    else {
        echo "<div class='content empty'> <div class='container'> <div class='col-md-12'> <div class='no-messages'> <i class='material-icons md-48'>forum</i> <p>Seems people are shy to start the chat. Break the ice send the first message.</p> </div> </div> </div> </div>";
    }
*/
?>
<?php
/*
    require 'db.php';
    if (isset($_GET['offset'])) {
        $sql3 = "SELECT * FROM conversation_log";
        $offset = $_GET['offset'] + 5;
        $sql3 = "SELECT * FROM conversation_log";
        $all = mysqli_query($conn, $sql3);
        if ($offset >= mysqli_num_rows($all)) {
            echo "";
        }
        elseif ($offset >= $offset2) {
            echo "<div><p style='text-align: center'><a href='message-log.php?next_section=".$offset."'>See more messages<br><img src='fonts/chevron-down.svg'></a></p></div><br>";
                }
    }

    if (isset($_GET['next_section'])) {
        $sql3 = "SELECT * FROM conversation_log";
        $offset = $_GET['next_section'] + 5;
        $sql3 = "SELECT * FROM conversation_log";
        $all = mysqli_query($conn, $sql3);
        if ($offset >= mysqli_num_rows($all)) {
            echo "";
        }
        elseif ($offset >= $offset2) {
            echo "<br><div><p style='text-align: center'><a href='message-log.php?next_section=".$offset."'>See more messages<br><img src='fonts/chevron-down.svg'></a></p></div><br>";
                }
    }
    */
?>
<!--<script type="text/javascript">
            $('input.previous').on('click', function () {
                var offset = $('input.previous').attr('id');
                $.ajax({
                    url: 'message-log.php',
                    type: 'GET',
                    data: {'offset': offset},
                    success: function (data) {
                         console.log(offset);
                        $("#message-box").animate({ scrollTop: 0 }, 600);
                        }

                })
            });
</script>-->
<?php else: echo "<p style='text-align: center'><img src='favicon.png' width='100px' height='100px'><br><br><a href='sign-in' style='text-decoration:underline;'><em>Sign in</em></a> to continue</p>"; ?>
<?php endif; ?>