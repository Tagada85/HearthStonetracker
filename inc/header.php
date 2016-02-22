<?php

require_once 'database.php';

?>



<!DOCTYPE html>
<html>
	<head>
		<title><?php echo 'A title'?></title>
		<link rel="stylesheet" href="css/styles.css">
		<meta charset="utf-8"> 
	</head>
	<body>
		<header>
			<div class="nav-left">
				<a href="/index.php">
					<img src="img/logo.png">
				</a>
			</div>
			<nav>
				<ul class="navigation">
					<li>
						<a href="/index.php">Home</a>
					</li>
					<li>
						<a href="/stats.php">Stats</a>
					</li>
					<li>
						<a href="/decks.php">Decks</a>
					</li>
					<li>
						<a href="/contact.php">Contact</a>
					</li>
				</ul>
			</nav>
		</header>
		<section class="main-content">
