<?php

include 'inc/header.php';

?>

<h3>Welcome to HearthStone Tracker</h3>
<p>This application records your HearthStone games. It was created with HTML, Sass, PHP and mySQL.<br>
You can check my gitHub for the code. 
<?php 
	if(!isset($_SESSION['username'])){
		echo 'To get started, <a href="/signup.php">create an account</a>.';
	}; ?>
</p>

<?php

include 'inc/footer.php';
?>