<?php

include 'inc/header.php';


if(!empty($_POST["username"]) && !empty($_POST["password"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$user = new User;
	$account = $user->verifyLogIn($username, $password);
	if ($account == TRUE){
		echo "<script>window.location.replace('/')</script>";
	}else if($account == FALSE){
		echo "<span class='message'>Wrong password and/or username.</span>";
	}
}



?>



<form class="form_container" method="post" action="#">
	<label for="username"> Username:
		<input type="text" name="username" id="username">
	</label>
	<br><br>
	<label for="password"> Password:
		<input type="password" name="password" id="password">
	</label>
	<br><br>
	<input type="submit" value="Log In">
</form>


<?php

include 'inc/footer.php';

?>