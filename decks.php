<?php

require_once('database.php');
include 'inc/header.php';


?>

<h3>Want to add a deck to the list? Fill in the form !</h3>

<form action="decks.php" method="post">
	<label for="name"> Name of the Deck:
		<input type="text" id="name" name="name">
	</label>
	<br><br>
	<p>Class concerned:</p>
		<select>
			<?php 
				foreach($classes as $class) {
					echo "<option name='" .$class["Class_Name"]."'>".$class["Class_Name"]."</option>";
				}
			?>
		</select>
	<textarea name="description" id="description" placeholder="Enter a short description of the deck" rows="10" cols="40"></textarea>
</form>
