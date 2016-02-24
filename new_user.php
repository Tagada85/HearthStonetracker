<?php

include 'inc/header.php';

if(empty($_POST["username"]) ||empty($_POST["password"]) || empty($_POST["confirm_password"])) {
	
} else if($_POST["password"] != $_POST["confirm_password"]){
	echo "Passwords don't match! Try again.";
} else {
	require_once 'inc/UsersClass.php';
	$u = $_POST["username"];
	$p = $_POST["password"];
	$user = new User;
	$acc = $user->createAccount($u, $p);
	echo "<span class='message'>".$acc."</span>";
}

?>
<div class="form_container">
	<form method="post" action="new_user.php">
		<label for="username"> Username :
			<input type="text" name="username" id="username">
		</label>
		<br><br>
		<label for="password"> Password:
			<input type="password" name="password" id="password">
		</label>
		<br><br>
		<label for="confirm_password">Confirm Password:
			<input type="password" name="confirm_password" id="confirm_passwword">
		</label>
		<br><br>
		<input type="submit" value="Create new User">
	</form>
</div>


<?php

include 'inc/footer.php';

?>