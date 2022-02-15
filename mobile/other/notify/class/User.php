<?php
class User { 
    
    private $conn;
    private $userTable = "notification_user"; 
   	public $id;
    public $username;
    public $password;   
    
    public function __construct($db){
        $this->conn = $db;
    }	
		
	function listAll(){		
		$stmt = $this->conn->prepare("
			SELECT * FROM ".$this->userTable." 
			WHERE username != 'admin'");
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}	
	
	function login (){		
		$stmt = $this->conn->prepare("
			SELECT id as userid, username, password 
			FROM ".$this->userTable." 
			WHERE username = ? AND password = ? ");
		$stmt->bind_param("ss", $this->username, $this->password);	
		$stmt->execute();
		$result = $stmt->get_result();		
		return $result;			
	}
}
?>