<?php
session_start();
//session_destroy();
require_once 'inc/usersClass.php';
$path = $_SERVER['REQUEST_URI'];
?>



<!DOCTYPE html>
<html>
	<head>
		<title><?php 
			if($path == '/' || $path == '/index.php'){
				echo 'Homepage';
			}else if($path == '/stats.php'){
				echo 'Statistics';
			}else if($path == '/decks.php'){
				echo 'Decks';
			}else if($path == '/new_game.php'){
				echo 'Add a game';
			} else if($path == '/login.php'){
				echo 'Log In';
			}else if($path == '/signup.php'){
				echo 'Create a Account';
			}
		?></title>
		<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<link href='https://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<meta charset="utf-8"> 
	</head>
	<body>
		<header>
			<div class="nav-left">
				<a href="/">
					<img src="img/logo.png">
				</a>
			</div>
			<!-- If the user is logged in -->
			
			<nav>
				<ul class="navigation">
					<?php 
						if(isset($_SESSION["username"])):
					?>
					<li>
						<a href="/">Home</a>
					</li>
					<li>
						<a href="/stats.php">Stats</a>
					</li>
					<li>
						<a href="/decks.php">Decks</a>
					</li>
					
			<?php else: ?>
					<!-- If not logged in, show these -->
					<li>
						<a href="/login.php">Log In</a>
					</li>
					<li>
						<a href="/signup.php">Sign Up</a>
					</li>
			<?php endif; ?>
					<li>
						<a href="http://www.damiencosset.com/contact.html">Contact</a>
					</li>
				</ul>
			</nav>
			<?php 
				if(isset($_SESSION["username"])){
					echo "<span>";
					echo "Connected as " .$_SESSION["username"];
					echo "   ";
					echo "<a href='/logout.php' class='logout'>Log out</a>";
					echo "</span>";
				}
			?>

		</header>
		
		<?php
			if(isset($_SESSION["username"])){
				
				echo "<a href='/new_game.php' class='btn game-btn'>+ Add New Game</a>";
				
			}
		?>
		
		<section class="main-content">


