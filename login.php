<?php

require_once ("./vendor/autoload.php");

use App\Classes\DBConnector;
use App\Classes\Login;

$db = new DBConnector();
// $db->connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = new Login($_POST);
    $result = $register->loginUser();
    echo "Register";
    print_r($result);
}

include("./src/Pages/login.php");