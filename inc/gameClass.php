<?php




Class Game {
	function __construct($db=NULL){
		if(is_object($db)){
			$this->_db = $db;
		}else {
			$this->_db = new PDO("mysql:host=localhost:3306;dbname=HearthStone", "root", "root");
		}
	}
		function createDeck($name, $class, $desc){
		$sql = "SELECT COUNT(Deck_Name) AS Count FROM Decks WHERE Deck_Name = '$name'";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$row = $stmt->fetch();
			if($row["Count"]!= 0){
				return "This name is already used for an other deck. Please choose a different one";
			}
		}
		$sql = "INSERT INTO Decks VALUES (Deck_ID = Deck_ID + 1, '$name', '$class', '$desc')";
		if(!$this->_db->query($sql)){
			return "Sorry, an error occured. Your deck could not be written in the database.";
		} else {
			return "Your deck was successfully created!";
		}
	}

	function getClasses(){
		$sql = "SELECT Class_Name FROM Classes";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $row){
				echo "<option>".$row["Class_Name"] . "</option>";
			}
		} 
	}

	function getDecksTable(){
		$sql = "SELECT Deck_Name, Deck_Class, Description FROM Decks";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $row){
				echo "<tr><td>".$row["Deck_Name"] . "</td><td>" . $row["Deck_Class"]. "</td><td>" . $row["Description"]."</td></tr>";
			}
		}
	}

	function getDecksName(){
		$sql = "SELECT Deck_Name FROM Decks";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $row) {
				echo '<option>'.$row["Deck_Name"]."</option>";
			}
		}
	}

	function createGame($class_used, $class_opp, $outcome, $deck_used){
		
		$sql = "SELECT Deck_Class FROM Decks WHERE Deck_Name = '$deck_used'";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$deck_class = $stmt->fetch();
			$deck = $deck_class["Deck_Class"];
			
		}

		if($deck != $class_used) {
			return "The deck you choosed doesn't match the class you played. Try again or enter a new deck first.";
		}

		$sql = "INSERT INTO Games VALUES (Game_ID = Game_ID + 1, '$class_used', '$deck_used',
			'$class_opp', '$outcome')";
		if(!$stmt = $this->_db->query($sql)){
			return "There was an error. Please try again.";
		} else {
			return "The game was successfully added!";
		}
	} 

}



?>