<?php SESSION_START(); 

include_once 'config/Database.php';
include_once 'class/Notification.php';

$database = new Database();
$db = $database->getConnection();

$notification = new Notification($db);

$array=array(); 
$rows=array(); 
$notification->username = 'webdamn';
$result = $notification->getNotificationByUser(); 
$totalNotification = 0;
while ($userNotification = $result->fetch_assoc()) { 		
 $data['title'] = $userNotification['title'];
 $data['message'] = $userNotification['message'];
 $data['icon'] = 'avatar.png';
 $data['url'] = '/';
 $rows[] = $data;
 $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($userNotification['repeat']*60));
 $notification->nexttime = $nextime;
 $notification->id = $userNotification['id'];
 $notification->updateNotification();
 $totalNotification++;
}
$array['notif'] = $rows;
$array['count'] = $totalNotification;
$array['result'] = true;
echo json_encode($array);
?>