<?php

include 'inc/header.php';
require_once 'inc/gameClass.php';
if(!empty($_POST["user_class"]) && !empty($_POST["opponent_class"]) && !empty($_POST["outcome"])){
	$class_used = $_POST["user_class"];
	$class_opp = $_POST["opponent_class"];
	$outcome = $_POST["outcome"];
	$deck_used = $_POST["deck_used"];
	$user = $_SESSION["username"];
	$game = new Game;
	$result = $game->createGame($class_used, $class_opp, $outcome, $deck_used, $user);
	echo "<span class='message'>".$result."</span>";

}
?>

<div class="form_container">
	<h4>Complete the form to record a game</h4>
	<form action="new_game.php" method="post">
		<span>Your Class: </span>
		<select name="user_class">
			<?php
				$classes = new Game;
				$classes->getClasses();
			?>
		</select>
		<br><br>
		<span>Opponent Class: </span>
		<select name="opponent_class">
			<?php 
				$opp_classes = new Game;
				$opp_classes-> getClasses();
			?>
		</select>
		<br><br>
		<span>Outcome:</span>
		<label for="win">
			<input type="radio" name="outcome" value="win" id="win">Win
		</label>
		<label for="lose">
			<input type="radio" name="outcome" value="lose" id="lose">Lose
		</label>
		<br><br>
		<span>Deck Used:</span>
		<select name="deck_used">
			<?php 
				$decks = new Game;
				$decks->getDecksName();
			?>
		</select>
		<br><br>
		<input type="submit" value="Save Game">
	</form>
</div>




<?php

include 'inc/footer.php';

?>