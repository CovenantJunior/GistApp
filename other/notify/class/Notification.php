<?php
class Notification {     
    private $conn;
    private $notificationTable = "notifications";     	
    public $id;
    public $title;
    public $message;
    public $ntime;
    public $repeat;
    public $nloop;
    public $publish_date; 
	public $username; 
    
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function listNotification(){
		$stmt = $this->conn->prepare("
			SELECT * 
			FROM ".$this->notificationTable);
		$stmt->execute();			
		$result = $stmt->get_result();
			
		return $result;	
	}	
	
	function getNotificationByUser(){
		$query = "
			SELECT *
			FROM ".$this->notificationTable." 
			WHERE username= ? AND nloop > 0 AND ntime <= CURRENT_TIMESTAMP()";
		$stmt = $this->conn->prepare($query);				
		$stmt->bind_param("s", $this->username);	
		$stmt->execute();		
		$result = $stmt->get_result();		
		return $result;	
	}	
	
	function saveNotification(){	
		$insertQuery = "
			INSERT INTO ".$this->notificationTable."( `title`, `message`, `ntime`, `repeat`, `nloop`, `username`)
			VALUES(?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($insertQuery);			
		$stmt->bind_param("sssiis",$this->title, $this->message, $this->ntime, $this->repeat, $this->nloop, $this->username);
		if($stmt->execute()){
			return true;
		}	 
		return false;				
	}		
	
	function updateNotification() {		
		$updateQuery = "
			UPDATE ".$this->notificationTable." 
			SET ntime= ?, publish_date=CURRENT_TIMESTAMP(), nloop = nloop-1 
			WHERE id= ? ";		
		$stmt = $this->conn->prepare($updateQuery);	 		 
		$stmt->bind_param("si", $this->nexttime, $this->id);		
		if($stmt->execute()){
			return true;
		}	 
		return false;		
	}		
}
?>