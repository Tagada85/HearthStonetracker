<?php

include 'inc/header.php';

include 'inc/gameClass.php';






?>

<form class="form_container" action="stats.php" method="post">
	<h5>Filters:</h5>
	<span>By Class: </span>
	<select name="class_filter">
		<option disabled selected>-- Select a Class --</option>
		<?php 
			$classes_filter = new Game;
			$classes_filter->getClasses();
		?>
	</select>
	<br><br>
	<span>By Deck:</span>
	<select name="deck_filter">
		<option disabled selected>-- Select a Deck --</option>
		<?php 
			$deck_filter = new Game;
			$deck_filter->getDecksName();
		?>
	</select>
	<br><br>
	<input type="submit" value='GO'>
</form>

<?php

if(!empty($_POST["class_filter"]) && !empty($_POST["deck_filter"])){
	$filter_cl = $_POST["class_filter"];
	$filter_deck = $_POST["deck_filter"];
	$user_stats = new User;
	$display = $user_stats->getStatsDeckAndClass($filter_cl, $filter_deck);
}
else if(!empty($_POST["class_filter"]) ){
	 $filter_cl = $_POST["class_filter"];
	 $filter_deck = "";
	 $user_stats = new User;
	 $display = $user_stats->getStatsClass($filter_cl);


} else if(!empty($_POST["deck_filter"])){
	 $filter_deck = $_POST["deck_filter"];
	 $user_stats = new User;
	 $display = $user_stats->getStatsDeck($filter_deck);

} else {
	$filter_cl = "";
	$filter_deck = "";
	$display = [0, 0, 0];
}



?>



<?php

include 'inc/footer.php';

?>