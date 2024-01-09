<?php
require("includes/head.php");


$errors = array('username' => '', 'pass' => '', 'Fname' => '', 'Lname' => '', 'email' => '', 'description' => '');
$numerror = 0;

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.

	// perform validations on the form data
	$username = Secure($connection, 'username');
	$password = Secure($connection, 'pass');
	$fname = Secure($connection, 'Fname');
	$lname = Secure($connection, 'Lname');
	$email = Secure($connection, 'email');
	$description = Secure($connection, 'description');
	$iterations = ['cost' => 15];
	$hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

	$query = "INSERT INTO `accounts` (`username`, `Fname`, `Lname`, `email`, `description`, `pass`) VALUES ('{$username}', '{$fname}', '{$lname}', '{$email}', '{$description}', '{$hashed_password}')";
	$result = mysqli_query($connection, $query);
	$query1 = "SELECT id, username, pass, usertype FROM accounts WHERE username = '{$username}' LIMIT 1";
	$result1 = mysqli_query($connection, $query1);
	$details = mysqli_fetch_array($result1);


	$regexp2 = "/^[\.a-zA-Z0-9,!? ]{2,600}$/";

	if (
		!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
	) {
		$errors['email'] = " Email not valid.";
		$numerror++;
	}
	if (
		!preg_match($regexp2, $_POST['username'])
	) {
		$errors['username'] = " Username is required.";
		$numerror++;
	}
	if (
		!preg_match($regexp2, $_POST['pass'])
	) {
		$errors['pass'] = " Password is required.";
		$numerror++;
	}
	if (
		!preg_match($regexp2, $_POST['Fname'])
	) {
		$errors['Fname'] = " Name is required.";
		$numerror++;
	}
	if (
		!preg_match($regexp2, $_POST['Lname'])
	) {
		$errors['Lname'] = " Surname is required.";
		$numerror++;
	}
	if (
		!preg_match($regexp2, $_POST['description'])
	) {
		$errors['description'] = " Description is required.";
		$numerror++;
	}
	if ($numerror == 0) {
		if ($result) {
			if ($details["usertype"] == "user" || $details["usertype"] == "") {
				$_SESSION['user_id'] = $details['id'];
				$_SESSION['user'] = $details['username'];
				$_SESSION['usertype'] = $details['usertype'];
				$redirect = new Redirector("index.php?uc=1");
			}
		} else {
			$message = "User could not be created. This user already exists.";
			$message .= "<br />" . mysqli_error($connection);
		}
	}
}

include("navigation/header.php");

?>
<div class="CreateNewUser">
	<div> <?php if (isset($message)) {
				echo $message;
			} ?>
	</div>
	<form action="" method="post">
		<fieldset>
			<legend>
				<h2>Create New User</h2>
			</legend>
			Username:<br><input type="text" name="username">
			<div style="color:red;"><?php echo $errors['username']; ?></div><br><br>
			Password:<br><input type="text" name="pass">
			<div style="color:red;"><?php echo $errors['pass']; ?></div><br><br>
			First Name:<br><input type="text" name="Fname">
			<div style="color:red;"><?php echo $errors['Fname']; ?></div><br><br>
			Last Name:<br><input type="text" name="Lname">
			<div style="color:red;"><?php echo $errors['Lname']; ?></div><br><br>
			Email:<br><input type="text" name="email">
			<div style="color:red;"><?php echo $errors['email']; ?></div><br><br>
			Description:<br><textarea cols="21" rows="6" type="text" name="description"></textarea>
			<div style="color:red;"><?php echo $errors['description']; ?></div><br><br>
			<input class="button" type="submit" name="submit" value="Create" />
		</fieldset>
	</form>
</div>
</div>
<?php include("navigation/footer.php"); ?>
<?php
if (isset($connection)) {
	mysqli_close($connection);
}


?>