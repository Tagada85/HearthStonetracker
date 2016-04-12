<?php

include 'inc/header.php';


if(!empty($_POST["username"])){
	include_once('inc/usersClass.php');
	$u = trim($_POST["username"]);
	$email = trim($_POST["email"]);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die('Invalid Email Adress');
	}
	$password = $_POST["password"];

	$users = new User;
	echo $users->createAccount($u, $email, $password);
} 



?>

<h4>Create an Account:</h4>
<form class="form_container" action="#" method="post">
	<label for="username"> Username:
		<input type="text" id="username" name="username">
	</label>
	<br><br>
	<label for="email"> Email:
		<input type="email" id="email" name="email">
	</label>
	<br><br>
	<label for="password"> Password:
		<input type="password" id="password" name="password">
	</label>
	<br><br>
	<label for="confirm_password"> Confirm Password:
		<input type="password" id="confirm_password" name="confirm_password">
	</label>
	<br><br>
	<input type="submit" id="submit" value="Create Account">
</form>



<script>

	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");
	var email = document.getElementById("email");
	var username = document.getElementById("username");
	var submit = document.getElementById("submit");

	function controlPasswords() {
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords must match !");
		} else {
			confirm_password.setCustomValidity("");
		}
	}

	function controlInputs(event){
		if(username.value == '' || email.value == ''){
			alert("You must complete the form to create an account.");
			event.preventDefault();
		}
	}

	password.onchange = controlPasswords;
	confirm_password.onkeyup = controlPasswords;
	submit.onclick = controlInputs;


</script>


<?php

include 'inc/footer.php';

?>