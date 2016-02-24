<?php



Class User {

	function __construct($db=NULL){
		if(is_object($db)){
			$this->_db = $db;
		}else {
			$this->_db = new PDO("mysql:host=localhost:3306;dbname=HearthStone", "root", "root");
		}
	}

	function createAccount($username, $password){
		$sql = "SELECT COUNT(Username) AS Count FROM Users WHERE Username = '$username'";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$row = $stmt->fetch();
			if($row["Count"] != 0) {
				return "This Username is already taken. Try again!";
			}
		}
		$sql = "INSERT INTO Users VALUES (User_ID = User_ID + 1, '$username', '$password')";
		if(!$this->_db->query($sql)){			
			return "An error occured while trying to create your account.";
		} else {
			return "Your account was successfully created!";
		}
	}


}

?>