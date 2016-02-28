<?php




Class User {

	private $_db;

	function __construct($db=NULL){
		if(is_object($db)){
			$this->_db = $db;
		}else {
			$this->_db = new PDO("mysql:host=localhost:3306;dbname=HearthStone", "root", "root");
		}
	}

	function createAccount($u, $email, $password){
		$sql = "SELECT COUNT(Username) AS theCount
				FROM Users
				WHERE Username=:email";
		if($stmt = $this->_db->prepare($sql)) {
			$stmt->bindParam(":email", $u, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			if($row['theCount'] != 0) {
				return "<span class='message'> Error! This username is already taken. Please try again.</span>";
			}
		}
		$stmt->closeCursor();

		$sql = "INSERT INTO Users VALUES (User_ID = User_ID + 1, '$u', '$password', '$email')";
		if(!$this->_db->query($sql)){
			return "<span class='message'> Error! We couldn't create your account. Sorry for the inconvenience. Try again later.</span>";
		} else {
			session_destroy();
			session_start();
			$_SESSION["loggedIn"] = TRUE;
			$_SESSION["username"] = $u;
			return "<span class='message'> Your account was successfully created!!</span>";
		}
		
	}

	function verifyLogIn($username, $password){
		$sql = "SELECT COUNT(*) AS theCount FROM Users WHERE Username = '$username' AND Password = '$password'";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$row = $stmt->fetch();
			if($row["theCount"] != 1){
				return "<span class='message'>Wrong password and/or username.</span>";
			} else {
				session_destroy();
				session_start();
				$_SESSION["username"] = $username;
				$_SESSION["loggedIn"] = TRUE;
				echo "<span class='message'>Welcome back! You are connected as ".$username."</span>";
				header("location:/index.php");
			}
		}
	}


	function getStatsClass($filter_cl, $user_id){
		$sql_classes = "SELECT Class_Name FROM Classes";
		$get_classes = $this->_db->prepare($sql_classes);
		$get_classes->execute();
		$classes = $get_classes->fetchAll(PDO::FETCH_ASSOC);

		foreach($classes as $class) {
			$sql_games_played = "SELECT COUNT(*) AS Games_Played FROM Games WHERE Class_Used = '$filter_cl' AND Class_Opp = '$class[Class_Name]' AND User_Id = '$user_id'";
			$sql_games_won = "SELECT COUNT(*) AS Games_Won FROM Games WHERE Class_Used = '$filter_cl' AND Outcome = 'win' AND Class_Opp = '$class[Class_Name]' AND User_Id = '$user_id'";
			$number_games = $this->_db->prepare($sql_games_played);
			$number_games->execute();
			$row = $number_games->fetch();
			$games_played =  $row["Games_Played"];


			$won = $this->_db->prepare($sql_games_won);
			$won->execute();
			$row = $won->fetch();
			$games_won = $row["Games_Won"];
			echo "vs ".$class["Class_Name"]." , Played " . $games_played . " and won ". $games_won . "<br>";
		}



		//$wins_percent = $games_won / $games_played * 100;
		//return $results = [$games_played, $games_won, $wins_percent];
	}

	function getStatsDeck($filter_deck, $user_id){

		$sql_classes = "SELECT Class_Name FROM Classes";
		$get_classes = $this->_db->prepare($sql_classes);
		$get_classes->execute();
		$classes = $get_classes->fetchAll(PDO::FETCH_ASSOC);

		foreach($classes as $class){
			$sql_games_played = "SELECT COUNT(*) AS Games_Played FROM Games WHERE Deck_Used = '$filter_deck' AND Class_Opp = '$class[Class_Name]' AND User_Id = '$user_id'";
			$sql_games_won = "SELECT COUNT(*) AS Games_Won FROM Games WHERE Deck_Used = '$filter_deck' AND Class_Opp = '$class[Class_Name]' AND Outcome = 'win' AND User_Id = '$user_id'";
			$number_games = $this->_db->prepare($sql_games_played);
			$number_games->execute();
			$row = $number_games->fetch();
			$games_played =  $row["Games_Played"];


			$won = $this->_db->prepare($sql_games_won);
			$won->execute();
			$row = $won->fetch();
			$games_won = $row["Games_Won"];
			echo "vs ".$class["Class_Name"]." , Played " . $games_played . " and won ". $games_won . "<br>";
		}
			//$wins_percent = $games_won / $games_played * 100;
			//return $results = [$games_played, $games_won, $wins_percent];

	}


	function getStatsDeckAndClass($filter_cl, $filter_deck, $user_id){

		$sql_classes = "SELECT Class_Name FROM Classes";
		$get_classes = $this->_db->prepare($sql_classes);
		$get_classes->execute();
		$classes = $get_classes->fetchAll(PDO::FETCH_ASSOC);


		foreach($classes as $class){
			$sql_games_played = "SELECT COUNT(*) AS Games_Played FROM Games WHERE Deck_Used = '$filter_deck' AND Class_Used = '$filter_cl' AND Class_Opp = '$class[Class_Name]' AND User_Id = '$user_id'";
			$sql_games_won = "SELECT COUNT(*) AS Games_Won FROM Games WHERE Deck_Used = '$filter_deck' AND Class_Used = '$filter_cl' AND Class_Opp = '$class[Class_Name]'  AND Outcome = 'win' AND User_Id = '$user_id'";
			$number_games = $this->_db->prepare($sql_games_played);
			$number_games->execute();
			$row = $number_games->fetch();
			$games_played =  $row["Games_Played"];


			$won = $this->_db->prepare($sql_games_won);
			$won->execute();
			$row = $won->fetch();
			$games_won = $row["Games_Won"];
			echo "vs ".$class["Class_Name"]." , Played " . $games_played . " and won ". $games_won . "<br>";

		}
	//	$wins_percent = $games_won / $games_played * 100;
	//	return $results = [$games_played, $games_won, $wins_percent];

	}

	function getUserId($username){
		$sql = "SELECT User_Id AS theId FROM Users WHERE Username = '$username'";
		if($stmt = $this->_db->prepare($sql)){
			$stmt->execute();
			$id = $stmt->fetch();
			$user_id = $id["theId"];
			return $user_id;
		}
	}


}

?>