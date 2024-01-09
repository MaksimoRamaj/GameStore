<?php
require("includes/head.php");
$db = new DbCon();

$news = "SELECT * FROM `news`";
$newsResult = mysqli_query($connection, $news);
$new = mysqli_fetch_all($newsResult, MYSQLI_ASSOC);
//var_dump($new);
$contactemail = $new[0]['email'];

$errors = array('firstname' => '', 'lastname' => '', 'email' => '', 'subject' => '', 'message' => '');
$numerror = 0;

if (isset($_POST['submit'])) {

    $firstname = Secure($connection, "firstname");
    $lastname = Secure($connection, "lastname");
    $email = Secure($connection, "email");
    $subject = Secure($connection, 'subject');
    $message = Secure($connection, "message");



    // $mymail = "emil96k0@easv365.dk";
    $mymail = $contactemail;
    // $emailinput = $_POST['email'];
    $regexp1 = "/^[A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
    $regexp2 = "/^[\.a-zA-Z0-9,!? ]{2,600}$/";

    if (
        !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $errors['email'] = " Email not valid.";
        $numerror++;
    }
    if (
        !preg_match($regexp2, $_POST['subject'])
    ) {
        $errors['subject'] = " Subject is required.";
        $numerror++;
    }
    if (
        !preg_match($regexp2, $_POST['message'])
    ) {
        $errors['message'] = " Message must contain something...";
        $numerror++;
    }
    if (
        !preg_match($regexp2, $_POST['firstname'])
        || !preg_match($regexp2, $_POST['lastname'])
    ) {
        $errors['firstname'] = " First name incorrectly filled out.";
        $errors['lastname'] = " Last name incorrectly filled out.";
        $numerror++;
    }
    if (
        empty($email)
        || empty($firstname)
        || empty($lastname)
        || empty($subject)
        || empty($message)
    ) {
        echo "Empty fields";
    }
    if ($numerror == 0) {
        $timestamp = date("h:i:sa");
        $body = "$message\n\nE-mail: $email";
        $body2 = "Thank you for your message \n\n$body";
        mail($mymail, $subject, $body, "From: $email\n");
        mail($email, $body2, $timestamp, "From: noreply@DWPGames.dk");
        echo "Thanks for your E-mail" . "<br> Sent at" . date("h:i:sa");
    }
} ?>


<?php
include("navigation/header.php");
?>

<div class="contactFormContainer">
    <form method="post" action="contact.php">
        <fieldset>
            <legend>
                <h2>Here you can write us an email!</h2>
            </legend>
            First Name: <br><input type="text" name="firstname">
            <div style="color:red;"><?php echo $errors['firstname']; ?></div> <br><br>
            Last Name: <br><input type="text" name="lastname">
            <div style="color:red;"><?php echo $errors['lastname']; ?></div> <br><br>
            Your Email: <br><input type="text" name="email">
            <div style="color:red;"><?php echo $errors['email']; ?></div> <br><br>
            Subject: <br><input type="text" name="subject">
            <div style="color:red;"><?php echo $errors['subject']; ?></div> <br><br>
            Message: <br><textarea cols="21" rows="10" name="message"></textarea>
            <div style="color:red;"><?php echo $errors['message']; ?></div> <br><br>
            <input class="submitBtn" type="submit" name="submit">
        </fieldset>
    </form>

</div>


<?php include("navigation/footer.php"); ?>