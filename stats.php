<?php

include 'inc/header.php';

include 'inc/gameClass.php';


//delete games
if(isset($_POST["delete"])){
	require_once('inc/usersClass.php');
	$deleting = new User;
	$username = $_SESSION['username'];
	$user_id = $deleting->getUserId($username);
	$deleting->deleteGames($user_id);
	echo "<span class='message'>Games Deleted!</span>";
}



?>
<div class="message_container"></div>
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

<form method="POST" action="#">
	<input type="hidden" name="delete">
	<input type="submit" value="Reset Games" name="Delete" class="danger"> 
</form>

<table class="display_data">
	<thead>
		<th>Against</th>
		<th>Games Played</th>
		<th>Games Won</th>
		<th>Games Lost</th>
		<th>% of Wins</th>
	</thead>
<?php

if(!empty($_POST["class_filter"]) && !empty($_POST["deck_filter"])){
	$filter_cl = $_POST["class_filter"];
	$filter_deck = $_POST["deck_filter"];
	$user_stats = new User;
	$id = $user_stats->getUserId($_SESSION["username"]);
	$display = $user_stats->getStatsDeckAndClass($filter_cl, $filter_deck, $id);
}
else if(!empty($_POST["class_filter"]) ){
	 $filter_cl = $_POST["class_filter"];
	 $filter_deck = "";
	 $username = $_SESSION["username"];
	 $user_stats = new User;
	 $id = $user_stats->getUserId($username);
	 $display = $user_stats->getStatsClass($filter_cl, $id);


} else if(!empty($_POST["deck_filter"])){
	 $filter_deck = $_POST["deck_filter"];
	 $user_stats = new User;
	 $id = $user_stats->getUserId($_SESSION["username"]);
	 $display = $user_stats->getStatsDeck($filter_deck, $id);

} else {
	$filter_cl = "";
	$filter_deck = "";
	$display = [0, 0, 0];
}



?>

</table>
	
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
	

	$(".danger").click(function(e){
		var result = confirm('Are you sure? This will delete all your recorded games!');
		if(result == false) {
			e.preventDefault();
		}
	});


</script>






<?php

include 'inc/footer.php';

?>