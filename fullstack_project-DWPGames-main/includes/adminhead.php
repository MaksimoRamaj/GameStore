<?php 
spl_autoload_register(function ($class) 
{include "../classes/" . $class . ".php";}
);

require('../includes/connection.php');
require('../includes/session.php');
