<?php
require("../includes/adminhead.php");
// if (!admin()) {
//     $redirect = new Redirector("../index.php");
// }

$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT pass FROM `accounts` WHERE ID='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $password = $_POST['pass'];
    $iterations = ['cost' => 15];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

    $sql = "UPDATE `accounts` SET  `pass`='$hashed_password' WHERE ID='$id'";
    // echo $sql;

    if ($_POST['pass'] == $_POST['confirm']) {
        if (!mysqli_query($connection, $sql)) {
            echo mysqli_error($connection);
        }
        mysqli_close($connection);
            $redirect = new Redirector("../index.php");
            exit;
    } else {
        echo "no match";
    }
}
include("../navigation/adminNav.php");
?>

<div class="adminContent">
    <div class="changePass">
        <form method="POST">
            <fieldset>
                <legend>
                    <h3>Change Password</h3>
                </legend>
                <br><input type="password" name="pass" value="" placeholder="New Password" Required> <br><br>
                <br><input type="password" name="confirm" value="" placeholder="Confirm New Password" Required> <br><br>
                <br><input class="changePassBtn" type="submit" name="update" value="Update">
            </fieldset>
        </form>
    </div>
</div>

<?php include("../navigation/footer.php"); ?>