<?php

 // Database credentials
    define('DB_HOST', 'localhost:3306');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_NAME', 'HearthStone');


ini_set('display_errors', 'On');



try{
	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
	$db = new PDO($dsn, DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
	echo $e->getMessage();
	die();
}

try{
	$results = $db->query('SELECT * FROM Classes');
}catch(Exception $e){
	echo $e->getMessage();
	die();
}




?>

