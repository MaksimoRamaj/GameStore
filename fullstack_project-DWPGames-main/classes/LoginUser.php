<?php
// spl_autoload_register(function ($class) {
//     include "./classes/" . $class . ".php";
// });
class loginUser
{
    public $message;
    // START FORM PROCESSING
    public function __construct($username, $password)
    {
        $db = new DbCon();
        $username = trim($username);
        $password = trim($password);
        $query = $db->dbCon->prepare("SELECT id, username, pass, usertype FROM accounts WHERE username = '{$username}' LIMIT 1");
        if ($query->execute()) {
            $found_user = $query->fetchAll();
            if (count($found_user) == 1) {
                // username/password authenticated
                // and only 1 match
                if (password_verify($password, $found_user[0]['pass'])) {
                    if ($found_user[0]["usertype"] == "user" || $found_user[0]["usertype"] == "") {
                        $_SESSION['user_id'] = $found_user[0]['id'];
                        $_SESSION['user'] = $found_user[0]['username'];
                        $_SESSION['usertype'] = $found_user[0]['usertype'];
                        $redirect = new Redirector("index.php");
                    } elseif ($found_user[0]["usertype"] == "admin") {
                        $_SESSION['user_id'] = $found_user[0]['id'];
                        $_SESSION['user'] = $found_user[0]['username'];
                        $_SESSION['usertype'] = $found_user[0]['usertype'];
                        $redirect = new Redirector("/addproduct.php");
                    }
                } else {
                    // username/password combo was not found in the database
                    $this->message = "Username/password combination incorrect.<br />
						Please make sure your caps lock key is off and try again.";
                }
            } else { // Form has not been submitted.
                if (isset($_GET['logout']) && $_GET['logout'] == 1) {
                    $this->message = "You are now logged out.";
                }
            }
            if (!empty($this->message)) {
                echo "<p>" . $this->message . "</p>";
            }
        }
    }
}
