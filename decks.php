<?php


include 'inc/header.php';
require_once 'inc/gameClass.php';

if(!empty($_POST["name"]) || !empty($_POST["description"])){
	$name = $_POST["name"];
	$class = $_POST["class"];
	$desc = $_POST["description"];
	$deck = new Game;
	$result = $deck->createDeck($name, $class, $desc);
	echo "<span class='message'>".$result."</span>";
}

?>

<div class="deck_list">
	<table class="display_data">
		<legend>Existing Decks</legend>
		<th>Deck Name</th>
		<th>Deck Class</th>
		<th>Description</th>
		<?php 
			$decks = new Game;
			$decks->getDecksTable();
		?>
	</table>
</div>

<div class="form_container">
	<h3>Want to add a deck to the list? Fill in the form !</h3>

	<form action="decks.php" method="post">
		<label for="name"> Name of the Deck:
			<input type="text" id="name" name="name">
		</label>
		<br><br>
		<span>Class concerned:</span>
			<select name="class">
				<?php 
					$classes = new Game;
					$classes ->getClasses();
				?>
			</select>
			<br><br>
		<textarea name="description" id="description" placeholder="Enter a short description of the deck" rows="10" cols="40"></textarea>
		<br><br>
		<input type="submit" value="Create Deck">
	</form>
</div>

<?php
include 'inc/footer.php';
?>
