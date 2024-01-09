<?php
require("../includes/adminhead.php");
if(isset($_GET['id'])) {
    $query = "DELETE FROM `accounts` WHERE ID=" .$_GET['id'];
    mysqli_query($connection, $query);
    $redirect = New Redirector("accounts.php?ud=1");
}
