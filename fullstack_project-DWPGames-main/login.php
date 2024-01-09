<?php
require("includes/head.php");

if (logged_in()) {
	$redirect = new Redirector("index.php");
}
if (isset($_POST['submit_login'])) { // Form has been submitted.
	$login = new loginUser($_POST['user'], $_POST['pass']);
}
include("navigation/header.php");
?>

<div id="Login" class="login">
	<form action="" method="post">
		<fieldset>
			<legend>
				<h2>Please login</h2>
			</legend>
			Username:
			<input type="text" name="user" maxlength="30" value="" /> <br><br>
			Password:
			<input type="password" name="pass" maxlength="30" value="" /> <br><br>
			<input class="button" type="submit" name="submit_login" value="Login" />
		</fieldset>
	</form>
	<br><br>
	<div class="createNew">
		<h2>Is it someone new?</h2>
		<a style='text-decoration: none;' href='newuser.php'>
			<button>Create User</button></a>
	</div>
</div>

<?php
include("navigation/footer.php");

if (isset($connection)) {
	mysqli_close($connection);
}
?>